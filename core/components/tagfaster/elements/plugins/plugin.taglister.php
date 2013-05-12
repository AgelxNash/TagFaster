<?php
if ($modx->event->name == 'OnPageNotFound' && $modx->request->getResourceMethod()=="alias") {
    $tagListPageID = $modx->getOption("tf.pageID",$scriptProperties,1); //Страница с поиском статей по тегу
	$tagListPageURI = $modx->makeUrl($tagListPageID);
	$tagRequestName=$modx->getOption("tf.RequestTag",$scriptProperties,'tag');
	$tvRequestName=$modx->getOption("tf.RequestNameTV",$scriptProperties,'key');
    $pageRequest=$modx->getOption("tf.pageRequest",$scriptProperties,'page');
    $serverURI = trim($_SERVER['REQUEST_URI'],'/');
    $lenListPageURI = strlen($tagListPageURI);
    $endURI = explode("/",$serverURI,3);

    if(strtolower($endURI[0])==trim(strtolower($tagListPageURI),'/') && isset($endURI[1],$endURI[2]) && $endURI[1]!='' && $endURI[2]!=''){

        $modx->request->parameters['GET'][$tvRequestName]=$endURI[1];
        if($pageRequest==''){
            $tag = preg_replace('/(.*)\/(\d+)$/', '$2', $endURI[2]);
        }else{
            $tag = preg_replace('/(.*)?(\?'.$pageRequest.'=|\/|\&'.$pageRequest.'=)(\d+)$/', '$1', $endURI[2]);
        }
        if($tag!=''){
            $modx->request->parameters['GET'][$tagRequestName]=$tag;
            $modx->sendForward($tagListPageID);
        }
    }
}