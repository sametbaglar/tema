<?php

if ( !class_exists( 'CLD_Enqueue' ) ) {

	class CLD_Enqueue {

		function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'register_frontend_assets' ) );
		}

		function register_frontend_assets() {
			wp_enqueue_script( 'cld-frontend', get_stylesheet_directory_uri() . '/js/cld.js', '','',true );
			$ajax_nonce = wp_create_nonce( 'cld-ajax-nonce' );
			$js_object = array( 'admin_ajax_url' => admin_url( 'admin-ajax.php' ), 'admin_ajax_nonce' => $ajax_nonce );
			wp_localize_script( 'cld-frontend', 'cld_js_object', $js_object );
		}

	}

	new CLD_Enqueue();
}