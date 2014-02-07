<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
	if( have_posts() ): ?>
		<?php 
		while( have_posts() ): 
			the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>

		<?php the_post_thumbnail( 'large', array( 'class' => 'product-image alignright' ) ); ?>

			<div class="entry-content">
				<?php
				//get the price and size from the custom fields
				$price = get_post_meta( $post->ID, 'price', true );
				$size =  get_post_meta( $post->ID, 'size', true );

				//show them if they exist
				if($price)
					echo 'Price: ' . $price . '<br>';

				if($size)
					echo 'Size: ' . $size . '<br>';

				//show the brand and features taxonomy terms for this product
				the_terms( $post->ID, 'brand', '<p>Brand: ', '<br />', '</p>' );

				the_terms( $post->ID, 'feature', '<p>Features: ', ', ', '</p>' );

 
				the_content(); 
				wp_link_pages(array(
					'before' => 'Continue Reading about this Product! ',
					'next_or_number' => 'next',
				));
			 	?>
			</div>
			
		</article><!-- end post -->

		<?php endwhile; ?>

		<div class="pagination">
			<?php 
			//single post pagination - go to the next/prev post			
			previous_post_link( '%link', '&larr; %title' ); 
			next_post_link( '%link', '%title &rarr;');
			?>
		</div>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_footer(); //include footer.php ?>