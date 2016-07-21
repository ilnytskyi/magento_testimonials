<?php

class SI_Testimonials_Block_Adminhtml_Testimonials extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('si_testimonials');
        $this->_blockGroup = 'sitestimonials';
        $this->_controller = 'adminhtml_testimonials';
        $this->_headerText = $helper->__('Testimonials Management');
        $this->_removeButton('add');
        // $this->_addButtonLabel = $helper->__('Add testimonial');
    }

}