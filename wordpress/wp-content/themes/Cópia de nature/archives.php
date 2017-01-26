<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="archives">
		
	<?php if (function_exists('af_ela_super_archive')) { ?>
		<?php af_ela_super_archive(); ?><div style="clear:both;"></div>
	<?php } ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>