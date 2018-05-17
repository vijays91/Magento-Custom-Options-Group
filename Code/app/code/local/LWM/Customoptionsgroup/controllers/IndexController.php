<?php

class LWM_Customoptionsgroup_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction() {
		$groups_option = Mage::getModel('customoptionsgroup/customoptionsgroup')->getCollection()->getData();
		foreach ($groups_option as $key => $option) {
			print_r($option['group_label']);
		}
	}
}