<?php
// Taxonomy Fields
function add_custom_taxonomies() {
	register_taxonomy('ulke', 'post', array('hierarchical' => false, 'labels' => array('name' => _x('Ülke', 'taxonomy general name'), 'singular_name' => _x('Ülke', 'taxonomy singular name'), 'search_items' => __('Ülke ara'), 'all_items' => __('Tüm ülkeler'), 'edit_item' => __('Ülke düzenle'), 'update_item' => __('Ülke güncelle'), 'add_new_item' => __('Yeni ülke ekle'), 'new_item_name' => __('Yeni ülke adı'), 'menu_name' => __('Ülkeler'),), 'rewrite' => array('slug' => 'ulke', 'with_front' => false,'hierarchical' => false),));
	register_taxonomy('oyuncu', 'post', array('hierarchical' => false, 'labels' => array('name' => _x('Oyuncu', 'taxonomy general name'), 'singular_name' => _x('Oyuncu', 'taxonomy singular name'), 'search_items' => __('Oyuncu ara'), 'all_items' => __('Tüm oyuncular'), 'edit_item' => __('Oyuncu düzenle'), 'update_item' => __('Oyuncu güncelle'), 'add_new_item' => __('Yeni oyuncu ekle'), 'new_item_name' => __('Yeni oyuncu adı'), 'menu_name' => __('Oyuncular'),), 'rewrite' => array('slug' => 'oyuncu', 'with_front' => false,'hierarchical' => false),));
	register_taxonomy('yil', 'post', array('hierarchical' => false, 'labels' => array('name' => _x('Yapım Yılı', 'taxonomy general name'), 'singular_name' => _x('Yapım Yılı', 'taxonomy singular name'), 'search_items' => __('Yapım Yılı ara'), 'all_items' => __('Tüm yıllar'), 'edit_item' => __('Yapım Yılı düzenle'), 'update_item' => __('Yapım Yılı güncelle'), 'add_new_item' => __('Yeni Yapım Yılı ekle'), 'new_item_name' => __('Yeni Yapım Yılı'), 'menu_name' => __('Yapım Yılı'),), 'rewrite' => array('slug' => 'yil', 'with_front' => false, 'hierarchical' => false),));
	register_taxonomy('yonetmen', 'post', array('hierarchical' => false, 'labels' => array('name' => _x('Yönetmen', 'taxonomy general name'), 'singular_name' => _x('Yönetmen', 'taxonomy singular name'), 'search_items' => __('Yönetmen ara'), 'all_items' => __('Tüm yönetmenler'), 'edit_item' => __('Yönetmen düzenle'), 'update_item' => __('Yönetmen güncelle'), 'add_new_item' => __('Yeni yönetmen ekle'), 'new_item_name' => __('Yeni yönetmen adı'), 'menu_name' => __('Yönetmenler'),), 'rewrite' => array('slug' => 'yonetmen','with_front' => false,'hierarchical' => false),));
}
add_action('init', 'add_custom_taxonomies', 0);

//Change Default Settings
function unregister_default_wp_widgets(){
    unregister_widget( "WP_Widget_Calendar" );
    unregister_widget( "WP_Widget_Links" );
    unregister_widget( "WP_Widget_Meta" );
    unregister_widget( "WP_Widget_Search" );
    unregister_widget( "WP_Widget_Recent_Comments" );
    unregister_widget( "WP_Widget_RSS" );
}
add_action( "widgets_init", "unregister_default_wp_widgets", 1 );
remove_action( "wp_head", "wlwmanifest_link" );
remove_action( "wp_head", "wp_generator" );
remove_action( "wp_head", "rsd_link" );
remove_action( "wp_head", "start_post_rel_link" );
remove_action( "wp_head", "index_rel_link" );
remove_action( "wp_head", "adjacent_posts_rel_link" );
function remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css' );

//Post Functions
add_theme_support('post-thumbnails', array('post'));
function filmplus_post_thumbnail($width, $height, $lazy='no') {
	global $post;
	$post_id = $post->ID;
	$lazyLoad = '';
	if($lazy == 'yes') $lazyLoad = 'class="lazy" data-';
	if ( has_post_thumbnail($post) ) {
		echo '<img width="'.$width.'" height="'.$height.'" '.$lazyLoad.'src="'.get_the_post_thumbnail_url($post).'" alt="'.get_the_title().'" />'; 
	} 
	elseif (get_post_meta($post_id, 'resim', true)) {
		echo '<img width="'.$width.'" height="'.$height.'" '.$lazyLoad.'src="'.get_post_meta($post_id, 'resim', true).'" alt="'.get_the_title().'" />';
	} 
	else {
		echo '<img width="'.$width.'" height="'.$height.'" '.$lazyLoad.'src="'.get_template_directory_uri().'/images/no-thumbnail.png" alt="'.get_the_title().'" />';
	}
}
function filmplus_flags($meta) {
	global $post;
	$dil = get_post_meta($post->ID, ''.$meta.'', true);
	if($dil == "Turkce Dublaj") echo '<div class="dil-afis"><img src="'.get_bloginfo('template_directory').'/images/dublaj.png" title="Türkçe Dublaj"></div><div class="film-dil">Türkçe Dublaj</div>';
	if($dil == "Yerli Film") echo '<div class="dil-afis"><img src="'.get_bloginfo('template_directory').'/images/dublaj.png" title="Yerli Film"></div><div class="film-dil">Yerli Film</div>';
	if($dil == "Turkce Altyazi") echo '<div class="dil-afis"><i class="far fa-closed-captioning" title="Türkçe Altyazılı"></i></div><div class="film-dil">Türkçe Altyazılı</div>';
	if($dil == "Ingilizce Altyazi") echo '<div class="dil-afis"><img src="'.get_bloginfo('template_directory').'/images/english.png" title="İngilizce Altyazılı"></div><div class="film-dil">İngilizce Altyazılı</div>';
	if($dil == "Altyazisiz") echo '<div class="dil-afis"><img src="'.get_bloginfo('template_directory').'/images/nosub.png" title="Altyazısız" ></div><div class="film-dil">Altyazısız</div>';
	if($dil == "Turkce Altyazi-Dublaj") echo '<div class="dil-afis"><img style="margin-right: 3px;" src="'.get_bloginfo('template_directory').'/images/dublaj.png" title="Türkçe Dublaj" ><i class="far fa-closed-captioning" title="Türkçe Altyazılı"></i></div><div class="film-dil" style="width: calc(100% - 61px);">Dublaj & Altyazı</div>';
}

