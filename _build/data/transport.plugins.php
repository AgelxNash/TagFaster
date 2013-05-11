<?php
$plugins = array();
$plugins[0] = $modx->newObject('modPlugin');
$plugins[0]->fromArray(array(
	'id' => 0,
	'name'=>'TagSaver',
	'category' => 0,
	'description' =>'Save tag from TV to DB',
	'plugincode' => getSnippetContent($sources['plugins'] . 'plugin.tagsaver.php')
));

$plugins[1] = $modx->newObject('modPlugin');
$plugins[1]->fromArray(array(
	'id' => 0,
	'name'=>'TagLister',
	'category' => 0,
	'description' =>'For useTagsFurl',
	'plugincode' => getSnippetContent($sources['plugins'] . 'plugin.taglister.php')
));

$events = array();
$events[0]= $modx->newObject('modPluginEvent');
$events[0]->fromArray(array(
	'event' => 'OnDocFormSave',
	'priority' => 0,
	'propertyset' => 0,
),'',true,true);

if (is_array($events) && !empty($events)) {
	$plugins[0]->addMany($events);
	$modx->log(xPDO::LOG_LEVEL_INFO,'Packaged in '.count($events).' plugin events.'); flush();
} else {
	$modx->log(xPDO::LOG_LEVEL_ERROR,'Could not find plugin events!');
}

$events = array();
$events[0]= $modx->newObject('modPluginEvent');
$events[0]->fromArray(array(
	'event' => 'OnPageNotFound',
	'priority' => 0,
	'propertyset' => 0,
),'',true,true);

if (is_array($events) && !empty($events)) {
	$plugins[1]->addMany($events);
	$modx->log(xPDO::LOG_LEVEL_INFO,'Packaged in '.count($events).' plugin events.'); flush();
} else {
	$modx->log(xPDO::LOG_LEVEL_ERROR,'Could not find plugin events!');
}

unset($events);
return $plugins;