<?php
/**
 * Plugin Name:  Lux Landing Builder
 * Plugin URI:   https://espectaculosluxury.com
 * Description:  Plantilla maestra para landing pages de provincia y productos de localidad. Usa el deployer para crear nuevas provincias a partir del patrón Barcelona 2026.
 * Version:      1.1.0
 * Author:       Espectáculos Luxury
 * Author URI:   https://espectaculosluxury.com
 * Text Domain:  lux-landing-builder
 * Requires PHP: 7.4
 *
 * ─────────────────────────────────────────────────────────────────────────────
 * ESTRUCTURA DEL PLUGIN
 * ─────────────────────────────────────────────────────────────────────────────
 *  lux-landing-builder/
 *  ├── lux-landing-builder.php   ← este archivo (bootstrap + admin UI)
 *  ├── deployer.php              ← script CLI/web para desplegar una provincia
 *  ├── templates/
 *  │   ├── landing.php           ← plantilla landing de provincia (parametrizable)
 *  │   └── product.php           ← plantilla producto de localidad (parametrizable)
 *  └── README.md
 *
 * CÓMO USAR
 * ─────────────────────────────────────────────────────────────────────────────
 *  1. Sube la carpeta completa a /wp-content/plugins/
 *  2. Activa el plugin desde el panel de WordPress
 *  3. Ve a "Lux Builder" en el menú de administración
 *  4. Rellena los datos de la nueva provincia y haz clic en "Desplegar"
 *     – O bien edita config_provincia.php manualmente y ejecuta deployer.php
 *       desde SSH: php deployer.php
 * ─────────────────────────────────────────────────────────────────────────────
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'LUX_BUILDER_VERSION', '1.1.0' );
define( 'LUX_BUILDER_DIR',     plugin_dir_path( __FILE__ ) );
define( 'LUX_BUILDER_URL',     plugin_dir_url( __FILE__ ) );

/* ─── Admin menu ──────────────────────────────────────────────────────────── */
add_action( 'admin_menu', function () {
    add_menu_page(
        'Lux Landing Builder',
        'Lux Builder',
        'manage_options',
        'lux-landing-builder',
        'lux_builder_admin_page',
        'dashicons-layout',
        56
    );
} );