//Part System
function filmplus_ps( $args = "" ) {
    $defaults = array(
        "before" => "<p>",
        "after" => "</p>",
        "link_before" => "",
        "link_after" => "",
        "pagelink" => "%",
        "echo" => TRUE
    );
    $r = wp_parse_args( $args, $defaults );
    extract( $r, EXTR_SKIP );
    global $page;
    global $numpages;
    global $multipage;
    global $more;
    global $pagenow;
    global $pages;
    $output = "";
    if ( $multipage ) {
		echo "";
		$output .= $before;
		$i = 1;
		while ( $i < $numpages + 1 ) {
			$part_content = $pages[$i - 1];
			$has_part_title = strpos( $part_content, "<!--baslik:" );
			if ( 0 === $has_part_title ) {
				$end = strpos( $part_content, "-->" );
				$title = trim( str_replace( "<!--baslik:", "", substr( $part_content, 0, $end ) ) );
			}
			else {
				$title = "Part&nbsp;".$i;
			}
			$output .= "<li>";
			if ( $i != $page || !$more && $page == 1 ) {
				$output .= _wp_link_page( $i );
			}
			if($i == $page ){
				$output .= '<span class="source"><i class="fas fa-video"></i> Kaynak: ';
			}
			$title = isset( $title ) && 0 < strlen( $title ) ? $title : ". Part";
			$output .= $title;
			if ( $i != $page || !$more && $page == 1 ) {
				$output .= "</a>";
			}
			if($i == $page ){
				$output .= ' <i class="fas fa-caret-down"></i></span>';
			}
			$output .= "</li>";
			$i = $i + 1;
		}
		$output .= $after;
    }
	echo $output;
	return $output;
}
function filmplus_sources(){
    global $post,$pages,$numpages,$page,$more;
    $part_titles = array();
    $part_languages = array();
	$part_qualities = array();
	$title = '';
	for( $i = 0; $i < $numpages; $i++ ) {
		$part_content = $pages[$i];
		$part_title = strpos( $part_content, '<!--baslik:' );
		if( 0 === $part_title ) {
			$end = strpos( $part_content, '-->' );
			$title = trim( str_replace( '<!--baslik:', '', substr( $part_content, 0, $end ) ) );
			$title_array = explode(",", $title);
		}
		if( $title ) {
			array_push( $part_titles, $title_array[0] );
			if(!empty($title_array[1])) {
				array_push( $part_languages, trim(strtolower($title_array[1])));
			}
			else {
				array_push( $part_languages, 'undefined' );
			}
			if(!empty($title_array[2])) {
				array_push( $part_qualities, trim(strtolower($title_array[2])));
			}
			else {
				array_push( $part_qualities, 'undefined' );
			}
		}
		else {
			array_push( $part_titles, 'Kaynak '.($i+1).'' );
		}
	}
	echo '<div class="filmplus_sources"><div class="languages">';
	if (in_array("trd", $part_languages)) {
		echo '<button class="source_button" id="trd"><img src="'.get_bloginfo('template_directory').'/images/dublaj.png" title="Türkçe Dublaj"> Türkçe Dublaj <i class="fas fa-caret-down"></i></button>';
	}
	if (in_array("tra", $part_languages)) {
		echo '<button class="source_button" id="tra"><i class="far fa-closed-captioning caption" title="Türkçe Altyazılı"></i> Türkçe Altyazılı <i class="fas fa-caret-down"></i></button>';
	}
	if (in_array("eng", $part_languages)) {
		echo '<button class="source_button" id="eng"><img src="'.get_bloginfo('template_directory').'/images/english.png" title="İngilizce Altyazılı"> İngilizce Altyazılı <i class="fas fa-caret-down"></i></button>';
	}
	if (in_array("org", $part_languages)) {
		echo '<button class="source_button" id="org"><img src="'.get_bloginfo('template_directory').'/images/nosub.png" title="Altyazısız"> Altyazısız <i class="fas fa-caret-down"></i></button>';
	}
	if (in_array("frg", $part_languages)) {
		echo '<button class="source_button" id="frg"><img src="'.get_bloginfo('template_directory').'/images/frag.png" title="Fragman"> Fragman <i class="fas fa-caret-down"></i></button>';
	}
	echo '</div>';
	echo '<div class="sources">';
	foreach($part_titles as $key => $part_title) {
		if(isset($part_qualities[$key])) {
			if($part_qualities[$key] == "undefined") {
				$quality = '';
			}
			else {
				$quality = '<span class="part_kalite">'.$part_qualities[$key].'</span>';
			}
		}
		else {
			$quality = '';
		}
		if(isset($part_languages[$key])) {
			$dil = 'dil="'.$part_languages[$key].'"';
		}
		else {
			$dil = '';
		}
		if ( ($key+1 != $page) || ((!$more) && ($page==1)) ) {
			echo _wp_link_page($key+1).'<span class="dil" '.$dil.'>'.$part_title.''.$quality.'</span></a>';
		}	
		else {
			echo '<span class="dil current_dil" '.$dil.'>'.$part_title.''.$quality.'</span>';
			if(isset($part_languages[$key])):
				?>
				<script>
				$( document ).ready(function() {
					$("#<?php echo $part_languages[$key];?>").trigger("click");
				});
				</script>
				<?php
			endif;
		}
	}
	echo '</div></div>';
	$lang_unique = array_unique($part_languages);
	if((count($lang_unique) == 1 && $lang_unique[0] == "undefined") || empty($title)) {
		?>
		<style>.dil { display:inline-block!important;}</style>
		<?php
	}
	if (get_post_meta( $post->ID, 'indir', true )) {
		?>
		<style>
		.filmplus_sources { width: calc(100% - 346px)!important; }
		@media screen and (max-width: 1000px) {.filmplus_sources { width: 100%!important; }}
		</style>
		<?php
	}
}

