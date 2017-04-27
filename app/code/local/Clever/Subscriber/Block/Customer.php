<?php

class Clever_Subscriber_Block_Customer extends Mage_Core_Block_Template
{

    public function getProducts()
    {
        $email = Mage::getSingleton('customer/session')->getCustomer()->getEmail();

        $subscriptions = Mage::getModel('subscriber/subscriptions')->getCollection()
            ->addFieldToFilter('email', $email)
            ->getData();

        $productCollection = [];
        if(!empty($subscriptions)) {
            $productIds = [];
            foreach($subscriptions as $product) {
                $productIds[] = $product['product_id'];
            }
            $productCollection = Mage::getModel('catalog/product')->getCollection();
            $productCollection->addAttributeToSelect('name');
            $productCollection->addFieldToFilter('entity_id', ['in' => [$productIds]]);
        }
        return $productCollection;
    }

}