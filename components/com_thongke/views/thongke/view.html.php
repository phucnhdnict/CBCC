<?php
/**
 * Author: Phucnh
 * Date created: Mar 19, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThongkeViewThongke extends JViewLegacy {
    function display($tpl = null) {
        $task = JRequest::getVar('task');
            switch($task){
            	case 'default':
                    $this->setLayout('default');
                    $this->defaults();
                    break;
                default:		                
                	$this->setLayout('hoso_404');
                	break;
  }
  parent::display($tpl);
 }
 function defaults(){
 	$document = JFactory::getDocument();
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/upload/jquery.fileupload.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery.colorbox-min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/upload/jquery.iframe-transport.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/dataTables-1.10.0/jquery.dataTables.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/bootstrap.tab.ajax.js');
 	$document->addStyleSheet(JUri::base(true).'media/cbcc/js/dataTables-1.10.0/css/jquery.dataTables.min.css');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.cookie.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');
 	$document->addScript( JURI::base(true).'/media/cbcc/js/caydonvi.js' );
 	$document->addScript(JUri::base(true).'/media/cbcc/js/dataTables.tableTools.min.js');
 	$document->addStyleSheet(JUri::base(true).'/media/cbcc/js/dataTables-1.10.0/css/dataTables.tableTools.css');
 	
 	$model = Core::model('Thongke/Thongke');
 	$idUser = JFactory::getUser()->id;
 	$idRoot = Core::getManageUnit($idUser, 'com_thongke', 'treeview', 'treecctsbnn');
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