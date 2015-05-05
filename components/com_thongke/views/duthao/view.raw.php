<?php
/**
 * Author: Phucnh
 * Date created: Apr 25, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThongkeViewDuthao extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
	  		case 'word_duthao_nltx':
	  			$this->_nltx();
	  			break;
	  		case 'word_duthao_nltth':
	  			$this->_nltth();
	  			break;
	  		case 'word_duthao_bnvnvc':
	  			$this->_bnvnvc();
	  			break;
	  		case 'word_duthao_dd':
	  			$this->_dd();
	  			break;
	  		case 'word_duthao_bn':
	  			$this->_bn();
	  			break;
	  		case 'word_duthao_cxnl':
	  			$this->_cxnl();
	  			break;
	  	}
	  	parent::display($tpl);
	 }
	function _nltx(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		//  		$config_default = json_decode(Core::config('cbcc/template/default'));
		//  		$mauduthao			=	$config_default->mauduthao;
		$data = $model->duthao($idhoso, 'nltx');
		$this->assignRef('data', $data);
		$this->setLayout('duthao_nltx');
		header("Content-type: application/vnd.ms-word");
		header("Expires : 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header ("Content-Disposition: attachment; Filename=duthao_nangluongthuongxuyen" . date ( 'dmy' ) . ".doc" );
	}
	function _nltth(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		$data = $model->duthao($idhoso, 'nltth');
		$this->assignRef('data', $data);
		$this->setLayout('duthao_nltth');
		header("Content-type: application/vnd.ms-word");
		header("Expires : 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header ("Content-Disposition: attachment; Filename=duthao_nangluongtruocthoihan" . date ( 'dmy' ) . ".doc" );
	}
	function _dd(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		$data = $model->duthao($idhoso, 'dd');
 		$this->assignRef('data', $data);
 		$this->setLayout('duthao_dd');
 		header("Content-type: application/vnd.ms-word");
 		header("Expires : 0");
 		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
 		header ("Content-Disposition: attachment; Filename=duthao_dieudong" . date ( 'dmy' ) . ".doc" );
	}
	function _bn(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		$data = $model->duthao($idhoso, 'bn');
	 	$this->assignRef('data', $data);
	 	$this->setLayout('duthao_bn');
	 	header("Content-type: application/vnd.ms-word");
	 	header("Expires : 0");
	 	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	 	header ("Content-Disposition: attachment; Filename=duthao_bonhiem" . date ( 'dmy' ) . ".doc" );
	}
	function _bnvnvc(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		$data = $model->duthao($idhoso, 'bnvnvc');
 		$this->assignRef('data', $data);
 		$this->setLayout('duthao_bnvnvc');
 		header("Content-type: application/vnd.ms-word");
 		header("Expires : 0");
 		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
 		header ("Content-Disposition: attachment; Filename=duthao_bonhiemvaongachvienchuc" . date ( 'dmy' ) . ".doc" );
	}
	function _cxnl(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		$data = $model->duthao($idhoso, 'cxnl');
 		$this->assignRef('data', $data);
 		$this->setLayout('duthao_cxnl');
 		header("Content-type: application/vnd.ms-word");
 		header("Expires : 0");
 		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
 		header ("Content-Disposition: attachment; Filename=duthao_chuyenxepngachluong" . date ( 'dmy' ) . ".doc" );
	}
}
?>