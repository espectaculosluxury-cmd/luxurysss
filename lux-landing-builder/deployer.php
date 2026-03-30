<?php
/**
 * ═══════════════════════════════════════════════════════════════════════════
 *  LUX LANDING BUILDER — DEPLOYER
 *  Versión: 1.0.0
 * ═══════════════════════════════════════════════════════════════════════════
 *
 * MODOS DE USO:
 * ──────────────────────────────────────────────────────────────────────────
 *  A) Desde el panel WP → Lux Builder → formulario → botón Desplegar
 *     (el admin inyecta $cfg y llama a este archivo via require)
 *
 *  B) Desde SSH / CLI:
 *     php deployer.php --config=config_provincia.json
 *
 *  C) Desde navegador (acceso directo al archivo en wp-content/plugins/):
 *     Requiere WP_CLI_RUNNING o token de seguridad en $_GET['lux_token']
 *
 * PASOS QUE EJECUTA:
 * ──────────────────────────────────────────────────────────────────────────
 *  1. Carga WordPress
 *  2. Lee configuración de la provincia
 *  3. Genera HTML de la landing y la guarda en el post WP indicado
 *  4. Actualiza/crea los 10 (o N) productos de localidad
 *  5. Asigna metadatos SEO (RankMath) a la landing y a cada producto
 *  6. Registra imágenes en la media library (si se proporcionan)
 *  7. Asigna imágenes destacadas + galerías WooCommerce
 *  8. Limpia caches (W3TC, WP Rocket, LiteSpeed)
 *  9. Imprime resumen de resultados
 * ═══════════════════════════════════════════════════════════════════════════
 */

// ── Bootstrap ────────────────────────────────────────────────────────────────

// Detectar si estamos dentro del plugin (llamado desde admin) o standalone
if ( ! defined( 'LUX_BUILDER_DIR' ) ) {
    // Modo standalone: cargar WordPress manualmente
    $wp_load = dirname(__DIR__, 3) . '/wp-load.php'; // plugins/lux-landing-builder/ → httpdocs/
    if ( ! file_exists($wp_load) ) {
        // Intentar ruta alternativa (Plesk/cPanel)
        $wp_load = '/var/www/vhosts/espectaculosluxury.com/httpdocs/wp-load.php';
    }
    if ( ! file_exists($wp_load) ) {
        die("ERROR: No se encuentra wp-load.php. Ajusta la ruta en deployer.php línea ~35.\n");
    }
    require $wp_load;
    define( 'LUX_BUILDER_DIR', plugin_dir_path(__FILE__) );
    define( 'LUX_BUILDER_STANDALONE', true );

    // Seguridad: token o CLI requerido en modo standalone
    if ( ! ( defined('WP_CLI') && WP_CLI ) && php_sapi_name() !== 'cli' ) {
        $token = get_option('lux_builder_token');
        if ( ! $token || ( $_GET['lux_token'] ?? '' ) !== $token ) {
            wp_die('Acceso denegado. Usa el panel WP o pasa ?lux_token=TOKEN_SECRETO');
        }
    }

    // Leer configuración desde JSON o CLI args
    $cfg_file = LUX_BUILDER_DIR . 'config_provincia.json';
    if ( isset($argv) ) {
        foreach ($argv as $arg) {
            if (str_starts_with($arg, '--config=')) {
                $cfg_file = substr($arg, 9);
            }
        }
    }
    if ( ! file_exists($cfg_file) ) {
        die("ERROR: No se encuentra config_provincia.json. Créalo o usa el formulario WP.\n");
    }
    $cfg = json_decode(file_get_contents($cfg_file), true);
    if ( ! $cfg ) {
        die("ERROR: config_provincia.json no es JSON válido.\n");
    }

    // Parse localities
    $localities_raw = $cfg['localities'] ?? '[]';
    $localities = is_array($localities_raw) ? $localities_raw : json_decode($localities_raw, true);
    if ( ! is_array($localities) ) {
        die("ERROR: 'localities' no es un array JSON válido.\n");
    }

    // Re-index by key for interlinks
    $localities_keyed = [];
    foreach ($localities as $l) {
        $localities_keyed[$l['key']] = $l;
    }
    $localities = $localities_keyed;
}

// ── Disable KSES + texturize ──────────────────────────────────────────────────
kses_remove_filters();
remove_filter('content_save_pre',          'wp_filter_post_kses');
remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');
remove_filter('the_content', 'wptexturize');
remove_filter('the_content', 'wpautop');
remove_filter('the_title',   'wptexturize');

