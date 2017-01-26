</div> <!-- end of #content -->
<div id="sidebar">


<ul>
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>
	<li>
		<h2><?php _e('About Me'); ?></h2>
		<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
		</p>


		<h2><?php _e('Subscribe to this Site'); ?></h2>
		<ul class="no-splitted">
		<li><a href="<?php bloginfo('rss2_url'); ?>">Posts RSS</a></li>
		<li><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments RSS</a></li>
		</ul>


		<h2><?php _e('Calendar'); ?></h2>
		<?php get_calendar() ?>


		<h2><?php _e('Search'); ?></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>


		<?php if (function_exists('wp_theme_switcher')) { ?>
		<h2><?php _e('Themes'); ?></h2>
		<ul class="no-splitted">
		<li><?php wp_theme_switcher('dropdown'); ?></li>
		</ul>
		<?php } ?>
	</li>



	
	<li id="sidebar-splitted">
		

		<div class="splitted-left">
			<h2><?php _e('Categories'); ?></h2>
			<ul class="splittedlists">
			<?php wp_list_cats('sort_column=id&hide_empty=0&optioncount=0&hierarchical=1'); ?> 
			</ul>
		</div>
		

		<div class="splitted-right">
			<h2><?php _e('Archives'); ?></h2>
			<ul class="splittedlists">
			<?php wp_get_archives('type=monthly&limit=12&show_post_count=0'); ?>
			</ul>
		</div>

	</li>



<?php endif; ?>
</ul>



</div> <!-- end sidebar -->