<?php
/**
 * ASSIGN_IMAGES_LOCALITY.PHP
 * Registra las imágenes BCN en la biblioteca de medios de WordPress con
 * metadatos SEO completos (ALT, título, descripción, leyenda) y las asigna
 * como imagen destacada a cada producto de localidad.
 *
 * Ejecutar: php /tmp/assign_images_locality.php
 */

// ── Bootstrap WordPress ──────────────────────────────────────────────────────
define('ABSPATH_CUSTOM', '/var/www/vhosts/espectaculosluxury.com/httpdocs/');
if (!defined('ABSPATH')) {
    define('ABSPATH', ABSPATH_CUSTOM);
}
require_once ABSPATH_CUSTOM . 'wp-load.php';
require_once ABSPATH_CUSTOM . 'wp-admin/includes/image.php';
require_once ABSPATH_CUSTOM . 'wp-admin/includes/file.php';
require_once ABSPATH_CUSTOM . 'wp-admin/includes/media.php';

// ── Suppress non-critical errors ─────────────────────────────────────────────
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);

// ── Base URL for images ───────────────────────────────────────────────────────
$IMG_BASE = 'https://espectaculosluxury.com/wp-content/uploads/2026/03/';
$IMG_LOCAL = '/var/www/vhosts/espectaculosluxury.com/httpdocs/wp-content/uploads/2026/03/';

