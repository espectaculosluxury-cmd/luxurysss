<?php
/**
 * CREATE_BARCELONA_PRODUCTS.PHP
 * Crea 8 productos WooCommerce para Barcelona por municipio
 * Todos etiquetados bajo cat 1824 (contratar-stripper-para-fiestas-y-despedidas-en-barcelona)
 * + actualiza la landing page /stripper-barcelona/ (post 67406)
 *
 * Estructura replicada del producto modelo: 67331 (variable, cat 1718+1824)
 */

$conn = new mysqli('localhost','UsrDBespLu2015','spol2vi0xy1go','DBespLu2015');
$conn->set_charset('utf8mb4');
if ($conn->connect_error) { die("DB ERROR: ".$conn->connect_error."\n"); }
echo "DB connected OK\n";

// ─────────────────────────────────────────────
// TAXONOMY IDs (verified from DB)
// ─────────────────────────────────────────────
$tt_product_type_simple    = 2;   // product_type: simple
$tt_cat_main               = 1718; // product_cat: Contratar stripper a domicilio...
$tt_cat_barcelona          = 1824; // product_cat: Contratar stripper para fiestas y despedidas en Barcelona
$tt_visibility_featured    = 156;  // product_visibility: featured
// pa_localidades-de-barcelona term_taxonomy_ids:
$loc_tt = [
  'barcelona'                => 5578,
  'hospitalet-de-llobregat'  => 5579,
  'badalona'                 => 5580,
  'terrassa'                 => 5581,
  'sabadell'                 => 5582,
  'cornella-de-llobregat'    => 5589,
  'sant-cugat-del-valles'    => 5590,
  'sitges'                   => 5591,
];
// pa_tipos-de-show term_taxonomy_ids (from existing product 67331):
$show_tt = [
  'show-integral'    => 3247,
  'show-duo-fem'     => 3248,
  'show-accesorios'  => 3249,
  'show-sensual'     => 3250,
  'camarera-sexy'    => 3251,
  'cam-strip'        => 4664,
];

// product_brand Barcelona
$tt_brand_bcn = 6113; // Stripper en Barcelona

