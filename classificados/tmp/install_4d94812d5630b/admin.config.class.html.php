<?php
/**
* @version $Id: admin.config.class.html.php 4820 2009-01-05 11:46:25Z Radek Suski $
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
 *  no direct access
 */
defined( '_SOBI2_' ) || defined( '_VALID_MOS' )  || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );
/*
 * ensure user has access to this function
 */
class adminConfig_HTML {

	/**
	 * @param adminConfig $config
	 */
	function showGeneral( &$config )
	{
		sobi2Config::loadOverlib();
		$tabs = new sobiTabs( true );
		$tabs->startPane("general-config");
		$tabs->startTab(_SOBI2_CONFIG_GEN,"general");
		$alowDeleting = array();
		$alowDeleting[] = sobiHTML::makeOption( '0', _SOBI2_NO_U);
		$alowDeleting[] = sobiHTML::makeOption( '1', _SOBI2_YES_U);
		$alowDeleting[] = sobiHTML::makeOption( '2', _SOBI2_CONFIG_GENERAL_PERMS_UNPUBLISH);
		$alowDeleting = sobiHTML::selectList( $alowDeleting, 'allowUserDelete', 'size="3" class="inputbox"', 'value', 'text', $config->allowUserDelete );

		$alowQedit = array();
		$alowQedit[] = sobiHTML::makeOption( '0', _SOBI2_NO_U);
		$alowQedit[] = sobiHTML::makeOption( '1', _SOBI2_YES_U);
		$alowQedit[] = sobiHTML::makeOption( '2', _SOBI2_QFIELD_ALLOW_ADM);
		$alowQedit = sobiHTML::selectList( $alowQedit, 'allowQuickEdit', 'size="3" class="inputbox"', 'value', 'text', $config->allowQuickEdit );
		sobi2Config::import( 'includes|adm.helper.class', 'adm' );

		?>
		  <table class="SobiAdminForm" width="100%">
		    <tr class="row1">
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_GEN_OPTION; ?></th>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_COMPONENT_NAME_EXPL),addslashes(_SOBI2_CONFIG_COMPONENT_NAME),'','',_SOBI2_CONFIG_COMPONENT_NAME, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><input type="text" class="text_area" name="componentName" value="<?php echo $config->componentName; ?>" size="40" maxlength="40"/></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_LANGUAGE_EXPL),addslashes(_SOBI2_CONFIG_LANGUAGE),'','',_SOBI2_CONFIG_LANGUAGE, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::selectList( $config->langList, 'sobi2Language', 'size="1" class="text_area"', 'value', 'text', $config->sobi2Language);?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_SHOW_LISTING_ON_FP_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_SHOW_LISTING_ON_FP),'','',_SOBI2_CONFIG_GENERAL_SHOW_LISTING_ON_FP, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'showListingOnFP', 'class="inputbox"', $config->showListingOnFp );?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%">
		      	<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_DEF_TMPL_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_DEF_TMPL),'','',_SOBI2_CONFIG_GENERAL_DEF_TMPL, '#',0 );?>
		      </td>
		      <td valign="top" width="70%"><?php echo sobi2AdmHelper::templatesChooser( $config->defTemplate, 'defTpl', null, null, false ); ?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_ENTRIES_IN_LINE; ?></td>
		      <td valign="top" width="70%"><input type="text" style="text-align: center;" class="text_area" name="itemsInLine" value="<?php echo $config->itemsInLine; ?>" size="5" maxlength="5"/></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_LINES_IN_SITE; ?></td>
		      <td valign="top" width="70%"><input type="text" style="text-align: center;" class="text_area" name="lineOnSite" value="<?php echo $config->lineOnSite; ?>" size="5" maxlength="5"/></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%"><?php echo _SOBI2_CONFIG_GENERAL_SORT_LISTING_BY; ?></td>
		      <td valign="top" width="70%"><?php echo $config->getListingOrdering(); ?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_SHOW_CAT_LISTING_ON_FP_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_SHOW_CAT_LISTING_ON_FP),'','',_SOBI2_CONFIG_GENERAL_SHOW_CAT_LISTING_ON_FP, '#',0 ); ?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'showCatListOnFp', 'class="inputbox"', $config->showCatListOnFp);?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_CATS_IN_LINE; ?></td>
		      <td valign="top" width="70%"><input type="text" style="text-align: center;" class="text_area" name="catsListInLine" value="<?php echo $config->catsListInLine; ?>" size="5" maxlength="5"/></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%"><?php echo _SOBI2_CONFIG_GENERAL_SORT_CATS_BY; ?></td>
		      <td valign="top" width="70%"><?php echo $config->getCatsOrdering(); ?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_SHOW_SUBCATS_UNDER_CAT_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_SHOW_SUBCATS_UNDER_CAT),'','',_SOBI2_CONFIG_GENERAL_SHOW_SUBCATS_UNDER_CAT, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'subcatsShow', 'class="inputbox"', $config->subcatsShow);?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_NUMBER_SUBCATS; ?></td>
		      <td valign="top" width="70%"><input type="text" style="text-align: center;" class="text_area" name="subcatsNumber" value="<?php echo $config->subcatsNumber; ?>" size="5" maxlength="5"/></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%"><?php echo _SOBI2_CONFIG_GENERAL_SORT_SUBCATS_BY; ?></td>
		      <td valign="top" width="70%"><?php echo $config->getCatsOrdering( "subcatsOrdering" ); ?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_SHOW_COUNTER_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_SHOW_COUNTER),'','',_SOBI2_CONFIG_GENERAL_SHOW_COUNTER, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'showCatItemsCount', 'class="inputbox"', $config->showCatItemsCount);?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_SHOW_FROM_SUBCATS_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_SHOW_FROM_SUBCATS),'','',_SOBI2_CONFIG_GENERAL_SHOW_FROM_SUBCATS, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'showEntriesFromSubcats', 'class="inputbox"', $config->showEntriesFromSubcats);?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_CAT_INFO; ?></td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'showCatDesc', 'class="inputbox"', $config->showCatDesc);?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_ICO_IN_VC; ?></td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'showIcoInVC', 'class="inputbox"', $config->showIcoInVC);?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_LOGO_IN_VC; ?></td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'showImgInVC', 'class="inputbox"', $config->showImgInVC);?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_USE_META_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_USE_META),'','',_SOBI2_CONFIG_GENERAL_USE_META, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'useMeta', 'class="inputbox"', $config->useMeta);?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%">
		      	<?php echo _SOBI2_CONFIG_GENERAL_USE_RSS;?>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'useRSSfeed', 'class="inputbox"', $config->useRSSfeed);?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_FORCE_MENUID_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_FORCE_MENUID),'','',_SOBI2_CONFIG_GENERAL_FORCE_MENUID, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'forceMenuId', 'class="inputbox"', $config->forceMenuId);?></td>
		    </tr>
		    <tr class="row1">
		      <th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_GENERAL_PERMS; ?></th>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%"><?php echo _SOBI2_CONFIG_GENERAL_PERMS_EDIT; ?></td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'allowUserToEditEntry', 'class="inputbox"', $config->allowUserToEditEntry);?></td>
		    </tr>

		    <tr class="row1">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_QFIELD_ALLOW_EXPL._SOBI2_ADM_EXPERIMENTAL_OPT),addslashes(_SOBI2_QFIELD_ALLOW._SOBI2_ADM_EXPERIMENTAL_OPT),'','',_SOBI2_QFIELD_ALLOW._SOBI2_ADM_EXPERIMENTAL_OPT, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%">
		      	<?php echo $alowQedit;?>
		      </td>
		    </tr>


		    <tr class="row0">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_PERMS_DEL_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_PERMS_DEL),'','',_SOBI2_CONFIG_GENERAL_PERMS_DEL, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%">
		      	<?php echo $alowDeleting;?></td>
		    </tr>

		    <tr>
		      <th colspan="2" style="text-align:left;"><?php echo _SOBI2_MENU; ?></th>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_ALPHA; ?></td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'showAlphaIndex', 'class="inputbox"', $config->showAlphaIndex);?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_HP_LINK; ?></td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'showComponentLink', 'class="inputbox"', $config->showComponentLink);?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_SEARCH_LINK; ?></td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'showSearchLink', 'class="inputbox"', $config->showSearchLink);?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_NEW_ENTRY_LINK; ?></td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList( 'showAddNewLink', 'class="inputbox"', $config->showAddNewEntryLink);?></td>
		    </tr>
		   </table>
		<?php
		$tabs->endTab();
		$tabs->startTab(_SOBI2_CONFIG_FRONTPAGE,"frontpage");
		?>
		  <table class="SobiAdminForm" border="1" width="100%">
		    <tr>
		    	<th colspan="3" style="text-align:left;"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION_TEXT; ?></th>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION; ?></td>
		      <td valign="top"><?php echo sobiHTML::yesnoRadioList( 'showComponentDescription', 'class="inputbox"', $config->showComponentDescription); ?></td>
		      <td valign="top"></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION_ON_SEARCHPAGE; ?></td>
		      <td valign="top"><?php echo sobiHTML::yesnoRadioList( 'showComponentDescInSearch', 'class="inputbox"', $config->showComponentDescInSearch); ?></td>
		      <td valign="top"></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%"><?php echo _SOBI2_CONFIG_GENERAL_SHOW_DESCRIPTION_TEXT; ?></td>
		      <td valign="top"><?php sobi2bridge::editorArea( 'componentDescription',   $config->componentDesc->description, 'componentDescription', '100%;', '300', '60', '20' ) ; ?></td>
		      <td valign="top"></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%"><?php echo _SOBI2_CONFIG_GENERAL_IMG_FOR_DESCRIPTION; ?></td>
		      <td valign="top">
					  <table class="SobiAdminForm" border = 1 width="100%">
					    <tr>
					      <td valign="top" width="20%"><label for="image"><?php echo _SOBI2_IMAGE_U; ?>: </label></td>
					      <td valign="top" width="20%"><?php echo sobi2AdmHelper::amImages( 'image', $config->componentDesc->image ); ?></td>
					      <td style="vertical-align:top; height:100px" rowspan="2">
							<script type="text/javascript">
								if (document.forms[0].image.options.value!=''){
								  jsimg='..<?php echo $config->catImagesFolder;?>' + getSelectedValue( 'adminForm', 'image' );
								} else {
								  jsimg='../images/M_images/blank.png';
								}
								document.write('<img src=' + jsimg + ' name="imagelib" width="80" height="80" border="2" alt="Preview" />');
							</script>
						  </td>
					    </tr>
					    <tr>
					      <td valign="top"><label for="image_position"><?php echo _SOBI2_IMAGE_POS; ?>: </label></td>
					      <td valign="top"><?php echo sobi2AdmHelper::amPositions( 'image_position', $config->componentDesc->image_position, NULL, 0, 0 ); ?></td>
					    </tr>
					  </table>
		      </td>
		      <td valign="top">
		      </td>
		    </tr>
		  </table>
<?php
		$tabs->endTab();
		$tabs->startTab(_SOBI2_CONFIG_SEARCH_OPT,"searchopt");
?>
		  <table class="SobiAdminForm" border="1" width="100%">
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_SEARCH_OPT; ?></th>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_EXSEARCH_USE_SLIDER_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_EXSEARCH_USE_SLIDER),'','',_SOBI2_CONFIG_GENERAL_EXSEARCH_USE_SLIDER, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList('ajaxSearchUseSlider', 'class="inputbox"', $config->ajaxSearchUseSlider);?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_ON_START_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_ON_START),'','',_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_ON_START, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList('ajaxSearchSlidInOnStart', 'class="inputbox"', $config->ajaxSearchSlidInOnStart);?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_AFTER_SEARCH_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_AFTER_SEARCH),'','',_SOBI2_CONFIG_GENERAL_EXSEARCH_SLIDER_FADE_AFTER_SEARCH, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList('ajaxSearchSlidInAfterSearch', 'class="inputbox"', $config->ajaxSearchSlidInAfterSearch);?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE),'','',_SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList('ajaxSearchCatsForFields', 'class="inputbox"', $config->ajaxSearchCatsForFields, _SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE_CAT_FIRST, _SOBI2_CONFIG_GENERAL_EXSEARCH_SEQUENCE_FIELD_FIRST );?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_EXSEARCH_CAT_FIELS_DEPEND_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_EXSEARCH_CAT_FIELS_DEPEND._SOBI2_ADM_EXPERIMENTAL_OPT),'','',_SOBI2_CONFIG_GENERAL_EXSEARCH_CAT_FIELS_DEPEND._SOBI2_ADM_EXPERIMENTAL_OPT, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList('ajaxSearchCatsFieldsDepend', 'class="inputbox"', $config->ajaxSearchCatsFieldsDepend );?></td>
		    <tr class="row1">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_EXSEARCH_CATCONT_HEIGHT_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_EXSEARCH_CATCONT_HEIGHT),'','',_SOBI2_CONFIG_GENERAL_EXSEARCH_CATCONT_HEIGHT, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><input type="text" style="text-align: center;" class="text_area" name="ajaxSearchCatsContHeight" value="<?php echo $config->ajaxSearchCatsContHeight; ?>" size="10" maxlength="10"/>&nbsp;px.</td>
		    </tr>

		  </table>
<?php
		$tabs->endTab();
		$tabs->startTab(_SOBI2_CONFIG_SYSTEM_MAILS,"sysmails");
?>
		  <table class="SobiAdminForm" border="1" width="100%">
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_SYSTEM_MAILS; ?></th>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_SYSTEM_MAILS_ADM_MAIL_USERS_EXPL),addslashes(_SOBI2_CONFIG_SYSTEM_MAILS_ADM_MAIL_USERS),'','',_SOBI2_CONFIG_SYSTEM_MAILS_ADM_MAIL_USERS, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%">
		      <?php
					$my_groups = $config->acl->get_object_groups( 'users', $config->user->id, 'ARO' );
					if (is_array( $my_groups ) && count( $my_groups ) > 0) {
						$ex_groups = $config->acl->get_group_children( $my_groups[0], 'ARO', 'RECURSE' );
					} else {
						$ex_groups = array();
					}
					$ex_groups = is_array($ex_groups) ? $ex_groups : array();
					$gtree = $config->acl->get_group_children_tree( null, 'USERS', false );
					// remove users 'above' me
					$i = 0;
					while ($i < count( $gtree )) {
						if (in_array( $gtree[$i]->value, $ex_groups )) {
							array_splice( $gtree, $i, 1 );
						} else {
							$i++;
						}
					}
					$s = explode(",", $config->mailAdmGid );
					$keys = array();
					foreach ($s as $selected) {
						$v = new stdClass();
						$v->value = $selected;
						$keys[] = $v;
					}
					echo sobiHTML::selectList( $gtree, 'mailAdmGid[]', 'size="10" multiple="true"', 'value', 'text', $keys );
		      ?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL_EXPL),addslashes(_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL),'','',_SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><?php echo sobiHTML::yesnoRadioList('mailSoJ', 'class="inputbox"', $config->mailSoJ, _SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL_CMS, _SOBI2_CONFIG_SYSTEM_MAILS_USER_MAIL_SOBI);?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="30%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_SYSTEM_MAILS_USER_FID_EXPL),addslashes(_SOBI2_CONFIG_SYSTEM_MAILS_USER_FID),'','',_SOBI2_CONFIG_SYSTEM_MAILS_USER_FID, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="70%"><?php echo $config->getExistingFieldsList( $config->mailFieldId, "mailFieldId"); ?></td>
		    </tr>
		  </table>
<?php
		$tabs->endTab();
		$tabs->startTab("Cache","Cache");
?>
		  <table class="SobiAdminForm" border="1" width="100%">
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_CACHE_DESCRIPTION_TEXT; ?></th>
		    </tr>
		    <tr class="row0">
		      <td colspan="2"><?php echo _SOBI2_CONFIG_L2CACHE_EXPL._SOBI2_CONFIG_CACHE_LIFETIME_EXPL; ?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%"><?php echo _SOBI2_CONFIG_L2CACHE_ON; ?></td>
		      <td valign="top"><?php echo sobiHTML::yesnoRadioList('cacheL2Enabled','class="inputbox"', $config->cacheL2Enabled); ?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%"><?php echo _SOBI2_CONFIG_L2CACHE_DV_ON; ?></td>
		      <td valign="top"><?php echo sobiHTML::yesnoRadioList('cacheL2dvEnabled','class="inputbox"', $config->cacheL2dvEnabled); ?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%"><?php echo _SOBI2_CONFIG_L2CACHE_LIFETIME; ?></td>
		      <td valign="top"><input type="text" class="text_area" style="text-align:center;" name="cacheL2Lifetime" value="<?php echo $config->cacheL2Lifetime; ?>" size="10" maxlength="4000"/> <?php echo _SOBI2_CONFIG_L2CACHE_LIFETIME_SECONDS; ?> </td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      	<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_L2CACHE_STRLEN_EXPL),addslashes(_SOBI2_CONFIG_L2CACHE_STRLEN),'','',_SOBI2_CONFIG_L2CACHE_STRLEN, '#',0 );?>
		      </td>
		      <td valign="top"><input type="text" class="text_area" style="text-align:center;" name="cacheL2strLen" value="<?php echo $config->cacheL2strLen; ?>" size="10" maxlength="4000"/></td>
		    </tr>



		    <tr class="row1">
		      <td colspan="2"><?php echo _SOBI2_CONFIG_L3CACHE_EXPL; ?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%"><?php echo _SOBI2_CONFIG_L3CACHE_ON; ?></td>
		      <td valign="top"><?php echo sobiHTML::yesnoRadioList('cacheL3Enabled','class="inputbox"', $config->cacheL3Enabled); ?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%"><?php echo _SOBI2_CONFIG_L3CACHE_STRLEN; ?></td>
		      <td valign="top"><input type="text" class="text_area" style="text-align:center;" name="cacheL3strLen" value="<?php echo $config->cacheL3strLen; ?>" size="10" maxlength="4000"/></td>
		    </tr>
		    <tr class="row0">
			    <td colspan="2">
			    	<input type="submit" onclick="submitbutton('emptyL3Cache')" class="button" name="<?php echo _SOBI2_CONFIG_L3CACHE_CLEAR; ?>" value="<?php echo _SOBI2_CONFIG_L3CACHE_CLEAR; ?>"/>
			    </td>
		    </tr>
		  </table>
<?php
		$tabs->endTab();
		$tabs->startTab("Debug","Debug");
