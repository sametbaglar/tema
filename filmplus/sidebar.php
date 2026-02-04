<div id="mobil-sidebar"><i class="fa fa-hashtag"></i></div>
<div id="contentx">
	<div id="sidebax">
		<?php if (is_active_sidebar('sidebar-ust')) { ?>
		<?php dynamic_sidebar('sidebar-ust'); ?>
		<?php } ?>
		<div class="listcontent">
			<div class="title">
				<span class="title-border bd-purple"><i class="fas fa-bars"></i> <?php echo filmplus_film_turleri;?></span>
			</div>
			<ul id="listul" class="custom-scrollbar">
			<?php 
			$args = array(
				'name__like'  => 'Serisi',
			);
			$ids = array();
			$categories = get_categories( $args );
			if(get_categories($args)){
				foreach ( $categories as $category ) {
					array_push($ids, $category->term_id);
				}
			}
			array_push($ids,1);
			$ids_str = implode(",", $ids);
			wp_list_categories('show_option_all&orderby=name&title_li=&depth=0&hide_empty=0&exclude='.$ids_str.''); ?>
			</ul>
		</div>
		<div class="listcontent">
			<div class="title">
				<span class="title-border bd-purple"><i class="fas fa-calendar-alt"></i> <?php echo filmplus_yillara_gore_filmler;?></span>
			</div>
			<ul id="listulx" class="custom-scrollbar">
			<?php
			$terms = get_terms(
				array(
					'taxonomy'   => 'yil',
					'hide_empty' => false,
					'orderby' => 'name',
					'order' => 'DESC',
				)
			);
			if ( ! empty( $terms ) && is_array( $terms ) ) {
				foreach ( $terms as $term ) { ?>
					<li><a href="<?php echo esc_url( get_term_link( $term ) ) ?>"><?php echo $term->name; ?></a></li>
				<?php
				}
			} 
			?>
			</ul>
		</div>
		<?php if (is_active_sidebar('sidebar-alt')) { ?>
		<?php dynamic_sidebar('sidebar-alt'); ?>
		<?php } ?>
	</div>
</div>