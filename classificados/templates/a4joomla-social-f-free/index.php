<?php // no direct access 
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$showLeftColumn = (bool) $this->countModules('left');
$showRightColumn = (bool) $this->countModules('right');
$showRightColumn &= JRequest::getCmd('layout') != 'form';
$showRightColumn &= JRequest::getCmd('task') != 'edit';
$margin = 30;
$logoText	= $this->params->get("logoText");
$slogan	= $this->params->get("slogan");
$pageWidth	= $this->params->get("pageWidth", "9500");
$pageHeight	= $this->params->get("pageHeight", "120");
$rightColumnWidth	= $this->params->get("rightColumnWidth", "200");
$leftColumnWidth	= $this->params->get("leftColumnWidth", "200");
$logoWidth	= $this->params->get("logoWidth", "350");

if($this->countModules('user4')){
$searchWidth = 240;
} else {
$searchWidth = 0;
}
$headerrightWidth = $pageWidth - $logoWidth - 30;

if ($showLeftColumn && $showRightColumn) {
   $contentWidth = $pageWidth - $leftColumnWidth - $rightColumnWidth - 3*$margin;
} elseif (!$showLeftColumn && $showRightColumn) {
   $contentWidth = $pageWidth - $rightColumnWidth - 2*$margin ;
} elseif ($showLeftColumn && !$showRightColumn) {
   $contentWidth = $pageWidth - $leftColumnWidth - 2*$margin ;
} else {
   $contentWidth = $pageWidth - $margin ;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >

<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="templates/<?php echo $this->template ?>/css/aqua.css" type="text/css" />
<!--[if IE 6]>
<link rel="stylesheet" href="templates/<?php echo $this->template ?>/css/ie6.css" type="text/css" />
<style type="text/css">
img, div, a, input { behavior: url(templates/<?php echo $this->template ?>/iepngfix.htc) }
</style>
<script src="templates/<?php echo $this->template ?>/js/iepngfix_tilebg.js" type="text/javascript"></script>
<![endif]-->
<!--[if lte IE 7]>
<link rel="stylesheet" href="templates/<?php echo $this->template ?>/css/ie67.css" type="text/css" />
<![endif]-->

<style type="text/css">
 #logo {
    width:<?php echo $logoWidth; ?>px;
 }
 #headerright {
    width:<?php echo $headerrightWidth; ?>px;
 } 
 #search {
   width:<?php echo $searchWidth; ?>px;
 }
</style>
</head>
<body>

<div id="topwrap" class="gainlayout">

</div>

<div id="headerwrap" class="gainlayout">
  <div id="header" class="gainlayout" style="width:<?php echo $pageWidth; ?>px; height:<?php echo $pageHeight; ?>px;"> 
      <div id="logo">
         <h1>Passos Classificados</h1>
          <h2>Seu Portal de Classificados Online de Passos-MG</h2> 
      </div>
	  <div id="headerright" class="gainlayout">
        <?php if($this->countModules('banner')) : ?>
          <div id="banner">
            <jdoc:include type="modules" name="banner" style="xhtml" /> 
          </div>
        <?php endif; ?>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
  </div>	  
  <div class="clr"></div>
</div>

<div id="topmenuwrap" class="gainlayout">
 <div id="topmenuwrap2" class="gainlayout" style="width:<?php echo $pageWidth; ?>px;">
  <?php if($this->countModules('user3')) : ?>
         <div id="topmenu" class="gainlayout">
           <jdoc:include type="modules" name="user3" style="xhtml" />
           <div class="clr"></div>
         </div> 
  <?php endif; ?>
  <?php if($this->countModules('user4')) : ?>
        <div id="search">
          <jdoc:include type="modules" name="user4" style="xhtml" /> 
		<div class="clr"></div>  
        </div>
  <?php endif; ?>
  <div class="clr"></div>
 </div>
 <div class="clr"></div>
</div> 

<div id="allwrap" class="gainlayout">


<div id="wrap" class="gainlayout" style="width:<?php echo $pageWidth; ?>px;">

  <?php if($this->countModules('breadcrumb')) : ?>
	  <div id="pathway" class="gainlayout">
        <jdoc:include type="module" name="breadcrumbs" style="none" />
      <div class="clr"></div>
	  </div>
  <?php endif; ?> 
  <div id="cbody" class="gainlayout">
  <?php if($showLeftColumn) : ?>
  <div id="sidebar" style="width:<?php echo $leftColumnWidth; ?>px;">     
      <jdoc:include type="modules" name="left" style="xhtml" />    
  </div>
  <?php endif; ?>
  <div id="content60" style="width:<?php echo $contentWidth; ?>px;">    

      <?php if ($this->getBuffer('message')) : ?>
				<div class="error">
					<h2>
						<?php echo JText::_('Message'); ?>
					</h2>
					<jdoc:include type="message" />
				</div>
			<?php endif; ?> 
      <div id="content">
      <jdoc:include type="component" /> 
      </div>  
  </div>
  <?php if($showRightColumn) : ?>
  <div id="sidebar-2" style="width:<?php echo $rightColumnWidth; ?>px;">     
      <jdoc:include type="modules" name="right" style="xhtml" />     
  </div>
  <?php endif; ?>
  <div class="clr"></div>
  </div>
<!--end of wrap-->
</div>

<!--end of allwrap-->
</div>
<div id="footerwrap" class="gainlayout" style="text-align: center;width:<?php echo $pageWidth; ?>px;"> 
<div style="text-align: center;"><jdoc:include type="modules" name="footer" /></div>  <div style="text-align: center;"> Desenvolvido por<a href="http://twitter.com/#!/lucas_marques target="_blank">@lucas_marques</a>
</div>

</body>
</html>
