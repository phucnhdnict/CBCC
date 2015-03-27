<?php
/**
 * Author: Phucnh
 * Date created: Mar 19, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class HososViewImport extends JViewLegacy {
    function display($tpl = null) {
        $task = JRequest::getVar('task');
            switch($task){
            	case 'importhoso':
                    $this->setLayout('default');
                    $this->importHoso();
                    break;
                default:		                
                	$this->setLayout('hoso_404');
                	break;
  }
  parent::display($tpl);
 }
 function importHoso(){
 	$document = JFactory::getDocument();
 	$document->addScript(JUri::base(true).'/media/cbcc/js/dataTables-1.10.0/jquery.dataTables.min.js');
 	$document->addStyleSheet(JUri::base(true).'media/cbcc/js/dataTables-1.10.0/css/jquery.dataTables.min.css');
 	$model = Core::model('Hoso/Import');
 	$idUser = JFactory::getUser()->id;
 	$idRoot = Core::getManageUnit($idUser, 'com_hoso', 'treeview', 'treeImportHoso');
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