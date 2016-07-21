<?php

class SI_Testimonials_Model_Testimonial extends Mage_Core_Model_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('sitestimonials/testimonial');
    }

}