<?php

class SI_Testimonials_Block_Testimonials extends Mage_Core_Block_Template
{

    public function __construct()
    {
        parent::__construct();
        $collection = Mage::getModel("sitestimonials/testimonial")->getCollection();
        $collection->addFieldToFilter('status', '1');
        $collection->setOrder('created', 'DESC')->load();

        $this->setCollection($collection);
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $pager = $this->getLayout()->createBlock('page/html_pager', 'testimonials.pager');
        $pager->setCollection($this->getCollection());
        $pager->setAvailableLimit(array(10 => 10, 20 => 20, 'all' => 'all'));
        $this->setChild('pager', $pager);
        $this->getCollection()->load();
        return $pager;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }


    public function getCollection()
    {
        $limit = 5;
        $curr_page = 1;

        if (Mage::app()->getRequest()->getParam('p')) {
            $curr_page = Mage::app()->getRequest()->getParam('p');
        }

        if (Mage::app()->getRequest()->getParam('limit')) {
            $limit = Mage::app()->getRequest()->getParam('limit');
        }

        $offset = ($curr_page - 1) * $limit;
        $collection = Mage::getModel('sitestimonials/testimonial')->getCollection()
            ->addFieldToFilter('status', 1);
        $collection->setOrder('created', 'DESC');
        $collection->getSelect()->limit($limit, $offset);

        return $collection;
    }


}