<?php
/**
 * fix_bcn_cat_parent.php
 *
 * Makes category 1824 a top-level category (removes parent 1718)
 * so that the product permalink becomes:
 *   /contratar-stripper-para-fiestas-y-despedidas-en-barcelona/<slug>/
 *
 * Also updates the category_base so the category page itself
 * is accessible at the right URL.
 */

define('WP_USE_THEMES', false);
require('/var/www/vhosts/espectaculosluxury.com/httpdocs/wp-load.php');

global $wpdb;

echo "=== Fix Category 1824 Parent ===\n\n";

$cat_id = 1824;

// 1. Check current state
$cat = get_term($cat_id, 'product_cat');
echo "Before:\n";
echo "  Name: {$cat->name}\n";
echo "  Slug: {$cat->slug}\n";
echo "  Parent: {$cat->parent}\n\n";

// 2. Remove the parent (set to 0 = top-level)
if ($cat->parent != 0) {
    $result = wp_update_term($cat_id, 'product_cat', [
        'parent' => 0
    ]);
    if (is_wp_error($result)) {
        echo "ERROR: " . $result->get_error_message() . "\n";
    } else {
        echo "SUCCESS: Category 1824 is now top-level (parent = 0)\n";
    }
} else {
    echo "Category 1824 is already top-level.\n";
}

// 3. Verify
$cat_after = get_term($cat_id, 'product_cat');
echo "\nAfter:\n";
echo "  Name: {$cat_after->name}\n";
echo "  Slug: {$cat_after->slug}\n";
echo "  Parent: {$cat_after->parent}\n\n";

// 4. Make sure WooCommerce product_base is set to /%product_cat%
$wc_perms = get_option('woocommerce_permalinks', []);
echo "WC product_base: " . ($wc_perms['product_base'] ?? '(empty)') . "\n";
if (($wc_perms['product_base'] ?? '') !== '/%product_cat%') {
    $wc_perms['product_base'] = '/%product_cat%';
    update_option('woocommerce_permalinks', $wc_perms);
    echo "Updated WC product_base to /%product_cat%\n";
}

// 5. Flush rewrite rules
global $wp_rewrite;
$wp_rewrite->flush_rules(true);
echo "Rewrite rules flushed.\n\n";

// 6. Show new product permalinks
$product_ids = [67974, 67975, 67976, 67977, 67978, 67979, 67980, 67981];
echo "New product permalinks:\n";
foreach ($product_ids as $pid) {
    clean_post_cache($pid);
    echo "  " . get_permalink($pid) . "\n";
}

// 7. Category page URL
echo "\nCategory page URL:\n";
echo "  " . get_term_link($cat_id, 'product_cat') . "\n";

echo "\n=== DONE ===\n";
