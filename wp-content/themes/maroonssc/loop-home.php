<?php
/**
 * Home Page Loop
 *
 * @package WordPress
 * @subpackage MaroonsSC
 * @since MaroonsSC 1.0
*/

/**
 * exclude "uncategorized"
*/
query_posts( '&cat=-1');

// duh
$i = 1;

if ( have_posts() ) {

  while ( have_posts() ) {
    the_post();

    //alternating classes for home page blocks
    $feature_class = ( $i % 2 ) ? 'home-post-excerpt red' : 'home-post-excerpt yellow';
		$feature_class .= ( $i % 3 ) ? '' : ' third';
    $title_class = ( $i % 2 ) ? 'n2u fff' : 'n2u g0d0';
		//post thumbs
		$post_thumb = ( has_post_thumbnail() ) ? true : false;
		//thumb = true
		$feature_class .= ( $post_thumb ) ? ' with-img' : '';
    //title pos
    $title_pos = get_post_meta( $post->ID, 'title_position_maroonssc' );
    $title_pos = ( count( $title_pos ) > 0 ) ? $title_pos[0] : 'tl';

?>
<!-- LOOP HOME -->
        <article id="post-<?php the_ID(); ?>" <?php post_class( $feature_class ); ?>>
          <h1 class="<?php echo $title_pos; ?>">
            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="<?php echo $title_class; ?>"><?php the_title(); ?></a>
          </h1>
          <?php
          if ( $post_thumb ) { 
          ?>
					  
            <div class="img-full-wrapper"><?php the_post_thumbnail('feat-img'); ?></div>

          <?php
					} else {
					?>
          <div class="home-excerpt"><?php // the_excerpt(); ?></div>
          <?php
					}
					?>
        </article>

<?php
    $i++;
  } // END While

} else {

  echo ( "<p>No Posts were found.</p>" );

}

?>
