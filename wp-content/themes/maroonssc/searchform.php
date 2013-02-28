<?php
/**
 * The template for displaying search forms
 *
 * @package WordPress
 * @subpackage MaroonsSC
 * @since MaroonsSC 1.0
 */
?>
  <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" name="" id="" class="search-form">
    <label for="search-field" class="hide"><?php _e( 'Search' ); ?>:</label>
    <input type="search" name="s" id="search-field" class="input search heavy-input-type" value="Search" />
    <label for="search-submit" class="hide"><?php _e( 'Submit' ); ?>:</label>
    <input type="submit" name="search-submit" id="search-submit" class="submit-image search-submit-image">
  </form>