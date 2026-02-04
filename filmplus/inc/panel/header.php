<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
<script type='text/javascript'>
jQuery(document).ready(function() {
	//AJAX Upload
	jQuery('.upload_button').each(function(){
		var clickedObject = jQuery(this);
		var clickedID = jQuery(this).attr('id');
		new AjaxUpload(clickedID, {
			  action: '<?php echo admin_url("admin-ajax.php"); ?>',
			  name: clickedID,
			  data: { 
					action: 'filmplus_upload',
					type: 'upload',
					data: clickedID },
			  autoSubmit: true, 
			  responseType: false,
			  onChange: function(file, extension){},
			  onSubmit: function(file, extension){
				  this.disable();
			  },
			  onComplete: function(file, response) {
				  this.enable();
				  jQuery('[name="'+clickedID+'"]').val(response);
				  jQuery('.save_tip').fadeIn(400).delay(5000).fadeOut(400);
			  }
		});
	});

	// Save Changes
	jQuery('.save_changes').click(function(e) {
		e.preventDefault();
		var form = jQuery(this).parents('form');
		jQuery.ajax({
			url: '<?php echo admin_url("admin-ajax.php"); ?>',
			data: jQuery(form).serialize()+'&action=filmplus_save_fields',
			type: 'POST',
			success: function() {
				jQuery('.save_tip').fadeIn(400).delay(5000).fadeOut(400);
			}
		});
	});

	// Main tabs
	jQuery('.main_tabs a').click(function(e) {
		e.preventDefault();
		var href = jQuery(this).attr('href')
		var parent = jQuery(href).parent();
		var name = href.replace('#', '');
		jQuery(this).parents('ul').find('li').removeClass('selected');
		jQuery(this).parent().addClass('selected');
		jQuery('.sub_tabs ul').fadeOut();
		jQuery('.sub_tabs').find('.'+name).fadeIn();
		jQuery(parent).find('> div.mainTab').slideUp();
		jQuery(href).slideDown();
	});
	// Sub tabs
	jQuery('.sub_tabs a').click(function(e) {
		e.preventDefault();
		var href = jQuery(this).attr('href')
		var parent = jQuery(href).parent();
		jQuery(this).parents('ul').find('li').removeClass('selected');
		jQuery(this).parent().addClass('selected');
		jQuery(parent).find('> div').slideUp();
		jQuery(href).slideDown();
	});
	// Skins
	jQuery('.skins img').live('click', function(e) {
		e.preventDefault();
		var id = jQuery(this).attr('id');
		var bg_color = jQuery(this).data('background');
		var pattern = jQuery(this).data('pattern');
		var link_color = jQuery(this).data('link');
		jQuery(this).parent().find('img').removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('[name=filmplus_pattern]').parent().find('img').removeClass('selected');
		jQuery('#' + pattern).addClass('selected');
		jQuery(this).parent().find('input').val(id);
		jQuery('#filmplus_bg_color').val(bg_color);
		jQuery('#colorpicker_bg_color .colorSelector').ColorPickerSetColor(bg_color);
		jQuery('#colorpicker_bg_color .colorSelector div').css('background-color', '#' + bg_color);
		jQuery('[name=filmplus_pattern]').val(pattern);
		jQuery('#filmplus_link_color').val(link_color);
		jQuery('#colorpicker_link_color .colorSelector').ColorPickerSetColor(link_color);
		jQuery('#colorpicker_link_color .colorSelector div').css('background-color', '#' + link_color);
	});
	// Images
	jQuery('.images img').live('click', function(e) {
		e.preventDefault();
		var id = jQuery(this).attr('id');
		jQuery(this).parent().find('img').removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery(this).parent().find('input').val(id);
	});
	jQuery('.images img.selected').live('click', function(e) {
		e.preventDefault();
		jQuery(this).removeClass('selected');
		jQuery(this).parent().find('input').val('');
	});
});

