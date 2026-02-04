<?php

if ( !class_exists( 'PLD_Enqueue' ) ) {

    class PLD_Enqueue {

        function __construct() {
            add_action( 'wp_enqueue_scripts', array( $this, 'register_frontend_assets' ) );
        }

        function register_frontend_assets() {
            wp_enqueue_script( 'pld-frontend', get_stylesheet_directory_uri() . '/js/pld.js', '','',true );
            $ajax_nonce = wp_create_nonce( 'pld-ajax-nonce' );
            $js_object = array( 'admin_ajax_url' => admin_url( 'admin-ajax.php' ), 'admin_ajax_nonce' => $ajax_nonce );
            wp_localize_script( 'pld-frontend', 'pld_js_object', $js_object );
        }

    }

    new PLD_Enqueue();
}