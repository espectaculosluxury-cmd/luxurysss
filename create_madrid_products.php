<?php
/**
 * Create WooCommerce Variable Products for Madrid Municipios
 * 8 municipios × 5 show types = 40 products + 200 variations
 */

$conn = new mysqli('localhost', 'UsrDBespLu2015', 'spol2vi0xy1go', 'DBespLu2015');
if ($conn->connect_error) { die('DB Error: ' . $conn->connect_error); }
$conn->set_charset('utf8mb4');

// =====================================================
// 1. SETUP DATA
// =====================================================

// Image IDs mapping (madrid-img-01.jpg = 67871, ..., madrid-img-21.jpg = 67891)
$img_base = 67871; // madrid-img-01 = 67871
// img-01=67871, img-02=67872, ... img-21=67891

// 8 Municipios with their data
$municipios = [
    'alcala-de-henares' => [
        'name' => 'Alcalá de Henares',
        'slug' => 'stripper-alcala-de-henares',
        'term_id' => 6044,
        'attr_name' => 'Alcalá de Henares',
        'img_main' => 67871,   // madrid-img-01
        'img_gallery' => [67872, 67873],
        'alt' => 'Stripper Alcalá de Henares — show privado despedida soltera 2026',
        'badge' => 'Shows VIP Alcalá',
        'tipo' => 'Despedida · Cumpleaños · Fiesta Privada',
        'desc_short' => 'Contrata stripper en Alcalá de Henares desde 180€. Shows integrales, dúo lésbico, camarera sexy. Artistas verificadas. Reserva en 2h.',
        'cat_id' => 2846,
    ],
    'mostoles' => [
        'name' => 'Móstoles',
        'slug' => 'stripper-mostoles',
        'term_id' => 6053,
        'attr_name' => 'Móstoles',
        'img_main' => 67874,   // madrid-img-04
        'img_gallery' => [67875, 67876],
        'alt' => 'Stripper Móstoles — show striptease despedida soltera 2026',
        'badge' => 'Shows VIP Móstoles',
        'tipo' => 'Despedida · Cumpleaños · Fiesta Privada',
        'desc_short' => 'Contrata stripper en Móstoles desde 180€. Shows integrales y packs completos. Toda la zona sur de Madrid. Reserva express.',
        'cat_id' => 2846,
    ],
    'alcorcon' => [
        'name' => 'Alcorcón',
        'slug' => 'stripper-alcorcon',
        'term_id' => 6046,
        'attr_name' => 'Alcorcón',
        'img_main' => 67877,   // madrid-img-07
        'img_gallery' => [67878, 67879],
        'alt' => 'Stripper Alcorcón — show privado fiesta 2026',
        'badge' => 'Shows VIP Alcorcón',
        'tipo' => 'Despedida · Cumpleaños · Fiesta Privada',
        'desc_short' => 'Stripper a domicilio en Alcorcón desde 180€. Shows VIP para despedidas y fiestas privadas. Artistas premium. Disponible todo el año.',
        'cat_id' => 2846,
    ],
    'leganes' => [
        'name' => 'Leganés',
        'slug' => 'stripper-leganes',
        'term_id' => 6052,
        'attr_name' => 'Leganés',
        'img_main' => 67880,   // madrid-img-10
        'img_gallery' => [67881, 67882],
        'alt' => 'Stripper Leganés — espectáculo privado cumpleaños 2026',
        'badge' => 'Shows VIP Leganés',
        'tipo' => 'Despedida · Cumpleaños · Fiesta Privada',
        'desc_short' => 'Contrata la mejor stripper en Leganés desde 180€. Packs completos para despedidas de soltera y cumpleaños. Respuesta inmediata.',
        'cat_id' => 2846,
    ],
    'getafe' => [
        'name' => 'Getafe',
        'slug' => 'stripper-getafe',
        'term_id' => 6051,
        'attr_name' => 'Getafe',
        'img_main' => 67883,   // madrid-img-13
        'img_gallery' => [67884, 67885],
        'alt' => 'Stripper Getafe — show integral fiesta privada 2026',
        'badge' => 'Shows VIP Getafe',
        'tipo' => 'Despedida · Cumpleaños · Fiesta Privada',
        'desc_short' => 'Stripper profesional en Getafe desde 180€. Shows integrales, camarera sexy y packs VIP. Sur de Madrid. Reserva por WhatsApp.',
        'cat_id' => 2846,
    ],
    'fuenlabrada' => [
        'name' => 'Fuenlabrada',
        'slug' => 'stripper-fuenlabrada',
        'term_id' => 6050,
        'attr_name' => 'Fuenlabrada',
        'img_main' => 67886,   // madrid-img-16
        'img_gallery' => [67887, 67888],
        'alt' => 'Stripper Fuenlabrada — show striptease domicilio 2026',
        'badge' => 'Shows VIP Fuenlabrada',
        'tipo' => 'Despedida · Cumpleaños · Fiesta Privada',
        'desc_short' => 'Contrata stripper en Fuenlabrada desde 180€. Shows VIP a domicilio. Despedidas de soltera y fiestas privadas. Discreción total.',
        'cat_id' => 2846,
    ],
    'alcobendas' => [
        'name' => 'Alcobendas',
        'slug' => 'stripper-alcobendas',
        'term_id' => 6045,
        'attr_name' => 'Alcobendas',
        'img_main' => 67889,   // madrid-img-19
        'img_gallery' => [67890, 67871],
        'alt' => 'Stripper Alcobendas — show privado norte Madrid 2026',
        'badge' => 'Shows VIP Alcobendas',
        'tipo' => 'Despedida · Cumpleaños · Fiesta Privada',
        'desc_short' => 'Stripper en Alcobendas desde 180€. Shows exclusivos en la zona norte de Madrid. Artistas premium para eventos corporativos y privados.',
        'cat_id' => 2846,
    ],
    'pozuelo-de-alarcon' => [
        'name' => 'Pozuelo de Alarcón',
        'slug' => 'stripper-pozuelo-de-alarcon',
        'term_id' => 6055,
        'attr_name' => 'Pozuelo de Alarcón',
        'img_main' => 67891,   // madrid-img-21
        'img_gallery' => [67872, 67873],
        'alt' => 'Stripper Pozuelo de Alarcón — show VIP chalé 2026',
        'badge' => 'Shows VIP Pozuelo',
        'tipo' => 'Despedida · Cumpleaños · Fiesta Privada',
        'desc_short' => 'Contrata stripper en Pozuelo de Alarcón desde 180€. Shows exclusivos en chalés y urbanizaciones premium. La más discreta del oeste de Madrid.',
        'cat_id' => 2846,
    ],
];

