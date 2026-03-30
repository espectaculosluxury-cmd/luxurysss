<?php
/**
 * fix_product_custom_rewrite.php
 *
 * Strategy: 
 * 1. Revert WooCommerce product_base back to /producto (original, no conflicts)
 * 2. Add custom WordPress rewrite rules that map:
 *    /contratar-stripper-para-fiestas-y-despedidas-en-barcelona/<slug>/
 *    => the correct WooCommerce product page
 * 3. This uses a mu-plugin to add the rules permanently
 * 4. Products still "live" at /producto/ internally but are accessible via the BCN category URL
 *
 * Alternative approach: Use WordPress's native rewrite API to add product rules
 * under the Barcelona category prefix while keeping /producto/ working.
 */

define('WP_USE_THEMES', false);
require('/var/www/vhosts/espectaculosluxury.com/httpdocs/wp-load.php');

global $wp_rewrite, $wpdb;

echo "=== Fix with Custom Rewrite Rules ===\n\n";

// 1. Revert product_base to original /producto
$wc_perms = get_option('woocommerce_permalinks', []);
$wc_perms['product_base'] = '/producto';
$wc_perms['use_verbose_page_rules'] = '';
update_option('woocommerce_permalinks', $wc_perms);
echo "1. Reverted product_base to '/producto'\n";

// 2. Regenerate rules
$wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name = 'rewrite_rules'");
$wp_rewrite->init();
$wp_rewrite->flush_rules(true);
echo "2. Base rewrite rules regenerated\n\n";

// 3. Create a must-use plugin that adds custom rewrite rules for Barcelona products
$mu_plugin_dir = '/var/www/vhosts/espectaculosluxury.com/httpdocs/wp-content/mu-plugins';
if (!is_dir($mu_plugin_dir)) {
    mkdir($mu_plugin_dir, 0755, true);
    echo "3. Created mu-plugins directory\n";
}

$mu_plugin_content = '<?php
/**
 * Plugin Name: Barcelona Products Custom Rewrite
 * Description: Maps /contratar-stripper-para-fiestas-y-despedidas-en-barcelona/<slug>/ to WooCommerce products
 * Version: 1.0
 */

add_action(\'init\', \'bcn_add_product_rewrite_rules\', 20);
function bcn_add_product_rewrite_rules() {
    $bcn_prefix = \'contratar-stripper-para-fiestas-y-despedidas-en-barcelona\';
    $bcn_slugs = [
        \'show-integral-stripper-barcelona\',
        \'show-lesbico-duo-barcelona\',
        \'show-juguete-erotico-barcelona\',
        \'camarera-sexy-barcelona\',
        \'pack-camarera-show-barcelona\',
        \'stripper-a-domicilio-barcelona-producto\',
        \'stripper-despedida-soltera-barcelona-producto\',
        \'stripper-cumpleanos-barcelona-producto\',
    ];
    
    foreach ($bcn_slugs as $slug) {
        // Main product page
        add_rewrite_rule(
            \'^(\' . preg_quote($bcn_prefix) . \')/(\' . preg_quote($slug) . \')/?$\',
            \'index.php?product=\' . $slug,
            \'top\'
        );
        // Product with page number
        add_rewrite_rule(
            \'^(\' . preg_quote($bcn_prefix) . \')/(\' . preg_quote($slug) . \')/page/?([0-9]{1,})/?$\',
            \'index.php?product=\' . $slug . \'&paged=$matches[3]\',
            \'top\'
        );
    }
}

// Ensure product slugs are recognized as product query var
add_filter(\'woocommerce_product_rewrite_slug\', function($slug) {
    return $slug;
});
';

$mu_plugin_file = $mu_plugin_dir . '/bcn-product-rewrite.php';
file_put_contents($mu_plugin_file, $mu_plugin_content);
echo "3. Created mu-plugin: $mu_plugin_file\n";

// 4. Flush rewrite rules again to include the new mu-plugin rules
$wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name = 'rewrite_rules'");
$wp_rewrite->init();

// Register the new rules
$bcn_prefix = 'contratar-stripper-para-fiestas-y-despedidas-en-barcelona';
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

foreach ($bcn_slugs as $slug) {
    add_rewrite_rule(
        '^(' . preg_quote($bcn_prefix) . ')/(' . preg_quote($slug) . ')/?$',
        'index.php?product=' . $slug,
        'top'
    );
}

$wp_rewrite->flush_rules(true);
echo "4. Added custom rewrite rules and flushed\n\n";

// 5. Verify all URLs
$test_urls = [
    '/stripper-barcelona/' => 'Landing page',
    '/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/' => 'Category page',
    '/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/show-integral-stripper-barcelona/' => 'Product 1',
    '/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/camarera-sexy-barcelona/' => 'Product 4',
    '/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/' => 'Product 6',
];

echo "5. HTTP status check:\n";
foreach ($test_urls as $path => $label) {
    $response = wp_remote_get('https://espectaculosluxury.com' . $path, ['timeout' => 8, 'sslverify' => false]);
    $code = !is_wp_error($response) ? wp_remote_retrieve_response_code($response) : 'ERR';
    echo "  $code | $label | $path\n";
}

// 6. Check product permalinks
echo "\n6. Product permalinks (now /producto/ base):\n";
foreach ([67974, 67977, 67979, 67981] as $pid) {
    clean_post_cache($pid);
    echo "  $pid: " . get_permalink($pid) . "\n";
}

echo "\n=== DONE ===\n";
