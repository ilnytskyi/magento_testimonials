<?php

class SI_Testimonials_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction(){
        $data = $this->getRequest()->getPost();
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $testimonial = Mage::getModel('sitestimonials/testimonial');

        $testimonial->setContent($data['testimonial']['content']);
        $testimonial->setUserId($customer->getId());
        $testimonial->setCreated(now());
        //$testimonial->setStatus(0); // always pending
        $testimonial->save();

        $this->loadLayout();
        $this->renderLayout();
    }

}