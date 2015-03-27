<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class NhucaudaotaoViewNhucaudaotao extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		  	case 'canhanguinhucau':
		  		$this->setLayout('frmnhucaucanhan');
		  		break;
		  	case 'editNhucaudaotao':
		  		$this->editNhucaudaotao();
		  		$this->setLayout('frmnhucaucanhan');
		  		break;
		  	case 'ds_nhucaudaotaotaidonvi':
	  			$this->ds_nhucaudaotaotaidonvi();
	  			break;
		  	case 'ds_nhucaudaotaocanhan':
	  			$this->ds_nhucaudaotaocanhan();
	  			break;
		  	case 'getChuyennganhByLoaitrinhdo':
	  			$this->getChuyennganhByLoaitrinhdo();
	  			break;
		  	case 'getTrinhdoByChuyennganh':
	  			$this->getTrinhdoByChuyennganh();
	  			break;
		  	case 'getTrinhdoByLoaitrinhdo':
	  			$this->getTrinhdoByLoaitrinhdo();
	  			// P bo sung 3/3/2015, thêm chức năng cán bộ tổ chức có thể thêm nhu cầu thay cho cbcc
  			case 'tonghopthemmoi':
  				$this->setLayout('frmtonghop');
				break;
  			case 'tonghophieuchinh':
		  		$this->editNhucaudaotao();
				$this->setLayout('frmtonghop');
				break;
  }
  parent::display($tpl);
 }
 function editNhucaudaotao(){
 	$model = Core::model('Daotao/Nhucaudaotao');
 	$id_ncdt = JRequest::getVar('id_ncdt');
 	if($id_ncdt>0)
 		$datadb_nhucaudaotao  = $model->infoNhucaudaotaoEdit($id_ncdt);
 	$this->assignRef('datadb_nhucaudaotao', $datadb_nhucaudaotao);
 }
 function ds_nhucaudaotaotaidonvi(){
 	$donvi_id = JRequest::getVar('donvi_id');
 	$model = Core::model('Daotao/Nhucaudaotao');
 	$rowNCDT= $model->ds_nhucaudaotaotaidonvi($donvi_id);
 	Core::printJson($rowNCDT );
 	die();
 }
 function ds_nhucaudaotaocanhan(){
 	$model = Core::model('Daotao/Nhucaudaotao');
 	$rowNCDT= $model->ds_nhucaudaotaocanhan($model->getEmpidByJos(jFactory::getUser()->id));
 	Core::printJson($rowNCDT );
 	die();
 }
 function getChuyennganhByLoaitrinhdo(){
 	$loaitrinhdo_lim_code = JRequest::getVar('loaitrinhdo_lim_code');
 	echo (@NhucaudaotaoHelper::selectBoxForJs(null, array('name'=>'id_chuyennganh','id'=>'id_chuyennganh', 'class'=>'chosen'), 'ls_code', array('code','name'),array('status = 1', 'lim_code ='.$loaitrinhdo_lim_code), 'name'));
 	exit;
 }
 function getTrinhdoByChuyennganh(){
 	$chuyennganh_lim_code = JRequest::getVar('chuyennganh_lim_code');
 	echo (@NhucaudaotaoHelper::selectBoxForJs(null, array('name'=>'id_trinhdo','id'=>'id_trinhdo', 'class'=>'chosen'), 'cla_sca_code', array('code','name'),array('ls_code ='.$chuyennganh_lim_code), 'name'));
 	exit;
 }
 function getTrinhdoByLoaitrinhdo(){
 	$loaitrinhdo_lim_code = JRequest::getVar('loaitrinhdo_lim_code');
 	echo (@NhucaudaotaoHelper::selectBoxForJs(null, array('name'=>'id_trinhdo','id'=>'id_trinhdo', 'class'=>'chosen'), 'cla_sca_code', array('code','name'),array('tosc_code ='.$loaitrinhdo_lim_code), 'name'));
 	exit;
 }
}
?>