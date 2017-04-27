<?php

class Clever_Subscriber_Block_Adminhtml_Subscribers_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('subscribersGrid');
        $this->setDefaultSort('email');
        $this->setDefaultDir('ASC');

        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('subscriber/subscriptions')->getCollection();
        $collection->getSelect()
            ->joinLeft(
                ['c' => Mage::getSingleton('core/resource')->getTableName('customer/entity')],
                'c.email = main_table.email',
                ['entity_id' => 'entity_id']
            );

        $this->setCollection($collection);
        parent::_prepareCollection();

        return $this;
    }

    protected function _prepareColumns()
    {
        $this->addColumn('email', array(
            'header' => 'Email',
            'index'  => 'email',
            'width' => '400'
        ));

        $this->addColumn('customer_id', array(
            'header' => 'Customer ID',
            'index'  => 'entity_id',
            'width' => '100',
            'align' => 'center'

        ));

        $this->addColumn('product_id', array(
            'header' => 'Product ID',
            'index' => 'product_id',
            'width' => '100',
            'align' => 'center'
        ));

        $this->addExportType('*/*/exportCsv', 'CSV');
        $this->addExportType('*/*/exportExcel', 'Excel XML');

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }
}