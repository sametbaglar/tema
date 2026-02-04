<?php get_header();?>
<div id="content">
	<div class="incontent">
		<div class="title">
			<h1 class="title-border bd-purple"><i class="fa fa-play-circle"></i> <?php echo single_term_title().get_option('filmplus_seo_index_add_tax'); ?></h1>  
		</div>
		<div id="listehizala">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php include (TEMPLATEPATH . '/filmlist.php');?>
			<?php endwhile; else: ?>
			<?php endif; ?>
		</div>
		<div class="sayfalama"><?php filmplus_sayfalama();?></div>
	</div>
<?php get_sidebar();?>
</div>
<?php get_footer();?>