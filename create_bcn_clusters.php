<?php
/**
 * Create Barcelona Cluster Pages (3 remaining + update 2 existing)
 * Clusters: Cumpleaños, Fiestas Privadas, Stripper Masculino
 * Also update: Despedidas (67991), A Domicilio (67992)
 * Gold Minimal Pro design — same CSS variables as landing
 */
$conn = new mysqli('localhost','UsrDBespLu2015','spol2vi0xy1go','DBespLu2015');
$conn->set_charset('utf8mb4');

$now = current_time_mysql();
function current_time_mysql(){ return date('Y-m-d H:i:s'); }

// Image bank
$imgs = [
  'hero1'  => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-01.jpg',
  'hero2'  => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-02.jpg',
  'hero3'  => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-03.jpg',
  'hero4'  => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-04.jpg',
  'hero5'  => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-05.jpg',
  'hero6'  => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-06.jpg',
  'hero7'  => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-07.jpg',
  'hero8'  => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-08.jpg',
  'hero9'  => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-09.jpg',
  'hero10' => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-10.jpg',
  'hero11' => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-11.jpg',
  'hero12' => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-12.jpg',
  'hero13' => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-13.jpg',
  'hero14' => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-14.jpg',
  'hero15' => 'https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-15.jpg',
];

$base_url   = 'https://espectaculosluxury.com';
$landing    = $base_url . '/stripper-barcelona/';
$cat_url    = $base_url . '/categoria-producto/contratar-striper-a-domicilio-despedidas-cumpleanos-hoteles/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/';

