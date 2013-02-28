<?php
/**
 * The default template for displaying content
 *
 * Hanldes Page, Single
 *
 * @package WordPress
 * @subpackage MaroonsSC
 * @since MaroonsSC
 */
 
 $page = ( is_page() ) ? true : false;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('category-post-excerpt'); ?>>


<?php	
	if ( !$page ) {
?>
	<header class="title-date">
		<h1 class="pb8"><?php the_title(); ?></h1>
		<?php the_date( 'F j, Y', '<p class="date">', '</p>', true ); ?>
	</header>
<?php
  }
?>

	<div class="wysiwyg-content">
		<?php the_content(); ?>
	</div>

<?php
	if ( !$page ) {
	  if ( get_the_tag_list() ) {
?>
	<footer class="single-post-footer">
    <div class="tag-list">
      <h6 class="read-more runin">Tagges: </h6>
      <?php echo get_the_tag_list('<p class="tags">', ', ', '</p>'); ?>
    </div>

	</footer>
<?php
	  }
	}
?>

</article>
