<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-2.0/JG/trunk/administrator/components/com_joomgallery/changelog.php $
// $Id: changelog.php 4307 2013-06-16 19:19:36Z chraneco $
/******************************************************************************\
**   JoomGallery 2                                                            **
**   By: JoomGallery::ProjectTeam                                             **
**   Copyright (C) 2008 - 2012  JoomGallery::ProjectTeam                      **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                  **
**   Released under GNU GPL Public License                                    **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look             **
**   at administrator/components/com_joomgallery/LICENSE.TXT                  **
\******************************************************************************/

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
?>

CHANGELOG JOOMGALLERY (since Version 2.0.0 BETA)

Legende / Legend:

* -> Security Fix
# -> Bug Fix
+ -> Addition
^ -> Change
- -> Removed
! -> Note

===============================================================================
                                        2.1.4
                                      (20130616)
===============================================================================

20130616
# Clone category structure before changing it in the script so that the
  original one remains unchanged

20130523
+ Support of unicode aliases added

20130425
# Error 'JPath::clean: $path is not a string' in FTP Upload view fixed

20130421
# Wrong filters were applied to image and category descriptions

20130420
# In sent messages of JoomGallery option 'jg_realname' was not always considered

20130419
# Number of images and categories were not displayed if only one page exists

20130331
- JFormFields 'owner' and 'cbowner' deleted because they aren't used anymore

20130314
# Cooliris did not work with enabled error reporting

===============================================================================
                                        2.1.3
                                      (20130314)
===============================================================================

20130228
# Pagination problem in image manager fixed

20130222
# Convert file endings to lower case when migrating

20130213
# Undefined variable notice when uploading special image files

20130207
# Image upload and category creation in MiniJoom was not possible in
  frontend due to wrong URLs

20130127
# Wrong ACL check for batch upload fixed

20130122
# Owner filter of image manager did not work correct

20130117
^ File sort algorithm changed in batch upload, thanks to Hoffi

===============================================================================
                                        2.1.2
                                      (20130113)
===============================================================================

20130113
# With some specific configuration settings an empty script string was added
  to the document head which causes problems when using caching

20130111
# Batch editing images was not possible because of wrong form validation error
# In category view, the list bullet for image title was displayed in some cases
  even if the output of the image title was disabled

20121217
# Image distortion which was caused by incrementing image dimensions in the
  nametag container of the detail view has been removed

20121209
# Improved performance with very many users in configuration and image manager
# Failing Ajax request at category selection if SEF is enabled fixed

20121207
# Ordering box did not change when selecting another parent category if Ajax
  category selection was enabled

20121203
^ Form field 'Category' renamed to 'JoomCategory' to avoid conflicts resp.
  incompatibilities with Joomla!

20121107
# Searching images in MiniJoom was not possible if SEF is enabled
  with 'Adds Suffix to URL'

20121019
# Access rights in links to certain gallery views have not been checked in
  frontend user pannel and frontend user categories view

===============================================================================
                                        2.1.1
                                      (20121014)
===============================================================================
20121013
# Wrong numbering of 'Auto-Update' forms in the 'Installed extensions' tab of
  the admin panel

20121003
# Voting via Ajax was not possible if SEF is enabled with 'Adds Suffix to URL'

20121002
# Wrong value for function imagejpeg() produced an error in PHP 5.4
# Adding all images of a category to the favourites was not always possible

===============================================================================
                                        2.1.0
                                      (20120923)
===============================================================================

20120915
^ Refactoring of frontend uploads for using JForm

20120913
+ Possibility to add custom fields for images and categories via plugins
+ New option for searching categories via Ajax requests
+ New option for improving performance in big galleries
+ New option for being able to add all images of a category to the favourites
+ New option for preventing multiple votes (an IP lock is created)
- Option 'Date/Time Format' removed because language constants are used for that

