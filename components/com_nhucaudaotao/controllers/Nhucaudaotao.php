<?php
class NhucaudaotaoControllerNhucaudaotao extends JControllerLegacy {
	function __construct() {
		parent::__construct ();
	}
	function display($cachable = false, $urlparams = false) {
		parent::display();
	}
	function saveCanhanguinhucaudaotao(){
		$data_nhucaudaotaoFrm = JRequest::get('data_nhucaudaotaoFrm');
		$model = Core::model('Daotao/Nhucaudaotao');
		echo $model->saveNhucaudaotao($data_nhucaudaotaoFrm);
		exit;
	}
	function updatestatusNhucaudaotao(){
		$id_ncdt = JRequest::getVar('id_ncdt');
		$model = Core::model('Daotao/Nhucaudaotao');
		echo $model->updatestatusNhucaudaotao($id_ncdt,JFactory::getUser()->id);
		exit;
	}
	function deleteNhucaudaotao(){
		$arrNcdtDelete = JRequest::get('arrNcdtDelete');
		$model = Core::model('Daotao/Nhucaudaotao');
		$model->removeNhucaudaotao($arrNcdtDelete);
		exit;
	}
}
?>