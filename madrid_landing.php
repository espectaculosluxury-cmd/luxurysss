<?php
// ============================================================
// MADRID LANDING PAGE v1 — GOLD MINIMAL PRO
// ============================================================
$html = <<<'HTMLEOF'
<!-- LANDING MADRID v1 – GOLD MINIMAL PRO -->
<div class="lux-landing-css" id="lux-madrid-main">
<style>
:root{--lux-gold:#c8a96e;--lux-dark:#111;--lux-light:#f9f6f0}
.lx-hero{background:linear-gradient(135deg,#0a0a0a 0%,#1a1208 50%,#0f0c05 100%);color:#fff;padding:80px 20px;text-align:center;position:relative;overflow:hidden}
.lx-hero::before{content:'';position:absolute;inset:0;background:url('https://espectaculosluxury.com/wp-content/uploads/2026/03/stripper-en-Madrid-a-domicilio-2-scaled.jpg') center/cover no-repeat;opacity:.18}
.lx-hero__inner{position:relative;z-index:2;max-width:820px;margin:0 auto}
.lx-hero__badge{display:inline-block;background:var(--lux-gold);color:#000!important;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:5px 16px;border-radius:20px;margin-bottom:18px}
.lx-h1{font-size:clamp(28px,5vw,52px);font-weight:800;line-height:1.15;margin:0 0 18px;letter-spacing:-.5px;color:#fff!important}
.lx-h1 span{color:var(--lux-gold)!important}
.lx-hero__sub{font-size:18px;opacity:.85;margin:0 0 32px;max-width:600px;margin-left:auto;margin-right:auto;color:#fff!important}
.lx-cta-wrap{display:flex;gap:14px;justify-content:center;flex-wrap:wrap}
.lx-btn{display:inline-flex;align-items:center;gap:8px;padding:15px 28px;border-radius:50px;font-weight:700;font-size:15px;text-decoration:none!important;transition:.25s}
.lx-btn--gold{background:var(--lux-gold);color:#000!important}
.lx-btn--outline{border:2px solid var(--lux-gold);color:#fff!important;background:transparent}
.lx-btn--gold:hover{background:#e0bf80;transform:translateY(-2px)}
.lx-trust{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;margin-top:36px}
.lx-trust__item{background:rgba(255,255,255,.07);border:1px solid rgba(200,169,110,.25);border-radius:8px;padding:10px 18px;font-size:13px;color:#ddd}
.lx-section{padding:60px 20px;max-width:1100px;margin:0 auto}
.lx-section__title{font-size:clamp(22px,3vw,32px);font-weight:800;text-align:center;margin-bottom:8px;color:var(--lux-dark)}
.lx-section__sub{text-align:center;color:#666;margin-bottom:40px;font-size:15px}
.lx-cards{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:22px}
.lx-card{background:#fff;border-radius:14px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08);transition:.25s}
.lx-card:hover{transform:translateY(-4px);box-shadow:0 8px 30px rgba(0,0,0,.14)}
.lx-card__img{width:100%;aspect-ratio:4/5;object-fit:cover;display:block}
.lx-card__body{padding:16px}
.lx-card__tag{font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--lux-gold);margin-bottom:6px}
.lx-card__title{font-size:16px;font-weight:700;color:var(--lux-dark);margin-bottom:4px}
.lx-card__price{font-size:22px;font-weight:800;color:var(--lux-dark)}
.lx-card__price span{font-size:13px;font-weight:400;color:#999}
.lx-card__btn{display:inline-block;margin-top:12px;padding:10px 20px;background:var(--lux-gold);color:#000!important;border-radius:30px;font-weight:700;font-size:13px;text-decoration:none!important}
/* MUNIC GRID */
.lx-munic-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-top:30px}
.lx-munic-grid br{display:none!important;content:none!important;width:0!important;height:0!important;overflow:hidden!important;position:absolute!important}
.lx-munic-card{background:#fff;border-radius:12px;overflow:hidden!important;box-shadow:0 2px 12px rgba(0,0,0,.07);transition:.2s;text-decoration:none!important;display:flex!important;flex-direction:column;border:1px solid #f0e8d8;position:relative}
.lx-munic-card:hover{transform:translateY(-3px);box-shadow:0 6px 20px rgba(0,0,0,.12);border-color:var(--lux-gold)}
.lx-munic-card__img{width:100%!important;max-width:100%!important;aspect-ratio:1/1;object-fit:cover;object-position:center top;display:block!important;height:auto!important;flex-shrink:0}
.lx-munic-card__body{padding:14px 16px}
.lx-munic-card__title{font-weight:700;color:var(--lux-dark)!important;margin-bottom:4px;font-size:15px}
.lx-munic-card__price{font-size:13px;color:var(--lux-gold);font-weight:600}
.lx-steps{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:24px;max-width:900px;margin:0 auto}
.lx-step__num{width:48px;height:48px;background:var(--lux-gold);color:#000;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:20px;margin:0 auto 12px}
.lx-step__title{font-weight:700;font-size:16px;margin-bottom:8px;color:var(--lux-dark);text-align:center}
.lx-step__desc{font-size:14px;color:#666;text-align:center;line-height:1.6}
.lx-cta-final{background:linear-gradient(135deg,#0a0a0a,#1a1208);padding:80px 20px;text-align:center;color:#fff}
.lx-cta-final h2{font-size:clamp(24px,4vw,38px);font-weight:800;margin-bottom:16px;color:#fff!important}
.lx-cities{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin-top:20px}
.lx-cities a{color:var(--lux-gold)!important;font-size:13px;text-decoration:none!important;border:1px solid rgba(200,169,110,.3);padding:4px 12px;border-radius:20px}
.lx-faq details{border-bottom:1px solid #eee;padding:16px 0}
.lx-faq summary{font-weight:700;cursor:pointer;font-size:16px;color:var(--lux-dark);list-style:none;padding-left:24px;position:relative}
.lx-faq summary::before{content:"▶";position:absolute;left:0;color:var(--lux-gold);font-size:11px;top:4px;transition:.2s}
.lx-faq details[open] summary::before{transform:rotate(90deg)}
.lx-faq details p{padding:12px 0 0 24px;color:#555;line-height:1.8;font-size:15px}
.lx-price-table{width:100%;border-collapse:collapse;margin:30px 0}
.lx-price-table th{background:var(--lux-gold);color:#000;padding:12px 16px;text-align:left;font-size:14px}
.lx-price-table td{padding:12px 16px;border-bottom:1px solid #f0e8d8;font-size:14px;color:#444}
.lx-price-table tr:nth-child(even) td{background:#faf7f2}
@media(max-width:600px){.lx-h1{font-size:28px}.lx-cta-wrap{flex-direction:column;align-items:center}}
@media(min-width:640px){.lx-munic-grid{grid-template-columns:repeat(3,1fr)}}
@media(min-width:900px){.lx-munic-grid{grid-template-columns:repeat(4,1fr)}}
</style>

<!-- HERO -->
<div class="lx-hero">
<div class="lx-hero__inner">
<div class="lx-hero__badge">Madrid · Capital · Shows Premium 2026</div>
<h1 class="lx-h1">Stripper en <span>Madrid</span><br>Shows VIP desde 180€ · Despedidas y Fiestas</h1>
<p class="lx-hero__sub">La agencia líder en Madrid. Malasaña, Salamanca, Chamberí, Chueca, La Latina y toda la Comunidad de Madrid. Respuesta garantizada en menos de 2 horas.</p>
<div class="lx-cta-wrap"><a class="lx-btn lx-btn--gold" href="https://wa.me/34695858978?text=Hola%2C%20quiero%20contratar%20stripper%20en%20Madrid" target="_blank" rel="noopener noreferrer">📱 Reservar por WhatsApp</a><a class="lx-btn lx-btn--outline" href="tel:+34695858978">☎ 695 858 978</a></div>
<div class="lx-trust"><span class="lx-trust__item">⭐ +1.500 Shows en Madrid</span><span class="lx-trust__item">🔒 100% Discreción</span><span class="lx-trust__item">⚡ Respuesta en 2h</span><span class="lx-trust__item">💳 Pago seguro</span></div>
</div>
</div>

<!-- INTRO -->
<div class="lx-section">
<h2 class="lx-section__title">Contratar Stripper en Madrid</h2>
<p class="lx-section__sub">La agencia de referencia para shows de adultos en la capital de España</p>
<div style="max-width:820px;margin:0 auto;line-height:1.85;color:#444;font-size:16px">
<p>En <strong>Espectáculos Luxury</strong> llevamos más de 15 años siendo la agencia más contratada para <strong>shows de striptease en Madrid</strong> y toda la Comunidad de Madrid. Actuamos en pisos de Airbnb, hoteles de cinco estrellas en el Paseo de la Castellana, fincas en la Sierra de Guadarrama, apartamentos en el barrio de Salamanca, locales privados en Malasaña y villas en la zona norte de Madrid. Nuestra agenda cubre los 365 días del año con disponibilidad inmediata.</p>
<p>Nuestras artistas son <strong>profesionales con formación en baile, espectáculo y etiqueta</strong>. Cada show está diseñado a medida para tu celebración: <strong>despedidas de soltera y soltero</strong>, cumpleaños sorpresa, fiestas privadas en chalet, eventos corporativos privados y simplemente una noche especial en la capital. Trabajamos con absoluta discreción: las artistas llegan con ropa de calle y en vehículo propio, sin identificación externa.</p>
</div>
</div>

<!-- CATÁLOGO DE SHOWS -->
<div style="background:var(--lux-light);padding:60px 20px">
<div style="max-width:1100px;margin:0 auto">
<h2 class="lx-section__title">Catálogo de Shows en Madrid</h2>
<p class="lx-section__sub">Elige el show perfecto para tu celebración en la capital</p>
<div class="lx-cards">
<div class="lx-card">
<img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2021/04/contratar-striper-en-Madrid-stripper-a-domicilio-1.webp" alt="Show Integral Stripper Madrid – Despedida Soltera Domicilio 2026" loading="lazy" width="400" height="500">
<div class="lx-card__body">
<div class="lx-card__tag">Más contratado · Madrid</div>
<div class="lx-card__title">Show Integral</div>
<div class="lx-card__price">180&nbsp;€ <span>/ show 45–60 min</span></div>
<a class="lx-card__btn" href="https://wa.me/34695858978?text=Hola%2C%20quiero%20Show%20Integral%20en%20Madrid" rel="nofollow noopener" target="_blank">Reservar</a>
</div>
</div>
<div class="lx-card">
<img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2021/04/contratar-show-lesbico-en-Madrid-para-despedidas-show-stripper-a-domicilio-fiestas-privadas.webp" alt="Show Lésbico Dúo Madrid – Dos Strippers Despedida Soltera 2026" loading="lazy" width="400" height="500">
<div class="lx-card__body">
<div class="lx-card__tag">Show Exclusivo · Dúo</div>
<div class="lx-card__title">Show Lésbico Dúo</div>
<div class="lx-card__price">350&nbsp;€ <span>/ show 60 min</span></div>
<a class="lx-card__btn" href="https://wa.me/34695858978?text=Hola%2C%20quiero%20Show%20L%C3%A9sbico%20D%C3%BAo%20en%20Madrid" rel="nofollow noopener" target="_blank">Reservar</a>
</div>
</div>
<div class="lx-card">
<img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2021/04/contratar-striper-en-madrid-show-con-vibrador.webp" alt="Show Stripper con Juguetes Eróticos Madrid – Fiestas Privadas 2026" loading="lazy" width="400" height="500">
<div class="lx-card__body">
<div class="lx-card__tag">Show Premium · Adultos</div>
<div class="lx-card__title">Show con Juguetes Eróticos</div>
<div class="lx-card__price">280&nbsp;€ <span>/ show 60 min</span></div>
<a class="lx-card__btn" href="https://wa.me/34695858978?text=Hola%2C%20quiero%20Show%20Juguetes%20Madrid" rel="nofollow noopener" target="_blank">Reservar</a>
</div>
</div>
<div class="lx-card">
<img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2021/04/contratar-striper-en-Madrid-stripper-a-domicilio-4.webp" alt="Camarera Sexy Madrid 180€ hora – Fiestas y Eventos 2026" loading="lazy" width="400" height="500">
<div class="lx-card__body">
<div class="lx-card__tag">Camarera · By the Hour</div>
<div class="lx-card__title">Camarera Sexy</div>
<div class="lx-card__price">180&nbsp;€ <span>/ chica / hora</span></div>
<a class="lx-card__btn" href="https://wa.me/34695858978?text=Hola%2C%20quiero%20Camarera%20Sexy%20en%20Madrid" rel="nofollow noopener" target="_blank">Reservar</a>
</div>
</div>
<div class="lx-card">
<img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2021/04/contratar-striper-en-Madrid-stripper-a-domicilio-2.webp" alt="Pack Camarera Sexy más Show Stripper Madrid 300€ 2026" loading="lazy" width="400" height="500">
<div class="lx-card__body">
<div class="lx-card__tag">Pack Combinado · VIP</div>
<div class="lx-card__title">Pack Camarera + Show</div>
<div class="lx-card__price">300&nbsp;€ <span>/ pack ~2h</span></div>
<a class="lx-card__btn" href="https://wa.me/34695858978?text=Hola%2C%20quiero%20Pack%20Camarera%20%2B%20Show%20Madrid" rel="nofollow noopener" target="_blank">Reservar</a>
</div>
</div>
<div class="lx-card">
<img class="lx-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2021/04/contratar-striper-en-Madrid-stripper-a-domicilio-3.webp" alt="Stripper Masculino Madrid – Show Hombre Despedida Soltera 2026" loading="lazy" width="400" height="500">
<div class="lx-card__body">
<div class="lx-card__tag">Stripper Masculino · Boys</div>
<div class="lx-card__title">Stripper Masculino</div>
<div class="lx-card__price">180&nbsp;€ <span>/ show 45–60 min</span></div>
<a class="lx-card__btn" href="https://wa.me/34695858978?text=Hola%2C%20quiero%20Stripper%20Masculino%20en%20Madrid" rel="nofollow noopener" target="_blank">Reservar</a>
</div>
</div>
</div>

<!-- TABLA DE PRECIOS -->
<div style="max-width:700px;margin:50px auto 0">
<h3 style="text-align:center;font-size:20px;font-weight:800;margin-bottom:6px;color:var(--lux-dark)">Tabla de Precios — Shows en Madrid 2026</h3>
<p style="text-align:center;color:#888;font-size:14px;margin-bottom:20px">Precios cerrados, sin sorpresas. IVA incluido.</p>
<table class="lx-price-table">
<thead><tr><th>Tipo de Show</th><th>Duración</th><th>Precio</th></tr></thead>
<tbody>
<tr><td>🔥 Show Integral (más popular)</td><td>45–60 min</td><td><strong>desde 180 €</strong></td></tr>
<tr><td>💃 Show Lésbico Dúo (2 artistas)</td><td>60 min</td><td><strong>desde 350 €</strong></td></tr>
<tr><td>🍆 Show con Juguetes Eróticos</td><td>60 min</td><td><strong>desde 280 €</strong></td></tr>
<tr><td>🍾 Camarera Sexy</td><td>por hora / por chica</td><td><strong>180 €/h</strong></td></tr>
<tr><td>✨ Pack Camarera + Show</td><td>~2 horas</td><td><strong>desde 300 €</strong></td></tr>
<tr><td>👨 Stripper Masculino</td><td>45–60 min</td><td><strong>desde 180 €</strong></td></tr>
</tbody>
</table>
</div>
</div>
</div>

<!-- MUNICIPIOS / ZONAS MADRID -->
<div class="lx-section">
<h2 class="lx-section__title">Zonas y Municipios de Madrid donde actuamos</h2>
<p class="lx-section__sub">Cobertura total: Madrid capital, área metropolitana y Sierra de Guadarrama</p>
<div class="lx-munic-grid"><a class="lx-munic-card" href="https://espectaculosluxury.com/producto/stripper-madrid-capital/"><img class="lx-munic-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2021/04/contratar-striper-en-Madrid-stripper-a-domicilio-5.webp" alt="Stripper Madrid Capital Centro Malasaña Salamanca 2026" loading="lazy" width="300" height="300"><span class="lx-munic-card__body"><span class="lx-munic-card__title">🏙️ Madrid Capital</span><span class="lx-munic-card__price">Desde 180 € · Malasaña · Salamanca · Chueca</span></span></a><a class="lx-munic-card" href="https://espectaculosluxury.com/producto/stripper-pozuelo-aravaca/"><img class="lx-munic-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2021/04/contratar-striper-en-Madrid-stripper-a-domicilio-6.webp" alt="Stripper Pozuelo de Alarcón y Aravaca Madrid 2026" loading="lazy" width="300" height="300"><span class="lx-munic-card__body"><span class="lx-munic-card__title">🏡 Pozuelo de Alarcón</span><span class="lx-munic-card__price">Desde 180 € · Aravaca · Majadahonda</span></span></a><a class="lx-munic-card" href="https://espectaculosluxury.com/producto/stripper-boadilla-las-rozas/"><img class="lx-munic-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2021/04/contratar-striper-en-Madrid-stripper-a-domicilio-7.webp" alt="Stripper Boadilla del Monte Las Rozas Madrid 2026" loading="lazy" width="300" height="300"><span class="lx-munic-card__body"><span class="lx-munic-card__title">🌳 Boadilla · Las Rozas</span><span class="lx-munic-card__price">Desde 180 € · Villaviciosa · Galapagar</span></span></a><a class="lx-munic-card" href="https://espectaculosluxury.com/producto/stripper-alcobendas-san-sebastian-reyes/"><img class="lx-munic-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2021/04/contratar-striper-en-Madrid-stripper-a-domicilio-8.webp" alt="Stripper Alcobendas San Sebastián de los Reyes Madrid 2026" loading="lazy" width="300" height="300"><span class="lx-munic-card__body"><span class="lx-munic-card__title">🏢 Alcobendas · SSReyes</span><span class="lx-munic-card__price">Desde 180 € · Norte de Madrid</span></span></a><a class="lx-munic-card" href="https://espectaculosluxury.com/producto/stripper-leganes-getafe/"><img class="lx-munic-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2021/04/contratar-striper-en-Madrid-stripper-a-domicilio-9.webp" alt="Stripper Leganés Getafe Madrid Sur 2026" loading="lazy" width="300" height="300"><span class="lx-munic-card__body"><span class="lx-munic-card__title">🏭 Leganés · Getafe</span><span class="lx-munic-card__price">Desde 180 € · Sur metropolitano</span></span></a><a class="lx-munic-card" href="https://espectaculosluxury.com/producto/stripper-alcala-de-henares/"><img class="lx-munic-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2021/04/contratar-striper-en-Madrid-stripper-a-domicilio-10.webp" alt="Stripper Alcalá de Henares Madrid Este Corredor del Henares 2026" loading="lazy" width="300" height="300"><span class="lx-munic-card__body"><span class="lx-munic-card__title">🎓 Alcalá de Henares</span><span class="lx-munic-card__price">Desde 180 € · Corredor del Henares</span></span></a><a class="lx-munic-card" href="https://espectaculosluxury.com/producto/stripper-mostoles-fuenlabrada/"><img class="lx-munic-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2021/04/contratar-striper-en-Madrid-stripper-a-domicilio-11.webp" alt="Stripper Móstoles Fuenlabrada Madrid Suroeste 2026" loading="lazy" width="300" height="300"><span class="lx-munic-card__body"><span class="lx-munic-card__title">🏘️ Móstoles · Fuenlabrada</span><span class="lx-munic-card__price">Desde 180 € · Suroeste</span></span></a><a class="lx-munic-card" href="https://espectaculosluxury.com/producto/stripper-sierra-guadarrama/"><img class="lx-munic-card__img" src="https://espectaculosluxury.com/wp-content/uploads/2021/04/contratar-striper-en-Madrid-stripper-a-domicilio-12.webp" alt="Stripper Sierra Guadarrama Navacerrada El Escorial Madrid 2026" loading="lazy" width="300" height="300"><span class="lx-munic-card__body"><span class="lx-munic-card__title">⛰️ Sierra de Guadarrama</span><span class="lx-munic-card__price">Desde 180 € · Navacerrada · El Escorial</span></span></a></div>
<div style="margin-top:30px;padding:20px;background:#f9f6f0;border-radius:12px;line-height:1.8;color:#555;font-size:15px">
<p>Cobertura completa en la Comunidad de Madrid: <strong>Torrejón de Ardoz · Parla · Alcorcón · Collado Villalba · Torrelodones · Aranjuez · Valdemoro · Pinto · Ciempozuelos · Arganda del Rey · Rivas-Vaciamadrid</strong> y todas las localidades de la Sierra. Para municipios fuera del área metropolitana se aplica suplemento de desplazamiento. Consulta disponibilidad para tu localidad.</p>
</div>
</div>

<!-- ZONAS DE OCIO NOCTURNO MADRID -->
<div style="background:var(--lux-light);padding:60px 20px">
<div style="max-width:1100px;margin:0 auto">
<h2 class="lx-section__title">Zonas de ocio nocturno en Madrid</h2>
<p class="lx-section__sub">Los barrios y locales más populares para organizar despedidas y fiestas privadas en Madrid</p>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px;margin-top:30px">
<div style="background:#fff;border-radius:12px;padding:22px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f0e8d8">
<h3 style="font-size:16px;font-weight:700;margin-bottom:8px;color:#111">🎭 Barrio de Malasaña</h3>
<p style="font-size:14px;color:#666;line-height:1.6;margin:0">El corazón alternativo de Madrid, perfecto para despedidas de soltera. Bares de ambiente, restaurantes con salones privados y una vida nocturna intensa entre la Calle Fuencarral y la Plaza del Dos de Mayo. Ideal para combinar pintxos, show privado y fiesta.</p>
</div>
<div style="background:#fff;border-radius:12px;padding:22px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f0e8d8">
<h3 style="font-size:16px;font-weight:700;margin-bottom:8px;color:#111">🌈 Barrio de Chueca</h3>
<p style="font-size:14px;color:#666;line-height:1.6;margin:0">El barrio más vibrante y festivo de Madrid. Calle Pelayo, Plaza de Chueca y la Calle Hortaleza concentran los mejores locales para despedidas inclusivas y fiestas privadas. Ambiente abierto, alegre y sin prejuicios toda la semana.</p>
</div>
<div style="background:#fff;border-radius:12px;padding:22px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f0e8d8">
<h3 style="font-size:16px;font-weight:700;margin-bottom:8px;color:#111">🍷 Barrio de Salamanca</h3>
<p style="font-size:14px;color:#666;line-height:1.6;margin:0">El barrio más exclusivo de Madrid para celebraciones de lujo. Hoteles de 5 estrellas, restaurantes gourmet en Serrano y Velázquez, y locales privados de alta gama. El entorno perfecto para shows VIP en la capital.</p>
</div>
<div style="background:#fff;border-radius:12px;padding:22px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f0e8d8">
<h3 style="font-size:16px;font-weight:700;margin-bottom:8px;color:#111">🎵 <a href="https://www.teatrokapital.com/" target="_blank" rel="nofollow noopener" style="color:#111;text-decoration:none">Teatro Kapital</a></h3>
<p style="font-size:14px;color:#666;line-height:1.6;margin:0">La discoteca más famosa de Madrid en Atocha, con 7 plantas temáticas. Referencia para el after de despedidas y fiestas privadas. Combinada con un show privado de stripper, garantiza una noche inolvidable en la capital.</p>
</div>
<div style="background:#fff;border-radius:12px;padding:22px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f0e8d8">
<h3 style="font-size:16px;font-weight:700;margin-bottom:8px;color:#111">🕺 <a href="https://www.ohmbarcalona.com/" target="_blank" rel="nofollow noopener" style="color:#111;text-decoration:none">Sala Cool</a> · Joy Eslava</h3>
<p style="font-size:14px;color:#666;line-height:1.6;margin:0">Joy Eslava en la Calle Arenal es uno de los clubs más emblemáticos de Madrid. Perfecto para terminar la noche después del show privado con striptease. Ambiente elegante, música comercial y acceso VIP para grupos.</p>
</div>
<div style="background:#fff;border-radius:12px;padding:22px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f0e8d8">
<h3 style="font-size:16px;font-weight:700;margin-bottom:8px;color:#111">🌃 La Latina · Lavapiés</h3>
<p style="font-size:14px;color:#666;line-height:1.6;margin:0">Los barrios más auténticos del centro histórico de Madrid. Terrazas de verano, bares de vinos y tabernas con salones privados para grupos. Imprescindible para las despedidas que quieren combinar cultura, gastronomía y show privado.</p>
</div>
</div>
<p style="font-size:14px;color:#888;margin-top:20px">Información de referencia: <a href="https://www.esmadrid.com/" target="_blank" rel="nofollow noopener" style="color:var(--lux-gold)">esMadrid Turismo</a> · <a href="https://www.tripadvisor.es/Attractions-g187514-Activities-c20-Madrid.html" target="_blank" rel="nofollow noopener" style="color:var(--lux-gold)">Vida nocturna en TripAdvisor</a> · <a href="https://www.madrid.es/portales/munimadrid/es/inicio/turismo-y-ocio/" target="_blank" rel="nofollow noopener" style="color:var(--lux-gold)">Turismo Madrid Ayuntamiento</a></p>
</div>
</div>

<!-- PASOS -->
<div style="background:#f9f6f0;padding:60px 20px">
<div style="max-width:900px;margin:0 auto">
<h2 class="lx-section__title">Cómo reservar tu stripper en Madrid</h2>
<p class="lx-section__sub">4 pasos sencillos · Respuesta garantizada en menos de 2 horas</p>
<div class="lx-steps">
<div class="lx-step"><div class="lx-step__num">1</div><div class="lx-step__title">Contáctanos</div><div class="lx-step__desc">Escríbenos por WhatsApp con fecha, hora, lugar y tipo de show. Atendemos 365 días, de 09:00 a 02:00.</div></div>
<div class="lx-step"><div class="lx-step__num">2</div><div class="lx-step__title">Personalizamos</div><div class="lx-step__desc">Elegís show, vestuario temático (policía, enfermera, azafata…) y detalles especiales para Madrid.</div></div>
<div class="lx-step"><div class="lx-step__num">3</div><div class="lx-step__title">Confirmamos</div><div class="lx-step__desc">Precio cerrado. Pago por Bizum, PayPal o transferencia. Sin sorpresas ni costes ocultos.</div></div>
<div class="lx-step"><div class="lx-step__num">4</div><div class="lx-step__title">¡Disfrutad!</div><div class="lx-step__desc">La artista llega puntual y discreta a cualquier punto de Madrid o la Comunidad.</div></div>
</div>
</div>
</div>

<!-- CLUSTER LINKS -->
<div class="lx-section">
<h2 class="lx-section__title">Páginas especializadas para Madrid</h2>
<p class="lx-section__sub">Busca el tipo de celebración que estás organizando en Madrid</p>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:14px;max-width:900px;margin:0 auto">
<a href="https://espectaculosluxury.com/stripper-despedidas-madrid/" style="display:block;padding:18px;background:#fff;border:1px solid #e8e0d0;border-radius:10px;text-decoration:none!important;transition:.2s;font-weight:600;color:#111!important">💍 Despedida de Soltera Madrid</a>
<a href="https://espectaculosluxury.com/stripper-cumpleanos-madrid/" style="display:block;padding:18px;background:#fff;border:1px solid #e8e0d0;border-radius:10px;text-decoration:none!important;transition:.2s;font-weight:600;color:#111!important">🎂 Cumpleaños en Madrid</a>
<a href="https://espectaculosluxury.com/stripper-a-domicilio-madrid/" style="display:block;padding:18px;background:#fff;border:1px solid #e8e0d0;border-radius:10px;text-decoration:none!important;transition:.2s;font-weight:600;color:#111!important">🏠 Stripper a Domicilio Madrid</a>
<a href="https://espectaculosluxury.com/stripper-fiestas-privadas-madrid/" style="display:block;padding:18px;background:#fff;border:1px solid #e8e0d0;border-radius:10px;text-decoration:none!important;transition:.2s;font-weight:600;color:#111!important">🎉 Fiestas Privadas Madrid</a>
</div>
</div>

<!-- FAQ -->
<div class="lx-section">
<h2 class="lx-section__title">Preguntas frecuentes sobre strippers en Madrid</h2>
<p class="lx-section__sub">Todo lo que necesitas saber antes de contratar</p>
<div class="lx-faq">
<details><summary>¿Cuánto cuesta contratar un stripper en Madrid en 2026?</summary><p>Los shows en Madrid parten desde <strong>180 €</strong> para el Show Integral (45–60 minutos). El Show Lésbico Dúo con dos artistas cuesta desde 350 €, el Show con Juguetes Eróticos desde 280 €, la Camarera Sexy 180 €/hora por chica, el Pack Camarera+Show desde 300 € y el Stripper Masculino desde 180 €. Para municipios fuera de la M-30 puede aplicarse un suplemento de desplazamiento de 20–40 €.</p></details>
<details><summary>¿En qué zonas de Madrid ofrecéis el servicio?</summary><p>Cubrimos <strong>toda la Comunidad de Madrid</strong>: Madrid capital (Malasaña, Chueca, Salamanca, Chamberí, La Latina, Lavapiés, Vallecas, Carabanchel…), zona norte (Alcobendas, San Sebastián de los Reyes, Sanchinarro, Las Tablas), zona oeste (Pozuelo de Alarcón, Majadahonda, Boadilla del Monte, Las Rozas), zona sur (Leganés, Getafe, Parla, Alcorcón, Fuenlabrada, Móstoles), zona este (Alcalá de Henares, Torrejón, Arganda) y toda la Sierra de Guadarrama (Navacerrada, El Escorial, Collado Villalba).</p></details>
<details><summary>¿Cómo se organiza una despedida de soltera con stripper en Madrid?</summary><p>Lo más habitual es reservar un <strong>apartamento o piso en Airbnb en Malasaña o Chueca</strong>, preparar una cena o aperitivo entre el grupo, y que la artista llegue sobre las 22:00-23:00. El show dura 45-60 minutos y después continuáis la noche en los bares del barrio o en un club. También organizamos shows en suites de hotel (NH, Meliá, Hilton, Marriott), fincas en la Sierra o villas con piscina en Pozuelo y Las Rozas. Os asesoramos en todo el proceso.</p></details>
<details><summary>¿Cuánta antelación necesito para reservar?</summary><p>Recomendamos reservar con <strong>48–72 horas de antelación</strong>, especialmente viernes y sábados de mayo a septiembre. Para fechas señaladas (Nochevieja, San Valentín, Semana Santa, puentes de mayo) lo ideal es reservar con 2 semanas. Sin embargo, solemos tener disponibilidad de última hora — contáctanos directamente por WhatsApp e intentamos cubrirte.</p></details>
<details><summary>¿Actuáis en hoteles de Madrid? ¿Cuáles?</summary><p>Sí, trabajamos con <strong>todos los hoteles de Madrid</strong> con previo acuerdo con el cliente. Nuestros artistas conocen los protocolos de acceso y discreción necesarios para actuar en establecimientos como el Meliá Castilla, NH Collection, Vincci, Room Mate, Marriott, Hilton y hoteles boutique del centro histórico. Simplemente necesitamos que el huésped gestione el acceso con la recepción.</p></details>
<details><summary>¿Podéis hacer shows en fincas o villas con piscina cerca de Madrid?</summary><p>Absolutamente. Tenemos amplia experiencia en <strong>shows en fincas, villas y chalets</strong> en zonas como Pozuelo de Alarcón, Las Rozas, Galapagar, Collado Villalba, Alpedrete, Moralzarzal, El Escorial y toda la Sierra de Guadarrama. Para eventos de grupo grande (despedidas de verano, cumpleaños con piscina) el show al aire libre tiene un impacto espectacular. Consultad opciones y podemos personalizar el set-up.</p></details>
<details><summary>¿Los shows son 100% privados y discretos?</summary><p>La <strong>discreción total es nuestra prioridad absoluta</strong>. Las artistas llegan con ropa de calle, sin identificación externa y en vehículo propio. Nunca revelamos información sobre clientes, localizaciones ni tipos de eventos. Firmamos acuerdo de confidencialidad bajo petición. Todos los pagos son seguros y se realizan a través de canales normales (Bizum, PayPal, transferencia) sin descriptivos comprometedores.</p></details>
<details><summary>¿Qué ocurre si necesito cancelar mi reserva?</summary><p>Entendemos que los planes cambian, especialmente en Madrid con la agenda tan apretada que hay. Cancelaciones con <strong>más de 72 horas de antelación</strong>: sin coste. Entre 24–72h: 50% del importe. Menos de 24h o no-show: 100%. Los cambios de fecha se gestionan sin coste adicional con suficiente antelación, sujetos a disponibilidad del artista.</p></details>
</div>
</div>

<!-- CTA FINAL -->
<div class="lx-cta-final">
<h2>¿Lista para reservar tu show en Madrid?</h2>
<p style="font-size:17px;opacity:.85;margin-bottom:32px;color:#fff">Contacta ahora. Respuesta en menos de 2 horas. Precios cerrados, sin sorpresas.</p>
<div class="lx-cta-wrap"><a class="lx-btn lx-btn--gold" href="https://wa.me/34695858978?text=Hola%2C%20quiero%20contratar%20stripper%20en%20Madrid" target="_blank" rel="noopener noreferrer">📱 Reservar por WhatsApp</a><a class="lx-btn lx-btn--outline" href="tel:+34695858978">☎ 695 858 978</a></div>
<div class="lx-cities" style="margin-top:30px">
<a href="https://espectaculosluxury.com/producto/stripper-madrid-capital/">Madrid Capital</a>
<a href="https://espectaculosluxury.com/producto/stripper-pozuelo-aravaca/">Pozuelo · Majadahonda</a>
<a href="https://espectaculosluxury.com/producto/stripper-alcobendas-san-sebastian-reyes/">Alcobendas · SSReyes</a>
<a href="https://espectaculosluxury.com/producto/stripper-leganes-getafe/">Leganés · Getafe</a>
<a href="https://espectaculosluxury.com/producto/stripper-alcala-de-henares/">Alcalá de Henares</a>
<a href="https://espectaculosluxury.com/producto/stripper-mostoles-fuenlabrada/">Móstoles · Fuenlabrada</a>
<a href="https://espectaculosluxury.com/producto/stripper-boadilla-las-rozas/">Boadilla · Las Rozas</a>
<a href="https://espectaculosluxury.com/producto/stripper-sierra-guadarrama/">Sierra de Guadarrama</a>
</div>
</div>

<!-- JSON-LD -->
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"LocalBusiness","name":"Espectáculos Luxury – Stripper Madrid","url":"https://espectaculosluxury.com/stripper-madrid/","telephone":"+34695858978","priceRange":"€€","description":"Agencia líder de strippers en Madrid. Shows para despedidas de soltera, cumpleaños y fiestas privadas desde 180€. Cobertura en toda la Comunidad de Madrid.","address":{"@type":"PostalAddress","addressLocality":"Madrid","addressRegion":"Comunidad de Madrid","addressCountry":"ES"},"geo":{"@type":"GeoCoordinates","latitude":"40.4168","longitude":"-3.7038"},"openingHours":"Mo-Su 09:00-02:00","aggregateRating":{"@type":"AggregateRating","ratingValue":"4.9","reviewCount":"487","bestRating":"5"},"hasOfferCatalog":{"@type":"OfferCatalog","name":"Shows Stripper Madrid","itemListElement":[{"@type":"Offer","name":"Show Integral","price":"180","priceCurrency":"EUR"},{"@type":"Offer","name":"Show Lésbico Dúo","price":"350","priceCurrency":"EUR"},{"@type":"Offer","name":"Camarera Sexy","price":"180","priceCurrency":"EUR"},{"@type":"Offer","name":"Pack Camarera + Show","price":"300","priceCurrency":"EUR"}]}}
</script>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"¿Cuánto cuesta contratar un stripper en Madrid en 2026?","acceptedAnswer":{"@type":"Answer","text":"Los shows en Madrid parten desde 180€ para el Show Integral. Show Lésbico Dúo desde 350€, Show con Juguetes Eróticos desde 280€, Camarera Sexy 180€/hora, Pack Camarera+Show desde 300€ y Stripper Masculino desde 180€."}},{"@type":"Question","name":"¿En qué zonas de Madrid ofrecéis el servicio?","acceptedAnswer":{"@type":"Answer","text":"Cubrimos toda la Comunidad de Madrid: Madrid capital, Pozuelo, Majadahonda, Alcobendas, San Sebastián de los Reyes, Leganés, Getafe, Alcalá de Henares, Móstoles, Fuenlabrada y Sierra de Guadarrama."}},{"@type":"Question","name":"¿Los shows son discretos y privados?","acceptedAnswer":{"@type":"Answer","text":"Sí. Las artistas llegan con ropa de calle, sin identificación externa. Nunca revelamos información de clientes ni localizaciones. Firmamos acuerdo de confidencialidad bajo petición."}}]}
</script>
</div>
HTMLEOF

echo strlen($html);
file_put_contents('/tmp/madrid_landing_v1.html', $html);
echo "\nFile written: " . file_exists('/tmp/madrid_landing_v1.html') . "\n";
