<?php
include_once(dirname(dirname(dirname(__FILE__)))."/xnop.class.php");

class Tags extends xPDOSimpleObject {
	public static function load(xPDO & $xpdo, $className, $criteria, $cacheFlag= true) {
		$instance = parent::load($xpdo,__CLASS__,$criteria,$cacheFlag);
		if(!is_object($instance) || !($instance instanceof $className)){
			$instance = new xNop;
			$xpdo->log(xPDO::LOG_LEVEL_DEBUG,'Load NOPing class for ' . __CLASS__ ." WHERE ".print_r($criteria,1));
		}
		return $instance;
	}
}