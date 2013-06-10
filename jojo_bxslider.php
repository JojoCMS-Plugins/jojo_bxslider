<?php
/**
 *                    Jojo CMS
 *                ================
 *
 * Copyright 2007 Harvey Kane <code@ragepank.com>
 * Copyright 2007 Michael Holt <code@gardyneholt.co.nz>
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

class Jojo_Plugin_Jojo_bxslider extends Jojo_Plugin
{

    /* Gets $num items sorted for use on homepages and sidebars */
    static function getItems($showid=false, $pageid=false) {
        $query  = "SELECT s.*, c.*";
        $query .= $pageid ? ", p.pageid, pg_menutitle, pg_title, pg_url, pg_status, pg_livedate, pg_expirydate" : '';
        $query .= " FROM {slide} s";
        $query .= " LEFT JOIN {slideshow} c ON (s.slideshowid=c.slideshowid)";
        $query .= $showid ? " WHERE c.slideshowid =" . $showid : " LEFT JOIN {page} p ON (c.pageid=p.pageid) WHERE c.pageid =" . $pageid ;
        $query .=  " ORDER BY s.displayorder, s.title";
        $items = Jojo::selectQuery($query);
        $items = self::cleanItems($items, $showid);
        return $items;
    }

    /* clean items for output */
    static function cleanItems($items, $filter=false) {
        foreach ($items as $k=>&$i){
            if (!$filter) {
                $pagedata = Jojo_Plugin_Core::cleanItems(array($i));
                if (!$pagedata) {
                    unset($items[$k]);
                    continue;
                }
                $i['pagetitle'] = $pagedata[0]['title'];
                $i['pageurl']   = $pagedata[0]['url'];
            }
            $i['id']           = $i['slideid'];
            $i['title']        = htmlspecialchars($i['title'], ENT_COMPAT, 'UTF-8', false);
            /* Strip all tags and template include code ie [[ ]] */
            $i['bodyplain'] = preg_replace('/\[\[.*?\]\]/', '',  trim(strip_tags($i['description'])));
            $i['image'] = $i['image'] ? 'slides/' . $i['image'] : '';
            $i['plugin']     = 'jojo_bxslider';
            unset($items[$k]['description_code']);
        }
        return $items;
    }


    function _getContent()
    {
        global $smarty;
        $content = array();

        $pageid = $this->page['pageid'];
        $slides = self::getItems(false, $pageid);
		$smarty->assign('slideshow', $slides[0]);
		$smarty->assign('slides', $slides);

        $content['content'] = $smarty->fetch('jojo_bxslider.tpl');
        $content['javascript'] = $smarty->fetch('jojo_bxslider_js.tpl');
        return $content;
    }

    public static function contentFilter($content)
    {
        global $smarty;
        if (strpos($content, '[[bxslider:') === false) {
            return $content;
        }
        preg_match_all('/\[\[bxslider: ?([^\]]*)\]\]/', $content, $matches);
        foreach($matches[1] as $k => $search) {
            /* convert name into ID */
            if (is_numeric($search)) {
                $id = $search;
            } else {
                $slideshow = Jojo::selectRow("SELECT slideshowid FROM {slideshow} WHERE name = ?", array($search));
                $id = $slideshow['slideshowid'];
            }
            if (isset($id)) {
                $slides = self::getItems($id);
                $smarty->assign('filterslideshow', true);
                $smarty->assign('slideshow', $slides[0]);
                $smarty->assign('slides', $slides);

                $html = $smarty->fetch('jojo_bxslider.tpl');
                $js = $smarty->fetch('jojo_bxslider_js.tpl');
                $html = $html . "\n" .
                "<script>\n" . $js . "\n</script>\n";
                $content   = str_replace($matches[0][$k], $html, $content);
            }
        }
        return $content;
    }

    // Sync the category data over to the page table
    static function admin_action_after_save_slideshow($id) {
        if (!Jojo::getFormData('fm_pageid', 0)) {
            // no pageid set for this category (either it's a new category or maybe the original page was deleted)
            self::sync_category_to_page($id);
       }
    }

    // Sync the category data over from the page table
    static function admin_action_after_save_page($id) {
        if (strtolower(Jojo::getFormData('fm_pg_link',    ''))=='jojo_plugin_jojo_bxslider') {
           self::sync_page_to_category($id);
       }
    }

    static function sync_category_to_page($catid) {
        // add a new hidden page for this category and make up a title
            $newpageid = Jojo::insertQuery(
            "INSERT INTO {page} SET pg_title = ?, pg_link = ?, pg_url = ?, pg_parent = ?, pg_status = ?",
            array(
                'New Presentation',  // Title
                'jojo_plugin_jojo_bxslider',  // Link
                '',  // URL
                0,  // Parent - don't do anything smart, just put it at the top level for now
                'hidden' // hide new page so it doesn't show up on the live site until it's been given a proper title and url
            )
        );
        // If we successfully added the page, update the category with the new pageid
        if ($newpageid) {
            jojo::updateQuery(
                "UPDATE {slideshow} SET pageid = ? WHERE slideshowid = ?",
                array(
                    $newpageid,
                    $catid
                )
            );
       }
    return true;
    }

    static function sync_page_to_category($pageid) {
        // Get the list of categories by page id
        $categories = jojo::selectAssoc("SELECT pageid AS id, pageid FROM {slideshow}");
        // no category for this page id
        if (!count($categories) || !isset($categories[$pageid])) {
            jojo::insertQuery("INSERT INTO {slideshow} (pageid) VALUES ('$pageid')");
        }
        return true;
    }


}