?>
		  <table class="SobiAdminForm" border="1" width="100%">
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_DEBUG_DESCRIPTION_TEXT; ?></th>
		    </tr>
		    <tr>
		      <td valign="top" width="20%"><?php echo _SOBI2_CONFIG_DEBUG_TMPL; ?></td>
		      <td valign="top"><?php echo sobiHTML::yesnoRadioList('debugTmpl','class="inputbox"', $config->debugTmpl ); ?></td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%"><?php echo _SOBI2_CONFIG_DEBUG_LEVEL; ?></td>
		      <td valign="top">
		      	<?php
				if($config->debug > 100)
					$debug = $config->debug - 100;
				else
					$debug = $config->debug;

		      		$debugOpt = array();
		      		$debugOpt[] = sobiHTML::makeOption(-1,_SOBI2_CONFIG_DEBUG_LEVEL_0);
		      		$debugOpt[] = sobiHTML::makeOption(7,_SOBI2_CONFIG_DEBUG_LEVEL_7);
		      		$debugOpt[] = sobiHTML::makeOption(8,_SOBI2_CONFIG_DEBUG_LEVEL_8);
		      		$debugOpt[] = sobiHTML::makeOption(9,_SOBI2_CONFIG_DEBUG_LEVEL_9);
		      		$debugList = sobiHTML::selectList($debugOpt,'debug','size="1" class="text_area"','value', 'text',$debug);
		      		echo $debugList;
		      	?>
		      	</td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%"><?php echo _SOBI2_CONFIG_DEBUG_SHOW_ERR; ?></td>
		      <td valign="top"><?php echo sobiHTML::yesnoRadioList('displayErrors','class="inputbox"', $config->debug > 100 ? 1 : 0); ?></td>
		    </tr>
		  </table>
<?php
		$tabs->endTab();
		$tabs->startTab(_SOBI2_CONFIG_GENERAL_BACKGROUNDS,"backgrounds");
?>
		    <table class="SobiAdminForm" border="1" width="100%">
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_GENERAL_BACKGROUNDS_AND_BORDERS; ?></th>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_BORDER_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_BORDERS),'','',_SOBI2_CONFIG_GENERAL_BORDERS, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%">
				<div style="width:103px;width/* */:/**/100px;width: /**/100px;height:20px;border:1px solid #7F9DB9;">
				<input type="text" maxlength="7" style="width:80px;font-size:12px;height:17px;float:left;border:0px;padding-top:2px" name="sobi2BorderColor" size="10" value="#<?php echo $config->sobi2BorderColor;?>">
				<!-- <img style="float:right;padding-right:1px;padding-top:1px" src="<?php echo $config->liveSite.'/administrator/components/com_sobi2/images/select_arrow.gif'; ?>" onmouseover="this.src='<?php echo $config->liveSite.'/administrator/components/com_sobi2/images/select_arrow_over.gif'; ?>'" onmouseout="this.src='<?php echo $config->liveSite.'/administrator/components/com_sobi2/images/select_arrow.gif';?>'" onclick="showColorPicker(this,document.forms[0].sobi2BorderColor); changed()"> -->
				</div>
			  </td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_GENERAL_BACKGROUND_EXPL),addslashes(_SOBI2_CONFIG_GENERAL_BACKGROUND),'','',_SOBI2_CONFIG_GENERAL_BACKGROUND, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" valign="top" width="80%">
				<?php
					$javascript = "onchange=\"if (this.options[selectedIndex].value!='')" .
							"{" .
							" document.backgroundimage.src='../components/com_sobi2/images/backgrounds/' + this.options[selectedIndex].value;" .
							"} " .
							"else " .
							"{" .
							"  document.a.src='../images/blank.png'" .
							"}\"";
					echo sobi2AdmHelper::amImages( 'backgroundimage', $config->sobi2BackgroundImg, $javascript, '/components/com_sobi2/images/backgrounds/' );
				 ?>
					<script type="text/javascript">
						if (document.forms[0].backgroundimage.options.value!=''){
						  bsimg='<?php echo $config->liveSite;?>/components/com_sobi2/images/backgrounds/' + getSelectedValue( 'adminForm', 'backgroundimage' );
						} else {
						  bsimg='<?php echo $config->liveSite;?>/images/M_images/blank.png';
						}
						document.write('<img src=' + bsimg + ' name="backgroundimage" width="50" height="50" border="2" style=" border-color: <?php echo $config->sobi2BorderColor;?>;" alt="Preview" />');
					</script>
			  </td>
		    </tr>
		</table>
		<input type="hidden" name="returnTask" value="genConf"/>
<?php
		$tabs->endTab();
		$tabs->startTab("Sigsiu Tree","atree");
?>
		  <table class="SobiAdminForm" border="1" width="100%">
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_GENERAL_ATREE_IMAGES;?></th>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">Root</td>
		      <td valign="top" width="80%"><input type="text" style="text-align: left;" class="text_area" name="atreeImgsRoot" value="<?php echo $config->aTreeImages['root']; ?>" size="50" maxlength="500"/></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">Folder</td>
		      <td valign="top" width="80%"><input type="text" style="text-align: left;" class="text_area" name="atreeImgsFolder" value="<?php echo $config->aTreeImages['folder']; ?>" size="50" maxlength="500"/></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">Folder Open</td>
		      <td valign="top" width="80%"><input type="text" style="text-align: left;" class="text_area" name="atreeImgsFolderOpen" value="<?php echo $config->aTreeImages['folderOpen']; ?>" size="50" maxlength="500"/></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">Join</td>
		      <td valign="top" width="80%"><input type="text" style="text-align: left;" class="text_area" name="atreeImgsJoin" value="<?php echo $config->aTreeImages['join']; ?>" size="50" maxlength="500"/></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">Join Bottom</td>
		      <td valign="top" width="80%"><input type="text" style="text-align: left;" class="text_area" name="atreeImgsJoinBottom" value="<?php echo $config->aTreeImages['joinBottom']; ?>" size="50" maxlength="500"/></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">Plus</td>
		      <td valign="top" width="80%"><input type="text" style="text-align: left;" class="text_area" name="atreeImgsJoinPlus" value="<?php echo $config->aTreeImages['plus']; ?>" size="50" maxlength="500"/></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">Plus Bottom</td>
		      <td valign="top" width="80%"><input type="text" style="text-align: left;" class="text_area" name="atreeImgsJoinPlusBottom" value="<?php echo $config->aTreeImages['plusBottom']; ?>" size="50" maxlength="500"/></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">Minus</td>
		      <td valign="top" width="80%"><input type="text" style="text-align: left;" class="text_area" name="atreeImgsJoinMinus" value="<?php echo $config->aTreeImages['minus']; ?>" size="50" maxlength="500"/></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">Minus Bottom</td>
		      <td valign="top" width="80%"><input type="text" style="text-align: left;" class="text_area" name="atreeImgsJoinMinusBottom" value="<?php echo $config->aTreeImages['minusBottom']; ?>" size="50" maxlength="500"/></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">Line</td>
		      <td valign="top" width="80%"><input type="text" style="text-align: left;" class="text_area" name="atreeImgsLine" value="<?php echo $config->aTreeImages['line']; ?>" size="50" maxlength="500"/></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">Empty</td>
		      <td valign="top" width="80%"><input type="text" style="text-align: left;" class="text_area" name="atreeImgsEmpty" value="<?php echo $config->aTreeImages['empty']; ?>" size="50" maxlength="500"/></td>
		    </tr>
		  </table>
		<?php
		$tabs->endTab();
		$tabs->endPane();
	}
	/**
	 * @param adminConfig $config
	 */
	function editFormConf( &$config )
	{
		sobi2Config::loadOverlib();
		$tabs = new sobiTabs(true);
		$tabs->startPane("edita-pane");
		$tabs->startTab(_SOBI2_CONFIG_FIELDS,"Labels");
?>
		  <table class="SobiAdminForm" width="100%">
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_FIELDS_DESC; ?></th>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_BASE_ENTRY_FEES_EXPL),addslashes(_SOBI2_BASE_ENTRY_FEES),'','',_SOBI2_BASE_ENTRY_FEES, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:center;" name="basicPrice" value="<?php echo $config->basicPrice; ?>" size="5" maxlength="50"/></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_BASE_ENTRY_FEES_LABEL_EXPL),addslashes(_SOBI2_BASE_ENTRY_FEES_LABEL),'','',_SOBI2_BASE_ENTRY_FEES_LABEL, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area"  name="basicPriceLabel" value="<?php echo $config->basicPriceLabel; ?>" size="20" maxlength="40"/></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_T_LABEL_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_T_LABEL),'','',_SOBI2_CONFIG_ENTRY_T_LABEL, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area"  name="efEntryTitleLabel" value="<?php echo $config->efEntryTitleLabel; ?>" size="20" maxlength="40"/></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_T_LENGTH_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_T_LENGTH),'','',_SOBI2_CONFIG_ENTRY_T_LENGTH, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:center;" name="efEntryTitleLength" value="<?php echo $config->efEntryTitleLength; ?>" size="5" maxlength="5"/></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_ALLOW_ADDING_TO_PARENT_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_ALLOW_ADDING_TO_PARENT),'','',_SOBI2_CONFIG_ENTRY_ALLOW_ADDING_TO_PARENT, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'allowAddingToParentCats', 'class="inputbox"', $config->allowAddingToParentCats ); ?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_ALLOW_MULTI_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_ALLOW_MULTI),'','',_SOBI2_CONFIG_ENTRY_ALLOW_MULTI, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'allowMultiTitle', 'class="inputbox"', $config->allowMultiTitle ); ?></td>
		    </tr>

		    <tr class="row0">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_ALLOW_BACKGROUND_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_ALLOW_BACKGROUND),'','',_SOBI2_CONFIG_ENTRY_ALLOW_BACKGROUND, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'allowUsingBackground', 'class="inputbox"', $config->allowUsingBackground ); ?></td>
		    </tr>

		    <tr class="row1">
		      <td valign="top" width="20%">
		      		<?php echo _SOBI2_CONFIG_ENTRY_ALLOW_IMG;?>
		      </td>
		      <td valign="top" width="80%">
				<script type="text/javascript">
  					function imgPrice(action) {
  						var adminForm = document.getElementById('adminForm');
  						switch(action) {
  							case 0:
  								adminForm.priceForImg.disabled = true;
  							break
  							case 1:
  								adminForm.priceForImg.disabled = false;
  							break
  							case 2:
  								adminForm.priceForIco.disabled = true;
  							break
  							case 3:
  								adminForm.priceForIco.disabled = false;
  							break
  						}
  					}
				</script>
					  <select name="allowUsingImg"  size="3">
					    <option onclick="imgPrice(0); adminForm.efImgLabel.disabled = true; adminForm.imgWidth.disabled = true; adminForm.imgHeigth.disabled = true;" <?php if($config->allowUsingImg == 0) echo "selected"; ?> value="0"><?php echo _SOBI2_NO_U;?></option>
					    <option onclick="imgPrice(0); adminForm.efImgLabel.disabled = false; adminForm.imgWidth.disabled = false; adminForm.imgHeigth.disabled = false;" <?php if($config->allowUsingImg == 1) echo "selected"; ?> value="1"><?php echo _SOBI2_YES_U;?></option>
					    <option onclick="imgPrice(1); adminForm.efImgLabel.disabled = false; adminForm.imgWidth.disabled = false; adminForm.imgHeigth.disabled = false;" <?php if($config->allowUsingImg == 2) echo "selected"; ?> value="2"><?php echo _SOBI2_CONFIG_ENTRY_ALLOW_NOT_FREE;?></option>
					  </select>
		      </td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_IMG_LABEL_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_IMG_LABEL),'','',_SOBI2_CONFIG_ENTRY_IMG_LABEL, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area" id="efImgLabel" name="efImgLabel" value="<?php echo $config->efImgLabel; ?>" size="20" maxlength="40"/></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_RESIZE_IMG_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_RESIZE_IMG),'','',_SOBI2_CONFIG_ENTRY_RESIZE_IMG, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%">
		      	<label for="thumbWidth"><?php echo _SOBI2_CONFIG_ENTRY_W; ?></label>
		      	<input type="text" <?php if($config->allowUsingImg < 1) echo "disabled"; ?> class="text_area" style="text-align:center;" name="imgWidth" id="imgWidth" value="<?php echo $config->imgWidth; ?>" size="5" maxlength="10"/> px.
		      	<label for="thumbWidth"><?php echo _SOBI2_CONFIG_ENTRY_H; ?></label>
		      	<input type="text" <?php if($config->allowUsingImg < 1) echo "disabled"; ?> class="text_area" style="text-align:center;" name="imgHeigth" id="imgHeigth" value="<?php echo $config->imgHeigth; ?>" size="5" maxlength="10"/> px.
		      </td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">
		      		<?php echo _SOBI2_CONFIG_ENTRY_PRICE_IMG;?>
		      </td>
		      <td valign="top" width="80%"><input type="text" <?php if($config->allowUsingImg != 2) echo "disabled"; ?> class="text_area" style="text-align:center;" name="priceForImg" id="priceForImg" value="<?php echo number_format($config->priceForImg, 2, $config->curencyDecSeparator, ' '); ?>" size="5" maxlength="10"/> <?php echo $config->currency; ?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      		<?php echo _SOBI2_CONFIG_ENTRY_ALLOW_ICO;?>
		      <td valign="top" width="80%">
					  <select name="allowUsingIco"  size="3">
					    <option onclick="imgPrice(2); adminForm.efIcoLabel.disabled = true;  adminForm.thumbWidth.disabled = true; adminForm.thumbHeigth.disabled = true;" <?php if($config->allowUsingIco == 0) echo "selected"; ?> value="0"><?php echo _SOBI2_NO_U;?></option>
					    <option onclick="imgPrice(2); adminForm.efIcoLabel.disabled = false; adminForm.thumbWidth.disabled = false; adminForm.thumbHeigth.disabled = false;" <?php if($config->allowUsingIco == 1) echo "selected"; ?> value="1"><?php echo _SOBI2_YES_U;?></option>
					    <option onclick="imgPrice(3); adminForm.efIcoLabel.disabled = false; adminForm.thumbWidth.disabled = false; adminForm.thumbHeigth.disabled = false;;" <?php if($config->allowUsingIco == 2) echo "selected"; ?> value="2"><?php echo _SOBI2_CONFIG_ENTRY_ALLOW_NOT_FREE;?></option>
					  </select>
		      </td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_ICO_LABEL_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_ICO_LABEL),'','',_SOBI2_CONFIG_ENTRY_ICO_LABEL, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area"  id="efIcoLabel" name="efIcoLabel" value="<?php echo $config->efIcoLabel; ?>" size="20" maxlength="40"/></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_RESIZE_ICO_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_RESIZE_ICO),'','',_SOBI2_CONFIG_ENTRY_RESIZE_ICO, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%">
		      	<label for="thumbWidth"><?php echo _SOBI2_CONFIG_ENTRY_W; ?></label>
		      	<input type="text" <?php if($config->allowUsingIco < 1) echo "disabled"; ?> class="text_area" style="text-align:center;" name="thumbWidth" id="thumbWidth" value="<?php echo $config->thumbWidth; ?>" size="5" maxlength="10"/> px.
		      	<label for="thumbWidth"><?php echo _SOBI2_CONFIG_ENTRY_H; ?></label>
		      	<input type="text" <?php if($config->allowUsingIco < 1) echo "disabled"; ?> class="text_area" style="text-align:center;" name="thumbHeigth" id="thumbHeigth" value="<?php echo $config->thumbHeigth; ?>" size="5" maxlength="10"/> px.
		      </td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      		<?php echo _SOBI2_CONFIG_ENTRY_PRICE_ICO;?>
		      </td>
		      <td valign="top" width="80%"><input type="text" <?php if($config->allowUsingIco != 2) echo "disabled"; ?> class="text_area" style="text-align:center;" name="priceForIco" id="priceForIco" value="<?php echo number_format($config->priceForIco, 2, $config->curencyDecSeparator, ' '); ?>" size="5" maxlength="10"/> <?php echo $config->currency; ?></td>
		    </tr>


		    <tr class="row1">
		      <td valign="top" width="20%">
		      		<?php echo _SOBI2_CONFIG_ENTRY_MAX_FILE_SIZE;?>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:center;" name="maxFileSize" id="maxFileSize" value="<?php echo $config->maxFileSize; ?>" size="10" maxlength="10"/> <?php echo _SOBI2_CONFIG_ENTRY_FILE_SIZE_BYTES; ?> </td>
		    </tr>

		</table>
<?php
		$tabs->endTab();
		$tabs->startTab(_SOBI2_CATEGORIES_H,"cats");
