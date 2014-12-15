<?php

/**
 * The Template for displaying content of post format status
 *
 * @author 		tokokoo
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php if ( is_singular( get_post_type() ) ) { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<section class="post-details">
			<?php tokokoo_single_post_title(); ?>

			<?php jozh_post_attribute(); ?>
		</section>
	
		<section class="post_content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'tokokoo' ) . '</span>', 'after' => '</p>' ) ); ?>
		</section><!-- .post_content -->

		<?php tokokoo_post_author(); ?>

	</article><!-- .hentry -->

<?php } else { ?>

	<div class="col-md-4">

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-thumb' ); ?>>

			<div class="entry-content">
				<?php the_content(); ?>
			</div>

			<div class="entry-details">
				<div class="container">
					<?php tokokoo_post_title(); ?>
					
					<?php echo tokokoo_published_date( array( 'before' => '<div class="entry-date"><span>', 'after' => '</span></div>' ) ); ?>
				</div>
			</div>

		</article><!-- .hentry -->

	</div><!-- .col-md-4 -->

<?php } ?>