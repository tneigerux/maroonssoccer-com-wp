<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage MaroonsSC
 * @since MaroonsSC 1.0
 */

get_header(); ?>
<!-- SEARCH PHP -->
			<div class="clear-all stretch-wrapper"> <!-- Clearing div for content + sidebar -->
      <section class="interior-content-wrapper category-excerpts-wrapper clear-all">

			<?php if ( have_posts() ) { ?>

				<header class="title-date no-stripe">
					<h1 class="category-excerpt-h1"><?php printf( __( 'Search Results for: %s'), get_search_query() ); ?></h1>
				</header>

           
					<?php
			        while ( have_posts() ) {
								the_post();
								/* Include the Post-Format-specific template for the content.
								 * If you want to overload this in a child theme then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
						    get_template_part( 'loop', 'archive' );
							} //end while
					?>


				<nav class="category-nav clear-all">
        	<ul >
            <li class="link-ira oldposts"><?php next_posts_link('Older Posts', 0); ?></li>
            <li class="link-ira newposts"><?php previous_posts_link('Newer Posts', 0); ?></li>
          </ul>
        </nav>

			<?php } else { ?>

					<header class="title-date no-stripe">
						<h1 class="category-excerpt-h1"><?php _e( 'Nothing Found' ); ?></h1>
					</header>

					<article class="page type-page status-publish hentry category-post-excerpt">
						<div class="category-excerpt">
			        <?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.' ); ?>
            </div>
				  </article>

			<?php } ?>

			</section>

				<?php get_sidebar(); ?>

      </div>
      
<?php get_footer(); ?>