//Comment Functions
function filmplus_comment_excerpt( $comment_ID = 0 ) {
    $comment         = get_comment( $comment_ID );
    $comment_excerpt = $comment->comment_content;
    return apply_filters( 'filmplus_comment_excerpt', $comment_excerpt, $comment->comment_ID );
}
function filmplus_get_popular_comment($post_id,$minvote,$mincomment) {
	$comments = get_comments(array('post_id'=>$post_id, 'status' => 'approve'));
	$c_array = array();
	$arr = array();
	foreach($comments as $comment) {
		array_push($c_array,$comment->comment_ID);
	}
	for($i=0;$i<count($c_array);$i++) {
		$clc = get_comment_meta( $c_array[$i], 'cld_like_count') ;
		$cdc = get_comment_meta( $c_array[$i], 'cld_dislike_count');
		if(!isset($clc[0])) {$lc = 0;} else { $lc = $clc[0]; }
		if(!isset($cdc[0])) {$dc = 0;} else { $dc = $cdc[0] ;}
		$arr[$i] = $lc+$dc;
	}
	if(!empty($c_array)) {
	    $value = array_search(max($arr), $arr);
	    if(max($arr) > $minvote - 1 && count($c_array) > $mincomment - 1) filmplus_get_comment_by_id($c_array[$value]);
	}
}
function filmplus_get_comment_by_id( $comment_id ) {
	$comment = get_comment( $comment_id );
	$uname = get_the_author_meta( 'user_nicename', $comment->user_id ); 
	$usid = $comment_id ;
	$user_id   = get_comment($usid)->user_id;
	$user_info = get_userdata($user_id );
	$clc = get_comment_meta( $comment_id, 'cld_like_count') ;
	$cdc = get_comment_meta( $comment_id, 'cld_dislike_count');
	if(!isset($clc[0])) {$lc = 0;} else { $lc = $clc[0]; }
	if(!isset($cdc[0])) {$dc = 0;} else { $dc = $cdc[0] ;}
	if ( ! empty( $comment ) ) {
	?>
	<ul class="commentlist">
		<li class="even thread-odd thread-alt" style=" border-left: 3px solid #ffd70d; ">
			<div class="comment-body">
				<div class="comment-author vcard">
				<?php echo get_avatar($comment->user_id); ?>
				<?php
				if($user_info) {
					$rol = $user_info->roles;
				}
				if ($user_id) {
					if ( $rol[0] == 'administrator') {
						printf( __( '<a href="%s"><cite class="fn">%s</cite></a><cite id="userrole">%s</cite>' ), site_url('/profil/' . $uname) ,$uname, filmplus_yonetici); 
					} 
					elseif ($rol[0] == 'editor') {
						printf( __( '<a href="%s"><cite class="fn">%s</cite></a><cite id="userrole">%s</cite>' ), site_url('/profil/' . $uname) ,get_comment_author_link($comment_id), filmplus_editor); 
					}
					elseif ($rol[0] == 'cevirmen') {
						printf( __( '<a href="%s"><cite class="fn">%s</cite></a><cite id="userrole">%s</cite>' ), site_url('/profil/' . $uname) ,get_comment_author_link($comment_id), filmplus_cevirmen); 
					}
					else {
						printf( __( '<a href="%s"><cite class="fn">%s</cite></a><cite id="userrole">%s</cite>' ), site_url('/profil/' . $uname) ,get_comment_author_link($comment_id), filmplus_kayitli_uye); 
					}
				} 
				else {
					printf( __( '<cite class="fn">%s</cite><cite id="userrole">%s</cite>' ), get_comment_author_link($comment_id), filmplus_misafir); 
				}
				?>
				</div>
				<div class="comment-meta commentmetadata popularcomment">
					<i class="fas fa-star"></i> <?php echo filmplus_populer_yorum;?>
				</div>
				<p><?php comment_text($comment_id); ?></p>
				<div class="reply">
					<a rel="nofollow" class="comment-reply-link" href="<?php echo ''.get_permalink().'?replytocom='.$comment_id.'#respond';?>" data-respondelement="respond"><?php echo filmplus_cevapla;?></a>
				</div>
			</div>
		</li>
	</ul>
	<?php 
    } 
	else {
		echo '';
    }
}
function filmplus_comment($comment, $args, $depth) {
	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
        $add_below = 'comment';
    } 
	else {
		$tag       = 'li';
        $add_below = 'div-comment';
    }
	?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>">
	<?php 
    if ( 'div' != $args['style'] ) { 
	?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php
    } 
	?>
		<div class="comment-author vcard">
	<?php 
	if ( $args['avatar_size'] != 0 ) {
		echo get_avatar( $comment, $args['avatar_size'] ); 
    } 
	$uname = get_the_author_meta( 'user_nicename', $comment->user_id ); 
	$usid = get_comment_ID();
	$user_id   = get_comment($usid)->user_id;
	$user_info = get_userdata($user_id );
	if($user_info) {
		$rol = $user_info->roles;
	}
		if ($user_id) {
			if ( $rol[0] == 'administrator') {
				printf( __( '<a href="%s"><cite class="fn">%s</cite></a><cite id="userrole">%s</cite>' ), site_url('/profil/' . $uname) ,$uname, filmplus_yonetici); 
			} 
			elseif ($rol[0] == 'editor') {
				printf( __( '<a href="%s"><cite class="fn">%s</cite></a><cite id="userrole">%s</cite>' ), site_url('/profil/' . $uname) ,get_comment_author_link(), filmplus_editor); 
			} 
			elseif ($rol[0] == 'cevirmen') {
				printf( __( '<a href="%s"><cite class="fn">%s</cite></a><cite id="userrole">%s</cite>' ), site_url('/profil/' . $uname) ,get_comment_author_link(), filmplus_cevirmen); 
			} 
			else {
				printf( __( '<a href="%s"><cite class="fn">%s</cite></a><cite id="userrole">%s</cite>' ), site_url('/profil/' . $uname) ,get_comment_author_link(), filmplus_kayitli_uye); 
			}
		} 
		else {
            printf( __( '<cite class="fn">%s</cite><cite id="userrole">%s</cite>' ), get_comment_author_link(), filmplus_misafir); 
		}
		?>
        </div>
		<?php 
        if ( $comment->comment_approved == '0' ) { 
			?>
				<em class="comment-awaiting-moderation"><?php _e( filmplus_moderator_onayi ); ?></em><br/>
			<?php 
        } 
		?>
        <div class="comment-meta commentmetadata">
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
                printf( 
                    __('%1$s at %2$s'), 
                    get_comment_date(),  
                    get_comment_time() 
                ); ?>
            </a><?php 
            edit_comment_link( __( '(Düzenle)' ), '  ', '' ); ?>
        </div>
        <?php comment_text(); ?>
        <div class="reply"><?php 
                comment_reply_link( 
                    array_merge( 
                        $args, 
                        array( 
                            'add_below' => $add_below, 
                            'depth'     => $depth, 
                            'max_depth' => $args['max_depth'] 
                        ) 
                    ) 
                ); ?>
        </div><?php 
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}

//Shortcodes for Comments
add_filter( 'comment_excerpt', 'shortcode_unautop');
add_filter( 'comment_excerpt', 'do_shortcode');
add_filter( 'filmplus_comment_excerpt', 'shortcode_unautop');
add_filter( 'filmplus_comment_excerpt', 'do_shortcode');
add_filter( 'comment_text', 'shortcode_unautop');
add_filter( 'comment_text', 'do_shortcode');

//Spoiler
function filmplus_spoiler_func( $atts, $content = null ) {
	$default_title = __(''.filmplus_spoiler_iceren_alan.'');
	$helptext_show = __('fa-exclamation-circle');
	$helptext_hide = __('fa-exclamation-circle');
	extract( 
		shortcode_atts( 
		array(
			'title' => filmplus_spoiler_iceren_alan,
		), 
		$atts 
		) 
	);
	$spoiler = 
	'<div class="filmplus_spoiler">' .
	'<p class="filmplus_spoiler_header" ' . 
	'data-filmplus-spoiler-show="' . $helptext_show .'" '.
	'data-filmplus-spoiler-hide="' . $helptext_hide . '">' . $title . '</p>' .
	'<div class="filmplus_spoiler_content">' .
	do_shortcode($content) . 
	'</div>' . 
	'</div>';
	return $spoiler;
}
add_shortcode( 'spoiler', 'filmplus_spoiler_func' );

//Facebook - Instagram - Twitter Fields
function show_extra_profile_fields($user) {
    ?>
	<h2>Sosyal Hesaplar</h2>
	<table class="form-table">
		<tbody>
				<tr class="user-user-login-wrap">
					<th>
						<label for="facebook">Facebook Kullanıcı Adı</label>
					</th>
					<td>
						<input type="text" id="facebook" name="facebook" value="<?php echo esc_attr(get_the_author_meta('facebook', $user->ID)) ?>" placeholder="@kullaniciadi" class="regular-text">
					</td>
				</tr>
                <tr class="user-user-login-wrap">
					<th>
						<label for="twitter">Twitter Kullanıcı Adı</label>
					</th>
					<td>
						<input type="text" id="twitter" name="twitter" value="<?php echo esc_attr(get_the_author_meta('twitter', $user->ID)) ?>" placeholder="@kullaniciadi" class="regular-text">
					</td>
                </tr>
                <tr class="user-user-login-wrap">
					<th>
						<label for="instagram">Instagram Kullanıcı Adı</label>
					</th>
					<td>
						<input type="text" id="instagram" name="instagram" value="<?php echo esc_attr(get_the_author_meta('instagram', $user->ID)) ?>" placeholder="@kullaniciadi" class="regular-text">
					</td>
                </tr>
		</tbody>
	</table>
    <?php
}
add_action('show_user_profile', 'show_extra_profile_fields');
add_action('edit_user_profile', 'show_extra_profile_fields');
function update_extra_profile_fields($user_id) {
	if (current_user_can('edit_user', $user_id)){
		update_user_meta($user_id, 'facebook', $_POST['facebook']);
        update_user_meta($user_id, 'twitter', $_POST['twitter']);
        update_user_meta($user_id, 'instagram', $_POST['instagram']);
    }
}
add_action('personal_options_update', 'update_extra_profile_fields');
add_action('edit_user_profile_update', 'update_extra_profile_fields');

