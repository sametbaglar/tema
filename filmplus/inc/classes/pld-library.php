<?php

if ( !class_exists( 'PLD_Library' ) ) {

	class PLD_Library {

		function __construct() {
		}

		function get_user_IP() {
			$client = @$_SERVER['HTTP_CLIENT_IP'];
			$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
			$remote = $_SERVER['REMOTE_ADDR'];

			if ( filter_var( $client, FILTER_VALIDATE_IP ) ) {
				$ip = $client;
			} elseif ( filter_var( $forward, FILTER_VALIDATE_IP ) ) {
				$ip = $forward;
			} else {
				$ip = $remote;
			}

			return $ip;
		}

	}

}