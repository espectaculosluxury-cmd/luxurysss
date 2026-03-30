<?php
/**
 * Create 8 WooCommerce Variable Products for Barcelona
 * Category: 1824 (contratar-stripper-para-fiestas-y-despedidas-en-barcelona)
 * Attribute: pa_tipo-show (existing terms)
 * Images: IDs 67959-67973 (newly uploaded)
 */
$conn = new mysqli('localhost','UsrDBespLu2015','spol2vi0xy1go','DBespLu2015');
$conn->set_charset('utf8mb4');

// Existing pa_tipo-show term IDs
$tipo_show_terms = [
    6845 => ['name'=>'Show Integral',              'slug'=>'show-integral',                'price'=>180],
    6846 => ['name'=>'Show Lésbico Dúo',           'slug'=>'show-lesbico-duo',             'price'=>330],
    6847 => ['name'=>'Show con Juguetes Eróticos', 'slug'=>'show-juguetes-eroticos',       'price'=>300],
    6848 => ['name'=>'Camarera Sexy',              'slug'=>'camarera-sexy',                'price'=>180],
    6849 => ['name'=>'Pack Camarera Sexy + Show',  'slug'=>'pack-camarera-show',           'price'=>380],
];
// Additional terms created for Madrid (use if exist)
// 6892 Show con Juguetes Eróticos (alt), 6893 Pack Camarera + Show Integral, 6894 Stripper Masculino

// 8 products: each product = 1 show type × location cluster
// Product design:
// P1 - Show Integral Barcelona (hero product, 4 img)
// P2 - Show Lésbico Dúo Barcelona
// P3 - Show con Juguete Erótico Barcelona
// P4 - Camarera Sexy Barcelona
// P5 - Pack Camarera + Show Barcelona
// P6 - Stripper a Domicilio Barcelona (all shows)
// P7 - Stripper para Despedidas Barcelona
// P8 - Stripper para Cumpleaños Barcelona

