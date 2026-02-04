<?php

if ( !class_exists( 'PLD_Hooks' ) ) {

    class PLD_Hooks extends PLD_Library {

        function __construct() {
            parent::__construct();
            add_filter( 'post_like_dislike_content', array( $this, 'posts_like_dislike' ), 200 );
            add_action( 'pld_like_dislike_output', array( $this, 'generate_like_dislike_html' ), 10 );
        }

        function posts_like_dislike( $content ) {

            global $post;
            if ( empty( $post ) ) {
                return $content;
            }
            if ( $post->post_type != 'post' ) {
                return $content;
            }
            if ( is_admin() ) {
                return $content;
            }
            ob_start();

            do_action( 'pld_like_dislike_output', $content );

            $like_dislike_html = ob_get_contents();
            ob_end_clean();
            $content .= apply_filters( 'pld_like_dislike_html', $like_dislike_html);
            return $content;
        }

        function generate_like_dislike_html( $content ) {
            include(PLD_PATH . '/inc/pld/like-dislike-html.php');
        }

    }

    new PLD_Hooks();
}