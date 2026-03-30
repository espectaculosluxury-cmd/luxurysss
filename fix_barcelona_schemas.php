<?php
/**
 * FIX_BARCELONA_SCHEMAS.PHP
 * 1. Inserts/updates RankMath Event schema for Barcelona landing (67406)
 * 2. Inserts/updates RankMath LocalBusiness schema for Barcelona landing
 * 3. Sets product schemas for all 8 new Barcelona products
 * 4. Flushes WP transients and object cache
 */

$conn = new mysqli('localhost','UsrDBespLu2015','spol2vi0xy1go','DBespLu2015');
$conn->set_charset('utf8mb4');
if ($conn->connect_error) { die("DB ERROR: ".$conn->connect_error."\n"); }
echo "DB connected OK\n";

// ─────────────────────────────────────────────
// 1. EVENT SCHEMA for /stripper-barcelona/ (67406)
// ─────────────────────────────────────────────
$event_schema = [
    '@context' => 'https://schema.org',
    '@type'    => 'Event',
    '@id'      => 'https://espectaculosluxury.com/stripper-barcelona/#event',
    'name'     => 'Show de Stripper en Barcelona 2026 — Espectáculos Luxury',
    'description' => 'Contrata un show de striptease profesional en Barcelona para despedidas de soltera, cumpleaños y fiestas privadas. Artistas verificados a domicilio en toda la provincia de Barcelona y el área metropolitana.',
    'url'      => 'https://espectaculosluxury.com/stripper-barcelona/',
    'startDate' => '2026-01-01',
    'endDate'   => '2026-12-31',
    'eventStatus' => 'https://schema.org/EventScheduled',
    'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
    'image' => [
        'https://espectaculosluxury.com/wp-content/uploads/2026/03/OFERTA-STRIPPER-EN-BARCELONA-1.jpg',
        'https://espectaculosluxury.com/wp-content/uploads/2026/03/OFERTA-STRIPPER-EN-BARCELONA.jpg',
        'https://espectaculosluxury.com/wp-content/uploads/2026/03/barcelona-park-guell.jpg',
    ],
    'location' => [
        '@type' => 'Place',
        'name'  => 'A domicilio en Barcelona y área metropolitana',
        'address' => [
            '@type'           => 'PostalAddress',
            'addressLocality' => 'Barcelona',
            'addressRegion'   => 'Cataluña',
            'postalCode'      => '08001',
            'addressCountry'  => 'ES',
        ],
    ],
    'performer' => [
        '@type' => 'PerformingGroup',
        'name'  => 'Artistas de Espectáculos Luxury',
        'url'   => 'https://espectaculosluxury.com/',
    ],
    'organizer' => [
        '@type'     => 'Organization',
        '@id'       => 'https://espectaculosluxury.com/#organization',
        'name'      => 'Espectáculos Luxury',
        'url'       => 'https://espectaculosluxury.com/',
        'telephone' => '+34695858978',
    ],
    'offers' => [
        [
            '@type'         => 'Offer',
            'name'          => 'Show Integral',
            'price'         => '180',
            'priceCurrency' => 'EUR',
            'availability'  => 'https://schema.org/InStock',
            'validFrom'     => '2026-01-01',
            'url'           => 'https://espectaculosluxury.com/stripper-barcelona/',
        ],
        [
            '@type'         => 'Offer',
            'name'          => 'Show Lésbico Dúo',
            'price'         => '350',
            'priceCurrency' => 'EUR',
            'availability'  => 'https://schema.org/InStock',
            'validFrom'     => '2026-01-01',
            'url'           => 'https://espectaculosluxury.com/stripper-barcelona/',
        ],
        [
            '@type'         => 'Offer',
            'name'          => 'Show con Juguete Erótico',
            'price'         => '280',
            'priceCurrency' => 'EUR',
            'availability'  => 'https://schema.org/InStock',
            'validFrom'     => '2026-01-01',
            'url'           => 'https://espectaculosluxury.com/stripper-barcelona/',
        ],
        [
            '@type'         => 'Offer',
            'name'          => 'Pack Camarera + Show',
            'price'         => '300',
            'priceCurrency' => 'EUR',
            'availability'  => 'https://schema.org/InStock',
            'validFrom'     => '2026-01-01',
            'url'           => 'https://espectaculosluxury.com/stripper-barcelona/',
        ],
    ],
];

