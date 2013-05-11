<?php
if($modx->event->name=='OnDocFormSave'){
    $TagFaster = $modx->getService('TagFaster','TagFaster',$modx->getOption('core_path') . 'components/tagfaster/');
    if (!($TagFaster instanceof TagFaster)) return '';
    
    $tagsTV = $modx->getOption("tf.tvlist",$scriptProperties,''); 
    if($tagsTV!=''){
        $tagsTV = explode(",", $tagsTV);
        foreach($tagsTV as $tv){
            if($tv!=''){
                $sep = $modx->getOption("tf.".$tv.".separator",$scriptProperties,',');
                $xTV = $modx->getObject('modTemplateVar', array('name' => $tv));
                $TagFaster->setNewTag($resource->get('id'), $xTV->get('id'), explode($sep,$xTV->getValue($resource->get('id'))));
            }
        }
    }
}