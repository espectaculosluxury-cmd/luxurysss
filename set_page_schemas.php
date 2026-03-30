<?php
/**
 * Set RankMath LocalBusiness + FAQPage schemas for Madrid landing and cluster pages
 */

$conn = new mysqli('localhost', 'UsrDBespLu2015', 'spol2vi0xy1go', 'DBespLu2015');
if ($conn->connect_error) { die('DB Error: ' . $conn->connect_error); }
$conn->set_charset('utf8mb4');

$pages = [
    67389 => [
        'type' => 'landing',
        'name' => 'Stripper Madrid - Landing Principal',
        'url' => 'https://espectaculosluxury.com/stripper-madrid/',
        'title' => 'Stripper en Madrid 2026 | Shows VIP desde 180€ · Despedidas y Fiestas — Espectáculos Luxury',
        'desc' => 'Contrata stripper en Madrid desde 180€. Shows integrales, dúo lésbico, camarera sexy. 8 municipios, artistas verificadas, reserva en 2h. Toda la Comunidad de Madrid.',
        'kw' => 'stripper madrid,contratar stripper madrid,stripper a domicilio madrid,show striptease madrid 2026',
        'img' => 67874,
        'faq' => [
            ['q' => '¿Cuánto cuesta contratar un stripper en Madrid?', 'a' => 'El precio de un stripper en Madrid comienza desde 180 € para un show integral básico. Los packs más completos (Pack Camarera + Integral) empiezan desde 300 €. El dúo lésbico desde 350 €. Precios fijos sin extras ocultos.'],
            ['q' => '¿Se puede contratar stripper a domicilio en Madrid?', 'a' => 'Sí, realizamos todos nuestros shows directamente en tu domicilio en Madrid y toda la Comunidad. El servicio cubre pisos, chalés, hoteles, Airbnbs y locales alquilados.'],
            ['q' => '¿Con cuánta antelación debo reservar en Madrid?', 'a' => 'Recomendamos 48-72 horas para garantizar disponibilidad. Para fines de semana y festivos, idealmente 5-7 días antes. También atendemos urgencias en menos de 24 horas.'],
            ['q' => '¿Hacéis shows para despedidas de soltera en Madrid?', 'a' => 'Absolutamente. Las despedidas de soltera son nuestro servicio más demandado en Madrid. Ofrecemos shows personalizados con striptease, juegos y packs especiales para grupos.'],
            ['q' => '¿Qué tipos de show hay en Madrid?', 'a' => 'En Madrid ofrecemos: Show Integral (180€), Dúo Lésbico (350€), Show con Juguetes Eróticos (280€), Camarera Sexy (180€/h), Pack Camarera + Integral (300€) y Stripper Masculino Boys (180€).'],
            ['q' => '¿En qué municipios de Madrid operáis?', 'a' => 'Cubrimos toda la Comunidad de Madrid: Madrid Capital, Alcalá de Henares, Móstoles, Alcorcón, Leganés, Getafe, Fuenlabrada, Alcobendas, Pozuelo de Alarcón y muchos más.'],
            ['q' => '¿Los shows de striptease son legales en Madrid?', 'a' => 'Sí, son completamente legales en España para mayores de 18 años en espacios privados. Espectáculos Luxury opera con total transparencia, cumple la normativa y emite facturas.'],
            ['q' => '¿Cómo reservo un stripper en Madrid?', 'a' => 'El proceso es sencillo: 1) Escríbenos por WhatsApp con fecha y tipo de show. 2) Te enviamos disponibilidad y presupuesto en 2h. 3) Confirmas con anticipo. 4) Disfrutas el show.'],
        ],
    ],
    67391 => [
        'type' => 'cluster',
        'name' => 'Stripper Despedidas Madrid',
        'url' => 'https://espectaculosluxury.com/stripper-despedidas-madrid/',
        'title' => 'Stripper para Despedida de Soltera en Madrid 2026 | Desde 180€ — Espectáculos Luxury',
        'desc' => 'Contrata el mejor stripper para despedida de soltera en Madrid desde 180€. Shows integrales, packs VIP, camarera sexy. Toda la Comunidad de Madrid. Reserva express.',
        'kw' => 'stripper despedida soltera madrid,contratar stripper despedida madrid,show striptease despedida madrid',
        'img' => 67871,
        'faq' => [
            ['q' => '¿Cuánto cuesta un stripper para despedida de soltera en Madrid?', 'a' => 'El precio comienza desde 180 € para un show integral básico. El pack más popular para despedidas (Pack Camarera + Integral) cuesta desde 300 €.'],
            ['q' => '¿Cuántas personas suele haber en una despedida con stripper en Madrid?', 'a' => 'Las despedidas suelen ser grupos de 8 a 20 personas. Actuamos para grupos de todos los tamaños, desde 5 hasta 50+ personas.'],
            ['q' => '¿Se puede hacer el show en el hotel de la despedida?', 'a' => 'Sí, actuamos en suites y habitaciones de hotel en Madrid con total discreción. Es una de las opciones más demandadas para despedidas VIP.'],
            ['q' => '¿Cómo personalizo el show para la despedida?', 'a' => 'Puedes elegir el tipo de show, el disfraz, los juegos interactivos y la música. Todo se acuerda previamente por WhatsApp para que el show sea perfecto.'],
            ['q' => '¿Hay shows masculinos para despedidas de soltera en Madrid?', 'a' => 'Sí, disponemos de boys (strippers masculinos) desde 180 € para despedidas de soltera en toda la Comunidad de Madrid.'],
            ['q' => '¿Con cuánta antelación reservar para una despedida?', 'a' => 'Lo ideal es reservar con 5-7 días para fines de semana. Entre semana podemos gestionar reservas con 24-48 horas de antelación.'],
        ],
    ],
    67392 => [
        'type' => 'cluster',
        'name' => 'Stripper Cumpleaños Madrid',
        'url' => 'https://espectaculosluxury.com/stripper-cumpleanos-madrid/',
        'title' => 'Stripper para Cumpleaños en Madrid 2026 | Desde 180€ — Espectáculos Luxury',
        'desc' => 'Contrata stripper para cumpleaños en Madrid desde 180€. Shows sorpresa, packs completos, camarera sexy. La mejor agencia de Madrid para fiestas de cumpleaños.',
        'kw' => 'stripper cumpleaños madrid,contratar stripper cumpleaños madrid,show cumpleaños madrid',
        'img' => 67872,
        'faq' => [
            ['q' => '¿Qué tipo de show es mejor para un cumpleaños en Madrid?', 'a' => 'Para cumpleaños recomendamos el Show Integral (180€) con disfraces temáticos o el Pack Camarera + Integral (300€) para una experiencia más completa.'],
            ['q' => '¿Podéis hacer shows sorpresa en Madrid?', 'a' => 'Sí, coordinamos shows sorpresa para cumpleaños con total discreción. El cumpleañero/a no se entera de nada hasta que la artista aparece.'],
            ['q' => '¿Cuál es la edad mínima para contratar un show de cumpleaños?', 'a' => 'Todos nuestros servicios son exclusivamente para mayores de 18 años, tanto para el contratante como para todos los asistentes al evento.'],
            ['q' => '¿Hacéis shows masculinos para cumpleaños de chicas en Madrid?', 'a' => 'Sí, los boys strippers son muy populares para cumpleaños femeninos en Madrid. Disponibles desde 180 € en toda la Comunidad.'],
            ['q' => '¿Qué incluye el show de cumpleaños en Madrid?', 'a' => 'Incluye: artista profesional, coreografía temática, disfraces, música, show de 30-45 min, posibilidad de juegos con invitados y desplazamiento a tu ubicación.'],
            ['q' => '¿Se puede contratar más de un show para el cumpleaños?', 'a' => 'Sí, puedes contratar múltiples shows o un dúo lésbico (desde 350€) para grupos más grandes. Consúltanos y te diseñamos el paquete perfecto.'],
        ],
    ],
    67393 => [
        'type' => 'cluster',
        'name' => 'Stripper a Domicilio Madrid',
        'url' => 'https://espectaculosluxury.com/stripper-a-domicilio-madrid/',
        'title' => 'Stripper a Domicilio en Madrid 2026 | Shows Privados desde 180€ — Espectáculos Luxury',
        'desc' => 'Stripper a domicilio en Madrid desde 180€. Shows privados en tu casa, hotel o Airbnb. Artistas verificadas, discreción total. Toda la Comunidad de Madrid.',
        'kw' => 'stripper a domicilio madrid,stripper domicilio madrid,show privado domicilio madrid',
        'img' => 67873,
        'faq' => [
            ['q' => '¿Cómo funciona el servicio de stripper a domicilio en Madrid?', 'a' => 'La artista se desplaza a tu dirección en Madrid a la hora acordada, realiza el show de 30-45 min y se marcha discretamente. Todo se coordina por WhatsApp.'],
            ['q' => '¿El desplazamiento a domicilio en Madrid tiene coste adicional?', 'a' => 'El desplazamiento está incluido para Madrid capital y municipios a menos de 20 km. Para zonas más alejadas puede aplicarse un pequeño suplemento.'],
            ['q' => '¿Qué espacio necesito en casa para el show?', 'a' => 'Con un espacio de 3x3 metros es suficiente. No necesitas grandes áreas. La artista se adapta al espacio disponible.'],
            ['q' => '¿Hacéis shows en Airbnbs y apartamentos de alquiler en Madrid?', 'a' => 'Sí, los apartamentos turísticos y Airbnbs son perfectos para shows privados. Son discretos y ofrecen privacidad total para el grupo.'],
            ['q' => '¿A qué horas hacéis shows a domicilio en Madrid?', 'a' => 'Nuestra disponibilidad es de 20:00 a 04:00 horas. Para otros horarios consúltanos y evaluamos la disponibilidad.'],
            ['q' => '¿Qué diferencia hay entre un show a domicilio y en local alquilado?', 'a' => 'El show a domicilio ofrece máxima intimidad y comodidad. Un local alquilado puede ser mejor para grupos grandes. Ambas opciones tienen el mismo precio base.'],
        ],
    ],
    67892 => [
        'type' => 'cluster',
        'name' => 'Stripper Fiestas Privadas Madrid',
        'url' => 'https://espectaculosluxury.com/stripper-fiestas-privadas-madrid/',
        'title' => 'Stripper para Fiestas Privadas en Madrid 2026 | Shows VIP desde 180€ — Espectáculos Luxury',
        'desc' => 'Contrata stripper para fiesta privada en Madrid desde 180€. Shows integrales, dúo lésbico, camarera sexy y packs VIP. Toda la Comunidad de Madrid. Reserva por WhatsApp.',
        'kw' => 'stripper fiesta privada madrid,show striptease fiesta privada madrid,stripper para fiesta madrid',
        'img' => 67875,
        'faq' => [
            ['q' => '¿Cuánto cuesta un stripper para fiesta privada en Madrid?', 'a' => 'El precio comienza desde 180 € para un show integral. Los packs más completos como el dúo lésbico o el pack camarera + integral cuestan desde 300-350 €.'],
            ['q' => '¿Para qué tipo de fiestas privadas hacéis shows en Madrid?', 'a' => 'Actuamos para todo tipo de fiestas privadas: despedidas, cumpleaños, reuniones de amigos, eventos corporativos y cualquier celebración adulta.'],
            ['q' => '¿Cuántos invitados puede haber en la fiesta?', 'a' => 'No hay límite. Actuamos tanto para grupos íntimos de 5 personas como para fiestas de 50+ invitados. Para grupos grandes recomendamos más de una artista.'],
            ['q' => '¿Hacéis shows para fiestas mixtas?', 'a' => 'Sí, disponemos de artistas para todo tipo de público: strippers femeninas, boys masculinos y shows adaptados a grupos mixtos.'],
            ['q' => '¿Es necesario alquilar un local para la fiesta privada en Madrid?', 'a' => 'No, actuamos en domicilios, pisos, chalés, hoteles, Airbnbs y locales alquilados. Tú eliges el espacio y nosotros nos adaptamos.'],
            ['q' => '¿Con cuánto tiempo de antelación reservar?', 'a' => 'Recomendamos 48-72 horas para entre semana y 5-7 días para fines de semana. Gestionamos urgencias en menos de 24h si la agenda lo permite.'],
        ],
    ],
];

