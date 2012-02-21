<?php

class Form_SignUp extends Zend_Form
{
    public $name='signup';
    public function init()
    {
        $this->setName($this->name);
        $urlHelper = new Zend_View_Helper_Url();
        $this->setMethod('post');
        $this->addElement('text','email',array(
            'label'=>'E-Mail',
            'required'=>true,
            'requiredSuffix'=>'*',
            'class' => 'ui-state-default ui-corner-all',
            'validators'=>array('EmailAddress',/*array('Db_NoRecordExists',true,array('table'=>'user','field'=>'email'))*/), //uncomment to get validation of existing users
            'filters' => array('StringToLower')
        ))
        ->addElement('password','password',array(
            'label'=>'Password',
            'required'=>true,
            'requiredSuffix'=>'*',
            'class' => 'ui-state-default ui-corner-all',
            'validators'=>array(array('StringLength',true,array('encoding'=>'utf-8','min'=>3,'max'=>8)),
            'Alnum')))
            ->addElement('password','retypedPassword',array(
                'label'=>'Retype your password',
                'required'=>true,
                'requiredSuffix'=>'*',
                'class' => 'ui-state-default ui-corner-all',
                'validators'=>array(array('StringLength',true,array('encoding'=>'utf-8','min'=>3,'max'=>8)),
                'Alnum')))
                ->addElement('submit','submit', array('label'=>'Sign Up'));
        $this->addAjax();
        return $this; 
    }

    public function isValid($data)
    {
        if (empty($data['password'])) $data['password'] = null;
        $passwordMatchValidator = new Zend_Validate_Identical($data['password']);
        $passwordMatchValidator->setMessage('Passwords must match',Zend_Validate_Identical::NOT_SAME);
        $this->getElement('retypedPassword')->addValidator($passwordMatchValidator);
        return parent::isValid($data);
    }
    
    private function addAjax() {
        $view = Zend_Layout::getMvcInstance()->getView();
        $view->jQuery()->onLoadCaptureStart();
        $url = $view->url(array('format' => 'json'));
        echo "var form = $('#$this->name');\n";
        echo "var url = '$url';\n";
        echo file_get_contents('js/ajax_form.js');
        $view->jQuery()->onLoadCaptureEnd();
    }
    

}
