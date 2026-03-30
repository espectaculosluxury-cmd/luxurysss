<?php
/**
 * ═══════════════════════════════════════════════════════════════════════════
 *  LUX LANDING BUILDER — PLANTILLA PRODUCTO DE LOCALIDAD
 *  Versión: 1.0.0  |  Patrón: create_locality_products_v2.php (Barcelona)
 * ═══════════════════════════════════════════════════════════════════════════
 *
 * VARIABLES DISPONIBLES (inyectadas por deployer.php):
 * ──────────────────────────────────────────────────────────────────────────
 *  $cfg         → array config provincia
 *  $locality    → array datos localidad {key, slug, city, cs, dist, barrios}
 *  $localities  → array TODAS las localidades (para interlinks)
 *
 * Accesos directos:
 *  $city    → nombre completo    ("Hospitalet de Llobregat")
 *  $cs      → nombre corto       ("Hospitalet")
 *  $dist    → distancia          ("5 km")
 *  $barrios → barrios            ("Centre, Bellvitge…")
 *  $prov    → provincia          ("Barcelona")
 *  $base_url → URL base categoría
 *  $wa      → URL WhatsApp
 *  $tel     → URL tel:
 *  $num     → número visible
 *  $years   → años experiencia
 *  $events  → eventos realizados
 * ═══════════════════════════════════════════════════════════════════════════
 */

if ( ! defined( 'LUX_BUILDER_DIR' ) ) { exit; }

// ── Accesos directos ────────────────────────────────────────────────────────
$city    = $locality['city'];
$cs      = $locality['cs'];
$dist    = $locality['dist'];
$barrios = $locality['barrios'];
$key     = $locality['key'];
$prov    = $cfg['prov_name'];
$prov_slug = $cfg['prov_slug'];
$base_url  = rtrim( $cfg['base_url'], '/' ) . '/';
$wa        = 'https://wa.me/' . $cfg['wa_phone'] . '?text=' . rawurlencode( 'Hola, quiero contratar un stripper en ' . $city );
$tel       = 'tel:+' . preg_replace('/\D/','',$cfg['wa_phone']);
$num       = $cfg['phone_display'];
$years     = $cfg['years'];
$events    = $cfg['events'];
$landing_url = get_site_url() . '/stripper-' . $prov_slug . '/';

// Show images (use province-specific or fall back to BCN images)
$img      = $cfg['show_images'] ?? [];
$img_base = 'https://espectaculosluxury.com/wp-content/uploads/2026/03/';
$i_card1  = $img['integral']  ?? $img_base . 'bcn-stripper-01.jpg';
$i_card2  = $img['lesbico']   ?? $img_base . 'bcn-stripper-08.jpg';
$i_card3  = $img['camarera']  ?? $img_base . 'bcn-stripper-05.jpg';
$i_card4  = $img['pack']      ?? $img_base . 'bcn-stripper-06.jpg';
$i_card5  = $img['juguete']   ?? $img_base . 'bcn-stripper-10.jpg';
$i_card6  = $img['masculino'] ?? $img_base . 'bcn-stripper-14.jpg';

// ── Interlink pills ─────────────────────────────────────────────────────────
function lux_product_interlinks( $base_url, $localities, $current_key, $prov, $landing_url ) {
    $html  = '<div style="margin-top:40px;padding:24px;background:#f9f6f0;border-radius:12px;border:1px solid #e8e0d0;">';
    $html .= '<p style="font-size:.78rem;letter-spacing:.1em;text-transform:uppercase;color:#c8a96e;font-weight:700;margin:0 0 14px;">📍 Stripper en otras ciudades de ' . esc_html($prov) . '</p>';
    $html .= '<div style="display:flex;flex-wrap:wrap;gap:8px 10px;">';
    $html .= '<a href="' . esc_url($landing_url) . '" style="color:#c8a96e;text-decoration:none;padding:5px 13px;border:1px solid #c8a96e;border-radius:20px;font-size:.82rem;">🏠 ' . esc_html($prov) . ' Ciudad</a>';
    foreach ( $localities as $k => $l ) {
        if ( $k === $current_key ) continue;
        $html .= '<a href="' . esc_url($base_url . $l['slug'] . '/') . '" style="color:#c8a96e;text-decoration:none;padding:5px 13px;border:1px solid #c8a96e;border-radius:20px;font-size:.82rem;">📍 Stripper ' . esc_html($l['cs']) . '</a>';
    }
    $html .= '</div></div>';
    return $html;
}

// ── Build HTML ───────────────────────────────────────────────────────────────
ob_start();
?>
<style>
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
.lxp-card-img{width:100%;height:140px;object-fit:cover;object-position:top center;border-radius:8px;margin-bottom:10px;display:block}
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
</style>

<div class="lxp">

