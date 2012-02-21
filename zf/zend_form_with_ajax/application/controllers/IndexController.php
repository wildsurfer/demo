<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction() {
        $form = new Form_SignUp();
        $message = '';
        if ($this->_request->isPost())
        {
            if ($form->isValid($this->_getAllParams()))
            {
                $data = $form->getValues();
                //do smth with data here
                if ($this->_request->isXmlHttpRequest()) $this->_helper->json(null);
                else $message = 'Form is valid! Congratulations!';
            } else {
                if ($this->_request->isXmlHttpRequest()) $this->_helper->json($form->getMessages());
                else $message = 'Form is invalid!';
            }
        } 
        $this->view->message = $message;
        $this->view->form = $form;
    }
}
