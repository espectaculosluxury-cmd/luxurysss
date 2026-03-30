# Lux Landing Builder — Plugin WordPress
**Versión:** 1.0.0 | **Patrón:** Barcelona 2026

## ¿Qué hace este plugin?

Genera automáticamente:
1. **Una landing page de provincia** (HTML completo, idéntico al patrón BCN landing v9)
2. **Los productos de localidad** (hasta N ciudades/barrios, patrón locality_products_v2)

Todo en un clic desde el panel de WordPress, o por SSH con `php deployer.php`.

---

## Instalación

1. Sube la carpeta `lux-landing-builder/` a `/wp-content/plugins/`
2. Activa el plugin desde **Panel WP → Plugins**
3. Ve a **Lux Builder** en el menú lateral

---

## Estructura de archivos

```
lux-landing-builder/
├── lux-landing-builder.php   ← Bootstrap + interfaz de administración WP
├── deployer.php              ← Motor de despliegue (admin + standalone)
├── templates/
│   ├── landing.php           ← Plantilla HTML landing de provincia (parametrizable)
│   └── product.php           ← Plantilla HTML producto de localidad (parametrizable)
├── config_provincia.json     ← (se genera automáticamente al desplegar)
└── README.md
```

---

## Uso desde el Panel WP

### Campos del formulario

| Campo | Descripción | Ejemplo BCN |
|-------|-------------|-------------|
| **Provincia (nombre)** | Nombre visible en el HTML | `Barcelona` |
| **Slug de provincia** | Slug URL (minúsculas, sin tildes) | `barcelona` |
| **Post ID de la landing** | ID del post WP existente, o vacío para crear nuevo | `67406` |
| **Term ID categoría WC** | ID del term `product_cat` de WooCommerce | `1824` |
| **Número WhatsApp** | Con prefijo de país, sin `+` | `34695858978` |
| **Texto WhatsApp** | URL-encoded | `Hola%2C+quiero+contratar+un+stripper+en+Barcelona` |
| **Número teléfono visible** | Formato legible | `695 858 978` |
| **URL imagen hero** | URL completa de la imagen ya subida a WP | `https://…/bcn-stripper-01.jpg` |
| **Años de experiencia** | Texto libre | `+15` |
| **Eventos realizados** | Texto libre | `+2.000` |
| **URL base categoría** | URL con barra final | `https://espectaculosluxury.com/contratar-stripper-…/` |
| **Localidades (JSON)** | Ver formato abajo | (ver ejemplo) |

---

## Formato JSON de localidades

```json
[
  {
    "key":     "hospitalet",
    "slug":    "stripper-hospitalet-de-llobregat-producto",
    "city":    "Hospitalet de Llobregat",
    "cs":      "Hospitalet",
    "dist":    "5 km",
    "barrios": "Centre, Bellvitge, Santa Eulàlia, Gornal"
  },
  {
    "key":     "badalona",
    "slug":    "stripper-badalona-producto",
    "city":    "Badalona",
    "cs":      "Badalona",
    "dist":    "8 km",
    "barrios": "Centre, La Salut, Morera, Lloreda"
  }
]
```

### Claves requeridas por localidad

| Clave | Descripción |
|-------|-------------|
| `key` | Identificador interno único (minúsculas, sin tildes) |
| `slug` | Slug del producto WooCommerce |
| `city` | Nombre completo de la ciudad |
| `cs` | Nombre corto (para usar en textos) |
| `dist` | Distancia a la capital de provincia |
| `barrios` | Lista de barrios principales (texto) |

---

## Configuración avanzada en JSON

Además de los campos básicos, `config_provincia.json` acepta:

