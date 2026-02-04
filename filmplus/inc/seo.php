<?php
function filmplus_titles() {
	$shortname = 'filmplus';
	if (is_home() || is_front_page()) {
		if (get_option($shortname.'_seo_home_title') == 'On') echo get_option($shortname.'_seo_home_titletext');  
		else { 
			if (get_option($shortname.'_seo_home_type') == 'blogisim') echo get_bloginfo('name').get_option($shortname.'_seo_home_separate').get_bloginfo('description'); 
			if ( get_option($shortname.'_seo_home_type') == 'blogaciklama') echo get_bloginfo('description').get_option($shortname.'_seo_home_separate').get_bloginfo('name');
			if ( get_option($shortname.'_seo_home_type') == 'sadeceblog') echo get_bloginfo('name');
		}
	}
	if (is_single() || is_page()) { 
		global $wp_query; 
		$postid = $wp_query->post->ID; 
		$key = get_option($shortname.'_seo_single_field_title');
		$exists3 = get_post_meta($postid, ''.$key.'', true);
				if (get_option($shortname.'_seo_field') == 'On' && $exists3 !== '' ) {
					if (get_option($shortname.'_seo_single_type') == 'yazibaslik') echo trim($exists3).get_option($shortname.'_seo_single_separate').get_bloginfo('name');
					if (get_option($shortname.'_seo_single_type') == 'yaziblog') echo get_bloginfo('name').get_option($shortname.'_seo_single_separate').trim($exists3); 
					if (get_option($shortname.'_seo_single_type') == 'sadeceyazi') echo trim($exists3);
				}
				else { 
					if (get_option($shortname.'_seo_single_type') == 'yazibaslik') echo trim(wp_title('',false,'')).get_option($shortname.'_seo_single_separate').get_bloginfo('name');
					if (get_option($shortname.'_seo_single_type') == 'yaziblog') echo get_bloginfo('name').get_option($shortname.'_seo_single_separate').trim(wp_title('',false,'')); 
					if (get_option($shortname.'_seo_single_type') == 'sadeceyazi') echo trim(wp_title('',false,''));
			    }
	}
	if (is_category()) { 
		if (get_option($shortname.'_seo_index_type') == 'kategoribaslik') echo trim(wp_title('',false,'')).get_option($shortname.'_seo_index_add_cat').get_option($shortname.'_seo_index_separate').get_bloginfo('name');
		if (get_option($shortname.'_seo_index_type') == 'kategoriblog') echo get_bloginfo('name').get_option($shortname.'_seo_index_separate').trim(wp_title('',false,'').get_option($shortname.'_seo_index_add_cat')); 
		if (get_option($shortname.'_seo_index_type') == 'sadecekategori') echo trim(wp_title('',false,'').get_option($shortname.'_seo_index_add_cat'));
		}
	if (is_author()) { 
		if (get_option($shortname.'_seo_index_type') == 'kategoribaslik') echo trim(wp_title('',false,'')).get_option($shortname.'_seo_index_separate').get_bloginfo('name');
		if (get_option($shortname.'_seo_index_type') == 'kategoriblog') echo get_bloginfo('name').get_option($shortname.'_seo_index_separate').trim(wp_title('',false,'')); 
		if (get_option($shortname.'_seo_index_type') == 'sadecekategori') echo trim(wp_title('',false,''));
		}
	if (is_tax()) { 
		if (get_option($shortname.'_seo_index_type_tax') == 'kategoribaslik') echo trim(single_term_title('',false,'')).get_option($shortname.'_seo_index_add_tax').get_option($shortname.'_seo_index_separate_tax').get_bloginfo('name');
		if (get_option($shortname.'_seo_index_type_tax') == 'kategoriblog') echo get_bloginfo('name').get_option($shortname.'_seo_index_separate_tax').trim(single_term_title('',false,'').get_option($shortname.'_seo_index_add_tax')); 
		if (get_option($shortname.'_seo_index_type_tax') == 'sadecekategori') echo trim(single_term_title('',false,'').get_option($shortname.'_seo_index_add_tax'));
		}
	if (is_tag()) { 
		if (get_option($shortname.'_seo_index_type') == 'kategoribaslik') echo trim(single_term_title('',false,'')).get_option($shortname.'_seo_index_separate').get_bloginfo('name');
		if (get_option($shortname.'_seo_index_type') == 'kategoriblog') echo get_bloginfo('name').get_option($shortname.'_seo_index_separate').trim(single_term_title('',false,'')); 
		if (get_option($shortname.'_seo_index_type') == 'sadecekategori') echo trim(single_term_title('',false,''));
		}
	if (is_search()) { 
		if (get_option($shortname.'_seo_index_type') == 'kategoribaslik') echo trim(get_search_query('',false,'')).get_option($shortname.'_seo_index_separate').get_bloginfo('name');
		if (get_option($shortname.'_seo_index_type') == 'kategoriblog') echo get_bloginfo('name').get_option($shortname.'_seo_index_separate').trim(get_search_query('',false,'')); 
		if (get_option($shortname.'_seo_index_type') == 'sadecekategori') echo trim(get_search_query('',false,''));
		}
	if (is_404()) { 
		echo trim(wp_title('',false,''));
		}
} 
function filmplus_description() {
	$shortname = 'filmplus';
	if (is_home() && get_option($shortname.'_seo_home_description')) { 
	echo '<meta name="description" content="'.get_option($shortname.'_seo_home_description').'" />'; echo "\n"; 
	}
	global $wp_query; 
	if (isset($wp_query->post->ID)) $postid = $wp_query->post->ID; 
	$key2 = get_option($shortname.'_seo_single_field_description');
	if (isset($postid)) $exists = get_post_meta($postid, ''.$key2.'', true);
    else $exists = '';
	if (get_option($shortname.'_seo_field') == 'On' && $exists !== '') {
		if (is_single() || is_page()) { echo '<meta name="description" content="'.$exists.'" />'; echo "\n"; }
	}
	remove_filter('term_description','wpautop');
	$cat = get_query_var('cat'); 
    $exists2 = category_description($cat);
    $exists33 = term_description();
	if ($exists2 !== '' && get_option($shortname.'_seo_index_description') == 'On') {
		if (is_category()) { echo '<meta name="description" content="'. $exists2 .'" />'; echo "\n"; }
	}
	if ($exists33 !== '' && get_option($shortname.'_seo_tax_description') == 'On') {
		if (is_tax()) { echo '<meta name="description" content="'. $exists33 .'" />'; echo "\n"; }
	}
	if (is_search() && get_option($shortname.'_seo_index_description') == 'On') { echo '<meta name="description" content="'. wp_title('',false,'') .'" />'; echo "\n"; }
}
function filmplus_keywords() {
	$shortname = 'filmplus';
	if (is_home() && get_option($shortname.'_seo_home_keywords')) { echo '<meta name="keywords" content="'.get_option($shortname.'_seo_home_keywords').'" />'; echo "\n"; }
	global $wp_query; 
	if (isset($wp_query->post->ID)) $postid = $wp_query->post->ID; 
	$key3 = get_option($shortname.'_seo_single_field_keywords');
	if (isset($postid)) $exists4 = get_post_meta($postid, ''.$key3.'', true);
	if (isset($exists4) && $exists4 !== '' && get_option($shortname.'_seo_field') == 'On') {
		if (is_single() || is_page()) { echo '<meta name="keywords" content="'.$exists4.'" />'; echo "\n"; }
	}
}
function filmplus_metatags(){
?>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta content="tr" http-equiv="Content-Language" />
<meta name="language" content="Turkish" />
<meta name="geo.placename" content="Turkey" />
<meta name="location" content="türkiye, tr, turkey" />
<meta name="google" content="notranslate" />
<?php
}
function filmplus_canonical() {
	$shortname = 'filmplus';
	if (get_option($shortname.'_seo_canonical') == 'On') {
	global $wp_query; 
	if (isset($wp_query->post->ID)) $postid = $wp_query->post->ID; 
		$url = filmplus_aiosp_get_url($wp_query);
		echo '<link rel="canonical" href="'.$url.'" />';	
	}
}
if (get_option('filmplus_seo_canonical') == 'On') {
	include_once('canonical.php');
}
function filmplus_stylesheet() {
	if(get_option('filmplus_tema_rengi') == 'mor')
		$style = '/style.css';
    elseif(get_option('filmplus_tema_rengi') == 'dark')
        $style = '/style-dark.css';
	else 
		$style = '/style-blue.css';
?>
<link rel="stylesheet" href="<?php echo ''.get_template_directory_uri().$style;?>" type="text/css" media="all" />
<?php
}
?>