// ── SEO Metadata per image ────────────────────────────────────────────────────
// Each entry: filename => [title, alt, description, caption]
$images_meta = [
    'bcn-stripper-01.jpg' => [
        'title'       => 'Stripper Barcelona 2026 – Show Integral a domicilio',
        'alt'         => 'Stripper Barcelona 2026 show integral a domicilio desde 180€ Espectáculos Luxury',
        'description' => 'Artista de Espectáculos Luxury Barcelona en pose sensual con sombrero de cowboy negro, body negro, guantes de cuero y botas camperas. Show Integral disponible a domicilio en Barcelona y área metropolitana desde 180 €. Confirmación en menos de 2 horas.',
        'caption'     => 'Show Integral stripper Barcelona – desde 180 € · Disponible 24h · Confirmación en 2h',
    ],
    'bcn-stripper-02.jpg' => [
        'title'       => 'Stripper despedida de soltera Barcelona – Show sensual',
        'alt'         => 'Stripper despedida de soltera Barcelona 2026 show privado a domicilio Espectáculos Luxury',
        'description' => 'Artista profesional con look cowboy chic en blanco y negro: sombrero negro, body negro y botas camperas bordadas. Ideal para despedidas de soltera en Barcelona, Hospitalet, Badalona y toda el área metropolitana. Reserva en 2 horas.',
        'caption'     => 'Stripper despedida de soltera Barcelona 2026 · Shows VIP privados desde 180 €',
    ],
    'bcn-stripper-03.jpg' => [
        'title'       => 'Contratar stripper Barcelona – Artista VIP show privado',
        'alt'         => 'Contratar stripper Barcelona artista VIP show privado a domicilio desde 180€ 2026',
        'description' => 'Artista elegante en sesión fotográfica profesional: body negro de manga larga, sombrero de ala ancha negro, guantes de cuero largos y botas camperas. Espectáculos Luxury Barcelona: más de 15 años de experiencia y +2.000 eventos realizados.',
        'caption'     => 'Contratar stripper Barcelona – Artista VIP · +15 años experiencia · Shows desde 180 €',
    ],
    'bcn-stripper-04.jpg' => [
        'title'       => 'Show stripper domicilio Barcelona – Artista profesional 2026',
        'alt'         => 'Show stripper a domicilio Barcelona 2026 artista profesional bodysuit negro botas cowboy',
        'description' => 'Artista de Espectáculos Luxury en pose seductora de perfil, con body negro escotado, sombrero negro, guantes de cuero oscuros y botas camperas bordadas. Show a domicilio en Barcelona, Sant Cugat, Terrassa, Sabadell y toda Cataluña.',
        'caption'     => 'Show stripper domicilio Barcelona · Toda el área metropolitana · Reserva en 2h',
    ],
    'bcn-stripper-05.jpg' => [
        'title'       => 'Stripper Hospitalet de Llobregat – Show privado a domicilio',
        'alt'         => 'Stripper Hospitalet de Llobregat 2026 show privado a domicilio lencería blanca Espectáculos Luxury',
        'description' => 'Artista morena con lencería blanca tipo body sin tirantes y medias de encaje blancas, sobre fondo beige cálido. Show privado disponible en Hospitalet de Llobregat y alrededores. Espectáculos Luxury: artistas verificadas, discreción total y pago seguro.',
        'caption'     => 'Stripper Hospitalet de Llobregat · Shows desde 180 € · Discreción garantizada',
    ],
    'bcn-stripper-06.jpg' => [
        'title'       => 'Stripper Badalona – Show VIP lencería blanca',
        'alt'         => 'Stripper Badalona 2026 show VIP a domicilio lencería blanca medias encaje Espectáculos Luxury',
        'description' => 'Artista profesional en body blanco strapless y medias de encaje blancas, posando de lado con curvas pronunciadas sobre fondo beige. Disponible para shows en Badalona, Santa Coloma de Gramenet y área norte de Barcelona. Confirmación en menos de 2 horas.',
        'caption'     => 'Stripper Badalona 2026 · Shows VIP privados · Confirmación en 2h',
    ],
    'bcn-stripper-07.jpg' => [
        'title'       => 'Stripper Cornellà de Llobregat – Camarera sexy show erótico',
        'alt'         => 'Stripper Cornellà de Llobregat 2026 camarera sexy show erótico lencería blanca a domicilio',
        'description' => 'Artista morena recostada en el suelo, con body blanco cut-out, medias de encaje blancas y tacones blancos de aguja, sobre fondo beige rosado. Servicio de camarera sexy y show integral disponible en Cornellà de Llobregat y localidades del Baix Llobregat.',
        'caption'     => 'Stripper Cornellà de Llobregat · Camarera sexy + show desde 380 € pack completo',
    ],
    'bcn-stripper-08.jpg' => [
        'title'       => 'Stripper Mataró – Show sensual ropa interior roja',
        'alt'         => 'Stripper Mataró 2026 show sensual lencería roja transparente show privado a domicilio',
        'description' => 'Artista morena con cuerpo escultural posando con lencería tipo corsé rojo transparente de encaje y motivos florales, con decoración de corazón rosa y flechas de Cupido al fondo. Show de alta calidad disponible en Mataró y Maresme. Verificada y con referencias.',
        'caption'     => 'Stripper Mataró 2026 · Shows desde 180 € · Artistas verificadas Espectáculos Luxury',
    ],
    'bcn-stripper-09.jpg' => [
        'title'       => 'Stripper Santa Coloma de Gramenet – Show sensual lencería roja',
        'alt'         => 'Stripper Santa Coloma de Gramenet 2026 show lencería roja minivestido transparente a domicilio',
        'description' => 'Artista de Espectáculos Luxury en minivestido transparente rojo con sujetador incorporado de flores en relieve, posando frente a decorado de corazones y flechas rosas. Disponible para shows privados en Santa Coloma de Gramenet, Badalona y norte de Barcelona.',
        'caption'     => 'Stripper Santa Coloma de Gramenet · Shows VIP · Pago seguro · Discreción total',
    ],
    'bcn-stripper-10.jpg' => [
        'title'       => 'Stripper a domicilio Barcelona – Show integral estilo rocker',
        'alt'         => 'Stripper a domicilio Barcelona 2026 show integral chaqueta cuero medias rejilla botas charol',
        'description' => 'Artista de Espectáculos Luxury Barcelona en look rocker elegante: chaqueta de cuero negro, gafas de sol, medias de rejilla con motivos florales y botas de charol negro hasta el muslo. Show a domicilio en Barcelona capital, despedidas y fiestas privadas.',
        'caption'     => 'Stripper a domicilio Barcelona 2026 · Estilo rocker premium · Shows desde 180 €',
    ],
    'bcn-stripper-11.jpg' => [
        'title'       => 'Stripper Sabadell – Show privado artista profesional',
        'alt'         => 'Stripper Sabadell 2026 show privado a domicilio artista chaqueta cuero botas charol muslo',
        'description' => 'Artista de perfil en pose dinámica con chaqueta moto de cuero negro, body negro, medias de rejilla florales y botas de charol negro hasta el muslo con plataforma. Show integral disponible en Sabadell, Terrassa y Vallès Occidental desde 180 €.',
        'caption'     => 'Stripper Sabadell 2026 · Vallès Occidental · Shows desde 180 € · Reserva en 2h',
    ],
    'bcn-stripper-12.jpg' => [
        'title'       => 'Stripper Terrassa – Artista show a domicilio despedidas',
        'alt'         => 'Stripper Terrassa 2026 artista show a domicilio despedidas chaqueta cuero medias rejilla',
        'description' => 'Artista morena en pose felina a cuatro patas, con chaqueta de cuero negro, medias de rejilla con flores, botas de charol negro y pendientes de aro grandes. Show a domicilio en Terrassa, Sabadell y toda la comarca del Vallès para despedidas y fiestas privadas.',
        'caption'     => 'Stripper Terrassa 2026 · Shows VIP para despedidas · Artistas verificadas',
    ],
    'bcn-stripper-13.jpg' => [
        'title'       => 'Stripper Sant Cugat del Vallès – Show VIP privado',
        'alt'         => 'Stripper Sant Cugat del Vallès 2026 show VIP privado a domicilio artista profesional',
        'description' => 'Artista de Espectáculos Luxury en pose sensual de pie, con chaqueta moto de cuero negro, medias de rejilla de lujo con motivos florales y botas de charol hasta el muslo. Disponible para shows privados en Sant Cugat del Vallès, Rubí y Valldoreix.',
        'caption'     => 'Stripper Sant Cugat del Vallès · Shows VIP desde 180 € · Discreción absoluta',
    ],
    'bcn-stripper-14.jpg' => [
        'title'       => 'Stripper Sitges – Show VIP lencería turquesa animal print',
        'alt'         => 'Stripper Sitges 2026 show VIP lencería turquesa animal print liguero medias encaje',
        'description' => 'Artista rubia atlética con lencería de conjunto turquesa con estampado de piel de serpiente: sujetador push-up, braguita, liguero dorado y medias de encaje turquesa. Accesorios dorados: collar choker, pulseras y anillos. Show VIP disponible en Sitges, Garraf y costa del Garraf para despedidas y eventos de lujo.',
        'caption'     => 'Stripper Sitges 2026 · Shows VIP costa Garraf · Lujosas artistas desde 180 €',
    ],
    'bcn-stripper-15.jpg' => [
        'title'       => 'Stripper Castelldefels – Show de lujo despedidas y fiestas VIP',
        'alt'         => 'Stripper Castelldefels 2026 show lujo despedidas fiestas VIP lencería turquesa liguero',
        'description' => 'Artista rubia con pelo recogido en moño alto, ojos claros y lencería turquesa con estampado serpiente: bralette, braguita con liguero dorado y medias de encaje azul. Show exclusivo disponible en Castelldefels, Gavà, Viladecans y toda la costa del Baix Llobregat para eventos privados y despedidas de lujo.',
        'caption'     => 'Stripper Castelldefels 2026 · Costa Baix Llobregat · Shows exclusivos desde 180 €',
    ],
];