//Register Form
function isUsernameValid($string){
	if(preg_match('/[^a-zA-Z0-9_]/', $string) == 0) {
        return true;
    }
    else {
		return false;
	}
}
function filmplus_registration(){
	if( $_POST['action'] == 'register_action' ) {
		$error = '';
		$response=$_POST["captcha"];
		$username = trim( $_POST['username'] );
		$email = trim( $_POST['email'] );
		$fname = trim( $_POST['firstname'] );
		$lname = trim( $_POST['lastname'] );
		$pswrd = $_POST['passwrd'];
		$pswrd2 = $_POST['passwrd2'];
		if(email_exists($email) )
			$error .= '<li class="error">'.filmplus_email_kayitli.'</li>';
		if(username_exists($username) )
			$error .= '<li class="error">'.filmplus_kullanici_kayitli.'</li>';
		if( !isUsernameValid($username) )
			$error .= '<li class="error">'.filmplus_kullanici_gecersiz.'</li>';
		if( empty( $username ) )
			$error .= '<li class="error">'.filmplus_kullanici_girilmedi.'</li>';
		if( empty( $email ) )
			$error .= '<li class="error">'.filmplus_email_girilmedi.'</li>';
		elseif( !filter_var($email, FILTER_VALIDATE_EMAIL) )
			$error .= '<li class="error">'.filmplus_gecerli_mail.'</li>';
		if( empty( $pswrd ) || empty( $pswrd2 ))
			$error .= '<li class="error">'.filmplus_parola_girilmedi.'</li>';
		if(strlen($username) < 5)
			$error .= '<li class="error">'.filmplus_kullanici_karakter.'</li>';
		if(strlen($pswrd) < 5)
			$error .= '<li class="error">'.filmplus_parola_karakter.'</li>';
		if ($pswrd <> $pswrd2)
			$error .= '<li class="error">'.filmplus_parola_uyusmuyor.'</li>';
		if (!$response)
			$error .= '<li class="error">'.filmplus_robot.'</li>';
		if( empty( $error ) ){
			$user_data = array(
				'user_login' => $username,
				'user_email' => $email,
				'user_pass' => $pswrd,
				'first_name' => $fname,
				'last_name' => $lname,
				'role' => 'subscriber'
			);
			$status = wp_insert_user($user_data);
			wp_new_user_notification($status, null, 'admin'); 
			if( is_wp_error($status) ){
				$msg = '';
				foreach( $status->errors as $key=>$val ){
					foreach( $val as $k=>$v ){
						$msg = '<li class="error">'.$v.'</li>';
					}
				}
				echo $msg;
			}
			else {
				$msg = '<li class="success">'.filmplus_kayit_basarili.'</li>';
			echo $msg;
			}
		}
		else {
			echo $error;
		}
		die(1);
	}
}
add_action( 'wp_ajax_register_action', 'filmplus_registration' );
add_action( 'wp_ajax_nopriv_register_action', 'filmplus_registration' );
function ajax_register() {
    wp_register_script ( 
        'ajax-register',
        get_stylesheet_directory_uri() . '/js/ajax-register.js',
        array( 'jquery' ),
        '1.0',
        true
    );
    wp_localize_script (
        'ajax-register',
        'user_ajax_register',
        array(
            'ajax_url'   => admin_url( 'admin-ajax.php' )
        )
    );
    wp_enqueue_script( 'ajax-register' );
}
add_action( 'wp_enqueue_scripts', 'ajax_register' );

//Profile Update Form
function filmplus_profile_update(){
	$current_user = wp_get_current_user();
	if( $_POST['action'] == 'update_action' ) {
		$error = '';
		$response=$_POST["captcha"];
		$email = trim( $_POST['email'] );
		$pswrd = $_POST['passwrd'];
		$pswrd2 = $_POST['passwrd2'];
		if( empty( $_POST['firstname'] ) && empty( $_POST['lastname'] ) ){
			$displayname = $current_user->user_nicename;
		} 
		else {
			$displayname = ''.esc_attr( $_POST['firstname'] ).' '.esc_attr( $_POST['lastname'] ).'';
		}
		if( email_exists( $email ) && ( email_exists( $email ) != $current_user->ID ) )
			$error .= '<li class="error">'.filmplus_email_kayitli.'</li>';
		if( empty( $email ) )
			$error .= '<li class="error">'.filmplus_email_girilmedi.'</li>';
		elseif( !filter_var($email, FILTER_VALIDATE_EMAIL) )
			$error .= '<li class="error">'.filmplus_gecerli_mail.'</li>';
		if((!empty( $pswrd ) || !empty( $pswrd2 )) && strlen($pswrd) < 5)
			$error .= '<li class="error">'.filmplus_parola_karakter.'</li>';
		if((!empty( $pswrd ) || !empty( $pswrd2 )) && $pswrd <> $pswrd2)
			$error .= '<li class="error">'.filmplus_parola_uyusmuyor.'</li>';
		if (!$response)
			$error .= '<li class="error">'.filmplus_robot.'</li>';
		if( empty( $error ) ){
			$status = wp_update_user( array( 'ID' => $current_user->ID, 'display_name' => $displayname, 'user_email' => $email ) );
			if(!empty( $pswrd ) && !empty( $pswrd2 )){
				$status = wp_update_user( array( 'ID' => $current_user->ID, 'display_name' => $displayname, 'user_pass' => esc_attr( $pswrd ) ) );
			}
			update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['about'] ) );
			update_user_meta( $current_user->ID, 'facebook', esc_attr( $_POST['facebook'] ) );
			update_user_meta( $current_user->ID, 'twitter', esc_attr( $_POST['twitter'] ) );
			update_user_meta( $current_user->ID, 'instagram', esc_attr( $_POST['instagram'] ) );
			update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['firstname'] ) );
			update_user_meta( $current_user->ID, 'last_name', esc_attr( $_POST['lastname'] ) );
			if( is_wp_error($status) ){
				$msg = '';
				foreach( $status->errors as $key=>$val ){
					foreach( $val as $k=>$v ){
						$msg = '<li class="error">'.$v.'</li>';
					}
				}
				echo $msg;
			}
			else {
				$msg = '<li class="success">'.filmplus_guncelleme_basarili.'</li>';
				echo $msg;
			}
		}
		else {
			echo $error;
		}
		die(1);
	}
}
add_action( 'wp_ajax_update_action', 'filmplus_profile_update' );
add_action( 'wp_ajax_nopriv_update_action', 'filmplus_profile_update' );
function ajax_profile_update() {
    wp_register_script ( 
        'ajax-profile-update',
        get_stylesheet_directory_uri() . '/js/ajax-profile-update.js',
        array( 'jquery' ),
        '1.0',
        true
    );
    wp_localize_script (
        'ajax-profile-update',
        'user_ajax_profile_update',
        array(
            'ajax_url'   => admin_url( 'admin-ajax.php' )
        )
    );
    wp_enqueue_script( 'ajax-profile-update' );
}
add_action( 'wp_enqueue_scripts', 'ajax_profile_update' );

