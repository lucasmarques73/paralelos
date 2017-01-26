<?php

defined('_JEXEC') or die('Direct Access to this location is not allowed.');
      if($this->current_tab != 'categories'): ?>
<div>
  <ul class="jg-message">
    <li><?php echo JText::_('JGA_MAIMAN_MSG_REFRESH_NECESSARY'); ?></li>
  </ul>
  <script type="text/javascript">
    $('cpanel-panel-joom-maintenance-db-categories').addEvent('click', function(){
      document.location.href="index.php?option=<?php echo _JOOM_OPTION; ?>&controller=maintenance&tab=categories";
    });
  </script>
</div>
<?php else: ?>
<form action="index.php" method="post" name="adminForm">
  <table cellpadding="4" cellspacing="0" border="0" width="100%">
    <tr>
      <td>
        <fieldset class="TODO" style="text-align:center;">
          <legend><?php echo JText::_('JGA_MAIMAN_BATCH_JOBS'); ?></legend>
          <?php echo $this->lists['cat_jobs']; ?>
          <p id="batchjobs"></p>
          <input type="submit" value="<?php echo JText::_('JGA_MAIMAN_APPLY'); ?>" onclick="if(document.adminForm.task.value == ''){return false;}"/>
        </fieldset>
      </td>
      <td width="100%"></td>
      <td><?php echo JText::_('JGA_COMMON_SEARCH'); ?><br />
        <input type="text" name="cat_search" value="<?php echo $this->cat_searchtext; ?>" class="inputbox" onchange="document.adminForm.submit();" />
      </td>
      <td>
        <?php echo JText::_('JGA_MAIMAN_CT_ORDERBY_CATNAME'); ?><br />
        <?php echo $this->lists['cat_ordering']; ?>
      </td>
      <td>
        <?php echo JText::_('JGA_COMMON_FILTER_BY_CATEGORY'); ?><br />
        <?php echo $this->lists['cat_cats']; ?>
      </td>
      <td>
        <?php echo JText::_('JGA_COMMON_FILTER_BY_TYPE'); ?><br />
        <?php echo $this->lists['cat_filter']; ?>
      </td>
    </tr>
  </table>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th width="5">
        <?php echo JText::_('Num'); ?>
      </th>
      <th width="20">
        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $this->checked ? count($this->items) : 0; ?>);" />
      </th>
      <th class="title">
        <?php echo JText::_('JGA_MAIMAN_CT_CATNAME'); ?>
      </th>
      <th width="13%" align="center">
        <?php echo JText::_('JGA_MAIMAN_CT_THUMBNAIL_FOLDER'); ?>
      </th>
      <th width="13%" align="center">
        <?php echo JText::_('JGA_MAIMAN_CT_IMAGE_FOLDER'); ?>
      </th>
      <th width="13%" align="center">
        <?php echo JText::_('JGA_MAIMAN_CT_ORIGINAL_FOLDER'); ?>
      </th>
      <th align="center">
        <?php echo JText::_('JGA_COMMON_OWNER'); ?>
      </th>
      <th align="center">
        <?php echo JText::_('JGA_COMMON_PARENT_CATEGORY'); ?>
      </th>
      <th width="5" align="left">
        <?php echo JText::_('ID'); ?>
      </th>
    </tr>
