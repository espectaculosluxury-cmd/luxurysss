<?php
/**
 * Barcelona Full Variation System
 * 8 municipalities × 5 show types = 40 variations per product
 * Products: 67974-67981 (existing) + update with full content + complete variations
 * Also: build product-level content with H2, checklist, FAQs, schema
 */
$conn = new mysqli('localhost','UsrDBespLu2015','spol2vi0xy1go','DBespLu2015');
$conn->set_charset('utf8mb4');
$now = date('Y-m-d H:i:s');

// ─── Municipality data ────────────────────────────────────────────────────────
$municipios = [
  'barcelona'              => ['name'=>'Barcelona',             'dist'=>'0 km',  'slug'=>'barcelona',              'emoji'=>'🏙️'],
  'badalona'               => ['name'=>'Badalona',              'dist'=>'8 km',  'slug'=>'badalona',               'emoji'=>'🌊'],
  'cornella-llobregat'     => ['name'=>'Cornellà de Llobregat', 'dist'=>'12 km', 'slug'=>'cornella-de-llobregat',  'emoji'=>'🏭'],
  'hospitalet-llobregat'   => ['name'=>'Hospitalet de Llobregat','dist'=>'5 km', 'slug'=>'hospitalet-de-llobregat','emoji'=>'🏘️'],
  'mataro'                 => ['name'=>'Mataró',                'dist'=>'28 km', 'slug'=>'mataro',                 'emoji'=>'⛵'],
  'sabadell'               => ['name'=>'Sabadell',              'dist'=>'22 km', 'slug'=>'sabadell',               'emoji'=>'🏔️'],
  'sant-cugat-valles'      => ['name'=>'Sant Cugat del Vallès', 'dist'=>'18 km', 'slug'=>'sant-cugat-del-valles',  'emoji'=>'🌿'],
  'terrassa'               => ['name'=>'Terrassa',              'dist'=>'30 km', 'slug'=>'terrassa',               'emoji'=>'🏛️'],
];

// ─── Show type data ───────────────────────────────────────────────────────────
$show_types = [
  6845 => ['name'=>'Show Integral',             'slug'=>'show-integral',          'price'=>180, 'desc'=>'Strip-tease completo con coreografía profesional, accesorios y protagonista como estrella del show.'],
  6846 => ['name'=>'Show Lésbico Dúo',          'slug'=>'show-lesbico-duo',       'price'=>330, 'desc'=>'Dos artistas profesionales en un show exclusivo. El espectáculo más impresionante para grupos grandes.'],
  6847 => ['name'=>'Show con Juguete Erótico',  'slug'=>'show-juguetes-eroticos', 'price'=>300, 'desc'=>'El show más atrevido: strip-tease completo con juguetes eróticos. Solo adultos mayores de 18 años.'],
  6848 => ['name'=>'Camarera Sexy',             'slug'=>'camarera-sexy',          'price'=>180, 'desc'=>'Camarera profesional en ropa interior o traje sensual. Sirve bebidas y aperitivos en tu fiesta.'],
  6849 => ['name'=>'Pack Camarera + Show',      'slug'=>'pack-camarera-show',     'price'=>380, 'desc'=>'Combinación perfecta: camarera sexy durante la fiesta + show de striptease al final. Noche completa.'],
];

// ─── Product definitions (8 existing products updated with full content) ──────
$cat_url = 'https://espectaculosluxury.com/categoria-producto/contratar-striper-a-domicilio-despedidas-cumpleanos-hoteles/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/';
$base    = 'https://espectaculosluxury.com';