//Pagination
function filmplus_sayfalama($pages = '', $range = 3) {
	$showitems = ($range * 2)+1;
	global $paged;
	if(empty($paged)) $paged = 1;
	if($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages) {
			$pages = 1;
		}
	}
	if(1 != $pages) {
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; İlk</a>";
		if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&laquo;</a>";
		for ($i=1; $i <= $pages; $i++){
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
				echo ($paged == $i)? "<strong class='on'>".$i."</strong>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
			}
		}
		if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&raquo;</a>";
		if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Son &raquo;</a>";
	}
}

//Users List
function ajax_users_list() {
    wp_register_script ( 
        'ajax-users-list',
        get_stylesheet_directory_uri() . '/js/ajax-users-list.js',
        array( 'jquery' ),
        '1.0',
        true
    );
    $ajax_nonce = wp_create_nonce( 'usl-ajax-nonce' );
    wp_localize_script (
        'ajax-users-list',
        'users_list_ajax',
        array(
            'ajax_url'   => admin_url( 'admin-ajax.php' ),
            'admin_ajax_nonce' => $ajax_nonce
        )
    );
    wp_enqueue_script( 'ajax-users-list' );
}
add_action( 'wp_enqueue_scripts', 'ajax_users_list' );
function check_post_exists($ID){
	if(get_post_status($ID) === FALSE){
		return false;
	}
	else {
		return true;
	}
}
function filmplus_add_to_favorite_list(){
    if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'usl-ajax-nonce' ) ) {
	    $user_id = get_current_user_id();
	    $users_fav_list = get_user_meta($user_id,'users_fav_list',true);
	    if(empty($users_fav_list)) $users_fav_list = array();
	    $fav_post_id = $_POST["fav_add_post_id"];
    	if(isset($fav_post_id) && is_user_logged_in() && check_post_exists($fav_post_id) && !in_array($fav_post_id, $users_fav_list)){
		    $users_fav_list[] = $fav_post_id;
		    update_user_meta($user_id,'users_fav_list',$users_fav_list);
	    }
    }
}
add_action( 'wp_ajax_add_to_favorite_action', 'filmplus_add_to_favorite_list' );
add_action( 'wp_ajax_nopriv_add_to_favorite_action', 'filmplus_add_to_favorite_list' );
function filmplus_rem_from_favorite_list(){
    if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'usl-ajax-nonce' ) ) {
	    $user_id = get_current_user_id();
	    $users_fav_list = get_user_meta($user_id,'users_fav_list',true);
	    $fav_post_id = $_POST["fav_rem_post_id"];
	    if(isset($fav_post_id) && is_user_logged_in()&& check_post_exists($fav_post_id)){
	    	if(count($users_fav_list) == 1 && in_array($fav_post_id, $users_fav_list)){
	    		delete_user_meta($user_id,'users_fav_list');
	    	}
	    	else {
		    	$users_fav_list = array_diff($users_fav_list, array($fav_post_id));
		    	$users_fav_list = array_values($users_fav_list);
			    update_user_meta($user_id,'users_fav_list',$users_fav_list);
		    }
	    }
    }
}
add_action( 'wp_ajax_rem_from_favorite_action', 'filmplus_rem_from_favorite_list' );
add_action( 'wp_ajax_nopriv_rem_from_favorite_action', 'filmplus_rem_from_favorite_list' );
function filmplus_add_to_watchlater_list(){
    if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'usl-ajax-nonce' ) ) {
	    $user_id = get_current_user_id();
    	$users_wl_list = get_user_meta($user_id,'users_wl_list',true);
	    if(empty($users_wl_list)) $users_wl_list = array();
	    $wl_post_id = $_POST["wl_add_post_id"];
	    if(isset($wl_post_id) && is_user_logged_in() && check_post_exists($wl_post_id) && !in_array($wl_post_id, $users_wl_list)){
		    $users_wl_list[] = $wl_post_id;
		    update_user_meta($user_id,'users_wl_list',$users_wl_list);
	    }
    }
}
add_action( 'wp_ajax_add_to_watchlater_action', 'filmplus_add_to_watchlater_list' );
add_action( 'wp_ajax_nopriv_add_to_watchlater_action', 'filmplus_add_to_watchlater_list' );
function filmplus_rem_from_watchlater_list(){
    if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'usl-ajax-nonce' ) ) {
	    $user_id = get_current_user_id();
	    $users_wl_list = get_user_meta($user_id,'users_wl_list',true);
    	$wl_post_id = $_POST["wl_rem_post_id"];
	    if(isset($wl_post_id) && is_user_logged_in()&& check_post_exists($wl_post_id)){
	    	if(count($users_wl_list) == 1 && in_array($wl_post_id, $users_wl_list)){
	    		delete_user_meta($user_id,'users_wl_list');
	    	}
	    	else {
		    	$users_wl_list = array_diff($users_wl_list, array($wl_post_id));
		    	$users_wl_list = array_values($users_wl_list);
		    	update_user_meta($user_id,'users_wl_list',$users_wl_list);
	    	}
    	}
    }
}
add_action( 'wp_ajax_rem_from_watchlater_action', 'filmplus_rem_from_watchlater_list' );
add_action( 'wp_ajax_nopriv_rem_from_watchlater_action', 'filmplus_rem_from_watchlater_list' );
function filmplus_add_to_watched_list(){
    if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'usl-ajax-nonce' ) ) {
	    $user_id = get_current_user_id();
    	$users_wh_list = get_user_meta($user_id,'users_wh_list',true);
	    if(empty($users_wh_list)) $users_wh_list = array();
    	$wh_post_id = $_POST["wh_add_post_id"];
	    if(isset($wh_post_id) && is_user_logged_in() && check_post_exists($wh_post_id) && !in_array($wh_post_id, $users_wh_list)){
	    	$users_wh_list[] = $wh_post_id;
		    update_user_meta($user_id,'users_wh_list',$users_wh_list);
	    }
    }
}
add_action( 'wp_ajax_add_to_watched_action', 'filmplus_add_to_watched_list' );
add_action( 'wp_ajax_nopriv_add_to_watched_action', 'filmplus_add_to_watched_list' );
function filmplus_rem_from_watched_list(){
    if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'usl-ajax-nonce' ) ) {
	    $user_id = get_current_user_id();
    	$users_wh_list = get_user_meta($user_id,'users_wh_list',true);
	    $wh_post_id = $_POST["wh_rem_post_id"];
	    if(isset($wh_post_id) && is_user_logged_in()&& check_post_exists($wh_post_id)){
	    	if(count($users_wh_list) == 1 && in_array($wh_post_id, $users_wh_list)){
		    	delete_user_meta($user_id,'users_wh_list');
	    	}
		    else {
		    	$users_wh_list = array_diff($users_wh_list, array($wh_post_id));
		    	$users_wh_list = array_values($users_wh_list);
		    	update_user_meta($user_id,'users_wh_list',$users_wh_list);
	    	}
	    }
    }
}
add_action( 'wp_ajax_rem_from_watched_action', 'filmplus_rem_from_watched_list' );
add_action( 'wp_ajax_nopriv_rem_from_watched_action', 'filmplus_rem_from_watched_list' );
function filmplus_display_remove_from_watchlater(){
	global $post;
	$post_id = $post->ID;
	?>
	<button class="wl<?php echo $post_id;?> wl_rem" role="rem_wl" post_id="<?php echo $post_id;?>"><i class="fas fa-times"></i></button>
	<?php
}
function filmplus_display_remove_from_watched(){
	global $post;
	$post_id = $post->ID;
	?>
	<button class="wh<?php echo $post_id;?> wl_rem" role="rem_wh" post_id="<?php echo $post_id;?>"><i class="fas fa-times"></i></button>
	<?php
}
function filmplus_display_remove_from_favorite(){
	global $post;
	$post_id = $post->ID;
	?>
	<button class="fav<?php echo $post_id;?> wl_rem" role="rem_fav" post_id="<?php echo $post_id;?>"><i class="fas fa-times"></i></button>
	<?php
}
function filmplus_list(){
	global $post;
	$post_id = $post->ID;
	$us_id = get_current_user_id();
	$users_wh_list = get_user_meta($us_id,'users_wh_list',true);
	$users_fav_list = get_user_meta($us_id,'users_fav_list',true);
	$users_wl_list = get_user_meta($us_id,'users_wl_list',true);
	if(empty($users_wh_list)) $users_wh_list = array();
	if(empty($users_fav_list)) $users_fav_list = array();
	if(empty($users_wl_list)) $users_wl_list = array();
	if(is_user_logged_in()){
	?>
		<div class="list">
			<button class="addToList"><i class="fas fa-plus-square"></i> <?php echo filmplus_listeye_ekle;?></button>
			<ul class="listMenu" style="display:none">
				<?php if (in_array($post_id, $users_fav_list)):?>
				<li><a href="#" class="fav<?php echo $post_id;?> favActive" role="rem_fav" post_id="<?php echo $post_id;?>"><i class="fas fa-star"></i> <?php echo filmplus_favoriler;?></a></li>
				<?php else:?>
				<li><a href="#" class="fav<?php echo $post_id;?>" role="add_fav" post_id="<?php echo $post_id;?>"><i class="fas fa-star"></i> <?php echo filmplus_favoriler;?></a></li>
				<?php endif;?>
				<?php if (in_array($post_id, $users_wh_list)):?>
				<li><a href="#" class="wh<?php echo $post_id;?> whActive" role="rem_wh" post_id="<?php echo $post_id;?>"><i class="fa fa-check-circle"></i> <?php echo filmplus_izlenenler;?></a></li>
				<?php else:?>
				<li><a href="#" class="wh<?php echo $post_id;?>" role="add_wh" post_id="<?php echo $post_id;?>"><i class="fa fa-check-circle"></i> <?php echo filmplus_izlenenler;?></a></li>
				<?php endif;?>
				<?php if (in_array($post_id, $users_wl_list)):?>
				<li><a href="#" class="wl<?php echo $post_id;?> wlActive" role="rem_wl" post_id="<?php echo $post_id;?>"><i class="fas fa-history"></i> <?php echo filmplus_izlenecekler;?></a></li>
				<?php else:?>
				<li><a href="#" class="wl<?php echo $post_id;?>" role="add_wl" post_id="<?php echo $post_id;?>"><i class="fas fa-history"></i> <?php echo filmplus_izlenecekler;?></a></li>
				<?php endif;?>
			</ul>
		</div>
	<?php
	}
	else {
	?>
		<div class="list">
			<button class="addToList"><i class="fas fa-plus-square"></i> <?php echo filmplus_listeye_ekle;?></button>
			<ul class="listMenu" style="display:none">
				<li><a href="#" class="simplemodal-login"><i class="fas fa-star"></i> <?php echo filmplus_favoriler;?></a></li>
				<li><a href="#" class="simplemodal-login"><i class="fa fa-check-circle"></i> <?php echo filmplus_izlenenler;?></a></li>
				<li><a href="#" class="simplemodal-login"><i class="fas fa-history"></i> <?php echo filmplus_izlenecekler;?></a></li>
			</ul>
		</div>
	<?php
	}
}

