<?php
class Clever_Subscriber_Model_Resource_Subscriptions extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('subscriber/subscriptions', ' ');
    }
}