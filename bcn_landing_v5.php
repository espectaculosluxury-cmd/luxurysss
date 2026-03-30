<?php
/**
 * BCN Landing V5 - Sin variables CSS, sin comillas simples en CSS
 * Evita la corrupción de WordPress (-- → &#8211;, ' → &#8216;)
 */
require('/var/www/vhosts/espectaculosluxury.com/httpdocs/wp-load.php');

// Eliminar filtros que corrompen el contenido
kses_remove_filters();
remove_filter('content_save_pre', 'wp_filter_post_kses');
remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');
remove_filter('the_content', 'wptexturize');
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
remove_filter('the_title', 'wptexturize');

// Colores hardcoded (sin variables CSS)
// gold = #c8a96e, gold2 = #e0bc6a, dark = #111111, light = #f9f6f0, text = #2a2a2a

$new_content = <<<'HTML'
<div id="lux-bcn-main">
<style>
#lux-bcn-main{font-family:"Inter","Helvetica Neue",Arial,sans-serif;color:#2a2a2a;background:#fff;line-height:1.6}
#lux-bcn-main *{box-sizing:border-box;margin:0;padding:0}
#lux-bcn-main a{color:inherit}
#lux-bcn-main img{display:block;max-width:100%}

.lx-hero{
  background:linear-gradient(150deg,rgba(8,8,8,.94) 0%,rgba(20,15,5,.90) 55%,rgba(35,25,8,.86) 100%),
  url("https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-01.jpg") center/cover no-repeat;
  color:#fff;padding:90px 24px 80px;text-align:center;position:relative;overflow:hidden
}
.lx-hero::before{content:"";position:absolute;inset:0;background:radial-gradient(ellipse 80% 60% at 50% 0%,rgba(200,169,110,.12) 0%,transparent 70%);pointer-events:none}
.lx-hero__inner{max-width:880px;margin:0 auto;position:relative;z-index:1}
.lx-hero__badge{display:inline-flex;align-items:center;gap:8px;background:rgba(200,169,110,.13);border:1px solid rgba(200,169,110,.40);border-radius:100px;padding:8px 20px;font-size:.72rem;color:#c8a96e;letter-spacing:.1em;text-transform:uppercase;margin-bottom:28px}
.lx-hero__badge::before{content:"";display:inline-block;width:7px;height:7px;border-radius:50%;background:#c8a96e;animation:lxpulse 2s infinite}
@keyframes lxpulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(.8)}}
.lx-h1{font-size:clamp(1.8rem,4.8vw,3rem);font-weight:900;line-height:1.15;color:#fff;margin-bottom:20px;letter-spacing:-.025em}
.lx-h1 span{color:#c8a96e}
.lx-hero__sub{font-size:1.08rem;color:rgba(255,255,255,.82);max-width:660px;margin:0 auto 36px;line-height:1.65}
.lx-cta-wrap{display:flex;flex-wrap:wrap;gap:14px;justify-content:center;margin-bottom:36px}
.lx-btn{display:inline-flex;align-items:center;gap:9px;padding:15px 30px;border-radius:8px;font-weight:700;font-size:.98rem;text-decoration:none;transition:all .22s;cursor:pointer;border:none;line-height:1}
.lx-btn-gold{background:linear-gradient(135deg,#c8a96e,#e0bc6a);color:#111;box-shadow:0 4px 16px rgba(200,169,110,.3)}
.lx-btn-gold:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(200,169,110,.45)}
.lx-btn-outline{background:transparent;color:#fff;border:2px solid rgba(255,255,255,.35)}
.lx-btn-outline:hover{border-color:#c8a96e;color:#c8a96e;background:rgba(200,169,110,.07)}
.lx-trust{display:flex;flex-wrap:wrap;justify-content:center;gap:12px}
.lx-trust__item{display:flex;align-items:center;gap:7px;font-size:.8rem;color:rgba(255,255,255,.8);background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.14);padding:7px 16px;border-radius:100px}

.lx-divider{display:block;height:3px;background:linear-gradient(90deg,transparent,#c8a96e,#e0bc6a,#c8a96e,transparent);opacity:.4;border:none;margin:0}

.lx-wrap-dark{background:#111111}
.lx-wrap-light{background:#f9f6f0}
.lx-wrap-white{background:#ffffff}
.lx-wrap-ctafinal{background:linear-gradient(135deg,#111111 0%,#1a1200 100%)}

.lx-section{padding:80px 24px;max-width:1140px;margin:0 auto}
.lx-section-sm{padding:60px 24px;max-width:1140px;margin:0 auto}

.lx-sec-hdr{text-align:center;margin-bottom:48px}
.lx-sec-hdr-left{text-align:left;margin-bottom:40px}
.lx-sec-title{font-size:clamp(1.45rem,3.2vw,2.1rem);font-weight:800;color:#111111;letter-spacing:-.025em;line-height:1.2;margin-bottom:10px}
.lx-wrap-dark .lx-sec-title,.lx-wrap-ctafinal .lx-sec-title{color:#fff}
.lx-sec-sub{color:#666;font-size:.97rem;margin-top:8px;line-height:1.5}
.lx-wrap-dark .lx-sec-sub,.lx-wrap-ctafinal .lx-sec-sub{color:rgba(255,255,255,.62)}
.lx-gold-line{display:block;width:52px;height:3px;background:linear-gradient(90deg,#c8a96e,#e0bc6a);border-radius:3px;margin:12px auto 0}
.lx-sec-hdr-left .lx-gold-line{margin:12px 0 0}

.lx-seo-box{max-width:820px;margin:0 auto}
.lx-seo-box p{font-size:.97rem;color:#555;line-height:1.78;margin-bottom:16px}
.lx-seo-box p:last-child{margin-bottom:0}

.lx-cards{display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:24px}
.lx-card{background:#fff;border-radius:14px;overflow:hidden;box-shadow:0 3px 16px rgba(0,0,0,.08);transition:transform .22s,box-shadow .22s;border:1px solid rgba(200,169,110,.18);display:flex;flex-direction:column}
.lx-card:hover{transform:translateY(-5px);box-shadow:0 16px 40px rgba(0,0,0,.13)}
.lx-card__img{width:100%;height:210px;object-fit:cover;object-position:top center}
.lx-card__body{padding:22px;flex:1;display:flex;flex-direction:column}
.lx-card__tag{font-size:.68rem;color:#c8a96e;text-transform:uppercase;letter-spacing:.08em;font-weight:700;margin-bottom:7px}
.lx-card__title{font-size:1.05rem;font-weight:800;color:#111111;margin-bottom:9px;line-height:1.3}
.lx-card__desc{font-size:.87rem;color:#666;line-height:1.55;margin-bottom:14px;flex:1}
.lx-card__price{font-size:1.15rem;font-weight:800;color:#c8a96e;margin-bottom:14px}
.lx-card__btn{display:inline-flex;align-items:center;justify-content:center;padding:10px 20px;background:linear-gradient(135deg,#c8a96e,#e0bc6a);color:#111;border-radius:8px;font-size:.85rem;font-weight:700;text-decoration:none;transition:opacity .2s;align-self:flex-start}
.lx-card__btn:hover{opacity:.85}

.lx-muni-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(170px,1fr));gap:14px}
.lx-muni-card{background:rgba(255,255,255,.06);border:1px solid rgba(200,169,110,.25);border-radius:8px;padding:18px 14px;text-align:center;text-decoration:none;color:#fff;transition:all .2s}
.lx-muni-card:hover{background:#c8a96e;color:#111;border-color:#c8a96e}
.lx-muni-card__icon{font-size:1.6rem;margin-bottom:8px}
.lx-muni-card__name{font-size:.88rem;font-weight:700;line-height:1.2}
.lx-muni-card__dist{font-size:.73rem;color:rgba(255,255,255,.55);margin-top:4px}
.lx-muni-card:hover .lx-muni-card__dist{color:rgba(0,0,0,.6)}

.lx-checklist{list-style:none;display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:10px 24px}
.lx-checklist li{padding:10px 10px 10px 36px;position:relative;font-size:.93rem;color:#444;line-height:1.45;background:#fff;border-radius:8px;border:1px solid rgba(200,169,110,.12)}
.lx-checklist li::before{content:"✓";position:absolute;left:12px;top:11px;color:#c8a96e;font-weight:900;font-size:1rem}
.lx-checklist-plain{list-style:none;display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:6px 24px}
.lx-checklist-plain li{padding:8px 8px 8px 28px;position:relative;font-size:.93rem;color:#444;line-height:1.45}
.lx-checklist-plain li::before{content:"✓";position:absolute;left:6px;top:9px;color:#c8a96e;font-weight:900;font-size:1rem}

.lx-table-wrap{overflow-x:auto;border-radius:12px;box-shadow:0 3px 16px rgba(0,0,0,.08);margin-top:24px}
.lx-nightlife{width:100%;border-collapse:collapse;min-width:360px}
.lx-nightlife thead tr{background:linear-gradient(135deg,#1a1a1a,#2a1f00)}
.lx-nightlife th{color:#c8a96e;padding:14px 18px;text-align:left;font-size:.8rem;letter-spacing:.07em;text-transform:uppercase;font-weight:700;white-space:nowrap}
.lx-nightlife tbody tr{background:#fff}
.lx-nightlife tbody tr:nth-child(even){background:#fdf9f3}
.lx-nightlife td{padding:13px 18px;border-bottom:1px solid rgba(200,169,110,.12);font-size:.91rem;color:#333;vertical-align:middle}
.lx-nightlife tbody tr:last-child td{border-bottom:none}
.lx-nightlife tbody tr:hover td{background:rgba(200,169,110,.07);color:#111}
.lx-nightlife td strong{color:#111;font-weight:700}
.lx-td-tipo{display:inline-flex;align-items:center;background:rgba(200,169,110,.12);color:#7a5c20;border-radius:100px;padding:3px 12px;font-size:.78rem;font-weight:600;white-space:nowrap}

.lx-steps{display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:24px}
.lx-step{background:#fff;border-radius:14px;padding:28px 24px;border:1px solid rgba(200,169,110,.2);text-align:center;box-shadow:0 2px 12px rgba(0,0,0,.05)}
.lx-step__num{width:52px;height:52px;border-radius:50%;background:linear-gradient(135deg,#c8a96e,#e0bc6a);display:flex;align-items:center;justify-content:center;font-weight:900;font-size:1.15rem;color:#111;margin:0 auto 16px;box-shadow:0 4px 14px rgba(200,169,110,.35)}
.lx-step__title{font-weight:800;font-size:1rem;color:#111111;margin-bottom:8px}
.lx-step__desc{font-size:.87rem;color:#777;line-height:1.55}

.lx-price-wrap{overflow-x:auto;border-radius:14px;box-shadow:0 4px 24px rgba(0,0,0,.22);margin-top:8px}
.lx-price-table{width:100%;border-collapse:collapse;min-width:560px}
.lx-price-table thead tr{background:linear-gradient(135deg,#c8a96e,#e0bc6a)}
.lx-price-table th{color:#111;padding:16px 20px;text-align:left;font-size:.82rem;letter-spacing:.06em;text-transform:uppercase;font-weight:800;white-space:nowrap}
.lx-price-table th:not(:first-child){text-align:center}
.lx-price-table tbody tr{background:rgba(255,255,255,.04)}
.lx-price-table tbody tr:nth-child(even){background:rgba(255,255,255,.08)}
.lx-price-table td{padding:15px 20px;border-bottom:1px solid rgba(255,255,255,.08);font-size:.93rem;color:rgba(255,255,255,.92);vertical-align:middle}
.lx-price-table tbody tr:last-child td{border-bottom:none}
.lx-price-table td:not(:first-child){text-align:center}
.lx-price-table td strong{color:#ffffff;font-weight:700}
.lx-price-hl{font-weight:800;color:#e0bc6a;font-size:1.05rem;white-space:nowrap}
.lx-price-table tbody tr:hover td{background:rgba(200,169,110,.08)}
.lx-price-note{color:rgba(255,255,255,.45);font-size:.78rem;margin-top:14px;text-align:center;font-style:italic}

.lx-testimonials{display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:20px}
.lx-testimonial{background:#fff;border-radius:14px;padding:24px;border-left:4px solid #c8a96e;box-shadow:0 3px 14px rgba(0,0,0,.07)}
.lx-testimonial__stars{font-size:1rem;margin-bottom:12px;letter-spacing:2px}
.lx-testimonial blockquote{font-size:.91rem;color:#555;line-height:1.65;margin-bottom:14px;font-style:italic}
.lx-testimonial cite{font-size:.8rem;color:#c8a96e;font-weight:700;font-style:normal;display:block}

.lx-faq{margin-top:8px}
.lx-faq details{border:1px solid rgba(200,169,110,.22);border-radius:8px;margin-bottom:10px;background:#fff;overflow:hidden}
.lx-faq details[open]{border-color:#c8a96e;box-shadow:0 3px 14px rgba(200,169,110,.12)}
.lx-faq summary{padding:17px 22px;cursor:pointer;font-weight:700;font-size:.93rem;color:#111111;list-style:none;display:flex;justify-content:space-between;align-items:center;gap:16px;user-select:none}
.lx-faq summary::-webkit-details-marker{display:none}
.lx-faq summary::after{content:"+";font-size:1.4rem;color:#c8a96e;flex-shrink:0;transition:transform .2s;line-height:1}
.lx-faq details[open] summary{border-bottom:1px solid rgba(200,169,110,.15)}
.lx-faq details[open] summary::after{transform:rotate(45deg)}
.lx-faq details p{padding:16px 22px 18px;font-size:.9rem;color:#555;line-height:1.68}

.lx-cta-final{padding:90px 24px;text-align:center}
.lx-cta-final h2{font-size:clamp(1.6rem,3.5vw,2.2rem);font-weight:900;color:#fff;margin-bottom:12px}
.lx-cta-final p{color:rgba(255,255,255,.72);margin-bottom:32px;font-size:1.05rem;line-height:1.5}

@media(max-width:768px){
  .lx-section{padding:60px 18px}
  .lx-section-sm{padding:50px 18px}
  .lx-hero{padding:70px 18px 60px}
  .lx-h1{font-size:1.6rem}
  .lx-cards{grid-template-columns:1fr}
  .lx-steps{grid-template-columns:1fr 1fr}
  .lx-price-table th,.lx-price-table td{padding:12px 14px;font-size:.85rem}
  .lx-cta-final{padding:60px 18px}
}
@media(max-width:480px){
  .lx-hero{padding:60px 16px 50px}
  .lx-h1{font-size:1.45rem}
  .lx-hero__sub{font-size:.95rem}
  .lx-trust{gap:8px}
  .lx-trust__item{font-size:.74rem;padding:6px 12px}
  .lx-steps{grid-template-columns:1fr}
  .lx-muni-grid{grid-template-columns:repeat(2,1fr)}
  .lx-sec-hdr{margin-bottom:32px}
  .lx-btn{padding:13px 22px;font-size:.9rem}
  .lx-cta-final{padding:50px 16px}
}
</style>

<script type="application/ld+json">
{"@context":"https://schema.org","@graph":[{"@type":"LocalBusiness","@id":"https://espectaculosluxury.com/#organization","name":"Espectáculos Luxury","url":"https://espectaculosluxury.com","telephone":"+34695858978","priceRange":"€€","image":"https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-01.jpg","description":"Agencia líder en shows de stripper a domicilio en Barcelona. Más de 10 años de experiencia y +5.000 eventos en Barcelona y Cataluña.","areaServed":[{"@type":"City","name":"Barcelona"},{"@type":"City","name":"Hospitalet de Llobregat"},{"@type":"City","name":"Badalona"},{"@type":"City","name":"Sabadell"},{"@type":"City","name":"Terrassa"},{"@type":"City","name":"Sant Cugat del Vallès"},{"@type":"City","name":"Sitges"},{"@type":"City","name":"Cornellà de Llobregat"}],"address":{"@type":"PostalAddress","addressLocality":"Barcelona","addressRegion":"Cataluña","addressCountry":"ES"},"sameAs":["https://wa.me/34695858978"],"aggregateRating":{"@type":"AggregateRating","ratingValue":"5","reviewCount":"312","bestRating":"5"}},{"@type":"Event","name":"Show de Stripper en Barcelona 2026 | Espectáculos Luxury","description":"Shows de striptease profesionales en Barcelona para despedidas de soltera, cumpleaños y fiestas privadas.","url":"https://espectaculosluxury.com/stripper-barcelona/","startDate":"2026-01-01","endDate":"2026-12-31","eventStatus":"https://schema.org/EventScheduled","eventAttendanceMode":"https://schema.org/OfflineEventAttendanceMode","location":{"@type":"Place","name":"Barcelona y Área Metropolitana","address":{"@type":"PostalAddress","addressLocality":"Barcelona","addressRegion":"Cataluña","addressCountry":"ES"}},"image":["https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-01.jpg","https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-05.jpg","https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-14.jpg"],"performer":{"@type":"PerformingGroup","name":"Artistas de Espectáculos Luxury"},"organizer":{"@id":"https://espectaculosluxury.com/#organization"},"offers":[{"@type":"Offer","name":"Show Integral","price":"180","priceCurrency":"EUR","availability":"https://schema.org/InStock","url":"https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/show-integral-stripper-barcelona/"},{"@type":"Offer","name":"Show Lésbico Dúo","price":"330","priceCurrency":"EUR","availability":"https://schema.org/InStock","url":"https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/show-lesbico-duo-barcelona/"},{"@type":"Offer","name":"Show con Juguete Erótico","price":"300","priceCurrency":"EUR","availability":"https://schema.org/InStock","url":"https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/show-juguete-erotico-barcelona/"},{"@type":"Offer","name":"Camarera Sexy","price":"180","priceCurrency":"EUR","availability":"https://schema.org/InStock","url":"https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/camarera-sexy-barcelona/"},{"@type":"Offer","name":"Pack Camarera + Show","price":"380","priceCurrency":"EUR","availability":"https://schema.org/InStock","url":"https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/pack-camarera-show-barcelona/"}]},{"@type":"FAQPage","mainEntity":[{"@type":"Question","name":"¿Cuánto cuesta contratar un stripper en Barcelona?","acceptedAnswer":{"@type":"Answer","text":"Los shows de stripper en Barcelona empiezan desde 180€ para el Show Integral. El Show Lésbico Dúo parte de 330€, el Show con Juguete Erótico desde 300€, la Camarera Sexy desde 180€/hora y el Pack Camarera + Show desde 380€."}},{"@type":"Question","name":"¿Cuánto tiempo tardan en confirmar la reserva?","acceptedAnswer":{"@type":"Answer","text":"Confirmamos todas las reservas en menos de 2 horas por WhatsApp o teléfono. Llama al 695 858 978."}},{"@type":"Question","name":"¿Actúan en toda Barcelona y área metropolitana?","acceptedAnswer":{"@type":"Answer","text":"Sí, cubrimos toda Barcelona y área metropolitana hasta 60 km: Hospitalet, Badalona, Sabadell, Terrassa, Cornellà, Sant Cugat, Sitges, Castelldefels."}},{"@type":"Question","name":"¿Se puede contratar un stripper para un hotel en Barcelona?","acceptedAnswer":{"@type":"Answer","text":"Sí, realizamos shows en hoteles de lujo: Hotel W, Arts Barcelona, NH Collection, Meliá, Hyatt Regency, Hilton Diagonal Mar."}},{"@type":"Question","name":"¿Cuáles son los barrios con más shows de Barcelona?","acceptedAnswer":{"@type":"Answer","text":"Eixample (Gaixample), El Born, Gothic, Barceloneta, Gràcia, Poblenou y Sarrià-Sant Gervasi."}},{"@type":"Question","name":"¿Tienen disponibilidad los fines de semana y festivos?","acceptedAnswer":{"@type":"Answer","text":"Sí, disponibilidad las 24 horas, 365 días al año, incluyendo fines de semana y festivos."}},{"@type":"Question","name":"¿Qué diferencia hay entre el show integral y el lésbico dúo?","acceptedAnswer":{"@type":"Answer","text":"El Show Integral es con una sola artista. El Show Lésbico Dúo incluye dos artistas con coreografía conjunta, el más demandado para despedidas de soltera."}},{"@type":"Question","name":"¿Cómo se contrata la camarera sexy en Barcelona?","acceptedAnswer":{"@type":"Answer","text":"Por WhatsApp al 695 858 978. El servicio parte de 180€/hora. Pack camarera + show desde 380€."}}]}]}
</script>

<!-- HERO -->
<section class="lx-hero">
  <div class="lx-hero__inner">
    <div class="lx-hero__badge">Barcelona · Shows Premium 2026 · Confirmación en 2h</div>
    <h1 class="lx-h1">Stripper en <span>Barcelona</span> 2026<br>Shows VIP desde 180€ · Despedidas y Fiestas Privadas</h1>
    <p class="lx-hero__sub">La agencia líder en shows de striptease a domicilio en Barcelona. Artistas verificadas, discreción total y disponibilidad 24h en toda Barcelona y área metropolitana.</p>
    <div class="lx-cta-wrap">
      <a href="https://wa.me/34695858978?text=Hola%2C+quiero+contratar+un+stripper+en+Barcelona" class="lx-btn lx-btn-gold">📲 Reservar por WhatsApp</a>
      <a href="tel:+34695858978" class="lx-btn lx-btn-outline">📞 695 858 978</a>
    </div>
    <div class="lx-trust">
      <span class="lx-trust__item">⭐⭐⭐⭐⭐ +5.000 fiestas en Barcelona</span>
      <span class="lx-trust__item">🗺️ Toda Barcelona y Cataluña</span>
      <span class="lx-trust__item">⚡ Confirmación en menos de 2h</span>
      <span class="lx-trust__item">🔒 100% Discreto y profesional</span>
    </div>
  </div>
</section>

<span class="lx-divider"></span>

<!-- SEO INTRO -->
<div class="lx-wrap-white">
  <div class="lx-section-sm">
    <div class="lx-seo-box">
      <h2 style="font-size:1.45rem;font-weight:800;color:#111111;margin-bottom:8px">Stripper en Barcelona: Shows VIP a Domicilio</h2>
      <span class="lx-gold-line" style="margin:0 0 24px"></span>
      <p>Contratar un <strong>stripper en Barcelona</strong> para una <strong>despedida de soltera</strong>, cumpleaños o fiesta privada en 2026 es más fácil que nunca con <strong>Espectáculos Luxury</strong>. Somos la agencia con más experiencia de Cataluña: más de 10 años organizando shows de striptease profesionales en <strong>domicilios, hoteles, apartamentos turísticos, villas con piscina y salas privadas</strong> de Barcelona y toda el área metropolitana.</p>
      <p>Nuestro catálogo 2026 incluye el <strong>Show Integral desde 180€</strong>, el espectacular <strong>Show Lésbico Dúo desde 330€</strong>, el <strong>Show con Juguete Erótico desde 300€</strong>, la <strong>Camarera Sexy desde 180€/hora</strong> y el popular <strong>Pack Camarera + Show desde 380€</strong>. Todas nuestras artistas están verificadas, son 100% profesionales y ofrecen la máxima discreción. Confirmamos tu reserva en <strong>menos de 2 horas</strong>.</p>
    </div>
  </div>
</div>

<span class="lx-divider"></span>

<!-- CATÁLOGO -->
<div class="lx-wrap-light">
  <div class="lx-section">
    <div class="lx-sec-hdr">
      <div class="lx-hero__badge" style="margin-bottom:16px">Catálogo 2026</div>
      <h2 class="lx-sec-title">Shows de Stripper en Barcelona</h2>
      <span class="lx-gold-line"></span>
      <p class="lx-sec-sub" style="margin-top:14px">Selecciona el show perfecto para tu celebración</p>
    </div>
    <div class="lx-cards">
      <div class="lx-card">
        <img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-01.jpg" alt="Show Integral stripper Barcelona 2026 a domicilio" loading="lazy" width="400" height="300">
        <div class="lx-card__body">
          <div class="lx-card__tag">⭐ Más popular</div>
          <div class="lx-card__title">Show Integral</div>
          <div class="lx-card__desc">Strip-tease completo con coreografía, accesorios y actuación privada exclusiva. 30 a 45 min.</div>
          <div class="lx-card__price">desde 180€</div>
          <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/show-integral-stripper-barcelona/" class="lx-card__btn">Ver show →</a>
        </div>
      </div>
      <div class="lx-card">
        <img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-08.jpg" alt="Show Lésbico Dúo Barcelona despedida de soltera" loading="lazy" width="400" height="300">
        <div class="lx-card__body">
          <div class="lx-card__tag">🔥 Top despedidas</div>
          <div class="lx-card__title">Show Lésbico Dúo</div>
          <div class="lx-card__desc">Dos artistas profesionales con coreografía exclusiva. El show más espectacular para despedidas.</div>
          <div class="lx-card__price">desde 330€</div>
          <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/show-lesbico-duo-barcelona/" class="lx-card__btn">Ver show →</a>
        </div>
      </div>
      <div class="lx-card">
        <img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-10.jpg" alt="Show con Juguete Erótico Barcelona show privado adultos" loading="lazy" width="400" height="300">
        <div class="lx-card__body">
          <div class="lx-card__tag">💋 Show atrevido</div>
          <div class="lx-card__title">Show con Juguete Erótico</div>
          <div class="lx-card__desc">Show integral más demostración con juguete erótico. Para fiestas privadas adultas más atrevidas.</div>
          <div class="lx-card__price">desde 300€</div>
          <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/show-juguete-erotico-barcelona/" class="lx-card__btn">Ver show →</a>
        </div>
      </div>
      <div class="lx-card">
        <img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-05.jpg" alt="Camarera Sexy Barcelona eventos fiestas privadas lencería" loading="lazy" width="400" height="300">
        <div class="lx-card__body">
          <div class="lx-card__tag">🥂 Ambiente perfecto</div>
          <div class="lx-card__title">Camarera Sexy</div>
          <div class="lx-card__desc">Camarera en lencería exclusiva para toda la fiesta. Atención personalizada y servicio VIP. Mínimo 2h.</div>
          <div class="lx-card__price">180€/hora</div>
          <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/camarera-sexy-barcelona/" class="lx-card__btn">Ver servicio →</a>
        </div>
      </div>
      <div class="lx-card">
        <img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-06.jpg" alt="Pack Camarera Sexy más Show Integral Barcelona todo incluido" loading="lazy" width="400" height="300">
        <div class="lx-card__body">
          <div class="lx-card__tag">🎁 Pack todo en uno</div>
          <div class="lx-card__title">Pack Camarera + Show</div>
          <div class="lx-card__desc">La experiencia completa: camarera sexy durante la fiesta más show integral al final.</div>
          <div class="lx-card__price">desde 380€</div>
          <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/pack-camarera-show-barcelona/" class="lx-card__btn">Ver pack →</a>
        </div>
      </div>
      <div class="lx-card">
        <img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-14.jpg" alt="Stripper Masculino Barcelona shows para chicas despedida soltero" loading="lazy" width="400" height="300">
        <div class="lx-card__body">
          <div class="lx-card__tag">💪 Para chicas</div>
          <div class="lx-card__title">Stripper Masculino</div>
          <div class="lx-card__desc">Artistas masculinos musculosos y profesionales para despedidas de soltera y fiestas de chicas.</div>
          <div class="lx-card__price">desde 180€</div>
          <a href="https://wa.me/34695858978?text=Quiero+contratar+un+stripper+masculino+en+Barcelona" class="lx-card__btn">Reservar →</a>
        </div>
      </div>
    </div>
  </div>
</div>

<span class="lx-divider"></span>

<!-- COBERTURA -->
<div class="lx-wrap-dark">
  <div class="lx-section">
    <div class="lx-sec-hdr">
      <h2 class="lx-sec-title">¿Dónde Actuamos en Barcelona?</h2>
      <span class="lx-gold-line"></span>
      <p class="lx-sec-sub" style="margin-top:14px">Cobertura total de Barcelona ciudad y área metropolitana · Hasta 60 km del centro</p>
    </div>
    <div class="lx-muni-grid">
      <a href="https://espectaculosluxury.com/stripper-barcelona/" class="lx-muni-card"><div class="lx-muni-card__icon">🏙️</div><div class="lx-muni-card__name">Barcelona Ciudad</div><div class="lx-muni-card__dist">Eixample, Gràcia, Gothic</div></a>
      <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx-muni-card"><div class="lx-muni-card__icon">🌆</div><div class="lx-muni-card__name">Hospitalet</div><div class="lx-muni-card__dist">5 km del centro</div></a>
      <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx-muni-card"><div class="lx-muni-card__icon">🌇</div><div class="lx-muni-card__name">Badalona</div><div class="lx-muni-card__dist">8 km del centro</div></a>
      <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx-muni-card"><div class="lx-muni-card__icon">🏘️</div><div class="lx-muni-card__name">Cornellà</div><div class="lx-muni-card__dist">10 km del centro</div></a>
      <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx-muni-card"><div class="lx-muni-card__icon">🏡</div><div class="lx-muni-card__name">Sant Cugat</div><div class="lx-muni-card__dist">18 km del centro</div></a>
      <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx-muni-card"><div class="lx-muni-card__icon">🌃</div><div class="lx-muni-card__name">Sabadell</div><div class="lx-muni-card__dist">22 km del centro</div></a>
      <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx-muni-card"><div class="lx-muni-card__icon">🌉</div><div class="lx-muni-card__name">Terrassa</div><div class="lx-muni-card__dist">30 km del centro</div></a>
      <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx-muni-card"><div class="lx-muni-card__icon">🏖️</div><div class="lx-muni-card__name">Sitges</div><div class="lx-muni-card__dist">35 km · Costa</div></a>
      <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx-muni-card"><div class="lx-muni-card__icon">🌊</div><div class="lx-muni-card__name">Castelldefels</div><div class="lx-muni-card__dist">25 km · Playa</div></a>
      <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx-muni-card"><div class="lx-muni-card__icon">🏢</div><div class="lx-muni-card__name">Mataró</div><div class="lx-muni-card__dist">30 km · Maresme</div></a>
      <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx-muni-card"><div class="lx-muni-card__icon">🏗️</div><div class="lx-muni-card__name">Santa Coloma</div><div class="lx-muni-card__dist">10 km del centro</div></a>
      <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx-muni-card"><div class="lx-muni-card__icon">🗺️</div><div class="lx-muni-card__name">+60 km cobertura</div><div class="lx-muni-card__dist">Consulta disponibilidad</div></a>
    </div>
  </div>
</div>

<span class="lx-divider"></span>

<!-- ESPACIOS Y LOCALES -->
<div class="lx-wrap-white">
  <div class="lx-section">
    <div class="lx-sec-hdr-left">
      <h2 class="lx-sec-title">Espacios y Locales donde Actuamos</h2>
      <span class="lx-gold-line"></span>
      <p style="color:#666;font-size:.97rem;margin-top:18px;line-height:1.65">Llevamos el show a cualquier espacio de Barcelona: desde apartamentos del Eixample hasta villas con piscina en Sitges o hoteles de lujo en el Puerto Olímpico.</p>
    </div>
    <ul class="lx-checklist">
      <li>🏠 Domicilios particulares en cualquier barrio de Barcelona</li>
      <li>🏨 Hotel W, Hotel Arts, NH Collection, Meliá Diagonal, Hyatt Regency</li>
      <li>🛋️ Apartamentos turísticos y Airbnb en Gothic, Born, Eixample y Barceloneta</li>
      <li>🏖️ Villas con piscina en Sitges, Castelldefels, Gavà y Garraf</li>
      <li>🛥️ Yates y barcos en el Puerto Olímpico y Port Vell de Barcelona</li>
      <li>🎉 Salas privadas alquiladas y locales de fiestas en Barcelona</li>
      <li>🏢 Eventos corporativos y after-work en el 22@ y Diagonal</li>
      <li>🌊 Beach clubs: Shoko, Opium Beach, Barts Beachclub (verano)</li>
    </ul>

    <h3 style="font-size:1.15rem;font-weight:800;color:#111111;margin:52px 0 10px">🌙 Pubs y Discotecas de Moda en Barcelona 2026</h3>
    <span class="lx-gold-line" style="margin:0 0 18px"></span>
    <p style="color:#666;font-size:.92rem;margin-bottom:6px;line-height:1.65">Barcelona concentra la mayor oferta de ocio nocturno de España. Si organizas la despedida en alguno de estos locales, nuestras artistas pueden asistir o puedes contratar el show para antes o después:</p>
    <div class="lx-table-wrap">
      <table class="lx-nightlife">
        <thead><tr><th>Local</th><th>Zona</th><th>Tipo</th></tr></thead>
        <tbody>
          <tr><td><strong>Pacha Barcelona</strong></td><td>Port Olímpic</td><td><span class="lx-td-tipo">Discoteca</span></td></tr>
          <tr><td><strong>Opium Mar</strong></td><td>Barceloneta</td><td><span class="lx-td-tipo">Club + Beach</span></td></tr>
          <tr><td><strong>Razzmatazz</strong></td><td>Poblenou</td><td><span class="lx-td-tipo">Sala de conciertos</span></td></tr>
          <tr><td><strong>Sala Apolo</strong></td><td>Paral·lel</td><td><span class="lx-td-tipo">Sala clásica</span></td></tr>
          <tr><td><strong>Sutton Club</strong></td><td>Diagonal</td><td><span class="lx-td-tipo">Club VIP</span></td></tr>
          <tr><td><strong>Bling Bling</strong></td><td>Sant Gervasi</td><td><span class="lx-td-tipo">Discoteca luxury</span></td></tr>
          <tr><td><strong>El Nacional</strong></td><td>Passeig de Gràcia</td><td><span class="lx-td-tipo">Gastrobar VIP</span></td></tr>
          <tr><td><strong>Moog</strong></td><td>Arc del Teatre</td><td><span class="lx-td-tipo">Club electrónico</span></td></tr>
          <tr><td><strong>Jamboree</strong></td><td>Plaça Reial</td><td><span class="lx-td-tipo">Jazz / Club</span></td></tr>
          <tr><td><strong>Mirablau</strong></td><td>Tibidabo</td><td><span class="lx-td-tipo">Terraza con vistas</span></td></tr>
          <tr><td><strong>Shoko</strong></td><td>Port Olímpic</td><td><span class="lx-td-tipo">Beach Club</span></td></tr>
          <tr><td><strong>Club Catwalk</strong></td><td>Port Olímpic</td><td><span class="lx-td-tipo">Discoteca</span></td></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<span class="lx-divider"></span>

<!-- PASOS -->
<div class="lx-wrap-white">
  <div class="lx-section">
    <div class="lx-sec-hdr">
      <h2 class="lx-sec-title">Cómo Contratar un Stripper en Barcelona</h2>
      <span class="lx-gold-line"></span>
      <p class="lx-sec-sub" style="margin-top:14px">4 pasos simples para tener el show perfecto</p>
    </div>
    <div class="lx-steps">
      <div class="lx-step"><div class="lx-step__num">1</div><div class="lx-step__title">Elige el Show</div><div class="lx-step__desc">Selecciona entre nuestro catálogo: Integral, Lésbico Dúo, con Juguete, Camarera o Pack completo.</div></div>
      <div class="lx-step"><div class="lx-step__num">2</div><div class="lx-step__title">Contáctanos</div><div class="lx-step__desc">Escríbenos por WhatsApp al 695 858 978 o llámanos con los detalles: fecha, lugar y tipo de show.</div></div>
      <div class="lx-step"><div class="lx-step__num">3</div><div class="lx-step__title">Confirmación en 2h</div><div class="lx-step__desc">Recibirás confirmación y datos de la artista asignada en menos de 2 horas. Pago fácil y discreto.</div></div>
      <div class="lx-step"><div class="lx-step__num">4</div><div class="lx-step__title">¡Disfruta el Show!</div><div class="lx-step__desc">La artista llega puntual a tu evento y ofrece el show más profesional y memorable de Barcelona.</div></div>
    </div>
  </div>
</div>

<span class="lx-divider"></span>

<!-- PRECIOS -->
<div class="lx-wrap-dark">
  <div class="lx-section">
    <div class="lx-sec-hdr">
      <h2 class="lx-sec-title">Precios Shows Barcelona 2026</h2>
      <span class="lx-gold-line"></span>
    </div>
    <div class="lx-price-wrap">
      <table class="lx-price-table">
        <thead><tr><th>Tipo de Show</th><th>Precio</th><th>Duración</th><th>Ideal para</th></tr></thead>
        <tbody>
          <tr><td><strong>Show Integral</strong></td><td class="lx-price-hl">desde 180€</td><td>30 a 45 min</td><td>Cualquier evento</td></tr>
          <tr><td><strong>Show Lésbico Dúo</strong></td><td class="lx-price-hl">desde 330€</td><td>45 a 60 min</td><td>Despedidas de soltera</td></tr>
          <tr><td><strong>Show con Juguete Erótico</strong></td><td class="lx-price-hl">desde 300€</td><td>30 a 45 min</td><td>Fiestas adultas</td></tr>
          <tr><td><strong>Camarera Sexy</strong></td><td class="lx-price-hl">180€ / hora</td><td>Mínimo 2h</td><td>Toda la fiesta</td></tr>
          <tr><td><strong>Pack Camarera + Show</strong></td><td class="lx-price-hl">desde 380€</td><td>3 a 4 horas</td><td>Todo en uno</td></tr>
          <tr><td><strong>Stripper Masculino</strong></td><td class="lx-price-hl">desde 180€</td><td>30 a 45 min</td><td>Para chicas</td></tr>
        </tbody>
      </table>
    </div>
    <p class="lx-price-note">* Desplazamiento incluido en Barcelona y hasta 30 km. Consultar suplemento para distancias mayores.</p>
  </div>
</div>

<span class="lx-divider"></span>

<!-- TESTIMONIOS -->
<div class="lx-wrap-white">
  <div class="lx-section">
    <div class="lx-sec-hdr">
      <h2 class="lx-sec-title">Lo que Dicen Nuestros Clientes en Barcelona</h2>
      <span class="lx-gold-line"></span>
      <p class="lx-sec-sub" style="margin-top:14px">+5.000 eventos · valoración media 5/5</p>
    </div>
    <div class="lx-testimonials">
      <div class="lx-testimonial">
        <div class="lx-testimonial__stars">⭐⭐⭐⭐⭐</div>
        <blockquote>"Increíble show para la despedida de mi amiga en el Eixample. La chica era super profesional y discreta. Reservamos por WhatsApp y en 1 hora lo teníamos confirmado."</blockquote>
        <cite>Marta R., Barcelona · Despedida de soltera · Feb 2026</cite>
      </div>
      <div class="lx-testimonial">
        <div class="lx-testimonial__stars">⭐⭐⭐⭐⭐</div>
        <blockquote>"Contratamos el pack camarera más show para el cumpleaños de mi novio en un apartamento del Born. Fue un 10, superó todas las expectativas. Los precios son muy competitivos."</blockquote>
        <cite>Laura G., Barcelona · Cumpleaños privado · Ene 2026</cite>
      </div>
      <div class="lx-testimonial">
        <div class="lx-testimonial__stars">⭐⭐⭐⭐⭐</div>
        <blockquote>"Show lésbico dúo en un hotel del Puerto Olímpico para la despedida de soltero. Los chicos no se lo podían creer. Todo muy profesional y discreto. Sin duda la mejor agencia de Barcelona."</blockquote>
        <cite>Carlos M., Barcelona · Despedida de soltero · Mar 2026</cite>
      </div>
      <div class="lx-testimonial">
        <div class="lx-testimonial__stars">⭐⭐⭐⭐⭐</div>
        <blockquote>"Organizamos una fiesta privada en un chalet de Sitges y el show fue espectacular. La chica llegó puntual y el show duró más de lo esperado. ¡10 sobre 10!"</blockquote>
        <cite>Alejandro V., Sitges · Fiesta privada · Dic 2025</cite>
      </div>
    </div>
  </div>
</div>

<span class="lx-divider"></span>

<!-- POR QUÉ ELEGIRNOS -->
<div class="lx-wrap-light">
  <div class="lx-section">
    <div class="lx-sec-hdr">
      <h2 class="lx-sec-title">¿Por Qué Elegirnos en Barcelona?</h2>
      <span class="lx-gold-line"></span>
      <p class="lx-sec-sub" style="margin-top:14px">Somos la agencia de referencia en shows privados de Barcelona y Cataluña</p>
    </div>
    <ul class="lx-checklist-plain">
      <li>Más de 10 años de experiencia y más de 5.000 eventos en Barcelona y Cataluña</li>
      <li>Artistas verificadas, profesionales y con experiencia demostrada</li>
      <li>Confirmación de reserva garantizada en menos de 2 horas</li>
      <li>Discreción absoluta: sin cargos descriptivos en la factura</li>
      <li>Cobertura de toda Barcelona y área metropolitana (hasta 60 km)</li>
      <li>Disponibilidad 24 horas, 365 días al año incluyendo festivos</li>
      <li>Precios transparentes: todo incluido desde el primer presupuesto</li>
      <li>El catálogo de artistas más amplio de Barcelona y Cataluña</li>
      <li>Shows personalizables según el tipo de evento y preferencias</li>
      <li>Pago seguro, fácil y discreto por múltiples métodos</li>
    </ul>
  </div>
</div>

<span class="lx-divider"></span>

<!-- SHOWS POR EVENTO -->
<div class="lx-wrap-white">
  <div class="lx-section">
    <div class="lx-sec-hdr">
      <h2 class="lx-sec-title">Shows en Barcelona por Tipo de Evento</h2>
      <span class="lx-gold-line"></span>
      <p class="lx-sec-sub" style="margin-top:14px">Explora nuestros shows especializados para cada ocasión</p>
    </div>
    <div class="lx-cards" style="grid-template-columns:repeat(auto-fill,minmax(240px,1fr))">
      <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-despedida-soltera-barcelona-producto/" style="text-decoration:none">
        <div class="lx-card"><img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-02.jpg" alt="Stripper despedida de soltera Barcelona 2026" loading="lazy" width="300" height="200"><div class="lx-card__body"><div class="lx-card__tag">💍 Despedidas</div><div class="lx-card__title">Stripper Despedida de Soltera</div><div class="lx-card__desc">Shows exclusivos para despedidas de soltera en Barcelona</div><div class="lx-card__price">desde 180€</div></div></div>
      </a>
      <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-cumpleanos-barcelona-producto/" style="text-decoration:none">
        <div class="lx-card"><img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-15.jpg" alt="Stripper cumpleaños sorpresa Barcelona 2026" loading="lazy" width="300" height="200"><div class="lx-card__body"><div class="lx-card__tag">🎂 Cumpleaños</div><div class="lx-card__title">Stripper Cumpleaños Sorpresa</div><div class="lx-card__desc">La sorpresa perfecta para quien cumpla años en Barcelona</div><div class="lx-card__price">desde 180€</div></div></div>
      </a>
      <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" style="text-decoration:none">
        <div class="lx-card"><img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-11.jpg" alt="Stripper a domicilio Barcelona 24h disponible" loading="lazy" width="300" height="200"><div class="lx-card__body"><div class="lx-card__tag">🏠 A Domicilio · 24h</div><div class="lx-card__title">Stripper a Domicilio</div><div class="lx-card__desc">Shows en tu casa, hotel o apartamento turístico en Barcelona</div><div class="lx-card__price">desde 180€</div></div></div>
      </a>
      <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/show-lesbico-duo-barcelona/" style="text-decoration:none">
        <div class="lx-card"><img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-09.jpg" alt="Show lésbico dúo Barcelona despedidas soltera VIP" loading="lazy" width="300" height="200"><div class="lx-card__body"><div class="lx-card__tag">✨ Show Premium</div><div class="lx-card__title">Show Lésbico Dúo</div><div class="lx-card__desc">El show más demandado para despedidas exclusivas en Barcelona</div><div class="lx-card__price">desde 330€</div></div></div>
      </a>
    </div>
  </div>
</div>

<span class="lx-divider"></span>

<!-- FAQ -->
<div class="lx-wrap-light">
  <div class="lx-section">
    <div class="lx-sec-hdr">
      <h2 class="lx-sec-title">Preguntas Frecuentes sobre Stripper en Barcelona</h2>
      <span class="lx-gold-line"></span>
    </div>
    <div class="lx-faq">
      <details><summary>¿Cuánto cuesta contratar un stripper en Barcelona?</summary><p>Los shows de stripper en Barcelona empiezan desde <strong>180€</strong> para el Show Integral. El Show Lésbico Dúo parte de <strong>330€</strong>, el Show con Juguete Erótico desde <strong>300€</strong>, la Camarera Sexy desde <strong>180€/hora</strong> (mínimo 2 horas) y el Pack Camarera + Show desde <strong>380€</strong>. El desplazamiento está incluido en Barcelona ciudad y hasta 30 km.</p></details>
      <details><summary>¿Cuánto tiempo tardan en confirmar la reserva?</summary><p>Confirmamos todas las reservas de stripper en Barcelona en <strong>menos de 2 horas</strong> por WhatsApp o teléfono. En muchos casos la confirmación es inmediata. Llama al <strong>695 858 978</strong> o escríbenos por WhatsApp.</p></details>
      <details><summary>¿Actúan en toda Barcelona y área metropolitana?</summary><p>Sí, cubrimos <strong>toda la ciudad de Barcelona y su área metropolitana</strong> hasta 60 km: Hospitalet de Llobregat, Badalona, Sabadell, Terrassa, Cornellà, Sant Cugat del Vallès, Mataró, Sitges, Castelldefels, Gavà y muchos más.</p></details>
      <details><summary>¿Se puede contratar un show para un hotel de Barcelona?</summary><p>Sí, realizamos shows en los mejores hoteles de Barcelona: <strong>Hotel W Barcelona, Hotel Arts, NH Collection, Meliá Diagonal, Hyatt Regency, Hilton Diagonal Mar</strong> y cualquier hotel de la ciudad.</p></details>
      <details><summary>¿Cuáles son los barrios de Barcelona con más demanda de shows privados?</summary><p>Los barrios con mayor demanda son: <strong>Eixample</strong> (Gaixample), <strong>El Born y el Gothic Quarter</strong>, <strong>Barceloneta</strong>, <strong>Gràcia</strong>, <strong>Poblenou</strong> y <strong>Sarrià-Sant Gervasi</strong>.</p></details>
      <details><summary>¿Tienen disponibilidad los fines de semana y festivos?</summary><p>Tenemos disponibilidad <strong>las 24 horas, 365 días al año</strong>, incluyendo fines de semana, festivos y temporadas de alta demanda como San Valentín, verano y Nochevieja.</p></details>
      <details><summary>¿Qué diferencia hay entre el show integral y el lésbico dúo?</summary><p>El <strong>Show Integral</strong> es el striptease completo con una sola artista profesional. El <strong>Show Lésbico Dúo</strong> incluye dos artistas con coreografía conjunta y es el show más solicitado para <strong>despedidas de soltera</strong> en Barcelona.</p></details>
      <details><summary>¿Cómo funciona el servicio de camarera sexy en Barcelona?</summary><p>La <strong>camarera sexy</strong> atiende tu fiesta durante toda la celebración vestida con lencería exclusiva. Servicio mínimo de 2 horas a <strong>180€/hora por chica</strong>. También disponible el <strong>Pack Camarera + Show desde 380€</strong>.</p></details>
    </div>
  </div>
</div>

<span class="lx-divider"></span>

<!-- CTA FINAL -->
<div class="lx-wrap-ctafinal">
  <div class="lx-cta-final">
    <h2>¿Listo para Reservar tu Show en Barcelona?</h2>
    <p>Contacta ahora y confirmamos en menos de 2 horas · Disponibles 24h · 365 días al año</p>
    <div class="lx-cta-wrap">
      <a href="https://wa.me/34695858978?text=Hola%2C+quiero+contratar+un+stripper+en+Barcelona" class="lx-btn lx-btn-gold" style="font-size:1.05rem;padding:17px 34px">📲 Reservar por WhatsApp</a>
      <a href="tel:+34695858978" class="lx-btn lx-btn-outline" style="font-size:1.05rem;padding:17px 34px">📞 Llamar al 695 858 978</a>
    </div>
    <p style="margin-top:22px;font-size:.82rem;color:rgba(255,255,255,.38)">Espectáculos Luxury · Barcelona y Área Metropolitana · <a href="https://espectaculosluxury.com/stripper-madrid/" style="color:rgba(255,255,255,.38)">Ver también: Stripper en Madrid</a></p>
  </div>
</div>

</div>
HTML;

// Guardar directamente en la base de datos sin filtros de WP
global $wpdb;
$result = $wpdb->update(
    $wpdb->posts,
    ['post_content' => $new_content, 'post_modified' => current_time('mysql'), 'post_modified_gmt' => current_time('mysql', true)],
    ['ID' => 67406],
    ['%s', '%s', '%s'],
    ['%d']
);

if ($result === false) {
    echo "DB ERROR: " . $wpdb->last_error . "\n";
} else {
    echo "OK: post 67406 actualizado en BD. Filas: $result\n";
    echo "Longitud contenido: " . strlen($new_content) . " chars\n";
}

// Limpiar toda caché
wp_cache_delete(67406, 'posts');
wp_cache_delete(67406, 'post_meta');
clean_post_cache(67406);
wp_cache_flush();
if (function_exists('w3tc_flush_all')) { w3tc_flush_all(); }
if (function_exists('rocket_clean_domain')) { rocket_clean_domain(); }

// Verificar que no hay &#8211; en el contenido guardado
$saved = $wpdb->get_var("SELECT post_content FROM {$wpdb->posts} WHERE ID = 67406");
$corrupted = substr_count($saved, '&#8211;');
echo "Verificacion &#8211; en BD: $corrupted ocurrencias\n";
echo "Verificacion -- en BD: " . substr_count($saved, '--') . " ocurrencias\n";
echo "URL: https://espectaculosluxury.com/stripper-barcelona/\n";