foreach ($pages as $pid => $pdata) {
    echo "Setting RankMath schema for: {$pdata['name']} (ID: $pid)\n";
    
    $shortcode = 's-madrid-' . substr(md5($pdata['url']), 0, 8);
    
    // Build FAQPage schema
    $faq_entries = [];
    foreach ($pdata['faq'] as $item) {
        $faq_entries[] = [
            '@type' => 'Question',
            'name' => $item['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['a']],
        ];
    }
    
    $faq_schema = serialize([
        'metadata' => [
            'type' => 'template',
            'shortcode' => $shortcode,
            'isPrimary' => '',
            'title' => 'FAQ',
            'reviewLocationShortcode' => '[rank_math_rich_snippet]',
        ],
        '@type' => 'FAQPage',
        'name' => '%seo_title%',
        'url' => '%url%',
        'datePublished' => '2026-01-15',
        'dateModified' => '2026-03-30',
        'mainEntity' => $faq_entries,
    ]);
    
    // Build LocalBusiness schema for landing
    if ($pdata['type'] === 'landing') {
        $lb_schema = serialize([
            'metadata' => [
                'type' => 'template',
                'shortcode' => $shortcode,
                'isPrimary' => '1',
                'title' => 'LocalBusiness',
                'reviewLocationShortcode' => '[rank_math_rich_snippet]',
            ],
            '@type' => 'LocalBusiness',
            'name' => 'Espectáculos Luxury — Stripper Madrid',
            'url' => 'https://espectaculosluxury.com/stripper-madrid/',
            'telephone' => '+34684038590',
            'priceRange' => '€€',
            'description' => 'Agencia líder en contratación de strippers y shows adultos en Madrid. Despedidas de soltera, cumpleaños y fiestas privadas.',
            'areaServed' => [
                ['@type' => 'City', 'name' => 'Madrid'],
                ['@type' => 'City', 'name' => 'Alcalá de Henares'],
                ['@type' => 'City', 'name' => 'Móstoles'],
                ['@type' => 'City', 'name' => 'Alcorcón'],
                ['@type' => 'City', 'name' => 'Getafe'],
                ['@type' => 'City', 'name' => 'Fuenlabrada'],
            ],
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => '5',
                'reviewCount' => '312',
                'bestRating' => '5',
                'worstRating' => '1',
            ],
        ]);
    }
    
    // Update RankMath meta
    $conn->query("DELETE FROM el_postmeta WHERE post_id=$pid AND meta_key IN ('rank_math_title','rank_math_description','rank_math_focus_keyword','rank_math_robots','rank_math_schema_FAQPage','rank_math_schema_LocalBusiness','_thumbnail_id')");
    
    $rm_title = $conn->real_escape_string($pdata['title']);
    $rm_desc = $conn->real_escape_string($pdata['desc']);
    $rm_kw = $conn->real_escape_string($pdata['kw']);
    
    $conn->query("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES ($pid,'rank_math_title','$rm_title')");
    $conn->query("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES ($pid,'rank_math_description','$rm_desc')");
    $conn->query("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES ($pid,'rank_math_focus_keyword','$rm_kw')");
    $conn->query("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES ($pid,'rank_math_robots','a:1:{i:0;s:5:\"index\";}')");
    $conn->query("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES ($pid,'rank_math_schema_FAQPage','" . $conn->real_escape_string($faq_schema) . "')");
    
    if ($pdata['type'] === 'landing') {
        $conn->query("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES ($pid,'rank_math_schema_LocalBusiness','" . $conn->real_escape_string($lb_schema) . "')");
        echo "  ✓ LocalBusiness schema added\n";
    }
    
    $conn->query("INSERT INTO el_postmeta (post_id, meta_key, meta_value) VALUES ($pid,'_thumbnail_id','{$pdata['img']}')");
    
    echo "  ✓ FAQPage schema, title, description, keywords set\n";
}

echo "\nAll done! RankMath schemas set for " . count($pages) . " pages.\n";
