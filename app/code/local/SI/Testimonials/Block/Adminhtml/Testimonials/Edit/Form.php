<?php

class SI_Testimonials_Block_Adminhtml_Testimonials_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $helper = Mage::helper('si_testimonials');
        $model = Mage::registry('current_testimonial');
        $statusValues = $helper->getStatusValues();
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array(
                'id' => $this->getRequest()->getParam('id')
            )),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $this->setForm($form);

        $fieldset = $form->addFieldset('news_testimonial', array('legend' => $helper->__('Testimonial Data')));

        $fieldset->addField('content', 'editor', array(
            'label' => $helper->__('Content'),
            'required' => true,
            'wysiwyg'   => true,
            'config'    => $wysiwygConfig,
            'name' => 'content',
        ));

        $fieldset->addField('created', 'date', array(
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_LONG    ),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'label' => $helper->__('Created'),
            'required' => false,
            'name' => 'created'
        ));

        $fieldset->addField('status', 'select', array(
            'label' => $helper->__('Status'),
            'required' => true,
            'name' => 'status',
            'values' => $statusValues
        ));

        $form->setUseContainer(true);

        if ($data = Mage::getSingleton('adminhtml/session')->getFormData()) {
            $form->setValues($data);
        } else {
            $form->setValues($model->getData());
        }

        return parent::_prepareForm();
    }

}
