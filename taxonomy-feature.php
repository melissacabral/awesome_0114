<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
	if( have_posts() ): ?>

	<h2 class="archive-title">All Products Featuring <?php single_cat_title(); ?></h2>

		<?php 
		while( have_posts() ): 
			the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
			

			<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'thumb' ) ); ?>

			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div>

			<?php //grab the price custom field. if it exists, display it in a charming price tag 
			$price = get_post_meta( $post->ID, 'price', true );

			if( $price ): ?>
				<span class="product-price">
					<?php echo $price; ?>
				</span>
			<?php
			endif; //price tag
			?>

		</article><!-- end post -->

		<?php endwhile; ?>

		<div class="pagination">
			<?php 
			//check to see if pagenavi plugin is active before displaying it
			if( function_exists('wp_pagenavi') ){
				 wp_pagenavi(); 
			}else{
				//archive pagination - go to the next/prev set of posts
				next_posts_link( '&larr; Older Posts' );
				previous_posts_link( 'Newer Posts &rarr;' ); 
			}
			?>
		</div>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar('shop'); //include sidebar-shop.php ?>
<?php get_footer(); //include footer.php ?>