//Login - Forgot Password Modals
if (!class_exists('SimpleModalLogin')) {
	class SimpleModalLogin {
		var $optionsName = 'simplemodal_login_options';
		var $nonce = 'simplemodal-login-update-options';
		var $themeUrl = '';
		var $options = array();
		var $users_can_register = null;
		function __construct() {
			$this->themeUrl = get_template_directory_uri();
			$this->get_options();
			$this->version="1.1";
			if (!is_admin()) {
				$secure = ( 'https' === parse_url( site_url(), PHP_URL_SCHEME ) && 'https' === parse_url( home_url(), PHP_URL_SCHEME ) );
				setcookie( TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN, $secure );
				if ( SITECOOKIEPATH != COOKIEPATH )
					setcookie( TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN, $secure );
				add_filter('login_redirect', array(&$this, 'login_redirect'), 5, 3);
				add_filter('register', array(&$this, 'register'));
				add_filter('loginout', array(&$this, 'login_loginout'));
				add_action('wp_footer', array($this, 'login_footer'));
				add_action('wp_print_scripts', array(&$this, 'login_js'));
			}
		}
		function check_options() {
			$options = null;
			if (!$options = get_option($this->optionsName)) {
				$options = array(
					'shortcut' => true,
					'theme' => 'default',
					'version' => $this->version,
					'registration' => $this->users_can_register,
					'reset' => true
				);
				update_option($this->optionsName, $options);
			}
			else {
				if (isset($options['version'])) {
					if ($options['version'] < '1.1') {
					}
				}
				else {
					if (isset($options['admin'])) {
						unset($options['admin']);
						$options['shortcut'] = true;
						$options['version'] = $this->version;
						$options['registration'] = $this->users_can_register;
						$options['reset'] = true;
						update_option($this->optionsName, $options);
					}
				}
			}
			return $options;
		}
		function get_options() {
			$options = $this->check_options();
			$this->options = $options;
		}
		function is_ajax() {
			return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
					&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
		}
		function login_footer() {
			$output = '<div id="simplemodal-login-form" style="display:none">';
			$login_form = $this->login_form();
			$output .= apply_filters('simplemodal_login_form', $login_form);
			if ($this->users_can_register && $this->options['registration']) {
				$registration_form = $this->registration_form();
				$output .= apply_filters('simplemodal_registration_form', $registration_form);
			}
			if ($this->options['reset']) {
				$reset_form = $this->reset_form();
				$output .= apply_filters('simplemodal_reset_form', $reset_form);
			}
			$output .= '</div>';
			echo $output;
		}
		function login_form() {
			$output = sprintf('
	<form name="loginform" id="loginform" action="%s" method="post">
		<div class="title">%s</div>
		<div class="simplemodal-login-fields">
		<p>
			<label>%s<br />
			<input type="text" name="log" class="user_login input" placeholder="'.filmplus_kullanici_adi.'" value="" size="20" tabindex="10" /></label>
		</p>
		<p>
			<label>%s<br />
			<input type="password" name="pwd" class="user_pass input" placeholder="'.filmplus_parolaniz2.'" value="" size="20" tabindex="20" /></label>
		</p>',
				site_url('wp-login.php', 'login_post'),
				__('<span class="title-border bd-purple"><i class="fas fa-sign-in-alt"></i> '.filmplus_uye_girisi.'</span>', 'simplemodal-login'),
				__('', 'simplemodal-login'),
				__('', 'simplemodal-login')
			);
			ob_start();
			do_action('login_form');
			$output .= ob_get_clean();
			$output .= sprintf('
		<p class="forgetmenot"><label><input name="rememberme" checked="checked" type="checkbox" id="rememberme" class="rememberme" value="forever" tabindex="90" /> %s</label></p>
		<p class="submit">
			<input type="submit" name="wp-submit" value="%s" tabindex="100" />
			<input type="button" class="simplemodal-close" value="%s" tabindex="101" />
			<input type="hidden" name="redirect_to" value="'.get_bloginfo('url') . '" />
		</p>
		<p class="nav">',
				__(''.filmplus_beni_hatirla.'', 'simplemodal-login'),
				__(''.filmplus_giris_yap.'', 'simplemodal-login'),
				__('×', 'simplemodal-login')
			);
			if ($this->options['reset']) {
				$output .= sprintf('<a class="simplemodal-forgotpw" href="%s" title="%s">%s</a>',
					site_url('wp-login.php?action=lostpassword', 'login'),
					__('Password Lost and Found', 'simplemodal-login'),
					__(''.filmplus_parolani_unuttun.'', 'simplemodal-login')
				);
			}
			$output .= '
			</p>
			</div>
			<div class="simplemodal-login-activity" style="display:none;"></div>
		</form>';
			return $output;
		}
		function login_js() {
			global $wp_scripts;
			if (isset($wp_scripts->registered['jquery-simplemodal'])
					&& version_compare($wp_scripts->registered['jquery-simplemodal']->ver, $this->simplemodalVersion) === -1) {
				wp_deregister_script('jquery-simplemodal');
			}
			wp_enqueue_script('jquery-simplemodal', $this->themeUrl . '/js/jquery.simplemodal.js', array('jquery'), '1.1', true);
			wp_enqueue_script('simplemodal-login', $this->themeUrl . '/js/simplemodal.js', null, $this->version, true);
			wp_localize_script('simplemodal-login', 'SimpleModalLoginL10n', array(
				'shortcut' => $this->options['shortcut'] ? 'true' : 'false',
				'logged_in' => is_user_logged_in() ? 'true' : 'false',
				'admin_url' => get_admin_url(),
				'empty_username' => __('<strong>'.filmplus_hata.'</strong>: '.filmplus_kullanici_girilmedi.'', 'simplemodal-login'),
				'empty_password' => __('<strong>'.filmplus_hata.'</strong>: '.filmplus_parola_girilmedi.'', 'simplemodal-login'),
				'empty_email' => __('<strong>'.filmplus_hata.'</strong>: '.filmplus_email_girilmedi.'', 'simplemodal-login'),
				'empty_all' => __('<strong>'.filmplus_hata.'</strong>: '.filmplus_tum_alanlar_gerekli.'', 'simplemodal-login')
			));
		}
		function login_loginout($link) {
			if (!is_user_logged_in()) {
				$link = str_replace('href=', 'class="simplemodal-login" href=', $link);
			}
			return $link;
		}
		function login_redirect($redirect_to, $req_redirect_to, $user) {
			if (!isset($user->user_login) || !$this->is_ajax()) {
				return $redirect_to;
			}
			if (function_exists('redirect_to_front_page')) {
				$redirect_to = redirect_to_front_page($redirect_to, $req_redirect_to, $user);
			}
			echo "<div id='simplemodal-login-redirect'>$redirect_to</div>";
			exit();
		}
		function reset_form() {
			$output = sprintf('
	<form name="lostpasswordform" id="lostpasswordform" action="%s" method="post">
		<div class="title">%s</div>
		<div class="simplemodal-login-fields">
		<p>
			<label>%s<br />
			<input type="text" name="user_login" class="user_login input" placeholder="'.filmplus_mail_veya_kullanici.'" value="" size="20" tabindex="10" /></label>
		</p>',
				site_url('wp-login.php?action=lostpassword', 'login_post'),
				__('<span class="title-border bd-purple"><i class="fa fa-question-circle"></i> '.filmplus_parola_sifirla.'</span>', 'simplemodal-login'),
				__('', 'simplemodal-login')
			);
			ob_start();
			do_action('lostpassword_form');
			$output .= ob_get_clean();
			$output .= sprintf('
		<p class="submit">
			<input type="submit" name="wp-submit" value="%s" tabindex="100" />
			<input type="button" class="simplemodal-close" value="%s" tabindex="101" />
		</p>
		<p class="nav">
			<a class="simplemodal-login" href="%s">%s</a>',
				__(''.filmplus_yeni_parola_al.'', 'simplemodal-login'),
				__('×', 'simplemodal-login'),
				site_url('wp-login.php', 'login'),
				__(''.filmplus_giris_yap.'', 'simplemodal-login')
			);
			$output .= '
		</p>
		</div>
		<div class="simplemodal-login-activity" style="display:none;"></div>
	</form>';
			return $output;
		}
		function save_admin_options(){
			return update_option($this->optionsName, $this->options);
		}
	}
}
if (class_exists('SimpleModalLogin')) {
	$simplemodal_login = new SimpleModalLogin();
	$simplemodal_login->users_can_register = get_option('users_can_register') ? true : false;
}

