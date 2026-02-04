<?php get_header(); ?>
<div id="content">
	<div class="leftC">
		<div class="singlecontent">
			<div class="title">
				<h1 class="title-border bd-purple"><i class="fas fa-play-circle"></i> <?php the_title();?></h1>
				<?php if ( get_post_meta( get_the_ID(), 'filmadi', true ) ) : ?>
				<div lang="en" class="bolum-ismi">
					<?php echo get_post_meta( get_the_ID(), 'filmadi', true ) ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="inepisode">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php if(get_option('filmplus_r_a') == 'On') { ?>
						<?php include(TEMPLATEPATH . '/videoad.php'); ?>
					<?php } else {?>
						<?php include(TEMPLATEPATH . '/video.php'); ?>
					<?php } ?>
					<?php filmplus_sosyal();?>
				<?php endwhile; else: ?><?php endif; ?>
			</div>
		</div>
		<?php if(get_option('filmplus_r_b') == 'On'): ?>
		<div class="videoalt">
			<?php echo get_option('filmplus_r_b_b'); ?>
		</div>
		<?php endif; ?>
		<?php $serial_id = filmplus_film_bilgileri();?>
		<?php filmplus_gallery();?>
		<?php filmplus_benzer_filmler();?>
		<div class="commentcontent">
			<?php if( comments_open() ):?>
				<div class="title">
					<span class="title-border bd-purple"><i class="fas fa-comments"></i> <?php echo filmplus_yorumlar; ?></span>
					<span class="countcom"><?php comments_number('0 Yorum', '1 Yorum', '% Yorum' );?></span>   
				</div>
				<?php comments_template(); ?>  
			<?php else:?>
				<div class="yorumkapali"><i class="fas fa-ban"></i> <?php echo filmplus_yorum_kapali; ?></div>
			<?php endif;?>
		</div>
	</div>
	<?php filmplus_seri_filmler($serial_id);?>
	<?php if(get_option('filmplus_sidebar_show') == 'On'): ?>
		<?php get_sidebar();?>
	<?php else:?>
		<style>.leftC { width: 100% !important; }</style>
	<?php endif; ?>
</div>
<?php get_footer();?>