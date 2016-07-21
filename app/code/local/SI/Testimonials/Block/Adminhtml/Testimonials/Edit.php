<?php

class SI_Testimonials_Block_Adminhtml_Testimonials_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'sitestimonials';
        $this->_controller = 'adminhtml_testimonials';
    }

    public function getHeaderText()
    {
        $helper = Mage::helper('si_testimonials');
        $model = Mage::registry('current_testimonial');

        if ($model->getId()) {
            return $helper->__("Edit Testimonial item '%s'", $this->escapeHtml($model->getId()));
        } else {
            return $helper->__("Add Testimonial item");
        }
    }

}