<?php
/**
 * ═══════════════════════════════════════════════════════════════════════════
 *  LUX LANDING BUILDER — PLANTILLA LANDING DE PROVINCIA
 *  Versión: 1.0.0  |  Patrón: Barcelona 2026 (landing v9)
 * ═══════════════════════════════════════════════════════════════════════════
 *
 * VARIABLES DISPONIBLES (inyectadas por deployer.php o el admin):
 * ──────────────────────────────────────────────────────────────────────────
 *  $cfg   → array con toda la configuración de la provincia
 *  $localities → array de localidades (key, slug, city, cs, dist, barrios)
 *
 * Accesos directos para legibilidad:
 *  $prov      → nombre de la provincia          (ej: "Sevilla")
 *  $prov_slug → slug de la provincia             (ej: "sevilla")
 *  $landing_url → URL canónica de la landing     (ej: "https://.../stripper-sevilla/")
 *  $base_url  → URL base de los productos        (ej: "https://.../categoria-sevilla/")
 *  $wa        → URL WhatsApp completa
 *  $tel       → URL tel:
 *  $num       → Número visible                   (ej: "695 858 978")
 *  $hero_img  → URL imagen hero
 *  $years     → Años de experiencia              (ej: "+15")
 *  $events    → Eventos realizados               (ej: "+2.000")
 *
 * NOTAS DE ADAPTACIÓN PARA NUEVA PROVINCIA:
 * ──────────────────────────────────────────────────────────────────────────
 *  1. Sustituye todas las referencias geográficas usando las variables.
 *  2. El CSS usa el prefijo #lx9 → especificidad 110, no cambiar.
 *  3. Las imágenes de shows se asignan en deployer.php (assign_images).
 *  4. Los locales nocturnos (tabla) deben actualizarse manualmente por provincia.
 *  5. El JSON-LD LocalBusiness se genera dinámicamente.
 * ═══════════════════════════════════════════════════════════════════════════
 */

if ( ! defined( 'LUX_BUILDER_DIR' ) ) { exit; }

// ── Accesos directos ────────────────────────────────────────────────────────
$prov        = $cfg['prov_name'];
$prov_slug   = $cfg['prov_slug'];
$base_url    = rtrim( $cfg['base_url'], '/' ) . '/';
$wa          = 'https://wa.me/' . $cfg['wa_phone'] . '?text=' . $cfg['wa_text'];
$tel         = 'tel:+' . preg_replace('/\D/','',$cfg['wa_phone']);
$num         = $cfg['phone_display'];
$hero_img    = $cfg['hero_image'] ?: 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-01.jpg';
$years       = $cfg['years'];
$events      = $cfg['events'];
$site_url    = get_site_url();
$landing_url = $site_url . '/stripper-' . $prov_slug . '/';

// Helper: municipality grid links
function lux_muni_links( $base_url, $localities ) {
    $icons = ['🏠','🌿','🌊','🏘','🌃','🌇','🏖','🏝','🌆','🏛','🗺'];
    $out   = '';
    foreach ( $localities as $i => $l ) {
        $icon = $icons[ $i % count($icons) ];
        $out .= '<a href="' . esc_url($base_url . $l['slug'] . '/') . '" class="lx9-muni">'
              . '<span class="lx9-muni-icon">' . $icon . '</span>'
              . '<span class="lx9-muni-name">'. esc_html($l['cs']) .'</span>'
              . '<span class="lx9-muni-dist">'. esc_html($l['dist']) .'</span>'
              . '</a>';
    }
    return $out;
}

// Helper: interlink pills (bottom of coverage section)
function lux_interlink_pills( $base_url, $localities, $prov, $landing_url ) {
    $out  = '<div style="margin-top:40px;padding-top:32px;border-top:1px solid rgba(255,255,255,.1);">';
    $out .= '<p class="lx9-eyebrow" style="margin-bottom:18px">📍 Zonas de servicio relacionadas</p>';
    $out .= '<div style="display:flex;flex-wrap:wrap;gap:10px 14px;font-size:0.85rem;">';
    foreach ( $localities as $l ) {
        $out .= '<a href="' . esc_url($base_url . $l['slug'] . '/') . '" '
              . 'style="color:#c8a96e;text-decoration:none;padding:6px 14px;border:1px solid #c8a96e;border-radius:20px;">'
              . '📍 Stripper ' . esc_html($l['cs']) . '</a>';
    }
    $out .= '<a href="' . esc_url($landing_url) . '" '
          . 'style="color:#c8a96e;text-decoration:none;padding:6px 14px;border:1px solid #c8a96e;border-radius:20px;">'
          . '🏠 Stripper ' . esc_html($prov) . ' Ciudad</a>';
    $out .= '</div></div>';
    return $out;
}

// ── JSON-LD ──────────────────────────────────────────────────────────────────
$jsonld = json_encode([
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'           => 'LocalBusiness',
            '@id'             => $site_url . '/#organization',
            'name'            => 'Espectáculos Luxury',
            'url'             => $site_url,
            'telephone'       => '+' . preg_replace('/\D/','',$cfg['wa_phone']),
            'priceRange'      => '€€',
            'image'           => $hero_img,
            'description'     => 'Agencia líder en shows de stripper en ' . $prov . '. ' . $years . ' años de experiencia y ' . $events . ' eventos realizados.',
            'address'         => [
                '@type'           => 'PostalAddress',
                'addressLocality' => $prov,
                'addressCountry'  => 'ES',
            ],
            'aggregateRating' => [
                '@type'       => 'AggregateRating',
                'ratingValue' => '5',
                'reviewCount' => '312',
                'bestRating'  => '5',
            ],
        ],
        [
            '@type'      => 'FAQPage',
            'mainEntity' => [
                [
                    '@type'          => 'Question',
                    'name'           => '¿Cuánto cuesta contratar un stripper en ' . $prov . '?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text'  => 'Los shows empiezan desde 180€ (Show Integral). Show Lésbico Dúo desde 330€, Show con Juguete Erótico desde 300€, Camarera Sexy desde 180€/hora, Pack desde 380€.',
                    ],
                ],
                [
                    '@type'          => 'Question',
                    'name'           => '¿Cuánto tardan en confirmar?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text'  => 'Confirmamos en menos de 2 horas por WhatsApp o teléfono.',
                    ],
                ],
            ],
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );

// ── Show catalog images (assign via deployer / fallback to BCN images) ────────
$img = $cfg['show_images'] ?? [];
$img_base = 'https://espectaculosluxury.com/wp-content/uploads/2026/03/';
$i_integral  = $img['integral']  ?? $img_base . 'bcn-stripper-01.jpg';
$i_lesbico   = $img['lesbico']   ?? $img_base . 'bcn-stripper-08.jpg';
$i_juguete   = $img['juguete']   ?? $img_base . 'bcn-stripper-10.jpg';
$i_camarera  = $img['camarera']  ?? $img_base . 'bcn-stripper-05.jpg';
$i_pack      = $img['pack']      ?? $img_base . 'bcn-stripper-06.jpg';
$i_masculino = $img['masculino'] ?? $img_base . 'bcn-stripper-14.jpg';
$i_desp      = $img['despedida'] ?? $img_base . 'bcn-stripper-02.jpg';
$i_cumple    = $img['cumple']    ?? $img_base . 'bcn-stripper-15.jpg';
$i_domicilio = $img['domicilio'] ?? $img_base . 'bcn-stripper-11.jpg';
$i_duo_alt   = $img['duo_alt']   ?? $img_base . 'bcn-stripper-09.jpg';

