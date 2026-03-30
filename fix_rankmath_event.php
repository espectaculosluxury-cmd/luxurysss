<?php
/**
 * Fix the RankMath-generated Event schema by updating the rank_math_schema_LocalBusiness
 * and adding/updating a proper Event schema in RankMath's format (serialized PHP array).
 * 
 * The RankMath Event comes from the page schema settings. We'll update it via the 
 * rank_math_schema_Event meta key with a properly serialized PHP array.
 */

$conn = new mysqli('localhost','UsrDBespLu2015','spol2vi0xy1go','DBespLu2015');
if ($conn->connect_error) die('DB Error: '.$conn->connect_error);
$conn->set_charset('utf8mb4');
$conn->query("SET NAMES 'utf8mb4'");

// Build the RankMath Event schema array (matches RankMath's internal format)
$event_schema = [
    'metadata' => [
        'type' => 'template',
        'shortcode' => 's-madrid-event-2026',
        'isPrimary' => '',
        'title' => 'Event',
        'reviewLocationShortcode' => '[rank_math_rich_snippet]',
    ],
    '@type' => 'Event',
    'name' => 'Show de Stripper en Madrid 2026 — Espectáculos Luxury',
    'description' => 'Contrata un show de striptease profesional en Madrid para despedidas de soltera, cumpleaños y fiestas privadas. Artistas verificadas a domicilio en toda la Comunidad de Madrid.',
    'url' => 'https://espectaculosluxury.com/stripper-madrid/',
    'startDate' => '2026-01-01',
    'endDate' => '2026-12-31',
    'eventStatus' => 'https://schema.org/EventScheduled',
    'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
    'image' => [
        'https://espectaculosluxury.com/wp-content/uploads/2026/03/madrid-img-01.jpg',
        'https://espectaculosluxury.com/wp-content/uploads/2026/03/madrid-img-04.jpg',
        'https://espectaculosluxury.com/wp-content/uploads/2026/03/madrid-img-07.jpg',
    ],
    'location' => [
        '@type' => 'Place',
        'name' => 'A domicilio en Madrid y área metropolitana',
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Madrid',
            'addressRegion' => 'Comunidad de Madrid',
            'addressCountry' => 'ES',
        ],
    ],
    'performer' => [
        '@type' => 'PerformingGroup',
        'name' => 'Artistas de Espectáculos Luxury',
        'url' => 'https://espectaculosluxury.com/',
    ],
    'organizer' => [
        '@type' => 'Organization',
        'name' => 'Espectáculos Luxury',
        'url' => 'https://espectaculosluxury.com/',
        'telephone' => '+34695858978',
    ],
    'offers' => [
        [
            '@type' => 'Offer',
            'name' => 'Show Integral',
            'price' => '180',
            'priceCurrency' => 'EUR',
            'availability' => 'https://schema.org/InStock',
            'validFrom' => '2026-01-01',
            'url' => 'https://espectaculosluxury.com/stripper-madrid/',
        ],
        [
            '@type' => 'Offer',
            'name' => 'Show Lésbico Dúo',
            'price' => '350',
            'priceCurrency' => 'EUR',
            'availability' => 'https://schema.org/InStock',
            'validFrom' => '2026-01-01',
            'url' => 'https://espectaculosluxury.com/stripper-madrid/',
        ],
        [
            '@type' => 'Offer',
            'name' => 'Show con Juguete Erótico',
            'price' => '280',
            'priceCurrency' => 'EUR',
            'availability' => 'https://schema.org/InStock',
            'validFrom' => '2026-01-01',
            'url' => 'https://espectaculosluxury.com/stripper-madrid/',
        ],
        [
            '@type' => 'Offer',
            'name' => 'Pack Camarera + Show',
            'price' => '300',
            'priceCurrency' => 'EUR',
            'availability' => 'https://schema.org/InStock',
            'validFrom' => '2026-01-01',
            'url' => 'https://espectaculosluxury.com/stripper-madrid/',
        ],
    ],
];

$serialized = serialize($event_schema);
echo "Schema serialized, length: " . strlen($serialized) . "\n";

// Check if rank_math_schema_Event already exists
$check = $conn->query("SELECT meta_id FROM el_postmeta WHERE post_id=67389 AND meta_key='rank_math_schema_Event'");
if ($check->num_rows > 0) {
    // Update existing
    $stmt = $conn->prepare("UPDATE el_postmeta SET meta_value=? WHERE post_id=67389 AND meta_key='rank_math_schema_Event'");
    $stmt->bind_param('s', $serialized);
    $stmt->execute();
    echo "Updated existing rank_math_schema_Event, rows: " . $stmt->affected_rows . "\n";
} else {
    // Insert new
    $stmt = $conn->prepare("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES (67389, 'rank_math_schema_Event', ?)");
    $stmt->bind_param('s', $serialized);
    $stmt->execute();
    echo "Inserted new rank_math_schema_Event, id: " . $conn->insert_id . "\n";
}

// Verify
$verify = $conn->query("SELECT meta_value FROM el_postmeta WHERE post_id=67389 AND meta_key='rank_math_schema_Event'");
$vrow = $verify->fetch_assoc();
$data = unserialize($vrow['meta_value']);
echo "Verified startDate: " . $data['startDate'] . "\n";
echo "Verified endDate: " . $data['endDate'] . "\n";
echo "Verified performer: " . $data['performer']['name'] . "\n";
echo "Verified offers count: " . count($data['offers']) . "\n";

echo "Done!\n";