// Show types (using existing pa_tipo-show terms)
$show_types = [
    'show-integral' => ['name' => 'Show Integral', 'price' => 180, 'term_id' => 6845],
    'show-lesbico-duo' => ['name' => 'Show Lésbico Dúo', 'price' => 350, 'term_id' => 6846],
    'show-juguetes-eroticos' => ['name' => 'Show con Juguetes Eróticos', 'price' => 280, 'term_id' => 6847],
    'camarera-sexy' => ['name' => 'Camarera Sexy', 'price' => 180, 'term_id' => 6848],
    'pack-camarera-show' => ['name' => 'Pack Camarera Sexy + Show Integral', 'price' => 300, 'term_id' => 6849],
];

// =====================================================
// 2. CREATE / GET Municipio Madrid PRODUCT ATTRIBUTE
// =====================================================
echo "=== Step 1: Create pa_municipio-madrid attribute ===\n";

$attr_check = $conn->query("SELECT attribute_id FROM el_woocommerce_attribute_taxonomies WHERE attribute_name='municipio-madrid'");
if ($attr_check->num_rows === 0) {
    $conn->query("INSERT INTO el_woocommerce_attribute_taxonomies (attribute_label, attribute_name, attribute_type, attribute_orderby, attribute_public) VALUES ('Municipio Madrid', 'municipio-madrid', 'select', 'menu_order', 0)");
    $attr_id = $conn->insert_id;
    echo "Created attribute pa_municipio-madrid, ID: $attr_id\n";
} else {
    $row = $attr_check->fetch_assoc();
    $attr_id = $row['attribute_id'];
    echo "Attribute pa_municipio-madrid exists, ID: $attr_id\n";
}

