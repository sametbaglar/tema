$( document ).ready(function() {
	var ajax_url = users_list_ajax.ajax_url;
	$(".no_login").click(function(){
		alert("Sadece kayıtlı kullanıcılar bu özelliği kullanabilir.");
	});
	$(document).on("click","[role=add_fav]",function() {
	var fav_add_post_id = $(this).attr("post_id");
		$.ajax({
		url : ajax_url,
		method : 'post',
		data:{action: "add_to_favorite_action",fav_add_post_id:fav_add_post_id,_wpnonce: users_list_ajax.admin_ajax_nonce},
		success: function(response){
			$('.fav'+fav_add_post_id).attr("role", "rem_fav");
			$('.fav'+fav_add_post_id).addClass("favActive");
		}
		});
	});
	$(document).on("click","[role=rem_fav]",function() {
	var fav_rem_post_id = $(this).attr("post_id");
		$.ajax({
		url : ajax_url,
		method : 'post',
		data:{action: "rem_from_favorite_action",fav_rem_post_id:fav_rem_post_id,_wpnonce: users_list_ajax.admin_ajax_nonce},
		success: function(response){
			$('.fav'+fav_rem_post_id).attr("role", "add_fav");
			$('.fav'+fav_rem_post_id).removeClass("favActive"); 
			$('.remove_fav_'+fav_rem_post_id).remove(); 
		}
		});
	});
	$(document).on("click","[role=add_wl]",function() {
	var wl_add_post_id = $(this).attr("post_id");
		$.ajax({
		url : ajax_url,
		method : 'post',
		data:{action: "add_to_watchlater_action",wl_add_post_id:wl_add_post_id,_wpnonce: users_list_ajax.admin_ajax_nonce},
		success: function(response){
			$('.wl'+wl_add_post_id).attr("role", "rem_wl");
			$('.wl'+wl_add_post_id).addClass("wlActive"); 
		}
		});
	});
	$(document).on("click","[role=rem_wl]",function() {
	var wl_rem_post_id = $(this).attr("post_id");
		$.ajax({
		url : ajax_url,
		method : 'post',
		data:{action: "rem_from_watchlater_action",wl_rem_post_id:wl_rem_post_id,_wpnonce: users_list_ajax.admin_ajax_nonce},
		success: function(response){
			$('.wl'+wl_rem_post_id).attr("role", "add_wl");
			$('.wl'+wl_rem_post_id).removeClass("wlActive"); 
			$('.remove_wl_'+wl_rem_post_id).remove(); 
		}
		});
	});	
	$(document).on("click","[role=add_wh]",function() {
	var wh_add_post_id = $(this).attr("post_id");
		$.ajax({
		url : ajax_url,
		method : 'post',
		data:{action: "add_to_watched_action",wh_add_post_id:wh_add_post_id,_wpnonce: users_list_ajax.admin_ajax_nonce},
		success: function(response){
			$('.wh'+wh_add_post_id).attr("role", "rem_wh");
			$('.wh'+wh_add_post_id).addClass("whActive"); 
		}
		});
	});
	$(document).on("click","[role=rem_wh]",function() {
	var wh_rem_post_id = $(this).attr("post_id");
		$.ajax({
		url : ajax_url,
		method : 'post',
		data:{action: "rem_from_watched_action",wh_rem_post_id:wh_rem_post_id,_wpnonce: users_list_ajax.admin_ajax_nonce},
		success: function(response){
			$('.wh'+wh_rem_post_id).attr("role", "add_wh");
			$('.wh'+wh_rem_post_id).removeClass("whActive"); 
			$('.remove_wh_'+wh_rem_post_id).remove(); 
		}
		});
	});
	$('.addToList').click(function(){
		$('.listMenu').slideToggle('fast');
	});
});