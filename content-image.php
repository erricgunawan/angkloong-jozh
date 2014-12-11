<?php

/**
 * The Template for displaying content of post format image
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

			<?php if ( jozh_get_first_image() ) : ?>
				<div class="entry-content">
					<figure class="post-thumbnail">
						<a href="<?php the_permalink(); ?>">
							<img src="<?php echo jozh_get_first_image(); ?>" alt="<?php the_title_attribute(); ?>" />
						</a>
					</figure>
				</div>
			<?php endif; ?>

			<div class="entry-details">
				<div class="container">
					<?php tokokoo_post_title(); ?>

					<?php echo tokokoo_published_date( array( 'before' => '<div class="entry-date"><span>', 'after' => '</span></div>' ) ); ?>
				</div>
			</div>

		</article><!-- .hentry -->

	</div><!-- .col-md-4 -->

<?php } ?>