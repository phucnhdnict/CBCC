<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class NhucaudaotaoViewThongkenhucaudaotao extends JViewLegacy {
	function display($tpl = null) {
		$task = JRequest::getVar('task');
		switch($task){
			case 'hienthithongke':
				$this->hienthithongke();
				$this->setLayout('esxl');
		   		break;
		}
		parent::display($tpl);
 	}
 	function hienthithongke(){
 		$data = JRequest::get('data');
 		$tungay = $data['tungay'];
 		$denngay = $data['denngay'];
 		$model = Core::model('Daotao/Thongkenhucaudaotao');
 		$ketqua = $model->hienthithongke($data,$tungay,$denngay);
 		Core::printJson($ketqua);
 		die;
 	}
}
?>