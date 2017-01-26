<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');
echo $this->loadTemplate('header'); ?>
  <a name="joomimg"></a>
<?php if($this->_config->get('jg_showdetailtitle') == 1): ?>
  <div>
    <h3 class="jg_imgtitle" id="jg_photo_title">
      <?php echo JoomHelper::BBDecode($this->image->imgtitle); ?>&nbsp;
    </h3>
  </div>
<?php endif;
      if($this->params->get('show_all_in_popup')):
        echo $this->popup['before'];
      endif; ?>
  <div id="jg_dtl_photo" class="jg_dtl_photo" style="text-align:center;">
<?php if($this->params->get('show_nametags')): ?>
    <div id="jg-img" style="position:relative; margin:10px auto; width:<?php echo ++$this->image->img_width; ?>px; height: <?php echo ++$this->image->img_height; ?>px; z-index:0;">
<?php endif;
      if($this->params->get('image_linked')): ?>
    <a href="<?php echo $this->image->link; ?>">
<?php endif; ?>
      <img src="<?php echo $this->image->img_src; ?>" class="jg_photo" id="jg_photo_big" width="<?php echo $this->image->width; ?>" height="<?php echo $this->image->height; ?>" alt="<?php echo $this->image->imgtitle;?>" <?php echo $this->extra; ?> />
<?php if($this->params->get('image_linked')): ?>
    </a>
<?php endif;
      if($this->_user->get('id') && $this->_config->get('jg_nameshields') && !$this->slideshow && ($this->params->get('show_movable_nametag') || $this->_config->get('jg_nameshields_others'))):
        if($this->_config->get('jg_nameshields_others')):
          $overlib  = '<a id="jg-movable-nametag-icon" style="position:relative; top:-30px; left:-35px; z-index:500;" href="javascript:joom_getcoordinates();">'
                        .JHTML::_('joomgallery.icon', 'tag_add.png', 'JGS_DETAIL_NAMETAGS_OTHERS_TIPCAPTION').'</a>';
          $overlib  = htmlspecialchars($overlib, ENT_QUOTES, 'UTF-8');
        endif; ?>
      <span id="jg-movable-nametag" style="position:absolute; top:0px; left:0px; width:<?php echo $this->nametag['length']; ?>px; z-index: 500; cursor:move;" class="nameshield<?php if($this->_config->get('jg_nameshields_others')): echo ' jg_displaynone nametagWithTip" title="'.$overlib; endif; ?>">
        <?php echo $this->nametag['name']; ?>&nbsp;
      </span>
      <form name="nameshieldform" action="<?php echo $this->nametag['link']; ?>" target="_top" method="post">
        <div>
          <input type="hidden" name="id"     value="<?php echo $this->image->id; ?>" />
          <input type="hidden" name="xvalue" value="" />
          <input type="hidden" name="yvalue" value="" />
          <input type="hidden" name="userid" value="" />
        </div>
      </form>
<?php endif;
      if($this->params->get('show_nametags')): ?>
      <?php echo JHTML::_('joomgallery.nametags', $this->nametags); ?>
    </div>
<?php endif; ?>
  </div>
<?php if($this->params->get('slideshow_enabled')): ?>
  <div class="jg_displaynone">
    <form name="jg_slideshow_form" target="_top" method="post" action="">
      <input type="hidden" name="jg_number" value="<?php echo $this->image->id; ?>" readonly="readonly" />
<?php if(!$this->slideshow): ?>
      <input type="hidden" name="slideshow" value="1" readonly="readonly" />
<?php endif; ?>
    </form>
  </div>
  <div class="jg_displaynone" id="jg_displaynone">
<?php   if(!$this->slideshow): ?>
    <a href="javascript:joom_startslideshow()"<?php echo JHTML::_('joomgallery.tip', 'JGS_DETAIL_SLIDESHOW_START', 'JGS_DETAIL_SLIDESHOW', true); ?>>
      <?php echo JHTML::_('joomgallery.icon', 'control_play.png', 'JGS_DETAIL_SLIDESHOW_START'); ?></a>
    <a href="javascript:photo.goon()" style="visibility:hidden; display:inline;"></a>
    <span<?php echo JHTML::_('joomgallery.tip', 'JGS_DETAIL_SLIDESHOW_STOP', 'JGS_DETAIL_SLIDESHOW', true); ?>>
      <?php echo JHTML::_('joomgallery.icon', 'control_stop_gr.png', 'JGS_DETAIL_IMG_FULLSIZE_TIPCAPTION'); ?>
    </span>
