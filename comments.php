<?php 
//hide the comments if post is password protected
if( post_password_required() ){
	return; //stop the rest of this file from running
} 

//separate the comments count from trackbacks/pingbacks
$comments_by_type = separate_comments($comments);

//count just comments
$comment_count = count($comments_by_type['comment']);
//count trackbacks & pingbacks
$ping_count = count($comments_by_type['pings']);
?>
<section id="comments" class="clearfix">
	<h3 id="comments-title">
		<?php 	echo $comment_count;
				echo $comment_count == 1 ? ' Comment so far' : ' Comments so far'; ?>
				| <a href="#respond">Leave a Comment</a>
	</h3>

	<div class="commentlist">
		<?php wp_list_comments( array(
			'type' => 'comment',
			'style' => 'div', //not a list
			'avatar_size' => 70,
			'callback' => 'awesome_comment', //callback func contains HTML output for one comment. defined in functions.php
		) ); ?>
	</div>

	<?php //show pagination if necessary
	if( get_option( 'page_comments' ) AND get_comment_pages_count() > 1 ): ?>
	<div class="pagination">
		<?php previous_comments_link(); ?>
		<?php next_comments_link(); ?>
	</div>
	<?php endif; //paginate comments ?>


	<?php comment_form(); ?>
</section>

<section id="trackbacks" class="clearfix">
	<h3><?php echo $ping_count; ?> Sites link here</h3>
	<ol>
		<?php wp_list_comments( array(
			'type' => 'pings', //pingbacks and trackbacks
		) ); ?>
	</ol>
</section>