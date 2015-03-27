<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
//import view parent class
class HososViewTreeview extends JViewLegacy{
	function display($tpl = null) {
		$task = JRequest::getVar('task');
		switch ($task){
			case 'treeview':
				$this->_getTreeview();
				break;
			case 'treeDonvi':
				$this->_getTreeviewDonvi();
			break;
			case 'treequyhoach':
				$this->_getTreeviewQuyhoach();
			break;
			case 'treeImportHoso':
				$this->_getTreeviewImportHoso();
			break;
			default :
				$this->_initDefault();
				break;
		}
		parent::display($tpl);
	}
	function _getTreeview($tpl = null){
		$model = JModelLegacy::getInstance('Treeview','HosoModel');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->treeView($id);
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
	function _getTreeviewDonvi($tpl = null){
		$model = JModelLegacy::getInstance('Treeview','HosoModel');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->treeViewDonvi($id);
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
	function _getTreeviewQuyhoach($tpl = null){
		$model = JModelLegacy::getInstance('Treeview','HosoModel');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->treeViewQuyhoach($id);
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
	function _getTreeviewImportHoso($tpl = null){
		$model = JModelLegacy::getInstance('Treeview','HosoModel');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->treeImportHoso($id);
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