<?php   endif;
        if($this->slideshow): ?>
    <a href="javascript:joom_slideshow.clearTimer()" id="jg_pause" style="visibility:visible; display:inline;"<?php echo JHTML::_('joomgallery.tip', 'JGS_DETAIL_SLIDESHOW_PAUSE', 'JGS_DETAIL_SLIDESHOW', true); ?>>
      <?php echo JHTML::_('joomgallery.icon', 'control_pause.png', 'JGS_DETAIL_SLIDESHOW_PAUSE'); ?></a>
    <a href="javascript:joom_slideshow.nextItem();joom_slideshow.prepareTimer();" id="jg_goon" style="visibility:visible; display:inline;">
      <?php echo JHTML::_('joomgallery.icon', 'control_play.png', 'JGS_GOON'); ?></a>
    <a href="javascript:joom_stopslideshow()"<?php echo JHTML::_('joomgallery.tip', 'JGS_DETAIL_SLIDESHOW_STOP', 'JGS_DETAIL_SLIDESHOW', true); ?>>
      <?php echo JHTML::_('joomgallery.icon', 'control_stop.png', 'JGS_DETAIL_SLIDESHOW_STOP'); ?></a>
<?php   endif; ?>
  </div>
  <div class="jg_detailnavislide" id="jg_detailnavislide">
    <div class="jg_no_script">
      <?php echo JText::_('JGS_DETAIL_SLIDESHOW_NO_SCRIPT'); ?>
    </div>
  </div>
  <script type="text/javascript">
    document.getElementById('jg_displaynone').className = 'jg_detailnavislide';
    document.getElementById('jg_detailnavislide').className = 'jg_displaynone';
  </script>
<?php endif; ?>
  <div class="jg_detailnavi">
    <div class="jg_detailnaviprev">
<?php if($this->params->get('show_previous_link')): ?>
<?php   if($this->_config->get('jg_cursor_navigation') == 1): ?>
      <form  name="form_jg_back_link" action="<?php echo $this->pagination['previous']['link']; ?>">
        <input type="hidden" name="jg_back_link" readonly="readonly" />
      </form>
<?php   endif;?>
      <a href="<?php echo $this->pagination['previous']['link']; ?>">
        <?php echo JHTML::_('joomgallery.icon', 'arrow_left.png', 'JGS_DETAIL_IMG_PREVIOUS'); ?></a>
      <a href="<?php echo $this->pagination['previous']['link']; ?>">
        <?php echo JText::_('JGS_DETAIL_IMG_PREVIOUS'); ?></a>
<?php   if($this->params->get('show_previous_text')): ?>
      <br /><?php echo $this->pagination['previous']['text']; ?>
<?php   endif;
      endif; ?>
      &nbsp;
    </div>
    <div class="jg_iconbar">
<?php if($this->params->get('show_zoom_icon') == 1): ?>
      <a href="<?php echo $this->image->link;?>"<?php //echo JHTML::_('joomgallery.tip', 'JGS_DETAIL_IMG_FULLSIZE_TIPTEXT', 'JGS_DETAIL_IMG_FULLSIZE_TIPCAPTION', true); ?>>
        <?php echo JHTML::_('joomgallery.icon', 'zoom.png', 'JGS_DETAIL_IMG_FULLSIZE_TIPCAPTION'); ?></a>
<?php endif;
      if($this->params->get('show_zoom_icon') == -1): ?>
      <span<?php echo JHTML::_('joomgallery.tip', 'JGS_DETAIL_IMG_FULLSIZE_LOGIN_TIPTEXT', 'JGS_DETAIL_IMG_FULLSIZE_TIPCAPTION', true); ?>>
        <?php echo JHTML::_('joomgallery.icon', 'zoom_gr.png', 'JGS_DETAIL_IMG_FULLSIZE_TIPCAPTION'); ?>
      </span>
<?php endif;
      if($this->params->get('show_download_icon') == 1): ?>
      <a href="<?php echo $this->params->get('download_link'); ?>"<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_DOWNLOAD_TIPTEXT', 'JGS_COMMON_DOWNLOAD_TIPCAPTION', true); ?>>
        <?php echo JHTML::_('joomgallery.icon', 'download.png', 'JGS_COMMON_DOWNLOAD_TIPCAPTION'); ?></a>
<?php endif;
      if($this->params->get('show_download_icon') == -1): ?>
      <span<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_DOWNLOAD_LOGIN_TIPTEXT', 'JGS_COMMON_DOWNLOAD_TIPCAPTION', true); ?>>
        <?php echo JHTML::_('joomgallery.icon', 'download_gr.png', 'JGS_COMMON_DOWNLOAD_TIPCAPTION'); ?>
      </span>