//TMDB Buttons
jQuery(document).ready(function($) {
    function addinput($a, $b, $c) {
        $a.click(function() {
            var o = $b,
                a = o.val().length,
                s = o[0].selectionStart,
                r = o[0].selectionEnd,
                l = $c + o.val().substring(s, r);
            o.val(o.val().substring(0, s) + l + o.val().substring(r, a)), n(o[0], 9)
        });
    }
    addinput($('#btn1'), $('#filmplus_tmdb_title'), '{title}');
    addinput($('#btn2'), $('#filmplus_tmdb_title'), '{original_title}');
    addinput($('#btn3'), $('#filmplus_tmdb_title'), '{yapim_yili}');
    addinput($('#btn4'), $('#filmplus_tmdb_seo_title'), '{title}');
    addinput($('#btn5'), $('#filmplus_tmdb_seo_title'), '{original_title}');
    addinput($('#btn6'), $('#filmplus_tmdb_seo_title'), '{yapim_yili}');
    addinput($('#btn7'), $('#filmplus_tmdb_seo_desc'), '{title}');
    addinput($('#btn8'), $('#filmplus_tmdb_seo_desc'), '{original_title}');
    addinput($('#btn9'), $('#filmplus_tmdb_seo_desc'), '{yapim_yili}');
    addinput($('#btn10'), $('#filmplus_tmdb_seo_url'), '{title}');
    addinput($('#btn11'), $('#filmplus_tmdb_seo_url'), '{original_title}');
    addinput($('#btn12'), $('#filmplus_tmdb_seo_url'), '{yapim_yili}');
});
</script>
<div class='filmplus'>
	<div class='filmplus_header'>
		<a class="logo" href="#">filmplus+</a>
	<ul class='main_tabs'>
		<li class='selected'><a class='general' href='#general_settings'><i class="fas fa-globe"></i> Genel Ayarlar</a></li>
		<li><a class='seo' href='#seo_settings'><i class="fas fa-cogs"></i> Seo Ayarları </a></li>
		<li style="border:none;"><a class='appearence' href='#appearence_settings'><i class="fas fa-dollar-sign"></i> Reklam Ayarları</a></li>
		<li><a class='tmdb' href='#tmdb_settings'><i class="fas fa-video"></i> TMDb Bot Ayarları</a></li>
	</ul>
	</div>
	<div class='filmplus_container'>
		<div class='sub_tabs'>
			<ul class='general_settings selected'>
				<li class='selected'><a href='#general'>Görünüm</a></li>
				<li><a href='#analytics'>Analytics</a></li>
				<li><a href='#single'>Single</a></li>
				<li><a href='#slider'>Slider</a></li>
				<li><a href='#footer'>Footer</a></li>
				<li><a href='#robot'>Recaptcha</a></li>
			</ul>
			<ul class='seo_settings selected' style='display:none'>
				<li class='selected'><a href='#seohome' >Anasayfa Ayarları</a></li>
				<li><a href='#seosingle'>Yazı Ayarları</a></li>
				<li><a href='#seokategori'>Kategori Ayarları</a></li>
				<li><a href='#seotaxonomy'>Taxonomy Ayarları</a></li>
				<li><a href='#seogenel'>Diğer Ayarlar</a></li>
			</ul>
			<ul class='appearence_settings selected' style='display:none'>
				<li class='selected'><a href='#reklam_a'>Video Önü</a></li>
				<li><a href='#reklam_u'>Video Üstü</a></li>
				<li><a href='#reklam_b'>Video Altı</a></li>
				<li><a href='#reklam_c'>Sol Kayan</a></li>
				<li><a href='#reklam_d'>Sağ Kayan</a></li>
				<li><a href='#reklam_e'>Splash</a></li>
				<li><a href='#reklam_ps'>Pageskin</a></li>
				<li><a href='#reklam_h'>Header</a></li>
				<li><a href='#reklam_f'>Footer Kayan</a></li>
			</ul>
			<ul class='tmdb_settings selected' style='display:none'>
				<li class='selected'><a href='#tmdb'>Api Ayarları</a></li>
                <li><a href='#tmdbseo'>Seo Ayarları</a></li>
			</ul>
		</div>