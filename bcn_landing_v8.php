<?php
/**
 * BCN Landing V8 — Diseño profesional experto
 * Correcciones: hero full-bleed saliendo del contenedor, sistema de espaciado generoso,
 * tipografía jerarquizada, botones con padding real, secciones bien diferenciadas.
 */
require('/var/www/vhosts/espectaculosluxury.com/httpdocs/wp-load.php');

kses_remove_filters();
remove_filter('content_save_pre',          'wp_filter_post_kses');
remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');
remove_filter('the_content', 'wptexturize');
remove_filter('the_content', 'wpautop');
remove_filter('the_title',   'wptexturize');

update_post_meta(67406, '_ez-toc-disabled', 1);
update_post_meta(67406, '_ez-toc-disabled-custom-toc', 1);

$html = <<<'HTML'
<div id="lx8">
<style>

/* ─────────────────────────────────────────────────────
   1. OVERRIDE COMPLETO DEL TEMA JASMIN / CLAUE
───────────────────────────────────────────────────── */
/* Ocultar header duplicado del tema */
.page-head { display: none !important; }

/* Eliminar márgenes del wrapper del tema */
.jas-col-md-12.mt__60,
.jas-col-md-12.mb__60,
.jas-col-md-12.mt__60.mb__60 {
  margin-top:    0 !important;
  margin-bottom: 0 !important;
  padding-top:   0 !important;
  padding-bottom:0 !important;
}

/* El jas-container limita el ancho — nuestro div lo rompe */
.jas-container { overflow: visible !important; }

/* Ocultar TOC del plugin */
.ez-toc-container, #ez-toc-container,
.eztoc-sticky-container, div[id^="ez-toc"] {
  display: none !important;
}

/* ─────────────────────────────────────────────────────
   2. TOKENS DE DISEÑO (sin variables CSS para evitar
      corrupción de WordPress con "--")
───────────────────────────────────────────────────── */
/*
  Gold:      #C8A96E  /  #E0BC6A  (gradient)
  Dark:      #0A0A0A
  Dark2:     #111111
  Surface:   #141414
  Pearl:     #F8F5F0
  White:     #FFFFFF
  Text:      #1A1A1A
  TextMid:   #555555
  TextLight: #888888
*/

/* ─────────────────────────────────────────────────────
   3. RESET DENTRO DE #lx8
───────────────────────────────────────────────────── */
#lx8 {
  font-family: "Inter", "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 16px;
  line-height: 1.65;
  color: #1a1a1a;
  background: #ffffff;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
#lx8 *, #lx8 *::before, #lx8 *::after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
#lx8 a       { text-decoration: none; color: inherit; }
#lx8 img     { display: block; max-width: 100%; height: auto; }
#lx8 strong  { font-weight: 700; }
#lx8 ul      { list-style: none; }

/* ─────────────────────────────────────────────────────
   4. HERO — Full-bleed saliendo del contenedor Jasmin
   Técnica: negative margin + width calc para romper
   el jas-container de max-width 1170px
───────────────────────────────────────────────────── */
.lx8-hero-wrapper {
  /* Breakout del contenedor del tema */
  margin-left:  calc(-50vw + 50%);
  margin-right: calc(-50vw + 50%);
  width: 100vw;
  position: relative;
  overflow: hidden;
}

.lx8-hero {
  position: relative;
  min-height: 720px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #0a0a0a;
}

/* Imagen de fondo */
.lx8-hero-bg {
  position: absolute;
  inset: 0;
  background-image: url("https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-01.jpg");
  background-size: cover;
  background-position: center 20%;
  opacity: 0.30;
  transition: opacity 0.6s ease;
}

/* Gradiente oscurecedor multistop */
.lx8-hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    180deg,
    rgba(10,8,4,0.45) 0%,
    rgba(10,8,4,0.65) 40%,
    rgba(10,8,4,0.80) 70%,
    rgba(10,8,4,0.92) 100%
  );
}

/* Halo dorado sutil */
.lx8-hero-glow {
  position: absolute;
  top: -80px;
  left: 50%;
  transform: translateX(-50%);
  width: 900px;
  height: 500px;
  background: radial-gradient(
    ellipse at 50% 30%,
    rgba(200,169,110,0.12) 0%,
    transparent 65%
  );
  pointer-events: none;
}

/* Contenido del hero */
.lx8-hero-inner {
  position: relative;
  z-index: 2;
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
  padding: 120px 40px 110px;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0;
}

/* Badge animado */
.lx8-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 10px 28px;
  border: 1px solid rgba(200,169,110,0.40);
  border-radius: 100px;
  background: rgba(200,169,110,0.08);
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: #c8a96e;
  margin-bottom: 40px;
}
.lx8-badge-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #c8a96e;
  animation: lx8pulse 2.4s ease-in-out infinite;
  flex-shrink: 0;
}
@keyframes lx8pulse {
  0%, 100% { opacity: 1; transform: scale(1); }
  50%       { opacity: 0.25; transform: scale(0.6); }
}

/* Título principal */
.lx8-h1 {
  font-size: clamp(2.4rem, 5.5vw, 3.8rem);
  font-weight: 900;
  line-height: 1.08;
  letter-spacing: -0.035em;
  color: #ffffff;
  margin-bottom: 24px;
}
.lx8-h1 em {
  font-style: normal;
  color: #c8a96e;
}

/* Línea dorada decorativa */
.lx8-rule {
  width: 56px;
  height: 2px;
  background: linear-gradient(90deg, #c8a96e, #e0bc6a);
  border-radius: 2px;
  margin-bottom: 28px;
  flex-shrink: 0;
}

/* Subtítulo hero */
.lx8-hero-sub {
  font-size: 1.1rem;
  font-weight: 400;
  color: rgba(255,255,255,0.70);
  line-height: 1.80;
  max-width: 540px;
  margin-bottom: 52px;
}

/* Bloque de botones CTA */
.lx8-btns {
  display: flex;
  flex-wrap: wrap;
  gap: 18px;
  justify-content: center;
  margin-bottom: 56px;
}

/* Botón base */
.lx8-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  border-radius: 50px;
  font-weight: 700;
  letter-spacing: 0.01em;
  line-height: 1;
  text-decoration: none;
  transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
  border: none;
  cursor: pointer;
  white-space: nowrap;
  /* Padding generoso: vertical 20px · horizontal 44px */
  padding: 20px 44px;
  font-size: 1rem;
}

