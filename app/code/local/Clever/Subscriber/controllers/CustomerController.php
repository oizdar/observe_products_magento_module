<?php

class Clever_Subscriber_CustomerController extends Mage_Core_Controller_Front_Action
{
    public function preDispatch()
    {
        parent::preDispatch();
        if (!Mage::getSingleton('customer/session')->authenticate($this)) {
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
        }
    }

    public function listAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle('My Observed Products');
        $this->renderLayout();
    }
}