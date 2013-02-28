<?php
/**
 * Global Footer
 *
 * @package WordPress
 * @subpackage MaroonsSC
 * @since 1.0
*/

/**
 * Get Sponsors
 *
 * @since 1.0
*/
$rs = return_sponsors();

?>

      <?php if ( $rs ) {  ?>
      <aside class="widget sponsors-widget clear-all">
        <ul>
          <?php echo $rs; ?>
        </ul>
      </aside>
      <?php } ?>
    
    </div>
    <footer class="content-wrapper site-footer">
    	<p class="footer-copyright"><?php echo get_footer_meta(); ?></p>
      <a href="#body-tag" title="Back to the Top of this Page" class="link-ir backtotop">Back To Top</a>
    </footer>
  </section>
  <!-- END: .site-wrapper -->
  <?php
    /**
     * For Footer Hooks
		 * Do Not Remove
    */
    wp_footer();
  ?>
 </body>
</html>
