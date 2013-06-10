<?php
/**
 *
 * Copyright 2007 Michael Cochrane <code@gardyneholt.co.nz>
 *
 * See the enclosed file license.txt for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @author  Michael Cochrane <code@gardyneholt.co.nz>
 * @license http://www.fsf.org/copyleft/lgpl.html GNU Lesser General Public License
 * @link    http://www.jojocms.org JojoCMS
 */

$_provides['pluginClasses'] = array(
        'Jojo_Plugin_Jojo_bxslider' => 'Slideshow',
        );

/* Content filter for grabbing [[bxslider: title]] */
Jojo::addFilter('output', 'contentFilter', 'jojo_bxslider');


/* capture the button press in the admin section */
Jojo::addHook('admin_action_after_save_page', 'admin_action_after_save_page', 'jojo_bxslider');
Jojo::addHook('admin_action_after_save_slideshow', 'admin_action_after_save_slideshow', 'jojo_bxslider');
