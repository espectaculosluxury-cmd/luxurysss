# Gold Minimal Pro — Design Methodology & Editorial Template
## Espectáculos Luxury · Landing Pages & Cluster Pages
### Version 2.0 · March 2026

---

## 1. DESIGN PHILOSOPHY

**Gold Minimal Pro** is the proprietary design system used by Espectáculos Luxury for all city landing pages and product cluster pages. The system prioritizes:

- **Conversion over aesthetics**: Every element drives WhatsApp contact
- **Trust signals**: Pricing, testimonials, badges reduce friction
- **Mobile-first**: Grid systems collapse gracefully to 2 columns at 390px
- **SEO density**: H1/H2 hierarchy, FAQ schema, structured content ~22,000 chars landing / ~9,000 chars cluster
- **WordPress-safe HTML**: All CSS inlined in `<style>` within the post content to avoid wpautop conflicts

---

## 2. COLOR PALETTE & TYPOGRAPHY

```css
:root {
  --lux-gold: #c8a96e;      /* Primary brand gold */
  --lux-dark: #111;          /* Text & backgrounds */
  --lux-light: #f9f6f0;      /* Section backgrounds */
}

/* Key Gradients */
.hero-bg: linear-gradient(135deg, #0a0a0a 0%, #1a1208 50%, #0f0c05 100%);
.cta-bg:  linear-gradient(135deg, #0a0a0a, #1a1208);

/* Typography */
H1: clamp(28px, 5vw, 52px) — weight 800
H2: clamp(22px, 3vw, 32px) — weight 800
Body: 15-16px — line-height 1.78 — color #444
Price: font-size 22px+ — weight 800 — color var(--lux-gold)
```

---

## 3. PAGE ARCHITECTURE

### 3.1 Landing Page Structure (~22,000–35,000 chars)

```
1. <div class="lux-landing-css"> wrapper
2. <style> block (6,000–8,000 chars CSS)
3. .lx-hero — Hero with background image (opacity 0.22–0.35)
4. .lx-section — Shows catalog (5 lx-card items)
5. .lx-section — Municipality grid (lx-munic-grid)
6. .lx-section — Body text + H1 SEO content
7. .lx-section — Price table
8. .lx-section — 4-step reservation flow
9. .lx-section — FAQ (8 items, <details>/<summary>)
10. .lx-cta-final — Final CTA section
11. JSON-LD: LocalBusiness + FAQPage (inline in body)
```

### 3.2 Cluster Page Structure (~9,000–25,000 chars)

```
1. .lx-breadcrumb navigation
2. .lx-hero (lighter, badge + H1 + CTA button)
3. .lx-section h2 — Topic intro (keyword-rich)
4. .lx-cards — 3-5 show type cards
5. Price table (responsive)
6. .lx-checklist — What's included
7. .lx-why-grid — 6 trust reasons
8. .lx-faq — 6-8 FAQ items
9. Municipality links grid
10. Internal cross-links box
11. .lx-cta-final
```

### 3.3 Product Page Structure (~14,000 chars)

```
1. <style> (product-scoped CSS)
2. H2 — Primary keyword headline
3. .lx-intro — Long intro 2 paragraphs (400+ words)
4. .lx-checklist — "¿Qué incluye?" 12 items
5. Zones & destinations section
6. Types of spaces section
7. .lx-price-table — Comparative all 6 show types
8. .lx-testimonials — 3 reviews with 5★ rating
9. .lx-why-grid — 4 reasons
10. .lx-faq — 8 FAQ items with <details>/<summary>
11. .lx-cta-box — WhatsApp CTA
12. Internal cross-links box
```

---

## 4. CSS COMPONENT LIBRARY

### 4.1 Hero Section

```css
.lx-hero {
  background: linear-gradient(135deg, #0a0a0a 0%, #1a1208 50%, #0f0c05 100%);
  color: #fff;
  padding: 80px 20px;  /* 70px for clusters */
  text-align: center;
  position: relative;
  overflow: hidden;
}
.lx-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: url('IMAGE_URL') center/cover no-repeat;
  opacity: .22;  /* .35 for clusters */
}
.lx-hero__inner {
  position: relative;
  z-index: 2;
  max-width: 820px;
  margin: 0 auto;
}
.lx-hero__badge {
  display: inline-block;
  background: var(--lux-gold);
  color: #000;
  font-size: .72rem;
  font-weight: 700;
  letter-spacing: .12em;
  text-transform: uppercase;
  padding: 5px 16px;
  border-radius: 20px;
  margin-bottom: 18px;
}
```