// ─────────────────────────────────────────────
// PRODUCT DEFINITIONS – 8 municipios
// ─────────────────────────────────────────────
$products = [

  // 1. Barcelona Capital
  [
    'title'   => 'Stripper en Barcelona Capital 2026 | Show a Domicilio Eixample, Gràcia, Gótico',
    'slug'    => 'stripper-barcelona-capital',
    'price'   => '180',
    'img_id'  => 67886, // madrid-img-16.jpg
    'img_url' => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/madrid-img-16.jpg',
    'loc_tt'  => [5578],
    'seo_title' => 'Stripper Barcelona Capital 2026 | A Domicilio desde 180€',
    'seo_desc'  => 'Contrata stripper a domicilio en Barcelona capital para despedidas y fiestas. Eixample, Gràcia, Barrio Gótico, Barceloneta. Reserva en 2h desde 180€.',
    'seo_kw'    => 'stripper barcelona capital,stripper eixample,stripper gracia barcelona,stripper barrio gotico,stripper a domicilio barcelona',
    'content'   => '<h2>Stripper en Barcelona Capital 2026 — Show a Domicilio</h2>
<p>¿Buscas contratar un <strong>stripper en Barcelona capital</strong> para tu despedida de soltera, cumpleaños o fiesta privada? <strong>Espectáculos Luxury</strong> lleva el show directamente a tu domicilio, hotel o apartamento en cualquier distrito de la ciudad.</p>
<h3>Distritos de Barcelona donde actuamos</h3>
<p>Cubrimos todos los barrios y distritos de Barcelona: <strong>Eixample</strong> (el corazón de las fiestas VIP), <strong>Gràcia y Vila de Gràcia</strong> (pisos amplios y ambiente bohemio), <strong>Barrio Gótico y El Born</strong> (hoteles boutique históricos), <strong>Barceloneta y Port Olímpic</strong> (apartamentos con vistas al mar), <strong>Sarrià-Sant Gervasi</strong> (villas y chalets de alto standing), <strong>Les Corts y Sants-Montjuïc</strong>, <strong>Poble Sec y Paralelo</strong>, <strong>Sant Martí y Poblenou</strong>.</p>
<h3>Hoteles Premium en Barcelona Capital</h3>
<p>Tenemos experiencia actuando en los mejores hoteles de Barcelona: <strong>W Barcelona</strong> (Barceloneta), <strong>Hotel Arts</strong>, <strong>Mandarin Oriental</strong> (Paseo de Gracia), <strong>Hilton Diagonal Mar</strong>, <strong>Barceló Raval</strong>, <strong>Hotel 1898</strong> (Las Ramblas), <strong>The Serras</strong> (Born), <strong>DO Plaça Reial</strong> y muchos más. Show discreto en habitación o suite.</p>
<h3>Tipos de Show y Precios en Barcelona Capital</h3>
<ul>
<li>Show Integral: desde <strong>180€</strong> (45-60 min, coreografía completa)</li>
<li>Show Lésbico Dúo: desde <strong>350€</strong> (2 bailarinas, 50-70 min)</li>
<li>Show con Juguete Erótico: desde <strong>280€</strong></li>
<li>Camarera Sexy: <strong>180€/hora</strong> (mín. 2h)</li>
<li>Pack Camarera + Show: desde <strong>300€</strong></li>
<li>Stripper Masculino (Boys): desde <strong>180€</strong></li>
</ul>
<p>Confirmación en menos de 2 horas. WhatsApp: <strong>695 858 978</strong>. Sin costes ocultos, IVA incluido.</p>',
  ],

  // 2. L'Hospitalet de Llobregat
  [
    'title'   => 'Stripper en L\'Hospitalet de Llobregat 2026 | Show a Domicilio',
    'slug'    => 'stripper-hospitalet-de-llobregat',
    'price'   => '180',
    'img_id'  => 67881, // madrid-img-11.jpg
    'img_url' => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/madrid-img-11.jpg',
    'loc_tt'  => [5579],
    'seo_title' => 'Stripper en Hospitalet de Llobregat 2026 | Shows desde 180€',
    'seo_desc'  => 'Contrata stripper en L\'Hospitalet de Llobregat para despedidas, cumpleaños y fiestas privadas. Show a domicilio con confirmación en 2h. Desde 180€.',
    'seo_kw'    => 'stripper hospitalet de llobregat,stripper en hospitalet,contratar stripper hospitalet,show striptease hospitalet llobregat',
    'content'   => '<h2>Stripper en L\'Hospitalet de Llobregat 2026 — Shows a Domicilio</h2>
<p>Contrata un <strong>stripper en L\'Hospitalet de Llobregat</strong> para tu próxima fiesta o despedida. Espectáculos Luxury ofrece shows de striptease profesionales a domicilio en toda L\'Hospitalet: <strong>Gran Vía Sud, Bellvitge, Florida, La Torrassa, Sant Josep, Gornal</strong> y el resto de barrios.</p>
<h3>¿Por qué contratar en Hospitalet?</h3>
<p>L\'Hospitalet es la segunda ciudad más grande de Cataluña, con una activa vida de ocio nocturno y una gran oferta de pisos y apartamentos para fiestas privadas. Nuestro equipo está habituado a actuar en viviendas y hoteles del área metropolitana de Barcelona, con <strong>desplazamiento gratuito</strong> desde Barcelona capital.</p>
<h3>Precios en L\'Hospitalet de Llobregat</h3>
<ul>
<li>Show Integral: desde <strong>180€</strong></li>
<li>Show Lésbico Dúo: desde <strong>350€</strong></li>
<li>Camarera Sexy: <strong>180€/h</strong> (mín. 2h)</li>
<li>Pack Camarera + Show: desde <strong>300€</strong></li>
</ul>
<p>Reserva en 2h por WhatsApp: <strong>695 858 978</strong>.</p>',
  ],

  // 3. Badalona
  [
    'title'   => 'Stripper en Badalona 2026 | Show a Domicilio para Despedidas y Fiestas',
    'slug'    => 'stripper-badalona',
    'price'   => '180',
    'img_id'  => 67876, // madrid-img-06.jpg
    'img_url' => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/madrid-img-06.jpg',
    'loc_tt'  => [5580],
    'seo_title' => 'Stripper en Badalona 2026 | Show a Domicilio desde 180€',
    'seo_desc'  => 'Contrata stripper en Badalona para despedidas de soltera, cumpleaños y fiestas privadas. Shows a domicilio con artistas profesionales. Reserva en 2h.',
    'seo_kw'    => 'stripper badalona,stripper en badalona,contratar stripper badalona,show striptease badalona',
    'content'   => '<h2>Stripper en Badalona 2026 — Show a Domicilio</h2>
<p>¿Organizas una despedida de soltera o cumpleaños en Badalona? <strong>Espectáculos Luxury</strong> lleva el mejor show de striptease a domicilio en Badalona: <strong>Centre, Llefià, Sant Roc, Morera, La Salut, Bufalà, Artigas, Nova Lloreda</strong> y urbanizaciones costeras.</p>
<h3>Zonas de Actuación en Badalona</h3>
<p>Badalona cuenta con apartamentos frente al mar, urbanizaciones residenciales y varios hoteles ideales para shows privados. Actuamos en pisos de playa, chalets en zonas altas y cualquier espacio privado de la ciudad. Acceso directo desde Barcelona por metro L2 y autopista C-31.</p>
<h3>Precios y Shows en Badalona</h3>
<ul>
<li>Show Integral: desde <strong>180€</strong> (sin suplemento desde BCN capital)</li>
<li>Show Lésbico Dúo: desde <strong>350€</strong></li>
<li>Show con Juguete Erótico: desde <strong>280€</strong></li>
<li>Camarera Sexy: <strong>180€/h</strong></li>
</ul>
<p>Confirmación en menos de 2h. Contacta: <strong>695 858 978</strong>.</p>',
  ],

  // 4. Terrassa
  [
    'title'   => 'Stripper en Terrassa 2026 | Show a Domicilio para Despedidas y Fiestas',
    'slug'    => 'stripper-terrassa',
    'price'   => '180',
    'img_id'  => 67878, // madrid-img-08.jpg
    'img_url' => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/madrid-img-08.jpg',
    'loc_tt'  => [5581],
    'seo_title' => 'Stripper en Terrassa 2026 | Shows desde 180€ — Despedidas y Fiestas',
    'seo_desc'  => 'Contrata stripper en Terrassa para despedidas de soltera, cumpleaños y fiestas privadas. Shows a domicilio con artistas verificadas. Confirmación en 2h.',
    'seo_kw'    => 'stripper terrassa,stripper en terrassa,contratar stripper terrassa,show striptease terrassa',
    'content'   => '<h2>Stripper en Terrassa 2026 — Show a Domicilio</h2>
<p>Terrassa es la tercera ciudad más grande de Cataluña, con una vibrante vida nocturna concentrada en el <strong>Centre Històric, Ègara, Ca n\'Anglada, Vallparadís</strong> y las zonas residenciales del extrarradio. <strong>Espectáculos Luxury</strong> lleva shows de striptease profesionales directamente a tu fiesta en Terrassa.</p>
<h3>La Noche en Terrassa</h3>
<p>Terrassa tiene una amplia oferta de bares y discotecas en su centro histórico, especialmente en los alrededores de la Plaza Mayor y Rambla d\'Ègara. Para shows privados, trabajamos en pisos de alquiler, chalets en les Arenes y urbanizaciones de Can Roca y Montserrat. También cubrimos el polígono industrial Sant Pere Nord para eventos de empresa.</p>
<h3>Precios en Terrassa</h3>
<ul>
<li>Show Integral: desde <strong>180€</strong> (+ 15€ suplemento desplazamiento desde BCN)</li>
<li>Show Lésbico Dúo: desde <strong>365€</strong></li>
<li>Camarera Sexy: <strong>180€/h</strong></li>
<li>Pack Camarera + Show: desde <strong>310€</strong></li>
</ul>
<p>WhatsApp: <strong>695 858 978</strong>. Confirmamos en menos de 2h.</p>',
  ],

  // 5. Sabadell
  [
    'title'   => 'Stripper en Sabadell 2026 | Show a Domicilio — Despedidas y Cumpleaños',
    'slug'    => 'stripper-sabadell',
    'price'   => '180',
    'img_id'  => 67873, // madrid-img-03.jpg
    'img_url' => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/madrid-img-03.jpg',
    'loc_tt'  => [5582],
    'seo_title' => 'Stripper en Sabadell 2026 | Shows desde 180€ — Despedidas y Fiestas',
    'seo_desc'  => 'Contrata stripper en Sabadell para despedidas de soltera, cumpleaños y fiestas privadas. Shows a domicilio con artistas profesionales verificadas. Desde 180€.',
    'seo_kw'    => 'stripper sabadell,stripper en sabadell,contratar stripper sabadell,show striptease sabadell,despedida soltera sabadell',
    'content'   => '<h2>Stripper en Sabadell 2026 — Show a Domicilio</h2>
<p>Organiza la mejor despedida de soltera o cumpleaños en Sabadell con un show de striptease profesional a domicilio. <strong>Espectáculos Luxury</strong> actúa en toda Sabadell: <strong>Centre, Can Puiggener, Campoamor, La Creu de Barbará, Torre-Romeu, Nord, Can Rull</strong> y urbanizaciones del extrarradio.</p>
<h3>Ocio Nocturno en Sabadell</h3>
<p>Sabadell cuenta con una intensa actividad nocturna en su centro histórico, con bares de copas y locales de entretenimiento en la Rambla, la Plaza Sant Roc y el Barrio Histórico. Para shows privados, trabajamos en pisos de alquiler vacacional, chalets en urbanizaciones y salas privadas en la zona del parque de Catalunya.</p>
<h3>Precios en Sabadell</h3>
<ul>
<li>Show Integral: desde <strong>180€</strong> (+ 15€ desplazamiento desde BCN)</li>
<li>Show Lésbico Dúo: desde <strong>365€</strong></li>
<li>Show con Juguete Erótico: desde <strong>295€</strong></li>
<li>Camarera Sexy: <strong>180€/h</strong></li>
</ul>
<p>Reserva rápida por WhatsApp: <strong>695 858 978</strong>.</p>',
  ],

  // 6. Cornellà de Llobregat
  [
    'title'   => 'Stripper en Cornellà de Llobregat 2026 | Show a Domicilio',
    'slug'    => 'stripper-cornella-de-llobregat',
    'price'   => '180',
    'img_id'  => 67884, // madrid-img-14.jpg
    'img_url' => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/madrid-img-14.jpg',
    'loc_tt'  => [5589],
    'seo_title' => 'Stripper en Cornellà de Llobregat 2026 | Desde 180€',
    'seo_desc'  => 'Contrata stripper en Cornellà de Llobregat para despedidas y fiestas privadas. Show a domicilio en cualquier barrio. Confirmación en 2h. Desde 180€.',
    'seo_kw'    => 'stripper cornella de llobregat,stripper en cornella,contratar stripper cornella llobregat,show striptease cornella',
    'content'   => '<h2>Stripper en Cornellà de Llobregat 2026</h2>
<p>¿Buscas contratar un <strong>stripper en Cornellà de Llobregat</strong>? Espectáculos Luxury ofrece shows a domicilio en todos los barrios de Cornellà: <strong>Centre, Almeda, Sant Ildefons, Fontsanta, Gavarra, Sant Joan Espí</strong> y urbanizaciones.</p>
<h3>Cornellà: Zona Estratégica del Baix Llobregat</h3>
<p>Cornellà de Llobregat es una ciudad clave del Baix Llobregat, muy bien comunicada con Barcelona por metro L5 y autopista. Tiene una activa zona de ocio en el entorno del Centre Comercial Gran Via 2 y varias zonas residenciales con pisos amplios ideales para fiestas privadas. Desplazamiento incluido sin suplemento desde Barcelona capital.</p>
<h3>Precios en Cornellà</h3>
<ul>
<li>Show Integral: desde <strong>180€</strong></li>
<li>Show Lésbico Dúo: desde <strong>350€</strong></li>
<li>Camarera Sexy: <strong>180€/h</strong> (mín. 2h)</li>
<li>Pack Camarera + Show: desde <strong>300€</strong></li>
</ul>
<p>Contacta: WhatsApp <strong>695 858 978</strong>. Confirmamos en menos de 2h.</p>',
  ],

  // 7. Sant Cugat del Vallès
  [
    'title'   => 'Stripper en Sant Cugat del Vallès 2026 | Show VIP a Domicilio',
    'slug'    => 'stripper-sant-cugat-del-valles',
    'price'   => '200',
    'img_id'  => 67889, // madrid-img-19.jpg
    'img_url' => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/madrid-img-19.jpg',
    'loc_tt'  => [5590],
    'seo_title' => 'Stripper en Sant Cugat del Vallès 2026 | Shows VIP desde 200€',
    'seo_desc'  => 'Contrata stripper en Sant Cugat del Vallès para despedidas en villas, chalets y mansiones. Shows VIP a domicilio con artistas exclusivas. Confirmación en 2h.',
    'seo_kw'    => 'stripper sant cugat del valles,stripper en sant cugat,show striptease sant cugat,despedida soltera sant cugat valles',
    'content'   => '<h2>Stripper en Sant Cugat del Vallès 2026 — Shows VIP a Domicilio</h2>
<p>Sant Cugat del Vallès es sinónimo de exclusividad en Cataluña: villas con piscina, chalets de lujo, urbanizaciones privadas y un nivel de vida premium. <strong>Espectáculos Luxury</strong> se especializa en shows VIP adaptados al entorno exclusivo de Sant Cugat.</p>
<h3>Zonas Premium de Sant Cugat donde Actuamos</h3>
<p>Cubrimos todas las urbanizaciones y zonas residenciales de Sant Cugat: <strong>Can Trabal, Volpalleres, Les Planes, La Floresta, Residencial Sant Pere, Can Bellet</strong>, el casco antiguo junto al Monasterio y los nuevos desarrollos del eje Diagonal. También actuamos en Sant Cugat para eventos corporativos y after-works en empresas del entorno del 22@ y el polo tecnológico.</p>
<h3>Precios en Sant Cugat del Vallès</h3>
<ul>
<li>Show Integral VIP: desde <strong>200€</strong></li>
<li>Show Lésbico Dúo Premium: desde <strong>380€</strong></li>
<li>Show con Juguete Erótico: desde <strong>300€</strong></li>
<li>Camarera Sexy: <strong>200€/h</strong> (mín. 2h)</li>
<li>Pack Camarera + Show VIP: desde <strong>360€</strong></li>
</ul>
<p>WhatsApp: <strong>695 858 978</strong>. Discreción total, profesionalidad garantizada.</p>',
  ],

  // 8. Sitges
  [
    'title'   => 'Stripper en Sitges 2026 | Show VIP a Domicilio — Villas y Hoteles Boutique',
    'slug'    => 'stripper-sitges',
    'price'   => '200',
    'img_id'  => 67890, // madrid-img-20.jpg
    'img_url' => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/madrid-img-20.jpg',
    'loc_tt'  => [5591],
    'seo_title' => 'Stripper en Sitges 2026 | Shows VIP desde 200€ — Villas y Hoteles',
    'seo_desc'  => 'Contrata stripper en Sitges para despedidas en villas con piscina, hoteles boutique y fiestas en la playa. Shows VIP exclusivos. Reserva en 2h desde 200€.',
    'seo_kw'    => 'stripper sitges,stripper en sitges,show striptease sitges,despedida soltera sitges,stripper villa sitges',
    'content'   => '<h2>Stripper en Sitges 2026 — Shows VIP para Villas y Hoteles Boutique</h2>
<p>Sitges es el destino de moda para despedidas de soltera y fiestas exclusivas en Cataluña. Villas con piscina, hoteles boutique con vistas al mar, apartamentos en el casco histórico... <strong>Espectáculos Luxury</strong> lleva el show VIP directamente a tu celebración en Sitges.</p>
<h3>Sitges: El Destino Perfecto para Despedidas</h3>
<p>Sitges combina un ambiente cosmopolita y abierto con entornos de lujo incomparables. La ciudad es conocida por su vida nocturna en el <strong>Carrer del Pecado</strong> y sus alrededores, con locales de copas, terrazas y música en vivo. Para shows privados, trabajamos en villas alquiladas en las urbanizaciones de Playa de Vallpineda, Can Robert y Les Botigues, así como en hoteles boutique como el <strong>Hotel Celimar, Melia Sitges, San Sebastián Playa</strong> y otros.</p>
<h3>Precios en Sitges</h3>
<ul>
<li>Show Integral VIP: desde <strong>200€</strong></li>
<li>Show Lésbico Dúo Premium: desde <strong>380€</strong></li>
<li>Show con Juguete Erótico: desde <strong>300€</strong></li>
<li>Camarera Sexy: <strong>200€/h</strong> (mín. 2h)</li>
<li>Pack Camarera + Show VIP: desde <strong>360€</strong></li>
</ul>
<p>WhatsApp: <strong>695 858 978</strong>. Suplemento de desplazamiento desde 20€ (según distancia de BCN). Reserva confirmada en menos de 2h.</p>',
  ],

];

