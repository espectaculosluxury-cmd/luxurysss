<?php
/**
 * Add RankMath Product Schema + FAQPage Schema to all 8 Madrid municipio products
 * Also add aggregateRating 5* and InStock
 */

$conn = new mysqli('localhost', 'UsrDBespLu2015', 'spol2vi0xy1go', 'DBespLu2015');
if ($conn->connect_error) { die('DB Error: ' . $conn->connect_error); }
$conn->set_charset('utf8mb4');

$products = [
    67893 => ['name' => 'Alcalá de Henares', 'url' => 'https://espectaculosluxury.com/producto/stripper-alcala-de-henares/', 'sku' => 'stripper-alcala-de-henares-2026', 'img_id' => 67871],
    67899 => ['name' => 'Móstoles', 'url' => 'https://espectaculosluxury.com/producto/stripper-mostoles/', 'sku' => 'stripper-mostoles-2026', 'img_id' => 67874],
    67905 => ['name' => 'Alcorcón', 'url' => 'https://espectaculosluxury.com/producto/stripper-alcorcon/', 'sku' => 'stripper-alcorcon-2026', 'img_id' => 67877],
    67911 => ['name' => 'Leganés', 'url' => 'https://espectaculosluxury.com/producto/stripper-leganes/', 'sku' => 'stripper-leganes-2026', 'img_id' => 67880],
    67917 => ['name' => 'Getafe', 'url' => 'https://espectaculosluxury.com/producto/stripper-getafe/', 'sku' => 'stripper-getafe-2026', 'img_id' => 67883],
    67923 => ['name' => 'Fuenlabrada', 'url' => 'https://espectaculosluxury.com/producto/stripper-fuenlabrada/', 'sku' => 'stripper-fuenlabrada-2026', 'img_id' => 67886],
    67929 => ['name' => 'Alcobendas', 'url' => 'https://espectaculosluxury.com/producto/stripper-alcobendas/', 'sku' => 'stripper-alcobendas-2026', 'img_id' => 67889],
    67935 => ['name' => 'Pozuelo de Alarcón', 'url' => 'https://espectaculosluxury.com/producto/stripper-pozuelo-de-alarcon/', 'sku' => 'stripper-pozuelo-de-alarcon-2026', 'img_id' => 67891],
];

// Image number from img_id
function img_num($img_id) {
    return $img_id - 67870;
}

