<?php
add_action( 'admin_menu', 'filmplus_create_meta_box' );
add_action( 'save_post', 'filmplus_save_meta_data' );
function filmplus_create_meta_box() {
	add_meta_box( 'post-meta-boxes', __('Film Bilgileri', 'filmplus'), 'post_meta_boxes', 'post', 'normal', 'high' );
	add_meta_box( 'page-meta-boxes', __('FilmPlus SEO Paneli', 'filmplus'), 'page_meta_boxes', 'page', 'normal', 'high' );
}
function filmplus_post_meta_boxes() {
	$filmplus_seotitle = get_option('filmplus_seo_single_field_title');
	$filmplus_seodescription = get_option('filmplus_seo_single_field_description');
	$filmplus_keywords = get_option('filmplus_seo_single_field_keywords');
	if(get_option('filmplus_seo_field') == 'On') {
	$meta_boxes = array(
		'filmadi' => array( 'name' => 'filmadi', 'title' => __('Filmin Orijinal Adı:', 'filmplus'), 'type' => 'text'),
		'imdb' => array( 'name' => 'imdb', 'title' => __('IMDb Puanı:', 'filmplus'), 'type' => 'text'),
		'ozet' => array( 'name' => 'ozet', 'title' => __('Özet:', 'filmplus'), 'type' => 'textarea'),
		'youtube' => array( 'name' => 'youtube', 'title' => __('Youtube Trailer Url:', 'filmplus'), 'type' => 'text'),   
		'info' => array( 'name' => 'info', 'title' => __('Film Notu:', 'filmplus'), 'type' => 'text'),   
		'cevirinotu' => array( 'name' => 'cevirinotu', 'title' => __('Çeviri Notları:', 'filmplus'), 'type' => 'textarea'),
		'indir' => array( 'name' => 'indir', 'title' => __('İndirme Linki:', 'filmplus'), 'type' => 'text'),
		'resim' => array( 'name' => 'resim', 'title' => __('Alternatif Film Afiş URL:', 'filmplus'), 'type' => 'text'),
		'dil' => array( 'name' => 'dil', 'title' => __('Dil:', 'filmplus'), 'type' => 'select', 'options' => array('Girilmedi', 'Turkce Dublaj', 'Turkce Altyazi', 'Turkce Altyazi-Dublaj', 'Ingilizce Altyazi', 'Altyazisiz', 'Yerli Film') ),
		'seobaslik' => array( 'name' => 'seobaslik', 'title' => __('SEO AYARLARI', 'filmplus'), 'type' => 'filmplusselect'),
		$filmplus_seotitle => array( 'name' => $filmplus_seotitle, 'title' => __('Başlık:', 'filmplus'), 'type' => 'text', 'desc' => 'Google da gözükecek başlık.'),
		$filmplus_seodescription => array( 'name' => $filmplus_seodescription, 'title' => __('Açıklama:', 'filmplus'), 'type' => 'textarea', 'desc' => 'Google da gözükecek açıklama. Max 160 karakter'),
		$filmplus_keywords => array( 'name' => $filmplus_keywords, 'title' => __('Anahtar Kelimeler:', 'filmplus'), 'type' => 'text', 'desc' => 'Anahtar kelimeleri virgül (,) ile ayırmayı unutmayınız.'),
	);
	} else {
	$meta_boxes = array(
		'filmadi' => array( 'name' => 'filmadi', 'title' => __('Filmin Orijinal Adı:', 'filmplus'), 'type' => 'text'),
		'imdb' => array( 'name' => 'imdb', 'title' => __('IMDb Puanı:', 'filmplus'), 'type' => 'text'),
		'ozet' => array( 'name' => 'ozet', 'title' => __('Özet:', 'filmplus'), 'type' => 'textarea'),
		'youtube' => array( 'name' => 'youtube', 'title' => __('Youtube Trailer Url:', 'filmplus'), 'type' => 'text'),   
		'info' => array( 'name' => 'info', 'title' => __('Film Notu:', 'filmplus'), 'type' => 'text'),   
		'cevirinotu' => array( 'name' => 'cevirinotu', 'title' => __('Çeviri Notları:', 'filmplus'), 'type' => 'textarea'),
		'indir' => array( 'name' => 'indir', 'title' => __('İndirme Linki:', 'filmplus'), 'type' => 'text'),
		'resim' => array( 'name' => 'resim', 'title' => __('Alternatif Film Afiş URL:', 'filmplus'), 'type' => 'text'),
		'dil' => array( 'name' => 'dil', 'title' => __('Dil:', 'filmplus'), 'type' => 'select', 'options' => array('Girilmedi', 'Turkce Dublaj', 'Turkce Altyazi', 'Turkce Altyazi-Dublaj', 'Ingilizce Altyazi', 'Altyazisiz', 'Yerli Film') ),
	);
	}
	return apply_filters( 'filmplus_post_meta_boxes', $meta_boxes );
}
function filmplus_page_meta_boxes() {
	$filmplus_seotitle = get_option('filmplus_seo_single_field_title');
	$filmplus_seodescription = get_option('filmplus_seo_single_field_description');
	$filmplus_keywords = get_option('filmplus_seo_single_field_keywords');
	if(get_option('filmplus_seo_field') == 'On') {
	$meta_boxes = array(
		$filmplus_seotitle => array( 'name' => $filmplus_seotitle, 'title' => __('Başlık:', 'filmplus'), 'type' => 'text', 'desc' => 'Google da gözükmesini istediğiniz başlığı buraya giriniz.'),
		$filmplus_seodescription => array( 'name' => $filmplus_seodescription, 'title' => __('Açıklama:', 'filmplus'), 'type' => 'textarea', 'desc' => 'Google için 160 Karakteri geçmeyecek bir açıklama girebilirsiniz.'),
		$filmplus_keywords => array( 'name' => $filmplus_keywords, 'title' => __('Anahtar Kelimeler:', 'filmplus'), 'type' => 'text', 'desc' => 'Anahtar kelimeleri virgül (,) ile ayırmayı unutmayınız.'),
	);
	} else {
	$meta_boxes = array(
		'resim' => array( 'name' => 'resim', 'title' => __('Resim:', 'filmplus'), 'type' => 'text', 'desc' => 'Sayfa ait bir resim koyabilirsiniz.'),
	);
	}
	return apply_filters( 'filmplus_page_meta_boxes', $meta_boxes );
}
function post_meta_boxes() {
	global $post;
	$meta_boxes = filmplus_post_meta_boxes(); 
?>
	<table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :
		$value = get_post_meta( $post->ID, $meta['name'], true );
		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );
        elseif ( $meta['type'] == 'filmplusselect' )
			get_meta_filmplusselect( $meta, $value );
        elseif ( $meta['type'] == 'selectadmin' )
			get_meta_selectadmin( $meta, $value );
        elseif ( $meta['type'] == 'checkbox' )
			get_meta_checkbox( $meta, $value );
        elseif ( $meta['type'] == 'selectdate' )
			get_meta_selectgrup( $meta, $value );
	endforeach; ?>
	</table>
