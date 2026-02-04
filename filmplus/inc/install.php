<?php
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
	add_action('init', 'filmplus_install', 1);
	add_action('admin_footer','removed_widgets');
}
function filmplus_install() {
	global $wp_rewrite;
	filmplus_page_install();
	update_option('users_can_register', 0);
	$wp_rewrite->flush_rules();
}
function filmplus_page_install() {
	global $wpdb;
   	$post_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'simple-contact-form';");
    if (!$post_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'wpforms',
	        'post_author' => 1,
	        'post_name' => 'simple-contact-form',
	        'post_title' => __('İletişim Formu', 'filmplus'),
			'ping_status' => 'closed',
			'comment_status' => 'closed',
        );
		$post_id = wp_insert_post($my_page);
		$string = '{"id":"'.$post_id.'","field_id":3,"fields":[{"id":"0","type":"name","label":"Ad\u0131n\u0131z","format":"simple","description":"","required":"1","size":"medium","simple_placeholder":"Ad\u0131n\u0131z*","simple_default":"","first_placeholder":"","first_default":"","middle_placeholder":"","middle_default":"","last_placeholder":"","last_default":"","label_hide":"1","css":""},{"id":"1","type":"email","label":"E-mail Adresiniz","description":"","required":"1","size":"medium","placeholder":"E-mail Adresiniz*","confirmation_placeholder":"","label_hide":"1","default_value":"","css":""},{"id":"2","type":"textarea","label":"Mesaj\u0131n\u0131z","description":"","required":"1","size":"medium","placeholder":"Mesaj\u0131n\u0131z*","label_hide":"1","css":""}],"settings":{"form_title":"\u0130leti\u015fim Formu","form_desc":"","form_class":"","submit_text":"G\u00f6nder","submit_text_processing":"G\u00f6nderiliyor...","submit_class":"","honeypot":"1","recaptcha":"1","notification_enable":"1","notifications":{"1":{"email":"{admin_email}","subject":"\u0130leti\u015fim Formundan Yeni Mesaj","sender_name":"'.get_bloginfo( 'name' ).'","sender_address":"{admin_email}","replyto":"{field_id=\"1\"}","message":"{all_fields}"}},"confirmations":{"1":{"type":"message","message":"<p>Mesaj\u0131n\u0131z bize ula\u015ft\u0131, te\u015fekk\u00fcrler.<\/p>","message_scroll":"1","page":"9","redirect":""}}},"meta":{"template":"contact"}}';
		$my_post = array();
		$my_post['ID'] = $post_id;
		$my_post['post_content'] = addslashes($string);
        wp_update_post( $my_post );
		update_option('filmplus_iletisim_form_post_id', $post_id);
    } else {
    	update_option('filmplus_iletisim_form_post_id', $post_id);
    }
   	$post_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'blank-form';");
    if (!$post_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'wpforms',
	        'post_author' => 1,
	        'post_name' => 'blank-form',
	        'post_title' => __('Hata Bildir', 'filmplus'),
			'ping_status' => 'closed',
			'comment_status' => 'closed',
        );
		$post_id = wp_insert_post($my_page);
		$string = '{"id":"'.$post_id.'","field_id":2,"fields":{"1":{"id":"1","type":"textarea","label":"Ald\u0131\u011f\u0131n\u0131z Hata Nedir?","description":"","required":"1","size":"medium","placeholder":"Ald\u0131\u011f\u0131n\u0131z Hata Nedir?*","label_hide":"1","limit_count":"1","limit_mode":"characters","default_value":"","css":""}},"settings":{"form_title":"Hata Bildir","form_desc":"","form_class":"","submit_text":"G\u00f6nder","submit_text_processing":"G\u00f6nderiliyor...","submit_class":"","honeypot":"1","recaptcha":"1","notification_enable":"1","notifications":{"1":{"email":"{admin_email}","subject":"Yeni Hata Bildirimi","sender_name":"'.get_bloginfo( 'name' ).'","sender_address":"{admin_email}","replyto":"","message":"{all_fields}\r\n{page_title}"}},"confirmations":{"1":{"type":"message","message":"<p>Bildiriminiz i\u00e7in te\u015fekk\u00fcrler!<\/p>","message_scroll":"1","page":"513","redirect":""}}},"meta":{"template":"blank"}}';
		$my_post = array();
		$my_post['ID'] = $post_id;
		$my_post['post_content'] = addslashes($string);
        wp_update_post( $my_post );
		update_option('filmplus_hata_bildir_form_post_id', $post_id);
    } else {
    	update_option('filmplus_hata_bildir_form_post_id', $post_id);
    }
   	$page_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'profil-duzenle';");
    if (!$page_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'page',
	        'post_author' => 1,
	        'post_name' => 'profil-duzenle',
	        'post_title' => __('Profil Düzenle', 'filmplus')
        );
		$page_id = wp_insert_post($my_page);
        update_post_meta($page_id, '_wp_page_template', 'profiledit.php');
        update_option('filmplus_profilduzenle_page_id', $page_id);
    } else {
   		update_post_meta($page_id, '_wp_page_template', 'profiledit.php');
    	update_option('filmplus_profilduzenle_page_id', $page_id);
    }
   	$page_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'turkce-dublaj-filmler';");
    if (!$page_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'page',
	        'post_author' => 1,
	        'post_name' => 'turkce-dublaj-filmler',
	        'post_title' => __('Türkçe Dublaj Filmler', 'filmplus')
        );
		$page_id = wp_insert_post($my_page);
        update_post_meta($page_id, '_wp_page_template', 'dublaj.php');
        update_option('filmplus_dublaj_page_id', $page_id);
    } else {
   		update_post_meta($page_id, '_wp_page_template', 'dublaj.php');
    	update_option('filmplus_dublaj_page_id', $page_id);
    }
   	$page_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'turkce-altyazili-filmler';");
    if (!$page_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'page',
	        'post_author' => 1,
	        'post_name' => 'turkce-altyazili-filmler',
	        'post_title' => __('Türkçe Altyazılı Filmler', 'filmplus')
        );
		$page_id = wp_insert_post($my_page);
        update_post_meta($page_id, '_wp_page_template', 'altyazili.php');
        update_option('filmplus_altyazili_page_id', $page_id);
    } else {
   		update_post_meta($page_id, '_wp_page_template', 'altyazili.php');
    	update_option('filmplus_altyazili_page_id', $page_id);
    }
   	$page_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'yerli-filmler';");
    if (!$page_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'page',
	        'post_author' => 1,
	        'post_name' => 'yerli-filmler',
	        'post_title' => __('Yerli Filmler', 'filmplus')
        );
		$page_id = wp_insert_post($my_page);
        update_post_meta($page_id, '_wp_page_template', 'yerli.php');
        update_option('filmplus_yerli_page_id', $page_id);
    } else {
   		update_post_meta($page_id, '_wp_page_template', 'yerli.php');
    	update_option('filmplus_yerli_page_id', $page_id);
    }
    $page_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'uye-ol';");
    if (!$page_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'page',
	        'post_author' => 1,
	        'post_name' => 'uye-ol',
	        'post_title' => __('Üye Ol', 'filmplus')
        );
		$page_id = wp_insert_post($my_page);
        update_post_meta($page_id, '_wp_page_template', 'register.php');
        update_option('filmplus_uyeol_page_id', $page_id);
    } else {
   		update_post_meta($page_id, '_wp_page_template', 'register.php');
    	update_option('filmplus_uyeol_page_id', $page_id);
    }

    $page_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'film-arsivi';");
    if (!$page_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'page',
	        'post_author' => 1,
	        'post_name' => 'film-arsivi',
	        'post_title' => __('Film Arşivi', 'filmplus')
        );
		$page_id = wp_insert_post($my_page);
        update_post_meta($page_id, '_wp_page_template', 'film-arsivi.php');
        update_option('filmplus_arsiv_page_id', $page_id);
    } else {
   		update_post_meta($page_id, '_wp_page_template', 'film-arsivi.php');
    	update_option('filmplus_arsiv_page_id', $page_id);
    }

    $page_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'imdb-en-iyiler';");
    if (!$page_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'page',
	        'post_author' => 1,
	        'post_name' => 'imdb-en-iyiler',
	        'post_title' => __('IMDb En İyiler', 'filmplus')
        );
		$page_id = wp_insert_post($my_page);
        update_post_meta($page_id, '_wp_page_template', 'imdbtop.php');
        update_option('filmplus_imdbtop_page_id', $page_id);
    } else {
   		update_post_meta($page_id, '_wp_page_template', 'imdbtop.php');
    	update_option('filmplus_imdbtop_page_id', $page_id);
    }

    $page_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'en-cok-izlenen-filmler';");
    if (!$page_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'page',
	        'post_author' => 1,
	        'post_name' => 'en-cok-izlenen-filmler',
	        'post_title' => __('En Çok İzlenen Filmler', 'filmplus')
        );
		$page_id = wp_insert_post($my_page);
        update_post_meta($page_id, '_wp_page_template', 'mostviewed.php');
        update_option('filmplus_mostviewed_page_id', $page_id);
    } else {
   		update_post_meta($page_id, '_wp_page_template', 'mostviewed.php');
    	update_option('filmplus_mostviewed_page_id', $page_id);
    }

    $page_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'en-cok-begenilen-filmler';");
    if (!$page_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'page',
	        'post_author' => 1,
	        'post_name' => 'en-cok-begenilen-filmler',
	        'post_title' => __('En Çok Beğenilen Filmler', 'filmplus')
        );
		$page_id = wp_insert_post($my_page);
        update_post_meta($page_id, '_wp_page_template', 'mostliked.php');
        update_option('filmplus_mostliked_page_id', $page_id);
    } else {
   		update_post_meta($page_id, '_wp_page_template', 'mostliked.php');
    	update_option('filmplus_mostliked_page_id', $page_id);
    }
    
    $page_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'favorilerim';");
    if (!$page_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'page',
	        'post_author' => 1,
	        'post_name' => 'favorilerim',
	        'post_title' => __('Favorilerim', 'filmplus')
        );
		$page_id = wp_insert_post($my_page);
        update_post_meta($page_id, '_wp_page_template', 'favorites.php');
        update_option('filmplus_favorites_page_id', $page_id);
    } else {
   		update_post_meta($page_id, '_wp_page_template', 'favorites.php');
    	update_option('filmplus_favorites_page_id', $page_id);
    }
    
    $page_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'izlediklerim';");
    if (!$page_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'page',
	        'post_author' => 1,
	        'post_name' => 'izlediklerim',
	        'post_title' => __('İzlediklerim', 'filmplus')
        );
		$page_id = wp_insert_post($my_page);
        update_post_meta($page_id, '_wp_page_template', 'watched.php');
        update_option('filmplus_watched_page_id', $page_id);
    } else {
   		update_post_meta($page_id, '_wp_page_template', 'watched.php');
    	update_option('filmplus_watched_page_id', $page_id);
    }
    
    $page_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'izleyeceklerim';");
    if (!$page_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'page',
	        'post_author' => 1,
	        'post_name' => 'izleyeceklerim',
	        'post_title' => __('İzleyeceklerim', 'filmplus')
        );
		$page_id = wp_insert_post($my_page);
        update_post_meta($page_id, '_wp_page_template', 'watchlater.php');
        update_option('filmplus_watchlater_page_id', $page_id);
    } else {
   		update_post_meta($page_id, '_wp_page_template', 'watchlater.php');
    	update_option('filmplus_watchlater_page_id', $page_id);
    }

    $page_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'iletisim';");
    if (!$page_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'page',
	        'post_author' => 1,
	        'post_name' => 'iletisim',
	        'post_title' => __('İletişim', 'filmplus')
        );
		$page_id = wp_insert_post($my_page);
        update_post_meta($page_id, '_wp_page_template', 'contact.php');
        update_option('filmplus_iletisim_page_id', $page_id);
    } else {
   		update_post_meta($page_id, '_wp_page_template', 'contact.php');
    	update_option('filmplus_iletisim_page_id', $page_id);
    }
	$array = get_option('wpform_settings');
	if(empty($array)) {
	    $array = array();
	}

    $page_id = $wpdb->get_var("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'seri-filmler';");
    if (!$page_id) {
        $my_page = array(
	        'post_status' => 'publish',
	        'post_type' => 'page',
	        'post_author' => 1,
	        'post_name' => 'seri-filmler',
	        'post_title' => __('Seri Filmler', 'filmplus')
        );
		$page_id = wp_insert_post($my_page);
        update_post_meta($page_id, '_wp_page_template', 'seri-filmler.php');
        update_option('filmplus_serifilm_page_id', $page_id);
    } else {
   		update_post_meta($page_id, '_wp_page_template', 'seri-filmler.php');
    	update_option('filmplus_serifilm_page_id', $page_id);
    }
	$array = get_option('wpform_settings');
	if(empty($array)) {
	    $array = array();
	}
	$array['recaptcha-type'] = 'v2';
	$array['recaptcha-site-key'] = get_option('filmplus_site_key');
	$array['recaptcha-secret-key'] = get_option('filmplus_secret_key');
	$array['validation-required'] = 'Bu alan zorunludur';
	$array['validation-url'] = 'Lütfen web site adresi girin';
	$array['validation-email'] = 'Lütfen geçerli bir e-mail adresi girin';
	$array['validation-email-suggestion'] = 'Bunu mu demek istediğiniz {suggestion}?';
	$array['validation-number'] = 'Lütfen geçerli bir sayı girin';
	$array['validation-confirm'] = 'Değerler uyuşmuyor';
	$array['validation-check-limit'] = 'İzin verilen seçim sayısını aştınız: {#}.';
	update_option('wpforms_settings',$array);
	$views_options = 'a:11:{s:5:"count";i:0;s:12:"exclude_bots";i:0;s:12:"display_home";i:0;s:14:"display_single";i:0;s:12:"display_page";i:0;s:15:"display_archive";i:0;s:14:"display_search";i:0;s:13:"display_other";i:0;s:8:"use_ajax";i:0;s:8:"template";s:12:"%VIEW_COUNT%";s:20:"most_viewed_template";s:82:"<li><a href="%POST_URL%" title="%POST_TITLE%">%POST_TITLE%</a> - %VIEW_COUNT%</li>";}';
	update_option('views_options', unserialize($views_options));
	update_option('posts_per_page', 20);
}
function removed_widgets(){
    global $wp_registered_sidebars;
    $widgets = get_option('sidebars_widgets');
    foreach ($wp_registered_sidebars as $sidebar => $value) {
        unset($widgets[$sidebar]);
    }
    update_option('sidebars_widgets',$widgets);
}