<?php endif;
      if($this->params->get('show_nametag_icon') == 1): ?>
      <a href="javascript:joom_getcoordinates();"<?php echo JHTML::_('joomgallery.tip', 'JGS_DETAIL_NAMETAGS_TIPTEXT', 'JGS_DETAIL_NAMETAGS_TIPCAPTION', true); ?>>
        <?php echo JHTML::_('joomgallery.icon', 'tag_add.png', 'JGS_DETAIL_NAMETAGS_TIPCAPTION'); ?></a>
<?php endif;
      if($this->params->get('show_nametag_icon') == 2): ?>
      <a href="javascript:if(confirm('<?php echo JText::_('JGS_DETAIL_NAMETAGS_ALERT_SURE_DELETE', true); ?>')){ location.href='<?php echo $this->params->get('nametag_link'); ?>';}"<?php echo JHTML::_('joomgallery.tip', 'JGS_DETAIL_NAMETAGS_DELETE_TIPTEXT', 'JGS_DETAIL_NAMETAGS_DELETE_TIPCAPTION', true); ?>>
        <?php echo JHTML::_('joomgallery.icon', 'tag_delete.png', 'JGS_DETAIL_NAMETAGS_DELETE_TIPCAPTION'); ?></a>
<?php endif;
      if($this->params->get('show_nametag_icon') == 3): ?>
      <a href="<?php echo JRoute::_('index.php?task=selectnametag&tmpl=component'); ?>" class="modal<?php echo JHTML::_('joomgallery.tip', 'JGS_DETAIL_NAMETAGS_SELECT_OTHERS_TIPTEXT', 'JGS_DETAIL_NAMETAGS_SELECT_OTHERS_TIPCAPTION'); ?>" rel="{handler:'iframe', size:{x:200,y:100}}">
        <?php echo JHTML::_('joomgallery.icon', 'tag_edit.png', 'JGS_DETAIL_NAMETAGS_SELECT_OTHERS_TIPCAPTION'); ?></a>
<?php endif;
      if($this->params->get('show_nametag_icon') == -1): ?>
      <span<?php echo JHTML::_('joomgallery.tip', 'JGS_DETAIL_NAMETAGS_UNREGISTERED_TIPTEXT', 'JGS_DETAIL_NAMETAGS_UNREGISTERED_TIPCAPTION', true); ?>>
        <?php echo JHTML::_('joomgallery.icon', 'tag_add_gr.png', 'JGS_DETAIL_NAMETAGS_UNREGISTERED_TIPCAPTION'); ?>
      </span>
<?php endif;
      if($this->params->get('show_favourites_icon') == 1): ?>
      <a href="<?php echo $this->params->get('favourites_link'); ?>"<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_FAVOURITES_ADD_IMAGE_TIPTEXT', 'JGS_COMMON_FAVOURITES_ADD_IMAGE_TIPCAPTION', true); ?>>
        <?php echo JHTML::_('joomgallery.icon', 'star.png', 'JGS_COMMON_FAVOURITES_ADD_IMAGE_TIPCAPTION'); ?></a>
<?php endif;
      if($this->params->get('show_favourites_icon') == -1): ?>
      <span<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_FAVOURITES_ADD_IMAGE_NOT_ALLOWED_TIPTEXT', 'JGS_COMMON_DOWNLOAD_TIPCAPTION', true); ?>>
        <?php echo JHTML::_('joomgallery.icon', 'star_gr.png', 'JGS_COMMON_DOWNLOAD_TIPCAPTION'); ?>
      </span>
<?php endif;
      if($this->params->get('show_favourites_icon') == 2): ?>
      <a href="<?php echo $this->params->get('favourites_link'); ?>"<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_DOWNLOADZIP_ADD_IMAGE_TIPTEXT', 'JGS_COMMON_DOWNLOADZIP_ADD_IMAGE_TIPCAPTION', true); ?>>
        <?php echo JHTML::_('joomgallery.icon', 'basket_put.png', 'JGS_COMMON_DOWNLOADZIP_ADD_IMAGE_TIPCAPTION'); ?></a>
<?php endif;
      if($this->params->get('show_favourites_icon') == -2): ?>
      <span<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_DOWNLOADZIP_ADD_IMAGE_NOT_ALLOWED_TIPTEXT', 'JGS_COMMON_DOWNLOADZIP_ADD_IMAGE_TIPCAPTION', true); ?>>
        <?php echo JHTML::_('joomgallery.icon', 'basket_put_gr.png', 'JGS_COMMON_DOWNLOADZIP_ADD_IMAGE_TIPCAPTION'); ?>
      </span>