/* Botón dorado principal */
.lx8-btn-gold {
  background: linear-gradient(135deg, #c8a96e 0%, #e0bc6a 55%, #c8a96e 100%);
  background-size: 200% auto;
  color: #111111;
  box-shadow: 0 8px 32px rgba(200,169,110,0.40),
              0 2px 8px rgba(0,0,0,0.30);
}
.lx8-btn-gold:hover {
  background-position: right center;
  transform: translateY(-4px) scale(1.02);
  box-shadow: 0 20px 50px rgba(200,169,110,0.55),
              0 4px 16px rgba(0,0,0,0.30);
  color: #111111;
}

/* Botón contorno */
.lx8-btn-outline {
  background: transparent;
  color: rgba(255,255,255,0.85);
  border: 1.5px solid rgba(255,255,255,0.28);
}
.lx8-btn-outline:hover {
  border-color: #c8a96e;
  color: #c8a96e;
  background: rgba(200,169,110,0.07);
  transform: translateY(-3px);
}

/* Trust bar */
.lx8-trust {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 12px;
}
.lx8-trust-item {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 9px 20px;
  border-radius: 100px;
  border: 1px solid rgba(255,255,255,0.12);
  background: rgba(255,255,255,0.055);
  font-size: 0.78rem;
  font-weight: 500;
  color: rgba(255,255,255,0.68);
  letter-spacing: 0.01em;
}

/* ─────────────────────────────────────────────────────
   5. DIVISOR DORADO
───────────────────────────────────────────────────── */
.lx8-divider {
  display: block;
  height: 1px;
  background: linear-gradient(
    90deg,
    transparent 0%,
    rgba(200,169,110,0.45) 25%,
    rgba(224,188,106,0.70) 50%,
    rgba(200,169,110,0.45) 75%,
    transparent 100%
  );
  border: none;
  margin: 0;
}

/* ─────────────────────────────────────────────────────
   6. SISTEMA DE SECCIONES
───────────────────────────────────────────────────── */
/* Fondos */
.lx8-bg-white  { background: #ffffff; }
.lx8-bg-pearl  { background: #f8f5f0; }
.lx8-bg-dark   { background: #0e0e0e; }
.lx8-bg-finish {
  background: linear-gradient(155deg, #0c0c0c 0%, #16100000 50%, #0c0c0c 100%);
}

/* Sección + wrapper interior */
.lx8-section {
  padding: 100px 24px;
}
.lx8-section-sm {
  padding: 80px 24px;
}
.lx8-wrap {
  max-width: 1160px;
  margin: 0 auto;
}
.lx8-wrap-narrow {
  max-width: 800px;
  margin: 0 auto;
}

/* ─────────────────────────────────────────────────────
   7. CABECERA DE SECCIÓN
───────────────────────────────────────────────────── */
.lx8-sec-head {
  text-align: center;
  margin-bottom: 64px;
}
.lx8-sec-head-left {
  text-align: left;
  margin-bottom: 56px;
}

/* Eyebrow */
.lx8-eyebrow {
  display: inline-block;
  font-size: 0.70rem;
  font-weight: 700;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: #c8a96e;
  margin-bottom: 14px;
}

/* Título sección */
.lx8-title {
  font-size: clamp(1.65rem, 3.4vw, 2.4rem);
  font-weight: 800;
  letter-spacing: -0.03em;
  line-height: 1.16;
  color: #111111;
  margin-bottom: 14px;
}
.lx8-bg-dark .lx8-title,
.lx8-bg-finish .lx8-title { color: #ffffff; }

/* Subtítulo sección */
.lx8-subtitle {
  font-size: 1.02rem;
  color: #777777;
  line-height: 1.70;
  max-width: 580px;
  margin: 18px auto 0;
}
.lx8-bg-dark .lx8-subtitle,
.lx8-bg-finish .lx8-subtitle { color: rgba(255,255,255,0.50); }
.lx8-sec-head-left .lx8-subtitle {
  margin-left: 0;
  margin-right: auto;
}

/* Barra dorada decorativa */
.lx8-goldbar {
  display: block;
  width: 48px;
  height: 3px;
  background: linear-gradient(90deg, #c8a96e, #e0bc6a);
  border-radius: 3px;
  margin: 18px auto 0;
}
.lx8-sec-head-left .lx8-goldbar { margin-left: 0; }

/* ─────────────────────────────────────────────────────
   8. TEXTO SEO (PROSE)
───────────────────────────────────────────────────── */
.lx8-prose {
  max-width: 800px;
  margin: 0 auto;
}
.lx8-prose p {
  font-size: 1.02rem;
  color: #555555;
  line-height: 1.90;
  margin-bottom: 24px;
}
.lx8-prose p:last-child { margin-bottom: 0; }
.lx8-prose strong { color: #111111; }

/* ─────────────────────────────────────────────────────
   9. TARJETAS DE SHOW
───────────────────────────────────────────────────── */
.lx8-grid-3 {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
}
.lx8-grid-4 {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 28px;
}

.lx8-card {
  background: #ffffff;
  border-radius: 20px;
  overflow: hidden;
  border: 1px solid rgba(200,169,110,0.14);
  box-shadow: 0 4px 24px rgba(0,0,0,0.08);
  transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1),
              box-shadow 0.28s ease;
  display: flex;
  flex-direction: column;
}
.lx8-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 24px 56px rgba(0,0,0,0.15),
              0 0 0 1px rgba(200,169,110,0.20);
}

.lx8-card-img {
  width: 100%;
  height: 240px;
  object-fit: cover;
  object-position: top center;
}

.lx8-card-body {
  padding: 28px 28px 30px;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.lx8-card-tag {
  font-size: 0.68rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.10em;
  color: #c8a96e;
  margin-bottom: 10px;
}
.lx8-card-title {
  font-size: 1.12rem;
  font-weight: 800;
  color: #111111;
  line-height: 1.28;
  margin-bottom: 12px;
}
.lx8-card-desc {
  font-size: 0.90rem;
  color: #666666;
  line-height: 1.65;
  flex: 1;
  margin-bottom: 18px;
}
.lx8-card-price {
  font-size: 1.25rem;
  font-weight: 800;
  color: #c8a96e;
  margin-bottom: 18px;
  letter-spacing: -0.01em;
}
.lx8-card-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 13px 24px;
  border-radius: 50px;
  background: linear-gradient(135deg, #c8a96e, #e0bc6a);
  color: #111111;
  font-size: 0.86rem;
  font-weight: 700;
  text-decoration: none;
  align-self: flex-start;
  transition: opacity 0.22s, transform 0.22s;
  box-shadow: 0 4px 16px rgba(200,169,110,0.28);
}
.lx8-card-btn:hover {
  opacity: 0.88;
  transform: translateY(-2px);
  color: #111111;
}

/* ─────────────────────────────────────────────────────
   10. GRID MUNICIPIOS
───────────────────────────────────────────────────── */
.lx8-muni-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(175px, 1fr));
  gap: 16px;
}
.lx8-muni {
  background: rgba(255,255,255,0.055);
  border: 1px solid rgba(200,169,110,0.24);
  border-radius: 14px;
  padding: 22px 16px;
  text-align: center;
  text-decoration: none;
  color: #ffffff;
  transition: all 0.24s ease;
}
.lx8-muni:hover {
  background: #c8a96e;
  border-color: #c8a96e;
  color: #111111;
  transform: translateY(-4px);
  box-shadow: 0 12px 32px rgba(200,169,110,0.28);
}
.lx8-muni-icon { font-size: 1.7rem; margin-bottom: 10px; }
.lx8-muni-name { font-size: 0.90rem; font-weight: 700; line-height: 1.2; }
.lx8-muni-dist { font-size: 0.73rem; color: rgba(255,255,255,0.46); margin-top: 6px; }
.lx8-muni:hover .lx8-muni-dist { color: rgba(0,0,0,0.52); }

/* ─────────────────────────────────────────────────────
   11. CHECKLIST
───────────────────────────────────────────────────── */
.lx8-checklist {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
  gap: 14px 36px;
  list-style: none;
}
.lx8-checklist li {
  position: relative;
  padding: 14px 14px 14px 46px;
  font-size: 0.96rem;
  color: #444444;
  line-height: 1.55;
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid rgba(200,169,110,0.14);
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.lx8-checklist li::before {
  content: "✓";
  position: absolute;
  left: 16px;
  top: 15px;
  color: #c8a96e;
  font-weight: 900;
  font-size: 0.92rem;
}

/* Lista plain (sin card) */
.lx8-list-plain {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 12px 36px;
  list-style: none;
}
.lx8-list-plain li {
  position: relative;
  padding: 10px 10px 10px 32px;
  font-size: 0.96rem;
  color: #444444;
  line-height: 1.55;
}
.lx8-list-plain li::before {
  content: "✓";
  position: absolute;
  left: 6px;
  top: 11px;
  color: #c8a96e;
  font-weight: 900;
  font-size: 0.92rem;
}

/* ─────────────────────────────────────────────────────
   12. TABLA DE LOCALES
───────────────────────────────────────────────────── */
.lx8-tbl-wrap {
  overflow-x: auto;
  border-radius: 16px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.10);
  margin-top: 40px;
}
.lx8-tbl {
  width: 100%;
  border-collapse: collapse;
  min-width: 420px;
}
.lx8-tbl thead tr {
  background: linear-gradient(135deg, #1a1a1a, #2a1900);
}
.lx8-tbl th {
  color: #c8a96e;
  padding: 18px 26px;
  text-align: left;
  font-size: 0.76rem;
  letter-spacing: 0.10em;
  text-transform: uppercase;
  font-weight: 700;
  white-space: nowrap;
}
.lx8-tbl tbody tr:nth-child(odd)  { background: #ffffff; }
.lx8-tbl tbody tr:nth-child(even) { background: #fdf9f2; }
.lx8-tbl td {
  padding: 16px 26px;
  border-bottom: 1px solid rgba(200,169,110,0.10);
  font-size: 0.93rem;
  color: #333333;
  vertical-align: middle;
}
.lx8-tbl tbody tr:last-child td { border-bottom: none; }
.lx8-tbl tbody tr:hover td { background: rgba(200,169,110,0.06); }
.lx8-chip {
  display: inline-flex;
  align-items: center;
  padding: 4px 14px;
  border-radius: 100px;
  background: rgba(200,169,110,0.10);
  color: #7a5c20;
  font-size: 0.78rem;
  font-weight: 600;
  white-space: nowrap;
}

/* ─────────────────────────────────────────────────────
   13. PASOS
───────────────────────────────────────────────────── */
.lx8-steps {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 28px;
  position: relative;
}
/* Línea conectora (solo desktop) */
.lx8-steps::before {
  content: "";
  position: absolute;
  top: 56px;
  left: calc(12.5% + 28px);
  right: calc(12.5% + 28px);
  height: 2px;
  background: linear-gradient(90deg, #c8a96e, #e0bc6a, #c8a96e);
  opacity: 0.30;
  pointer-events: none;
}
.lx8-step {
  background: #ffffff;
  border-radius: 20px;
  padding: 40px 28px 36px;
  text-align: center;
  border: 1px solid rgba(200,169,110,0.18);
  box-shadow: 0 4px 20px rgba(0,0,0,0.06);
  transition: transform 0.26s ease, box-shadow 0.26s ease;
  position: relative;
  z-index: 1;
}
.lx8-step:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 48px rgba(0,0,0,0.12);
}
.lx8-step-num {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: linear-gradient(135deg, #c8a96e, #e0bc6a);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 900;
  font-size: 1.2rem;
  color: #111111;
  margin: 0 auto 22px;
  box-shadow: 0 6px 24px rgba(200,169,110,0.38);
}
.lx8-step-title {
  font-size: 1.05rem;
  font-weight: 800;
  color: #111111;
  margin-bottom: 12px;
}
.lx8-step-desc {
  font-size: 0.90rem;
  color: #777777;
  line-height: 1.65;
}

/* ─────────────────────────────────────────────────────
   14. TABLA DE PRECIOS
───────────────────────────────────────────────────── */
.lx8-price-wrap {
  overflow-x: auto;
  border-radius: 20px;
  box-shadow: 0 16px 60px rgba(0,0,0,0.40);
  margin-top: 12px;
}
.lx8-price-tbl {
  width: 100%;
  border-collapse: collapse;
  min-width: 600px;
}
.lx8-price-tbl thead tr {
  background: linear-gradient(135deg, #c8a96e 0%, #e0bc6a 100%);
}
.lx8-price-tbl th {
  color: #111111;
  padding: 20px 28px;
  text-align: left;
  font-size: 0.78rem;
  letter-spacing: 0.09em;
  text-transform: uppercase;
  font-weight: 800;
  white-space: nowrap;
}
.lx8-price-tbl th:not(:first-child) { text-align: center; }
.lx8-price-tbl tbody tr { background: rgba(255,255,255,0.04); }
.lx8-price-tbl tbody tr:nth-child(even) { background: rgba(255,255,255,0.08); }
.lx8-price-tbl td {
  padding: 18px 28px;
  border-bottom: 1px solid rgba(255,255,255,0.07);
  font-size: 0.95rem;
  color: rgba(255,255,255,0.85);
  vertical-align: middle;
}
.lx8-price-tbl tbody tr:last-child td { border-bottom: none; }
.lx8-price-tbl td:not(:first-child) { text-align: center; }
.lx8-price-tbl tbody tr:hover td { background: rgba(200,169,110,0.08); }
.lx8-price-hl {
  font-weight: 800;
  color: #e0bc6a;
  font-size: 1.08rem;
  white-space: nowrap;
}
.lx8-price-note {
  font-size: 0.80rem;
  color: rgba(255,255,255,0.36);
  font-style: italic;
  text-align: center;
  margin-top: 22px;
  line-height: 1.6;
}

/* ─────────────────────────────────────────────────────
   15. TESTIMONIOS
───────────────────────────────────────────────────── */
.lx8-reviews {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 28px;
}
.lx8-review {
  background: #ffffff;
  border-radius: 20px;
  padding: 36px 32px;
  border-left: 4px solid #c8a96e;
  box-shadow: 0 4px 24px rgba(0,0,0,0.08);
  transition: transform 0.24s ease;
}
.lx8-review:hover {
  transform: translateY(-5px);
}
.lx8-review-stars {
  font-size: 1.1rem;
  letter-spacing: 3px;
  margin-bottom: 18px;
  color: #c8a96e;
  display: block;
}
.lx8-review blockquote {
  font-size: 0.93rem;
  color: #555555;
  line-height: 1.80;
  font-style: italic;
  margin-bottom: 20px;
  quotes: none;
}
.lx8-review cite {
  font-size: 0.82rem;
  color: #c8a96e;
  font-weight: 700;
  font-style: normal;
  display: block;
}

/* ─────────────────────────────────────────────────────
   16. FAQ ACORDEÓN
───────────────────────────────────────────────────── */
.lx8-faq {
  display: flex;
  flex-direction: column;
  gap: 12px;
  margin-top: 8px;
}
.lx8-faq details {
  border: 1px solid rgba(200,169,110,0.22);
  border-radius: 14px;
  background: #ffffff;
  overflow: hidden;
  transition: box-shadow 0.22s ease;
}
.lx8-faq details[open] {
  border-color: #c8a96e;
  box-shadow: 0 6px 28px rgba(200,169,110,0.12);
}
.lx8-faq summary {
  padding: 22px 28px;
  cursor: pointer;
  font-weight: 700;
  font-size: 0.97rem;
  color: #111111;
  list-style: none;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 20px;
  user-select: none;
  line-height: 1.4;
}
.lx8-faq summary::-webkit-details-marker { display: none; }
.lx8-faq summary::after {
  content: "+";
  font-size: 1.6rem;
  font-weight: 300;
  color: #c8a96e;
  flex-shrink: 0;
  transition: transform 0.24s ease;
  line-height: 1;
  min-width: 24px;
  text-align: center;
}
.lx8-faq details[open] summary {
  border-bottom: 1px solid rgba(200,169,110,0.14);
}
.lx8-faq details[open] summary::after { transform: rotate(45deg); }
.lx8-faq details p {
  padding: 20px 28px 26px;
  font-size: 0.93rem;
  color: #555555;
  line-height: 1.80;
}

/* ─────────────────────────────────────────────────────
   17. CTA FINAL
───────────────────────────────────────────────────── */
.lx8-cta-wrap {
  max-width: 720px;
  margin: 0 auto;
  padding: 110px 32px 120px;
  text-align: center;
}
.lx8-cta-wrap h2 {
  font-size: clamp(1.9rem, 4.0vw, 2.8rem);
  font-weight: 900;
  letter-spacing: -0.03em;
  color: #ffffff;
  margin-bottom: 18px;
  line-height: 1.14;
}
.lx8-cta-wrap p {
  font-size: 1.05rem;
  color: rgba(255,255,255,0.58);
  line-height: 1.70;
  margin-bottom: 44px;
}
.lx8-cta-footer {
  margin-top: 32px;
  font-size: 0.79rem;
  color: rgba(255,255,255,0.26);
  line-height: 1.7;
}
.lx8-cta-footer a { color: rgba(255,255,255,0.26); }
.lx8-cta-footer a:hover { color: rgba(200,169,110,0.60); }

/* ─────────────────────────────────────────────────────
   18. SECCIÓN "¿POR QUÉ NOSOTROS?" — STATS GRID
───────────────────────────────────────────────────── */
.lx8-stats {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
  margin-bottom: 64px;
}
.lx8-stat {
  text-align: center;
  padding: 40px 20px;
  background: #ffffff;
  border-radius: 18px;
  border: 1px solid rgba(200,169,110,0.16);
  box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}
.lx8-stat-num {
  font-size: clamp(2rem, 4vw, 2.8rem);
  font-weight: 900;
  color: #c8a96e;
  letter-spacing: -0.04em;
  line-height: 1;
  margin-bottom: 10px;
}
.lx8-stat-label {
  font-size: 0.85rem;
  color: #777777;
  line-height: 1.45;
  font-weight: 500;
}

/* ─────────────────────────────────────────────────────
   19. RESPONSIVE — TABLET (max 1024px)
───────────────────────────────────────────────────── */
@media (max-width: 1024px) {
  .lx8-grid-3 { grid-template-columns: repeat(2, 1fr); }
  .lx8-grid-4 { grid-template-columns: repeat(2, 1fr); }
  .lx8-steps { grid-template-columns: repeat(2, 1fr); }
  .lx8-steps::before { display: none; }
  .lx8-stats { grid-template-columns: repeat(2, 1fr); }
}

/* ─────────────────────────────────────────────────────
   20. RESPONSIVE — MOBILE (max 768px)
───────────────────────────────────────────────────── */
@media (max-width: 768px) {
  .lx8-hero-inner { padding: 96px 28px 88px; }
  .lx8-h1 { font-size: 2.0rem; }
  .lx8-hero-sub { font-size: 1rem; }
  .lx8-btn { padding: 17px 36px; font-size: 0.95rem; }
  .lx8-section { padding: 76px 20px; }
  .lx8-section-sm { padding: 60px 20px; }
  .lx8-sec-head { margin-bottom: 48px; }
  .lx8-grid-3 { grid-template-columns: 1fr; gap: 24px; }
  .lx8-grid-4 { grid-template-columns: repeat(2, 1fr); gap: 20px; }
  .lx8-reviews { grid-template-columns: 1fr; }
  .lx8-steps { grid-template-columns: 1fr 1fr; gap: 18px; }
  .lx8-stats { grid-template-columns: repeat(2, 1fr); gap: 16px; }
}

/* ─────────────────────────────────────────────────────
   21. RESPONSIVE — PEQUEÑO (max 520px)
───────────────────────────────────────────────────── */
@media (max-width: 520px) {
  .lx8-hero-inner  { padding: 80px 20px 72px; }
  .lx8-h1          { font-size: 1.75rem; }
  .lx8-hero-sub    { font-size: 0.95rem; }
  .lx8-badge       { font-size: 0.66rem; padding: 9px 20px; }
  .lx8-btn         { padding: 16px 28px; font-size: 0.9rem; }
  .lx8-trust-item  { font-size: 0.74rem; padding: 8px 14px; }
  .lx8-section     { padding: 60px 18px; }
  .lx8-section-sm  { padding: 48px 18px; }
  .lx8-grid-4      { grid-template-columns: 1fr; }
  .lx8-steps       { grid-template-columns: 1fr; }
  .lx8-stats       { grid-template-columns: 1fr 1fr; gap: 14px; }
  .lx8-stat        { padding: 28px 14px; }
  .lx8-muni-grid   { grid-template-columns: repeat(2, 1fr); }
  .lx8-cta-wrap    { padding: 72px 20px 80px; }
}

</style>

<!-- ════════════ JSON-LD SCHEMA ════════════ -->
<script type="application/ld+json">
{"@context":"https://schema.org","@graph":[{"@type":"LocalBusiness","@id":"https://espectaculosluxury.com/#organization","name":"Espectáculos Luxury","url":"https://espectaculosluxury.com","telephone":"+34695858978","priceRange":"€€","image":"https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-01.jpg","description":"Agencia líder en shows de stripper a domicilio en Barcelona. Más de 10 años de experiencia y +5.000 eventos en Barcelona y Cataluña.","areaServed":[{"@type":"City","name":"Barcelona"},{"@type":"City","name":"Hospitalet de Llobregat"},{"@type":"City","name":"Badalona"},{"@type":"City","name":"Sabadell"},{"@type":"City","name":"Terrassa"},{"@type":"City","name":"Sant Cugat del Vallès"},{"@type":"City","name":"Sitges"},{"@type":"City","name":"Castelldefels"}],"address":{"@type":"PostalAddress","addressLocality":"Barcelona","addressRegion":"Cataluña","addressCountry":"ES"},"sameAs":["https://wa.me/34695858978"],"aggregateRating":{"@type":"AggregateRating","ratingValue":"5","reviewCount":"312","bestRating":"5"}},{"@type":"Event","name":"Show de Stripper en Barcelona 2026","startDate":"2026-01-01","endDate":"2026-12-31","location":{"@type":"Place","name":"Barcelona","address":{"@type":"PostalAddress","addressLocality":"Barcelona","addressCountry":"ES"}},"url":"https://espectaculosluxury.com/stripper-barcelona/","offers":[{"@type":"Offer","name":"Show Integral","price":"180","priceCurrency":"EUR"},{"@type":"Offer","name":"Show Lésbico Dúo","price":"330","priceCurrency":"EUR"},{"@type":"Offer","name":"Show con Juguete Erótico","price":"300","priceCurrency":"EUR"},{"@type":"Offer","name":"Camarera Sexy","price":"180","priceCurrency":"EUR"},{"@type":"Offer","name":"Pack Camarera + Show","price":"380","priceCurrency":"EUR"},{"@type":"Offer","name":"Stripper Masculino","price":"180","priceCurrency":"EUR"}]},{"@type":"FAQPage","mainEntity":[{"@type":"Question","name":"¿Cuánto cuesta contratar un stripper en Barcelona?","acceptedAnswer":{"@type":"Answer","text":"Los shows de stripper en Barcelona empiezan desde 180€ para el Show Integral. El Show Lésbico Dúo parte de 330€, el Show con Juguete Erótico desde 300€, la Camarera Sexy desde 180€/hora y el Pack Camarera + Show desde 380€."}},{"@type":"Question","name":"¿Cuánto tiempo tardan en confirmar la reserva?","acceptedAnswer":{"@type":"Answer","text":"Confirmamos todas las reservas en menos de 2 horas por WhatsApp o teléfono."}},{"@type":"Question","name":"¿Actúan en toda Barcelona y área metropolitana?","acceptedAnswer":{"@type":"Answer","text":"Sí, cubrimos toda Barcelona y área metropolitana hasta 60 km."}},{"@type":"Question","name":"¿Se puede contratar un show para un hotel en Barcelona?","acceptedAnswer":{"@type":"Answer","text":"Sí, realizamos shows en los mejores hoteles de Barcelona: Hotel W, Hotel Arts, NH Collection, Meliá Diagonal e Hyatt Regency."}}]}]}
</script>

<!-- ════════════════════════════════════════════════
     HERO — Full bleed saliendo del jas-container
════════════════════════════════════════════════ -->
<div class="lx8-hero-wrapper">
  <section class="lx8-hero">
    <div class="lx8-hero-bg"></div>
    <div class="lx8-hero-overlay"></div>
    <div class="lx8-hero-glow"></div>

    <div class="lx8-hero-inner">

      <!-- Badge -->
      <div class="lx8-badge">
        <span class="lx8-badge-dot"></span>
        Barcelona &middot; Shows Premium 2026 &middot; Confirmación en 2h
      </div>

      <!-- H1 -->
      <h1 class="lx8-h1">
        Stripper en <em>Barcelona</em> 2026<br>
        Shows VIP desde 180&euro;
      </h1>

      <!-- Regla dorada -->
      <div class="lx8-rule"></div>

      <!-- Subtítulo -->
      <p class="lx8-hero-sub">
        La agencia líder en shows de striptease a domicilio en Barcelona.<br>
        Artistas verificadas &middot; Discreción total &middot; Disponibilidad 24h.
      </p>

      <!-- CTA Botones -->
      <div class="lx8-btns">
        <a href="https://wa.me/34695858978?text=Hola%2C+quiero+contratar+un+stripper+en+Barcelona"
           class="lx8-btn lx8-btn-gold">
          &#128242;&nbsp; Reservar por WhatsApp
        </a>
        <a href="tel:+34695858978" class="lx8-btn lx8-btn-outline">
          &#128222;&nbsp; 695 858 978
        </a>
      </div>

      <!-- Trust bar -->
      <div class="lx8-trust">
        <span class="lx8-trust-item">&#11088;&#11088;&#11088;&#11088;&#11088;&nbsp; +5.000 fiestas</span>
        <span class="lx8-trust-item">&#128506;&nbsp; Toda Barcelona y Cataluña</span>
        <span class="lx8-trust-item">&#9889;&nbsp; Confirmación en 2h</span>
        <span class="lx8-trust-item">&#128274;&nbsp; 100% Discreto</span>
      </div>

    </div>
  </section>
</div>

<span class="lx8-divider"></span>

<!-- ════════════════════════════════════════════════
     INTRO SEO
════════════════════════════════════════════════ -->
<div class="lx8-bg-white">
  <div class="lx8-section-sm">
    <div class="lx8-wrap">
      <div class="lx8-sec-head">
        <span class="lx8-eyebrow">Espectáculos Luxury · Barcelona</span>
        <h2 class="lx8-title">Stripper en Barcelona: Shows VIP a Domicilio</h2>
        <span class="lx8-goldbar"></span>
      </div>
      <div class="lx8-prose">
        <p>Contratar un <strong>stripper en Barcelona</strong> para una <strong>despedida de soltera</strong>, cumpleaños o fiesta privada en 2026 es más fácil que nunca con <strong>Espectáculos Luxury</strong>. Somos la agencia con más experiencia de Cataluña: más de 10 años organizando shows de striptease profesionales en <strong>domicilios, hoteles, apartamentos turísticos, villas con piscina y salas privadas</strong> de Barcelona y toda el área metropolitana.</p>
        <p>Nuestro catálogo 2026 incluye el <strong>Show Integral desde 180&euro;</strong>, el espectacular <strong>Show Lésbico Dúo desde 330&euro;</strong>, el <strong>Show con Juguete Erótico desde 300&euro;</strong>, la <strong>Camarera Sexy desde 180&euro;/hora</strong> y el popular <strong>Pack Camarera + Show desde 380&euro;</strong>. Todas nuestras artistas están verificadas, son 100% profesionales y ofrecen la máxima discreción. Confirmamos tu reserva en <strong>menos de 2 horas</strong>.</p>
      </div>
    </div>
  </div>
</div>

<span class="lx8-divider"></span>

<!-- ════════════════════════════════════════════════
     CATÁLOGO DE SHOWS
════════════════════════════════════════════════ -->
<div class="lx8-bg-pearl">
  <div class="lx8-section">
    <div class="lx8-wrap">
      <div class="lx8-sec-head">
        <span class="lx8-eyebrow">Catálogo 2026</span>
        <h2 class="lx8-title">Shows de Stripper en Barcelona</h2>
        <span class="lx8-goldbar"></span>
        <p class="lx8-subtitle">Selecciona el show perfecto para tu celebración</p>
      </div>
      <div class="lx8-grid-3">

        <div class="lx8-card">
          <img class="lx8-card-img"
               src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-01.jpg"
               alt="Show Integral stripper Barcelona 2026"
               loading="lazy" width="400" height="240">
          <div class="lx8-card-body">
            <div class="lx8-card-tag">&#11088; Más popular</div>
            <div class="lx8-card-title">Show Integral</div>
            <div class="lx8-card-desc">Strip-tease completo con coreografía, accesorios y actuación privada exclusiva. 30 a 45 min.</div>
            <div class="lx8-card-price">desde 180&euro;</div>
            <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/show-integral-stripper-barcelona/"
               class="lx8-card-btn">Ver show &rarr;</a>
          </div>
        </div>

        <div class="lx8-card">
          <img class="lx8-card-img"
               src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-08.jpg"
               alt="Show Lésbico Dúo Barcelona despedida soltera"
               loading="lazy" width="400" height="240">
          <div class="lx8-card-body">
            <div class="lx8-card-tag">&#128293; Top despedidas</div>
            <div class="lx8-card-title">Show Lésbico Dúo</div>
            <div class="lx8-card-desc">Dos artistas profesionales con coreografía exclusiva. El show más espectacular para despedidas.</div>
            <div class="lx8-card-price">desde 330&euro;</div>
            <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/show-lesbico-duo-barcelona/"
               class="lx8-card-btn">Ver show &rarr;</a>
          </div>
        </div>

        <div class="lx8-card">
          <img class="lx8-card-img"
               src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-10.jpg"
               alt="Show con Juguete Erótico Barcelona fiestas adultas"
               loading="lazy" width="400" height="240">
          <div class="lx8-card-body">
            <div class="lx8-card-tag">&#128139; Show atrevido</div>
            <div class="lx8-card-title">Show con Juguete Erótico</div>
            <div class="lx8-card-desc">Show integral más demostración con juguete erótico. Para fiestas privadas adultas más atrevidas.</div>
            <div class="lx8-card-price">desde 300&euro;</div>
            <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/show-juguete-erotico-barcelona/"
               class="lx8-card-btn">Ver show &rarr;</a>
          </div>
        </div>

        <div class="lx8-card">
          <img class="lx8-card-img"
               src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-05.jpg"
               alt="Camarera Sexy Barcelona fiesta privada lencería"
               loading="lazy" width="400" height="240">
          <div class="lx8-card-body">
            <div class="lx8-card-tag">&#127946; Ambiente perfecto</div>
            <div class="lx8-card-title">Camarera Sexy</div>
            <div class="lx8-card-desc">Camarera en lencería exclusiva para toda la fiesta. Atención personalizada y servicio VIP. Mínimo 2h.</div>
            <div class="lx8-card-price">180&euro; / hora</div>
            <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/camarera-sexy-barcelona/"
               class="lx8-card-btn">Ver servicio &rarr;</a>
          </div>
        </div>

        <div class="lx8-card">
          <img class="lx8-card-img"
               src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-06.jpg"
               alt="Pack Camarera más Show Integral Barcelona todo incluido"
               loading="lazy" width="400" height="240">
          <div class="lx8-card-body">
            <div class="lx8-card-tag">&#127873; Todo en uno</div>
            <div class="lx8-card-title">Pack Camarera + Show</div>
            <div class="lx8-card-desc">La experiencia completa: camarera sexy durante la fiesta más show integral al final de la noche.</div>
            <div class="lx8-card-price">desde 380&euro;</div>
            <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/pack-camarera-show-barcelona/"
               class="lx8-card-btn">Ver pack &rarr;</a>
          </div>
        </div>

        <div class="lx8-card">
          <img class="lx8-card-img"
               src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-14.jpg"
               alt="Stripper Masculino Barcelona para chicas despedida"
               loading="lazy" width="400" height="240">
          <div class="lx8-card-body">
            <div class="lx8-card-tag">&#128170; Para chicas</div>
            <div class="lx8-card-title">Stripper Masculino</div>
            <div class="lx8-card-desc">Artistas masculinos profesionales para despedidas de soltera y fiestas de chicas en Barcelona.</div>
            <div class="lx8-card-price">desde 180&euro;</div>
            <a href="https://wa.me/34695858978?text=Quiero+contratar+un+stripper+masculino+en+Barcelona"
               class="lx8-card-btn">Reservar &rarr;</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<span class="lx8-divider"></span>

<!-- ════════════════════════════════════════════════
     COBERTURA MUNICIPIOS
════════════════════════════════════════════════ -->
<div class="lx8-bg-dark">
  <div class="lx8-section">
    <div class="lx8-wrap">
      <div class="lx8-sec-head">
        <span class="lx8-eyebrow">Cobertura</span>
        <h2 class="lx8-title">¿Dónde Actuamos en Barcelona?</h2>
        <span class="lx8-goldbar"></span>
        <p class="lx8-subtitle">Cobertura total de Barcelona ciudad y área metropolitana · Hasta 60 km del centro</p>
      </div>
      <div class="lx8-muni-grid">
        <a href="https://espectaculosluxury.com/stripper-barcelona/" class="lx8-muni">
          <div class="lx8-muni-icon">&#127968;</div>
          <div class="lx8-muni-name">Barcelona Ciudad</div>
          <div class="lx8-muni-dist">Eixample, Gràcia, Gothic</div>
        </a>
        <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx8-muni">
          <div class="lx8-muni-icon">&#127748;</div>
          <div class="lx8-muni-name">Hospitalet</div>
          <div class="lx8-muni-dist">5 km del centro</div>
        </a>
        <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx8-muni">
          <div class="lx8-muni-icon">&#127751;</div>
          <div class="lx8-muni-name">Badalona</div>
          <div class="lx8-muni-dist">8 km del centro</div>
        </a>
        <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx8-muni">
          <div class="lx8-muni-icon">&#127978;</div>
          <div class="lx8-muni-name">Cornellà</div>
          <div class="lx8-muni-dist">10 km del centro</div>
        </a>
        <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx8-muni">
          <div class="lx8-muni-icon">&#127969;</div>
          <div class="lx8-muni-name">Sant Cugat</div>
          <div class="lx8-muni-dist">18 km del centro</div>
        </a>
        <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx8-muni">
          <div class="lx8-muni-icon">&#127749;</div>
          <div class="lx8-muni-name">Sabadell</div>
          <div class="lx8-muni-dist">22 km del centro</div>
        </a>
        <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx8-muni">
          <div class="lx8-muni-icon">&#127751;</div>
          <div class="lx8-muni-name">Terrassa</div>
          <div class="lx8-muni-dist">30 km del centro</div>
        </a>
        <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx8-muni">
          <div class="lx8-muni-icon">&#127958;</div>
          <div class="lx8-muni-name">Sitges</div>
          <div class="lx8-muni-dist">35 km · Costa</div>
        </a>
        <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx8-muni">
          <div class="lx8-muni-icon">&#127754;</div>
          <div class="lx8-muni-name">Castelldefels</div>
          <div class="lx8-muni-dist">25 km · Playa</div>
        </a>
        <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx8-muni">
          <div class="lx8-muni-icon">&#127962;</div>
          <div class="lx8-muni-name">Mataró</div>
          <div class="lx8-muni-dist">30 km · Maresme</div>
        </a>
        <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx8-muni">
          <div class="lx8-muni-icon">&#127970;</div>
          <div class="lx8-muni-name">Santa Coloma</div>
          <div class="lx8-muni-dist">10 km del centro</div>
        </a>
        <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" class="lx8-muni">
          <div class="lx8-muni-icon">&#128506;</div>
          <div class="lx8-muni-name">+60 km cobertura</div>
          <div class="lx8-muni-dist">Consulta disponibilidad</div>
        </a>
      </div>
    </div>
  </div>
</div>

<span class="lx8-divider"></span>

<!-- ════════════════════════════════════════════════
     ESPACIOS Y LOCALES
════════════════════════════════════════════════ -->
<div class="lx8-bg-white">
  <div class="lx8-section">
    <div class="lx8-wrap">
      <div class="lx8-sec-head-left">
        <span class="lx8-eyebrow">Espacios</span>
        <h2 class="lx8-title">Espacios y Locales donde Actuamos</h2>
        <span class="lx8-goldbar"></span>
        <p class="lx8-subtitle" style="margin-left:0;margin-top:20px">Llevamos el show a cualquier espacio de Barcelona: desde apartamentos del Eixample hasta villas con piscina en Sitges o hoteles de lujo en el Puerto Olímpico.</p>
      </div>
      <ul class="lx8-checklist">
        <li>&#127968; Domicilios particulares en cualquier barrio de Barcelona</li>
        <li>&#127968; Hotel W, Hotel Arts, NH Collection, Meliá Diagonal, Hyatt Regency</li>
        <li>&#127745; Apartamentos turísticos y Airbnb en Gothic, Born, Eixample y Barceloneta</li>
        <li>&#127958; Villas con piscina en Sitges, Castelldefels, Gavà y Garraf</li>
        <li>&#128676; Yates y barcos en Puerto Olímpico y Port Vell de Barcelona</li>
        <li>&#127881; Salas privadas alquiladas y locales de fiestas en Barcelona</li>
        <li>&#127970; Eventos corporativos y after-work en el 22@ y Diagonal</li>
        <li>&#127754; Beach clubs: Shoko, Opium Beach, Barts Beachclub (verano)</li>
      </ul>

      <h3 style="font-size:1.18rem;font-weight:800;color:#111;margin:72px 0 16px">
        &#127769; Pubs y Discotecas de Moda en Barcelona 2026
      </h3>
      <span class="lx8-goldbar" style="margin:0 0 24px"></span>
      <p style="color:#666;font-size:.95rem;margin-bottom:0;line-height:1.80;max-width:720px">
        Barcelona concentra la mayor oferta de ocio nocturno de España. Si organizas la despedida en alguno de estos locales, nuestras artistas pueden asistir o puedes contratar el show antes o después:
      </p>
      <div class="lx8-tbl-wrap">
        <table class="lx8-tbl">
          <thead>
            <tr>
              <th>Local</th>
              <th>Zona</th>
              <th>Tipo</th>
            </tr>
          </thead>
          <tbody>
            <tr><td><strong>Pacha Barcelona</strong></td><td>Port Olímpic</td><td><span class="lx8-chip">Discoteca</span></td></tr>
            <tr><td><strong>Opium Mar</strong></td><td>Barceloneta</td><td><span class="lx8-chip">Club + Beach</span></td></tr>
            <tr><td><strong>Razzmatazz</strong></td><td>Poblenou</td><td><span class="lx8-chip">Sala de conciertos</span></td></tr>
            <tr><td><strong>Sala Apolo</strong></td><td>Paral·lel</td><td><span class="lx8-chip">Sala clásica</span></td></tr>
            <tr><td><strong>Sutton Club</strong></td><td>Diagonal</td><td><span class="lx8-chip">Club VIP</span></td></tr>
            <tr><td><strong>Bling Bling</strong></td><td>Sant Gervasi</td><td><span class="lx8-chip">Discoteca luxury</span></td></tr>
            <tr><td><strong>El Nacional</strong></td><td>Passeig de Gràcia</td><td><span class="lx8-chip">Gastrobar VIP</span></td></tr>
            <tr><td><strong>Moog</strong></td><td>Arc del Teatre</td><td><span class="lx8-chip">Club electrónico</span></td></tr>
            <tr><td><strong>Jamboree</strong></td><td>Plaça Reial</td><td><span class="lx8-chip">Jazz / Club</span></td></tr>
            <tr><td><strong>Mirablau</strong></td><td>Tibidabo</td><td><span class="lx8-chip">Terraza con vistas</span></td></tr>
            <tr><td><strong>Shoko</strong></td><td>Port Olímpic</td><td><span class="lx8-chip">Beach Club</span></td></tr>
            <tr><td><strong>Club Catwalk</strong></td><td>Port Olímpic</td><td><span class="lx8-chip">Discoteca</span></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<span class="lx8-divider"></span>

<!-- ════════════════════════════════════════════════
     PASOS DE RESERVA
════════════════════════════════════════════════ -->
<div class="lx8-bg-pearl">
  <div class="lx8-section">
    <div class="lx8-wrap">
      <div class="lx8-sec-head">
        <span class="lx8-eyebrow">Proceso de reserva</span>
        <h2 class="lx8-title">Cómo Contratar un Stripper en Barcelona</h2>
        <span class="lx8-goldbar"></span>
        <p class="lx8-subtitle">4 pasos simples para tener el show perfecto</p>
      </div>
      <div class="lx8-steps">
        <div class="lx8-step">
          <div class="lx8-step-num">1</div>
          <div class="lx8-step-title">Elige el Show</div>
          <div class="lx8-step-desc">Selecciona entre nuestro catálogo: Integral, Lésbico Dúo, con Juguete, Camarera o Pack completo.</div>
        </div>
        <div class="lx8-step">
          <div class="lx8-step-num">2</div>
          <div class="lx8-step-title">Contáctanos</div>
          <div class="lx8-step-desc">Escríbenos por WhatsApp al 695 858 978 o llámanos con los detalles: fecha, lugar y tipo de show.</div>
        </div>
        <div class="lx8-step">
          <div class="lx8-step-num">3</div>
          <div class="lx8-step-title">Confirmación en 2h</div>
          <div class="lx8-step-desc">Recibirás confirmación y datos de la artista en menos de 2 horas. Pago fácil y discreto.</div>
        </div>
        <div class="lx8-step">
          <div class="lx8-step-num">4</div>
          <div class="lx8-step-title">¡Disfruta el Show!</div>
          <div class="lx8-step-desc">La artista llega puntual y ofrece el show más profesional y memorable de Barcelona.</div>
        </div>
      </div>
    </div>
  </div>
</div>

<span class="lx8-divider"></span>

<!-- ════════════════════════════════════════════════
     PRECIOS
════════════════════════════════════════════════ -->
<div class="lx8-bg-dark">
  <div class="lx8-section">
    <div class="lx8-wrap">
      <div class="lx8-sec-head">
        <span class="lx8-eyebrow">Tarifas 2026</span>
        <h2 class="lx8-title">Precios Shows Barcelona 2026</h2>
        <span class="lx8-goldbar"></span>
      </div>
      <div class="lx8-price-wrap">
        <table class="lx8-price-tbl">
          <thead>
            <tr>
              <th>Tipo de Show</th>
              <th>Precio</th>
              <th>Duración</th>
              <th>Ideal para</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>Show Integral</strong></td>
              <td class="lx8-price-hl">desde 180&euro;</td>
              <td>30 a 45 min</td>
              <td>Cualquier evento</td>
            </tr>
            <tr>
              <td><strong>Show Lésbico Dúo</strong></td>
              <td class="lx8-price-hl">desde 330&euro;</td>
              <td>45 a 60 min</td>
              <td>Despedidas de soltera</td>
            </tr>
            <tr>
              <td><strong>Show con Juguete Erótico</strong></td>
              <td class="lx8-price-hl">desde 300&euro;</td>
              <td>30 a 45 min</td>
              <td>Fiestas adultas</td>
            </tr>
            <tr>
              <td><strong>Camarera Sexy</strong></td>
              <td class="lx8-price-hl">180&euro; / hora</td>
              <td>Mínimo 2h</td>
              <td>Toda la fiesta</td>
            </tr>
            <tr>
              <td><strong>Pack Camarera + Show</strong></td>
              <td class="lx8-price-hl">desde 380&euro;</td>
              <td>3 a 4 horas</td>
              <td>Todo en uno</td>
            </tr>
            <tr>
              <td><strong>Stripper Masculino</strong></td>
              <td class="lx8-price-hl">desde 180&euro;</td>
              <td>30 a 45 min</td>
              <td>Para chicas</td>
            </tr>
          </tbody>
        </table>
      </div>
      <p class="lx8-price-note">* Desplazamiento incluido en Barcelona y hasta 30 km. Consultar suplemento para distancias mayores.</p>
    </div>
  </div>
</div>

<span class="lx8-divider"></span>

<!-- ════════════════════════════════════════════════
     TESTIMONIOS
════════════════════════════════════════════════ -->
<div class="lx8-bg-white">
  <div class="lx8-section">
    <div class="lx8-wrap">
      <div class="lx8-sec-head">
        <span class="lx8-eyebrow">Opiniones reales</span>
        <h2 class="lx8-title">Lo que Dicen Nuestros Clientes</h2>
        <span class="lx8-goldbar"></span>
        <p class="lx8-subtitle">+5.000 eventos &middot; valoración media 5 sobre 5</p>
      </div>
      <div class="lx8-reviews">
        <div class="lx8-review">
          <span class="lx8-review-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
          <blockquote>"Increíble show para la despedida de mi amiga en el Eixample. La chica era super profesional y discreta. Reservamos por WhatsApp y en 1 hora lo teníamos confirmado."</blockquote>
          <cite>Marta R. &middot; Barcelona &middot; Despedida de soltera &middot; Feb 2026</cite>
        </div>
        <div class="lx8-review">
          <span class="lx8-review-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
          <blockquote>"Contratamos el pack camarera más show para el cumpleaños de mi novio en un apartamento del Born. Fue un 10, superó todas las expectativas."</blockquote>
          <cite>Laura G. &middot; Barcelona &middot; Cumpleaños privado &middot; Ene 2026</cite>
        </div>
        <div class="lx8-review">
          <span class="lx8-review-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
          <blockquote>"Show lésbico dúo en un hotel del Puerto Olímpico para la despedida de soltero. Los chicos no se lo podían creer. Todo muy profesional y discreto."</blockquote>
          <cite>Carlos M. &middot; Barcelona &middot; Despedida de soltero &middot; Mar 2026</cite>
        </div>
        <div class="lx8-review">
          <span class="lx8-review-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
          <blockquote>"Organizamos una fiesta privada en un chalet de Sitges y el show fue espectacular. La chica llegó puntual y el show duró más de lo esperado. ¡10 sobre 10!"</blockquote>
          <cite>Alejandro V. &middot; Sitges &middot; Fiesta privada &middot; Dic 2025</cite>
        </div>
      </div>
    </div>
  </div>
</div>

<span class="lx8-divider"></span>

<!-- ════════════════════════════════════════════════
     POR QUÉ ELEGIRNOS — STATS + LISTA
════════════════════════════════════════════════ -->
<div class="lx8-bg-pearl">
  <div class="lx8-section">
    <div class="lx8-wrap">
      <div class="lx8-sec-head">
        <span class="lx8-eyebrow">¿Por qué nosotros?</span>
        <h2 class="lx8-title">La Agencia de Referencia en Barcelona</h2>
        <span class="lx8-goldbar"></span>
        <p class="lx8-subtitle">Somos la agencia líder en shows privados de Barcelona y Cataluña</p>
      </div>
      <!-- Stats numéricos -->
      <div class="lx8-stats">
        <div class="lx8-stat">
          <div class="lx8-stat-num">+10</div>
          <div class="lx8-stat-label">Años de experiencia en Barcelona</div>
        </div>
        <div class="lx8-stat">
          <div class="lx8-stat-num">+5.000</div>
          <div class="lx8-stat-label">Eventos realizados en Cataluña</div>
        </div>
        <div class="lx8-stat">
          <div class="lx8-stat-num">5/5</div>
          <div class="lx8-stat-label">Valoración media de nuestros clientes</div>
        </div>
        <div class="lx8-stat">
          <div class="lx8-stat-num">2h</div>
          <div class="lx8-stat-label">Tiempo máximo de confirmación de reserva</div>
        </div>
      </div>
      <!-- Lista ventajas -->
      <ul class="lx8-list-plain">
        <li>Artistas verificadas, profesionales y con experiencia demostrada</li>
        <li>Confirmación de reserva garantizada en menos de 2 horas</li>
        <li>Discreción absoluta: sin cargos descriptivos en la factura</li>
        <li>Cobertura de toda Barcelona y área metropolitana (hasta 60 km)</li>
        <li>Disponibilidad 24 horas, 365 días al año incluyendo festivos</li>
        <li>Precios transparentes: todo incluido desde el primer presupuesto</li>
        <li>El catálogo de artistas más amplio de Barcelona y Cataluña</li>
        <li>Shows personalizables según el tipo de evento y preferencias</li>
        <li>Pago seguro, fácil y discreto por múltiples métodos</li>
        <li>Más de 10 años de experiencia y +5.000 eventos en Barcelona</li>
      </ul>
    </div>
  </div>
</div>

<span class="lx8-divider"></span>

<!-- ════════════════════════════════════════════════
     SHOWS POR TIPO DE EVENTO
════════════════════════════════════════════════ -->
<div class="lx8-bg-white">
  <div class="lx8-section">
    <div class="lx8-wrap">
      <div class="lx8-sec-head">
        <span class="lx8-eyebrow">Por tipo de evento</span>
        <h2 class="lx8-title">Shows en Barcelona por Tipo de Evento</h2>
        <span class="lx8-goldbar"></span>
        <p class="lx8-subtitle">Explora nuestros shows especializados para cada ocasión</p>
      </div>
      <div class="lx8-grid-4">
        <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-despedida-soltera-barcelona-producto/" style="text-decoration:none;display:block">
          <div class="lx8-card">
            <img class="lx8-card-img" src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-02.jpg" alt="Stripper despedida de soltera Barcelona 2026" loading="lazy" width="300" height="200">
            <div class="lx8-card-body">
              <div class="lx8-card-tag">&#128141; Despedidas</div>
              <div class="lx8-card-title">Stripper Despedida de Soltera</div>
              <div class="lx8-card-desc">Shows exclusivos para despedidas de soltera en Barcelona</div>
              <div class="lx8-card-price">desde 180&euro;</div>
            </div>
          </div>
        </a>
        <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-cumpleanos-barcelona-producto/" style="text-decoration:none;display:block">
          <div class="lx8-card">
            <img class="lx8-card-img" src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-15.jpg" alt="Stripper cumpleaños sorpresa Barcelona 2026" loading="lazy" width="300" height="200">
            <div class="lx8-card-body">
              <div class="lx8-card-tag">&#127874; Cumpleaños</div>
              <div class="lx8-card-title">Stripper Cumpleaños Sorpresa</div>
              <div class="lx8-card-desc">La sorpresa perfecta para quien cumpla años en Barcelona</div>
              <div class="lx8-card-price">desde 180&euro;</div>
            </div>
          </div>
        </a>
        <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/stripper-a-domicilio-barcelona-producto/" style="text-decoration:none;display:block">
          <div class="lx8-card">
            <img class="lx8-card-img" src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-11.jpg" alt="Stripper a domicilio Barcelona 24h disponible" loading="lazy" width="300" height="200">
            <div class="lx8-card-body">
              <div class="lx8-card-tag">&#127968; A Domicilio · 24h</div>
              <div class="lx8-card-title">Stripper a Domicilio</div>
              <div class="lx8-card-desc">Shows en tu casa, hotel o apartamento en Barcelona</div>
              <div class="lx8-card-price">desde 180&euro;</div>
            </div>
          </div>
        </a>
        <a href="https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/show-lesbico-duo-barcelona/" style="text-decoration:none;display:block">
          <div class="lx8-card">
            <img class="lx8-card-img" src="https://espectaculosluxury.com/wp-content/uploads/2026/03/bcn-stripper-09.jpg" alt="Show lésbico dúo Barcelona despedidas VIP" loading="lazy" width="300" height="200">
            <div class="lx8-card-body">
              <div class="lx8-card-tag">&#10024; Show Premium</div>
              <div class="lx8-card-title">Show Lésbico Dúo</div>
              <div class="lx8-card-desc">El show más demandado para despedidas exclusivas en Barcelona</div>
              <div class="lx8-card-price">desde 330&euro;</div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>

<span class="lx8-divider"></span>

<!-- ════════════════════════════════════════════════
     FAQ
════════════════════════════════════════════════ -->
<div class="lx8-bg-pearl">
  <div class="lx8-section">
    <div class="lx8-wrap">
      <div class="lx8-sec-head">
        <span class="lx8-eyebrow">Preguntas frecuentes</span>
        <h2 class="lx8-title">FAQ: Stripper en Barcelona</h2>
        <span class="lx8-goldbar"></span>
      </div>
      <div class="lx8-faq">
        <details>
          <summary>¿Cuánto cuesta contratar un stripper en Barcelona?</summary>
          <p>Los shows de stripper en Barcelona empiezan desde <strong>180&euro;</strong> para el Show Integral. El Show Lésbico Dúo parte de <strong>330&euro;</strong>, el Show con Juguete Erótico desde <strong>300&euro;</strong>, la Camarera Sexy desde <strong>180&euro;/hora</strong> (mínimo 2 horas) y el Pack Camarera + Show desde <strong>380&euro;</strong>. El desplazamiento está incluido en Barcelona ciudad y hasta 30 km.</p>
        </details>
        <details>
          <summary>¿Cuánto tiempo tardan en confirmar la reserva?</summary>
          <p>Confirmamos todas las reservas de stripper en Barcelona en <strong>menos de 2 horas</strong> por WhatsApp o teléfono. En muchos casos la confirmación es inmediata. Llama al <strong>695 858 978</strong> o escríbenos por WhatsApp.</p>
        </details>
        <details>
          <summary>¿Actúan en toda Barcelona y área metropolitana?</summary>
          <p>Sí, cubrimos <strong>toda la ciudad de Barcelona y su área metropolitana</strong> hasta 60 km: Hospitalet de Llobregat, Badalona, Sabadell, Terrassa, Cornellà, Sant Cugat del Vallès, Mataró, Sitges, Castelldefels, Gavà y muchos más.</p>
        </details>
        <details>
          <summary>¿Se puede contratar un show para un hotel de Barcelona?</summary>
          <p>Sí, realizamos shows en los mejores hoteles de Barcelona: <strong>Hotel W Barcelona, Hotel Arts, NH Collection, Meliá Diagonal, Hyatt Regency, Hilton Diagonal Mar</strong> y cualquier hotel de la ciudad.</p>
        </details>
        <details>
          <summary>¿Cuáles son los barrios de Barcelona con más demanda?</summary>
          <p>Los barrios con mayor demanda son: <strong>Eixample</strong> (Gaixample), <strong>El Born y el Gothic Quarter</strong>, <strong>Barceloneta</strong>, <strong>Gràcia</strong>, <strong>Poblenou</strong> y <strong>Sarrià-Sant Gervasi</strong>.</p>
        </details>
        <details>
          <summary>¿Tienen disponibilidad los fines de semana y festivos?</summary>
          <p>Tenemos disponibilidad <strong>las 24 horas, 365 días al año</strong>, incluyendo fines de semana, festivos y temporadas de alta demanda como San Valentín, verano y Nochevieja.</p>
        </details>
        <details>
          <summary>¿Qué diferencia hay entre el show integral y el lésbico dúo?</summary>
          <p>El <strong>Show Integral</strong> es el striptease completo con una sola artista profesional. El <strong>Show Lésbico Dúo</strong> incluye dos artistas con coreografía conjunta y es el show más solicitado para <strong>despedidas de soltera</strong> en Barcelona.</p>
        </details>
        <details>
          <summary>¿Cómo funciona el servicio de camarera sexy en Barcelona?</summary>
          <p>La <strong>camarera sexy</strong> atiende tu fiesta durante toda la celebración vestida con lencería exclusiva. Servicio mínimo de 2 horas a <strong>180&euro;/hora por chica</strong>. También disponible el <strong>Pack Camarera + Show desde 380&euro;</strong>.</p>
        </details>
      </div>
    </div>
  </div>
</div>

<span class="lx8-divider"></span>

<!-- ════════════════════════════════════════════════
     CTA FINAL
════════════════════════════════════════════════ -->
<div class="lx8-bg-dark">
  <div class="lx8-cta-wrap">
    <span class="lx8-eyebrow" style="display:block;margin-bottom:20px">Reserva tu show ahora</span>
    <h2>¿Listo para Reservar<br>tu Show en Barcelona?</h2>
    <p>Contacta ahora y confirmamos en menos de 2 horas.<br>Disponibles 24h · 365 días al año</p>
    <div class="lx8-btns">
      <a href="https://wa.me/34695858978?text=Hola%2C+quiero+contratar+un+stripper+en+Barcelona"
         class="lx8-btn lx8-btn-gold" style="padding:22px 52px;font-size:1.05rem">
        &#128242;&nbsp; Reservar por WhatsApp
      </a>
      <a href="tel:+34695858978" class="lx8-btn lx8-btn-outline" style="padding:22px 48px;font-size:1.05rem">
        &#128222;&nbsp; Llamar al 695 858 978
      </a>
    </div>
    <p class="lx8-cta-footer">
      Espectáculos Luxury · Barcelona y Área Metropolitana ·
      <a href="https://espectaculosluxury.com/stripper-madrid/">Ver también: Stripper en Madrid</a>
    </p>
  </div>
</div>

</div><!-- /#lx8 -->
HTML;

global $wpdb;
$result = $wpdb->update(
    $wpdb->posts,
    [
        'post_content'      => $html,
        'post_modified'     => current_time('mysql'),
        'post_modified_gmt' => current_time('mysql', true),
    ],
    ['ID' => 67406],
    ['%s','%s','%s'],
    ['%d']
);

echo ($result === false)
    ? "DB ERROR: " . $wpdb->last_error . "\n"
    : "OK — chars: " . strlen($html) . "\n";

// Flush all caches
wp_cache_delete(67406, 'posts');
wp_cache_delete(67406, 'post_meta');
clean_post_cache(67406);
wp_cache_flush();
if (function_exists('w3tc_flush_all'))       w3tc_flush_all();
if (function_exists('rocket_clean_domain'))  rocket_clean_domain();
if (function_exists('wp_cache_clear_cache')) wp_cache_clear_cache();

// Verify
$saved = $wpdb->get_var("SELECT post_content FROM {$wpdb->posts} WHERE ID = 67406");
$bad = substr_count($saved, '&#8211;');
$dashes = substr_count($saved, '--');
echo "Corruptions in DB: $bad\n";
echo "Double dashes: $dashes\n";
echo "URL: https://espectaculosluxury.com/stripper-barcelona/\n";
