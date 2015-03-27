<?php
defined('_JEXEC') or die;

class NhucaudaotaoHelper
{
	static public function selectBoxAndAttr($value,$attrs,$table,$colums,$where = null,$order = null){
		if (count($colums) >= 2) {
			$rows = NhucaudaotaoHelper::collect($table, $colums, $where, $order);
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
			$str.= '<option value=""';
			if(count($colums) > 2){
				for($j = 2; $j < count($colums); $j++){
					$str.= ' data-'.$colums[$j].'=""';
				}
			}
			$str.= '></option>';
				
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
			$rows = NhucaudaotaoHelper::collect($table, $colums, $where, $order);
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
	static public function selectBox($value,$attrs,$table,$colums,$where = null,$order = null,$optAdd = null){
		if (count($colums) >= 2) {
			$rows = NhucaudaotaoHelper::collect($table, $colums, $where, $order);
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
			return JHTML::_('select.genericlist',array_merge($optNull,$rows),@$controlName, @$controlAttrs, $colums[0],$colums[1],$value);
			//  return JHTML::_('select.genericlist',$options,$controlName, $controlAttrs, 'value','text',$value);
		}
		return '';
	}
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
		$db->setQuery($query);
		return $db->loadAssocList($key);
	}
	static public function collectHasKey($table,$colums,$key,$where = null,$order = null,$isCache = true){
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
		$db->setQuery($query);
		return $db->loadAssocList($key);
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
}