<?php endif;
      if($this->params->get('show_report_icon') == 1): ?>
      <a href="<?php echo JRoute::_('index.php?task=report&id='.$this->image->id.'&tmpl=component'); ?>" class="modal<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_REPORT_IMAGE_TIPTEXT', 'JGS_COMMON_REPORT_IMAGE_TIPCAPTION'); ?>" rel="{handler:'iframe'}"><!--, size:{x:200,y:100}-->
        <?php echo JHTML::_('joomgallery.icon', 'exclamation.png', 'JGS_COMMON_REPORT_TIPCAPTION'); ?></a>
<?php endif;
      if($this->params->get('show_report_icon') == -1): ?>
      <span<?php echo JHTML::_('joomgallery.tip', 'JGS_COMMON_REPORT_IMAGE_NOT_ALLOWED_TIPTEXT', 'JGS_COMMON_REPORT_IMAGE_TIPCAPTION', true); ?>>
        <?php echo JHTML::_('joomgallery.icon', 'exclamation_gr.png', 'JGS_COMMON_REPORT_IMAGE_TIPCAPTION'); ?>
      </span>
<?php endif; ?>
      <?php echo $this->event->icons; ?>
    </div>
    <div class="jg_detailnavinext">
<?php if($this->params->get('show_next_link')): ?>
<?php   if($this->_config->get('jg_cursor_navigation') == 1): ?>
      <form name="form_jg_forward_link" action="<?php echo $this->pagination['next']['link']; ?>">
        <input type="hidden" name="jg_forward_link" readonly="readonly" />
      </form>
<?php   endif;?>
      <a href="<?php echo $this->pagination['next']['link']; ?>">
        <?php echo JText::_('JGS_DETAIL_IMG_NEXT'); ?></a>
      <a href="<?php echo $this->pagination['next']['link']; ?>">
        <?php echo JHTML::_('joomgallery.icon', 'arrow_right.png', 'JGS_DETAIL_IMG_NEXT'); ?></a>
<?php   if($this->params->get('show_next_text')): ?>
      <br /><?php echo $this->pagination['next']['text']; ?>
<?php   endif;
      endif; ?>
      &nbsp;
    </div>
  </div>
<?php if($this->params->get('show_all_in_popup')):
        echo $this->popup['after'];
      endif;
      if($this->_config->get('jg_minis')): ?>
  <div class="jg_minis">
<?php   if($this->_config->get('jg_motionminis') == 2): ?>
    <div id="motioncontainer">
      <div id="motiongallery">
        <div style="white-space:nowrap;" id="trueContainer">
<?php   endif;
        if(count($this->images)):
          foreach($this->images as $row): ?>
          <a href="<?php echo JRoute::_('index.php?view=detail&id='.$row->id).JHTML::_('joomgallery.anchor'); ?>">
<?php       $cssid = '';
            if($row->id == $this->image->id):
              $cssid = ' id="jg_mini_akt"';
            endif; ?>
            <img src="<?php echo $this->_ambit->getImg('thumb_url', $row); ?>"<?php echo $cssid; ?> class="jg_minipic" alt="<?php echo $row->imgtitle; ?>" /></a>
<?php     endforeach;
        endif;
        if($this->_config->get('jg_motionminis') == 2): ?>
        </div>
      </div>
    </div>
<?php   endif; ?>
  </div>
<?php endif;
      if($this->_config->get('jg_showdetailtitle') == 2): ?>
  <div>
    <h3 class="jg_imgtitle" id="jg_photo_title">
      <?php echo JoomHelper::BBDecode($this->image->imgtitle); ?>&nbsp;
    </h3>
  </div>
<?php endif;
      if($this->params->get('show_detailbtm_modules', 0)):
        foreach($this->modules['detailbtm'] as $module): ?>
  <div class="jg_module">
<?php     if($module->showtitle): ?>
    <div class="sectiontableheader">
      <h4>
        <?php echo $module->title; ?>&nbsp;
      </h4>
    </div>
<?php     endif;
          echo $module->rendered; ?>
  </div>
<?php   endforeach;
      endif;
      if($this->_config->get('jg_showdetail')):
        $this->i = 0; ?>
  <div class="jg_details">
    <div class="sectiontableheader">
      <h4 <?php echo $this->toggler; ?>>
        <?php echo JText::_('JGS_DETAIL_INFO'); ?>&nbsp;
      </h4>
    </div>
    <?php if(!empty($this->slider)): ?>
    <div <?php echo $this->slider; ?>>
<?php   endif;
        if($this->_config->get('jg_showdetaildescription') && strlen($this->image->imgtext) > 0): ?>
      <div class="sectiontableentry<?php $this->i++; echo ($this->i%2)+1; ?>">
        <div class="jg_photo_left">
          <?php echo JText::_('JGS_COMMON_DESCRIPTION'); ?>
        </div>
        <div class="jg_photo_right" id="jg_photo_description">
          <?php echo JHTML::_('joomgallery.text', JoomHelper::BBDecode($this->image->imgtext)); ?>&nbsp;
        </div>
      </div>
