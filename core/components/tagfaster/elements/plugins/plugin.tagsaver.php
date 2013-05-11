<?php
if($modx->event->name=='OnDocFormSave'){
    $TagFaster = $modx->getService('TagFaster','TagFaster',$modx->getOption('core_path') . 'components/tagfaster/');
    if (!($TagFaster instanceof TagFaster)) return '';
    
    $tagsTV = $modx->getOption("tvlist",$scriptProperties,''); //Список TV имен
    if($tagsTV!=''){
        $tagsTV = explode(",", $tagsTV); //Разделитель это может быть пробел или запятая
        foreach($tagsTV as $tv){
            if($tv!=''){
                $sep = $modx->getOption($tv.".separator",$scriptProperties,','); //ИМЯTV.sep - узнаем разделитель для этого ТВ параметра
                $xTV = $modx->getObject('modTemplateVar', array('name' => $tv));
                $TagFaster->setNewTag($resource->get('id'), $xTV->get('id'), explode($sep,$xTV->getValue($resource->get('id'))));
            }
        }
    }
}