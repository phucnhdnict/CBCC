<?php
class HosoModelTreeview extends JModelLegacy{
	public function treeView($id_parent,$option = array()){
		$db = JFactory::getDbo();
		$exceptionUnits = $this->getUnManageDonvi(JFactory::getUser()->id,'com_hoso','treeview','treeview');
		$exception_condition = ($exceptionUnits)?' AND a.id NOT IN ('.$exceptionUnits.')':'';
		$query = 'SELECT a.id,a.parent_id,a.type,CONCAT(a.name," (",IF(b.total_hoso is NULL,0,b.total_hoso),")") AS name,a.level,a.lft,a.rgt,a.active
					FROM ins_dept AS a
					LEFT JOIN index_dept AS b ON a.id = b.dept_id
					WHERE a.active = 1 AND a.parent_id = '.$db->quote($id_parent).$exception_condition.'
					ORDER BY a.name COLLATE utf8_unicode_ci';
		$db->setQuery($query);
		$rows = $db->loadAssocList();
		$arrTypes = array('file','folder','root');
		for ($i=0,$n=count($rows);$i<$n;$i++){
			$types = '';
			$result[] = array(
					"attr" => array("id" => "node_".$rows[$i]['id'], "rel" => $arrTypes[$rows[$i]['type']], "showlist" => $rows[$i]['type']),
					"data" => $rows[$i]['name'],
					"state" => ((int)$rows[$i]['rgt'] - (int)$rows[$i]['left'] > 1) ? "closed" : ""
			);
		}
		return json_encode($result);
	}
	public function treeViewDonvi($id_parent,$option = array()){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select(array('a.id','a.parent_id','a.type','a.name','a.level','a.lft','a.rgt','a.active'))
				->from($db->quoteName('ins_dept','a'))
				->where(array('a.active = 1','a.parent_id = '.$db->quote($id_parent),'a.type <> 0'))
				->order('a.name COLLATE utf8_unicode_ci');
		$db->setQuery($query);
		$rows = $db->loadAssocList();
		$arrTypes = array('file','folder','root');
		for ($i=0,$n=count($rows);$i<$n;$i++){
			$types = '';
			$result[] = array(
					"attr" => array("id" => "node_".$rows[$i]['id'], "rel" => $arrTypes[$rows[$i]['type']], "showlist" => $rows[$i]['type']),
					"data" => $rows[$i]['name'],
					"state" => ((int)$rows[$i]['rgt'] - (int)$rows[$i]['left'] > 1) ? "closed" : ""
			);
		}
		return json_encode($result);
	}
	public function treeViewQuyhoach($id_parent,$option = array()){
		$db = JFactory::getDbo();
// 		$exceptionUnits = Core::getUnManageDonvi(JFactory::getUser()->id,'com_hoso','treeview','treequyhoach');
		$exceptionUnits = $this->getUnManageDonvi(JFactory::getUser()->id,'com_hoso','treeview','treequyhoach');
		$exception_condition = ($exceptionUnits)?' AND a.id NOT IN ('.$exceptionUnits.')':'';
		$query = 'SELECT a.id,a.parent_id,a.type,a.name,a.level,a.lft,a.rgt,a.active
					FROM ins_dept AS a 
					WHERE a.active = 1 AND a.parent_id = '.$db->quote($id_parent).$exception_condition.'
					ORDER BY a.name COLLATE utf8_unicode_ci';
		$db->setQuery($query);
		$rows = $db->loadAssocList();
		$arrTypes = array('file','folder','root');
		for ($i=0,$n=count($rows);$i<$n;$i++){
			$types = '';
			$result[] = array(
					"attr" => array("id" => "node_".$rows[$i]['id'], "rel" => $arrTypes[$rows[$i]['type']], "showlist" => $rows[$i]['type']),
					"data" => $rows[$i]['name'],
					"state" => ((int)$rows[$i]['rgt'] - (int)$rows[$i]['left'] > 1) ? "closed" : ""				
			);
		}
		return json_encode($result);
	}
	/**
	 * Tree đơn vị chức năng import hồ sơ
	 * @param int $id_parent
	 * @param unknown $option
	 * @return string
	 */
	
	public function treeImportHoso($id_parent, $option=null){
		$db = JFactory::getDbo();
// 		$exceptionUnits = Core::getUnManageDonvi(JFactory::getUser()->id,'com_hoso','treeview','treeImportHoso');
		$exceptionUnits = $this->getUnManageDonvi(JFactory::getUser()->id,'com_hoso','treeview','treeImportHoso');
		$exception_condition = ($exceptionUnits)?' AND a.id NOT IN ('.$exceptionUnits.')':'';
		$query = "SELECT a.id,a.parent_id,a.type,a.name,a.level,a.lft,a.rgt,a.active
					FROM ins_dept AS a
					LEFT JOIN index_dept AS b ON a.id = b.dept_id
					WHERE a.active = 1 AND a.parent_id = ".$db->quote($id_parent).$exception_condition."
					ORDER BY a.name COLLATE utf8_unicode_ci";
		$db->setQuery($query);
		$rows = $db->loadAssocList();
		$arrTypes = array('file','folder','root');
		for ($i=0,$n=count($rows);$i<$n;$i++){
			$types = '';
			$result[] = array(
					"attr" => array("id" => "node_".$rows[$i]['id'], "rel" => $arrTypes[$rows[$i]['type']], "showlist" => $rows[$i]['type']),
					"data" => $rows[$i]['name'],
					"state" => ((int)$rows[$i]['rgt'] - (int)$rows[$i]['left'] > 1) ? "closed" : ""
			);
		}
		return json_encode($result);
	}
	/////////////////////////////////////////
	public static function getUnManageDonvi($id_user,$component = null,$controller=null,$task=null,$location='site'){
		if ($id_user == null) {
			return null;
		}
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('DISTINCT uad.param_donvi')
		->from(' core_user_action_loaitrudonvi AS uad  ')
		->join('INNER', 'core_action AS b ON uad.action_id = b.id')
		->where(" uad.user_id = ".$db->quote($id_user))
		;
		if ($component != null) {
			$query->where('b.component = '.$db->q($component));
		}
		if ($controller != null) {
			$query->where('b.controllers = '.$db->q($controller));
		}
		if ($task != null) {
			$query->where('b.tasks = '.$db->q($task));
		}
		if ($location != null) {
			$query->where('b.location = '.$db->q($location));
		}
		//          echo $query->__toString().'<br />';exit;
		$db->setQuery( $query);
	
		return $db->loadResult();
	}
	///////////////////////////////////////////
}