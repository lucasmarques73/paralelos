<?php
/*
Plugin Name: WP FB Like Button
Version: 1.1
Description: Adds Facebook "Like" button to your posts
Usage:  Choose an option in the options menu, or insert <!--fb_like--> into your post
Author: Mind Development & Design LLC
Author URI: http://www.minddnd.com
*/

if(!function_exists('wp_fb_like_menu')) {
  function wp_fb_like_menu () {
    add_options_page("WP FB Like Button", "WP FB Like Button", 8, basename(__FILE__), "wp_fb_like_options");
  }
}

if (!function_exists('wp_fb_like_options')) {
  function wp_fb_like_options() {
    ?>
    <div class="wrap">
    <h2>WP Facebook Like Button Options</h2>
    <form name="wp_fb_option_form" method="post">
    <p>Select button alignment:<br/>
    <select name="wp_fb_like_align" id="wp_fb_like_align">
    <option value="bn" <?php if ((get_option("wp_fb_like_align") == "bn") || (!get_option("wp_fb_like_align"))) echo ' selected'; ?>>None (Bottom)</option>
    <option value="tn" <?php if (get_option("wp_fb_like_align") == "tn") echo 'selected'; ?>>None (Top)</option>
    <option value="tl" <?php if (get_option("wp_fb_like_align") == "tl") echo 'selected'; ?>>Top Left</option>
    <option value="tr" <?php if (get_option("wp_fb_like_align") == "tr") echo 'selected'; ?>>Top Right</option>
    <option value="bl" <?php if (get_option("wp_fb_like_align") == "bl") echo 'selected'; ?>>Bottom Left</option>
    <option value="br" <?php if (get_option("wp_fb_like_align") == "br") echo 'selected'; ?>>Bottom Right</option>
    </select>
    </p>

    <p>Layout Style:<br/>
    <select name="wp_fb_like_layout" id="wp_fb_like_layout">
    <option value="standard" <?php if (get_option("wp_fb_like_layout") == "standard") echo 'selected'; ?>>standard</option>
    <option value="button_count" <?php if (get_option("wp_fb_like_layout") == "button_count") echo 'selected'; ?>>button_count</option>
    </select>
    </p>

    <p>Show Faces:<br/>
    <select name="wp_fb_like_show_faces" id="wp_fb_like_show_faces">
    <option value="true" <?php if (get_option("wp_fb_like_show_faces") == "true") echo 'selected'; ?>>true</option>
    <option value="false" <?php if (get_option("wp_fb_like_show_faces") == "false") echo 'selected'; ?>>false</option>
    </select>
    </p>

    <p>Verb to display:<br/>
    <select name="wp_fb_like_action" id="wp_fb_like_action">
    <option value="like" <?php if (get_option("wp_fb_like_action") == "like") echo 'selected'; ?>>like</option>
    <option value="recommend" <?php if (get_option("wp_fb_like_action") == "recommend") echo 'selected'; ?>>recommend</option>
    </select>
    </p>

    <p>Color Scheme:<br/>
    <select name="wp_fb_like_colorscheme" id="wp_fb_like_colorscheme">
    <option value="light" <?php if (get_option("wp_fb_like_colorscheme") == "light") echo 'selected'; ?>>light</option>
    <option value="dark" <?php if (get_option("wp_fb_like_colorscheme") == "dark") echo 'selected'; ?>>dark</option>
    </select>
    </p>

    <?php
      $wp_fb_like_width = get_option("wp_fb_like_width");
      if($wp_fb_like_width == '') { $wp_fb_like_width = '450'; }
      $wp_fb_like_height = get_option("wp_fb_like_height");
      if($wp_fb_like_height == '') { $wp_fb_like_height = '100'; }
    ?>

    <p>Width:<br/>
    <input type="text" name="wp_fb_like_width" id="wp_fb_like_width" value="<?= $wp_fb_like_width ?>">
    </p>

    <p>Height:<br/>
    <input type="text" name="wp_fb_like_height" id="wp_fb_like_height" value="<?= $wp_fb_like_height ?>">
    </p>

    <p>Show on pages:<br/>
    <select name="wp_fb_show_pages" id="wp_fb_show_pages">
    <option value="no"<?php if (get_option("wp_fb_show_pages") == "no") echo 'selected'; ?>>no</option>
    <option value="yes"<?php if (get_option("wp_fb_show_pages") == "yes") echo 'selected'; ?>>yes</option>
    </select>
    </p>

    <p>Automatically show button: <em>Select "no" if you are using the template tag</em><br/>
    <select name="wp_fb_show_auto" id="wp_fb_show_auto">
    <option value="yes"<?php if (get_option("wp_fb_show_auto") == "yes") echo 'selected'; ?>>yes</option>
    <option value="no"<?php if (get_option("wp_fb_show_auto") == "no") echo 'selected'; ?>>no</option>
    </select>
    </p>

    <p><input type="submit" value="Save &raquo;"></p>
    <input type="hidden" name="wp_fb_form_submit" value="true" />
    </form></div>
<?php
  }
}

