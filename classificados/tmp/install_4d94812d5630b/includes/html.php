<?php
/**
* @version $Id: html.php 4820 2009-01-05 11:46:25Z Radek Suski $
* @package: Sigsiu Online Business Index 2
* ===================================================
* @author
* Name: Sigrid & Radek Suski, Sigsiu.NET
* Email: sobi@sigsiu.net
* Url: http://www.sigsiu.net
* ===================================================
* @copyright Copyright (C) 2006 - 2009 Sigsiu.NET (http://www.sigsiu.net). All rights reserved.
* @license see http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL.
* You can use, redistribute this file and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation.
*/

/*
 * no direct access
 */
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
class sobiHTML {
	/**
	 * @param string $value
	 * @param string $text
	 * @param string $id
	 * @param string $attr
	 * @param string $class
	 * @param string $selected
	 * @param bool $disabled
	 * @param bool $readonly
	 * @return stdClass
	 */
	function makeOption( $value, $text = null, $id = null, $attr = null, $class = "inputbox", $selected = false, $disabled = false, $readonly = false )
	{
		$obj 				= new stdClass;
		$obj->value			= $value;
		$obj->text 			= $text;
		$obj->id 			= $id;
		$obj->attr 			= $attr;
		$obj->selected 		= $selected;
		$obj->disabled 		= $disabled;
		$obj->readonly 		= $readonly;
		$obj->class 		= $class;
		return $obj;
	}
	/**
	 * @param array $arr An array of objects
	 * @param string $name
	 * @param string $title
	 * @param string $text
	 * @param int $cols
	 * @param string $lor
	 * @param bool $fieldset
	 * @param array $selected
	 * @param string $class
	 * @return string
	 */
	function checkBoxGroup( &$arr, $name, $selected = null, $text = null, $cols = 2, $lor = "left", $fieldset = true , $class = null )
	{
		if ( is_array( $arr ) ) {
			reset( $arr );
		}
		$class = $class ? " class=\"{$class}\" " : null;
		$html = "\n\n\t<table {$class}>\n\t\t<tr>";
		$col = 0;
		$c = 0;
		foreach( $arr as $opt ) {
			if( $col == $cols) {
				$html .= "\n\t\t</tr>\n\t\t<tr>";
				$col = 0;
			}
			$col++;
			$c++;
			$checked = ( is_array( $selected ) && array_keys( $selected, $opt->value ) ) || $opt->selected ? " checked=\"checked\" " : null;
			$id = $opt->id ? $opt->id : "{$name}_{$c}";
			$disabled = $opt->disabled ? " disabled=\"disabled\" " : null;
			$readonly = $opt->readonly ? " readonly " : null;
			$class = $opt->class ? " class=\"{$opt->class}\" " : " class=\"inputbox\" ";
			$box = "\n\t\t\t\t<input id=\"{$id}\" name=\"{$name}[]\" value=\"{$opt->value}\"{$checked}{$opt->attr}{$disabled} {$class}{$readonly}type=\"checkbox\"/>";
			$label = "\n\t\t\t\t<label for=\"{$id}\">{$opt->text}</label>";
			switch ($lor) {
				default:
				case "left":
					$box .= $label;
					break;
				case "right":
					$box = $label.$box;
					break;
			}
			$html .= "\n\t\t\t<td>{$box}\n\t\t\t</td>";
			if( $c == count($arr) ) {
				if( $col != $cols ) {
					$col = $cols - $col;
					$colspan = $col > 1 ? " colspan=\"{$col}\" " : null;
					$html .= "\n\t\t\t<td{$colspan}>\n\t\t\t\t&nbsp;\n\t\t\t</td>";
				}
				$html .= "\n\t\t</tr>";
			}
		}
		$html .= "\n\t</table>\n\n";
		if($fieldset) {
			$html = "\n\n\n<fieldset id=\"{$name}\"> \n\n<legend>{$text}</legend> \n\n {$html} </fieldset>\n\n";
		}
		return $html;
	}
	/**
	* Generates an HTML select list
	* @param array An array of objects
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param string The name of the object variable for the option value
	* @param string The name of the object variable for the option text
	* @param mixed The key that is selected
	* @returns string HTML for the select list
	*/
	function selectList( &$arr, $tag_name, $tag_attribs, $key, $text, $selected=NULL )
	{
		// check if array
		if ( is_array( $arr ) ) {
			reset( $arr );
		}
		if(!(strstr($tag_attribs, "class"))) {
			$class = defined("_SOBI2_ADMIN") ? "class = \"text_area\"" : "class = \"inputbox\"";
		}
		else {
			if(defined("_SOBI2_ADMIN") && (strstr( $tag_attribs, 'class="inputbox"') || strstr( $tag_attribs, "class='inputbox'"))) {
				$tag_attribs = str_replace( array('class="inputbox"',"class='inputbox'"), 'class="text_area"', $tag_attribs);
			}
			$class = null;
		}
		$html 	= "\n<select name=\"$tag_name\" $tag_attribs $class>";
		$count 	= count( $arr );

		for ($i=0, $n=$count; $i < $n; $i++ ) {
			$k = $arr[$i]->$key;
			$t = $arr[$i]->$text;
			$id = ( isset($arr[$i]->id) ? @$arr[$i]->id : null);

			$extra = $id ? " id=\"" . $arr[$i]->id . "\"" : '';
			if (is_array( $selected )) {
				foreach ($selected as $obj) {
					$k2 = $obj->$key;
					if ($k == $k2) {
						$extra .= " selected=\"selected\"";
						break;
					}
				}
			} else {
				$extra .= ($k == $selected ? " selected=\"selected\"" : '');
			}
			$html .= "\n\t<option value=\"".$k."\"$extra >" . $t . "</option>";
		}
		$html .= "\n</select>\n";

		return $html;
	}
	/**
	* Writes a yes/no select list
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @returns string HTML for the select list values
	*/
	function yesnoSelectList( $tagName, $tagAttribs, $selected, $yes=_SOBI2_YES_U, $no=_SOBI2_NO_U )
	{
		$arr = array(
						sobiHTML::makeOption( 0, $no ),
						sobiHTML::makeOption( 1, $yes ),
					);
		return sobiHTML::selectList( $arr, $tagName, $tagAttribs, 'value', 'text', $selected );
	}

