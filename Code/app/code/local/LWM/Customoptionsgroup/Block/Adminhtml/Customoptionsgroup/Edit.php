<?php

class LWM_Customoptionsgroup_Block_Adminhtml_Customoptionsgroup_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'customoptionsgroup';
        $this->_controller = 'adminhtml_customoptionsgroup';
		// $this->_removeButton('save');
		// $this->_removeButton('reset');
    }
 
    public function getHeaderText()
    {
        if( Mage::registry('customoptionsgroup_data') && Mage::registry('customoptionsgroup_data')->getId() ) 
		{
            return Mage::helper('customoptionsgroup/data')->__("Custom Options Group &nbsp;'%s'  ", $this->htmlEscape(Mage::registry('customoptionsgroup_data')->getGroupLabel()));
        } else {
            return Mage::helper('customoptionsgroup')->__('Add Item');
        }
    }
}