// Create terms for each municipio in pa_municipio-madrid taxonomy
$term_ids_madrid = [];
foreach ($municipios as $mslug => $mdata) {
    $term_check = $conn->query("SELECT t.term_id FROM el_terms t JOIN el_term_taxonomy tt ON t.term_id=tt.term_id WHERE t.slug='" . $conn->real_escape_string($mslug) . "' AND tt.taxonomy='pa_municipio-madrid'");
    if ($term_check->num_rows > 0) {
        $row = $term_check->fetch_assoc();
        $term_ids_madrid[$mslug] = $row['term_id'];
        echo "Term exists: {$mdata['name']} (ID: {$term_ids_madrid[$mslug]})\n";
    } else {
        $conn->query("INSERT INTO el_terms (name, slug, term_group) VALUES ('" . $conn->real_escape_string($mdata['name']) . "', '" . $conn->real_escape_string($mslug) . "', 0)");
        $new_term_id = $conn->insert_id;
        $conn->query("INSERT INTO el_term_taxonomy (term_id, taxonomy, description, parent, count) VALUES ($new_term_id, 'pa_municipio-madrid', '', 0, 0)");
        $term_ids_madrid[$mslug] = $new_term_id;
        echo "Created term: {$mdata['name']} (ID: $new_term_id)\n";
    }
}

// =====================================================
// 3. CREATE PRODUCTS
// =====================================================
echo "\n=== Step 2: Create 8 variable products ===\n";

$created_products = [];