<?php   endif;
        if($this->_config->get('jg_showdetaildatum')): ?>
      <div class="sectiontableentry<?php $this->i++; echo ($this->i%2)+1; ?>">
        <div class="jg_photo_left">
          <?php echo JText::_('JGS_DETAIL_INFO_DATE'); ?>
        </div>
        <div class="jg_photo_right" id="jg_photo_date">
          <?php echo JHTML::_('date', $this->image->imgdate, JText::_('DATE_FORMAT_LC1')); ?>&nbsp;
        </div>
      </div>
<?php   endif;
        if($this->_config->get('jg_showdetailhits')): ?>
      <div class="sectiontableentry<?php $this->i++; echo ($this->i%2)+1; ?>">
        <div class="jg_photo_left">
          <?php echo JText::_('JGS_COMMON_HITS'); ?>
        </div>
        <div class="jg_photo_right" id="jg_photo_hits">
          <?php echo $this->image->hits; ?>&nbsp;
        </div>
      </div>
<?php   endif;
        if($this->_config->get('jg_showdetailrating')): ?>
      <div class="sectiontableentry<?php $this->i++; echo ($this->i%2)+1; ?>">
        <div class="jg_photo_left">
          <?php echo JText::_('JGS_DETAIL_INFO_RATING'); ?>
        </div>
        <div class="jg_photo_right" id="jg_photo_rating">
          <?php echo JHTML::_('joomgallery.rating', $this->image, true, 'jg_starrating_detail'); ?>
        </div>
      </div>
<?php   endif;
        if($this->_config->get('jg_showdetailfilesize')): ?>
      <div class="sectiontableentry<?php $this->i++; echo ($this->i%2)+1; ?>">
        <div class="jg_photo_left">
          <?php echo JText::_('JGS_DETAIL_INFO_FILESIZE'); ?>
        </div>
        <div class="jg_photo_right" id="jg_photo_filesizedtl">
          <?php echo $this->image->img_size; ?>
          (<?php echo $this->image->img_width; ?> x <?php echo $this->image->img_height; ?> px)&nbsp;
        </div>
      </div>
<?php   endif;
        if($this->_config->get('jg_showdetailauthor')): ?>
      <div class="sectiontableentry<?php $this->i++; echo ($this->i%2)+1; ?>">
        <div class="jg_photo_left">
          <?php echo JText::_('JGS_DETAIL_AUTHOR'); ?>
        </div>
        <div class="jg_photo_right" id="jg_photo_author">
          <?php echo $this->image->author; ?>
        </div>
      </div>
<?php   endif;
        if($this->_config->get('jg_showoriginalfilesize')): ?>
      <div class="sectiontableentry<?php $this->i++; echo ($this->i%2)+1; ?>">
        <div class="jg_photo_left">
          <?php echo JText::_('JGS_DETAIL_INFO_FILESIZE_ORIGINAL'); ?>
        </div>
        <div class="jg_photo_right" id="jg_photo_filesizeorg">
          <?php echo $this->image->orig_size; ?>
          (<?php echo $this->image->orig_width; ?> x <?php echo $this->image->orig_height; ?> px)&nbsp;
        </div>
      </div>
<?php   endif;
        if(!empty($this->slider)): ?>
    </div>
<?php   endif; ?>
  </div>
<?php endif;
      if($this->params->get('show_detailpane_modules')):
        foreach($this->modules['detailpane'] as $module): ?>
  <div class="jg_panemodule">
    <div class="sectiontableheader">
      <h4 <?php echo $this->toggler; ?>>
        <?php echo $module->title; ?>&nbsp;
      </h4>
    </div>
<?php     if(!empty($this->slider)): ?>
    <div <?php echo $this->slider; ?>>
<?php     endif; ?>
      <?php echo $module->rendered; ?>
<?php     if(!empty($this->slider)): ?>
    </div>
<?php     endif;?>
  </div>
<?php   endforeach;
      endif;
      if($this->params->get('show_exifdata')): ?>
  <div class="jg_exif">
    <div class="sectiontableheader">
      <h4 <?php echo $this->toggler; ?>>
        <?php echo JText::_('JGSE_DATA'); ?>
      </h4>
    </div>
<?php   if(!empty($this->slider)): ?>
    <div <?php echo $this->slider; ?>>
<?php   endif;
        echo $this->exifdata; ?>&nbsp;
<?php   if(!empty($this->slider)): ?>
    </div>
