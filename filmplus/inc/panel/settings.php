<?php
class filmplusPanel {
	var $theme_name;
	public function __construct($theme_name = 'Tema Ayarları')
	{
		$this->theme_name = $theme_name;
		$this->default_options();
		add_action('init', array($this, 'init'));
		add_action('admin_menu', array($this, 'admin_menu'));
		add_action('wp_ajax_filmplus_upload', array($this, 'upload'));
		add_action('wp_ajax_filmplus_save_fields', array($this, 'save_fields'));
		add_action('wp_ajax_filmplus_reset_fields', array($this, 'reset_fields'));
	}

	public function default_options()
	{
		add_option('filmplus_tema_rengi', 'mor');
		add_option('filmplus_twitter', 'On');
		add_option('filmplus_facebook', 'On');
		add_option('filmplus_sosyal', 'On');
		add_option('filmplus_sidebar_show', 'On');
		add_option('filmplus_benzer_show', 'On');
		add_option('filmplus_galeri_show', 'On');
		add_option('filmplus_benzer_count', '10');
		add_option('filmplus_slider', '');
		add_option('filmplus_homepage_pagination', '');
		add_option('filmplus_r_a_g', 'On');
		add_option('filmplus_r_a_s', '15000');
		add_option('filmplus_r_e_s', '1');
		add_option('filmplus_slider_gecis', '10000');
		add_option('filmplus_slider_tipi', 'tip2');
		add_option('filmplus_sayfa_basi', '20');
		add_option('filmplus_tmdb_title', '{title}');
		add_option('filmplus_tmdb_seo_title', '{title} izle');
		add_option('filmplus_tmdb_seo_desc', '');
		add_option('filmplus_tmdb_seo_url', '{title} izle');
		add_option('filmplus_logo_title', 'filmplus+');
		add_option('filmplus_part_sistem', 'On');
		add_option('filmplus_yeni', 'On');
		add_option('filmplus_part_iki', 'Part');
		add_option('filmplus_part_bir', 'Fragman');
		add_option('filmplus_seo_home_type', 'sadeceblog');
		add_option('filmplus_seo_home_separate', ' | ');
		add_option('filmplus_seo_single_title', '');
		add_option('filmplus_seo_single_type', 'yazibaslik');
		add_option('filmplus_seo_single_separate', ' | ');
		add_option('filmplus_seo_index_separate', ' | ');
		add_option('filmplus_seo_index_separate_tax', ' | ');
		add_option('filmplus_seo_index_add_tax', '');
		add_option('filmplus_seo_index_add_cat', '');
		add_option('filmplus_seo_index_type', 'kategoribaslik');
		add_option('filmplus_seo_index_type_tax', 'kategoribaslik');
		add_option('filmplus_seo_field', '');
		add_option('filmplus_seo_canonical', 'On');
		add_option('filmplus_seo_facebook', 'On');
		add_option('filmplus_seo_single_field_title', 'filmplus_seotitle');
		add_option('filmplus_seo_single_field_description', 'filmplus_seodescription');
		add_option('filmplus_seo_single_field_keywords', 'filmplus_seokeywords');
	}

	public function init()
	{
	}
	public function admin_menu()
	{
		$object = add_menu_page('Tema Ayarları', $this->theme_name, 'manage_options', 'filmplus_panel', array($this, 'options_panel'), get_bloginfo('template_directory') . '/inc/panel/images/themeoptions-icon.png');

  	add_action('admin_print_styles-'.$object, array($this, 'admin_scripts'));
	}
	public function admin_scripts()
	{
		wp_enqueue_style($this->theme_name, get_bloginfo('template_url').'/inc/panel/style.css', '', '1');
    	wp_enqueue_script('jquery');
		wp_enqueue_script('ajaxupload', get_bloginfo('template_url').'/inc/panel/js/ajaxupload.js');
	}
	
	public function options_panel()
	{
		$options = new filmplusPanelOptions;
	}

	public function upload()
	{
		$clickedID = $_POST['data'];
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		$upload_tracking[] = $clickedID;
		update_option($clickedID, $uploaded_file['url']);
		if(!empty($uploaded_file['error'])) {
			echo 'Dosya yüklenemedi: ' . $uploaded_file['error'];
		}	
		else {
			echo $uploaded_file['url'];
		}
		die();
	}

	public function save_fields()
	{
		unset($_POST['action']);
		foreach($_POST as $key => $value) {
			update_option($key, stripslashes($value));
		}
		die();
	}
	public function reset_fields()
	{
		update_option('filmplus_logo', '');
		update_option('filmplus_favicon', '');
		update_option('filmplus_analytics', '');
		update_option('filmplus_twitter_id', '');
		update_option('filmplus_facebook_id', '');
		update_option('filmplus_instagram_id', '');
		update_option('filmplus_tmdb_id', '');
		update_option('filmplus_site_key', '');
		update_option('filmplus_secret_key', '');
		update_option('filmplus_slider_id', '');
		update_option('filmplus_footer_left', '');
		update_option('filmplus_footer_right', '');
		update_option('filmplus_blur', '');
		update_option('filmplus_r_a', '');
		update_option('filmplus_r_b', '');
		update_option('filmplus_r_u', '');
		update_option('filmplus_r_c', '');
		update_option('filmplus_r_d', '');
		update_option('filmplus_r_e', '');
		update_option('filmplus_r_h', '');
		update_option('filmplus_r_ee', '');
		update_option('filmplus_r_ps', '');
		update_option('filmplus_r_f', '');
		update_option('filmplus_r_a_a', '');
		update_option('filmplus_r_b_b', '');
		update_option('filmplus_r_u_u', '');
		update_option('filmplus_r_c_c', '');
		update_option('filmplus_r_d_d', '');
		update_option('filmplus_r_e_e', '');
		update_option('filmplus_r_h_h', '');
		update_option('filmplus_r_ps_ps1', '');
		update_option('filmplus_r_ps_ps2', '');
		update_option('filmplus_r_f_f1', '');
		update_option('filmplus_r_f_f2', '');
		update_option('filmplus_r_f_f3', '');
		update_option('filmplus_seo_home_type', 'sadeceblog');
		update_option('filmplus_seo_single_type', 'yazibaslik');
		update_option('filmplus_seo_index_type', 'kategoribaslik');
		update_option('filmplus_seo_home_separate', ' | ');
		update_option('filmplus_seo_single_separate', ' | ');
		update_option('filmplus_seo_index_separate', ' | ');
		update_option('filmplus_seo_home_title', '');
		update_option('filmplus_seo_single_title', '');
		update_option('filmplus_seo_home_titletext', '');
		update_option('filmplus_seo_home_description', '');
		update_option('filmplus_seo_index_description', '');
		update_option('filmplus_seo_tax_description', '');
		update_option('filmplus_seo_single_description', '');
		update_option('filmplus_seo_home_keywords', '');
		update_option('filmplus_seo_single_keywords', '');
		update_option('filmplus_seo_canonical', 'On');
		update_option('filmplus_seo_facebook', 'On');
		update_option('filmplus_seo_field', '');
		update_option('filmplus_seo_single_field_title', 'filmplus_seotitle');
		update_option('filmplus_seo_single_field_description', 'filmplus_seodescription');
		update_option('filmplus_seo_single_field_keywords', 'filmplus_seokeywords');
		die();
	}
}
?>