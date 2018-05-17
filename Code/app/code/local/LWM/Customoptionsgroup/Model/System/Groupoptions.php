<?php

class LWM_Customoptionsgroup_Model_System_Groupoptions
{
    public function toOptionArray()
    {
		$groups = array();
		$groups[] = array('value' => '', 'label' => Mage::helper('adminhtml')->__('-- Please select --'));
		$groups_option = Mage::getModel('customoptionsgroup/customoptionsgroup')->getCollection()->setOrder('id', 'Asc')->getData();
		foreach ($groups_option as $key => $option) {
			$groups[] = array('value' => $option['id'], 'label' => $option['group_label']);
		}		
        return $groups;
    }
}
