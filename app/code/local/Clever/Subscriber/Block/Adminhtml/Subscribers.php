<?php

class Clever_Subscriber_Block_Adminhtml_Subscribers extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'subscriber';
        $this->_controller = 'adminhtml_subscribers';
        $this->_headerText = 'Observed Products';

        parent::__construct();
        $this->_removeButton('add');
    }
}