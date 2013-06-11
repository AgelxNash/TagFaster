<?php
if($modx->event->name=='OnDocFormSave'){
    $TagFaster = $modx->getService('TagFaster','TagFaster',$modx->getOption('core_path') . 'components/tagfaster/');
    if (!($TagFaster instanceof TagFaster)) return '';
    
    $tagsTV = $modx->getOption("tf.tvlist",$scriptProperties,''); //Список TV имен
    if($tagsTV!=''){
        $tagsTV = explode(",", $tagsTV); //Разделитель это может быть пробел или запятая
        $tagsTV = array_map('trim',$tagsTV);
        
        foreach($tagsTV as $tv){
            if($tv!=''){
                $sep = $modx->getOption("tf.".$tv.".separator",$scriptProperties,','); //ИМЯTV.sep - узнаем разделитель для этого ТВ параметра
                $xTV = $modx->getObject('modTemplateVar', array('name' => $tv));
                $TagFaster->setNewTag($resource->get('id'), $xTV->get('id'), explode($sep,$xTV->getValue($resource->get('id'))));
            }
        }
    }
}