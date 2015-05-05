<?php
/**
 * Author: Phucnh
 * Date created: Apr 04, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThongkeViewThongke extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
	  		case 'word_2c':
	  			$this->_exportword_2c();
	  			break;
	  	}
	  	parent::display($tpl);
	 }

 	function _exportword_2c(){
 		$idhoso = JRequest::getVar('idHoso','');
 		$model = Core::model('Thongke/Thongke');
 		$data = $model->exportWord_2c($idhoso);
 		 
 		$this->assignRef('data', $data);
 		$this->setLayout('word_vc2c');
 	
 		header("Content-type: application/vnd.ms-word");
 		Header("Expires : 0");
 		Header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
 		header ("Content-Disposition: attachment; Filename=2C-BNV" . date ( 'dmy' ) . ".doc" );
 	}
}
?>