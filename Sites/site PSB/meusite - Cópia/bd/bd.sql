-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 22, 2011 as 01:16 PM
-- Versão do Servidor: 5.5.8
-- Versão do PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `bd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_banner`
--

CREATE TABLE IF NOT EXISTS `jos_banner` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(30) NOT NULL DEFAULT 'banner',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `imageurl` varchar(100) NOT NULL DEFAULT '',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `showBanner` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  `custombannercode` text,
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tags` text NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`bid`),
  KEY `viewbanner` (`showBanner`),
  KEY `idx_banner_catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_banner`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_bannerclient`
--

CREATE TABLE IF NOT EXISTS `jos_bannerclient` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out_time` time DEFAULT NULL,
  `editor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_bannerclient`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_bannertrack`
--

CREATE TABLE IF NOT EXISTS `jos_bannertrack` (
  `track_date` date NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_bannertrack`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_categories`
--

CREATE TABLE IF NOT EXISTS `jos_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `section` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`section`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `jos_categories`
--

INSERT INTO `jos_categories` (`id`, `parent_id`, `title`, `name`, `alias`, `image`, `section`, `image_position`, `description`, `published`, `checked_out`, `checked_out_time`, `editor`, `ordering`, `access`, `count`, `params`) VALUES
(1, 0, 'Noticias', '', 'noticias', '', '1', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, ''),
(3, 0, 'Institucional', '', 'institucional', '', '2', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, ''),
(4, 0, 'Eleições', '', 'eleicoes', '', '2', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, ''),
(5, 0, 'Comissão Provisória', '', 'comissao-provisoria', '', '2', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 4, 0, 0, ''),
(6, 0, 'teste', '', 'teste', '', 'com_contact_details', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_components`
--

CREATE TABLE IF NOT EXISTS `jos_components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `menuid` int(11) unsigned NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `admin_menu_link` varchar(255) NOT NULL DEFAULT '',
  `admin_menu_alt` varchar(255) NOT NULL DEFAULT '',
  `option` varchar(50) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `admin_menu_img` varchar(255) NOT NULL DEFAULT '',
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `parent_option` (`parent`,`option`(32))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Extraindo dados da tabela `jos_components`
--

INSERT INTO `jos_components` (`id`, `name`, `link`, `menuid`, `parent`, `admin_menu_link`, `admin_menu_alt`, `option`, `ordering`, `admin_menu_img`, `iscore`, `params`, `enabled`) VALUES
(1, 'Banners', '', 0, 0, '', 'Banner Management', 'com_banners', 0, 'js/ThemeOffice/component.png', 0, 'track_impressions=0\ntrack_clicks=0\ntag_prefix=\n\n', 1),
(2, 'Banners', '', 0, 1, 'option=com_banners', 'Active Banners', 'com_banners', 1, 'js/ThemeOffice/edit.png', 0, '', 1),
(3, 'Clients', '', 0, 1, 'option=com_banners&c=client', 'Manage Clients', 'com_banners', 2, 'js/ThemeOffice/categories.png', 0, '', 1),
(4, 'Web Links', 'option=com_weblinks', 0, 0, '', 'Manage Weblinks', 'com_weblinks', 0, 'js/ThemeOffice/component.png', 0, 'show_comp_description=1\ncomp_description=\nshow_link_hits=1\nshow_link_description=1\nshow_other_cats=1\nshow_headings=1\nshow_page_title=1\nlink_target=0\nlink_icons=\n\n', 1),
(5, 'Links', '', 0, 4, 'option=com_weblinks', 'View existing weblinks', 'com_weblinks', 1, 'js/ThemeOffice/edit.png', 0, '', 1),
(6, 'Categories', '', 0, 4, 'option=com_categories&section=com_weblinks', 'Manage weblink categories', '', 2, 'js/ThemeOffice/categories.png', 0, '', 1),
(7, 'Contacts', 'option=com_contact', 0, 0, '', 'Edit contact details', 'com_contact', 0, 'js/ThemeOffice/component.png', 1, 'contact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_fax=\nicon_misc=\nshow_headings=1\nshow_position=1\nshow_email=0\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nbannedEmail=\nbannedSubject=\nbannedText=\nsession=1\ncustomReply=0\n\n', 1),
(8, 'Contacts', '', 0, 7, 'option=com_contact', 'Edit contact details', 'com_contact', 0, 'js/ThemeOffice/edit.png', 1, '', 1),
(9, 'Categories', '', 0, 7, 'option=com_categories&section=com_contact_details', 'Manage contact categories', '', 2, 'js/ThemeOffice/categories.png', 1, 'contact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_fax=\nicon_misc=\nshow_headings=1\nshow_position=1\nshow_email=0\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nbannedEmail=\nbannedSubject=\nbannedText=\nsession=1\ncustomReply=0\n\n', 1),
(10, 'Polls', 'option=com_poll', 0, 0, 'option=com_poll', 'Manage Polls', 'com_poll', 0, 'js/ThemeOffice/component.png', 0, '', 1),
(11, 'News Feeds', 'option=com_newsfeeds', 0, 0, '', 'News Feeds Management', 'com_newsfeeds', 0, 'js/ThemeOffice/component.png', 0, '', 1),
(12, 'Feeds', '', 0, 11, 'option=com_newsfeeds', 'Manage News Feeds', 'com_newsfeeds', 1, 'js/ThemeOffice/edit.png', 0, 'show_headings=1\nshow_name=1\nshow_articles=1\nshow_link=1\nshow_cat_description=1\nshow_cat_items=1\nshow_feed_image=1\nshow_feed_description=1\nshow_item_description=1\nfeed_word_count=0\n\n', 1),
(13, 'Categories', '', 0, 11, 'option=com_categories&section=com_newsfeeds', 'Manage Categories', '', 2, 'js/ThemeOffice/categories.png', 0, '', 1),
(14, 'User', 'option=com_user', 0, 0, '', '', 'com_user', 0, '', 1, '', 1),
(15, 'Search', 'option=com_search', 0, 0, 'option=com_search', 'Search Statistics', 'com_search', 0, 'js/ThemeOffice/component.png', 1, 'enabled=0\n\n', 1),
(16, 'Categories', '', 0, 1, 'option=com_categories&section=com_banner', 'Categories', '', 3, '', 1, '', 1),
(17, 'Wrapper', 'option=com_wrapper', 0, 0, '', 'Wrapper', 'com_wrapper', 0, '', 1, '', 1),
(18, 'Mail To', '', 0, 0, '', '', 'com_mailto', 0, '', 1, '', 1),
(19, 'Media Manager', '', 0, 0, 'option=com_media', 'Media Manager', 'com_media', 0, '', 1, 'upload_extensions=bmp,csv,doc,epg,gif,ico,jpg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,EPG,GIF,ICO,JPG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS\nupload_maxsize=10000000\nfile_path=images\nimage_path=images/stories\nrestrict_uploads=1\nallowed_media_usergroup=3\ncheck_mime=1\nimage_extensions=bmp,gif,jpg,png\nignore_extensions=\nupload_mime=image/jpeg,image/gif,image/png,image/bmp,application/x-shockwave-flash,application/msword,application/excel,application/pdf,application/powerpoint,text/plain,application/x-zip\nupload_mime_illegal=text/html\nenable_flash=0\n\n', 1),
(20, 'Articles', 'option=com_content', 0, 0, '', '', 'com_content', 0, '', 1, 'show_noauth=0\nshow_title=1\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\nfeed_summary=0\n\n', 1),
(21, 'Configuration Manager', '', 0, 0, '', 'Configuration', 'com_config', 0, '', 1, '', 1),
(22, 'Installation Manager', '', 0, 0, '', 'Installer', 'com_installer', 0, '', 1, '', 1),
(23, 'Language Manager', '', 0, 0, '', 'Languages', 'com_languages', 0, '', 1, 'administrator=pt-BR\nsite=pt-BR', 1),
(24, 'Mass mail', '', 0, 0, '', 'Mass Mail', 'com_massmail', 0, '', 1, 'mailSubjectPrefix=\nmailBodySuffix=\n\n', 1),
(25, 'Menu Editor', '', 0, 0, '', 'Menu Editor', 'com_menus', 0, '', 1, '', 1),
(27, 'Messaging', '', 0, 0, '', 'Messages', 'com_messages', 0, '', 1, '', 1),
(28, 'Modules Manager', '', 0, 0, '', 'Modules', 'com_modules', 0, '', 1, '', 1),
(29, 'Plugin Manager', '', 0, 0, '', 'Plugins', 'com_plugins', 0, '', 1, '', 1),
(30, 'Template Manager', '', 0, 0, '', 'Templates', 'com_templates', 0, '', 1, '', 1),
(31, 'User Manager', '', 0, 0, '', 'Users', 'com_users', 0, '', 1, 'allowUserRegistration=1\nnew_usertype=Registered\nuseractivation=1\nfrontend_userparams=1\n\n', 1),
(32, 'Cache Manager', '', 0, 0, '', 'Cache', 'com_cache', 0, '', 1, '', 1),
(33, 'Control Panel', '', 0, 0, '', 'Control Panel', 'com_cpanel', 0, '', 1, '', 1),
(34, 'JoomGallery', 'option=com_joomgallery', 0, 0, 'option=com_joomgallery', 'JoomGallery', 'com_joomgallery', 0, 'components/com_joomgallery/assets/images/joom_main.png', 0, '', 1),
(35, 'Category Manager', '', 0, 34, 'option=com_joomgallery&controller=categories', 'Category Manager', 'com_joomgallery', 0, 'components/com_joomgallery/assets/images/joom_categories.png', 0, '', 1),
(36, 'Picture Manager', '', 0, 34, 'option=com_joomgallery&controller=images', 'Picture Manager', 'com_joomgallery', 1, 'components/com_joomgallery/assets/images/joom_pictures.png', 0, '', 1),
(37, 'Comments Manager', '', 0, 34, 'option=com_joomgallery&controller=comments', 'Comments Manager', 'com_joomgallery', 2, 'components/com_joomgallery/assets/images/joom_comments.png', 0, '', 1),
(38, 'Picture Upload', '', 0, 34, 'option=com_joomgallery&controller=upload', 'Picture Upload', 'com_joomgallery', 3, 'components/com_joomgallery/assets/images/joom_pictureupload.png', 0, '', 1),
(39, 'Batch Upload', '', 0, 34, 'option=com_joomgallery&controller=batchupload', 'Batch Upload', 'com_joomgallery', 4, 'components/com_joomgallery/assets/images/joom_batchupload.png', 0, '', 1),
(40, 'FTP Upload', '', 0, 34, 'option=com_joomgallery&controller=ftpupload', 'FTP Upload', 'com_joomgallery', 5, 'components/com_joomgallery/assets/images/joom_ftpupload.png', 0, '', 1),
(41, 'Java Upload', '', 0, 34, 'option=com_joomgallery&controller=jupload', 'Java Upload', 'com_joomgallery', 6, 'components/com_joomgallery/assets/images/joom_jupload.png', 0, '', 1),
(42, 'Configuration Manager', '', 0, 34, 'option=com_joomgallery&controller=config', 'Configuration Manager', 'com_joomgallery', 7, 'components/com_joomgallery/assets/images/joom_config.png', 0, '', 1),
(43, 'Customize CSS', '', 0, 34, 'option=com_joomgallery&controller=cssedit', 'Customize CSS', 'com_joomgallery', 8, 'components/com_joomgallery/assets/images/joom_css.png', 0, '', 1),
(44, 'Migration Manager', '', 0, 34, 'option=com_joomgallery&controller=migration', 'Migration Manager', 'com_joomgallery', 9, 'components/com_joomgallery/assets/images/joom_migration.png', 0, '', 1),
(45, 'Maintenance Manager', '', 0, 34, 'option=com_joomgallery&controller=maintenance', 'Maintenance Manager', 'com_joomgallery', 10, 'components/com_joomgallery/assets/images/joom_maintenance.png', 0, '', 1),
(46, 'Help', '', 0, 34, 'option=com_joomgallery&controller=help', 'Help', 'com_joomgallery', 11, 'components/com_joomgallery/assets/images/joom_information.png', 0, '', 1),
(62, 'JCE MENU INSTALL', '', 0, 47, 'option=com_jce&type=install', 'JCE MENU INSTALL', 'com_jce', 4, 'templates/khepri/images/menu/icon-16-install.png', 0, '', 1),
(60, 'JCE MENU GROUPS', '', 0, 47, 'option=com_jce&type=group', 'JCE MENU GROUPS', 'com_jce', 2, 'templates/khepri/images/menu/icon-16-user.png', 0, '', 1),
(61, 'JCE MENU PLUGINS', '', 0, 47, 'option=com_jce&type=plugin', 'JCE MENU PLUGINS', 'com_jce', 3, 'templates/khepri/images/menu/icon-16-plugin.png', 0, '', 1),
(58, 'JCE MENU CPANEL', '', 0, 47, 'option=com_jce', 'JCE MENU CPANEL', 'com_jce', 0, 'templates/khepri/images/menu/icon-16-cpanel.png', 0, '', 1),
(59, 'JCE MENU CONFIG', '', 0, 47, 'option=com_jce&type=config', 'JCE MENU CONFIG', 'com_jce', 1, 'templates/khepri/images/menu/icon-16-config.png', 0, '', 1),
(47, 'JCE', 'option=com_jce', 0, 0, 'option=com_jce', 'JCE', 'com_jce', 0, 'components/com_jce/img/logo.png', 0, '\npackage=1\npackage=1', 1),
(63, 'ninjaXplorer', 'option=com_ninjaxplorer', 0, 0, 'option=com_ninjaxplorer', 'ninjaXplorer', 'com_ninjaxplorer', 0, 'components/com_ninjaxplorer/images/nssIcon.png', 0, '', 1),
(64, 'Webee Comments', 'option=com_webeecomment', 0, 0, 'option=com_webeecomment', 'Webee Comments', 'com_webeecomment', 0, 'http://localhost/meusite/administrator/components/com_webeecomment/images/menu-icon.png', 0, '', 1),
(65, 'Xmap', 'option=com_xmap', 0, 0, 'option=com_xmap', 'Xmap', 'com_xmap', 0, 'js/ThemeOffice/component.png', 0, '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_contact_details`
--

CREATE TABLE IF NOT EXISTS `jos_contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(20) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `jos_contact_details`
--

INSERT INTO `jos_contact_details` (`id`, `name`, `alias`, `con_position`, `address`, `suburb`, `state`, `country`, `postcode`, `telephone`, `fax`, `misc`, `image`, `imagepos`, `email_to`, `default_con`, `published`, `checked_out`, `checked_out_time`, `ordering`, `params`, `user_id`, `catid`, `access`, `mobile`, `webpage`) VALUES
(1, 'teste', 'teste', '', '', '', '', '', '', '', '', '', '', NULL, '', 0, 1, 0, '0000-00-00 00:00:00', 1, 'show_name=1\nshow_position=1\nshow_email=0\nshow_street_address=1\nshow_suburb=1\nshow_state=1\nshow_postcode=1\nshow_country=1\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nshow_webpage=1\nshow_misc=1\nshow_image=1\nallow_vcard=0\ncontact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_mobile=\nicon_fax=\nicon_misc=\nshow_email_form=1\nemail_description=\nshow_email_copy=1\nbanned_email=\nbanned_subject=\nbanned_text=', 62, 6, 0, '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_content`
--

CREATE TABLE IF NOT EXISTS `jos_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `title_alias` varchar(255) NOT NULL DEFAULT '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `sectionid` int(11) unsigned NOT NULL DEFAULT '0',
  `mask` int(11) unsigned NOT NULL DEFAULT '0',
  `catid` int(11) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` text NOT NULL,
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `parentid` int(11) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_section` (`sectionid`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `jos_content`
--

INSERT INTO `jos_content` (`id`, `title`, `alias`, `title_alias`, `introtext`, `fulltext`, `state`, `sectionid`, `mask`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `parentid`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`) VALUES
(1, 'Reggae', 'reggae', '', '<h1 id="firstHeading" style="text-align: center;"><span style="color: #000000;">Reggae</span></h1>\r\n<div id="siteSub"><span style="color: #000000;">Origem: Wikipédia, a enciclopédia livre.</span></div>\r\n<div id="jump-to-nav"><span style="color: #000000;"> </span></div>\r\n<p><span style="color: #000000;"><strong>Reggae</strong> é um gênero musical desenvolvido originalmente na Jamaica do fim da década de 1960. Embora por vezes seja usado num sentido mais amplo para se referir à maior parte dos tipos de música jamaicana, o termo <em>reggae</em> indica mais especificamente um tipo particular de música que se originou do desenvolvimento do ska e do rocksteady.</span></p>\r\n<p><span style="color: #000000;">O reggae se baseia num estilo rítmico caracterizado pela acentuação no tempo fraco, conhecido como <em>skank</em>. O estilo normalmente é mais lento que o ska porém mais rápido que o rocksteady, e seus compassos normalmente são acentuados na segunda e na quarta batida, com a guitarra base servindo ou para enfatizar a terceira batida, ou para segurar o acorde da segunda até que o quarto seja tocado. É principalmente essa "terceira batida", sua velocidade e o uso de linhas de baixo complexas que diferencia o reggae do rocksteady, embora estilos  posteriores tenham incorporado estas inovações de maneira independente.</span></p>\r\n<p><span style="color: #000000;">O cantor e compositor Bob Marley é o ícone deste estilo musical <br /></span></p>', '', -2, 0, 0, 0, '2011-02-23 16:03:26', 62, '@lucas_marques', '2011-02-25 22:56:33', 62, 0, '0000-00-00 00:00:00', '2011-02-23 16:03:26', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=1\nshow_author=1\nshow_create_date=0\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=pt-BR\nkeyref=Reggae\nreadmore=', 4, 0, 0, 'Reggae Bob Marley', '', 0, 2, 'robots=\nauthor='),
(2, 'Comissão Atual', 'comissao-atual', '', '<p>Presidente - José Geraldo Lopes Silveira</p>\r\n<p>Vice-Presidente - Sérgio Donizetti Marques</p>', '', 1, 2, 0, 5, '2011-02-26 15:41:03', 62, '', '2011-02-26 15:45:09', 62, 0, '0000-00-00 00:00:00', '2011-02-26 15:41:03', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=0\nshow_pdf_icon=0\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 3, 0, 1, '', '', 0, 3, 'robots=\nauthor='),
(3, 'Manifesto', 'manifesto', '', '<table style="width: 100%;" title="Título" border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><span style="color: #000000;"><img src="http://www.psbnacional.org.br/html/imagens/0ic_interna.gif" border="0" alt="Imagem Icone PSB" width="41" height="36" /></span></td>\r\n<td width="100%">\r\n<div><span style="color: #000000;">Manifesto</span></div>\r\n<div><span style="color: #000000;">Partido Socialista Brasileiro - PSB</span></div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<div></div>\r\n<div><span style="color: #000000;">Os atuais membros do Partido Socialista Brasileiro, reunidos em Convenção Nacional,<br />-  Considerando que a Sociedade atual assenta em uma ordem econômica de  que decorrem, necessariamente, desigualdades sociais profundas e o  predomínio de umas nações sobre outras, o que entrava o desenvolvimento  da civilização;<br />- Considerando que a transformação econômica e social  que conduzirá à supressão de tais desigualdades e predomínio pode ser  obtida por processos democráticos;<br />- Considerando, ainda, que as  condições históricas, econômicas e sociais peculiares ao Brasil não o  situarão fora do mundo contemporâneo, quanto aos problemas sociais e  políticos em geral e as soluções socialistas que se impuseram.<br /><br />Resolvem constituir-se em Partido, sob o lema de Socialismo e Liberdade, e orientado pelos seguintes princípios:<br /><br />I  – O Partido considera-se ao mesmo tempo resultado da experiência  política e social dos últimos cem anos em todo o mundo e expressão  particular das aspirações socialistas do povo brasileiro.<br /><br />II – As  peculiaridades nacionais serão pelo partido consideradas, de modo que a  aplicação de seus princípios não constituía solução de continuidade na  história política do País, nem violência aos caracteres culturais do  povo brasileiro.<br /><br />III – Sem desconhecer a influência exercida  sobre o movimento socialista pelos grandes teóricos e doutrinadores que  contribuíram, eficazmente, para despertar mo operariado uma consciência  política necessária ao progresso social, entende que as cisões  provocadas por essa influência nos vários grupamentos partidários estão  em grande parte superadas.<br /><br />Por ocasião da II Convenção Nacional  da Esquerda Democrática, realizada no Rio de Janeiro em abril de 1947,  constituiu-se o Partido Socialista Brasileiro.<br />IV – O Partido tem  como patrimônio inalienável da humanidade as conquistas  democrático-liberais, mas as considera insuficientes como forma  política, para se chegar à eliminação de um regime econômico de  exploração do homem pelo homem.<br /><br />V – O Partido não tem uma  concepção filosófica da vida, nem credo religioso; reconhece a seus  membros o direito de seguirem, nessa matéria, sua própria consciência.<br /><br />VI  – Com base em seu programa, o Partido desenvolverá sua ação no sentido  de fazer proselitismo, sem prejuízo da liberdade de organização  partidária, princípio que respeitará, uma vez alcançado o poder.<br /><br />VII  – O objetivo do Partido, no terreno econômico e a transformação da  estrutura da sociedade, incluída a gradual e progressiva socialização  dos meios de produção, que procurará realizar na medida em que as  condições do País a exigirem.<br /><br />VIII – No terreno cultural, o  objetivo do Partido é a educação do povo em bases democráticas, visando a  fraternidade humana e a abolição de todos os privilégios de classe e  preconceitos de raça.<br /><br />IX – O Partido dispõe-se a realizar suas reivindicações por processos democráticos de luta política.<br /><br />X  – O Partido admite a possibilidade de realizar algumas de suas  reivindicações em regime capitalista, mas afirma sua convicção de que a  solução definitiva dos problemas sociais e econômicos, mormente os de  suma importância, como a democratização da cultura e a saúde pública, só  será possível mediante a execução integral do seu programa.<br /><br />XI –  O Partido não se destina a lutar pelos interesses exclusivos de uma  classe, mas pelos de todos os que vivem do próprio trabalho, operários  do campo e das cidades, empregados em geral, funcionários públicos ou de  organizações paraestatais, servidores das profissões liberais – pois os  considera, todos, identificados por interesses comuns. Não lhe é, por  isto, indiferente a defesa dos interesses dos pequenos produtores e dos  pequenos comerciantes.<br /><br />Com base nos princípios acima expostos, o Partido adota o seguinte:<br /><br />PROGRAMA<br /><br />Classes Sociais – O estabelecimento de um regime socialista acarretará a abolição do antagonismo de classe.<br />Socialização  – O Partido não considera socialização dos meio de produção e  distribuição a simples intervenção de Estado na economia e entende que  aquela só deverá ser decretada pelo voto do parlamento democraticamente  constituído e executada pelos órgãos administrativos eleitos em cada  empresa.<br />Da Propriedade em Geral – A socialização realizar-se-á  gradativamente, até a transferência, ao domínio social, de todos os bens  passíveis de criar riquezas, mantida a propriedade privada nos limites  da possibilidade de sua utilização pessoal, sem prejuízo do interesse  coletivo.<br />Da Terra- A socialização progressiva será realizada segundo  a importância demográfica e econômica das regiões e a natureza de  exploração rural, organizando-se fazendas nacionais e fazendas  cooperativas, assistidas estas, material e tecnicamente, pelo Estado. O  problema do latifúndio será resolvido por este sistema de grandes  explorações, pois assim sua fragmentação trará obstáculos ao progresso  social. Entretanto, dada a diversidade do desenvolvimento econômico das  diferentes regiões, será facultado o parcelamento das terras da Nação em  pequenas porções de usufruto individual o­nde não for viável a  exploração coletiva.<br />Na Indústria – Na socialização progressiva dos meios de produção industrial partir-se-á dos ramos básicos da economia.<br />Do Comércio -A socialização da riqueza compreenderá a nacionalização do crédito, que ficará, assim, a serviço da produção.<br /><br />DAS FINANÇAS PÚBLICAS<br /><br />-  Serão suprimidos os impostos indiretos e aumentados, progressivamente,  os que recaiam sobre a propriedade territorial, a terra, o capital, a  renda em sentido estrito e a herança, até que a satisfação das  necessidades coletivas possa estar assegurada sem recurso ao imposto.<br />- Os gastos públicos serão orçados se autorizados pelo Parlamento, de modo que assegurem o máximo de bem-estar coletivo.<br /><br />DA CIRCULAÇÃO<br /><br />-O  comércio exterior ficará sob controle do Estado até se tornar função  privativa deste. A circulação das riquezas será defendida dos obstáculos  que a entravam, promovendo-se formas diretas de distribuição, sobretudo  através de cooperativas.<br /><br />ORGANIZAÇÃO DO TRABALHO<br /><br />- O  trabalho será considerado direito e obrigação social de todo cidadão  válido, promovendo-se a progressiva eliminação das diferenças que  atualmente separam o trabalho manual do intelectual. O Estado assegurará  o exercício desse direito. O cidadão prestará à sociedade o máximo de  serviços dentro de suas possibilidades e das necessidades sociais, sem  prejuízo de sua liberdade, quanto à escolha da empresa e da natureza da  ocupação.<br />- A liberdade individual de contrato de trabalho sofrerá as  limitações decorrentes das convenções coletivas e da legislação de  amparo aos trabalhadores.<br />- Os sindicatos serão órgãos de defesa das forças produtoras. Deverão, por isto, gozar de liberdade e autonomia.<br />- Será assegurado o direito de greve.<br /><br />ORGANIZAÇÃO POLÍTICA<br /><br />-  O Estado será organizado democraticamente, mantendo sua tradicional  forma federativa e respeitando a autonomia dos municípios, observados os  seguintes princípios:<br />• constituição dos órgãos do Estado por sufrágio universal, direto e secreto, com exceção do judiciário;<br />• Parlamento permanente;<br />• autonomia funcional do poder judiciário;<br />• vitaliciedade, inamovibilidade e irredutibilidade de seus vencimentos;<br />• justiça gratuita;<br />• neutralidade do Estado em face dos credos filosóficos e religiosos;<br />• liberdade de organização partidária dentro dos princípios democráticos;<br />•  a política externa será orientada pelo princípio de igualdade de  direitos e deveres entre as nações, e visará o desenvolvimento pacífico  das relações entre elas. Só o parlamento será competente para decidir da  paz e da guerra.<br /><br />DIREITOS FUNDAMENTAIS DO CIDADÃO<br /><br />- Todos  os cidadãos serão iguais perante a lei, sendo-lhes asseguradas as  liberdades de locomoção, de reunião, de associação, de manifestação do  pensamento, pela palavra escrita, falada ou irradiada; a liberdade de  crença e de cultos, de modo que nenhum deles tenha com o governo da  União ou dos Estados relações de dependência ou aliança.<br />- Será assegurada a igualdade jurídica do homem e da mulher.<br /><br />EDUCAÇÃO E SAÚDE<br /><br />-  A educação é direito de todo cidadão, que a poderá exigir do Estado,  dentro dos limites de sua vocação e capacidade, sem qualquer  retribuição. A educação visará dar ao homem capacidade de adaptação à  sociedade em que vive e não a um grupo ou classe. O ensino oficial será  leigo e organizado de modo que vise o interesse público e não fins  comerciais. O professor terá liberdade didática em sua cadeira. O  educador, no exercício de sua profissão, nenhuma restrição sofrerá de  caráter filosófico, religioso ou político.<br />- A manutenção da saúde  pública é dever do Estado, que não só estabelecerá condições gerais  capazes de assegurar existência e trabalho sadios em todo o território  nacional, como ainda proporcionará a todos assistência médico-higiênica e  hospitalar.<br /><br />REIVINDICAÇÕES IMEDIATAS<br /><br />Enquanto não lhe for  possível, como governo, realizar esta programação, o Partido propugnará  as seguintes, que serão ampliadas e desdobradas na medida em que a  consecução de umas permita a apresentação das subseqüentes, bem como de  outras que, dentro dos princípios gerais do Partido, devam ser  levantadas em virtude do aparecimento de novas situações:<br />1º -  Subordinação da nacionalização de bens pela União, Estados e Municípios,  em cada caso particular, ao voto das respectivas câmaras legislativas.<br />2º  - Administração das empresas nacionalizadas por órgãos constituídos de  representantes dos respectivos governos, indicados pelo Executivo e  aprovados pelo Legislativo, e de representantes eleitos pelos empregados  das empresas.<br />3º - Nacionalização das fontes e empresas de energia,  transportes e indústrias extrativistas consideradas fundamentais.  Elaboração e execução de um plano destinado a colocar o potencial de  energia hidráulica e de combustíveis a serviço do desenvolvimento  industrial. Exclusividade da navegação de cabotagem, inclusive fluvial,  para os navios brasileiros.<br />4º - Nacionalização das terras não  exploradas, ou de terras cuja exploração atual não atende ao interesse  público, a partir das situadas nas regiões populosas, de modo adequado,  inclusive pela instalação de cooperativas de trabalhadores. Assistência  financeira, material e técnica às cooperativas nos latifúndios e às  organizadas pelos pequenos agricultores. Abolição imediata do aforamento  de terras particulares. Proibição de alienação das terras públicas,  sendo a renda do domínio direto partilhada pelos governos federal,  estaduais e municipais.<br />Parcelamento das terras da Nação o­nde não for viável a instalação de cooperativas, em pequenas porções de usufruto individual.<br /><br />Libertação  de uma área em torno das cidades, vilas e povoados, destinada à  produção de gêneros de imediato consumo alimentar local. Concessão de  crédito fácil e barato (penhor agrícola) aos pequenos agricultores.<br />5º  - Nacionalização do crédito e das operações de seguro. Abolição dos  impostos sobre o comércio interestadual, sobre os gêneros de primeira  necessidade, vestuário indispensável às classes pobres e médias, livros,  medicamentos e demais utilidades destinadas à educação e saúde  públicas, instrumentos manuais do trabalho do operário urbano ou o  trabalhador rural, e dos pequenos agricultores e, ainda, sobre a renda  mínima necessária a uma subsistência digna e eficiente e sobre as  pequenas propriedades agrícolas. Abolição gradativa dos impostos  indiretos e taxação fortemente progressiva sobre a terra, a renda, o  capital e a herança;<br />6º - Incentivo à organização de cooperativas de  consumo, em municípios, bairros e empresas pela facilitação de crédito e  isenção de impostos;<br />7º - Liberdade e autonomia dos sindicatos,  considerada a unidade sindical dos trabalhadores, aspiração a ser  realizada por eles próprios; direito irrestrito de greve em todos os  ramos da atividade profissional; organização do trabalho de modo que os  direitos individuais e sociais dos trabalhadores sejam assegurados e  ampliados, que na indústria quer no campo; salário mínimo que possa  garantir o necessário à subsistência do trabalhador e de sua família e à  educação de seus filhos; seguro social universal; instituto único de  previdência e assistência, dirigido por órgão misto de representantes  das partes contribuintes e descentralizado administrativamente no que  diz respeito à concessão de benefícios; participação dos trabalhadores  na direção e nos lucros das empresas, independentemente dos salários;  fixação das aposentadorias e pensões em quantia nunca inferior ao  salário mínimo; impenhorabilidade da casa de pequena valia o­nde residir  o devedor; reconhecimento do direito de sindicalização a todas as  categorias profissionais, inclusive aos funcionários públicos, federais,  municipais e paraestatais; elaboração e execução de um plano do sistema  de transporte, marítimo, fluvial, terrestre e aéreo, de modo a permitir  a articulação das comunicações entre as nossas diversas regiões;  estímulo à imigração para desenvolvimento industrial e agrário do país e  povoamento do seu solo, respeitada a segurança nacional; livre entrada  para as máquinas operatrizes e aparelhamentos industriais não fabricados  no Brasil; tarifa de renda de 15% para os demais produtos e  matérias-primas que não tenham similar nacional segundo um plano a ser  executado em cinco anos.<br />8º - Defesa e desenvolvimento da forma  democrática de governo e garantias às liberdades e direitos fundamentais  do homem; regime representativo de origem popular, através do sufrágio  universal, direto e secreto, com representação proporcional, garantida a  possibilidade do exercício do direito do voto a bordo, a tripulantese  passageiros e a empregados em ferrovia ou rodovia, durante a viagem;  direito de voto a todos os militares e aos analfabetos; liberdade e  manifestação do pensamento pela palavra escrita, falada e irradiada;  liberdade de organização partidária, de associação, de reunião;  igualdade jurídica do homem e da mulher; liberdade e crença e de cultos,  de modo que nenhum deles tenha com o governo da União ou dos Estados  relações de dependência ou aliança; proibição de qualquer espécie de  subvenção, auxílio ou doação oficial a igrejas, congregações ou  organizações religiosas ou filosóficas; organização racional das  repartições públicas.<br /><br />Unidade do direito substantivo, do  processual e da magistratura; justiça gratuita; restauração da  instituição do júri sobre suas bases populares; adoção, na justiça do  trabalho, do critério de escolha, nomeação e carreira vigente na justiça  comum; extensão aos juízes do trabalho das garantias vigentes para a  justiça comum: gratuidade do registro civil das pessoas naturais,  compreendendo nascimentos, casamentos e óbitos; transformação, para  isto, dos respectivos cartórios em departamentos do Estado, mediante o  enquadramento de seus serventuários no funcionalismo, para todos os  efeitos, ainda que subordinado o respectivo serviço ao Judiciário.<br />Fortalecimento  do Poder Legislativo pela adoção do sistema unicameral com uma  assembléia permanente, cujas sessões só se poderão suspender a seu  próprio critério.<br />Responsabilidade efetiva dos governantes em todos  os seus graus, criando-se para isto órgãos de fiscalização, ligados  diretamente ao Poder Legislativo e exclusivamente dele dependente.<br />Competência  ao Supremo Tribunal Federal para declarar a inconstitucionalidade do  estado de sítio, quando decretado com inobservância das condições e  limites fixados na Constituição.<br />Autonomia do Distrito Federal,  quanto aos seus interesses puramente locais, e eleição do seu prefeito e  da Câmara local pelo voto popular.<br />Instituições, nos Estados, de  órgãos deliberativos para decisões em matéria fiscal, à maneira do que  já ocorre em relação à União.<br />9º - Plano nacional de educação que  atenda à conveniência de transferir-se gradativamente o exercício desta  ao Estado e de suprimir-se, progressivamente, o ensino particular de  fins lucrativos; subordinação do ensino particular ao interesse público.  Autonomia administrativa e didática das universidades; liberdade de  programas no ensino superior e no secundário, sem prejuízo do currículo  geral. Liberdade de cátedra. Criação e incentivo de órgãos culturais  complementares do organismo educacional. Subordinação obrigatória de  funcionamento de fábricas ou quaisquer empresas agrícolas e industriais  de relativa importância ao funcionamento de creches, ambulatórios,  escolas, restaurantes e cozinhas centrais junto a elas. Gratuidade e  obrigatoriedade imediatas do ensino primário; gratuidade do ensino  técnico profissional; gratuidade do ensino secundário e superior, na  medida do possível. Amparo material ao estudante pobre, quanto ao ensino  secundário e ao superior, na medida de suas necessidades e de seu  merecimento. Correspondência do ensino técnico-profisional do primeiro e  do segundo grau com os caracteres e as necessidades da economia  regional, criação de institutos agronômicos e de pesquisas nas diversas  regiões do país, conforme suas condições geoeconômicas.<br />Destinação de  um mínimo de 15% da receita pública ao ensino, com sua aplicação no  mesmo orçamentário. Remuneração do professor na base da manutenção de  uma existência digna, incluída uma quota destinada ao desenvolvimento do  seu preparo; adoção de uma escala de salários estabelecida com um  critério capaz de atrair o professor para as zonas menos povoadas e de  menores recursos; afastamento do simples arbítrio do Executivo no  recrutamento dos quadros docentes.<br />Organização adequada dos serviços  de saúde pública; assistência médica para os trabalhadores, mediante  planos de remuneração mínima, ou até de gratuidade, conforme o caso, sem  prejuízos das aspirações de sobrevivência e progresso técnico da  profissão.<br />Combate às endemias e eficazes medidas contra a  desnutrição do povo, especialmente das crianças, dos trabalhadores e das  gestantes; adoção de um plano geral do amparo à maternidade e à  infância, envolvendo a organização do trabalho, a educação e a  assistência médico-higiênica propriamente dita; desenvolvimento da  assistência hospitalar, mediante subordinação dos estabelecimentos de  caridade já existentes a um plano geral de assistência que os coloque a  serviço efetivo do povo; saneamento das regiões insalubres, a começar  pelas mais povoadas; assistência à invalidez, desenvolvimento de um  plano destinado a atrair e fixar nos municípios do interior, privados de  assistência médico-profissional, os que ali possam viver de sua  profissão, com benefício para a coletividade; disseminação adequada de  centos de Puericultura e Centros de Saúde e fomento à organização de  Escolas de Enfermagem e Obstetrícia prática, estas principalmente nas  cidades do interior; saneamento permanente de rios, portos e canais.</span></div>', '', 1, 2, 0, 3, '2011-03-01 23:39:13', 62, '', '2011-03-05 03:19:11', 62, 0, '0000-00-00 00:00:00', '2011-03-01 23:39:13', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 2, 0, 3, '', '', 0, 0, 'robots=\nauthor='),
(4, 'Institucional', 'institucional', '', '<p>Institucional</p>', '', 1, 0, 0, 0, '2011-03-02 00:20:25', 62, '', '2011-03-02 00:37:21', 62, 0, '0000-00-00 00:00:00', '2011-03-02 00:20:25', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 3, 0, 1, '', '', 0, 5, 'robots=\nauthor='),
(5, 'Estatuto', 'estatuto', '', '<table style="width: 100%;" title="Título" border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><img src="http://www.psbnacional.org.br/html/imagens/0ic_interna.gif" border="0" alt="Imagem Icone PSB" width="41" height="36" /></td>\r\n<td width="100%">\r\n<div>Estatuto</div>\r\n<div>Partido Socialista Brasileiro - PSB</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<div style="text-align: center;"><br /> <br />\r\n<div><strong>PARTIDO SOCIALISTA BRASILEIRO - PSB</strong></div>\r\n<br /> O Presidente do Partido Socialista Brasileiro - PSB, no uso de suas  atribuições estatutárias, e considerando o cumprimento, pelo Partido,  do artigo 55, § 1º da Lei nº 9.096, de 19 de setembro de 1995, resolve:<br /><br />Fazer  publicar o texto integral do Estatuto do PSB, aprovado pelo Congresso  Nacional Extraordinário do Partido, realizado nos dia 20 de agosto de  2005, em Brasília, Distrito Federal. <br /><br /><br />\r\n<div><strong>Eduardo Campos</strong><br />Presidente Nacional do Partido Socialista Brasileiro</div>\r\n<br /> <br />\r\n<div style="text-align: center;"><strong>Carlos Siqueira</strong><br />Primeiro Secretário Nacional do PSB</div>\r\n<div style="text-align: center;"></div>\r\n<div style="text-align: left;"><a href="http://www.psbnacional.org.br/upd_blob/0001/1586.doc">Download do Estatuto</a></div>\r\n</div>', '', 1, 2, 0, 3, '2011-03-04 22:49:34', 62, '', '2011-03-18 18:06:40', 62, 0, '0000-00-00 00:00:00', '2011-03-04 22:49:34', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 3, 0, 2, '', '', 0, 7, 'robots=\nauthor='),
(6, 'Regimento Interno', 'regimento-interno', '', '<table style="width: 100%;" title="Título" border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><span style="color: #000000;"><img src="http://www.psbnacional.org.br/html/imagens/0ic_interna.gif" border="0" alt="Imagem Icone PSB" width="41" height="36" /></span></td>\r\n<td width="100%">\r\n<div><span style="color: #000000;">Regimento Interno</span></div>\r\n<div><span style="color: #000000;">Partido Socialista Brasileiro - PSB</span></div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<div><span style="color: #000000;"><br /><strong>CAPÍTULO I</strong><br /><br />Art. 1º O Partido Socialista  Brasileiro – PSB, com sede e foro na Capital da República Federativa do  Brasil, com jurisdição em todo território nacional e duração por tempo  indeterminado, rege-se, por seu Manifesto, Programa e Estatuto, pelo  Código de Ética e Fidelidade Partidária e por este Regimento Interno,  observados os princípios constitucionais, as normas legais e  partidárias.<br /><br />Art. 2º A filiação ao PSB só terá validade se realizada nos termos das normas estatutárias e deste Regimento Interno.<br /><br />§ 1º A prova de filiação é o cartão padronizado de Identidade Partidária no modelo aprovado pelo Diretório Nacional do PSB.<br /><br /><strong>CAPÍTULO II </strong><br />Dos Congressos do PSB<br /><br />Art.  3º O Congresso é o órgão decisório e supremo do PSB nos níveis zonal,  Municipal, Estadual e Nacional, competindo-lhe no âmbito de sua  jurisdição:<br />a) deliberar sobre as questões de interesse partidário;<br />b) eleger os membros do respectivo Diretório;<br />c) deliberar sobre os recursos a ele interpostos;<br />d) eleger os seus delegados ao Congresso imediatamente superior;<br />e) deliberar sobre as alianças ou coligações com outros partidos democráticos e progressistas.<br /><br />§  1º Participará, proporcionalmente, da composição da nominata de  delegados do PSB aos Congressos Estaduais e Nacional, no caso de  disputa, cada chapa que obtiver pelo menos 10% (dez por cento) dos  votos.<br /><br />§ 2º Nos Congressos do PSB, o voto será pessoal e  igualitário, vedado o voto cumulativo, ainda que o filiado ostente mais  de uma condição que o habilite a votar<br /><br />Art. 4º Compete privativamente ao Congresso Nacional:<br />I  autorizar alianças e coligações para as eleições nacionais e  estabelecer linhas políticas para os Congressos Estaduais, Municipais e  Zonais;<br />II deliberar sobre todas as questões de princípios e de orientação política e partidária;<br />III indicar e aprovar os candidatos a Presidente e Vice-presidente da República;<br />IV  deliberar sobre a dissolução do Partido, em congresso especialmente  convocado para tal finalidade e com a aprovação de 2/3 (dois terços) dos  delegados regularmente credenciados;<br />V deliberar sobre a  incorporação ou fusão do PSB com outros partidos em congresso  especialmente convocado para tal finalidade, com aprovação de 2/3 (dois  terços) dos delegados regularmente credenciados;<br />VI aprovar e alterar  este Estatuto, pelo voto da maioria absoluta do total de seus  delegados, em convocação específica para este fim;<br />VII decidir, em última instância em grau de recurso;<br />VIII eleger o Diretório Nacional;<br />IX  destituir o Diretório Nacional, pelo voto de pelo menos 60% (sessenta  por cento) dos delegados do Congresso Partidário Nacional, quando  convocado nos termos do Estatuto partidário para tal fim.<br /><br />Art. 5º  Compete privativamente ao Congresso Estadual, observadas as normas  atinentes a escolha de candidatos e a fixação de coligações previstas no  Estatuto partidário, indicar os candidatos aos legislativos Estadual e  Federal e ao Executivo Estadual, e a eleição de seus órgãos de direção,  fiscalização e controle.<br /><br />Art. 6º Compete privativamente ao  Congresso Municipal, observadas as normas estatutárias e as resoluções  políticas e diretrizes emanadas do órgão imediatamente superior, indicar  os candidatos às eleições proporcionais e majoritárias municipais, e a  eleição de seus órgãos de direção, fiscalização e controle.<br /><br />Art.  7º Os Congressos do PSB Nacional, Estadual, Municipal e Zonal reúnem-se  ordinariamente de 2 em 2 (dois em dois) anos, quando convocados pelo  respectivo Diretório ou ainda a requerimento de 1/3 (um terço) dos  Diretórios Estaduais ou de 1/3 (um terço) dos Diretórios Municipais, ou  de 1/3 (um terço) dos Diretórios Zonais, conforme o caso.<br /><br />§ 1º  Nos Municípios com existência simultânea de Diretório Municipal e Zonal,  o Congresso Municipal será convocado pelo Diretório por 1/3 (um terço)  dos delegados zonais ao Congresso Municipal, ou ainda pela maioria  simples dos membros dos diretórios zonais ou pelo conjunto de 1/3 (um  terço) dos filiados de cada Diretório Zonal.<br /><br />§ 2º Os Congressos  ordinários serão convocados com antecedência mínima de 30 (trinta) dias  em âmbito Nacional, 20 (vinte) dias em âmbito Estadual e 10 (dez) dias o  Municipal e o Zonal.<br /><br />§ 3º Os Congressos extraordinários serão  convocados com antecedência mínima de 45 (quarenta e cinco) dias em  âmbito Nacional, 30 (trinta) dias em âmbito Estadual e 10 (dez) dias o  Municipal e Zonal.<br /><br />§ 4º Em caso de urgência urgentíssima, os  Diretórios poderão reduzir os prazos de convocação dos congressos  extraordinários, submetendo, obrigatoriamente a decisão à aprovação do  Diretório hierarquicamente superior.<br /><br />Art. 8º O Congresso  Municipal será constituído por todos os filiados ao PSB, em dia com suas  obrigações partidárias, inclusive com as contribuições previstas nos  arts. 61 e 63 do Estatuto Partidário e portadores do Cartão de  Identidade Partidária, definitivo ou provisório, no modelo estabelecido  pela Direção Nacional.<br /><br />§ 1º São delegados natos ao Congresso  previsto neste artigo, os membros do Diretório Municipal, e os  detentores de mandatos eletivos filiados na circunscrição municipal.<br /><br />§  2º Nos municípios com existência simultânea de Diretórios Municipal e  Zonal, o Congresso Municipal será composto de membros do Diretório  Municipal, membro dos Diretórios Zonais, delegados zonais ao Congresso  Municipal, eleitos na proporção de 10 (dez) delegados para os primeiros  30 (trinta) filiados e mais 1 (um) por dez filiados a mais ou fração, e  os detentores de mandatos eletivos previstos no parágrafo 1º deste  artigo.<br /><br />Art. 9º O Congresso Estadual é composto de delegados natos e eleitos nos Congressos Municipais:<br /><br />a)  São delegados natos os detentores de mandato eletivo federal e  estadual, os Prefeitos, e os membros titulares do Diretório Estadual;<br />b) Os demais delegados serão eleitos pelos Congressos Municipais na seguinte proporção:<br />1) Dois delegados em cada Município em que o PSB tiver diretório definitivo;<br />2) Mais um delegado, na hipótese de o PSB ter eleito um ou mais Vereadores à Câmara Municipal.<br /><br />Parágrafo  Único. No Município o­nde o PSB houver obtido, na eleição imediatamente  anterior, pelo menos 2% (dois por cento) dos votos apurados para a  Câmara dos Deputados, será eleito mais um delegado, e mais um a cada  5.000 (cinco mil) votos obtidos, no mesmo pleito, para o PSB.<br /><br />Art. 10 Os Congressos do PSB serão convocados por edital , publicados no jornal de maior circulação na respectiva jurisdição.<br /><br />Parágrafo  Único. Não havendo jornal no âmbito da jurisdição do município, o  edital deverá ser afixado na Sede do Partido e no Cartório Eleitoral.<br /><br />Art.  11 Os Congressos do PSB serão instalados com a presença de pelo menos  20 % (vinte por cento) dos filiados ou delegados com direito a voto no  respectivo congresso e deliberará por maioria absoluta de votos,  ressalvados os quoruns especiais previstos no Estatuto Partidário.<br /><br />Art.  12 Poderão participar dos congressos do PSB, todos os filiados ao  Partido com antecedência mínima de 60 (sessenta) dias, portadores do  documento referido no caput do art. 8º, e em dia com as obrigações  previstas nos artigos 61 e 63 do Estatuto Partidário.<br /><br />Art. 13 Os delegados ao Congresso Nacional do PSB serão eleitos pelo respectivo Congresso Estadual na seguinte proporção:<br />I-  Dez delegados por unidade federativa o­nde o PSB, até a data-limite da  realização dos Congressos Estaduais, estiver organizado em caráter  definitivo, e obtenha o registro pela Executiva Nacional, que se  pronunciará em tempo hábil à realização do Congresso Nacional.<br />II-  Nos Estados o­nde o PSB tiver direção estadual provisória serão eleitos  ao Congresso Nacional do Partido apenas 4 (quatro), delegados por  unidade federativa, dos delegados previstos na alínea anterior.<br /><br />§  1º Na unidade federativa o­nde o PSB tiver obtido pelo menos 2% dos  votos apurados para a Câmara dos Deputado, acrescenta-se um (01)  delegado, e mais um (01) delegado a cada trinta mil votos além do  percentual de sufrágios referidos neste dispositivo.<br /><br />§ 2º Na  unidade federativa o­nde o PSB houver eleito Deputados Estaduais, a cada  Deputado eleito pelo PSB corresponderá um delegado.<br /><br />§ 3º São  delegados natos ao Congresso nacional do PSB os seguintes detentores de  mandatos eletivos pela legenda do Partido: o presidente e o  vice-presidente da República, os governadores e os vice-governadores, os  senadores, os deputados federais, os membros titulares do Diretório  Nacional.<br /><br /><br /><strong>CAPÍTULO III </strong><br />Da Fixação de Normas sobre a Constituição de <br />Diretórios Municipais e Estaduais<br /><br />Art.  14 Na composição dos Diretórios, respeitada a representação majoritária  da chapa vencedora, será assegurada representação proporcional às  chapas que tenham obtido no mínimo, 10 % (dez por cento) dos votos  válidos, excluídos os brancos e nulos.<br /><br />Art. 15 Na composição das  chapas para os Diretórios será levada em conta, sempre que possível, a  representatividade de diversos segmentos sociais.<br /><br />Parágrafo Único  - É obrigatório constar do Regimento Interno dos Congressos do PSB  todas as normas pertinentes a prazos e registro de chapas.<br /><br />Art.  16 Para constituir Diretório Municipal, deve haver no Município um  número mínimo de filiados, a ser fixado pelo Diretório Estadual ou pela  Comissão Executiva Provisória Estadual.<br /><br />Art. 17 Para constituir  Diretório Estadual deverá haver Diretórios Municipais constituídos na  forma deste Regimento Interno, em pelo menos, 20 % (vinte por cento) dos  Municípios do respectivo Estado.<br />Parágrafo único. Após alcançar o  nível de organização previsto neste artigo, a Comissão Executiva  Provisória Estadual, convocará imediatamente um Congresso para eleger o  Diretório Estadual.<br /><br />Art. 18 Nas Capitais de Estados e nos  Municípios com mais de uma zona eleitoral, serão constituídos Diretórios  Municipais que representarão o PSB politicamente e junto à Justiça  Eleitoral no âmbito de sua respectiva jurisdição.<br /><br />Parágrafo Único  Sem prejuízo do disposto neste artigo, também serão criados Diretórios  Zonais com a finalidade exclusiva de facilitar a organização eleitoral  do Partido.<br /><br />Art. 19 A constituição de Diretórios nas Capitais e  Cidades com mais de uma zona eleitoral, será realizado através de  Congresso Municipal, que será convocado após 50% (cinquenta por cento)  das Zonais atingirem o número de filiados fixado pelo Diretório ou  Comissão Provisória Estadual.<br /><br /><br /><strong>CAPÍTULO IV</strong></span> <span style="color: #000000;"><br />Do Registro dos Diretórios e Comissões Executivas<br /><br />Art.  20 Compete à Comissão Executiva, no âmbito de sua jurisdição, decidir  sobre o registro da Comissão Executiva e do Diretório hierarquicamente  inferior.<br /><br />Art. 21 No prazo de cinco dias após a realização do  Congresso que eleger o Diretório Zonal, Municipal ou Diretório Estadual,  o Presidente da Comissão Executiva respectiva encaminhará à Comissão  Executiva hierarquicamente superior o requerimento de registro do  Diretório e da Comissão Executiva, acompanhado dos seguintes documentos:<br />I. Do Zonal para o Municipal<br />a)  Cópia do Edital de convocação do Congresso Zonal com prova de sua  publicação na sede do Partido, no cartório eleitoral da respectiva Zona  ou em jornal;<br />b) Cópias das Atas do Congresso e do Diretório que  elegeram os Membros do Diretório, Conselho Fiscal, Conselho de Ética,  Delegados ao Congresso imediatamente superior e a sua Comissão  Executiva.<br />c) Ofício contendo os nomes dos membros efetivos do  Diretório Zonal, Delegados ao Congresso Municipal e sua Comissão  Executiva , contendo para cada membro nome, endereço, CPF, título  eleitoral, seção, zona, cargo que ocupa, o número e data de filiação ao  PSB.<br />II - Do Municipal para o Estadual<br />a) Os documentos constantes das letras "a" e "b" , do item anterior;<br />b) Relação de todos os filiados recadastrados no município até a data do Congresso;<br />c) Relação dos nomes dos filiados detentores de mandatos, no município, em qualquer nível, com endereço e CPF;<br />d) Endereço e CGC do Diretório Municipal;<br />III - Do Estadual para o Nacional<br />a) Cópia do Edital de Convocação do Congresso;<br />b) Relação dos Municípios o­nde o partido está organizado de forma definitiva ou provisório com os seguintes dados:<br />1) Endereço do Diretório Municipal;<br />2) Relação dos membros da Comissão Executiva;<br />3) Nome completo - CPF - endreço - Número Nacional de filiação partidária, título eleitoral, zona seção e data de filiação.<br />c)  Relação, por município, de todos os filiados detentores de mandatos  eletivos, em qualquer nível, contendo os mesmos dados exigidos na letra  anterior.<br /><br />Art. 22 O Presidente da Comissão Executiva  hierarquicamente superior, ao receber o pedido de registro nomeará um  relator, entre os membros da Comissão Executiva, e encaminhará o  expediente à Secretaria do Partido para autuar e numerar o processo de  registro.<br /><br />§ 1º O relator do processo de registro de Comissão  Executiva no Diretório terá o prazo de 10 (dez) dias, a contar da data  do efetivo recebimento do processo, para apresentar o seu relatório;<br /><br />§  2º O prazo estabelecido no parágrafo anterior poderá ser dilatado para  mais 10 (dez) dias se o relator necessitar de determinar diligência ao  Presidente da Comissão Executiva hierarquicamente inferior;<br /><br />§ 3º A  Comissão Executiva encarregada do registro do Diretório e da Executiva  Municipal ou Estadual terá 30 (trinta) dias de prazo para efetuar o  registro.<br /><br />§ 4º Nos casos de negligência do relator quanto ao não  cumprimento dos prazos dos §§ 1º e 2º, deste artigo, o presidente  avocará o processo e a competência, prolatando sua decisão no prazo  improrrogável de 3 (três) dias. <br /><br />Art. 23 O Diretório e a Comissão  Executiva Municipal ou Estadual só poderão exercer os poderes que lhes  confere o Estatuto Partidário, após o deferimento do seu registro  perante a Comissão Executiva hierarquicamente superior.<br />Parágrafo  único. O Congresso partidário que eleger o Diretório Municipal ou  Estadual, outorgará poderes à Comissão Executiva Municipal ou Estadual  provisória para dirigir o Partido até o efetivo deferimento do registro,  pela Comissão Executiva hierarquicamente superior.<br /><br />Art. 24 Após o  deferimento do registro do Diretório e da Comissão Executiva Estadual  ou Municipal, a Comissão Executiva hierarquicamente superior comunicará à  Justiça Eleitoral a sua decisão.<br />Parágrafo único. Somente após a  comunicação à Justiça Eleitoral, prevista neste artigo, A Comissão  Executiva e o Diretório Municipal ou Estadual, poderão exercer as  atribuições que lhes são conferidas pelo Estatuto Partidário.<br /><br /><strong>CAPÍTULO V </strong><br />Dos Recursos e sua Tramitação<br /><br />Art. 25 Aos filiados ao PSB asseguram-se, entre outros, o direito a recorrer de decisões dos órgãos partidários.<br /><br />§  1º O recurso previsto neste artigo deve ser interposto no prazo máximo  de 10 (dez) dias, a contar da data em que o filiado for notificado  oficialmente por escrito da decisão do órgão partidário a quo.  (inferior).<br /><br />§ 2º O recurso pode ser interposto independente da notificação prevista no parágrafo anterior.<br /><br />Art.  26 O Presidente do órgão hierarquicamente superior, ao receber o  recurso designará um relator, dentre os membros da Comissão Executiva,  no prazo máximo de dez dias, a contar do recebimento.<br /><br />Art. 27 O  relator do recurso apresentará o relatório no prazo máximo de 20 (vinte)  dias úteis, a contar do efetivo recebimento do processo.<br /><br />§ 1º O relator ouvirá, obrigatoriamente, as razões das partes, assinalando para tal fim o prazo máximo de 10 (dez) dias úteis.<br /><br />§ 2º O relator poderá atribuir ao recurso o efeito suspensivo, ou recebê-lo somente no efeito devolutivo.<br /><br /><br /><strong>CAPÍTULO VI </strong><br />Das Intervenções<br /><br />Art.  28 Os Diretórios do PSB intervirão, por prazo e duração certa, nos  órgãos hierarquicamente subordinados mediante decisão de, pelo menos 60 %  (sessenta por cento) de seus membros, para:<br />I Manter a integridade partidária;<br />II Assegurar a disciplina;<br />III  Impedir acordo de participação governamental e coligação que contrarie  as normas pertinentes contidas no Estatuto Partidário;<br />IV Garantir o controle das finanças;<br />V Preservar normas estatutárias, a ética partidária e as diretrizes políticas fixadas pelos órgãos competentes.<br /><br />§  1º A decretação de intervenção deverá ser precedida de audiência, no  prazo máximo de 8 (oito) dias, do órgão objeto da intervenção.<br /><br />§ 2º A intervenção realizada em desobediência às normas previstas no Estatuto Partidário e neste Regimento, será nula.<br /><br />Art.  29 Da decisão que decretar intervenção, cabe, no prazo de 5 (cinco  dias), recurso ao Diretório hierarquicamente superior, facultado ao  relator atribuir-lhe o efeito suspensivo.<br /><br />§ 1º Se o recurso  interposto contra a decretação de intervenção não for julgado no prazo  máximo de 30 (trinta dias), o ato de intervenção será suspenso até o  julgamento do recurso.<br /><br />Art. 30 Do ato de intervenção será editado decreto do qual deverá constar as razões da decisão.<br /><br />§  1º A decisão sobre intervenção em órgão partidário, só passa a viger  após a publicação em jornal de circulação na respectiva jurisdição ou  afixado na sede do Partido, o decreto a que se refere este artigo.<br /><br />Art.  31 O recadastramento dos filiados ao PSB será realizado sempre, no  período e na forma que determinar a Comissão Executiva Nacional do  Partido.<br /><br />§ 1º A contribuição partidária estatutária obrigatória,  vencida se constitui crédito líquido e certo do partido, para todos os  fins de direito.<br /><br />§ 2º A validade da filiação ou recadastramento  se vincula, obrigatoriamente ao pagamento da contribuição partidária  estatutária e ao preenchimento de todas as demais formalidades legais,  estatutárias, éticas e regimentais, sob pena de sua anulabilidade.<br /><br />§  3º Os gastos eleitorais do candidato ou contribuições voluntárias não  exime e nem desobriga o filiado ao pagamento de contribuição partidária  estatutária obrigatória.<br /><br />Art. 32 São livros obrigatórios para o Diretório do PSB em qualquer nível:<br />a) Os Livros Contábeis - CAIXA e DIÁRIO;<br />b) O Livro de Atas de Reuniões do Diretório e da Comissão Executiva;<br />c) O Livro de Atas do Congresso Respectivo.<br /><br />Art.  33 O presente Regimento Interno entrará em vigor após sua aprovação  pelo Diretório Nacional e publicação no Diário Oficial da União.<br /><br /><br />Brasília, 2 de fevereiro de 1997.<br />MIGUEL ARRAES DE ALENCAR <br />Presidente Nacional do Partido Socialista Brasileiro – PSB<br /><br />CARLOS SIQUEIRA <br />Primeiro Secretário da Comissão Executiva Nacional do PSB</span></div>', '', 1, 2, 0, 3, '2011-03-04 22:50:13', 62, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2011-03-04 22:50:13', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 1, '', '', 0, 4, 'robots=\nauthor=');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_content_frontpage`
--

CREATE TABLE IF NOT EXISTS `jos_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_content_frontpage`
--

INSERT INTO `jos_content_frontpage` (`content_id`, `ordering`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_content_rating`
--

CREATE TABLE IF NOT EXISTS `jos_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(11) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(11) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_content_rating`
--

INSERT INTO `jos_content_rating` (`content_id`, `rating_sum`, `rating_count`, `lastip`) VALUES
(1, 5, 1, '127.0.0.1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_acl_aro`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_value` varchar(240) NOT NULL DEFAULT '0',
  `value` varchar(240) NOT NULL DEFAULT '',
  `order_value` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `jos_section_value_value_aro` (`section_value`(100),`value`(100)),
  KEY `jos_gacl_hidden_aro` (`hidden`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `jos_core_acl_aro`
--

INSERT INTO `jos_core_acl_aro` (`id`, `section_value`, `value`, `order_value`, `name`, `hidden`) VALUES
(10, 'users', '62', 0, 'Administrator', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_acl_aro_groups`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `jos_gacl_parent_id_aro_groups` (`parent_id`),
  KEY `jos_gacl_lft_rgt_aro_groups` (`lft`,`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Extraindo dados da tabela `jos_core_acl_aro_groups`
--

INSERT INTO `jos_core_acl_aro_groups` (`id`, `parent_id`, `name`, `lft`, `rgt`, `value`) VALUES
(17, 0, 'ROOT', 1, 22, 'ROOT'),
(28, 17, 'USERS', 2, 21, 'USERS'),
(29, 28, 'Public Frontend', 3, 12, 'Public Frontend'),
(18, 29, 'Registered', 4, 11, 'Registered'),
(19, 18, 'Author', 5, 10, 'Author'),
(20, 19, 'Editor', 6, 9, 'Editor'),
(21, 20, 'Publisher', 7, 8, 'Publisher'),
(30, 28, 'Public Backend', 13, 20, 'Public Backend'),
(23, 30, 'Manager', 14, 19, 'Manager'),
(24, 23, 'Administrator', 15, 18, 'Administrator'),
(25, 24, 'Super Administrator', 16, 17, 'Super Administrator');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_acl_aro_map`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro_map` (
  `acl_id` int(11) NOT NULL DEFAULT '0',
  `section_value` varchar(230) NOT NULL DEFAULT '0',
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`acl_id`,`section_value`,`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_core_acl_aro_map`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_acl_aro_sections`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(230) NOT NULL DEFAULT '',
  `order_value` int(11) NOT NULL DEFAULT '0',
  `name` varchar(230) NOT NULL DEFAULT '',
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `jos_gacl_value_aro_sections` (`value`),
  KEY `jos_gacl_hidden_aro_sections` (`hidden`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `jos_core_acl_aro_sections`
--

INSERT INTO `jos_core_acl_aro_sections` (`id`, `value`, `order_value`, `name`, `hidden`) VALUES
(10, 'users', 1, 'Users', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_acl_groups_aro_map`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_groups_aro_map` (
  `group_id` int(11) NOT NULL DEFAULT '0',
  `section_value` varchar(240) NOT NULL DEFAULT '',
  `aro_id` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `group_id_aro_id_groups_aro_map` (`group_id`,`section_value`,`aro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_core_acl_groups_aro_map`
--

INSERT INTO `jos_core_acl_groups_aro_map` (`group_id`, `section_value`, `aro_id`) VALUES
(25, '', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_log_items`
--

CREATE TABLE IF NOT EXISTS `jos_core_log_items` (
  `time_stamp` date NOT NULL DEFAULT '0000-00-00',
  `item_table` varchar(50) NOT NULL DEFAULT '',
  `item_id` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_core_log_items`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_log_searches`
--

CREATE TABLE IF NOT EXISTS `jos_core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_core_log_searches`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_groups`
--

CREATE TABLE IF NOT EXISTS `jos_groups` (
  `id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_groups`
--

INSERT INTO `jos_groups` (`id`, `name`) VALUES
(0, 'Public'),
(1, 'Registered'),
(2, 'Special');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_jce_groups`
--

CREATE TABLE IF NOT EXISTS `jos_jce_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `users` text NOT NULL,
  `types` varchar(255) NOT NULL,
  `components` text NOT NULL,
  `rows` text NOT NULL,
  `plugins` varchar(255) NOT NULL,
  `published` tinyint(3) NOT NULL,
  `ordering` int(11) NOT NULL,
  `checked_out` tinyint(3) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `jos_jce_groups`
--

INSERT INTO `jos_jce_groups` (`id`, `name`, `description`, `users`, `types`, `components`, `rows`, `plugins`, `published`, `ordering`, `checked_out`, `checked_out_time`, `params`) VALUES
(1, 'Default', 'Default group for all users with edit access', '', '19,20,21,23,24,25', '', '5,6,7,8,9,10,11,12,13,14,15,16,17,18;19,20,21,22,23,24,25,26,27,29,30,31,34,46;35,36,37,38,39,40,41,42,43,44,45;47,48,49,50,51,52,53,55,56', '1,2,3,4,5,19,20,35,36,37,38,39,40,47,48,49,50,51,52,53,55,56', 1, 1, 0, '0000-00-00 00:00:00', ''),
(2, 'Front End', 'Sample Group for Authors, Editors, Publishers', '', '19,20,21', '', '5,6,7,8,9,12,13,14,15,16,17,18,26,27;19,20,24,25,29,30,34,41,42,43,45,46,48,49;23,31,37,38,40,44,47,50,51,52,53,55,56', '5,19,20,48,49,1,3,37,38,40,47,50,51,52,53,55,56', 0, 2, 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_jce_plugins`
--

CREATE TABLE IF NOT EXISTS `jos_jce_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `layout` varchar(255) NOT NULL,
  `row` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(3) NOT NULL,
  `editable` tinyint(3) NOT NULL,
  `iscore` tinyint(3) NOT NULL,
  `elements` varchar(255) NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plugin` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Extraindo dados da tabela `jos_jce_plugins`
--

INSERT INTO `jos_jce_plugins` (`id`, `title`, `name`, `type`, `icon`, `layout`, `row`, `ordering`, `published`, `editable`, `iscore`, `elements`, `checked_out`, `checked_out_time`) VALUES
(1, 'Context Menu', 'contextmenu', 'plugin', '', '', 0, 0, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(2, 'File Browser', 'browser', 'plugin', '', '', 0, 0, 1, 1, 1, '', 0, '0000-00-00 00:00:00'),
(3, 'Inline Popups', 'inlinepopups', 'plugin', '', '', 0, 0, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(4, 'Media Support', 'media', 'plugin', '', '', 0, 0, 1, 1, 1, '', 0, '0000-00-00 00:00:00'),
(5, 'Help', 'help', 'plugin', 'help', 'help', 1, 1, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(6, 'New Document', 'newdocument', 'command', 'newdocument', 'newdocument', 1, 2, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(7, 'Bold', 'bold', 'command', 'bold', 'bold', 1, 3, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(8, 'Italic', 'italic', 'command', 'italic', 'italic', 1, 4, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(9, 'Underline', 'underline', 'command', 'underline', 'underline', 1, 5, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(10, 'Font Select', 'fontselect', 'command', 'fontselect', 'fontselect', 1, 6, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(11, 'Font Size Select', 'fontsizeselect', 'command', 'fontsizeselect', 'fontsizeselect', 1, 7, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(12, 'Style Select', 'styleselect', 'command', 'styleselect', 'styleselect', 1, 8, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(13, 'StrikeThrough', 'strikethrough', 'command', 'strikethrough', 'strikethrough', 1, 9, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(14, 'Justify Full', 'full', 'command', 'justifyfull', 'justifyfull', 1, 10, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(15, 'Justify Center', 'center', 'command', 'justifycenter', 'justifycenter', 1, 11, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(16, 'Justify Left', 'left', 'command', 'justifyleft', 'justifyleft', 1, 12, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(17, 'Justify Right', 'right', 'command', 'justifyright', 'justifyright', 1, 13, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(18, 'Format Select', 'formatselect', 'command', 'formatselect', 'formatselect', 1, 14, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(19, 'Paste', 'paste', 'plugin', 'cut,copy,paste', 'paste', 2, 1, 1, 1, 1, '', 0, '0000-00-00 00:00:00'),
(20, 'Search Replace', 'searchreplace', 'plugin', 'search,replace', 'searchreplace', 2, 2, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(21, 'Font ForeColour', 'forecolor', 'command', 'forecolor', 'forecolor', 2, 3, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(22, 'Font BackColour', 'backcolor', 'command', 'backcolor', 'backcolor', 2, 4, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(23, 'Unlink', 'unlink', 'command', 'unlink', 'unlink', 2, 5, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(24, 'Indent', 'indent', 'command', 'indent', 'indent', 2, 6, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(25, 'Outdent', 'outdent', 'command', 'outdent', 'outdent', 2, 7, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(26, 'Undo', 'undo', 'command', 'undo', 'undo', 2, 8, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(27, 'Redo', 'redo', 'command', 'redo', 'redo', 2, 9, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(28, 'HTML', 'html', 'command', 'code', 'code', 2, 10, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(29, 'Numbered List', 'numlist', 'command', 'numlist', 'numlist', 2, 11, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(30, 'Bullet List', 'bullist', 'command', 'bullist', 'bullist', 2, 12, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(31, 'Anchor', 'anchor', 'command', 'anchor', 'anchor', 2, 13, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(32, 'Image', 'image', 'command', 'image', 'image', 2, 14, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(33, 'Link', 'link', 'command', 'link', 'link', 2, 15, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(34, 'Code Cleanup', 'cleanup', 'command', 'cleanup', 'cleanup', 2, 16, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(35, 'Directionality', 'directionality', 'plugin', 'ltr,rtl', 'directionality', 3, 1, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(36, 'Emotions', 'emotions', 'plugin', 'emotions', 'emotions', 3, 2, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(37, 'Fullscreen', 'fullscreen', 'plugin', 'fullscreen', 'fullscreen', 3, 3, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(38, 'Preview', 'preview', 'plugin', 'preview', 'preview', 3, 4, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(39, 'Tables', 'table', 'plugin', 'tablecontrols', 'buttons', 3, 5, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(40, 'Print', 'print', 'plugin', 'print', 'print', 3, 6, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(41, 'Horizontal Rule', 'hr', 'command', 'hr', 'hr', 3, 7, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(42, 'Subscript', 'sub', 'command', 'sub', 'sub', 3, 8, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(43, 'Superscript', 'sup', 'command', 'sup', 'sup', 3, 9, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(44, 'Visual Aid', 'visualaid', 'command', 'visualaid', 'visualaid', 3, 10, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(45, 'Character Map', 'charmap', 'command', 'charmap', 'charmap', 3, 11, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(46, 'Remove Format', 'removeformat', 'command', 'removeformat', 'removeformat', 2, 1, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(47, 'Styles', 'style', 'plugin', 'styleprops', 'style', 4, 1, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(48, 'Non-Breaking', 'nonbreaking', 'plugin', 'nonbreaking', 'nonbreaking', 4, 2, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(49, 'Visual Characters', 'visualchars', 'plugin', 'visualchars', 'visualchars', 4, 3, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(50, 'XHTML Xtras', 'xhtmlxtras', 'plugin', 'cite,abbr,acronym,del,ins,attribs', 'xhtmlxtras', 4, 4, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(51, 'Image Manager', 'imgmanager', 'plugin', 'imgmanager', 'imgmanager', 4, 5, 1, 1, 1, '', 0, '0000-00-00 00:00:00'),
(52, 'Advanced Link', 'advlink', 'plugin', 'advlink', 'advlink', 4, 6, 1, 1, 1, '', 0, '0000-00-00 00:00:00'),
(53, 'Spell Checker', 'spellchecker', 'plugin', 'spellchecker', 'spellchecker', 4, 7, 1, 1, 1, '', 0, '0000-00-00 00:00:00'),
(54, 'Layers', 'layer', 'plugin', 'insertlayer,moveforward,movebackward,absolute', 'layer', 4, 8, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(55, 'Advanced Code Editor', 'advcode', 'plugin', 'advcode', 'advcode', 4, 9, 1, 0, 1, '', 0, '0000-00-00 00:00:00'),
(56, 'Article Breaks', 'article', 'plugin', 'readmore,pagebreak', 'article', 4, 10, 1, 0, 1, '', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_joomgallery`
--

CREATE TABLE IF NOT EXISTS `jos_joomgallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `imgtitle` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `imgauthor` varchar(50) DEFAULT NULL,
  `imgtext` text NOT NULL,
  `imgdate` datetime NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `imgvotes` int(11) NOT NULL DEFAULT '0',
  `imgvotesum` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `imgfilename` varchar(100) NOT NULL DEFAULT '',
  `imgthumbname` varchar(100) NOT NULL DEFAULT '',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `owner` int(11) unsigned NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `useruploaded` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_catid` (`catid`),
  KEY `idx_owner` (`owner`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_joomgallery`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_joomgallery_catg`
--

CREATE TABLE IF NOT EXISTS `jos_joomgallery_catg` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `parent` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `published` char(1) NOT NULL DEFAULT '0',
  `owner` int(11) DEFAULT '0',
  `catimage` varchar(100) DEFAULT NULL,
  `img_position` int(10) DEFAULT '0',
  `catpath` varchar(255) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `idx_parent` (`parent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_joomgallery_catg`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_joomgallery_comments`
--

CREATE TABLE IF NOT EXISTS `jos_joomgallery_comments` (
  `cmtid` int(11) NOT NULL AUTO_INCREMENT,
  `cmtpic` int(11) NOT NULL DEFAULT '0',
  `cmtip` varchar(15) NOT NULL DEFAULT '',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `cmtname` varchar(50) NOT NULL DEFAULT '',
  `cmttext` text NOT NULL,
  `cmtdate` datetime NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cmtid`),
  KEY `idx_cmtpic` (`cmtpic`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_joomgallery_comments`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_joomgallery_config`
--

CREATE TABLE IF NOT EXISTS `jos_joomgallery_config` (
  `id` int(1) NOT NULL DEFAULT '0',
  `jg_pathimages` varchar(50) NOT NULL,
  `jg_pathoriginalimages` varchar(50) NOT NULL,
  `jg_paththumbs` varchar(50) NOT NULL,
  `jg_pathftpupload` varchar(50) NOT NULL,
  `jg_pathtemp` varchar(50) NOT NULL,
  `jg_wmpath` varchar(50) NOT NULL,
  `jg_wmfile` varchar(50) NOT NULL,
  `jg_dateformat` varchar(50) NOT NULL,
  `jg_checkupdate` int(1) NOT NULL,
  `jg_filenamewithjs` int(1) NOT NULL,
  `jg_filenamesearch` varchar(50) NOT NULL,
  `jg_filenamereplace` varchar(50) NOT NULL,
  `jg_thumbcreation` varchar(5) NOT NULL,
  `jg_fastgd2thumbcreation` int(1) NOT NULL,
  `jg_impath` varchar(50) NOT NULL,
  `jg_resizetomaxwidth` int(1) NOT NULL,
  `jg_maxwidth` int(5) NOT NULL,
  `jg_picturequality` int(3) NOT NULL,
  `jg_useforresizedirection` int(1) NOT NULL,
  `jg_cropposition` int(1) NOT NULL,
  `jg_thumbwidth` int(5) NOT NULL,
  `jg_thumbheight` int(5) NOT NULL,
  `jg_thumbquality` int(3) NOT NULL,
  `jg_uploadorder` int(1) NOT NULL,
  `jg_useorigfilename` int(1) NOT NULL,
  `jg_filenamenumber` int(1) NOT NULL,
  `jg_delete_original` int(1) NOT NULL,
  `jg_wrongvaluecolor` varchar(10) NOT NULL,
  `jg_msg_upload_type` int(1) NOT NULL,
  `jg_msg_upload_recipients` text NOT NULL,
  `jg_msg_comment_type` int(1) NOT NULL,
  `jg_msg_comment_recipients` text NOT NULL,
  `jg_msg_comment_toowner` int(1) NOT NULL,
  `jg_msg_report_type` int(1) NOT NULL,
  `jg_msg_report_recipients` text NOT NULL,
  `jg_msg_report_toowner` int(1) NOT NULL,
  `jg_realname` int(1) NOT NULL,
  `jg_cooliris` int(1) NOT NULL,
  `jg_coolirislink` int(1) NOT NULL,
  `jg_contentpluginsenabled` int(1) NOT NULL,
  `jg_itemid` varchar(10) NOT NULL,
  `jg_userspace` int(1) NOT NULL,
  `jg_approve` int(1) NOT NULL,
  `jg_usercat` int(1) NOT NULL,
  `jg_maxusercat` int(5) NOT NULL,
  `jg_userowncatsupload` int(1) NOT NULL,
  `jg_maxuserimage` int(9) NOT NULL,
  `jg_maxfilesize` int(9) NOT NULL,
  `jg_category` text NOT NULL,
  `jg_usercategory` text NOT NULL,
  `jg_usercatacc` int(1) NOT NULL,
  `jg_useruploadsingle` int(1) NOT NULL,
  `jg_maxuploadfields` int(3) NOT NULL,
  `jg_useruploadbatch` int(1) NOT NULL,
  `jg_useruploadjava` int(1) NOT NULL,
  `jg_useruploadnumber` int(1) NOT NULL,
  `jg_special_gif_upload` int(1) NOT NULL,
  `jg_delete_original_user` int(1) NOT NULL,
  `jg_newpiccopyright` int(1) NOT NULL,
  `jg_newpicnote` int(1) NOT NULL,
  `jg_showrating` int(1) NOT NULL,
  `jg_maxvoting` int(1) NOT NULL,
  `jg_ratingcalctype` int(1) NOT NULL,
  `jg_ratingdisplaytype` int(1) NOT NULL,
  `jg_ajaxrating` int(1) NOT NULL,
  `jg_onlyreguservotes` int(1) NOT NULL,
  `jg_showcomment` int(1) NOT NULL,
  `jg_anoncomment` int(1) NOT NULL,
  `jg_namedanoncomment` int(1) NOT NULL,
  `jg_approvecom` int(1) NOT NULL,
  `jg_bbcodesupport` int(1) NOT NULL,
  `jg_smiliesupport` int(1) NOT NULL,
  `jg_anismilie` int(1) NOT NULL,
  `jg_smiliescolor` varchar(10) NOT NULL,
  `jg_anchors` int(1) NOT NULL,
  `jg_tooltips` int(1) NOT NULL,
  `jg_dyncrop` int(1) NOT NULL,
  `jg_dyncropposition` int(1) NOT NULL,
  `jg_dyncropwidth` int(5) NOT NULL,
  `jg_dyncropheight` int(5) NOT NULL,
  `jg_firstorder` varchar(20) NOT NULL,
  `jg_secondorder` varchar(20) NOT NULL,
  `jg_thirdorder` varchar(20) NOT NULL,
  `jg_pagetitle_cat` text NOT NULL,
  `jg_pagetitle_detail` text NOT NULL,
  `jg_showgalleryhead` int(1) NOT NULL,
  `jg_showpathway` int(1) NOT NULL,
  `jg_completebreadcrumbs` int(1) NOT NULL,
  `jg_search` int(1) NOT NULL,
  `jg_showallpics` int(1) NOT NULL,
  `jg_showallhits` int(1) NOT NULL,
  `jg_showbacklink` int(1) NOT NULL,
  `jg_suppresscredits` int(1) NOT NULL,
  `jg_showuserpanel` int(1) NOT NULL,
  `jg_showallpicstoadmin` int(1) NOT NULL,
  `jg_showminithumbs` int(1) NOT NULL,
  `jg_openjs_padding` int(3) NOT NULL,
  `jg_openjs_background` varchar(10) NOT NULL,
  `jg_dhtml_border` varchar(10) NOT NULL,
  `jg_show_title_in_dhtml` int(1) NOT NULL,
  `jg_show_description_in_dhtml` int(1) NOT NULL,
  `jg_lightbox_speed` int(3) NOT NULL,
  `jg_lightbox_slide_all` int(1) NOT NULL,
  `jg_resize_js_image` int(1) NOT NULL,
  `jg_disable_rightclick_original` int(1) NOT NULL,
  `jg_showgallerysubhead` int(1) NOT NULL,
  `jg_showallcathead` int(1) NOT NULL,
  `jg_colcat` int(1) NOT NULL,
  `jg_catperpage` int(1) NOT NULL,
  `jg_ordercatbyalpha` int(1) NOT NULL,
  `jg_showgallerypagenav` int(1) NOT NULL,
  `jg_showcatcount` int(1) NOT NULL,
  `jg_showcatthumb` int(1) NOT NULL,
  `jg_showrandomcatthumb` int(1) NOT NULL,
  `jg_ctalign` int(1) NOT NULL,
  `jg_showtotalcatimages` int(1) NOT NULL,
  `jg_showtotalcathits` int(1) NOT NULL,
  `jg_showcatasnew` int(1) NOT NULL,
  `jg_catdaysnew` int(3) NOT NULL,
  `jg_showdescriptioningalleryview` int(1) NOT NULL,
  `jg_rmsm` int(1) NOT NULL,
  `jg_showrmsmcats` int(1) NOT NULL,
  `jg_showsubsingalleryview` int(1) NOT NULL,
  `jg_showcathead` int(1) NOT NULL,
  `jg_usercatorder` int(1) NOT NULL,
  `jg_usercatorderlist` varchar(50) NOT NULL,
  `jg_showcatdescriptionincat` int(1) NOT NULL,
  `jg_showpagenav` int(1) NOT NULL,
  `jg_showpiccount` int(1) NOT NULL,
  `jg_perpage` int(3) NOT NULL,
  `jg_catthumbalign` int(1) NOT NULL,
  `jg_colnumb` int(3) NOT NULL,
  `jg_detailpic_open` int(1) NOT NULL,
  `jg_lightboxbigpic` int(1) NOT NULL,
  `jg_showtitle` int(1) NOT NULL,
  `jg_showpicasnew` int(1) NOT NULL,
  `jg_daysnew` int(3) NOT NULL,
  `jg_showhits` int(1) NOT NULL,
  `jg_showauthor` int(1) NOT NULL,
  `jg_showowner` int(1) NOT NULL,
  `jg_showcatcom` int(1) NOT NULL,
  `jg_showcatrate` int(1) NOT NULL,
  `jg_showcatdescription` int(1) NOT NULL,
  `jg_showcategorydownload` int(1) NOT NULL,
  `jg_showcategoryfavourite` int(1) NOT NULL,
  `jg_category_report_images` int(1) NOT NULL,
  `jg_showsubcathead` int(1) NOT NULL,
  `jg_showsubcatcount` int(1) NOT NULL,
  `jg_colsubcat` int(3) NOT NULL,
  `jg_subperpage` int(3) NOT NULL,
  `jg_showpagenavsubs` int(1) NOT NULL,
  `jg_subcatthumbalign` int(1) NOT NULL,
  `jg_showsubthumbs` int(1) NOT NULL,
  `jg_showrandomsubthumb` int(1) NOT NULL,
  `jg_showdescriptionincategoryview` int(1) NOT NULL,
  `jg_ordersubcatbyalpha` int(1) NOT NULL,
  `jg_showtotalsubcatimages` int(1) NOT NULL,
  `jg_showtotalsubcathits` int(1) NOT NULL,
  `jg_showdetailpage` int(1) NOT NULL,
  `jg_showdetailnumberofpics` int(1) NOT NULL,
  `jg_cursor_navigation` int(1) NOT NULL,
  `jg_disable_rightclick_detail` int(1) NOT NULL,
  `jg_detail_report_images` int(1) NOT NULL,
  `jg_report_images_notauth` int(1) NOT NULL,
  `jg_showdetailtitle` int(1) NOT NULL,
  `jg_showdetail` int(1) NOT NULL,
  `jg_showdetailaccordion` int(1) NOT NULL,
  `jg_showdetaildescription` int(1) NOT NULL,
  `jg_showdetaildatum` int(1) NOT NULL,
  `jg_showdetailhits` int(1) NOT NULL,
  `jg_showdetailrating` int(1) NOT NULL,
  `jg_showdetailfilesize` int(1) NOT NULL,
  `jg_showdetailauthor` int(1) NOT NULL,
  `jg_showoriginalfilesize` int(1) NOT NULL,
  `jg_showdetaildownload` int(1) NOT NULL,
  `jg_downloadfile` int(1) NOT NULL,
  `jg_downloadwithwatermark` int(1) NOT NULL,
  `jg_watermark` int(1) NOT NULL,
  `jg_watermarkpos` int(1) NOT NULL,
  `jg_bigpic` int(1) NOT NULL,
  `jg_bigpic_open` int(1) NOT NULL,
  `jg_bbcodelink` int(1) NOT NULL,
  `jg_showcommentsunreg` int(1) NOT NULL,
  `jg_showcommentsarea` int(1) NOT NULL,
  `jg_send2friend` int(1) NOT NULL,
  `jg_minis` int(1) NOT NULL,
  `jg_motionminis` int(1) NOT NULL,
  `jg_motionminiWidth` int(3) NOT NULL,
  `jg_motionminiHeight` int(3) NOT NULL,
  `jg_miniWidth` int(3) NOT NULL,
  `jg_miniHeight` int(3) NOT NULL,
  `jg_minisprop` int(1) NOT NULL,
  `jg_nameshields` int(1) NOT NULL,
  `jg_nameshields_others` int(1) NOT NULL,
  `jg_nameshields_unreg` int(1) NOT NULL,
  `jg_show_nameshields_unreg` int(1) NOT NULL,
  `jg_nameshields_height` int(3) NOT NULL,
  `jg_nameshields_width` int(3) NOT NULL,
  `jg_slideshow` int(1) NOT NULL,
  `jg_slideshow_timer` int(3) NOT NULL,
  `jg_slideshow_transition` int(1) NOT NULL,
  `jg_slideshow_transtime` int(3) NOT NULL,
  `jg_slideshow_maxdimauto` int(1) NOT NULL,
  `jg_slideshow_width` int(3) NOT NULL,
  `jg_slideshow_heigth` int(3) NOT NULL,
  `jg_slideshow_infopane` int(1) NOT NULL,
  `jg_slideshow_carousel` int(1) NOT NULL,
  `jg_slideshow_arrows` int(1) NOT NULL,
  `jg_showexifdata` int(1) NOT NULL,
  `jg_geotagging` text NOT NULL,
  `jg_subifdtags` text NOT NULL,
  `jg_ifdotags` text NOT NULL,
  `jg_gpstags` text NOT NULL,
  `jg_showiptcdata` int(1) NOT NULL,
  `jg_iptctags` text NOT NULL,
  `jg_showtoplist` int(1) NOT NULL,
  `jg_toplist` int(3) NOT NULL,
  `jg_topthumbalign` int(1) NOT NULL,
  `jg_toptextalign` int(1) NOT NULL,
  `jg_toplistcols` int(3) NOT NULL,
  `jg_whereshowtoplist` int(1) NOT NULL,
  `jg_showrate` int(1) NOT NULL,
  `jg_showlatest` int(1) NOT NULL,
  `jg_showcom` int(1) NOT NULL,
  `jg_showthiscomment` int(1) NOT NULL,
  `jg_showmostviewed` int(1) NOT NULL,
  `jg_favourites` int(1) NOT NULL,
  `jg_showdetailfavourite` int(1) NOT NULL,
  `jg_favouritesshownotauth` int(1) NOT NULL,
  `jg_maxfavourites` int(5) NOT NULL,
  `jg_zipdownload` int(1) NOT NULL,
  `jg_usefavouritesforpubliczip` int(1) NOT NULL,
  `jg_usefavouritesforzip` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_joomgallery_config`
--

INSERT INTO `jos_joomgallery_config` (`id`, `jg_pathimages`, `jg_pathoriginalimages`, `jg_paththumbs`, `jg_pathftpupload`, `jg_pathtemp`, `jg_wmpath`, `jg_wmfile`, `jg_dateformat`, `jg_checkupdate`, `jg_filenamewithjs`, `jg_filenamesearch`, `jg_filenamereplace`, `jg_thumbcreation`, `jg_fastgd2thumbcreation`, `jg_impath`, `jg_resizetomaxwidth`, `jg_maxwidth`, `jg_picturequality`, `jg_useforresizedirection`, `jg_cropposition`, `jg_thumbwidth`, `jg_thumbheight`, `jg_thumbquality`, `jg_uploadorder`, `jg_useorigfilename`, `jg_filenamenumber`, `jg_delete_original`, `jg_wrongvaluecolor`, `jg_msg_upload_type`, `jg_msg_upload_recipients`, `jg_msg_comment_type`, `jg_msg_comment_recipients`, `jg_msg_comment_toowner`, `jg_msg_report_type`, `jg_msg_report_recipients`, `jg_msg_report_toowner`, `jg_realname`, `jg_cooliris`, `jg_coolirislink`, `jg_contentpluginsenabled`, `jg_itemid`, `jg_userspace`, `jg_approve`, `jg_usercat`, `jg_maxusercat`, `jg_userowncatsupload`, `jg_maxuserimage`, `jg_maxfilesize`, `jg_category`, `jg_usercategory`, `jg_usercatacc`, `jg_useruploadsingle`, `jg_maxuploadfields`, `jg_useruploadbatch`, `jg_useruploadjava`, `jg_useruploadnumber`, `jg_special_gif_upload`, `jg_delete_original_user`, `jg_newpiccopyright`, `jg_newpicnote`, `jg_showrating`, `jg_maxvoting`, `jg_ratingcalctype`, `jg_ratingdisplaytype`, `jg_ajaxrating`, `jg_onlyreguservotes`, `jg_showcomment`, `jg_anoncomment`, `jg_namedanoncomment`, `jg_approvecom`, `jg_bbcodesupport`, `jg_smiliesupport`, `jg_anismilie`, `jg_smiliescolor`, `jg_anchors`, `jg_tooltips`, `jg_dyncrop`, `jg_dyncropposition`, `jg_dyncropwidth`, `jg_dyncropheight`, `jg_firstorder`, `jg_secondorder`, `jg_thirdorder`, `jg_pagetitle_cat`, `jg_pagetitle_detail`, `jg_showgalleryhead`, `jg_showpathway`, `jg_completebreadcrumbs`, `jg_search`, `jg_showallpics`, `jg_showallhits`, `jg_showbacklink`, `jg_suppresscredits`, `jg_showuserpanel`, `jg_showallpicstoadmin`, `jg_showminithumbs`, `jg_openjs_padding`, `jg_openjs_background`, `jg_dhtml_border`, `jg_show_title_in_dhtml`, `jg_show_description_in_dhtml`, `jg_lightbox_speed`, `jg_lightbox_slide_all`, `jg_resize_js_image`, `jg_disable_rightclick_original`, `jg_showgallerysubhead`, `jg_showallcathead`, `jg_colcat`, `jg_catperpage`, `jg_ordercatbyalpha`, `jg_showgallerypagenav`, `jg_showcatcount`, `jg_showcatthumb`, `jg_showrandomcatthumb`, `jg_ctalign`, `jg_showtotalcatimages`, `jg_showtotalcathits`, `jg_showcatasnew`, `jg_catdaysnew`, `jg_showdescriptioningalleryview`, `jg_rmsm`, `jg_showrmsmcats`, `jg_showsubsingalleryview`, `jg_showcathead`, `jg_usercatorder`, `jg_usercatorderlist`, `jg_showcatdescriptionincat`, `jg_showpagenav`, `jg_showpiccount`, `jg_perpage`, `jg_catthumbalign`, `jg_colnumb`, `jg_detailpic_open`, `jg_lightboxbigpic`, `jg_showtitle`, `jg_showpicasnew`, `jg_daysnew`, `jg_showhits`, `jg_showauthor`, `jg_showowner`, `jg_showcatcom`, `jg_showcatrate`, `jg_showcatdescription`, `jg_showcategorydownload`, `jg_showcategoryfavourite`, `jg_category_report_images`, `jg_showsubcathead`, `jg_showsubcatcount`, `jg_colsubcat`, `jg_subperpage`, `jg_showpagenavsubs`, `jg_subcatthumbalign`, `jg_showsubthumbs`, `jg_showrandomsubthumb`, `jg_showdescriptionincategoryview`, `jg_ordersubcatbyalpha`, `jg_showtotalsubcatimages`, `jg_showtotalsubcathits`, `jg_showdetailpage`, `jg_showdetailnumberofpics`, `jg_cursor_navigation`, `jg_disable_rightclick_detail`, `jg_detail_report_images`, `jg_report_images_notauth`, `jg_showdetailtitle`, `jg_showdetail`, `jg_showdetailaccordion`, `jg_showdetaildescription`, `jg_showdetaildatum`, `jg_showdetailhits`, `jg_showdetailrating`, `jg_showdetailfilesize`, `jg_showdetailauthor`, `jg_showoriginalfilesize`, `jg_showdetaildownload`, `jg_downloadfile`, `jg_downloadwithwatermark`, `jg_watermark`, `jg_watermarkpos`, `jg_bigpic`, `jg_bigpic_open`, `jg_bbcodelink`, `jg_showcommentsunreg`, `jg_showcommentsarea`, `jg_send2friend`, `jg_minis`, `jg_motionminis`, `jg_motionminiWidth`, `jg_motionminiHeight`, `jg_miniWidth`, `jg_miniHeight`, `jg_minisprop`, `jg_nameshields`, `jg_nameshields_others`, `jg_nameshields_unreg`, `jg_show_nameshields_unreg`, `jg_nameshields_height`, `jg_nameshields_width`, `jg_slideshow`, `jg_slideshow_timer`, `jg_slideshow_transition`, `jg_slideshow_transtime`, `jg_slideshow_maxdimauto`, `jg_slideshow_width`, `jg_slideshow_heigth`, `jg_slideshow_infopane`, `jg_slideshow_carousel`, `jg_slideshow_arrows`, `jg_showexifdata`, `jg_geotagging`, `jg_subifdtags`, `jg_ifdotags`, `jg_gpstags`, `jg_showiptcdata`, `jg_iptctags`, `jg_showtoplist`, `jg_toplist`, `jg_topthumbalign`, `jg_toptextalign`, `jg_toplistcols`, `jg_whereshowtoplist`, `jg_showrate`, `jg_showlatest`, `jg_showcom`, `jg_showthiscomment`, `jg_showmostviewed`, `jg_favourites`, `jg_showdetailfavourite`, `jg_favouritesshownotauth`, `jg_maxfavourites`, `jg_zipdownload`, `jg_usefavouritesforpubliczip`, `jg_usefavouritesforzip`) VALUES
(1, 'images/joomgallery/details/', 'images/joomgallery/originals/', 'images/joomgallery/thumbnails/', 'components/com_joomgallery/ftp_upload/', 'administrator/components/com_joomgallery/temp/', 'components/com_joomgallery/assets/images/', 'watermark.png', '%d.%m.%Y %H:%M:%S', 0, 1, 'ä|ö|ü|ß', 'ae|oe|ue|ss', 'gd2', 1, '', 1, 400, 100, 0, 2, 133, 100, 100, 1, 0, 1, 0, '#f00', 2, '', 2, '', 0, 2, '', 0, 0, 0, 0, 1, '', 1, 0, 1, 10, 0, 500, 2000000, '', '', 1, 1, 3, 1, 1, 0, 1, 2, 1, 1, 1, 5, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 'grey', 1, 2, 0, 2, 100, 100, 'ordering ASC', 'imgdate DESC', 'imgtitle DESC', '[! JGS_COMMON_CATEGORY!]: #cat', '[! JGS_COMMON_CATEGORY!]: #cat - [! JGS_COMMON_IMAGE!]:  #img', 1, 1, 1, 1, 3, 1, 3, 1, 3, 1, 1, 10, '#fff', '#808080', 0, 1, 5, 1, 1, 1, 1, 1, 4, 5, 1, 1, 1, 1, 3, 1, 1, 1, 1, 7, 1, 1, 1, 0, 1, 1, 'date,title', 1, 2, 1, 8, 1, 2, 0, 1, 1, 1, 10, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 2, 8, 1, 3, 2, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 2, 1, 0, 9, 2, 6, 3, 1, 2, 1, 1, 2, 400, 50, 28, 28, 2, 0, 1, 1, 0, 10, 6, 1, 6000, 0, 2000, 0, 640, 480, 0, 0, 0, 0, '', '', '', '', 0, '', 2, 12, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_joomgallery_countstop`
--

CREATE TABLE IF NOT EXISTS `jos_joomgallery_countstop` (
  `cspicid` int(11) NOT NULL DEFAULT '0',
  `csip` varchar(20) NOT NULL,
  `cssessionid` varchar(200) DEFAULT NULL,
  `cstime` datetime DEFAULT NULL,
  KEY `idx_cspicid` (`cspicid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_joomgallery_countstop`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_joomgallery_maintenance`
--

CREATE TABLE IF NOT EXISTS `jos_joomgallery_maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `refid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `title` text NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `orig` varchar(255) NOT NULL,
  `thumborphan` int(11) NOT NULL,
  `imgorphan` int(11) NOT NULL,
  `origorphan` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_joomgallery_maintenance`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_joomgallery_nameshields`
--

CREATE TABLE IF NOT EXISTS `jos_joomgallery_nameshields` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `npicid` int(11) NOT NULL DEFAULT '0',
  `nuserid` int(11) unsigned NOT NULL DEFAULT '0',
  `nxvalue` int(11) NOT NULL DEFAULT '0',
  `nyvalue` int(11) NOT NULL DEFAULT '0',
  `by` int(11) NOT NULL DEFAULT '0',
  `nuserip` varchar(15) NOT NULL DEFAULT '0',
  `ndate` datetime NOT NULL,
  `nzindex` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nid`),
  KEY `idx_picid` (`npicid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_joomgallery_nameshields`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_joomgallery_orphans`
--

CREATE TABLE IF NOT EXISTS `jos_joomgallery_orphans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullpath` varchar(255) NOT NULL,
  `type` varchar(7) NOT NULL,
  `refid` int(11) NOT NULL,
  `title` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_joomgallery_orphans`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_joomgallery_users`
--

CREATE TABLE IF NOT EXISTS `jos_joomgallery_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uuserid` int(11) NOT NULL DEFAULT '0',
  `piclist` text,
  `layout` int(1) NOT NULL,
  `time` datetime NOT NULL,
  `zipname` varchar(70) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `idx_uid` (`uuserid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_joomgallery_users`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_joomgallery_votes`
--

CREATE TABLE IF NOT EXISTS `jos_joomgallery_votes` (
  `voteid` int(11) NOT NULL AUTO_INCREMENT,
  `picid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `userip` varchar(15) NOT NULL DEFAULT '0',
  `datevoted` datetime NOT NULL,
  `vote` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`voteid`),
  KEY `idx_picid` (`picid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_joomgallery_votes`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_menu`
--

CREATE TABLE IF NOT EXISTS `jos_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(75) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `link` text,
  `type` varchar(50) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `componentid` int(11) unsigned NOT NULL DEFAULT '0',
  `sublevel` int(11) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pollid` int(11) NOT NULL DEFAULT '0',
  `browserNav` tinyint(4) DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `utaccess` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `lft` int(11) unsigned NOT NULL DEFAULT '0',
  `rgt` int(11) unsigned NOT NULL DEFAULT '0',
  `home` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `componentid` (`componentid`,`menutype`,`published`,`access`),
  KEY `menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `jos_menu`
--

INSERT INTO `jos_menu` (`id`, `menutype`, `name`, `alias`, `link`, `type`, `published`, `parent`, `componentid`, `sublevel`, `ordering`, `checked_out`, `checked_out_time`, `pollid`, `browserNav`, `access`, `utaccess`, `params`, `lft`, `rgt`, `home`) VALUES
(1, 'Menu', 'Home', 'home', 'index.php?option=com_content&view=frontpage', 'component', 1, 0, 20, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'num_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=front\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 1),
(2, 'Menu', 'Cadastre-se no Site', 'cadastrar-no-site', 'index.php?option=com_user&view=register', 'component', 0, 0, 14, 0, 8, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(3, 'Menu', 'Noticias', 'noticias', 'index.php?option=com_content&view=category&id=1', 'component', 1, 0, 20, 0, 7, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'display_num=10\nshow_headings=1\nshow_date=0\ndate_format=\nfilter=1\nfilter_type=title\norderby_sec=\nshow_pagination=1\nshow_pagination_limit=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=0\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=0\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(4, 'Menu', 'Separador', 'separador', '', 'separator', -2, 0, 0, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(5, 'Menu', 'Fotos', 'fotos', 'index.php?option=com_joomgallery&view=gallery', 'component', 1, 0, 34, 0, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(6, 'Menu', 'Institucional', 'institucional', 'index.php?option=com_content&view=category&id=3', 'component', 1, 0, 20, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'display_num=10\nshow_headings=1\nshow_date=0\ndate_format=\nfilter=1\nfilter_type=title\norderby_sec=\nshow_pagination=1\nshow_pagination_limit=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=0\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=0\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(7, 'Menu', 'Eleições', 'eleicoes', 'index.php?option=com_content&view=category&id=4', 'component', 1, 0, 20, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'display_num=10\nshow_headings=1\nshow_date=0\ndate_format=\nfilter=1\nfilter_type=title\norderby_sec=\nshow_pagination=1\nshow_pagination_limit=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(8, 'Comissao-Provisoria', 'Comissão Provisória', 'comissao-provisoria', 'index.php?option=com_content&view=category&id=5', 'component', 1, 0, 20, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'display_num=10\nshow_headings=1\nshow_date=0\ndate_format=\nfilter=1\nfilter_type=title\norderby_sec=\nshow_pagination=1\nshow_pagination_limit=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(9, 'Menu', 'Fale Conosco', 'fale-conosco', 'index.php?option=com_contact&view=contact&id=1', 'component', 1, 0, 7, 0, 9, 62, '2011-03-02 00:41:51', 0, 0, 0, 0, 'show_contact_list=0\nshow_category_crumb=0\ncontact_icons=\nicon_address=\nicon_email=\nicon_telephone=\nicon_mobile=\nicon_fax=\nicon_misc=\nshow_headings=\nshow_position=\nshow_email=\nshow_telephone=\nshow_mobile=\nshow_fax=\nallow_vcard=\nbanned_email=\nbanned_subject=\nbanned_text=\nvalidate_session=\ncustom_reply=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(10, 'Menu', 'Manifesto', 'manifesto', 'index.php?option=com_content&view=article&id=3', 'component', -2, 0, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_menu_types`
--

CREATE TABLE IF NOT EXISTS `jos_menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(75) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `jos_menu_types`
--

INSERT INTO `jos_menu_types` (`id`, `menutype`, `title`, `description`) VALUES
(1, 'Menu', 'Menu', 'Menu do site'),
(3, 'Comissao-Provisoria', 'Comissão Provisória', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_messages`
--

CREATE TABLE IF NOT EXISTS `jos_messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` int(11) NOT NULL DEFAULT '0',
  `priority` int(1) unsigned NOT NULL DEFAULT '0',
  `subject` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_messages`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_messages_cfg`
--

CREATE TABLE IF NOT EXISTS `jos_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_messages_cfg`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_migration_backlinks`
--

CREATE TABLE IF NOT EXISTS `jos_migration_backlinks` (
  `itemid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `sefurl` text NOT NULL,
  `newurl` text NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_migration_backlinks`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_modules`
--

CREATE TABLE IF NOT EXISTS `jos_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) DEFAULT NULL,
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `numnews` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `control` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `jos_modules`
--

INSERT INTO `jos_modules` (`id`, `title`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `published`, `module`, `numnews`, `access`, `showtitle`, `params`, `iscore`, `client_id`, `control`) VALUES
(1, 'Main Menu', '', 0, 'user3', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 1, 'menutype=Menu\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=1\ncache=1\ntag_id=\nclass_sfx=\nmoduleclass_sfx=_menu\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=1\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n', 1, 0, ''),
(2, 'Login', '', 1, 'login', 0, '0000-00-00 00:00:00', 1, 'mod_login', 0, 0, 1, '', 1, 1, ''),
(3, 'Popular', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_popular', 0, 2, 1, '', 0, 1, ''),
(4, 'Recent added Articles', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_latest', 0, 2, 1, 'ordering=c_dsc\nuser_id=0\ncache=0\n\n', 0, 1, ''),
(5, 'Menu Stats', '', 5, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_stats', 0, 2, 1, '', 0, 1, ''),
(6, 'Unread Messages', '', 1, 'header', 0, '0000-00-00 00:00:00', 1, 'mod_unread', 0, 2, 1, '', 1, 1, ''),
(7, 'Online Users', '', 2, 'header', 0, '0000-00-00 00:00:00', 1, 'mod_online', 0, 2, 1, '', 1, 1, ''),
(8, 'Toolbar', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', 1, 'mod_toolbar', 0, 2, 1, '', 1, 1, ''),
(9, 'Quick Icons', '', 1, 'icon', 0, '0000-00-00 00:00:00', 1, 'mod_quickicon', 0, 2, 1, '', 1, 1, ''),
(10, 'Logged in Users', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_logged', 0, 2, 1, '', 0, 1, ''),
(11, 'Footer', '', 0, 'footer', 0, '0000-00-00 00:00:00', 1, 'mod_footer', 0, 0, 1, '', 1, 1, ''),
(12, 'Admin Menu', '', 1, 'menu', 0, '0000-00-00 00:00:00', 1, 'mod_menu', 0, 2, 1, '', 0, 1, ''),
(13, 'Admin SubMenu', '', 1, 'submenu', 0, '0000-00-00 00:00:00', 1, 'mod_submenu', 0, 2, 1, '', 0, 1, ''),
(14, 'User Status', '', 1, 'status', 0, '0000-00-00 00:00:00', 1, 'mod_status', 0, 2, 1, '', 0, 1, ''),
(15, 'Title', '', 1, 'title', 0, '0000-00-00 00:00:00', 1, 'mod_title', 0, 2, 1, '', 0, 1, ''),
(16, 'Indicação', '', 5, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_JF_INDIQUE', 0, 0, 1, 'moduleclass_sfx=\ntext=Indique meu site para seus amigos!\n\n', 0, 0, ''),
(25, 'JComments Latest', '', 10, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_jcomments', 0, 0, 1, 'object_group=com_content\ncount=5\nlength=50\navatar_size=32\nlimit_object_title=30\nlabel4more=More...\nlabel4author=By\ndateformat=%d.%m.%y %H:%M\nlabel4rss=RSS\n', 0, 0, ''),
(24, 'Previsão do Tempo', '', 6, 'left', 62, '2011-03-16 15:54:33', 1, 'mod_html', 0, 0, 1, 'moduleclass_sfx=\ncache=0\nfwd_html=<iframe src=''http://selos.climatempo.com.br/selos/MostraSelo.php?CODCIDADE=1096&SKIN=padrao'' scrolling=''no'' frameborder=''0'' width=150 height=''170'' marginheight=''0'' marginwidth=''0''></iframe>\nclean_js=1\nclean_css=1\nclean_all=1\n\n', 0, 0, ''),
(22, 'Comissão Provisória', '', 2, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 1, 'menutype=Comissao-Provisoria\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=1\ntag_id=\nclass_sfx=\nmoduleclass_sfx=\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n', 0, 0, ''),
(19, 'Quem está online', '', 9, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_whosonline', 0, 0, 1, 'cache=0\nshowmode=0\nmoduleclass_sfx=\n\n', 0, 0, ''),
(20, 'Pesquisar', '', 8, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_search', 0, 0, 1, 'moduleclass_sfx=\nwidth=20\ntext=Pesquisar\nbutton=1\nbutton_pos=right\nimagebutton=\nbutton_text=OK\nset_itemid=\ncache=1\ncache_time=900\n\n', 0, 0, ''),
(21, 'JoomGallery News', '', 1, 'joom_cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_feed', 0, 0, 1, 'cache=1\n    cache_time=15\n    moduleclass_sfx=\n    rssurl=http://www.en.joomgallery.net/feed/rss.html\n    rssrtl=0\n    rsstitle=1\n    rssdesc=0\n    rssimage=1\n    rssitems=3\n    rssitemdesc=1\n    word_count=30', 0, 1, ''),
(26, 'Login no Site', '', 3, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_login', 0, 0, 1, 'cache=0\nmoduleclass_sfx=\npretext=\nposttext=\nlogin=\nlogout=1\ngreeting=1\nname=0\nusesecure=0\n\n', 0, 0, ''),
(27, 'breadcrumbs', '', 1, 'breadcrumb', 0, '0000-00-00 00:00:00', 1, 'mod_breadcrumbs', 0, 0, 1, 'showHome=1\nhomeText=Home\nshowLast=1\nseparator=>\nmoduleclass_sfx=\ncache=0\n\n', 0, 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_modules_menu`
--

CREATE TABLE IF NOT EXISTS `jos_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_modules_menu`
--

INSERT INTO `jos_modules_menu` (`moduleid`, `menuid`) VALUES
(1, 0),
(16, 0),
(19, 0),
(20, 0),
(22, 0),
(24, 0),
(25, 0),
(26, 0),
(27, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_newsfeeds`
--

CREATE TABLE IF NOT EXISTS `jos_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `link` text NOT NULL,
  `filename` varchar(200) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(11) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(11) unsigned NOT NULL DEFAULT '3600',
  `checked_out` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `published` (`published`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_newsfeeds`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_plugins`
--

CREATE TABLE IF NOT EXISTS `jos_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `element` varchar(100) NOT NULL DEFAULT '',
  `folder` varchar(100) NOT NULL DEFAULT '',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `iscore` tinyint(3) NOT NULL DEFAULT '0',
  `client_id` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Extraindo dados da tabela `jos_plugins`
--

INSERT INTO `jos_plugins` (`id`, `name`, `element`, `folder`, `access`, `ordering`, `published`, `iscore`, `client_id`, `checked_out`, `checked_out_time`, `params`) VALUES
(1, 'Authentication - Joomla', 'joomla', 'authentication', 0, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(2, 'Authentication - LDAP', 'ldap', 'authentication', 0, 2, 0, 1, 0, 0, '0000-00-00 00:00:00', 'host=\nport=389\nuse_ldapV3=0\nnegotiate_tls=0\nno_referrals=0\nauth_method=bind\nbase_dn=\nsearch_string=\nusers_dn=\nusername=\npassword=\nldap_fullname=fullName\nldap_email=mail\nldap_uid=uid\n\n'),
(3, 'Authentication - GMail', 'gmail', 'authentication', 0, 4, 0, 0, 0, 0, '0000-00-00 00:00:00', ''),
(4, 'Authentication - OpenID', 'openid', 'authentication', 0, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', ''),
(5, 'User - Joomla!', 'joomla', 'user', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', 'autoregister=1\n\n'),
(6, 'Search - Content', 'content', 'search', 0, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\nsearch_content=1\nsearch_uncategorised=1\nsearch_archived=1\n\n'),
(7, 'Search - Contacts', 'contacts', 'search', 0, 3, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n'),
(8, 'Search - Categories', 'categories', 'search', 0, 4, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n'),
(9, 'Search - Sections', 'sections', 'search', 0, 5, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n'),
(10, 'Search - Newsfeeds', 'newsfeeds', 'search', 0, 6, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n'),
(11, 'Search - Weblinks', 'weblinks', 'search', 0, 2, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n'),
(12, 'Content - Pagebreak', 'pagebreak', 'content', 0, 10000, 1, 1, 0, 0, '0000-00-00 00:00:00', 'enabled=1\ntitle=1\nmultipage_toc=1\nshowall=1\n\n'),
(13, 'Content - Rating', 'vote', 'content', 0, 4, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(14, 'Content - Email Cloaking', 'emailcloak', 'content', 0, 5, 1, 0, 0, 0, '0000-00-00 00:00:00', 'mode=1\n\n'),
(15, 'Content - Code Hightlighter (GeSHi)', 'geshi', 'content', 0, 5, 0, 0, 0, 0, '0000-00-00 00:00:00', ''),
(16, 'Content - Load Module', 'loadmodule', 'content', 0, 6, 1, 0, 0, 0, '0000-00-00 00:00:00', 'enabled=1\nstyle=0\n\n'),
(17, 'Content - Page Navigation', 'pagenavigation', 'content', 0, 2, 1, 1, 0, 0, '0000-00-00 00:00:00', 'position=1\n\n'),
(18, 'Editor - No Editor', 'none', 'editors', 0, 0, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(19, 'Editor - TinyMCE', 'tinymce', 'editors', 0, 0, 1, 1, 0, 0, '0000-00-00 00:00:00', 'mode=extended\nskin=1\ncompressed=0\ncleanup_startup=0\ncleanup_save=2\nentity_encoding=raw\nlang_mode1\nlang_code=pt\ntext_direction=ltr\ncontent_css=1\ncontent_css_custom=\nrelative_urls=1\nnewlines=0\ninvalid_elements=applet\nextended_elements=\ntoolbar=top\ntoolbar_align=left\nhtml_height=550\nhtml_width=750\nelement_path=1\nfonts=1\npaste=1\nsearchreplace=1\ninsertdate=1\nformat_date=%Y-%m-%d\ninserttime=1\nformat_time=%H:%M:%S\ncolors=1\ntable=1\nsmilies=1\nmedia=1\nhr=1\ndirectionality=1\nfullscreen=1\nstyle=1\nlayer=1\nxhtmlxtras=1\nvisualchars=1\nnonbreaking=1\ntemplate=0\nadvimage=1\nadvlink=1\nautosave=1\ncontextmenu=1\ninlinepopups=1\nsafari=1\ncustom_plugin=\ncustom_button=\n\n'),
(20, 'Editor - XStandard Lite 2.0', 'xstandard', 'editors', 0, 0, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
(21, 'Editor Button - Image', 'image', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(22, 'Editor Button - Pagebreak', 'pagebreak', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(23, 'Editor Button - Readmore', 'readmore', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(24, 'XML-RPC - Joomla', 'joomla', 'xmlrpc', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
(25, 'XML-RPC - Blogger API', 'blogger', 'xmlrpc', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', 'catid=1\nsectionid=0\n\n'),
(27, 'System - SEF', 'sef', 'system', 0, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(28, 'System - Debug', 'debug', 'system', 0, 2, 1, 0, 0, 0, '0000-00-00 00:00:00', 'queries=1\nmemory=1\nlangauge=1\n\n'),
(29, 'System - Legacy', 'legacy', 'system', 0, 3, 1, 1, 0, 0, '0000-00-00 00:00:00', 'route=0\n\n'),
(30, 'System - Cache', 'cache', 'system', 0, 4, 0, 1, 0, 0, '0000-00-00 00:00:00', 'browsercache=0\ncachetime=15\n\n'),
(31, 'System - Log', 'log', 'system', 0, 5, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
(32, 'System - Remember Me', 'remember', 'system', 0, 6, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(33, 'System - Backlink', 'backlink', 'system', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
(34, 'System - Mootools Upgrade', 'mtupgrade', 'system', 0, 8, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
(35, 'System - jSecure Authentication', 'jsecure', 'system', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 'key=\noptions=1\ncustom_path=plugins/system/404.html\n\n'),
(36, 'Editor - JCE', 'jce', 'editors', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(37, 'Content - YouTube Video Embedding', 'youtubeembed', 'content', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', 'width=425\nheight=344\n'),
(38, 'Webee Comment', 'webeecomment', 'content', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_polls`
--

CREATE TABLE IF NOT EXISTS `jos_polls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `voters` int(9) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '0',
  `lag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_polls`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_poll_data`
--

CREATE TABLE IF NOT EXISTS `jos_poll_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pollid` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pollid` (`pollid`,`text`(1))
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_poll_data`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_poll_date`
--

CREATE TABLE IF NOT EXISTS `jos_poll_date` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vote_id` int(11) NOT NULL DEFAULT '0',
  `poll_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_poll_date`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_poll_menu`
--

CREATE TABLE IF NOT EXISTS `jos_poll_menu` (
  `pollid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pollid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_poll_menu`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_sections`
--

CREATE TABLE IF NOT EXISTS `jos_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` text NOT NULL,
  `scope` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_scope` (`scope`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `jos_sections`
--

INSERT INTO `jos_sections` (`id`, `title`, `name`, `alias`, `image`, `scope`, `image_position`, `description`, `published`, `checked_out`, `checked_out_time`, `ordering`, `access`, `count`, `params`) VALUES
(1, 'Noticias', '', 'noticias', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 1, 0, 4, ''),
(2, 'Conteudo', '', 'conteudo', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 2, 0, 5, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_session`
--

CREATE TABLE IF NOT EXISTS `jos_session` (
  `username` varchar(150) DEFAULT '',
  `time` varchar(14) DEFAULT '',
  `session_id` varchar(200) NOT NULL DEFAULT '0',
  `guest` tinyint(4) DEFAULT '1',
  `userid` int(11) DEFAULT '0',
  `usertype` varchar(50) DEFAULT '',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `data` longtext,
  PRIMARY KEY (`session_id`(64)),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_session`
--

INSERT INTO `jos_session` (`username`, `time`, `session_id`, `guest`, `userid`, `usertype`, `gid`, `client_id`, `data`) VALUES
('', '1300795885', 'pi6c3elebk0rcgopu8mu4p4r57', 1, 0, '', 0, 0, '__default|a:8:{s:15:"session.counter";i:2;s:19:"session.timer.start";i:1300795400;s:18:"session.timer.last";i:1300795400;s:17:"session.timer.now";i:1300795885;s:22:"session.client.browser";s:90:"Mozilla/5.0 (Windows; U; Windows NT 6.1; pt-BR; rv:1.9.2.15) Gecko/20110303 Firefox/3.6.15";s:8:"registry";O:9:"JRegistry":3:{s:17:"_defaultNameSpace";s:7:"session";s:9:"_registry";a:1:{s:7:"session";a:1:{s:4:"data";O:8:"stdClass":0:{}}}s:7:"_errors";a:0:{}}s:4:"user";O:5:"JUser":19:{s:2:"id";i:0;s:4:"name";N;s:8:"username";N;s:5:"email";N;s:8:"password";N;s:14:"password_clear";s:0:"";s:8:"usertype";N;s:5:"block";N;s:9:"sendEmail";i:0;s:3:"gid";i:0;s:12:"registerDate";N;s:13:"lastvisitDate";N;s:10:"activation";N;s:6:"params";N;s:3:"aid";i:0;s:5:"guest";i:1;s:7:"_params";O:10:"JParameter":7:{s:4:"_raw";s:0:"";s:4:"_xml";N;s:9:"_elements";a:0:{}s:12:"_elementPath";a:1:{i:0;s:63:"C:\\xampp\\htdocs\\meusite\\libraries\\joomla\\html\\parameter\\element";}s:17:"_defaultNameSpace";s:8:"_default";s:9:"_registry";a:1:{s:8:"_default";a:1:{s:4:"data";O:8:"stdClass":0:{}}}s:7:"_errors";a:0:{}}s:9:"_errorMsg";N;s:7:"_errors";a:0:{}}s:13:"session.token";s:32:"b3a9b1e27e0caf0144d07b2fc01de8d2";}');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_stats_agents`
--

CREATE TABLE IF NOT EXISTS `jos_stats_agents` (
  `agent` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_stats_agents`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_templates_menu`
--

CREATE TABLE IF NOT EXISTS `jos_templates_menu` (
  `template` varchar(255) NOT NULL DEFAULT '',
  `menuid` int(11) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menuid`,`client_id`,`template`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_templates_menu`
--

INSERT INTO `jos_templates_menu` (`template`, `menuid`, `client_id`) VALUES
('vermelho', 0, 0),
('khepri', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_users`
--

CREATE TABLE IF NOT EXISTS `jos_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `usertype` varchar(25) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `gid_block` (`gid`,`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Extraindo dados da tabela `jos_users`
--

INSERT INTO `jos_users` (`id`, `name`, `username`, `email`, `password`, `usertype`, `block`, `sendEmail`, `gid`, `registerDate`, `lastvisitDate`, `activation`, `params`) VALUES
(62, 'Administrator', 'admin', 'lucasmarques73@hotmail.com', 'a460c713a92499971f0f8ef5343079d6:pxBfBGcmcxC7NHQFIKPiVfnoFDmsu16U', 'Super Administrator', 0, 1, 25, '2011-02-23 02:53:19', '2011-03-18 17:58:54', '', 'admin_language=pt-BR\nlanguage=pt-BR\neditor=\nhelpsite=\ntimezone=-3\n\n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_webeecomment_comment`
--

CREATE TABLE IF NOT EXISTS `jos_webeecomment_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `articleId` int(10) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `handle` text NOT NULL,
  `isUser` int(10) unsigned NOT NULL DEFAULT '0',
  `email` text NOT NULL,
  `url` text,
  `published` int(10) unsigned NOT NULL DEFAULT '0',
  `saved` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `ipAddress` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_webeecomment_comment`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_webeecomment_disabled`
--

CREATE TABLE IF NOT EXISTS `jos_webeecomment_disabled` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `target_id` int(10) unsigned NOT NULL DEFAULT '0',
  `type` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_webeecomment_disabled`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_weblinks`
--

CREATE TABLE IF NOT EXISTS `jos_weblinks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`,`published`,`archived`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_weblinks`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_xmap`
--

CREATE TABLE IF NOT EXISTS `jos_xmap` (
  `name` varchar(30) NOT NULL,
  `value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_xmap`
--

INSERT INTO `jos_xmap` (`name`, `value`) VALUES
('classname', 'sitemap'),
('columns', '1'),
('exclmenus', ''),
('exclude_css', '0'),
('exclude_xsl', '0'),
('exlinks', '1'),
('expand_category', '1'),
('expand_section', '1'),
('ext_image', 'img_grey.gif'),
('includelink', '1'),
('show_menutitle', '1'),
('sitemap_default', '1'),
('version', '1.1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_xmap_ext`
--

CREATE TABLE IF NOT EXISTS `jos_xmap_ext` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extension` varchar(100) NOT NULL,
  `published` int(1) DEFAULT '0',
  `params` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Extraindo dados da tabela `jos_xmap_ext`
--

INSERT INTO `jos_xmap_ext` (`id`, `extension`, `published`, `params`) VALUES
(1, 'com_agora', 1, '-1{include_forums=1\ninclude_topics=1\nmax_topics=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nforum_priority=-1\nforum_changefreq=-1\ntopic_priority=-1\ntopic_changefreq=-1\n}'),
(2, 'com_contact', 1, '-1{include_contacts=1\nmax_contacts=\ncat_priority=-1\ncat_changefreq=-1\ncontact_priority=-1\ncontact_changefreq=-1\n}'),
(3, 'com_content', 1, '-1{expand_categories=1\nexpand_sections=1\nshow_unauth=0\nmax_art=0\nmax_art_age=0\ncat_priority=-1\ncat_changefreq=-1\nart_priority=-1\nart_changefreq=-1\nkeywords=1\n}'),
(4, 'com_eventlist', 1, '-1{include_events=1\nmax_events=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nfile_priority=-1\nfile_changefreq=-1\n}'),
(5, 'com_g2bridge', 1, '-1{include_items=2\ncat_priority=-1\ncat_changefreq=-1\nitem_priority=-1\nitem_changefreq=-1\n}'),
(6, 'com_glossary', 1, '-1{include_entries=1\nmax_entries=\nletter_priority=0.5\nletter_changefreq=weekly\nentry_priority=0.5\nentry_changefreq=weekly\n}'),
(7, 'com_hotproperty', 1, '-1{include_properties=1\ninclude_companies=1\ninclude_agents=1\nproperties_text=Properties\ncompanies_text=Companies\nagents_text=Agents\nmax_properties=\ntype_priority=-1\ntype_changefreq=-1\nproperty_priority=-1\nproperty_changefreq=-1\ncompany_priority=-1\ncompany_changefreq=-1\nagent_priority=-1\nagent_changefreq=-1\n}'),
(8, 'com_jcalpro', 1, '-1{include_events=1\ncat_priority=-1\ncat_changefreq=-1\nevent_priority=-1\nevent_changefreq=-1\n}'),
(9, 'com_jdownloads', 1, '-1{include_files=1\nmax_files=\nmax_age=\ncat_priority=0.5\ncat_changefreq=weekly\nfile_priority=0.5\nfile_changefreq=weekly\n}'),
(10, 'com_jevents', 1, '-1{include_events=1\nmax_events=\ncat_priority=0.5\ncat_changefreq=weekly\nevent_priority=0.5\nevent_changefreq=weekly\n}'),
(11, 'com_jomres', 1, '-1{priority=0.5\nchangefreq=weekly\n}'),
(12, 'com_joomdoc', 1, '-1{include_docs=1\ndoc_task=\ncat_priority=0.5\ncat_changefreq=weekly\ndoc_priority=0.5\ndoc_changefreq=weekly\n}'),
(13, 'com_joomgallery', 1, '-1{include_pictures=1\nmax_pictures=\ncat_priority=-1\ncat_changefreq=-1\npictures_priority=-1\npictures_changefreq=-1\n}'),
(14, 'com_kb', 1, '-1{include_articles=1\ninclude_feeds=1\nmax_articles=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nfile_priority=-1\nfile_changefreq=-1\n}'),
(15, 'com_kunena', 1, '-1{include_topics=1\nmax_topics=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\ntopic_priority=-1\ntopic_changefreq=-1\n}'),
(16, 'com_mtree', 1, '-1{cats_order=cat_name\ninclude_links=1\nlinks_order=ordering\nmax_links=\nmax_age=\ncat_priority=0.5\ncat_changefreq=weekly\nlink_priority=0.5\nlink_changefreq=weekly\n}'),
(17, 'com_myblog', 1, '-1{include_tag_clouds=1\ninclude_feed=2\ninclude_archives=2\nnumber_of_bloggers=8\ninclude_blogger_posts=1\nnumber_of_post_per_blogger=32\ntext_bloggers=Bloggers\nblogger_priority=-1\nblogger_changefreq=-1\nfeed_priority=-1\nfeed_changefreq=-1\nentry_priority=-1\nentry_changefreq=-1\ncats_priority=-1\ncats_changefreq=-1\narc_priority=-1\narc_changefreq=-1\ntag_priority=-1\ntag_changefreq=-1\n}'),
(18, 'com_rapidrecipe', 1, '-1{cats_order=cat_name\ninclude_links=1\nlinks_order=ordering\nmax_links=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nrecipe_priority=-1\nrecipe_changefreq=-1\n}'),
(19, 'com_remository', 1, '-1{include_files=1\nmax_files=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nfile_priority=-1\nfile_changefreq=-1\n}'),
(20, 'com_resource', 1, '-1{include_articles=1\ncat_priority=-1\ncat_changefreq=-1\narticle_priority=-1\narticle_changefreq=-1\n}'),
(21, 'com_rokdownloads', 1, '-1{include_files=1\nmax_files=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nfile_priority=-1\nfile_changefreq=-1\n}'),
(22, 'com_rsgallery2', 1, '-1{include_images=1\nmax_images=\nmax_age=\nimages_order=orderding\ncat_priority=0.5\ncat_changefreq=weekly\nimage_priority=0.5\nimage_changefreq=weekly\n}'),
(23, 'com_sectionex', 1, '-1{expand_categories=1\nexpand_sections=1\nshow_unauth=0\ncat_priority=-1\ncat_changefreq=-1\nart_priority=-1\nart_changefreq=-1\n}'),
(24, 'com_sobi2', 1, '-1{include_entries=1\ncat_priority=-1\ncat_changefreq=weekly\nentry_priority=-1\nentry_changefreq=weekly\n}'),
(25, 'com_virtuemart', 1, '-1{include_products=1\ncat_priority=0.5\ncat_changefreq=weekly\nprod_priority=0.5\nprod_changefreq=weekly\n}');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_xmap_items`
--

CREATE TABLE IF NOT EXISTS `jos_xmap_items` (
  `uid` varchar(100) NOT NULL,
  `itemid` int(11) NOT NULL,
  `view` varchar(10) NOT NULL,
  `sitemap_id` int(11) NOT NULL,
  `properties` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`uid`,`itemid`,`view`,`sitemap_id`),
  KEY `uid` (`uid`,`itemid`),
  KEY `view` (`view`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_xmap_items`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_xmap_sitemap`
--

CREATE TABLE IF NOT EXISTS `jos_xmap_sitemap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `expand_category` int(11) DEFAULT NULL,
  `expand_section` int(11) DEFAULT NULL,
  `show_menutitle` int(11) DEFAULT NULL,
  `columns` int(11) DEFAULT NULL,
  `exlinks` int(11) DEFAULT NULL,
  `ext_image` varchar(255) DEFAULT NULL,
  `menus` text,
  `exclmenus` varchar(255) DEFAULT NULL,
  `includelink` int(11) DEFAULT NULL,
  `usecache` int(11) DEFAULT NULL,
  `cachelifetime` int(11) DEFAULT NULL,
  `classname` varchar(255) DEFAULT NULL,
  `count_xml` int(11) DEFAULT NULL,
  `count_html` int(11) DEFAULT NULL,
  `views_xml` int(11) DEFAULT NULL,
  `views_html` int(11) DEFAULT NULL,
  `lastvisit_xml` int(11) DEFAULT NULL,
  `lastvisit_html` int(11) DEFAULT NULL,
  `excluded_items` text,
  `compress_xml` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `jos_xmap_sitemap`
--

INSERT INTO `jos_xmap_sitemap` (`id`, `name`, `expand_category`, `expand_section`, `show_menutitle`, `columns`, `exlinks`, `ext_image`, `menus`, `exclmenus`, `includelink`, `usecache`, `cachelifetime`, `classname`, `count_xml`, `count_html`, `views_xml`, `views_html`, `lastvisit_xml`, `lastvisit_html`, `excluded_items`, `compress_xml`) VALUES
(1, 'Novo Sitemap', 0, 0, 1, 1, 1, 'img_grey.gif', 'mainmenu,0,1,1,0.5,daily,mod_mainmenu\nMenu,1,1,1,0.5,daily,mod_mainmenu\nComissao-Provisoria,2,1,1,0.5,daily,mod_mainmenu', '', 1, 0, 30, 'xmap', 0, 0, 0, 0, 0, 0, '', 0);
