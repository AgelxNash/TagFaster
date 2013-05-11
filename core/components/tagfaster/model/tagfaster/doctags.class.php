<?php
include_once(dirname(dirname(dirname(__FILE__)))."/xnop.class.php");
class DocTags extends xPDOObject{
	
	public function get($k, $format = null, $formatTemplate= null) {
		if($k=='tag'){
			$data = $this->xpdo->getObject('Tags',array('id'=>$this->_fields['tag_id']))->get('name',$format,$formatTemplate);
		}else{
			$data = parent::get($k, $format = null, $formatTemplate= null);
		}
		return $data;
	}
	public function save($cacheFlag= null) {
		if(isset($this->_fields['tag'])){
			$id = $this->findTagID($this->_fields['tag']);
			if(false === $id){
				$id=$this->addTag($this->_fields['tag'], $cacheFlag);
				if(!$id){
					$this->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'error insert tag');
				}
			}
			$this->set('tag_id',$id);
			unset($this->_fields['tag']);
		}
		
		return (!$this->checkDuplicate()) ? parent::save($cacheFlag) : false;
	}
	private function checkDuplicate(){
		$xDocTag = $this->xpdo->newQuery(__CLASS__,array(
			'doc_id'=>$this->get('doc_id'),
			'tag_id'=>$this->get('tag_id'),
			'tv_id'=>$this->get('tv_id')
		));
		return ($this->xpdo->getCount(__CLASS__,$xDocTag)) ? true : false;
	}
	
	private function addTag($tag,$cacheFlag = null){
		$xTags=$this->xpdo->newObject("Tags",array('name'=>trim($tag)));
		return ($xTags->save($cacheFlag)) ? $xTags->getPrimaryKey() : false;
	}
	
	private function findTagID($tag){
		$xTag = $this->xpdo->newQuery("Tags",array('name'=>trim($tag)));
		return ($this->xpdo->getCount("Tags",$xTag)) ? $this->xpdo->getObject('Tags',$xTag)->getPrimaryKey() : false;
	}
	public static function load(xPDO & $xpdo, $className, $criteria, $cacheFlag= true) {
		$instance = parent::load($xpdo,__CLASS__,$criteria,$cacheFlag);
		if(!is_object($instance) || !($instance instanceof $className)){
			$instance = new xNop;
			$xpdo->log(xPDO::LOG_LEVEL_DEBUG,'Load NOPing class for ' .__CLASS__." WHERE ".print_r($criteria,1));
		}
		return $instance;
	}
}