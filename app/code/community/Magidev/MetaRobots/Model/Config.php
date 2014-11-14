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
class Magidev_MetaRobots_Model_Config extends Mage_Core_Model_Abstract
{

    /**
     * Retrieve config option: Meta Tag Robots
     * @return array
     */
    public function getMetaRobotsContent(){
        $config=unserialize(Mage::getStoreConfig('magidev_seo/general/meta_index'));
        if(empty($config)){
            return array();
        }
        return $config;
    }
    /**
     * Retrieve config option: Disable Canonical Tag on Page
     * @return array
     */
    public function disableCanonical(){
        return Mage::getStoreConfig('magidev_seo/general/disable_canonical');
    }

    /**
     * Retrieve config option: Use Canonical Link Meta Tag For Categories and Products
     * @return int
     */
    public function isCanonicalEnabled(){
        return (Mage::getStoreConfig('catalog/seo/product_canonical_tag')||Mage::getStoreConfig('catalog/seo/category_canonical_tag'));
    }

    /**
     * Retrieve config option: Design ->  HTML Head -> Default Robots
     * @return string
     */
    public function getDefaultMetaRobotsContent(){
        return Mage::getStoreConfig('design/head/default_robots');
    }

    /**
     * Retrieve config option: Enable Meta Robots Override
     * @return string
     */
    public function isEnabled(){
        return Mage::getStoreConfig('magidev_seo/general/enabled');
    }
}