<?php
}
function page_meta_boxes() {
	global $post;
	$meta_boxes = filmplus_page_meta_boxes(); ?>
	<table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :
		$value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) );
		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );
	endforeach; ?>
	</table>
<?php
}
function add_js_to_meta() {
	wp_register_script( 'custom-javascript', get_template_directory_uri() . '/inc/panel/js/custom.js' );
	wp_enqueue_script( 'custom-javascript' );
}
add_action( 'admin_enqueue_scripts', 'add_js_to_meta' );
function get_meta_text_input( $args = array(), $value = false ) {
	extract( $args ); ?>
	<tr>
		<th style="width:20%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_html( $value, 1 ); ?>" size="30" tabindex="30" style="width: 97%;margin-top:-3px;" />
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<br />
			<p class="description"></p>
		</td>
	</tr>
	<?php
}
function get_meta_select( $args = array(), $value = false ) {
	extract( $args ); ?>
	<tr>
		<th style="width:20%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<select style="width:372px;" name="<?php echo $name; ?>" id="<?php echo $name; ?>">
			<?php foreach ( $options as $option ) : ?>
				<option <?php if ( htmlentities( $value, ENT_QUOTES ) == $option ) echo ' selected="selected"'; ?>>
					<?php echo $option; ?>
				</option>
			<?php endforeach; ?>
			</select>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}