<!-- HERO -->
<div class="lxp-hero">
  <span class="lxp-rule"></span>
  <h1>Stripper en <em><?php echo esc_html($cs); ?></em> 2026<br>Shows VIP a Domicilio desde 180&euro;</h1>
  <p>Agencia l&#237;der en shows de striptease a domicilio en <?php echo esc_html($city); ?> &middot; <?php echo esc_html($dist); ?> de <?php echo esc_html($prov); ?> &middot; Confirmaci&#243;n en 2h</p>
  <div class="lxp-btns">
    <a href="<?php echo esc_url($wa); ?>" class="lxp-btn-gold">&#128242;&nbsp; Reservar por WhatsApp</a>
    <a href="<?php echo esc_url($tel); ?>" class="lxp-btn-out">&#128222;&nbsp; <?php echo esc_html($num); ?></a>
  </div>
  <div class="lxp-trust">
    <span>&#11088;&#11088;&#11088;&#11088;&#11088; <?php echo esc_html($events); ?> fiestas</span>
    <span>&#128274; 100% Discreto</span>
    <span>&#9889; Confirmaci&#243;n 2h</span>
    <span>&#128506; Toda el &#225;rea <?php echo esc_html(strtoupper(substr($prov_slug,0,3))); ?></span>
  </div>
</div>

<!-- STATS -->
<div class="lxp-stats">
  <div class="lxp-stat"><span class="lxp-sn"><?php echo esc_html($years); ?></span><span class="lxp-sl">A&#241;os de experiencia</span></div>
  <div class="lxp-stat"><span class="lxp-sn"><?php echo esc_html($events); ?></span><span class="lxp-sl">Eventos en la provincia</span></div>
  <div class="lxp-stat"><span class="lxp-sn">5/5</span><span class="lxp-sl">Valoraci&#243;n media</span></div>
  <div class="lxp-stat"><span class="lxp-sn">2h</span><span class="lxp-sl">Tiempo confirmaci&#243;n</span></div>
</div>

<!-- INTRO SEO -->
<h2>Stripper a Domicilio en <?php echo esc_html($city); ?></h2>
<p>Contratar un <strong>stripper en <?php echo esc_html($cs); ?></strong> para una despedida de soltera, cumplea&#241;os o fiesta privada en 2026 es f&#225;cil con <strong>Espect&#225;culos Luxury</strong>. Operamos a <?php echo esc_html($dist); ?> del centro de <?php echo esc_html($prov); ?>, cubriendo todos los barrios: <strong><?php echo esc_html($barrios); ?></strong> y alrededores.</p>
<p>M&#225;s de <?php echo esc_html($years); ?> a&#241;os de experiencia organizando shows de striptease profesionales en domicilios, hoteles y locales privados de <?php echo esc_html($city); ?>. Artistas verificadas y 100% profesionales. <strong>Confirmamos en menos de 2 horas.</strong></p>

<!-- CATÁLOGO -->
<h2>Cat&#225;logo de Shows en <?php echo esc_html($cs); ?></h2>
<div class="lxp-grid">

  <div class="lxp-card">
    <img src="<?php echo esc_url($i_card1); ?>" alt="Show Integral stripper <?php echo esc_attr($cs); ?> 2026" loading="lazy" class="lxp-card-img">
    <div class="lxp-ct">&#11088; M&#225;s popular</div>
    <div class="lxp-cn">Show Integral</div>
    <p style="font-size:.87rem;color:#555;margin:4px 0">Striptease completo 30&#8209;45 min con artista profesional.</p>
    <div class="lxp-cp">desde 180&euro;</div>
  </div>

  <div class="lxp-card">
    <img src="<?php echo esc_url($i_card2); ?>" alt="Show L&#233;sbico D&#250;o <?php echo esc_attr($cs); ?> despedidas" loading="lazy" class="lxp-card-img">
    <div class="lxp-ct">&#10024; Premium</div>
    <div class="lxp-cn">Show L&#233;sbico D&#250;o</div>
    <p style="font-size:.87rem;color:#555;margin:4px 0">Dos artistas con coreograf&#237;a conjunta. El m&#225;s solicitado.</p>
    <div class="lxp-cp">desde 330&euro;</div>
  </div>

  <div class="lxp-card">
    <img src="<?php echo esc_url($i_card3); ?>" alt="Camarera Sexy <?php echo esc_attr($cs); ?> fiesta privada" loading="lazy" class="lxp-card-img">
    <div class="lxp-ct">&#127946; Toda la fiesta</div>
    <div class="lxp-cn">Camarera Sexy</div>
    <p style="font-size:.87rem;color:#555;margin:4px 0">Atenci&#243;n toda la celebraci&#243;n en lencer&#237;a exclusiva.</p>
    <div class="lxp-cp">180&euro; / hora</div>
  </div>

  <div class="lxp-card">
    <img src="<?php echo esc_url($i_card4); ?>" alt="Pack Camarera m&#225;s Show <?php echo esc_attr($cs); ?>" loading="lazy" class="lxp-card-img">
    <div class="lxp-ct">&#128142; Todo incluido</div>
    <div class="lxp-cn">Pack Camarera + Show</div>
    <p style="font-size:.87rem;color:#555;margin:4px 0">Camarera durante la fiesta + show final incluido.</p>
    <div class="lxp-cp">desde 380&euro;</div>
  </div>

  <div class="lxp-card">
    <img src="<?php echo esc_url($i_card5); ?>" alt="Show Juguete Er&#243;tico <?php echo esc_attr($cs); ?>" loading="lazy" class="lxp-card-img">
    <div class="lxp-ct">&#127881; Especial</div>
    <div class="lxp-cn">Show con Juguete Er&#243;tico</div>
    <p style="font-size:.87rem;color:#555;margin:4px 0">Show integral con elemento extra para fiestas adultas.</p>
    <div class="lxp-cp">desde 300&euro;</div>
  </div>

  <div class="lxp-card">
    <img src="<?php echo esc_url($i_card6); ?>" alt="Stripper Masculino <?php echo esc_attr($cs); ?> para chicas" loading="lazy" class="lxp-card-img">
    <div class="lxp-ct">&#128170; Para chicas</div>
    <div class="lxp-cn">Stripper Masculino</div>
    <p style="font-size:.87rem;color:#555;margin:4px 0">Shows masculinos profesionales para despedidas de soltera.</p>
    <div class="lxp-cp">desde 180&euro;</div>
  </div>

