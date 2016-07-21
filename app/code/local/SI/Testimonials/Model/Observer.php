<?php

class SI_Testimonials_Model_Observer
{
    public function regenerateMenu($observer)
    {

        $menu = $observer->getMenu();
        $tree = $menu->getTree();

        $data = array(
            'name' => Mage::helper('catalog')->__('Feedback'),
            'id' => 'testimonial-menu-item',
            'url' => Mage::getURL('feedback')
        );

        $testimonialNode = new Varien_Data_Tree_Node($data, 'id', $tree, $menu);
        $menu->addChild($testimonialNode);

    }
}