// ── Product → Image assignment ────────────────────────────────────────────────
// product_slug => [primary_image, [gallery_images...]]
$product_images = [
    // Locality products
    'stripper-hospitalet-de-llobregat-producto' => [
        'primary' => 'bcn-stripper-05.jpg',
        'gallery' => ['bcn-stripper-06.jpg', 'bcn-stripper-07.jpg'],
    ],
    'stripper-badalona-producto' => [
        'primary' => 'bcn-stripper-06.jpg',
        'gallery' => ['bcn-stripper-05.jpg', 'bcn-stripper-08.jpg'],
    ],
    'stripper-cornella-de-llobregat-producto' => [
        'primary' => 'bcn-stripper-07.jpg',
        'gallery' => ['bcn-stripper-05.jpg', 'bcn-stripper-10.jpg'],
    ],
    'stripper-sant-cugat-del-valles-producto' => [
        'primary' => 'bcn-stripper-13.jpg',
        'gallery' => ['bcn-stripper-11.jpg', 'bcn-stripper-12.jpg'],
    ],
    'stripper-sabadell-producto' => [
        'primary' => 'bcn-stripper-11.jpg',
        'gallery' => ['bcn-stripper-12.jpg', 'bcn-stripper-13.jpg'],
    ],
    'stripper-terrassa-producto' => [
        'primary' => 'bcn-stripper-12.jpg',
        'gallery' => ['bcn-stripper-10.jpg', 'bcn-stripper-11.jpg'],
    ],
    'stripper-sitges-producto' => [
        'primary' => 'bcn-stripper-14.jpg',
        'gallery' => ['bcn-stripper-15.jpg', 'bcn-stripper-08.jpg'],
    ],
    'stripper-castelldefels-producto' => [
        'primary' => 'bcn-stripper-15.jpg',
        'gallery' => ['bcn-stripper-14.jpg', 'bcn-stripper-09.jpg'],
    ],
    'stripper-mataro-producto' => [
        'primary' => 'bcn-stripper-08.jpg',
        'gallery' => ['bcn-stripper-09.jpg', 'bcn-stripper-06.jpg'],
    ],
    'stripper-santa-coloma-de-gramenet-producto' => [
        'primary' => 'bcn-stripper-09.jpg',
        'gallery' => ['bcn-stripper-08.jpg', 'bcn-stripper-05.jpg'],
    ],
    // Main BCN products (existing ones)
    'stripper-a-domicilio-barcelona-producto' => [
        'primary' => 'bcn-stripper-10.jpg',
        'gallery' => ['bcn-stripper-11.jpg', 'bcn-stripper-01.jpg'],
    ],
    'stripper-despedida-soltera-barcelona-producto' => [
        'primary' => 'bcn-stripper-02.jpg',
        'gallery' => ['bcn-stripper-01.jpg', 'bcn-stripper-03.jpg'],
    ],
    'stripper-cumpleanos-barcelona-producto' => [
        'primary' => 'bcn-stripper-04.jpg',
        'gallery' => ['bcn-stripper-03.jpg', 'bcn-stripper-02.jpg'],
    ],
    'show-lesbico-duo-barcelona' => [
        'primary' => 'bcn-stripper-09.jpg',
        'gallery' => ['bcn-stripper-08.jpg', 'bcn-stripper-14.jpg'],
    ],
];

