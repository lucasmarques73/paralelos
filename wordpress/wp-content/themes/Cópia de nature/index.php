<?php get_header(); ?>

	<?php if (have_posts()) : ?>

		<?php $post = $posts[0]; // Thanks Kubrick for this code ?>
		
		<?php if (is_category()) { ?>
		<div class="page-title">
			<h2 class="page-title-border"><?php _e('Archive for'); ?> <?php echo single_cat_title(); ?></h2>
		</div>
 	  	<?php } elseif (is_day()) { ?>
		<div class="page-title">
			<h2 class="page-title-border"><?php _e('Archive for'); ?> <?php the_time('F j, Y'); ?></h2>
		</div>
	 	<?php } elseif (is_month()) { ?>
		<div class="page-title">
			<h2 class="page-title-border"><?php _e('Archive for'); ?> <?php the_time('F, Y'); ?></h2>
		</div>
		<?php } elseif (is_year()) { ?>
		<div class="page-title">
			<h2 class="page-title-border"><?php _e('Archive for'); ?> <?php the_time('Y'); ?></h2>
		</div>
		<?php } elseif (is_author()) { ?>
		<div class="page-title">
			<h2 class="page-title-border"><?php _e('Author Archive'); ?></h2>
		</div>
		<?php } elseif (is_search()) { ?>
		<div class="page-title">
			<h2 class="page-title-border"><?php _e('Search Results'); ?></h2>
		</div>
		<?php } ?>

		
		<?php while (have_posts()) : the_post(); ?>
			
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
				<span class="post-comment"><?php comments_popup_link(__('No Comment'), __('1 Comment'), __('% Comments'), 'commentslink', __('Comments are off')); ?></span>&nbsp;
				<span class="post-filed"><?php the_category(', ') ?></span>
				<?php edit_post_link(__('Edit'), ' &#183; ', ''); ?>
				</p>
				</div> <!-- end posthead -->
		
				<div class="postentry">
				<?php if (is_search()) { ?>
					<?php the_excerpt() ?><div style="clear:both;"></div>
				<?php } else { ?>
					<?php the_content(__('Read the rest of this entry &raquo;')); ?><div style="clear:both;"></div>
				<?php } ?>
				</div> <!-- end postentry -->
				
				<!--
				<?php trackback_rdf(); ?>
				-->
			
			</div>
				
		<?php endwhile; ?>

		<div class="pages">
		<div class="pages-border"></div>
		<span class="page-previous"><?php posts_nav_link(' ', '', __('&laquo; Older Entries')); ?></span>
		<span class="page-next"><?php posts_nav_link('', __('Newer Entries &raquo;'), ''); ?></span>
		</div> <!-- end pages -->

	<?php else : ?>
		
		<div class="post">
		<h2><?php _e('Error 404 - Not found'); ?></h2>
		</div>

	<?php endif; ?>


<?php get_sidebar(); ?>

<?php get_footer(); ?>
