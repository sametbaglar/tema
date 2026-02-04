<?php
// Anasayfa Özel Film Listeleme Bileşeni
add_action('widgets_init', 'post_boxes_widgets');
function post_boxes_widgets() {
	register_widget('filmplus_Kutu');
}
class filmplus_Kutu extends WP_Widget {
    public function __construct()
    {
    parent::__construct('filmplus_kutu', '+Anasayfa Özel Film Listeleme', [
        'classname' => 'filmplus_Kutu',
        'description' => 'Anasayfada isteğiniz kategorilere göre film listelemenizi sağlar.'
    ]);    
    }
	function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$posts_per_page = $instance['posts_per_page'];	
		$cat = $instance['cat'];
?>
<div class="title" style="position: unset;">
	<span class="title-border bd-blue"><?php echo $title; ?></span>
</div>
<div id="listehizala">
	<?php query_posts(array('orderby' => 'date', 'order' => 'DESC', 'posts_per_page' =>  $posts_per_page,  'cat' => $cat,'post_type' => 'post'));?>
	<?php if(have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>        
	<?php include (TEMPLATEPATH . '/filmlist.php');?>
		<?php endwhile; ?>    
	<?php endif; ?>
	<?php wp_reset_query();?>
</div>
<?php	
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['cat'] = strip_tags( $new_instance['cat'] );
		$instance['posts_per_page'] = $new_instance['posts_per_page'];	
		return $instance;
	} 
	function form( $instance ) {
		$defaults = array( 'title' => '', 'cat' => '', 'posts_per_page' => 8, 'pagination' => 'disable', 'post_sort' => 'date', 'post_order' => 'desc', 'display' => 'compact', 'tumunu_gor' => ''); $instance = wp_parse_args( (array) $instance, $defaults ); 
	?>
	<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>">Başlık</label>
	<br/><input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'cat' ); ?>">Film Kategori ID'leri:</label>
	<br/><input type="text" id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" value="<?php echo $instance['cat']; ?>" />
	<br/><small>Anasayfada listelemek istediğiniz film kategorilerin ID lerini girin, virgül ile birbirinden ayırabilirsiniz (ör; 23,51,102,65). Boş bıraktığınızda tüm filmler görüntülenecektir.</small>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>">Gösterilecek Film Sayısı:</label>
	<input  type="text" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" value="<?php echo $instance['posts_per_page']; ?>" size="3" />
	</p>
	<input type="hidden" name="widget-options" id="widget-options" value="1" />
	<?php
	}
} 
// Günün Filmi Bileşeni
add_action('widgets_init', 'film_of_day_widgets');
function film_of_day_widgets() {
	register_widget('filmofday');
}
class filmofday extends WP_Widget {
    public function __construct()
    {
    parent::__construct('widget_filmofday', '+Günün Filmi', [
        'classname' => 'Günün Filmi',
        'description' => 'Günün filmini sidebarda göstermenizi sağlar.'
    ]);    
    }
    public function form($instance)
    {
    $filmofday_id = !empty($instance['filmofday_id']) ? $instance['filmofday_id'] : '';
    $filmofday_title = !empty($instance['filmofday_title']) ? $instance['filmofday_title'] : '';
    ?>
    <p>
        <label for="<?php echo $this->get_field_id('filmofday_title') ?>">Başlık:</label>
        <input type="text" id="<?php echo $this->get_field_id('filmofday_title') ?>" name="<?php echo $this->get_field_name('filmofday_title') ?>" value="<?php echo $filmofday_title ?>">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('filmofday_id') ?>">Gösterilecek Filmin ID'si:
        <input type="text" id="<?php echo $this->get_field_id('filmofday_id') ?>" name="<?php echo $this->get_field_name('filmofday_id') ?>" value="<?php echo $filmofday_id ?>">
    </p>
    <?php    
    }
    public function update($new_instance, $old_instance)
    {
    $old_instance['filmofday_id'] = $new_instance['filmofday_id'];
    $old_instance['filmofday_title'] = $new_instance['filmofday_title'];
    return $old_instance;    
    }
    public function widget($args, $instance)
    {
    $filmofday_id = $instance['filmofday_id'];
    $filmofday_title = apply_filters('widget_title', $instance['filmofday_title']);
    $args['before_widget'] = '<div class="filmofday">';
    $args['after_widget'] = '</div>';
    echo $args['before_widget']. $args['before_title']. $filmofday_title .  $args['after_title'];
    ?>
	<?php query_posts(array('post__in' => array($filmofday_id), 'posts_per_page' => 1, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'post_type' => 'post'));?>
	<?php if(have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
<div class="gununfilmi">   
	<a href="<?php the_permalink() ?>">
		<div class="gununfilmi-afis">
			<?php filmplus_post_thumbnail('70px','105px'); ?>
		</div>
	</a>
	<div class="gununfilmi-title">
		<a href="<?php the_permalink() ?>"><?php the_title();?></a>
	</div>
	<?php if (get_post_meta( get_the_ID(), 'imdb', true )) : ?>
	<div class="gununfilmi-imdb">
		<i class="fas fa-star"></i> <?php echo get_post_meta( get_the_ID(), 'imdb', true );?>
	</div>
	<?php endif; ?>
	<div class="gununfilmi-yil"> 
		<i class="fas fa-calendar-check"></i> <?php echo strip_tags(get_the_term_list(get_the_ID(), 'yil' ));?>
	</div>
	<div class="hemen">
		<a href="<?php the_permalink() ?>"><i class="fas fa-play-circle"></i> <?php echo filmplus_tikla_izle;?></a>
	</div>
</div>
<?php endwhile; ?>    
<?php endif; ?>
<?php wp_reset_query();?>
    <?php
    echo $args['after_widget'];    
    }
}
// Son Yorumlar Bileşeni
add_action('widgets_init', 'last_comments_widgets');
function last_comments_widgets() {
	register_widget('last_comments');
}
class last_comments extends WP_Widget {
    public function __construct()
    {
    parent::__construct('widget_last_comments', '+Son Yorumlar', [
        'classname' => 'Son Yorumlar',
        'description' => 'Son yorumları sidebarda göstermenizi sağlar.'
    ]);    
    }
    public function form($instance)
    {
    $last_comments_id = !empty($instance['last_comments_id']) ? $instance['last_comments_id'] : '';
    ?>
    <p>
        <label for="<?php echo $this->get_field_id('last_comments_id') ?>">Gösterilecek Son Yorum Sayısı:
        <input type="text" id="<?php echo $this->get_field_id('last_comments_id') ?>" name="<?php echo $this->get_field_name('last_comments_id') ?>" value="<?php echo $last_comments_id ?>">
    </p>
    <?php    
    }
    public function update($new_instance, $old_instance)
    {
    $old_instance['last_comments_id'] = $new_instance['last_comments_id'];
    return $old_instance;    
    }
    public function widget($args, $instance)
    {
    $last_comments_id = $instance['last_comments_id'];
    ?>
<div id="lcwidget">
<div class="title"><span class="title-border bd-purple"><i class="fas fa-comments"></i> Son Yorumlar</span></div>
<?php 
	global $comment;
    $args = array(
            'number' => $last_comments_id,
            'status' => 'approve',
    );
    $comments = get_comments($args);
    foreach($comments as $comment) :
		echo '<div class="lastcomment"><div class="lc-avatar">'.get_avatar($comment->user_id).'</div><div class="lc-title"><a href="'.get_comment_link($comment->comment_ID).'">'.get_the_title($comment->comment_post_ID).'</a></div><div class="lc-author"><span>'.$comment->comment_author.'</span>, <i class="far fa-clock"></i> '.filmplus_zaman('comment').'</div><div class="lc-content">'.filmplus_comment_excerpt($comment->comment_ID).'</div></div>';
    endforeach;
?>
</div>
    <?php
    }
}
// Film Robotu Bileşeni
add_action('widgets_init', 'film_filter_widgets');
function film_filter_widgets() {
	register_widget('film_filter');
}
class film_filter extends WP_Widget {
    public function __construct()
    {
    parent::__construct('widget_film_filter', '+Film Robotu', [
        'classname' => 'Film Robotu',
        'description' => 'Sidebarda filmleri filtrelemenizi sağlar.'
    ]);    
    }
    public function form($instance)
    {
    ?>
    <?php    
    }
    public function widget($args, $instance)
    {
    ?>
<form style="margin-bottom:7px;" action="<?php echo get_permalink(get_option('filmplus_arsiv_page_id')) ?>" method="get" id="filter">
	<div class="title" style="margin-bottom: 15px;">
		<span class="title-border bd-purple"><i class="fas fa-robot"></i> <?php echo filmplus_film_robotu;?></span>
	</div>
	<label style="width: auto;">
		<select class="nameclass" style="width:164px" name="filtrele">
			<option value="imdb"><?php echo filmplus_imdb_puanina_gore;?></option>
			<option value="views"><?php echo filmplus_izlenmeye_gore;?></option>
			<option value="like"><?php echo filmplus_begeniye_gore;?></option>
			<option value="comment_count"><?php echo filmplus_yoruma_gore;?></option>
			<option value="date"><?php echo filmplus_eklenmeye_gore;?></option>
			<option value="name"><?php echo filmplus_alfabetik;?></option>
		</select>
	</label>
	<label class="filterlabel" style="width: auto;float: right;">
		<select class="nameclass filterselect" name="sirala">
			<option value="DESC">Z-A / 9-0</option>
			<option value="ASC">A-Z / 0-9</option>
		</select>
	</label>
	<label class="filterlabel">
		<select class="nameclass filterselect" id="imdb" name="imdb">
			<option value=""><?php echo filmplus_min_imdb;?></option> 
			<option value="1">1</option> 
			<option value="2">2</option> 
			<option value="3">3</option> 
			<option value="4">4</option> 
			<option value="5">5</option> 
			<option value="6">6</option> 
			<option value="7">7</option> 
			<option value="8">8</option> 
			<option value="9">9</option>
		</select>
	</label>
	<label>
		<select class="nameclass" id="yil" name="yil">
			<option value=""><?php echo filmplus_yapim_yili;?></option>
			<?php
			$terms = get_terms(
				array(
					'taxonomy'   => 'yil',
					'hide_empty' => false,
					'orderby' => 'name',
					'order' => 'DESC'
				)
			);
			if ( ! empty( $terms ) && is_array( $terms ) ) {
				foreach ( $terms as $term ) { 
				?>
			<option value="<?php echo $term->name; ?>"><?php echo $term->name; ?></option>
				<?php
				}
			} 
			?>
		</select>
	</label>
	<label>
		<select class="nameclass" id="tur" name="tur">
			<option value=""><?php echo filmplus_kategori;?></option>
			<?php
			$args5 = array(
				'name__like'  => 'Serisi',
			);
			$ids = array();
			$categories = get_categories( $args5 );
			if(get_categories($args5)){
				foreach ( $categories as $category ) {
					array_push($ids, $category->term_id);
				}
			}
			array_push($ids,1);
			$ids_str = implode(",", $ids);
			$args = array(
				'orderby' => 'name',
				'order' => 'ASC',
				'parent' => 0,
				'hide_empty' => 0,
				'exclude'  => $ids_str,
			);
			$categories = get_categories( $args );
			foreach ( $categories as $category ) {
			?>
			<option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
			<?php
			}
			?> 
		</select>
	</label>
	<label>
		<select class="nameclass" id="dil" name="dil">
			<option value=""><?php echo filmplus_dil;?></option>
			<option value="Turkce Dublaj"><?php echo filmplus_turkce_dublaj;?></option>
			<option value="Turkce Altyazili"><?php echo filmplus_turkce_altyazili;?></option>
			<option value="Yerli Film"><?php echo filmplus_yerli_film;?></option>
		</select>
	</label>
    <button type="submit" style=" margin-top: 0px; margin-bottom: 10px; "><i class="fas fa-filter"></i> <?php echo filmplus_filmleri_filtrele;?></button>
</form>
    <?php
    }
}
// Sidebar Özel Film Listeleme Bileşeni
add_action('widgets_init', 'sidebar_film_listeleme');
function sidebar_film_listeleme() {
	register_widget('sidebar_film');
}
class sidebar_film extends WP_Widget {
    public function __construct()
    {
    parent::__construct('widget_sidebar_film', '+Sidebar Özel Film Listeleme', [
        'classname' => 'Sidebar Özel Film Listeleme',
        'description' => 'Sidebarda istediğinize göre filmleri listelemenizi sağlar.'
    ]);    
    }
    public function form($instance)
    {
    $sbfilm_title = !empty($instance['sbfilm_title']) ? $instance['sbfilm_title'] : '';
    $sbfilm_id = !empty($instance['sbfilm_title']) ? $instance['sbfilm_id'] : '';
    ?>
    <p>
        <label for="<?php echo $this->get_field_id('sbfilm_title') ?>">Başlık:
        <input type="text" id="<?php echo $this->get_field_id('sbfilm_title') ?>" name="<?php echo $this->get_field_name('sbfilm_title') ?>" value="<?php echo $sbfilm_title ?>">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('sbfilm_id') ?>">Gösterilecek Film ID'leri:
        <input type="text" id="<?php echo $this->get_field_id('sbfilm_id') ?>" name="<?php echo $this->get_field_name('sbfilm_id') ?>" value="<?php echo $sbfilm_id ?>">
    <br/><small>Sidebarda listelemek istediğiniz filmlerin ID lerini girin, ID leri virgül ile ayırmayı unutmayın (ör; 23,51,102,65).</small>
    </p>
    <?php    
    }
    public function update($new_instance, $old_instance)
    {
    $old_instance['sbfilm_title'] = $new_instance['sbfilm_title'];
    $old_instance['sbfilm_id'] = $new_instance['sbfilm_id'];
    return $old_instance;    
    }
    public function widget($args, $instance)
    {
    $sbfilm_title = $instance['sbfilm_title'];
    $sbfilm_id = $instance['sbfilm_id'];
    ?>
<div id="sfwidget">
	<div class="title" style="margin-bottom: 15px;">
		<span class="title-border bd-purple"><i class="fas fa-film"></i> <?php echo $sbfilm_title;?></span>
	</div>
	<?php
	$idler = $sbfilm_id;
	$id_array = explode(",", $idler);
	query_posts(array('post__in' => $id_array,'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => count($id_array), 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'post_type' => 'post'));
	?>
	<?php if(have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>  
	<div class="sfilm">
		<div class="sf-img">
			<?php filmplus_post_thumbnail('40px','60px'); ?>
		</div>
		<div class="sf-title">
			<a href="<?php the_permalink();?>"><?php the_title();?></a>
		</div>
		<div class="sf-info">
			<i class="fas fa-star imdbicon"></i> <?php echo get_post_meta( get_the_ID(), 'imdb', true );?> 
			<i class="fas fa-calendar-check dateicon"></i> <?php echo strip_tags(get_the_term_list(get_the_ID(), 'yil' ));?>
		</div>
		<div class="sf-play">
			<a href="<?php the_permalink();?>"><i class="fas fa-play-circle playicon"></i></a>
		</div>
	</div>
		<?php endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_query();?>
</div>
    <?php
    }
}
?>