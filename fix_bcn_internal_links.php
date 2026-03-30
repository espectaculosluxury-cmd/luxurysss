<?php
/**
 * fix_bcn_internal_links.php
 *
 * Replaces /producto/<bcn-slug>/ with /contratar-stripper-para-fiestas-y-despedidas-en-barcelona/<bcn-slug>/
 * in the content of all Barcelona products, clusters, and the landing page.
 * Uses direct DB queries to bypass wp_update_post hooks that crash CLI.
 */

define('WP_USE_THEMES', false);
define('DOING_CRON', true); // Suppress some hook actions
require('/var/www/vhosts/espectaculosluxury.com/httpdocs/wp-load.php');

global $wpdb;

echo "=== Fix Barcelona Internal Links ===\n\n";

// Posts to update (products + clusters + landing)
$post_ids = [
    // Products
    67974, 67975, 67976, 67977, 67978, 67979, 67980, 67981,
    // Clusters
    67991, 67992, 67993, 67994, 67995,
];

// Also find the landing page
$landing = $wpdb->get_var("
    SELECT ID FROM {$wpdb->posts}
    WHERE post_name = 'stripper-barcelona'
    AND post_type IN ('page','post')
    AND post_status = 'publish'
    LIMIT 1
");
if ($landing) {
    $post_ids[] = (int)$landing;
    echo "Found landing page: $landing\n";
}

$bcn_slugs = [
    'show-integral-stripper-barcelona',
    'show-lesbico-duo-barcelona',
    'show-juguete-erotico-barcelona',
    'camarera-sexy-barcelona',
    'pack-camarera-show-barcelona',
    'stripper-a-domicilio-barcelona-producto',
    'stripper-despedida-soltera-barcelona-producto',
    'stripper-cumpleanos-barcelona-producto',
];

$new_base = '/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/';
$old_base = '/producto/';

$total_updated = 0;

foreach ($post_ids as $pid) {
    $post = $wpdb->get_row("SELECT ID, post_title, post_content FROM {$wpdb->posts} WHERE ID = $pid");
    if (!$post) {
        echo "SKIP: Post $pid not found\n";
        continue;
    }

    $original = $post->post_content;
    $new_content = $original;

    // Replace each known Barcelona product slug URL
    foreach ($bcn_slugs as $slug) {
        $old_url = $old_base . $slug . '/';
        $new_url = $new_base . $slug . '/';
        $new_content = str_replace($old_url, $new_url, $new_content);
    }

    // Also do a generic replace of /producto/ → new base for any Barcelona-related URLs
    // (cautious: only replace if it looks like a Barcelona product slug)
    // Actually let's just check if there are any remaining /producto/ references
    $remaining = substr_count($new_content, '/producto/');

    if ($new_content !== $original) {
        $result = $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->posts} SET post_content = %s, post_modified = NOW(), post_modified_gmt = UTC_TIMESTAMP() WHERE ID = %d",
                $new_content,
                $pid
            )
        );
        echo "UPDATED $pid ({$post->post_title}): $result row(s) changed, remaining /producto/ refs: $remaining\n";
        $total_updated++;
    } else {
        $remaining_in_original = substr_count($original, '/producto/');
        echo "NO CHANGE $pid ({$post->post_title}) - /producto/ refs: $remaining_in_original\n";
    }
}

// Also update post meta (JSON-LD schemas in rank_math_schema_*)
echo "\n--- Updating RankMath schema meta for Barcelona posts ---\n";

$all_ids = implode(',', array_map('intval', $post_ids));
$schema_metas = $wpdb->get_results("
    SELECT post_id, meta_id, meta_key, meta_value
    FROM {$wpdb->postmeta}
    WHERE post_id IN ($all_ids)
    AND meta_key LIKE 'rank_math_schema%'
    AND meta_value LIKE '%/producto/%'
");

foreach ($schema_metas as $meta) {
    $new_value = $meta->meta_value;
    foreach ($bcn_slugs as $slug) {
        $new_value = str_replace('/producto/' . $slug . '/', $new_base . $slug . '/', $new_value);
    }
    if ($new_value !== $meta->meta_value) {
        $wpdb->query($wpdb->prepare(
            "UPDATE {$wpdb->postmeta} SET meta_value = %s WHERE meta_id = %d",
            $new_value, $meta->meta_id
        ));
        echo "UPDATED meta {$meta->meta_key} for post {$meta->post_id}\n";
    }
}

// Clear object cache
wp_cache_flush();
clean_post_cache(0);

echo "\n=== Total posts updated: $total_updated ===\n";
echo "=== DONE ===\n";
