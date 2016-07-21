<?php

class SI_Testimonials_Adminhtml_TestimonialsController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('si_testimonials');

        $contentBlock = $this->getLayout()->createBlock('sitestimonials/adminhtml_testimonials');
        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

    public function editAction()
    {
        $id = (int) $this->getRequest()->getParam('id');
        Mage::register('current_testimonial', Mage::getModel('sitestimonials/testimonial')->load($id));

        $this->loadLayout()->_setActiveMenu('si_testimonials');
        $this->_addContent($this->getLayout()->createBlock('sitestimonials/adminhtml_testimonials_edit'));

        //add editor
        $this->getLayout()->getBlock('head')->addJs('mage/adminhtml/wysiwyg/tiny_mce/setup.js');
        $this->getLayout()->getBlock('head')->addJs('mage/adminhtml/wysiwyg/tiny_mce/variables.js');
        $this->getLayout()->getBlock('head')->addJs('mage/adminhtml/wysiwyg/widget.js');
        $this->getLayout()->getBlock('head')->addJs('tiny_mce/tiny_mce.js');

        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            try {
                $model = Mage::getModel('sitestimonials/testimonial');
                $model->setData($data)->setId($this->getRequest()->getParam('id'));
                if(!$model->getCreated()){
                    $model->setCreated(now());
                }
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Testimonial was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('sitestimonials/testimonial')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Testimonial was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }
}