<?php

class LWM_Customoptionsgroup_Model_Product_Option extends Mage_Catalog_Model_Product_Option
{
    /**
     * get Product Option Collection
     *
     * @param Mage_Catalog_Model_Product $product
     * @return Mage_Catalog_Model_Resource_Product_Option_Collection
     */
    public function getProductOptionCollection(Mage_Catalog_Model_Product $product)
    {
        $collection = $this->getCollection()
            ->addFieldToFilter('product_id', $product->getId())
            ->addTitleToResult($product->getStoreId())
            ->addPriceToResult($product->getStoreId());

            if(!Mage::app()->getStore()->isAdmin()){
                $collection->setOrder('group_options', 'asc');
            }

        $collection->setOrder('sort_order', 'asc')
            ->setOrder('title', 'asc');
        // echo $collection->getSelect();


        if ($this->getAddRequiredFilter()) {
            $collection->addRequiredFilter($this->getAddRequiredFilterValue());
        }

        $collection->addValuesToResult($product->getStoreId());
        return $collection;
    }
    public function getGroupOptionLabel($id = 0) {
        if($id > 0) {
            $collection = Mage::getModel('customoptionsgroup/customoptionsgroup')->load($id);
            return $collection;
        } else {
            return $this->__("Default");
        }
    }
}