//Translator User Role
add_role(
    'cevirmen',
    __( 'Çevirmen' ),
    array(
        'read'         => false, 
        'edit_posts'   => false,
    )
);

// Ads
function pageskin_reklam() {
	$url1 = get_option('filmplus_r_ps_ps1') ;
	$url2 = get_option('filmplus_r_ps_ps2') ;
	$psad = '<style>@media only screen and (max-width: 1000px) {.body-clickable{display:none}}.body-clickable { position: fixed; top: 0; left: 0; z-index: 1; height: 100%; width: 100%; background: url('.$url1.') no-repeat fixed center 0px #000000; cursor: pointer; }</style> <div class="body-clickable"></div> <script> $(document).ready(function() { $(".body-clickable").click(function(ps){ if (ps.target === this) { window.open("'.$url2.'", "_blank"); } }); }); </script>';
	echo $psad;
}
function footer_reklam() {
	$fUrl1 = get_option('filmplus_r_f_f1') ;
	$fUrl2 = get_option('filmplus_r_f_f2') ;
	$fAdCode = get_option('filmplus_r_f_f3') ;
	$fAd = '<div id="footerad"><a rel="nofollow" href="'.$fUrl2.'" target="_blank"><img src="'.$fUrl1.'"></a><div id="footeradclose">'.filmplus_reklami_kapat.' <i class="fas fa-times"></i></div></div> <script> $(document).ready(function() { $("#footeradclose").click(function() { $("#footeradclose").hide(); $("#footerad").hide(); }); }); </script>';
	$fAd2 = '<div id="footerad">'.$fAdCode.'<div id="footeradclose">'.filmplus_reklami_kapat.' <i class="fas fa-times"></i></div></div> <script> $(document).ready(function() { $("#footeradclose").click(function() { $("#footeradclose").hide(); $("#footerad").hide(); }); }); </script>';
	if( $fAdCode ) {
		echo $fAd2;
	}
	else {
		echo $fAd;
	}
}

