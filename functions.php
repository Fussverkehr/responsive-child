<?php
function responsiv_child_styles() {
wp_deregister_style( 'responsiv-style');
wp_register_style('responsiv-style', get_template_directory_uri(). '/style.css');
wp_enqueue_style('responsiv-style', get_template_directory_uri(). '/style.css');
wp_enqueue_style( 'childtheme-style', get_stylesheet_directory_uri().'/style.css', array('responsiv-style') );
}
add_action( 'wp_enqueue_scripts', 'responsiv_child_styles' );

add_image_size( 'slides', 460, 360, true );

register_sidebar( array(
						  'name'          => __( 'Ohne Content' ),
						  'description'   => __( 'Area 12 - sidebar-ohne.php', 'responsive' ),
						  'id'            => 'ohne-content',
						  'before_widget' => '<div class="ohne-widget">',
						  'after_widget'  => '</div>'
						  
						  
					  ) );	
					  
if( !function_exists( 'responsive_post_meta_data' ) ) :

	function responsive_post_meta_data() {
		printf( __( '<span class="%1$s">Posted on </span>%2$s<span class="%3$s"> by </span>%4$s', 'responsive' ),
				'meta-prep meta-prep-author posted',
				sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="timestamp updated">%3$s</span></a>',
						 esc_url( get_permalink() ),
						 esc_attr( get_the_time() ),
						 esc_html( get_the_date() )
				),
				'byline',
				sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
						 get_author_posts_url( get_the_author_meta( 'ID' ) ),
						 sprintf( esc_attr__( 'View all posts by %s', 'responsive' ), get_the_author() ),
						 esc_attr( get_the_author() )
				)
		);
	}
endif;

/**
 * Sets the post excerpt length to 200 words.
 * Adopted from Coraline
 */
/*Remove the filter that removes the admin bar*/
function remove_parent_filters(){ //Have to do it after theme setup, because child theme functions are loaded first
    remove_filter('excerpt_length', 'responsive_excerpt_length');
    remove_filter( 'excerpt_more', 'responsive_auto_excerpt_more' );
    remove_filter( 'get_the_excerpt', 'responsive_custom_excerpt_more' );


}
add_action( 'after_setup_theme', 'remove_parent_filters' ); 
 
function responsive_child_excerpt_length( $length ) {
	return 200;
}
add_filter( 'excerpt_length', 'responsive_child_excerpt_length' );


/**
 * Returns a "Read more" link for excerpts
 */
function responsive_child_read_more() {
	return '';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and responsive_read_more_link().
 */
function responsive_child_auto_excerpt_more( $more ) {
	return '' . responsive_child_read_more();
}
add_filter( 'excerpt_more', 'responsive_child_auto_excerpt_more' );




/**
 * Adds a pretty "Read more" link to custom post excerpts.
 */
function responsive_child_custom_excerpt_more( $output ) {
	if ( has_excerpt() && !is_attachment() ) {
		$output .= responsive_child_read_more();
	}

	return $output;
}

add_filter( 'get_the_excerpt', 'responsive_child_custom_excerpt_more' );

add_image_size( 'home-gallery', 460, 360, true );

/**
 * Override Jetpack's default OpenGraph image.
 * Standard is blank WordPress image (https://s0.wp.com/i/blank.jpg).
 * Christoph Nahr 2015-07-07
 */
add_filter( 'jetpack_open_graph_image_default', function() {
    return 'https://begegnungszonen.ch/wp-content/themes/responsive-child/signal.png';
});



?>