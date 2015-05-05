<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class HososViewQuyhoachcanbo extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		  	case 'addQuyhoachcanbo':
		  		$this->themquyhoachcanbo();
		  		$this->setLayout('frmquyhoachcanbo');
		  		break;
		  	case 'editQuyhoachcanbo':
		  		$this->editQuyhoachcanbo();
		  		$this->setLayout('frmquyhoachcanbo');
		  		break;
		  	case 'ds_quyhoachcb':
	  			$this->ds_quyhoachcb();
	  			break;
	  		default:
	  			break;
  }
  parent::display($tpl);
 }
 function editQuyhoachcanbo(){
 	$model = Core::model('Hoso/Quyhoachcanbo');
 	$id_qhcb = JRequest::getVar('id_qhcb');
 	$donvi_id = JRequest::getVar('donvi_id');
 	$this->assignRef('donvi_id', $donvi_id);
 	if($id_qhcb>0)
 		$datadb_quyhoachcanbo  = $model->thongtinQuyhoachcanboDeEdit($id_qhcb);
 	$this->assignRef('datadb_quyhoachcanbo', $datadb_quyhoachcanbo);
 }
function themquyhoachcanbo(){
	$donvi_id = JRequest::getVar('donvi_id');
	$this->assignRef('donvi_id', $donvi_id);
}
 function ds_quyhoachcb(){
 	$donvi_id = JRequest::getVar('donvi_id');
 	$model = Core::model('Hoso/Quyhoachcanbo');
 	$rowQHCB= $model->ds_quyhoachcanbo($donvi_id);
 	return Core::PrintJson($rowQHCB);
	die;
 }
}
?>