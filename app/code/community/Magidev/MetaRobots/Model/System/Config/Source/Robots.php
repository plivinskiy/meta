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
 * Config source model of robots
 *
 * @category   Magidev
 * @package    Magidev_MetaRobots
 * @author     Magidev Team <support@magidev.com>
 */
class Magidev_MetaRobots_Model_System_Config_Source_Robots
{
    public function toOptionArray(){
        return array(
            array('value'=>'','label'=>'Default'),
            array('value'=>'INDEX,FOLLOW','label'=>'INDEX,FOLLOW'),
            array('value'=>'NOINDEX,FOLLOW','label'=>'NOINDEX,FOLLOW'),
            array('value'=>'NOINDEX,NOFOLLOW','label'=>'NOINDEX,NOFOLLOW'),
            array('value'=>'INDEX,NOFOLLOW','label'=>'INDEX,NOFOLLOW')
        );
    }
}