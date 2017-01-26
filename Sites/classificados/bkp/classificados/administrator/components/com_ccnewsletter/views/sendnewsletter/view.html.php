<?php
/**
 * ccNewsletter
 * @author Chill Creations <info@chillcreations.com>
 * @link http://www.chillcreations.com
 * @license GNU/GPL
**/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view' );
class ccNewsletterViewsendNewsletter extends JView
{

	function display($tpl = null)
	{
		global $mainframe;
		// create the toolbar for use in the view
		JToolBarHelper::title( JText::_( 'CC_NEWSLETTER_TITLE') . ' - ' . JText::_( 'CC_SEND_NEWSLETTER_TITLE' ), 'ccnewsletter.png' );
		if ( $this->getLayout() != 'ccsend' )
		{
			//JToolBarHelper::custom('send_all', 'send', '', JText::_( 'CC_TOOL_SEND_NEWSLETTER'), false);
		//	JToolBarHelper::custom('send_batch_msg', 'send', '', JText::_( 'CC_TOOL_SEND_NEWSLETTER'), false);
			JToolBarHelper::custom('ccsend', 'send', '', JText::_( 'CC_TOOL_SEND_NEWSLETTER'), false);

			JToolBarHelper::custom('ccsendtesting', 'forward', '', JText::_( 'CC_TOOL_TEST_MESSAGE'), false);
			//JToolBarHelper::preferences('com_ccnewsletter', '500');
		}
		else
		{
			JToolBarHelper::cancel('cancel', JText::_('CC_BACK_TO_NEWSLETTER') );
		}
		// instantiate the model
		$newsletterModel =& $this->getModel();
		$newsletterDataid=$newsletterModel->getDataId();
		$id	= JRequest::getVar( 'id', '', 'get', 'string' );
		$sendid	= JRequest::getVar( 'id', '', 'post', 'string' );
		$this->_addCss();
		if(($id =="")&&($sendid == ""))
		{
			$select = $newsletterDataid->id;
		}
		elseif($id)
		{
			$select = $id;
		}
		elseif($sendid)
		{
			$select = $sendid;
		}
		// call the get data function of our model to load the data into a  local object
		$newsletterData=$newsletterModel->getData($select);
		// call the image tag convert function of our model and overwrite the body variable in our local object
		$newsletterData->body=$newsletterModel->convertImgTags($newsletterData->body);
		// call the backgroiund image convert function of our model and overwrite the background property of tables
		$newsletterData->body=$newsletterModel->convertBackgroundTags($newsletterData->body);
		// call the internal link convert function of our model and overwrite the internal link property of tables
		$newsletterData->body=$newsletterModel->convertInternalLink($newsletterData->body);

		//echo $newsletterData->body;


		//get all of the available newsletters to populate select list
		$available_newsletters=$newsletterModel->getAllNewsletters();

		// get parameters for displayin the form
		$params=$newsletterModel->getComponentParameters();
		$fromName = $params->get('fromName');
		$fromEmail = $params->get('fromEmail');
		$testEmail = $params->get('testEmailAddress');

		//create some js to submit our form if the user selects a different newsletter in the form
		$javascript = 'onchange="document.adminForm.submit();"';

		// load up data for use in the template
		$this->assignRef('lists', JHTML::_( 'select.genericlist', $available_newsletters, 'newsletterToSend',$javascript,'id','idname', $select ));
		$this->assignRef('fromName',$fromName);
		$this->assignRef('fromEmail',$fromEmail);
		$this->assignRef('testEmail',$testEmail);

		//$this->assignRef('newsletterForPreview',$current_select_val);
		$this->assignRef('newsletterForPreviewBody',$newsletterData);
		$this->assignRef('subject',$newsletterData->name);

		$_ccdata = $newsletterModel->get_ccdata();

		/* Get the component base directory */
		$adminDir = JPATH_ADMINISTRATOR .DS. 'components';
		$siteDir = JPATH_SITE .DS. 'components';
		$file = $adminDir.DS.'com_ccnewsletter'.DS.'ccnewsletter.xml';
		$xml = new JSimpleXML;
		$xml->loadFile($file);
		$xml = $xml->document;
		$c_version = $xml->version[0]->data();
		$c_name = $xml->name[0]->data();

		/* Check for New Version */
		$myReadAccess= new versionRead('http://www.chillcreations.com/versionnumbers.txt');
		if($data = $myReadAccess->getFileContents()) {
			$pieces = explode("\n", $data);
			foreach($pieces as $piece)
			{
				$small_pieces[] = explode(",", $piece);
			}
			$versionContent = "";
 			foreach( $small_pieces as $small_piece)
			{
  				if ($small_piece[0] == $c_name && $small_piece[1] > $c_version && trim($small_piece[3]) != 'none') {
					$versionContent ="<div style='font-weight:bold;text-align:center;color:#FF0000;'><a style='color:#FF0000;' href='".$small_piece[2]."' target='_blank'>". JText::_( 'ID_WARNING' ) . " " .JText::_( 'ID_NEW_VERSION' ) . " " . $small_piece[1]. " " .JText::_( 'ID_AVAIALBLE_DOWNLOAD' ) ."</a>";
					$versionContent .="<br/>".$small_piece[3]."</div>";
  				}
				else if ($small_piece[0] == $c_name && $small_piece[1] > $c_version && trim($small_piece[3]) == 'none') {
					$versionContent = "<div style='font-weight:bold;text-align:center;color:#FF0000;'><a style='color:#FF0000;' href='".$small_piece[2]."' target='_blank'>". JText::_( 'ID_WARNING' ) . " " .JText::_( 'ID_NEW_VERSION' ) . " " . $small_piece[1]. " " .JText::_( 'ID_AVAIALBLE_DOWNLOAD' ) ."</a></div>";
				}
			}
		}
		if(isset($versionContent) && $versionContent != "") {
			$this->assignRef('versionContent',	$versionContent);
		}
		$this->assignRef('version',		$c_version);
		$this->assignRef('name',		$c_name);

		$this->assignRef('ccdata', $_ccdata );
		parent::display($tpl);
	}
	function _addCss()
	{
	    $document =& JFactory::getDocument();
	    $document->addStyleSheet('components/com_ccnewsletter/assets/ccnewsleter.css');
	}
}


