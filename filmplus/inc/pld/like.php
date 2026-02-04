<?php defined( 'ABSPATH' ) or die();?>
<div class="pld-like-wrap  pld-common-wrap">
    <a href="javascript:void(0);" class="pld-like-trigger pld-like-dislike-trigger <?php echo ($user_ip_check == 1 || isset( $_COOKIE['pld_' . $post_id] )) ? 'pld-prevent' : ''; ?>" title="<?php echo filmplus_begendim;?>" data-post-id="<?php echo $post_id; ?>" data-trigger-type="like" data-restriction="cookie" data-ip-check="<?php echo $user_ip_check; ?>" data-user-check="<?php echo $user_check; ?>"><i class="fas fa-thumbs-up"></i> <?php echo filmplus_begendim;?></a>
    <span class="pld-like-count-wrap pld-count-wrap">(<?php if($like_count == '') {echo "0";} echo $like_count; ?>)
    </span>
</div>