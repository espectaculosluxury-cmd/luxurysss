<?php
/**
 * fix_landing_product_links.php
 * 
 * Fixes the remaining /producto/ links in the Barcelona landing page (67406)
 * for the 3 slugs that don't have the -producto suffix.
 */
define('WP_USE_THEMES', false);
define('DOING_CRON', true);
require('/var/www/vhosts/espectaculosluxury.com/httpdocs/wp-load.php');

global $wpdb;

echo "=== Fix Landing Page /producto/ Links ===\n\n";

$new_base = '/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/';

// These slugs appear WITHOUT -producto suffix in the landing page
// but they are the same products (redirects should handle it)
// We need to map them to the correct new URLs
$slug_map = [
    // old slug (without -producto) => new slug (correct product post_name)
    'stripper-a-domicilio-barcelona'         => 'stripper-a-domicilio-barcelona-producto',
    'stripper-despedida-soltera-barcelona'   => 'stripper-despedida-soltera-barcelona-producto',
    'stripper-cumpleanos-barcelona'          => 'stripper-cumpleanos-barcelona-producto',
];

$content = $wpdb->get_var("SELECT post_content FROM {$wpdb->posts} WHERE ID = 67406");
$original = $content;

foreach ($slug_map as $old_slug => $new_slug) {
    $old_url = '/producto/' . $old_slug . '/';
    $new_url = $new_base . $new_slug . '/';
    $count_before = substr_count($content, $old_url);
    $content = str_replace($old_url, $new_url, $content);
    $count_after = substr_count($content, $old_url);
    echo "  '$old_url' → '$new_url' (replaced: " . ($count_before - $count_after) . ")\n";
}

$remaining = substr_count($content, '/producto/');
echo "\nRemaining /producto/ refs: $remaining\n";

if ($content !== $original) {
    $result = $wpdb->query(
        $wpdb->prepare(
            "UPDATE {$wpdb->posts} SET post_content = %s, post_modified = NOW(), post_modified_gmt = UTC_TIMESTAMP() WHERE ID = 67406",
            $content
        )
    );
    echo "Updated landing page 67406: $result row(s)\n";
} else {
    echo "No changes needed.\n";
}

wp_cache_flush();
echo "\n=== DONE ===\n";
