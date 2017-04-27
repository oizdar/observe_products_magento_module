<?php

class Clever_Subscriber_Adminhtml_SubscribersController extends Mage_Adminhtml_Controller_Action
{
    const GRID_BLOCK_NAMESPACE = 'subscriber/adminhtml_subscribers_grid';

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('customer/customer');
        $this->_addContent($this->getLayout()->createBlock('subscriber/adminhtml_subscribers'));
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock(static::GRID_BLOCK_NAMESPACE)->toHtml()
        );
    }

    public function exportCsvAction()
    {
        $grid = $this->getLayout()->createBlock(static::GRID_BLOCK_NAMESPACE);
        $this->_prepareDownloadResponse('observedProducts.csv', $grid->getCsvFile());
    }

    public function exportExcelAction()
    {
        $filename = 'observedProducts.xml';
        $grid = $this->getLayout()->createBlock(static::GRID_BLOCK_NAMESPACE);
        $this->_prepareDownloadResponse($filename, $grid->getExcelFile($filename));
    }
}