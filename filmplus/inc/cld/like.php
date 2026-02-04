<?php defined( 'ABSPATH' ) or die();?>
<div class="cld-like-wrap  cld-common-wrap">
	<?php
	$liked_ips = get_comment_meta( $comment_id, 'cld_ips', true );
	$user_ip = $this->get_user_IP();
	if ( empty( $liked_ips ) ) {
		$liked_ips = array();
	}
	$user_ip_check = (in_array( $user_ip, $liked_ips )) ? 1 : 0;
	?>
	<a href="javascript:void(0);" class="cld-like-trigger cld-like-dislike-trigger <?php echo ($user_ip_check == 1 || isset( $_COOKIE['cld_' . $comment_id] )) ? 'cld-prevent' : ''; ?>" title="<?php _e( 'Like', 'comments-like-dislike' ); ?>" data-comment-id="<?php echo $comment_id; ?>" data-trigger-type="like" data-restriction="cookie" data-user-ip="<?php echo $user_ip; ?>" data-ip-check="<?php echo $user_ip_check; ?>"><i class="fa fa-thumbs-up"></i></a>
	<span class="cld-like-count-wrap cld-count-wrap"><?php echo (empty( $like_count )) ? 0 : number_format( $like_count ); ?></span>
</div>