// ─────────────────────────────────────────────
// 2. LOCAL BUSINESS SCHEMA for /stripper-barcelona/
// ─────────────────────────────────────────────
$localbiz_schema = [
    '@context'    => 'https://schema.org',
    '@type'       => 'LocalBusiness',
    '@id'         => 'https://espectaculosluxury.com/#organization-barcelona',
    'name'        => 'Espectáculos Luxury — Stripper en Barcelona',
    'url'         => 'https://espectaculosluxury.com/stripper-barcelona/',
    'telephone'   => '+34695858978',
    'priceRange'  => '€€',
    'description' => 'Agencia de shows de striptease profesionales en Barcelona. Más de 1.200 shows realizados. Artistas verificados, reserva en 2h, discreción total.',
    'image'       => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/OFERTA-STRIPPER-EN-BARCELONA-1.jpg',
    'areaServed'  => [
        'Barcelona', 'L\'Hospitalet de Llobregat', 'Badalona', 'Terrassa',
        'Sabadell', 'Mataró', 'Sitges', 'Sant Cugat del Vallès', 'Cornellà de Llobregat',
    ],
    'address' => [
        '@type'           => 'PostalAddress',
        'addressLocality' => 'Barcelona',
        'addressRegion'   => 'Cataluña',
        'addressCountry'  => 'ES',
    ],
    'openingHoursSpecification' => [
        [
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'],
            'opens'     => '10:00',
            'closes'    => '02:00',
        ],
    ],
    'sameAs' => [
        'https://espectaculosluxury.com/',
    ],
];

// ─────────────────────────────────────────────
// SERIALIZE FOR RANKMATH
// Format: a:N:{s:key_len:"key";a:M:{...}}
// RankMath stores each schema as a serialized PHP array with specific keys
// ─────────────────────────────────────────────
function build_rankmath_schema($schema_data, $schema_id) {
    // RankMath schema format: ['@type' => ..., 'metadata' => [...], ...]
    $rm_schema = [
        '@context' => 'https://schema.org',
        '@type'    => $schema_data['@type'],
        'metadata' => [
            'title'    => $schema_data['@type'],
            'type'     => 'template',
            'shortcode'=> '',
        ],
    ];
    foreach ($schema_data as $k => $v) {
        if ($k !== '@context') $rm_schema[$k] = $v;
    }
    return serialize($rm_schema);
}

