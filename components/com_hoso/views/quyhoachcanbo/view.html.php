<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class HososViewQuyhoachcanbo extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		  	case "danhsachquyhoach":
		  		$this->setLayout('danhsachquyhoach');
		  		$this->dungchung();
		  		$this->danhsachquyhoach();
		  		break;
  }
  parent::display($tpl);
 }
 public function _default(){
 }
 public function dungchung(){
 	$document = JFactory::getDocument();
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.blockUI.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.validate.default.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/dataTables-1.10.0/jquery.dataTables.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/date-time/bootstrap-datepicker.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/dataTables.tableTools.min.js');
 	$document->addStyleSheet(JUri::base(true).'media/cbcc/js/dataTables-1.10.0/css/jquery.dataTables.min.css');
 	$document->addStyleSheet(JUri::base(true).'/media/cbcc/js/dataTables-1.10.0/css/dataTables.tableTools.css');
 	
 }
 public function danhsachquyhoach(){
 	$document = JFactory::getDocument();
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.cookie.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');
 	$document->addScript( JURI::base(true).'/media/cbcc/js/caydonvi.js' );
 	$model = Core::model('Hoso/Quyhoachcanbo');
	$idUser = JFactory::getUser()->id;
	$idRoot = Core::getManageUnit($idUser, 'com_hoso', 'treeview', 'treequyhoach');
	if($idRoot == null){
		$this->setLayout('hoso_404');
	}else{
		$root['root_id'] = $model->getRootTree();
 		$root['root_name'] = $model->getInfoByDonvi_id($root['root_id']);
	}
 	$this->assignRef('root_info', $root);
 }
}

?>