function get_meta_textarea( $args = array(), $value = false ) {
	extract( $args ); ?>
	<tr>
		<th style="width:20%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" cols="60" rows="4" tabindex="30" style="width: 97%;margin-top:-3px;"><?php echo esc_html( $value, 1 ); ?></textarea>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<p class="description"></p>
		</td>
	</tr>
	<?php
}
function get_meta_filmplusselect( $args = array(), $value = false ) {
	extract( $args ); ?>
	<tr>
		<th style="width:20%;">
			<label for="<?php echo $name; ?>" style="font-weight:bold;"><?php echo $title; ?></label>
		</th>
		<td>
			<span class="description"></span>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}
function filmplus_save_meta_data( $post_id ) {
	global $post;
	if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] )
		$meta_boxes = array_merge( filmplus_page_meta_boxes() );
	else
		$meta_boxes = array_merge( filmplus_post_meta_boxes() );
	foreach ( $meta_boxes as $meta_box ) :
		if(isset($_POST[$meta_box['name'] . '_noncename'])):
			if ( !wp_verify_nonce( $_POST[$meta_box['name'] . '_noncename'], plugin_basename( __FILE__ ) ) )
				return $post_id;
			if ( 'page' == $_POST['post_type'] && !current_user_can( 'edit_page', $post_id ) )
				return $post_id;
			elseif ( 'post' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
				return $post_id;
			$data = stripslashes( $_POST[$meta_box['name']] );
			if ( get_post_meta( $post_id, $meta_box['name'] ) == '' )
				add_post_meta( $post_id, $meta_box['name'], $data, true );
			elseif ( $data != get_post_meta( $post_id, $meta_box['name'], true ) )
				update_post_meta( $post_id, $meta_box['name'], $data );
			elseif ( $data == '' )
				delete_post_meta( $post_id, $meta_box['name'], get_post_meta( $post_id, $meta_box['name'], true ) );
		endif;
	endforeach;
}
add_action( 'media_buttons', 'filmplus_add_source' );
function filmplus_add_source(){
?>
<a href="#" id="kaynak_ekle" class="button" title="Kaynak Ekle">
	<span class="dashicons dashicons-format-video"></span> Video Kaynağı Ekle
</a>
<div id="source-modal-backdrop"></div>
<div class="kaynak_ekle">
	<div class="kaynak_title">Kaynak Ekle</div>
	<span class="kaynak_kapat">×</span>
	<p>
		<input type="text" id="source_name" placeholder="Kaynak İsmi*">
	</p>
	<p>
		<select id="languages">
			<option value="">Dil Seçin</option>
			<option value="trd">Türkçe Dublaj</option>
			<option value="tra">Türkçe Altyazılı</option>
			<option value="eng">İngilizce Altyazılı</option>
			<option value="org">Altyazısız</option>
			<option value="frg">Fragman</option>
		</select>
	</p>
	<p>
		<select id="qualities">
			<option value="">Kalite Seçin</option>
			<option value="1080p">1080p</option>
			<option value="720p">720p</option>
			<option value="480p">480p</option>
			<option value="360p">360p</option>
		</select>
	</p>
	<p>
		<input type="checkbox" name="checkbox" id="first_part">
		<label for="first_part"> İlk Kaynağı Ekliyorsanız Burayı İşaretleyin</label>
	</p>
	<p>
		<textarea placeholder="Video Kodu*" autocomplete="off" cols="40" id="code"></textarea>
	</p>
	<p>
		<strong>Not:</strong> Bir kaynak için dil seçimi yapıyorsanız, diğer tüm kaynaklar için de dil seçimi yapmalısınız.
	</p>
	<p>
		<div id="ekle">Ekle</div>
	</p>
</div>
<?php
}
function admin_source_register()
{
	wp_enqueue_style('source-style', get_bloginfo('template_url').'/inc/panel/source.css', '', '1');
	wp_enqueue_script('jquery');
	wp_enqueue_script('source-js', get_bloginfo('template_url').'/inc/panel/js/source.js');
}
add_action( 'admin_enqueue_scripts', 'admin_source_register' );
?>