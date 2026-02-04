<?php
global $post;
$post_id = $post->ID;
$like_count = get_post_meta( $post_id, 'pld_like_count', true );
$dislike_count = get_post_meta( $post_id, 'pld_dislike_count', true );
$post_id = get_the_ID();
$like_count = apply_filters( 'pld_like_count', $like_count, $post_id );
$dislike_count = apply_filters( 'pld_dislike_count', $dislike_count, $post_id );
$liked_ips = get_post_meta( $post_id, 'pld_ips', true );
$user_ip = $this->get_user_IP();
if ( empty( $liked_ips ) ) {
    $liked_ips = array();
}
if ( is_user_logged_in() ) {
    $liked_users = get_post_meta( $post_id, 'pld_users', true );
    $liked_users = (empty( $liked_users )) ? array() : $liked_users;
    $current_user_id = get_current_user_id();
    if ( in_array( $current_user_id, $liked_users ) ) {
        $user_check = 1;
    } else {
        $user_check = 0;
    }
} else {
    $user_check = 1;
}
$user_ip_check = (in_array( $user_ip, $liked_ips )) ? 1 : 0;
?>
<div class="pld-like-dislike-wrap pld-template-1">
    <?php
    include(PLD_PATH . '/inc/pld/like.php');
    include(PLD_PATH . '/inc/pld/dislike.php');
    ?>
</div>