// ─────────────────────────────────────────────
// HELPER: Insert term relationship
// ─────────────────────────────────────────────
function add_term_rel($conn, $object_id, $term_taxonomy_id, $term_order = 0) {
    $conn->query("INSERT IGNORE INTO el_term_relationships (object_id, term_taxonomy_id, term_order) VALUES ($object_id, $term_taxonomy_id, $term_order)");
    $conn->query("UPDATE el_term_taxonomy SET count = count + 1 WHERE term_taxonomy_id = $term_taxonomy_id");
}

// ─────────────────────────────────────────────
// HELPER: Insert postmeta
// ─────────────────────────────────────────────
function add_meta($conn, $post_id, $meta_key, $meta_value) {
    $stmt = $conn->prepare("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES (?, ?, ?)");
    $stmt->bind_param('iss', $post_id, $meta_key, $meta_value);
    $stmt->execute();
    $stmt->close();
}

// ─────────────────────────────────────────────
// PRODUCT ATTRIBUTES serialized
// ─────────────────────────────────────────────
$product_attributes_simple = 'a:2:{s:27:"pa_localidades-de-barcelona";a:6:{s:4:"name";s:27:"pa_localidades-de-barcelona";s:5:"value";s:0:"";s:8:"position";i:0;s:10:"is_visible";i:1;s:12:"is_variation";i:0;s:11:"is_taxonomy";i:1;}s:16:"pa_tipos-de-show";a:6:{s:4:"name";s:16:"pa_tipos-de-show";s:5:"value";s:0:"";s:8:"position";i:1;s:10:"is_visible";i:1;s:12:"is_variation";i:0;s:11:"is_taxonomy";i:1;}}';

