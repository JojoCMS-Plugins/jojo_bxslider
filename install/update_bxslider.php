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

$default_td['slide'] = array(
        'td_name' => "slide",
        'td_primarykey' => "slideid",
        'td_displayfield' => "title",
        'td_plugin' => "Jojo_bxslider",
        'td_categorytable' => "slideshow",
        'td_categoryfield' => "slideshowid",
        'td_filter' => "yes",
        'td_orderbyfields' => "displayorder, title",
        'td_deleteoption' => "yes",
        'td_menutype' => "tree",
        'td_defaultpermissions' => "everyone.show=0\neveryone.view=0\neveryone.edit=0\neveryone.add=0\neveryone.delete=0\nadmin.show=0\nadmin.view=0\nadmin.edit=0\nadmin.add=0\nadmin.delete=0\nnotloggedin.show=0\nnotloggedin.view=0\nnotloggedin.edit=0\nnotloggedin.add=0\nnotloggedin.delete=0\nregistered.show=0\nregistered.view=0\nregistered.edit=0\nregistered.add=0\nregistered.delete=0\nsysinstall.show=0\nsysinstall.view=0\nsysinstall.edit=0\nsysinstall.add=0\nsysinstall.delete=0\n",
    );

$o = 1;

/* Content Tab */

// Slideid Field
$default_fd['slide']['slideid'] = array(
        'fd_name' => "Slideid",
        'fd_type' => "hidden",
        'fd_help' => "A unique ID, automatically assigned by the system",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

// Slideshow Field
$default_fd['slide']['slideshowid'] = array(
        'fd_name' => "Slideshow",
        'fd_type' => "dblist",
        'fd_options' => "slideshow",
        'fd_default' => "0",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

// Title Field
$default_fd['slide']['title'] = array(
        'fd_name' => "Title",
        'fd_type' => "text",
        'fd_size' => "60",
        'fd_order' => "1",
        'fd_tabname' => "Content"
    );

// Image Field
$default_fd['slide']['titleimage'] = array(
        'fd_name' => "Title Image",
        'fd_type' => "fileupload",
        'fd_help' => "an image to use with/for the title",
        'fd_order' => $o++,
        'fd_tabname' => "Content"
    );

// Image Field
$default_fd['slide']['image'] = array(
        'fd_name' => "Image",
        'fd_type' => "fileupload",
        'fd_order' => $o++,
        'fd_tabname' => "Content"
    );

// Thumbnail Image
$default_fd['slide']['thumbimage'] = array(
        'fd_name' => "Thumbnail Image",
        'fd_type' => "fileupload",
        'fd_help' => "an image to use for the 'pager' thumbnail navigation (if used and different to the main image)",
        'fd_order' => $o++,
        'fd_tabname' => "Content"
    );

// ImageLink Field
$default_fd['slide']['imagelink'] = array(
        'fd_name' => "Weblink",
        'fd_type' => "text",
        'fd_size' => 80,
        'fd_order' => $o++,
        'fd_tabname' => "Content"
    );

if (class_exists('Jojo_Plugin_jojo_videoembed')) {
// Image Field
$default_fd['slide']['videourl'] = array(
        'fd_name' => "Video URL",
        'fd_type' => "text",
        'fd_size' => 80,
        'fd_order' => $o++,
        'fd_tabname' => "Content"
    );
}

// Description Field
$default_fd['slide']['description'] = array(
        'fd_name' => "Description",
        'fd_type' => "hidden",
        'fd_order' => $o++,
        'fd_tabname' => "Content"
    );

// Description_code Field
$default_fd['slide']['description_code'] = array(
        'fd_name' => "Description_code",
        'fd_type' => "texteditor",
        'fd_options' => "description",
        'fd_order' => $o++,
        'fd_tabname' => "Content"
    );

// Displayorder Field
$default_fd['slide']['displayorder'] = array(
        'fd_name' => "Displayorder",
        'fd_type' => "integer",
        'fd_default' => "0",
        'fd_order' => $o++,
        'fd_tabname' => "Content"
    );


/* Slideshow */

$default_td['slideshow'] = array(
        'td_name' => "slideshow",
        'td_primarykey' => "slideshowid",
        'td_displayfield' => "sstitle",
        'td_filter' => "yes",
        'td_topsubmit' => "yes",
        'td_addsimilar' => "no",
        'td_deleteoption' => "yes",
        'td_menutype' => "list",
        'td_help' => "New slideshow's options.",
        'td_plugin' => "Jojo_bxslider"
    );

$table = 'slideshow';
$o = 1;

// ID Field
$default_fd[$table]['slideshowid'] = array(
        'fd_name' => "ID",
        'fd_type' => "integer",
        'fd_readonly' => "1",
        'fd_help' => "A unique ID, automatically assigned by the system",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
        'fd_mode' => "advanced"
    );

$default_fd[$table]['sstitle'] = array(
        'fd_name' => "Title",
        'fd_type' => "text",
        'fd_size' => 80,
        'fd_order' => $o++,
        'fd_tabname' => "Content"
    );

// Page Field
$default_fd[$table]['pageid'] = array(
        'fd_name' => "Page",
        'fd_type' => "dbpluginpagelist",
        'fd_options' => "jojo_plugin_jojo_bxslider",
        'fd_readonly' => "1",
        'fd_default' => "1",
        'fd_help' => "The page on the site used for this slideshow.",
        'fd_order' => $o++,
        'fd_tabname' => "Content"
    );

// index image
$default_fd[$table]['indeximage'] = array(
        'fd_name' => "Index Image",
        'fd_type' => "fileupload",
        'fd_readonly' => "0",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

// sizing Field
$default_fd[$table]['width'] = array(
        'fd_name' => "Slide width",
        'fd_type' => "integer",
        'fd_readonly' => "0",
        'fd_default' => 800,
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['height'] = array(
        'fd_name' => "Slide height",
        'fd_type' => "integer",
        'fd_readonly' => "0",
        'fd_default' => 500,
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

// sizing Field
$default_fd[$table]['imagewidth'] = array(
        'fd_name' => "Image width",
        'fd_type' => "integer",
        'fd_readonly' => "0",
        'fd_default' => 800,
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['imageheight'] = array(
        'fd_name' => "Image height",
        'fd_type' => "integer",
        'fd_readonly' => "0",
        'fd_default' => 500,
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

// Options
$default_fd[$table]['transition'] = array(
        'fd_name' => "Transition Mode",
        'fd_type' => "radio",
        'fd_readonly' => "0",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['controls'] = array(
        'fd_name' => "Show Controls",
        'fd_type' => "yesno",
        'fd_readonly' => "0",
        'fd_default' => "1",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['pager'] = array(
        'fd_name' => "Show Slide Nav",
        'fd_type' => "yesno",
        'fd_readonly' => "0",
        'fd_default' => "0",
        'fd_help' => "Display navigation.",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['pagerimages'] = array(
        'fd_name' => "Slide Nav images",
        'fd_type' => "yesno",
        'fd_readonly' => "0",
        'fd_default' => "0",
        'fd_help' => "Display thumbnail images in navigation instead of icons/numbers.",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['thumbimagesize'] = array(
        'fd_name' => "Thumbnail Size",
        'fd_type' => "text",
        'fd_readonly' => "0",
        'fd_default' => '170x100',
        'fd_order' => $o++,
        'fd_tabname' => "Content"
    );

$default_fd[$table]['pagerbottom'] = array(
        'fd_name' => "Slide nav at bottom",
        'fd_type' => "yesno",
        'fd_readonly' => "0",
        'fd_default' => "1",
        'fd_help' => "Display navigation at bottom (rather than top).",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );
$default_fd[$table]['auto'] = array(
        'fd_name' => "Enable Auto Play",
        'fd_type' => "yesno",
        'fd_readonly' => "0",
        'fd_default' => "0",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['autocontrols'] = array(
        'fd_name' => "Auto Controls",
        'fd_type' => "yesno",
        'fd_readonly' => "0",
        'fd_default' => "0",
        'fd_help' => "Display Start/Stop controls.",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['autostart'] = array(
        'fd_name' => "Auto Start",
        'fd_type' => "yesno",
        'fd_readonly' => "0",
        'fd_default' => "1",
        'fd_help' => "Start Auto play automatically.",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['autohoverpause'] = array(
        'fd_name' => "Auto Hover Pause",
        'fd_type' => "yesno",
        'fd_readonly' => "0",
        'fd_default' => "1",
        'fd_help' => "Pause Auto play on mouse hover.",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['loop'] = array(
        'fd_name' => "Infinite Loop",
        'fd_type' => "yesno",
        'fd_readonly' => "0",
        'fd_default' => "1",
        'fd_help' => "Pause Auto play on mouse hover.",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['ticker'] = array(
        'fd_name' => "Ticker",
        'fd_type' => "yesno",
        'fd_readonly' => "0",
        'fd_default' => "0",
        'fd_help' => "Play as a continuous ticker.",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['tickerhoverpause'] = array(
        'fd_name' => "Ticker Hover Pause",
        'fd_type' => "yesno",
        'fd_readonly' => "0",
        'fd_default' => "0",
        'fd_help' => "Pause Ticker play on mouse hover.",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['random'] = array(
        'fd_name' => "Random Slide Start",
        'fd_type' => "yesno",
        'fd_readonly' => "0",
        'fd_default' => "0",
        'fd_help' => "Start on a random slide.",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['captions'] = array(
        'fd_name' => "Image Captions",
        'fd_type' => "yesno",
        'fd_readonly' => "0",
        'fd_default' => "0",
        'fd_help' => "Show image titles as captions.",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['titles'] = array(
        'fd_name' => "Slide Titles",
        'fd_type' => "yesno",
        'fd_readonly' => "0",
        'fd_default' => "0",
        'fd_help' => "Show slide titles.",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['speed'] = array(
        'fd_name' => "Transition Speed",
        'fd_type' => "integer",
        'fd_readonly' => "0",
        'fd_default' => "500",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['pause'] = array(
        'fd_name' => "Pause",
        'fd_type' => "integer",
        'fd_readonly' => "0",
        'fd_default' => "3000",
        'fd_help' => "Pause length between slides on auto play.",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['slidedisplayqty'] = array(
        'fd_name' => "Slides to Show",
        'fd_type' => "integer",
        'fd_readonly' => "0",
        'fd_default' => "1",
        'fd_help' => "How many slides should show at once.",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );

$default_fd[$table]['slidemoveqty'] = array(
        'fd_name' => "Slides to Move",
        'fd_type' => "integer",
        'fd_readonly' => "0",
        'fd_default' => "1",
        'fd_help' => "How many slides should move at once.",
        'fd_order' => $o++,
        'fd_tabname' => "Content",
    );
