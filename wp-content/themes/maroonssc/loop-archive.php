<?php
/**
 * The Loop used by archive.php and search.php
 *
 * @package WordPress
 * @subpackage MaroonsSC
 * @since MaroonsSC
 */
?>
<!-- LOOP ARCHIVE -->
<article id="post-<?php the_ID(); ?>" <?php post_class('category-post-excerpt'); ?>>


<?php	
	if ( !is_page() ) {
?>
	<header class="title-date">
  <!-- IS THIS GOING TO BE LINKED??? -->
		<h1 class="pb8"><a href="<?php the_permalink(); ?>" title="Read More About <?php the_title_attribute(); ?>" class="g0d0 n2u"><?php the_title(); ?></a></h1>
		<?php the_date( 'F j, Y', '<p class="date">', '</p>', true ); ?>
	</header>
<?php
  }
?>

	<div class="category-excerpt">
		<?php the_excerpt(); ?>
	</div>

	<footer class="category-post-footer">
    <div class="tag-list">
      <h6 class="read-more runin">Tagged: </h6>
      <?php echo get_the_tag_list('<p class="tags">', ', ', '</p>'); ?>
    </div>
		<a href="<?php the_permalink(); ?>" title="Read More About <?php the_title_attribute(); ?>" class="link-ir readmore">Read More</a>
	</footer>
</article>