<?php   endif;?>
  </div>
<?php endif;
      if($this->params->get('show_map')): ?>
  <div class="jg_exif">
    <div class="sectiontableheader">
      <h4 <?php echo $this->toggler; ?>>
        <?php echo JText::_('JGS_DETAIL_MAPS_GEOTAGGING'); ?>
      </h4>
    </div>
<?php   if(!empty($this->slider)): ?>
    <div <?php echo $this->slider; ?>>
<?php   endif; ?>
      <div id="jg_geomap">
        <script type="text/javascript">
          if (GBrowserIsCompatible())
          {
            var map = new GMap2(document.getElementById('jg_geomap'));
            var mapcenter = new GLatLng(<?php echo $this->mapdata; ?>);
            map.setCenter(mapcenter, 13);
            map.addOverlay(new GMarker(mapcenter));
            map.setUIToDefault();
          }
          else
          {
            document.write(JText._('JGS_DETAIL_MAPS_BROWSER_IS_INCOMPATIBLE'));
          }
        </script>
      </div>
<?php   if(!empty($this->slider)): ?>
    </div>
<?php   endif; ?>
  </div>
<?php endif;
      if($this->params->get('show_iptcdata')): ?>
  <div class="jg_exif">
    <div class="sectiontableheader">
      <h4 <?php echo $this->toggler; ?>>
        <?php echo JText::_('JGSI_DATA'); ?>
      </h4>
    </div>
<?php   if(!empty($this->slider)): ?>
    <div <?php echo $this->slider; ?>>
<?php   endif;
        echo $this->iptcdata.'&nbsp;';
        if(!empty($this->slider)): ?>
    </div>
<?php   endif; ?>
  </div>
<?php endif;
      if($this->params->get('show_voting_area')): ?>
  <div id="jg_voting" class="jg_voting">
    <div class="sectiontableheader">
      <h4 <?php echo $this->toggler; ?>>
        <?php echo JText::_('JGS_DETAIL_RATING'); ?>&nbsp;
      </h4>
    </div>
<?php   if(!empty($this->slider)): ?>
    <div <?php echo $this->slider;?>>
<?php   endif;
        if($this->params->get('voting_message')): ?>
        <?php echo $this->params->get('voting_message'); ?>&nbsp;
<?php   endif;
        if($this->params->get('show_voting_area') == 1):
          if($this->params->get('voting_display_type') == 0):
            if($this->params->get('ajaxvoting') == 1):
              $url = JRoute::_('index.php?view=vote&format=raw&id='.$this->image->id);
              $onsubmit = 'javascript: var voteval = joomGetVoteValue(); joomAjaxVote(\''.$url.'\', \'imgvote=\' + voteval); return false;'; ?>
      <form id="ratingform" name="ratingform" action="<?php echo JRoute::_('index.php?task=vote&id='.$this->image->id); ?>" target="_top" method="post" onsubmit="<?php echo $onsubmit; ?>" >
<?php       else : ?>
      <form name="ratingform" action="<?php echo JRoute::_('index.php?task=vote&id='.$this->image->id); ?>" target="_top" method="post">
<?php       endif; ?>
        <?php echo JText::sprintf('JGS_DETAIL_RATING_BAD', 1); ?>&nbsp;
        <?php echo $this->voting; ?>
        <?php echo JText::_('JGS_DETAIL_RATING_GOOD', $this->maxvoting); ?>&nbsp;
        <p>
          <input class="button" type="submit" value="<?php echo JText::_('JGS_DETAIL_RATING_VOTE'); ?>" name="<?php echo JText::_('JGS_DETAIL_RATING_VOTE'); ?>" />
        </p>
      </form>
<?php     endif;
          if($this->params->get('voting_display_type') == 1): ?>
      <div>&nbsp;</div>
      <ul id="jg_starrating_bar" class="jg_starrating_bar">
        <li class="jg_current-rating" style="width:<?php echo (int)((float)floor(($this->maxvoting / 2.0) + 0.5) * 100.0 / (float) $this->maxvoting); ?>%;">
          &nbsp;
        </li>
<?php       for($i=1; $i<=$this->maxvoting; $i++):
              $url = JRoute::_('index.php?task=vote&id='.$this->image->id.'&imgvote='.$i); ?>
        <li>
<?php         if($this->params->get('ajaxvoting') == 1):
                $ajax_url = JRoute::_('index.php?view=vote&format=raw&id='.$this->image->id);
                $onclick = 'javascript:joomAjaxVote(\''.$ajax_url.'\', \'imgvote='.$i.'\'); return false;'; ?>
          <div onclick="<?php echo $onclick; ?>" class="jg_star_<?php echo $i; ?><?php echo JHTML::_('joomgallery.tip', JText::sprintf('JGS_DETAIL_RATING_STARS_TIPTEXT_VAR', $i, $this->maxvoting), JText::_('JGS_DETAIL_RATING_STARS_TIPCAPTION'), false, false) ?>">
            &nbsp;
          </div>
