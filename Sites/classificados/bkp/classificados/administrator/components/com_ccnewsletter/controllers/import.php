<?php
/**
* @package ccNewsletter
* @version 1.0.9
* @author  Chill Creations <info@chillcreations.com>
* @link    http://www.chillcreations.com
* @copyright Copyright (C) 2008 - 2010 Chill Creations-All rights reserved
* @license GNU/GPL, see LICENSE.php for full license.
* See COPYRIGHT.php for more copyright notices and details.

This file is part of ccNewsletter.
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
**/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.controller' );

// extend our main controller for the newsletter
class ccNewsletterControllerimport extends JController
{
	function __construct()
	{
		parent::__construct();
		// Register Extra tasks, in this case we are saying to treat add like edit;
	}
	function display()
	{
		JRequest::setVar( 'view', 'import');
		parent::display();
	}
	 function doExport()
	 {
		global $mainframe;
		$database =& JFactory::getDBO();
		$output_file="export.csv";
		$query = "SELECT * FROM  #__ccnewsletter_subscribers ORDER BY id";
		$database->setquery($query);
		$rows = $database->loadObjectList();
		$result = count($rows);
		$output = '';
		for ($i = 0; $i < $result; $i++)
		{
			$row = & $rows[$i];
			$output .= '"", ';
			$output .= '"'.$row->name.'", ';
			$output .= '"'.$row->email.'", ';
			$output .= '"'.$row->plainText.'", ';
			$output .= '"'.$row->enabled.'", ';
			$output .= '"'.$row->sdate.'", ';
			$output .= '"'.$row->lastSentNewsletter.'" ';
			if($result != ($i -1))
			{
				$output .="\n";
			}
		}
		// Open a new output file
		$file = fopen ($output_file,'w');
		// Put contents of $output into the $file
		fputs($file, $output);
		fclose($file);
		// This line will stream the file to the user rather than spray it across the screen
		header("Content-type: application/octet-stream");
		// Internet Explorer support
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-disposition:  attachment; filename=bu_ccnewsletter_subscribers_" .
		date("ymd").".csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $output;
		exit();
	}
	function importfromdb()
	{
			$selection = JRequest::getVar( 'selection', 'post', 'string' );
			$deletesubs = JRequest::getVar( 'deletesubs', 'post', 'string' );
			$my	=& JFactory::getUser();
			$database =& JFactory::getDBO();
			$msg = JText::_( 'CC_IMPORTED_SUCCESSFULLY' );

			if($deletesubs== "deletesubs")
			{
				$query = "DELETE  FROM #__ccnewsletter_subscribers";
				$database->setQuery( $query );
				$database->query();
			}
			if($selection == "yanc")
			{
				$database->setQuery( "SELECT * FROM #__yanc_subscribers" );
				$subscribers = $database->loadObjectList();
				$error = $database->getErrorMsg();
				foreach($subscribers as $subscriber)
				{
					$subscriber_state = $subscriber->state;
					if($subscriber->uid == 0)
					{
						$subscriber_name = $subscriber->name;
						$subscriber_email = $subscriber->email;
					}
					else
					{
						$query = "SELECT * FROM #__users WHERE id=".$subscriber->uid;
						$database->setquery($query);
						$row = $database->loadObject();
						$subscriber_name = $row->name;
						$subscriber_email = $row->email;
					}
					$query = "SELECT count(*) FROM #__ccnewsletter_subscribers WHERE email='".$subscriber_email."'";
					$database->setquery($query);
					$count = $database->loadResult();
					if($count<1)
					{
						$query = "INSERT INTO #__ccnewsletter_subscribers (`id`, `name`, `email`, `plainText`, `enabled`, `sdate`) VALUES ( '', '$subscriber_name', '$subscriber_email', '', '$subscriber_state', '')";
						$database->setQuery( $query );
						$database->query();
					}
				}
			}
			if($selection == "acajoom")
			{
					$database->setQuery( "SELECT * FROM #__acajoom_subscribers" );
					$subscribers = $database->loadObjectList();
					$error = $database->getErrorMsg();
					foreach($subscribers as $subscriber)
					{
						$subscriber_email = $subscriber->email;
						$subscriber_state = $subscriber->confirmed;
						$subscriber_name = $subscriber->name;
						$subscriber_date =  $subscriber->subscribe_date;
						$query = "SELECT count(*) FROM #__ccnewsletter_subscribers WHERE email='".$subscriber_email."'";
						$database->setquery($query);
						$count = $database->loadResult();
						if($count<1)
						{
							$query = "INSERT INTO #__ccnewsletter_subscribers (`id`, `name`, `email`, `plainText`, `enabled`, `sdate`) VALUES ( '', '$subscriber_name', '$subscriber_email', '', '$subscriber_state', '$subscriber_date')";
							$database->setQuery( $query );
							$database->query();
						}
					}
			}
			if($selection == "vmod")
			{
					$database->setQuery( "SELECT * FROM #__vemod_news_mailer_subs" );
					$subscribers = $database->loadObjectList();
					$error = $database->getErrorMsg();
					foreach($subscribers as $subscriber)
					{
						$query = "SELECT * FROM #__users WHERE id=".$subscriber->userid;
						$database->setquery($query);
						$row = $database->loadObject();
						$subscriber_name = $row->name;
						$subscriber_email = $row->email;
						$subscriber_date =  $row->registerDate;
						$query = "SELECT count(*) FROM #__ccnewsletter_subscribers WHERE email='".$subscriber_email."'";
						$database->setquery($query);
						$total = $database->loadResult();
						if($total==0)
						{
							$query = "INSERT INTO #__ccnewsletter_subscribers (`id`, `name`, `email`, `plainText`, `enabled`, `sdate`) VALUES ( '', '$subscriber_name', '$subscriber_email', '', 1, '$subscriber_date')";
							$database->setQuery( $query );
							$database->query();
						}
					}
			}
			if($selection == "communicator")
			{
				$database->setQuery( "SELECT * FROM #__communicator_subscribers" );
				$subscribers = $database->loadObjectList();
				$error = $database->getErrorMsg();
				foreach($subscribers as $subscriber)
				{
					$subscriber_email = $subscriber->subscriber_email;
					$subscriber_state = $subscriber->confirmed;
					$subscriber_name = $subscriber->subscriber_name;
					$subscriber_date =  $subscriber->subscribe_date;
					$query = "SELECT count(*) FROM #__ccnewsletter_subscribers WHERE email='".$subscriber_email."'";
					$database->setquery($query);
					$count = $database->loadResult();
					if($count<1)
					{
						$query = "INSERT INTO #__ccnewsletter_subscribers (`id`, `name`, `email`, `plainText`, `enabled`, `sdate`) VALUES ( '', '$subscriber_name', '$subscriber_email', '', '$subscriber_state', '$subscriber_date')";
						$database->setQuery( $query );
						$database->query();
					}
				}
			}
			if($selection == "letterman")
			{
				$database->setQuery( "SELECT * FROM #__letterman_subscribers" );
				$subscribers = $database->loadObjectList();
				$error = $database->getErrorMsg();
				foreach($subscribers as $subscriber)
				{
					$subscriber_email = $subscriber->subscriber_email;
					$subscriber_state = $subscriber->confirmed;
					$subscriber_name = $subscriber->subscriber_name;
					$subscriber_date =  $subscriber->subscribe_date;
					$query = "SELECT count(*) FROM #__ccnewsletter_subscribers WHERE email='".$subscriber_email."'";
					$database->setquery($query);
					$count = $database->loadResult();
					if($count<1)
					{
						$query = "INSERT INTO #__ccnewsletter_subscribers (`id`, `name`, `email`, `plainText`, `enabled`, `sdate`) VALUES ( '', '$subscriber_name', '$subscriber_email', '', '$subscriber_state', '$subscriber_date')";
						$database->setQuery( $query );
						$database->query();
					}
				}
			}
			$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import', $msg );
	 }