/* ─── Admin page ──────────────────────────────────────────────────────────── */
function lux_builder_admin_page() {
    $message = '';
    $error   = '';

    if ( isset( $_POST['lux_deploy'] ) && check_admin_referer( 'lux_deploy_action' ) ) {
        $result = lux_builder_run_deployer( $_POST );
        if ( is_wp_error( $result ) ) {
            $error = $result->get_error_message();
        } else {
            $message = $result;
        }
    }

    // Load saved config if exists
    $cfg_file = LUX_BUILDER_DIR . 'config_provincia.json';
    $cfg      = file_exists( $cfg_file ) ? json_decode( file_get_contents( $cfg_file ), true ) : [];

    $prov_name     = $cfg['prov_name']     ?? 'Barcelona';
    $prov_slug     = $cfg['prov_slug']     ?? 'barcelona';
    $landing_id    = $cfg['landing_id']    ?? '';
    $cat_id        = $cfg['cat_id']        ?? '';
    $wa_phone      = $cfg['wa_phone']      ?? '34695858978';
    $wa_text       = $cfg['wa_text']       ?? 'Hola%2C+quiero+contratar+un+stripper';
    $phone_display = $cfg['phone_display'] ?? '695 858 978';
    $hero_image    = $cfg['hero_image']    ?? '';
    $years         = $cfg['years']         ?? '+15';
    $events        = $cfg['events']        ?? '+2.000';
    $base_url      = $cfg['base_url']      ?? 'https://espectaculosluxury.com/contratar-stripper-para-fiestas-y-despedidas-en-barcelona/';
    $localities_raw = $cfg['localities']   ?? '';

    ?>
    <div class="wrap">
        <h1>🏗 Lux Landing Builder <span style="font-size:.7em;color:#888">v<?php echo LUX_BUILDER_VERSION; ?></span></h1>
        <p style="color:#555">Despliega una nueva landing de provincia + 10 productos de localidad en un solo clic.<br>
        Basado en el patrón <strong>Barcelona 2026</strong> (landing v9 + productos de localidad v2).</p>

        <?php if ( $message ) : ?>
            <div class="notice notice-success is-dismissible"><pre style="white-space:pre-wrap;background:#f0f9f0;padding:12px;border-radius:4px"><?php echo esc_html( $message ); ?></pre></div>
        <?php endif; ?>
        <?php if ( $error ) : ?>
            <div class="notice notice-error is-dismissible"><p><?php echo esc_html( $error ); ?></p></div>
        <?php endif; ?>

        <form method="post" style="max-width:860px">
            <?php wp_nonce_field( 'lux_deploy_action' ); ?>
            <table class="form-table" role="presentation">

                <tr><th scope="row"><label for="prov_name">Provincia (nombre)</label></th>
                <td><input type="text" id="prov_name" name="prov_name" value="<?php echo esc_attr( $prov_name ); ?>" class="regular-text" required>
                <p class="description">Ej: Madrid, Sevilla, Valencia</p></td></tr>

                <tr><th scope="row"><label for="prov_slug">Slug de provincia</label></th>
                <td><input type="text" id="prov_slug" name="prov_slug" value="<?php echo esc_attr( $prov_slug ); ?>" class="regular-text" required>
                <p class="description">Ej: madrid, sevilla, valencia (minúsculas, sin tildes)</p></td></tr>

                <tr><th scope="row"><label for="landing_id">Post ID de la landing</label></th>
                <td><input type="number" id="landing_id" name="landing_id" value="<?php echo esc_attr( $landing_id ); ?>" class="small-text">
                <p class="description">ID del post/página WP donde se guardará el HTML de la landing. Dejar vacío para crear nueva.</p></td></tr>

                <tr><th scope="row"><label for="cat_id">Term ID de categoría WooCommerce</label></th>
                <td><input type="number" id="cat_id" name="cat_id" value="<?php echo esc_attr( $cat_id ); ?>" class="small-text" required>
                <p class="description">ID del term (product_cat) donde se crearán los productos de localidad.</p></td></tr>

                <tr><th scope="row"><label for="wa_phone">Número WhatsApp (con prefijo)</label></th>
                <td><input type="text" id="wa_phone" name="wa_phone" value="<?php echo esc_attr( $wa_phone ); ?>" class="regular-text">
                <p class="description">Ej: 34695858978</p></td></tr>

                <tr><th scope="row"><label for="wa_text">Texto WhatsApp (URL encoded)</label></th>
                <td><input type="text" id="wa_text" name="wa_text" value="<?php echo esc_attr( $wa_text ); ?>" class="large-text">
                <p class="description">Ej: Hola%2C+quiero+contratar+un+stripper+en+Sevilla</p></td></tr>

                <tr><th scope="row"><label for="phone_display">Número teléfono (visible)</label></th>
                <td><input type="text" id="phone_display" name="phone_display" value="<?php echo esc_attr( $phone_display ); ?>" class="regular-text">
                <p class="description">Ej: 695 858 978</p></td></tr>

                <tr><th scope="row"><label for="hero_image">URL imagen hero</label></th>
                <td><input type="url" id="hero_image" name="hero_image" value="<?php echo esc_attr( $hero_image ); ?>" class="large-text">
                <p class="description">URL completa de la imagen de fondo del hero (ya subida a la media library)</p></td></tr>

                <tr><th scope="row"><label for="years">Años de experiencia</label></th>
                <td><input type="text" id="years" name="years" value="<?php echo esc_attr( $years ); ?>" class="small-text">
                <p class="description">Ej: +15</p></td></tr>

                <tr><th scope="row"><label for="events">Eventos realizados</label></th>
                <td><input type="text" id="events" name="events" value="<?php echo esc_attr( $events ); ?>" class="small-text">
                <p class="description">Ej: +2.000</p></td></tr>

                <tr><th scope="row"><label for="base_url">URL base categoría</label></th>
                <td><input type="url" id="base_url" name="base_url" value="<?php echo esc_attr( $base_url ); ?>" class="large-text">
                <p class="description">URL base donde se alojan los productos de localidad (con barra final)</p></td></tr>

                <tr><th scope="row"><label for="localities_raw">Localidades (JSON)</label></th>
                <td>
                <textarea id="localities_raw" name="localities_raw" rows="16" class="large-text" style="font-family:monospace;font-size:12px"><?php echo esc_textarea( $localities_raw ?: lux_builder_default_localities_json() ); ?></textarea>
                <p class="description">Array JSON de localidades. Ver formato en el README. Puedes cambiar todas las ciudades para otra provincia.</p></td></tr>

            </table>

            <p class="submit">
                <button type="submit" name="lux_deploy" class="button button-primary button-hero">
                    🚀 Desplegar Provincia
                </button>
                &nbsp;&nbsp;
                <a href="<?php echo esc_url( LUX_BUILDER_URL . 'README.md' ); ?>" class="button" target="_blank">📖 README</a>
            </p>
        </form>

        <hr>
        <h2>📋 Patrón Barcelona (referencia)</h2>
        <table class="widefat fixed" style="max-width:860px">
            <thead><tr><th>Elemento</th><th>Valor</th></tr></thead>
            <tbody>
                <tr><td>Landing post ID</td><td>67406</td></tr>
                <tr><td>Categoría WooCommerce</td><td>1824 — contratar-stripper-para-fiestas-y-despedidas-en-barcelona</td></tr>
                <tr><td>URL landing</td><td><a href="https://espectaculosluxury.com/stripper-barcelona/" target="_blank">https://espectaculosluxury.com/stripper-barcelona/</a></td></tr>
                <tr><td>Imágenes</td><td>bcn-stripper-01.jpg … bcn-stripper-15.jpg (IDs 67959–67973)</td></tr>
                <tr><td>Productos localidad</td><td>IDs 68317–68326 (10 localidades)</td></tr>
                <tr><td>Pull Request</td><td><a href="https://github.com/espectaculosluxury-cmd/luxurysss/pull/1" target="_blank">PR #1 — feat(barcelona)</a></td></tr>
            </tbody>
        </table>

        <hr>
        <h2>🗺️ Índice de Provincias — "También actuamos en otras ciudades"</h2>
        <p style="color:#555;max-width:700px">
            Esta lista se muestra automáticamente al final del CTA de <strong>cada landing y producto</strong>
            como la sección <em>"También actuamos en otras ciudades"</em>.
            Se actualiza sola cada vez que haces un deploy. También puedes añadir o borrar entradas manualmente aquí.
        </p>

        <?php
        $province_index = lux_get_all_provinces();
        ?>

        <?php if ( ! empty($province_index) ) : ?>
        <table class="widefat fixed" style="max-width:860px;margin-bottom:20px">
            <thead><tr><th style="width:25%">Nombre</th><th style="width:20%">Slug</th><th>URL Landing</th><th style="width:80px">Borrar</th></tr></thead>
            <tbody>
            <?php foreach ( $province_index as $p ) : ?>
                <tr>
                    <td><?php echo esc_html($p['name']); ?></td>
                    <td><code><?php echo esc_html($p['slug']); ?></code></td>
                    <td><a href="<?php echo esc_url($p['url']); ?>" target="_blank"><?php echo esc_html($p['url']); ?></a></td>
                    <td>
                        <form method="post" style="margin:0" onsubmit="return confirm('¿Eliminar <?php echo esc_attr($p['name']); ?>?')">
                            <?php wp_nonce_field('lux_province_index_action'); ?>
                            <input type="hidden" name="lux_province_action" value="remove">
                            <input type="hidden" name="pi_slug_remove" value="<?php echo esc_attr($p['slug']); ?>">
                            <button type="submit" class="button button-small" style="color:#cc1818;border-color:#cc1818">✕</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php else : ?>
            <p style="color:#999"><em>Sin provincias registradas aún. Se crearán automáticamente con cada deploy.</em></p>
        <?php endif; ?>

        <h3>➕ Añadir provincia manualmente</h3>
        <form method="post" style="max-width:860px;background:#f9f6f0;padding:16px 20px;border-radius:6px;border:1px solid #e0d8c8">
            <?php wp_nonce_field('lux_province_index_action'); ?>
            <input type="hidden" name="lux_province_action" value="add">
            <table class="form-table" role="presentation" style="margin:0">
                <tr>
                    <th style="width:160px"><label for="pi_name">Nombre</label></th>
                    <td><input type="text" id="pi_name" name="pi_name" class="regular-text" placeholder="Ej: Sevilla" required></td>
                </tr>
                <tr>
                    <th><label for="pi_slug">Slug</label></th>
                    <td><input type="text" id="pi_slug" name="pi_slug" class="regular-text" placeholder="Ej: sevilla" required>
                    <p class="description">Minúsculas sin tildes, igual que el slug de la landing.</p></td>
                </tr>
                <tr>
                    <th><label for="pi_url">URL Landing</label></th>
                    <td><input type="url" id="pi_url" name="pi_url" class="large-text" placeholder="https://espectaculosluxury.com/stripper-sevilla/" required></td>
                </tr>
            </table>
            <p style="margin-top:14px">
                <button type="submit" class="button button-secondary">➕ Añadir al índice</button>
            </p>
        </form>

    </div>
    <?php
}