// ── Nightlife table (localizable – default: Barcelona) ───────────────────────
// Para otra provincia reemplaza $nightlife_rows con los locales locales.
$nightlife_rows = $cfg['nightlife'] ?? [
    [ 'name'=>'Pacha Barcelona',  'url'=>'https://www.pachab.com/',              'zona'=>'Port Olímpic',     'tipo'=>'Discoteca'        ],
    [ 'name'=>'Opium Mar',        'url'=>'https://www.opiummar.com/',             'zona'=>'Barceloneta',      'tipo'=>'Club + Beach'     ],
    [ 'name'=>'Razzmatazz',       'url'=>'https://www.razzmatazz.es/',            'zona'=>'Poblenou',         'tipo'=>'Sala conciertos'  ],
    [ 'name'=>'Sala Apolo',       'url'=>'https://www.sala-apolo.com/',           'zona'=>'Paral·lel',        'tipo'=>'Sala clásica'     ],
    [ 'name'=>'Sutton Club',      'url'=>'https://www.suttonbarcelona.com/',      'zona'=>'Diagonal',         'tipo'=>'Club VIP'         ],
    [ 'name'=>'Bling Bling',      'url'=>'https://blingbling.es/',               'zona'=>'Sant Gervasi',     'tipo'=>'Discoteca luxury' ],
    [ 'name'=>'El Nacional',      'url'=>'https://www.elnacional.cat/',           'zona'=>'Passeig de Gràcia','tipo'=>'Gastrobar VIP'    ],
    [ 'name'=>'Moog',             'url'=>'https://www.masimas.com/moog',          'zona'=>'Arc del Teatre',   'tipo'=>'Club electrónico' ],
    [ 'name'=>'Jamboree',         'url'=>'https://www.masimas.com/jamboree',      'zona'=>'Plaça Reial',      'tipo'=>'Jazz / Club'      ],
    [ 'name'=>'Mirablau',         'url'=>'https://www.mirablau.es/',              'zona'=>'Tibidabo',         'tipo'=>'Terraza vistas'   ],
    [ 'name'=>'Shoko',            'url'=>'https://www.shoko.biz/',               'zona'=>'Port Olímpic',     'tipo'=>'Beach Club'       ],
    [ 'name'=>'Club Catwalk',     'url'=>'https://www.clubcatwalk.net/',          'zona'=>'Port Olímpic',     'tipo'=>'Discoteca'        ],
];

// ── Hotels (localizable) ─────────────────────────────────────────────────────
$hotel_links = $cfg['hotels'] ?? [
    ['name'=>'Hotel W',          'url'=>'https://www.hotelwbarcelona.com/'],
    ['name'=>'Hotel Arts',       'url'=>'https://www.hotelartsbarcelona.com/'],
    ['name'=>'NH Collection',    'url'=>'https://www.nh-hotels.com/es/hotels/nh-collection-barcelona-gran-hotel-calderon'],
    ['name'=>'Melia Diagonal',   'url'=>'https://www.melia.com/es/hoteles/espana/barcelona/melia-barcelona'],
    ['name'=>'Hyatt Regency',    'url'=>'https://www.hyatt.com/es-ES/hotel/spain/hyatt-regency-barcelona-tower'],
];
$hotel_html = implode(', ', array_map(fn($h) =>
    '<a href="'.esc_url($h['url']).'" rel="nofollow noopener" target="_blank">'.esc_html($h['name']).'</a>',
    $hotel_links
));

// ── FAQ reviews (localizable) ─────────────────────────────────────────────────
$reviews = $cfg['reviews'] ?? [
    [ 'stars'=>5, 'text'=>'Increíble show para la despedida de mi amiga. La chica era super profesional y discreta. Reservamos por WhatsApp y en 1 hora lo teníamos confirmado.', 'author'=>'Marta R.', 'location'=>$prov, 'event'=>'Despedida de soltera', 'date'=>'Feb 2026' ],
    [ 'stars'=>5, 'text'=>'Contratamos el pack camarera más show para el cumpleaños de mi novio. Fue un 10, superó todas las expectativas.', 'author'=>'Laura G.', 'location'=>$prov, 'event'=>'Cumpleaños privado', 'date'=>'Ene 2026' ],
    [ 'stars'=>5, 'text'=>'Show lésbico dúo en un hotel. Los chicos no se lo podían creer. Todo muy profesional y discreto.', 'author'=>'Carlos M.', 'location'=>$prov, 'event'=>'Despedida de soltero', 'date'=>'Mar 2026' ],
    [ 'stars'=>5, 'text'=>'Organizamos una fiesta privada y el show fue espectacular. La chica llegó puntual y el show duró más de lo esperado. ¡10 sobre 10!', 'author'=>'Alejandro V.', 'location'=>$prov, 'event'=>'Fiesta privada', 'date'=>'Dic 2025' ],
];

// ─────────────────────────────────────────────────────────────────────────────
// BUILD HTML
// ─────────────────────────────────────────────────────────────────────────────
ob_start();
?>
<div id="lx9">
<style>
/* ════════════════════════════════════════════
   A. OVERRIDES DEL TEMA (sin prefijo #lx9)
════════════════════════════════════════════ */
.page-head { display: none !important; }
.jas-col-md-12.mt__60,.jas-col-md-12.mb__60,.jas-col-md-12.mt__60.mb__60{margin-top:0!important;margin-bottom:0!important;padding-top:0!important;padding-bottom:0!important}
.jas-container { overflow: visible !important; }
.ez-toc-container,#ez-toc-container,.eztoc-sticky-container,div[id^="ez-toc"]{display:none!important}

/* ════════════════════════════════════════════
   B. RESET LIMPIO — solo box-sizing
════════════════════════════════════════════ */
#lx9 *, #lx9 *::before, #lx9 *::after { box-sizing: border-box; }

/* ════════════════════════════════════════════
   C. BASE #lx9
════════════════════════════════════════════ */
#lx9{font-family:"Inter","Helvetica Neue",Helvetica,Arial,sans-serif;font-size:16px;line-height:1.65;color:#1a1a1a;background:#fff;-webkit-font-smoothing:antialiased}
#lx9 a{text-decoration:none;color:inherit}
#lx9 img{display:block;max-width:100%;height:auto}
#lx9 strong{font-weight:700}
#lx9 ul,#lx9 ol{list-style:none}
#lx9 p{margin:0}
#lx9 h1,#lx9 h2,#lx9 h3{margin:0}

/* ════════════════════════════════════════════
   D. HERO FULL-BLEED
════════════════════════════════════════════ */
#lx9 .lx9-hero-wrapper{margin-left:calc(-50vw + 50%);margin-right:calc(-50vw + 50%);width:100vw;position:relative;overflow:hidden}
#lx9 .lx9-hero{position:relative;min-height:720px;display:flex;align-items:center;justify-content:center;background:#0a0a0a}
#lx9 .lx9-hero-bg{position:absolute;inset:0;background-image:var(--lx9-hero-bg);background-size:cover;background-position:center 20%;opacity:.30}
#lx9 .lx9-hero-overlay{position:absolute;inset:0;background:linear-gradient(180deg,rgba(10,8,4,.45) 0%,rgba(10,8,4,.65) 40%,rgba(10,8,4,.82) 70%,rgba(10,8,4,.93) 100%)}
#lx9 .lx9-hero-glow{position:absolute;top:-80px;left:50%;transform:translateX(-50%);width:900px;height:500px;background:radial-gradient(ellipse at 50% 30%,rgba(200,169,110,.13) 0%,transparent 65%);pointer-events:none}
#lx9 .lx9-hero-inner{position:relative;z-index:2;width:100%;max-width:800px;margin:0 auto;padding:120px 40px 110px;text-align:center;display:flex;flex-direction:column;align-items:center}
#lx9 .lx9-badge{display:inline-flex;align-items:center;gap:10px;padding:10px 28px;border:1px solid rgba(200,169,110,.40);border-radius:100px;background:rgba(200,169,110,.08);font-size:.72rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#c8a96e;margin-bottom:40px}
#lx9 .lx9-badge-dot{width:7px;height:7px;border-radius:50%;background:#c8a96e;animation:lx9pulse 2.4s ease-in-out infinite;flex-shrink:0}
@keyframes lx9pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.25;transform:scale(.6)}}
#lx9 .lx9-h1{font-size:clamp(2.4rem,5.5vw,3.8rem);font-weight:900;line-height:1.08;letter-spacing:-.035em;color:#fff;margin-bottom:24px}
#lx9 .lx9-h1 em{font-style:normal;color:#c8a96e}
#lx9 .lx9-rule{width:56px;height:2px;background:linear-gradient(90deg,#c8a96e,#e0bc6a);border-radius:2px;margin-bottom:28px;flex-shrink:0;display:block;border:none}
#lx9 .lx9-hero-sub{font-size:1.1rem;font-weight:400;color:rgba(255,255,255,.70);line-height:1.80;max-width:540px;margin-bottom:52px}
#lx9 .lx9-btns{display:flex;flex-wrap:wrap;gap:18px;justify-content:center;margin-bottom:56px}
#lx9 .lx9-btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;border-radius:50px;font-weight:700;font-size:1rem;letter-spacing:.01em;line-height:1;text-decoration:none;transition:all .28s cubic-bezier(.34,1.56,.64,1);border:none;cursor:pointer;white-space:nowrap;padding:20px 44px}
#lx9 .lx9-btn-gold{background:linear-gradient(135deg,#c8a96e 0%,#e0bc6a 55%,#c8a96e 100%);background-size:200% auto;color:#111;box-shadow:0 8px 32px rgba(200,169,110,.40),0 2px 8px rgba(0,0,0,.30)}
#lx9 .lx9-btn-gold:hover{background-position:right center;transform:translateY(-4px) scale(1.02);box-shadow:0 20px 50px rgba(200,169,110,.55),0 4px 16px rgba(0,0,0,.30);color:#111}
#lx9 .lx9-btn-outline{background:transparent;color:rgba(255,255,255,.85);border:1.5px solid rgba(255,255,255,.28)}
#lx9 .lx9-btn-outline:hover{border-color:#c8a96e;color:#c8a96e;background:rgba(200,169,110,.07);transform:translateY(-3px)}
#lx9 .lx9-trust{display:flex;flex-wrap:wrap;justify-content:center;gap:12px}
#lx9 .lx9-trust-item{display:inline-flex;align-items:center;gap:8px;padding:9px 20px;border-radius:100px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.055);font-size:.78rem;font-weight:500;color:rgba(255,255,255,.68)}