// ─── Shared CSS ─────────────────────────────────────────────────────────────
$css = <<<'CSS'
<style>
#lux-cluster{--lux-gold:#c8a96e;--lux-gold2:#e0bc6a;--lux-dark:#111;--lux-dark2:#1a1a1a;--lux-light:#f9f6f0;--lux-text:#2a2a2a;--r:6px;font-family:'Inter','Helvetica Neue',Arial,sans-serif;color:var(--lux-text);background:#fff}
#lux-cluster *{box-sizing:border-box;margin:0;padding:0}
.lxc-hero{background:linear-gradient(135deg,rgba(10,10,10,.92) 0%,rgba(26,26,26,.88) 60%,rgba(40,30,10,.85) 100%),var(--hero-img,url('')) center/cover no-repeat;color:#fff;padding:72px 20px 60px;text-align:center;position:relative;overflow:hidden}
.lxc-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at center top,rgba(200,169,110,.08) 0%,transparent 70%);pointer-events:none}
.lxc-hero__inner{max-width:820px;margin:0 auto;position:relative;z-index:1}
.lxc-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(200,169,110,.12);border:1px solid rgba(200,169,110,.35);border-radius:var(--r);padding:6px 14px;font-size:.7rem;color:var(--lux-gold);letter-spacing:.08em;text-transform:uppercase;margin-bottom:20px}
.lxc-badge::before{content:'';display:inline-block;width:6px;height:6px;border-radius:50%;background:var(--lux-gold);animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}
.lxc-h1{font-size:clamp(1.6rem,4vw,2.6rem);font-weight:800;line-height:1.18;color:#fff;margin-bottom:16px;letter-spacing:-.02em}
.lxc-h1 span{color:var(--lux-gold)}
.lxc-hero-sub{font-size:1rem;color:rgba(255,255,255,.8);max-width:620px;margin:0 auto 26px;line-height:1.6}
.lxc-cta-wrap{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin-bottom:28px}
.lxc-btn{display:inline-flex;align-items:center;gap:8px;padding:13px 24px;border-radius:var(--r);font-weight:700;font-size:.9rem;text-decoration:none;transition:all .2s}
.lxc-btn--gold{background:linear-gradient(135deg,var(--lux-gold),var(--lux-gold2));color:#111}
.lxc-btn--gold:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(200,169,110,.4)}
.lxc-btn--outline{background:transparent;color:#fff;border:1.5px solid rgba(255,255,255,.4)}
.lxc-btn--outline:hover{border-color:var(--lux-gold);color:var(--lux-gold)}
.lxc-trust{display:flex;flex-wrap:wrap;justify-content:center;gap:16px}
.lxc-trust-item{display:flex;align-items:center;gap:6px;font-size:.76rem;color:rgba(255,255,255,.75);background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);padding:5px 12px;border-radius:100px}
/* Sections */
.lxc-sec{padding:56px 20px;max-width:1080px;margin:0 auto}
.lxc-wrap--dark{background:var(--lux-dark);padding:56px 20px;max-width:100%}
.lxc-wrap--light{background:var(--lux-light);padding:56px 20px;max-width:100%}
.lxc-wrap--dark .lxc-sec,.lxc-wrap--light .lxc-sec{padding:0;max-width:1080px;margin:0 auto}
.lxc-stitle{font-size:clamp(1.25rem,2.8vw,1.8rem);font-weight:800;color:var(--lux-dark);margin-bottom:6px;letter-spacing:-.02em}
.lxc-wrap--dark .lxc-stitle{color:#fff}
.lxc-ssub{color:#666;font-size:.93rem;margin-bottom:32px}
.lxc-wrap--dark .lxc-ssub{color:rgba(255,255,255,.58)}
.lxc-goldline{display:inline-block;width:44px;height:3px;background:linear-gradient(90deg,var(--lux-gold),var(--lux-gold2));border-radius:2px;margin:8px 0 14px}
/* Cards */
.lxc-cards{display:grid;grid-template-columns:repeat(auto-fill,minmax(270px,1fr));gap:18px;margin-top:8px}
.lxc-card{background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.07);transition:transform .2s,box-shadow .2s;border:1px solid rgba(200,169,110,.15)}
.lxc-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(0,0,0,.12)}
.lxc-card img{width:100%;height:190px;object-fit:cover;object-position:top}
.lxc-card__body{padding:16px}
.lxc-card__tag{font-size:.66rem;color:var(--lux-gold);text-transform:uppercase;letter-spacing:.07em;font-weight:700;margin-bottom:4px}
.lxc-card__h3{font-size:.96rem;font-weight:700;color:var(--lux-dark);margin-bottom:6px;line-height:1.3}
.lxc-card__p{font-size:.83rem;color:#666;line-height:1.5;margin-bottom:10px}
.lxc-card__price{font-size:1.05rem;font-weight:800;color:var(--lux-gold);margin-bottom:10px}
.lxc-card__link{display:inline-block;padding:8px 16px;background:linear-gradient(135deg,var(--lux-gold),var(--lux-gold2));color:#111;border-radius:var(--r);font-size:.8rem;font-weight:700;text-decoration:none;transition:opacity .2s}
.lxc-card__link:hover{opacity:.85}
/* Checklist */
.lxc-checklist{list-style:none;display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:7px 14px;margin-top:12px}
.lxc-checklist li{padding:7px 7px 7px 28px;position:relative;font-size:.88rem;color:#444;line-height:1.4}
.lxc-checklist li::before{content:'✓';position:absolute;left:8px;color:var(--lux-gold);font-weight:800}
/* Steps */
.lxc-steps{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;margin-top:18px}
.lxc-step{background:#fff;border-radius:10px;padding:20px;border:1px solid rgba(200,169,110,.18);text-align:center}
.lxc-step__num{width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--lux-gold),var(--lux-gold2));display:flex;align-items:center;justify-content:center;font-weight:900;font-size:1rem;color:#111;margin:0 auto 12px}
.lxc-step__h{font-weight:700;font-size:.9rem;color:var(--lux-dark);margin-bottom:4px}
.lxc-step__p{font-size:.8rem;color:#777;line-height:1.5}
/* Price Table */
.lxc-ptable{width:100%;border-collapse:collapse;margin-top:14px;border-radius:10px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.07)}
.lxc-ptable th{background:var(--lux-dark);color:var(--lux-gold);padding:11px 14px;font-size:.8rem;letter-spacing:.04em;text-transform:uppercase;text-align:left}
.lxc-ptable td{padding:11px 14px;border-bottom:1px solid rgba(200,169,110,.12);font-size:.88rem;background:#fff}
.lxc-ptable tr:last-child td{border-bottom:none}
.lxc-ptable .ph{font-weight:800;color:var(--lux-gold)}
/* Testimonials */
.lxc-testimonials{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:14px;margin-top:18px}
.lxc-testi{background:#fff;border-radius:10px;padding:18px;border-left:3px solid var(--lux-gold);box-shadow:0 2px 10px rgba(0,0,0,.06)}
.lxc-testi blockquote{font-size:.86rem;color:#555;line-height:1.6;margin-bottom:8px;font-style:italic}
.lxc-testi cite{font-size:.76rem;color:var(--lux-gold);font-weight:700;font-style:normal}
/* FAQ */
.lxc-faq{margin-top:18px}
.lxc-faq details{border:1px solid rgba(200,169,110,.2);border-radius:var(--r);margin-bottom:7px;background:#fff}
.lxc-faq details[open]{border-color:var(--lux-gold)}
.lxc-faq summary{padding:14px 16px;cursor:pointer;font-weight:700;font-size:.88rem;color:var(--lux-dark);list-style:none;display:flex;justify-content:space-between;align-items:center}
.lxc-faq summary::after{content:'+';font-size:1.3rem;color:var(--lux-gold)}
.lxc-faq details[open] summary::after{content:'−'}
.lxc-faq details p{padding:0 16px 13px;font-size:.86rem;color:#555;line-height:1.6}
/* Internal links */
.lxc-links{display:flex;flex-wrap:wrap;gap:10px;margin-top:18px}
.lxc-link-pill{display:inline-block;padding:8px 16px;background:#fff;border:1px solid rgba(200,169,110,.3);border-radius:100px;font-size:.82rem;color:var(--lux-dark);text-decoration:none;transition:all .2s}
.lxc-link-pill:hover{background:var(--lux-gold);color:#111;border-color:var(--lux-gold)}
/* CTA Final */
.lxc-cta-final{background:linear-gradient(135deg,var(--lux-dark) 0%,#1a1200 100%);padding:56px 20px;text-align:center}
.lxc-cta-final h2{font-size:1.7rem;font-weight:900;color:#fff;margin-bottom:8px}
.lxc-cta-final p{color:rgba(255,255,255,.68);margin-bottom:24px;font-size:.96rem}
@media(max-width:640px){.lxc-hero{padding:52px 14px 42px}.lxc-h1{font-size:1.42rem}}
</style>
CSS;

// ─── Helper: build JSON-LD block ─────────────────────────────────────────────
function build_jsonld($slug, $title, $desc, $url, $faqs, $keyword, $price_from) {
    $faq_json = '';
    foreach ($faqs as $f) {
        $faq_json .= '{"@type":"Question","name":'.json_encode($f[0]).',"acceptedAnswer":{"@type":"Answer","text":'.json_encode($f[1]).'}},';
    }
    $faq_json = rtrim($faq_json, ',');
    return '<script type="application/ld+json">
[
  {"@context":"https://schema.org","@type":"Service","name":'.json_encode($title).',"description":'.json_encode($desc).',"url":'.json_encode($url).',"provider":{"@type":"LocalBusiness","name":"Espectáculos Luxury","url":"https://espectaculosluxury.com","telephone":"+34644507282","address":{"@type":"PostalAddress","addressLocality":"Barcelona","addressRegion":"Cataluña","postalCode":"08001","addressCountry":"ES"},"priceRange":"180€-380€","aggregateRating":{"@type":"AggregateRating","ratingValue":"5","reviewCount":"312"}},"areaServed":{"@type":"City","name":"Barcelona"},"offers":{"@type":"Offer","priceCurrency":"EUR","price":'.json_encode($price_from).',"availability":"https://schema.org/InStock"}},
  {"@context":"https://schema.org","@type":"FAQPage","mainEntity":['.$faq_json.']}
]
</script>';
}

// ─────────────────────────────────────────────────────────────────────────────
// CLUSTER 1: DESPEDIDAS DE SOLTERA BARCELONA (update existing ID 67991)
// ─────────────────────────────────────────────────────────────────────────────
$desp_slug  = 'stripper-despedidas-soltera-barcelona';
$desp_url   = $base_url . '/' . $desp_slug . '/';
$desp_title = 'Stripper Despedida de Soltera Barcelona 2026 | Shows desde 180€';
$desp_desc_rm = 'Contrata stripper para despedida de soltera en Barcelona desde 180€. Shows personalizados en piso, hotel, villa o beach club. 8 municipios cubiertos. Confirmación en 2h, discreción total.';

$desp_faqs = [
  ['¿Cuánto cuesta contratar un stripper para despedida de soltera en Barcelona?','El precio base del Show Integral es 180€. El Show Lésbico Dúo parte desde 330€. El Pack Camarera Sexy + Show comienza en 380€. Todos los precios incluyen desplazamiento dentro de Barcelona ciudad y área metropolitana.'],
  ['¿Con cuánta antelación debo reservar el stripper para la despedida?','Recomendamos reservar con 48-72h de antelación para garantizar disponibilidad, especialmente viernes y sábados. Para fechas especiales (puentes, festivos) reservar con 1 semana.'],
  ['¿El stripper acude al piso de la novia?','Sí, realizamos el show en el domicilio, apartamento turístico, villa con piscina, hotel boutique o cualquier espacio privado en Barcelona y municipios cercanos.'],
  ['¿Qué show se recomienda para una despedida de soltera?','El más popular es el Show Lésbico Dúo (330€) para grupos de 8-20 personas. Para grupos más pequeños el Show Integral (180€) es ideal. El Show con Juguete Erótico (300€) es la opción más atrevida.'],
  ['¿Es discreta la llegada del artista?','Totalmente. Los artistas acuden con ropa de calle, sin identificación externa en el vehículo, y solo se presentan como "sorpresa" ante el grupo.'],
  ['¿Hay strippers masculinos para despedidas mixtas o de soltero?','Sí, contamos con stripper masculino (chippendale) desde 180€, ideal para despedidas mixtas o grupos exclusivamente femeninos.'],
  ['¿Qué municipios cubre el servicio en Barcelona?','Cubrimos Barcelona ciudad, Badalona, Cornellà de Llobregat, Hospitalet de Llobregat, Mataró, Sabadell, Sant Cugat del Vallès y Terrassa, así como toda el área metropolitana.'],
  ['¿Se puede pagar contra reembolso o se requiere señal?','Aceptamos señal del 30% por transferencia o Bizum para confirmar la reserva, y el resto se abona en efectivo o Bizum antes de comenzar el show.'],
];

$desp_html = $css . '
<div id="lux-cluster">
<style>#lux-cluster .lxc-hero{--hero-img:url(' . $imgs['hero3'] . ')}</style>

<!-- HERO -->
<section class="lxc-hero">
  <div class="lxc-hero__inner">
    <span class="lxc-badge">💋 Shows Barcelona · Despedidas 2026</span>
    <h1 class="lxc-h1">Stripper para <span>Despedida de Soltera</span><br>en Barcelona 2026</h1>
    <p class="lxc-hero-sub">Shows profesionales a domicilio en Barcelona, Eixample, Gràcia, Barceloneta, hotels y villas. Strip-tease con coreografía, actriz o dúo lésbico. <strong style="color:var(--lux-gold)">Desde 180€ · Confirmación en 2h</strong></p>
    <div class="lxc-cta-wrap">
      <a href="https://wa.me/34644507282?text=Hola%2C+quiero+contratar+stripper+para+despedida+en+Barcelona" class="lxc-btn lxc-btn--gold">📲 Reservar por WhatsApp</a>
      <a href="' . $cat_url . '" class="lxc-btn lxc-btn--outline">🎭 Ver todos los shows</a>
    </div>
    <div class="lxc-trust">
      <span class="lxc-trust-item">⭐ 5/5 · 312 reseñas</span>
      <span class="lxc-trust-item">✅ Artistas certificados</span>
      <span class="lxc-trust-item">🔒 100% discreción</span>
      <span class="lxc-trust-item">🚀 Confirmación 2h</span>
    </div>
  </div>
</section>

<!-- INTRO SEO -->
<section style="padding:52px 20px;background:#fff">
  <div class="lxc-sec" style="max-width:800px;padding:0">
    <h2 style="font-size:1.35rem;font-weight:800;color:var(--lux-dark);margin-bottom:12px">Contrata el mejor stripper para despedida de soltera en Barcelona</h2>
    <p style="font-size:.92rem;color:#555;line-height:1.7;margin-bottom:12px">Organizar la <strong>despedida de soltera perfecta en Barcelona</strong> requiere una sorpresa que nadie olvide. En <strong>Espectáculos Luxury</strong> llevamos más de 10 años diseñando shows de striptease exclusivos para despedidas en Barcelona ciudad y toda el área metropolitana —desde el Eixample y Gràcia hasta apartamentos en la Barceloneta, villas con piscina en Sant Cugat del Vallès o suites en el barrio Gótico.</p>
    <p style="font-size:.92rem;color:#555;line-height:1.7;margin-bottom:12px">Nuestros artistas profesionales —actrices con formación en danza y coreografía— realizan shows personalizados adaptados al nivel de atrevimiento del grupo: desde un elegante <em>Show Integral</em> con strip-tease y accesorios hasta el espectacular <em>Show Lésbico Dúo</em> con dos artistas. Cada actuación incluye 45-60 minutos de show, música curada y un guion exclusivo con la novia como protagonista.</p>
    <h2 style="font-size:1.15rem;font-weight:800;color:var(--lux-dark);margin:22px 0 10px">¿Qué incluye el show en tu despedida?</h2>
    <ul class="lxc-checklist">
      <li>Strip-tease completo con coreografía personalizada</li>
      <li>Música y playlist curada para despedidas</li>
      <li>La novia como protagonista del show</li>
      <li>Desplazamiento incluido en Barcelona ciudad</li>
      <li>45-60 minutos de actuación</li>
      <li>Disfraces y accesorios de alta calidad</li>
      <li>Fotos y vídeo permitidos (acuerdo previo)</li>
      <li>Discreción y profesionalidad garantizadas</li>
    </ul>
  </div>
</section>

<!-- SHOWS CARDS -->
<div class="lxc-wrap--dark">
  <div class="lxc-sec">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">Shows disponibles para despedidas en Barcelona</h2>
    <p class="lxc-ssub">Elige el show que mejor se adapte a tu grupo y presupuesto</p>
    <div class="lxc-cards">
      <div class="lxc-card">
        <img src="' . $imgs['hero5'] . '" alt="Show Integral stripper despedida Barcelona" loading="lazy">
        <div class="lxc-card__body">
          <div class="lxc-card__tag">Más popular</div>
          <h3 class="lxc-card__h3">Show Integral de Stripper</h3>
          <p class="lxc-card__p">Coreografía profesional completa con strip-tease, accesorios y novia como protagonista.</p>
          <div class="lxc-card__price">Desde 180€</div>
          <a href="' . $base_url . '/show-integral-stripper-barcelona/" class="lxc-card__link">Ver show →</a>
        </div>
      </div>
      <div class="lxc-card">
        <img src="' . $imgs['hero8'] . '" alt="Show Lésbico Dúo despedida Barcelona" loading="lazy">
        <div class="lxc-card__body">
          <div class="lxc-card__tag">Show premium</div>
          <h3 class="lxc-card__h3">Show Lésbico Dúo</h3>
          <p class="lxc-card__p">Dos artistas profesionales en un show exclusivo para despedidas de soltera. Ideal para grupos.</p>
          <div class="lxc-card__price">Desde 330€</div>
          <a href="' . $base_url . '/show-lesbico-duo-barcelona/" class="lxc-card__link">Ver show →</a>
        </div>
      </div>
      <div class="lxc-card">
        <img src="' . $imgs['hero11'] . '" alt="Show Juguete Erótico Barcelona" loading="lazy">
        <div class="lxc-card__body">
          <div class="lxc-card__tag">Más atrevido</div>
          <h3 class="lxc-card__h3">Show con Juguete Erótico</h3>
          <p class="lxc-card__p">El show más audaz para despedidas: striptease completo con juguetes eróticos incluidos.</p>
          <div class="lxc-card__price">Desde 300€</div>
          <a href="' . $base_url . '/show-juguete-erotico-barcelona/" class="lxc-card__link">Ver show →</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- PRICE TABLE -->
<section style="padding:52px 20px;background:var(--lux-light,#f9f6f0)">
  <div class="lxc-sec" style="padding:0">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">Tabla de precios — Despedidas de Soltera Barcelona 2026</h2>
    <p class="lxc-ssub">Precios finales con desplazamiento incluido en Barcelona ciudad</p>
    <table class="lxc-ptable">
      <thead><tr><th>Show</th><th>Duración</th><th>Ideal para</th><th>Precio</th></tr></thead>
      <tbody>
        <tr><td>Show Integral</td><td>45 min</td><td>Grupos 4-10 pax</td><td class="ph">180€</td></tr>
        <tr><td>Show Lésbico Dúo</td><td>60 min</td><td>Grupos 8-20 pax</td><td class="ph">330€</td></tr>
        <tr><td>Show con Juguete Erótico</td><td>50 min</td><td>Grupos +18 atrevidas</td><td class="ph">300€</td></tr>
        <tr><td>Pack Camarera Sexy + Show</td><td>2-3 h</td><td>Fiestas completas</td><td class="ph">380€</td></tr>
        <tr><td>Stripper Masculino (Chippendale)</td><td>45 min</td><td>Grupos femeninos/mixtos</td><td class="ph">180€</td></tr>
      </tbody>
    </table>
  </div>
</section>

<!-- STEPS -->
<section style="padding:52px 20px;background:#fff">
  <div class="lxc-sec" style="padding:0">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">¿Cómo contratar el stripper para tu despedida?</h2>
    <p class="lxc-ssub">Proceso sencillo en 4 pasos — confirmación en menos de 2 horas</p>
    <div class="lxc-steps">
      <div class="lxc-step"><div class="lxc-step__num">1</div><h3 class="lxc-step__h">Contacta por WhatsApp</h3><p class="lxc-step__p">Escríbenos con fecha, ubicación y show deseado. Presupuesto inmediato.</p></div>
      <div class="lxc-step"><div class="lxc-step__num">2</div><h3 class="lxc-step__h">Elige show y artista</h3><p class="lxc-step__p">Te enviamos catálogo de artistas disponibles para tu fecha. Tú eliges.</p></div>
      <div class="lxc-step"><div class="lxc-step__num">3</div><h3 class="lxc-step__h">Confirma con señal 30%</h3><p class="lxc-step__p">Reserva asegurada con señal por Bizum o transferencia. Confirmación escrita.</p></div>
      <div class="lxc-step"><div class="lxc-step__num">4</div><h3 class="lxc-step__h">¡Disfruta el show!</h3><p class="lxc-step__p">La artista llega puntual, discreta y preparada para una noche inolvidable.</p></div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<div class="lxc-wrap--dark">
  <div class="lxc-sec">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">Reseñas reales — Despedidas en Barcelona</h2>
    <p class="lxc-ssub">Lo que dicen las novias y grupos que han confiado en nosotros</p>
    <div class="lxc-testimonials">
      <div class="lxc-testi"><blockquote>"Contratamos el show lésbico dúo para la despedida de mi hermana en un apartamento en Barceloneta. Las chicas fueron increíbles, muy profesionales y la novia quedó sin palabras. ¡100% recomendable!"</blockquote><cite>— Marta G., Barcelona</cite></div>
      <div class="lxc-testi"><blockquote>"Organizamos la despedida en una villa de Sant Cugat y el show integral fue el punto álgido de la noche. La artista llegó a tiempo, fue súper discreta y el show superó todas las expectativas."</blockquote><cite>— Laura P., Sant Cugat del Vallès</cite></div>
      <div class="lxc-testi"><blockquote>"Reservé con solo 24 horas de antelación y lo gestionaron todo perfectamente. Show en hotel en el Eixample, muy profesional. El precio fue justo y el show increíble."</blockquote><cite>— Sandra M., Eixample Barcelona</cite></div>
    </div>
  </div>
</div>

<!-- FAQ -->
<section style="padding:52px 20px;background:var(--lux-light,#f9f6f0)">
  <div class="lxc-sec" style="padding:0">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">Preguntas frecuentes — Stripper despedida Barcelona</h2>
    <div class="lxc-faq">';
foreach ($desp_faqs as $f) {
    $desp_html .= '<details><summary>' . htmlspecialchars($f[0]) . '</summary><p>' . $f[1] . '</p></details>';
}
$desp_html .= '
    </div>
  </div>
</section>

<!-- INTERNAL LINKS -->
<section style="padding:40px 20px;background:#fff">
  <div class="lxc-sec" style="padding:0">
    <h3 style="font-size:1rem;font-weight:700;color:var(--lux-dark);margin-bottom:14px">Explora más servicios en Barcelona</h3>
    <div class="lxc-links">
      <a href="' . $landing . '" class="lxc-link-pill">🏠 Stripper en Barcelona (inicio)</a>
      <a href="' . $base_url . '/stripper-cumpleanos-barcelona/" class="lxc-link-pill">🎂 Cumpleaños Barcelona</a>
      <a href="' . $base_url . '/stripper-a-domicilio-barcelona/" class="lxc-link-pill">🏠 A domicilio Barcelona</a>
      <a href="' . $base_url . '/stripper-fiestas-privadas-barcelona/" class="lxc-link-pill">🎉 Fiestas privadas Barcelona</a>
      <a href="' . $base_url . '/stripper-masculino-barcelona/" class="lxc-link-pill">💪 Stripper masculino Barcelona</a>
      <a href="' . $cat_url . '" class="lxc-link-pill">🛍️ Ver todos los productos</a>
    </div>
  </div>
</section>

<!-- CTA FINAL -->
<div class="lxc-cta-final">
  <h2>¿Lista para sorprender a la novia?</h2>
  <p>Reserva ahora tu show exclusivo para despedida de soltera en Barcelona.<br>Confirmación en menos de 2 horas · Discreción total · Artistas profesionales</p>
  <a href="https://wa.me/34644507282?text=Quiero+reservar+stripper+despedida+soltera+Barcelona" class="lxc-btn lxc-btn--gold">📲 Reservar por WhatsApp ahora</a>
</div>

' . build_jsonld($desp_slug, $desp_title, $desp_desc_rm, $desp_url, $desp_faqs, 'stripper despedida soltera barcelona', '180') . '
</div>';

// ─────────────────────────────────────────────────────────────────────────────
// CLUSTER 2: A DOMICILIO BARCELONA (update existing ID 67992)
// ─────────────────────────────────────────────────────────────────────────────
$adom_slug  = 'stripper-a-domicilio-barcelona';
$adom_url   = $base_url . '/' . $adom_slug . '/';
$adom_title = 'Stripper a Domicilio en Barcelona 2026 | desde 180€ · Hotel, Piso, Villa';
$adom_desc_rm = 'Contratar stripper a domicilio en Barcelona desde 180€. Acudimos a tu piso, hotel, villa con piscina o apartamento turístico. 8 municipios. Reserva en 2h. Discreción garantizada.';

$adom_faqs = [
  ['¿A qué lugares acude el stripper a domicilio en Barcelona?','Acudimos a pisos particulares, apartamentos turísticos, villas con piscina, hoteles boutique, suites, barcos, beach clubs y cualquier espacio privado en Barcelona y área metropolitana (Badalona, Hospitalet, Cornellà, Terrassa, Sabadell, Sant Cugat del Vallès, Mataró).'],
  ['¿Cuál es el precio del stripper a domicilio en Barcelona?','El Show Integral a domicilio parte desde 180€. El desplazamiento está incluido dentro de Barcelona ciudad y hasta 25 km. Para municipios más alejados se aplica un suplemento de 10-20€.'],
  ['¿Con cuánta antelación puedo reservar?','Aceptamos reservas con 2 horas de antelación si hay artistas disponibles. Para mayor seguridad y elección de artista, recomendamos 48h.'],
  ['¿Qué espacio mínimo necesita el stripper para el show?','Con unos 3×3 metros es suficiente. El artista solo necesita un pequeño espacio libre para moverse cómodamente. Funciona perfectamente en salones, azoteas, terrazas y habitaciones de hotel.'],
  ['¿El artista llega con música propia?','Sí, los artistas llevan su propia playlist y equipo de sonido Bluetooth. No necesitas preparar nada.'],
  ['¿Se puede contratar stripper a domicilio en Badalona o Terrassa?','Sí, cubrimos todos los municipios del área metropolitana: Badalona, Hospitalet de Llobregat, Cornellà, Terrassa, Sabadell, Sant Cugat del Vallès y Mataró.'],
  ['¿El show es solo para mujeres o también para hombres?','Tenemos tanto artistas femeninas para espectadores masculinos como strippers masculinos (chippendales) para grupos femeninos o mixtos.'],
  ['¿Qué pasa si necesito cancelar la reserva?','Cancelaciones con más de 24h de antelación: devolución del 80% de la señal. Cancelaciones con menos de 24h: la señal no se devuelve, pero podemos reprogramar la fecha.'],
];

$adom_html = $css . '
<div id="lux-cluster">
<style>#lux-cluster .lxc-hero{--hero-img:url(' . $imgs['hero6'] . ')}</style>

<!-- HERO -->
<section class="lxc-hero">
  <div class="lxc-hero__inner">
    <span class="lxc-badge">🏠 Stripper a Domicilio · Barcelona 2026</span>
    <h1 class="lxc-h1">Stripper a <span>Domicilio en Barcelona</span><br>2026 · Piso, Hotel o Villa</h1>
    <p class="lxc-hero-sub">Enviamos artistas profesionales directamente a tu piso, apartamento turístico, hotel o villa con piscina en Barcelona y toda el área metropolitana. <strong style="color:var(--lux-gold)">Desde 180€ · Confirmación 2h · Sin sorpresas</strong></p>
    <div class="lxc-cta-wrap">
      <a href="https://wa.me/34644507282?text=Hola%2C+quiero+stripper+a+domicilio+en+Barcelona" class="lxc-btn lxc-btn--gold">📲 Reservar por WhatsApp</a>
      <a href="' . $cat_url . '" class="lxc-btn lxc-btn--outline">🎭 Ver catálogo completo</a>
    </div>
    <div class="lxc-trust">
      <span class="lxc-trust-item">⭐ 5/5 · 312 reseñas</span>
      <span class="lxc-trust-item">✅ Sin coste de desplazamiento BCN</span>
      <span class="lxc-trust-item">🔒 Discreción total</span>
      <span class="lxc-trust-item">📍 8 municipios cubiertos</span>
    </div>
  </div>
</section>

<!-- INTRO -->
<section style="padding:52px 20px;background:#fff">
  <div class="lxc-sec" style="max-width:800px;padding:0">
    <h2 style="font-size:1.35rem;font-weight:800;color:var(--lux-dark);margin-bottom:12px">¿Por qué contratar el stripper a domicilio en Barcelona?</h2>
    <p style="font-size:.92rem;color:#555;line-height:1.7;margin-bottom:12px">El servicio de <strong>stripper a domicilio en Barcelona</strong> es la forma más cómoda y privada de disfrutar un show exclusivo. Sin necesidad de alquilar sala ni desplazarte: el artista llega directamente donde estés, ya sea un apartamento de Airbnb en el Eixample, una villa privada en Sant Cugat del Vallès, una suite en el Hotel W, un penthouse en Sarrià o un apartamento en la Barceloneta.</p>
    <p style="font-size:.92rem;color:#555;line-height:1.7;margin-bottom:12px">Cubrimos toda la <strong>Barcelona metropolitana</strong>: 8 municipios clave —Barcelona ciudad, Badalona, Cornellà de Llobregat, Hospitalet de Llobregat, Mataró, Sabadell, Sant Cugat del Vallès y Terrassa— con el mismo nivel de excelencia y discreción.</p>
    <h2 style="font-size:1.15rem;font-weight:800;color:var(--lux-dark);margin:22px 0 10px">Espacios donde realizamos el show a domicilio</h2>
    <ul class="lxc-checklist">
      <li>Pisos y apartamentos particulares</li>
      <li>Apartamentos turísticos / Airbnb</li>
      <li>Villas privadas con piscina</li>
      <li>Suites y habitaciones de hotel</li>
      <li>Áticos y penthouses con terraza</li>
      <li>Barcos y yates en el Puerto Olímpico</li>
      <li>Chalets en la urbanización</li>
      <li>Beach clubs y terrazas privadas</li>
    </ul>
  </div>
</section>

<!-- MUNICIPIOS GRID -->
<div class="lxc-wrap--dark">
  <div class="lxc-sec">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">Municipios cubiertos — Stripper a domicilio</h2>
    <p class="lxc-ssub">Desplazamiento sin coste adicional en Barcelona ciudad · +10€ área metropolitana</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;margin-top:20px">
      <div style="background:rgba(200,169,110,.1);border:1px solid rgba(200,169,110,.3);border-radius:8px;padding:14px;text-align:center">
        <div style="font-size:1.3rem;margin-bottom:4px">🏙️</div>
        <div style="font-weight:700;color:#fff;font-size:.88rem">Barcelona Ciudad</div>
        <div style="font-size:.75rem;color:rgba(255,255,255,.55);margin-top:2px">Sin suplemento</div>
      </div>
      <div style="background:rgba(200,169,110,.07);border:1px solid rgba(200,169,110,.2);border-radius:8px;padding:14px;text-align:center">
        <div style="font-size:1.3rem;margin-bottom:4px">🌊</div>
        <div style="font-weight:700;color:#fff;font-size:.88rem">Badalona</div>
        <div style="font-size:.75rem;color:rgba(255,255,255,.45);margin-top:2px">+10€ · 8 km</div>
      </div>
      <div style="background:rgba(200,169,110,.07);border:1px solid rgba(200,169,110,.2);border-radius:8px;padding:14px;text-align:center">
        <div style="font-size:1.3rem;margin-bottom:4px">🏘️</div>
        <div style="font-weight:700;color:#fff;font-size:.88rem">Hospitalet de Llobregat</div>
        <div style="font-size:.75rem;color:rgba(255,255,255,.45);margin-top:2px">+10€ · 5 km</div>
      </div>
      <div style="background:rgba(200,169,110,.07);border:1px solid rgba(200,169,110,.2);border-radius:8px;padding:14px;text-align:center">
        <div style="font-size:1.3rem;margin-bottom:4px">🏭</div>
        <div style="font-weight:700;color:#fff;font-size:.88rem">Cornellà de Llobregat</div>
        <div style="font-size:.75rem;color:rgba(255,255,255,.45);margin-top:2px">+10€ · 12 km</div>
      </div>
      <div style="background:rgba(200,169,110,.07);border:1px solid rgba(200,169,110,.2);border-radius:8px;padding:14px;text-align:center">
        <div style="font-size:1.3rem;margin-bottom:4px">⛵</div>
        <div style="font-weight:700;color:#fff;font-size:.88rem">Mataró</div>
        <div style="font-size:.75rem;color:rgba(255,255,255,.45);margin-top:2px">+20€ · 28 km</div>
      </div>
      <div style="background:rgba(200,169,110,.07);border:1px solid rgba(200,169,110,.2);border-radius:8px;padding:14px;text-align:center">
        <div style="font-size:1.3rem;margin-bottom:4px">🌿</div>
        <div style="font-weight:700;color:#fff;font-size:.88rem">Sant Cugat del Vallès</div>
        <div style="font-size:.75rem;color:rgba(255,255,255,.45);margin-top:2px">+15€ · 18 km</div>
      </div>
      <div style="background:rgba(200,169,110,.07);border:1px solid rgba(200,169,110,.2);border-radius:8px;padding:14px;text-align:center">
        <div style="font-size:1.3rem;margin-bottom:4px">🏔️</div>
        <div style="font-weight:700;color:#fff;font-size:.88rm">Sabadell</div>
        <div style="font-size:.75rem;color:rgba(255,255,255,.45);margin-top:2px">+15€ · 22 km</div>
      </div>
      <div style="background:rgba(200,169,110,.07);border:1px solid rgba(200,169,110,.2);border-radius:8px;padding:14px;text-align:center">
        <div style="font-size:1.3rem;margin-bottom:4px">🏛️</div>
        <div style="font-weight:700;color:#fff;font-size:.88rem">Terrassa</div>
        <div style="font-size:.75rem;color:rgba(255,255,255,.45);margin-top:2px">+20€ · 30 km</div>
      </div>
    </div>
  </div>
</div>

<!-- PRICE TABLE -->
<section style="padding:52px 20px;background:var(--lux-light,#f9f6f0)">
  <div class="lxc-sec" style="padding:0">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">Precios stripper a domicilio Barcelona 2026</h2>
    <table class="lxc-ptable">
      <thead><tr><th>Show</th><th>Duración</th><th>Barcelona ciudad</th><th>Área metropolitana</th></tr></thead>
      <tbody>
        <tr><td>Show Integral</td><td>45 min</td><td class="ph">180€</td><td>190-200€</td></tr>
        <tr><td>Show Lésbico Dúo</td><td>60 min</td><td class="ph">330€</td><td>340-350€</td></tr>
        <tr><td>Show con Juguete Erótico</td><td>50 min</td><td class="ph">300€</td><td>310-320€</td></tr>
        <tr><td>Camarera Sexy</td><td>1h/chica</td><td class="ph">180€/h</td><td>190€/h</td></tr>
        <tr><td>Pack Camarera + Show</td><td>2-3 h</td><td class="ph">380€</td><td>390-400€</td></tr>
      </tbody>
    </table>
  </div>
</section>

<!-- FAQ -->
<section style="padding:52px 20px;background:#fff">
  <div class="lxc-sec" style="padding:0">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">FAQ — Stripper a domicilio Barcelona</h2>
    <div class="lxc-faq">';
foreach ($adom_faqs as $f) {
    $adom_html .= '<details><summary>' . htmlspecialchars($f[0]) . '</summary><p>' . $f[1] . '</p></details>';
}
$adom_html .= '
    </div>
  </div>
</section>

<!-- INTERNAL LINKS -->
<section style="padding:38px 20px;background:var(--lux-light,#f9f6f0)">
  <div class="lxc-sec" style="padding:0">
    <h3 style="font-size:1rem;font-weight:700;color:var(--lux-dark);margin-bottom:14px">Más shows en Barcelona</h3>
    <div class="lxc-links">
      <a href="' . $landing . '" class="lxc-link-pill">🏠 Stripper Barcelona (inicio)</a>
      <a href="' . $base_url . '/stripper-despedidas-soltera-barcelona/" class="lxc-link-pill">💋 Despedidas Barcelona</a>
      <a href="' . $base_url . '/stripper-cumpleanos-barcelona/" class="lxc-link-pill">🎂 Cumpleaños Barcelona</a>
      <a href="' . $base_url . '/stripper-fiestas-privadas-barcelona/" class="lxc-link-pill">🎉 Fiestas privadas Barcelona</a>
      <a href="' . $base_url . '/stripper-masculino-barcelona/" class="lxc-link-pill">💪 Stripper masculino Barcelona</a>
    </div>
  </div>
</section>

<!-- CTA FINAL -->
<div class="lxc-cta-final">
  <h2>¿Listo para el show a domicilio?</h2>
  <p>Reserva ahora — el artista llega directamente donde estés.<br>Barcelona y 8 municipios del área metropolitana · Confirmación en 2h</p>
  <a href="https://wa.me/34644507282?text=Quiero+stripper+a+domicilio+Barcelona" class="lxc-btn lxc-btn--gold">📲 Reservar por WhatsApp</a>
</div>

' . build_jsonld($adom_slug, $adom_title, $adom_desc_rm, $adom_url, $adom_faqs, 'stripper domicilio barcelona', '180') . '
</div>';

// ─────────────────────────────────────────────────────────────────────────────
// CLUSTER 3: CUMPLEAÑOS BARCELONA
// ─────────────────────────────────────────────────────────────────────────────
$cump_slug  = 'stripper-cumpleanos-barcelona';
$cump_url   = $base_url . '/' . $cump_slug . '/';
$cump_title = 'Stripper para Cumpleaños en Barcelona 2026 | Shows desde 180€ · Sorpresa';
$cump_desc_rm = 'Contrata el mejor stripper para cumpleaños en Barcelona desde 180€. Sorpresa a domicilio, hotel, restaurante privado o villa. 8 municipios. Reserva express. Discreción garantizada 2026.';

$cump_faqs = [
  ['¿Cuánto cuesta contratar un stripper para cumpleaños en Barcelona?','El Show Integral para cumpleaños parte desde 180€. El Pack Camarera Sexy + Show comienza en 380€. El Show Lésbico Dúo cuesta 330€. Todos incluyen desplazamiento en Barcelona ciudad.'],
  ['¿El stripper puede ser una sorpresa para el/la cumpleañero/a?','Absolutamente. Coordinamos la llegada discreta con el organizador para que sea una sorpresa total. Podemos disfrazarnos de repartidor, mensajero o cualquier personaje acordado.'],
  ['¿Se puede contratar stripper para cumpleaños en restaurante privado?','Sí, trabajamos con reservas de sala en restaurantes, pubs con sala privada, discotecas y locales. El artista llega como "invitado sorpresa".'],
  ['¿Qué show recomiendas para un cumpleaños masculino?','Para grupos masculinos recomendamos el Show Integral (180€) o el Show con Juguete Erótico (300€). Para grupos mixtos o femeninos, el Show Lésbico Dúo o el Stripper Masculino.'],
  ['¿Pueden venir dos artistas para un grupo grande?','Sí, podemos enviar dos artistas para grupos de más de 15 personas. El Show Lésbico Dúo (330€) ya incluye dos artistas. Para dos shows separados, consultar precio.'],
  ['¿Qué rango de edad mínima se requiere para el público?','Todos los asistentes deben ser mayores de 18 años. Es imprescindible confirmarlo al hacer la reserva.'],
  ['¿Se puede filmar el show de cumpleaños?','Se permite fotografía y vídeo con acuerdo previo entre el organizador y el artista. Se firma una cláusula de uso privado del material.'],
  ['¿Cuánto tiempo antes debo reservar para el show de cumpleaños?','Recomendamos 48h, pero aceptamos reservas exprés con 2-4h de antelación si hay disponibilidad. Para fechas especiales (Sant Joan, Nochevieja) reservar con 1-2 semanas.'],
];

$cump_html = $css . '
<div id="lux-cluster">
<style>#lux-cluster .lxc-hero{--hero-img:url(' . $imgs['hero9'] . ')}</style>

<!-- HERO -->
<section class="lxc-hero">
  <div class="lxc-hero__inner">
    <span class="lxc-badge">🎂 Stripper Cumpleaños · Barcelona 2026</span>
    <h1 class="lxc-h1">Stripper para <span>Cumpleaños</span><br>en Barcelona 2026 · Sorpresa Perfecta</h1>
    <p class="lxc-hero-sub">La sorpresa más original para el cumpleaños más especial. Shows profesionales a domicilio, restaurantes privados, hoteles y villas. <strong style="color:var(--lux-gold)">Desde 180€ · Llegada sorpresa · Discreción</strong></p>
    <div class="lxc-cta-wrap">
      <a href="https://wa.me/34644507282?text=Hola%2C+quiero+contratar+stripper+para+cumplea%C3%B1os+en+Barcelona" class="lxc-btn lxc-btn--gold">📲 Reservar por WhatsApp</a>
      <a href="' . $cat_url . '" class="lxc-btn lxc-btn--outline">🎭 Ver todos los shows</a>
    </div>
    <div class="lxc-trust">
      <span class="lxc-trust-item">⭐ 5/5 · 312 reseñas</span>
      <span class="lxc-trust-item">🎁 Llegada sorpresa</span>
      <span class="lxc-trust-item">🔒 100% discreción</span>
      <span class="lxc-trust-item">⚡ Reserva en 2h</span>
    </div>
  </div>
</section>

<!-- INTRO -->
<section style="padding:52px 20px;background:#fff">
  <div class="lxc-sec" style="max-width:800px;padding:0">
    <h2 style="font-size:1.35rem;font-weight:800;color:var(--lux-dark);margin-bottom:12px">El mejor stripper para cumpleaños en Barcelona</h2>
    <p style="font-size:.92rem;color:#555;line-height:1.7;margin-bottom:12px">Un <strong>stripper para cumpleaños en Barcelona</strong> es la sorpresa más recordada de cualquier celebración. En <strong>Espectáculos Luxury</strong> especializamos shows diseñados para que el cumpleañero o cumpleañera sea el protagonista absoluto de una noche única. Desde una llegada inesperada disfrazada hasta un espectáculo completo con coreografía y juguetes eróticos.</p>
    <p style="font-size:.92rem;color:#555;line-height:1.7;margin-bottom:12px">Cubrimos todo Barcelona y el área metropolitana: Eixample, Gràcia, Barceloneta, Sarrià, Poblenou, y municipios como Badalona, Hospitalet, Cornellà, Sant Cugat del Vallès, Terrassa, Sabadell y Mataró.</p>
    <h2 style="font-size:1.15rem;font-weight:800;color:var(--lux-dark);margin:22px 0 10px">¿Qué incluye el show de cumpleaños?</h2>
    <ul class="lxc-checklist">
      <li>Llegada sorpresa coordinada contigo</li>
      <li>Show personalizado con el protagonista</li>
      <li>Strip-tease con coreografía completa</li>
      <li>Disfraces y temáticas a elegir</li>
      <li>Música y ambiente curado</li>
      <li>45-60 minutos de actuación</li>
      <li>Fotos y vídeo permitidos (previa firma)</li>
      <li>Desplazamiento incluido en Barcelona ciudad</li>
    </ul>
  </div>
</section>

<!-- SHOWS CARDS -->
<div class="lxc-wrap--dark">
  <div class="lxc-sec">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">Shows para cumpleaños en Barcelona</h2>
    <p class="lxc-ssub">Elige el formato que mejor encaje con el protagonista y tu grupo</p>
    <div class="lxc-cards">
      <div class="lxc-card">
        <img src="' . $imgs['hero2'] . '" alt="Show Integral cumpleaños Barcelona" loading="lazy">
        <div class="lxc-card__body">
          <div class="lxc-card__tag">El clásico</div>
          <h3 class="lxc-card__h3">Show Integral de Stripper</h3>
          <p class="lxc-card__p">Coreografía completa con striptease, accesorios y protagonista como estrella del show.</p>
          <div class="lxc-card__price">Desde 180€</div>
          <a href="' . $base_url . '/show-integral-stripper-barcelona/" class="lxc-card__link">Ver detalles →</a>
        </div>
      </div>
      <div class="lxc-card">
        <img src="' . $imgs['hero12'] . '" alt="Pack Camarera Show cumpleaños Barcelona" loading="lazy">
        <div class="lxc-card__body">
          <div class="lxc-card__tag">Pack completo</div>
          <h3 class="lxc-card__h3">Pack Camarera Sexy + Show</h3>
          <p class="lxc-card__p">La camarera sirve durante la cena y protagoniza el show de cumpleaños al final de la noche.</p>
          <div class="lxc-card__price">Desde 380€</div>
          <a href="' . $base_url . '/pack-camarera-show-barcelona/" class="lxc-card__link">Ver detalles →</a>
        </div>
      </div>
      <div class="lxc-card">
        <img src="' . $imgs['hero4'] . '" alt="Stripper masculino cumpleaños Barcelona" loading="lazy">
        <div class="lxc-card__body">
          <div class="lxc-card__tag">Para grupos femeninos</div>
          <h3 class="lxc-card__h3">Stripper Masculino (Chippendale)</h3>
          <p class="lxc-card__p">Bailarín masculino profesional para cumpleaños de mujer. Show con coreografía sensual y contacto.</p>
          <div class="lxc-card__price">Desde 180€</div>
          <a href="' . $base_url . '/stripper-masculino-barcelona/" class="lxc-card__link">Ver detalles →</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- PRICE TABLE -->
<section style="padding:52px 20px;background:var(--lux-light,#f9f6f0)">
  <div class="lxc-sec" style="padding:0">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">Precios shows de cumpleaños — Barcelona 2026</h2>
    <table class="lxc-ptable">
      <thead><tr><th>Show</th><th>Para quién</th><th>Duración</th><th>Precio</th></tr></thead>
      <tbody>
        <tr><td>Show Integral</td><td>Cumpleañero/a + grupo</td><td>45 min</td><td class="ph">180€</td></tr>
        <tr><td>Show Lésbico Dúo</td><td>Grupos femeninos</td><td>60 min</td><td class="ph">330€</td></tr>
        <tr><td>Show con Juguete Erótico</td><td>Adultos / parejas</td><td>50 min</td><td class="ph">300€</td></tr>
        <tr><td>Pack Camarera + Show</td><td>Fiestas con cena previa</td><td>2-3 h</td><td class="ph">380€</td></tr>
        <tr><td>Stripper Masculino</td><td>Grupos femeninos / mixtos</td><td>45 min</td><td class="ph">180€</td></tr>
      </tbody>
    </table>
  </div>
</section>

<!-- TESTIMONIALS -->
<div class="lxc-wrap--dark">
  <div class="lxc-sec">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">Reseñas — Cumpleaños Barcelona</h2>
    <div class="lxc-testimonials">
      <div class="lxc-testi"><blockquote>"Contratamos el Pack Camarera + Show para el cumpleaños de mi marido en nuestra villa de Sant Cugat. Fue el mejor regalo: la chica llegó de camarera y al final reveló el show. Impresionante. ¡Volveremos a contratar!"</blockquote><cite>— Elena R., Sant Cugat del Vallès</cite></div>
      <div class="lxc-testi"><blockquote>"Organicé el cumpleaños de 40 de mi amiga en su piso de Gràcia. El show lésbico dúo fue increíble, las chicas fueron muy profesionales y todo fue consensuado y respetuoso. Recomendadísimo."</blockquote><cite>— Nuria C., Gràcia Barcelona</cite></div>
      <div class="lxc-testi"><blockquote>"El stripper masculino para el cumpleaños de mi madre (sí, ¡50 años!) fue el hit de la noche. Todo muy profesional, divertido y tastefully done. Muchas gracias por hacer tan fácil la reserva."</blockquote><cite>— Andrea V., Eixample Barcelona</cite></div>
    </div>
  </div>
</div>

<!-- FAQ -->
<section style="padding:52px 20px;background:#fff">
  <div class="lxc-sec" style="padding:0">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">FAQ — Stripper para cumpleaños Barcelona</h2>
    <div class="lxc-faq">';
foreach ($cump_faqs as $f) {
    $cump_html .= '<details><summary>' . htmlspecialchars($f[0]) . '</summary><p>' . $f[1] . '</p></details>';
}
$cump_html .= '
    </div>
  </div>
</section>

<!-- INTERNAL LINKS -->
<section style="padding:38px 20px;background:var(--lux-light,#f9f6f0)">
  <div class="lxc-sec" style="padding:0">
    <h3 style="font-size:1rem;font-weight:700;color:var(--lux-dark);margin-bottom:14px">También te puede interesar</h3>
    <div class="lxc-links">
      <a href="' . $landing . '" class="lxc-link-pill">🏠 Stripper Barcelona (inicio)</a>
      <a href="' . $base_url . '/stripper-despedidas-soltera-barcelona/" class="lxc-link-pill">💋 Despedidas de soltera</a>
      <a href="' . $base_url . '/stripper-a-domicilio-barcelona/" class="lxc-link-pill">🏠 A domicilio Barcelona</a>
      <a href="' . $base_url . '/stripper-fiestas-privadas-barcelona/" class="lxc-link-pill">🎉 Fiestas privadas</a>
      <a href="' . $base_url . '/stripper-masculino-barcelona/" class="lxc-link-pill">💪 Stripper masculino</a>
    </div>
  </div>
</section>

<div class="lxc-cta-final">
  <h2>¡Sorprende al cumpleañero/a con el show definitivo!</h2>
  <p>Reserva tu show de cumpleaños en Barcelona ahora.<br>Llegada sorpresa · Discreción total · Artistas profesionales</p>
  <a href="https://wa.me/34644507282?text=Quiero+stripper+para+cumplea%C3%B1os+en+Barcelona" class="lxc-btn lxc-btn--gold">📲 Reservar por WhatsApp</a>
</div>

' . build_jsonld($cump_slug, $cump_title, $cump_desc_rm, $cump_url, $cump_faqs, 'stripper cumpleaños barcelona', '180') . '
</div>';

// ─────────────────────────────────────────────────────────────────────────────
// CLUSTER 4: FIESTAS PRIVADAS BARCELONA
// ─────────────────────────────────────────────────────────────────────────────
$fies_slug  = 'stripper-fiestas-privadas-barcelona';
$fies_url   = $base_url . '/' . $fies_slug . '/';
$fies_title = 'Stripper para Fiestas Privadas en Barcelona 2026 | Shows desde 180€';
$fies_desc_rm = 'Contrata stripper para fiestas privadas en Barcelona desde 180€. Shows en villas, apartamentos, discotecas privadas, yates y hoteles. Camarera sexy, shows exclusivos 2026. Reserva ya.';

$fies_faqs = [
  ['¿Qué tipo de shows ofrecéis para fiestas privadas en Barcelona?','Ofrecemos Show Integral (180€), Show Lésbico Dúo (330€), Show con Juguete Erótico (300€), Camarera Sexy (180€/h por chica) y Pack Camarera + Show Integral (380€). Para fiestas privadas con múltiples artistas, consultar precio especial.'],
  ['¿Se puede contratar stripper para una fiesta en discoteca privada o local alquilado?','Sí, tenemos experiencia actuando en locales privados, pubs con sala reservada, discotecas privadas y espacios de eventos de Barcelona.'],
  ['¿Cuántas personas puede haber en el espacio para el show?','No hay límite de asistentes. Hemos actuado en fiestas desde 5 hasta 80 personas. Para grupos grandes (más de 30 pax), recomendamos el Show Lésbico Dúo o contratar dos artistas.'],
  ['¿Podéis actuar en yate o barco en el Puerto Olímpico de Barcelona?','Sí, tenemos experiencia en shows a bordo de yates y barcos privados en el Puerto Olímpico y Puerto de Barcelona. Consultar suplemento por ubicación.'],
  ['¿La Camarera Sexy incluye el show?','La Camarera Sexy (180€/h) realiza su función de servir bebidas y aperitivos en ropa interior o traje sensual. El show striptease se contrata aparte o a través del Pack Camarera + Show (380€).'],
  ['¿Podéis actuar en una villa con piscina fuera de Barcelona?','Sí, cubrimos villas y fincas en el Vallès, Maresme y Baix Llobregat. Distancias superiores a 30 km tienen un suplemento de desplazamiento.'],
  ['¿Hay paquetes especiales para empresas (team building, eventos corporativos)?','Sí, diseñamos shows corporativos 100% personalizados para eventos de empresa: cenas, incentivos, y celebraciones privadas. Consultar presupuesto.'],
  ['¿Se puede repetir el show o contratar más de un pase en la misma noche?','Sí, es posible contratar dos pases en la misma velada. El segundo pase tiene un descuento del 20% sobre el precio original.'],
];

$fies_html = $css . '
<div id="lux-cluster">
<style>#lux-cluster .lxc-hero{--hero-img:url(' . $imgs['hero13'] . ')}</style>

<!-- HERO -->
<section class="lxc-hero">
  <div class="lxc-hero__inner">
    <span class="lxc-badge">🎉 Fiestas Privadas · Barcelona 2026</span>
    <h1 class="lxc-h1">Stripper para <span>Fiestas Privadas</span><br>en Barcelona 2026</h1>
    <p class="lxc-hero-sub">Shows exclusivos para fiestas privadas, eventos de empresa, villas, yates y locales privados en Barcelona y área metropolitana. <strong style="color:var(--lux-gold)">Desde 180€ · Camarera Sexy disponible · 2026</strong></p>
    <div class="lxc-cta-wrap">
      <a href="https://wa.me/34644507282?text=Hola%2C+quiero+stripper+para+fiesta+privada+en+Barcelona" class="lxc-btn lxc-btn--gold">📲 Reservar por WhatsApp</a>
      <a href="' . $cat_url . '" class="lxc-btn lxc-btn--outline">🎭 Ver catálogo</a>
    </div>
    <div class="lxc-trust">
      <span class="lxc-trust-item">⭐ 5/5 · 312 reseñas</span>
      <span class="lxc-trust-item">🥂 Shows VIP disponibles</span>
      <span class="lxc-trust-item">🔒 Total discreción</span>
      <span class="lxc-trust-item">🚀 Confirmación 2h</span>
    </div>
  </div>
</section>

<!-- INTRO -->
<section style="padding:52px 20px;background:#fff">
  <div class="lxc-sec" style="max-width:800px;padding:0">
    <h2 style="font-size:1.35rem;font-weight:800;color:var(--lux-dark);margin-bottom:12px">Shows premium para fiestas privadas en Barcelona</h2>
    <p style="font-size:.92rem;color:#555;line-height:1.7;margin-bottom:12px">Organizar una <strong>fiesta privada en Barcelona</strong> con show de stripper es una experiencia que marca la diferencia. En <strong>Espectáculos Luxury</strong> ofrecemos shows personalizados para todo tipo de eventos privados: cumpleaños VIP, despedidas de empresa, eventos corporativos, fiestas en villa con piscina, shows en yate, y mucho más.</p>
    <p style="font-size:.92rem;color:#555;line-height:1.7;margin-bottom:12px">Contamos con el catálogo más completo de Barcelona: <em>Camarera Sexy</em> para dar ambiente a tu fiesta, <em>Show Integral</em>, <em>Show Lésbico Dúo</em>, <em>Pack Camarera + Show</em> para una experiencia completa de principio a fin, y <em>Stripper Masculino</em> para fiestas femeninas exclusivas.</p>
    <h2 style="font-size:1.15rem;font-weight:800;color:var(--lux-dark);margin:22px 0 10px">Espacios para fiestas privadas en Barcelona</h2>
    <ul class="lxc-checklist">
      <li>Villas privadas con piscina</li>
      <li>Áticos y penthouses en Barcelona</li>
      <li>Yates y barcos en Puerto Olímpico</li>
      <li>Locales y discotecas privadas</li>
      <li>Salas de hotel y suites</li>
      <li>Beach clubs en Barceloneta</li>
      <li>Apartamentos turísticos y Airbnb</li>
      <li>Espacios de eventos y fincas</li>
    </ul>
  </div>
</section>

<!-- SERVICES GRID -->
<div class="lxc-wrap--dark">
  <div class="lxc-sec">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">Servicios para fiestas privadas en Barcelona</h2>
    <p class="lxc-ssub">Desde la Camarera Sexy hasta el Show más atrevido</p>
    <div class="lxc-cards">
      <div class="lxc-card">
        <img src="' . $imgs['hero7'] . '" alt="Camarera Sexy fiesta privada Barcelona" loading="lazy">
        <div class="lxc-card__body">
          <div class="lxc-card__tag">Ambiente de fiesta</div>
          <h3 class="lxc-card__h3">Camarera Sexy</h3>
          <p class="lxc-card__p">Sirve cócteles y aperitivos en ropa interior o traje sensual. Ambiente único para tu fiesta privada.</p>
          <div class="lxc-card__price">180€/hora por chica</div>
          <a href="' . $base_url . '/camarera-sexy-barcelona/" class="lxc-card__link">Ver servicio →</a>
        </div>
      </div>
      <div class="lxc-card">
        <img src="' . $imgs['hero10'] . '" alt="Pack Camarera Show fiesta privada Barcelona" loading="lazy">
        <div class="lxc-card__body">
          <div class="lxc-card__tag">El pack más completo</div>
          <h3 class="lxc-card__h3">Pack Camarera Sexy + Show</h3>
          <p class="lxc-card__p">La camarera sirve durante la fiesta y cierra con un show de striptease completo. La combinación perfecta.</p>
          <div class="lxc-card__price">Desde 380€</div>
          <a href="' . $base_url . '/pack-camarera-show-barcelona/" class="lxc-card__link">Ver pack →</a>
        </div>
      </div>
      <div class="lxc-card">
        <img src="' . $imgs['hero14'] . '" alt="Show Lésbico Dúo fiesta privada Barcelona" loading="lazy">
        <div class="lxc-card__body">
          <div class="lxc-card__tag">Show VIP</div>
          <h3 class="lxc-card__h3">Show Lésbico Dúo</h3>
          <p class="lxc-card__p">El show más espectacular para grupos grandes. Dos artistas profesionales con show completo.</p>
          <div class="lxc-card__price">Desde 330€</div>
          <a href="' . $base_url . '/show-lesbico-duo-barcelona/" class="lxc-card__link">Ver show →</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- PRICE TABLE -->
<section style="padding:52px 20px;background:var(--lux-light,#f9f6f0)">
  <div class="lxc-sec" style="padding:0">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">Precios para fiestas privadas — Barcelona 2026</h2>
    <table class="lxc-ptable">
      <thead><tr><th>Servicio</th><th>Ideal para</th><th>Duración</th><th>Precio</th></tr></thead>
      <tbody>
        <tr><td>Camarera Sexy</td><td>Ambiente fiesta</td><td>Por horas</td><td class="ph">180€/h</td></tr>
        <tr><td>Show Integral</td><td>Grupos 4-15 pax</td><td>45 min</td><td class="ph">180€</td></tr>
        <tr><td>Show con Juguete Erótico</td><td>Fiestas adultos</td><td>50 min</td><td class="ph">300€</td></tr>
        <tr><td>Show Lésbico Dúo</td><td>Grupos grandes</td><td>60 min</td><td class="ph">330€</td></tr>
        <tr><td>Pack Camarera + Show</td><td>Noche completa</td><td>2-4 h</td><td class="ph">380€</td></tr>
        <tr><td>Stripper Masculino</td><td>Fiestas femeninas</td><td>45 min</td><td class="ph">180€</td></tr>
      </tbody>
    </table>
  </div>
</section>

<!-- FAQ -->
<section style="padding:52px 20px;background:#fff">
  <div class="lxc-sec" style="padding:0">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">Preguntas frecuentes — Fiestas privadas Barcelona</h2>
    <div class="lxc-faq">';
foreach ($fies_faqs as $f) {
    $fies_html .= '<details><summary>' . htmlspecialchars($f[0]) . '</summary><p>' . $f[1] . '</p></details>';
}
$fies_html .= '
    </div>
  </div>
</section>

<!-- INTERNAL LINKS -->
<section style="padding:38px 20px;background:var(--lux-light,#f9f6f0)">
  <div class="lxc-sec" style="padding:0">
    <h3 style="font-size:1rem;font-weight:700;color:var(--lux-dark);margin-bottom:14px">Más opciones en Barcelona</h3>
    <div class="lxc-links">
      <a href="' . $landing . '" class="lxc-link-pill">🏠 Stripper Barcelona (inicio)</a>
      <a href="' . $base_url . '/stripper-despedidas-soltera-barcelona/" class="lxc-link-pill">💋 Despedidas de soltera</a>
      <a href="' . $base_url . '/stripper-cumpleanos-barcelona/" class="lxc-link-pill">🎂 Cumpleaños Barcelona</a>
      <a href="' . $base_url . '/stripper-a-domicilio-barcelona/" class="lxc-link-pill">🏠 A domicilio Barcelona</a>
      <a href="' . $base_url . '/stripper-masculino-barcelona/" class="lxc-link-pill">💪 Stripper masculino</a>
    </div>
  </div>
</section>

<div class="lxc-cta-final">
  <h2>Haz de tu fiesta privada una noche legendaria</h2>
  <p>Shows exclusivos para fiestas privadas en Barcelona y área metropolitana.<br>Camarera Sexy · Shows Striptease · Dúo Lésbico · Stripper Masculino</p>
  <a href="https://wa.me/34644507282?text=Quiero+show+para+fiesta+privada+en+Barcelona" class="lxc-btn lxc-btn--gold">📲 Reservar por WhatsApp</a>
</div>

' . build_jsonld($fies_slug, $fies_title, $fies_desc_rm, $fies_url, $fies_faqs, 'stripper fiestas privadas barcelona', '180') . '
</div>';

// ─────────────────────────────────────────────────────────────────────────────
// CLUSTER 5: STRIPPER MASCULINO BARCELONA
// ─────────────────────────────────────────────────────────────────────────────
$masc_slug  = 'stripper-masculino-barcelona';
$masc_url   = $base_url . '/' . $masc_slug . '/';
$masc_title = 'Stripper Masculino Barcelona 2026 | Chippendale desde 180€ · Despedidas';
$masc_desc_rm = 'Contrata stripper masculino (chippendale) en Barcelona desde 180€. Ideal para despedidas de soltera, cumpleaños femeninos y fiestas. Show profesional a domicilio. 8 municipios. Reserva ya.';

$masc_faqs = [
  ['¿Cuánto cuesta contratar un stripper masculino en Barcelona?','El Show de Stripper Masculino (Chippendale) parte desde 180€ en Barcelona ciudad. El precio incluye desplazamiento y 45 minutos de show completo.'],
  ['¿Qué incluye el show del stripper masculino?','El show incluye llegada en personaje (policía, bombero, mensajero, etc.), strip-tease con coreografía completa, accesorios temáticos, y la protagonista (novia, cumpleañera) como estrella del show.'],
  ['¿Se pueden pedir temáticas específicas para el stripper masculino?','Sí, disponemos de múltiples trajes temáticos: policía, bombero, militar, Chef sexy, médico, ejecutivo, mensajero y más. Indicarlo al hacer la reserva.'],
  ['¿El stripper masculino actúa también en grupos mixtos?','Sí, nuestros artistas masculinos actúan ante grupos femeninos exclusivos y ante grupos mixtos. Para grupos masculinos ofrecemos artistas femeninas.'],
  ['¿Cuánto mide y cómo es el perfil del stripper masculino de Barcelona?','Nuestros artistas masculinos tienen entre 25-38 años, complexión atlética, formación en baile y coreografía. Puedes ver perfiles y fotos (con discreción) al contactar.'],
  ['¿El stripper masculino acude a domicilio en Barcelona?','Sí, acude a pisos, apartamentos, hoteles, villas con piscina y cualquier espacio privado. Cubrimos Barcelona ciudad y los 8 municipios del área metropolitana.'],
  ['¿Puedo reservar stripper masculino para una despedida de soltera en Barcelona?','Absolutamente. Es uno de los servicios más demandados: el chippendale llega de "sorpresa" coordinado con la organizadora y realiza un show completo con la novia como protagonista.'],
  ['¿Hay diferencia de precio entre el stripper masculino y el femenino?','No, el precio base es el mismo: desde 180€ el show integral. El show masculino (chippendale) tiene exactamente las mismas tarifas que el show femenino.'],
];

$masc_html = $css . '
<div id="lux-cluster">
<style>#lux-cluster .lxc-hero{--hero-img:url(' . $imgs['hero15'] . ')}</style>

<!-- HERO -->
<section class="lxc-hero">
  <div class="lxc-hero__inner">
    <span class="lxc-badge">💪 Stripper Masculino · Barcelona 2026</span>
    <h1 class="lxc-h1"><span>Stripper Masculino</span> en Barcelona 2026<br>Chippendale · Desde 180€</h1>
    <p class="lxc-hero-sub">Bailarines masculinos profesionales (chippendales) para despedidas de soltera, cumpleaños femeninos y fiestas privadas en Barcelona. <strong style="color:var(--lux-gold)">Desde 180€ · Llegada sorpresa · Discreción</strong></p>
    <div class="lxc-cta-wrap">
      <a href="https://wa.me/34644507282?text=Hola%2C+quiero+contratar+stripper+masculino+en+Barcelona" class="lxc-btn lxc-btn--gold">📲 Reservar por WhatsApp</a>
      <a href="' . $cat_url . '" class="lxc-btn lxc-btn--outline">🎭 Ver catálogo completo</a>
    </div>
    <div class="lxc-trust">
      <span class="lxc-trust-item">⭐ 5/5 · 312 reseñas</span>
      <span class="lxc-trust-item">🎭 Artistas con formación</span>
      <span class="lxc-trust-item">🔒 100% discreción</span>
      <span class="lxc-trust-item">🚀 Confirmación 2h</span>
    </div>
  </div>
</section>

<!-- INTRO -->
<section style="padding:52px 20px;background:#fff">
  <div class="lxc-sec" style="max-width:800px;padding:0">
    <h2 style="font-size:1.35rem;font-weight:800;color:var(--lux-dark);margin-bottom:12px">Contrata el mejor stripper masculino en Barcelona</h2>
    <p style="font-size:.92rem;color:#555;line-height:1.7;margin-bottom:12px">El <strong>stripper masculino en Barcelona</strong> —también conocido como chippendale— es la elección perfecta para despedidas de soltera, cumpleaños femeninos y fiestas privadas de grupos de mujeres o mixtos. En <strong>Espectáculos Luxury</strong> contamos con una selección de bailarines masculinos con formación profesional en danza y coreografía, físico atlético y experiencia en shows privados en Barcelona y toda el área metropolitana.</p>
    <p style="font-size:.92rem;color:#555;line-height:1.7;margin-bottom:12px">Los shows incluyen llegada en personaje sorpresa, strip-tease con coreografía completa y múltiples opciones temáticas: policía, bombero, militar, mensajero, médico, ejecutivo y más. El show se realiza a domicilio, en hotel, villa o cualquier espacio privado.</p>
    <h2 style="font-size:1.15rem;font-weight:800;color:var(--lux-dark);margin:22px 0 10px">¿Qué incluye el show del stripper masculino?</h2>
    <ul class="lxc-checklist">
      <li>Llegada en personaje (traje temático a elegir)</li>
      <li>Strip-tease con coreografía completa</li>
      <li>La protagonista como estrella del show</li>
      <li>Músuca y playlist curada</li>
      <li>45-60 minutos de actuación</li>
      <li>Accesorios y props incluidos</li>
      <li>Fotos y vídeo permitidos (previa firma)</li>
      <li>Desplazamiento incluido en Barcelona ciudad</li>
    </ul>
  </div>
</section>

<!-- TEMÁTICAS -->
<div class="lxc-wrap--dark">
  <div class="lxc-sec">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">Temáticas disponibles — Stripper masculino Barcelona</h2>
    <p class="lxc-ssub">Elige la temática que más le guste a la protagonista</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:12px;margin-top:20px">
      <div style="background:rgba(200,169,110,.1);border:1px solid rgba(200,169,110,.25);border-radius:8px;padding:14px;text-align:center">
        <div style="font-size:1.5rem;margin-bottom:6px">👮</div>
        <div style="color:#fff;font-size:.85rem;font-weight:600">Policía</div>
      </div>
      <div style="background:rgba(200,169,110,.08);border:1px solid rgba(200,169,110,.2);border-radius:8px;padding:14px;text-align:center">
        <div style="font-size:1.5rem;margin-bottom:6px">🚒</div>
        <div style="color:#fff;font-size:.85rem;font-weight:600">Bombero</div>
      </div>
      <div style="background:rgba(200,169,110,.08);border:1px solid rgba(200,169,110,.2);border-radius:8px;padding:14px;text-align:center">
        <div style="font-size:1.5rem;margin-bottom:6px">💼</div>
        <div style="color:#fff;font-size:.85rem;font-weight:600">Ejecutivo</div>
      </div>
      <div style="background:rgba(200,169,110,.08);border:1px solid rgba(200,169,110,.2);border-radius:8px;padding:14px;text-align:center">
        <div style="font-size:1.5rem;margin-bottom:6px">📦</div>
        <div style="color:#fff;font-size:.85rem;font-weight:600">Mensajero</div>
      </div>
      <div style="background:rgba(200,169,110,.08);border:1px solid rgba(200,169,110,.2);border-radius:8px;padding:14px;text-align:center">
        <div style="font-size:1.5rem;margin-bottom:6px">🎖️</div>
        <div style="color:#fff;font-size:.85rem;font-weight:600">Militar</div>
      </div>
      <div style="background:rgba(200,169,110,.08);border:1px solid rgba(200,169,110,.2);border-radius:8px;padding:14px;text-align:center">
        <div style="font-size:1.5rem;margin-bottom:6px">👨‍⚕️</div>
        <div style="color:#fff;font-size:.85rem;font-weight:600">Médico / Enfermero</div>
      </div>
    </div>
  </div>
</div>

<!-- PRICE TABLE -->
<section style="padding:52px 20px;background:var(--lux-light,#f9f6f0)">
  <div class="lxc-sec" style="padding:0">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">Precios stripper masculino Barcelona 2026</h2>
    <table class="lxc-ptable">
      <thead><tr><th>Show</th><th>Ideal para</th><th>Duración</th><th>Precio</th></tr></thead>
      <tbody>
        <tr><td>Show Integral Masculino</td><td>Despedidas · Cumpleaños</td><td>45 min</td><td class="ph">180€</td></tr>
        <tr><td>Show Integral + Temática</td><td>Con traje especial</td><td>50 min</td><td class="ph">200€</td></tr>
        <tr><td>Pack Dos Pases</td><td>Noche larga</td><td>2×45 min</td><td class="ph">320€</td></tr>
        <tr><td>Pack Mixto (Masculino + Femenino)</td><td>Fiestas mixtas</td><td>2×45 min</td><td class="ph">340€</td></tr>
      </tbody>
    </table>
  </div>
</section>

<!-- TESTIMONIALS -->
<div class="lxc-wrap--dark">
  <div class="lxc-sec">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">Reseñas — Stripper masculino Barcelona</h2>
    <div class="lxc-testimonials">
      <div class="lxc-testi"><blockquote>"Contratamos el chippendale disfrazado de policía para la despedida de mi hermana en el Eixample. Fue increíble, muy profesional y con un cuerpazo. La novia quedó sin palabras. 100% recomendable."</blockquote><cite>— Patricia M., Eixample Barcelona</cite></div>
      <div class="lxc-testi"><blockquote>"Para el cumpleaños de 40 de mi amiga en su villa de Mataró contratamos el stripper masculino. Llegó de mensajero con un paquete falso y el show fue espectacular. Toda la noche hablamos de ello."</blockquote><cite>— Silvia A., Mataró</cite></div>
      <div class="lxc-testi"><blockquote>"El proceso de reserva fue rapidísimo: 20 minutos por WhatsApp y todo confirmado. El artista llegó puntual, fue súper profesional y el show superó todas las expectativas. Muy recomendable."</blockquote><cite>— Mónica T., Badalona</cite></div>
    </div>
  </div>
</div>

<!-- FAQ -->
<section style="padding:52px 20px;background:#fff">
  <div class="lxc-sec" style="padding:0">
    <span class="lxc-goldline"></span>
    <h2 class="lxc-stitle">FAQ — Stripper masculino Barcelona</h2>
    <div class="lxc-faq">';
foreach ($masc_faqs as $f) {
    $masc_html .= '<details><summary>' . htmlspecialchars($f[0]) . '</summary><p>' . $f[1] . '</p></details>';
}
$masc_html .= '
    </div>
  </div>
</section>

<!-- INTERNAL LINKS -->
<section style="padding:38px 20px;background:var(--lux-light,#f9f6f0)">
  <div class="lxc-sec" style="padding:0">
    <h3 style="font-size:1rem;font-weight:700;color:var(--lux-dark);margin-bottom:14px">También disponible en Barcelona</h3>
    <div class="lxc-links">
      <a href="' . $landing . '" class="lxc-link-pill">🏠 Stripper Barcelona (inicio)</a>
      <a href="' . $base_url . '/stripper-despedidas-soltera-barcelona/" class="lxc-link-pill">💋 Despedidas de soltera</a>
      <a href="' . $base_url . '/stripper-cumpleanos-barcelona/" class="lxc-link-pill">🎂 Cumpleaños Barcelona</a>
      <a href="' . $base_url . '/stripper-a-domicilio-barcelona/" class="lxc-link-pill">🏠 A domicilio Barcelona</a>
      <a href="' . $base_url . '/stripper-fiestas-privadas-barcelona/" class="lxc-link-pill">🎉 Fiestas privadas</a>
    </div>
  </div>
</section>

<div class="lxc-cta-final">
  <h2>¿Lista para la sorpresa masculina definitiva?</h2>
  <p>Reserva tu stripper masculino (chippendale) en Barcelona ahora.<br>Despedidas · Cumpleaños · Fiestas privadas · Desde 180€</p>
  <a href="https://wa.me/34644507282?text=Quiero+contratar+stripper+masculino+Barcelona" class="lxc-btn lxc-btn--gold">📲 Reservar por WhatsApp</a>
</div>

' . build_jsonld($masc_slug, $masc_title, $masc_desc_rm, $masc_url, $masc_faqs, 'stripper masculino barcelona', '180') . '
</div>';

// ─────────────────────────────────────────────────────────────────────────────
// DATABASE OPERATIONS: create/update all 5 cluster pages
// ─────────────────────────────────────────────────────────────────────────────
$clusters = [
  [
    'post_id'     => 67991,   // existing "Stripper Despedidas" — UPDATE
    'action'      => 'update',
    'slug'        => $desp_slug,
    'title'       => $desp_title,
    'html'        => $desp_html,
    'rm_title'    => $desp_title,
    'rm_desc'     => $desp_desc_rm,
    'rm_keyword'  => 'stripper despedida soltera barcelona,stripper despedida barcelona,contratar stripper despedida barcelona,show stripper despedida soltera',
    'thumbnail'   => 67965, // bcn-stripper-07.jpg
    'canonical'   => $desp_url,
  ],
  [
    'post_id'     => 67992,   // existing "Stripper A Domicilio" — UPDATE
    'action'      => 'update',
    'slug'        => $adom_slug,
    'title'       => $adom_title,
    'html'        => $adom_html,
    'rm_title'    => $adom_title,
    'rm_desc'     => $adom_desc_rm,
    'rm_keyword'  => 'stripper a domicilio barcelona,stripper domicilio barcelona,contratar stripper domicilio barcelona,stripper barcelona domicilio 2026',
    'thumbnail'   => 67966, // bcn-stripper-08.jpg
    'canonical'   => $adom_url,
  ],
  [
    'post_id'     => 0,       // NEW
    'action'      => 'insert',
    'slug'        => $cump_slug,
    'title'       => $cump_title,
    'html'        => $cump_html,
    'rm_title'    => $cump_title,
    'rm_desc'     => $cump_desc_rm,
    'rm_keyword'  => 'stripper cumpleanos barcelona,stripper para cumpleanos barcelona,contratar stripper cumpleanos barcelona,show stripper cumpleaños 2026',
    'thumbnail'   => 67967, // bcn-stripper-09.jpg
    'canonical'   => $cump_url,
  ],
  [
    'post_id'     => 0,       // NEW
    'action'      => 'insert',
    'slug'        => $fies_slug,
    'title'       => $fies_title,
    'html'        => $fies_html,
    'rm_title'    => $fies_title,
    'rm_desc'     => $fies_desc_rm,
    'rm_keyword'  => 'stripper fiestas privadas barcelona,stripper fiesta privada barcelona,camarera sexy barcelona,contratar stripper fiesta barcelona',
    'thumbnail'   => 67970, // bcn-stripper-12.jpg
    'canonical'   => $fies_url,
  ],
  [
    'post_id'     => 0,       // NEW
    'action'      => 'insert',
    'slug'        => $masc_slug,
    'title'       => $masc_title,
    'html'        => $masc_html,
    'rm_title'    => $masc_title,
    'rm_desc'     => $masc_desc_rm,
    'rm_keyword'  => 'stripper masculino barcelona,chippendale barcelona,contratar stripper masculino barcelona,stripper masculino despedida barcelona',
    'thumbnail'   => 67973, // bcn-stripper-15.jpg
    'canonical'   => $masc_url,
  ],
];

$results = [];

foreach ($clusters as $cl) {
    $html_escaped = $conn->real_escape_string($cl['html']);
    $title_esc    = $conn->real_escape_string($cl['title']);
    $slug_esc     = $conn->real_escape_string($cl['slug']);

    if ($cl['action'] === 'update') {
        $pid = (int)$cl['post_id'];
        $conn->query("UPDATE el_posts SET
            post_content   = '{$html_escaped}',
            post_title     = '{$title_esc}',
            post_name      = '{$slug_esc}',
            post_status    = 'publish',
            post_modified  = '{$now}',
            post_modified_gmt = '{$now}'
            WHERE ID = {$pid}");
        $results[] = "UPDATED post {$pid} — {$cl['slug']}";
    } else {
        $conn->query("INSERT INTO el_posts
            (post_author,post_date,post_date_gmt,post_content,post_title,post_excerpt,post_status,
             comment_status,ping_status,post_name,post_type,post_modified,post_modified_gmt,to_ping,pinged,post_content_filtered)
            VALUES (1,'{$now}','{$now}','{$html_escaped}','{$title_esc}','','publish',
                    'closed','closed','{$slug_esc}','page','{$now}','{$now}','','','')");
        $pid = $conn->insert_id;
        $cl['post_id'] = $pid;
        $results[] = "INSERTED post {$pid} — {$cl['slug']}";
    }

    $pid = (int)$cl['post_id'];

    // Featured image
    $conn->query("DELETE FROM el_postmeta WHERE post_id={$pid} AND meta_key='_thumbnail_id'");
    $conn->query("INSERT INTO el_postmeta (post_id,meta_key,meta_value) VALUES ({$pid},'_thumbnail_id','{$cl['thumbnail']}')");

    // RankMath title
    $rm_title = $conn->real_escape_string($cl['rm_title']);
    $conn->query("DELETE FROM el_postmeta WHERE post_id={$pid} AND meta_key='rank_math_title'");
    $conn->query("INSERT INTO el_postmeta (post_id,meta_key,meta_value) VALUES ({$pid},'rank_math_title','{$rm_title}')");

    // RankMath description
    $rm_desc = $conn->real_escape_string($cl['rm_desc']);
    $conn->query("DELETE FROM el_postmeta WHERE post_id={$pid} AND meta_key='rank_math_description'");
    $conn->query("INSERT INTO el_postmeta (post_id,meta_key,meta_value) VALUES ({$pid},'rank_math_description','{$rm_desc}')");

    // RankMath focus keyword
    $rm_kw = $conn->real_escape_string($cl['rm_keyword']);
    $conn->query("DELETE FROM el_postmeta WHERE post_id={$pid} AND meta_key='rank_math_focus_keyword'");
    $conn->query("INSERT INTO el_postmeta (post_id,meta_key,meta_value) VALUES ({$pid},'rank_math_focus_keyword','{$rm_kw}')");

    // Robots: index, follow
    $conn->query("DELETE FROM el_postmeta WHERE post_id={$pid} AND meta_key='rank_math_robots'");
    $conn->query("INSERT INTO el_postmeta (post_id,meta_key,meta_value) VALUES ({$pid},'rank_math_robots','a:2:{i:0;s:5:\"index\";i:1;s:6:\"follow\";}')");

    // Canonical
    $canonical = $conn->real_escape_string($cl['canonical']);
    $conn->query("DELETE FROM el_postmeta WHERE post_id={$pid} AND meta_key='rank_math_canonical_url'");
    $conn->query("INSERT INTO el_postmeta (post_id,meta_key,meta_value) VALUES ({$pid},'rank_math_canonical_url','{$canonical}')");

    // WP page template (default, no sidebar)
    $conn->query("DELETE FROM el_postmeta WHERE post_id={$pid} AND meta_key='_wp_page_template'");
    $conn->query("INSERT INTO el_postmeta (post_id,meta_key,meta_value) VALUES ({$pid},'_wp_page_template','default')");
}

echo "\n=== CLUSTER PAGES RESULTS ===\n";
foreach ($results as $r) { echo $r . "\n"; }
echo "\nDONE — All 5 cluster pages created/updated.\n";
$conn->close();
