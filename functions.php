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



//don't close the PHP tag!