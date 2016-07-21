<?php

class SI_Testimonials_Model_Resource_Testimonial extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('sitestimonials/table_testimonials', 'entity_id');
    }

}