<?php

class Clever_Subscriber_AjaxController extends Mage_Core_Controller_Front_Action
{
    public function postAction()
    {
        $this->getResponse()->setHeader('Content-Type', 'application/json');
        $postedData = $this->getRequest()->getPost();

        $jsonData = [];
        if(!isset($postedData['productId']) || !isset($postedData['email'])) {
            $this->invalidArgumentResponse();
            return;
        }

        try {


            $userId = Mage::getSingleton('customer/session')->getCustomer()->getId();
            if (isset($userId)) {
                $email = Mage::getSingleton('customer/session')->getCustomer()->getEmail();
                if ($email !== $postedData['email']) {
                    $this->invalidArgumentResponse();
                    return;
                }
            } else {
                $customerModel = Mage::getModel('customer/customer');
                $customerModel->setWebsiteId(Mage::app()->getWebsite()->getId());
                $customer = $customerModel->loadByEmail($postedData['email']);
                if ($customer->getId() !== null) {
                    $this->pleaseLoginResponse();
                    return;
                }
            }
            $subscriptionsModel = Mage::getModel('subscriber/subscriptions');

            if ($subscriptionsModel->isSubscribed($postedData['email'], $postedData['productId'])) {
                $jsonData = $this->getOKResponseData('Product already subscribed.');
            } else {
                $subscriptionsModel->addData([
                    'email' => $postedData['email'],
                    'product_id' => $postedData['productId'],
                ]);
                $subscriptionsModel->save();


                $jsonData = $this->getOKResponseData('Product successfully subscribed.');
            }
        } catch(Exception $e) {
            $this->databaseErrorResponse();
            return;
        }

        $this->setJsonResponse(200, $jsonData);
    }


    protected function invalidArgumentResponse()
    {
        $jsonData = [
            'code' => 'INVALID_ARGUMENT',
            'error' => 'Invalid argument exception.'
        ];
        $this->setJsonResponse(400, $jsonData);
    }

    protected function pleaseLoginResponse()
    {
        $jsonData = [
            'code' => 'EMAIL_EXISTS',
            'error' => 'Please login to subscribe, customer email exists in database.'
        ];
        $this->setJsonResponse(400, $jsonData);
    }

    protected function setJsonResponse($code, $jsonData = [])
    {
        $this->getResponse()->setHttpResponseCode($code);
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($jsonData));
    }

    protected function getOKResponseData($message = 'Product succesfully subscribed')
    {
        return [
            'code' => 'OK',
            'message' => $message
        ];
    }

    protected function databaseErrorResponse()
    {
        $jsonData = [
            'code' => 'DATABASE_ERROR',
            'error' => 'Database error occured. Try again later or contact administrator.'
        ];
        $this->setJsonResponse(500, $jsonData);
    }
}