//Live Search
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
function data_fetch(){
    if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'search-ajax-nonce' ) ) {
	    $q1 = get_posts(array(
	    	'post_type' => 'post',
	    	'post_status' => 'publish',
	    	'posts_per_page' => '-1',
		    's' => esc_attr( $_POST['keyword'] )
    	));
	    $q2 = get_posts(array(
	    	'post_type' => 'post',
	    	'post_status' => 'publish',
		    'posts_per_page' => '-1',
		    'meta_query' => array(
		    	array(
			    	'key' => 'filmadi',
			    	'value' => esc_attr( $_POST['keyword'] ),
				    'compare' => 'LIKE'
		    	)
	    	)
	    ));
	    $merged = array_merge( $q1, $q2 );
	    $post_ids = array();
	    foreach( $merged as $item ) {
		    $post_ids[] = $item->ID;
    	}
	    $unique = array_unique($post_ids);
	    if(!$unique){
	    	$unique=array('0');
    	}
	    $args = array(
	    	'post_type' => 'post',
	    	'posts_per_page' => '5',
	    	'post__in' => $unique,
	        'paged' => get_query_var('paged'),
	    );
	    $the_query = new WP_Query($args);
	    $counter = 0;
        if( $the_query->have_posts() ) :
            while( $the_query->have_posts() ): $the_query->the_post();$counter++; ?>
                <div id="searchelement">
                    <div class="search-cat-img">
                        <a href="<?php the_permalink() ?>">
                        <?php filmplus_post_thumbnail('30px', '45px');?>
			            </a>
                    </div>
                    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                    <div id="search-cat-year">
                        <?php echo strip_tags(get_the_term_list( $post->ID, 'yil' ));?>
                    </div>
                </div>
	    	<?php endwhile;
	    	wp_reset_postdata(); 
	    else :
	    	echo '<div id="searchelementnf">'.filmplus_film_bulunamadi.'</div>';
    	endif;
	    if($counter>4){
		    echo '<div id="searchelementnf"><a href="'.get_option('home').'?s=' . esc_attr( $_POST['keyword'] ) . '">'.filmplus_daha_fazla_sonuc.'</a></div>';
	    }
    }
}
function live_search() {
    wp_register_script ( 
        'live-search',
        get_stylesheet_directory_uri() . '/js/live-search.js',
        array( 'jquery' ),
        '1.0',
        true
    );
    $ajax_nonce = wp_create_nonce( 'search-ajax-nonce' );
    wp_localize_script (
        'live-search',
        'live_search_ajax',
        array(
            'ajax_url'   => admin_url( 'admin-ajax.php' ),
            'admin_ajax_nonce' => $ajax_nonce
        )
    );
    wp_enqueue_script( 'live-search' );
}
add_action( 'wp_enqueue_scripts', 'live_search' );

//Frontend Assets
function filmplus_add_js_script() {
	wp_enqueue_script( "jquery-perfect-scrollbar", get_template_directory_uri() . "/js/jquery.perfect-scrollbar.min.js", "","",true);
	wp_enqueue_script( "owl-carousel", get_template_directory_uri() . "/js/owl.carousel.min.js", "","",true);
	wp_enqueue_script( "filmplus", get_template_directory_uri() . "/js/filmplus.js", "","",true);
	if(get_option('filmplus_galeri_show') == 'On') {
		wp_enqueue_script( "blueimp-helper", get_template_directory_uri() . "/js/blueimp-helper.js", "","",true);
		wp_enqueue_script( "blueimp-gallery", get_template_directory_uri() . "/js/blueimp-gallery.js", "","",true);
		wp_enqueue_script( "jquery.blueimp-gallery", get_template_directory_uri() . "/js/jquery.blueimp-gallery.js", "","",true);
	}
	wp_enqueue_script( "comment-validation", get_template_directory_uri() . "/js/comment-validation.js", "","",true);
	wp_enqueue_script( "filmlus-jquery-migrate", "https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.4.1/jquery-migrate.min.js", "","1.4.1",false);
	wp_enqueue_script( "jquery-validate", "https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js", "","1.19.1",false);
}
add_action('wp_print_scripts', 'filmplus_add_js_script');
function replace_jquery() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, '3.3.1');
		wp_enqueue_script('jquery');
	}
}
add_action('init', 'replace_jquery');

//Disable Emojis
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} 
	else {
		return array();
	}
}
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}

//Boxet Film Categories Custom Field
function filmplus_category_fields($term) {
    if (current_filter() == 'category_edit_form_fields') {
        $resim_url = get_term_meta($term->term_id, 'resim_url', true);
        ?>
        <tr class="form-field">
            <th valign="top" scope="row">
                <label for="term_fields[resim_url]"><?php _e('Seri Film Afiş Url'); ?></label>
            </th>
            <td>
                <input type="text" size="40" value="<?php echo esc_attr($resim_url); ?>" id="term_fields[resim_url]" name="term_fields[resim_url]"><br/>
                <span class="description">
                    <?php _e('Eğer bu kategori, bir seri film kategorisi ise Seri Filmler sayfasında gösterilecek kategori afiş URLsini buraya girin.'); ?>
                </span>
            </td>
        </tr>   
	    <?php 
        } elseif (current_filter() == 'category_add_form_fields') {
        ?>
        <div class="form-field">
            <label for="term_fields[resim_url]"><?php _e('Seri Film Afiş Url'); ?></label>
            <input type="text" size="40" value="" id="term_fields[resim_url]" name="term_fields[resim_url]">
            <p class="description">
                <?php _e('Eğer bu kategori, bir seri film kategorisi ise Seri Filmler sayfasında gösterilecek kategori afiş URLsini buraya girin.'); ?>
            </p>
        </div>  
        <?php
    }
}
add_action('category_add_form_fields', 'filmplus_category_fields', 10, 6);
add_action('category_edit_form_fields', 'filmplus_category_fields', 10, 6);
function filmplus_save_category_fields($term_id) {
    if (!isset($_POST['term_fields'])) {
        return;
    }
    foreach ($_POST['term_fields'] as $key => $value) {
        update_term_meta($term_id, $key, sanitize_text_field($value));
    }
}
add_action('edited_category', 'filmplus_save_category_fields', 10, 2);
add_action('create_category', 'filmplus_save_category_fields', 10, 2);

//Blur Post Images
function filmplus_blur_images() {
    $array = array(0);
    if(get_option('filmplus_blur')) {
        $array = explode(",", get_option('filmplus_blur'));
    }
    return $array;
} 

//Comments Like Dislike
if ( !class_exists( 'CLD_Comments_like_dislike' ) ) {
	class CLD_Comments_like_dislike {
		function __construct() {
			$this->define_constants();
			$this->includes();
		}
		function includes() {
			require_once CLD_PATH . '/inc/classes/cld-library.php';
			require_once CLD_PATH . '/inc/classes/cld-enqueue.php';
			require_once CLD_PATH . '/inc/classes/cld-hook.php';
			require_once CLD_PATH . '/inc/classes/cld-ajax.php';
		}
		function define_constants() {
			defined( 'CLD_PATH' ) or define( 'CLD_PATH', TEMPLATEPATH );
		}
	}
	$cld_object = new CLD_Comments_like_dislike();
}

//Posts Like Dislike
function post_like_dislike_content($content = null) {
    $content = apply_filters( 'post_like_dislike_content', $content );
    echo $content;
}
if ( !class_exists( 'PLD_Comments_like_dislike' ) ) {
    class PLD_Comments_like_dislike {
        function __construct() {
            $this->define_constants();
            $this->includes();
        }
        function includes() {
            require_once PLD_PATH . '/inc/classes/pld-library.php';
            require_once PLD_PATH . '/inc/classes/pld-enqueue.php';
            require_once PLD_PATH . '/inc/classes/pld-hook.php';
            require_once PLD_PATH . '/inc/classes/pld-ajax.php';
        }
        function define_constants() {
            defined( 'PLD_PATH' ) or define( 'PLD_PATH', TEMPLATEPATH );
        }
    }
    $pld_object = new PLD_Comments_like_dislike();
}

//Remove Admin Bar
add_filter( 'show_admin_bar', '__return_false' );
remove_action( 'personal_options', '_admin_bar_preferences' );

//Profil URL Base
global $wp_rewrite;
$wp_rewrite->author_base = 'profil';