if (!function_exists('wp_fb_like_handler')) {
  function wp_fb_like_handler() {
    if(isset($_POST['wp_fb_form_submit'])) {
      update_option("wp_fb_like_align", $_POST['wp_fb_like_align']);
      update_option("wp_fb_like_layout", $_POST['wp_fb_like_layout']);
      update_option("wp_fb_like_show_faces", $_POST['wp_fb_like_show_faces']);
      update_option("wp_fb_like_action", $_POST['wp_fb_like_action']);
      update_option("wp_fb_like_colorscheme", $_POST['wp_fb_like_colorscheme']);
      update_option("wp_fb_like_width", intval($_POST['wp_fb_like_width']));
      update_option("wp_fb_like_height", intval($_POST['wp_fb_like_height']));
      update_option("wp_fb_show_pages", $_POST['wp_fb_show_pages']);
      update_option("wp_fb_show_auto", $_POST['wp_fb_show_auto']);
    }
  }
}

if(!function_exists('wp_fb_like_format')) {
  function wp_fb_like_format($align) {
    if($align == 'left') { $margin = '5px 5px 5px 0'; }
    if($align == 'right') { $margin = '5px 0 5px 5px'; }
    if($align == 'none') { $margin = '0'; }
    $layout = get_option("wp_fb_like_layout");
    if($layout == '') { $layout = 'standard'; }
    $show_faces = get_option("wp_fb_like_show_faces");
    if($show_faces == '') { $show_faces = 'true'; }
    $action = get_option("wp_fb_like_action");
    if($action == '') { $layout = 'like'; }
    $colorscheme = get_option("wp_fb_like_colorscheme");
    if($colorscheme == '') { $colorscheme = 'light'; }
    $width = get_option("wp_fb_like_width");
    if($width == '') { $width = '450'; }
    $height = get_option("wp_fb_like_height");
    if($height == '') { $height = '100'; }      
		global $post;
		$permalink = get_permalink($post->ID);
    $html = '<div id="wp_fb_like_button" style="margin: '.$margin.'; float: '.$align.'"><iframe src="http://www.facebook.com/plugins/like.php?href='.htmlentities($permalink).'&amp;layout='.$layout.'&amp;show_faces='.$show_faces.'&amp;action='.$action.'&amp;colorscheme='.$colorscheme.'&amp;width='.$width.'&amp;height='.$height.'" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width: '.$width.'px; height: '.$height.'px;"></iframe></div>';
    return $html;
  }
}

if (!function_exists('insert_wp_fb_like')) {
  function insert_wp_fb_like() {
    $align = get_option("wp_fb_like_align");
    echo wp_fb_like_format('none');
  }
}

if (!function_exists('wp_fb_show_button')) {
  function wp_fb_show_button($content) {
    $align = get_option("wp_fb_like_align");
    switch($align) {
      case 'tl':
        return wp_fb_like_format('left').$content;
        break;
      case 'tr':
        return wp_fb_like_format('right').$content;
        break;
      case 'bl':
        return $content.wp_fb_like_format('left');
        break;
      case 'br':
        return $content.wp_fb_like_format('right');
        break;
      case 'tn':
        return wp_fb_like_format('none').$content;
        break;
      case 'bn':
        return $content.wp_fb_like_format('none');
        break;            
      default:
        return $content.wp_fb_like_format('none');
    }
  }
}

if (!function_exists('wp_fb_like')) {
  function wp_fb_like($content) {
    if (get_option("wp_fb_show_auto") == "no") { return $content; }
		if ( !is_feed() && !is_archive() && !is_search() && !is_404() && !is_page() ) {
    		if(! preg_match('|<!--fb_like-->|', $content)) {
          return wp_fb_show_button($content);
    		} else {
          return str_replace('<!--fb_like-->', wp_fb_like_format('none'), $content);
        }
    }
    else { 
      if (get_option("wp_fb_show_pages") == "yes") {
        return wp_fb_show_button($content);        
      }
      else {
        return $content;
      }
    }
	}
}

add_filter('the_content', 'wp_fb_like', 999);
add_action('admin_menu', 'wp_fb_like_menu');
add_action('init', 'wp_fb_like_handler');

?>
