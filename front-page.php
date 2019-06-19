<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Site Front Page
 *
 * Note: You can overwrite front-page.php as well as any other Template in Child Theme.
 * Create the same file (name) include in /responsive-child-theme/ and you're all set to go!
 * @see            http://codex.wordpress.org/Child_Themes and
 *                 http://themeid.com/forum/topic/505/child-theme-example/
 *
 * @file           front-page.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/front-page.php
 * @link           http://codex.wordpress.org/Template_Hierarchy
 * @since          available since Release 1.0
 */

/**
 * Globalize Theme Options
 */
$responsive_options = responsive_get_options();
/**
 * If front page is set to display the
 * blog posts index, include home.php;
 * otherwise, display static front page
 * content
 */
if( 'posts' == get_option( 'show_on_front' ) && $responsive_options['front_page'] != 1 ) {
	get_template_part( 'home' );
}
elseif( 'page' == get_option( 'show_on_front' ) && $responsive_options['front_page'] != 1 ) {
	$template = get_post_meta( get_option( 'page_on_front' ), '_wp_page_template', true );
	$template = ( $template == 'default' ) ? 'index.php' : $template;
	locate_template( $template, true );
}
else {

	get_header();

	//test for first install no database
	$db = get_option( 'responsive_theme_options' );
	//test if all options are empty so we can display default text if they are
	$empty = ( empty( $responsive_options['home_headline'] ) && empty( $responsive_options['home_subheadline'] ) && empty( $responsive_options['home_content_area'] ) ) ? false : true;
	?>

	<div id="featured" class="grid col-940">

		<div class="grid col-460">

			<h4 class="featured-title">
				<?php
				if( isset( $responsive_options['home_headline'] ) && $db && $empty )
					echo $responsive_options['home_headline'];
				else {
					_e( 'Hello, World!', 'responsive' );
				}
				?>
			</h4>

			<h4 class="featured-subtitle">
				<?php
				if( isset( $responsive_options['home_subheadline'] ) && $db && $empty )
					echo $responsive_options['home_subheadline'];
				else
					_e( 'Your H2 subheadline here', 'responsive' );
				?>
			</h4>

			<p>
				<?php
				if( isset( $responsive_options['home_content_area'] ) && $db && $empty )
					echo do_shortcode($responsive_options['home_content_area'] );
       else
					_e( 'Your title, subtitle and this very content is editable from Theme Option. Call to Action button and its destination link as well. Image on your right can be an image or even YouTube video if you like.', 'responsive' );
				?>
			</p>

			<?php if( $responsive_options['cta_button'] == 0 ): ?>

				<div class="call-to-action">

					<a href="<?php echo $responsive_options['cta_url']; ?>" class="blue button">
						<?php
						if( isset( $responsive_options['cta_text'] ) && $db )
							echo $responsive_options['cta_text'];
						else
							_e( 'Call to Action', 'responsive' );
						?>
					</a>

				</div><!-- end of .call-to-action -->

			<?php endif; ?>

		</div>
		<!-- end of .col-460 -->

		<div class="grid-right col-460 fit">
		<img class="front-signal" src="<?php bloginfo('stylesheet_directory'); ?>/signal.png" alt="Begegnungszonen-Signal" />
		
				
		<ul class="slideshow">
		<?php query_posts('cat=4,73&has_thumbnail()&orderby=rand'); 

		if ( have_posts() ) : while ( have_posts() ) : the_post();?>
			
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
			   <?php the_post_thumbnail('home-gallery'); ?><span><?php the_title(); ?></span>
			   </a>
			
			
		<?php	
 		endwhile;endif;
		?>
		</ul>
		</div>
		<!-- end of #featured-image -->
	</div><!-- end of #featured -->

<script>
			jQuery(function(){

				jQuery('.slideshow').wrap('<div class="slideshowcontainer"></div>');
				jQuery('ul.slideshow a').hide().eq(0).show().addClass('active');			
				jQuery('.slideshowcontainer').after('<a href="#" id="backbutton"><< </a><a href="#" id="forbutton">>></a>');
				jQuery('ul.slideshow a span').hide();
				var myTimer = setInterval(function startAni(){jQuery('#forbutton').trigger('click');		
					    },7000);
				$('.slideshowcontainer').hover(function(){
				    clearInterval(myTimer);
				    $('ul.slideshow a span').fadeIn(1000);
				    			},
				function(){
				    jQuery('ul.slideshow a span').fadeOut(1000);
				    var myTimer = setInterval(function startAni(){jQuery('#forbutton').trigger('click');		
				    	    },5000);				    
				});	    				
				
				jQuery('#forbutton').on('click' , function(){
				var currentImage = jQuery('ul.slideshow a.active');
				
					if (jQuery('ul.slideshow a.active').next().length == 0){
					jQuery('ul.slideshow a.active').fadeOut(3000).removeClass('active');
					jQuery('ul.slideshow a:first-child').fadeIn(3000).addClass('active');
					} else{
				jQuery('ul.slideshow a.active').fadeOut(3000).removeClass('active').next().fadeIn(3000).addClass('active');
						}
				return false;
			});
	 
jQuery('#backbutton').on( 'click' , function(){
	var currentImage = jQuery('ul.slideshow a.active');
	
		if (jQuery('ul.slideshow a.active').prev().length == 0){
		
		jQuery('ul.slideshow a:last-child').fadeOut(3000).removeClass('active');
		
		jQuery('ul.slideshow a:last-child').fadeIn(3000).addClass('active');
		} else{
	jQuery('ul.slideshow a.active').fadeOut(3000).removeClass('active').prev().fadeIn(3000).addClass('active');
			}
	return false;
});

			});
		</script>	

<?php
	get_sidebar( 'home' );
	get_footer();
}
?>
