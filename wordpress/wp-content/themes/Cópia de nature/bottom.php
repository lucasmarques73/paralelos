<div id="bottom-sep">&nbsp;</div>
<div id="bottom">

<div class="bottom-divs">


	<div id="bottom-left">
		<?php
			$today = current_time('mysql', 1);
			if ( $recentposts = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish' AND post_date_gmt < '$today' ORDER BY post_date DESC LIMIT 8")):
		?>

		<h2><?php _e("Recent Posts"); ?></h2>
		<ul>
			<?php foreach ($recentposts as $post) { if ($post->post_title == '') $post->post_title = sprintf(__('Post #%s'), $post->ID);
			echo "<li><a href='".get_permalink($post->ID)."'>"; the_title(); echo '</a></li>'; }?>
		</ul>
		<?php endif; ?>
	</div>
	


	<div id="bottom-mid">
		<h2><?php _e("Links"); ?></h2>
		<ul>
			<li><a href="" title="">Partners</a></li>
			<li><a href="" title="">Bookmark</a></li>
			<li><a href="" title="">My Link</a></li>
			<li><a href="" title="">Partners</a></li>
			<li><a href="" title="">Bookmark</a></li>
		</ul>
	</div>


	<div id="bottom-right">
		<h2><?php _e("Meta"); ?></h2>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<li><a href="http://validator.w3.org/check?uri=referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
			<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
			<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
			<?php wp_meta(); ?>
		</ul>
	</div>

</div>

</div> <!-- end bottom -->