global $wpdb;

$results  = [];
$errors   = [];
$log      = function($msg) use (&$results) { $results[] = $msg; echo $msg . "\n"; };
$err      = function($msg) use (&$errors)  { $errors[]  = $msg; echo "❌ ERROR: $msg\n"; };

$prov      = $cfg['prov_name'];
$prov_slug = $cfg['prov_slug'];
$cat_id    = absint($cfg['cat_id']);
$landing_id = absint($cfg['landing_id'] ?? 0);
$now       = current_time('mysql');

$log("═══════════════════════════════════════════════════════");
$log("  LUX LANDING BUILDER — Deploy: {$prov}");
$log("═══════════════════════════════════════════════════════");

// ── PASO 1: Generar HTML de la landing ───────────────────────────────────────
$log("\n[1/5] Generando HTML landing…");
ob_start();
$landing_html = require LUX_BUILDER_DIR . 'templates/landing.php';
ob_end_clean();
if ( is_string($landing_html) && strlen($landing_html) > 500 ) {
    $log("  ✅ Landing HTML generado (" . strlen($landing_html) . " chars)");
} else {
    $err("Landing HTML demasiado corto o inválido.");
}

// ── PASO 2: Guardar/crear la landing en WP ───────────────────────────────────
$log("\n[2/5] Guardando landing en WordPress…");
if ( $landing_id && get_post($landing_id) ) {
    // UPDATE existing post
    $r = $wpdb->update(
        $wpdb->posts,
        [
            'post_content'      => $landing_html,
            'post_modified'     => $now,
            'post_modified_gmt' => get_gmt_from_date($now),
        ],
        ['ID' => $landing_id],
        ['%s','%s','%s'],
        ['%d']
    );
    if ($r === false) {
        $err("DB ERROR actualizando landing ID {$landing_id}: " . $wpdb->last_error);
    } else {
        $log("  ✅ Landing actualizada — Post ID: {$landing_id}");
    }
    // Disable EZ-TOC
    update_post_meta($landing_id, '_ez-toc-disabled', 1);
    update_post_meta($landing_id, '_ez-toc-disabled-custom-toc', 1);

    // SEO meta
    $seo_title = "Stripper en {$prov} 2026 | Shows VIP desde 180€ · Espectáculos Luxury";
    $seo_desc  = "Contratar stripper en {$prov} desde 180€. Shows a domicilio para despedidas y fiestas. Artistas verificadas. Confirmación en 2h. +2.000 eventos.";
    lux_upsert_meta($wpdb, $landing_id, 'rank_math_title',       $seo_title);
    lux_upsert_meta($wpdb, $landing_id, 'rank_math_description', $seo_desc);
    $log("  ✅ SEO meta landing actualizada");
} else {
    // CREATE new page
    $new_id = wp_insert_post([
        'post_author'   => 1,
        'post_content'  => $landing_html,
        'post_title'    => "Stripper en {$prov} 2026 | Shows VIP desde 180€",
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_name'     => 'stripper-' . $prov_slug,
        'comment_status'=> 'closed',
        'ping_status'   => 'closed',
    ]);
    if (is_wp_error($new_id)) {
        $err("No se pudo crear la landing: " . $new_id->get_error_message());
    } else {
        $landing_id = $new_id;
        $cfg['landing_id'] = $landing_id;
        $log("  ✅ Landing CREADA — Post ID: {$landing_id}");
        $log("  ℹ️  URL: " . get_permalink($landing_id));
    }
}

// ── Registrar provincia en el índice global "También actuamos" ───────────────
if ( function_exists('lux_register_province') ) {
    $site_url_dep  = get_site_url();
    $landing_url_dep = $site_url_dep . '/stripper-' . $prov_slug . '/';
    lux_register_province( $prov, $prov_slug, $landing_url_dep );
    $log("  ✅ Provincia '{$prov}' registrada en índice global (lux_provinces_index)");
}

// ── Función helper upsert meta ───────────────────────────────────────────────
function lux_upsert_meta($wpdb, $post_id, $key, $value) {
    $val = is_array($value) ? serialize($value) : $value;
    $exists = $wpdb->get_var($wpdb->prepare(
        "SELECT meta_id FROM {$wpdb->postmeta} WHERE post_id=%d AND meta_key=%s", $post_id, $key
    ));
    if ($exists) {
        $wpdb->update($wpdb->postmeta, ['meta_value'=>$val], ['post_id'=>$post_id,'meta_key'=>$key]);
    } else {
        $wpdb->insert($wpdb->postmeta, ['post_id'=>$post_id,'meta_key'=>$key,'meta_value'=>$val]);
    }
}

