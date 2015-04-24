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
		  	case 'doituong':
		  		$this->doituong();
		  		break;
		  	default:
		  		$this->setLayout('hoso_404');
		  		break;
  }
  parent::display($tpl);
 }
 public function doituong(){
 	$model			=	Core::model('Thongke/Bcdaotaoboiduong');
 	$donvi_id 	=	$_POST['donvi_id'];
 	$tungay 		=	$_POST['tungay'];
 	$denngay 		=	$_POST['denngay'];
 	$target			=	$_POST['target'];
 	$condition		=	$_POST['condition'];
 	$json 			=	$model->hienthiBaocao($donvi_id, $target, $condition,$tungay, $denngay);
 	Core::PrintJson($json);
 	die;
 }
}
?>