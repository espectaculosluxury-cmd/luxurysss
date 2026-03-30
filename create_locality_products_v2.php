<?php
/**
 * Crea 10 productos de localidad BCN directamente en la DB sin hooks problemáticos.
 */
require('/var/www/vhosts/espectaculosluxury.com/httpdocs/wp-load.php');

kses_remove_filters();
remove_filter('content_save_pre',          'wp_filter_post_kses');
remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');

global $wpdb;

$cat_id = 1824; // contratar-stripper-para-fiestas-y-despedidas-en-barcelona
$base   = 'https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/';
$wa     = 'https://wa.me/34695858978?text=Hola%2C+quiero+contratar+un+stripper+en+Barcelona';
$tel    = 'tel:+34695858978';
$num    = '695 858 978';

$localities = [
  'hospitalet'    => ['slug'=>'stripper-hospitalet-de-llobregat-producto',  'city'=>'Hospitalet de Llobregat', 'cs'=>'Hospitalet',    'dist'=>'5 km',  'barrios'=>'Centre, Bellvitge, Santa Eulàlia, Gornal'],
  'badalona'      => ['slug'=>'stripper-badalona-producto',                  'city'=>'Badalona',                'cs'=>'Badalona',      'dist'=>'8 km',  'barrios'=>'Centre, La Salut, Morera, Lloreda'],
  'cornella'      => ['slug'=>'stripper-cornella-de-llobregat-producto',     'city'=>'Cornellà de Llobregat',  'cs'=>'Cornellà',      'dist'=>'10 km', 'barrios'=>'Centre, Sant Ildefons, Almeda, Gavarra'],
  'sant_cugat'    => ['slug'=>'stripper-sant-cugat-del-valles-producto',     'city'=>'Sant Cugat del Vallès',  'cs'=>'Sant Cugat',    'dist'=>'18 km', 'barrios'=>'Centre, Mirasol, Volpelleres, Torreblanca'],
  'sabadell'      => ['slug'=>'stripper-sabadell-producto',                  'city'=>'Sabadell',                'cs'=>'Sabadell',      'dist'=>'22 km', 'barrios'=>'Centre, Can Puiggener, Torre-romeu, Gràcia'],
  'terrassa'      => ['slug'=>'stripper-terrassa-producto',                  'city'=>'Terrassa',                'cs'=>'Terrassa',      'dist'=>'30 km', 'barrios'=>'Centre, Sant Pere, Ègara, Roc Blanc'],
  'sitges'        => ['slug'=>'stripper-sitges-producto',                    'city'=>'Sitges',                  'cs'=>'Sitges',        'dist'=>'35 km', 'barrios'=>'Centre Històric, Vinyet, Quint Mar'],
  'castelldefels' => ['slug'=>'stripper-castelldefels-producto',             'city'=>'Castelldefels',           'cs'=>'Castelldefels', 'dist'=>'25 km', 'barrios'=>'Centre, Castelldefels Platja, Can Bou, Montemar'],
  'mataro'        => ['slug'=>'stripper-mataro-producto',                    'city'=>'Mataró',                  'cs'=>'Mataró',        'dist'=>'30 km', 'barrios'=>'Centre, Cirera, Molins, Rocafonda'],
  'santacoloma'   => ['slug'=>'stripper-santa-coloma-de-gramenet-producto',  'city'=>'Santa Coloma de Gramenet','cs'=>'Santa Coloma',  'dist'=>'10 km', 'barrios'=>'Centre, Riu Nord, Fondo, Singuerlín'],
];