```json
{
  "prov_name":     "Sevilla",
  "prov_slug":     "sevilla",
  "landing_id":    12345,
  "cat_id":        9876,
  "wa_phone":      "34695858978",
  "wa_text":       "Hola%2C+quiero+contratar+un+stripper+en+Sevilla",
  "phone_display": "695 858 978",
  "hero_image":    "https://…/sevilla-stripper-01.jpg",
  "years":         "+15",
  "events":        "+2.000",
  "base_url":      "https://espectaculosluxury.com/contratar-stripper-sevilla/",
  "localities":    "[…JSON de localidades…]",

  "show_images": {
    "integral":  "https://…/sev-stripper-01.jpg",
    "lesbico":   "https://…/sev-stripper-08.jpg",
    "juguete":   "https://…/sev-stripper-10.jpg",
    "camarera":  "https://…/sev-stripper-05.jpg",
    "pack":      "https://…/sev-stripper-06.jpg",
    "masculino": "https://…/sev-stripper-14.jpg",
    "despedida": "https://…/sev-stripper-02.jpg",
    "cumple":    "https://…/sev-stripper-15.jpg",
    "domicilio": "https://…/sev-stripper-11.jpg",
    "duo_alt":   "https://…/sev-stripper-09.jpg"
  },

  "image_map": {
    "stripper-triana-producto": {
      "featured": "https://…/sev-stripper-03.jpg",
      "gallery":  ["https://…/sev-stripper-04.jpg", "https://…/sev-stripper-05.jpg"]
    }
  },

  "nightlife": [
    { "name": "Macao", "url": "https://macaoclub.com/", "zona": "Alameda", "tipo": "Discoteca" }
  ],

  "hotels": [
    { "name": "Hotel Alfonso XIII", "url": "https://www.hotelalmaterrafirmese.es/" }
  ],

  "reviews": [
    {
      "stars": 5,
      "text": "Show increíble para la despedida de mi amiga en Sevilla.",
      "author": "Ana P.",
      "location": "Sevilla",
      "event": "Despedida de soltera",
      "date": "Feb 2026"
    }
  ]
}
```

---

## Uso por SSH (CLI)

```bash
cd /var/www/vhosts/espectaculosluxury.com/httpdocs/wp-content/plugins/lux-landing-builder/
php deployer.php --config=config_provincia.json
```

---

## Pasos para desplegar una nueva provincia

### 1. Preparar en WooCommerce
- Crear la categoría de producto para la nueva provincia
- Anotar el **Term ID** de esa categoría

### 2. Preparar las imágenes
- Subir las imágenes de las artistas a la Media Library de WP
- Anotar las URLs completas

### 3. Crear/identificar la landing page
- Si ya existe un post/página, anotar su **Post ID**
- Si no, dejar vacío para que el deployer cree uno nuevo

### 4. Rellenar el formulario
- Ir a **Lux Builder** en el panel WP
- Rellenar todos los campos
- Ajustar el JSON de localidades con las ciudades/municipios de la nueva provincia

### 5. Desplegar
- Clic en **🚀 Desplegar Provincia**
- Verificar el log de resultados
- Comprobar la URL de la landing y los productos

### 6. Post-deploy
- Actualizar el mu-plugin de rewrite si es necesario
- Configurar RankMath para la landing (canonical, OG image)
- Añadir la nueva provincia al menú de navegación

---

## Referencia Barcelona (patrón original)

| Elemento | Valor |
|----------|-------|
| Post ID landing | `67406` |
| URL landing | `https://espectaculosluxury.com/stripper-barcelona/` |
| Cat ID WooCommerce | `1824` |
| Productos localidad | IDs 68317–68326 (10 ciudades) |
| Imágenes | bcn-stripper-01.jpg … bcn-stripper-15.jpg |
| Media IDs | 67959–67973 |
| Pull Request | [PR #1](https://github.com/espectaculosluxury-cmd/luxurysss/pull/1) |

---

## Personalización de templates

Los archivos `templates/landing.php` y `templates/product.php` son PHP puro.
Puedes editarlos directamente para:

- Cambiar los textos de los shows (precios, descripciones)
- Añadir/quitar secciones
- Modificar la tabla de locales nocturnos predeterminada
- Cambiar el esquema de colores (variables CSS `#c8a96e`, `#e0bc6a`)
- Añadir secciones específicas de provincia (playas, barrios típicos, etc.)

> ⚠️ **No cambies el prefijo CSS `#lx9`** — tiene especificidad 110 que garantiza
> que los estilos del tema no interfieran. Si cambias el prefijo, actualiza también
> el `<div id="lx9">` del wrapper en `landing.php`.

---

## Changelog

### v1.0.0 (2026-03-30)
- Primera versión
- Patrón extraído de Barcelona landing v9 + locality products v2
- Admin UI con formulario de configuración
- Deployer standalone (SSH/CLI)
- Templates parametrizables para landing y productos
- Soporte para image_map, nightlife, hotels, reviews personalizados