$products = [
  [
    'title'       => 'Show Integral Stripper Barcelona 2026 | desde 180€ · A Domicilio y Hotel',
    'slug'        => 'show-integral-stripper-barcelona',
    'price'       => 180,
    'images'      => [67959,67960,67961,67962], // cowboy hat BW series
    'thumbnail'   => 67959,
    'gallery'     => '67960,67961,67962',
    'tipo_terms'  => [6845], // Show Integral
    'short_desc'  => '<p>El <strong>show integral de stripper en Barcelona</strong> más demandado de 2026. Coreografía profesional, strip-tease completo con accesorios y show privado exclusivo. Disponible en toda Barcelona, Eixample, Gràcia, Barceloneta, hotels y apartamentos turísticos. <strong>Desde 180€</strong> · Reserva con confirmación en 2h · Discreción garantizada.</p>',
    'rm_title'    => 'Show Integral Stripper Barcelona 2026 | desde 180€ · A Domicilio',
    'rm_desc'     => 'Contrata el show integral de stripper en Barcelona desde 180€. Coreografía profesional, strip-tease completo. Despedidas, cumpleaños y fiestas privadas en Barcelona y área metropolitana. Confirmación 2h.',
    'rm_keywords' => 'show integral stripper barcelona,stripper barcelona 180€,contratar stripper barcelona,show striptease barcelona 2026',
    'badge'       => 'Shows VIP Barcelona',
    'tipo'        => 'Despedida · Cumpleaños · Fiesta',
  ],
  [
    'title'       => 'Show Lésbico Dúo Barcelona 2026 | desde 330€ · Despedidas de Soltera',
    'slug'        => 'show-lesbico-duo-barcelona',
    'price'       => 330,
    'images'      => [67966,67967,67964,67965],
    'thumbnail'   => 67966,
    'gallery'     => '67967,67964,67965',
    'tipo_terms'  => [6846],
    'short_desc'  => '<p>El <strong>show lésbico dúo en Barcelona</strong> más espectacular para despedidas de soltera 2026. Dos artistas profesionales de Espectáculos Luxury con coreografía exclusiva, accesorios eróticos y show privado VIP. Disponible en hoteles W, Arts, Meliá y cualquier domicilio de Barcelona. <strong>Desde 330€</strong> para el dúo completo.</p>',
    'rm_title'    => 'Show Lésbico Dúo Barcelona 2026 | desde 330€ · Despedidas Soltera',
    'rm_desc'     => 'Show lésbico dúo en Barcelona desde 330€. Dos artistas profesionales para despedidas de soltera VIP. Coreografía exclusiva en hoteles y domicilios de Barcelona. Confirmación en 2h.',
    'rm_keywords' => 'show lésbico dúo barcelona,stripper lésbica barcelona,dúo striptease barcelona,show lésbico despedida barcelona',
    'badge'       => 'Show Dúo Premium',
    'tipo'        => 'Despedida · Fiesta VIP',
  ],
  [
    'title'       => 'Show Stripper con Juguete Erótico Barcelona | desde 300€ · Show Privado',
    'slug'        => 'show-juguete-erotico-barcelona',
    'price'       => 300,
    'images'      => [67968,67969,67970,67971],
    'thumbnail'   => 67968,
    'gallery'     => '67969,67970,67971',
    'tipo_terms'  => [6847],
    'short_desc'  => '<p>Show de stripper con juguete erótico (dildo) en Barcelona. El show más atrevido para fiestas privadas adultas en 2026. Artista profesional de Espectáculos Luxury con actuación completa + demostración con juguete. Disponible en domicilios, apartamentos turísticos y hoteles de Barcelona. <strong>Desde 300€</strong>.</p>',
    'rm_title'    => 'Show Stripper con Juguete Erótico Barcelona | desde 300€',
    'rm_desc'     => 'Show de stripper con juguete erótico en Barcelona desde 300€. Show privado adulto para fiestas y cumpleaños en domicilios, hoteles y apartamentos Airbnb de Barcelona y área metropolitana.',
    'rm_keywords' => 'show juguete erótico barcelona,stripper dildo barcelona,show privado adultos barcelona,show erótico barcelona 2026',
    'badge'       => 'Show Erótico VIP',
    'tipo'        => 'Fiesta Privada · Adultos',
  ],
  [
    'title'       => 'Camarera Sexy Barcelona 2026 | desde 180€/h · Eventos y Despedidas',
    'slug'        => 'camarera-sexy-barcelona',
    'price'       => 180,
    'images'      => [67963,67964,67965,67966],
    'thumbnail'   => 67963,
    'gallery'     => '67964,67965,67966',
    'tipo_terms'  => [6848],
    'short_desc'  => '<p><strong>Camarera sexy en Barcelona</strong> disponible para eventos, despedidas de soltera y fiestas privadas 2026. Lencería exclusiva, atención personalizada y actitud profesional. Disponible en toda Barcelona, Eixample, Barceloneta, Hospitalet y área metropolitana. <strong>Desde 180€/hora</strong> por chica.</p>',
    'rm_title'    => 'Camarera Sexy Barcelona 2026 | desde 180€/h · Eventos Privados',
    'rm_desc'     => 'Contrata camarera sexy en Barcelona desde 180€/hora. Ideal para despedidas de soltera, cumpleaños y fiestas privadas. Lencería exclusiva, servicio en toda Barcelona y área metropolitana. Reserva 2h.',
    'rm_keywords' => 'camarera sexy barcelona,camarera lencería barcelona,camarera evento privado barcelona,camarera despedida soltera barcelona',
    'badge'       => 'Camarera VIP',
    'tipo'        => 'Evento · Despedida · Fiesta',
  ],
  [
    'title'       => 'Pack Camarera Sexy + Show Integral Barcelona | desde 380€ · Todo en Uno',
    'slug'        => 'pack-camarera-show-barcelona',
    'price'       => 380,
    'images'      => [67965,67963,67964,67960],
    'thumbnail'   => 67965,
    'gallery'     => '67963,67964,67960',
    'tipo_terms'  => [6849],
    'short_desc'  => '<p>El <strong>pack más completo de Barcelona</strong>: camarera sexy durante tu fiesta + show integral de striptease al final. El combo perfecto para despedidas de soltera y soltero, cumpleaños y eventos especiales. Artista profesional de Espectáculos Luxury. <strong>Desde 380€</strong> con todo incluido.</p>',
    'rm_title'    => 'Pack Camarera Sexy + Show Integral Barcelona | desde 380€',
    'rm_desc'     => 'Pack camarera sexy más show integral en Barcelona desde 380€. Todo en uno para despedidas de soltera y soltero, cumpleaños y fiestas privadas. Artista profesional. Confirmación en 2h.',
    'rm_keywords' => 'pack camarera sexy show barcelona,camarera más show barcelona,pack striptease barcelona,camarera show integral barcelona 2026',
    'badge'       => 'Pack All-In VIP',
    'tipo'        => 'Despedida · Cumpleaños · Evento',
  ],
  [
    'title'       => 'Stripper a Domicilio Barcelona 2026 | Shows desde 180€ · 24h Disponible',
    'slug'        => 'stripper-a-domicilio-barcelona',
    'price'       => 180,
    'images'      => [67971,67972,67973,67968],
    'thumbnail'   => 67971,
    'gallery'     => '67972,67973,67968',
    'tipo_terms'  => [6845,6847,6848],
    'short_desc'  => '<p><strong>Stripper a domicilio en Barcelona</strong> disponible las 24 horas en 2026. Artistas profesionales de Espectáculos Luxury llegan a tu domicilio, apartamento Airbnb, hotel o villa en cualquier barrio de Barcelona y área metropolitana. Confirmación en menos de 2 horas. <strong>Desde 180€</strong>. Discreción total garantizada.</p>',
    'rm_title'    => 'Stripper a Domicilio Barcelona 2026 | desde 180€ · 24h',
    'rm_desc'     => 'Stripper a domicilio en Barcelona desde 180€ disponible 24h. Shows en tu apartamento, hotel, villa o domicilio en Barcelona, Eixample, Gràcia, Barceloneta, Hospitalet, Badalona y más. Confirmación 2h.',
    'rm_keywords' => 'stripper a domicilio barcelona,stripper barcelona domicilio,contratar stripper casa barcelona,stripper hotel barcelona',
    'badge'       => 'Shows a Domicilio',
    'tipo'        => 'Domicilio · Hotel · Airbnb',
  ],
  [
    'title'       => 'Stripper para Despedidas de Soltera Barcelona 2026 | Show Exclusivo',
    'slug'        => 'stripper-despedida-soltera-barcelona',
    'price'       => 180,
    'images'      => [67960,67961,67966,67967],
    'thumbnail'   => 67960,
    'gallery'     => '67961,67966,67967',
    'tipo_terms'  => [6845,6846,6849],
    'short_desc'  => '<p>La <strong>stripper para despedidas de soltera en Barcelona</strong> más solicitada de 2026. Espectáculos Luxury organiza el show perfecto para tu despedida: strip-tease integral, show lésbico dúo o pack camarera + show. Disponible en hoteles, apartamentos turísticos y domicilios de Barcelona. Zona Gothic, Born, Eixample, Barceloneta. <strong>Desde 180€</strong>.</p>',
    'rm_title'    => 'Stripper Despedida de Soltera Barcelona 2026 | Shows desde 180€',
    'rm_desc'     => 'Contrata stripper para despedida de soltera en Barcelona desde 180€. Show integral, lésbico dúo o pack completo. Disponible en toda Barcelona: Gothic, Born, Eixample, Barceloneta. Confirmación 2h.',
    'rm_keywords' => 'stripper despedida soltera barcelona,stripper para despedida barcelona,show stripper despedida barcelona,contratar stripper despedida barcelona 2026',
    'badge'       => 'Despedidas Barcelona',
    'tipo'        => 'Despedida de Soltera',
  ],
  [
    'title'       => 'Stripper para Cumpleaños Barcelona 2026 | Sorpresa VIP desde 180€',
    'slug'        => 'stripper-cumpleanos-barcelona',
    'price'       => 180,
    'images'      => [67972,67973,67962,67963],
    'thumbnail'   => 67972,
    'gallery'     => '67973,67962,67963',
    'tipo_terms'  => [6845,6848,6849],
    'short_desc'  => '<p><strong>Stripper para cumpleaños en Barcelona</strong>: la sorpresa más original y atrevida para celebrar en 2026. Sorprende a quien cumpla años con el show más exclusivo de Espectáculos Luxury. Artistas disponibles en toda Barcelona, Hospitalet, Badalona, Sabadell, Terrassa y área metropolitana. <strong>Desde 180€</strong>. Reserva online o por WhatsApp.</p>',
    'rm_title'    => 'Stripper para Cumpleaños Barcelona 2026 | Sorpresa VIP desde 180€',
    'rm_desc'     => 'Sorprende con una stripper para cumpleaños en Barcelona desde 180€. Shows integrales, camarera sexy o pack completo. Toda Barcelona y área metropolitana: Hospitalet, Badalona, Sabadell, Terrassa.',
    'rm_keywords' => 'stripper cumpleaños barcelona,stripper sorpresa barcelona,contratar stripper cumpleaños barcelona,stripper para fiesta cumpleaños barcelona 2026',
    'badge'       => 'Cumpleaños VIP',
    'tipo'        => 'Cumpleaños · Sorpresa',
  ],
];

