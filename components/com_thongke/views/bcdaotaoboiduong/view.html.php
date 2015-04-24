<?php
/**
 * Author: Phucnh
 * Date created: Apr 15, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThongkeViewBcdaotaoboiduong extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		  	default:
		  		$this->setLayout('hoso_404');
		  		break;
		  		case "default":
		  			$this->setLayout('default');
		  			$this->dungchung();
		  			$this->baocao();
		  			break;
  }
  parent::display($tpl);
 }
 public function dungchung(){
 	$document = JFactory::getDocument();
 	$document->addScript(JUri::base(true).'/media/cbcc/js/date-time/bootstrap-datepicker.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.maskedinput.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/dataTables-1.10.0/jquery.dataTables.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/dataTables.tableTools.min.js');
 	$document->addStyleSheet(JUri::base(true).'media/cbcc/js/dataTables-1.10.0/css/jquery.dataTables.min.css');
 	$document->addStyleSheet(JUri::base(true).'/media/cbcc/js/dataTables-1.10.0/css/dataTables.tableTools.css');
 }
 public function baocao(){
 	$document = JFactory::getDocument();
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.cookie.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');
 	$document->addScript( JURI::base(true).'/media/cbcc/js/caydonvi.js' );
 	$model 	=	Core::model('Thongke/Bcdaotaoboiduong');
 	$idUser = JFactory::getUser()->id;
 	$idRoot = Core::getManageUnit($idUser, 'com_thongke', 'treeview', 'treebcdaotaoboiduong');
 	if($idRoot == null){
 		$this->setLayout('hoso_404');
 	}else{
 		$root['root_id'] = $idRoot;
 		$tmp= $model->getThongtin(array('name'),'ins_dept',null,array('id='.$root['root_id']),null);
 		$root['root_name'] = $tmp[0]->name;
 	}
 	$this->assignRef('root_info', $root);
 }
}
?>