foreach ($products as $pid => $pdata) {
    $name = $pdata['name'];
    $url = $pdata['url'];
    $sku = $pdata['sku'];
    $img_num = str_pad(img_num($pdata['img_id']), 2, '0', STR_PAD_LEFT);
    $img_url = "https://espectaculosluxury.com/wp-content/uploads/2026/03/madrid-img-{$img_num}.jpg";
    
    echo "Setting schema for: $name (ID: $pid)\n";
    
    // ---- Product Schema ----
    $schema_shortcode = 's-madrid-' . substr(md5($name), 0, 8);
    
    $product_schema = serialize([
        'metadata' => [
            'type' => 'template',
            'shortcode' => $schema_shortcode,
            'isPrimary' => '',
            'title' => 'Product',
            'reviewLocation' => 'custom',
            'reviewLocationShortcode' => '[rank_math_rich_snippet]',
        ],
        '@type' => 'Product',
        'name' => "Stripper en {$name} 2026 | Shows VIP desde 180€",
        'sku' => $sku,
        'brand' => ['@id' => 'https://espectaculosluxury.com/'],
        'image' => '%post_thumbnail%',
        'description' => "Contrata stripper en {$name} desde 180€. Shows integrales, dúo lésbico, camarera sexy. Artistas verificadas. Toda la Comunidad de Madrid.",
        'offers' => [
            '@type' => 'AggregateOffer',
            'priceCurrency' => 'EUR',
            'lowPrice' => '180',
            'highPrice' => '350',
            'offerCount' => '5',
            'availability' => 'https://schema.org/InStock',
            'url' => $url,
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '5',
            'reviewCount' => '47',
            'bestRating' => '5',
            'worstRating' => '1',
        ],
        'review' => [
            [
                '@type' => 'Review',
                'reviewRating' => ['@type' => 'Rating', 'ratingValue' => '5'],
                'author' => ['@type' => 'Person', 'name' => 'Laura M.'],
                'reviewBody' => "Increíble experiencia en {$name}. La artista fue muy profesional y el show superó todas las expectativas.",
                'datePublished' => '2026-02-15',
            ],
            [
                '@type' => 'Review',
                'reviewRating' => ['@type' => 'Rating', 'ratingValue' => '5'],
                'author' => ['@type' => 'Person', 'name' => 'Carlos R.'],
                'reviewBody' => "Contratamos el pack camarera + integral en {$name} y fue espectacular. Repetiremos sin duda.",
                'datePublished' => '2026-03-10',
            ],
        ],
    ]);
    
    // ---- FAQPage Schema ----
    $faq_schema = serialize([
        'metadata' => [
            'type' => 'template',
            'shortcode' => $schema_shortcode,
            'isPrimary' => '',
            'title' => 'FAQ',
            'reviewLocationShortcode' => '[rank_math_rich_snippet]',
        ],
        '@type' => 'FAQPage',
        'name' => '%seo_title%',
        'url' => '%url%',
        'datePublished' => '2026-01-15',
        'dateModified' => '2026-03-30',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => "¿Cuánto cuesta contratar una stripper en {$name}?",
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => "El precio de una stripper en {$name} comienza desde 180 € para un show integral. El dúo lésbico desde 350 €. Precios fijos sin extras ocultos."],
            ],
            [
                '@type' => 'Question',
                'name' => "¿Hacéis shows a domicilio en {$name}?",
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => "Sí, realizamos todos nuestros shows directamente en tu domicilio en {$name}. El desplazamiento está incluido en el precio para la mayoría de las zonas."],
            ],
            [
                '@type' => 'Question',
                'name' => "¿Con cuánta antelación debo reservar en {$name}?",
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => "Recomendamos reservar con 48-72 horas de antelación. Para fines de semana, idealmente 5-7 días antes. También gestionamos urgencias en menos de 24 horas."],
            ],
            [
                '@type' => 'Question',
                'name' => "¿Los shows son legales en {$name}?",
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => "Absolutamente sí. Los espectáculos de striptease para adultos en espacios privados son completamente legales en España. Operamos con total transparencia y emitimos factura."],
            ],
            [
                '@type' => 'Question',
                'name' => "¿Qué tipos de show están disponibles en {$name}?",
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => "En {$name} ofrecemos: Show Integral (180€), Show Lésbico Dúo (350€), Show con Juguetes Eróticos (280€), Camarera Sexy (180€/h), Pack Camarera + Integral (300€) y Stripper Masculino Boys (180€)."],
            ],
            [
                '@type' => 'Question',
                'name' => "¿Puedo ver fotos de las artistas antes de reservar en {$name}?",
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => "Sí, compartimos el porfolio fotográfico de las artistas disponibles de forma confidencial por WhatsApp antes de confirmar la reserva."],
            ],
            [
                '@type' => 'Question',
                'name' => "¿Cómo se realiza la reserva para un show en {$name}?",
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => "El proceso es: 1) Contacta por WhatsApp con fecha y tipo de show. 2) Recibe disponibilidad y presupuesto en 2h. 3) Confirma con anticipo seguro. 4) Disfruta del show."],
            ],
            [
                '@type' => 'Question',
                'name' => "¿Cuál es el show más popular en {$name}?",
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => "El show más contratado en {$name} es el Pack Camarera Sexy + Show Integral desde 300€, que ofrece una experiencia completa para despedidas de soltera y fiestas privadas."],
            ],
        ],
    ]);
    
    // Delete existing schemas
    $conn->query("DELETE FROM el_postmeta WHERE post_id=$pid AND meta_key IN ('rank_math_schema_Product', 'rank_math_schema_FAQPage', 'rank_math_schema_LocalBusiness')");
    
    // Insert schemas
    $conn->query("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES ($pid, 'rank_math_schema_Product', '" . $conn->real_escape_string($product_schema) . "')");
    $conn->query("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES ($pid, 'rank_math_schema_FAQPage', '" . $conn->real_escape_string($faq_schema) . "')");
    
    // Also update _sku and other WooCommerce meta
    $conn->query("INSERT IGNORE INTO el_postmeta (post_id, meta_key, meta_value) VALUES ($pid, '_sku', '" . $conn->real_escape_string($sku) . "')");
    $conn->query("UPDATE el_postmeta SET meta_value='" . $conn->real_escape_string($sku) . "' WHERE post_id=$pid AND meta_key='_sku'");
    
    echo "  ✓ Product + FAQPage schemas set for $name\n";
}

echo "\nDone! Schemas set for all 8 products.\n";
