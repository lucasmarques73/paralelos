CREATE TABLE IF NOT EXISTS `#__ccnewsletter_newsletters` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `#__ccnewsletter_subscribers` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `plainText` tinyint(1) NOT NULL default '0',
  `enabled` tinyint(1) NOT NULL default '1',
  `sdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastSentNewsletter` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY (`lastSentNewsletter`)
) TYPE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `#__ccnewsletter_acknowledgement` (
  `id` int(2) NOT NULL default '0',
  `subs_title` varchar(255) NOT NULL default '',
  `subs_content` mediumtext NOT NULL,
  `unsubs_title` varchar(255) NOT NULL default '',
  `unsubs_content` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  DEFAULT CHARSET=utf8;
