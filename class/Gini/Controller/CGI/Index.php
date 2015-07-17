<?php

namespace Gini\Controller\CGI {

    class Index extends \Gini\Controller\CGI\Layout\Genee {
        
        function __index() {
            $this->view->body = V('index');
        }
        
        function actionBadBrowser() {
            return \Gini\IoC::construct('\Gini\CGI\Response\HTML', V('bad-browser'));
        }
        
    }

}
