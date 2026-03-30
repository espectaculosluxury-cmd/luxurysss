<?php
/**
 * fix_bcn_category_v2.php
 *
 * Focused fix:
 * 1. Ensures all 8 Barcelona products are in cat 1824 (already done, verifies).
 * 2. Changes WooCommerce product_base to /%product_cat% so URLs show the category.
 * 3. Sets category thumbnail (image 67959) for cat 1824.
 * 4. Assigns images 67959-67973 to product galleries (2 each, cycling).
 * 5. Sets rank_math_primary_category and _primary_term_product_cat to 1824.
 * 6. Flushes rewrite rules.
 */

define('WP_USE_THEMES', false);
require('/var/www/vhosts/espectaculosluxury.com/httpdocs/wp-load.php');

echo "=== Barcelona Category & Permalink Fix v2 ===\n\n";

$product_ids = [67974, 67975, 67976, 67977, 67978, 67979, 67980, 67981];
$image_ids   = [67959, 67960, 67961, 67962, 67963, 67964, 67965, 67966,
                67967, 67968, 67969, 67970, 67971, 67972, 67973];
$cat_id      = 1824;

// 1. Verify category assignment + set primary category meta
echo "1. Category assignment + primary category meta\n";
foreach ($product_ids as $pid) {
    $cats = wp_get_object_terms($pid, 'product_cat', ['fields' => 'ids']);
    if (is_wp_error($cats)) { echo "   ERR $pid\n"; continue; }
    if (!in_array($cat_id, $cats)) {
        wp_set_object_terms($pid, array_merge($cats, [$cat_id]), 'product_cat');
        echo "   ADDED $cat_id to $pid\n";
    } else {
        echo "   OK $pid already in cat $cat_id\n";
    }
    update_post_meta($pid, 'rank_math_primary_category', $cat_id);
    update_post_meta($pid, '_primary_term_product_cat', $cat_id);
}

// 2. Update WooCommerce permalink base
echo "\n2. WooCommerce permalink base\n";
$wc_perms = get_option('woocommerce_permalinks', []);
$old_base  = $wc_perms['product_base'] ?? '/producto';
$wc_perms['product_base'] = '/%product_cat%';
update_option('woocommerce_permalinks', $wc_perms);
echo "   Changed: '$old_base' → '/%product_cat%'\n";

// 3. Category thumbnail
echo "\n3. Category thumbnail\n";
$thumb = get_term_meta($cat_id, 'thumbnail_id', true);
if (!$thumb) {
    update_term_meta($cat_id, 'thumbnail_id', 67959);
    echo "   Set thumbnail to 67959\n";
} else {
    echo "   Thumbnail already set: $thumb\n";
}

// 4. Distribute images to products
echo "\n4. Images to products\n";
$total = count($image_ids);
$idx   = 0;
foreach ($product_ids as $i => $pid) {
    // Featured image
    if (!get_post_thumbnail_id($pid)) {
        set_post_thumbnail($pid, $image_ids[$idx % $total]);
        echo "   $pid: featured = " . $image_ids[$idx % $total] . "\n";
    } else {
        echo "   $pid: featured already = " . get_post_thumbnail_id($pid) . "\n";
    }
    // Gallery: 2 images per product
    $g1 = $image_ids[$idx % $total];
    $g2 = $image_ids[($idx + 1) % $total];
    $existing_gallery = get_post_meta($pid, '_product_image_gallery', true);
    if (empty($existing_gallery)) {
        update_post_meta($pid, '_product_image_gallery', "$g1,$g2");
        echo "   $pid: gallery = $g1,$g2\n";
    } else {
        echo "   $pid: gallery already = $existing_gallery\n";
    }
    $idx += 2;
}

// 5. Tag each image with the category (custom meta for reference)
echo "\n5. Tag images with category $cat_id\n";
foreach ($image_ids as $img_id) {
    update_post_meta($img_id, '_product_cat_id', $cat_id);
    echo "   $img_id tagged\n";
}

// 6. Flush rewrite rules
echo "\n6. Flushing rewrite rules...\n";
global $wp_rewrite;
$wp_rewrite->flush_rules(true);
echo "   Done.\n";

// 7. Show resulting permalinks
echo "\n7. Product permalinks after change:\n";
foreach ($product_ids as $pid) {
    // Clean permalink cache
    clean_post_cache($pid);
    echo "   " . get_permalink($pid) . "\n";
}

echo "\n=== DONE ===\n";