<?php if($this->checked):
        if($n = count($this->items)):
          $k = 0;
          for($i = 0; $i < $n; $i++):
            $row = &$this->items[$i];
            $checked    = JHTML::_('grid.id', $i, $row->id); ?>
    <tr class="row<?php echo $k; ?>">
      <td>
        <?php echo $this->pagination->getRowOffset($i); ?>
      </td>
      <td>
        <?php echo $checked; ?>
      </td>
      <td>
        <a href="index.php?option=<?php echo _JOOM_OPTION; ?>&amp;controller=images&amp;task=edit&amp;cid=<?php echo $row->refid; ?>">
          <?php echo $row->title; ?>
        </a>
      </td>
      <td align="center">
        <?php if($row->thumb):
                echo $this->tick();
              else:
                echo $this->cross();
                echo $row->thumborphan ? $this->correct('addorphanedfolder', $row->thumborphan, JText::_('JGA_MAIMAN_OPTION_ADD_ORPHANED_FOLDER')) : '';
                echo $this->correct('create', $row->id, JText::_('JGA_MAIMAN_OF_CREATE_EMPTY_FOLDER').'::'.JText::_('JGA_MAIMAN_OF_CREATE_EMPTY_FOLDER_NOTE'), false, '&amp;type=thumb');
              endif; ?>
      </td>
      <td align="center">
        <?php if($row->img):
                echo $this->tick();
              else:
                echo $this->cross();
                echo $row->imgorphan ? $this->correct('addorphanedfolder', $row->imgorphan, JText::_('JGA_MAIMAN_OPTION_ADD_ORPHANED_FOLDER')) : '';
                echo $this->correct('create', $row->id, JText::_('JGA_MAIMAN_OF_CREATE_EMPTY_FOLDER').'::'.JText::_('JGA_MAIMAN_OF_CREATE_EMPTY_FOLDER_NOTE'), false, '&amp;type=img');
              endif; ?>
      </td>
      <td align="center">
        <?php if($row->orig):
                echo $this->tick();
              else:
                echo $this->cross();
                echo $row->origorphan ? $this->correct('addorphanedfolder', $row->origorphan, JText::_('JGA_MAIMAN_OPTION_ADD_ORPHAN')) : '';
                echo $this->correct('create', $row->id, JText::_('JGA_MAIMAN_OF_CREATE_EMPTY_FOLDER').'::'.JText::_('JGA_MAIMAN_OF_CREATE_EMPTY_FOLDER_NOTE'), false, '&amp;type=orig');
              endif; ?>
      </td>
      <td align="center">
<?php       if($row->owner != -1): ?>
        <?php echo JHTML::_('joomgallery.displayname', $row->owner); echo $this->tick(); ?>
<?php       else: ?>
        <?php echo $this->cross(); ?>
        <?php echo $this->correct('newcategoryuser', null, JText::_('JGA_MAIMAN_OPTION_SET_NEW_USER'), 'javascript:joom_selectnewuser('.$i.')'); ?>
        <div id="correctuser<?php echo $i; ?>"></div>
<?php       endif; ?>
      </td>
      <td>
        <?php echo JHTML::_('joomgallery.categorypath', $row->catid); ?>
      </td>
      <td>
        <?php echo $row->refid; ?>
      </td>
    </tr>
<?php       $k = 1 - $k;
          endfor; ?>
    <tr>
      <td colspan="9">
        <?php echo $this->pagination->getListFooter(); ?>
      </td>
    </tr>
<?php   else: ?>
    <tr>
      <td colspan="9">
        <div class="TODO">
          <p>
            <span class="TODO" style="color:green; font-weight:bold;">
              <?php echo JText::_('JGA_MAIMAN_CT_MSG_NO_CORRUPT_CATEGORIES_FOUND'); ?>
            </span>
          </p>
        </div>
      </td>
    </tr>
<?php   endif; ?>
    <tr>
      <td colspan="9">
        <div class="TODO">
          <p>
            <input type="submit" name="check" value="<?php echo JText::_('JGA_MAIMAN_CHECK_AGAIN'); ?>" onclick="document.adminForm.task.value = 'check';" />
          </p>
        </div>
      </td>
    </tr>
<?php else: ?>
    <tr>
      <td colspan="9">
        <div class="TODO">
          <p>
            <span class="TODO" style="color:orange; font-weight:bold;">
              <?php echo JText::_('JGA_MAIMAN_PLEASE_CHECK'); ?>
            </span>
          </p>
          <input type="submit" name="check" value="<?php echo JText::_('JGA_MAIMAN_CHECK'); ?>" onclick="document.adminForm.task.value = 'check';" />
          <p>
            <span class="TODO" style="">
              <?php echo JText::_('JGA_MAIMAN_CHECK_NOTE'); ?>
            </span>
          </p>
        </div>
      </td>
    </tr>
<?php endif; ?>
  </table>
  <div class="jg_displaynone" id="garage">
    <input type="hidden" name="option" value="<?php echo _JOOM_OPTION; ?>" />
    <input type="hidden" name="controller" value="maintenance" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="tab" value="categories" />
    <input type="hidden" name="boxchecked" value="0" />
    <?php echo JHTML::_('list.users', 'newuser', 0, true, null, 'name', false); ?>
    <a href="#correctUser" id="filesave" title="<?php echo JText::_('JGA_MAIMAN_APPLY'); ?>"><img src="images/filesave.png" alt="<?php echo JText::_('JGA_MAIMAN_APPLY'); ?>" /></a>
    <span id="usertip"> <?php echo JHTML::_('tooltip', JText::_('JGA_MAIMAN_CT_NOTE_USER_FILTER_CAT'), JText::_('JGA_MAIMAN_NOTE')); ?></span>
  </div>
</form>
<?php endif;
