<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Post Data Template-Part File
 *
 * @file           post-data.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.1.0
 * @filesource     wp-content/themes/responsive/post-data.php
 * @link           http://codex.wordpress.org/Templates
 * @since          available since Release 1.0
 */
?>

<?php if( !is_page() ) { ?>
	<div class="post-data">
	
	<?php 
	  // if the category is music or a music SUBcategory, 
	  if (cat_is_ancestor_of(4, $cat) or is_category(4) or cat_is_ancestor_of(73, $cat) or is_category(73)):  ?>
		<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) ); ?>
<p>
					<?php the_excerpt(); ?>
    
	  </p>
	<?php endif; ?>
	
		<?php the_tags( __('') . ' ', ' ', '<br />' ); ?>
	</div>
<hr> </hr>
<!-- end of .post-data -->

<?php } ?>

<div class="post-edit">
<?php edit_post_link( __( 'Edit', 'responsive' ) ); ?>
</div>