// ── Helper: get or create attachment ─────────────────────────────────────────
function get_or_create_attachment($filename, $meta, $img_local, $img_base) {
    global $wpdb;

    $local_file = $img_local . $filename;
    $url        = $img_base . $filename;

    if (!file_exists($local_file)) {
        echo "  ⚠️  File not found: $local_file\n";
        return 0;
    }

    // Check if already in media library
    $existing = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->posts}
         WHERE post_type = 'attachment'
         AND guid LIKE %s
         LIMIT 1",
        '%' . $filename
    ));

    if ($existing) {
        // Update existing attachment meta
        wp_update_post([
            'ID'           => $existing,
            'post_title'   => $meta['title'],
            'post_excerpt' => $meta['caption'],
            'post_content' => $meta['description'],
        ]);
        update_post_meta($existing, '_wp_attachment_image_alt', $meta['alt']);
        echo "  ✅ Updated existing attachment ID $existing: {$filename}\n";
        return (int)$existing;
    }

    // Create new attachment
    $filetype  = wp_check_filetype($local_file);
    $upload_dir = wp_upload_dir();

    // Use the 2026/03 path
    $attachment = [
        'guid'           => $img_base . $filename,
        'post_mime_type' => $filetype['type'],
        'post_title'     => $meta['title'],
        'post_excerpt'   => $meta['caption'],
        'post_content'   => $meta['description'],
        'post_status'    => 'inherit',
    ];

    $attach_id = wp_insert_attachment($attachment, $local_file);

    if (is_wp_error($attach_id)) {
        echo "  ❌ Error creating attachment for {$filename}: " . $attach_id->get_error_message() . "\n";
        return 0;
    }

    // Generate attachment metadata (thumbnails etc.)
    $attach_data = wp_generate_attachment_metadata($attach_id, $local_file);
    wp_update_attachment_metadata($attach_id, $attach_data);

    // Set ALT text
    update_post_meta($attach_id, '_wp_attachment_image_alt', $meta['alt']);

    // Update RankMath image meta if available
    if (class_exists('RankMath\Post\Images')) {
        // Just ensure alt is set — RankMath reads from _wp_attachment_image_alt
    }

    echo "  ✅ Created attachment ID $attach_id: {$filename}\n";
    return (int)$attach_id;
}

// ── Main execution ────────────────────────────────────────────────────────────
echo "\n=== ESPECTÁCULOS LUXURY — Asignación de imágenes con SEO metadata ===\n\n";

// Step 1: Register/update all images in media library
echo "── Paso 1: Registrando imágenes en la biblioteca de medios ──\n";
$attachment_map = []; // filename => attach_id

