<?php
/**
 * Author: Phucnh
* Date created: Apr 23, 2015
* Company: DNICT
*/
defined('_JEXEC') or die();
require 'libraries/phpexcel/Classes/PHPExcel.php';
class ThongkeViewBcdaotaoboiduong extends JViewLegacy
{   
  function __construct()
  { 
  	parent::__construct();
  }
  function display($tpl = null)
   { global $mainframe;
    $document = &JFactory::getDocument();
    $date = new JDate();
    $objPhpExcel = new PHPExcel();
    $model = Core::model('Thongke/Bcdaotaoboiduong');
    $ketqua = array();
    $data = JRequest::get('donvi_id');
    $tungay= $data['tungay'];
    $denngay= $data['denngay'];
    $donvi_id= $data['donvi_id'];
    $json=array();
	$json[1]= $model->hienthiBaocao($donvi_id, 1, 1,$tungay, $denngay);
	$json[2]= $model->hienthiBaocao($donvi_id, 1, 2,$tungay, $denngay);
	$json[3]= $model->hienthiBaocao($donvi_id, 1, 3,$tungay, $denngay);
	$json[4]= $model->hienthiBaocao($donvi_id, 1, 4,$tungay, $denngay);
	$json[5]= $model->hienthiBaocao($donvi_id, 2, 1,$tungay, $denngay);
	$json[6]= $model->hienthiBaocao($donvi_id, 2, 2,$tungay, $denngay);
	$json[7]= $model->hienthiBaocao($donvi_id, 2, 3,$tungay, $denngay);
	$json[8]= $model->hienthiBaocao($donvi_id, 2, 4,$tungay, $denngay);
	$json[9]= 0;
	$json[10]= 0;
	$json[11]= $model->hienthiBaocao($donvi_id, 4, 1,$tungay, $denngay);
	$json[12]= $model->hienthiBaocao($donvi_id, 4, 2,$tungay, $denngay);
	$json[13]= $model->hienthiBaocao($donvi_id, 4, 3,$tungay, $denngay);
	$json[14]= $model->hienthiBaocao($donvi_id, 5, 1,$tungay, $denngay);
	$json[15]= $model->hienthiBaocao($donvi_id, 5, 2,$tungay, $denngay);
	$json[16]= $model->hienthiBaocao($donvi_id, 6, 3,$tungay, $denngay);
	$json[17]= $model->hienthiBaocao($donvi_id, 0, null,$tungay, $denngay);
    $this->assignRef('json', $json);
    $this->assignRef('tungay', $tungay);
    $this->assignRef('denngay', $denngay);
    if(is_null($tpl)) $tpl = 'excel';
    parent::display($tpl);
  }
}