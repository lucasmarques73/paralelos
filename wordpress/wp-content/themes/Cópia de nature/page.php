<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="post" id="post-<?php the_ID(); ?>">

		<h2 class="posttitle"><?php the_title(); ?></h2>
			
		<?php the_content(__('Read the rest of this page &raquo;')); ?><div style="clear:both;"></div>
		<?php wp_link_pages(); ?>
		
		<?php edit_post_link(__('Edit'), '<p>', '</p>'); ?>

	</div>
	
	<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
