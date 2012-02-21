<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAutoload()
    {	
        date_default_timezone_set('Europe/Kiev');
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath'  => dirname(__FILE__),
        ));
        return $autoloader;
    }

    protected function _initThirdPartyLib()
    {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        ZendX_JQuery::enableView($view);
    }
}

