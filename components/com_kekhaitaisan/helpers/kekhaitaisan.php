<?php
class VitrivieclamHelper{
	static public function collect($table,$colums,$where = null,$order = null,$isCache = true){	
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
		->select($colums)
		->from($table);
		if ($order != null && is_string($order)) {
			$query->order($order);
		}
		if ($where != null && is_array($where)) {
			$query->where($where);
		}
// 		echo  $query->__toString();
		$db->setQuery($query);
		return $db->loadAssocList();
	}
	static public function recursive($table,$colums = array('id'=>'id','parent'=>'parentid','text'=>'name'),$where,$parentid = 0,$level = 0, &$result) {
		$db = JFactory::getDbo();		
		if(!$result) $result = array();//khoi tao 1 array co ten la arr
		//var_dump($colums['parentid']);exit;
		$cols = array_values($colums);
		//var_dump($colums['parentid'].' = '.$parentid);exit;
		$query = $db->getQuery(true)
				->select($cols)
				->from($table);
		if ('NULL' == strtoupper($parentid)) {
			$query->where($colums['parent'].' IS NULL ');
		}else{
			$query->where($colums['parent'].' = '.$parentid);
		}
		if ($where != null && is_array($where)) {
			$query->where($where);
		}
		$db->setQuery($query);
		$rows = $db->loadAssocList();	
		for ($i = 0; $i < count($rows); $i++) {
			$row = $rows[$i];			
			$result[] = array('id'=>$row['id'],'text'=>$row[$colums['text']],'parent'=>(($row[$colums['parent']]== null)?'#':$row[$colums['parent']]),'level'=>$level);
			$result = VitrivieclamHelper::recursive($table,$colums,$where,$row[$colums['id']],($level+1),&$result);
		}
		
		return $result;
	}
	static function makeParentChildRelationsForTree(&$inArray, &$outArray, $currentParentId = 0) {		
    
		if(!is_array($inArray)) {
        return;
    }

    if(!is_array($outArray)) {
        return;
    }
        foreach($inArray as $key => $tuple) {	        	        	        
	        if($tuple['parent'] == $currentParentId) {
	            $tuple['children'] = array();
	            VitrivieclamHelper::makeParentChildRelationsForTree($inArray, $tuple['children'], $tuple['id']);
	            $outArray[] = $tuple;
	        }
	    }
	}
	static public function collectGetName($table,$colums,$where = null,$order = null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
		->select($colums)
		->from($table);
		if ($order != null && is_string($order)) {
			$query->order($order);
		}
		if ($where != null) {
			$query->where($where);
		}
		 
		$db->setQuery($query);
		return $db->loadResult();
	}
	static public function selectBox($value,$attrs,$table,$colums,$where = null,$order = null,$optAdd = null){
		//var_dump($colums[0]);
		if (count($colums) >= 2) {		
	        $rows = VitrivieclamHelper::collect($table, $colums, $where, $order);
	        //var_dump($rows);exit;	
	        if (is_array($attrs)) {
	        	$controlName = $attrs['name'];
	        	unset($attrs['name']);
	        	unset($attrs['value']);
	        	foreach ($attrs as $key=>$val){
	        		if (is_array($val)) {
	        			$controlAttrs .=" ".$key.'="'.implode(" ", $val).'"';
	        		}else{
	        			$controlAttrs .=" ".$key.'="'.$val.'"';
	        		}        		
	        	}
	        }else{
	        	$controlAttrs = $attrs;
	        }
	        if (isset($attrs['hasEmpty']) && $attrs['hasEmpty'] == true) {
	        	$option = array("$colums[0]"=>'',"$colums[1]"=>'');
	        	array_unshift($rows, $option);
	        }
			$optNull[] = JHTML::_('select.option','','',$colums[0],$colums[1]);
	        if(is_array($optAdd)){
	        	foreach($optAdd as $key=>$val){
	        		$optNull[] = JHtml::_('select.option',$key,$val,$colums[0],$colums[1]);
	        	}	
	        }
	        return JHTML::_('select.genericlist',array_merge($optNull,$rows),$controlName, $controlAttrs, $colums[0],$colums[1],$value);
	      //  return JHTML::_('select.genericlist',$options,$controlName, $controlAttrs, 'value','text',$value);
		}
		return '';
	}
	static public function selectBoxAndAttr($value,$attrs,$table,$colums,$where = null,$order = null){
		if (count($colums) >= 2) {
			$rows = VitrivieclamHelper::collect($table, $colums, $where, $order);
			if (is_array($attrs)) {
				$controlName = $attrs['name'];
				unset($attrs['name']);
				unset($attrs['value']);
				foreach ($attrs as $key=>$val){
					if (is_array($val)) {
						$controlAttrs .=" ".$key.'="'.implode(" ", $val).'"';
					}else{
						$controlAttrs .=" ".$key.'="'.$val.'"';
					}
				}
			}else{
				$controlAttrs = $attrs;
			}
			
			$str = '<select name="'.$controlName.'" '.$controlAttrs.'>';
			if (!isset($attrs['noEmpty']) && $attrs['noEmpty'] != true) {
				$str.= '<option value=""';
				if(count($colums) > 2){
					for($j = 2; $j < count($colums); $j++){
						$str.= ' data-'.$colums[$j].'=""';
					}
				}
				$str.= '></option>';
			}
			
			for($i = 0, $n = count($rows); $i < $n; $i++){
				$row = $rows[$i];
				$str.= '<option value="'.$row[$colums[0]].'"';
				if(count($colums) > 2){
					for($j = 2; $j < count($colums); $j++){
						$str.= ' data-'.$colums[$j].'="'.$row[$colums[$j]].'"';
					}
				}
				if($row[$colums[0]] == $value){
					$str.= ' selected="selected"';
				}
				$str.= '>'.$row[$colums[1]].'</option>';
			}
			
			$str.= '</select>';
			
			return $str;
		}
		return '';
	}
	static public function selectBoxForJs($value,$attrs,$table,$colums,$where = null,$order = null,$optAdd = null){
		//var_dump($colums[0]);
		if (count($colums) >= 2) {		
	        $rows = VitrivieclamHelper::collect($table, $colums, $where, $order);
	        //var_dump($rows);exit;	
	        if (is_array($attrs)) {
	        	$controlName = $attrs['name'];
	        	unset($attrs['name']);
	        	unset($attrs['value']);
	        	foreach ($attrs as $key=>$val){
	        		if (is_array($val)) {
	        			$controlAttrs .=" ".$key.'="'.implode(" ", $val).'"';
	        		}else{
	        			$controlAttrs .=" ".$key.'="'.$val.'"';
	        		}        		
	        	}
	        }else{
	        	$controlAttrs = $attrs;
	        }
	        if (isset($attrs['hasEmpty']) && $attrs['hasEmpty'] == true) {
	        	$option = array("$colums[0]"=>'',"$colums[1]"=>'');
	        	array_unshift($rows, $option);
	        }
			$optNull[] = JHTML::_('select.option','','',$colums[0],$colums[1]);
	        if(is_array($optAdd)){
	        	foreach($optAdd as $key=>$val){
	        		$optNull[] = JHtml::_('select.option',$key,$val,$colums[0],$colums[1]);
	        	}	
	        }
	        return JHTML::_('select.genericlist',array_merge($optNull,$rows),$controlName, $controlAttrs, $colums[0],$colums[1],$value);
	      //  return JHTML::_('select.genericlist',$options,$controlName, $controlAttrs, 'value','text',$value);
		}
		return '';
	}
	static public function selectBoxComparing($value,$attrs){
		//var_dump($colums[0]);
		if (!isset($attrs['preitem']) && is_array($attrs['preitem'])) {
			foreach ($attrs['preitem'] as $key => $value) {
				$options[] = JHTML::_('select.option',$key,$value);
			}
		}
		$options[] = JHTML::_('select.option','EQ','=');
		$options[] = JHTML::_('select.option','GE','>=');
		$options[] = JHTML::_('select.option','GT','>');
		$options[] = JHTML::_('select.option','LE','<=');
		$options[] = JHTML::_('select.option','LT','<');
		if (is_array($attrs)) {
			$controlName = $attrs['name'];
			unset($attrs['name']);
			unset($attrs['value']);
			foreach ($attrs as $key=>$val){
				if (is_array($val)) {
					$controlAttrs .=" ".$key.'="'.implode(" ", $val).'"';
				}else{
					$controlAttrs .=" ".$key.'="'.$val.'"';
					if ('ng-model' == $key) {
						$controlAttrs .=' ng-init="'.$val.'=\''.$value.'\'"';
						//$controlAttrs .=' ng-value="'.$value.'"';
					}
				}
			}
		}else{
			$controlAttrs = $attrs;
		}
		//$value = 'EQ';
		return JHTML::_('select.genericlist',$options,$controlName, $controlAttrs,'value','text',$value);
	}
	static public function checkRoleOfUser($idUser,$component,$controller,$task){
		$db = JFactory::getDbo();
		$query = "SELECT a.iddonvi AS rootId,c.name AS rootName
						FROM core_user_action_donvi AS a
						INNER JOIN core_action AS b ON a.action_id = b.id
							AND b.component = ".$db->quote($component)."
							AND b.controllers = ".$db->quote($controller)."
							AND b.tasks = ".$db->quote($task)."
						LEFT JOIN ins_dept AS c ON a.iddonvi = c.id
						WHERE user_id = ".$db->quote($idUser)."
						ORDER BY c.lft ASC
						LIMIT 1";
		$db->setQuery($query);
		return $db->loadAssoc();
	}
	static function checkFiles($file){
		jimport('joomla.filesystem.file');
		$params = &JComponentHelper::getParams('com_hoso');
		$type = $params->get('typefile','txt,doc,jpg,jpeg,png,gif,xls,ppt');
		$arrtype=explode(",", $type);
		$file['name'] = JFile::makeSafe($file['name']);
		if (!$file['name']) {
			$msg =  'Error. Unsupported Media Type!';
			JFactory::getApplication()->enqueueMessage($msg, 'error');
			return false;
		}
		$allowedExtensions = $arrtype;
		$convert_file = VitrivieclamHelper::strtolower_utf8($file['name']);
		if (!in_array(end(explode(".",
				$convert_file)),
				$allowedExtensions)) {
			/** Alternatively you may use chaining */
			JFactory::getApplication()->enqueueMessage('Tập tin không đúng định dạng:'. $file['name'], 'error');
			JLog::add('Tập tin không đúng định dạng:'.$file['name'], JLog::WARNING, 'com_helloworld');
			return false;
		}
		return true;
	}
	static public function strtolower_utf8($string){
		$convert_to = array(
				"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
				"v", "w", "x", "y", "z", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
				"a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "d", "d", "e", "e", "e", "e", "e", "e", "e", "e",
				"e", "e","e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "i", "i",
				"i", "i", "i", "o", "o", "o", "o", "o","o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o","o","o",
				"o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
				"u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u","u", "y", "y", "y", "y", "y", "y", "y", "y"," "
		);
		$convert_from = array(
				"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
				"V", "W", "X", "Y", "Z", "À","à", "Ả","ả", "Ã","ã", "Á","á", "Ạ","ạ", "Ă","ă", "Ằ","ằ", "Ắ","ắ", "Ặ","ặ",
				"Â","â", "Ấ","ấ", "Ầ","ầ", "Ẩ","ẩ", "Ẫ","ẫ", "Ậ","ậ", "Đ","đ", "È","è", "Ẻ","ẻ", "Ẽ","ẽ", "É","é", "Ẹ","ẹ",
				"Ê","ê", "Ề","ề", "Ể","ể", "Ễ","ễ", "Ế","ế", "Ệ","ệ", "Ì","ì", "Í","í", "Ỉ","ỉ", "Ĩ","ĩ", "Ị","ị", "Ò","ò",
				"Ỏ","ỏ", "Õ","õ", "Ó","ó", "Ọ","ọ",	"Ô","ô", "Ồ","ồ", "Ổ","ổ", "Ỗ","ỗ", "Ộ","ộ", "Ơ","ơ", "Ờ","ờ", "Ớ","ớ",
				"Ở","ở", "Ỡ","ỡ", "Ợ","ợ", "Ù","ù", "Ủ","ủ", "Ũ","ũ", "Ú","ú", "Ụ","ụ", "Ư","ư", "Ừ","ừ", "Ử","ử", "Ữ","ữ",
				"Ứ","ứ", "Ự","ự", "Ỳ","ỳ", "Ỷ","ỷ", "Ỹ","ỹ", "Ý","ý","_"
		);
		$string_cv = str_replace($convert_from, $convert_to, $string);
		return str_replace(" ", "_", $string_cv);
	}
}