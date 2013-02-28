<?php
/**
 * header.php
 *
 * Displays <head> and global site header
 *
 * @package WordPress
 * @subpackage MaroonsSC
 * @since MaroonsSC 1.0
 *
 * TO CONSIDER FROM 2011
  - <meta charset="<?php bloginfo( 'charset' ); ?>" />
  - <meta name="viewport" content="width=device-width" />
  - <link rel="profile" href="http://gmpg.org/xfn/11" />
*/

/**
 * Add Wide Nav class in case the primary nav goes over 6
*/
$menu = wp_nav_menu( array( 'theme_location' => 'primary', 'echo' => false  ) );

$menu_count = wp_nav_menu( array( 'theme_location' => 'primary', 'echo' => false, 'depth' => 1 ) );

$num = substr_count ( $menu_count , '<li' );
$addl_classes = ( $num > 5 ) ? ' wide-nav' : '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <script>document.documentElement.className += ' js';</script>
  <meta charset="UTF-8" />

  <meta name="keywords" content="">

  <meta name="description" content="<?php

    // Add the blog description to meat description
    $site_description = get_bloginfo( 'description', 'display' );
    if ( isset($site_description)  ) {
      echo $site_description;
    }

  ?>">

  <title><?php
    /**
     * Add the page title followed by | if it exists
     * http://codex.wordpress.org/Function_Reference/wp_title
    */
    wp_title( '|', true, 'right' );
  
    // Add the blog name.
    bloginfo( 'name' );
  
  ?></title>

<?php
  /**
   * This should be abstracted to a user setting
   * <link href='http://fonts.googleapis.com/css?family=Alfa+Slab+One' rel='stylesheet' type='text/css'>
   * Possible css s/b written by php to replace names like 'Alfa Slab One' dynamically
  */
?>
  <link href='http://fonts.googleapis.com/css?family=Alfa+Slab+One' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
  <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php
  /**
   * Hook for plugins and themes to add additonal <head> elements
   * http://codex.wordpress.org/Plugin_API/Action_Reference/wp_head
  */
  wp_head();
?>
</head>
<body id="body-tag" <?php body_class(); ?>> 
  <!-- BEGIN: .site-wrapper -->
  <section class="site-wrapper">
    <div class="content-wrapper">
      <header class="site-header<?php echo $addl_classes; ?>">
        <h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo( 'template_url' ); ?>/img/logo.png" width="328" height="121" alt="Maroons Soccer Club" /></a></h1>
        <nav class="primary-site-nav<?php echo $addl_classes; ?>">
          <?php

            wp_nav_menu( array( 'theme_location' => 'primary' ) );

          ?>
        </nav>
        <?php get_search_form(); ?>
      </header>
