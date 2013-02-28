<?php
/**
 * Theme Functions, Plugins, Widgets and Helpers
 * Reference: http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage MaroonsSC
 * @since MaroonsSC 1.0
*/




/* ---------------------------------
 Theme Config
--------------------------------- */

// testing defining theme name, treating this as a config for the theme
define('THE_THEME', 'maroonssc');

//Store theme options
$to = get_option( THE_THEME . '_options');


// Config Dashboard Dev Reminder 
function themeby_dashboardbox() {
?>
<p><b>Theme By:</b> James Krayer<br />
   <a href="http://www.jameskrayer.com">http://www.jameskrayer.com</a><br />
   <a href="mailto:jameskrayer@yahoo.com">jameskrayer@yahoo.com</a></p>
<?php
}

function custom_dashboard_widget() {
  wp_add_dashboard_widget ( 'themeby-jkrayer', __('Contact The Developer'), 'themeby_dashboardbox' );
}

// Hook it in to the dashboard setup action
add_action('wp_dashboard_setup', 'custom_dashboard_widget');


/* ---------------------------------
 Universal Functions
--------------------------------- */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @link Required: http://codex.wordpress.org/Theme_Review#Template_Tags_and_Hooks
 *
 * @since 1.0
*/
if ( !isset($content_width) ) {
  $content_width = 620;
}


/**
 * Add theme suport for Custom Nav Menus
 *
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menu
 *
 * @since 1.0
*/
register_nav_menu( 'primary', 'Primary Nav' );


/**
 * Remove Theme Editor
 *
 * @since 1.0
*/
function remove_editor_menu() {
  remove_action('admin_menu', '_add_themes_utility_last', 101);
}

add_action('_admin_menu', 'remove_editor_menu', 1);


/**
 * Register jQuery and jQuery Functions
 *
 * @since 1.0
*/
function jquery_init() {
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', false, '1.7.1', true);
    wp_enqueue_script('jquery');
    // load a JS file from my theme: js/theme.js
    wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/site.js', array('jquery'), NULL, true );
  }
}

add_action('init', 'jquery_init');


/**
 * Register Sidebars
 *
 * @since 1.0
*/
// Right Sidebar
register_sidebar ( array('name' => 'Sidebar'
                       , 'before_widget' => '<section id="%1$s" class="sidebar-widget widget %2$s">'
                       , 'after_widget' => '</section>'
                       , 'description' => __( 'Widgets in this area will be shown on the right-hand side.' )
                        )
                 );


/**
 * Add theme support for Post Thumbnails
 *
 * @links http://codex.wordpress.org/Post_Thumbnails
 *
 * @since 1.0
*/
if ( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails', array( 'post' ) ); // thumbnails on post only
  add_image_size( 'feat-img', 9999, 311 ); // unlimited width x 311 high
}




/* --------------------------------- 
Theme Specific Functions
--------------------------------- */

/**
 * Display Sponsors If they exist Or return False
 *
 * @var array $to theme options
 * @var array $args arguments for wp_list_bookmarks
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_list_bookmarks
 *
 * @since 1.0
*/
function return_sponsors() {

  $args = array( 'categorize' => false
               , 'title_li' => NULL // kill links category title
               , 'echo' => false //return rather than display 
               , 'category_before' => ''
               , 'category_after' => '' // kill links being enclosed in an li
               );

  global $to;

  // If sponsor id is set in the options use it.
  if ( isset( $to['sponsor_cat'] ) && !empty( $to['sponsor_cat'] ) ) {
    $args['category'] = $to['sponsor_cat'];
  }
  // else try the word 'Sponsors'
  else {
    $args['category_name'] = 'Sponsors';
  }

  $r = wp_list_bookmarks( $args );
  
  return $r;

} // END fn


/**
 * Return footer meta set in the theme or a default Value
 *
 * @var array $to theme options
 *
 * @since 1.0
*/
function get_footer_meta() {

  global $to;

  if ( isset( $to['footer_copyright'] ) && !empty ( $to['footer_copyright'] ) ) {
    return $to['footer_copyright'];
  } else {
    return '&copy; 2012 Maroons Soccer Club Ridgewood, NJ';
  }

} // END fn



/**
 * Theme Control Panel
*/
require( get_template_directory() . '/inc/theme-options.php' );




