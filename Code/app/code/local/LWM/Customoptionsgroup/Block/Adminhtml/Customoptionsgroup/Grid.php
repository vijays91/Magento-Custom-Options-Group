<?php

class LWM_Customoptionsgroup_Block_Adminhtml_Customoptionsgroup_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('customoptionsgroupGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('customoptionsgroup/customoptionsgroup')->getCollection();
        $this->setCollection($collection);		
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
   //      $this->addColumn('id', array(
   //          'header'    => Mage::helper('customoptionsgroup')->__('ID'),
   //          'align'     => 'right',
			// 'type'		=> 'number',
   //          'index'     => 'id',
   //      ));
		
        $this->addColumn('group_label', array(
            'header'    => Mage::helper('customoptionsgroup')->__('Group Label'),
            'width'     => '150',
            'index'     => 'group_label'
        ));

   //      $this->addColumn('sort_order', array(
   //          'header'    => Mage::helper('customoptionsgroup')->__('Sort Order'),
   //          'align'     => 'right',
			// 'width'		=> '120px',
   //          'index'     => 'sort_order',
   //      )); 
		
   //      $this->addColumn('created_at', array(
   //          'header'    => Mage::helper('customoptionsgroup')->__('Created At'),
   //          'index' 	=> 'created_at',
   //          'type' 		=> 'datetime',
   //          'width' 	=> '150px',
   //      ));
		
 
   //      $this->addColumn('updated_at', array(
   //          'header'    => Mage::helper('customoptionsgroup')->__('Updated At'),
   //          'index' 	=> 'updated_at',
   //          'type'		=> 'datetime',
			// //'default'   => '--',
   //          'width' 	=> '150px',
   //      ));

        return parent::_prepareColumns();
    }
	
	
	
	protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('customoptionsgroup');		
        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('customoptionsgroup')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('customoptionsgroup')->__('Are you sure Want to Delete?')
        ));
        return $this;
    }
	
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/view', array('id' => $row->getId()));
    }

    public function getGridUrl()
    {
      return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}