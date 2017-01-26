<?php

defined('_JEXEC') or die('Direct Access to this location is not allowed.'); ?>
<table border="0" cellpadding="10" class="adminform">
  <tbody>
    <tr>
      <td width="55%" valign="top">
        <div id="cpanel" class="joom_cpanel">
<?php foreach($this->items as $item):
        $this->item = $item;
        echo $this->loadTemplate('button');
      endforeach; ?>
        </div>
      </td>
      <td width="45%" valign="top">
<?php echo $this->tabs->startPane('content-pane');
      $this->entry      = 1;
      if($this->params->get('dated_extensions')):
        echo $this->tabs->startPanel(JText::_('JGA_ADMENU_UPDATECHECK_TITLE'), 'cpanel-panel-joom_update');
        foreach($this->dated_extensions as $name => $extension):
          $this->extension  = $extension;
          $this->name       = $name;
          echo $this->loadTemplate('extension');
          $this->entry++;
          if($this->entry <= count($this->dated_extensions)): ?>
    <hr />
<?php     endif;
        endforeach;
        echo $this->tabs->endPanel();
      endif;
      foreach($this->modules as $module):
        echo $this->tabs->startPanel( $module->title, 'cpanel-panel-'.$module->name );
        echo JModuleHelper::renderModule($module);
        echo $this->tabs->endPanel();
      endforeach;
      if($this->params->get('show_available_extensions')):
        echo $this->tabs->startPanel(JText::_('JGA_ADMENU_INSTALLED_EXTENSIONS'), 'cpanel-panel-joom_update2');
        echo $this->sliders->startPane('content-pane');
        foreach($this->available_extensions as $name => $extension):
          $title = $name;
          if(isset($this->installed_extensions[$name]))
          {
            if(isset($this->dated_extensions[$name]))
            {
              $title .= ' <span class="TODO" style="color:red; font-size:70%;">[Installed but not up-to-date]</span>';
            }
            else
            {
              $title .= ' <span class="TODO" style="color:green; font-size:70%;">[Installed]</span>';
            }
          }
          else
          {
            $title .= ' <span class="TODO" style="color:orange; font-size:70%;">[Not installed]</span>';
          }
          echo $this->sliders->startPanel($title, 'cpanel-panel-joom_update3');
          $this->extension  = $extension;
          $this->name       = $name;
          echo $this->loadTemplate('availableextension');
          if($this->entry < count($this->available_extensions)):
            $this->entry++;
          endif;
          echo $this->sliders->endPanel();
        endforeach;
        echo $this->sliders->endPane();
        echo $this->tabs->endPanel();
      endif;
      echo $this->tabs->endPane();
      if($this->params->get('show_update_info_text')): ?>
        <div class="jg-system-uptodate">
          <?php echo JText::_('JGA_ADMENU_SYSTEM_UPTODATE'); ?>
        </div>
<?php endif; ?>
      </td>
    </tr>
  </tbody>
</table>
<?php JHTML::_('joomgallery.credits');
