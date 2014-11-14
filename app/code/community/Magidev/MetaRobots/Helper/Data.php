<?php
/**
 * MagiDev
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade MagiDev Package to newer
 * versions in the future. If you wish to customize Package for your
 * needs please refer to http://www.magidev.com for more information.
 *
 * @category    Magidev
 * @package     Magidev_MetaRobots
 * @copyright   Copyright (c) 2014 MagiDev. (http://www.magidev.com)
 */

/**
 * Helper
 *
 * @category   Magidev
 * @package    Magidev_MetaRobots
 * @author     Magidev Team <support@magidev.com>
 */
class Magidev_MetaRobots_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * Add meta tag robots to header
     *
     * @param Mage_Page_Block_Html_Head $block
     * @return bool|void
     */
    public function addMetaRobots(Mage_Page_Block_Html_Head $block)
    {
        $_routers = Mage::getSingleton('magidev_robots/config')->getMetaRobotsContent();
        if (empty($_routers)) {
            return false;
        }
        $request = Mage::app()->getRequest();
        $_bool = false;
        foreach ($_routers as $_item) {
            $_router = trim($_item['router']);
            if (stripos($_router, '/') !== false && stripos($_router, '?') === false) { // parse url without query
                $_bool = $this->isIdenticalUrl($_router, $request);
            } elseif (stripos($_router, '?') !== false) { // parse url with query
                $_urlInfo = explode('?', $_router);
                $_bool2 = true;
                if (isset($_urlInfo[0]) && $_urlInfo[0] != '*' && $_urlInfo[0] != '') {
                    $_bool2 = $this->isIdenticalUrl($_urlInfo[0], $request);
                }
                if ($_bool2 && !empty($_urlInfo[1])) {
                    parse_str($_urlInfo[1], $_urlParams);
                    foreach ($_urlParams as $_param => $_value) {
                        if ($request->getParam($_param) == $_value) {
                            $_bool = true;
                        }
                    }
                }
            } elseif (stripos($_router, '|') !== false) {
                // params
                $_router = trim($_router, '|');
                $_params = explode('|', $_router);
                $_currentParams = Mage::app()->getRequest()->getParams();
                $_intersect = false;
                if (!empty($_params) && !empty($_currentParams)) {
                    $_intersect = array_intersect($_params, array_keys($_currentParams));
                }
                $_bool = ($_intersect && !empty($_intersect));

            } else { // parse action
                $_bool = $this->isIdenticalAction($_router, $request);
            }
            if ($_bool) {
                if (empty($_item['content'])) {
                    $_item['content'] = Mage::getSingleton('magidev_robots/config')->getDefaultMetaRobotsContent();
                }
                $block->setData('robots', $_item['content']);
                break;
            }
        }
        if (!Mage::getSingleton('magidev_robots/config')->disableCanonical()) {
            return;
        }
        // canonical tag can not be used with NOINDEX
        if (Mage::getSingleton('magidev_robots/config')->isCanonicalEnabled() && $_bool && in_array($_item['content'], array('NOINDEX,NOFOLLOW', 'NOINDEX,FOLLOW'))) {
            foreach ($block->getItems() as $_link) {
                if ($_link['type'] == 'link_rel' && $_link['params'] == 'rel="canonical"') {
                    $block->removeItem($_link['type'], $_link['name']);
                }
            }
        }

    }


    /**
     * Check if current action is identical with router
     *
     * @param $route
     * @param $request
     * @return bool
     */
    private function isIdenticalAction($route, $request)
    {
        $route = explode('_', trim($route, '/'));
        if (empty($route)) {
            return false;
        }
        $_action = $_module = $_controller = false;
        if (isset($route[0]) && ($route[0] == '*' || $request->getModuleName() == trim($route[0]))) {
            $_module = true;
        }
        if (isset($route[1]) && ($route[1] == '*' || $request->getControllerName() == trim($route[1]))) {
            $_controller = true;
        }
        if (isset($route[2]) && ($route[2] == '*' || $request->getActionName() == trim($route[2]))) {
            $_action = true;
        }
        return $_module && $_controller && $_action;
    }

    /**
     * Check if current url is identical with router
     *
     * @param $route
     * @param $request
     * @return bool
     */
    private function isIdenticalUrl($route, $request)
    {
        if (empty($route)) {
            return false;
        }
        $_pathInfo = $request->getOriginalPathInfo();
        $_originalRoute = $route = trim($route);
        if ($_pathInfo == $route) {
            return true;
        }
        if ($_pathInfo == '/') {
            return false;
        }
        $route = explode('/', trim($route, '/'));
        if (empty($route)) {
            return false;
        }
        $_pathInfo = explode('/', trim($_pathInfo, '/'));
        foreach ($route as $_index => $_str) {
            $_str = trim($_str);
            if (isset($_pathInfo[$_index]) && ($_str != trim($_pathInfo[$_index]) && $_str != '*')) {
                return false;
            }
        }
        if (count($_pathInfo) > count($route) && substr($_originalRoute, -1) != '*') {
            return false;
        }
        return true;
    }
}