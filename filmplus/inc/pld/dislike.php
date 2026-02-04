<?php defined( 'ABSPATH' ) or die();?>
<div class="pld-dislike-wrap  pld-common-wrap">
    <a href="javascript:void(0);" class="pld-dislike-trigger pld-like-dislike-trigger <?php echo ($user_ip_check == 1 || isset( $_COOKIE['pld_' . $post_id] )) ? 'pld-prevent' : ''; ?>" title="<?php echo filmplus_begenmedim;?>" data-post-id="<?php echo $post_id; ?>" data-trigger-type="dislike" data-ip-check="<?php echo $user_ip_check; ?>" data-restriction="cookie" data-user-check="<?php echo $user_check; ?>"><i class="fas fa-thumbs-down"></i> <?php echo filmplus_begenmedim;?></a>
    <span class="pld-dislike-count-wrap pld-count-wrap">(<?php if($dislike_count == '') {echo "0";} echo $dislike_count; ?>)</span>
</div>