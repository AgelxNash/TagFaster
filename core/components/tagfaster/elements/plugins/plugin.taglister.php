<?php
if ($modx->event->name == 'OnPageNotFound' && $modx->request->getResourceMethod()=="alias") {
    $tagListPageID = $modx->getOption("tvlist",$scriptProperties,1); //Страница с поиском статей по тегу
	$tagListPageURI = $modx->makeUrl($tagListPageID);
	$tagRequestName=$modx->getOption("tvlist",$scriptProperties,'tag');
	$tvRequestName=$modx->getOption("tvlist",$scriptProperties,'key');
    
    $serverURI = trim($_SERVER['REQUEST_URI'],'/');
    $lenListPageURI = strlen($tagListPageURI);
    $endURI = explode("/",$serverURI,3);

    if(strtolower($endURI[0])==trim(strtolower($tagListPageURI),'/') && isset($endURI[1],$endURI[2]) && $endURI[1]!='' && $endURI[2]!=''){

        $modx->request->parameters['GET'][$tvRequestName]=$endURI[1];
        $modx->request->parameters['GET'][$tagRequestName]=str_replace("%","",$endURI[2]);
        $modx->sendForward($tagListPageID);

    }
}