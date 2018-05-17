<?php

class LWM_Customoptionsgroup_Block_Adminhtml_Customoptionsgroup extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_customoptionsgroup';
        $this->_blockGroup = 'customoptionsgroup';
        $this->_headerText = Mage::helper('customoptionsgroup')->__('Custom Options Group Reports');
        parent::__construct();
		// $this->_removeButton('add');
    }
}