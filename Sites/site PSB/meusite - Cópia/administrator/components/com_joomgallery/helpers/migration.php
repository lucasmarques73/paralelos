<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-1.5/JG/trunk/administrator/components/com_joomgallery/helpers/migration.php $
// $Id: migration.php 2566 2010-11-03 21:10:42Z mab $
/****************************************************************************************\
**   JoomGallery  1.5.6                                                                 **
**   By: JoomGallery::ProjectTeam                                                       **
**   Copyright (C) 2008 - 2010  JoomGallery::ProjectTeam                                **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                            **
**   Released under GNU GPL Public License                                              **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look                       **
**   at administrator/components/com_joomgallery/LICENSE.TXT                            **
\****************************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * Helper class for migration procedures
 *
 * @abstract
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomMigration
{
  /**
   * @TODO: Variable comments
   */
  var $max_execution_time;
  var $starttime;
  var $maxtime;
  var $logfile;
  var $logfilename;
  var $_db;
  var $_mainframe;
  var $_config;
  var $migration;

  /**
   * Constructor
   *
   * @access  protected
   * @return  void
   * @since   1.5.0
   */
  function __construct($action)
  {
    $this->_mainframe = & JFactory::getApplication('administrator');
    $this->_db        = & JFactory::getDBO();
    $this->_config    = & JoomConfig::getInstance();

    $this->logfilename = 'migration.log.txt';

    // Check the maximum execution time of the script
    // Set secure setting of the real execution time
    $max_execution_time = @ini_get('max_execution_time');

    // Try to set the max execution time to 60s if lower than
    // If not succesful the return value will be the old time, so use this
    if($max_execution_time < 60)
    {
      @ini_set('max_execution_time','60');
      $max_execution_time = @ini_get('max_execution_time');
    }
    $this->max_execution_time = $max_execution_time;
    $this->maxtime            = (int) $this->max_execution_time * 0.8;
    $this->starttime          = time();

    switch($action)
    {
      case 'start':
        $this->Joom_Migrate_Start();
        $this->Joom_Migrate_FirstStep();
        break;

      case 'continue';
        $this->Joom_Migrate_OpenLogfile('a');
        $this->Joom_Migrate_WriteLogfile ('*****************************');
        $this->Joom_Migrate_Continue();
        break;

      default:
        // Check
        $this->Joom_Migrate_Check();
        break;
    }
  }

  /**
   * Checks the remaining time of actual migration step
   *
   * @access  public
   * @return  boolean True: Time remaining for migration, false: No more time left
   * @since   1.5.0
   */
  function Joom_Migrate_Checktime()
  {
    $timeleft = -(time() - $this->starttime - $this->maxtime);
    if ($timeleft > 0)
    {
      return true;
    }

    return false;
  }

  /**
   * Make a redirect to continue/end migration
   *
   * @access  public
   * @param   string  $action Redirect to continue or end
   * @return  void
   * @since   1.5.0
   */
  function Joom_Migrate_Refresh($action = '')
  {
    $msg      = '';
    $msgType  = '';
    if($action != 'exit')
    {
      $url        = 'index.php?option='._JOOM_OPTION.'&controller=migration&migration='.$this->migration.'&task=continue';
      $this->Joom_Migrate_WriteLogfile ('Refresh to continue the migration');
    }
    else
    {
      $url        = 'index.php?option='._JOOM_OPTION;

      $errors = $this->_mainframe->getUserState('joom.migration.errors');
      if($errors)
      {
        $this->Joom_Migrate_WriteLogfile('Errors recognized: '.$errors);
        $msg      = 'There were '.$errors.' error(s) during migration. Please have a look at the logfile.';
        $msgType  = 'error';
      }
      else
      {
        $msg      = 'Migration successfully ended';
      }

      $this->Joom_Migrate_WriteLogfile ('Migration ended');
    }
    $this->Joom_Migrate_CloseLogfile();
    $this->_mainframe->redirect($url, $msg, $msgType);
  }

  /**
   * Opens the logfile and puts first comments into it.
   *
   * @access  public
   * @return  void
   * @since   1.5.0
   */
  function Joom_Migrate_Start()
  {
    $this->Joom_Migrate_SetError('init');
    $this->Joom_Migrate_OpenLogfile('w');
    $this->Joom_Migrate_WriteLogfile ('max. execution time: '.$this->max_execution_time.' seconds');
    $this->Joom_Migrate_WriteLogfile ('calculated refresh time: '.$this->maxtime.' seconds');
    $this->Joom_Migrate_WriteLogfile ('*****************************');
  }

  /**
   * puts last comments into the logfile,
   * closes it and sets redirect with report of success.
   *
   * @access  public
   * @return  void
   * @since   1.5.0
   */
  function Joom_Migrate_End()
  {
    $this->Joom_Migrate_WriteLogfile ('end of migration - exiting');
    $this->Joom_Migrate_WriteLogfile ('*****************************');
    $this->Joom_Migrate_CloseLogfile();
    $this->Joom_Migrate_Refresh('exit');
  }

  /**
   * Opens the logfile
   *
   * @access  public
   * @param   string  $openmode a=append, otherwise new file
   * @return  void
   * @since   1.5.0
   */
  function Joom_Migrate_OpenLogfile($openmode = 'a')
  {
    $logfile = JPATH_COMPONENT.DS.'adminclasses'.DS.$this->logfilename;
    $this->logfile = fopen($logfile, $openmode);
    $this->Joom_Migrate_WriteLogfile('Migration Step started');
  }

  /**
   * Closes the logfile
   *
   * @access  public
   * @return  void
   * @since   1.5.0
   */
  function Joom_Migrate_CloseLogfile()
  {
    fclose($this->logfile);
  }

  /**
   * write into logfile
   *
   * @access  public
   * @param   string  $line The line to write into the logfile
   * @return  void
   * @since   1.5.0
   */
  function Joom_Migrate_WriteLogfile($line)
  {
    $timestring = strftime('%Y-%m-%d %H:%M:%S', time());
    fwrite($this->logfile, $timestring.' - '.$line."\n");
  }

  /**
   * Initiates and increases the error counter
   *
   * @access  public
   * @param   string  $msg  An optional error message to write into the logfile
   * @param   boolean $db   True, if a DB-Error occured
   * @return  void
   * @since   1.5.0
   */
  function Joom_Migrate_SetError($msg = null, $db = false)
  {
    if($msg == 'init')
    {
      $this->_mainframe->setUserState('joom.migration.errors', 0);
      return;
    }

    $error_counter = $this->_mainframe->getUserState('joom.migration.errors');
    if(is_null($error_counter))
    {
      $error_counter = 1;
    }
    else
    {
      $error_counter++;
    }

    $this->_mainframe->setUserState('joom.migration.errors', $error_counter);

    if(!is_null($msg))
    {
      if(!$db)
      {
        $this->Joom_Migrate_WriteLogfile('Error: '.$msg);
      }
      else
      {
        $replace = array("\r\n", "\r", "\n", '              ');
        $msg = str_replace($replace, ' ', $msg);
        $this->Joom_Migrate_WriteLogfile('DB error: '.$msg);
      }
    }
  }

  /**
   * Checks general requirements for migration
   *
   * @access  public
   * @param   string  $xml          Path to the XML-File of the required extension
   * @param   string  $min_version  minimal required version, false if no check shall be performed
   * @param   string  $min_version  maximum possible version, false if no check shall be performed
   * @return  string  Message about state or boolean true or false.
   * @since   1.5.0
   */
  function Joom_Migrate_Check_General($xml = false, $min_version = false, $max_version = false)
  {
    // Check extension
    if($xml)
    {
      if(!file_exists(JPATH_ADMINISTRATOR . DS . $xml))
      {
        return JText::_('JGA_MIGMAN_EXTENSION_NOT_INSTALLED');
      }
      else
      {
        if($min_version OR $max_version)
        {
          $xml = JFactory::getXMLParser('simple');
          $xml->loadFile(JPATH_ADMINISTRATOR . DS . $xml);

          $version_tag  = $xml->document->getElementByPath('version');
          $version      = $version_tag->data();
          if($min_version)
          {
            $comparision_min = version_compare($version, $min_version, '>=');
          }
          else
          {
            $comparision_min = true;
          }
          if($max_version)
          {
            $comparision_max = version_compare($version, $max_version, '<=');
          }
          else
          {
            $comparision_max = true;
          }
          if(!$comparision_min OR !$comparision_max)
          {
            return JText::_('JGA_MIGMAN_WRONG_VERSION');
          }
        }
      }
    }

    // Check whether site is offline
    $sitestatus = $this->_mainframe->getCfg('offline');
?>
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
  <tr>
    <th colspan="3" align="center">
      <?php echo JText::_('JGA_MIGMAN_RESULTS'); ?>
    </th>
  </tr>
  <tr>
    <td colspan="3">
      <h4><?php echo JText::_('JGA_MIGMAN_SITESTATUS'); ?></h4>
    </td>
  </tr>
  <tr>
    <td width="80%" align="left"><?php echo JText::_('JGA_MIGMAN_SITE_OFFLINE'); ?></td>
<?php
    if($sitestatus == 0)
    { ?>
    <td width="10%" align="center">
      &nbsp;
    </td>
    <td align="center">
      <img src="images/publish_x.png" border="0" alt="" />
    </td>
<?php
      $ready = false;
    }
    else
    {
?>
    <td width="10%" align="center">
      <img src="images/tick.png" border="0" alt="" />
    </td>
    <td align="center">
      &nbsp;
    </td>
<?php $ready = true;
    } ?>
  </tr>
<?php
    return $ready;
  }

  /**
   * Checks required directories for migration
   *
   * @access  public
   * @param   array   $dirs Array of directories to search for
   * @return  boolean True if all directories are existent, false otherwise
   * @since   1.5.0
   */
  function Joom_Migrate_Check_Directories($dirs = array())
  {
    // Add JoomGallery directories
    $joom_dirs  = array($this->_config->jg_pathimages,
                        $this->_config->jg_pathoriginalimages,
                        $this->_config->jg_paththumbs);
    foreach($joom_dirs as $dir)
    {
      array_push($dirs, JPath::clean(JPATH_ROOT . DS . $dir));
    }
?>
  <tr>
    <td colspan="3">
      <h4><?php echo JText::_('JGA_MIGMAN_DIRECTORIES'); ?></h4>
    </td>
  </tr>
<?php
    $ready = true;
    foreach($dirs as $dir)
    {
      if(file_exists($dir))
      { ?>
  <tr>
    <td align="left"><?php echo $dir; ?></td>
    <td align="center">
      <img src="images/tick.png" border="0" alt="" />
    </td>
    <td align="center">
      &nbsp;
    </td>
  </tr>
<?php }
      else
      {
        $ready = false; ?>
  <tr>
    <td align="left"><?php echo $dir; ?></td>
    <td align="center">
      &nbsp;
    </td>
    <td align="center">
      <img src="images/publish_x.png" border="0" alt="" />
    </td>
  </tr>
<?php }
    }

    return $ready;
  }

  /**
   * Checks required database tables for migration
   *
   * @access  public
   * @param   array   $tables Array of database tables to search for
   * @return  boolean True if all tables are existent, false otherwise
   * @since   1.5.0
   */
  function Joom_Migrate_Check_Tables($tables = array())
  { ?>
  <tr>
    <td colspan="3">
      <h4><?php echo JText::_('JGA_MIGMAN_DATABASETABLES'); ?></h4>
    </td>
  </tr>
<?php
    $ready = false;
    foreach($tables as $table)
    {
      $query = 'SELECT COUNT(*) FROM ' . $table;
      $this->_db->setQuery($query);
      $count = $this->_db->loadResult();
      if(!is_null($count))
      {
        if($count == 0)
        { ?>
        <tr>
          <td align="left">
            <?php echo $this->_db->replacePrefix($table); ?>: <span style="color:#080; font-size:12px; font-weight:bold;"><?php echo JText::_('JGA_MIGMAN_EMPTY'); ?></span>
          </td>
          <td align="center">
            <img src="images/tick.png" border="0" alt="" />
          </td>
          <td align="center">
            &nbsp;
          </td>
        </tr>
<?php   }
        else
        {
          $ready = true; ?>
        <tr>
          <td align="left">
            <?php echo $this->_db->replacePrefix($table); ?>: <span style="color:#080; font-weight:bold;"><?php echo $count .' '.JText::_('JGA_MIGMAN_ROWS'); ?></span>
          </td>
          <td align="center">
            <img src="images/tick.png" border="0" alt="" />
          </td>
          <td align="center">
            &nbsp;
          </td>
        </tr>
<?php   }
      }
      else
      { ?>
      <tr>
        <td align="left">
          <?php echo $this->_db->replacePrefix($table); ?>: <span style="color:#f30; font-weight:bold;"><?php echo $this->_db->getErrorMsg(); ?></span>
        </td>
        <td align="center">
          &nbsp;
        </td>
        <td align="center">
          <img src="images/publish_x.png" border="0" alt="" />
        </td>
      </tr>
<?php }
    }

    // Check JoomGallery tables
    $tables = array('#__joomgallery',
                    '#__joomgallery_catg',
                    '#__joomgallery_comments',
                    '#__joomgallery_votes',
                    '#__joomgallery_nameshields');
    foreach($tables as $table)
    {
      $query = 'SELECT COUNT(*) FROM ' . $table;
      $this->_db->setQuery($query);
      $count = $this->_db->loadResult();
      if(!is_null($count) AND $count == 0 )
      { ?>
      <tr>
        <td align="left">
          <?php echo $this->_db->replacePrefix($table); ?>: <span style="color:#080; font-size:12px; font-weight:bold;"><?php echo JText::_('JGA_MIGMAN_EMPTY'); ?></span>
        </td>
        <td align="center">
          <img src="images/tick.png" border="0" alt="" />
        </td>
        <td align="center">
          &nbsp;
        </td>
      </tr>
<?php }
      else
      {
        $ready = false; ?>
      <tr>
        <td align="left">
          <?php echo $this->_db->replacePrefix($table); ?>: <span style="color:#f30; font-weight:bold;"><?php echo $count .' '.JText::_('JGA_MIGMAN_ROWS'); ?></span>
        </td>
        <td align="center">
          &nbsp;
        </td>
        <td align="center">
          <img src="images/publish_x.png" border="0" alt="" />
        </td>
      </tr>
<?php }
    }

    return $ready;
  }

  /**
   * Displays message whether migration can be started or not.
   * If yes, the button which starts the migration will be displayed, too.
   *
   * @access  public
   * @param   boolean $ready  True, if the migration may be started
   * @return  void
   * @since   1.5.0
   */
  function Joom_Migrate_EndCheck($ready = false){
?>
  <tr>
    <td colspan="3">
      <hr />
<?php
    if($ready)
    { ?>
      <div style="text-align:center;color:#080;padding:1em 0;font:bold 1.2em Verdana;">
        <?php echo JText::_('JGA_MIGMAN_TRUE'); ?></div>
      <div style="text-align:center;"><?php echo JText::_('JGA_MIGMAN_TRUE_LONG'); ?></div>
<?php
    }
    else
    { ?>
      <div style="text-align:center;color:#f30;padding:1em 0;font:bold 1.2em Verdana;">
        <?php echo JText::_('JGA_MIGMAN_FALSE'); ?></div>
      <div style="text-align:center;"><?php echo JText::_('JGA_MIGMAN_FALSE_LONG'); ?></div>
<?php
    } ?>
      <hr />
    </td>
  </tr>
  <tr>
<?php
  if($ready)
  { ?>
    <th colspan="3" style="text-align:center;">
      <form action="index.php?option=<?php echo _JOOM_OPTION; ?>&amp;act=migrate" method="post">
        <input type="hidden" name="migration" value="<?php echo $this->migration; ?>">
        <input type="hidden" name="migration_action" value="start">
        <input type="submit" value="<?php echo JText::_('JGA_MIGMAN_START'); ?>" style="width: 100px" />
      </form>
      <hr />
    </th>
  <?php
    } ?>
  </tr>
</table>
<?php
  }

  /**
   * Starts all default migration checks.
   *
   * If you want to add additional migration checks
   * you will have to call all check functions above manually.
   * Please don't forget to check whether they return 'true'.
   *
   * @access  public
   * @param   array   $dirs         Array of directories to search for
   * @param   array   $tables       Array of database tables to search for
   * @param   string  $xml          Path to the XML-File of the required extension
   * @param   string  $min_version  minimal required version, false if no check shall be performed
   * @param   string  $min_version  maximum possible version, false if no check shall be performed
   * @return  boolean True if migration may be started
   * @since   1.5.0
   */
  function Joom_Migrate_Check($dirs = array(), $tables = array(), $xml = false, $min_version = false, $max_version = false)
  {
    $ready    = array();
    $ready[]  = $this->Joom_Migrate_Check_General($xml, $min_version, $max_version);
    if($ready[0] !== true && $ready[0] !== false)
    {
      $this->_mainframe->redirect('index.php?option='._JOOM_OPTION.'&controller=migration', $ready[0], 'notice');
    }
    $ready[]  = $this->Joom_Migrate_Check_Directories($dirs);
    $ready[]  = $this->Joom_Migrate_Check_Tables($tables);
    $this->Joom_Migrate_EndCheck(!in_array(false, $ready));
  }

  /**
   * First step of the migration
   * @abstract
   */
  function Joom_Migrate_FirstStep() {}

  /**
   * Main migration function
   * @abstract
   */
  function Joom_Migrate_Continue() {}

  /**
   * Creates directories and the database entry for a category
   *
   * @access  public
   * @param   object  $cat  Holds information about the new category
   * @return  boolean True on success, false otherwise
   * @since   1.5.0
   */
  function Joom_Migrate_CreateCategory($cat)
  {
    jimport('joomla.filesystem.file');

    // Some checks
    if(!isset($cat->id))
    {
      return false;
    }
    if(!isset($cat->name))
    {
      $cat->name = 'no cat name';
    }
    if(!isset($cat->parent))
    {
      $cat->parent = 0;
    }
    if(!isset($cat->description))
    {
      $cat->description = '';
    }
    if(!isset($cat->ordering))
    {
      $cat->ordering = 0;
    }
    if(!isset($cat->published))
    {
      $cat->published = 0;
    }
    if(!isset($cat->owner))
    {
      $cat->owner = 0;
    }
    if(!isset($cat->catimage))
    {
      $cat->catimage = '';
    }
    if(!isset($cat->img_position))
    {
      $cat->img_position = 0;
    }

    // Make the category name safe
    JFilterOutput::objectHTMLSafe($cat->name);

    // If the new category should be assigned as subcategory...
    if($cat->parent)
    {
      // Save the category path of parent category in a variable
      $parentpath = JoomHelper::getCatPath($cat->parent);
    }
    else
    {
      // Otherwise leave it empty
      $parentpath = '';
    }

    // Creation of category path
    // Cleaning of category title with function JoomFile::fixFilename
    // so special chars are converted and underscore removed
    // affects only the category path
    $newcatname = JoomFile::fixFilename($cat->name);
    // Add a undersore and the category id
    // affects only the category path
    $newcatname = $newcatname . '_' . $cat->id;
    // Prepend - if exists - the parent category path
    $catpath = $parentpath . $newcatname;
    // Create the paths of category for originals, pictures, thumbnails
    $cat_originalpath  = JPath::clean(JPATH_ROOT.DS.$this->_config->jg_pathoriginalimages.$catpath);
    $cat_picturepath   = JPath::clean(JPATH_ROOT.DS.$this->_config->jg_pathimages.$catpath);
    $cat_thumbnailpath = JPath::clean(JPATH_ROOT.DS.$this->_config->jg_paththumbs.$catpath);

    $result   = array();
    $result[] = JFolder::create($cat_originalpath);
    $result[] = JoomFile::copyIndexHtml($cat_originalpath);
    $result[] = JFolder::create($cat_picturepath);
    $result[] = JoomFile::copyIndexHtml($cat_picturepath);
    $result[] = JFolder::create($cat_thumbnailpath);
    $result[] = JoomFile::copyIndexHtml($cat_thumbnailpath);

    // Create database entry
    $query = "INSERT INTO "._JOOM_TABLE_CATEGORIES."
                (cid, name, parent, description, ordering, access, published, owner, catimage, img_position, catpath)
              VALUES
                (".$cat->id.",
                 '".$cat->name."',
                 ".$cat->parent.",
                 '".$cat->description."',
                 ".$cat->ordering.",
                 ".$cat->access.",
                 ".$cat->published.",
                 ".$cat->owner.",
                 '".$cat->catimage."',
                 ".$cat->img_position.",
                 '".$catpath."')";
    $this->_db->setQuery($query);
    $result['db'] = $this->_db->query();
    if(!$result['db'])
    {
      $this->Joom_Migrate_SetError($this->_db->getErrorMsg(), true);
    }

    if(!in_array(false, $result))
    {
      $this->Joom_Migrate_WriteLogfile ("Category ".$cat->id. " created: ".$cat->name);
      return true;
    }
    else
    {
      $this->Joom_Migrate_WriteLogfile (" -> Error creating category ".$cat->id. ": ".$cat->name);
      return false;
    }
  }

  /**
   * Creates images from the original one or moves the existing ones
   * into the folders of their category.
   *
   * [jimport('joomla.filesystem.file') has to be called afore]
   *
   * @access  public
   * @param   object  $row          Holds information about the new image
   * @param   string  $origimage    The original image
   * @param   string  $detailimage  The detail image
   * @param   string  $thumbnail    The thumbnail
   * @param   boolean $newfilename  True if a new filename shall be generated
   * @param   boolean $copy         True if the image shall be copied into the new directory, not moved
   * @return  boolean True on success
   * @since   1.5.0
   */
  function Joom_Migrate_MoveAndResizeImage($row, $origimage, $detailimage = null, $thumbnail = null, $newfilename = false, $copy = false)
  {
    // Some checks
    if(!isset($row->id))
    {
      return false;
    }
    if(!isset($row->imgfilename))
    {
      return false;
    }
    if(!isset($row->catid) || $row->catid == 0)
    {
      return false;
    }
    if(!isset($row->catpath))
    {
      $row->catpath = JoomHelper::getCatpath($row->catid);
    }
    if(!isset($row->imgtitle))
    {
      $row->imgtitle = str_replace(JFile::getExt($row->imgfilename), '', $row->imgfilename);
    }
    if(!isset($row->imgauthor))
    {
      $row->imgauthor = '';
    }
    if(!isset($row->imgtext))
    {
      $row->imgtext = '';
    }
    if(!isset($row->imgdate))
    {
      $row->imgdate = mktime();
    }
    if(!isset($row->imgcounter))
    {
      $row->imgcounter = 0;
    }
    if(!isset($row->imgvotes))
    {
      $row->imgvotes = 0;
    }
    if(!isset($row->imgvotesum))
    {
      $row->imgvotesum = 0;
    }
    if(!isset($row->published))
    {
      $row->published = 0;
    }
    if(!isset($row->imgthumbname))
    {
      $row->imgthumbname = $row->imgfilename;
    }
    if(!isset($row->checked_out))
    {
      $row->checked_out = 0;
    }
    if(!isset($row->owner))
    {
      $user = &JFactory::getUser();
      $row->owner = $user->get('id');
    }
    if(!isset($row->approved))
    {
      $row->approved = 1;
    }
    if(!isset($row->useruploaded))
    {
      $row->useruploaded = 0;
    }
    if(!isset($row->ordering))
    {
      $row->ordering = 0;
    }

    if($newfilename)
    {
      //TODO
    }

    // New images
    $neworigimage   = JPATH_ROOT.DS.$this->_config->jg_pathoriginalimages.$row->catpath.$row->imgfilename;
    $newdetailimage = JPATH_ROOT.DS.$this->_config->jg_pathimages.$row->catpath.$row->imgfilename;
    $newthumbnail   = JPATH_ROOT.DS.$this->_config->jg_paththumbs.$row->catpath.$row->imgfilename;

    $result = array();
    // Copy or move original image into the folder of the original images
    if($copy)
    {
      $result['orig'] = JFile::copy(JPath::clean($origimage),
                                    JPath::clean($neworigimage));
      if(!$result['orig'])
      {
        $this->Joom_Migrate_SetError('Could not copy original image');
      }
    }
    else
    {
      $result['orig'] = JFile::move(JPath::clean($origimage),
                                    JPath::clean($neworigimage));
      if(!$result['orig'])
      {
        $this->Joom_Migrate_SetError('Could not move original image');
      }
    }
    
    if(is_null($detailimage))
    {
      // Create new detail image
      $debugoutput='';
      $result['detail'] = JoomFile::resizeImage($debugoutput,
                                                $neworigimage,
                                                $newdetailimage,
                                                false,
                                                $this->_config->jg_maxwidth,
                                                false,
                                                $this->_config->jg_thumbcreation,
                                                $this->_config->jg_thumbquality,
                                                true
                                                );
      if(!$result['detail'])
      {
        $this->Joom_Migrate_SetError('Could not create detail image');
      }
    }
    else
    {
      // Copy or move existing detail image
      if($copy)
      {
        $result['detail'] = JFile::copy(JPath::clean($detailimage),
                                        JPath::clean($newdetailimage));
        if(!$result['detail'])
        {
          $this->Joom_Migrate_SetError('Could not copy detail image');
        }
      }
      else
      {
        $result['detail'] = JFile::move(JPath::clean($detailimage),
                                        JPath::clean($newdetailimage));
        if(!$result['detail'])
        {
          $this->Joom_Migrate_SetError('Could not move original image');
        }
      }
    }
    if(is_null($thumbnail))
    {
      // Create new thumbnail
      $debugoutput='';
      $result['thumb'] = JoomFile::resizeImage( $debugoutput,
                                                $neworigimage,
                                                $newthumbnail,
                                                $this->_config->jg_useforresizedirection,
                                                $this->_config->jg_thumbwidth,
                                                $this->_config->jg_thumbheight,
                                                $this->_config->jg_thumbcreation,
                                                $this->_config->jg_thumbquality
                                              );
      if(!$result['thumb'])
      {
        $this->Joom_Migrate_SetError('Could not create thumbnail');
      }
    }
    else
    {
      // Copy or move existing thumbnail
      if($copy)
      {
        $result['thumb'] = JFile::copy(JPath::clean($detailimage),
                                       JPath::clean($newdetailimage));
        if(!$result['thumb'])
        {
          $this->Joom_Migrate_SetError('Could not copy thumbnail');
        }
      }
      else
      {
        $result['thumb'] = JFile::move(JPath::clean($thumbnail),
                                       JPath::clean($newthumbnail));
        if(!$result['thumb'])
        {
          $this->Joom_Migrate_SetError('Could not move thumbnail');
        }
      }
    }

    // Delete original image if configured in JoomGallery
    if($this->_config->jg_delete_original == 1)
    {
      $result['delete_orig'] = JFile::delete($neworiginalimage);
      if(!$result['delete_orig'])
      {
        $this->Joom_Migrate_SetError('Could not delete original image');
      }
    }

    // Create database entry
    $query = "INSERT INTO "._JOOM_TABLE_IMAGES."
                (id, catid, imgtitle, imgauthor, imgtext, imgdate, imgcounter, imgvotes, imgvotesum,
                 published, imgfilename, imgthumbname, checked_out, owner, approved, useruploaded, ordering)
              VALUES
                (".$row->id.",
                 ".$row->catid.",
                 '".$row->imgtitle."',
                 '".$row->imgauthor."',
                 '".$row->imgtext."',
                 '".$row->imgdate."',
                 ".$row->imgcounter.",
                 ".$row->imgvotes.",
                 ".$row->imgvotesum.",
                 ".$row->published.",
                 '".$row->imgfilename."',
                 '".$row->imgthumbname."',
                 ".$row->checked_out.",
                 ".$row->owner.",
                 ".$row->approved.",
                 ".$row->useruploaded.",
                 ".$row->ordering.")";
    $this->_db->setQuery($query);
    $result['db'] = $this->_db->query();
    if(!$result['db'])
    {
      $this->Joom_Migrate_SetError($this->_db->getErrorMsg(), true);
    }

    if(!in_array(false, $result))
    {
      $this->Joom_Migrate_WriteLogfile ('Image successfully migrated: ' . $row->id . ' Title: ' . $row->imgtitle);
      return true;
    }
    else
    {
      $this->Joom_Migrate_WriteLogfile (' -> Error migrating image: ' . $row->id . ' Title: ' . $row->imgtitle);
      return false;
    }
  }

  /**
   * Migrates all the existing comments (of an image)
   *
   * @access  public
   * @param   array   $cmts Holds objects with comments
   * @return  int     Number of successfully stored comments
   * @since   1.5.0
   */
  function Joom_Migrate_Comments($cmts)
  {
    $counter = 0;
    foreach($cmts as $cmt)
    {
      // Some checks
      if(!isset($cmt->cmtpic) || $cmt->cmtpic == 0)
      {
        continue;
      }
      if(!isset($cmt->cmttext) || $cmt->cmttext == '')
      {
        continue;
      }
      if(!isset($cmt->cmtip))
      {
        // TODO
        $cmt->cmtip = '0.0.0.0';
      }
      if(!isset($cmt->userid))
      {
        $cmt->userid = 0;
      }
      if(!isset($cmt->cmtname))
      {
        $cmt->cmtname = '';
      }
      if(!isset($cmt->cmtdate))
      {
        $cmt->cmtdate = mktime();
      }
      if(!isset($cmt->published))
      {
        $cmt->published = 0;
      }
      if(!isset($cmt->approved))
      {
        $cmt->approved = 1;
      }

      // Create database entry
      $query = "INSERT INTO "._JOOM_TABLE_COMMENTS."
                  (cmtpic, cmtip, userid, cmtname, cmttext, cmtdate, published, approved)
                VALUES
                  (".$cmt->cmtpic.",
                   '".$cmt->cmtip."',
                   ".$cmt->userid.",
                   '".$cmt->cmtname."',
                   '".$cmt->cmttext."',
                   '".$cmt->cmtdate."',
                   ".$cmt->published.",
                   ".$cmt->approved.")";
      $this->_db->setQuery($query);
      if($this->_db->query())
      {
        $counter++;
      }
      else
      {
        $this->Joom_Migrate_SetError($this->_db->getErrorMsg(), true);
      }
    }

    $this->Joom_Migrate_WriteLogfile($counter.' comment(s) successfully stored');

    return $counter;
  }

  /**
   * Migrates all the existing nametags (of an image)
   *
   * @access  public
   * @param   array   $tags Holds objects with nametags
   * @return  int     Number of successfully stored namestags
   * @since   1.5.0
   */
  function Joom_Migrate_Nametags($tags)
  {
    $counter = 0;
    foreach($tags as $tag)
    {
      // Some checks
      if(!isset($tag->npicid) || $tag->npicid == 0)
      {
        continue;
      }
      if(!isset($tag->nxvalue) || $tag->nxvalue == 0)
      {
        continue;
      }
      if(!isset($tag->nyvalue) || $tag->nyvalue == 0)
      {
        continue;
      }
      if(!isset($cmt->userid))
      {
        $tag->userid = 0;
      }
      if(!isset($cmt->nuserip))
      {
        // TODO
        $tag->cmtip = '0.0.0.0';
      }
      if(!isset($cmt->ndate))
      {
        $tag->ndate = mktime();
      }
      if(!isset($cmt->nzindex))
      {
        $tag->nzindex = $counter;
      }

      // Create database entry
      $query = "INSERT INTO "._JOOM_TABLE_NAMESHIELDS."
                  (npicid, nuserid, nxvalue, nyvalue, nuserip, ndate, nzindex)
                VALUES
                  (".$tag->npicid.",
                   ".$tag->nuserid.",
                   ".$tag->nxvalue.",
                   '".$tag->nyvalue.",
                   '".$tag->nuserip."',
                   '".$tag->ndate."',
                   ".$tag->nzindex.")";
      $this->_db->setQuery($query);
      if($this->_db->query())
      {
        $counter++;
      }
      else
      {
        $this->Joom_Migrate_SetError($this->_db->getErrorMsg(), true);
      }
    }

    $this->Joom_Migrate_WriteLogfile($counter.' nametag(s) successfully stored');

    return $counter;
  }
}