foreach ($municipios as $mslug => $mdata) {
    $title = "Stripper en {$mdata['name']} 2026 | Shows VIP desde 180€";
    $now = date('Y-m-d H:i:s');
    
    // Build product content (~14000 chars editorial template)
    $content = build_product_content($mdata, $show_types, $conn);
    
    // Check if product already exists
    $existing = $conn->query("SELECT ID FROM el_posts WHERE post_name='" . $conn->real_escape_string($mdata['slug']) . "' AND post_type='product'");
    
    if ($existing->num_rows > 0) {
        $row = $existing->fetch_assoc();
        $product_id = $row['ID'];
        echo "Product exists: {$mdata['name']} (ID: $product_id) - Updating...\n";
        $stmt = $conn->prepare("UPDATE el_posts SET post_content=?, post_title=?, post_status='publish', post_modified=?, post_modified_gmt=? WHERE ID=?");
        $stmt->bind_param('ssssi', $content, $title, $now, $now, $product_id);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("INSERT INTO el_posts (post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_name, post_type, post_modified, post_modified_gmt, to_ping, pinged, post_content_filtered) VALUES (1, ?, ?, ?, ?, ?, 'publish', 'closed', 'closed', ?, 'product', ?, ?, '', '', '')");
        $excerpt = $mdata['desc_short'];
        $slug = $mdata['slug'];
        $stmt->bind_param('ssssssss', $now, $now, $content, $title, $excerpt, $slug, $now, $now);
        $stmt->execute();
        $product_id = $conn->insert_id;
        echo "Created product: {$mdata['name']} (ID: $product_id)\n";
    }
    
    $created_products[$mslug] = $product_id;
    
    // Set product meta
    set_product_meta($conn, $product_id, $mdata, $show_types, $mslug, $term_ids_madrid[$mslug]);
    
    // Assign to categories
    $conn->query("DELETE FROM el_term_relationships WHERE object_id=$product_id");
    
    // Assign to product category (Madrid)
    $conn->query("INSERT IGNORE INTO el_term_relationships (object_id, term_taxonomy_id) SELECT $product_id, tt.term_taxonomy_id FROM el_term_taxonomy tt WHERE tt.taxonomy='product_cat' AND tt.term_id={$mdata['cat_id']}");
    
    // Assign to pa_tipo-show attribute terms (all 5)
    foreach ($show_types as $st_slug => $st_data) {
        $tt_check = $conn->query("SELECT term_taxonomy_id FROM el_term_taxonomy WHERE term_id={$st_data['term_id']} AND taxonomy='pa_tipo-show'");
        if ($tt_check->num_rows > 0) {
            $tt_row = $tt_check->fetch_assoc();
            $conn->query("INSERT IGNORE INTO el_term_relationships (object_id, term_taxonomy_id) VALUES ($product_id, {$tt_row['term_taxonomy_id']})");
        }
    }
    
    // Assign to pa_municipio-madrid term
    $mu_tt = $conn->query("SELECT term_taxonomy_id FROM el_term_taxonomy WHERE term_id={$term_ids_madrid[$mslug]} AND taxonomy='pa_municipio-madrid'");
    if ($mu_tt->num_rows > 0) {
        $mu_row = $mu_tt->fetch_assoc();
        $conn->query("INSERT IGNORE INTO el_term_relationships (object_id, term_taxonomy_id) VALUES ($product_id, {$mu_row['term_taxonomy_id']})");
    }
    
    // Assign to pa_comunidad-de-madrid term (Madrid Capital = 6059 or specific municipio term)
    $cm_tt = $conn->query("SELECT term_taxonomy_id FROM el_term_taxonomy WHERE term_id={$mdata['term_id']} AND taxonomy='pa_comunidad-de-madrid'");
    if ($cm_tt->num_rows > 0) {
        $cm_row = $cm_tt->fetch_assoc();
        $conn->query("INSERT IGNORE INTO el_term_relationships (object_id, term_taxonomy_id) VALUES ($product_id, {$cm_row['term_taxonomy_id']})");
    }
    
    // Assign product_type = variable
    $type_tt = $conn->query("SELECT tt.term_taxonomy_id FROM el_term_taxonomy tt JOIN el_terms t ON tt.term_id=t.term_id WHERE t.slug='variable' AND tt.taxonomy='product_type'");
    if ($type_tt->num_rows > 0) {
        $type_row = $type_tt->fetch_assoc();
        $conn->query("INSERT IGNORE INTO el_term_relationships (object_id, term_taxonomy_id) VALUES ($product_id, {$type_row['term_taxonomy_id']})");
    }
    
    // =====================================================
    // 4. CREATE VARIATIONS
    // =====================================================
    echo "  Creating variations for {$mdata['name']}...\n";
    $var_num = 0;
    foreach ($show_types as $st_slug => $st_data) {
        $var_title = "$title - {$st_data['name']}";
        
        // Check if variation exists
        $var_existing = $conn->query("SELECT ID FROM el_posts WHERE post_parent=$product_id AND post_type='product_variation' AND post_title='" . $conn->real_escape_string($var_title) . "'");
        
        if ($var_existing->num_rows > 0) {
            $var_row = $var_existing->fetch_assoc();
            $var_id = $var_row['ID'];
            echo "    Variation exists: {$st_data['name']} (ID: $var_id)\n";
        } else {
            $var_slug = $mdata['slug'] . '-' . $st_slug;
            $stmt = $conn->prepare("INSERT INTO el_posts (post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_name, post_type, post_parent, post_modified, post_modified_gmt, to_ping, pinged, post_content_filtered) VALUES (1, ?, ?, '', ?, ?, 'publish', 'closed', 'closed', ?, 'product_variation', ?, ?, ?, '', '', '')");
            $stmt->bind_param('ssssssss', $now, $now, $var_title, $mdata['desc_short'], $var_slug, $product_id, $now, $now);
            $stmt->execute();
            $var_id = $conn->insert_id;
            echo "    Created variation: {$st_data['name']} (ID: $var_id)\n";
        }
        
        // Set variation meta
        $conn->query("DELETE FROM el_postmeta WHERE post_id=$var_id AND meta_key IN ('_price','_regular_price','_sale_price','_stock_status','_manage_stock','attribute_pa_tipo-show','_sku','_thumbnail_id','_downloadable','_virtual','_weight','_length','_width','_height')");
        
        $price = $st_data['price'];
        $sku = $mdata['slug'] . '-' . $st_slug . '-' . date('Y');
        
        $metas = [
            '_price' => $price,
            '_regular_price' => $price,
            '_stock_status' => 'instock',
            '_manage_stock' => 'no',
            '_downloadable' => 'no',
            '_virtual' => 'no',
            'attribute_pa_tipo-show' => $st_slug,
            '_sku' => $sku,
        ];
        
        // Add thumbnail to first variation
        if ($var_num === 0) {
            $metas['_thumbnail_id'] = $mdata['img_main'];
        }
        
        foreach ($metas as $mk => $mv) {
            $stmt = $conn->prepare("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES (?, ?, ?)");
            $stmt->bind_param('iss', $var_id, $mk, $mv);
            $stmt->execute();
        }
        $var_num++;
    }
    
    echo "  ✓ {$mdata['name']}: product ID=$product_id, 5 variations created\n";
}

// =====================================================
// 5. SET RANKMATH FOR ALL PRODUCTS
// =====================================================
echo "\n=== Step 3: Set RankMath SEO meta ===\n";

foreach ($municipios as $mslug => $mdata) {
    $pid = $created_products[$mslug];
    $rm_title = "Stripper en {$mdata['name']} 2026 | Shows VIP desde 180€ — Espectáculos Luxury";
    $rm_desc = $mdata['desc_short'];
    $rm_kw = "stripper {$mdata['name']},contratar stripper {$mdata['name']},show privado {$mdata['name']},stripper {$mdata['name']} 2026";
    
    $conn->query("DELETE FROM el_postmeta WHERE post_id=$pid AND meta_key IN ('rank_math_title','rank_math_description','rank_math_focus_keyword','rank_math_robots')");
    $conn->query("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES ($pid,'rank_math_title','" . $conn->real_escape_string($rm_title) . "')");
    $conn->query("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES ($pid,'rank_math_description','" . $conn->real_escape_string($rm_desc) . "')");
    $conn->query("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES ($pid,'rank_math_focus_keyword','" . $conn->real_escape_string($rm_kw) . "')");
    $conn->query("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES ($pid,'rank_math_robots','a:1:{i:0;s:5:\"index\";}')");
    
    echo "  SEO set for: {$mdata['name']} (ID: $pid)\n";
}