	function emailonly()
	{
		$deletesubsfromfile = JRequest::getVar( 'deletesubsfromfile', 'post', 'string' );
		$database =& JFactory::getDBO();
		$textarea = JRequest::getVar( 'emailtext', '', '', 'string' );

		if($textarea)
		{
			$emailids = explode(",", $textarea);
			$totalcount = count($emailids);
			if($deletesubsfromfile=="deletesubsfromfile")
			{
				if($totalcount>0)
				{
					$query = "DELETE  FROM #__ccnewsletter_subscribers";
					$database->setQuery( $query );
					$database->query();
				}
			}
			for($i=0; $i < $totalcount;$i++)
			{
					$emailids[$i] = trim($emailids[$i]);
					jimport('joomla.mail.helper');
					$valid = JMailHelper :: isEmailAddress($emailids[$i]);

					if($valid)
					{
						$query = "SELECT count(*) FROM #__ccnewsletter_subscribers WHERE email='".$emailids[$i]."'";
						$database->setquery($query);
						$count = $database->loadResult();
						if($count<1)
						{
							if($emailids[$i])
							{
								$query = "INSERT INTO #__ccnewsletter_subscribers (`id`, `name`, `email`, `plainText`, `enabled`, `sdate`) VALUES ( '', '', '$emailids[$i]', '', '1', '')";
								$database->setQuery( $query );
								$database->query();
								$lastid = $database->insertid();
							}
						}
					}
			}
		}
		if($lastid)
		{
			$msg = JText::_( 'CC_IMPORT_EMAIL_SUCCESSFULLY' );
			$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import', $msg );
		}
		else
		{
			JError::raiseWarning(100, JText::_('CC_IMPORT_EMAIL_ERR'));
			$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import' );
		}
	}