/* ════ E. DIVISOR ════ */
#lx9 .lx9-divider{display:block;height:1px;background:linear-gradient(90deg,transparent 0%,rgba(200,169,110,.45) 25%,rgba(224,188,106,.70) 50%,rgba(200,169,110,.45) 75%,transparent 100%);border:none;margin:0}

/* ════ F. SECCIONES ════ */
#lx9 .lx9-bg-white{background:#fff}
#lx9 .lx9-bg-pearl{background:#f8f5f0}
#lx9 .lx9-bg-dark{background:#0e0e0e}
#lx9 .lx9-bg-finish{background:linear-gradient(155deg,#0c0c0c 0%,#0c0c0c 100%)}
#lx9 .lx9-section{padding:100px 24px}
#lx9 .lx9-section-sm{padding:80px 24px}
#lx9 .lx9-wrap{max-width:1160px;margin-left:auto;margin-right:auto}

/* ════ G. CABECERAS ════ */
#lx9 .lx9-sec-head{text-align:center;margin-bottom:64px}
#lx9 .lx9-sec-head-left{text-align:left;margin-bottom:56px}
#lx9 .lx9-eyebrow{display:inline-block;font-size:.70rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:#c8a96e;margin-bottom:14px}
#lx9 .lx9-title{font-size:clamp(1.65rem,3.4vw,2.4rem);font-weight:800;letter-spacing:-.03em;line-height:1.16;color:#111;margin-bottom:14px}
#lx9 .lx9-bg-dark .lx9-title,#lx9 .lx9-bg-finish .lx9-title{color:#fff}
#lx9 .lx9-subtitle{font-size:1.02rem;color:#777;line-height:1.70;max-width:580px;margin-top:18px;margin-left:auto;margin-right:auto;margin-bottom:0}
#lx9 .lx9-bg-dark .lx9-subtitle,#lx9 .lx9-bg-finish .lx9-subtitle{color:rgba(255,255,255,.50)}
#lx9 .lx9-sec-head-left .lx9-subtitle{margin-left:0}
#lx9 .lx9-goldbar{display:block;width:48px;height:3px;background:linear-gradient(90deg,#c8a96e,#e0bc6a);border-radius:3px;margin:18px auto 0;border:none}
#lx9 .lx9-sec-head-left .lx9-goldbar{margin-left:0}

/* ════ H. PROSA ════ */
#lx9 .lx9-prose{max-width:800px;margin-left:auto;margin-right:auto}
#lx9 .lx9-prose p{font-size:1.02rem;color:#555;line-height:1.90;margin-bottom:24px}
#lx9 .lx9-prose p:last-child{margin-bottom:0}

/* ════ I. CARDS ════ */
#lx9 .lx9-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:32px}
#lx9 .lx9-grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:28px}
#lx9 .lx9-card{background:#fff;border-radius:20px;overflow:hidden;border:1px solid rgba(200,169,110,.14);box-shadow:0 4px 24px rgba(0,0,0,.08);transition:transform .28s cubic-bezier(.34,1.56,.64,1),box-shadow .28s ease;display:flex;flex-direction:column}
#lx9 .lx9-card:hover{transform:translateY(-10px);box-shadow:0 24px 56px rgba(0,0,0,.15),0 0 0 1px rgba(200,169,110,.20)}
#lx9 .lx9-card-img{width:100%;height:240px;object-fit:cover;object-position:top center;display:block}
#lx9 .lx9-card-body{padding:28px 28px 30px;flex:1;display:flex;flex-direction:column}
#lx9 .lx9-card-tag{font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.10em;color:#c8a96e;margin-bottom:10px}
#lx9 .lx9-card-title{font-size:1.12rem;font-weight:800;color:#111;line-height:1.28;margin-bottom:12px}
#lx9 .lx9-card-desc{font-size:.90rem;color:#666;line-height:1.65;flex:1;margin-bottom:18px}
#lx9 .lx9-card-price{font-size:1.25rem;font-weight:800;color:#c8a96e;margin-bottom:18px}
#lx9 .lx9-card-btn{display:inline-flex;align-items:center;gap:6px;padding:13px 24px;border-radius:50px;background:linear-gradient(135deg,#c8a96e,#e0bc6a);color:#111;font-size:.86rem;font-weight:700;text-decoration:none;align-self:flex-start;transition:opacity .22s,transform .22s;box-shadow:0 4px 16px rgba(200,169,110,.28);border:none}
#lx9 .lx9-card-btn:hover{opacity:.88;transform:translateY(-2px);color:#111}

/* ════ J. MUNICIPIOS ════ */
#lx9 .lx9-muni-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(175px,1fr));gap:16px}
#lx9 .lx9-muni{background:rgba(255,255,255,.055);border:1px solid rgba(200,169,110,.24);border-radius:14px;padding:22px 16px;text-align:center;text-decoration:none;color:#fff;transition:all .24s ease;display:block}
#lx9 .lx9-muni:hover{background:#c8a96e;border-color:#c8a96e;color:#111;transform:translateY(-4px);box-shadow:0 12px 32px rgba(200,169,110,.28)}
#lx9 .lx9-muni-icon{font-size:1.7rem;margin-bottom:10px;display:block}
#lx9 .lx9-muni-name{font-size:.90rem;font-weight:700;line-height:1.2;display:block}
#lx9 .lx9-muni-dist{font-size:.73rem;color:rgba(255,255,255,.46);margin-top:6px;display:block}
#lx9 .lx9-muni:hover .lx9-muni-dist{color:rgba(0,0,0,.52)}

/* ════ K. CHECKLIST ════ */
#lx9 .lx9-checklist{display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:14px 36px}
#lx9 .lx9-checklist li{position:relative;padding:14px 14px 14px 46px;font-size:.96rem;color:#444;line-height:1.55;background:#fff;border-radius:12px;border:1px solid rgba(200,169,110,.14);box-shadow:0 2px 8px rgba(0,0,0,.04);list-style:none}
#lx9 .lx9-checklist li::before{content:"\2713";position:absolute;left:16px;top:15px;color:#c8a96e;font-weight:900;font-size:.92rem}
#lx9 .lx9-list-plain{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:12px 36px}
#lx9 .lx9-list-plain li{position:relative;padding:10px 10px 10px 32px;font-size:.96rem;color:#444;line-height:1.55;list-style:none}
#lx9 .lx9-list-plain li::before{content:"\2713";position:absolute;left:6px;top:11px;color:#c8a96e;font-weight:900;font-size:.92rem}