/* ─── Deploy runner ───────────────────────────────────────────────────────── */
function lux_builder_run_deployer( $post_data ) {
    $cfg = [
        'prov_name'     => sanitize_text_field( $post_data['prov_name'] ?? '' ),
        'prov_slug'     => sanitize_title( $post_data['prov_slug'] ?? '' ),
        'landing_id'    => absint( $post_data['landing_id'] ?? 0 ),
        'cat_id'        => absint( $post_data['cat_id'] ?? 0 ),
        'wa_phone'      => sanitize_text_field( $post_data['wa_phone'] ?? '34695858978' ),
        'wa_text'       => sanitize_text_field( $post_data['wa_text'] ?? '' ),
        'phone_display' => sanitize_text_field( $post_data['phone_display'] ?? '695 858 978' ),
        'hero_image'    => esc_url_raw( $post_data['hero_image'] ?? '' ),
        'years'         => sanitize_text_field( $post_data['years'] ?? '+15' ),
        'events'        => sanitize_text_field( $post_data['events'] ?? '+2.000' ),
        'base_url'      => trailingslashit( esc_url_raw( $post_data['base_url'] ?? '' ) ),
        'localities'    => $post_data['localities_raw'] ?? '',
    ];

    if ( ! $cfg['prov_name'] || ! $cfg['prov_slug'] || ! $cfg['cat_id'] ) {
        return new WP_Error( 'missing_fields', 'Provincia, slug y cat_id son obligatorios.' );
    }

    // Save config to JSON for reference
    file_put_contents( LUX_BUILDER_DIR . 'config_provincia.json', json_encode( $cfg, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );

    // Parse localities JSON
    $localities = json_decode( $cfg['localities'], true );
    if ( ! is_array( $localities ) ) {
        return new WP_Error( 'invalid_json', 'El JSON de localidades no es válido.' );
    }

    // Load template files
    $landing_tpl = LUX_BUILDER_DIR . 'templates/landing.php';
    $product_tpl = LUX_BUILDER_DIR . 'templates/product.php';

    if ( ! file_exists( $landing_tpl ) || ! file_exists( $product_tpl ) ) {
        return new WP_Error( 'missing_templates', 'Faltan templates/landing.php o templates/product.php.' );
    }

    ob_start();
    require LUX_BUILDER_DIR . 'deployer.php';
    return ob_get_clean();
}

/* ─── Province index (lux_provinces_index) ────────────────────────────────── *
 *
 *  WP option 'lux_provinces_index' = array of:
 *    [ 'name' => 'Barcelona', 'slug' => 'barcelona', 'url' => 'https://…/stripper-barcelona/' ]
 *
 *  Automatically populated every time the deployer runs.
 *  Templates call lux_get_all_provinces() to render the "También actuamos" block.
 * ─────────────────────────────────────────────────────────────────────────── */

/**
 * Register (or refresh) a province in the global index.
 * Called from deployer.php after a successful landing deploy.
 *
 * @param string $name  Province display name, e.g. "Barcelona"
 * @param string $slug  Province slug, e.g. "barcelona"
 * @param string $url   Canonical landing URL (with trailing slash)
 */
function lux_register_province( $name, $slug, $url ) {
    $index = get_option( 'lux_provinces_index', [] );
    if ( ! is_array($index) ) { $index = []; }

    // Update existing entry or add new
    $found = false;
    foreach ( $index as &$entry ) {
        if ( $entry['slug'] === $slug ) {
            $entry['name'] = $name;
            $entry['url']  = $url;
            $found = true;
            break;
        }
    }
    unset($entry);
    if ( ! $found ) {
        $index[] = [ 'name' => $name, 'slug' => $slug, 'url' => $url ];
    }

    // Sort alphabetically by name
    usort( $index, fn($a,$b) => strcmp($a['name'], $b['name']) );

    update_option( 'lux_provinces_index', $index, false );
}

/**
 * Get all registered provinces as a sorted array.
 * Returns: [ ['name'=>…, 'slug'=>…, 'url'=>…], … ]
 * Falls back to the two provinces we know exist if option is empty.
 */
function lux_get_all_provinces() {
    $index = get_option( 'lux_provinces_index', [] );
    if ( ! is_array($index) || empty($index) ) {
        // Fallback: hardcoded known provinces so the block is never empty
        $site = function_exists('get_site_url') ? get_site_url() : 'https://espectaculosluxury.com';
        $index = [
            [ 'name' => 'Barcelona', 'slug' => 'barcelona', 'url' => $site . '/stripper-barcelona/' ],
            [ 'name' => 'Madrid',    'slug' => 'madrid',    'url' => $site . '/stripper-madrid/'    ],
        ];
    }
    return $index;
}

/**
 * Generate the "También actuamos en otras ciudades" HTML block.
 * Excludes the current province ($current_slug) from the list.
 *
 * @param string $current_slug  Slug of the current page's province (to exclude self-link)
 * @param string $theme         'dark' | 'light'  (CTA bg dark = dark, product page = light)
 * @return string HTML
 */
function lux_other_cities_block( $current_slug = '', $theme = 'dark' ) {
    $provinces = lux_get_all_provinces();

    // Filter out current province
    $others = array_filter( $provinces, fn($p) => $p['slug'] !== $current_slug );
    if ( empty($others) ) { return ''; }

    if ( $theme === 'dark' ) {
        // Over a dark CTA background
        $wrap_style  = 'margin-top:36px;padding-top:28px;border-top:1px solid rgba(255,255,255,.12);text-align:center;';
        $label_style = 'display:block;font-size:.74rem;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.45);margin-bottom:14px;font-weight:600;';
        $list_style  = 'display:flex;flex-wrap:wrap;gap:8px 10px;justify-content:center;';
        $link_style  = 'color:rgba(255,255,255,.70);text-decoration:none;padding:6px 16px;border:1px solid rgba(255,255,255,.25);border-radius:20px;font-size:.80rem;transition:all .2s;';
    } else {
        // Light background (product pages)
        $wrap_style  = 'margin-top:32px;padding:24px 20px;background:#f9f6f0;border-radius:12px;border:1px solid #e8e0d0;text-align:center;';
        $label_style = 'display:block;font-size:.74rem;letter-spacing:.12em;text-transform:uppercase;color:#c8a96e;font-weight:700;margin-bottom:14px;';
        $list_style  = 'display:flex;flex-wrap:wrap;gap:8px 10px;justify-content:center;';
        $link_style  = 'color:#c8a96e;text-decoration:none;padding:6px 16px;border:1px solid #c8a96e;border-radius:20px;font-size:.80rem;';
    }

    $html  = '<div style="' . $wrap_style . '">';
    $html .= '<span style="' . $label_style . '">🗺️ También actuamos en otras ciudades</span>';
    $html .= '<div style="' . $list_style . '">';
    foreach ( $others as $p ) {
        $html .= '<a href="' . esc_url($p['url']) . '" style="' . $link_style . '" rel="nofollow">'
               . esc_html($p['name']) . '</a>';
    }
    $html .= '</div></div>';
    return $html;
}

/* ─── Admin page: Province Index panel ────────────────────────────────────── */
add_action( 'admin_init', function () {
    // Handle manual add/remove from the admin panel
    if ( isset($_POST['lux_province_action']) && check_admin_referer('lux_province_index_action') ) {
        if ( $_POST['lux_province_action'] === 'add' ) {
            $name = sanitize_text_field( $_POST['pi_name'] ?? '' );
            $slug = sanitize_title( $_POST['pi_slug'] ?? '' );
            $url  = esc_url_raw( $_POST['pi_url']  ?? '' );
            if ( $name && $slug && $url ) {
                lux_register_province( $name, $slug, $url );
            }
        } elseif ( $_POST['lux_province_action'] === 'remove' ) {
            $slug  = sanitize_title( $_POST['pi_slug_remove'] ?? '' );
            $index = get_option( 'lux_provinces_index', [] );
            $index = array_values( array_filter( $index, fn($p) => $p['slug'] !== $slug ) );
            update_option( 'lux_provinces_index', $index, false );
        }
    }
} );

/* ─── Default localities JSON ─────────────────────────────────────────────── */
function lux_builder_default_localities_json() {
    $data = [
        [ "key" => "hospitalet",    "slug" => "stripper-hospitalet-de-llobregat-producto",  "city" => "Hospitalet de Llobregat", "cs" => "Hospitalet",    "dist" => "5 km",  "barrios" => "Centre, Bellvitge, Santa Eulàlia, Gornal" ],
        [ "key" => "badalona",      "slug" => "stripper-badalona-producto",                  "city" => "Badalona",                "cs" => "Badalona",      "dist" => "8 km",  "barrios" => "Centre, La Salut, Morera, Lloreda" ],
        [ "key" => "cornella",      "slug" => "stripper-cornella-de-llobregat-producto",     "city" => "Cornellà de Llobregat",   "cs" => "Cornellà",      "dist" => "10 km", "barrios" => "Centre, Sant Ildefons, Almeda, Gavarra" ],
        [ "key" => "sant_cugat",    "slug" => "stripper-sant-cugat-del-valles-producto",     "city" => "Sant Cugat del Vallès",   "cs" => "Sant Cugat",    "dist" => "18 km", "barrios" => "Centre, Mirasol, Volpelleres, Torreblanca" ],
        [ "key" => "sabadell",      "slug" => "stripper-sabadell-producto",                  "city" => "Sabadell",                "cs" => "Sabadell",      "dist" => "22 km", "barrios" => "Centre, Can Puiggener, Torre-romeu, Gràcia" ],
        [ "key" => "terrassa",      "slug" => "stripper-terrassa-producto",                  "city" => "Terrassa",                "cs" => "Terrassa",      "dist" => "30 km", "barrios" => "Centre, Sant Pere, Ègara, Roc Blanc" ],
        [ "key" => "sitges",        "slug" => "stripper-sitges-producto",                    "city" => "Sitges",                  "cs" => "Sitges",        "dist" => "35 km", "barrios" => "Centre Històric, Vinyet, Quint Mar" ],
        [ "key" => "castelldefels", "slug" => "stripper-castelldefels-producto",             "city" => "Castelldefels",           "cs" => "Castelldefels", "dist" => "25 km", "barrios" => "Centre, Castelldefels Platja, Can Bou, Montemar" ],
        [ "key" => "mataro",        "slug" => "stripper-mataro-producto",                    "city" => "Mataró",                  "cs" => "Mataró",        "dist" => "30 km", "barrios" => "Centre, Cirera, Molins, Rocafonda" ],
        [ "key" => "santacoloma",   "slug" => "stripper-santa-coloma-de-gramenet-producto",  "city" => "Santa Coloma de Gramenet","cs" => "Santa Coloma",  "dist" => "10 km", "barrios" => "Centre, Riu Nord, Fondo, Singuerlín" ],
    ];
    return json_encode( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
}
