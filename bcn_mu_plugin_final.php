<?php
/**
 * Plugin Name: BCN Product Page Rewrite Fix
 * Description: Fixes URL structure for Barcelona products and cluster pages.
 * Version: 3.0
 */

// Add Barcelona product rewrite rules
add_action('init', 'bcn_add_rewrite_rules', 5);
function bcn_add_rewrite_rules() {
    $prefix = 'contratar-stripper-para-fiestas-y-despedidas-en-barcelona';
    $slugs = array(
        'show-integral-stripper-barcelona',
        'show-lesbico-duo-barcelona',
        'show-juguete-erotico-barcelona',
        'camarera-sexy-barcelona',
        'pack-camarera-show-barcelona',
        'stripper-a-domicilio-barcelona-producto',
        'stripper-despedida-soltera-barcelona-producto',
        'stripper-cumpleanos-barcelona-producto',
    );

    foreach ($slugs as $slug) {
        add_rewrite_rule(
            '^' . preg_quote($prefix) . '/' . preg_quote($slug) . '/?$',
            'index.php?product=' . $slug,
            'top'
        );
        add_rewrite_rule(
            '^' . preg_quote($prefix) . '/' . preg_quote($slug) . '/page/?([0-9]+)/?$',
            'index.php?product=' . $slug . '&paged=$matches[1]',
            'top'
        );
    }

    // Category page rule - map clean URL to WC category
    add_rewrite_rule(
        '^' . preg_quote($prefix) . '/?$',
        'index.php?product_cat=' . $prefix,
        'top'
    );
    add_rewrite_rule(
        '^' . preg_quote($prefix) . '/page/?([0-9]+)/?$',
        'index.php?product_cat=' . $prefix . '&paged=$matches[1]',
        'top'
    );
}

// Add explicit page rules for Barcelona cluster and landing pages
add_action('init', 'bcn_add_page_rules', 5);
function bcn_add_page_rules() {
    $page_map = array(
        'stripper-barcelona'                    => 67406,
        'stripper-despedidas-soltera-barcelona'  => 67991,
        'stripper-a-domicilio-barcelona'         => 67992,
        'stripper-cumpleanos-barcelona'          => 67993,
        'stripper-fiestas-privadas-barcelona'    => 67994,
        'stripper-masculino-barcelona'           => 67995,
    );

    foreach ($page_map as $slug => $id) {
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

// Remove WooCommerce catch-all product_cat rules that break page URLs
add_filter('option_rewrite_rules', 'bcn_filter_rewrite_rules');
function bcn_filter_rewrite_rules($rules) {
    if (!is_array($rules)) return $rules;
    $problematic = array('(.+?)/?$', '^(.+?)/?$');
    foreach ($problematic as $pattern) {
        if (isset($rules[$pattern]) && strpos($rules[$pattern], 'product_cat') !== false) {
            unset($rules[$pattern]);
        }
    }
    return $rules;
}
