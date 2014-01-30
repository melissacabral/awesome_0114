<?php 
/*
Template Name: Automagic Sitemap
*/
 ?>
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

		<div class="entry-content">
			<section class="onethird">
				<h3>Pages:</h3>
				<ul>
					<?php wp_list_pages( array(
						'title_li' => '',
					) ); ?>
				</ul>
			</section>

			<section class="onethird">
				<h3>Blog Posts:</h3>
				<ul>
					<?php
					//show alphabetical list of posts
					 wp_get_archives( array(
					 	'type' => 'alpha', 
					 ) ); ?>
				</ul>
			</section>

			<section class="onethird">
				<h3>Feeds!</h3>
				<ul>
					<li>
						<a href="<?php bloginfo( 'rss2_url' ); ?>">All Blog Posts Feed</a>
					</li>
					<li>
						<a href="<?php bloginfo( 'comments_rss2_url' ); ?>">Comments Feed</a>
					</li>
				</ul>

				<h3>Categories:</h3>
				<ul>
					<?php wp_list_categories( array(
						'title_li' => '',
						'feed' => 'rss',
					) ); ?>
				</ul>
			</section>

		</div>

		</article><!-- end post -->

		<?php comments_template(); ?>

		<?php endwhile; ?>
	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_footer(); //include footer.php ?>