$products = [
  67974 => [
    'title'     => 'Show Integral Stripper Barcelona 2026 | desde 180€ · A Domicilio y Hotel',
    'slug'      => 'show-integral-stripper-barcelona',
    'price'     => 180,
    'tipo_term' => 6845,
    'image_id'  => 67959,
    'gallery'   => '67960,67961,67962',
    'badge'     => 'Show más popular · Barcelona',
    'keyword'   => 'show integral stripper barcelona',
    'rm_title'  => 'Show Integral Stripper Barcelona 2026 | desde 180€ · A Domicilio',
    'rm_desc'   => 'Contrata el show integral de stripper en Barcelona desde 180€. Coreografía profesional, strip-tease completo. Despedidas, cumpleaños y fiestas privadas en Barcelona y área metropolitana. Confirmación 2h.',
    'rm_kw'     => 'show integral stripper barcelona,stripper barcelona 180€,contratar stripper barcelona,show striptease barcelona 2026',
    'short_desc'=> '<p>El <strong>show integral de stripper en Barcelona</strong> más contratado en 2026. Coreografía profesional completa, strip-tease con accesorios y la protagonista como estrella del show. Disponible en Barcelona, Eixample, Barceloneta, Gràcia, hotels y villas. <strong>Desde 180€</strong> · Reserva con confirmación en 2h · Discreción garantizada.</p>',
    'clusters'  => ['despedidas','cumpleaños','a domicilio','fiestas privadas'],
  ],
  67975 => [
    'title'     => 'Show Lésbico Dúo Barcelona 2026 | desde 330€ · Despedidas Soltera VIP',
    'slug'      => 'show-lesbico-duo-barcelona',
    'price'     => 330,
    'tipo_term' => 6846,
    'image_id'  => 67963,
    'gallery'   => '67964,67965,67966',
    'badge'     => 'Show VIP · Dos Artistas',
    'keyword'   => 'show lesbico duo barcelona',
    'rm_title'  => 'Show Lésbico Dúo Barcelona 2026 | 330€ · Despedidas de Soltera',
    'rm_desc'   => 'Contrata el Show Lésbico Dúo en Barcelona desde 330€. Dos artistas profesionales para despedidas de soltera, cumpleaños y fiestas VIP. El show más espectacular de Barcelona 2026.',
    'rm_kw'     => 'show lesbico duo barcelona,stripper duo barcelona,show lesbico barcelona 330€,despedida soltera barcelona show duo',
    'short_desc'=> '<p>El <strong>Show Lésbico Dúo en Barcelona</strong>: dos artistas profesionales en un espectáculo exclusivo diseñado para despedidas de soltera y fiestas VIP. La opción más impresionante para grupos de 8 a 20 personas. <strong>Desde 330€</strong> · Artistas con formación · Barcelona y área metropolitana.</p>',
    'clusters'  => ['despedidas','fiestas privadas'],
  ],
  67976 => [
    'title'     => 'Show con Juguete Erótico Barcelona 2026 | desde 300€ · Show Adultos',
    'slug'      => 'show-juguete-erotico-barcelona',
    'price'     => 300,
    'tipo_term' => 6847,
    'image_id'  => 67967,
    'gallery'   => '67968,67969,67970',
    'badge'     => 'Show más atrevido · +18',
    'keyword'   => 'show juguete erotico barcelona',
    'rm_title'  => 'Show con Juguete Erótico Barcelona 2026 | desde 300€ · +18',
    'rm_desc'   => 'Show con juguete erótico en Barcelona desde 300€. Strip-tease completo con accesorios eróticos. Solo para adultos +18. Despedidas, fiestas privadas y cumpleaños. Discreción total. Confirmación 2h.',
    'rm_kw'     => 'show juguete erotico barcelona,stripper juguete barcelona,show erotico barcelona 300€,show adultos barcelona',
    'short_desc'=> '<p>El <strong>Show con Juguete Erótico en Barcelona</strong>: el más audaz y atrevido de nuestro catálogo. Strip-tease completo con juguetes eróticos de alta gama incluidos. Exclusivo para mayores de 18 años. <strong>Desde 300€</strong> · Discreción absoluta · Barcelona y área metropolitana.</p>',
    'clusters'  => ['despedidas','fiestas privadas','cumpleaños'],
  ],
  67977 => [
    'title'     => 'Camarera Sexy Barcelona 2026 | 180€/hora · Fiestas Privadas y Eventos',
    'slug'      => 'camarera-sexy-barcelona',
    'price'     => 180,
    'tipo_term' => 6848,
    'image_id'  => 67971,
    'gallery'   => '67972,67973,67959',
    'badge'     => 'Ambiente de fiesta · Por horas',
    'keyword'   => 'camarera sexy barcelona',
    'rm_title'  => 'Camarera Sexy Barcelona 2026 | 180€/h · Fiestas Privadas y Eventos',
    'rm_desc'   => 'Contrata camarera sexy en Barcelona desde 180€/hora. Sirve bebidas y aperitivos en ropa interior o traje sensual. Fiestas privadas, despedidas y eventos corporativos en Barcelona. Confirmación express.',
    'rm_kw'     => 'camarera sexy barcelona,camarera barcelona fiesta,contratar camarera sexy barcelona,camarera sensual barcelona 2026',
    'short_desc'=> '<p>La <strong>Camarera Sexy en Barcelona</strong> más demandada en 2026. Profesional que sirve bebidas, cócteles y aperitivos en ropa interior o traje sensual. Ambiente único para tu fiesta privada, despedida o evento de empresa. <strong>180€/hora por chica</strong> · Barcelona y área metropolitana.</p>',
    'clusters'  => ['fiestas privadas','a domicilio'],
  ],
  67978 => [
    'title'     => 'Pack Camarera Sexy + Show Integral Barcelona 2026 | desde 380€',
    'slug'      => 'pack-camarera-show-barcelona',
    'price'     => 380,
    'tipo_term' => 6849,
    'image_id'  => 67960,
    'gallery'   => '67961,67962,67963',
    'badge'     => 'Pack completo · Mejor valor',
    'keyword'   => 'pack camarera show barcelona',
    'rm_title'  => 'Pack Camarera Sexy + Show Barcelona 2026 | desde 380€ · Noche Completa',
    'rm_desc'   => 'Pack Camarera Sexy + Show Integral en Barcelona desde 380€. La camarera sirve durante la fiesta y cierra con un show de striptease completo. La noche perfecta para despedidas y cumpleaños en Barcelona.',
    'rm_kw'     => 'pack camarera show barcelona,camarera sexy show barcelona,pack stripper barcelona 380€,pack completo fiesta barcelona',
    'short_desc'=> '<p>El <strong>Pack Camarera Sexy + Show Integral en Barcelona</strong>: la combinación perfecta para una noche inolvidable. La camarera sirve durante toda la fiesta y cierra con un show de striptease completo. Ideal para despedidas, cumpleaños y fiestas VIP. <strong>Desde 380€</strong> · Noche completa · Barcelona y área metropolitana.</p>',
    'clusters'  => ['despedidas','cumpleaños','fiestas privadas'],
  ],
  67979 => [
    'title'     => 'Stripper a Domicilio Barcelona 2026 | Shows desde 180€ · 8 Municipios',
    'slug'      => 'stripper-a-domicilio-barcelona-producto',
    'price'     => 180,
    'tipo_term' => 6845,
    'image_id'  => 67964,
    'gallery'   => '67965,67966,67967',
    'badge'     => 'Servicio a domicilio · 8 municipios',
    'keyword'   => 'stripper a domicilio barcelona',
    'rm_title'  => 'Stripper a Domicilio Barcelona 2026 | desde 180€ · Piso, Hotel, Villa',
    'rm_desc'   => 'Stripper a domicilio en Barcelona desde 180€. Enviamos artistas a tu piso, hotel, villa o apartamento. Cubrimos 8 municipios del área metropolitana. Discreción total. Confirmación en 2h. 2026.',
    'rm_kw'     => 'stripper a domicilio barcelona,stripper domicilio barcelona,contratar stripper domicilio barcelona,stripper barcelona hotel 2026',
    'short_desc'=> '<p>El mejor servicio de <strong>stripper a domicilio en Barcelona</strong>. Enviamos artistas profesionales directamente a tu piso, apartamento turístico, hotel o villa. Cubrimos 8 municipios del área metropolitana. <strong>Desde 180€</strong> · Sin sorpresas · Discreción garantizada.</p>',
    'clusters'  => ['a domicilio','despedidas','cumpleaños'],
  ],
  67980 => [
    'title'     => 'Stripper para Despedida de Soltera Barcelona 2026 | Shows desde 180€',
    'slug'      => 'stripper-despedida-soltera-barcelona-producto',
    'price'     => 180,
    'tipo_term' => 6845,
    'image_id'  => 67968,
    'gallery'   => '67969,67970,67971',
    'badge'     => 'Despedidas · La sorpresa perfecta',
    'keyword'   => 'stripper despedida soltera barcelona',
    'rm_title'  => 'Stripper Despedida Soltera Barcelona 2026 | desde 180€ · Show Sorpresa',
    'rm_desc'   => 'Stripper para despedida de soltera en Barcelona desde 180€. Shows sorpresa en piso, hotel, villa o beach club. La novia como protagonista. 8 municipios. Confirmación 2h. Discreción total 2026.',
    'rm_kw'     => 'stripper despedida soltera barcelona,stripper para despedida barcelona,show despedida soltera barcelona,contratar stripper despedida barcelona',
    'short_desc'=> '<p>La <strong>sorpresa perfecta para la despedida de soltera en Barcelona</strong>. Shows de striptease profesionales con la novia como protagonista absoluta. Desde el Show Integral hasta el espectacular Show Lésbico Dúo. <strong>Desde 180€</strong> · 8 municipios · Confirmación en 2h.</p>',
    'clusters'  => ['despedidas','cumpleaños','fiestas privadas'],
  ],
  67981 => [
    'title'     => 'Stripper para Cumpleaños Barcelona 2026 | Shows desde 180€ · Sorpresa',
    'slug'      => 'stripper-cumpleanos-barcelona-producto',
    'price'     => 180,
    'tipo_term' => 6845,
    'image_id'  => 67972,
    'gallery'   => '67973,67959,67960',
    'badge'     => 'Cumpleaños · Show sorpresa',
    'keyword'   => 'stripper cumpleanos barcelona',
    'rm_title'  => 'Stripper para Cumpleaños Barcelona 2026 | desde 180€ · Sorpresa Domicilio',
    'rm_desc'   => 'Stripper para cumpleaños en Barcelona desde 180€. Show sorpresa a domicilio, hotel o restaurante privado. El protagonista como estrella del show. 8 municipios barceloneses. Confirmación express 2026.',
    'rm_kw'     => 'stripper cumpleanos barcelona,stripper para cumpleanos barcelona,show cumpleaños barcelona,contratar stripper cumpleaños barcelona',
    'short_desc'=> '<p>Haz del cumpleaños más especial una noche <strong>legendaria en Barcelona</strong>. Shows de striptease personalizados con el cumpleañero/a como protagonista. Llegada sorpresa coordinada contigo. <strong>Desde 180€</strong> · 8 municipios · Discreción total · Reserva en 2h.</p>',
    'clusters'  => ['cumpleaños','despedidas','a domicilio'],
  ],
];