20120904
# Use same image dimensions for nametag container (#jg-img) and image container
  (#jg_photo_big) in detail view

20120606
# Reset limitstart in backend only if necessary for correcting the pagination
# Add missing values for creating category selection box in MiniJoom
# Wrong 'alt' text for feed subscription icon in category view

20120601
+ Condsider global Joomla! option 'Include Site Name in Page Titles'

20120521
^ Refactoring of backend uploads for using JForm

20120520
+ Selection of thumbnail alignment in edit view for categories

20120508
# Sort function for the batch upload image file list

20120506
# Wrong display of 'Previous category' in the 'Image manager::Move images' view

20120426
+ Set documents meta data taken from menu entry definition
+ Display category meta data (description, keywords) as image meta data in detail
  view if image meta data is empty

20120412
# Display of the number of category images in gallery and category view

20120409
# Category creation in interface has used invalid parent category ID

20120406
# MiniJoom could not be used in certain editors
+ 'Override' option for thumbnail display in gallery and category view

20120405
# Typo in SQL command fixed

20120330
# SQL error fixed, that occurs when filtering by state in 'Usrcategories' view

20120323
^ Upgrade to Google Maps API Version 3

20120322
- Removing 'ordering' column from #__joomgallery_catg (not necessary anymore).
  Use 'lft' for ordering from now on.

20120319
# Do not use hardcoded user ID 42 as sender of messages and some other small
  fixes in messenger

20120307
^ Use of relative instead of absolute url pathes in dynamicly created CSS file
  joom_settings.css

===============================================================================
                                        2.0.0
                                      (20120304)
===============================================================================
20120227
# Sometimes wrong thumbnail links in gallery and category view if 'Skip category
  view' and manual thumbnail selection was configured

20120216
# With specific server configurations the time out for the refresher was too long

20120211
# In category view the image sorting by user did not work across all image pages

20120207
# in_hidden flag of categories was not always set correctly

20120205
^ CSS definition of different tool tip styling changed for better integration

20120127
^ Prevent bots from voting in case of star rating without AJAX

===============================================================================
                                      2.0.0 BETA5
                                      (20120127)
===============================================================================
20120127
# Delete created database entry of new category if creation of folders fails
+ Decide dynamically whether detail or original image should be linked when
  thumbs are displayed with the interface

20120115
- Last references to 'ordering' column of categories table removed
# Access level of images has not been checked in search query

20120113
# Access level of images has not been checked in top list queries

20120112
# Some erroneous quotation marks were inserted with the code of images when using JoomBu
# Changes for following 'Strict Standards'

===============================================================================
                                      2.0.0 BETA4
                                      (20111224)
===============================================================================
20111224
# Missing access level checks in gallery, category and detail view

20111219
# Missing database commands in delete function of front end edit model, therefore
  image files where not deleted on filesystem

20111215
# wrong information of automatic detection of Image Magick if the path has been
  setted manually before

20111211
# Frontend upload limit check was done in backend
# Redirect in Frontend JAVA-Upload not working

20111209
# Add default charset=utf to all tables in the installation SQL file removing
  ENGINE=MyISAM because it's not necessary anymore
^ If only the correspondent category is hidden (and not also the images in it)
  all images of the category will be displayed in detail view now (they can be
  hidden there by hide the single images in image manager)
^ Colon added to COM_JOOMGALLERY_TOPLIST_TOP instead of hard coded output

20111208
# PHP error if creating favourites zip download file failed,
  404 page, if original images where missing while creating archive file for
  favourites zip download
# Output of obsolete html code in category view if no textelements and icons are
  activated

20111123
# Rating not working, because Mootools library was not loaded for some
  configuration cases

20111122
# Small ACL bugs in fronted fixed
# Report could not be sent by unregistered users

20111119
# (Sub)Category thumbnails in category view did not display always correctly
  if manual setting has been selected

20111118
# Limiting the image preview in image manager (edit mode) to a maximum width

20111117
# Thickbox did not work in IE 8

===============================================================================
                                      2.0.0 BETA3
                                      (20111115)
===============================================================================

20111115
# Nested Set tree was not build correctly when moving a category into a category
  which doesn't already have sub-categories

20111114
# AJAX rating not working if display of rating in detail view (image information)
  not enabled

20111113
+ Changing access level for multiple images in the back end

20111108
# Inserting images from MiniJoom wasn't possible after an Ajax request was done

20111107
# SEF of images shouldn't be enabled by default

20111104
# Bug in MiniJoom due to which upload in frontend wasn't possible if upload
  categories were specified

20111102
# Alphabetical sorting of categories in category view

20111101
+ Usability improvements in category, image, comments and maintenance manager

===============================================================================
                                      2.0.0 BETA2
                                      (20111031)
===============================================================================
20111030
+ Improvement in migration manager so that category ordering isn't lost during migration

20111025
# Wrong language constants corrected and missing constants added

20111022
# Missing language constants added

20111021
# Tooltips were not working if 'Enabled with different styling' in configuration
  manager
# Language output in configuration manager for joom_settings.css corrected
# Hits haven't been counted in default detail view if 'Use real paths' was enabled
# Small fixes in the interface

===============================================================================
                                      2.0.0 BETA
                                      (20111016)
===============================================================================
20110917
^ new JAVA-Applet 5.0.5 Build 1566
20110714
+ Options 'Image title/description in DHTML container' renamed to
  'Image title/description in popup' -> functionality enlarged to all boxes
20110630
+ more options for accordion
+ new option 'skip category view'
20110622
+ Batchupload allows now any archive types defined in Joomla!
20110515
^ new jquery version 1.6.1 for thickbox3 because of problems with IE9 and DOMready()
  in older jquery, small changes in thickbox.js
