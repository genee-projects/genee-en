<?php

namespace Gini\Controller\CGI\AJAX {
    
    class Careers extends \Gini\Controller\CGI {
        
        function __index($name='') {
            if (!in_array($name, ['jobs', 'principle', 'benefits'])) return;
            return \Gini\IoC::construct('\Gini\CGI\Response\HTML', V('careers/'.$name.'-card'));
            
        }
        
        function actionJobsList() {
            
            $form = $this->form();
            
            $filename = "data/jobs.json";
            $jobsText = file_get_contents($filename);
            
            $jobs = json_decode($jobsText); 
            $newArray = [];
            foreach ($jobs as $job) {
                if($job->type == $form['type']){
                    $newArray[] = $job;
                }
            }

            usort($newArray,function($job1,$job2){
                return $job1->weight - $job2->weight;
            });
            //echo "<pre>";
            //var_dump($newArray);
            //die();
            //$jobs = those('job')->whose('type')->is($form['type'])->orderBy('weight');
            //echo "<pre>";
            //var_dump($newArray);
            //die();
            $vars = [
                'form' => $form,
                'jobs' => $newArray
            ];
            
            return \Gini\IoC::construct('\Gini\CGI\Response\HTML', V('careers/jobs', $vars));
            
        }
        
        function actionJob ($name='') {
            
            $name = $name ?: 'unknown';

            $view = (string)V('careers/jobs/'.$name);
            if (!$view) $view = (string) V('careers/jobs/unknown');
            
            return \Gini\IoC::construct('\Gini\CGI\Response\HTML', V('careers/job', ['content'=>$view]));
        }
        
    }
    
}
