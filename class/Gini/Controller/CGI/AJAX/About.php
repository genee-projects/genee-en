<?php

namespace Gini\Controller\CGI\AJAX {
    
    class About extends \Gini\Controller\CGI {
        
        function __index($name='') {
            
            if (!in_array($name, ['us', 'team', 'culture', 'honors'])) return;
            
            return \Gini\IoC::construct('\Gini\CGI\Response\HTML', V('about/'.$name));
            
        }
        
    }
    
}