/**
 * Meta Box for Posts
 * post_title_pos : add positioning style into home page display
 *
 * http://codex.wordpress.org/Function_Reference/add_meta_box
 *
 * parameters in order:
 * $id
 * $title
 * $callback
 * $post_type : Show only In Quote Content Type
 * $context
 * $priority
*/
function maroons_metainfo() {

  /**
   * Media Mentions and Recent News
   * Set Boolean for the display of these two items
   *
   * @since 1.0
  */
  add_meta_box (
    'displayblock-meta-box',
    __( 'Title Position', 'title_position_maroonssc' ),
    'displayblock_meta_box',
    'post',
    'side',
    'default' );

}


/**
 * Functions for the display of form fields for each meta box
*/
$class_arr = array( 'Top Left' => 'tl'
                  , 'Top Right' => 'tr'
                  , 'Bottom Left' => 'bl'
                  , 'Bottom Right' => 'br' );

/**
 * Display the Media Mentions / Recent News Checklist
 *
 * @since Socialflow 1.0
 *
 * @var array $pos Store title_position_maroonssc class
 * @var array $class_arr array of available values
*/
function displayblock_meta_box( $post ) {

  $pos = get_post_meta( $post->ID, 'title_position_maroonssc' );
  global $class_arr;

  // Use nonce for verification - http://codex.wordpress.org/Function_Reference/wp_nonce_field
  wp_nonce_field( plugin_basename( __FILE__ ), 'maroonssc_noncename' );

  // The actual fields for data entry
  echo '<ul class="form-no-clear">'; // cl = list:category categorychecklist
  foreach ( $class_arr as $k => $v ) {
    echo '  <li class="popular-category"><label for="title-position-' . $v . '" class="selectit">';
    echo '    <input type="radio"';
    if ( isset( $pos[0] ) && $pos[0] == $v ) { echo ' checked="checked"'; }
    echo ' id="title-position-' . $v . '" name="title_position_maroonssc" value="' . $v . '">' . $k . '</label></li>';
  }
  echo '</ul>';

}


/**
 * Functions for saving Meta Box data with post submit
*/
/**
 * Used by below functions to add and edit meta
 *
 * @internal needs check for value existing:
 * If a key -> value exists and the submitted value is blank a deletion should be  made
*/
function add_edit_meta( $quote_meta, $id ) {

 echo "this is the ";
 print_r($quote_meta);


  // Loop over _POST items and insert into DB
  foreach ( $quote_meta as $k => $v ) {
    // if the value is not empty proceed
    if ( !empty( $v ) ) {
      // try update
      if ( !update_post_meta( $id, $k, $v ) ) {
        // failing update try add, true so only one key value pair is stored
        add_post_meta( $id, $k, $v, true);
      }
    } else {
      // value was empty query the meta in the db
      $r = get_post_meta( $id, '', false );
      // if the submitted $key exists in the DB
      if ( array_key_exists( $k, $r ) ) {
        delete_post_meta( $id, $k );
      }
    }
  }
}




/**
 * Save Quote Meta Box data with post submit
 *
 * @since 1.0
*/
function quote_save_postdata( $post_id ) {

  global $class_arr;

  /**
   * verify if this is an auto save routine.
   * If it is our form has not been submitted, so we dont want to do anything
  */
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  /**
   * If 'maroonssc_noncename' is not in the $_POST data then this
   * is a page that's not useing this meta box
  */
  if ( !isset( $_POST['maroonssc_noncename'] ) ) {
    return;
  }

  /**
   * verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times
  */
  if ( !wp_verify_nonce( $_POST['maroonssc_noncename'], plugin_basename( __FILE__ ) ) ) {
    return;
  }

  // Check permissions
  if ( 'post' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) ) {
      echo "editpage";
      return;
    }
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) ) {
      echo "editpost";
      return;
    }
  }

  // OK, we're authenticated: we need to find and save the data
  // store post content in vars
  $id = $_POST['post_ID'];

  $quote_meta = array(
    'title_position_maroonssc' => $_POST['title_position_maroonssc']
  );

  //error check passed value
  if ( !in_array($quote_meta['title_position_maroonssc'], $class_arr ) ) {
    $quote_meta = 'tl';
  }

  // Loop over _POST items and insert into DB
  add_edit_meta( $quote_meta, $id );

}




/**
 * Init Hooks
 *
 * Define the custom box
 * Do something with the data entered
 *
 * @var array $save all save function names looped over and added to WP
*/

// adds all meta boxes
add_action( 'add_meta_boxes', 'maroons_metainfo' );

// adds all save functions
add_action( 'save_post', 'quote_save_postdata' );

?>