/* ════ L. TABLA LOCALES ════ */
#lx9 .lx9-tbl-wrap{overflow-x:auto;border-radius:16px;box-shadow:0 4px 24px rgba(0,0,0,.10);margin-top:40px}
#lx9 .lx9-tbl{width:100%;border-collapse:collapse;min-width:420px}
#lx9 .lx9-tbl thead tr{background:linear-gradient(135deg,#1a1a1a,#2a1900)}
#lx9 .lx9-tbl th{color:#c8a96e;padding:18px 26px;text-align:left;font-size:.76rem;letter-spacing:.10em;text-transform:uppercase;font-weight:700;white-space:nowrap}
#lx9 .lx9-tbl tbody tr:nth-child(odd){background:#fff}
#lx9 .lx9-tbl tbody tr:nth-child(even){background:#fdf9f2}
#lx9 .lx9-tbl td{padding:16px 26px;border-bottom:1px solid rgba(200,169,110,.10);font-size:.93rem;color:#333;vertical-align:middle}
#lx9 .lx9-tbl tbody tr:last-child td{border-bottom:none}
#lx9 .lx9-tbl tbody tr:hover td{background:rgba(200,169,110,.06)}
#lx9 .lx9-chip{display:inline-flex;align-items:center;padding:4px 14px;border-radius:100px;background:rgba(200,169,110,.10);color:#7a5c20;font-size:.78rem;font-weight:600;white-space:nowrap}

/* ════ M. PASOS ════ */
#lx9 .lx9-steps{display:grid;grid-template-columns:repeat(4,1fr);gap:28px;position:relative}
#lx9 .lx9-steps::before{content:"";position:absolute;top:56px;left:calc(12.5% + 28px);right:calc(12.5% + 28px);height:2px;background:linear-gradient(90deg,#c8a96e,#e0bc6a,#c8a96e);opacity:.28;pointer-events:none}
#lx9 .lx9-step{background:#fff;border-radius:20px;padding:40px 28px 36px;text-align:center;border:1px solid rgba(200,169,110,.18);box-shadow:0 4px 20px rgba(0,0,0,.06);position:relative;z-index:1;transition:transform .26s ease,box-shadow .26s ease}
#lx9 .lx9-step:hover{transform:translateY(-6px);box-shadow:0 20px 48px rgba(0,0,0,.12)}
#lx9 .lx9-step-num{width:60px;height:60px;border-radius:50%;background:linear-gradient(135deg,#c8a96e,#e0bc6a);display:flex;align-items:center;justify-content:center;font-weight:900;font-size:1.2rem;color:#111;margin:0 auto 22px;box-shadow:0 6px 24px rgba(200,169,110,.38)}
#lx9 .lx9-step-title{font-size:1.05rem;font-weight:800;color:#111;margin-bottom:12px}
#lx9 .lx9-step-desc{font-size:.90rem;color:#777;line-height:1.65}

/* ════ N. TABLA PRECIOS ════ */
#lx9 .lx9-price-wrap{overflow-x:auto;border-radius:20px;box-shadow:0 16px 60px rgba(0,0,0,.40);margin-top:12px}
#lx9 .lx9-price-tbl{width:100%;border-collapse:collapse;min-width:600px}
#lx9 .lx9-price-tbl thead tr{background:linear-gradient(135deg,#c8a96e 0%,#e0bc6a 100%)}
#lx9 .lx9-price-tbl th{color:#111;padding:20px 28px;text-align:left;font-size:.78rem;letter-spacing:.09em;text-transform:uppercase;font-weight:800;white-space:nowrap}
#lx9 .lx9-price-tbl th:not(:first-child){text-align:center}
#lx9 .lx9-price-tbl tbody tr{background:rgba(255,255,255,.04)}
#lx9 .lx9-price-tbl tbody tr:nth-child(even){background:rgba(255,255,255,.08)}
#lx9 .lx9-price-tbl td{padding:18px 28px;border-bottom:1px solid rgba(255,255,255,.07);font-size:.95rem;color:rgba(255,255,255,.85);vertical-align:middle}
#lx9 .lx9-price-tbl tbody tr:last-child td{border-bottom:none}
#lx9 .lx9-price-tbl td:not(:first-child){text-align:center}
#lx9 .lx9-price-tbl tbody tr:hover td{background:rgba(200,169,110,.08)}
#lx9 .lx9-price-hl{font-weight:800;color:#e0bc6a;font-size:1.08rem;white-space:nowrap}
#lx9 .lx9-price-note{font-size:.80rem;color:rgba(255,255,255,.36);font-style:italic;text-align:center;margin-top:22px;line-height:1.6}

/* ════ O. STATS ════ */
#lx9 .lx9-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:24px;margin-bottom:64px}
#lx9 .lx9-stat{text-align:center;padding:40px 20px;background:#fff;border-radius:18px;border:1px solid rgba(200,169,110,.16);box-shadow:0 4px 20px rgba(0,0,0,.06)}
#lx9 .lx9-stat-num{font-size:clamp(2rem,4vw,2.8rem);font-weight:900;color:#c8a96e;letter-spacing:-.04em;line-height:1;margin-bottom:10px;display:block}
#lx9 .lx9-stat-label{font-size:.85rem;color:#777;line-height:1.45;font-weight:500;display:block}

/* ════ P. REVIEWS ════ */
#lx9 .lx9-reviews{display:grid;grid-template-columns:repeat(2,1fr);gap:28px}
#lx9 .lx9-review{background:#fff;border-radius:20px;padding:36px 32px;border-left:4px solid #c8a96e;box-shadow:0 4px 24px rgba(0,0,0,.08);transition:transform .24s ease}
#lx9 .lx9-review:hover{transform:translateY(-5px)}
#lx9 .lx9-review-stars{font-size:1.1rem;letter-spacing:3px;margin-bottom:18px;color:#c8a96e;display:block}
#lx9 .lx9-review blockquote{font-size:.93rem;color:#555;line-height:1.80;font-style:italic;margin-bottom:20px;margin-left:0;margin-right:0}
#lx9 .lx9-review cite{font-size:.82rem;color:#c8a96e;font-weight:700;font-style:normal;display:block}

/* ════ Q. FAQ ════ */
#lx9 .lx9-faq{display:flex;flex-direction:column;gap:12px;margin-top:8px}
#lx9 .lx9-faq details{border:1px solid rgba(200,169,110,.22);border-radius:14px;background:#fff;overflow:hidden;transition:box-shadow .22s ease}
#lx9 .lx9-faq details[open]{border-color:#c8a96e;box-shadow:0 6px 28px rgba(200,169,110,.12)}
#lx9 .lx9-faq summary{padding:22px 28px;cursor:pointer;font-weight:700;font-size:.97rem;color:#111;list-style:none;display:flex;justify-content:space-between;align-items:center;gap:20px;user-select:none;line-height:1.4}
#lx9 .lx9-faq summary::-webkit-details-marker{display:none}
#lx9 .lx9-faq summary::after{content:"+";font-size:1.6rem;font-weight:300;color:#c8a96e;flex-shrink:0;transition:transform .24s ease;line-height:1;min-width:24px;text-align:center}
#lx9 .lx9-faq details[open] summary{border-bottom:1px solid rgba(200,169,110,.14)}
#lx9 .lx9-faq details[open] summary::after{transform:rotate(45deg)}
#lx9 .lx9-faq details p{padding:20px 28px 26px;font-size:.93rem;color:#555;line-height:1.80;margin:0}

/* ════ R. CTA FINAL ════ */
#lx9 .lx9-cta-wrap{max-width:720px;margin-left:auto;margin-right:auto;padding:110px 32px 120px;text-align:center}
#lx9 .lx9-cta-wrap h2{font-size:clamp(1.9rem,4.0vw,2.8rem);font-weight:900;letter-spacing:-.03em;color:#fff;margin-bottom:18px;line-height:1.14}
#lx9 .lx9-cta-wrap > p{font-size:1.05rem;color:rgba(255,255,255,.58);line-height:1.70;margin-bottom:44px}
#lx9 .lx9-cta-footer{margin-top:32px;font-size:.79rem;color:rgba(255,255,255,.26);line-height:1.7}
#lx9 .lx9-cta-footer a{color:rgba(255,255,255,.26)}
#lx9 .lx9-sec-desc{font-size:.95rem;color:#666;line-height:1.80;max-width:720px;margin-top:16px;margin-bottom:0}
#lx9 .lx9-sec-h3{font-size:1.18rem;font-weight:800;color:#111;margin-top:72px;margin-bottom:16px}

