<?php
/**
 * tagLister
 *
 * Copyright 2010 by Shaun McCormick <shaun@modxcms.com>
 *
 * This file is part of tagLister, a simple tag listing snippet for MODx
 * Revolution.
 *
 * tagLister is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * tagLister is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * tagLister; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package taglister
 */
/**
 * Wrap the getPage/getResources call to implement tagging. Needs getPage and
 * getResources to be installed to work.
 *
 * @var modX $modx
 * @var array $scriptProperties
 *
 * @package taglister
 */
 $TagFaster = $modx->getService('TagFaster','TagFaster',$modx->getOption('core_path') . 'components/tagfaster/');
if (!($TagFaster instanceof TagFaster)) return '';

$tagKeyVar = $modx->getOption('tagKeyVar',$scriptProperties,'key');
$staticKey = $modx->getOption('staticKey',$scriptProperties,'0');
$tagKey = (!$staticKey && !empty($tagKeyVar) && !empty($_GET[$tagKeyVar]))? $_GET[$tagKeyVar] : $modx->getOption('tagKey',$scriptProperties,'tags');

$tagRequestParam = $modx->getOption('tagRequestParam',$scriptProperties,'tag');
$grSnippet = $modx->getOption('grSnippet',$scriptProperties,'getPage');

$tvID = $modx->getOption('tvID',$scriptProperties,'');
if(!empty($tvID) && !is_int($tvID)){
    $xTV = $modx->getObject('modTemplateVar', array('name' => $tvID));
    $tvID=$xTV->get('id');
}          
$output = '';
$tag = $staticKey ? $staticKey : $modx->getOption('tag',$scriptProperties,urldecode($_GET[$tagRequestParam]));
if ($tag!='' && !empty($tvID)) {
   $tagID=$modx->getObject("Tags",array('name'=>$tag))->get('id');
    $doc = array();
    if($tagID>0){
        $q = $modx->newQuery("DocTags")->where(array('tv_id'=>$tvID,'tag_id'=>$tagID));
        $q=$modx->getCollection("DocTags",$q);
       
        $r = $modx->newQuery("modResource");
        foreach($q as $item){
            $doc[] = $item->get('doc_id');
        }
    }
    unset($modx->request->parameters['GET'][$tagRequestParam],$modx->request->parameters['GET'][$tagKeyVar]);
    $scriptProperties['pageNavScheme'] = 'request';
    $scriptProperties['resources'] = implode(",",$doc);   
    $scriptProperties['parents'] = '-1';  
    $scriptProperties['where'] = '{"published":1,"deleted":0}';
    
    /** @var modSnippet $elementObj */
    $elementObj = $modx->getObject('modSnippet', array('name' => $grSnippet));
    if ($elementObj) {
        $elementObj->setCacheable(false);
        $output = $elementObj->process($scriptProperties);
    } else {
        return 'You must have getPage and getResources downloaded and installed to use this snippet.';
    }
}else{
    $redirect = $modx->getOption('redirect',$scriptProperties,$modx->getOption('site_start'));
    $modx->sendRedirect($modx->makeUrl($redirect),array('responseCode' => 'HTTP/1.1 307 Temporary Redirect'));
}
return $output;