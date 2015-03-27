<?php
/**
 * Author: Phucnh
* Date created: Jan 23, 2015
* Company: DNICT
*/
defined('_JEXEC') or die();
require 'libraries/phpexcel/Classes/PHPExcel.php';
class NhucaudaotaoViewThongkenhucaudaotao extends JViewLegacy
{   
  function __construct()
  { 
  	parent::__construct();
  }
  function display($tpl = null)
   { global $mainframe;
    $user = JFactory::getUser();
    $document = &JFactory::getDocument();
    $date = new JDate();
    $objPhpExcel = new PHPExcel();
    $data = JRequest::get('donvi_id');
    $tungay= $data['tungay'];
    $denngay= $data['denngay'];

    $b=explode(',',$data['donvi_id']);
    $model = Core::model('Daotao/Thongkenhucaudaotao');
    $ketqua = array();
    for ($i=0;$i<sizeof($b);$i++)
    {
    	array_push($ketqua,$model->excelThongkencdt($b[$i],$tungay,$denngay,$data['stt']));
    }
    $this->assignRef('rows', $ketqua);
    if(is_null($tpl)) $tpl = 'excel';
    parent::display($tpl);
  }
}