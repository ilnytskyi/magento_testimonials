<?php

class SI_Testimonials_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getTestimonialsUrl() {
        return $this->_getUrl('feedback');
    }

    public function getStatusValues() {
        return array(
            '0' => 'Pending',
            '1' => 'Published',
            '2' => 'Rejected',
        );
    }
}