?>
		  <table class="SobiAdminForm" width="100%" border="1">
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CATEGORIES_H; ?></th>
		    </tr>
		    <tr>
		    	<td valign="top" width="20%">
		    		<?php echo _SOBI2_CONFIG_ENTRY_UP_TO_CATS; ?>
		    	</td>
		    	<td valign="top" width="80%">
				  <select name="maxCatsForEntry" size="1">
				    <option onclick=
				    "
				    	document.getElementById('seccatf').disabled = true;
				    	document.getElementById('seccatnf').disabled = true;
				    	document.getElementById('catPrices2').disabled = true;
				    	document.getElementById('thirdcatf').disabled = true;
				    	document.getElementById('thirdcatnf').disabled = true;
				    	document.getElementById('catPrices3').disabled = true;
				    	document.getElementById('forthcatf').disabled = true;
				    	document.getElementById('forthcatnf').disabled = true;
				    	document.getElementById('catPrices4').disabled = true;
				    	document.getElementById('fifthcatf').disabled = true;
				    	document.getElementById('fifthcatnf').disabled = true;
				    	document.getElementById('catPrices5').disabled = true;
				    "
				    	<?php if($config->maxCatsForEntry == 1) echo "selected"; ?> value="1">1
				    </option>
				    <option onclick=
				    "
				    	document.getElementById('seccatf').disabled = false;
				    	document.getElementById('seccatnf').disabled = false;
				    	if(document.getElementById('seccatnf').checked == true)
				    		document.getElementById('catPrices2').disabled = false;
				    	document.getElementById('thirdcatf').disabled = true;
				    	document.getElementById('thirdcatnf').disabled = true;
				    	document.getElementById('catPrices3').disabled = true;
				    	document.getElementById('forthcatf').disabled = true;
				    	document.getElementById('forthcatnf').disabled = true;
				    	document.getElementById('catPrices4').disabled = true;
				    	document.getElementById('fifthcatf').disabled = true;
				    	document.getElementById('fifthcatnf').disabled = true;
				    	document.getElementById('catPrices5').disabled = true;
				    "
				    	<?php if($config->maxCatsForEntry == 2) echo "selected"; ?> value="2">2
				    </option>
				    <option onclick=
				    "
				    	document.getElementById('seccatf').disabled = false;
				    	document.getElementById('seccatnf').disabled = false;
				    	if(document.getElementById('seccatnf').checked == true)
				    		document.getElementById('catPrices2').disabled = false;
				    	document.getElementById('thirdcatf').disabled = false;
				    	document.getElementById('thirdcatnf').disabled = false;
				    	if(document.getElementById('thirdcatnf').checked == true)
				    		document.getElementById('catPrices3').disabled = false;
				    	document.getElementById('forthcatf').disabled = true;
				    	document.getElementById('forthcatnf').disabled = true;
				    	document.getElementById('catPrices4').disabled = true;
				    	document.getElementById('fifthcatf').disabled = true;
				    	document.getElementById('fifthcatnf').disabled = true;
				    	document.getElementById('catPrices5').disabled = true;
				    "
				    	<?php if($config->maxCatsForEntry == 3) echo "selected"; ?> value="3">3
				    </option>
				    <option onclick=
				    "
				    	document.getElementById('seccatf').disabled = false;
				    	document.getElementById('seccatnf').disabled = false;
				    	if(document.getElementById('seccatnf').checked == true)
				    		document.getElementById('catPrices2').disabled = false;
				    	document.getElementById('thirdcatf').disabled = false;
				    	document.getElementById('thirdcatnf').disabled = false;
				    	if(document.getElementById('thirdcatnf').checked == true)
				    		document.getElementById('catPrices3').disabled = false;
				    	document.getElementById('forthcatf').disabled = false;
				    	document.getElementById('forthcatnf').disabled = false;
				    	if(document.getElementById('forthcatnf').checked == true)
				    		document.getElementById('catPrices4').disabled = false;
				    	document.getElementById('fifthcatf').disabled = true;
				    	document.getElementById('fifthcatnf').disabled = true;
				    	document.getElementById('catPrices5').disabled = true;
				    "
				    	<?php if($config->maxCatsForEntry == 4) echo "selected"; ?> value="4">4
				    </option>
				    <option onclick=
				    "
				    	document.getElementById('seccatf').disabled = false;
				    	document.getElementById('seccatnf').disabled = false;
				    	if(document.getElementById('seccatnf').checked == true)
				    		document.getElementById('catPrices2').disabled = false;
				    	document.getElementById('thirdcatf').disabled = false;
				    	document.getElementById('thirdcatnf').disabled = false;
				    	if(document.getElementById('thirdcatnf').checked == true)
				    		document.getElementById('catPrices3').disabled = false;
				    	document.getElementById('forthcatf').disabled = false;
				    	document.getElementById('forthcatnf').disabled = false;
				    	if(document.getElementById('forthcatnf').checked == true)
				    		document.getElementById('catPrices4').disabled = false;
				    	document.getElementById('fifthcatf').disabled = false;
				    	document.getElementById('fifthcatnf').disabled = false;
				    	if(document.getElementById('fifthcatnf').checked == true)
				    		document.getElementById('catPrices5').disabled = false;
				    "
				    	<?php if($config->maxCatsForEntry == 5) echo "selected"; ?> value="5">5
				    </option>
				  </select>
				  <?php echo _SOBI2_CATEGORIES_L; ?>
		    	</td>
		    </tr>
		    <tr>
		    	<td valign="top" width="20%">
		    		<?php echo _SOBI2_CONFIG_ENTRY_2_CAT; ?>
		    	</td>
		    	<td valign="top" width="80%">
  					<input type="radio" name="seccat" id="seccatf" value="1" onclick="catPrices2.disabled = true;" <?php if($config->catPrices[2] == 0) echo "checked"; ?> <?php if($config->maxCatsForEntry < 2 ) echo "disabled"; ?> />
  						<?php echo _SOBI2_IS_FREE_L; ?>
  					<input type="radio" name="seccat" id="seccatnf" value="1" onclick="catPrices2.disabled = false;" <?php if($config->catPrices[2] != 0) echo "checked"; ?> <?php if($config->maxCatsForEntry < 2 ) echo "disabled"; ?> />
  						<?php echo _SOBI2_IS_NOT_FREE_L; ?>
 		    	</td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      		<?php echo _SOBI2_CONFIG_ENTRY_2_CAT_PRICE;?>
		      </td>
		      <td valign="top" width="80%"><input type="text" <?php if($config->maxCatsForEntry < 2 || $config->catPrices[2] == 0) echo "disabled"; ?> class="text_area" style="text-align:center;" name="catPrices2" id="catPrices2" value="<?php echo number_format($config->catPrices[2], 2, $config->curencyDecSeparator, ' '); ?>" size="5" maxlength="10" /> <?php echo $config->currency; ?></td>
		    </tr>
		    <tr>
		    	<td valign="top" width="20%">
		    		<?php echo _SOBI2_CONFIG_ENTRY_3_CAT; ?>
		    	</td>
		    	<td valign="top" width="80%">
  					<input type="radio" name="thirdcat" id="thirdcatf" value="1" onclick="catPrices3.disabled = true;" <?php if($config->catPrices[3] == 0) echo "checked"; ?> <?php if($config->maxCatsForEntry < 3 ) echo "disabled"; ?> />
  						<?php echo _SOBI2_IS_FREE_L; ?>
  					<input type="radio" name="thirdcat" id="thirdcatnf" value="1" onclick="catPrices3.disabled = false;" <?php if($config->catPrices[3] != 0) echo "checked"; ?> <?php if($config->maxCatsForEntry < 3 ) echo "disabled"; ?> />
  						<?php echo _SOBI2_IS_NOT_FREE_L; ?>
 		    	</td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      		<?php echo _SOBI2_CONFIG_ENTRY_3_CAT_PRICE;?>
		      </td>
		      <td valign="top" width="80%"><input type="text" <?php if($config->maxCatsForEntry < 3 || $config->catPrices[3] == 0) echo "disabled"; ?> class="text_area" style="text-align:center;" name="catPrices3" id="catPrices3" value="<?php echo number_format($config->catPrices[3], 2, $config->curencyDecSeparator, ' '); ?>" size="5" maxlength="10" /> <?php echo $config->currency; ?></td>
		    </tr>
		    <tr>
		    	<td valign="top" width="20%">
		    		<?php echo _SOBI2_CONFIG_ENTRY_4_CAT; ?>
		    	</td>
		    	<td valign="top" width="80%">
  					<input type="radio" name="forthcat" id="forthcatf" value="1" onclick="catPrices4.disabled = true;" <?php if($config->catPrices[4] == 0) echo "checked"; ?> <?php if($config->maxCatsForEntry < 4 ) echo "disabled"; ?> />
  						<?php echo _SOBI2_IS_FREE_L; ?>
  					<input type="radio" name="forthcat" id="forthcatnf" value="1" onclick="catPrices4.disabled = false;" <?php if($config->catPrices[4] != 0) echo "checked"; ?> <?php if($config->maxCatsForEntry < 4 ) echo "disabled"; ?> />
  						<?php echo _SOBI2_IS_NOT_FREE_L; ?>
 		    	</td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      		<?php echo _SOBI2_CONFIG_ENTRY_4_CAT_PRICE;?>
		      </td>
		      <td valign="top" width="80%"><input type="text" <?php if($config->maxCatsForEntry < 4 || $config->catPrices[4] == 0) echo "disabled"; ?> class="text_area" style="text-align:center;" name="catPrices4" id="catPrices4" value="<?php echo number_format($config->catPrices[4], 2, $config->curencyDecSeparator, ' '); ?>" size="5" maxlength="10" /> <?php echo $config->currency; ?></td>
		    </tr>

		    <tr>
		    	<td valign="top" width="20%">
		    		<?php echo _SOBI2_CONFIG_ENTRY_5_CAT; ?>
		    	</td>
		    	<td valign="top" width="80%">
  					<input type="radio" name="fifthcat" id="fifthcatf" value="1" onclick="catPrices5.disabled = true;" <?php if($config->catPrices[5] == 0) echo "checked"; ?> <?php if($config->maxCatsForEntry < 5 ) echo "disabled"; ?> />
  						<?php echo _SOBI2_IS_FREE_L; ?>
  					<input type="radio" name="fifthcat" id="fifthcatnf" value="1" onclick="catPrices5.disabled = false;" <?php if($config->catPrices[5] != 0) echo "checked"; ?> <?php if($config->maxCatsForEntry < 5 ) echo "disabled"; ?> />
  						<?php echo _SOBI2_IS_NOT_FREE_L; ?>
 		    	</td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      		<?php echo _SOBI2_CONFIG_ENTRY_5_CAT_PRICE;?>
		      </td>
		      <td valign="top" width="80%"><input type="text" <?php if($config->maxCatsForEntry < 5 || $config->catPrices[5] == 0) echo "disabled"; ?> class="text_area" style="text-align:center;" name="catPrices5" id="catPrices5" value="<?php echo number_format($config->catPrices[5], 2, $config->curencyDecSeparator, ' '); ?>" size="5" maxlength="10" /> <?php echo $config->currency; ?></td>
		    </tr>

		  </table>
<?php
		$tabs->endTab();
		$tabs->startTab(_SOBI2_CONFIG_ENTRY_RENEWAL,"renewal");
?>
		  <table class="SobiAdminForm" width="100%" border="1">
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_ENTRY_RENEWAL_HEADER; ?></th>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_ALLOW_RENEWAL_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_ALLOW_RENEWAL),'','',_SOBI2_CONFIG_ENTRY_ALLOW_RENEWAL, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'allowRenew', 'class="inputbox"', $config->allowRenew ); ?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_ALLOW_REN_DAYS_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_ALLOW_REN_DAYS),'','',_SOBI2_CONFIG_ENTRY_ALLOW_REN_DAYS, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%">
		      	<?php
		      		$de =array();
		      		for( $i = 1; $i < 31; $i++ ) {
						$de[] = sobiHTML::makeOption( $i, $i );
		      		}
					echo sobiHTML::selectList( $de, 'allowRenewDaysForExp', 'size="1" class="inputbox"', 'value', 'text', $config->allowRenewDaysForExp );
		      	?>
		      	&nbsp; <?php echo _SOBI2_CONFIG_DAYS; ?>
		      </td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_RENEW_DISCOUNT_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_RENEW_DISCOUNT),'','',_SOBI2_CONFIG_ENTRY_RENEW_DISCOUNT, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%">
		      		<input type="text" name="renewDiscount" value="<?php echo $config->renewDiscount;?>" class="text_area" size="5"/> &nbsp; %
		      	</td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_RENEW_DAYS_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_RENEW_DAYS),'','',_SOBI2_CONFIG_ENTRY_RENEW_DAYS, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%">
		      		<input type="text" name="renewExpirationTime" value="<?php echo $config->renewExpirationTime;?>" class="text_area" size="5"/>
		      		&nbsp; <?php echo _SOBI2_CONFIG_DAYS; ?>
		      	</td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_RENEW_DELETE_FEES_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_RENEW_DELETE_FEES),'','',_SOBI2_CONFIG_ENTRY_RENEW_DELETE_FEES, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'renewDeleteFees', 'class="inputbox"', $config->renewDeleteFees ); ?></td>
		    </tr>

		  </table>
<?php
		$tabs->endTab();
		$tabs->startTab(_SOBI2_CONFIG_ENTRY_SAFETY,"safety");
?>
		  <table class="SobiAdminForm" width="100%">
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_ENTRY_SAFETY_OPTIONS; ?></th>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">
		      		<?php echo _SOBI2_ALLOW_FE_ENTRIES;?>
		      </td>
		      <td valign="top" width="80%">
		      	<?php echo sobiHTML::yesnoRadioList( 'allowFeEntr', 'class="inputbox"', $config->allowFeEntr ); ?>
		      </td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_ALLOW_ANO_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_ALLOW_ANO),'','',_SOBI2_CONFIG_ENTRY_ALLOW_ANO, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'allowAnonymous', 'class="inputbox"', $config->allowAnonymous ); ?></td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_AUTOPUBLISH_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_AUTOPUBLISH),'','',_SOBI2_CONFIG_ENTRY_AUTOPUBLISH, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'autopublishEntry', 'class="inputbox"', $config->autopublishEntry ); ?></td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_EXP_TIME_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_EXP_TIME),'','',_SOBI2_CONFIG_ENTRY_EXP_TIME, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><input type="text" style="text-align:center;" class="text_area" name="entryExpirationTime" value="<?php echo $config->entryExpirationTime; ?>" size="5" maxlength="4"/> &nbsp; <?php echo _SOBI2_DAYS_L; ?></td>
		    </tr>
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI_CONFIG_ENTRY_ACCEPT_RULES; ?></th>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI_CONFIG_ENTRY_NEED_TO_ACCEPT_RULES_EXPL),addslashes(_SOBI_CONFIG_ENTRY_NEED_TO_ACCEPT_RULES),'','',_SOBI_CONFIG_ENTRY_NEED_TO_ACCEPT_RULES, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'needToAcceptEntryRules', 'class="inputbox"', $config->needToAcceptEntryRules ); ?></td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      		<?php echo _SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_1 ;?>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area" name="acceptEntryRules1" value="<?php echo $config->acceptEntryRules1; ?>" size="40" maxlength="40"/></td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      		<?php echo _SOBI_CONFIG_ENTRY_ENTRY_RULES_TXT ;?>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area" name="entryRulesURLlabel" value="<?php echo $config->entryRulesURLlabel; ?>" size="40" maxlength="40"/></td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      		<?php echo _SOBI_CONFIG_ENTRY_ENTRY_RULES_URL ;?>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area" name="entryRulesURL" value="<?php echo $config->entryRulesURL; ?>" size="60" maxlength="400"/></td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      		<?php echo _SOBI_CONFIG_ENTRY_ENTRY_RULES_LABEL_2 ;?>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area" name="acceptEntryRules2" value="<?php echo $config->acceptEntryRules2; ?>" size="40" maxlength="40"/></td>
		    </tr>
		    <tr>
		      <td valign="top" colspan="2">
		      		<?php echo _SOBI_CONFIG_ENTRY_ENTRY_RULES_LABELS_EXPL ;?>
		      </td>
		    </tr>
		    <?php if (!defined("_JEXEC")) { ?>
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI_CONFIG_ENTRY_SEC_IMG; ?></th>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI_CONFIG_ENTRY_USE_SEC_IMG_EXPL),addslashes(_SOBI_CONFIG_ENTRY_USE_SEC_IMG),'','',_SOBI_CONFIG_ENTRY_USE_SEC_IMG, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'useSecurityCode', 'class="inputbox"', $config->useSecurityCode ); ?></td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      		<?php echo _SOBI_CONFIG_ENTRY_SEC_IMG_FONTCOLOR;?>
		      </td>
		      <td valign="top" width="80%">
				<div style="width:103px;width/* */:/**/100px;width: /**/100px;height:20px;border:1px solid #7F9DB9;">
				<input type="text" maxlength="7" style="width:80px;font-size:12px;height:17px;float:left;border:0px;padding-top:2px" name="secImgFontColor" size="10" value="#<?php echo $config->secImgFontColor;?>">
				<!-- <img style="float:right;padding-right:1px;padding-top:1px" src="<?php echo $config->liveSite.'/administrator/components/com_sobi2/images/select_arrow.gif'; ?>" onmouseover="this.src='<?php echo $config->liveSite.'/administrator/components/com_sobi2/images/select_arrow_over.gif'; ?>'" onmouseout="this.src='<?php echo $config->liveSite.'/administrator/components/com_sobi2/images/select_arrow.gif';?>'" onclick="showColorPicker(this,document.forms[0].secImgFontColor); changed()"> -->
				</div>
			  </td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      		<?php echo _SOBI_CONFIG_ENTRY_SEC_IMG_LINECOLOR;?>
		      </td>
		      <td valign="top" width="80%">
				<div style="width:103px;width/* */:/**/100px;width: /**/100px;height:20px;border:1px solid #7F9DB9;">
				<input type="text" maxlength="7" style="width:80px;font-size:12px;height:17px;float:left;border:0px;padding-top:2px" name="secImgLineColor" size="10" value="#<?php echo $config->secImgLineColor;?>">
				<!-- <img style="float:right;padding-right:1px;padding-top:1px" src="<?php echo $config->liveSite.'/administrator/components/com_sobi2/images/select_arrow.gif'; ?>" onmouseover="this.src='<?php echo $config->liveSite.'/administrator/components/com_sobi2/images/select_arrow_over.gif'; ?>'" onmouseout="this.src='<?php echo $config->liveSite.'/administrator/components/com_sobi2/images/select_arrow.gif';?>'" onclick="showColorPicker(this,document.forms[0].secImgLineColor); changed()"> -->
				</div>
			  </td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      		<?php echo _SOBI_CONFIG_ENTRY_SEC_IMG_BORDERCOLOR;?>
		      </td>
		      <td valign="top" width="80%">
				<div style="width:103px;width/* */:/**/100px;width: /**/100px;height:20px;border:1px solid #7F9DB9;">
				<input type="text" maxlength="7" style="width:80px;font-size:12px;height:17px;float:left;border:0px;padding-top:2px" name="secImgBorderColor" size="10" value="#<?php echo $config->secImgBorderColor;?>">
				<!-- <img style="float:right;padding-right:1px;padding-top:1px" src="<?php echo $config->liveSite.'/administrator/components/com_sobi2/images/select_arrow.gif'; ?>" onmouseover="this.src='<?php echo $config->liveSite.'/administrator/components/com_sobi2/images/select_arrow_over.gif'; ?>'" onmouseout="this.src='<?php echo $config->liveSite.'/administrator/components/com_sobi2/images/select_arrow.gif';?>'" onclick="showColorPicker(this,document.forms[0].secImgBorderColor); changed()"> -->
				</div>
			  </td>
		    </tr>
		    <tr>
		      <td valign="top" width="20%">
		      		<?php echo _SOBI_CONFIG_ENTRY_SEC_IMG_BGCOLOR;?>
		      </td>
		      <td valign="top" width="80%">
				<div style="width:103px;width/* */:/**/100px;width: /**/100px;height:20px;border:1px solid #7F9DB9;">
				<input type="text" maxlength="7" style="width:80px;font-size:12px;height:17px;float:left;border:0px;padding-top:2px" name="secImgBgColor" size="10" value="#<?php echo $config->secImgBgColor;?>">
				<!-- <img style="float:right;padding-right:1px;padding-top:1px" src="<?php echo $config->liveSite.'/administrator/components/com_sobi2/images/select_arrow.gif'; ?>" onmouseover="this.src='<?php echo $config->liveSite.'/administrator/components/com_sobi2/images/select_arrow_over.gif'; ?>'" onmouseout="this.src='<?php echo $config->liveSite.'/administrator/components/com_sobi2/images/select_arrow.gif';?>'" onclick="showColorPicker(this,document.forms[0].secImgBgColor); changed()"> -->
				</div>
			  </td>
		    </tr>
		    <?php } ?>
		   </table>
<?php
		$tabs->endTab();
		$tabs->endPane();
?>
	<input type="hidden" name="returnTask" value="efConf"/>