### 4.2 Municipality Grid

```css
.lx-munic-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 12px;
  margin-top: 30px;
}
@media(min-width: 640px) {
  .lx-munic-grid { grid-template-columns: repeat(3, 1fr); }
}
@media(min-width: 900px) {
  .lx-munic-grid { grid-template-columns: repeat(4, 1fr); }
}
.lx-munic-card {
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 2px 12px rgba(0,0,0,.07);
  transition: .2s;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  border: 1px solid #f0e8d8;
}
.lx-munic-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 20px rgba(0,0,0,.12);
  border-color: var(--lux-gold);
}
.lx-munic-card__img {
  width: 100%;
  aspect-ratio: 1/1;
  object-fit: cover;
  object-position: center top;
}
```

### 4.3 Show Cards

```css
.lx-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 22px;
}
.lx-card {
  background: #fff;
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0,0,0,.08);
  transition: .25s;
}
.lx-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 30px rgba(0,0,0,.14);
}
.lx-card__img {
  width: 100%;
  aspect-ratio: 4/5;  /* 4/3 for cluster cards */
  object-fit: cover;
  object-position: center top;
}
```

### 4.4 Price Table

```css
.lx-price-table {
  width: 100%;
  border-collapse: collapse;
  margin: 30px 0;
  font-size: 14px;
}
.lx-price-table th {
  background: var(--lux-dark);
  color: var(--lux-gold);
  padding: 12px 16px;
  text-align: left;
  font-weight: 700;
}
.lx-price-table td {
  padding: 12px 16px;
  border-bottom: 1px solid #f0e8d8;
}
.lx-price-table tr:nth-child(even) td {
  background: #fdfaf5;
}
.lx-price-table .lx-price {
  font-weight: 800;
  color: var(--lux-gold);
  white-space: nowrap;
}
```

### 4.5 FAQ Accordion

```css
.lx-faq details {
  border: 1px solid #e8dcc8;
  border-radius: 10px;
  margin-bottom: 10px;
  overflow: hidden;
}
.lx-faq summary {
  padding: 14px 18px;
  font-weight: 700;
  cursor: pointer;
  background: #fffdf7;
  list-style: none;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.lx-faq summary::after {
  content: '+';
  font-size: 1.3rem;
  color: var(--lux-gold);
}
.lx-faq details[open] summary::after { content: '−'; }
.lx-faq details[open] summary {
  border-bottom: 1px solid #e8dcc8;
}
.lx-faq__body {
  padding: 14px 18px;
  font-size: .93rem;
  color: #444;
  line-height: 1.65;
}
```

### 4.6 CTA Final Section

```css
.lx-cta-final {
  background: linear-gradient(135deg, #0a0a0a, #1a1208);
  color: #fff;
  text-align: center;
  padding: 60-80px 20px;
}
.lx-cta-final__btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: var(--lux-gold);
  color: #000;
  font-weight: 700;
  padding: 15px 38px;
  border-radius: 50px;
  text-decoration: none;
  font-size: 1.05rem;
  transition: transform .2s;
}
.lx-cta-final__btn:hover { transform: translateY(-2px); }
```

---

## 5. STANDARD PRICING (All cities)

| Show Type | Price | Duration | Notes |
|-----------|-------|----------|-------|
| Show Integral | desde 180 € | 30-45 min | Most popular |
| Dúo Lésbico | desde 350 € | 45-60 min | Two artists |
| Juguete Erótico (Dildo) | desde 280 € | 30-45 min | Interactive |
| Camarera Sexy | 180 €/hora/chica | Per hour | Long events |
| Pack Camarera + Integral | desde 300 € | 2-3h | Best value |
| Stripper Masculino (Boys) | desde 180 € | 30-45 min | Female groups |

---

## 6. SEO CONFIGURATION (RankMath)

### Title Pattern
```
Stripper en [CITY] [YEAR] | Shows VIP desde 180€ · [EVENT TYPE] — Espectáculos Luxury
```

### Meta Description Pattern (~200 chars)
```
Contrata stripper en [CITY] desde 180€. Shows integrales, dúo lésbico, camarera sexy. 
Artistas verificadas. [DISTANCE_CLAIM]. Reserva por WhatsApp.
```

