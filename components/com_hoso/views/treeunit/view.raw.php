<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class HososViewTreeunit extends JViewLegacy{
	function display($tpl = null){
 		$model  = $this->getModel();
		$id = JRequest::getInt('id');
		$id = ((int)$id==0)?Core::getManageUnit(JFactory::getUser()->id):$id;
		$items = $model->treeUnit($id);
		header("HTTP/1.0 200 OK");
		header('Content-type: application/json; charset=utf-8');
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		echo $items;
		exit;
	}
}