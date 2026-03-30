<?php
/**
 * Plugin Name: Luxury Disable wptexturize for custom landing pages
 * Description: Desactiva wptexturize para posts con contenido personalizado (IDs 67406 y similares)
 * Version: 1.0
 */

add_filter('run_wptexturize', function($run) {
    if (is_singular()) {
        global $post;
        $protected_ids = [67406]; // BCN landing
        if ($post && in_array($post->ID, $protected_ids)) {
            return false;
        }
    }
    return $run;
});