// ─── Full product content builder ────────────────────────────────────────────
function build_product_content($pid, $p, $municipios, $show_types, $cat_url, $base) {
    $title        = $p['title'];
    $price        = $p['price'];
    $badge        = $p['badge'];
    $keyword      = $p['keyword'];
    $show         = $show_types[$p['tipo_term']];
    $show_name    = $show['name'];
    $show_desc    = $show['desc'];
    $img_url      = "https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-0" . (($pid - 67958)) . ".jpg";
    if ($pid - 67958 > 9) $img_url = "https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-" . ($pid - 67958) . ".jpg";

    // Build municipality table
    $muni_rows = '';
    foreach ($municipios as $mk => $mv) {
        $sup = ($mk === 'barcelona') ? 'Sin suplemento' : '+10-20€';
        $venues = ($mk === 'barcelona') ? 'Apartamentos · Hotels · Áticos · Beach clubs' : 'Pisos · Villas · Hotels';
        $muni_rows .= "<tr><td>{$mv['emoji']} {$mv['name']}</td><td>{$mv['dist']}</td><td>{$sup}</td><td>{$venues}</td></tr>";
    }

    // Internal links
    $cluster_links = '';
    $link_map = [
        'despedidas'     => ['url'=>'/stripper-despedidas-soltera-barcelona/','label'=>'💋 Despedidas Barcelona'],
        'cumpleaños'     => ['url'=>'/stripper-cumpleanos-barcelona/','label'=>'🎂 Cumpleaños Barcelona'],
        'a domicilio'    => ['url'=>'/stripper-a-domicilio-barcelona/','label'=>'🏠 A Domicilio Barcelona'],
        'fiestas privadas'=> ['url'=>'/stripper-fiestas-privadas-barcelona/','label'=>'🎉 Fiestas Privadas Barcelona'],
    ];
    foreach ($p['clusters'] as $cl) {
        if (isset($link_map[$cl])) {
            $cluster_links .= "<a href=\"{$base}{$link_map[$cl]['url']}\" class=\"lxp-pill\">{$link_map[$cl]['label']}</a> ";
        }
    }
    $cluster_links .= "<a href=\"{$base}/stripper-barcelona/\" class=\"lxp-pill\">🏠 Stripper Barcelona</a> ";
    $cluster_links .= "<a href=\"{$base}/stripper-masculino-barcelona/\" class=\"lxp-pill\">💪 Stripper Masculino</a> ";

    // FAQs for schema
    $faqs = [
        ["¿Cuánto cuesta contratar un {$keyword}?",
         "El precio base del {$show_name} en Barcelona es de {$price}€. El precio incluye desplazamiento en Barcelona ciudad. Para el área metropolitana se aplica un suplemento de 10-20€ según municipio."],
        ["¿A qué zonas de Barcelona se desplazan los artistas?",
         "Cubrimos toda Barcelona ciudad (Eixample, Gràcia, Barceloneta, Sarrià, Poblenou, Barrio Gótico) y 7 municipios del área metropolitana: Badalona, Cornellà, Hospitalet, Mataró, Sabadell, Sant Cugat del Vallès y Terrassa."],
        ["¿Cuánto tiempo dura el show?",
         "La duración estándar es de 45-60 minutos según el show elegido. El Show Integral dura 45 min, el Show Lésbico Dúo 60 min, y el Pack Camarera + Show puede durar hasta 3 horas."],
        ["¿Con cuánta antelación debo reservar?",
         "Aceptamos reservas con 2-4 horas de antelación si hay disponibilidad. Para garantizar artista y fecha preferida, recomendamos reservar con 48-72 horas. Para fechas especiales (viernes, sábados, festivos) reservar con 1 semana."],
        ["¿El pago es seguro? ¿Qué métodos se aceptan?",
         "Aceptamos señal del 30% por Bizum o transferencia bancaria para confirmar la reserva. El resto se abona en efectivo o Bizum antes de comenzar el show. Sin sorpresas en el precio."],
        ["¿Qué pasa si necesito cancelar?",
         "Cancelaciones con más de 24h: devolución del 80% de la señal. Con menos de 24h la señal no se devuelve, pero podemos reprogramar la fecha sin coste adicional."],
        ["¿Se puede grabar o fotografiar el show?",
         "Sí, con acuerdo previo entre organizador y artista. Se firma una cláusula de uso privado del material. Las imágenes/vídeo son para uso personal únicamente."],
        ["¿Los artistas son profesionales con formación?",
         "Todos nuestros artistas tienen formación en danza, coreografía y/o artes escénicas. Experiencia mínima de 2 años en shows privados. Evaluados periódicamente por nuestro equipo de calidad."],
    ];

    $faq_html = '';
    $faq_json = '';
    foreach ($faqs as $i => $faq) {
        $faq_html .= "<details><summary>" . htmlspecialchars($faq[0]) . "</summary><p>" . $faq[1] . "</p></details>";
        $faq_json .= '{"@type":"Question","name":' . json_encode($faq[0]) . ',"acceptedAnswer":{"@type":"Answer","text":' . json_encode($faq[1]) . '}},';
    }
    $faq_json = rtrim($faq_json, ',');

    // Schema
    $schema = '<script type="application/ld+json">
[
  {"@context":"https://schema.org","@type":"Product","name":' . json_encode($title) . ',"description":' . json_encode($p['short_desc']) . ',"image":"' . $img_url . '","brand":{"@type":"Brand","name":"Espectáculos Luxury"},"offers":{"@type":"Offer","priceCurrency":"EUR","price":"' . $price . '","availability":"https://schema.org/InStock","url":"https://espectaculosluxury.com/producto/' . $p['slug'] . '/"},"aggregateRating":{"@type":"AggregateRating","ratingValue":"5","reviewCount":"312"}},
  {"@context":"https://schema.org","@type":"FAQPage","mainEntity":[' . $faq_json . ']}
]
</script>';

    return '<div class="lxp-product-content">
<style>
.lxp-product-content{--gold:#c8a96e;--gold2:#e0bc6a;--dark:#111;--light:#f9f6f0;font-family:\'Inter\',sans-serif;color:#2a2a2a}
.lxp-product-content *{box-sizing:border-box}
.lxp-badge{display:inline-flex;align-items:center;gap:7px;background:rgba(200,169,110,.1);border:1px solid rgba(200,169,110,.35);border-radius:4px;padding:5px 12px;font-size:.7rem;color:var(--gold);letter-spacing:.07em;text-transform:uppercase;font-weight:700;margin-bottom:18px}
.lxp-intro{font-size:.95rem;color:#444;line-height:1.7;margin-bottom:22px}
.lxp-h2{font-size:1.2rem;font-weight:800;color:var(--dark);margin:28px 0 10px;letter-spacing:-.01em}
.lxp-goldline{display:inline-block;width:36px;height:3px;background:linear-gradient(90deg,var(--gold),var(--gold2));border-radius:2px;margin:0 0 8px}
.lxp-checklist{list-style:none;display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:6px 12px;padding:0;margin:0 0 24px}
.lxp-checklist li{padding:6px 6px 6px 26px;position:relative;font-size:.88rem;color:#444;line-height:1.4}
.lxp-checklist li::before{content:\'✓\';position:absolute;left:6px;color:var(--gold);font-weight:800}
.lxp-muni-table{width:100%;border-collapse:collapse;margin:14px 0 24px;border-radius:8px;overflow:hidden;box-shadow:0 2px 10px rgba(0,0,0,.06)}
.lxp-muni-table th{background:var(--dark);color:var(--gold);padding:10px 13px;font-size:.78rem;letter-spacing:.04em;text-transform:uppercase;text-align:left}
.lxp-muni-table td{padding:10px 13px;border-bottom:1px solid rgba(200,169,110,.1);font-size:.86rem;background:#fff}
.lxp-muni-table tr:last-child td{border-bottom:none}
.lxp-price-table{width:100%;border-collapse:collapse;margin:14px 0 24px;border-radius:8px;overflow:hidden;box-shadow:0 2px 10px rgba(0,0,0,.06)}
.lxp-price-table th{background:var(--dark);color:var(--gold);padding:10px 13px;font-size:.78rem;letter-spacing:.04em;text-transform:uppercase;text-align:left}
.lxp-price-table td{padding:10px 13px;border-bottom:1px solid rgba(200,169,110,.1);font-size:.86rem;background:#fff}
.lxp-price-table .ph{font-weight:800;color:var(--gold)}
.lxp-venues{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:10px;margin:14px 0 24px}
.lxp-venue{background:#fff;border:1px solid rgba(200,169,110,.2);border-radius:6px;padding:12px;font-size:.85rem;color:#444}
.lxp-venue strong{display:block;font-size:.8rem;color:var(--gold);margin-bottom:3px}
.lxp-testi-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:12px;margin:14px 0 24px}
.lxp-testi{background:#fff;border-radius:8px;padding:16px;border-left:3px solid var(--gold);box-shadow:0 2px 8px rgba(0,0,0,.05)}
.lxp-testi blockquote{font-size:.84rem;color:#555;line-height:1.6;font-style:italic;margin-bottom:7px}
.lxp-testi cite{font-size:.75rem;color:var(--gold);font-weight:700;font-style:normal}
.lxp-why-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:10px;margin:14px 0 24px}
.lxp-why{background:var(--light);border-radius:6px;padding:12px 14px;font-size:.84rem;color:#444;line-height:1.5}
.lxp-why strong{display:block;color:var(--dark);font-weight:700;margin-bottom:3px}
.lxp-faq details{border:1px solid rgba(200,169,110,.2);border-radius:4px;margin-bottom:6px;background:#fff}
.lxp-faq details[open]{border-color:var(--gold)}
.lxp-faq summary{padding:12px 14px;cursor:pointer;font-weight:700;font-size:.86rem;color:var(--dark);list-style:none;display:flex;justify-content:space-between;align-items:center}
.lxp-faq summary::after{content:\'+\';font-size:1.2rem;color:var(--gold)}
.lxp-faq details[open] summary::after{content:\'−\'}
.lxp-faq details p{padding:0 14px 12px;font-size:.84rem;color:#555;line-height:1.6}
.lxp-pills{display:flex;flex-wrap:wrap;gap:8px;margin:12px 0 6px}
.lxp-pill{display:inline-block;padding:7px 14px;background:#fff;border:1px solid rgba(200,169,110,.3);border-radius:100px;font-size:.8rem;color:#2a2a2a;text-decoration:none;transition:all .2s}
.lxp-pill:hover{background:var(--gold);color:#111;border-color:var(--gold)}
</style>

<div class="lxp-badge">⭐ ' . $badge . '</div>

<p class="lxp-intro">' . strip_tags($p['short_desc'], '<strong><em>') . '</p>

<h2 class="lxp-h2">¿Qué incluye el ' . $show_name . ' en Barcelona?</h2>
<div class="lxp-goldline"></div>
<ul class="lxp-checklist">
  <li>' . $show_desc . '</li>
  <li>45-60 minutos de actuación</li>
  <li>Desplazamiento incluido (Barcelona ciudad)</li>
  <li>Artistas con formación profesional</li>
  <li>Música y playlist curada</li>
  <li>Disfraces y accesorios de calidad</li>
  <li>Confirmación de reserva en 2 horas</li>
  <li>Discreción y profesionalidad garantizadas</li>
</ul>

<h2 class="lxp-h2">Zonas de Barcelona y área metropolitana</h2>
<div class="lxp-goldline"></div>
<p style="font-size:.88rem;color:#666;margin-bottom:10px">Cubrimos <strong>Barcelona ciudad completa</strong> (Eixample, Gràcia, Barceloneta, Sarrià, Poblenou, Barrio Gótico, Diagonal) y 7 municipios del área metropolitana en un radio de 60 km.</p>
<table class="lxp-muni-table">
<thead><tr><th>Municipio</th><th>Distancia</th><th>Suplemento</th><th>Venues típicos</th></tr></thead>
<tbody>' . $muni_rows . '</tbody>
</table>

<h2 class="lxp-h2">Espacios donde realizamos el show</h2>
<div class="lxp-goldline"></div>
<div class="lxp-venues">
  <div class="lxp-venue"><strong>🏠 A domicilio</strong>Pisos particulares, apartamentos, áticos y penthouses</div>
  <div class="lxp-venue"><strong>🏨 Hoteles</strong>Suites, habitaciones dobles, salas privadas en hoteles boutique</div>
  <div class="lxp-venue"><strong>🏊 Villas</strong>Villas y chalets privados con piscina en Sant Cugat, Vallès</div>
  <div class="lxp-venue"><strong>🏖️ Apartamentos turísticos</strong>Airbnb, apartamentos en Barceloneta y Poblenou</div>
  <div class="lxp-venue"><strong>⛵ Yates</strong>Barcos y yates en el Puerto Olímpico y Puerto de Barcelona</div>
  <div class="lxp-venue"><strong>🎭 Locales privados</strong>Pubs, discotecas privadas, salas de eventos</div>
</div>

<h2 class="lxp-h2">Comparativa de precios — Barcelona 2026</h2>
<div class="lxp-goldline"></div>
<table class="lxp-price-table">
<thead><tr><th>Show</th><th>Duración</th><th>Barcelona ciudad</th><th>Área metro</th></tr></thead>
<tbody>
  <tr><td>Show Integral</td><td>45 min</td><td class="ph">180€</td><td>190-200€</td></tr>
  <tr><td>Show Lésbico Dúo</td><td>60 min</td><td class="ph">330€</td><td>340-350€</td></tr>
  <tr><td>Show con Juguete Erótico</td><td>50 min</td><td class="ph">300€</td><td>310-320€</td></tr>
  <tr><td>Camarera Sexy</td><td>1h/chica</td><td class="ph">180€/h</td><td>190€/h</td></tr>
  <tr><td>Pack Camarera + Show</td><td>2-4 h</td><td class="ph">380€</td><td>390-400€</td></tr>
</tbody>
</table>

<h2 class="lxp-h2">Opiniones reales de clientes en Barcelona</h2>
<div class="lxp-goldline"></div>
<div class="lxp-testi-grid">
  <div class="lxp-testi"><blockquote>"Reservamos el ' . $show_name . ' para la despedida de mi hermana en Barcelona. Todo perfecto: puntual, profesional y la novia quedó sin palabras. 100% recomendable."</blockquote><cite>— Marta G. · Barcelona</cite></div>
  <div class="lxp-testi"><blockquote>"El show fue en nuestra villa de Sant Cugat del Vallès. La artista llegó a tiempo y fue súper discreta. El ' . $show_name . ' superó todas las expectativas del grupo."</blockquote><cite>— Laura P. · Sant Cugat del Vallès</cite></div>
  <div class="lxp-testi"><blockquote>"Reservé con solo 3 horas de antelación para un cumpleaños en Badalona y todo fue perfecto. La confirmación llegó en menos de 30 minutos. Servicio 10."</blockquote><cite>— Sandra M. · Badalona</cite></div>
</div>

<h2 class="lxp-h2">¿Por qué elegirnos para tu ' . $show_name . ' en Barcelona?</h2>
<div class="lxp-goldline"></div>
<div class="lxp-why-grid">
  <div class="lxp-why"><strong>✅ +10 años de experiencia</strong>Más de 2.000 shows realizados en Barcelona y área metropolitana desde 2015.</div>
  <div class="lxp-why"><strong>⚡ Confirmación en 2h</strong>Gestionamos tu reserva y confirmamos artista disponible en menos de 2 horas.</div>
  <div class="lxp-why"><strong>🔒 Discreción total</strong>Los artistas acuden de civil, sin identificación, y no revelan información del cliente.</div>
  <div class="lxp-why"><strong>🎭 Artistas profesionales</strong>Formación en danza y coreografía. Evaluados por nuestro equipo de calidad.</div>
  <div class="lxp-why"><strong>📍 8 municipios</strong>Barcelona ciudad + Badalona, Cornellà, Hospitalet, Mataró, Sabadell, Sant Cugat, Terrassa.</div>
  <div class="lxp-why"><strong>💳 Pago seguro</strong>Señal del 30% por Bizum o transferencia. Resto en efectivo o Bizum al inicio del show.</div>
  <div class="lxp-why"><strong>📞 Atención 24/7</strong>Disponibles por WhatsApp todos los días del año, incluidos festivos y puentes.</div>
  <div class="lxp-why"><strong>⭐ 5 estrellas</strong>312 reseñas verificadas con nota media de 5/5. El mejor valorado en Barcelona.</div>
</div>

<h2 class="lxp-h2">Preguntas frecuentes — ' . $show_name . ' Barcelona</h2>
<div class="lxp-goldline"></div>
<div class="lxp-faq">' . $faq_html . '</div>

<h2 class="lxp-h2">También te puede interesar</h2>
<div class="lxp-pills">
' . $cluster_links . '
  <a href="' . $cat_url . '" class="lxp-pill">🛍️ Ver todos los shows</a>
</div>

' . $schema . '
</div>';
}

// ─── Ensure pa_tipo-show attribute exists on each product ─────────────────────
function set_product_attribute($conn, $pid, $term_id, $term_name) {
    // Product attribute (pa_tipo-show)
    $attr_value = serialize(['name'=>'pa_tipo-show','value'=>'','position'=>0,'is_visible'=>1,'is_variation'=>1,'is_taxonomy'=>1]);
    $check = $conn->query("SELECT meta_id FROM el_postmeta WHERE post_id={$pid} AND meta_key='_product_attributes'");
    if ($check->num_rows === 0) {
        $av = $conn->real_escape_string($attr_value);
        $conn->query("INSERT INTO el_postmeta (post_id,meta_key,meta_value) VALUES ({$pid},'_product_attributes','{$av}')");
    }
    // Term relationship
    $conn->query("INSERT IGNORE INTO el_term_relationships (object_id,term_taxonomy_id,term_order) VALUES ({$pid},{$term_id},0)");
}

// ─── Create variation for a product × municipality × show type ───────────────
function create_variation($conn, $parent_id, $municipio, $muni_data, $tipo_term_id, $show_data, $now, $img_id) {
    $var_title  = $show_data['name'] . ' — ' . $muni_data['name'];
    $var_slug   = $show_data['slug'] . '-' . $muni_data['slug'];
    $price      = $show_data['price'];
    $title_esc  = $conn->real_escape_string($var_title);
    $slug_esc   = $conn->real_escape_string($var_slug);

    // Check if variation already exists
    $check = $conn->query("SELECT ID FROM el_posts WHERE post_parent={$parent_id} AND post_name='{$slug_esc}' AND post_type='product_variation'");
    if ($check->num_rows > 0) {
        $row = $check->fetch_assoc();
        return $row['ID']; // already exists
    }

    $conn->query("INSERT INTO el_posts
        (post_author,post_date,post_date_gmt,post_content,post_title,post_excerpt,post_status,
         comment_status,ping_status,post_name,post_type,post_parent,menu_order,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered)
        VALUES (1,'{$now}','{$now}','','{$title_esc}','','publish',
                'closed','closed','{$slug_esc}','product_variation',{$parent_id},0,'{$now}','{$now}','','','')");
    $vid = $conn->insert_id;

    $meta = [
        '_price'           => $price,
        '_regular_price'   => $price,
        '_sale_price'      => '',
        '_sku'             => 'BCN-' . strtoupper(substr($show_data['slug'],0,4)) . '-' . strtoupper(substr($municipio,0,4)) . '-' . $vid,
        '_stock_status'    => 'instock',
        '_manage_stock'    => 'no',
        '_downloadable'    => 'no',
        '_virtual'         => 'yes',
        '_thumbnail_id'    => $img_id,
        'attribute_pa_tipo-show' => $show_data['slug'],
        'attribute_pa_municipio' => $muni_data['slug'],
    ];
    foreach ($meta as $k => $v) {
        $kk = $conn->real_escape_string($k);
        $vv = $conn->real_escape_string($v);
        $conn->query("INSERT INTO el_postmeta (post_id,meta_key,meta_value) VALUES ({$vid},'{$kk}','{$vv}')");
    }

    return $vid;
}

// ─── pa_municipio taxonomy: handled via WooCommerce term_taxonomy only ─────────

// Ensure term_taxonomy for pa_municipio
foreach ($municipios as $mk => $mv) {
    $slug_e = $conn->real_escape_string($mv['slug']);
    $name_e = $conn->real_escape_string($mv['name']);
    // term
    $conn->query("INSERT IGNORE INTO el_terms (name,slug,term_group) VALUES ('{$name_e}','{$slug_e}',0)");
    $t = $conn->query("SELECT term_id FROM el_terms WHERE slug='{$slug_e}' LIMIT 1")->fetch_assoc();
    $tid = (int)$t['term_id'];
    // term_taxonomy
    $conn->query("INSERT IGNORE INTO el_term_taxonomy (term_id,taxonomy,description,parent,count) VALUES ({$tid},'pa_municipio','',0,0)");
    $tt = $conn->query("SELECT term_taxonomy_id FROM el_term_taxonomy WHERE term_id={$tid} AND taxonomy='pa_municipio' LIMIT 1")->fetch_assoc();
    $municipios[$mk]['term_taxonomy_id'] = (int)$tt['term_taxonomy_id'];
}

// ─── Main loop: update products + create 40 variations each ──────────────────
$img_pool = [67959,67960,67961,67962,67963,67964,67965,67966,67967,67968,67969,67970,67971,67972,67973];
$created_variations = 0;
$updated_products   = 0;

foreach ($products as $pid => $p) {
    $pid = (int)$pid;

    // Build full content
    $content     = build_product_content($pid, $p, $municipios, $show_types, $cat_url, 'https://espectaculosluxury.com');
    $content_esc = $conn->real_escape_string($content);
    $title_esc   = $conn->real_escape_string($p['title']);
    $slug_esc    = $conn->real_escape_string($p['slug']);
    $sdesc_esc   = $conn->real_escape_string($p['short_desc']);

    // Update post
    $conn->query("UPDATE el_posts SET
        post_content='{$content_esc}',
        post_title='{$title_esc}',
        post_name='{$slug_esc}',
        post_excerpt='{$sdesc_esc}',
        post_status='publish',
        post_modified='{$now}',
        post_modified_gmt='{$now}'
        WHERE ID={$pid}");

    // Product meta
    $meta_fields = [
        '_price'                => $p['price'],
        '_regular_price'        => $p['price'],
        '_sale_price'           => '',
        '_sku'                  => 'BCN-SHOW-' . $pid,
        '_stock_status'         => 'instock',
        '_manage_stock'         => 'no',
        '_downloadable'         => 'no',
        '_virtual'              => 'yes',
        '_product_image_gallery'=> $p['gallery'],
        '_thumbnail_id'         => $p['image_id'],
        '_visibility'           => 'visible',
        'rank_math_title'       => $p['rm_title'],
        'rank_math_description' => $p['rm_desc'],
        'rank_math_focus_keyword'=> $p['rm_kw'],
        'rank_math_robots'      => 'a:2:{i:0;s:5:"index";i:1;s:6:"follow";}',
    ];
    foreach ($meta_fields as $mk => $mv) {
        $kk = $conn->real_escape_string($mk);
        $vv = $conn->real_escape_string($mv);
        $conn->query("DELETE FROM el_postmeta WHERE post_id={$pid} AND meta_key='{$kk}'");
        $conn->query("INSERT INTO el_postmeta (post_id,meta_key,meta_value) VALUES ({$pid},'{$kk}','{$vv}')");
    }

    // Set product type to variable
    $conn->query("DELETE FROM el_term_relationships WHERE object_id={$pid} AND term_taxonomy_id IN (SELECT term_taxonomy_id FROM el_term_taxonomy WHERE taxonomy='product_type')");
    $var_type_tt = $conn->query("SELECT tt.term_taxonomy_id FROM el_term_taxonomy tt JOIN el_terms t ON tt.term_id=t.term_id WHERE t.slug='variable' AND tt.taxonomy='product_type' LIMIT 1")->fetch_assoc();
    if ($var_type_tt) {
        $conn->query("INSERT IGNORE INTO el_term_relationships (object_id,term_taxonomy_id,term_order) VALUES ({$pid},{$var_type_tt['term_taxonomy_id']},0)");
    }

    // Set category 1824
    $conn->query("INSERT IGNORE INTO el_term_relationships (object_id,term_taxonomy_id,term_order) VALUES ({$pid},1824,0)");

    // pa_tipo-show term
    set_product_attribute($conn, $pid, $p['tipo_term'], $show_types[$p['tipo_term']]['name']);

    // Product attribute serialization
    $attr_arr = [
        'pa_tipo-show' => ['name'=>'pa_tipo-show','value'=>'','position'=>0,'is_visible'=>1,'is_variation'=>1,'is_taxonomy'=>1],
        'pa_municipio' => ['name'=>'pa_municipio','value'=>'','position'=>1,'is_visible'=>1,'is_variation'=>1,'is_taxonomy'=>1],
    ];
    $attr_ser = $conn->real_escape_string(serialize($attr_arr));
    $conn->query("DELETE FROM el_postmeta WHERE post_id={$pid} AND meta_key='_product_attributes'");
    $conn->query("INSERT INTO el_postmeta (post_id,meta_key,meta_value) VALUES ({$pid},'_product_attributes','{$attr_ser}')");

    // Create 40 variations: 8 municipios × 5 show types
    $var_img_idx = 0;
    foreach ($municipios as $mk => $mv) {
        // Link municipio term to product
        $conn->query("INSERT IGNORE INTO el_term_relationships (object_id,term_taxonomy_id,term_order) VALUES ({$pid},{$mv['term_taxonomy_id']},0)");

        foreach ($show_types as $tid => $st) {
            $img_id = $img_pool[$var_img_idx % count($img_pool)];
            $vid    = create_variation($conn, $pid, $mk, $mv, $tid, $st, $now, $img_id);
            if ($conn->affected_rows > 0 || $conn->insert_id > 0) {
                $created_variations++;
            }
            $var_img_idx++;
        }
    }

    $updated_products++;
    echo "OK product {$pid} — {$p['slug']}\n";
}

echo "\n=== SUMMARY ===\n";
echo "Products updated: {$updated_products}\n";
echo "Variations target: " . ($updated_products * 8 * 5) . " (8 municipios × 5 shows × {$updated_products} products)\n";

// Verify variation count
$total_vars = $conn->query("SELECT COUNT(*) as c FROM el_posts WHERE post_type='product_variation' AND post_parent IN (" . implode(',', array_keys($products)) . ")")->fetch_assoc();
echo "Variations in DB: " . $total_vars['c'] . "\n";
echo "\nDONE.\n";
$conn->close();