<?php
	}
	/**
	 * @param adminConfig $config
	 */
	function getViewConf( &$config )
	{
		sobi2Config::loadOverlib();
		$tabs = new sobiTabs(true);
		$tabs->startPane("view-pane");
		$tabs->startTab(_SOBI2_CONFIG_GEN,"view-gen");

?>
		  <table class="SobiAdminForm" width="100%">
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_VIEW_OPTIONS; ?></th>
		    </tr>

		    <tr class="row1">
		      <td valign="top" width="40%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_VIEW_ALLOW_ANO_EXPL),addslashes(_SOBI2_CONFIG_VIEW_ALLOW_ANO),'','',_SOBI2_CONFIG_VIEW_ALLOW_ANO, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="60%"><?php echo sobiHTML::yesnoRadioList( 'allowAnoDetails', 'class="inputbox"', $config->allowAnoDetails ); ?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="40%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_VIEW_OPTIONS_ICO_EXPL),addslashes(_SOBI2_CONFIG_VIEW_OPTIONS_ICO),'','',_SOBI2_CONFIG_VIEW_OPTIONS_ICO, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="60%"><?php echo sobiHTML::yesnoRadioList( 'showIcoInDetails', 'class="inputbox"', $config->showIcoInDetails ); ?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="40%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_VIEW_OPTIONS_IMG_EXPL),addslashes(_SOBI2_CONFIG_VIEW_OPTIONS_IMG),'','',_SOBI2_CONFIG_VIEW_OPTIONS_IMG, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="60%"><?php echo sobiHTML::yesnoRadioList( 'showImageInDetails', 'class="inputbox"', $config->showImageInDetails ); ?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="40%">
		      		<?php echo _SOBI2_CONFIG_VIEW_OPTIONS_ADDED_DATE;?>
		      </td>
		      <td valign="top" width="60%"><?php echo sobiHTML::yesnoRadioList( 'showAddedDate', 'class="inputbox"', $config->showAddedDate ); ?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="40%">
		      		<?php echo _SOBI2_CONFIG_VIEW_OPTIONS_HITS;?>
		      </td>
		      <td valign="top" width="60%"><?php echo sobiHTML::yesnoRadioList( 'showHits', 'class="inputbox"', $config->showHits ); ?></td>
		    </tr>
		</table>
<?php
	$tabs->endTab();
	$tabs->startTab("Google Maps","googlemaps");
?>

  <table class="SobiAdminForm" width="100%">
    <tr>
    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_ENTRY_GMAPS_NOTICE; ?></th>
    </tr>
    <tr class="row0">
      <td valign="top" width="40%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_ON_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_ON),'','',_SOBI2_CONFIG_ENTRY_GMAPS_ON, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="60%"><?php echo sobiHTML::yesnoRadioList( 'useGoogleMaps', 'class="inputbox"', $config->useGoogleMaps ); ?></td>
    </tr>
    <tr class="row1">
      <td valign="top" width="40%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_API_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_API),'','',_SOBI2_CONFIG_ENTRY_GMAPS_API, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="60%">
      	<input type="text" class="text_area" name="googleMapsApiKey" id="googleMapsApiKey" value="<?php echo $config->googleMapsApiKey; ?>" size="25" maxlength="300"/>
      </td>
    </tr>
    <tr class="row0">
      <td valign="top" width="40%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_W_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_W),'','',_SOBI2_CONFIG_ENTRY_GMAPS_W, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="60%">
      	<input type="text" class="text_area" style="text-align:center;" name="googleMapsWidth" id="googleMapsWidth" value="<?php echo $config->googleMapsWidth; ?>" size="5" maxlength="10"/> px.
      </td>
    </tr>
    <tr class="row1">
      <td valign="top" width="40%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_H_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_H),'','',_SOBI2_CONFIG_ENTRY_GMAPS_H, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="60%">
      	<input type="text" class="text_area" style="text-align:center;" name="googleMapsHeight" id="googleMapsHeight" value="<?php echo $config->googleMapsHeight; ?>" size="5" maxlength="10"/> px.
      </td>
    </tr>
    <tr class="row0">
      <td valign="top" width="40%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_LAT_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_LAT),'','',_SOBI2_CONFIG_ENTRY_GMAPS_LAT, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="60%">
      	<?php echo $config->getExistingFieldsList($config->googleMapsLatField, 'googleMapsLatField'); ?>
      </td>
    </tr>
    <tr class="row1">
      <td valign="top" width="40%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_LON_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_LON),'','',_SOBI2_CONFIG_ENTRY_GMAPS_LON, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="60%">
      	<?php echo $config->getExistingFieldsList($config->googleMapsLongField, 'googleMapsLongField'); ?>
      </td>
    </tr>
    <tr class="row0">
      <td valign="top" width="40%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE),'','',_SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="60%">
      	<?php
      		$bubbleSelect = array();
      		$bubbleSelect[] = sobiHTML::makeOption( 0, _SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_DISABLE);
      		$bubbleSelect[] = sobiHTML::makeOption( 1, _SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_EN_WAIT);
      		$bubbleSelect[] = sobiHTML::makeOption( 2, _SOBI2_CONFIG_ENTRY_GMAPS_BUBBLE_EN_OPEN);
      		echo sobiHTML::selectList( $bubbleSelect, 'googleMapsBubble', 'size="1" class="inputbox"', 'value', 'text', $config->googleMapsBubble);
      	?>
      </td>
    </tr>
    <tr class="row0">
      <td valign="top" width="40%">
      	<span class="editlinktip">
      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_ZOOM_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_GMAPS_ZOOM),'','',_SOBI2_CONFIG_ENTRY_GMAPS_ZOOM, '#',0 );?>
      	</span>
      </td>
      <td valign="top" width="60%">
      	<?php
      		$zoomSelect = array();
      		for($i = 1; $i < 18; $i++)
      			$zoomSelect[] = sobiHTML::makeOption( $i, $i);
      		echo sobiHTML::selectList( $zoomSelect, 'googleMapsZoom', 'size="1" class="inputbox"', 'value', 'text', $config->googleMapsZoom);
      	?>
      </td>
    </tr>
  </table>
<?php
	$tabs->endTab();
	$tabs->startTab(_SOBI2_CONFIG_ENTRY_WS_HEADER, "waysearch");
?>
		  <table class="SobiAdminForm" width="100%">
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_ENTRY_WS_HEADER; ?></th>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="40%">
		      		<?php echo _SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH;?>
		      </td>
		      <td valign="top" width="60%"><?php echo sobiHTML::yesnoRadioList( 'useWaySearch', 'class="inputbox"', $config->useWaySearch ); ?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="40%">
		      		<?php echo _SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_URL ;?>
		      </td>
		      <td valign="top" width="60%"><input type="text" class="text_area" name="waySearchUrl" value="<?php echo $config->waySearchUrl; ?>" size="60" maxlength="500"/></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="40%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_LABEL_EXPL),addslashes(_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_LABEL),'','',_SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_LABEL, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="60%"><input type="text" class="text_area" name="waySearchLabel" value="<?php echo $config->waySearchLabel; ?>" size="60" maxlength="100"/></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="40%"></td>
		      <td valign="top" width="60%"><?php echo _SOBI2_CONFIG_VIEW_OPTIONS_WAY_SEARCH_URL_VAR_EXPL; ?></td>
		    </tr>
		    <tr>
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_ENTRY_WS_FIELDS_ASSIGMENT; ?></th>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="40%">STREET</td>
		      <td valign="top" width="60%"><?php echo $config->getExistingFieldsList($config->waySearchFields["STREET"], "wsSTREET"); ?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="40%">ZIPCODE</td>
		      <td valign="top" width="60%"><?php echo $config->getExistingFieldsList($config->waySearchFields["ZIPCODE"], "wsZIPCODE"); ?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="40%">CITY</td>
		      <td valign="top" width="60%"><?php echo $config->getExistingFieldsList($config->waySearchFields["CITY"], "wsCITY"); ?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="40%">COUNTRY</td>
		      <td valign="top" width="60%"><?php echo $config->getExistingFieldsList($config->waySearchFields["COUNTRY"], "wsCOUNTRY"); ?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="40%">FEDSTATE</td>
		      <td valign="top" width="60%"><?php echo $config->getExistingFieldsList($config->waySearchFields["FEDSTATE"], "wsFEDSTATE"); ?></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="40%">COUNTY</td>
		      <td valign="top" width="60%"><?php echo $config->getExistingFieldsList($config->waySearchFields["COUNTY"], "wsCOUNTY"); ?></td>
		    </tr>
		</table>
<input type="hidden" name="returnTask" value="viewConf"/>
<?php
	$tabs->endTab();
	$tabs->endPane();
	}
	/**
	 * @param adminConfig $config
	 */
	function getPaymentsConf( &$config )
	{
		sobi2Config::loadOverlib();
?>
		  <table class="SobiAdminForm" width="100%">
		    <tr class="row1">
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_PAYMENTS_OPTIONS; ?></th>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      		<?php echo _SOBI2_CONFIG_PAYMENTS_CURRENCY;?>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:center;" name="currency" id="currency" value="<?php echo $config->currency; ?>" size="30" maxlength="50" /></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_PAYMENTS_CURRENCY_SEPARATOR_EXPL),addslashes(_SOBI2_CONFIG_PAYMENTS_CURRENCY_SEPARATOR),'','',_SOBI2_CONFIG_PAYMENTS_CURRENCY_SEPARATOR, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:center;" name="curencyDecSeparator" id="curencyDecSeparator" value="<?php echo $config->curencyDecSeparator; ?>" size="5" maxlength="10" /></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_PAYMENTS_TITLE_EXPL),addslashes(_SOBI2_CONFIG_PAYMENTS_TITLE),'','',_SOBI2_CONFIG_PAYMENTS_TITLE, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:left;" name="payTitle" id="payTitle" value="<?php echo $config->payTitle; ?>" size="50" maxlength="400" /></td>
		    </tr>
		    <tr class="row1">
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_PAYMENTS_BANK_TRANSFER; ?></th>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER_EXPL),addslashes(_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER),'','',_SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%">
				  <select class="inputbox" name="useBankTransfer" size="3">
				    <option <?php if($config->useBankTransfer == 0) echo "selected"; ?> value="0"><?php echo _SOBI2_NO_U; ?></option>
				    <option <?php if($config->useBankTransfer == 1) echo "selected"; ?> value="1"><?php echo _SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER_YES_OVER_EMAIL; ?></option>
				    <option <?php if($config->useBankTransfer == 2) echo "selected"; ?> value="2"><?php echo _SOBI2_CONFIG_PAYMENTS_USE_BANK_TRANSFER_YES_ON_PAGE; ?></option>
				  </select>
		      </td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_PAYMENTS_BANK_DATA_EXPL),addslashes(_SOBI2_CONFIG_PAYMENTS_BANK_DATA),'','',_SOBI2_CONFIG_PAYMENTS_BANK_DATA, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%">
				  <textarea class="text_area" name="bankData" rows="10" cols="50" wrap="off"><?php echo str_replace("<br />", "", $config->bankData); ?></textarea>
			  </td>
		    </tr>
		    <tr class="row0">
		    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_CONFIG_PAYMENTS_PAY_PAL; ?></th>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_PAYMENTS_USE_PAY_PAL_EXPL),addslashes(_SOBI2_CONFIG_PAYMENTS_USE_PAY_PAL),'','',_SOBI2_CONFIG_PAYMENTS_USE_PAY_PAL, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'usePayPal', 'class="inputbox"', $config->usePayPal ); ?></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_PAYMENTS_PAY_PAL_URL_EXPL),addslashes(_SOBI2_CONFIG_PAYMENTS_PAY_PAL_URL),'','',_SOBI2_CONFIG_PAYMENTS_PAY_PAL_URL, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:left;" name="payPalUrl" id="payPalUrl" value="<?php echo $config->payPalUrl; ?>" size="50" maxlength="400" /></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">
		      		<?php echo _SOBI2_CONFIG_PAYMENTS_PAY_PAL_EMAIL;?>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:left;" name="payPalMail" id="payPalMail" value="<?php echo $config->payPalMail; ?>" size="50" maxlength="400" /></td>
		    </tr>
		    <tr class="row0">
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_PAYMENTS_PAY_PAL_RETURL_EXPL),addslashes(_SOBI2_CONFIG_PAYMENTS_PAY_PAL_RETURL),'','',_SOBI2_CONFIG_PAYMENTS_PAY_PAL_RETURL, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:left;" name="payPalReturnUrl" id="payPalReturnUrl" value="<?php echo $config->payPalReturnUrl; ?>" size="50" maxlength="400" /></td>
		    </tr>
		    <tr class="row1">
		      <td valign="top" width="20%">
		      		<?php echo _SOBI2_CONFIG_PAYMENTS_CURRENCY_TEXT;?>
		      </td>
		      <td valign="top" width="80%"><input type="text" class="text_area" style="text-align:center;" name="payPalCurrency" id="payPalCurrency" value="<?php echo $config->payPalCurrency; ?>" size="10" maxlength="20" /></td>
		    </tr>
		</table>
		<input type="hidden" name="returnTask" value="payConf"/>