	function importtxtcsv()
	{
		$deletesubsfromfile = JRequest::getVar( 'deletesubsfromfile', 'post', 'string' );
		$fieldseparator = JRequest::getVar( 'delimiter', '', '', 'string' );
		$lineseparator = "\n";
		$database =& JFactory::getDBO();
		$textarea = JRequest::getVar( 'emailtext', '', '', 'string' );

	  	$post	= JRequest::get( 'post' );
		$import_file = JRequest::getVar( 'importfile', '', 'files', 'array' );
		$deletesubsfromfile = JRequest::getVar( 'deletesubsfromfile', 'post', 'string' );
		$csvfile = $import_file['tmp_name'];
		$msg = JText::_( 'CC_IMPORT_SUCCESSFULLY' );
		jimport('joomla.filesystem.file');
		$addauto = 0;
		$save = 0;
		$outputfile = "output.sql";
		$format = strtolower(JFile::getExt($import_file['name']));
		if($csvfile=="")
		{
			JError::raiseWarning(100, JText::_('CC_NO_FILE_WARNING'));
			$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
		}
	 	elseif($format != "txt")
		{
			$err = true;
			JError::raiseWarning(100, JText::_('CC_ERROR_NOT_CORRECT_FORMAT'));
			$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
		}
		else
		{
			if(!file_exists($csvfile))
			{
		    echo "File not found. Make sure you specified the correct path.\n";
		    exit;
		}
		$file = fopen($csvfile,"r");
			if(!$file)
			{
		    echo "Error opening data file.\n";
		    exit;
		}
		$size = filesize($csvfile);
			if(!$size)
			{
		    echo "File is empty.\n";
		    exit;
		}

		$line = fgetcsv($file); // default : delimiter = comma, enclosure = double quote, escape character = backslash
			switch ( count($line) )
			{
				case 1:
					// assume e-mail addresses only
					$pos = strpos( $line[0], '@' );
					if ( !$pos )
					{
						// Ok : maybe the first row was a column title : let's try the next line.
						$line = fgetcsv($file);
						$pos = strpos( $line[0], '@' );
						if ( !$pos )
						{
							// error : and e-mail address must contain an @
							JError::raiseWarning(100, JText::_('CC_INVALID_FORMAT'));
							$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
							return ;
						}
					}
					if($deletesubsfromfile=="deletesubsfromfile")
					{
						$query = "DELETE  FROM #__ccnewsletter_subscribers";
						$database->setQuery( $query );
						$database->query();
					}
					while ( $line = fgetcsv($file) )
					{
						 $query = "SELECT count(*) FROM #__ccnewsletter_subscribers WHERE email=".$database->quote($line[0]);
						 $database->setquery($query);
						 $count = $database->loadResult();
						 $email_id = str_replace("'", "", $database->quote($line[0]));

						if($count<1)
						{
							jimport('joomla.mail.helper');
							$valid = JMailHelper :: isEmailAddress(trim($email_id));
							if($valid)
							{
								$query = "INSERT into #__ccnewsletter_subscribers (`name`, `email`) values('', ".$database->quote($line[0]).")";
								$database->setQuery( $query );
								$database->query();
								$lastid = $database->insertid();
							}
						}
					}
					if($lastid)
					{
						$msg = JText::_( 'CC_IMPORT_SUCCESSFULLY' );
						$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import', $msg );
					}
					else
					{
						JError::raiseWarning(100, JText::_('CC_IMPORT_ERROR'));
						$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import' );
					}
				break;

				case 2:
					// assume name and e-mail addresses only
					$pos0 = strpos( $line[0], '@' );
					$pos1 = strpos( $line[1], '@' );
					if ( !$pos0 && !$pos1 )
					{
						$line = fgetcsv($file);
						$pos0 = strpos( $line[0], '@' );
						$pos1 = strpos( $line[1], '@' );
						if ( !$pos0 && !$pos1 )
						{
							JError::raiseWarning(100, JText::_('CC_INVALID_FORMAT'));
							$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
							return ;
						}
						else
						{
							if ( $pos0 )
							{
								$email_field = 0;
								$name_field  = 1;
							}
							else
							{
								$email_field = 1;
								$name_field  = 0;
							}
						}
					}
					else
					{
						if ( $pos0 )
						{
							$email_field = 0;
							$name_field  = 1;
						}
						else
						{
							$email_field = 1;
							$name_field  = 0;
						}
					}
					if($deletesubsfromfile=="deletesubsfromfile")
					{
						$query = "DELETE  FROM #__ccnewsletter_subscribers";
						$database->setQuery( $query );
						$database->query();
					}
					while ( $line = fgetcsv($file) )
					{
						 $query = "SELECT count(*) FROM #__ccnewsletter_subscribers WHERE email=".$database->quote($line[$email_field]);
						 $database->setquery($query);
						 $count = $database->loadResult();
						if($count<1)
						{
							$email_id = str_replace("'", "",$database->quote($line[$email_field]));
							jimport('joomla.mail.helper');
							$valid = JMailHelper :: isEmailAddress(trim($email_id));
							if($valid)
							{
								$query = "INSERT into #__ccnewsletter_subscribers (`name`, `email`) values(".$database->quote($line[$name_field]).", ".$database->quote($line[$email_field]).")";
								$database->setQuery( $query );
								$database->query();
								$lastid = $database->insertid();
							}
						}
					}
				if($lastid)
				{
					$msg = JText::_( 'CC_IMPORT_SUCCESSFULLY' );
					$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import', $msg );
				}
				else
				{
					JError::raiseWarning(100, JText::_('CC_IMPORT_ERROR'));
					$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import' );
				}
				break;
				case 7:
				$fieldseparator = ",";
				$lineseparator = "\n";
				$database =& JFactory::getDBO();

				$post	= JRequest::get( 'post' );
				$import_file = JRequest::getVar( 'importfile', '', 'files', 'array' );
				$deletesubsfromfile = JRequest::getVar( 'deletesubsfromfile', 'post', 'string' );
				$csvfile = $import_file['tmp_name'];
				$msg = JText::_( 'CC_IMPORT_SUCCESSFULLY' );
				jimport('joomla.filesystem.file');
				$addauto = 0;
				$save = 0;
				$outputfile = "output.sql";
				$format = strtolower(JFile::getExt($import_file['name']));
				if($csvfile=="")
				{
					JError::raiseWarning(100, JText::_('CC_NO_FILE_WARNING'));
					$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
				}
			 	elseif($format != "txt")
				{
					$err = true;
					JError::raiseWarning(100, JText::_('CC_ERROR_NOT_CORRECT_FORMAT'));
					$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
				}
				else
				{
				if(!file_exists($csvfile)) {
				    echo "File not found. Make sure you specified the correct path.\n";
				    exit;
				}
				$file = fopen($csvfile,"r");
				if(!$file) {
				    echo "Error opening data file.\n";
				    exit;
				}
				$size = filesize($csvfile);
				if(!$size) {
				    echo "File is empty.\n";
				    exit;
				}
				$csvcontent = fread($file,$size);
				fclose($file);
				$lines = 0;
				$queries = "";
				$linearray = array();
				$import = str_replace(array("\r\n","\r"),"\n",$csvcontent);
				$array = explode("\n", $import);
				foreach ($array AS $row)
				{
					$row = trim($row);
					if (empty($row))
					{
						continue;
					}
					$values = explode(',', $row);
					if(count($values) != 7)
					{
						JError::raiseWarning(100, JText::_('CC_INVALID_FORMAT'));
						$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
						return ;
					}
					else if(count($values) == 7)
					{
						if($deletesubsfromfile=="deletesubsfromfile")
						{
							$query = "DELETE  FROM #__ccnewsletter_subscribers";
							$database->setQuery( $query );
							$database->query();
						}
					}
				}
				foreach(split($lineseparator,$csvcontent) as $line)
				{
					$lines++;
					$line = trim($line,"\t");
				   	$line = str_replace("\r","",$line);
				    $line = str_replace("'","\'",$line);
				    $linearray = explode($fieldseparator,$line);
				    $linemysql = implode(',',$linearray);
				    if($line != "") {
				    	 $emailvalue = $linearray[2];
				    	 $emailvalue = str_replace('"', "",$emailvalue );
						 $query = "SELECT count(*) FROM #__ccnewsletter_subscribers WHERE email='".$emailvalue."'";
						 $database->setquery($query);
						 $count = $database->loadResult();
						if($count<1)
						{
							jimport('joomla.mail.helper');
							$valid = JMailHelper :: isEmailAddress(trim($emailvalue));
							if($valid)
							{
							    if($addauto) {
							        $query = "INSERT into #__ccnewsletter_subscribers values('','$linemysql');";
							    }
							    else {
								    $query = "INSERT into #__ccnewsletter_subscribers  values(".$linemysql.");";
							    }
							    $queries .= $query . "\n";
						    	$database->setQuery( $query );
								$database->query();
								$lastid = $database->insertid();
							}
						}
				    }
				}
				if($save) {
				    if(!is_writable($outputfile)) {
				        echo "File is not writable, check permissions.\n";
				    }
				    else {
				        $file2 = fopen($outputfile,"w");

				        if(!$file2) {
				            echo "Error writing to the output file.\n";
				        }
				        else {
				            fwrite($file2,$queries);
				            fclose($file2);
				        }
				    }
				}
				if($lastid)
				{
					$msg = JText::_( 'CC_IMPORT_SUCCESSFULLY' );
					$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import', $msg );
				}
				else
				{
					JError::raiseWarning(100, JText::_('CC_IMPORT_ERROR'));
					$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import' );
				}
				}
				break;
				default:
					JError::raiseWarning(100, JText::_('CC_INVALID_FORMAT'));
					$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
					return ;
				break;
			}
		}
	}
	function importcsv()
	{
		$fieldseparator = ",";
		$lineseparator = "\n";
		$database =& JFactory::getDBO();

		$post	= JRequest::get( 'post' );
		$import_file = JRequest::getVar( 'importfile', '', 'files', 'array' );
		$deletesubsfromfile = JRequest::getVar( 'deletesubsfromfile', 'post', 'string' );
		$csvfile = $import_file['tmp_name'];
		$msg = JText::_( 'CC_IMPORT_SUCCESSFULLY' );
		jimport('joomla.filesystem.file');
		$addauto = 0;
		$save = 0;
		$outputfile = "output.sql";
		$format = strtolower(JFile::getExt($import_file['name']));
		if($csvfile=="")
		{
			JError::raiseWarning(100, JText::_('CC_NO_FILE_WARNING'));
			$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
		}
	 	elseif($format != "csv")
		{
			$err = true;
			JError::raiseWarning(100, JText::_('CC_ERROR_NOT_CORRECT_FORMAT'));
			$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
		}
		else
		{
			if(!file_exists($csvfile))
			{
		    echo "File not found. Make sure you specified the correct path.\n";
		    exit;
		}
		$file = fopen($csvfile,"r");
			if(!$file)
			{
		    echo "Error opening data file.\n";
		    exit;
		}
		$size = filesize($csvfile);
			if(!$size)
			{
		    echo "File is empty.\n";
		    exit;
		}

		$line = fgetcsv($file); // default : delimiter = comma, enclosure = double quote, escape character = backslash
			switch ( count($line) )
			{
				case 1:
					// assume e-mail addresses only
					$pos = strpos( $line[0], '@' );
					if ( !$pos )
					{
						// Ok : maybe the first row was a column title : let's try the next line.
						$line = fgetcsv($file);
						$pos = strpos( $line[0], '@' );
						if ( !$pos )
						{
							// error : and e-mail address must contain an @
							JError::raiseWarning(100, JText::_('CC_INVALID_FORMAT'));
							$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
							return ;
						}
					}
					if($deletesubsfromfile=="deletesubsfromfile")
					{
						$query = "DELETE  FROM #__ccnewsletter_subscribers";
						$database->setQuery( $query );
						$database->query();
					}
					while ( $line = fgetcsv($file) )
					{
						 $query = "SELECT count(*) FROM #__ccnewsletter_subscribers WHERE email=".$database->quote($line[0]);
						 $database->setquery($query);
						 $count = $database->loadResult();

						if($count<1)
						{
							$email_id = str_replace("'", "", $database->quote($line[0]));
							jimport('joomla.mail.helper');
							$valid = JMailHelper :: isEmailAddress(trim($email_id));
							if($valid)
							{
								$query = "INSERT into #__ccnewsletter_subscribers (`name`, `email`) values('', ".$database->quote($line[0]).")";
								$database->setQuery( $query );
								$database->query();
								$lastid = $database->insertid();
							}
						}
					}
					if($lastid)
					{
						$msg = JText::_( 'CC_IMPORT_SUCCESSFULLY' );
						$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import', $msg );
					}
					else
					{
						JError::raiseWarning(100, JText::_('CC_IMPORT_ERROR'));
						$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import' );
					}
				break;

				case 2:
					// assume name and e-mail addresses only
					$pos0 = strpos( $line[0], '@' );
					$pos1 = strpos( $line[1], '@' );
					if ( !$pos0 && !$pos1 )
					{
						$line = fgetcsv($file);
						$pos0 = strpos( $line[0], '@' );
						$pos1 = strpos( $line[1], '@' );
						if ( !$pos0 && !$pos1 )
						{
							JError::raiseWarning(100, JText::_('CC_INVALID_FORMAT'));
							$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
							return ;
						}
						else
						{
							if ( $pos0 )
							{
								$email_field = 0;
								$name_field  = 1;
							}
							else
							{
								$email_field = 1;
								$name_field  = 0;
							}
						}
					}
					else
					{
						if ( $pos0 )
						{
							$email_field = 0;
							$name_field  = 1;
						}
						else
						{
							$email_field = 1;
							$name_field  = 0;
						}
					}
					if($deletesubsfromfile=="deletesubsfromfile")
					{
						$query = "DELETE  FROM #__ccnewsletter_subscribers";
						$database->setQuery( $query );
						$database->query();
					}
					while ( $line = fgetcsv($file) )
					{
						 $query = "SELECT count(*) FROM #__ccnewsletter_subscribers WHERE email=".$database->quote($line[$email_field]);
						 $database->setquery($query);
						 $count = $database->loadResult();
						if($count<1)
						{
							$email_id = str_replace("'", "", $database->quote($line[$email_field]));
							jimport('joomla.mail.helper');
							$valid = JMailHelper :: isEmailAddress(trim($email_id));
							if($valid)
							{
								$query = "INSERT into #__ccnewsletter_subscribers (`name`, `email`) values(".$database->quote($line[$name_field]).", ".$database->quote($line[$email_field]).")";
								$database->setQuery( $query );
								$database->query();
								$lastid = $database->insertid();
							}
						}
					}
				if($lastid)
				{
					$msg = JText::_( 'CC_IMPORT_SUCCESSFULLY' );
					$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import', $msg );
				}
				else
				{
					JError::raiseWarning(100, JText::_('CC_IMPORT_ERROR'));
					$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import' );
				}
				break;
				case 7:
				$fieldseparator = ",";
				$lineseparator = "\n";
				$database =& JFactory::getDBO();

				$post	= JRequest::get( 'post' );
				$import_file = JRequest::getVar( 'importfile', '', 'files', 'array' );
				$deletesubsfromfile = JRequest::getVar( 'deletesubsfromfile', 'post', 'string' );
				$csvfile = $import_file['tmp_name'];
				$msg = JText::_( 'CC_IMPORT_SUCCESSFULLY' );
				jimport('joomla.filesystem.file');
				$addauto = 0;
				$save = 0;
				$outputfile = "output.sql";
				$format = strtolower(JFile::getExt($import_file['name']));
				if($csvfile=="")
				{
					JError::raiseWarning(100, JText::_('CC_NO_FILE_WARNING'));
					$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
				}
			 	elseif($format != "csv")
				{
					$err = true;
					JError::raiseWarning(100, JText::_('CC_ERROR_NOT_CORRECT_FORMAT'));
					$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
				}
				else
				{
				if(!file_exists($csvfile)) {
				    echo "File not found. Make sure you specified the correct path.\n";
				    exit;
				}
				$file = fopen($csvfile,"r");
				if(!$file) {
				    echo "Error opening data file.\n";
				    exit;
				}
				$size = filesize($csvfile);
				if(!$size) {
				    echo "File is empty.\n";
				    exit;
				}
				$csvcontent = fread($file,$size);
				fclose($file);
				$lines = 0;
				$queries = "";
				$linearray = array();
				$import = str_replace(array("\r\n","\r"),"\n",$csvcontent);
				$array = explode("\n", $import);
				foreach ($array AS $row)
				{
					$row = trim($row);
					if (empty($row))
					{
						continue;
					}
					$values = explode(',', $row);
					if(count($values) != 7)
					{
						JError::raiseWarning(100, JText::_('CC_INVALID_FORMAT'));
						$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
						return ;
					}
					else if(count($values) == 7)
					{
						if($deletesubsfromfile=="deletesubsfromfile")
						{
							$query = "DELETE  FROM #__ccnewsletter_subscribers";
							$database->setQuery( $query );
							$database->query();
						}
					}
				}
				foreach(split($lineseparator,$csvcontent) as $line)
				{
					$lines++;
					$line = trim($line,"\t");
				   	$line = str_replace("\r","",$line);
				    $line = str_replace("'","\'",$line);
				    $linearray = explode($fieldseparator,$line);
				    $linemysql = implode(',',$linearray);
				    if($line != "") {
				    	 $emailvalue = $linearray[2];
				    	 $emailvalue = str_replace('"', "",$emailvalue );
				    	 $emailvalue = trim($emailvalue);
						 $query = "SELECT count(*) FROM #__ccnewsletter_subscribers WHERE email='".$emailvalue."'";
						 $database->setquery($query);
						 $count = $database->loadResult();
						if($count<1)
						{
							jimport('joomla.mail.helper');
							$valid = JMailHelper :: isEmailAddress(trim($emailvalue));

							if($valid)
							{
							    if($addauto) {
							        $query = "INSERT into #__ccnewsletter_subscribers values('','$linemysql');";
							    }
							    else {
								    $query = "INSERT into #__ccnewsletter_subscribers  values(".$linemysql.");";
							    }
							    $queries .= $query . "\n";
						    	$database->setQuery( $query );
								$database->query();
								$lastid = $database->insertid();
							}
						}
				    }
				}
				if($save) {
				    if(!is_writable($outputfile)) {
				        echo "File is not writable, check permissions.\n";
				    }
				    else {
				        $file2 = fopen($outputfile,"w");

				        if(!$file2) {
				            echo "Error writing to the output file.\n";
				        }
				        else {
				            fwrite($file2,$queries);
				            fclose($file2);
				        }
				    }
				}
				if($lastid)
				{
					$msg = JText::_( 'CC_IMPORT_SUCCESSFULLY' );
					$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import', $msg );
				}
				else
				{
					JError::raiseWarning(100, JText::_('CC_IMPORT_ERROR'));
					$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import' );
				}
			}
			break;
			default:
				JError::raiseWarning(100, JText::_('CC_INVALID_FORMAT'));
				$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
				return ;
			break;
			}
		}
	}
	function importxml()
	{
		global $mainframe;
		$post	= JRequest::get( 'post' );
		$import_file = JRequest::getVar( 'importfile', '', 'files', 'array' );
		$deletesubsfromfile = JRequest::getVar( 'deletesubsfromfile', 'post', 'string' );
		$xmlfile = $import_file['tmp_name'];
		jimport('joomla.filesystem.file');
		$format = strtolower(JFile::getExt($import_file['name']));
		if($xmlfile=="")
		{
			JError::raiseWarning(100, JText::_('CC_NO_FILE_WARNING'));
			$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
		}
		elseif($format != "xml")
		{
			$err = true;
			JError::raiseWarning(100, JText::_('CC_ERROR_NOT_CORRECT_FORMAT'));
			$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
		}
		else
		{
		$database =& JFactory::getDBO();
		$xml = new JSimpleXML;
		$csvfile = $import_file['tmp_name'];
  		$xml->loadFile($csvfile);
  		if($deletesubsfromfile=="deletesubsfromfile")
		{
				$query = "DELETE  FROM #__ccnewsletter_subscribers";
				$database->setQuery( $query );
				$database->query();
		}
 		$xml = $xml->document;
		$i = 0;

		foreach( $xml->subscriber as $file )
		{
		/*	echo $xml->subscriber[$i]->name[0]->data();
			echo " - " . $xml->subscriber[$i]->email[0]->data();
			echo " - " . $xml->subscriber[$i]->confirmed[0]->data();
			echo " - " . $xml->subscriber[$i]->subscribe_date[0]->data();

			echo "<br/>";
		*/

			$query = "SELECT count(*) FROM #__ccnewsletter_subscribers WHERE email='".$xml->subscriber[$i]->email[0]->data()."'";
			$database->setquery($query);
			$count = $database->loadResult();
			if($count<1)
			{
				$query = "INSERT INTO #__ccnewsletter_subscribers values ('', '".$xml->subscriber[$i]->name[0]->data()."', '".$xml->subscriber[$i]->email[0]->data()."', '0', '".$xml->subscriber[$i]->confirmed[0]->data()."', '".$xml->subscriber[$i]->subscribe_date[0]->data()."', '')";
				$database->setQuery( $query );
				$database->query();
				$msg = JText::_( 'CC_IMPORT_SUCCESSFULLY' );
			}
			$i++;
	 	}
		$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import', $msg );
		}
	}