</div>

<!-- POR QUÉ ELEGIRNOS -->
<h2>&#191;Por Qu&#233; Elegirnos en <?php echo esc_html($cs); ?>?</h2>
<ul class="lxp-list">
  <li>M&#225;s de <?php echo esc_html($years); ?> a&#241;os de experiencia en <?php echo esc_html($city); ?> y toda el &#225;rea de <?php echo esc_html($prov); ?></li>
  <li>Artistas verificadas, profesionales y con experiencia demostrada</li>
  <li>Confirmaci&#243;n de reserva garantizada en menos de 2 horas</li>
  <li>Discreci&#243;n absoluta: sin cargos descriptivos en la factura</li>
  <li>Desplazamiento incluido en <?php echo esc_html($city); ?> y hasta 30 km del centro de <?php echo esc_html($prov); ?></li>
  <li>Disponibilidad 24h, 365 d&#237;as al a&#241;o incluyendo festivos</li>
  <li>Precios transparentes: todo incluido desde el primer presupuesto</li>
  <li>Shows personalizables seg&#250;n tipo de evento y preferencias</li>
</ul>

<!-- FAQ -->
<h2>Preguntas Frecuentes</h2>
<div class="lxp-faq">
  <details><summary>&#191;Cu&#225;nto cuesta contratar un stripper en <?php echo esc_html($cs); ?>?</summary><p>Los shows en <?php echo esc_html($city); ?> empiezan desde <strong>180&euro;</strong> (Show Integral). L&#233;sbico D&#250;o desde <strong>330&euro;</strong>, con Juguete desde <strong>300&euro;</strong>, Camarera Sexy <strong>180&euro;/hora</strong>, Pack desde <strong>380&euro;</strong>. Desplazamiento incluido.</p></details>
  <details><summary>&#191;Cu&#225;nto tardan en confirmar?</summary><p>Confirmamos en <strong>menos de 2 horas</strong> por WhatsApp o tel&#233;fono. Llama al <strong><?php echo esc_html($num); ?></strong> o esc&#237;benos.</p></details>
  <details><summary>&#191;Cubren todos los barrios de <?php echo esc_html($cs); ?>?</summary><p>S&#237;, cubrimos <strong><?php echo esc_html($barrios); ?></strong> y todos sus alrededores. Sin recargo de desplazamiento.</p></details>
  <details><summary>&#191;Se puede contratar para hotel o apartamento?</summary><p>S&#237;, actuamos en hoteles, apartamentos tur&#237;sticos y Airbnbs de <?php echo esc_html($city); ?>. Discreci&#243;n total garantizada.</p></details>
  <details><summary>&#191;Disponibilidad fines de semana?</summary><p><strong>24 horas, 365 d&#237;as al a&#241;o</strong>, incluyendo fines de semana, festivos y temporada alta.</p></details>
</div>

<!-- CTA -->
<div class="lxp-cta">
  <h2>&#191;Listo para Reservar en <?php echo esc_html($cs); ?>?</h2>
  <p>Confirmamos en menos de 2 horas &middot; Disponibles 24h &middot; 365 d&#237;as</p>
  <div class="lxp-btns">
    <a href="<?php echo esc_url($wa); ?>" class="lxp-btn-gold">&#128242;&nbsp; Reservar por WhatsApp</a>
    <a href="<?php echo esc_url($tel); ?>" class="lxp-btn-out">&#128222;&nbsp; Llamar ahora</a>
  </div>
</div>

<?php echo lux_product_interlinks( $base_url, $localities, $key, $prov, $landing_url ); ?>

</div><!-- /.lxp -->
<?php
return ob_get_clean();
