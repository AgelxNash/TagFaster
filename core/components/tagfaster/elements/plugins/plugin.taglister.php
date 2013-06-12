<?php
if ($modx->event->name == 'OnPageNotFound' && $modx->request->getResourceMethod()=="alias") {
    $tagListPageID = $modx->getOption("tf.pageID",$scriptProperties,1); //Страница с поиском статей по тегу
    $tagListPageURI = $modx->makeUrl($tagListPageID);
    $tagRequestName=$modx->getOption("tf.RequestTag",$scriptProperties,'tag');
	$tvRequestName=$modx->getOption("tf.RequestNameTV",$scriptProperties,'key');
    $pageRequest=$modx->getOption("tf.pageRequest",$scriptProperties,'page');
    $serverURI = trim($_SERVER['REQUEST_URI'],'/');
    $lenListPageURI = strlen($tagListPageURI);
    if(strlen($serverURI)>$lenListPageURI && strtolower(substr($serverURI,0,$lenListPageURI))==strtolower($tagListPageURI)){
        $endURI = substr($serverURI, $lenListPageURI);
        $endURI = explode("/", $endURI, 2);
    }else{
        $endURI = array();
    }
    
    if(isset($endURI[0],$endURI[1]) && $endURI[0]!='' && $endURI[1]!=''){
        $modx->request->parameters['GET'][$tvRequestName]=$endURI[0];
       
        if($pageRequest==''){
            $tag = preg_replace('/(.*)\/(\d+)$/', '$2', $endURI[1]);
        }else{
            $tag = preg_replace('/(.*)?(\?'.$pageRequest.'=|\/|\&'.$pageRequest.'=)(\d+)$/', '$1', $endURI[1]);
        }
   
        if($tag!=''){
            $modx->request->parameters['GET'][$tagRequestName]=$tag;
            $modx->sendForward($tagListPageID);
        }
    }
    
}