// ─────────────────────────────────────────────
// UPSERT RANKMATH META
// ─────────────────────────────────────────────
function upsert_meta($conn, $post_id, $meta_key, $meta_value) {
    $check = $conn->query("SELECT meta_id FROM el_postmeta WHERE post_id=$post_id AND meta_key='".$conn->real_escape_string($meta_key)."'");
    if ($check->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE el_postmeta SET meta_value=? WHERE post_id=? AND meta_key=?");
        $stmt->bind_param('sis', $meta_value, $post_id, $meta_key);
        $stmt->execute();
        $stmt->close();
        return 'updated';
    } else {
        $stmt = $conn->prepare("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $post_id, $meta_key, $meta_value);
        $stmt->execute();
        $stmt->close();
        return 'inserted';
    }
}

// INSERT EVENT SCHEMA
$event_serialized = build_rankmath_schema($event_schema, 'event_bcn');
$r1 = upsert_meta($conn, 67406, 'rank_math_schema_Event', $event_serialized);
echo "Event schema: $r1\n";

// INSERT LOCALBIZ SCHEMA
$localbiz_serialized = build_rankmath_schema($localbiz_schema, 'localbiz_bcn');
$r2 = upsert_meta($conn, 67406, 'rank_math_schema_LocalBusiness', $localbiz_serialized);
echo "LocalBusiness schema: $r2\n";

// ─────────────────────────────────────────────
// 3. SET PRODUCT SCHEMAS FOR 8 NEW PRODUCTS
// ─────────────────────────────────────────────
$new_product_ids = [67951, 67952, 67953, 67954, 67955, 67956, 67957, 67958];

$product_titles = [
    67951 => 'Stripper en Barcelona Capital 2026',
    67952 => 'Stripper en L\'Hospitalet de Llobregat 2026',
    67953 => 'Stripper en Badalona 2026',
    67954 => 'Stripper en Terrassa 2026',
    67955 => 'Stripper en Sabadell 2026',
    67956 => 'Stripper en Cornellà de Llobregat 2026',
    67957 => 'Stripper en Sant Cugat del Vallès 2026',
    67958 => 'Stripper en Sitges 2026',
];

$product_urls = [
    67951 => 'https://espectaculosluxury.com/producto/stripper-barcelona-capital/',
    67952 => 'https://espectaculosluxury.com/producto/stripper-hospitalet-de-llobregat/',
    67953 => 'https://espectaculosluxury.com/producto/stripper-badalona/',
    67954 => 'https://espectaculosluxury.com/producto/stripper-terrassa/',
    67955 => 'https://espectaculosluxury.com/producto/stripper-sabadell/',
    67956 => 'https://espectaculosluxury.com/producto/stripper-cornella-de-llobregat/',
    67957 => 'https://espectaculosluxury.com/producto/stripper-sant-cugat-del-valles/',
    67958 => 'https://espectaculosluxury.com/producto/stripper-sitges/',
];

$product_prices = [67951=>180, 67952=>180, 67953=>180, 67954=>180, 67955=>180, 67956=>180, 67957=>200, 67958=>200];
$product_localities = [
    67951 => 'Barcelona', 67952 => "L'Hospitalet de Llobregat", 67953 => 'Badalona',
    67954 => 'Terrassa',  67955 => 'Sabadell',                   67956 => 'Cornellà de Llobregat',
    67957 => 'Sant Cugat del Vallès', 67958 => 'Sitges',
];

foreach ($new_product_ids as $pid) {
    $title    = $product_titles[$pid];
    $url      = $product_urls[$pid];
    $price    = $product_prices[$pid];
    $locality = $product_localities[$pid];

    // Service schema for each product
    $service_schema = serialize([
        '@context'    => 'https://schema.org',
        '@type'       => 'Service',
        '@id'         => $url.'#service',
        'name'        => $title,
        'description' => 'Show de striptease profesional a domicilio en '.$locality.' para despedidas de soltera, cumpleaños y fiestas privadas. Desde '.$price.'€. Confirmación en 2h.',
        'url'         => $url,
        'provider'    => [
            '@type'     => 'Organization',
            '@id'       => 'https://espectaculosluxury.com/#organization',
            'name'      => 'Espectáculos Luxury',
            'telephone' => '+34695858978',
            'url'       => 'https://espectaculosluxury.com/',
        ],
        'areaServed' => [
            '@type' => 'City',
            'name'  => $locality,
        ],
        'offers' => [
            '@type'         => 'Offer',
            'price'         => (string)$price,
            'priceCurrency' => 'EUR',
            'availability'  => 'https://schema.org/InStock',
            'validFrom'     => '2026-01-01',
            'url'           => $url,
        ],
        'metadata' => ['title' => 'Service', 'type' => 'template'],
    ]);

    $r = upsert_meta($conn, $pid, 'rank_math_schema_service', $service_schema);
    echo "Product $pid service schema: $r\n";

    // Set robots and pillar
    upsert_meta($conn, $pid, 'rank_math_robots', 'index,follow');
    upsert_meta($conn, $pid, 'rank_math_pillar_content', 'on');

    // Set canonical URL
    upsert_meta($conn, $pid, 'rank_math_canonical_url', $url);
}

// ─────────────────────────────────────────────
// 4. FLUSH WP TRANSIENTS
// ─────────────────────────────────────────────
echo "\nFlushing WP transients...\n";
$conn->query("DELETE FROM el_options WHERE option_name LIKE '_transient_%'");
echo "Transients deleted: ".$conn->affected_rows."\n";
$conn->query("DELETE FROM el_options WHERE option_name LIKE '_site_transient_%'");
echo "Site transients deleted: ".$conn->affected_rows."\n";

// Clear WC product cache (object cache keys)
$conn->query("UPDATE el_options SET autoload='no' WHERE option_name LIKE 'wc_%' AND option_name LIKE '%cache%'");
echo "WC cache entries reset: ".$conn->affected_rows."\n";

echo "\nDone!\n";