foreach ($images_meta as $filename => $meta) {
    $attach_id = get_or_create_attachment($filename, $meta, $IMG_LOCAL, $IMG_BASE);
    if ($attach_id > 0) {
        $attachment_map[$filename] = $attach_id;
    }
}

echo "\nTotal imágenes procesadas: " . count($attachment_map) . "\n\n";

// Step 2: Assign images to products
echo "── Paso 2: Asignando imágenes a productos de localidad ──\n";

foreach ($product_images as $slug => $img_config) {
    // Find product by slug
    $product = get_page_by_path($slug, OBJECT, 'product');
    if (!$product) {
        // Try direct DB lookup
        global $wpdb;
        $product_id = $wpdb->get_var($wpdb->prepare(
            "SELECT ID FROM {$wpdb->posts}
             WHERE post_name = %s AND post_type = 'product' AND post_status != 'trash'
             LIMIT 1",
            $slug
        ));
        if (!$product_id) {
            echo "  ⚠️  Producto no encontrado: $slug\n";
            continue;
        }
        $product = get_post($product_id);
    }

    $product_id = $product->ID;
    echo "\n  📦 Producto: {$product->post_title} (ID: $product_id)\n";

    // Assign primary (featured) image
    $primary_file = $img_config['primary'];
    if (isset($attachment_map[$primary_file])) {
        $attach_id = $attachment_map[$primary_file];
        set_post_thumbnail($product_id, $attach_id);
        echo "     🖼️  Featured image → {$primary_file} (ID: {$attach_id})\n";

        // Set RankMath OG image
        update_post_meta($product_id, 'rank_math_og_image_url', $IMG_BASE . $primary_file);
        update_post_meta($product_id, 'rank_math_twitter_image_url', $IMG_BASE . $primary_file);
    }

    // Assign gallery images (WooCommerce product gallery)
    $gallery_ids = [];
    if (!empty($img_config['gallery'])) {
        foreach ($img_config['gallery'] as $gfile) {
            if (isset($attachment_map[$gfile])) {
                $gallery_ids[] = $attachment_map[$gfile];
                echo "     🗂️  Gallery → {$gfile} (ID: {$attachment_map[$gfile]})\n";
            }
        }
        if (!empty($gallery_ids)) {
            update_post_meta($product_id, '_product_image_gallery', implode(',', $gallery_ids));
        }
    }

    echo "     ✅ OK\n";
}

// Step 3: Also update the main landing page (post 67406) product thumbnails
echo "\n── Paso 3: Verificando imagen destacada del landing principal (ID 67406) ──\n";
if (isset($attachment_map['bcn-stripper-01.jpg'])) {
    $current_thumb = get_post_thumbnail_id(67406);
    if (!$current_thumb) {
        set_post_thumbnail(67406, $attachment_map['bcn-stripper-01.jpg']);
        echo "  ✅ Featured image del landing → bcn-stripper-01.jpg\n";
    } else {
        echo "  ℹ️  Landing ya tiene featured image (ID: $current_thumb)\n";
    }
}

// Step 4: Output complete SEO metadata summary
echo "\n── Resumen SEO de imágenes ──\n";
echo str_pad("Archivo", 30) . str_pad("Attachment ID", 15) . "ALT\n";
echo str_repeat("─", 100) . "\n";
foreach ($images_meta as $filename => $meta) {
    $aid = isset($attachment_map[$filename]) ? $attachment_map[$filename] : 'N/A';
    echo str_pad($filename, 30) . str_pad((string)$aid, 15) . substr($meta['alt'], 0, 55) . "...\n";
}

// Step 5: Flush caches
echo "\n── Limpiando cachés ──\n";
wp_cache_flush();
if (function_exists('rocket_clean_domain')) {
    rocket_clean_domain();
    echo "  ✅ WP Rocket cache cleared\n";
}
if (function_exists('w3tc_flush_all')) {
    w3tc_flush_all();
    echo "  ✅ W3 Total Cache cleared\n";
}
// Ploi/Nginx cache via curl
@file_get_contents('http://localhost/wp-admin/admin-ajax.php?action=litespeed_purge_all');
echo "  ✅ Cache flush requested\n";

echo "\n=== ¡COMPLETADO! Imágenes asignadas con SEO metadata completo ===\n";
echo "URL de verificación: https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-hospitalet-de-llobregat-producto/\n\n";