### Focus Keywords (3-4)
```
stripper [city]
contratar stripper [city]
show [event_type] [city]
stripper [city] 2026
```

### RankMath Schema Configuration

**Products:**
- `rank_math_schema_Product` — AggregateOffer (180–350€), InStock, aggregateRating 5★
- `rank_math_schema_FAQPage` — 8 Q&A pairs
- `rank_math_robots` = `a:1:{i:0;s:5:"index";}`

**Landing Pages:**
- `rank_math_schema_LocalBusiness` — areaServed, aggregateRating, telephone
- `rank_math_schema_FAQPage` — 8 Q&A pairs

**Cluster Pages:**
- `rank_math_schema_FAQPage` — 6 Q&A pairs

---

## 7. EDITORIAL TEMPLATE (~14,000 chars)

### Template Variables
- `{CITY}` — City name (e.g., "Sevilla", "Madrid", "Cádiz")
- `{SLUG}` — URL slug (e.g., "stripper-sevilla")
- `{IMG_URL}` — Hero image URL
- `{YEAR}` — Current year (2026)

### Required Sections

1. **H2 Headline** — `Stripper en {CITY} — Show Privado VIP para [Event Type] {YEAR}`

2. **Long intro** (~250 words) — Must include:
   - Primary keyword in first sentence
   - Agency authority claim ("más de 10 años", "3.000 eventos")
   - Geographic coverage
   - Price anchor ("desde 180 €")
   - Call to action mention

3. **"¿Qué incluye?" checklist** — 12 items minimum:
   ```
   ✓ Artista profesional seleccionada para tu evento
   ✓ Coreografía personalizable (policía, enfermera, novia...)
   ✓ Show completo 30-60 minutos
   ✓ Disfraces, accesorios y equipo de sonido incluidos
   ✓ Interacción con invitados
   ✓ Desplazamiento a {CITY} incluido
   ✓ Foto/perfil de artista previo a reserva
   ✓ Gestión por WhatsApp: rápida y discreta
   ✓ Confirmación de reserva inmediata
   ✓ Asistencia 24/7 el día del evento
   ✓ Bis disponible bajo contrato
   ✓ Factura oficial disponible para empresas
   ```

4. **Zonas y destinos** — List all neighborhoods, districts, nearby towns

5. **Tipos de espacios** — Domicilios, hoteles, Airbnbs, locales, villas, barcos

6. **Tabla comparativa precios** — All 6 show types with duration and "Best For" column

7. **Testimonials** — 3 reviews with:
   - ★★★★★ star rating
   - Review text (40-60 words)
   - Author name + context (city, event type)
   - Date

8. **"¿Por qué elegirnos?"** — 4-6 items with emoji icons:
   - 🔒 Discreción garantizada
   - ⭐ X shows/año realizados
   - 💰 Precios fijos sin sorpresas
   - 📱 Gestión rápida por WhatsApp
   - 🎭 Artistas verificadas
   - 📍 Cobertura geográfica completa

9. **FAQ** — 8+ items using `<details>/<summary>`:
   - ¿Cuánto cuesta?
   - ¿Con cuánta antelación reservar?
   - ¿El desplazamiento está incluido?
   - ¿Puedo ver fotos antes?
   - ¿Es legal?
   - ¿Para grupos pequeños?
   - ¿Tipos de show disponibles?
   - ¿Cómo reservo?

10. **Internal cross-links** — Must link to:
    - Main city landing (`/stripper-{city}/`)
    - Cluster pages (despedida, cumpleaños, domicilio, fiestas privadas)
    - Products of same municipality

11. **External nofollow references** — 1-2 authority links:
    ```html
    <a href="https://www.comunidad.madrid/" rel="nofollow noopener" target="_blank">
      Comunidad de Madrid
    </a>
    ```

---

## 8. IMAGE STRATEGY

### Image Assignment Pattern (per city, 21 images total)
- **img-01 to img-07**: Primary show types (integral, lesbic, toy, camarera, pack, boys)
- **img-08 to img-14**: Municipality product thumbnails
- **img-15 to img-21**: Hero/background images for cluster pages

### ALT Text Formula
```
Stripper [city] — [show_type] [event_context] [year]
```
Examples:
- "Stripper Madrid — show integral despedida soltera 2026"
- "Stripper Alcalá de Henares — show privado fiesta domicilio 2026"

