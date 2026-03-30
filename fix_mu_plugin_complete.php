<?php
/**
 * fix_mu_plugin_complete.php
 *
 * Complete solution:
 * 1. Create/update mu-plugin that:
 *    a) Adds Barcelona product rewrite rules (top priority)
 *    b) Removes the WooCommerce product_cat catch-all via option filter
 *    c) Explicitly adds page rules for /stripper-barcelona/ and cluster pages
 * 2. Updates .htaccess to pass pagename properly
 * 3. Flushes everything
 */

define('WP_USE_THEMES', false);
require('/var/www/vhosts/espectaculosluxury.com/httpdocs/wp-load.php');

global $wp_rewrite, $wpdb;

echo "=== Complete Fix: mu-plugin + .htaccess ===\n\n";

// 1. Create comprehensive mu-plugin
$mu_dir = '/var/www/vhosts/espectaculosluxury.com/httpdocs/wp-content/mu-plugins';
if (!is_dir($mu_dir)) mkdir($mu_dir, 0755, true);

$mu_content = <<<'PHP'
<?php
/**
 * Plugin Name: BCN Product & Page Rewrite Fix
 * Description: Fixes URL structure for Barcelona products and prevents WooCommerce
 *              catch-all from breaking the /stripper-barcelona/ landing page.
 * Version: 2.0
 */

// Priority rewrite rules for Barcelona products
add_action('init', 'bcn_add_rewrite_rules', 5);
function bcn_add_rewrite_rules() {
    $prefix = 'contratar-stripper-para-fiestas-y-despedidas-en-barcelona';
    $slugs = [
        67974 => 'show-integral-stripper-barcelona',
        67975 => 'show-lesbico-duo-barcelona',
        67976 => 'show-juguete-erotico-barcelona',
        67977 => 'camarera-sexy-barcelona',
        67978 => 'pack-camarera-show-barcelona',
        67979 => 'stripper-a-domicilio-barcelona-producto',
        67980 => 'stripper-despedida-soltera-barcelona-producto',
        67981 => 'stripper-cumpleanos-barcelona-producto',
    ];

    foreach ($slugs as $id => $slug) {
        // Product page
        add_rewrite_rule(
            '^' . preg_quote($prefix) . '/' . preg_quote($slug) . '/?$',
            'index.php?product=' . $slug,
            'top'
        );
        // Product with page
        add_rewrite_rule(
            '^' . preg_quote($prefix) . '/' . preg_quote($slug) . '/page/?([0-9]+)/?$',
            'index.php?product=' . $slug . '&paged=$matches[1]',
            'top'
        );
    }
}

// Remove WooCommerce's catch-all product_cat rules that break page URLs
add_filter('option_rewrite_rules', 'bcn_filter_rewrite_rules');
function bcn_filter_rewrite_rules($rules) {
    if (!is_array($rules)) return $rules;

    // These are the problematic WooCommerce generic catch-alls
    $remove_patterns = [
        '(.+?)/?$',           // Bare catch-all => product_cat
        '^(.+?)/?$',          // Same with anchor
    ];

    foreach ($remove_patterns as $pattern) {
        if (isset($rules[$pattern])) {
            $val = $rules[$pattern];
            // Only remove if it maps to product_cat (not a page or post)
            if (strpos($val, 'product_cat') !== false) {
                unset($rules[$pattern]);
            }
        }
    }

    return $rules;
}

// Ensure Barcelona cluster pages are recognized
add_action('init', 'bcn_add_page_rules', 5);
function bcn_add_page_rules() {
    // These are the Barcelona cluster pages (post_type = post or page)
    $page_slugs = [
        'stripper-barcelona'                   => 67406,
        'stripper-despedidas-soltera-barcelona' => 67991,
        'stripper-a-domicilio-barcelona'        => 67992,
        'stripper-cumpleanos-barcelona'          => 67993,
        'stripper-fiestas-privadas-barcelona'   => 67994,
        'stripper-masculino-barcelona'          => 67995,
    ];

    foreach ($page_slugs as $slug => $id) {
        // Add explicit rewrite rule for each page slug
        add_rewrite_rule(
            '^' . preg_quote($slug) . '/?$',
            'index.php?page_id=' . $id,
            'top'
        );
        add_rewrite_rule(
            '^' . preg_quote($slug) . '/page/?([0-9]+)/?$',
            'index.php?page_id=' . $id . '&paged=$matches[1]',
            'top'
        );
    }
}
PHP;

