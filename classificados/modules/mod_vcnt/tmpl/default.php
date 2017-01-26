<!-- VCNT J1.5 by Kubik-Rubik.de - Version 1.5-1 -->
<?php
// "VCNT for Joomla 1.5"
// Author: Viktor Vogel
// URL: http://www.kubik-rubik.de
// version 1.5-1 (for more details see http://www.kubik-rubik.de/joomla-hilfe/modul-vcnt-visitorcounter-joomla-1.5)
// no direct access
defined('_JEXEC') or die('Restricted access');
	$locktime		=	$locktime * 60;
	$db =& JFactory::getDBO();
	$query = "create table if not exists #__vcnt (tm int not null, ip varchar(16) not null default '0.0.0.0')";
	$db->setQuery($query);
	$result = $db->query();
	$day			 =	date('d');
	$month			 =	date('n');
	$year			 =	date('Y');
	$daystart		 =	mktime(0,0,0,$month,$day,$year);
	$monthstart		 =  mktime(0,0,0,$month,1,$year);
	$weekday		 =	date('w');
	$weekday--;
	if ($weekday < 0)$weekday = 7;
	$weekday		 =	$weekday * 24*60*60;
	$weekstart		 =	$daystart - $weekday;
	$yesterdaystart	 =	$daystart - (24*60*60);
	$now			 =	time();
	$ip				 =	$_SERVER['REMOTE_ADDR'];
    if ($s_clean)
    {
		$db =& JFactory::getDBO();
		$query = "create table if not exists #__vcnt_pc (cnt int not null not null default '0')";
		$db->setQuery($query);
		$result = $db->query();
		
		$db =& JFactory::getDBO();
		$query = "select count(*) from #__vcnt_pc";
		$db->setQuery($query);
		$result = $db->query();
        $numrows = $db->loadResult();
        if (!$numrows)
        {
			$db =& JFactory::getDBO();
			$query = "insert into #__vcnt_pc values(0)";
			$db->setQuery($query);
			$result = $db->query();
        }

        $cleanstart = $monthstart - (8*24*60*60);
		$db =& JFactory::getDBO();
		$query = "select count(*) from #__vcnt where tm<$cleanstart";
		$db->setQuery($query);
		$result = $db->query();
        $oldrows = $db->loadResult();
        if ($oldrows)
        {
			$db =& JFactory::getDBO();
			$query = "update #__vcnt_pc set cnt=cnt+$oldrows";
			$db->setQuery($query);
			$result = $db->query();
			
			$db =& JFactory::getDBO();
			$query = "delete from #__vcnt where tm<$cleanstart";
			$db->setQuery($query);
			$result = $db->query();
        }
    }
		$db =& JFactory::getDBO();
		$query = "select cnt from #__vcnt_pc";
		$db->setQuery($query);
		$result = $db->query();
        $pre2 = $db->loadResult();
	
		$db =& JFactory::getDBO();
		$query = "select count(*) from #__vcnt where ip='$ip' and (tm+'$locktime')>'$now'";
		$db->setQuery($query);
		$result = $db->query();
        $items = $db->loadResult();
	if (empty($items))
	{
				$db =& JFactory::getDBO();
				$query = "insert into #__vcnt (tm, ip) values ('$now', '$ip')";
				$db->setQuery($query);
				$result = $db->query();
				$e = $db->getErrorMsg();
	}
		$db =& JFactory::getDBO();
		$query = "select count(*) from #__vcnt";
		$db->setQuery($query);
		$result = $db->query();
        $all_visitors = $db->loadResult();
		$all_visitors	+=	$preset;
		$all_visitors   +=  $pre2;
		$db =& JFactory::getDBO();
		$query = "select count(*) from #__vcnt where tm>'$daystart'";
		$db->setQuery($query);
		$result = $db->query();
        $today_visitors = $db->loadResult();
		$db =& JFactory::getDBO();
		$query = "select count(*) from #__vcnt where tm>'$yesterdaystart' and tm<'$daystart'";
		$db->setQuery($query);
		$result = $db->query();
        $yesterday_visitors = $db->loadResult();
		$db =& JFactory::getDBO();
		$query = "select count(*) from #__vcnt where tm>='$weekstart'";
		$db->setQuery($query);
		$result = $db->query();
        $week_visitors = $db->loadResult();
		$db =& JFactory::getDBO();
		$query = "select count(*) from #__vcnt where tm>='$monthstart'";
		$db->setQuery($query);
		$result = $db->query();
        $month_visitors = $db->loadResult();
	$content		 =	"<div>";
	if($s_today)		$content		.=	show($today,$today_visitors);
	if($s_yesterday)	$content		.=	show($yesterday,$yesterday_visitors);
	if($s_week)			$content		.=	show($x_week,$week_visitors);
	if($s_month)		$content		.=	show($x_month,$month_visitors);
	if($s_all)			$content		.=	show($all,$all_visitors);
	if($copy) 			$content 		.= "<div class=\"small\" style=\"text-align: center\">Powered by <a target=\"_blank\" href=\"http://www.kubik-rubik.de\" title=\"Kubik-Rubik.de\">Kubik-Rubik.de</a></div>";
	$content		.=	"</div>";
	function show($a1,$a2)
{
	$ret = "<span style=\"float: left;\">$a1</span>";
	$ret .= "<span style=\"float: right;\">$a2</span><br />";
	return $ret;
}
?>