### WordPress Media Import
```bash
wp media import /path/to/images/*.jpg \
  --path=/var/www/vhosts/domain/httpdocs \
  --allow-root \
  --title="Stripper {CITY}"
# Returns: media IDs for use in _thumbnail_id, _product_image_gallery
```

---

## 9. WORDPRESS DEPLOYMENT WORKFLOW

### Step 1: Prepare HTML
```bash
# Create landing page HTML file
nano /home/user/webapp/city_landing.html
# Ensure no raw PHP, no WP shortcodes that could break
# Use inline CSS only — no wp_enqueue needed
```

### Step 2: SCP to Server
```bash
sshpass -p 'PASSWORD' scp -o StrictHostKeyChecking=no \
  /home/user/webapp/city_landing.html \
  root@SERVER:/tmp/city_landing.html
```

### Step 3: Update via PHP/MySQL
```php
$conn = new mysqli('localhost', 'DB_USER', 'DB_PASS', 'DB_NAME');
$content = file_get_contents('/tmp/city_landing.html');
$stmt = $conn->prepare("UPDATE el_posts SET post_content=?, post_status='publish' WHERE ID=?");
$stmt->bind_param('si', $content, $post_id);
$stmt->execute();
```

### Step 4: Flush All Caches
```bash
wp --path=/path/to/wp --allow-root cache flush
wp --path=/path/to/wp --allow-root w3-total-cache flush all
redis-cli FLUSHALL
nginx -s reload
```

### Step 5: Verify
```bash
HTTP=$(curl -s -L -o /dev/null -w '%{http_code}' 'https://domain.com/slug/')
# Should return: 200
```

---

## 10. DATABASE TABLE PREFIX

The site uses **`el_`** prefix (NOT the default `wp_`):
- `el_posts` — Posts/Pages/Products
- `el_postmeta` — Post metadata (RankMath, WooCommerce, thumbnails)
- `el_terms` — Taxonomy terms
- `el_term_taxonomy` — Term taxonomy mappings
- `el_term_relationships` — Object-term relationships
- `el_woocommerce_attribute_taxonomies` — WC attributes

---

## 11. WOOCOMMERCE VARIABLE PRODUCT STRUCTURE

### Product Attributes Used
| Attribute | Taxonomy | Use |
|-----------|----------|-----|
| Tipo de Show | `pa_tipo-show` | **Variation** attribute |
| Municipio [City] | `pa_municipio-[city]` | Non-variation (display) |
| Comunidad de Madrid | `pa_comunidad-de-madrid` | Non-variation |

### Show Type Term IDs (pa_tipo-show)
| Term | Slug | ID | Price |
|------|------|----|-------|
| Show Integral | show-integral | 6845 | 180 |
| Show Lésbico Dúo | show-lesbico-duo | 6846 | 350 |
| Show con Juguetes Eróticos | show-juguetes-eroticos | 6847 | 280 |
| Camarera Sexy | camarera-sexy | 6848 | 180 |
| Pack Camarera Sexy + Show Integral | pack-camarera-show | 6849 | 300 |

### Required Product Meta
```
_price: 180 (minimum)
_regular_price: 180
_min_variation_price: 180
_max_variation_price: 350
_stock_status: instock
_manage_stock: no
_visibility: visible
_thumbnail_id: [attachment_id]
_product_image_gallery: [id1,id2,id3]
_product_attributes: [serialized array]
```

### Required Variation Meta
```
_price: [show_price]
_regular_price: [show_price]
_stock_status: instock
_manage_stock: no
attribute_pa_tipo-show: [show-slug]
_sku: [municipio-slug]-[show-slug]-2026
```

---

## 12. MADRID IMPLEMENTATION — COMPLETE INVENTORY

### Landing Page
| URL | Post ID | Size | Status |
|-----|---------|------|--------|
| /stripper-madrid/ | 67389 | 35,864 chars | ✅ 200 |

### Cluster Pages
| URL | Post ID | Size | Status |
|-----|---------|------|--------|
| /stripper-despedidas-madrid/ | 67391 | ~9,377 chars | ✅ 200 |
| /stripper-cumpleanos-madrid/ | 67392 | ~9,414 chars | ✅ 200 |
| /stripper-a-domicilio-madrid/ | 67393 | ~9,402 chars | ✅ 200 |
| /stripper-fiestas-privadas-madrid/ | 67892 | 24,730 chars | ✅ 200 |

