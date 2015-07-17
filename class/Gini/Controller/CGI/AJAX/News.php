<?php

namespace Gini\Controller\CGI\AJAX {
    
    class News extends \Gini\Controller\CGI {
        
        function actionList() {
            //$news_items = those('news')->orderBy('date', 'desc')->limit(50);
            $filename = "data/news.json";
            $newsText = file_get_contents($filename);
            
            $news = json_decode($newsText); 
            
            usort($news,function($n1,$n2){
                return strtotime($n2->date) - strtotime($n1->date);
            });
            $news = array_slice($news,0, 50);
            return \Gini\IoC::construct('\Gini\CGI\Response\HTML', V('news/list', ['news_items'=>$news]));
        }

        function actionNews() {
        	$form = $this->form();
        	if(!$form["id"]) {
        		return;
        	}
        	$id = $form["id"];
        	$view = V('news/details/'.$id);
        	return \Gini\IoC::construct('\Gini\CGI\Response\HTML', $view);

        }

        function actionFrame() {
        	return \Gini\IoC::construct('\Gini\CGI\Response\HTML',V('news/details/layout'));
        }
    
    }
        
}

