<?php
/**
 * Author: Phucnh
 * Date created: Apr 3, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThongkeViewTreeview extends JViewLegacy{
	function display($tpl = null) {
		$task = JRequest::getVar('task');
		switch ($task){
			case 'treeThongke':
				$this->_getTreeThongke();
				break;
			case 'treeDaotaoboiduong':
				$this->_getTreeDaotaoboiduong();
				break;
			default :
				$this->_initDefault();
				break;
		}
		parent::display($tpl);
	}
	function _getTreeThongke($tpl = null){
		$model = JModelLegacy::getInstance('Treeview','ThongkeModel');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->treeViewThongke($id, array('component'=>'com_thongke', 'controller'=>'treeview', 'task'=>'treeThongke'));
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
	function _getTreeDaotaoboiduong($tpl = null){
		$model = JModelLegacy::getInstance('Treeview','ThongkeModel');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->treeViewThongke($id, array('component'=>'com_thongke', 'controller'=>'treeview', 'task'=>'treeBcdaotaoboiduong'));
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