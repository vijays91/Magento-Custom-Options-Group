<?php
class LWM_Customoptionsgroup_Block_Adminhtml_Customoptionsgroup_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

	public function __construct() {
        parent::__construct();
    }
	protected function _prepareForm()
    {
		$viewForm = new Varien_Data_Form(array(
            'id' => 'edit_form',
			'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
			'method' => 'post',
        ));
		
		$fieldset = $viewForm->addFieldset('customoptionsgroupview_form', array(
            'legend'      => Mage::helper('customoptionsgroup')->__('Custom Options Group'),
            'class'        => 'fieldset-wide',
            )
        );
		
		$value =   Mage::registry('customoptionsgroup_data')->getData();
						
        $fieldset->addField('group_label', 'text', array(
            'label'     => Mage::helper('customoptionsgroup')->__('Group Label'),
            'text'      => $value['group_label'],
            'required'  => true,
			'class'     => 'required-entry',
			'name'      => 'group_label',
        ));

   //      $fieldset->addField('sort_order', 'text', array(
   //          'label'     => Mage::helper('customoptionsgroup')->__('Sort Order'),
   //          'text'      => $value['sort_order'],
   //          'required'  => true,
			// 'class'     => 'required-entry',
			// 'name'      => 'sort_order',
   //      ));

		if ( Mage::getSingleton('adminhtml/session')->getcustomoptionsgroupData() )
		{
		  $viewForm -> setValues(Mage::getSingleton('adminhtml/session')->getcustomoptionsgroupData());
		  Mage::getSingleton('adminhtml/session')->getcustomoptionsgroupData(null);
		} elseif ( Mage::registry('customoptionsgroup_data') ) {
		  $viewForm-> setValues(Mage::registry('customoptionsgroup_data')->getData());
		}

		$viewForm->setUseContainer(true);
        $this->setForm($viewForm);

		return parent::_prepareForm();
	}	
}