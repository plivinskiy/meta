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
 * Observer
 *
 * @category   Magidev
 * @package    Magidev_MetaRobots
 * @author     Magidev Team <support@magidev.com>
 */

class Magidev_MetaRobots_Model_Observer {

    /**
     * Add to Blocks additional info
     * event: core_block_abstract_to_html_before
     *
     * @param Varien_Event_Observer $observer
     * @return bool
     */
    public function beforeToHtml(Varien_Event_Observer $observer)
    {
        if (Mage::getSingleton('magidev_robots/config')->isEnabled()&&$observer->getBlock() instanceof Mage_Page_Block_Html_Head) {
            Mage::helper('magidev_robots')->addMetaRobots($observer->getBlock());
        }
    }

}