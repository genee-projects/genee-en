<?php

namespace Gini\Controller\CGI\AJAX {
    
    class Products extends \Gini\Controller\CGI {
        
        function actionView($name='') {
            
            if (!in_array($name, ['lims', 'lims-cf', 'billing', 'tender', 'mall'])) return;
            
            return \Gini\IoC::construct('\Gini\CGI\Response\HTML', V('products/'.$name.'/info'));
            
        }
        
        function actionConsult() {

            $form = $this->form();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $validator = new \Gini\CGI\Validator;

                try {

                    $validator
                        ->validate('name', $form['name'], T('姓名不能为空!'))
                        ->validate('institute', $form['institute'], T('单位不能为空!'))
                        ->validate('email', $form['email'], T('Email不能为空!'))
                        ->validate('phone', $form['phone'], T('电话不能为空!'))
                        ->validate('lab', $form['lab'], T('实验室名称不能为空!'))
                        ->validate('institute', $form['institute'], T('单位不能为空!'))
                        ->validate('description', $form['description'], T('问题不能为空!'))
                        ->done();

                    $subject = sprintf('[咨询] %s - %s', $form['name'], $form['institute']);
                    $body = yaml_emit($form, YAML_UTF8_ENCODING);

                    $contact = \Gini\Config::get('genee.product_contact');

                    $mail = \Gini\IoC::construct('\Gini\Mail');
                    $mail
                        ->from($form['email'], $form['name'])
                        ->to($contact['email'] ?: 'cs@geneegroup.com', $contact['name'] ?: '基理科技')
                        ->subject($subject)
                        ->body($body)
                        ->send();

                    return \Gini\IoC::construct('\Gini\CGI\Response\HTML', V('products/consult-success', $form));
                }
                catch (\Gini\CGI\Validator\Exception $e) {
                    $form['_errors'] = $validator->errors();
                }

            }

            $vars = [
                'form' => $form
            ];

             return \Gini\IoC::construct('\Gini\CGI\Response\HTML', V('products/consult', $vars));
        }
        
    }
    
}