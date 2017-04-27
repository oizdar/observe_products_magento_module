<?php
class Clever_subscriber_Model_Subscriptions extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('subscriber/subscriptions');
    }

    public function isSubscribed($customerEmail, $productId)
    {
        $data = $this->getCollection()
            ->addFieldToFilter('email', $customerEmail)
            ->addFieldToFilter('product_id', $productId)
            ->getData();

        return !empty($data);
    }
}