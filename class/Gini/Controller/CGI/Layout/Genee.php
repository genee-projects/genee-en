<?php

namespace Gini\Controller\CGI\Layout {

    abstract class Genee extends \Gini\Controller\CGI\Layout {
        
        protected $breadcrumb;
        
        function __preAction($action, &$params) {
            
            // 检查是否是浏览器支持
            if (\Gini\CGI::route() != 'bad-browser') {
                $browser = new \Ikimea\Browser\Browser;
                if( $browser->getBrowser() == \Ikimea\Browser\Browser::BROWSER_IE && $browser->getVersion() < 8 ) {
                    $this->redirect('bad-browser');
                }
            }

            $ret = parent::__preAction($action, $params);    
            
            $this->primary_menu = [
            	'index' => [
            		'title' => 'Home',
            		'href' => '#home',
            	],
            	'about' => [
            		'title' => 'About Us',
            		'href' => '#about',
            	],
            	'product' => [
            		'title' => 'Product & Service',
            		'href' => '#products',
            	],
            	'customers' => [
            		'title' => 'Success Stories',
            		'href' => '#customers',
            	],
            ];
            
            return $ret;
        }
        
        function __postAction($action, &$params, $response) {
            
            $route = \Gini\CGI::route();
            if ($route) $args = explode('/', $route);
            if (!$route || count($args) == 0) $args = ['index'];

            $this->view->header = V('header', ['menu'=>$this->primary_menu, 'selected'=>$args[0]]);
            $this->view->footer = V('footer');
            $this->view->contact_dropdown = V('contact-dropdown');
            
            $class = [];
            while (count($args) > 0) {
                $class[] = 'layout-' . implode('-', $args);
                array_pop($args);
            }
                       
            $this->view->layout_class = implode(' ', array_reverse($class));
                       
            return parent::__postAction($action, $params, $response);
        }
        
    }

}