// Build interlink pills for a locality (skip self)
function interlinks($base, $localities, $current_key) {
    $html = '<div style="margin-top:40px;padding:24px;background:#f9f6f0;border-radius:12px;border:1px solid #e8e0d0;">';
    $html .= '<p style="font-size:.78rem;letter-spacing:.1em;text-transform:uppercase;color:#c8a96e;font-weight:700;margin:0 0 14px;">📍 Stripper en otras ciudades de Barcelona</p>';
    $html .= '<div style="display:flex;flex-wrap:wrap;gap:8px 10px;">';
    $html .= '<a href="https://espectaculosluxury.com/stripper-barcelona/" style="color:#c8a96e;text-decoration:none;padding:5px 13px;border:1px solid #c8a96e;border-radius:20px;font-size:.82rem;">🏠 Barcelona Ciudad</a>';
    foreach($localities as $k => $l) {
        if($k === $current_key) continue;
        $html .= '<a href="'.$base.$l['slug'].'/" style="color:#c8a96e;text-decoration:none;padding:5px 13px;border:1px solid #c8a96e;border-radius:20px;font-size:.82rem;">📍 Stripper '.$l['cs'].'</a>';
    }
    $html .= '</div></div>';
    return $html;
}

$css = '<style>
.lxp{font-family:"Inter",sans-serif;color:#111;line-height:1.7;max-width:900px;margin:0 auto;padding:0 16px 60px}
.lxp h1{font-size:clamp(1.6rem,4vw,2.4rem);font-weight:900;color:#111;margin:0 0 10px;line-height:1.25}
.lxp h1 em{color:#c8a96e;font-style:normal}
.lxp h2{font-size:clamp(1.2rem,3vw,1.65rem);font-weight:800;color:#111;margin:36px 0 14px;border-left:4px solid #c8a96e;padding-left:14px}
.lxp p{font-size:1rem;color:#444;margin:0 0 14px}
.lxp-hero{background:linear-gradient(135deg,#111 0%,#1c1408 100%);border-radius:16px;padding:36px 28px;margin:0 0 32px;text-align:center}
.lxp-hero h1{color:#fff;margin-bottom:8px}
.lxp-hero p{color:rgba(255,255,255,.75);font-size:1.02rem;margin:0 0 22px}
.lxp-rule{display:block;width:52px;height:2px;background:linear-gradient(90deg,#c8a96e,#e0bc6a);margin:12px auto 18px}
.lxp-btns{display:flex;gap:12px;flex-wrap:wrap;justify-content:center}
.lxp-btn-gold{display:inline-flex;align-items:center;gap:8px;padding:15px 30px;background:linear-gradient(135deg,#c8a96e,#e0bc6a);color:#111;font-weight:800;font-size:.93rem;border-radius:50px;text-decoration:none;box-shadow:0 4px 18px rgba(200,169,110,.4)}
.lxp-btn-out{display:inline-flex;align-items:center;gap:8px;padding:15px 30px;background:transparent;color:#fff;font-weight:700;font-size:.93rem;border-radius:50px;text-decoration:none;border:2px solid rgba(255,255,255,.45)}
.lxp-trust{display:flex;flex-wrap:wrap;gap:8px;justify-content:center;margin-top:18px}
.lxp-trust span{font-size:.77rem;padding:5px 13px;border-radius:20px;border:1px solid rgba(200,169,110,.3);color:rgba(255,255,255,.78);background:rgba(255,255,255,.05)}
.lxp-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin:28px 0}
.lxp-stat{background:#f9f6f0;border-radius:12px;padding:18px 10px;text-align:center;border:1px solid #e8e0d0}
.lxp-sn{display:block;font-size:1.55rem;font-weight:900;color:#c8a96e}
.lxp-sl{display:block;font-size:.73rem;color:#666;margin-top:3px;line-height:1.35}
.lxp-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin:20px 0}
.lxp-card{background:#fff;border:1px solid #e8e0d0;border-radius:12px;padding:18px}
.lxp-ct{font-size:.7rem;font-weight:700;color:#c8a96e;text-transform:uppercase;letter-spacing:.08em;margin-bottom:6px}
.lxp-cn{font-size:.93rem;font-weight:800;color:#111;margin-bottom:4px}
.lxp-cp{font-size:1.05rem;font-weight:900;color:#c8a96e;margin-top:6px}
.lxp-list{list-style:none;padding:0;margin:14px 0}
.lxp-list li{padding:7px 0 7px 26px;position:relative;border-bottom:1px solid #f0ece4;font-size:.94rem;color:#444}
.lxp-list li:before{content:"✓";position:absolute;left:0;color:#c8a96e;font-weight:700}
.lxp-faq details{border:1px solid #e8e0d0;border-radius:10px;margin-bottom:8px}
.lxp-faq summary{padding:14px 18px;cursor:pointer;font-weight:700;font-size:.93rem;color:#111;list-style:none;background:#fafafa}
.lxp-faq details[open] summary{background:#f5f0e8;color:#c8a96e}
.lxp-faq details p{padding:14px 18px;margin:0;font-size:.91rem;color:#555}
.lxp-cta{background:linear-gradient(135deg,#111,#1c1408);border-radius:16px;padding:36px 28px;text-align:center;margin-top:36px}
.lxp-cta h2{color:#fff;margin:0 0 10px;font-size:1.35rem}
.lxp-cta p{color:rgba(255,255,255,.7);margin:0 0 20px}
@media(max-width:640px){.lxp-stats{grid-template-columns:1fr 1fr}.lxp-grid{grid-template-columns:1fr}.lxp-btns{flex-direction:column}.lxp-btn-gold,.lxp-btn-out{justify-content:center}}
</style>';

$now = current_time('mysql');
$results = [];

foreach($localities as $key => $l) {
    $slug    = $l['slug'];
    $city    = $l['city'];
    $cs      = $l['cs'];
    $dist    = $l['dist'];
    $barrios = $l['barrios'];
    $links   = interlinks($base, $localities, $key);
    $title   = "Stripper en {$cs} 2026 | Shows VIP desde 180\xe2\x82\xac \xc2\xb7 Esp. Luxury";

    $content = $css . '
<div class="lxp">
<div class="lxp-hero">
  <span class="lxp-rule"></span>
  <h1>Stripper en <em>'.$cs.'</em> 2026<br>Shows VIP a Domicilio desde 180&euro;</h1>
  <p>Agencia líder en shows de striptease a domicilio en '.$city.' &middot; '.$dist.' de Barcelona &middot; Confirmación en 2h</p>
  <div class="lxp-btns">
    <a href="'.$wa.'" class="lxp-btn-gold">&#128242;&nbsp; Reservar por WhatsApp</a>
    <a href="'.$tel.'" class="lxp-btn-out">&#128222;&nbsp; '.$num.'</a>
  </div>
  <div class="lxp-trust">
    <span>&#11088;&#11088;&#11088;&#11088;&#11088; +2.000 fiestas</span>
    <span>&#128274; 100% Discreto</span>
    <span>&#9889; Confirmación 2h</span>
    <span>&#128506; Toda el área BCN</span>
  </div>
</div>

<div class="lxp-stats">
  <div class="lxp-stat"><span class="lxp-sn">+15</span><span class="lxp-sl">Años de experiencia</span></div>
  <div class="lxp-stat"><span class="lxp-sn">+2.000</span><span class="lxp-sl">Eventos en Cataluña</span></div>
  <div class="lxp-stat"><span class="lxp-sn">5/5</span><span class="lxp-sl">Valoración media</span></div>
  <div class="lxp-stat"><span class="lxp-sn">2h</span><span class="lxp-sl">Tiempo confirmación</span></div>
</div>

<h2>Stripper a Domicilio en '.$city.'</h2>
<p>Contratar un <strong>stripper en '.$cs.'</strong> para una despedida de soltera, cumpleaños o fiesta privada en 2026 es fácil con <strong>Espectáculos Luxury</strong>. Operamos a '.$dist.' del centro de Barcelona, cubriendo todos los barrios: <strong>'.$barrios.'</strong> y alrededores.</p>
<p>Más de 15 años de experiencia organizando shows de striptease profesionales en domicilios, hoteles y locales privados de '.$city.'. Artistas verificadas y 100% profesionales. <strong>Confirmamos en menos de 2 horas.</strong></p>

<h2>Catálogo de Shows en '.$cs.'</h2>
<div class="lxp-grid">
  <div class="lxp-card"><div class="lxp-ct">⭐ Más popular</div><div class="lxp-cn">Show Integral</div><p style="font-size:.87rem;color:#555;margin:4px 0">Striptease completo 30-45 min con artista profesional.</p><div class="lxp-cp">desde 180&euro;</div></div>
  <div class="lxp-card"><div class="lxp-ct">✨ Premium</div><div class="lxp-cn">Show Lésbico Dúo</div><p style="font-size:.87rem;color:#555;margin:4px 0">Dos artistas con coreografía conjunta. El más solicitado.</p><div class="lxp-cp">desde 330&euro;</div></div>
  <div class="lxp-card"><div class="lxp-ct">🎉 Especial</div><div class="lxp-cn">Show con Juguete Erótico</div><p style="font-size:.87rem;color:#555;margin:4px 0">Show integral con elemento extra para fiestas adultas.</p><div class="lxp-cp">desde 300&euro;</div></div>
  <div class="lxp-card"><div class="lxp-ct">🏠 Toda la fiesta</div><div class="lxp-cn">Camarera Sexy</div><p style="font-size:.87rem;color:#555;margin:4px 0">Atención toda la celebración en lencería exclusiva.</p><div class="lxp-cp">180&euro; / hora</div></div>
  <div class="lxp-card"><div class="lxp-ct">💎 Todo incluido</div><div class="lxp-cn">Pack Camarera + Show</div><p style="font-size:.87rem;color:#555;margin:4px 0">Camarera durante la fiesta + show final incluido.</p><div class="lxp-cp">desde 380&euro;</div></div>
  <div class="lxp-card"><div class="lxp-ct">👩 Para chicas</div><div class="lxp-cn">Stripper Masculino</div><p style="font-size:.87rem;color:#555;margin:4px 0">Shows masculinos profesionales para despedidas de soltera.</p><div class="lxp-cp">desde 180&euro;</div></div>
</div>

<h2>¿Por Qué Elegirnos en '.$cs.'?</h2>
<ul class="lxp-list">
  <li>Más de 15 años de experiencia en '.$city.' y toda el área de Barcelona</li>
  <li>Artistas verificadas, profesionales y con experiencia demostrada</li>
  <li>Confirmación de reserva garantizada en menos de 2 horas</li>
  <li>Discreción absoluta: sin cargos descriptivos en la factura</li>
  <li>Desplazamiento incluido en '.$city.' y hasta 30 km del centro de BCN</li>
  <li>Disponibilidad 24h, 365 días al año incluyendo festivos</li>
  <li>Precios transparentes: todo incluido desde el primer presupuesto</li>
  <li>Shows personalizables según tipo de evento y preferencias</li>
</ul>

<h2>Preguntas Frecuentes</h2>
<div class="lxp-faq">
  <details><summary>¿Cuánto cuesta contratar un stripper en '.$cs.'?</summary><p>Los shows en '.$city.' empiezan desde <strong>180&euro;</strong> (Show Integral). Lésbico Dúo desde <strong>330&euro;</strong>, con Juguete desde <strong>300&euro;</strong>, Camarera Sexy <strong>180&euro;/hora</strong>, Pack desde <strong>380&euro;</strong>. Desplazamiento incluido.</p></details>
  <details><summary>¿Cuánto tardan en confirmar?</summary><p>Confirmamos en <strong>menos de 2 horas</strong> por WhatsApp o teléfono. Llama al <strong>'.$num.'</strong> o escríbenos.</p></details>
  <details><summary>¿Cubren todos los barrios de '.$cs.'?</summary><p>Sí, cubrimos <strong>'.$barrios.'</strong> y todos sus alrededores. Sin recargo de desplazamiento.</p></details>
  <details><summary>¿Se puede contratar para hotel o apartamento?</summary><p>Sí, actuamos en hoteles, apartamentos turísticos y Airbnbs de '.$city.'. Discreción total garantizada.</p></details>
  <details><summary>¿Disponibilidad fines de semana?</summary><p><strong>24 horas, 365 días al año</strong>, incluyendo fines de semana, festivos y temporada alta.</p></details>
</div>

<div class="lxp-cta">
  <h2>¿Listo para Reservar en '.$cs.'?</h2>
  <p>Confirmamos en menos de 2 horas &middot; Disponibles 24h &middot; 365 días</p>
  <div class="lxp-btns">
    <a href="'.$wa.'" class="lxp-btn-gold">&#128242;&nbsp; Reservar por WhatsApp</a>
    <a href="'.$tel.'" class="lxp-btn-out">&#128222;&nbsp; Llamar ahora</a>
  </div>
</div>

'.$links.'
</div>';

    // ── Check if product already exists ──────────────────────────────────────
    $existing_id = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->posts} WHERE post_name=%s AND post_type='product' LIMIT 1", $slug
    ));

    if($existing_id) {
        // UPDATE
        $wpdb->update($wpdb->posts, [
            'post_title'        => $title,
            'post_content'      => $content,
            'post_status'       => 'publish',
            'post_modified'     => $now,
            'post_modified_gmt' => get_gmt_from_date($now),
        ], ['ID' => $existing_id]);
        $post_id = $existing_id;
        $action  = 'UPDATED';
    } else {
        // INSERT
        $wpdb->insert($wpdb->posts, [
            'post_author'           => 1,
            'post_date'             => $now,
            'post_date_gmt'         => get_gmt_from_date($now),
            'post_content'          => $content,
            'post_title'            => $title,
            'post_excerpt'          => '',
            'post_status'           => 'publish',
            'comment_status'        => 'closed',
            'ping_status'           => 'closed',
            'post_name'             => $slug,
            'post_modified'         => $now,
            'post_modified_gmt'     => get_gmt_from_date($now),
            'post_type'             => 'product',
            'post_content_filtered' => '',
            'to_ping'               => '',
            'pinged'                => '',
            'guid'                  => home_url('/producto/'.$slug.'/'),
        ]);
        $post_id = $wpdb->insert_id;
        $action  = 'CREATED';
    }

    if(!$post_id) { echo "ERROR on {$slug}: ".$wpdb->last_error."\n"; continue; }

    // ── Set product type (term) ───────────────────────────────────────────────
    $simple_term = get_term_by('slug','simple','product_type');
    if($simple_term) {
        $wpdb->replace("{$wpdb->prefix}term_relationships",[
            'object_id'        => $post_id,
            'term_taxonomy_id' => $simple_term->term_taxonomy_id,
            'term_order'       => 0,
        ]);
    }

    // ── Assign to category ────────────────────────────────────────────────────
    $cat_tt = $wpdb->get_var($wpdb->prepare(
        "SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE term_id=%d AND taxonomy='product_cat'", $cat_id
    ));
    if($cat_tt) {
        $wpdb->replace("{$wpdb->prefix}term_relationships",[
            'object_id'        => $post_id,
            'term_taxonomy_id' => $cat_tt,
            'term_order'       => 0,
        ]);
        // Update count
        $wpdb->query($wpdb->prepare(
            "UPDATE {$wpdb->term_taxonomy} SET count=count+1 WHERE term_taxonomy_id=%d", $cat_tt
        ));
    }

    // ── Post meta ─────────────────────────────────────────────────────────────
    $meta = [
        '_price'                 => '180',
        '_regular_price'         => '180',
        '_visibility'            => 'visible',
        '_virtual'               => 'yes',
        '_stock_status'          => 'instock',
        '_manage_stock'          => 'no',
        'total_sales'            => '0',
        '_wc_average_rating'     => '5',
        '_wc_review_count'       => '10',
        'rank_math_title'        => "Stripper en {$cs} 2026 | Shows VIP desde 180€ · Espectáculos Luxury",
        'rank_math_description'  => "Contrata stripper en {$cs} desde 180€. Shows a domicilio, despedidas y fiestas. Toda {$city}. Artistas verificadas. Confirmación en 2h. +2.000 eventos.",
        'rank_math_robots'       => ['index','follow'],
    ];
    foreach($meta as $k => $v) {
        $val = is_array($v) ? serialize($v) : $v;
        $exists = $wpdb->get_var($wpdb->prepare(
            "SELECT meta_id FROM {$wpdb->postmeta} WHERE post_id=%d AND meta_key=%s", $post_id, $k
        ));
        if($exists) {
            $wpdb->update($wpdb->postmeta, ['meta_value'=>$val], ['post_id'=>$post_id,'meta_key'=>$k]);
        } else {
            $wpdb->insert($wpdb->postmeta, ['post_id'=>$post_id,'meta_key'=>$k,'meta_value'=>$val]);
        }
    }

    // Clean product lookup cache
    $wpdb->delete("{$wpdb->prefix}wc_product_meta_lookup", ['product_id'=>$post_id]);
    $wpdb->insert("{$wpdb->prefix}wc_product_meta_lookup", [
        'product_id'    => $post_id,
        'sku'           => '',
        'virtual'       => 1,
        'downloadable'  => 0,
        'min_price'     => 180,
        'max_price'     => 380,
        'onsale'        => 0,
        'stock_quantity'=> null,
        'stock_status'  => 'instock',
        'rating_count'  => 10,
        'average_rating'=> 5.0,
        'total_sales'   => 0,
        'tax_status'    => 'taxable',
        'tax_class'     => '',
    ]);

    $results[] = "{$action} ID:{$post_id} → {$slug}";
    echo "✅ {$action} ID:{$post_id} — {$cs}\n";
}

// ── Update mu-plugin with new slugs ──────────────────────────────────────────
$mu_path    = '/var/www/vhosts/espectaculosluxury.com/httpdocs/wp-content/mu-plugins/bcn-product-rewrite.php';
$mu_content = file_get_contents($mu_path);

$new_slugs = [
    'stripper-hospitalet-de-llobregat-producto',
    'stripper-badalona-producto',
    'stripper-cornella-de-llobregat-producto',
    'stripper-sant-cugat-del-valles-producto',
    'stripper-sabadell-producto',
    'stripper-terrassa-producto',
    'stripper-sitges-producto',
    'stripper-castelldefels-producto',
    'stripper-mataro-producto',
    'stripper-santa-coloma-de-gramenet-producto',
    'stripper-area-metropolitana-barcelona-producto',
];

$already_added = strpos($mu_content, 'stripper-hospitalet-de-llobregat-producto') !== false;
if(!$already_added) {
    $insert_after = "'stripper-cumpleanos-barcelona-producto',";
    $new_entries  = $insert_after."\n";
    foreach($new_slugs as $s) $new_entries .= "        '{$s}',\n";
    $new_entries  = rtrim($new_entries, "\n,").',';
    $mu_new = str_replace($insert_after, $new_entries, $mu_content);
    file_put_contents($mu_path, $mu_new);
    echo "\n✅ mu-plugin actualizado con ".count($new_slugs)." nuevos slugs\n";
} else {
    echo "\n✅ mu-plugin ya tenía los slugs de localidad\n";
}

// ── Flush rewrite rules via DB ────────────────────────────────────────────────
delete_option('rewrite_rules');
wp_cache_flush();
do_action('litespeed_purge_all');
echo "✅ Rewrite rules + cache flushed\n";

// ── Final URL check ───────────────────────────────────────────────────────────
echo "\n=== URLs FINALES ===\n";
foreach($localities as $key => $l) {
    $id = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->posts} WHERE post_name=%s AND post_type='product' LIMIT 1", $l['slug']
    ));
    echo ($id ? "✅" : "❌")." {$base}{$l['slug']}/ → ".($id?"ID:{$id}":"MISSING")."\n";
}
echo "\nDone!\n";
