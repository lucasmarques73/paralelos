<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-2.0/JG/trunk/administrator/components/com_joomgallery/views/help/view.html.php $
// $Id: view.html.php 3670 2012-03-03 13:36:14Z mab $
/****************************************************************************************\
**   JoomGallery 2                                                                      **
**   By: JoomGallery::ProjectTeam                                                       **
**   Copyright (C) 2008 - 2012  JoomGallery::ProjectTeam                                **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                            **
**   Released under GNU GPL Public License                                              **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look                       **
**   at administrator/components/com_joomgallery/LICENSE.TXT                            **
\****************************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * HTML View class for the help view
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryViewHelp extends JoomGalleryView
{
  /**
   * HTML view display method
   *
   * @access  public
   * @param   string  $tpl  The name of the template file to parse
   * @return  void
   * @since   1.5.5
   */
  function display($tpl = null)
  {
    $params = JComponentHelper::getParams('com_joomgallery');

    JToolBarHelper::title(JText::_('COM_JOOMGALLERY_HLPIFO_HELP_MANAGER'), 'systeminfo');
    JToolbarHelper::custom('cpanel', 'options.png', 'options.png', 'COM_JOOMGALLERY_COMMON_TOOLBAR_CPANEL', false);
    JToolbarHelper::spacer();

    $languages = array( 'de-DE-formal'    => array( 'translator'    => 'JoomGallery::ProjectTeam de-DE (formal)',
                                                    'downloadlink'  => 'http://www.joomgallery.net/downloads/joomgallery-fuer-joomla-25/sprachdateien/die-deutschen-formellen-sprachdateien.html',
                                                    'flag'          => 'de.png',
                                                    'type'          => 'formal'),
                        'de-DE-informal'  => array( 'translator'    => 'JoomGallery::ProjectTeam de-DE (informal)',
                                                    'downloadlink'  => 'http://www.joomgallery.net/downloads/joomgallery-fuer-joomla-25/sprachdateien/die-deutschen-informellen-sprachdateien.html',
                                                    'flag'          => 'de.png'),
                        'ar-AA'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/ar/" target="_blank">JoomGallery::TranslationTeam::Arabic ar-AA</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-arabic-unitag-language-files.html',
                                                    'flag'          => 'sy.png'),
                        'bs-BA'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/bs_BA/" target="_blank">JoomGallery::TranslationTeam::Bosnian (Bosnia and Herzegovina) bs-BA</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-bosnian-language-files.html',
                                                    'flag'          => 'ba.png'),
                        'bg-BG'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/bg_BG/" target="_blank">JoomGallery::TranslationTeam::Bulgarian (Bulgaria) bg-BG</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-bulgarian-language-files.html',
                                                    'flag'          => 'bg.png'),
                        'zh-CN'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/zh_CN/" target="_blank">JoomGallery::TranslationTeam::Chinese (China) zh-CN</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-chinese-simplified-language-files.html',
                                                    'flag'          => 'cn.png'),
                        'zh-TW'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/zh_TW/" target="_blank">JoomGallery::TranslationTeam::Chinese (Taiwan) zh-TW</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-chinese-traditional-language-files.html',
                                                    'flag'          => 'cn.png'),
                        'hr-HR'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/hr_HR/" target="_blank">JoomGallery::TranslationTeam::Croatian (Croatia) hr-HR</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-croatian-language-files.html',
                                                    'flag'          => 'hr.png'),
                        'cs-CZ'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/cs_CZ/" target="_blank">JoomGallery::TranslationTeam::Czech (Czech Republic) cs-CZ</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-czech-language-files.html',
                                                    'flag'          => 'cz.png'),
                        'da-DK'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/da_DK/" target="_blank">JoomGallery::TranslationTeam::Danish (Denmark) da-DK</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-danish-language-files.html',
                                                    'flag'          => 'dk.png'),
                        'nl-NL'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/nl_NL/" target="_blank">JoomGallery::TranslationTeam::Dutch (Netherlands) nl-NL</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-netherlands-language-files.html',
                                                    'flag'          => 'nl.png'),
                        'fi-FI'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/fi_FI/" target="_blank">JoomGallery::TranslationTeam::Finnish (Finland) fi-FI</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-finnish-language-files.html',
                                                    'flag'          => 'fi.png'),
                        'fr-FR'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/fr_FR/" target="_blank">JoomGallery::TranslationTeam::French (France) fr-FR</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-french-language-files.html',
                                                    'flag'          => 'fr.png'),
                        'el-GR'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/el_GR/" target="_blank">JoomGallery::TranslationTeam::Greek (Greece) el-GR</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-greek-language-files.html',
                                                    'flag'          => 'gr.png'),
                        'hu-HU-formal'    => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/hu_HU/" target="_blank">JoomGallery::TranslationTeam::Hungarian (Hungary) hu-HU (formal)</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-hungarian-formal-language-files.html',
                                                    'flag'          => 'hu.png'),
                        'hu-HU-informal'  => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/hu/" target="_blank">JoomGallery::TranslationTeam::Hungarian (Hungary) hu-HU (informal)</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-hungarian-informal-language-files.html',
                                                    'flag'          => 'hu.png'),
                        'it-IT'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/it_IT/" target="_blank">JoomGallery::TranslationTeam::Italian (Italy) it-IT</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-italian-language-files.html',
                                                    'flag'          => 'it.png'),
                        'ja-JP'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/ja_JP/" target="_blank">JoomGallery::TranslationTeam::Japanese (Japan) ja-JP</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-japanese-language-files.html',
                                                    'flag'          => 'jp.png'),
                        'lt-LT'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/lt_LT/" target="_blank">JoomGallery::TranslationTeam::Lithuanian (Lithuania) lt-LT</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-lithunian-language-files.html',
                                                    'flag'          => 'lt.png'),
                        'lv-LV'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/lv_LV/" target="_blank">JoomGallery::TranslationTeam::Latvian (Latvia) lv-LV</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-latvian-language-files.html',
                                                    'flag'          => 'lv.png'),
                        'nb-NO'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/nb_NO/" target="_blank">JoomGallery::TranslationTeam::Norwegian Bokmål (Norway) nb-NO</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-norwegian-language-files.html',
                                                    'flag'          => 'no.png'),
                        'fa-IR'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/fa_IR/" target="_blank">JoomGallery::TranslationTeam::Persian (Iran) fa-IR</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-persian-language-files.html',
                                                    'flag'          => 'ir.png'),
                        'pl-PL'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/pl_PL/" target="_blank">JoomGallery::TranslationTeam::Polish (Poland) pl-PL</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-polish-language-files.html',
                                                    'flag'          => 'pl.png'),
                        'pt-BR'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/pt_BR/" target="_blank">JoomGallery::TranslationTeam::Portuguese (Brazil) pt-BR</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-brazilian-portuguese-language-files.html',
                                                    'flag'          => 'br.png'),
                        'pt-PT'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/pt_PT/" target="_blank">JoomGallery::TranslationTeam::Portuguese (Portugal) pt-PT</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-portuguese-language-files.html',
                                                    'flag'          => 'pt.png'),
                        'ru-RU'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/ru_RU/" target="_blank">JoomGallery::TranslationTeam:: Russian (Russia) ru-RU</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-russian-language-files.html',
                                                    'flag'          => 'ru.png'),
                        'sr-RS'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/sr_RS/" target="_blank">JoomGallery::TranslationTeam::Serbian (Serbia) sr-RS</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-serbian-cyrillic-language-files.html',
                                                    'flag'          => 'rs.png'),
                        'sr-YU'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/sr/" target="_blank">JoomGallery::TranslationTeam::Serbian sr-YU</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-serbian-language-files.html',
                                                    'flag'          => 'rs.png'),
                        'sk-SK'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/sk_SK/" target="_blank">JoomGallery::TranslationTeam::Slovak (Slovakia) sk-SK</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-slovakian-language-files.html',
                                                    'flag'          => 'sk.png'),
                        'sl-SI'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/sl_SI/" target="_blank">JoomGallery::TranslationTeam::Slovenian (Slovenia) sl-SI</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-slovenian-language-files.html',
                                                    'flag'          => 'si.png'),
                        'es-ES'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/es_ES/" target="_blank">JoomGallery::TranslationTeam::Spanish (Spain) es-ES</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-spanish-language-files.html',
                                                    'flag'          => 'es.png'),
                        'sv-SE'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/sv_SE/" target="_blank">JoomGallery::TranslationTeam::Swedish (Sweden) sv-SE</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-swedish-language-files.html',
                                                    'flag'          => 'se.png'),
                        'tr-TR'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/tr_TR/" target="_blank">JoomGallery::TranslationTeam::Turkish (Turkey) tr-TR</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-turkish-language-files.html',
                                                    'flag'          => 'tr.png'),
                        'uk-UA'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/uk_UA/" target="_blank">JoomGallery::TranslationTeam::Ukrainian (Ukraine) uk-UA</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-ukrainian-language-files.html',
                                                    'flag'          => 'ua.png'),
                        'vi-VN'           => array( 'translator'    => '<a href="https://www.transifex.net/projects/p/joomgallery/language/vi_VN/" target="_blank">JoomGallery::TranslationTeam::Vietnamese (Viet Nam) vi-VN</a>',
                                                    'downloadlink'  => 'http://www.en.joomgallery.net/downloads/joomgallery-for-joomla-25/languages/the-vietnamese-language-files.html',
                                                    'flag'          => 'vn.png')
                      );
    if($this->_config->get('jg_checkupdate') && extension_loaded('curl'))
    {
      $params->set('autoinstall_possible', 1);
    }

    $this->assignRef('languages', $languages);
    $this->assignRef('params', $params);

    parent::display($tpl);
  }
}