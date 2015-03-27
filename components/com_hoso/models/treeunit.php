<?php
class HososModelTreeunit extends JModelLegacy{
	// dùng cho quy hoạch cán bộ, task default
	public function treeUnit($id_parent,$option = array()){
		$db = JFactory::getDbo();
		$query = "SELECT a.id,a.parent_id,a.type,a.name,a.level,a.lft,a.rgt,a.active
					FROM ins_dept AS a
					LEFT JOIN index_dept AS b ON a.id = b.dept_id
					WHERE a.active = 1 AND a.parent_id = ".$db->quote($id_parent)."
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
}