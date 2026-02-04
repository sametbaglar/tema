<div class="slideshow-container">      
	<div class="row">
		<div class="large-12 columns">
			<div class="owl-carousel owl-theme">
				<?php
				$idler = get_option('filmplus_slider_id');
				$id_array = explode(",", $idler);
				query_posts(array('post__in' => $id_array,'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => count($id_array), 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'post_type' => 'post'));?>
				<?php if(have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>   
				<div class="mySlides">
					<a href="<?php the_permalink() ?>">
						<div class="film-afis"><?php filmplus_post_thumbnail('160px','240px');?></div>
					</a>
					<div class="tikla-izle">
						<a href="<?php the_permalink() ?>"><i class="fas fa-play-circle"></i> <?php echo filmplus_tikla_izle;?></a>
					</div>
					<div id="filmbilgileri">
						<div id="listelements">
							<div class="s-title">
								<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
								<?php if (get_post_meta( get_the_ID(), 'imdb', true )) : ?>
									<span class="s-imdb">(IMDb: <?php echo get_post_meta( get_the_ID(), 'imdb', true );?>)</span>
								<?php endif; ?>
							</div>
						</div>
						<div id="film-aciklama"><?php echo get_post_meta( get_the_ID(), 'ozet', true );?></div>
						<?php echo get_the_term_list( $post->ID, 'category', '<div class="list-item"><span class="infoelements"><i class="fa fa-hashtag"></i> Tür: </span>', ', ', '</div>' ) ?>
						<?php echo get_the_term_list( $post->ID, 'oyuncu', '<div class="list-item"><span class="infoelements"><i class="fas fa-users"></i> Oyuncular: </span>', ', ', '</div>' ) ?>
						<?php echo get_the_term_list( $post->ID, 'yonetmen', '<div class="list-item"><span class="infoelements"><i class="fas fa-user"></i> Yönetmen: </span>', ', ', '</div>' ) ?>
						<?php echo get_the_term_list( $post->ID, 'yil', '<div class="list-item"><span class="infoelements"><i class="fas fa-calendar"></i> Yapım Yılı: </span>', ', ', '</div>' ) ?>
						<?php echo get_the_term_list( $post->ID, 'ulke', '<div class="list-item"><span class="infoelements"><i class="fas fa-globe"></i> Ülke: </span>', ', ', '</div>' ) ?>
					</div>
				</div>    
				<?php endwhile; ?>    
				<?php endif; ?>
			</div>
			<script> $(document).ready(function() { var owl = $('.owl-carousel'); owl.owlCarousel({autoplay:true, smartSpeed: 700, autoplayTimeout:<?php echo get_option('filmplus_slider_gecis');?>, autoplayHoverPause:true, margin: 10, nav: true, loop: true, responsive: { 0: { items: 1 } } }) }) </script>
		</div>
	</div>
</div>