<?php if(has_category(filmplus_blur_images())) {
    $filmi_gor = '<div class="filmi-gor"><i class="fa fa-eye-slash"></i> Resmi Aç</div>';
    $blur = 'blur';
}
else {
    $filmi_gor = '';
    $blur = '';
}
?>
<div class="listmovie">	
	<div class="movie-box">
		<?php if(get_the_term_list(get_the_ID(), 'yil' )):?>
		<div class="film-yil">
			<i class="fas fa-calendar-alt"></i> <?php echo strip_tags(get_the_term_list(get_the_ID(), 'yil' ));?>
		</div>
		<?php endif;?>
		<?php if(get_post_meta(get_the_ID(), 'imdb', true)):?>
		<div class="bolum-ust">
			<i class="fas fa-star"></i> <?php echo get_post_meta(get_the_ID(), 'imdb', true);?>
		</div>
		<?php endif;?>
		<div class="poster">
		    <?php echo $filmi_gor;?>					
			<div class="img <?php echo $blur;?>">
			    <a href="<?php the_permalink() ?>">
			        <?php filmplus_post_thumbnail('300px', '450px', 'yes');?>
			    </a>
			</div>
		</div>
		<div class="bolum-alt">
			<div class="film-ismi">
				<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			</div>
			<?php if (get_post_meta(get_the_ID(), 'dil', true) != "Girilmedi") : ?>
				<?php filmplus_flags('dil'); ?>
			<?php endif; ?>
		</div>
	</div>
</div>