### WooCommerce Products (8 municipios)
| Municipio | Product ID | URL | Variations |
|-----------|-----------|-----|------------|
| Alcalá de Henares | 67893 | /producto/stripper-alcala-de-henares/ | 67894–67898 |
| Móstoles | 67899 | /producto/stripper-mostoles/ | 67900–67904 |
| Alcorcón | 67905 | /producto/stripper-alcorcon/ | 67906–67910 |
| Leganés | 67911 | /producto/stripper-leganes/ | 67912–67916 |
| Getafe | 67917 | /producto/stripper-getafe/ | 67918–67922 |
| Fuenlabrada | 67923 | /producto/stripper-fuenlabrada/ | 67924–67928 |
| Alcobendas | 67929 | /producto/stripper-alcobendas/ | 67930–67934 |
| Pozuelo de Alarcón | 67935 | /producto/stripper-pozuelo-de-alarcon/ | 67936–67940 |

### Media Library — Madrid Images
| ID | File | ALT Text |
|----|------|----------|
| 67871 | madrid-img-01.jpg | Stripper despedida soltera Madrid show integral 2026 |
| 67872 | madrid-img-02.jpg | Stripper domicilio Madrid actuación privada Airbnb 2026 |
| 67873 | madrid-img-03.jpg | Stripper Madrid show VIP camarera sexy hotel 2026 |
| 67874 | madrid-img-04.jpg | Stripper Madrid pack completo fiestas privadas 2026 |
| 67875 | madrid-img-05.jpg | Stripper boys masculino despedida soltera Madrid 2026 |
| 67876 | madrid-img-06.jpg | Stripper Madrid duo lesbico show privado 2026 |
| 67877 | madrid-img-07.jpg | Stripper Madrid artista lencería show domicilio 2026 |
| 67878 | madrid-img-08.jpg | Stripper show completo Madrid fur coat 2026 |
| 67879 | madrid-img-09.jpg | Stripper Madrid camarera sexy uniforme fiesta 2026 |
| 67880 | madrid-img-10.jpg | Stripper Madrid show integral despedida hotel 2026 |
| 67881 | madrid-img-11.jpg | Stripper Madrid duo artistas show premium 2026 |
| 67882 | madrid-img-12.jpg | Stripper Madrid show privado cumpleaños suite 2026 |
| 67883 | madrid-img-13.jpg | Stripper Getafe show privado fiesta sur Madrid 2026 |
| 67884 | madrid-img-14.jpg | Stripper Madrid artista VIP show exclusivo 2026 |
| 67885 | madrid-img-15.jpg | Stripper Alcorcón domicilio despedida oeste Madrid 2026 |
| 67886 | madrid-img-16.jpg | Stripper Fuenlabrada show striptease domicilio 2026 |
| 67887 | madrid-img-17.jpg | Stripper Alcalá Henares despedida soltera 2026 |
| 67888 | madrid-img-18.jpg | Stripper Pozuelo Alarcón chalé villa 2026 |
| 67889 | madrid-img-19.jpg | Stripper Alcobendas show privado norte Madrid 2026 |
| 67890 | madrid-img-20.jpg | Stripper Madrid centro show domicilio 2026 |
| 67891 | madrid-img-21.jpg | Stripper Madrid show completo bailarina fur coat encaje 2026 |

---

## 13. CADIZ REFERENCE IMPLEMENTATION

The `/stripper-cadiz/` page served as the original Gold Minimal Pro reference. Key elements observed:

- **Same CSS architecture**: inline `<style>` in `post_content`
- **Same hero pattern**: dark gradient + image overlay + badge + H1
- **Same card grid**: auto-fill minmax(240px, 1fr)
- **Same price table**: dark header + gold text for prices
- **Attribute**: `pa_municipio-cadiz` used for filtering
- **Category**: `contratar-stripper-en-cadiz-para-fiestas-despedidas` (ID 1717)

The design was successfully replicated to:
- Córdoba (pa_municipio-cordoba)
- Sevilla (pa_municipio-sevilla)
- Granada (pa_municipio-granada)
- Málaga (pa_municipio-malaga)
- Logroño (pa_comunidad-de-madrid area variant)
- **Madrid** ← current implementation (March 2026)

---

*Document generated: March 30, 2026*
*Espectáculos Luxury — https://espectaculosluxury.com*
