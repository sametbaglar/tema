<?php

if ( !class_exists( 'PLD_Ajax' ) ) {

    class PLD_Ajax extends PLD_Library {

        function __construct() {
            add_action( 'wp_ajax_pld_post_ajax_action', array( $this, 'like_dislike_action' ) );
            add_action( 'wp_ajax_nopriv_pld_post_ajax_action', array( $this, 'like_dislike_action' ) );
        }

        function like_dislike_action() {
            if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'pld-ajax-nonce' ) ) {
                $post_id = sanitize_text_field( $_POST['post_id'] );
                do_action( 'pld_before_ajax_process', $post_id );
                $type = sanitize_text_field( $_POST['type'] );
                $user_ip = $this->get_user_IP();
                if ( $type == 'like' ) {
                    $like_count = get_post_meta( $post_id, 'pld_like_count', true );
                    if ( empty( $like_count ) ) {
                        $like_count = 0;
                    }
                    $like_count = $like_count + 1;
                    $check = update_post_meta( $post_id, 'pld_like_count', $like_count );

                    if ( $check ) {

                        $response_array = array( 'success' => true, 'latest_count' => '('.$like_count.')' );
                    } else {
                        $response_array = array( 'success' => false, 'latest_count' => '('.$like_count.')' );
                    }
                } else {
                    $dislike_count = get_post_meta( $post_id, 'pld_dislike_count', true );
                    if ( empty( $dislike_count ) ) {
                        $dislike_count = 0;
                    }
                    $dislike_count = $dislike_count + 1;
                    $check = update_post_meta( $post_id, 'pld_dislike_count', $dislike_count );
                    if ( $check ) {
                        $response_array = array( 'success' => true, 'latest_count' => '('.$dislike_count.')' );
                    } else {
                        $response_array = array( 'success' => false, 'latest_count' =>  '('.$dislike_count.')' );
                    }
                }
                $liked_ips = get_post_meta( $post_id, 'pld_ips', true );
                $liked_ips = (empty( $liked_ips )) ? array() : $liked_ips;
                if ( !in_array( $user_ip, $liked_ips ) ) {
                    $liked_ips[] = $user_ip;
                }

                update_post_meta( $post_id, 'pld_ips', $liked_ips );
                do_action( 'pld_after_ajax_process', $post_id );
                echo json_encode( $response_array );
                die();
            } else {
                die( 'No script kiddies please!' );
            }
        }

    }

    new PLD_Ajax();
}