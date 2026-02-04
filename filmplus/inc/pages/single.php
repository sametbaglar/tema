<?php
function filmplus_film_bilgileri(){
	global $post;
	$post_id = $post->ID;
	$trailer = get_post_meta( $post_id, 'youtube', true );
	$trailer_id = explode('watch?v=',$trailer);
	?>
	<div class="singlecontent">
		<div class="title">
			<span class="title-border bd-purple"><i class="fas fa-info-circle"></i> <?php echo filmplus_film_bilgileri; ?></span>
			<div id="ne-zaman"><?php echo filmplus_zaman(); ?> <?php echo filmplus_eklendi; ?></div>
		</div>
		<div class="film-afis">
			<?php filmplus_post_thumbnail('160px','240px'); ?>
			<?php if($trailer):?>
			<button id="trailerbutton"><i class="fas fa-video"></i> <?php echo filmplus_fragmani_izle; ?></button>
			<div id="trailer" class="modaltrailer">
				<div class="modal-content-trailer">
					<span class="trailerclose">&times;</span>
					<div class="trailer-container">
						<iframe class="trailer-video" allow="autoplay" src="https://www.youtube.com/embed/<?php echo $trailer_id[1];?>" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
			</div>
			<?php endif;?>
		</div>
		<div id="filmbilgileri">
			<div id="listelements">
				<div class="elements"><i class="far fa-eye"></i> <?php if(function_exists('the_views')) { the_views(); } ?> <?php echo filmplus_izlenme; ?></div>
				<?php if (get_post_meta( $post_id, 'imdb', true )) : ?>
				<div class="elements"><i class="fas fa-star"></i> IMDb: <?php echo get_post_meta( $post_id, 'imdb', true );?></div>
				<?php endif; ?>
				<?php
				$serial_id = array();
				$categories = wp_get_post_categories($post_id);
				foreach($categories as $category){
					echo '<div class="elements"><a href="'.get_category_link($category).'" title="'.get_cat_name($category).'">'.get_cat_name($category).'</a></div>';
					if (strpos(get_cat_name($category), 'Serisi') !== false) {
						array_push($serial_id,$category);
					}
				}
				?>
			</div>
			<div id="film-aciklama" class="custom-scrollbar"><?php echo get_post_meta( $post_id, 'ozet', true );?></div>
			<?php echo get_the_term_list( $post->ID, 'oyuncu', '<div class="list-item"><span class="infoelements"><i class="fas fa-users"></i> Oyuncular: </span>', ', ', '</div>' ) ?>
			<?php echo get_the_term_list( $post->ID, 'yonetmen', '<div class="list-item"><span class="infoelements"><i class="fas fa-user"></i> Yönetmen: </span>', ', ', '</div>' ) ?>
			<?php echo get_the_term_list( $post->ID, 'yil', '<div class="list-item"><span class="infoelements"><i class="fas fa-calendar"></i> Yapım Yılı: </span>', ', ', '</div>' ) ?>
			<?php echo get_the_term_list( $post->ID, 'ulke', '<div class="list-item"><span class="infoelements"><i class="fas fa-globe"></i> Ülke: </span>', ', ', '</div>' ) ?>
			<?php if(has_tag()):?>
			<?php if ( the_tags('<div class="list-item"><span class="infoelements"><i class="fas fa-tags"></i> Etiketler: </span>', ', ', '</div>') ) ?>
			<?php endif; ?>
		</div>
	</div>
	<?php
	return $serial_id;
}
function filmplus_benzer_filmler(){
	global $post;
	$categories = get_the_category($post->ID);
	if(get_option('filmplus_benzer_show') == 'On') {
		?>
		<div class="singlecontent">
			<div class="title"><span class="title-border bd-purple"><i class="fas fa-film"></i> <?php echo filmplus_bunlara_bakin; ?></span></div>
			<div class="row">
				<div class="large-12 columns">
					<div class="owl-carousel owl-theme">
					<?php 
					if ($categories) {
						$category_ids = array();
						foreach($categories as $individual_category) {
							$category_ids[] = $individual_category->term_id;
						}
						$args=array(
							'category__in' => $category_ids,
							'orderby' => 'date',
							'showposts'=> get_option('filmplus_benzer_count'),
							'post__not_in' => array($post->ID),
							'order' => 'DESC',
							'ignore_sticky_posts'=>1
						);
						$my_query = new wp_query($args); 
						if($my_query->have_posts()) { 
							while ($my_query->have_posts()) {
								$my_query->the_post();
								include (TEMPLATEPATH . '/filmlist.php');
							} 
						} 
						wp_reset_query(); 
					} 
					?>
					</div>
					<?php if(get_option('filmplus_sidebar_show') == 'On'): ?>
					<script> $(document).ready(function() { var owl = $('.owl-carousel'); owl.owlCarousel({ margin: 10, dots: false,nav: true, loop: false, rewind: true, responsive: { 0: { items: 2 }, 450: { items: 3 }, 600: { items: 4 }, 1000: { items: 4 }, 1440: { items: 5 } } }) }) </script>
					<?php else:?>
					<script> $(document).ready(function() { var owl = $('.owl-carousel'); owl.owlCarousel({ margin: 10, dots: false,nav: true, loop: false, rewind: true, responsive: { 0: { items: 2 }, 450: { items: 3 }, 600: { items: 4 }, 1000: { items: 5 }, 1440: { items: 6 } } }) }) </script>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}
}
function filmplus_gallery(){
	global $post;
	$post_id = $post->ID;
	if( get_option('filmplus_galeri_show') == 'On' && get_post_meta( $post_id, 'film_poster', true )) {
		?>
		<div class="gallerycontent">
			<div id="links" class="links">
				<div class="col-md-12">
					<div class="gallery-slider">
						<div class="slider owl-carousel owl-theme">
						<?php
						$film_posters = get_post_meta( $post_id, 'film_poster', false );
						foreach( $film_posters as $film_poster ) {
							echo '<div class="gallery-item"><a href="https://image.tmdb.org/t/p/original'.$film_poster.'" title="'.get_the_title().'" data-gallery=""><img src="https://image.tmdb.org/t/p/w300'.$film_poster.'"></a></div>';
						}
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript"> jQuery( document ).ready(function( $ ) { $('.gallery-slider .slider').owlCarousel({ margin: 10, dots: true,nav: true, loop: false, rewind: true, responsive: { 0: { items: 2 }, 450: { items: 2 }, 600: { items: 3 }, 1000: { items: 3 }, 1440: { items: 4 } } }) })</script>
		<div id="blueimp-gallery" class="blueimp-gallery">
			<div class="slides"></div>
			<h3 class="title"></h3>
			<a class="prev">‹</a>
			<a class="next">›</a>
			<a class="close">×</a>
			<a class="play-pause"></a>
			<ol class="indicator"></ol>
		</div>
		<?php
	}
}
function filmplus_seri_filmler($serial_id){
	global $post;
	if (!empty($serial_id) && !wp_is_mobile()) {
		?>
		<div class="serialfilm">
			<div class="title" style=" margin-bottom: 15px; ">
				<span class="title-border bd-purple"><i class="fas fa-film"></i> <?php echo filmplus_serinin_diger_filmleri; ?></span>
			</div>
			<?php
			query_posts(array('post__not_in' => array($post->ID),'category__in' => $serial_id,'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => -1, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'post_type' => 'post'));
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
function filmplus_sosyal(){
	global $post;
	?>
	<div id="alt">		
		<div class="facebook">
			<iframe src="https://www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&width=62&layout=button&action=like&size=small&show_faces=false&share=false&height=22&appId=1773916656230440" width="auto" height="22" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
		</div>
		<div class="facebook-share">
			<script>function fbs_click(){u=location.href;t=document.title;window.open('https://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>
			<a rel="nofollow" class="sh-face" href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" onclick="return fbs_click()" target="_blank">
				<span><i class="fab fa-facebook-f"></i> <?php echo filmplus_paylas; ?></span>
			</a>
		</div>
		<div class="twitter">
			<a href="https://twitter.com/share" class="twitter-share-button"><?php echo filmplus_tweet; ?></a> 
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>
		<div class="likebuttons">
			<?php if(function_exists('post_like_dislike_content')) { post_like_dislike_content(); } ?>
		</div>
	</div>
	<?php
}
?>