// ── PASO 3: Crear/actualizar productos de localidad ──────────────────────────
$log("\n[3/5] Creando/actualizando productos de localidad…");

$cat_tt = $wpdb->get_var($wpdb->prepare(
    "SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE term_id=%d AND taxonomy='product_cat'", $cat_id
));
if (!$cat_tt) {
    $err("No se encontró term_taxonomy_id para cat_id={$cat_id}");
}

$simple_term = get_term_by('slug','simple','product_type');

foreach ( $localities as $loc_key => $l ) {
    $slug    = $l['slug'];
    $city    = $l['city'];
    $cs      = $l['cs'];
    $locality = $l;

    // Generate product content
    ob_start();
    $product_html = require LUX_BUILDER_DIR . 'templates/product.php';
    ob_end_clean();

    $prod_title = "Stripper en {$cs} 2026 | Shows VIP desde 180€ · Esp. Luxury";

    // Check existing
    $existing_id = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->posts} WHERE post_name=%s AND post_type='product' LIMIT 1", $slug
    ));

    if ($existing_id) {
        $wpdb->update($wpdb->posts, [
            'post_title'        => $prod_title,
            'post_content'      => $product_html,
            'post_status'       => 'publish',
            'post_modified'     => $now,
            'post_modified_gmt' => get_gmt_from_date($now),
        ], ['ID' => $existing_id]);
        $post_id = $existing_id;
        $action  = 'UPDATED';
    } else {
        $wpdb->insert($wpdb->posts, [
            'post_author'           => 1,
            'post_date'             => $now,
            'post_date_gmt'         => get_gmt_from_date($now),
            'post_content'          => $product_html,
            'post_title'            => $prod_title,
            'post_excerpt'          => '',
            'post_status'           => 'publish',
            'comment_status'        => 'closed',
            'ping_status'           => 'closed',
            'post_name'             => $slug,
            'post_modified'         => $now,
            'post_modified_gmt'     => get_gmt_from_date($now),
            'post_type'             => 'product',
            'post_content_filtered' => '',
            'to_ping'               => '',
            'pinged'                => '',
            'guid'                  => home_url('/producto/'.$slug.'/'),
        ]);
        $post_id = $wpdb->insert_id;
        $action  = 'CREATED';
    }

    if (!$post_id) { $err("Error en {$slug}: ".$wpdb->last_error); continue; }

    // Product type
    if ($simple_term) {
        $wpdb->replace("{$wpdb->prefix}term_relationships",[
            'object_id'        => $post_id,
            'term_taxonomy_id' => $simple_term->term_taxonomy_id,
            'term_order'       => 0,
        ]);
    }

    // Category
    if ($cat_tt) {
        $wpdb->replace("{$wpdb->prefix}term_relationships",[
            'object_id'        => $post_id,
            'term_taxonomy_id' => $cat_tt,
            'term_order'       => 0,
        ]);
        if ($action === 'CREATED') {
            $wpdb->query($wpdb->prepare(
                "UPDATE {$wpdb->term_taxonomy} SET count=count+1 WHERE term_taxonomy_id=%d", $cat_tt
            ));
        }
    }

    // Post meta
    $meta_map = [
        '_price'                => '180',
        '_regular_price'        => '180',
        '_visibility'           => 'visible',
        '_virtual'              => 'yes',
        '_stock_status'         => 'instock',
        '_manage_stock'         => 'no',
        'total_sales'           => '0',
        '_wc_average_rating'    => '5',
        '_wc_review_count'      => '10',
        'rank_math_title'       => "Stripper en {$cs} 2026 | Shows VIP desde 180€ · Espectáculos Luxury",
        'rank_math_description' => "Contrata stripper en {$cs} desde 180€. Shows a domicilio, despedidas y fiestas. Toda {$city}. Artistas verificadas. Confirmación en 2h. {$events} eventos.",
        'rank_math_robots'      => serialize(['index','follow']),
    ];
    foreach ($meta_map as $k => $v) {
        lux_upsert_meta($wpdb, $post_id, $k, $v);
    }

    // WC product lookup
    $wpdb->delete("{$wpdb->prefix}wc_product_meta_lookup", ['product_id'=>$post_id]);
    $wpdb->insert("{$wpdb->prefix}wc_product_meta_lookup", [
        'product_id'    => $post_id,
        'sku'           => '',
        'virtual'       => 1,
        'downloadable'  => 0,
        'min_price'     => 180,
        'max_price'     => 380,
        'onsale'        => 0,
        'stock_quantity'=> null,
        'stock_status'  => 'instock',
        'rating_count'  => 10,
        'average_rating'=> 5.0,
        'total_sales'   => 0,
        'tax_status'    => 'taxable',
        'tax_class'     => '',
    ]);

    $log("  ✅ {$action} ID:{$post_id} — {$cs} ({$slug})");
}

