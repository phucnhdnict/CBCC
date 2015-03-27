<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class NhucaudaotaoViewTreeview extends JViewLegacy{
	function display($tpl = null) {
		$task = JRequest::getVar('task');
		switch ($task){
			case 'treenhucautonghop':
				$this->_getTreeNhucauTonghop();
				break;
			case 'treethongkenhucau':
				$this->_getTreeThongkeNhucau();
				break;
			default :
				$this->_initDefault();
				break;
		}
		parent::display($tpl);
	}
	function _getTreeNhucauTonghop($tpl = null){
		$model = JModelLegacy::getInstance('Treeview','NhucaudaotaoModel');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->treeViewNhucauTonghop($id);
		}else{
			$items = array();
		}
		header("HTTP/1.0 200 OK");
		header('Content-type: application/json; charset=utf-8');
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		echo $items;
		exit;
	}
	function _getTreeThongkeNhucau($tpl = null){
		$model = JModelLegacy::getInstance('Treeview','NhucaudaotaoModel');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->treeViewThongkeNhucau($id);
		}else{
			$items = array();
		}
		header("HTTP/1.0 200 OK");
		header('Content-type: application/json; charset=utf-8');
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		echo $items;
		exit;
	}
}