	function importacajoomacsv()
	{
		$fieldseparator = ",";
		$lineseparator = "\n";
		$database =& JFactory::getDBO();
		$post	= JRequest::get( 'post' );
		$import_file = JRequest::getVar( 'importfile', '', 'files', 'array' );
		$deletesubsfromfile = JRequest::getVar( 'deletesubsfromfile', 'post', 'string' );
		$csvfile = $import_file['tmp_name'];
		jimport('joomla.filesystem.file');
		$addauto = 0;
		$save = 0;
		$outputfile = "output.sql";
		$format = strtolower(JFile::getExt($import_file['name']));
		if($csvfile=="")
		{
			JError::raiseWarning(100, JText::_('CC_NO_FILE_WARNING'));
			$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
		}
	 	elseif($format != "csv")
		{
			$err = true;
			JError::raiseWarning(100, JText::_('CC_ERROR_NOT_CORRECT_FORMAT'));
			$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import');
		}
		else
		{

			if(!file_exists($csvfile))
			{
			    echo "File not found. Make sure you specified the correct path.\n";
			    exit;
			}

			$file = fopen($csvfile,"r");
			if(!$file)
			{
			    echo "Error opening data file.\n";
			    exit;
			}
			$size = filesize($csvfile);
			if(!$size)
			{
			    echo "File is empty.\n";
			    exit;
			}
			$csvcontent = fread($file,$size);
			fclose($file);

			//$import = file_get_contents($path . $filename);
			$import = str_replace(array("\r\n","\r"),"\n",$csvcontent);
			$array = explode("\n", $import);
			if($deletesubsfromfile=="deletesubsfromfile")
			{
				if (sizeof($array) > 0)
				{
					foreach ($array AS $row)
					{
						$row = trim($row);
						$values = explode(',', $row);
						if(count($values) == 4)
						{
						$query = "DELETE  FROM #__ccnewsletter_subscribers";
						$database->setQuery( $query );
						$database->query();
						}
					}
				}
			}

			if (sizeof($array) > 0)
			{
				 	foreach ($array AS $row)
					{
						$row = trim($row);
						if (empty($row))
						{
							continue;
						}
						$values = explode(',', $row);
						if(count($values) != 4)
						{
							JError::raiseWarning(100, JText::_('CC_INVALID_FORMAT'));
							$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import' );
							return;
						}
						$values[0] = trim($values[0]);
						$values[1] = trim($values[1]);

						echo $values[0];
						echo $values[1];
						if ( isset($values[1]) )
						{
							$valid = ccNewsletterControllerimport::validEmail($values[1]);
							if (!$valid) {
								continue;
							}
							else
							{
					 			 $subscribername = addslashes($values[0]);
					 			 $subscriberemail = $values[1];
					 			 $subscriberreceive_html  = (empty($values[2])) ? '0' : '1';
					 			 $subscriberconfirmed = (empty($values[3])) ? '0' : '1';
					 			 $date = date("Y-m-d H:i:s");
					 			 $query = "SELECT count(*) FROM #__ccnewsletter_subscribers WHERE email='".$subscriberemail."'";
								 $database->setquery($query);
								 $count = $database->loadResult();
								if($count<1)
								{
						 			 $query = "INSERT INTO `#__ccnewsletter_subscribers` (`id`,`name` , `email`, `plainText` , `enabled`, `sdate` ";
						 			 $query .= ") VALUES (" .
						 			 " '' , " .
									 " '$subscribername', " .
									 " '$subscriberemail', " .
									 " '$subscriberreceive_html', " .
									 " '$subscriberconfirmed' , " .
									 " '$date' ";
									 $query .= ")" ;
									$database->setQuery($query);
									$database->query();
									$lastid = $database->insertid();
								}
							}
						}
					}
					if($lastid)
					{
						$msg = JText::_( 'CC_IMPORT_SUCCESSFULLY' );
						$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import', $msg );
					}
					else
					{
						$msg = JText::_( 'CC_IMPORT_ERROR' );
						$this->setRedirect( 'index.php?option=com_ccnewsletter&controller=import', $msg );
					}
				}
			}
		}
	 function validEmail($email)
	 {
		return preg_match("/^[a-z0-9]([a-z0-9_\-\.])*@([a-z0-9\-]+\.)+[a-z]{2,7}$/i", $email);
	 }
}
?>
