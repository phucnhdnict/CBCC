<?php
class Kekhaitaisan_Model_KktsTaisan extends JModelLegacy
{
	/**
	 * @param mixed $formData
	 * @return boolean True on success
	 */
	public function create($formData){
		$table = Core::table('Kekhaitaisan/KktsTaisan');
		$src['tenloaitaisan']	= $formData['tenloaitaisan'];
		$src['parent_id']		= $formData['parent_id'];
		$src['type'] 			= $formData['type'];
		$src['orders']			= $formData['orders'];
		$src['status']			= $formData['status']== "on" ? 1 : 0;;
		
		return $table->save($src);
	}
	public function update($formData){
		$table = Core::table('Kekhaitaisan/KktsTaisan');
		$src['id'] 				= $formData['id'];
		$src['tenloaitaisan']	= $formData['tenloaitaisan'];
		$src['parent_id']		= $formData['parent_id'];
		$src['type'] 			= $formData['type'];
		$src['orders']			= $formData['orders'];
		$src['status']			= $formData['status']== "on" ? 1 : 0;;
		return $table->save($src);
	}
	public function read($id){
		$table = Core::table('Kekhaitaisan/KktsTaisan');
		if (!$table->load($id)) {
			return null;
		}
		$fields = array_keys($table->getFields());
		$data = array();
		for ($i = 0; $i < count($fields); $i++) {
			$data[$fields[$i]] = $table->$fields[$i];
		}
		return $data;
	}
	public function delete($cid){
		$table = Core::table('Kekhaitaisan/KktsTaisan');
		if(!is_array($cid)||count($cid)==0){
			$flag	=	false;
		}else {
			for ($i = 0; $i < count($cid); $i++) {
				$flag	=	$table->delete($cid[$i]);
			}
		}
		return $flag;
	}
	public function getCboLoaitaisan($select=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('id','tenloaitaisan'))
		->from($db->quoteName('kkts_taisan'))
		->where('status=1 and parent_id = 0');
		$query->order('orders');
		$db->setQuery($query);
		$arrChuyennganh = $db->loadObjectList();
		$data=array();
		array_push($data, array('value' => "0",'text' => "--Chọn tài sản cha--"));
		for($i=0;$i<sizeof($arrChuyennganh);$i++){
			array_push($data, array('value' => $arrChuyennganh[$i]->id,'text' => $arrChuyennganh[$i]->tenloaitaisan));
		}
		$options = array(
				'id' => 'parent_id',
				'option.key'=>'value',
				'option.text'=>'text',
				'option.attr'=>'attr',
				'list.select'=>$select
		);
		return $result = JHtmlSelect::genericlist($data,'parent_id',$options);
	}
	public function danhsachTaisan(){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select(array('id','(CONCAT("-- ",tenloaitaisan )) as tenloaitaisan','type','parent_id','orders','status'))
		->from('kkts_taisan')->where('parent_id = 0');
		$db->setQuery($query);
		return $db->loadObjectList();
	} 
	public function getChild($parent_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select(array('id','(CONCAT("------ ",tenloaitaisan )) as tenloaitaisan','type','parent_id','orders','status'))
		->from('kkts_taisan')->where('parent_id = '.$parent_id.'');
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	public function findAll($params = null,$order = null,$offset = null,$limit = null){
		$table = Core::table('Kekhaitaisan/KktsTaisan');
		$db = $table->getDbo();
		$query = $db->getQuery(true);
		$query->select(array('*'))
			->from($table->getTableName())
		;
		if (isset($params['name']) && !empty($params['name'])) {
			$query->where('name LIKE ('.$db->quote('%'.$params['name'].'%').')');
		}
		if ($order == null) {
			$query->order('id');
		}else{
			$query->order($order);
		}
		
		if($offset != null && $limit != null){
			$db->setQuery($query,$offset,$limit);
		}else{
			$db->setQuery($query);
		}
		return $db->loadObjectList();
	
	}
	
	function publish($cid = array(), $publish = 1)
	{
		$flag = false;
		if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			$table = Core::table('Kekhaitaisan/KktsTaisan');
			$src['status'] = $publish;
			for ($i = 0; $i < count($cid); $i++) {
				$src['id']	=	$cid[$i];
				$flag = $table->save($src);
			}
		}
		return $flag;
	}
	function __construct(){
		parent::__construct();
	
		$array = JRequest::getVar('cid',  0, '', 'array');
		global $mainframe, $option;
		$mainframe = &JFactory::getApplication();
	
		// Get the pagination request variables
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart	= $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );
		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}
	function _buildQuery($tb=null,$order=null){
		$db = &JFactory::getDbo();
		$post = JRequest::get('post');
	
		$query = 'SELECT * FROM '.$tb;
		if(!empty($post['type'])){
			$where []= 'type =' .$post['type'];
		}
		$where = (count($where))?implode(' AND ',$where):'';
		if(!empty($where)){
			$query .=' WHERE '.$where;
		}
		if(!empty($order)){
			$query .=' ORDER BY '.$order;
		}
	
		return $query;
	}
	function getData($tb=null,$order=null)
	{
		// Load the data
		$db = &JFactory::getDbo();
		if (empty( $this->_data )) {
			$query = $this->_buildQuery($tb,$order);
			$this->_data =  $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		}
		return $this->_data;
	}
	function getTotal($tb=null,$order=null)
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_total))
		{
			$query = $this->_buildQuery($tb,$order);
			$this->_total = $this->_getListCount($query);
		}
		return $this->_total;
	}
	function getPagination($tb=null,$order=null)
	{
	
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal($tb,$order), $this->getState('limitstart'), $this->getState('limit') );
		}
		return $this->_pagination;
	}
}