/* ════ T-V. RESPONSIVE ════ */
@media(max-width:1024px){#lx9 .lx9-grid-3{grid-template-columns:repeat(2,1fr)}#lx9 .lx9-grid-4{grid-template-columns:repeat(2,1fr)}#lx9 .lx9-steps{grid-template-columns:repeat(2,1fr)}#lx9 .lx9-steps::before{display:none}#lx9 .lx9-stats{grid-template-columns:repeat(2,1fr)}}
@media(max-width:768px){#lx9 .lx9-hero-inner{padding:96px 28px 88px}#lx9 .lx9-h1{font-size:2.0rem}#lx9 .lx9-hero-sub{font-size:1rem}#lx9 .lx9-btn{padding:17px 36px;font-size:.95rem}#lx9 .lx9-section{padding:76px 20px}#lx9 .lx9-section-sm{padding:60px 20px}#lx9 .lx9-sec-head{margin-bottom:48px}#lx9 .lx9-grid-3{grid-template-columns:1fr;gap:24px}#lx9 .lx9-grid-4{grid-template-columns:repeat(2,1fr);gap:20px}#lx9 .lx9-reviews{grid-template-columns:1fr}#lx9 .lx9-steps{grid-template-columns:1fr 1fr;gap:18px}#lx9 .lx9-stats{grid-template-columns:repeat(2,1fr);gap:16px}}
@media(max-width:520px){#lx9 .lx9-hero-inner{padding:80px 20px 72px}#lx9 .lx9-h1{font-size:1.75rem}#lx9 .lx9-hero-sub{font-size:.95rem}#lx9 .lx9-badge{font-size:.66rem;padding:9px 20px}#lx9 .lx9-btn{padding:16px 28px;font-size:.9rem}#lx9 .lx9-trust-item{font-size:.74rem;padding:8px 14px}#lx9 .lx9-section{padding:60px 18px}#lx9 .lx9-section-sm{padding:48px 18px}#lx9 .lx9-grid-4{grid-template-columns:1fr}#lx9 .lx9-steps{grid-template-columns:1fr}#lx9 .lx9-stats{grid-template-columns:1fr 1fr;gap:14px}#lx9 .lx9-stat{padding:28px 14px}#lx9 .lx9-muni-grid{grid-template-columns:repeat(2,1fr)}#lx9 .lx9-cta-wrap{padding:72px 20px 80px}}
</style>

<!-- ════════════ JSON-LD SCHEMA ════════════ -->
<script type="application/ld+json">
<?php echo $jsonld; ?>
</script>

<!-- ════════════ HERO FULL-BLEED ════════════ -->
<div class="lx9-hero-wrapper">
  <section class="lx9-hero" style="--lx9-hero-bg:url('<?php echo esc_url($hero_img); ?>')">
    <div class="lx9-hero-bg"></div>
    <div class="lx9-hero-overlay"></div>
    <div class="lx9-hero-glow"></div>
    <div class="lx9-hero-inner">

      <div class="lx9-badge">
        <span class="lx9-badge-dot"></span>
        <?php echo esc_html($prov); ?> &middot; Shows Premium 2026 &middot; Confirmaci&#243;n en 2h
      </div>

      <h1 class="lx9-h1">
        Stripper en <em><?php echo esc_html($prov); ?></em> 2026<br>
        Shows VIP desde 180&euro;
      </h1>

      <span class="lx9-rule"></span>

      <p class="lx9-hero-sub">
        La agencia l&#237;der en shows de striptease a domicilio en <?php echo esc_html($prov); ?>.<br>
        Artistas verificadas &middot; Discreci&#243;n total &middot; Disponibilidad 24h.
      </p>

      <div class="lx9-btns">
        <a href="<?php echo esc_url($wa); ?>" class="lx9-btn lx9-btn-gold">&#128242;&nbsp; Reservar por WhatsApp</a>
        <a href="<?php echo esc_url($tel); ?>" class="lx9-btn lx9-btn-outline">&#128222;&nbsp; <?php echo esc_html($num); ?></a>
      </div>

      <div class="lx9-trust">
        <span class="lx9-trust-item">&#11088;&#11088;&#11088;&#11088;&#11088;&nbsp; <?php echo esc_html($events); ?> fiestas</span>
        <span class="lx9-trust-item">&#128506;&nbsp; Toda <?php echo esc_html($prov); ?> y provincia</span>
        <span class="lx9-trust-item">&#9889;&nbsp; Confirmaci&#243;n en 2h</span>
        <span class="lx9-trust-item">&#128274;&nbsp; 100% Discreto</span>
      </div>

    </div>
  </section>
</div>

<span class="lx9-divider"></span>

<!-- ════════════ INTRO SEO ════════════ -->
<div class="lx9-bg-white">
  <div class="lx9-section-sm">
    <div class="lx9-wrap">
      <div class="lx9-sec-head">
        <span class="lx9-eyebrow">Espect&#225;culos Luxury &middot; <?php echo esc_html($prov); ?></span>
        <h2 class="lx9-title">Stripper en <?php echo esc_html($prov); ?>: Shows VIP a Domicilio</h2>
        <span class="lx9-goldbar"></span>
      </div>
      <div class="lx9-prose">
        <p>Contratar un <strong>stripper en <?php echo esc_html($prov); ?></strong> para una <strong>despedida de soltera</strong>, cumplea&#241;os o fiesta privada en 2026 es m&#225;s f&#225;cil que nunca con <strong>Espect&#225;culos Luxury</strong>. Somos la agencia con m&#225;s experiencia: <?php echo esc_html($years); ?> a&#241;os organizando shows de striptease profesionales en <strong>domicilios, hoteles, apartamentos tur&#237;sticos y salas privadas</strong> de <?php echo esc_html($prov); ?> y toda la provincia.</p>
        <p>Nuestro cat&#225;logo 2026 incluye el <strong>Show Integral desde 180&euro;</strong>, el espectacular <strong>Show L&#233;sbico D&#250;o desde 330&euro;</strong>, el <strong>Show con Juguete Er&#243;tico desde 300&euro;</strong>, la <strong>Camarera Sexy desde 180&euro;/hora</strong> y el popular <strong>Pack Camarera + Show desde 380&euro;</strong>. Confirmamos tu reserva en <strong>menos de 2 horas</strong>.</p>
      </div>
    </div>
  </div>
</div>

<span class="lx9-divider"></span>

<!-- ════════════ CATÁLOGO SHOWS ════════════ -->
<div class="lx9-bg-pearl">
  <div class="lx9-section">
    <div class="lx9-wrap">
      <div class="lx9-sec-head">
        <span class="lx9-eyebrow">Cat&#225;logo 2026</span>
        <h2 class="lx9-title">Shows de Stripper en <?php echo esc_html($prov); ?></h2>
        <span class="lx9-goldbar"></span>
        <p class="lx9-subtitle">Selecciona el show perfecto para tu celebraci&#243;n</p>
      </div>
      <div class="lx9-grid-3">

        <div class="lx9-card">
          <img class="lx9-card-img" src="<?php echo esc_url($i_integral); ?>" alt="Show Integral stripper <?php echo esc_attr($prov); ?> 2026" loading="lazy" width="400" height="240">
          <div class="lx9-card-body">
            <div class="lx9-card-tag">&#11088; M&#225;s popular</div>
            <div class="lx9-card-title">Show Integral</div>
            <p class="lx9-card-desc">Strip-tease completo con coreograf&#237;a, accesorios y actuaci&#243;n privada exclusiva. 30 a 45 min.</p>
            <div class="lx9-card-price">desde 180&euro;</div>
            <a href="<?php echo esc_url($base_url . 'show-integral-stripper-' . $prov_slug . '/'); ?>" class="lx9-card-btn">Ver show &rarr;</a>
          </div>
        </div>

        <div class="lx9-card">
          <img class="lx9-card-img" src="<?php echo esc_url($i_lesbico); ?>" alt="Show L&#233;sbico D&#250;o <?php echo esc_attr($prov); ?> despedida soltera" loading="lazy" width="400" height="240">
          <div class="lx9-card-body">
            <div class="lx9-card-tag">&#128293; Top despedidas</div>
            <div class="lx9-card-title">Show L&#233;sbico D&#250;o</div>
            <p class="lx9-card-desc">Dos artistas profesionales con coreograf&#237;a exclusiva. El show m&#225;s espectacular para despedidas.</p>
            <div class="lx9-card-price">desde 330&euro;</div>
            <a href="<?php echo esc_url($base_url . 'show-lesbico-duo-' . $prov_slug . '/'); ?>" class="lx9-card-btn">Ver show &rarr;</a>
          </div>
        </div>

        <div class="lx9-card">
          <img class="lx9-card-img" src="<?php echo esc_url($i_juguete); ?>" alt="Show con Juguete Er&#243;tico <?php echo esc_attr($prov); ?> fiestas adultas" loading="lazy" width="400" height="240">
          <div class="lx9-card-body">
            <div class="lx9-card-tag">&#128139; Show atrevido</div>
            <div class="lx9-card-title">Show con Juguete Er&#243;tico</div>
            <p class="lx9-card-desc">Show integral m&#225;s demostraci&#243;n con juguete er&#243;tico. Para fiestas privadas adultas m&#225;s atrevidas.</p>
            <div class="lx9-card-price">desde 300&euro;</div>
            <a href="<?php echo esc_url($base_url . 'show-juguete-erotico-' . $prov_slug . '/'); ?>" class="lx9-card-btn">Ver show &rarr;</a>
          </div>
        </div>

        <div class="lx9-card">
          <img class="lx9-card-img" src="<?php echo esc_url($i_camarera); ?>" alt="Camarera Sexy <?php echo esc_attr($prov); ?> fiesta privada lencer&#237;a" loading="lazy" width="400" height="240">
          <div class="lx9-card-body">
            <div class="lx9-card-tag">&#127946; Ambiente perfecto</div>
            <div class="lx9-card-title">Camarera Sexy</div>
            <p class="lx9-card-desc">Camarera en lencer&#237;a exclusiva para toda la fiesta. Atenci&#243;n personalizada y servicio VIP. M&#237;nimo 2h.</p>
            <div class="lx9-card-price">180&euro; / hora</div>
            <a href="<?php echo esc_url($base_url . 'camarera-sexy-' . $prov_slug . '/'); ?>" class="lx9-card-btn">Ver servicio &rarr;</a>
          </div>
        </div>

        <div class="lx9-card">
          <img class="lx9-card-img" src="<?php echo esc_url($i_pack); ?>" alt="Pack Camarera m&#225;s Show Integral <?php echo esc_attr($prov); ?> todo incluido" loading="lazy" width="400" height="240">
          <div class="lx9-card-body">
            <div class="lx9-card-tag">&#127873; Todo en uno</div>
            <div class="lx9-card-title">Pack Camarera + Show</div>
            <p class="lx9-card-desc">La experiencia completa: camarera sexy durante la fiesta m&#225;s show integral al final de la noche.</p>
            <div class="lx9-card-price">desde 380&euro;</div>
            <a href="<?php echo esc_url($base_url . 'pack-camarera-show-' . $prov_slug . '/'); ?>" class="lx9-card-btn">Ver pack &rarr;</a>
          </div>
        </div>

        <div class="lx9-card">
          <img class="lx9-card-img" src="<?php echo esc_url($i_masculino); ?>" alt="Stripper Masculino <?php echo esc_attr($prov); ?> para chicas despedida" loading="lazy" width="400" height="240">
          <div class="lx9-card-body">
            <div class="lx9-card-tag">&#128170; Para chicas</div>
            <div class="lx9-card-title">Stripper Masculino</div>
            <p class="lx9-card-desc">Artistas masculinos profesionales para despedidas de soltera y fiestas de chicas en <?php echo esc_html($prov); ?>.</p>
            <div class="lx9-card-price">desde 180&euro;</div>
            <a href="<?php echo esc_url($wa); ?>" class="lx9-card-btn">Reservar &rarr;</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<span class="lx9-divider"></span>

<!-- ════════════ COBERTURA ════════════ -->
<div class="lx9-bg-dark">
  <div class="lx9-section">
    <div class="lx9-wrap">
      <div class="lx9-sec-head">
        <span class="lx9-eyebrow">Cobertura</span>
        <h2 class="lx9-title">&#191;D&#243;nde Actuamos en <?php echo esc_html($prov); ?>?</h2>
        <span class="lx9-goldbar"></span>
        <p class="lx9-subtitle">Cobertura total de <?php echo esc_html($prov); ?> ciudad y provincia &middot; Hasta 60 km del centro</p>
      </div>
      <div class="lx9-muni-grid">
        <a href="<?php echo esc_url($landing_url); ?>" class="lx9-muni">
          <span class="lx9-muni-icon">&#127968;</span>
          <span class="lx9-muni-name"><?php echo esc_html($prov); ?> Ciudad</span>
          <span class="lx9-muni-dist">Centro ciudad</span>
        </a>
        <?php echo lux_muni_links( $base_url, $localities ); ?>
        <a href="<?php echo esc_url($wa); ?>" class="lx9-muni">
          <span class="lx9-muni-icon">&#128506;</span>
          <span class="lx9-muni-name">+60 km cobertura</span>
          <span class="lx9-muni-dist">Consulta disponibilidad</span>
        </a>
      </div>
      <?php echo lux_interlink_pills( $base_url, $localities, $prov, $landing_url ); ?>
    </div>
  </div>
</div>

<span class="lx9-divider"></span>

<!-- ════════════ ESPACIOS ════════════ -->
<div class="lx9-bg-white">
  <div class="lx9-section">
    <div class="lx9-wrap">
      <div class="lx9-sec-head-left">
        <span class="lx9-eyebrow">Espacios</span>
        <h2 class="lx9-title">Espacios y Locales donde Actuamos</h2>
        <span class="lx9-goldbar"></span>
        <p class="lx9-sec-desc">Llevamos el show a cualquier espacio de <?php echo esc_html($prov); ?>: desde apartamentos del centro hasta villas con piscina o hoteles de lujo.</p>
      </div>
      <ul class="lx9-checklist">
        <li>&#127968; Domicilios particulares en cualquier barrio de <?php echo esc_html($prov); ?></li>
        <li>&#127968; Hoteles de lujo: <?php echo $hotel_html; ?></li>
        <li>&#127745; Apartamentos tur&#237;sticos y Airbnb en el centro</li>
        <li>&#127958; Villas con piscina en la provincia de <?php echo esc_html($prov); ?></li>
        <li>&#127881; Salas privadas alquiladas y locales de fiestas</li>
        <li>&#127970; Eventos corporativos y after-work</li>
        <li>&#128676; Barcos y yates (consultar disponibilidad)</li>
        <li>&#127754; Beach clubs y terrazas de verano</li>
      </ul>

      <h3 class="lx9-sec-h3">&#127769; Pubs y Discotecas de Moda en <?php echo esc_html($prov); ?> 2026</h3>
      <span class="lx9-goldbar" style="margin-left:0;margin-bottom:24px"></span>
      <p class="lx9-sec-desc"><?php echo esc_html($prov); ?> ofrece una gran oferta de ocio nocturno. Si organizas la despedida en alguno de estos locales, nuestras artistas pueden asistir o puedes contratar el show antes o despu&#233;s:</p>
      <div class="lx9-tbl-wrap">
        <table class="lx9-tbl">
          <thead><tr><th>Local</th><th>Zona</th><th>Tipo</th></tr></thead>
          <tbody>
            <?php foreach ( $nightlife_rows as $row ) : ?>
            <tr>
              <td><a href="<?php echo esc_url($row['url']); ?>" rel="nofollow noopener" target="_blank"><strong><?php echo esc_html($row['name']); ?></strong></a></td>
              <td><?php echo esc_html($row['zona']); ?></td>
              <td><span class="lx9-chip"><?php echo esc_html($row['tipo']); ?></span></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<span class="lx9-divider"></span>

<!-- ════════════ PASOS ════════════ -->
<div class="lx9-bg-pearl">
  <div class="lx9-section">
    <div class="lx9-wrap">
      <div class="lx9-sec-head">
        <span class="lx9-eyebrow">Proceso de reserva</span>
        <h2 class="lx9-title">C&#243;mo Contratar un Stripper en <?php echo esc_html($prov); ?></h2>
        <span class="lx9-goldbar"></span>
        <p class="lx9-subtitle">4 pasos simples para tener el show perfecto</p>
      </div>
      <div class="lx9-steps">
        <div class="lx9-step"><div class="lx9-step-num">1</div><div class="lx9-step-title">Elige el Show</div><p class="lx9-step-desc">Selecciona entre nuestro cat&#225;logo: Integral, L&#233;sbico D&#250;o, con Juguete, Camarera o Pack completo.</p></div>
        <div class="lx9-step"><div class="lx9-step-num">2</div><div class="lx9-step-title">Cont&#225;ctanos</div><p class="lx9-step-desc">Esc&#237;benos por WhatsApp al <?php echo esc_html($num); ?> o ll&#225;manos con los detalles: fecha, lugar y tipo de show.</p></div>
        <div class="lx9-step"><div class="lx9-step-num">3</div><div class="lx9-step-title">Confirmaci&#243;n en 2h</div><p class="lx9-step-desc">Recibir&#225;s confirmaci&#243;n y datos de la artista en menos de 2 horas. Pago f&#225;cil y discreto.</p></div>
        <div class="lx9-step"><div class="lx9-step-num">4</div><div class="lx9-step-title">&#161;Disfruta el Show!</div><p class="lx9-step-desc">La artista llega puntual y ofrece el show m&#225;s profesional y memorable de <?php echo esc_html($prov); ?>.</p></div>
      </div>
    </div>
  </div>
</div>

<span class="lx9-divider"></span>

<!-- ════════════ PRECIOS ════════════ -->
<div class="lx9-bg-dark">
  <div class="lx9-section">
    <div class="lx9-wrap">
      <div class="lx9-sec-head">
        <span class="lx9-eyebrow">Tarifas 2026</span>
        <h2 class="lx9-title">Precios Shows <?php echo esc_html($prov); ?> 2026</h2>
        <span class="lx9-goldbar"></span>
      </div>
      <div class="lx9-price-wrap">
        <table class="lx9-price-tbl">
          <thead><tr><th>Tipo de Show</th><th>Precio</th><th>Duraci&#243;n</th><th>Ideal para</th></tr></thead>
          <tbody>
            <tr><td><strong>Show Integral</strong></td><td class="lx9-price-hl">desde 180&euro;</td><td>30 a 45 min</td><td>Cualquier evento</td></tr>
            <tr><td><strong>Show L&#233;sbico D&#250;o</strong></td><td class="lx9-price-hl">desde 330&euro;</td><td>45 a 60 min</td><td>Despedidas de soltera</td></tr>
            <tr><td><strong>Show con Juguete Er&#243;tico</strong></td><td class="lx9-price-hl">desde 300&euro;</td><td>30 a 45 min</td><td>Fiestas adultas</td></tr>
            <tr><td><strong>Camarera Sexy</strong></td><td class="lx9-price-hl">180&euro; / hora</td><td>M&#237;nimo 2h</td><td>Toda la fiesta</td></tr>
            <tr><td><strong>Pack Camarera + Show</strong></td><td class="lx9-price-hl">desde 380&euro;</td><td>3 a 4 horas</td><td>Todo en uno</td></tr>
            <tr><td><strong>Stripper Masculino</strong></td><td class="lx9-price-hl">desde 180&euro;</td><td>30 a 45 min</td><td>Para chicas</td></tr>
          </tbody>
        </table>
      </div>
      <p class="lx9-price-note">* Desplazamiento incluido en <?php echo esc_html($prov); ?> ciudad y hasta 30 km. Consultar suplemento para distancias mayores.</p>
    </div>
  </div>
</div>

<span class="lx9-divider"></span>

<!-- ════════════ TESTIMONIOS ════════════ -->
<div class="lx9-bg-white">
  <div class="lx9-section">
    <div class="lx9-wrap">
      <div class="lx9-sec-head">
        <span class="lx9-eyebrow">Opiniones reales</span>
        <h2 class="lx9-title">Lo que Dicen Nuestros Clientes</h2>
        <span class="lx9-goldbar"></span>
        <p class="lx9-subtitle"><?php echo esc_html($events); ?> eventos &middot; valoraci&#243;n media 5 sobre 5</p>
      </div>
      <div class="lx9-reviews">
        <?php foreach ( $reviews as $r ) : ?>
        <div class="lx9-review">
          <span class="lx9-review-stars"><?php echo str_repeat('★', intval($r['stars'])); ?></span>
          <blockquote>"<?php echo esc_html($r['text']); ?>"</blockquote>
          <cite><?php echo esc_html($r['author']); ?> &middot; <?php echo esc_html($r['location']); ?> &middot; <?php echo esc_html($r['event']); ?> &middot; <?php echo esc_html($r['date']); ?></cite>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<span class="lx9-divider"></span>

<!-- ════════════ POR QUÉ ELEGIRNOS ════════════ -->
<div class="lx9-bg-pearl">
  <div class="lx9-section">
    <div class="lx9-wrap">
      <div class="lx9-sec-head">
        <span class="lx9-eyebrow">&#191;Por qu&#233; nosotros?</span>
        <h2 class="lx9-title">La Agencia de Referencia en <?php echo esc_html($prov); ?></h2>
        <span class="lx9-goldbar"></span>
        <p class="lx9-subtitle">Somos la agencia l&#237;der en shows privados de <?php echo esc_html($prov); ?> y provincia</p>
      </div>
      <div class="lx9-stats">
        <div class="lx9-stat"><span class="lx9-stat-num"><?php echo esc_html($years); ?></span><span class="lx9-stat-label">A&#241;os de experiencia en <?php echo esc_html($prov); ?></span></div>
        <div class="lx9-stat"><span class="lx9-stat-num"><?php echo esc_html($events); ?></span><span class="lx9-stat-label">Eventos realizados en la provincia</span></div>
        <div class="lx9-stat"><span class="lx9-stat-num">5/5</span><span class="lx9-stat-label">Valoraci&#243;n media de nuestros clientes</span></div>
        <div class="lx9-stat"><span class="lx9-stat-num">2h</span><span class="lx9-stat-label">Tiempo m&#225;ximo de confirmaci&#243;n</span></div>
      </div>
      <ul class="lx9-list-plain">
        <li>Artistas verificadas, profesionales y con experiencia demostrada</li>
        <li>Confirmaci&#243;n de reserva garantizada en menos de 2 horas</li>
        <li>Discreci&#243;n absoluta: sin cargos descriptivos en la factura</li>
        <li>Cobertura de toda <?php echo esc_html($prov); ?> y provincia (hasta 60 km)</li>
        <li>Disponibilidad 24 horas, 365 d&#237;as al a&#241;o incluyendo festivos</li>
        <li>Precios transparentes: todo incluido desde el primer presupuesto</li>
        <li>El cat&#225;logo de artistas m&#225;s amplio de <?php echo esc_html($prov); ?></li>
        <li>Shows personalizables seg&#250;n el tipo de evento y preferencias</li>
        <li>Pago seguro, f&#225;cil y discreto por m&#250;ltiples m&#233;todos</li>
        <li><?php echo esc_html($years); ?> a&#241;os de experiencia y <?php echo esc_html($events); ?> eventos en <?php echo esc_html($prov); ?></li>
      </ul>
    </div>
  </div>
</div>

<span class="lx9-divider"></span>

<!-- ════════════ SHOWS POR EVENTO ════════════ -->
<div class="lx9-bg-white">
  <div class="lx9-section">
    <div class="lx9-wrap">
      <div class="lx9-sec-head">
        <span class="lx9-eyebrow">Por tipo de evento</span>
        <h2 class="lx9-title">Shows en <?php echo esc_html($prov); ?> por Tipo de Evento</h2>
        <span class="lx9-goldbar"></span>
        <p class="lx9-subtitle">Explora nuestros shows especializados para cada ocasi&#243;n</p>
      </div>
      <div class="lx9-grid-4">
        <a href="<?php echo esc_url($base_url . 'stripper-despedida-soltera-' . $prov_slug . '-producto/'); ?>" style="display:block;text-decoration:none">
          <div class="lx9-card"><img class="lx9-card-img" src="<?php echo esc_url($i_desp); ?>" alt="Stripper despedida de soltera <?php echo esc_attr($prov); ?> 2026" loading="lazy" width="300" height="200"><div class="lx9-card-body"><div class="lx9-card-tag">&#128141; Despedidas</div><div class="lx9-card-title">Stripper Despedida de Soltera</div><p class="lx9-card-desc">Shows exclusivos para despedidas de soltera en <?php echo esc_html($prov); ?></p><div class="lx9-card-price">desde 180&euro;</div></div></div>
        </a>
        <a href="<?php echo esc_url($base_url . 'stripper-cumpleanos-' . $prov_slug . '-producto/'); ?>" style="display:block;text-decoration:none">
          <div class="lx9-card"><img class="lx9-card-img" src="<?php echo esc_url($i_cumple); ?>" alt="Stripper cumplea&#241;os sorpresa <?php echo esc_attr($prov); ?> 2026" loading="lazy" width="300" height="200"><div class="lx9-card-body"><div class="lx9-card-tag">&#127874; Cumplea&#241;os</div><div class="lx9-card-title">Stripper Cumplea&#241;os Sorpresa</div><p class="lx9-card-desc">La sorpresa perfecta para quien cumpla a&#241;os en <?php echo esc_html($prov); ?></p><div class="lx9-card-price">desde 180&euro;</div></div></div>
        </a>
        <a href="<?php echo esc_url($base_url . 'stripper-a-domicilio-' . $prov_slug . '-producto/'); ?>" style="display:block;text-decoration:none">
          <div class="lx9-card"><img class="lx9-card-img" src="<?php echo esc_url($i_domicilio); ?>" alt="Stripper a domicilio <?php echo esc_attr($prov); ?> 24h disponible" loading="lazy" width="300" height="200"><div class="lx9-card-body"><div class="lx9-card-tag">&#127968; A Domicilio &middot; 24h</div><div class="lx9-card-title">Stripper a Domicilio</div><p class="lx9-card-desc">Shows en tu casa, hotel o apartamento en <?php echo esc_html($prov); ?></p><div class="lx9-card-price">desde 180&euro;</div></div></div>
        </a>
        <a href="<?php echo esc_url($base_url . 'show-lesbico-duo-' . $prov_slug . '/'); ?>" style="display:block;text-decoration:none">
          <div class="lx9-card"><img class="lx9-card-img" src="<?php echo esc_url($i_duo_alt); ?>" alt="Show l&#233;sbico d&#250;o <?php echo esc_attr($prov); ?> despedidas VIP" loading="lazy" width="300" height="200"><div class="lx9-card-body"><div class="lx9-card-tag">&#10024; Show Premium</div><div class="lx9-card-title">Show L&#233;sbico D&#250;o</div><p class="lx9-card-desc">El show m&#225;s demandado para despedidas exclusivas en <?php echo esc_html($prov); ?></p><div class="lx9-card-price">desde 330&euro;</div></div></div>
        </a>
      </div>
    </div>
  </div>
</div>

<span class="lx9-divider"></span>

<!-- ════════════ FAQ ════════════ -->
<div class="lx9-bg-pearl">
  <div class="lx9-section">
    <div class="lx9-wrap">
      <div class="lx9-sec-head">
        <span class="lx9-eyebrow">Preguntas frecuentes</span>
        <h2 class="lx9-title">FAQ: Stripper en <?php echo esc_html($prov); ?></h2>
        <span class="lx9-goldbar"></span>
      </div>
      <div class="lx9-faq">
        <details><summary>&#191;Cu&#225;nto cuesta contratar un stripper en <?php echo esc_html($prov); ?>?</summary><p>Los shows de stripper en <?php echo esc_html($prov); ?> empiezan desde <strong>180&euro;</strong> para el Show Integral. El Show L&#233;sbico D&#250;o parte de <strong>330&euro;</strong>, el Show con Juguete Er&#243;tico desde <strong>300&euro;</strong>, la Camarera Sexy desde <strong>180&euro;/hora</strong> (m&#237;nimo 2 horas) y el Pack Camarera + Show desde <strong>380&euro;</strong>.</p></details>
        <details><summary>&#191;Cu&#225;nto tiempo tardan en confirmar la reserva?</summary><p>Confirmamos todas las reservas de stripper en <?php echo esc_html($prov); ?> en <strong>menos de 2 horas</strong> por WhatsApp o tel&#233;fono. En muchos casos la confirmaci&#243;n es inmediata. Llama al <strong><?php echo esc_html($num); ?></strong>.</p></details>
        <details><summary>&#191;Act&#250;an en toda <?php echo esc_html($prov); ?> y municipios cercanos?</summary><p>S&#237;, cubrimos <strong>toda la ciudad de <?php echo esc_html($prov); ?> y su provincia</strong> hasta 60 km: <?php echo implode(', ', array_map(fn($l) => esc_html($l['city']), $localities)); ?> y muchos m&#225;s.</p></details>
        <details><summary>&#191;Se puede contratar un show para un hotel de <?php echo esc_html($prov); ?>?</summary><p>S&#237;, realizamos shows en los mejores hoteles de <?php echo esc_html($prov); ?>. Discrecci&#243;n total garantizada en todos los alojamientos.</p></details>
        <details><summary>&#191;Tienen disponibilidad los fines de semana y festivos?</summary><p>Tenemos disponibilidad <strong>las 24 horas, 365 d&#237;as al a&#241;o</strong>, incluyendo fines de semana, festivos y temporadas de alta demanda.</p></details>
        <details><summary>&#191;Qu&#233; diferencia hay entre el show integral y el l&#233;sbico d&#250;o?</summary><p>El <strong>Show Integral</strong> es el striptease completo con una sola artista profesional. El <strong>Show L&#233;sbico D&#250;o</strong> incluye dos artistas con coreograf&#237;a conjunta y es el show m&#225;s solicitado para <strong>despedidas de soltera</strong> en <?php echo esc_html($prov); ?>.</p></details>
        <details><summary>&#191;C&#243;mo funciona el servicio de camarera sexy en <?php echo esc_html($prov); ?>?</summary><p>La <strong>camarera sexy</strong> atiende tu fiesta durante toda la celebraci&#243;n vestida con lencer&#237;a exclusiva. Servicio m&#237;nimo de 2 horas a <strong>180&euro;/hora por chica</strong>. Tambi&#233;n disponible el <strong>Pack Camarera + Show desde 380&euro;</strong>.</p></details>
      </div>
    </div>
  </div>
</div>

<span class="lx9-divider"></span>

<!-- ════════════ CTA FINAL ════════════ -->
<div class="lx9-bg-dark">
  <div class="lx9-cta-wrap">
    <span class="lx9-eyebrow" style="display:block;margin-bottom:20px">Reserva tu show ahora</span>
    <h2>&#191;Listo para Reservar<br>tu Show en <?php echo esc_html($prov); ?>?</h2>
    <p>Contacta ahora y confirmamos en menos de 2 horas.<br>Disponibles 24h &middot; 365 d&#237;as al a&#241;o</p>
    <div class="lx9-btns">
      <a href="<?php echo esc_url($wa); ?>" class="lx9-btn lx9-btn-gold" style="padding:22px 52px;font-size:1.05rem">&#128242;&nbsp; Reservar por WhatsApp</a>
      <a href="<?php echo esc_url($tel); ?>" class="lx9-btn lx9-btn-outline" style="padding:22px 48px;font-size:1.05rem">&#128222;&nbsp; Llamar al <?php echo esc_html($num); ?></a>
    </div>
    <p class="lx9-cta-footer">
      Espect&#225;culos Luxury &middot; <?php echo esc_html($prov); ?> y provincia &middot; Disponibles 24h
    </p>
    <?php
    // ── "También actuamos en otras ciudades" — bloque dinámico ──────────────
    if ( function_exists('lux_other_cities_block') ) {
        echo lux_other_cities_block( $prov_slug, 'dark' );
    }
    ?>
  </div>
</div>

</div><!-- /#lx9 -->
<?php
return ob_get_clean();