	/**
	* Generates an HTML radio list
	* @param array An array of objects
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @param string The name of the object variable for the option value
	* @param string The name of the object variable for the option text
	* @returns string HTML for the select list
	*/
	function radioList( &$arr, $tag_name, $tag_attribs, $selected=null, $key='value', $text='text' )
	{
		reset( $arr );
		$html = null;
		for ($i=0, $n=count( $arr ); $i < $n; $i++ ) {
			$k = $arr[$i]->$key;
			$t = $arr[$i]->$text;
			$id = ( isset($arr[$i]->id) ? @$arr[$i]->id : null);

			$extra = '';
			$extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
			if (is_array( $selected )) {
				foreach ($selected as $obj) {
					$k2 = $obj->$key;
					if ($k == $k2) {
						$extra .= " selected=\"selected\"";
						break;
					}
				}
			} else {
				$extra .= ($k == $selected ? " checked=\"checked\"" : '');
			}
			$html .= "\n\t<input type=\"radio\" name=\"$tag_name\" id=\"$tag_name$k\" value=\"".$k."\"$extra $tag_attribs />";
			$html .= "\n\t<label for=\"$tag_name$k\">$t</label>";
		}
		$html .= "\n";

		return $html;
	}

	/**
	* Writes a yes/no radio list
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @returns string HTML for the radio list
	*/
	function yesnoRadioList( $tagName, $tagAttribs, $selected, $yes=_SOBI2_YES_U, $no=_SOBI2_NO_U )
	{
		$arr = array(
			sobiHTML::makeOption( '0', $no ),
			sobiHTML::makeOption( '1', $yes )
		);
		return sobiHTML::radioList( $arr, $tagName, $tagAttribs, $selected );
	}

