<?php defined( 'ABSPATH' ) or die();?>
<div class="cld-dislike-wrap  cld-common-wrap">
	<?php
	$liked_ips = get_comment_meta( $comment_id, 'cld_ips', true );
	$user_ip = $this->get_user_IP();
	if ( empty( $liked_ips ) ) {
		$liked_ips = array();
	}
	$user_ip_check = (in_array( $user_ip, $liked_ips )) ? 1 : 0;
	?>
	<a href="javascript:void(0);" class="cld-dislike-trigger cld-like-dislike-trigger <?php echo ($user_ip_check == 1 || isset( $_COOKIE['cld_' . $comment_id] )) ? 'cld-prevent' : ''; ?>" title="<?php _e( 'Dislike', 'comments-like-dislike' ); ?>" data-comment-id="<?php echo $comment_id; ?>" data-trigger-type="dislike" data-user-ip="<?php echo $user_ip; ?>" data-ip-check="<?php echo $user_ip_check; ?>" data-restriction="cookie"><i class="fa fa-thumbs-down"></i></a>
	<span class="cld-dislike-count-wrap cld-count-wrap"><?php echo (empty( $dislike_count )) ? 0 : number_format( $dislike_count ); ?></span>
</div>