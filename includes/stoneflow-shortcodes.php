<?php
// stoneflow-shortcodes.php

if ( ! function_exists( 'stoneflow_display_client_dashboard' ) ) {
    function stoneflow_display_client_dashboard() {
        return stoneflow_render_client_dashboard();
    }
}

add_shortcode( 'stoneflow_client_dashboard', 'stoneflow_display_client_dashboard' );
