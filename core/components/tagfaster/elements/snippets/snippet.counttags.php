<?php
$tag = $modx->getOption("input",$scriptProperties,'');
$tv = $modx->getOption("options",$scriptProperties,'');
$cache = (boolean)$modx->getOption("cache",$scriptProperties,true);
if(empty($tv)) return 0; //break;

$cached = null;
$cacheTime = null;
$cacheOptions = null;
$count = null;

if($cache && $modx->getCacheManager()){
    $cache = 'CountTags/'.$tv.'/'.$tag;
    $cacheTime = (integer) $modx->getOption('cache_resource_expires', null, 0);
    $cacheOptions = array(
        xPDO::OPT_CACHE_KEY => $modx->getOption('cache_resource_key', null, 'resource'),
        xPDO::OPT_CACHE_HANDLER => $modx->getOption('cache_resource_handler', null, 'xPDOFileCache'),
        xPDO::OPT_CACHE_EXPIRES => $cacheTime,
    );
    $count = $modx->cacheManager->get($cache, $cacheOptions);
}
if(is_null($count)){
    $TagFaster = $modx->getService('TagFaster','TagFaster',$modx->getOption('core_path') . 'components/tagfaster/');
    if (!($TagFaster instanceof TagFaster)) return 0; //break;
    $count = $TagFaster->getCountTags($tv,$tag);
    if($cache){
       $modx->cacheManager->set($cache, $count, $cacheTime, $cacheOptions);
    }
}
return $count;