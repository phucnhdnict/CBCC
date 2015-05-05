<?php
class HososControllerQuyhoachcanbo extends JControllerLegacy {
	function __construct() {
		parent::__construct ();
	}
	function display($cachable = false, $urlparams = false) {
		$task = JRequest::getVar('task');
		switch($task){
			case 'saveQuyhoachcanbo':
				$this->saveQuyhoachcanbo();
				break;
			case 'deleteQuyhoachcanbo':
				$this->deleteQuyhoachcanbo();
				break;
			default:
				break;
		}
		parent::display();
	}
	function saveQuyhoachcanbo(){
		$data_frmQuyhoachcanbo = JRequest::get('data_frmQuyhoachcanbo');
		$model = Core::model('Hoso/Quyhoachcanbo');
		return Core::PrintJson($model->saveQuyhoachcanbo($data_frmQuyhoachcanbo));
		die;
	}
	function deleteQuyhoachcanbo(){
		$arrQhcbDelete = JRequest::get('arrQhcbDelete');
		$model = Core::model('Hoso/Quyhoachcanbo');
		return Core::PrintJson($model->deleteQuyhoachcanbo($arrQhcbDelete));
		die;
	}
}
?>