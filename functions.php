<?php
//turn on sleeping features
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-background' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-formats', array('image', 'video', 'quote', 'aside', 'link', 'gallery', 'status', 'audio', 'chat' ));


//special image size for the home page big image
add_image_size( 'awesome-home-banner', 1120, 330, true );

//Unlock the ability to have editor-style.css to control edit box
add_editor_style();

/**
 * Make Excerpts better - change the length and [...]
 * @since 0.1
 */
function awesome_excerpt_length(){
	return 75; //words
}
add_filter( 'excerpt_length' , 'awesome_excerpt_length' );

function awesome_readmore(){
	return ' <a href="' . get_permalink() . '" class="readmore">Read More</a>';
}
add_filter( 'excerpt_more', 'awesome_readmore' );

/**
 * Example Custom Pluggable Function
 * Pluggable functions check to see if the function is already defined. 
 * This is important when developing theme frameworks
 * or parent themes
 */
if( !function_exists('awesome_example') ):
	function awesome_example(){
		echo 'This is just an example';
	}
endif;

/**
 * Add Navigation Menu Areas
 * @since 0.1 
 */
add_action( 'init', 'awesome_setup_menus' );
function awesome_setup_menus(){
	register_nav_menus( array(
		'main_menu' => 'Main Navigation Bar',
		'utilities' => 'Utility Area',
	) );
}

/**
 * Add 4 Widget Areas
 * @since 0.1
 */
add_action( 'widgets_init', 'awesome_register_sidebars' );
function awesome_register_sidebars(){
	register_sidebar( array(
		'name' 			=> 'Blog Sidebar',
		'id' 			=> 'blog_sidebar',
		'description' 	=> 'Complementary content next to the blog archives',
		'before_widget' => '<section class="widget clearfix %2$s" id="%1$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>', 
	) );
	register_sidebar( array(
		'name' 			=> 'Home Area',
		'id' 			=> 'home_area',
		'description' 	=> 'Appears near the bottom of the home page',
		'before_widget' => '<section class="widget clearfix %2$s" id="%1$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>', 
	) );
	register_sidebar( array(
		'name' 			=> 'Page Sidebar',
		'id' 			=> 'page_sidebar',
		'description' 	=> 'Complementary content next to Page content',
		'before_widget' => '<section class="widget clearfix %2$s" id="%1$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>', 
	) );
	register_sidebar( array(
		'name' 			=> 'Footer Area',
		'id' 			=> 'footer_area',
		'description' 	=> 'Appears at the bottom of every screen',
		'before_widget' => '<section class="widget clearfix %2$s" id="%1$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>', 
	) );
}

/**
 * Comments Callback Function
 * used on single.php and page.php
 * @since 0.1
 */

function awesome_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>

		<?php //BEGIN EDITING COMMENT OUTPUT ?>
		<div class="comment-author vcard">
		<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
		</div>
<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
		<br />
<?php endif; ?>

		<?php comment_text() ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
			?>
		</div>		

		<div class="reply">
		<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>

		<?php //STOP EDITING CUSTOM COMMENT  ?>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
<?php
        }



//don't close the PHP tag!