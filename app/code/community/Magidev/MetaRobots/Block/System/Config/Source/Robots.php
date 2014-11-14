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
 * Config source block of robots
 *
 * @category   Magidev
 * @package    Magidev_MetaRobots
 * @author     Magidev Team <support@magidev.com>
 */
class Magidev_MetaRobots_Block_System_Config_Source_Robots extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    /**
     * Search field renderer
     *
     * @var Magidev_MetaRobots_Block_System_Config_Source_Robots_Select
     */
    protected $_contentRenderer;


    /**
     * Get select block for config field
     *
     * @return Magidev_MetaRobots_Block_System_Config_Source_Robots_Select
     */
    protected function _getContentRenderer()
    {

        if (!$this->_contentRenderer) {
            $this->_contentRenderer = $this->getLayout()
                    ->createBlock('magidev_robots/system_config_source_robots_select')
                    ->setIsRenderToJsTemplate(true);
        }
        return $this->_contentRenderer;
    }

    protected function _renderCellTemplate($columnName)
    {

        $inputName = $this->getElement()->getName() . '[#{_id}][' . $columnName . ']';
        if ($columnName == "content") {
            return $this->_getContentRenderer()
                    ->setName($inputName)
                    ->setTitle($columnName)
                    ->setExtraParams('style="width:260px"')
                    ->setOptions(
                            Mage::getModel("magidev_robots/system_config_source_robots")->toOptionArray()
                    )
                    ->toHtml();
        }
        return parent::_renderCellTemplate($columnName);
    }

    /**
     * Assign extra parameters to row
     *
     * @param Varien_Object $row
     */
    protected function _prepareArrayRow(Varien_Object $row)
    {
        $row->setData('option_extra_attr_' . $this->_getContentRenderer()->calcOptionHash($row->getData('content')), 'selected="selected"');
    }

    protected function _prepareToRender()
    {
        $this->_addressFieldRenderer = null;
        $this->_configFieldRenderer = null;

        $this->addColumn('router', array(
                'label' => Mage::helper('magidev_robots')->__('URL Pattern'),
        ));
        $this->addColumn('content', array(
                'label' => Mage::helper('magidev_robots')->__('Option'),
        ));

        // Disables "Add after" button
        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('magidev_robots')->__('Add Rule');
    }
}