<?php         else:
                $onclick = 'javascript:location.href=\''.$url.'\'; return false;' ?>
          <div onclick="<?php echo $onclick; ?>" class="jg_star_<?php echo $i; ?> <?php echo JHTML::_('joomgallery.tip', JText::sprintf('JGS_DETAIL_RATING_STARS_TIPTEXT_VAR', $i, $this->maxvoting), JText::_('JGS_DETAIL_RATING_STARS_TIPCAPTION'), false, false) ?>">
            &nbsp;
          </div>
<?php         endif; ?>
        </li>
<?php       endfor; ?>
      </ul>
      <noscript>
        <div class="jg_no_script">
          <?php echo JText::_('JGS_DETAIL_RATING_NO_SCRIPT'); ?>
        </div>
      </noscript>
      <div>&nbsp;</div>
<?php     endif;
        endif;
        if(!empty($this->slider)): ?>
    </div>
<?php   endif; ?>
  </div>
<?php endif;
      if($this->params->get('show_bbcode')):
        $this->i = 0; ?>
  <div class="jg_bbcode">
    <div class="sectiontableheader">
      <h4 <?php echo $this->toggler; ?>>
        <?php echo JText::_('JGS_DETAIL_BBCODE_SHARE'); ?>&nbsp;
      </h4>
    </div>
<?php   if(!empty($this->slider)): ?>
    <div <?php echo $this->slider; ?>>
<?php   endif;
        if($this->params->get('bbcode_img')): ?>
        <div class="jg_bbcode_left">
          <?php echo JText::_('JGS_DETAIL_BBCODE_IMG'); ?>:
        </div>
        <div class="jg_bbcode_right">
          <input type="text" class="inputbox jg_img_BB_box" size="50" value="[IMG]<?php echo $this->params->get('bbcode_img'); ?>[/IMG]" readonly="readonly" onclick="select()" />
        </div>
<?php   endif;
        if($this->params->get('bbcode_url')): ?>
        <div class="jg_bbcode_left">
          <?php echo  JText::_('JGS_DETAIL_BBCODE_LINK'); ?>:
        </div>
        <div class="jg_bbcode_right">
          <input type="text" class="inputbox jg_img_BB_box" size="50" value="[URL]<?php echo $this->params->get('bbcode_url'); ?>[/URL]" readonly="readonly" onclick="select()" />
        </div>
<?php   endif;
        if(!empty($this->slider)): ?>
    </div>
<?php   endif;?>
  </div>
<?php endif;
      if($this->params->get('show_comments_block')): ?>
  <div class="jg_commentsarea">
    <div class="sectiontableheader">
      <h4 <?php echo $this->toggler; ?>>
        <?php echo JText::_('JGS_DETAIL_COMMENTS_EXISTING'); ?>&nbsp;
      </h4>
    </div>
<?php   if(!empty($this->slider)): ?>
    <div <?php echo $this->slider; ?>>
<?php   endif;
        if($this->_config->get('jg_showcommentsarea') == 2):
          echo $this->loadTemplate('commentsarea');
        endif;
        if($this->params->get('commenting_allowed')): ?>
      <a name="joomcommentform"></a>
      <form name="commentform" action="<?php echo JRoute::_('index.php?task=comment&id='.$this->image->id); ?>" method="post">
        <div class="jg_cmtl">
          <?php echo $this->_user->get('username'); ?>&nbsp;
<?php     if(!$this->_user->get('id') && $this->_config->get('jg_namedanoncomment')): ?>
          <input type="text" class="inputbox" name="cmtname" value="<?php echo JText::_('JGS_COMMON_GUEST'); ?>" tabindex="1" />
<?php     endif;
          if($this->params->get('smiley_support')): ?>
          <div class="jg_cmtsmilies">
<?php       $count = 1;
            foreach($this->smileys as $i => $sm): ?>
            <a href="javascript:joom_smilie('<?php echo $i; ?>')" title="<?php echo $i; ?>">
              <img src="<?php echo $sm; ?>" border="0" alt="<?php echo $sm; ?>" /></a>
<?php         if($count%4 == 0): ?>
            <br />
<?php         endif;
              $count++;
            endforeach; ?>
          </div>
<?php     endif;
          if($this->params->get('bbcode_status')): ?>
          <p class="small">
            <?php echo JText::sprintf('JGS_DETAIL_BBCODE_IS',  '<b>'.$this->params->get('bbcode_status').'</b>'); ?>
          </p>
