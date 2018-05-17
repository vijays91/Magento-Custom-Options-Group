<?php

class LWM_Customoptionsgroup_Adminhtml_CustomoptionsgroupController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
		$this->loadLayout()->_setActiveMenu('customoptionsgroup/items')
		->_addBreadcrumb(Mage::helper('adminhtml')->__('Contact Form Fields '), Mage::helper('adminhtml')->__('Custom Options Group'));
		return $this;
    }  

    public function indexAction() 
	{
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('customoptionsgroup/adminhtml_customoptionsgroup'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('view');
    }


	public function viewAction()
	{
		$customoptionsgroupId     = $this->getRequest()->getParam('id');
		$customoptionsgroupModel  = Mage::getModel('customoptionsgroup/customoptionsgroup')->load($customoptionsgroupId); 
        if ($customoptionsgroupModel->getId() || $customoptionsgroupId == 0) 
		{
			Mage::register('customoptionsgroup_data', $customoptionsgroupModel); 
            $this->loadLayout();
            $this->_setActiveMenu('customoptionsgroup/items');           
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Contact Record Manager'), Mage::helper('adminhtml')->__('Record Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Record Details'), Mage::helper('adminhtml')->__('Record Details'));           
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);           
            $this->_addContent($this->getLayout()->createBlock('customoptionsgroup/adminhtml_customoptionsgroup_edit'));
            $this->renderLayout();
        }
		else 
		{
            Mage::getSingleton('adminhtml/session')->addError(
				Mage::helper('customoptionsgroup')->__('Record does not exist')
			);
            $this->_redirect('*/*/');
        }
	}
	
    public function saveAction()
    {
        if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
                $smsnotificationModel = Mage::getModel('customoptionsgroup/customoptionsgroup');

                $smsnotificationModel->setId($this->getRequest()->getParam('id'))
                    ->setSortOrder($postData['sort_order'])
                    ->setGroupLabel($postData['group_label'])
                    ->setCreatedAt(now())
                    ->setUpdatedAt(now())
                    ->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setsmsnotificationData($this->getRequest()->getPost());
                $this->_redirect('*/*/view', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }

        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        $customoptionsgroupId     = $this->getRequest()->getParam('id');
        try  {
            $customoptionsgroup_del = Mage::getModel('customoptionsgroup/customoptionsgroup')->load($customoptionsgroupId);
            $customoptionsgroup_del->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Item was successfully deleted', count($customoptionsgroups)
                    )
                );
        } 
        catch (Exception $error)  {
            Mage::getSingleton('adminhtml/session')->addError($error->getMessage());
        }
        $this->_redirect('*/*/index');
    }
    public function massDeleteAction() {
        $customoptionsgroups = $this->getRequest()->getParam('customoptionsgroup');
        if(!is_array($customoptionsgroups)) 
		{
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } 
		else 
		{
            try 
			{
                foreach ($customoptionsgroups as $customoptionsgroupId) 
				{
                    $customoptionsgroup_del = Mage::getModel('customoptionsgroup/customoptionsgroup')->load($customoptionsgroupId);
                    $customoptionsgroup_del->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($customoptionsgroups)
                    )
                );
            } 
			catch (Exception $error) 
			{
                Mage::getSingleton('adminhtml/session')->addError($error->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
    public function gridAction() {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('customoptionsgroup/adminhtml_customoptionsgroup_grid')->toHtml()
        );
    }
	
}