$mu_file = $mu_dir . '/bcn-product-rewrite.php';
file_put_contents($mu_file, $mu_content);
echo "1. Updated mu-plugin: $mu_file\n";

// 2. Remove the problematic htaccess rules (they don't help, remove confusion)
$htaccess_path = '/var/www/vhosts/espectaculosluxury.com/httpdocs/.htaccess';
$htaccess = file_get_contents($htaccess_path);
$htaccess = preg_replace(
    '/\n# BEGIN Barcelona Pages Priority.*?# END Barcelona Pages Priority\n/s',
    "\n",
    $htaccess
);
file_put_contents($htaccess_path, $htaccess);
echo "2. Removed .htaccess Barcelona rules (using WP rewrite instead)\n";

// 3. Force complete rewrite regeneration
$wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name = 'rewrite_rules'");
$wp_rewrite->init();

// Now register the rules directly (same as init hook but for this script)
$prefix = 'contratar-stripper-para-fiestas-y-despedidas-en-barcelona';
$slugs = [
    67974 => 'show-integral-stripper-barcelona',
    67975 => 'show-lesbico-duo-barcelona',
    67976 => 'show-juguete-erotico-barcelona',
    67977 => 'camarera-sexy-barcelona',
    67978 => 'pack-camarera-show-barcelona',
    67979 => 'stripper-a-domicilio-barcelona-producto',
    67980 => 'stripper-despedida-soltera-barcelona-producto',
    67981 => 'stripper-cumpleanos-barcelona-producto',
];

foreach ($slugs as $id => $slug) {
    add_rewrite_rule('^' . preg_quote($prefix) . '/' . preg_quote($slug) . '/?$', 'index.php?product=' . $slug, 'top');
}

// Add explicit page rules
$page_rules = [
    'stripper-barcelona'                    => 67406,
    'stripper-despedidas-soltera-barcelona'  => 67991,
    'stripper-a-domicilio-barcelona'         => 67992,
    'stripper-cumpleanos-barcelona'           => 67993,
    'stripper-fiestas-privadas-barcelona'    => 67994,
    'stripper-masculino-barcelona'           => 67995,
];

foreach ($page_rules as $slug => $id) {
    add_rewrite_rule('^' . preg_quote($slug) . '/?$', 'index.php?page_id=' . $id, 'top');
}

$wp_rewrite->flush_rules(true);
echo "3. Rewrite rules regenerated with explicit rules\n\n";

// 4. Now manually apply the filter and save clean rules
$rules = get_option('rewrite_rules', []);
$bad_patterns = ['(.+?)/?$', '^(.+?)/?$'];
$removed = 0;
foreach ($bad_patterns as $pattern) {
    if (isset($rules[$pattern]) && strpos($rules[$pattern], 'product_cat') !== false) {
        unset($rules[$pattern]);
        $removed++;
        echo "4. Removed catch-all: $pattern\n";
    }
}
if ($removed) {
    update_option('rewrite_rules', $rules);
    echo "   Saved clean rules (" . count($rules) . " total)\n";
} else {
    echo "4. No catch-all rules found to remove\n";
}

// 5. Verify
echo "\n5. HTTP status check:\n";
$test_urls = [
    'https://espectaculosluxury.com/stripper-barcelona/' => '/stripper-barcelona/',
    'https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/' => 'Category',
    'https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/show-integral-stripper-barcelona/' => 'Product 1',
    'https://espectaculosluxury.com/stripper-despedidas-soltera-barcelona/' => 'Cluster despedidas',
    'https://espectaculosluxury.com/stripper-cumpleanos-barcelona/' => 'Cluster cumpleaños',
    'https://espectaculosluxury.com/stripper-masculino-barcelona/' => 'Cluster masculino',
];

foreach ($test_urls as $url => $label) {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_NOBODY => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT => 'Mozilla/5.0',
    ]);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    echo "  $code | $label\n";
}

echo "\n=== DONE ===\n";
