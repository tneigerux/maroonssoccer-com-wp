<?php
/**
 * The main template file.
 *
 * Handles Page, Single
 *
 * @package WordPress
 * @subpackage MaroonsSC
 * @since 1.0
*/

//global header
get_header();

?>

      <div class="clear-all stretch-wrapper"> <!-- Clearing div for content + sidebar -->
      <section class="interior-content-wrapper category-excerpts-wrapper clear-all">
<?php while ( have_posts() ) {
         the_post();

	       get_template_part( 'loop' );

         // comments_template( '', true );

       } // end of the loop.
?>
      </section>

      	<?php get_sidebar(); ?>

      </div> <!-- Clearing div for content + sidebar -->


<!-- END category.php content -->
<?php get_footer(); ?>
