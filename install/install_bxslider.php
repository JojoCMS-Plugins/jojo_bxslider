<?php
/**
 *                    Jojo CMS
 *                ================
 *
 * Copyright 2007-2008 Harvey Kane <code@ragepank.com>
 * Copyright 2007-2008 Michael Holt <code@gardyneholt.co.nz>
 * Copyright 2007 Melanie Schulz <mel@gardyneholt.co.nz>
 *
 * See the enclosed file license.txt for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @author  Harvey Kane <code@ragepank.com>
 * @author  Michael Cochrane <code@gardyneholt.co.nz>
 * @author  Melanie Schulz <mel@gardyneholt.co.nz>
 * @license http://www.fsf.org/copyleft/lgpl.html GNU Lesser General Public License
 * @link    http://www.jojocms.org JojoCMS
 */

$table = 'slideshow';
$query = "
CREATE TABLE {slideshow} (
  `slideshowid` int(11) NOT NULL auto_increment,
  `sstitle` varchar(255) NOT NULL,
  `indeximage` varchar(255) NOT NULL,
  `pageid` int(11) default NULL,
  `imageheight` int(5) default NULL,
  `imagewidth` int(5) default NULL,
  `thumbimagesize` varchar(255) NOT NULL,
  `height` int(5) default NULL,
  `width` int(5) default NULL,
  `titles` tinyint(1) default '0',
  `controls` tinyint(1) default '1',
  `pager` tinyint(1) default '0',
  `pagerimages` tinyint(1) default '0',
  `pagerbottom` tinyint(1) default '1',
  `auto` tinyint(1) default '0',
  `autocontrols` tinyint(1) default '0',
  `autostart` tinyint(1) default '1',
  `autohoverpause` tinyint(1) default '0',
  `loop` tinyint(1) default '1',
  `ticker` tinyint(1) default '0',
  `tickerhoverpause` tinyint(1) default '0',
  `transition` enum('horizontal','vertical','fade') NOT NULL default 'horizontal',
  `speed` int(5) default '500',
  `pause` int(5) default '3000',
  `random` tinyint(1) default '0',
  `captions` tinyint(1) default '0',
  `slidedisplayqty` int(5) default '1',
  `slidemoveqty` int(5) default '1',
  PRIMARY KEY  (`slideshowid`),
  KEY `id` (`pageid`)
) TYPE=MyISAM ;";

/* Check table structure */
$result = Jojo::checkTable($table, $query);

/* Output result */
if (isset($result['created'])) {
    echo sprintf("jojo_bxslider: Table <b>%s</b> Does not exist - created empty table.<br />", $table);
}

if (isset($result['added'])) {
    foreach ($result['added'] as $col => $v) {
        echo sprintf("jojo_bxslider: Table <b>%s</b> column <b>%s</b> Does not exist - added.<br />", $table, $col);
    }
}

if (isset($result['different'])) Jojo::printTableDifference($table,$result['different']);

$table = 'slide';
$query = "
    CREATE TABLE {slide} (
      `slideid` int(11) NOT NULL auto_increment,
      `slideshowid` int(11) NOT NULL default '0',
  	  `title` varchar(255) NOT NULL,
  	  `titleimage` varchar(255) NOT NULL,
      `displayorder` int(3) NOT NULL default '0',
	  `description` text NOT NULL,
	  `description_code` text NULL,
	  `image` varchar(255) NOT NULL,
	  `thumbimage` varchar(255) NOT NULL,
	  `imagelink` varchar(255) NOT NULL,";
if (class_exists('Jojo_Plugin_jojo_videoembed')) {
	$query .= "
	  `videourl` varchar(255) NOT NULL,";
}
$query .= "
	PRIMARY KEY  (`slideid`)
    ) TYPE=MyISAM ;";

/* Check table structure */
$result = Jojo::checkTable($table, $query);

/* Output result */
if (isset($result['created'])) {
    echo sprintf("jojo_bxslider: Table <b>%s</b> Does not exist - created empty table.<br />", $table);
}

if (isset($result['added'])) {
    foreach ($result['added'] as $col => $v) {
        echo sprintf("jojo_bxslider: Table <b>%s</b> column <b>%s</b> Does not exist - added.<br />", $table, $col);
    }
}

if (isset($result['different'])) Jojo::printTableDifference($table, $result['different']);
