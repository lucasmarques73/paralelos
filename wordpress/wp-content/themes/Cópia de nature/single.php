<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
			<div style="clear:both;"></div>
		</div>

		<div class="post" id="post-<?php the_ID(); ?>">
	
			<div class="posthead">
			<h2 class="posttitle">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permalink to'); ?> <?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>

			<p class="postdate">
			<strong class="day"><?php the_time('d'); ?></strong>
			<strong class="month"><?php the_time('M'); ?></strong>
			<strong class="year"><?php the_time('Y'); ?></strong>
			</p>
			
			<p class="postmeta"> 
			<span class="post-date"><?php the_time('j M, Y') ?></span>&nbsp;
			<span class="post-filed"><?php the_category(', ') ?></span>
			<?php edit_post_link(__('Edit'), ' &#183; ', ''); ?>
			</p>
			</div> <!-- end posthead -->
					
			<div class="postentry">
			<?php the_content(__('Read the rest of this entry &raquo;')); ?><div style="clear:both;"></div>
			<?php wp_link_pages(); ?>
			</div> <!-- end postentry -->
		</div>
				
		<div class="post">
			<?php comments_template(); ?>
		</div>

	<?php endwhile; else : ?>

		<div class="post">
			<h2><?php _e('Error 404 - Not found'); ?></h2>
		</div>

	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>