echo "\n=== SUMMARY ===\n";
foreach ($created_products as $mslug => $pid) {
    $mdata = $municipios[$mslug];
    echo "Product ID $pid: Stripper en {$mdata['name']} → /product/{$mdata['slug']}/\n";
}
echo "\nDone! Total products: " . count($created_products) . "\n";

// =====================================================
// HELPER FUNCTIONS
// =====================================================

function set_product_meta($conn, $product_id, $mdata, $show_types, $mslug, $munic_term_id) {
    $conn->query("DELETE FROM el_postmeta WHERE post_id=$product_id");
    
    // Build _product_attributes serialized value
    $attr_val = serialize([
        'pa_tipo-show' => [
            'name' => 'pa_tipo-show',
            'value' => '',
            'position' => 0,
            'is_visible' => 1,
            'is_variation' => 1,
            'is_taxonomy' => 1,
        ],
        'pa_municipio-madrid' => [
            'name' => 'pa_municipio-madrid',
            'value' => '',
            'position' => 1,
            'is_visible' => 1,
            'is_variation' => 0,
            'is_taxonomy' => 1,
        ],
    ]);
    
    // Gallery string
    $gallery = implode(',', $mdata['img_gallery']);
    
    $metas = [
        '_price' => 180,
        '_regular_price' => 180,
        '_min_variation_price' => 180,
        '_max_variation_price' => 350,
        '_min_variation_regular_price' => 180,
        '_max_variation_regular_price' => 350,
        '_stock_status' => 'instock',
        '_manage_stock' => 'no',
        '_downloadable' => 'no',
        '_virtual' => 'no',
        '_visibility' => 'visible',
        '_thumbnail_id' => $mdata['img_main'],
        '_product_image_gallery' => $gallery,
        '_product_attributes' => $attr_val,
        '_lux_badge' => $mdata['badge'],
        '_lux_tipo' => $mdata['tipo'],
    ];
    
    foreach ($metas as $mk => $mv) {
        $stmt = $conn->prepare("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $product_id, $mk, $mv);
        $stmt->execute();
    }
}

function build_product_content($mdata, $show_types, $conn) {
    $name = $mdata['name'];
    $slug = $mdata['slug'];
    $img = "https://espectaculosluxury.com/wp-content/uploads/2026/03/madrid-img-" . str_pad($mdata['img_main'] - 67870, 2, '0', STR_PAD_LEFT) . ".jpg";
    
    return <<<HTML
<!-- PRODUCT {$name} – GOLD MINIMAL PRO -->
<div class="lux-landing-css" id="lux-product-{$slug}">
<style>
:root{--lux-gold:#c8a96e;--lux-dark:#111;--lux-light:#f9f6f0}
.lx-section{max-width:980px;margin:0 auto;padding:30px 20px}
.lx-section h2{font-size:clamp(1.3rem,2.8vw,1.8rem);font-weight:800;color:var(--lux-dark);margin:30px 0 14px;padding-bottom:8px;border-bottom:3px solid var(--lux-gold)}
.lx-intro{font-size:1.02rem;line-height:1.78;color:#333;margin-bottom:24px}
.lx-checklist{list-style:none;padding:0;margin:0 0 24px;display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:9px}
.lx-checklist li{display:flex;align-items:flex-start;gap:9px;background:#fffdf7;border:1px solid #f0e6cc;border-radius:9px;padding:9px 13px;font-size:.92rem;color:#333}
.lx-checklist li::before{content:'✓';color:var(--lux-gold);font-weight:800;flex-shrink:0}
.lx-price-table{width:100%;border-collapse:collapse;margin:20px 0;font-size:.92rem}
.lx-price-table th{background:var(--lux-dark);color:var(--lux-gold);padding:11px 14px;text-align:left;font-weight:700}
.lx-price-table td{padding:10px 14px;border-bottom:1px solid #eee}
.lx-price-table tr:nth-child(even) td{background:#fdf9f2}
.lx-price-table .lx-price{font-weight:700;color:var(--lux-gold)}
.lx-faq details{border:1px solid #e8dcc8;border-radius:9px;margin-bottom:9px;overflow:hidden}
.lx-faq summary{padding:13px 16px;font-weight:700;font-size:.96rem;cursor:pointer;background:#fffdf7;list-style:none;display:flex;justify-content:space-between;align-items:center}
.lx-faq summary::after{content:'+';font-size:1.2rem;color:var(--lux-gold);font-weight:400}
.lx-faq details[open] summary::after{content:'−'}
.lx-faq details[open] summary{border-bottom:1px solid #e8dcc8}
.lx-faq__body{padding:13px 16px;font-size:.92rem;color:#444;line-height:1.65}
.lx-testimonials{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;margin:24px 0}
.lx-testi{background:#fffdf7;border:1px solid #e8dcc8;border-radius:12px;padding:18px;position:relative}
.lx-testi::before{content:'"';font-size:3rem;color:var(--lux-gold);opacity:.3;position:absolute;top:8px;left:14px;line-height:1}
.lx-testi__text{font-size:.92rem;color:#444;line-height:1.6;margin:0 0 12px;padding-top:16px}
.lx-testi__author{font-size:.82rem;font-weight:700;color:var(--lux-gold)}
.lx-stars{color:#f5c518;font-size:.85rem;margin-bottom:6px}
.lx-why-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin:20px 0}
.lx-why-item{background:#fffdf7;border:1px solid #e8dcc8;border-radius:12px;padding:18px 15px;text-align:center}
.lx-why-item__icon{font-size:1.8rem;margin-bottom:8px}
.lx-why-item h3{font-size:.95rem;font-weight:700;color:var(--lux-dark);margin:0 0 6px}
.lx-why-item p{font-size:.85rem;color:#555;margin:0;line-height:1.5}
.lx-cta-box{background:linear-gradient(135deg,#0a0a0a,#1a1208);color:#fff;text-align:center;padding:40px 20px;border-radius:16px;margin:30px 0}
.lx-cta-box h3{font-size:1.4rem;font-weight:800;margin:0 0 12px}
.lx-cta-box p{font-size:.98rem;opacity:.85;margin-bottom:20px}
.lx-cta-box a{display:inline-flex;align-items:center;gap:9px;background:var(--lux-gold);color:#000;font-weight:700;padding:13px 30px;border-radius:40px;text-decoration:none;font-size:.98rem}
</style>

<div class="lx-section">

<h2>Stripper en {$name} — Show Privado VIP para Despedidas y Fiestas 2026</h2>
<div class="lx-intro">
<p>¿Buscas contratar una <strong>stripper en {$name}</strong> para tu despedida de soltera, cumpleaños o fiesta privada? En <strong>Espectáculos Luxury</strong> somos la agencia de referencia para organizar shows de striptease en {$name} y toda la Comunidad de Madrid. Con más de 10 años de experiencia y más de 3.000 eventos realizados, garantizamos un espectáculo de máxima calidad y discreción total.</p>
<p>Nuestros shows en {$name} se realizan <strong>a domicilio</strong>, en hoteles, apartamentos, villas y locales alquilados. Disponemos de strippers femeninas y masculinas, camareras sexy, dúos lésbicos y packs completos para hacer de tu celebración una experiencia única e inolvidable. Precios claros desde <strong>180 €</strong>, sin extras ocultos, con reserva confirmada por WhatsApp en menos de 2 horas.</p>
</div>

<h2>¿Qué Incluye el Show de Stripper en {$name}?</h2>
<ul class="lx-checklist">
<li>Artista profesional seleccionada para tu evento específico</li>
<li>Coreografía temática personalizable (policía, enfermera, novia, etc.)</li>
<li>Show completo de 30 a 60 minutos según el tipo contratado</li>
<li>Disfraces, accesorios y equipo de sonido incluidos</li>
<li>Posibilidad de juegos e interacción con los invitados</li>
<li>Desplazamiento a {$name} incluido en el precio</li>
<li>Foto y perfil de la artista previo a la reserva</li>
<li>Gestión completa por WhatsApp: rápida y discreta</li>
<li>Confirmación de reserva inmediata con anticipo seguro</li>
<li>Asistencia 24/7 el día del evento</li>
<li>Posibilidad de bis y show ampliado bajo contrato</li>
<li>Factura oficial disponible para empresas</li>
</ul>

<h2>Zonas y Destinos en {$name} y Alrededores</h2>
<div class="lx-intro">
<p>Nuestros shows llegan a todos los barrios, urbanizaciones y municipios cercanos a {$name}. Cubrimos domicilios, hoteles, apartamentos turísticos, locales alquilados, villas y chalés en toda el área metropolitana de Madrid. Consulta disponibilidad para tu zona específica.</p>
</div>

<h2>Tipos de Espacios donde Actuamos en {$name}</h2>
<div class="lx-intro">
<ul style="margin-left:20px;line-height:2">
<li><strong>Domicilios particulares</strong> — pisos y chalés en cualquier barrio de {$name}</li>
<li><strong>Apartamentos y Airbnb</strong> — perfecto para grupos y visitantes</li>
<li><strong>Hoteles y suites</strong> — máxima discreción en celebraciones VIP</li>
<li><strong>Locales alquilados</strong> — salas privadas y espacios de eventos</li>
<li><strong>Villas y chalés de lujo</strong> — en urbanizaciones del extrarradio</li>
</ul>
</div>

<h2>Tabla Comparativa de Precios — Shows en {$name} 2026</h2>
<table class="lx-price-table">
<thead><tr><th>Tipo de Show</th><th>Duración</th><th>Precio</th><th>Mejor Para</th></tr></thead>
<tbody>
<tr><td>Show Integral</td><td>30-45 min</td><td class="lx-price">desde 180 €</td><td>Todo tipo de fiestas</td></tr>
<tr><td>Show Lésbico Dúo</td><td>45-60 min</td><td class="lx-price">desde 350 €</td><td>Grupos grandes, premium</td></tr>
<tr><td>Show con Juguetes Eróticos</td><td>30-45 min</td><td class="lx-price">desde 280 €</td><td>Despedidas mixtas</td></tr>
<tr><td>Camarera Sexy</td><td>Por horas</td><td class="lx-price">180 €/hora</td><td>Eventos largos</td></tr>
<tr><td>Pack Camarera + Integral</td><td>2-3 h</td><td class="lx-price">desde 300 €</td><td>Experiencia completa</td></tr>
<tr><td>Stripper Masculino (Boys)</td><td>30-45 min</td><td class="lx-price">desde 180 €</td><td>Fiestas de chicas</td></tr>
</tbody>
</table>

<h2>Testimonios de Clientes en {$name}</h2>
<div class="lx-testimonials">
<div class="lx-testi">
<div class="lx-stars">★★★★★</div>
<p class="lx-testi__text">Increíble experiencia. La chica fue súper profesional y el show superó todas nuestras expectativas. ¡Repetiremos!</p>
<span class="lx-testi__author">— Laura M., despedida de soltera en {$name}</span>
</div>
<div class="lx-testi">
<div class="lx-stars">★★★★★</div>
<p class="lx-testi__text">Organicé el cumpleaños de mi marido con el pack camarera + integral y fue espectacular. Todo muy discreto y profesional.</p>
<span class="lx-testi__author">— Ana C., cumpleaños en {$name}</span>
</div>
<div class="lx-testi">
<div class="lx-stars">★★★★★</div>
<p class="lx-testi__text">Respuesta rapidísima por WhatsApp, precio cerrado desde el principio y el show fue 10/10. Los recomiendo sin duda.</p>
<span class="lx-testi__author">— Carlos R., fiesta privada {$name}</span>
</div>
</div>

<h2>¿Por Qué Elegirnos para tu Show en {$name}?</h2>
<div class="lx-why-grid">
<div class="lx-why-item"><div class="lx-why-item__icon">🔒</div><h3>Discreción Total</h3><p>Confidencialidad garantizada. Tus datos nunca se comparten.</p></div>
<div class="lx-why-item"><div class="lx-why-item__icon">⭐</div><h3>+3.000 Shows</h3><p>La agencia con más experiencia en Madrid. Resultados reales.</p></div>
<div class="lx-why-item"><div class="lx-why-item__icon">💰</div><h3>Precio Fijo</h3><p>Presupuesto cerrado desde el primer contacto. Sin sorpresas.</p></div>
<div class="lx-why-item"><div class="lx-why-item__icon">📱</div><h3>Gestión Rápida</h3><p>Reserva confirmada en menos de 2 horas por WhatsApp.</p></div>
</div>

<h2>Preguntas Frecuentes — Stripper en {$name}</h2>
<div class="lx-faq">
<details><summary>¿Cuánto cuesta contratar una stripper en {$name}?</summary>
<div class="lx-faq__body">El precio de una stripper en {$name} comienza desde 180 € para un show integral básico. El pack más popular (camarera sexy + show integral) tiene un precio desde 300 €. El dúo lésbico comienza desde 350 €. Los precios son fijos, sin extras ocultos, e incluyen desplazamiento a {$name}.</div></details>
<details><summary>¿Con cuánta antelación debo reservar en {$name}?</summary>
<div class="lx-faq__body">Recomendamos reservar con 48-72 horas de antelación para garantizar disponibilidad. Para fines de semana, lo ideal es reservar con 5-7 días. También gestionamos peticiones urgentes en menos de 24 horas sujeto a disponibilidad.</div></details>
<details><summary>¿El desplazamiento a {$name} está incluido?</summary>
<div class="lx-faq__body">Sí, el desplazamiento a {$name} está incluido en el precio. Para municipios a más de 30 km del centro de Madrid puede aplicarse un pequeño suplemento de transporte indicado en el presupuesto.</div></details>
<details><summary>¿Puedo ver la artista antes de confirmar la reserva?</summary>
<div class="lx-faq__body">Sí. Compartimos el porfolio fotográfico de las artistas disponibles de forma confidencial por WhatsApp. Las fotos son verificadas y corresponden a las artistas reales.</div></details>
<details><summary>¿Los shows son legales en {$name}?</summary>
<div class="lx-faq__body">Absolutamente. Los espectáculos de striptease para adultos en espacios privados son completamente legales en España. Espectáculos Luxury opera con total transparencia, emite facturas y cumple con toda la normativa vigente.</div></details>
<details><summary>¿Hacéis shows para grupos pequeños en {$name}?</summary>
<div class="lx-faq__body">Sí, actuamos para grupos de cualquier tamaño en {$name}, desde 5 personas en celebraciones íntimas hasta grupos de 50+ en grandes fiestas. Para grupos grandes puede recomendarse contratar más de una artista.</div></details>
<details><summary>¿Qué tipos de shows están disponibles en {$name}?</summary>
<div class="lx-faq__body">En {$name} disponemos de: Show Integral (desde 180€), Show Lésbico Dúo (desde 350€), Show con Juguetes Eróticos (desde 280€), Camarera Sexy (180€/hora), Pack Camarera + Integral (desde 300€) y Stripper Masculino Boys (desde 180€).</div></details>
<details><summary>¿Cómo puedo reservar un stripper en {$name}?</summary>
<div class="lx-faq__body">El proceso es muy sencillo: 1) Contáctanos por WhatsApp indicando la fecha, tipo de show y número de personas. 2) Te enviamos disponibilidad y presupuesto en menos de 2 horas. 3) Confirmas con un anticipo seguro. 4) Disfrutas del show sin preocupaciones. ¡Así de fácil!</div></details>
</div>

<div class="lx-cta-box">
<h3>¿Listo para Contratar tu Stripper en {$name}?</h3>
<p>Reserva ahora por WhatsApp y recibe presupuesto personalizado en menos de 2 horas.</p>
<a href="https://wa.me/34684038590?text=Hola,%20quiero%20contratar%20stripper%20en%20{$name}" target="_blank" rel="noopener">📲 Reservar por WhatsApp</a>
</div>

<!-- ENLACES INTERNOS -->
<div style="margin-top:30px;padding:20px;background:#fffdf7;border:1px solid #e8dcc8;border-radius:12px">
<h3 style="font-size:1rem;font-weight:700;color:var(--lux-dark);margin:0 0 12px">Ver también:</h3>
<ul style="list-style:none;padding:0;margin:0;display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:7px">
<li><a href="https://espectaculosluxury.com/stripper-madrid/" style="color:var(--lux-gold);text-decoration:none;font-size:.9rem">→ Stripper en Madrid — Página Principal</a></li>
<li><a href="https://espectaculosluxury.com/stripper-despedidas-madrid/" style="color:var(--lux-gold);text-decoration:none;font-size:.9rem">→ Stripper Despedidas Madrid</a></li>
<li><a href="https://espectaculosluxury.com/stripper-fiestas-privadas-madrid/" style="color:var(--lux-gold);text-decoration:none;font-size:.9rem">→ Stripper Fiestas Privadas Madrid</a></li>
<li><a href="https://espectaculosluxury.com/stripper-cumpleanos-madrid/" style="color:var(--lux-gold);text-decoration:none;font-size:.9rem">→ Stripper Cumpleaños Madrid</a></li>
</ul>
</div>

</div>
</div>
<!-- END PRODUCT {$name} -->
HTML;
}
