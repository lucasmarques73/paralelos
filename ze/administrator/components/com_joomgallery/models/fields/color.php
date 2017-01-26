<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-2.0/JG/trunk/administrator/components/com_joomgallery/models/fields/color.php $
// $Id: color.php 3710 2012-03-20 05:04:22Z aha $

defined('_JEXEC') or die('Direct Access to this location is not allowed.');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('text');

/**
 * Supports a ColorPicker by mooRainbow
 * @since 1.6
 */
class JFormFieldColor extends JFormFieldText
{
  /**
   * The form field type.
   *
   * @var string
   * @since 1.6
   */
  public $type = 'Color'; //the form field type

  /**
   * Method to build the color picker
   *
   * @return string html and javascript individually for each input box
   * @since 1.6
   */
  protected function getInput()
  {
    // Add path to JoomGallery admin helpers
    JHTML::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomgallery'.DS.'helpers'.DS.'html');

    // Get the values from XML
    $stylesheet = $this->element['stylesheet'] ? (string) $this->element['stylesheet'] : 'default';

    // Get html and js
    $html = JHTML::_('joomgallery.colorpicker', $this->id, $this->value, $stylesheet, true, 'left', $this->name);
    return $html;
  }
}
