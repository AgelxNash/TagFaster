<?php
include_once(dirname(__FILE__)."/xnop.class.php");
class TagFaster {
    /**
     * A reference to the modX object.
     * @var modX $modx
     */
    private $modx = null;
	
	private $package = '';
	private $config = array();
	
	function __construct(modX &$modx,array $config = array()) {
        $this->modx =& $modx;
		$this->package = strtolower(__CLASS__);

        $corePath = $this->modx->getOption($this->package.'.core_path',null,$modx->getOption('core_path').'components/'.$this->package.'/');
        $this->config = array_merge(array(
            'corePath' => $corePath,
            'modelPath' => $corePath.'model/',
            'processorsPath' => $corePath.'processors/',
            'chunksPath' => $corePath.'elements/chunks/',
            'snippetsPath' => $corePath.'elements/snippets/',
        ),$config);

        $this->modx->addPackage($this->package, $this->config['modelPath']);
    }
	public function setNewTag($docID,$tvID,array $tags){
		$count = array('new'=>array(),'old'=>array(),'del'=>array());
		
		$tags = array_map('trim',$tags);
		$tags = array_unique($tags);
		
		$new = array();
		if($tags!=array()){
			$oldDocTags = $this->modx->getCollection('DocTags',array('doc_id'=>$docID,'tv_id'=>$tvID));
			foreach($oldDocTags as $tag){
				$tmp = $tag->get('tag');
				if(!in_array($tmp,$tags)){
					$count['del'][] = $tmp;
					$tag->remove();
				}else{
					$new[] = $tmp;
				}
			}
			foreach($tags as $tag){
				if(!in_array($tag,$new)){
					$xDocTags=$this->modx->newObject('DocTags');
					$xDocTags->set('doc_id',$docID);
					$xDocTags->set('tag',$tag);
					$xDocTags->set('tv_id',$tvID);
					$xDocTags->save();
					$count['new'][] = $tag;
				}else{
					$count['old'][]=$tag;
				}
			}
		}
		return $count;
	}
}