<?php
class Clever_Subscriber_Model_Resource_Subscriptions_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {
    protected function _construct()
    {
        $this->_init('subscriber/subscriptions');
    }
}