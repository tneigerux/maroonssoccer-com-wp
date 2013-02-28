<?php
/**
 * The Home Page
 *
 * @package WordPress
 * @subpackage MaroonsSC
 * @since MaroonsSC 1.0
 */

// global header
get_header();

?>

      <section class="home-excerpts-wrapper clear-all">
        <?php get_template_part( 'loop', 'home' ); ?>
      </section>

<?php

//global footer
get_footer();

?>
