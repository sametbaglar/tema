<?php
$comment_id = $comment->comment_ID;
$like_count = get_comment_meta( $comment_id, 'cld_like_count', true );
$dislike_count = get_comment_meta( $comment_id, 'cld_dislike_count', true );
$post_id = get_the_ID();
$like_count = apply_filters( 'cld_like_count', $like_count, $comment_id );
$dislike_count = apply_filters( 'cld_dislike_count', $dislike_count, $comment_id );
?>
<div class="cld-like-dislike-wrap cld-template-1">
	<?php
	include(CLD_PATH . '/inc/cld/like.php');
	include(CLD_PATH . '/inc/cld/dislike.php');
	?>
</div>