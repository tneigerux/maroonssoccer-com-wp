<?php
/**
 * Theme Options
 * Included by functions.php
 *
 * @package WordPress
 * @subpackage MaroonsSC
 * @since 1.0
*/


/**
 * Register Theme Options & Add them to our form
 *
 * @since 1.0
*/
function theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( !get_option( THE_THEME . '_options' ) ) {
		add_option( THE_THEME . '_options' );
	}
	
  /**
	 * http://codex.wordpress.org/Function_Reference/register_setting
	 *
	 * Since 1.0 
	*/
	register_setting( THE_THEME . '_theme_options', THE_THEME . '_options' );


	/**
	 * http://codex.wordpress.org/Function_Reference/add_settings_section
	 *
	 * @since 1.0
	*/
	add_settings_section( 'general', '', '__return_false',  THE_THEME . '_options' );

	/**
	 * http://codex.wordpress.org/Function_Reference/add_settings_field
	 *
	 * The next set of fuctions adds fields to the theme_options form
	 *
   * add_option : sponsor_cat : store sponsor category id from list of links categories
   *            : footer_copyright : store footer copyright line
 
	 *
	 * @since 1.0
	*/
	add_settings_field( 'footer_copyright', __( 'Footer Copyright' ), 'theme_show_textfield', THE_THEME . '_options', 'general', 'footer_copyright' );
  add_settings_field( 'sponsor_cat', __( 'Sponsor Category' ), 'theme_settings_links_category', THE_THEME . '_options', 'general', 'sponsor_cat' );

}
add_action( 'admin_init', 'theme_options_init' );

/**
 * Custom Admin Menus
 *
 * http://codex.wordpress.org/Function_Reference/add_theme_page
 *
 * parameters in order:
 * $page_title
 * $menu_title
 * $capability
 * $menu_slug
 * $function
*/
function theme_admin_pages() {

  /**
   * Theme Options
   *
   * @since 1.0
  */
    add_theme_page(
      __( 'Theme Options' ),
      __( 'Theme Options' ),
      'edit_theme_options',
      THE_THEME . '_options',
      'show_theme_options'
    );

}
add_action( 'admin_menu', 'theme_admin_pages' );


/**
 * Store theme options for global usage below
*/
$to = get_option( THE_THEME . '_options' );

/**
 * Store Helper text for each Option Field, for global usage below
*/
$helper_text = array(
  'field_name' => 'Select One',
  'footer_copyright' => 'You may leave this field blank to use the default copyright information.',
  'sponsor_cat' => 'Select the name of the sponsors category here if it is other than "Sponsors".'
);




/**
 * Get LinksCatgories as A Select List
 *
 * @param string $fn field name
 *
 * @var array $links_cat array of link categories
 *
 * @since 1.0
*/
function theme_settings_links_category( $fn ) {

  global $to;
	global $helper_text;
	$links_cat = get_terms( 'link_category', array( 'hide_empty ' => false ) );

?>	
	<select id="<?php echo $fn; ?>" name="<?php echo THE_THEME; ?>_options[<?php echo $fn; ?>]">  
    <option value="0">Chose One</option>
<?php
  foreach ( $links_cat as $v ) {
		echo '<option value="' . $v->term_id . '"';
		echo ( isset($to[$fn]) && $v->term_id == $to[$fn] ) ? ' selected="selected"' : '';
		echo '>' . $v->name . '</option>' . "\n";
	}
?>
  </select><span class="description"> <?php echo ( isset($helper_text[$fn]) ) ? $helper_text[$fn] : ''; ?></span>
<?php
}


/**
 * Display an <input> 
 *
 * @param string $fn field name
 *
 * @since 1.0
*/
function theme_show_textfield( $fn ) {

  global $to;
	global $helper_text;

?>
   <input type="text" id="<?php echo $fn; ?>" name="<?php echo THE_THEME; ?>_options[<?php echo $fn; ?>]" class="" value="<?php echo ( isset($to[$fn]) && !empty($to[$fn]) ) ? $to[$fn] : ''; ?>" />
   <span class="description"><?php echo ( isset($helper_text[$fn]) ) ? $helper_text[$fn] : ''; ?></span>
<?php
  
} // END fn


/**
 * Show theme Options Page
 *
 * @since 1.0
*/
function show_theme_options() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'socialflow' ), get_current_theme() ); ?></h2>
		<?php settings_errors(); ?>
		<form method="post" action="options.php">
			<?php
				settings_fields( THE_THEME . '_theme_options' );
				do_settings_sections( THE_THEME . '_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

?>
