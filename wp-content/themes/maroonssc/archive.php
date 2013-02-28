<?php
/**
 * The template for displaying Archive pages.
 *
 * Displaying Categories and Tags
 *
 * @package WordPress
 * @subpackage MaroonsSC
 * @since MaroonsSC 1.0
*/

get_header(); ?>

			<div class="clear-all stretch-wrapper"> <!-- Clearing div for content + sidebar -->
      <section class="interior-content-wrapper category-excerpts-wrapper clear-all">

<?php

			if ( have_posts() ) {
				while ( have_posts() ) {
          the_post();

					get_template_part( 'loop', 'archive' );

				}

				// Add Posts Nav
?>
				<nav class="category-nav clear-all">
        	<ul>
            <li><?php next_posts_link('Older Posts', 0); ?></li>
            <li><?php previous_posts_link('Newer Posts', 0); ?></li>
          </ul>
        </nav>

<?php
			} else { /* ?>
				Do something for no posts.
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

<?php */ 

			} // end have_posts

?>

			</section>

				<?php get_sidebar(); ?>

      </div><!-- #content -->
      
<?php get_footer(); ?>
