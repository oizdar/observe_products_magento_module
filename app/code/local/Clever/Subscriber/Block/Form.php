<?php

class Clever_Subscriber_Block_Form extends Mage_Core_Block_Template
{
    public function isLogged()
    {
        return Mage::getSingleton('customer/session')->isLoggedIn();
    }

    public function getEmail()
    {
        return Mage::getSingleton('customer/session')->getCustomer()->getEmail();
    }

    public function getCustomerId()
    {
        return Mage::getSingleton('customer/session')->getCustomer()->getId();
    }

    public function getFormAction()
    {
        return $this->getUrl('subscriber/ajax/post');
    }

    public function getProductId()
    {
        return Mage::registry('current_product')->getId();
    }

    public function isAvailable()
    {
        return Mage::registry('current_product')->isAvailable();
    }

    public function isSubscribed($email = null)
    {
        $customerEmail = Mage::getSingleton('customer/session')->getCustomer()->getEmail();
        $productId = Mage::registry('current_product')->getId();

        return Mage::getModel('subscriber/subscriptions')->isSubscribed($customerEmail, $productId);
    }

}