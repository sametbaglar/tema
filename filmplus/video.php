<?php filmplus_sources();?>
<div class="butonlar">
	<?php filmplus_list();?>
	<button id="hata" class="hatali"><i class="fas fa-flag"></i> <?php echo filmplus_hata_bildir; ?></button>
	<button onclick="toggle();" class="ac-kapa"><i class="far fa-lightbulb"></i> <?php echo filmplus_sinema_modu; ?></button>
	<?php if ( get_post_meta( get_the_ID(), 'indir', true ) ) : ?>
		<a href="<?php echo get_post_meta( get_the_ID(), 'indir', true ) ?>" target="_blank" class="altyazitipi"><i class="fas fa-download"></i> <?php echo filmplus_indir; ?></a>
	<?php endif; ?>
</div>
<div id="pencere" class="mobilhata">
	<div class="mobilhata-content">
		<div class="title">
			<span class="title-border bd-purple"><i class="fa fa-flag"></i> <?php echo filmplus_hata_bildir; ?></span>  
			<span class="hatakapat">&times;</span>
		</div>
		<?php echo do_shortcode('[wpforms id="'.get_option('filmplus_hata_bildir_form_post_id').'" title="false" description="false"]') ?>
	</div>
</div>
<div id="perde"></div>
<div class="filmalani">
	<?php if(get_option('filmplus_r_u') == 'On'): ?>
	<div class="videoust">
		<?php echo get_option('filmplus_r_u_u'); ?>
	</div>
	<?php endif; ?>
	<div class="video">
	<?php if ( get_post_meta( get_the_ID(), 'info', true ) ) : ?>
		<div id="filmnot"><i class="fas fa-info-circle"></i> <?php echo get_post_meta( get_the_ID(), 'info', true ) ?></div>
	<?php endif; ?>
	<div class="video-container"><?php the_content(); ?></div>
	<?php if ( get_post_meta( get_the_ID(), 'cevirinotu', true ) ) : ?>
		<div id="filmnot2" class="custom-scrollbar">
			<span style="color: #fff;"><?php echo filmplus_ceviri_notlari; ?> </span>
			<p class="whitespace"><?php echo nl2br( esc_html( get_post_meta( get_the_ID(), 'cevirinotu', true) ) ); ?></p>
		</div>
	<?php endif; ?>
	</div>
</div>