	/**
	* Writes Back Button
	*/
	function BackButton ( &$params, $hideJs = null )
	{
		// Back Button
		if ( $params->get( 'back_button' ) && !$params->get( 'popup' ) && !$hideJs ) {
			?>
			<div class="back_button">
				<a href='javascript:history.go(-1)'>
					<?php echo _BACK; ?></a>
			</div>
			<?php
		}
	}
	/**
	 * @param string $tooltip
	 * @param string $title
	 * @param int $width
	 * @param string $image
	 * @param string $text
	 * @param string $href
	 * @param bool $link
	 * @param string $position
	 * @return string
	 */
	function toolTip( $tooltip, $title = null, $width = null, $image="info.png", $text = null, $href = "#", $link = true, $position = "BELOW, RIGHT" )
	{
		$legacy = false;
		$config =& sobi2Config::getInstance();
		$config->loadOverlib();
		$text = str_replace( array( "\n", "\t", "\r" ), null, $text );
		if( defined( "_JEXEC" ) && class_exists( 'JFactory' ) ) {
			if( defined( "_SOBI2_ADMIN" ) ) {
				if( $config->key( "compat", "use_j10_tooltip_be" ) ) {
					$legacy = true;
				}
			}
			else {
				if( $config->key( "compat", "use_j10_tooltip_fe" ) ) {
					$legacy = true;
				}
			}
		}
		else {
			$legacy = true;
		}
		if( $legacy ) {
			return sobiHTML::j10Tooltip( $tooltip, $title, $width, $image, $text, $href, $link, $position );
		}
		else {
			return sobiHTML::j15Tooltip( $tooltip, $title, $width, $image, $text, $href, $link, $position );
		}
	}
	/**
	 * @param string $tooltip
	 * @param string $title
	 * @param int $width
	 * @param string $image
	 * @param string $text
	 * @param string $href
	 * @param bool $link
	 * @param string $position
	 * @return string
	 */
	function j15Tooltip( $tooltip, $title = null, $width = null, $image="info.png", $text = null, $href = "#", $link = true, $position = "BELOW, RIGHT" )
	{
		$config =& sobi2Config::getInstance();
		while ( strstr( $text, "\'" ) ) {
			$text = stripcslashes( $text );
		}
		while ( strstr( $text, "\'" ) ) {
			$text = stripcslashes( $text );
		}
		while ( strstr( $title, "\'" ) ) {
			$title = stripcslashes( $title );
		}
		if( !$title || strlen( $title ) == 0 ) {
			$title = _SOBI2_DEFAULT_TOOLTIP_TITLE;
		}
		if ( !$text ) {
			if( !$image || $image == 'info.png' ) {
				$image = "{$config->liveSite}/components/com_sobi2/images/info.png";
			}
			elseif( $image == 'tooltip.png' ) {
				$image 	= "{$config->liveSite}/includes/js/ThemeOffice/{$image}";
			}
			else {
				$image 	= $config->liveSite . '/'. $image;
			}
			$tip 	= "<img src=\"{$image}\" class=\"editlinktip hasTip\" alt=\"{$title}\" title=\"{$title}::{$tooltip}\"/>";
		}
		else {
			$tip = "<span class=\"editlinktip hasTip\" title=\"{$title}::{$tooltip}\">{$text}</span>";
		}
		return $tip;
	}
	/**
	 * @param string $tooltip
	 * @param string $title
	 * @param int $width
	 * @param string $image
	 * @param string $text
	 * @param string $href
	 * @param bool $link
	 * @param string $position
	 * @return string
	 */
	function j10Tooltip( $tooltip, $title = null, $width = null, $image="info.png", $text = null, $href = "#", $link = true, $position = "BELOW, RIGHT" )
	{
		$config =& sobi2Config::getInstance();
//		$href = '#';
		if ( $width ) {
			$width = ", WIDTH, '{$width}'";
		}
		if( !$title || strlen( $title ) == 0 ) {
			$title = _SOBI2_DEFAULT_TOOLTIP_TITLE;
		}
		if ( $title ) {
			$title = ", CAPTION, '{$title}'";
		}
		if ( !$text ) {
			if( !$image || $image == 'info.png' ) {
				$image = "{$config->liveSite}/components/com_sobi2/images/info.png";
			}
			elseif( $image == 'tooltip.png' ) {
				$image 	= "{$config->liveSite}/includes/js/ThemeOffice/{$image}";
			}
			else {
				$image 	= $config->liveSite . '/'. $image;
			}
			$text 	= "<img src=\"{$image}\" border=\"0\" alt=\"tooltip\"/>";
		}
		$style = 'style="text-decoration: none; color: #333;"';
		if ( $href ) {
			$style = '';
		}
		$mousover = 'return overlib(\''. $tooltip .'\''. $title .', '.$position.''. $width .');';
		if ( $link ) {
			$tip = '<a href="'. $href .'" onmouseover="'. $mousover .'" onmouseout="return nd();" '. $style .'>'. $text .'</a>';
		}
		else {
			$tip = '<span onmouseover="'. $mousover .'" onmouseout="return nd();" '. $style .'>'. $text .'</span>';
		}
		return $tip;
	}
	function integerSelectList( $start, $end, $inc, $tag_name, $tag_attribs, $selected, $format = null )
	{
		return class_exists( 'JHTML' ) ? JHTML::_('select.integerlist', $start, $end, $inc, $tag_name, $tag_attribs, $selected, $format ) : mosHTML::integerSelectList( $start, $end, $inc, $tag_name, $tag_attribs, $selected, $format );
	}
	function cleanText ( &$text )
	{
		return class_exists( 'JFilterOutput' ) ? JFilterOutput::cleanText( $text ) : mosHTML::cleanText( $text );
	}
	function emailCloaking( $mail, $mailto = 1, $text = '', $email = 1 )
	{
		return class_exists( 'JHTML' ) ? JHTML::_( 'email.cloak', $mail, $mailto, $text, $email ) : mosHTML::emailCloaking( $mail, $mailto, $text, $email );
	}
}
?>