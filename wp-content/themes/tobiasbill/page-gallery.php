<?php
/*
Template Name: Gallery
*/
?>

<?php get_template_part('templates/page', 'header'); ?>

<?php while (have_posts()) : the_post(); ?>
  <?php the_content(); ?>

  <div class="zip">

  	
<!-- fixa -->

 
<?$field_name = "zip";  ?>
<?php $field = get_field_object($field_name);  ?>
 
<?php  echo $field['label'];  ?>
<a href=" '<?php  echo $field['value'] ?>'">Här </a>
 



	<?php /*if( get_field( "zip-text" ) ): ?>
	<p><?php echo the_field("zip-text"); ?></p>
	<?php if( get_field( "zip" ) ): ?>
		<h5>Ladda ner bilderna <a href="<?php echo the_field( "zip" ); ?>">här</a></h5>
	<?php endif; */?>
</div>

  <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php endwhile; ?>