// ── PASO 4: Asignar imágenes ─────────────────────────────────────────────────
$log("\n[4/5] Asignando imágenes (si se proporcionan en cfg[image_map])…");
$image_map = $cfg['image_map'] ?? [];
if ( ! empty($image_map) ) {
    foreach ($image_map as $prod_slug => $imgs) {
        $prod_id = $wpdb->get_var($wpdb->prepare(
            "SELECT ID FROM {$wpdb->posts} WHERE post_name=%s AND post_type='product' LIMIT 1", $prod_slug
        ));
        if (!$prod_id) { $err("Producto no encontrado: {$prod_slug}"); continue; }

        $featured_url  = $imgs['featured'] ?? '';
        $gallery_urls  = $imgs['gallery']  ?? [];

        // Find attachment ID by GUID/URL
        if ($featured_url) {
            $att_id = lux_url_to_attachment_id($wpdb, $featured_url);
            if ($att_id) {
                lux_upsert_meta($wpdb, $prod_id, '_thumbnail_id', $att_id);
                $log("  ✅ Featured img set → {$prod_slug}: att_id={$att_id}");
            }
        }

        if ($gallery_urls) {
            $gallery_ids = [];
            foreach ($gallery_urls as $gurl) {
                $gid = lux_url_to_attachment_id($wpdb, $gurl);
                if ($gid) $gallery_ids[] = $gid;
            }
            if ($gallery_ids) {
                lux_upsert_meta($wpdb, $prod_id, '_product_image_gallery', implode(',', $gallery_ids));
                $log("  ✅ Gallery set → {$prod_slug}: " . implode(',', $gallery_ids));
            }
        }
    }
} else {
    $log("  ℹ️  Sin image_map en config — omitiendo asignación de imágenes.");
    $log("     Para asignar imágenes añade 'image_map' al JSON de configuración.");
}

function lux_url_to_attachment_id($wpdb, $url) {
    $path = str_replace(home_url('/wp-content/uploads/'), '', $url);
    return (int) $wpdb->get_var($wpdb->prepare(
        "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key='_wp_attached_file' AND meta_value=%s LIMIT 1",
        $path
    ));
}

// ── PASO 5: Limpiar caches ───────────────────────────────────────────────────
$log("\n[5/5] Limpiando caches…");
wp_cache_flush();
delete_option('rewrite_rules');
if (function_exists('w3tc_flush_all'))       { w3tc_flush_all();       $log("  ✅ W3TC flushed"); }
if (function_exists('rocket_clean_domain'))  { rocket_clean_domain();  $log("  ✅ WP Rocket flushed"); }
if (function_exists('wp_cache_clear_cache')) { wp_cache_clear_cache(); $log("  ✅ WP Super Cache flushed"); }
do_action('litespeed_purge_all');
$log("  ✅ Cache general flushed");

// ── Resumen ──────────────────────────────────────────────────────────────────
$log("\n═══════════════════════════════════════════════════════");
$log("  DESPLIEGUE COMPLETADO — {$prov}");
$log("  Landing: " . ($landing_id ? get_permalink($landing_id) : 'n/d'));
$log("  Productos: " . count($localities));
$log("  Errores: " . count($errors));
if ( function_exists('lux_get_all_provinces') ) {
    $idx = lux_get_all_provinces();
    $idx_names = implode(', ', array_column($idx, 'name'));
    $log("  Índice provincias (" . count($idx) . "): " . $idx_names);
}
$log("═══════════════════════════════════════════════════════\n");

if ( ! empty($errors) ) {
    $log("ERRORES ENCONTRADOS:");
    foreach ($errors as $e) $log("  ⚠ {$e}");
}

// Return output when called from admin
if ( defined('LUX_BUILDER_DIR') && ! defined('LUX_BUILDER_STANDALONE') ) {
    return implode("\n", $results);
}
