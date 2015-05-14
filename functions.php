<?php
/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom hooks and Theme settings.
 * 
 * @package angkloong-jozh
 * @license license.txt
 * @since   1.0
 *
 */

/* Adds the child theme setup function to the 'after_setup_theme' hook. */
// add_action( 'after_setup_theme', 'jozh_child_theme_setup', 11 );

/**
 * Setup function. All child themes should run their setup within this function. The idea is to add/remove 
 * filters and actions after the parent theme has been set up. This function provides you that opportunity.
 *
 * @since 1.0
 */
// function jozh_child_theme_setup() {
	// remove_action( 'init', 'tokokoo_add_image_sizes' );
// }

// add_action( 'tokokoo_add_image_sizes', 'jozh_image_sizes' );
// function jozh_image_sizes() {

	// replacing tokokoo_blog_single
	// update_option( 'large_size_w', 1175 );
	// update_option( 'large_size_h', 575 );
	// update_option( 'large_crop', 1 );

// }

/*************************************************************************************************/

/**
* Return an HTML img tag for the first image in a post content. Used to draw
* the content for posts of the “image” format.
* http://css-tricks.com/snippets/wordpress/get-the-first-image-from-a-post/#comment-1582091 --> not working
* http://www.wprecipes.com/how-to-get-the-first-image-from-the-post-and-display-it
*
* @return string An HTML img tag for the first image in a post content.
*/
function jozh_get_first_image() {

	// check featured image first
	if ( has_post_thumbnail() ) {

		// if exist, return it
		$src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
		return $src[0];

	} else {

		// Expose information about the current post.
		global $post;

		// We'll trap to see if this stays empty later in the function.
		$src = '';

		// Grab all img src's in the post content
		// $output = preg_match_all( '//i', $post->post_content, $matches ); // not working
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

		// Grab the first img src returned by our regex.
		if( ! isset ( $matches[1][0] ) ) { return false; }
		$src = $matches[1][0];

		// Make sure there's still something worth outputting after sanitization.
		if( empty( $src ) ) { return false; }

		return $src;

	}

}

/*************************************************************************************************/

/**
 * Post By Line
 * Override tokokoo_post_attribute()
 *
 * @since  2.0
 * @author tokokoo
 **/
function jozh_post_attribute() {
?>
	<div class="post-meta">
		<div class="cats">

			<?php echo tokokoo_published_date( array( 'before' => '<span>' . __( 'Posted on ', 'tokokoo' ) . '</span><div class="date">', 'after' => '</div>' ) ); ?>

			<?php echo tokokoo_post_author_link( array( 'before' => '| <span>' . __( 'By ', 'tokokoo' ) . '</span>', 'after' => ' | ' ) ); ?>

			<span><?php _e( 'Under:', 'tokokoo' ); ?></span>

			<?php echo tokokoo_post_category(); ?>

			<?php echo tokokoo_post_tags( array( 'before' => __( 'and: ', 'tokokoo' ), 'after' => ' ' ) ); ?>

			<?php echo tokokoo_post_comment_link( array( 'before' => '| <span>' . __( 'With ', 'tokokoo' ) . '</span>', 'zero' => __( '0 Responses', 'tokokoo' ),  ) ); ?>

		</div><!-- .cats -->

	</div><!-- .post-meta -->
<?php
}

/*************************************************************************************************/

/**
 * Save to Drive
 * extracted from https://wordpress.org/plugins/save-to-drive/
 */

/**
* Save to Drive Shortcode
*
* Shortcode for generating button
*
* @since	1.0
*
* @uses     generate_save_to_drive_button	Generate button code
*
* @param	string		$paras				Shortcode parameters
* @param	string		$content			Passed content
* @return	string							Code to generate button
*/
add_shortcode( 'savetodrive', 'jozh_save_to_drive_sc' );
function jozh_save_to_drive_sc( $paras = '', $content = '' ) {

	// Extract shortcode parameters

	extract( shortcode_atts( array( 'filename' => '', 'url' => '' ), $paras ) );

	// If URL is not specified as a parameter attempt to use the content instead

	if ( $url == '' ) {
		if ( $content == '' ) {
			return '<p style="color: #f00; font-weight: bold;">Save to Drive: ' . __( 'No filename was supplied', 'tokokoo' ) . "</p>\n";
		} else {
			$url = $content;
		}
	}

	return jozh_generate_save_to_drive_button( $url, $filename );
}

/**
* Generate Save to Drive button
*
* Generate the code to produce the Save to Drive button
*
* @since	1.0
*
* @param	string		$url				URL to download file
* @param	string		$filename			Name to save file as (optional)
* @return	string							Code to generate button
*/
function jozh_generate_save_to_drive_button( $url = '', $filename = '' ) {

	// If no filename attempt to extract it from the URL

	if ( $filename == '' ) {
		$slash_pos = strrpos( $url, '/' );
		if ( !$slash_pos ) {
			$filename = $url;
		} else {
			$filename = substr( $url, $slash_pos + 1 );
		}
	}

	// Once a URL is available, add the appropriate Add to Drive button

	$sitename = get_bloginfo( 'name' );

	$content = "\n" . '<!-- Jozh Save to Drive -->' . "\n";
	$content .= '<script src="https://apis.google.com/js/plusone.js"></script>' . "\n";
	$content .= '<div class="g-savetodrive" data-filename="' . $filename . '" data-sitename="' . $sitename . '" data-src="' . $url . '"></div>' . "\n";
	$content .= '<!-- ' . __( 'End of Save to Drive code', 'tokokoo' ) . ' -->' . "\n";

	// Return the content

	return $content;
}

/*************************************************************************************************/