<?php
	}
	/**
	 * @param adminConfig $config
	 */
	function editCSS( &$config )
	{
		$cssfile = $config->absolutePath.DS."components".DS."com_sobi2".DS."includes".DS."com_sobi2.css";
		if ($fp = fopen( $cssfile, "r" )){
			$open = fread( $fp, filesize( $cssfile ) );
			$open = htmlspecialchars( $open );
		}
		else {
			sobi2Config::redirect( "index2.php?option=com_sobi2&task=genConf", _SOBI2_GENERAL_FILE_ERROR.$cssfile );
		}
		$config->mainframe->addCustomHeadTag("<script src=\"{$config->liveSite}/administrator/components/com_sobi2/includes/codepress/codepress.js\" type=\"text/javascript\"></script>");
		if(defined("_SOBI_MAMBO")) {
			echo "<script src=\"{$config->liveSite}/administrator/components/com_sobi2/includes/codepress/codepress.js\" type=\"text/javascript\"></script>";
		}

?>
	<script type="text/javascript">
		var csscontentOn = 1;
		function toogleCssEd() {
			if(csscontentOn == 1) {
				csscontentOn = 0;
			}
			else {
				csscontentOn = 1;
			}
			csscontent.toggleEditor();
		}
		function submitbutton() {
			if(csscontentOn == 1) {
				csscontent.toggleEditor();
			}
			document.getElementsByName("task")[0].value = "saveConfig";
			document.getElementById('adminForm').submit();
		}
	</script>
	<table border="0" width="100%">
		<tr>
			<td>
				<?php echo $cssfile._SOBI2_GENERAL_FILE_IS?>
	 			<?php echo is_writable($cssfile) ? _SOBI2_GENERAL_FILE_WRITABLE : _SOBI2_GENERAL_FILE_UNWRITABLE; ?>
<?php
	if ( sobi2bridge::isChmodable( $cssfile ) ) {
		if( is_writable( $cssfile ) ) {
            	?>
            		<td align="right">
						<input type="checkbox" id="disable_write" name="disable_write" value="1"/>
						<label for="disable_write"><?php echo _SOBI2_GENERAL_DO_FILE_UNWRITABLE; ?></label>
					</td>
				<?php
				}
	else { ?>
			<td align="right">
				<input type="checkbox" id="enable_write" name="enable_write" value="1"/>
				<label for="enable_write"><?php echo _SOBI2_GENERAL_DO_FILE_WRITABLE; ?></label>
			</td>
			   <?php
				 }
				}
		       ?>
		   </tr>
		   </table>
		   <table class="SobiAdminForm">
			<tr><th><?php echo $cssfile; ?></th></tr>
			<tr>
				<td>
					<a href="javascript:toogleCssEd();"><?php echo _SOBI2_CODEPRESS_TOGGLE;?></a>
					<textarea style="width:100%" cols="110" rows="45" name="csscontent" id="csscontent" class="codepress css"><?php echo $open; ?></textarea>
				</td>
			</tr>
		   </table>
		   <input type="hidden" name="returnTask" value="editCSS"/>
<?php
	}
	/**
	 * @param adminConfig $config
	 */
	function editTemplate( &$config )
	{
		$tpl = sobi2Config::request( $_REQUEST, 'stpl', $config->defTemplate );
		if( !($templatefile = sobi2Config::translatePath( "{$config->templatesDir}|{$tpl}|sobi2.details.tmpl" ))) {
			$tpl = $config->defTemplate;
			if( !($templatefile = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.details.tmpl" ))) {
				$templatefile = sobi2Config::translatePath( "{$config->templatesDir}|default|sobi2.details.tmpl" );
				$tpl = 'default';
			}
		}
		if ($fp = fopen( $templatefile, "r" )){
			$open = fread( $fp, filesize( $templatefile ) );
			$open = htmlspecialchars( $open );
		}
		else {
			sobi2Config::redirect( "index2.php?option=com_sobi2&task=genConf", _SOBI2_GENERAL_FILE_ERROR.$templatefile );
		}
		sobi2Config::import( 'includes|adm.helper.class', 'adm' );
		$config->mainframe->addCustomHeadTag("<script src=\"{$config->liveSite}/administrator/components/com_sobi2/includes/codepress/codepress.js\" type=\"text/javascript\"></script>");
		if(defined("_SOBI_MAMBO")) {
			echo "<script src=\"{$config->liveSite}/administrator/components/com_sobi2/includes/codepress/codepress.js\" type=\"text/javascript\"></script>";
		}
?>
	<script type="text/javascript">
		var templateContentOn = 1;
		function toogleTemplEd() {
			if(templateContentOn == 1) {
				templateContentOn = 0;
			}
			else {
				templateContentOn = 1;
			}
			templateContent.toggleEditor();
		}
		function submitbutton() {
			if(templateContentOn == 1) {
				templateContent.toggleEditor();
			}
			document.getElementsByName("task")[0].value = "saveConfig";
			document.getElementById('adminForm').submit();
		}
	</script>
	<table class="SobiAdminForm" width="100%">
		<tr>
			<th style="text-align:left; width: 40%;"></th>
			<th style="text-align:left; width: 40%;"></th>
			<th style="text-align:left; width: 20%;"></th>
		</tr>
		<tr class="row0">
			<td><span class="editlinktip">
				<?php echo _SOBI2_CHOOSE_TPL_TO_EDIT; ?></span>
			</td>
			<td><?php echo sobi2AdmHelper::templatesChooser( $tpl, 'stpl', 'details', array( 'onchange' => 'window.location=window.location+\'&stpl=\'+this.options[this.selectedIndex].value '), false ); ?></td>
			<td></td>
		</tr>
		<tr class="row1">
			<td>
				... <?php echo str_replace( _SOBI_CMSROOT, null, $templatefile ) ; echo _SOBI2_GENERAL_FILE_IS; ?>
	 			<?php echo is_writable($templatefile) ? _SOBI2_GENERAL_FILE_WRITABLE : _SOBI2_GENERAL_FILE_UNWRITABLE; ?>
		<?php
		if (is_writable($templatefile)) {
            	?>
            		<td align="right">
						<input type="checkbox" id="disable_write" name="disable_write" value="1"/>
						<label for="disable_write"><?php echo _SOBI2_GENERAL_DO_FILE_UNWRITABLE; ?></label>
					</td>
				<?php
				}
			else { ?>
			<td align="right">
				<input type="checkbox" id="enable_write" name="enable_write" value="1"/>
				<label for="enable_write"><?php echo _SOBI2_GENERAL_DO_FILE_WRITABLE; ?></label>
			</td>
			   <?php
				 }
		       ?>
		       <td></td>
		   </tr>
		   </table>
			<?php
		    	if(count($config->S2_plugins)) {
		    		foreach($config->S2_plugins as $name => $plugin) {
						if(method_exists($plugin,"onEditDetailsTemplate")) {
							$plugins[$name] = $plugin->onEditDetailsTemplate( $tpl );
						}
		    		}
		    	}
			?>
		   <table class="SobiAdminForm">
			<tr><th><?php echo $templatefile; ?></th></tr>
			<tr>
				<td>
					<a href="javascript:toogleTemplEd();"><?php echo _SOBI2_CODEPRESS_TOGGLE;?></a>
					<textarea style="width:100%" cols="110" rows="45" name="templateContent" id="templateContent" class="codepress php"><?php echo $open; ?></textarea>
				</td>
			</tr>
		   </table>
		   <input type="hidden" name="returnTask" value="editTemplate"/>
		   <input type="hidden" name="stpl" value="<?php echo $tpl; ?>"/>
<?php
	}
	/**
	 * @param adminConfig $config
	 */
	function editVCTemplate( &$config )
	{
		$tpl = sobi2Config::request( $_REQUEST, 'stpl', $config->defTemplate );
		if( !($templatefile = sobi2Config::translatePath( "{$config->templatesDir}|{$tpl}|sobi2.vc.tmpl" ))) {
			$tpl = $config->defTemplate;
			if( !($templatefile = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.vc.tmpl" ))) {
				$templatefile = sobi2Config::translatePath( "{$config->templatesDir}|default|sobi2.vc.tmpl" );
				$tpl = 'default';
			}
		}
		if ($fp = fopen( $templatefile, "r" )){
			$open = fread( $fp, filesize( $templatefile ) );
			$open = htmlspecialchars( $open );
		}
		else {
			sobi2Config::redirect( "index2.php?option=com_sobi2&task=genConf", _SOBI2_GENERAL_FILE_ERROR.$templatefile );
		}
		$config->mainframe->addCustomHeadTag("<script src=\"{$config->liveSite}/administrator/components/com_sobi2/includes/codepress/codepress.js\" type=\"text/javascript\"></script>");
		if(defined("_SOBI_MAMBO")) {
			echo "<script src=\"{$config->liveSite}/administrator/components/com_sobi2/includes/codepress/codepress.js\" type=\"text/javascript\"></script>";
		}
		sobi2Config::import( 'includes|adm.helper.class', 'adm' );
?>
	<script type="text/javascript">
		var templateContentOn = 1;
		function toogleTemplEd() {
			if(templateContentOn == 1) {
				templateContentOn = 0;
			}
			else {
				templateContentOn = 1;
			}
			templateContent.toggleEditor();
		}
		function submitbutton() {
			if(templateContentOn == 1) {
				templateContent.toggleEditor();
			}
			document.getElementsByName("task")[0].value = "saveConfig";
			document.getElementById('adminForm').submit();
		}
	</script>
	<table class="SobiAdminForm" width="100%">
		<tr>
			<th style="text-align:left; width: 40%;"></th>
			<th style="text-align:left; width: 40%;"></th>
			<th style="text-align:left; width: 20%;"></th>
		</tr>
		<tr class="row1">
			<td><span class="editlinktip">
				<?php echo _SOBI2_CHOOSE_TPL_TO_EDIT ?></span>
			</td>
			<td><?php echo sobi2AdmHelper::templatesChooser( $tpl, 'stpl', 'vc', array( 'onchange' => 'window.location=window.location+\'&stpl=\'+this.options[this.selectedIndex].value '), false ); ?></td>
			<td></td>
		</tr>
		<tr class="row0">
			<td><span class="editlinktip"><?php echo sobiHTML::toolTip(addslashes(_SOBI2_VC_TEMPLATE_ENABLE_EXPL),addslashes(_SOBI2_VC_TEMPLATE_ENABLE),'','',_SOBI2_VC_TEMPLATE_ENABLE, '#',0 );?></span></td>
			<td><?php echo sobiHTML::yesnoRadioList( 'useDetailsView', 'class="inputbox"', $config->useDetailsView ); ?></td>
			<td></td>
		</tr>
		<tr class="row1">
			<td> ... <?php echo str_replace( _SOBI_CMSROOT, null, $templatefile ); echo _SOBI2_GENERAL_FILE_IS; ?><?php echo is_writable($templatefile) ? _SOBI2_GENERAL_FILE_WRITABLE : _SOBI2_GENERAL_FILE_UNWRITABLE; ?></td>
			<td>
				<?php
						if (is_writable($templatefile)) {
				 ?>
						<input type="checkbox" id="disable_write" name="disable_write" value="1"/>
						<label for="disable_write"><?php echo _SOBI2_GENERAL_DO_FILE_UNWRITABLE; ?></label>
				<?php
						}
						else { ?>
						<input type="checkbox" id="enable_write" name="enable_write" value="1"/>
						<label for="enable_write"><?php echo _SOBI2_GENERAL_DO_FILE_WRITABLE; ?></label>
				   <?php
					 	}
			       ?>
			</td>
			<td></td>
		</tr>
	</table>
			<?php
		    	if(count($config->S2_plugins)) {
		    		foreach($config->S2_plugins as $name => $plugin) {
						if(method_exists($plugin,"onEditVCTemplate")) {
							$plugins[$name] = $plugin->onEditVCTemplate( $tpl );
						}
		    		}
		    	}
			?>
		   <table class="SobiAdminForm">
			<tr><th><?php echo $templatefile; ?></th></tr>
			<tr>
				<td>
					<a href="javascript:toogleTemplEd();"><?php echo _SOBI2_CODEPRESS_TOGGLE;?></a>
					<textarea style="width:100%" cols="110" rows="45" name="templateContent" id="templateContent" class="codepress php"><?php echo $open; ?></textarea>
				</td>
			</tr>
		   </table>
		   <input type="hidden" name="returnTask" value="editVCTemplate"/>
		   <input type="hidden" name="stpl" value="<?php echo $tpl; ?>"/>
<?php
	}
	/**
	 * @param adminConfig $config
	 */
	function editFormTemplate( &$config )
	{
		$tpl = sobi2Config::request( $_REQUEST, 'stpl', $config->defTemplate );
		if( !($templatefile = sobi2Config::translatePath( "{$config->templatesDir}|{$tpl}|sobi2.form.tmpl" ))) {
			$tpl = $config->defTemplate;
			if( !($templatefile = sobi2Config::translatePath( "{$config->templatesDir}|{$config->defTemplate}|sobi2.form.tmpl" ))) {
				$templatefile = sobi2Config::translatePath( "{$config->templatesDir}|default|sobi2.form.tmpl" );
				$tpl = 'default';
			}
		}
		if ($fp = fopen( $templatefile, "r" )){
			$open = fread( $fp, filesize( $templatefile ) );
			$open = htmlspecialchars( $open );
		}
		else {
			sobi2Config::redirect( "index2.php?option=com_sobi2&task=genConf", _SOBI2_GENERAL_FILE_ERROR.$templatefile );
		}
		$config->mainframe->addCustomHeadTag("<script src=\"{$config->liveSite}/administrator/components/com_sobi2/includes/codepress/codepress.js\" type=\"text/javascript\"></script>");
		if(defined("_SOBI_MAMBO")) {
			echo "<script src=\"{$config->liveSite}/administrator/components/com_sobi2/includes/codepress/codepress.js\" type=\"text/javascript\"></script>";
		}
?>
	<script type="text/javascript">
		var templateContentOn = 1;
		function toogleTemplEd() {
			if(templateContentOn == 1) {
				templateContentOn = 0;
			}
			else {
				templateContentOn = 1;
			}
			templateContent.toggleEditor();
		}
		function submitbutton() {
			if(templateContentOn == 1) {
				templateContent.toggleEditor();
			}
			document.getElementsByName("task")[0].value = "saveConfig";
			document.getElementById('adminForm').submit();
		}
	</script>
	<table class="SobiAdminForm" width="100%">
		<tr>
			<th style="text-align:left; width: 40%;"></th>
			<th style="text-align:left; width: 40%;"></th>
			<th style="text-align:left; width: 20%;"></th>
		</tr>
		<tr class="row0">
			<td><span class="editlinktip"><?php echo sobiHTML::toolTip(addslashes(_SOBI2_VC_TEMPLATE_ENABLE_EXPL),addslashes(_SOBI2_VC_TEMPLATE_ENABLE),'','',_SOBI2_VC_TEMPLATE_ENABLE, '#',0 );?></span></td>
			<td><?php echo sobiHTML::yesnoRadioList( 'useFormTpl', 'class="inputbox"', $config->useFormTpl ); ?></td>
			<td></td>
		</tr>
		<tr class="row1">
			<td> ... <?php echo str_replace( _SOBI_CMSROOT, null, $templatefile ); echo _SOBI2_GENERAL_FILE_IS; ?><?php echo is_writable($templatefile) ? _SOBI2_GENERAL_FILE_WRITABLE : _SOBI2_GENERAL_FILE_UNWRITABLE; ?></td>
			<td>
			<?php
					if ( is_writable( $templatefile ) ) {
			 ?>
					<input type="checkbox" id="disable_write" name="disable_write" value="1"/>
					<label for="disable_write"><?php echo _SOBI2_GENERAL_DO_FILE_UNWRITABLE; ?></label>
			<?php
					}
					else { ?>
					<input type="checkbox" id="enable_write" name="enable_write" value="1"/>
					<label for="enable_write"><?php echo _SOBI2_GENERAL_DO_FILE_WRITABLE; ?></label>
			   <?php
				 	}
		       ?>
			</td>
			<td></td>
		</tr>
	</table>
			<?php
		    	if(count($config->S2_plugins)) {
		    		foreach($config->S2_plugins as $name => $plugin) {
						if(method_exists($plugin,"onEditFormTemplate")) {
							$plugins[$name] = $plugin->onEditFormTemplate( $tpl );
						}
		    		}
		    	}
			?>
		   <table class="SobiAdminForm">
			<tr><th><?php echo $templatefile; ?></th></tr>
			<tr>
				<td>
					<a href="javascript:toogleTemplEd();"><?php echo _SOBI2_CODEPRESS_TOGGLE;?></a>
					<textarea style="width:100%" cols="110" rows="45" name="templateContent" id="templateContent" class="codepress php"><?php echo $open; ?></textarea>
				</td>
			</tr>
		   </table>
		   <input type="hidden" name="returnTask" value="editFormTemplate"/>
		   <input type="hidden" name="stpl" value="<?php echo $tpl; ?>"/>
<?php
	}
	/**
	 * @param adminConfig $config
	 */
	function languageManager( &$config )
	{
		?>
		<div style="padding:10px;">
			<h4><?php echo _SOBI2_CONFIG_LANGMAN_INSTALL_NEW; ?></h4>
			<table class="SobiAdminForm">
				<tr>
					<th><?php echo _SOBI2_CONFIG_LANG_PACK_UPLOAD; ?></th>
				</tr>
				<tr>
					<td>
					<input name="sobi2Lang" id="sobi2Lang" class="inputbox" type="file" size="50" maxlength="100000" accept="text/*"/>
					<input type="submit" class="button" name="<?php echo _SOBI2_CONFIG_LANGMAN_INSTALL_BT; ?>" value="<?php echo _SOBI2_CONFIG_LANGMAN_INSTALL_BT; ?>"/>
					</td>
				</tr>
			</table>
		<table class="SobiAdminList">
			<tr>
				<th width="10" align="center">#</th>
				<th width="20" align="center"></th>
				<th align="left"><?php echo _SOBI2_CONFIG_LANGMAN_INSTALLED_LANGS ;?></th>
				<th align="center"><?php echo _SOBI2_LANG_FOR_VER; ?></th>
				<th align="center"><?php echo _SOBI2_CONFIG_LANGMAN_LIST_CREATED; ?></th>
				<th align="center"><?php echo _SOBI2_PLUGINS_AUTHOR; ?></th>
				<th align="center"><?php echo _SOBI2_PLUGINS_AUTHOR_URL; ?></th>
				<th align="center">Front</th>
				<th align="center">Back-End</th>
			</tr>
			<?php
			    sobi2Config::import("includes|xml_domit|xml_domit_lite_parser", "adm");
				$langs = $config->getLangList(false);
				asort($langs);
				if(count($langs)) {
					$counter = 0;
					foreach($langs as $lang) {
						$counter++;
						$style = $counter%2 ? "row0" : "row1";
						$img = ($lang != "default") ? "{$config->liveSite}/administrator/components/com_sobi2/images/flags/{$lang}.gif" : null;
						$xml = false;
						if($XMLfile = sobi2Config::translatePath("languages|{$lang}", "adm", true, ".xml")) {
							$xmlDoc = new DOMIT_Lite_Document();
							$xmlDoc->resolveErrors( true );
							$xmlDoc->loadXML( $XMLfile, false, true );
							$root = $xmlDoc->documentElement;
							if($root->getTagName() == 'sobi2lang') {
								$node = $root->getElementsByPath('version',1);
								$version = $node->getText();
								$node = $root->getElementsByPath('author',1);
								$author = $node->getText();
								$node = $root->getElementsByPath('creationDate',1);
								$creationDate = $node->getText();
								$node = $root->getElementsByPath('authorEmail',1);
								$authorEmail = $node->getText();
								$node = $root->getElementsByPath('authorUrl',1);
								$authorUrl = $node->getText();
								$authorRealUrl = $authorUrl;
								if(!(strstr($authorUrl, "http://"))) {
									$authorRealUrl = "http://{$authorUrl}";
								}
								$xml = true;
							}
						}
						if(!$xml) {
							$version = $authorUrl = $author = $creationDate = $authorEmail = $authorRealUrl = null;
						}
						$feFile = sobi2Config::translatePath("languages|{$lang}") ? 'tick.png' : 'publish_x.png';
						$beFile = sobi2Config::translatePath("languages|admin.{$lang}", "adm") ? 'tick.png' : 'publish_x.png';
					?>
						<tr class="<?php echo $style; ?>">
							<td align="center">
								<?php if($lang != "default") { ?>
								<input type="radio" name="lang" id="lang" value="<?php echo $lang; ?>"/>
								<?php } ?>
							</td>
							<td align="center"><?php if($img) { ?><img src="<?php echo $img; ?>" alt="<?php echo $lang; ?>"/><?php } ?></td>
							<td align="left"><?php echo $lang; ?></td>
							<td align="center"><?php echo $version; ?></td>
							<td align="center"><?php echo $creationDate; ?></td>
							<td align="center"><?php if( strstr( $authorEmail, "@" ) ) { ?><a href="mailto:<?php echo $authorEmail; ?>"><?php } ?><?php echo $author; ?></a></td>
							<td align="center"><a href="<?php echo $authorRealUrl; ?>"><?php echo $authorUrl; ?></a></td>
							<td align="center"><img src="images/<?php echo $feFile;?>" style="border: none;"/></td>
							<td align="center"><img src="images/<?php echo $beFile;?>" style="border: none;"/></td>
						</tr>
					<?php
					}
				}
			?>
		</table>
		</div>
		<input type="hidden" name="boxchecked" value="999" />
  		<input type="hidden" name="task" value="installLang"/>
  		<input type="hidden" name="returnTask" value="langMan"/>
		<?php
	}
	/**
	 * @param adminConfig $config
	 */
	function emailsConfig( &$config )
	{
?>
	<script  type='text/javascript' src='<?php echo $config->liveSite; ?>/administrator/components/com_sobi2/includes/advajax.js'></script>
	<table class="SobiAdminForm" width="100%">
		<tr>
			<th style="text-align:left; width: 20%;" id="sProgressMsg"><?php echo _SOBI2_CONFIG_EMAILS; ?></th>
			<th style="text-align:left; width: 60%;" id="sProgressbar"></th>
			<th style="text-align:center; width: 20%;"></th>
		</tr>
	</table>
	<table>
		<tr>
			<td style="text-align:left; width: 25%;"><?php echo _SOBI2_SELECT_OPTION_TO_EDIT; ?></td>
			<td style="text-align:left; width: 55%;">
				<select name="mailTpl" class="text_area">
					<option><?php echo _SOBI2_SELECT; ?></option>
					<option onclick="loadMailFram('emailsFooter', '<?php echo _SOBI2_CONFIG_FOOTER; ?>')"><?php echo _SOBI2_CONFIG_FOOTER; ?></option>
					<optgroup label="<?php echo _SOBI2_EMAIL_ON_SUBMIT_OPTGR; ?>">
						<option onclick="loadMailFram('emailOnSubmit', '<?php echo _SOBI2_EMAIL_ON_SUBMIT; ?>')"><?php echo _SOBI2_EMAIL_ON_SUBMIT; ?></option>
						<option onclick="loadMailFram('emailOnSubmitAdmin', '<?php echo _SOBI2_EMAIL_ON_SUBMIT_ADMIN; ?>')"><?php echo _SOBI2_EMAIL_ON_SUBMIT_ADMIN; ?></option>
					</optgroup>
					<optgroup label="<?php echo _SOBI2_EMAIL_ON_UPDATE_OPTGR; ?>">
						<option onclick="loadMailFram('emailOnUpdate', '<?php echo _SOBI2_EMAIL_ON_UPDATE; ?>')"><?php echo _SOBI2_EMAIL_ON_UPDATE; ?></option>
						<option onclick="loadMailFram('emailOnUpdateAdmin', '<?php echo _SOBI2_EMAIL_ON_UPDATE_ADMIN; ?>')"><?php echo _SOBI2_EMAIL_ON_UPDATE_ADMIN; ?></option>
					</optgroup>
					<optgroup label="<?php echo _SOBI2_EMAIL_ON_RENEW_OPTGR; ?>">
						<option onclick="loadMailFram('emailOnRenew', '<?php echo _SOBI2_EMAIL_ON_RENEW; ?>')"><?php echo _SOBI2_EMAIL_ON_RENEW; ?></option>
						<option onclick="loadMailFram('emailOnRenewAdmin', '<?php echo _SOBI2_EMAIL_ON_RENEW_ADMIN; ?>')"><?php echo _SOBI2_EMAIL_ON_RENEW_ADMIN; ?></option>
					</optgroup>
					<optgroup label="<?php echo _SOBI2_EMAIL_ON_PAYMENT_OPTGR; ?>">
						<option onclick="loadMailFram('emailOnPayment', '<?php echo _SOBI2_EMAIL_ON_PAYMENT; ?>')"><?php echo _SOBI2_EMAIL_ON_PAYMENT; ?></option>
						<option onclick="loadMailFram('emailOnPaymentAdmin', '<?php echo _SOBI2_EMAIL_ON_PAYMENT_ADMIN; ?>')"><?php echo _SOBI2_EMAIL_ON_PAYMENT_ADMIN; ?></option>
					</optgroup>
					<optgroup label="<?php echo _SOBI2_EMAIL_ON_APPROVE_OPTGR; ?>">
						<option onclick="loadMailFram('emailOnApprove', '<?php echo _SOBI2_EMAIL_ON_APPROVE; ?>')"><?php echo _SOBI2_EMAIL_ON_APPROVE; ?></option>
					</optgroup>
				</select>
				&nbsp;<a href="javascript:S_aboutMarkers()"><?php echo _SOBI2_CONFIG_MAIL_LINK_MARKERS;?></a>
				&nbsp;<input type="button" class="button" onclick="javascript:SobiSaveMail(this);" value="<?php echo _SOBI2_SAVE;?>" />
			</td>
		</tr>
	</table>
	<div id="markersInfo"></div>
	<script type="text/javascript">
		var markers = 0;
		var semaphor = 0;
		function SobiSaveMail(pressbutton) {
			if(semaphor == -1) {
				alert('<?php echo _SOBI2_PLEASE_WAIT; ?>');
			}
			else {
				semaphor = -1;
				advAJAX.submit(document.getElementById("adminForm"),
				{
					onInitialization : function(obj) { Sloader_start();	},
					onSuccess : function(obj) {
						semaphor = 0;
						Sloader_stop("<?php echo _SOBI2_CHANGES_SAVED;?>", "");
//						document.getElementById("mailContainer").innerHTML = obj.responseText;
					},
					onError : function(obj) {
						document.getElementById("sProgressMsg").innerHTML = "Error saving data";
					}
				}
				);
			}
		}
		function S_aboutMarkers() {
			if(markers == 0) {
				document.getElementById("markersInfo").innerHTML = "<?php echo _SOBI2_CONFIG_MAIL_ABOUT_MARKERS; ?>";
				markers = 1;
			}
			else {
				document.getElementById("markersInfo").innerHTML = "";
				markers = 0;
			}
		}
		function Sloader_start() {
			document.getElementById("sProgressMsg").innerHTML = "<?php echo _SOBI2_PLEASE_WAIT; ?>";
			document.getElementById("sProgressbar").innerHTML = "<img style='border: solid 1px;' src='<?php echo $config->liveSite; ?>/administrator/components/com_sobi2/images/progress.gif' alt='progress' title='progress'/>";
		}
		function Sloader_stop(msg, editing) {
			document.getElementById("sProgressMsg").innerHTML = msg+editing;
			document.getElementById("sProgressbar").innerHTML = "";
		}
		function loadMailFram(task, editing) {
			semaphor = -1;
			advAJAX.get({
			    url: "index3.php",
				parameters : {
				      "no_html" : "1",
				      "option" : "com_sobi2",
				      "task" : task,
				      "slang" : document.getElementById("slang").value
				},
				onInitialization : function() {
					Sloader_start();
				},

			    onSuccess : function(obj) {
			        Sloader_stop("<?php echo _SOBI2_READY;?>", editing);
			        document.getElementById("mailContainer").innerHTML = obj.responseText;
			        semaphor = 0;
			    },
			    onError : function(obj) { alert("Error: " + obj.status); }
			});
		}
	</script>

	<div id="mailContainer" style="padding-left: 5px;">
		<input type="hidden" name="slang" id="slang" value=""/>
	</div>
<?php
	}
	/**
	 * @param adminConfig $config
	 */
	function emailFooter( &$config )
	{
		?>
		<br/>
		<table class="SobiAdminForm" width="100%">
			<tr>
				<td valign="top">
			      	<span class="editlinktip">
			      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_FOOTER_EXPL),addslashes(_SOBI2_CONFIG_FOOTER),'','',_SOBI2_CONFIG_FOOTER, '#',0 );?>:
			      	</span>
				</td>
				<td>
					<textarea name="mailFooter" class="text_area" rows="15" cols="60" ><?php echo $config->mailFooter; ?></textarea>
				</td>
			</tr>
		</table>
		<input type="hidden" name="task" id="task" value="saveMailFooter"/>
		<input type="hidden" name="slang" id="slang" value=""/>
		<?php
	}
	/**
	 * @param adminConfig $config
	 * @param string $lang
	 */
	function emailOnSubmit( &$config, $lang )
	{
		?>
		<br/>
		<table class="SobiAdminForm" width="100%">
		    <tr>
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_NEW_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_NEW),'','',_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_NEW, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'notifyAuthorNew', 'class="inputbox"', $config->notifyAuthorNew ); ?></td>
		    </tr>
			<tr>
				<td>
			      	<span class="editlinktip">
			      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_MAIL_LANG_EXPL),addslashes(_SOBI2_CONFIG_MAIL_LANG),'','',_SOBI2_CONFIG_MAIL_LANG, '#',0 );?>
			      	</span>
				</td>
				<td><?php echo $config->getLanguages(true, $lang, 'class="inputbox" onchange="document.getElementById(\'slang\').value = this.options[this.options.selectedIndex].value; loadMailFram(\'emailOnSubmit\', \''._SOBI2_EMAIL_ON_SUBMIT.'\')";'); ?></td>
			</tr>
			<tr>
				<td><?php echo _SOBI2_EMAIL_TITLE;?> </td>
				<td><input type="text" class="text_area" style="text-align:left;" name="UserEmailOnSubmitTitle" id="UserEmailOnSubmitTitle" value="<?php echo $config->UserEmailOnSubmitTitle; ?>" size="50" maxlength="400" /></td>
			</tr>
			<tr>
				<td valign="top"><?php echo _SOBI2_EMAIL_TEXT;?> </td>
				<td><textarea name="UserEmailOnSubmitText" class="text_area" rows="15" cols="60" ><?php echo $config->UserEmailOnSubmitText; ?></textarea></td>
			</tr>

		</table>
		<input type="hidden" name="task" id="task" value="saveMailOnSubmitUser"/>
		<input type="hidden" name="slang" id="slang" value="<?php echo $lang;?>"/>
		<?php
	}
	/**
	 * @param adminConfig $config
	 * @param string $lang
	 */
	function emailOnUpdate( &$config, $lang )
	{
		?>
		<br/>
		<table class="SobiAdminForm" width="100%">
		    <tr>
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_EDIT_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_EDIT),'','',_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_EDIT, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'notifyAuthorChanges', 'class="inputbox"', $config->notifyAuthorChanges ); ?></td>
		    </tr>
			<tr>
				<td>
			      	<span class="editlinktip">
			      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_MAIL_LANG_EXPL),addslashes(_SOBI2_CONFIG_MAIL_LANG),'','',_SOBI2_CONFIG_MAIL_LANG, '#',0 );?>
			      	</span>
				</td>
				<td><?php echo $config->getLanguages(true,$lang, 'class="inputbox" onchange="document.getElementById(\'slang\').value = this.options[this.options.selectedIndex].value; loadMailFram(\'emailOnUpdate\', \''._SOBI2_EMAIL_ON_UPDATE.'\')";'); ?></td>
			</tr>
			<tr>
				<td><?php echo _SOBI2_EMAIL_TITLE;?> </td>
				<td><input type="text" class="text_area" style="text-align:left;" name="UserEmailOnUpdateTitle" id="UserEmailOnUpdateTitle" value="<?php echo $config->UserEmailOnUpdateTitle; ?>" size="50" maxlength="400" /></td>
			</tr>
			<tr>
				<td valign="top"><?php echo _SOBI2_EMAIL_TEXT;?> </td>
				<td><textarea name="UserEmailOnUpdateText" class="text_area" rows="15" cols="60" ><?php echo $config->UserEmailOnUpdateText; ?></textarea></td>
			</tr>

		</table>
		<input type="hidden" name="task" id="task" value="saveMailOnUpdateUser"/>
		<input type="hidden" name="slang" id="slang" value="<?php echo $lang;?>"/>
		<?php
	}
	/**
	 * @param adminConfig $config
	 * @param string $lang
	 */
	function emailOnRenew( &$config, $lang )
	{
		?>
		<br/>
		<table class="SobiAdminForm" width="100%">
		    <tr>
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_RENEW_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_RENEW),'','',_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_RENEW, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'notifyAuthorRenew', 'class="inputbox"', $config->notifyAuthorRenew ); ?></td>
		    </tr>
			<tr>
				<td>
			      	<span class="editlinktip">
			      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_MAIL_LANG_EXPL),addslashes(_SOBI2_CONFIG_MAIL_LANG),'','',_SOBI2_CONFIG_MAIL_LANG, '#',0 );?>
			      	</span>
				</td>
				<td><?php echo $config->getLanguages(true,$lang, 'class="inputbox" onchange="document.getElementById(\'slang\').value = this.options[this.options.selectedIndex].value; loadMailFram(\'emailOnRenew\', \''._SOBI2_EMAIL_ON_RENEW.'\')";'); ?></td>
			</tr>
			<tr>
				<td><?php echo _SOBI2_EMAIL_TITLE;?> </td>
				<td><input type="text" class="text_area" style="text-align:left;" name="UserEmailOnRenewTitle" id="UserEmailOnRenewTitle" value="<?php echo $config->UserEmailOnRenewTitle; ?>" size="50" maxlength="400" /></td>
			</tr>
			<tr>
				<td valign="top"><?php echo _SOBI2_EMAIL_TEXT;?> </td>
				<td><textarea name="UserEmailOnRenewText" class="text_area" rows="15" cols="60" ><?php echo $config->UserEmailOnRenewText; ?></textarea></td>
			</tr>

		</table>
		<input type="hidden" name="task" id="task" value="saveMailOnRenewUser"/>
		<input type="hidden" name="slang" id="slang" value="<?php echo $lang;?>"/>
		<?php
	}
	/**
	 * @param adminConfig $config
	 * @param string $lang
	 */
	function emailOnApprove( &$config, $lang )
	{
		?>
		<br/>
		<table class="SobiAdminForm" width="100%">
		    <tr>
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_APPROVED_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_APPROVED),'','',_SOBI2_CONFIG_ENTRY_NOTIFY_AUTHOR_APPROVED, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'emailOnAppr', 'class="inputbox"', $config->emailOnAppr ); ?></td>
		    </tr>
			<tr>
				<td>
			      	<span class="editlinktip">
			      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_MAIL_LANG_EXPL),addslashes(_SOBI2_CONFIG_MAIL_LANG),'','',_SOBI2_CONFIG_MAIL_LANG, '#',0 );?>
			      	</span>
				</td>
				<td><?php echo $config->getLanguages(true,$lang, 'class="inputbox" onchange="document.getElementById(\'slang\').value = this.options[this.options.selectedIndex].value; loadMailFram(\'emailOnApprove\', \''._SOBI2_EMAIL_ON_APPROVE.'\')";'); ?></td>
			</tr>
			<tr>
				<td><?php echo _SOBI2_EMAIL_TITLE;?> </td>
				<td><input type="text" class="text_area" style="text-align:left;" name="UserEmailOnApproveTitle" id="UserEmailOnApproveTitle" value="<?php echo $config->UserEmailOnApproveTitle; ?>" size="50" maxlength="400" /></td>
			</tr>
			<tr>
				<td valign="top"><?php echo _SOBI2_EMAIL_TEXT;?> </td>
				<td><textarea name="UserEmailOnApproveText" class="text_area" rows="15" cols="60" ><?php echo $config->UserEmailOnApproveText; ?></textarea></td>
			</tr>

		</table>
		<input type="hidden" name="task" id="task" value="saveMailOnApprove"/>
		<input type="hidden" name="slang" id="slang" value="<?php echo $lang;?>"/>
		<?php
	}
	/**
	 * @param adminConfig $config
	 * @param string $lang
	 */
	function emailOnPayment( &$config, $lang )
	{
		?>
		<br/>
		<table class="SobiAdminForm" width="100%">
			<tr>
				<td>
			      	<span class="editlinktip">
			      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_MAIL_LANG_EXPL),addslashes(_SOBI2_CONFIG_MAIL_LANG),'','',_SOBI2_CONFIG_MAIL_LANG, '#',0 );?>
			      	</span>
				</td>
				<td><?php echo $config->getLanguages(true,$lang, 'class="inputbox" onchange="document.getElementById(\'slang\').value = this.options[this.options.selectedIndex].value; loadMailFram(\'emailOnPayment\', \''._SOBI2_EMAIL_ON_PAYMENT.'\')";'); ?></td>
			</tr>
			<tr>
				<td><?php echo _SOBI2_EMAIL_TITLE;?> </td>
				<td><input type="text" class="text_area" style="text-align:left;" name="UserEmailPaymentsTitle" id="UserEmailPaymentsTitle" value="<?php echo $config->UserEmailPaymentsTitle; ?>" size="50" maxlength="400" /></td>
			</tr>
			<tr>
				<td valign="top"><?php echo _SOBI2_EMAIL_TEXT;?> </td>
				<td><textarea name="UserEmailPaymentsText" class="text_area" rows="30" cols="60" ><?php echo $config->UserEmailPaymentsText; ?></textarea></td>
			</tr>

		</table>
		<input type="hidden" name="task" id="task" value="saveMailOnPayment"/>
		<input type="hidden" name="slang" id="slang" value="<?php echo $lang;?>"/>
		<?php
	}
	/**
	 * @param adminConfig $config
	 * @param string $lang
	 */
	function emailOnSubmitAdmin( &$config, $lang )
	{
		?>
		<br/>
		<table class="SobiAdminForm" width="100%">
		    <tr>
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN),'','',_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'notifyAdmins', 'class="inputbox"', $config->notifyAdmins ); ?></td>
		    </tr>
			<tr>
				<td><?php echo _SOBI2_EMAIL_TITLE;?> </td>
				<td><input type="text" class="text_area" style="text-align:left;" name="AdmEmailOnSubmitTitle" id="AdmEmailOnSubmitTitle" value="<?php echo $config->AdmEmailOnSubmitTitle; ?>" size="50" maxlength="400" /></td>
			</tr>
			<tr>
				<td valign="top"><?php echo _SOBI2_EMAIL_TEXT;?> </td>
				<td><textarea name="AdmEmailOnSubmitText" class="text_area" rows="15" cols="60" ><?php echo $config->AdmEmailOnSubmitText; ?></textarea></td>
			</tr>

		</table>
		<input type="hidden" name="task" id="task" value="saveMailOnSubmitAdmin"/>
		<input type="hidden" name="slang" id="slang" value="<?php echo $lang;?>"/>
		<?php
	}
	/**
	 * @param adminConfig $config
	 * @param string $lang
	 */
	function emailOnUpdateAdmin( &$config, $lang )
	{
		?>
		<br/>
		<table class="SobiAdminForm" width="100%">
		    <tr>
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EDIT_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EDIT),'','',_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_EDIT, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'notifyAdminChanges', 'class="inputbox"', $config->notifyAdminChanges ); ?></td>
		    </tr>
			<tr>
				<td><?php echo _SOBI2_EMAIL_TITLE;?> </td>
				<td><input type="text" class="text_area" style="text-align:left;" name="AdmEmailOnUpdateTitle" id="AdmEmailOnUpdateTitle" value="<?php echo $config->AdmEmailOnUpdateTitle; ?>" size="50" maxlength="400" /></td>
			</tr>
			<tr>
				<td valign="top"><?php echo _SOBI2_EMAIL_TEXT;?> </td>
				<td><textarea name="AdmEmailOnUpdateText" class="text_area" rows="15" cols="60" ><?php echo $config->AdmEmailOnUpdateText; ?></textarea></td>
			</tr>

		</table>
		<input type="hidden" name="task" id="task" value="saveMailOnUpdateAdmin"/>
		<input type="hidden" name="slang" id="slang" value="<?php echo $lang;?>"/>
		<?php
	}
	/**
	 * @param adminConfig $config
	 * @param string $lang
	 */
	function emailOnRenewAdmin( &$config, $lang )
	{
		?>
		<br/>
		<table class="SobiAdminForm" width="100%">
		    <tr>
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_RENEW_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_RENEW),'','',_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_RENEW, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'notifyAdminRenew', 'class="inputbox"', $config->notifyAdminRenew ); ?></td>
		    </tr>
			<tr>
				<td><?php echo _SOBI2_EMAIL_TITLE;?> </td>
				<td><input type="text" class="text_area" style="text-align:left;" name="AdmEmailOnRenewTitle" id="AdmEmailOnRenewTitle" value="<?php echo $config->AdmEmailOnRenewTitle; ?>" size="50" maxlength="400" /></td>
			</tr>
			<tr>
				<td valign="top"><?php echo _SOBI2_EMAIL_TEXT;?> </td>
				<td><textarea name="AdmEmailOnRenewText" class="text_area" rows="15" cols="60" ><?php echo $config->AdmEmailOnRenewText; ?></textarea></td>
			</tr>

		</table>
		<input type="hidden" name="task" id="task" value="saveMailOnRenewAdmin"/>
		<input type="hidden" name="slang" id="slang" value="<?php echo $lang;?>"/>
		<?php
	}
	/**
	 * @param adminConfig $config
	 * @param string $lang
	 */
	function emailOnPaymentAdmin( &$config, $lang )
	{
		?>
		<br/>
		<table class="SobiAdminForm" width="100%">
		    <tr>
		      <td valign="top" width="20%">
		      	<span class="editlinktip">
		      		<?php echo sobiHTML::toolTip(addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_PAYMENT_EXPL),addslashes(_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_PAYMENT),'','',_SOBI2_CONFIG_ENTRY_NOTIFY_ADMIN_PAYMENT, '#',0 );?>
		      	</span>
		      </td>
		      <td valign="top" width="80%"><?php echo sobiHTML::yesnoRadioList( 'mailFeesAdm', 'class="inputbox"', $config->mailFeesAdm ); ?></td>
		    </tr>
			<tr>
				<td><?php echo _SOBI2_EMAIL_TITLE;?> </td>
				<td><input type="text" class="text_area" style="text-align:left;" name="AdmEmailPaymentsTitle" id="AdmEmailPaymentsTitle" value="<?php echo $config->AdmEmailPaymentsTitle; ?>" size="50" maxlength="400" /></td>
			</tr>
			<tr>
				<td valign="top"><?php echo _SOBI2_EMAIL_TEXT;?> </td>
				<td><textarea name="AdmEmailPaymentsText" class="text_area" rows="15" cols="60" ><?php echo $config->AdmEmailPaymentsText; ?></textarea></td>
			</tr>

		</table>
		<input type="hidden" name="task" id="task" value="saveMailOnPaymentAdmin"/>
		<input type="hidden" name="slang" id="slang" value="<?php echo $lang;?>"/>
		<?php
	}
	/**
	 * @param adminConfig $config
	 */
	function checkVersion( &$config )
	{
?>
	<script type="text/javascript">
  	function S_checkVer() {
		document.getElementById("msgContainer").src = "<?php echo $config->remoteAddrVCh;?>?version=<?php echo $config->getVersion(); ?>&slang=<?php echo $config->sobi2Language; ?>";
  	}
	</script>
	<table class="SobiAdminForm" width="100%">
		<tr>
			<th style="text-align:left;" colspan="4"><?php echo _SOBI2_CONFIG_CHECK_VER; ?></th>
		</tr>
		<tr>
			<td colspan="4" style="text-align:left; padding-left:5px;">&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align:left; padding-left:5px; width: 10%;"><?php echo _SOBI2_CONFIG_ACT_VER; ?></td>
			<td style="text-align:left; padding-left:5px; width: 20%;">
				<strong><?php echo $config->getVersion(); ?></strong>
				&nbsp;&nbsp;
				<input type="button" class="button"name="check" onclick="S_checkVer();" value="<?php echo _SOBI2_CONFIG_VER_CHECK; ?>"/>
			</td>
			<td colspan="2" style="text-align:left; width: 70%;"></td>
		</tr>
		<tr>
			<td colspan="4" style="text-align:left;">
				<br/>
				<iframe width="90%" height="400" frameborder="0" id="msgContainer" src=""></iframe>
			</td>
		</tr>
	</table>

<?php
	}
	/**
	 * @param adminConfig $config
	 */
	function pluginManager( &$config )
	{
    	$config->loadOverlib();
    	$plugins = $config->getPlugins();
    	$tables = $config->getPluginsTables();
    ?>
		<table class="SobiAdminHeading" style="margin-top:10px; margin-left:5px; margin-bottom: 10px;">
			<tr>
				<th class="plugins" > &nbsp; <?php echo _SOBI2_PLUGIN_HEADER; ?><small> [<?php echo _SOBI2_MENU_PLUGINS_MANAGER; ?>] </small></th>
			</tr>
		</table>
    	<form action="index2.php" method="post" id="adminForm" name="adminForm" enctype="multipart/form-data">
		<div style="padding:10px;">
			<h4><?php echo _SOBI2_CONFIG_PLUGINS_INSTALL_NEW; ?></h4>
			<table class="SobiAdminForm">
				<tr>
					<th><?php echo _SOBI2_CONFIG_PLUGINS_UPLOAD; ?></th>
				</tr>
				<tr>
					<td>
							<input name="sobi2Lang" id="sobi2Lang" class="inputbox" type="file" size="50" maxlength="100000" accept="text/*"/>
							<input type="submit" class="button" name="<?php echo _SOBI2_CONFIG_LANGMAN_INSTALL_BT; ?>" value="<?php echo _SOBI2_CONFIG_LANGMAN_INSTALL_BT; ?>"/>
					</td>
				</tr>
			</table>
		<table class="SobiAdminList">
			<tr>
				<th width="10" align="center">#</th>
				<th align="left"><?php echo _SOBI2_CONFIG_PLUGINS_INSTALLED_PLUGINS ;?></th>
				<th align="center">ID</th>
				<th align="center"><?php echo _SOBI2_PLUGINS_VER; ?></th>
				<th align="center"><?php echo _SOBI2_PLUGINS_AUTHOR; ?></th>
				<th align="center"><?php echo _SOBI2_PLUGINS_AUTHOR_URL; ?></th>
				<th align="center"><?php echo _SOBI2_PLUGINS_INIT_FILE; ?></th>
				<th align="center"><?php echo _SOBI2_PLUGINS_POSITION; ?></th>
				<th align="center">
					<a href="#" onclick="submitbutton('reorderPlugins'); return false;"><img src="images/filesave.png" border="0" width="16" height="16" alt="Save Order" /></a>
				</th>
				<th align="center"><?php echo _SOBI2_PLUGINS_ENABLED; ?></th>
			</tr>
			<?php
				if( count($plugins) ) {
					$counter = 0;
					foreach($plugins as $plugin) {
						$counter++;
						$style = $counter%2 ? "row0" : "row1";
						$enabled = $config->P_EnabledProcessing($plugin);
						$authorRealUrl = $plugin->author_url;
						if( !( strstr( $authorRealUrl, "http://" ) ) ) {
							$authorRealUrl = "http://{$authorRealUrl}";
						}

					?>
						<tr class="<?php echo $style; ?>">
							<td align="center">
								<input type="radio" name="plugin" id="plugin" value="<?php echo $plugin->id; ?>"/>
								<input type="hidden" name="pid[]" value="<?php echo $plugin->id; ?>" />
							</td>
							<td align="left"><span class="editlinktip"><?php echo sobiHTML::toolTip(addslashes($plugin->description),addslashes($plugin->name),'','',$plugin->name, '#',0 );?></span></td>
							<td align="center"><?php echo $plugin->name_id; ?></td>
							<td align="center"><?php echo $plugin->version; ?></td>
							<td align="center"><a href="mailto:<?php echo $plugin->author_email; ?>"><?php echo $plugin->author; ?></a></td>
							<td align="center"><a href="<?php echo $authorRealUrl; ?>"><?php echo $plugin->author_url; ?></a></td>
							<td align="center"><?php echo $plugin->init_file; ?></td>
							<td width="6" colspan = "2" align="center">
								<input type="text" name="pluginOrder[]" size="5" value="<?php echo $plugin->position; ?>" class="text_area" style="text-align: center" />
							</td>
							<td align="center"><?php echo $enabled; ?></td>
						</tr>
					<?php
					}
				}
			?>
		</table>
		<table class="SobiAdminHeading" style="margin-top:10px; margin-left:5px; margin-bottom: 10px;">
			<tr>
				<th class="plugins" > &nbsp; <?php echo _SOBI2_PLUGIN_HEADER; ?><small> [<?php echo _SOBI2_MENU_PLUGINS_DATATABLES; ?>] </small></th>
			</tr>
		</table>
		<table class="SobiAdminList">
			<tr>
				<th width="10" align="center">#</th>
				<th align="left"><?php echo _SOBI2_PLUGINS_DATATABLES_PNAME ;?></th>
				<th align="left"><?php echo _SOBI2_PLUGINS_DATATABLES_NAME ;?></th>
				<th align="left"><?php echo _SOBI2_PLUGINS_DATATABLES_INFO ;?></th>
				<th align="center"><?php echo _SOBI2_PLUGINS_DATATABLES_ROWS; ?></th>
				<th align="center"><?php echo _SOBI2_PLUGINS_DATATABLES_CREATED; ?></th>
				<th align="center"><?php echo _SOBI2_PLUGINS_DATATABLES_UPD; ?></th>
			</tr>
			<?php
				if( count( $tables ) ) {
					$counter = 0;
					foreach( $tables as $plugin ) {
						$counter++;
						$style = $counter%2 ? "row0" : "row1";
						$plugin->pname = $config->getTablePlugin( $plugin->Name );
						$tableName = str_replace( $config->database->_table_prefix."sobi2_plugin_", null, $plugin->Name );
					?>
						<tr class="<?php echo $style; ?>">
							<td align="center">
								<input type="checkbox" onclick="if( this.checked ) alert('<?php echo _JS_SOBI2_PLUGINS_DATATABLE_DELETE; ?>')" name="pluginstable[]" value="<?php echo $plugin->Name; ?>"/>
							</td>
							<td align="left"><?php echo $plugin->pname; ?></td>
							<td align="left"><?php echo $tableName; ?></td>
							<td align="left"><?php echo $plugin->Comment; ?></td>
							<td align="center"><?php echo $plugin->Rows; ?></td>
							<td align="center"><?php echo $plugin->Create_time; ?></td>
							<td align="center"><?php echo $plugin->Update_time; ?></td>
						</tr>
					<?php
					}
				}
			?>
		</table>
		</div>
		<input type="hidden" name="boxchecked" value="999" />
  		<input type="hidden" name="task" value="installPlugin"/>
  		<input type="hidden" name="returnTask" value="pluginsManager"/>
		<input type="hidden" name="option" value="com_sobi2"/>
    	</form>
    <?php
	}
	function errorLog( &$config, $err, $errors, $countErr, $force, $size )
	{
?>
	<table class="SobiAdminForm" width="100%">
		<tr>
			<th style="text-align:left;" colspan="4"><?php echo _SOBI2_ERRLOG_FILE_SIZE . $size; ?> kB.</th>&nbsp;
		</tr>
	</table>

<?php
		if($err) {
			echo _SOBI2_ERRLOG_NO_FILE;
			return;
		}
		if($errors && count($errors)) {
			echo "\n<table class=\"SobiAdminForm\" width=\"100%\" border='1'>";
			echo "\n\t<tr>";
			echo "\n\t\t<td width='5%' style='text-align: center; vertical-align: top;' >Level</td>";
			echo "\n\t\t<td width='5%' style='text-align: center; vertical-align: top;'>Date</td>";
			echo "\n\t\t<td width='15%' style='text-align: center; vertical-align: top;'>User&nbsp;IP</td>";
			echo "\n\t\t<td width='5%' style='text-align: center; vertical-align: top;'>Requestet&nbsp;URI</td>";
			echo "\n\t\t<td width='5%' style='text-align: center; vertical-align: top;'>Referer</td>";
			echo "\n\t\t<td width='5%' style='text-align: center; vertical-align: top;'>Browser</td>";
			echo "\n\t\t<td width='60%' style='text-align: left; vertical-align: top;'>Error</td>";
			echo "</tr>";
			foreach ($errors as $error) {
				$error->date = trim($error->date);
				$error->ip = str_replace(" ",null,trim($error->ip));
				$error->level = str_replace("\n",null,$error->level);
				$error->date = str_replace("\n",null,$error->date);
				$error->ip = str_replace("\n",null,$error->ip);
				$error->referer = str_replace(" ",null,trim($error->referer));
				$error->uri = str_replace(" ",null,trim($error->uri));
				$error->browser = trim($error->browser);
				$error->msg = str_replace("\n"," ",trim($error->msg));

				echo "\n\t<tr>";
				echo "\n\t\t<td width='5%' style='text-align: center; vertical-align: top;' >{$error->level}</td>";
				echo "\n\t\t<td width='5%' style='text-align: center; vertical-align: top;' >{$error->date}</td>";
				echo "\n\t\t<td width='15%' style='text-align: center; vertical-align: top;' >{$error->ip}</td>";
				if(strlen($error->uri) > 10) {
					$uri = substr($error->uri,0,15)."&nbsp;... ";
					$error->uri = "<a href='{$config->liveSite}{$error->uri}' target='_blank' title='{$config->liveSite}{$error->uri}'>{$uri}</a>";
				}
				echo "\n\t\t<td width='5%' style='text-align: center; vertical-align: top;' >{$error->uri}</td>";
				if(strlen($error->referer) > 10) {
					$uri = substr($error->referer,0,15)."&nbsp;... ";
					$error->referer = "<a href='{$error->referer}' target='_blank' title='{$error->referer}'>{$uri}</a>";
				}
				echo "\n\t\t<td width='5%' style='text-align: center; vertical-align: top;' >{$error->referer}</td>";
				if(strlen($error->browser) > 20) {
					$browser = substr($error->browser,0,15)."&nbsp;... ";
					$error->browser = sobiHTML::toolTip(addslashes($error->browser),addslashes($browser),'','',$browser, '#',0 );
					$error->browser = "<span class='editlinktip'>{$error->browser}</span>";
				}
				echo "\n\t\t<td width='5%' style='text-align: center; vertical-align: top;' >{$error->browser}</td>";
				echo "\n\t\t<td width='60%' style='text-align: left; vertical-align: top;' >{$error->msg}</td>";
				echo "\n\t\t</tr>";
			}
			echo "\n</table>";
		}
		else {
			echo "<br/>&nbsp;&nbsp;"._SOBI2_ERRLOG_FILE_TOO_BIG."&nbsp;&nbsp;";
			echo "<input type='button' onclick=\"location.href='{$config->liveSite}/administrator/index2.php?option=com_sobi2&task=errlog&force=1'\" value='"._SOBI2_ERRLOG_FILE_SHOW."' class='text_area'>";
			echo "<input type='button' onclick=\"location.href='{$config->liveSite}/administrator/index2.php?option=com_sobi2&task=getlogfile'\" value='"._SOBI2_ERRLOG_FILE_DOWNLOAD_FULL."' class='text_area'>";
		}
	}
	function generalConfig($task)
	{
		$config =& adminConfig::getInstance();
		switch($task) {
			case 'genConf':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_CONFIG_GEN." ] </small>";
				$style = "cpanel";
			break;
			case 'efConf':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_MENU_GENERAL_NEW_ENTRIES_CONFIG." ] </small>";
				$style = "cpanel";
			break;
			case 'viewConf':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_MENU_GENERAL_NEW_VIEW_CONFIG." ] </small>";
				$style = "view";
			break;
			case 'payConf':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_CONFIG_PAYMENTS_OPTIONS." ] </small>";
				$style = "payment";
			break;
			case 'editCSS':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_MENU_EDIT_CSS." ] </small>";
				$style = "css";
			break;
			case 'editTemplate':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_MENU_EDIT_TEMPLATE." ] </small>";
				$style = "template";
			break;
			case 'editVCTemplate':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_MENU_EDIT_VC_TEMPLATE." ] </small>";
				$style = "template";
			break;
			case 'editFormTemplate':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_MENU_EDIT_FORM_TEMPLATE." ] "._SOBI2_ADM_EXPERIMENTAL_OPT."</small>";
				$style = "template";
			break;
			case 'langMan':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_MENU_LANG_MANAGER." ] </small>";
				$style = "lang";
			break;
			case 'emails':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_MENU_EMAILS." ] </small>";
				$style = "mail";
			break;
			case 'vercheck':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_MENU_VER_CHECKER." ] </small>";
				$style = "cpanel";
			break;
			case 'errlog':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_MENU_ERRLOG." ] </small>";
				$style = "cpanel";
			break;
			case 'registry':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_MENU_REG_MANAGER." ]"._SOBI2_ADM_EXPERIMENTAL_OPT." </small>";
				$style = "registry";
			break;
			case 'recount':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_TOOLBAR_RECOUNT_CATS_F." ] </small>";
				$style = "registry";
			break;
			case 'syscheck':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_TOOLBAR_GEN_DEB_REP." ] </small>";
				$style = "syscheck";
			break;
			case 'templates':
				$title = _SOBI2_CONFIG.": <small> ["._SOBI2_MENU_TPL_MANAGER." ] </small>";
				$style = "templateman";
			break;

		}
		?>
		<form action="index2.php" method="post" id="adminForm" name="adminForm" enctype="multipart/form-data" accept-charset="<?php echo _ISO; ?>">
		<table class="SobiAdminHeading" style="margin-top:10px; margin-left:5px; margin-bottom: 10px;">
			<tr>
				<th class="<?php echo $style;?>"> &nbsp; <?php echo $title ?></th>
			</tr>
		</table>
		<?php
			switch($task) {
				case 'genConf':
					$config->showGeneral();
					break;
				case 'efConf':
					$config->getEditForm();
					$config->editFormConf();
					break;
				case 'viewConf':
					$config->getGoogleMaps();
					$config->getDetails();
					$config->getViewConf();
					break;
				case 'payConf':
					$config->getPayment();
					$config->getEditForm();
					$config->getPaymentsConf();
					break;
				case 'editCSS':
					$config->editCSS();
					break;
				case 'editTemplate':
					$config->editTemplate();
					break;
				case 'editVCTemplate':
					$config->editVCTemplate();
					break;
				case 'editFormTemplate':
					$config->editFormTemplate();
					break;
				case 'langMan':
					$config->languageManager();
					break;
				case 'emails':
					$config->getEditForm();
					$config->emailsConfig();
					break;
				case 'vercheck':
					$config->checkVersion();
					break;
				case 'registry':
					adminConfig_HTML::registry( $config );
					break;
				case 'templates':
					adminConfig_HTML::tplMan();
					break;
				case 'recount':
					adminConfig_HTML::catsRecount( $config );
					break;
				case 'syscheck':
					adminConfig_HTML::syscheck( $config );
					break;
				case 'errlog':
					$fileSize = 0;
					$errors = array();
					$countErr = 0;
					$force = sobi2Config::request($_GET,"force",0);
					$err = 0;
					$file = _SOBI_ADM_PATH.DS."error_logfile.txt";
					if(!(is_file($file))){
						$err = "1";
					}
					else {
						$fileSize = filesize($file);
						$fileSize /= 1024;
						$fileSize = intval($fileSize);
						if($fileSize < 500 || $force) {
							$fcontent = @fopen($file,"r");
							if(!$err)	 {
								$count = 0;
								while (!feof($fcontent)) {
									$count++;
									$buffer = fgets($fcontent, 4096);

									if(!isset($error))
										$error = new stdClass();
									if($count == 1)
										$error->date = $buffer;
									elseif ($count == 2) {
										$error->ip = str_ireplace("IP: ",null,$buffer);
									}
									elseif ($count == 3) {
										$error->uri = str_ireplace("Requestet URI: ",null,$buffer);
									}
									elseif ($count == 4) {
										$error->referer = str_ireplace("Refferer: ",null,$buffer);
									}
									elseif ($count == 5) {
										$error->browser = str_ireplace("Browser: ",null,$buffer);
										$error->browser = str_ireplace("\n"," ",$error->browser);
									}
									elseif ($count == 6) {
										$error->msg = str_ireplace("Error: ",null,$buffer);
										$error->msg = sobiHTML::cleanText($error->msg);
										$imgFolder = "/administrator/components/com_sobi2/images";
										if(stristr($buffer,"(Error number:")) {
											$start = strrpos($buffer,"Error number:");
											$error->level = substr($buffer,$start,25);
											$error->level = ereg_replace("[^0-9]","",$error->level);
										}
										else
											$error->level  = 0;
										switch ($error->level) {
											case 0:
												$img 			= "{$imgFolder}/intern.png";
												$tip			= sobiHTML::toolTip( addslashes( _SOBI2_ERR_INTERN ), "Internal", null, $img );
												$error->level 	= "<span style=\"cursor:help;\">{$tip}</span>";
												break;
											case 8:
											case 1024:
												$img 			= "{$imgFolder}/notice.png";
												$tip			= sobiHTML::toolTip( addslashes( _SOBI2_ERR_NOTICE ), "Notice", null, $img );
												$error->level 	= "<span style=\"cursor:help;\">{$tip}</span>";
												break;
											case 1:
												$img 			= "{$imgFolder}/error.png";
												$tip			= sobiHTML::toolTip( addslashes( _SOBI2_ERR_ERROR ), "Error", null, $img );
												$error->level 	= "<span style=\"cursor:help;\">{$tip}</span>";
												break;
											case 2:
												$img 			= "{$imgFolder}/warning.png";
												$tip			= sobiHTML::toolTip( addslashes( _SOBI2_ERR_WARNING ), "Warning", null, $img );
												$error->level 	= "<span style=\"cursor:help;\">{$tip}</span>";
												break;
											case 512:
												$img 			= "{$imgFolder}/error.png";
												$tip			= sobiHTML::toolTip( addslashes( _SOBI2_ERR_INTERN ), "Error", null, $img );
												$error->level 	= "<span style=\"cursor:help;\">{$tip}</span>";
												break;
											default:
												break;
										}

									}
									elseif ($count == 7) {
										$errors[] = $error;
										unset($error);
										$count = 0;
										$countErr++;
									}
								}
								$errors = array_reverse($errors);
							}
							fclose($fcontent);
						}
					}
					$config->errorLog($err,$errors,$countErr,$force,$fileSize);
				break;
			}
		?>
		<?php if( $task != 'langMan' && $task != 'emails' && $task != 'templates' ) { ?>
			<input type="hidden" name="task" value="" />
		<?php } ?>
		<input type="hidden" name="option" value="com_sobi2"/>
		<input type="hidden" name="editing" value="config" />
		</form>
		<?php
	}
    function pluginConfig( $pluginName )
    {
		$config =& adminConfig::getInstance();
    	$plugin = $config->S2_plugins[$pluginName];
    	if($plugin->name) {
    		$title = $plugin->name;
    	}
    	else {
    		$title = $pluginName;
    	}
    ?>
		<table class="SobiAdminHeading" style="margin-top:10px; margin-left:5px; margin-bottom: 10px;">
			<tr>
				<th class="modules" > &nbsp; <?php echo _SOBI2_PLUGIN_HEADER ?><small> [<?php echo $title; ?>] </small></th>
			</tr>
		</table>
    	<form action="index2.php" method="post" id="adminForm" name="adminForm" enctype="multipart/form-data">
    	<?php
    	if(method_exists($plugin,"config")) {
    		$plugin->config();
		}
		?>
		<input type="hidden" name="option" id="option" value="com_sobi2" />
		<input type="hidden" name="task" id="task" value="" />
		<input type="hidden" name="S2_plugin" value="<?php echo $pluginName ?>" />
    	</form>
    <?php
    }
	/**
	 * @param adminConfig $config
	 */
	function registry( &$config )
	{
		$file = file_get_contents( sobi2Config::translatePath("includes|inc|config", "front", true, ".ini" ) );
		if( !strlen( $file ) ) {
			trigger_error( "cannot open config.ini file ");
			$config->debOut( "cannot open config.ini file " );
			return null;
		}
		$file = explode( "\n", $file );
		$registry = array();
		foreach ( $file as $line ) {
			$registry[] = trim( $line );
		}
		$start = array_search( "[general]", $registry );
		$registry = array_slice( $registry, $start );
	?>
    <script type="text/javascript">
    	function addNewSection()
    	{
			var sectionName = document.getElementById("newSect").value;
			if( !sectionName ) {
				return false;
			}
			document.getElementById("newSect").value = '';
			var td1 = document.createElement("td");
			var td2 = document.createElement("td");
			var row = document.createElement("tr");
			var dummy = document.getElementById("lastRow");
			td1.innerHTML = '<big>Section: ['+sectionName+']<input type="hidden" name="reg['+sectionName+'][section]" value="'+sectionName+'"/></big>';
			td2.innerHTML = '<?php echo _SOBI2_REG_MANAGER_NEW_PAIR; ?>&nbsp;<input type="text" size="40" id="'+sectionName+'_newPair" value="" class="text_area"/><input type="button" value="<?php echo _SOBI2_REG_MANAGER_ADD_PAIR; ?>" onclick="addNewPair(\''+sectionName+'\');" class="button"/>';
			td1.colSpan = "2";
			td1.className = "text_area";
			td2.className = "text_area";
			row.appendChild(td1);
			row.appendChild(td2);
			row.className = "row1";
			row.id = sectionName;
			dummy.parentNode.insertBefore(row,dummy);
    	}
    	function addNewPair( section )
    	{
			var KeyName = document.getElementById(section+"_newPair").value;
			if( !KeyName ) {
				return false;
			}
			document.getElementById(section+"_newPair").value = '';
			sectionName = KeyName;
			var td1 = document.createElement("td");
			var td2 = document.createElement("td");
			var td3 = document.createElement("td");
			var row = document.createElement("tr");
			var sec = document.getElementById(section);
			td1.innerHTML = '<input type="checkbox" value="1" name="reg['+section+']['+KeyName+'][enabled]"/>';
			td2.innerHTML = '<input type="text" class="text_area" style="font-weight: bold; color:#000033;" size="40" name="reg['+section+']['+KeyName+'][key]" value="'+KeyName+'"/>';
			td3.innerHTML = '<input type="text" class="text_area" size="60" name="reg['+section+']['+KeyName+'][value]" value=""/>';
			row.appendChild(td1);
			row.appendChild(td2);
			row.appendChild(td3);
			row.className = "row0";
			sec.parentNode.insertBefore(row,sec.nextSibling);
    	}
    </script>
		  <table class="SobiAdminForm" width="100%">
		    <tr class="row1">
		    	<td style="text-align:left;"><img src="components/com_sobi2/images/warning.png" alt="warning"/> <big><b><?php echo _SOBI2_REG_MANAGER_WARNING; ?></b></big> </td>
		    	<td style="text-align:right;"><?php echo _SOBI2_REG_MANAGER_NEW_SECTION; ?>&nbsp;<input type="text" size="60" id="newSect" value="" class="text_area"/></td>
		    	<td style="text-align:center;"><input type="button" value="<?php echo _SOBI2_REG_MANAGER_ADD_SECTION; ?>" onclick="addNewSection();" class="button"/></td>
		    </tr>
		  </table>
		  <table class="SobiAdminForm" width="100%">
		    <tr class="row1">
		    	<th style="text-align:left;">Enabled</th>
		    	<th style="text-align:left;">Key</th>
		    	<th style="text-align:left;">Value</th>
		    </tr>
	<?php
		foreach ( $registry as $line ) {
			if( strlen( $line ) < 2 ) {
				continue;
			}
			if( $line[0] == "[") {
				$line = trim( $line );
				$section = str_replace( array( "[", "]"), null, $line );
				?>
			    <tr class="row1" id="<?php echo $section; ?>">
			    	<td colspan="2" class="text_area" style="text-align:left; border-style:solid"><big>Section: <?php echo $line; ?><input type="hidden" name="reg[<?php echo $section; ?>][section]" value="<?php echo $line; ?>"/></big> </td>
			    	<td class="text_area" style="text-align:left; border-style:solid">
				    	<?php echo _SOBI2_REG_MANAGER_NEW_PAIR; ?>&nbsp;<input type="text" size="40" id="<?php echo $section;?>_newPair" value="" class="text_area"/>
				    	<input type="button" value="<?php echo _SOBI2_REG_MANAGER_ADD_PAIR; ?>" onclick="addNewPair('<?php echo $section; ?>');" class="button"/>
				    </td>
			    </tr>
				<?php
			}
			else {
				if( strstr( $line, ";@@")) {
					echo '<tr>';
					echo '<th valign="top"colspan="3">';
					echo str_replace( ";@@", null, $line );
					echo "<input type=\"hidden\" name=\"reg[{$section}][comment]\" value=\"{$line}\"/>";
					echo '</th>';
					echo '</tr>';
				}
				else {
					echo '<tr class="row0">';
					echo '<td valign="top" width="5%">';
					if( $line[0] == ";" ) {
						$disabled = null;
						$line = str_replace(";", null, $line );
					}
					else {
						$disabled = "checked = \"checked\"";
					}
					$key = explode( "=", $line );
					$key[0] = trim( $key[0] );
					$key[1] = str_replace( '"', null, $key[1] );
					$key[1] = ltrim( $key[1] );
					echo "<input type=\"checkbox\" value=\"1\" {$disabled} name=\"reg[{$section}][{$key[0]}][enabled]\"/>";
					echo '</td>';
					echo '<td valign="top" width="20%">';
					echo "<input type=\"text\" class=\"text_area\" style=\"font-weight: bold; color:#000033;\" readonly size=\"40\" name=\"reg[{$section}][{$key[0]}][key]\" value=\"{$key[0]}\"/>";
					echo '</td>';
					echo '<td valign="top" width="80%">';
					echo "<input type=\"text\" class=\"text_area\" size=\"60\" name=\"reg[{$section}][{$key[0]}][value]\" value=\"{$key[1]}\"/>";
					echo '</td>';
					echo '</tr>';
				}
			}
		}
		echo '<tr style="display:none" id="lastRow"><td valign="top"colspan="3"></td></tr>';
	?>
		</table>
		<input type="hidden" name="returnTask" value="registry"/>
	<?php
	}
	/**
	 * @param adminConfig $config
	 */
	function catsRecount( &$config )
	{
    	$database =& $config->getDb();
    	$query = "SELECT  atime FROM #__sobi2_cobj WHERE cid > 0 ORDER BY atime ASC LIMIT 1";
    	$database->setQuery( $query );
    	$time = $database->loadResult();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$time = date( $config->key( "string", "date_format", "Y-m-d H:i:s" ), $time );

	?>
    <script type="text/javascript">
    	function startRecountCat()
    	{
    		document.getElementById("recframe").src = "index3.php?option=com_sobi2&task=ccount&no_html=1";
			document.getElementById("stbut").disabled = true;
    	}
	 </script>
	  <table class="SobiAdminForm" width="100%">
	    <tr class="row1">
	    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_RECOUNT_CATS_HEADER; ?></th>
	    </tr>
	    <tr class="row0">
	    	<td colspan="2" style="text-align:left;">&nbsp;</td>
	    </tr>
	    <tr class="row1">
	    	<td width="25%">&nbsp;&nbsp;<?php echo _SOBI2_RECOUNT_LAST_DATE; ?>: <strong><?php echo $time; ?></strong> </td>
	    	<td>
	    		<button type="button" id="stbut" class="button" value="<?php echo _SOBI2_RECOUNT_NOW; ?>" onclick="startRecountCat()" >
	    			<p style="vertical-align:middle;">
		    			<img src="components/com_sobi2/images/toolbar/recount.png" alt="Recount&nbsp;Categories" width="32" height="32" style="vertical-align:middle" >
		    			<?php echo _SOBI2_RECOUNT_NOW; ?>
	    			</p>
	    		</button>
	    	</td>
	    </tr>
	    <tr class="row0">
	    	<td colspan="2" style="text-align:left;">
			<br/>
		    <iframe id="recframe" src="" style="border-style:none; width:100%; height:180px;"></iframe>
	    	</td>
	    </tr>
	   </table>
	<?php
	}
	function syscheck( &$config )
	{
	?>
    <script type="text/javascript">
    	function startSyscheck()
    	{
    		document.getElementById("syscheckframe").src = "index3.php?option=com_sobi2&task=dosyscheck&no_html=1";
    	}
	 </script>
	  <table class="SobiAdminForm" width="100%">
	    <tr class="row1">
	    	<th colspan="2" style="text-align:left;"><?php echo _SOBI2_MENU_GEN_DEB_REP; ?></th>
	    </tr>
	    <tr class="row0">
	    	<td width="20%">
	    		<input type="button" id="stbut" class="button" value="<?php echo _SOBI2_MENU_GEN_DEB_REP; ?>" onclick="startSyscheck()"/>
	    	</td>
	    	<td style="text-align:left;"><?php echo _SOBI2_MENU_GEN_SYSCHECK_EXPL;?></td>
	    </tr>
	    <tr class="row0">
	    	<td colspan="2" style="text-align:left;">
		    <iframe id="syscheckframe" src="" style="border-style:none; width:100%; height:1000px;"></iframe>
	    	</td>
	    </tr>
	   </table>
	<?php
	}

	/**
	 */
	function tplMan()
	{
		$config =& adminConfig::getInstance();
		?>
		<div style="padding:10px;">
			<table class="SobiAdminForm">
				<tr>
					<th><?php echo _SOBI2_CONFIG_TPL_PACK_UPLOAD; ?></th>
				</tr>
				<tr>
					<td>
					<input name="sobi2tpl" id="sobi2tpl" class="inputbox" type="file" size="50" maxlength="100000" accept="text/*"/>
					<input type="submit" class="button" name="<?php echo _SOBI2_CONFIG_LANGMAN_INSTALL_BT; ?>" value="<?php echo _SOBI2_CONFIG_LANGMAN_INSTALL_BT; ?>"/>
					</td>
				</tr>
			</table>
		<table class="SobiAdminList">
			<tr>
				<th width="10" align="center">#</th>
				<th width="20" align="center"></th>
				<th align="left"><?php echo _SOBI2_CONFIG_TPL_INSTALLED ;?></th>
				<th align="center"><?php echo _SOBI2_LANG_FOR_VER; ?></th>
				<th align="center"><?php echo _SOBI2_CONFIG_LANGMAN_LIST_CREATED; ?></th>
				<th align="center"><?php echo _SOBI2_PLUGINS_AUTHOR; ?></th>
				<th align="center"><?php echo _SOBI2_PLUGINS_AUTHOR_URL; ?></th>
				<th align="center"><?php echo _SOBI2_PLUGINS_DEF; ?></th>
				<th align="center">Details View</th>
				<th align="center">V-Card</th>
				<th align="center">Form</th>
			</tr>
			<?php
			    sobi2Config::import( 'includes|xml_domit|xml_domit_lite_parser', 'adm' );
			    sobi2Config::import( 'includes|adm.helper.class', 'adm' );
				$templates = sobi2AdmHelper::getTemplates();
				asort( $templates );
				if( count( $templates ) ) {
					$counter = 0;
					foreach( $templates as $name => $template ) {
						$fname = null;
						$counter++;
						$style = $counter%2 ? "row0" : "row1";
						$xml = false;
						if( $XMLfile = sobi2Config::translatePath( "templates|{$name}|{$name}", 'front', true, '.xml' ) ) {
							$xmlDoc = new DOMIT_Lite_Document();
							$xmlDoc->resolveErrors( true );
							$xmlDoc->loadXML( $XMLfile, false, true );
							$root = $xmlDoc->documentElement;
							if( $root->getTagName() == 'sobi2template' ) {
								$node 			= $root->getElementsByPath( 'version', 1 );
								if( $node ) {
									$version		= $node->getText();
								}
								$node 				= $root->getElementsByPath( 'author', 1 );
								if( $node ) {
									$author 		= $node->getText();
								}
								$node 				= $root->getElementsByPath( 'creationDate', 1 );
								if( $node ) {
									$creationDate 	= $node->getText();
								}
								$node 				= $root->getElementsByPath( 'authorEmail', 1 );
								if( $node ) {
									$authorEmail 	= $node->getText();
								}
								$node 				= $root->getElementsByPath( 'authorUrl', 1 );
								if( $node ) {
									$authorUrl 		= $node->getText();
								}
								$node 				= $root->getElementsByPath( 'description', 1 );
								if( $node ) {
									$description	= $node->getText();
								}
								$node 				= $root->getElementsByPath( 'name', 1 );
								if( $node ) {
									$fname			= $node->getText();
								}
								$node 				= $root->getElementsByPath( 'thumb', 1 );
								if( $node ) {
									$thumb 			= $node->getText();
								}
								$authorRealUrl 	= $authorUrl;
								if( !( strstr( $authorUrl, 'http://' ) ) ) {
									$authorRealUrl = 'http://'.$authorUrl;
								}
								$xml = true;
							}
						}
						$tname = isset( $fname ) && strlen( $fname ) ? $fname : $name;
						if( !$xml ) {
							$version = $authorUrl = $author = $creationDate = $authorEmail = 'undefinied';
							$authorRealUrl = $thumb = $description = null;
							if( $name == 'default' ) {
								$version = '1.0';
								$author = 'Sigsiu.NET';
								$authorUrl = 'http://www.Sigsiu.NET';
								$creationDate = '11.09.2006';
								$authorEmail = 'sobi@sigsiu.net';;
								$authorRealUrl = $thumb = $description = null;
							}
						}

						$details 	= $template[ 'details'] ? 'tick.png' : 'publish_x.png';
						$vc 		= $template[ 'vc'] 		? 'tick.png' : 'publish_x.png';
						$form 		= $template[ 'form']	? 'tick.png' : 'publish_x.png';
						$def		= ( $name == $config->defTemplate ) ? 'tick.png' : 'publish_x.png';
						$act		= ( $name == $config->defTemplate ) ? "<img src=\"images/{$def}\" style=\"border: none;\"/>" : "<a href=\"index2.php?option=com_sobi2&amp;task=setDefTpl&amp;tpl={$name}\">".sobiHTML::toolTip( addslashes( _SOBI2_SET_TPL_DEF_EXPL ), addslashes( _SOBI2_SET_TPL_DEF ), null, "administrator/images/{$def}", null, "index2.php?option=com_sobi2&amp;task=setDefTpl&amp;tpl={$name}", true )."</a>";

						if( $thumb && sobi2Config::translatePath(  "templates|{$name}|{$thumb}", 'front', true, '' ) ) {
							$i = htmlentities( "img src=\"{$config->liveSite}/components/com_sobi2/templates/{$name}/{$thumb}\"" );
							$i = "<br/><br/><{$i}/>";
							$description .= $i;
						}
						if( $description ) {
							$tname = sobiHTML::toolTip( addslashes( $description ), $tname, null, null, $tname );
						}
					?>
						<tr class="<?php echo $style; ?>">
							<td align="center">
								<?php if( $name != 'default' ) { ?>
									<input type="radio" name="tpl" value="<?php echo $name; ?>"/>
								<?php } ?>
							</td>
							<td align="center"></td>
							<td align="left">
								<?php echo $tname; ?>
							</td>
							<td align="center">
								<?php echo $version; ?>
							</td>
							<td align="center">
								<?php echo $creationDate; ?>
							</td>
							<td align="center">
								<?php if( strstr( $authorEmail, "@" ) ) {
									?><a href="mailto:<?php echo $authorEmail; ?>"><?php
									}
								?><?php echo $author; ?></a>
							</td>
							<td align="center">
								<?php if( $authorRealUrl ) { ?>
								<a href="<?php echo $authorRealUrl; ?>"><?php echo $authorUrl; ?></a>
								<?php
									}
									else {
										?><?php echo $authorUrl; ?><?php
									}
								?>
							</td>
							<td align="center"><?php echo $act; ?></td>
							<td align="center"><img src="images/<?php echo $details;?>" style="border: none;"/></td>
							<td align="center"><img src="images/<?php echo $vc;?>" style="border: none;"/></td>
							<td align="center"><img src="images/<?php echo $form;?>" style="border: none;"/></td>
						</tr>
					<?php
					}
				}
			?>
		</table>
		</div>
		<input type="hidden" name="boxchecked" value="999" />
  		<input type="hidden" name="task" value="installTpl"/>
  		<input type="hidden" name="returnTask" value="templates"/>
		<?php
	}
}
?>