<?php     endif; ?>
        </div>
        <div class="jg_cmtr">
<?php     $rows = 4;
          if($this->_config->get('jg_smiliesupport')):
            $rows = 8;
          endif; ?>
            <textarea cols="40" rows="<?php echo $rows; ?>" name="cmttext" class="inputbox" tabindex="100" ></textarea>
        </div>
        <?php echo $this->event->captchas; ?>
        <div class="jg_cmtl">
          &nbsp;
        </div>
        <div class="jg_cmtr">
          <input type="button" name="send" value="<?php echo JText::_('JGS_DETAIL_COMMENTS_SEND_COMMENT'); ?>" class="button" onclick="joom_validatecomment()" />
            &nbsp;
          <input type="reset" value="<?php echo JText::_('JGS_COMMON_DELETE'); ?>" name="reset" class="button" />
        </div>
      </form>
<?php   endif;
        if(!$this->params->get('commenting_allowed')): ?>
      <div class="sectiontableentry<?php $this->i++; echo ($this->i%2)+1; ?>">
        <div class="jg_cmtf">
          <?php echo JText::_('JGS_DETAIL_COMMENTS_NOT_BY_GUEST'); ?>&nbsp;
        </div>
      </div>
<?php   endif;
        if($this->_config->get('jg_showcommentsarea') == 1):
          echo $this->loadTemplate('commentsarea');
        endif; ?>
<?php   if(!empty($this->slider)): ?>
    </div>
<?php   endif; ?>
  </div>
<?php endif;
      if($this->params->get('show_send2friend_block')): ?>
  <div class="jg_send2friend">
    <div class="sectiontableheader">
      <h4 <?php echo $this->toggler; ?>>
        <?php echo JText::_('JGS_DETAIL_SENDTOFRIEND'); ?>&nbsp;
      </h4>
    </div>
<?php   if(!empty($this->slider)): ?>
    <div <?php echo $this->slider; ?> >
<?php   endif;
        if($this->params->get('show_send2friend_form')): ?>
      <form name="send2friend" action="<?php echo JRoute::_('index.php?task=send2friend&id='.$this->image->id); ?>" method="post">
        <div class="jg_s2fl">
          <?php echo JText::_('JGS_DETAIL_SENDTOFRIEND_FRIENDS_NAME'); ?>:
        </div>
        <div class="jg_s2fr">
          <input type="text" name="send2friendname" size="15" class="inputbox" />
        </div>
        <div class="jg_s2fl">
          <?php echo JText::_('JGS_DETAIL_SENDTOFRIEND_FRIENDS_MAIL'); ?>:
        </div>
        <div class="jg_s2fr">
          <input type="text" name="send2friendemail" size="15" class="inputbox" />
        </div>
        <div class="jg_s2fl">
          &nbsp;
        </div>
        <p class="jg_s2fr">
          <input type="button" name="send" value="<?php echo JText::_('JGS_DETAIL_SENDTOFRIEND_SEND_EMAIL'); ?>" class="button" onclick="joom_validatesend2friend()" />&nbsp;
        </p>
      </form>
<?php   endif;
        if($this->params->get('send2friend_message')): ?>
      <div class="sectiontableentry1">
        <?php echo JText::_('JGS_DETAIL_LOGIN_FIRST'); ?>&nbsp;
      </div>
<?php   endif;
        if(!empty($this->slider)): ?>
    </div>
<?php   endif; ?>
  </div>
<?php endif;
      if($this->params->get('show_nametags')): ?>
  <span id="jg-tooltip-helper-1" class="jg_displaynone<?php echo JHTML::_('joomgallery.tip', 'JGS_DETAIL_NAMETAGS_OTHERS_TIPTEXT', 'JGS_DETAIL_NAMETAGS_OTHERS_TIPCAPTION'); ?>">&nbsp;</span>
  <span id="jg-tooltip-helper-2" class="jg_displaynone<?php echo JHTML::_('joomgallery.tip', 'JGS_DETAIL_NAMETAGS_DELETE_OTHERS_TIPTEXT', 'JGS_DETAIL_NAMETAGS_DELETE_OTHERS_TIPCAPTION'); ?>">&nbsp;</span>
  <script type="text/javascript">
    var jg_nameshields_width = <?php echo $this->_config->get('jg_nameshields_width'); ?>;
<?php   if($this->params->get('show_movable_nametag')): ?>
    $('jg-movable-nametag').makeDraggable({container: $('jg-img')});
<?php   endif; ?>
  </script>
<?php endif;
      echo $this->loadTemplate('footer');