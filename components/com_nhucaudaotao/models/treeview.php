<?php
class NhucaudaotaoModelTreeview extends JModelLegacy{
	/**
	 * Lấy thông tin cây Đơn vị hiện tại, dùng cho chức năng hiển thị cây tại nhucaudaotao
	 * @param unknown $id_parent
	 * @param unknown $option
	 * @return string
	 */
	public function treeViewNhucauTonghop($id_parent,$option = array()){
		$db = JFactory::getDbo();
		$exceptionUnits = Core::getUnManageDonvi(JFactory::getUser()->id,'com_nhucaudaotao','treeview','treenhucautonghop');
		$exception_condition = ($exceptionUnits)?' AND a.id NOT IN ('.$exceptionUnits.')':'';
		$query = 'SELECT a.id,a.parent_id,a.type,a.name,a.level,a.lft,a.rgt,a.active
					FROM ins_dept AS a
					WHERE a.active = 1  AND a.parent_id = '.$db->quote($id_parent).$exception_condition.'
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
	 * Lấy thông tin cây Đơn vị(bao gồm các tổ chức co, không hiện phòng), dùng cho chức năng hiển thị cây tại thongkenhucaudaotao
	 * @param unknown $id_parent
	 * @param unknown $option
	 * @return string
	 */
	public function treeViewThongkeNhucau($id_parent,$option = array()){
		$db = JFactory::getDbo();
		$exceptionUnits = Core::getUnManageDonvi(JFactory::getUser()->id,'com_nhucaudaotao','treeview','treethongkenhucau');
		$exception_condition = ($exceptionUnits)?' AND a.id NOT IN ('.$exceptionUnits.')':'';
		$query = 'SELECT a.id,a.parent_id,a.type,a.name,a.level,a.lft,a.rgt,a.active
					FROM ins_dept AS a
					WHERE a.active = 1 AND type > 0 AND a.parent_id = '.$db->quote($id_parent).$exception_condition.'
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
	
}