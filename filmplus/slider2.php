<div class="slideshow-container2">   
	<div class="row">
		<div class="large-12 columns">
			<div class="owl-carousel owl-theme">
				<?php
				$idler = get_option('filmplus_slider_id');
				$id_array = explode(",", $idler);
				query_posts(array('post__in' => $id_array,'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => count($id_array), 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'post_type' => 'post'));?>
				<?php if(have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>   
				<?php include (TEMPLATEPATH . '/filmlist.php');?>  
				<?php endwhile; ?>    
				<?php endif; ?>
			</div>
			<script> $(document).ready(function() { var owl = $('.owl-carousel'); owl.owlCarousel({autoplay:true, autoplaySpeed: 700,  autoplayTimeout:<?php echo get_option('filmplus_slider_gecis');?>, autoplayHoverPause:false, margin: 10, nav: true, loop: false, rewind: true, responsive: { 0: { items: 2 }, 450: { items: 3 }, 600: { items: 4 }, 1000: { items: 5 }, 1440: { items: 6 } } }) }) </script>
		</div>
	</div>
</div>