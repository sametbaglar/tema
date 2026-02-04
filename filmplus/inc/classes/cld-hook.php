<?php

if ( !class_exists( 'CLD_Comments_Hooks' ) ) {

	class CLD_Comments_Hooks extends CLD_Library {

		function __construct() {
			parent::__construct();
			add_filter( 'comment_text', array( $this, 'comments_like_dislike' ), 20, 2 );
			add_action( 'cld_like_dislike_output', array( $this, 'generate_like_dislike_html' ), 10, 2 );
		}

		function comments_like_dislike( $comment_text, $comment = null ) {
			
			if ( is_admin() ) {
				return $comment_text;
			}
			ob_start();

			do_action( 'cld_like_dislike_output', $comment_text, $comment );

			$like_dislike_html = ob_get_contents();
			ob_end_clean();
			$comment_text .= apply_filters( 'cld_like_dislike_html', $like_dislike_html);
			return $comment_text;
		}

		function generate_like_dislike_html( $comment_text, $comment ) {
			include(CLD_PATH . '/inc/cld/like-dislike-html.php');
		}

	}

	new CLD_Comments_Hooks();
}