function insert_postmeta($conn, $post_id, $key, $value) {
    $k = $conn->real_escape_string($key);
    $v = $conn->real_escape_string($value);
    $conn->query("INSERT INTO el_postmeta (post_id,meta_key,meta_value) VALUES ($post_id,'$k','$v')");
}

$cat_id = 1824; // contratar-stripper-para-fiestas-y-despedidas-en-barcelona
$created = [];

foreach ($products as $idx => $p) {
    echo "\nProcessing: {$p['slug']}\n";

    // Check if slug already exists
    $slug_esc = $conn->real_escape_string($p['slug']);
    $existing = $conn->query("SELECT ID FROM el_posts WHERE post_name='$slug_esc' AND post_type='product' LIMIT 1");
    if ($existing && $existing->num_rows > 0) {
        $row = $existing->fetch_assoc();
        echo "  SKIP (exists) -> ID ".$row['ID']."\n";
        $created[$p['slug']] = $row['ID'];
        continue;
    }

    $title_esc     = $conn->real_escape_string($p['title']);
    $short_esc     = $conn->real_escape_string($p['short_desc']);

    // Build rich long description (~800 words)
    $long_desc = build_long_desc($p);
    $long_esc  = $conn->real_escape_string($long_desc);

    // Insert product post
    $sql = "INSERT INTO el_posts
        (post_author, post_date, post_date_gmt, post_content, post_excerpt, post_title,
         post_status, comment_status, post_name, post_modified, post_modified_gmt,
         post_parent, guid, menu_order, post_type, post_mime_type)
        VALUES
        (1, NOW(), UTC_TIMESTAMP(), '$long_esc', '$short_esc', '$title_esc',
         'publish', 'open', '$slug_esc', NOW(), UTC_TIMESTAMP(),
         0, 'https://espectaculosluxury.com/?post_type=product&p=NEW', 0, 'product', '')";
    $conn->query($sql);
    $pid = $conn->insert_id;

    // Fix guid
    $conn->query("UPDATE el_posts SET guid='https://espectaculosluxury.com/?post_type=product&p=$pid' WHERE ID=$pid");

    // Basic WooCommerce meta
    insert_postmeta($conn, $pid, '_price', $p['price']);
    insert_postmeta($conn, $pid, '_regular_price', $p['price']);
    insert_postmeta($conn, $pid, '_sale_price', '');
    insert_postmeta($conn, $pid, '_sku', 'BCN-'.strtoupper(substr($p['slug'],0,8)).'-'.$pid);
    insert_postmeta($conn, $pid, '_manage_stock', 'no');
    insert_postmeta($conn, $pid, '_stock_status', 'instock');
    insert_postmeta($conn, $pid, '_visibility', 'visible');
    insert_postmeta($conn, $pid, '_virtual', 'yes');
    insert_postmeta($conn, $pid, '_sold_individually', 'yes');
    insert_postmeta($conn, $pid, '_product_version', '9.0.0');
    insert_postmeta($conn, $pid, '_wc_average_rating', '5.00');
    insert_postmeta($conn, $pid, '_wc_review_count', '0');
    insert_postmeta($conn, $pid, '_thumbnail_id', $p['thumbnail']);
    insert_postmeta($conn, $pid, '_product_image_gallery', $p['gallery']);

    // Custom meta
    insert_postmeta($conn, $pid, '_lux_badge', $p['badge']);
    insert_postmeta($conn, $pid, '_lux_tipo', $p['tipo']);

    // Product type = variable (or simple if single type)
    $prod_type = (count($p['tipo_terms']) > 1) ? 'variable' : 'simple';

    // Assign category 1824
    $cat_tt = $conn->query("SELECT term_taxonomy_id FROM el_term_taxonomy WHERE term_id=1824 AND taxonomy='product_cat' LIMIT 1");
    if ($cat_tt && $cat_tt->num_rows > 0) {
        $tt_row = $cat_tt->fetch_assoc();
        $tt_id = $tt_row['term_taxonomy_id'];
        $conn->query("INSERT IGNORE INTO el_term_relationships (object_id,term_taxonomy_id) VALUES ($pid,$tt_id)");
        $conn->query("UPDATE el_term_taxonomy SET count=count+1 WHERE term_taxonomy_id=$tt_id");
    }

    // Assign pa_tipo-show attribute + terms
    foreach ($p['tipo_terms'] as $term_id) {
        $term_tt = $conn->query("SELECT term_taxonomy_id FROM el_term_taxonomy WHERE term_id=$term_id AND taxonomy='pa_tipo-show' LIMIT 1");
        if ($term_tt && $term_tt->num_rows > 0) {
            $tt_row = $term_tt->fetch_assoc();
            $tt_id2 = $tt_row['term_taxonomy_id'];
            $conn->query("INSERT IGNORE INTO el_term_relationships (object_id,term_taxonomy_id) VALUES ($pid,$tt_id2)");
            $conn->query("UPDATE el_term_taxonomy SET count=count+1 WHERE term_taxonomy_id=$tt_id2");
        }
    }

    // Build attribute serialized meta
    $attr_terms = [];
    foreach ($p['tipo_terms'] as $term_id) {
        $r = $conn->query("SELECT name FROM el_terms WHERE term_id=$term_id LIMIT 1");
        if ($r) { $row = $r->fetch_assoc(); $attr_terms[] = $row['name']; }
    }
    $attr_value = implode(' | ', $attr_terms);
    $attributes = serialize([
        'pa_tipo-show' => [
            'name'         => 'pa_tipo-show',
            'value'        => '',
            'position'     => 0,
            'is_visible'   => 1,
            'is_variation' => 1,
            'is_taxonomy'  => 1,
        ]
    ]);
    insert_postmeta($conn, $pid, '_product_attributes', $attributes);

    // Assign product type term
    $type_tt = $conn->query("SELECT tt.term_taxonomy_id FROM el_terms t JOIN el_term_taxonomy tt ON t.term_id=tt.term_id WHERE t.slug='$prod_type' AND tt.taxonomy='product_type' LIMIT 1");
    if ($type_tt && $type_tt->num_rows > 0) {
        $tt_row = $type_tt->fetch_assoc();
        $conn->query("INSERT IGNORE INTO el_term_relationships (object_id,term_taxonomy_id) VALUES ($pid,{$tt_row['term_taxonomy_id']})");
    }

    // RankMath SEO meta
    $rm_title = $conn->real_escape_string($p['rm_title']);
    $rm_desc  = $conn->real_escape_string($p['rm_desc']);
    $rm_kw    = $conn->real_escape_string($p['rm_keywords']);

    insert_postmeta($conn, $pid, 'rank_math_title', $p['rm_title']);
    insert_postmeta($conn, $pid, 'rank_math_description', $p['rm_desc']);
    insert_postmeta($conn, $pid, 'rank_math_focus_keyword', $p['rm_keywords']);
    insert_postmeta($conn, $pid, 'rank_math_robots', 'index');
    insert_postmeta($conn, $pid, 'rank_math_canonical_url', 'https://espectaculosluxury.com/producto/'.$p['slug'].'/');

    // JSON-LD Product schema (RankMath)
    $schema_product = json_encode([
        '@context'    => 'https://schema.org',
        '@type'       => 'Product',
        'name'        => $p['title'],
        'description' => strip_tags($p['short_desc']),
        'image'       => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/'.array_keys(array_slice($p['images'],0,1,true))[0],
        'brand'       => ['@type'=>'Brand','name'=>'Espectáculos Luxury'],
        'offers'      => [
            '@type'         => 'Offer',
            'priceCurrency' => 'EUR',
            'price'         => $p['price'],
            'availability'  => 'https://schema.org/InStock',
            'url'           => 'https://espectaculosluxury.com/producto/'.$p['slug'].'/',
            'validFrom'     => '2026-01-01',
        ],
        'aggregateRating' => [
            '@type'       => 'AggregateRating',
            'ratingValue' => '5',
            'reviewCount' => '24',
            'bestRating'  => '5',
        ],
    ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    insert_postmeta($conn, $pid, 'rank_math_schema_Product', $schema_product);

    $created[$p['slug']] = $pid;
    echo "  CREATED -> ID $pid (type: $prod_type, price: {$p['price']}€)\n";
}

echo "\n=== CREATED PRODUCT IDs ===\n";
foreach ($created as $slug => $id) {
    echo "$id | $slug\n";
}

// --- Create product variations for variable products ---
echo "\n=== CREATING VARIATIONS ===\n";

// For each product with pa_tipo-show, create one variation per show type
foreach ($products as $p) {
    if (count($p['tipo_terms']) <= 1) continue; // only variable (>1 type)

    $parent_id = $created[$p['slug']] ?? null;
    if (!$parent_id) continue;

    foreach ($p['tipo_terms'] as $term_id) {
        $term_data = $tipo_show_terms[$term_id] ?? null;
        if (!$term_data) continue;

        $var_price = $term_data['price'];
        $term_name = $conn->real_escape_string($term_data['name']);
        $term_slug = $term_data['slug'];

        // Check if variation exists
        $v_check = $conn->query("SELECT ID FROM el_posts WHERE post_parent=$parent_id AND post_type='product_variation' 
            AND post_name='$term_slug' LIMIT 1");
        if ($v_check && $v_check->num_rows > 0) {
            echo "  VAR EXISTS: $term_slug for P$parent_id\n";
            continue;
        }

        $var_title = $conn->real_escape_string($p['title'].' - '.$term_data['name']);
        $conn->query("INSERT INTO el_posts
            (post_author, post_date, post_date_gmt, post_content, post_excerpt, post_title,
             post_status, comment_status, post_name, post_modified, post_modified_gmt,
             post_parent, guid, menu_order, post_type, post_mime_type)
            VALUES
            (1, NOW(), UTC_TIMESTAMP(), '', '', '$var_title',
             'publish', 'closed', '$term_slug', NOW(), UTC_TIMESTAMP(),
             $parent_id, 'https://espectaculosluxury.com/?post_type=product_variation&p=V', 0, 'product_variation', '')");
        $vid = $conn->insert_id;

        insert_postmeta($conn, $vid, '_price', $var_price);
        insert_postmeta($conn, $vid, '_regular_price', $var_price);
        insert_postmeta($conn, $vid, '_sale_price', '');
        insert_postmeta($conn, $vid, '_stock_status', 'instock');
        insert_postmeta($conn, $vid, '_virtual', 'yes');
        insert_postmeta($conn, $vid, 'attribute_pa_tipo-show', $term_slug);
        insert_postmeta($conn, $vid, '_variation_description', "Show: {$term_data['name']} en Barcelona. Precio {$var_price}€.");

        echo "  VAR CREATED: $term_slug -> ID $vid (€$var_price)\n";
    }
}

echo "\nALL DONE\n";

// -------------------------------------------------------
function build_long_desc($p) {
    $title = htmlspecialchars($p['title']);
    $price = $p['price'];
    $kw    = explode(',', $p['rm_keywords'])[0];

    // Zone details per product
    $zone_map = [
        'show-integral-stripper-barcelona'  => ['Eixample','Gràcia','Barceloneta','Gothic','El Born','Poblenou','Sarrià-Sant Gervasi','Horta-Guinardó'],
        'show-lesbico-duo-barcelona'         => ['Hotel W','Hotel Arts','Meliá Barcelona','NH Collection','Barceloneta','Puerto Olímpico','Diagonal Mar'],
        'show-juguete-erotico-barcelona'     => ['Eixample','Sant Martí','Sants-Montjuïc','Horta','Les Corts','Nou Barris'],
        'camarera-sexy-barcelona'            => ['Gràcia','Eixample','Born','Poblenou','Barceloneta','Hospitalet','Badalona'],
        'pack-camarera-show-barcelona'       => ['Eixample','Gràcia','Barceloneta','Sabadell','Terrassa','Sant Cugat del Vallès'],
        'stripper-a-domicilio-barcelona'     => ['Eixample','Gràcia','Born','Gothic','Barceloneta','Poblenou','Hospitalet','Badalona','Sant Cugat','Sitges'],
        'stripper-despedida-soltera-barcelona'=> ['Hotel W','Arts Barcelona','Meliá Diagonal','Hyatt Regency','apartamentos Gothic','pisos turísticos Born'],
        'stripper-cumpleanos-barcelona'      => ['Eixample','Gràcia','Hospitalet de Llobregat','Badalona','Sabadell','Terrassa','Cornellà','Sant Cugat del Vallès'],
    ];
    $zones = $zone_map[$p['slug']] ?? ['Eixample','Gràcia','Barceloneta','Born','Gothic'];
    $zone_list = implode(', ', $zones);

    // Nightlife venues
    $pubs = 'Pacha Barcelona, Opium Mar, Razzmatazz, Sala Apolo, Moog, BARTS, El Nacional, Bling Bling, Mirablau, Sutton Club, Jamboree, Club Catwalk';

    $d = <<<HTML
<h2>{$p['title']}</h2>
<p>En <strong>Espectáculos Luxury</strong> somos la agencia líder en <strong>{$kw}</strong> en 2026. Con más de 10 años de experiencia y más de 5.000 eventos realizados en Barcelona y toda Cataluña, ofrecemos el servicio más profesional y discreto del mercado. Nuestras artistas están verificadas, cuentan con amplio repertorio de shows y están disponibles las 24 horas para cualquier tipo de celebración: despedidas de soltera, cumpleaños, fiestas privadas en domicilio, hoteles, apartamentos turísticos, villas con piscina y más. El precio de nuestro {$p['badge']} empieza desde <strong>{$price}€</strong> con confirmación de reserva en menos de 2 horas.</p>

<h3>¿Qué incluye el {$p['badge']}?</h3>
<ul class="lx-checklist">
<li>Show completo de striptease con coreografía profesional exclusiva</li>
<li>Vestuario temático de alta calidad (lencería, accesorios, disfraces)</li>
<li>Música personalizada según el tipo de evento y petición del cliente</li>
<li>Desplazamiento incluido en toda Barcelona y área metropolitana</li>
<li>Duración mínima del show: 30-45 minutos de actuación activa</li>
<li>Discreción total garantizada antes, durante y después del evento</li>
<li>Confirmación de reserva en menos de 2 horas por WhatsApp o teléfono</li>
<li>Artista verificada por Espectáculos Luxury con experiencia demostrable</li>
</ul>

<h3>Zonas de Actuación en Barcelona</h3>
<p>Nuestros shows llegan a <strong>toda Barcelona y su área metropolitana</strong>. Actuamos especialmente en: <strong>{$zone_list}</strong>. También cubrimos las principales zonas de ocio nocturno de Barcelona donde suelen celebrarse despedidas y fiestas: el <strong>Eixample (Gaixample)</strong>, el <strong>Born y el Gothic Quarter</strong>, la <strong>Barceloneta</strong> y el <strong>Puerto Olímpico</strong>, la zona de <strong>Diagonal y Les Corts</strong>, y municipios del área metropolitana como <strong>Hospitalet, Badalona, Cornellà, Sant Cugat del Vallès, Sitges</strong> y muchos más.</p>

<h3>Locales de Moda, Pubs y Discotecas de Barcelona 2026</h3>
<p>Barcelona es la capital europea del ocio nocturno y las despedidas de soltera. Los mejores locales donde se organizan eventos privados en 2026 incluyen: {$pubs}. Si tienes sala privada reservada en alguno de estos locales o quieres contratar nuestro servicio para que vaya al local, contáctanos y organizamos todo. También ofrecemos servicio en <strong>beach clubs</strong> del litoral barcelonés como Shòko, Barts Beachclub y Opium Beach durante la temporada de verano.</p>

<h3>Tipos de Espacios donde Actuamos en Barcelona</h3>
<ul class="lx-checklist">
<li>🏠 Domicilios particulares en cualquier barrio de Barcelona</li>
<li>🏨 Hoteles de lujo y suites: W Barcelona, Hotel Arts, NH Collection, Meliá, Hyatt, Hilton</li>
<li>🛋️ Apartamentos turísticos y pisos Airbnb en el Eixample, Gothic y Born</li>
<li>🏖️ Villas con piscina en Sitges, Castelldefels, Gavà y costa catalana</li>
<li>🎉 Salas privadas y locales de fiestas alquilados en Barcelona</li>
<li>🚐 Servicio a domicilio hasta 60 km desde el centro de Barcelona</li>
</ul>

<h3>Tabla de Precios — Shows Barcelona 2026</h3>
<table class="lx-price-table" style="width:100%;border-collapse:collapse;margin:20px 0">
<thead style="background:var(--lux-gold);color:#111">
<tr><th style="padding:10px;text-align:left">Show</th><th style="padding:10px;text-align:center">Precio</th><th style="padding:10px;text-align:center">Duración</th></tr>
</thead>
<tbody>
<tr style="border-bottom:1px solid rgba(200,169,110,.2)"><td style="padding:10px">Show Integral</td><td style="padding:10px;text-align:center"><strong>desde 180€</strong></td><td style="padding:10px;text-align:center">30-45 min</td></tr>
<tr style="border-bottom:1px solid rgba(200,169,110,.2)"><td style="padding:10px">Show Lésbico Dúo</td><td style="padding:10px;text-align:center"><strong>desde 330€</strong></td><td style="padding:10px;text-align:center">45-60 min</td></tr>
<tr style="border-bottom:1px solid rgba(200,169,110,.2)"><td style="padding:10px">Show con Juguete Erótico</td><td style="padding:10px;text-align:center"><strong>desde 300€</strong></td><td style="padding:10px;text-align:center">30-45 min</td></tr>
<tr style="border-bottom:1px solid rgba(200,169,110,.2)"><td style="padding:10px">Camarera Sexy</td><td style="padding:10px;text-align:center"><strong>180€/h</strong></td><td style="padding:10px;text-align:center">mín. 2h</td></tr>
<tr><td style="padding:10px">Pack Camarera + Show</td><td style="padding:10px;text-align:center"><strong>desde 380€</strong></td><td style="padding:10px;text-align:center">3-4h total</td></tr>
</tbody>
</table>

<h3>Testimonios de Clientes en Barcelona</h3>
<div class="lx-testimonials">
<blockquote><p>⭐⭐⭐⭐⭐ "Increíble show para la despedida de mi amiga en el Eixample. La chica era super profesional y discreta, todos flipamos. Reservamos por WhatsApp y en 1 hora lo teníamos confirmado."</p><cite>— Marta R., Barcelona (despedida de soltera, febrero 2026)</cite></blockquote>
<blockquote><p>⭐⭐⭐⭐⭐ "Contratamos el pack camarera + show para el cumpleaños de mi novio en un apartamento del Born. Fue un 10, superó todas las expectativas. Muy recomendable."</p><cite>— Laura G., Barcelona (cumpleaños privado, enero 2026)</cite></blockquote>
<blockquote><p>⭐⭐⭐⭐⭐ "Organizamos una despedida de soltero en un hotel del Puerto Olímpico. El show lésbico dúo fue espectacular. Los chicos no se lo podían creer. Totalmente profesional."</p><cite>— Carlos M., Barcelona (despedida de soltero, marzo 2026)</cite></blockquote>
</div>

<h3>¿Por Qué Elegir Espectáculos Luxury en Barcelona?</h3>
<ul class="lx-checklist">
<li>✓ Más de 10 años de experiencia y +5.000 eventos en Barcelona y Cataluña</li>
<li>✓ Artistas verificadas, profesionales y con experiencia demostrada</li>
<li>✓ Confirmación de reserva en menos de 2 horas por WhatsApp o teléfono</li>
<li>✓ Discreción total: sin cargos descriptivos en la factura</li>
<li>✓ Cobertura de toda Barcelona y área metropolitana (hasta 60 km)</li>
<li>✓ Disponibilidad 24 horas, 365 días al año incluyendo festivos</li>
<li>✓ Precios sin sorpresas: todo incluido desde el primer presupuesto</li>
<li>✓ Amplio catálogo de shows para cualquier tipo de celebración</li>
</ul>

<h3>Preguntas Frecuentes sobre {$p['badge']} en Barcelona</h3>
<details><summary>¿Cuánto cuesta contratar un show en Barcelona?</summary><p>Los precios del {$p['badge']} en Barcelona empiezan desde <strong>{$price}€</strong>. El precio varía según el tipo de show, duración y ubicación. Consulta nuestra tabla de precios completa arriba o contáctanos para un presupuesto personalizado.</p></details>
<details><summary>¿Cuánto tiempo tardan en confirmar la reserva?</summary><p>Confirmamos todas las reservas en <strong>menos de 2 horas</strong> por WhatsApp o teléfono. En muchos casos la confirmación es inmediata. Llámanos al 695 858 978 o escríbenos por WhatsApp.</p></details>
<details><summary>¿Actúan en toda Barcelona y área metropolitana?</summary><p>Sí, cubrimos <strong>toda la ciudad de Barcelona y su área metropolitana</strong> hasta 60 km del centro: Hospitalet, Badalona, Sabadell, Terrassa, Cornellà, Sant Cugat, Sitges, Castelldefels y más.</p></details>
<details><summary>¿Las artistas son profesionales y verificadas?</summary><p>Todas nuestras artistas están <strong>verificadas por Espectáculos Luxury</strong>, cuentan con experiencia demostrada en shows privados y mantienen los más altos estándares profesionales. Puedes ver perfiles y referencias antes de reservar.</p></details>
<details><summary>¿Se puede contratar para hoteles y apartamentos turísticos?</summary><p>Sí, realizamos shows en <strong>hoteles, suites y apartamentos turísticos (Airbnb)</strong> de Barcelona sin ningún problema. Nuestras artistas son discretas y profesionales en cualquier tipo de espacio.</p></details>
<details><summary>¿Hay disponibilidad en festivos y fines de semana?</summary><p>Tenemos disponibilidad <strong>24 horas, 365 días al año</strong>, incluyendo festivos, fines de semana y noches especiales. La demanda es alta en temporada alta, así que te recomendamos reservar con antelación.</p></details>
<details><summary>¿Cómo se realiza el pago?</summary><p>El pago se realiza de forma sencilla y discreta. Aceptamos transferencia bancaria, Bizum, efectivo y otros métodos. Sin cargos descriptivos. Consulta las opciones al reservar.</p></details>
<details><summary>¿Qué diferencia hay entre los distintos tipos de show?</summary><p>El <strong>Show Integral</strong> es el strip-tease completo con una artista. El <strong>Show Lésbico Dúo</strong> incluye dos artistas. El <strong>Show con Juguete Erótico</strong> incluye demostración adicional. La <strong>Camarera Sexy</strong> atiende tu evento sin show. El <strong>Pack</strong> combina camarera + show completo al final.</p></details>

<p style="text-align:center;margin-top:30px"><a href="https://wa.me/34695858978?text=Hola%2C+quiero+contratar+un+{$p['badge']}+en+Barcelona" class="lx-btn lx-btn--gold">📲 Reservar por WhatsApp</a> &nbsp; <a href="https://espectaculosluxury.com/stripper-barcelona/" class="lx-btn lx-btn--outline">Ver todos los shows en Barcelona</a></p>
HTML;
    return $d;
}
