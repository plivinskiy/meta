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
 * Config source block of robots select
 *
 * @category   Magidev
 * @package    Magidev_MetaRobots
 * @author     Magidev Team <support@magidev.com>
 */
class Magidev_MetaRobots_Block_System_Config_Source_Robots_Select extends Mage_Core_Block_Html_Select
{
    /**
     * Return output in one line
     *
     * @return string
     */
    public function _toHtml()
    {
        return trim(preg_replace('/\s+/', ' ',parent::_toHtml()));
    }
}