// ─────────────────────────────────────────────
// CREATE PRODUCTS
// ─────────────────────────────────────────────
$created_ids = [];
$now = date('Y-m-d H:i:s');

foreach ($products as $p) {
    // Check if slug already exists
    $check = $conn->query("SELECT ID FROM el_posts WHERE post_name='".$conn->real_escape_string($p['slug'])."' AND post_type='product'");
    if ($check->num_rows > 0) {
        $existing = $check->fetch_assoc();
        echo "SKIP (exists): {$p['title']} → ID {$existing['ID']}\n";
        $created_ids[] = $existing['ID'];
        continue;
    }

    // Insert post
    $stmt = $conn->prepare("INSERT INTO el_posts 
        (post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_name, post_type, post_modified, post_modified_gmt, guid, to_ping, pinged, post_content_filtered)
        VALUES (1, ?, ?, ?, ?, '', 'publish', 'open', 'closed', ?, 'product', ?, ?, '', '', '', '')");
    
    $guid = 'https://espectaculosluxury.com/?post_type=product&p=0'; // will be updated
    $stmt->bind_param('sssssss', $now, $now, $p['content'], $p['title'], $p['slug'], $now, $now);
    $stmt->execute();
    $new_id = $conn->insert_id;
    $stmt->close();

    // Update GUID with real ID
    $conn->query("UPDATE el_posts SET guid='https://espectaculosluxury.com/?post_type=product&p=$new_id' WHERE ID=$new_id");

    echo "CREATED: {$p['title']} → ID $new_id\n";
    $created_ids[] = $new_id;

    // ── Term relationships ──
    // product_type: simple
    add_term_rel($conn, $new_id, $tt_product_type_simple);
    // product_cat: main + Barcelona
    add_term_rel($conn, $new_id, $tt_cat_main);
    add_term_rel($conn, $new_id, $tt_cat_barcelona);
    // product_visibility: featured
    add_term_rel($conn, $new_id, $tt_visibility_featured);
    // product_brand: Stripper en Barcelona
    add_term_rel($conn, $new_id, $tt_brand_bcn);
    // localidades
    foreach ($p['loc_tt'] as $l_tt) {
        add_term_rel($conn, $new_id, $l_tt);
    }
    // tipos de show (common set)
    foreach ([3247, 3248, 3249, 3250, 3251, 4664, 4676] as $show_tt_id) {
        add_term_rel($conn, $new_id, $show_tt_id);
    }

    // ── Post meta ──
    add_meta($conn, $new_id, '_price', $p['price']);
    add_meta($conn, $new_id, '_regular_price', $p['price']);
    add_meta($conn, $new_id, '_sale_price', '');
    add_meta($conn, $new_id, '_sku', 'BCN-'.strtoupper(substr($p['slug'],10,4)).'-2026');
    add_meta($conn, $new_id, '_virtual', 'no');
    add_meta($conn, $new_id, '_downloadable', 'no');
    add_meta($conn, $new_id, '_stock_status', 'instock');
    add_meta($conn, $new_id, '_stock', '');
    add_meta($conn, $new_id, '_manage_stock', 'no');
    add_meta($conn, $new_id, '_backorders', 'no');
    add_meta($conn, $new_id, '_sold_individually', 'no');
    add_meta($conn, $new_id, '_tax_status', 'taxable');
    add_meta($conn, $new_id, '_tax_class', '');
    add_meta($conn, $new_id, '_product_version', '10.6.1');
    add_meta($conn, $new_id, '_visibility', 'visible');
    add_meta($conn, $new_id, '_featured', 'yes');
    add_meta($conn, $new_id, '_wc_average_rating', '0');
    add_meta($conn, $new_id, '_wc_review_count', '0');
    add_meta($conn, $new_id, 'total_sales', '0');
    add_meta($conn, $new_id, '_product_attributes', $product_attributes_simple);

    // Thumbnail
    add_meta($conn, $new_id, '_thumbnail_id', (string)$p['img_id']);

    // RankMath SEO
    add_meta($conn, $new_id, 'rank_math_title', $p['seo_title']);
    add_meta($conn, $new_id, 'rank_math_description', $p['seo_desc']);
    add_meta($conn, $new_id, 'rank_math_focus_keyword', $p['seo_kw']);
    add_meta($conn, $new_id, 'rank_math_robots', 'index,follow');
    add_meta($conn, $new_id, 'rank_math_pillar_content', 'on');

    // Product page customizations (reusing from model 67331)
    add_meta($conn, $new_id, '_cart_button_settings', 'show');
    add_meta($conn, $new_id, '_rfq_button_settings', 'hide');
    add_meta($conn, $new_id, '_wpb_vc_editor_type', 'backend');

    echo "  → Meta set, terms assigned\n";
}

echo "\n=== PRODUCTS CREATED: ".count($created_ids)." ===\n";
echo "IDs: ".implode(', ', $created_ids)."\n\n";

// ─────────────────────────────────────────────
// UPDATE CATEGORY COUNTS
// ─────────────────────────────────────────────
$conn->query("UPDATE el_term_taxonomy SET count = (SELECT COUNT(*) FROM el_term_relationships tr JOIN el_posts p ON tr.object_id=p.ID WHERE tr.term_taxonomy_id=1718 AND p.post_type='product' AND p.post_status='publish') WHERE term_taxonomy_id=1718");
$conn->query("UPDATE el_term_taxonomy SET count = (SELECT COUNT(*) FROM el_term_relationships tr JOIN el_posts p ON tr.object_id=p.ID WHERE tr.term_taxonomy_id=1824 AND p.post_type='product' AND p.post_status='publish') WHERE term_taxonomy_id=1824");
echo "Category counts updated\n";

// ─────────────────────────────────────────────
// UPDATE BARCELONA LANDING PAGE (67406) with new product links in munic grid
// ─────────────────────────────────────────────
echo "\nUpdating Barcelona landing page post 67406...\n";
$landing_file = '/tmp/barcelona_landing_upload.html';
if (!file_exists($landing_file)) {
    echo "WARNING: Landing file not found at $landing_file. Skipping landing update.\n";
} else {
    $landing_html = file_get_contents($landing_file);
    $flen = strlen($landing_html);
    echo "Landing file length: $flen bytes\n";
    
    $stmt = $conn->prepare("UPDATE el_posts SET post_content=?, post_modified=?, post_modified_gmt=?, post_status='publish' WHERE ID=67406");
    $stmt->bind_param('sss', $landing_html, $now, $now);
    $stmt->execute();
    echo "Landing rows affected: ".$stmt->affected_rows."\n";
    $stmt->close();

    // Update RankMath meta for landing
    $seo_keys = [
        'rank_math_title' => 'Stripper en Barcelona 2026 | Shows VIP desde 180€ · Despedidas y Fiestas',
        'rank_math_description' => 'Contrata stripper en Barcelona desde 180€. Shows integrales, dúo lésbico, camarera sexy. Toda la provincia. Artistas verificadas, reserva en 2h. Más de 600 fiestas.',
        'rank_math_focus_keyword' => 'stripper barcelona,contratar stripper barcelona,stripper a domicilio barcelona,show striptease barcelona 2026,stripper despedida soltera barcelona',
        'rank_math_robots' => 'index,follow',
        'rank_math_pillar_content' => 'on',
    ];
    foreach ($seo_keys as $key => $val) {
        $check = $conn->query("SELECT meta_id FROM el_postmeta WHERE post_id=67406 AND meta_key='$key'");
        if ($check->num_rows > 0) {
            $stmt2 = $conn->prepare("UPDATE el_postmeta SET meta_value=? WHERE post_id=67406 AND meta_key=?");
            $stmt2->bind_param('ss', $val, $key);
            $stmt2->execute();
            $stmt2->close();
        } else {
            add_meta($conn, 67406, $key, $val);
        }
    }
    echo "Landing SEO meta updated\n";
}

// ─────────────────────────────────────────────
// VERIFY
// ─────────────────────────────────────────────
echo "\n=== VERIFICATION ===\n";
$r = $conn->query("SELECT p.ID, p.post_title, p.post_name, pm.meta_value AS price 
    FROM el_posts p 
    LEFT JOIN el_postmeta pm ON p.ID=pm.post_id AND pm.meta_key='_price'
    WHERE p.ID IN (".implode(',',$created_ids).")
    ORDER BY p.ID");
while($row=$r->fetch_assoc()){
    echo "  ID {$row['ID']} | {$row['post_title']} | {$row['post_name']} | {$row['price']}€\n";
}

$r2 = $conn->query("SELECT count FROM el_term_taxonomy WHERE term_taxonomy_id=1824");
$row2 = $r2->fetch_assoc();
echo "\nCAT 1824 product count: ".$row2['count']."\n";

echo "\nDone!\n";
