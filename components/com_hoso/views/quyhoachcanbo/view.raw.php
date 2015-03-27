<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class HososViewQuyhoachcanbo extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		  	case 'addQuyhoachcanbo':
		  		$this->themquyhoachcanbo();
		  		$this->setLayout('frmquyhoachcanbo');
		  		break;
		  	case 'editQuyhoachcanbo':
		  		$this->editQuyhoachcanbo();
		  		$this->setLayout('frmquyhoachcanbo');
		  		break;
		  	case 'saveQuyhoachcanbo':
		  		$this->saveQuyhoachcanbo();
		  		break;
		  	case 'ds_quyhoachcb':
	  			$this->ds_quyhoachcb();
	  			break;
		  	case 'deleteQuyhoachcanbo':
	  			$this->deleteQuyhoachcanbo();
	  			break;
	  		default:
	  			break;
  }
  parent::display($tpl);
 }
 function editQuyhoachcanbo(){
 	$model = Core::model('Hoso/Quyhoachcanbo');
 	$id_qhcb = JRequest::getVar('id_qhcb');
 	$donvi_id = JRequest::getVar('donvi_id');
 	$this->assignRef('donvi_id', $donvi_id);
 	if($id_qhcb>0)
 		$datadb_quyhoachcanbo  = $model->thongtinQuyhoachcanboDeEdit($id_qhcb);
 	$this->assignRef('datadb_quyhoachcanbo', $datadb_quyhoachcanbo);
 }
function themquyhoachcanbo(){
	$donvi_id = JRequest::getVar('donvi_id');
	$this->assignRef('donvi_id', $donvi_id);
}
function saveQuyhoachcanbo(){
	$data_frmQuyhoachcanbo = JRequest::get('data_frmQuyhoachcanbo');
	$model = Core::model('Hoso/Quyhoachcanbo');
	$model->saveQuyhoachcanbo($data_frmQuyhoachcanbo);
	exit;
}
function deleteQuyhoachcanbo(){
	$arrQhcbDelete = JRequest::get('arrQhcbDelete');
	$model = Core::model('Hoso/Quyhoachcanbo');
	$model->deleteQuyhoachcanbo($arrQhcbDelete);
	exit;
}
 function ds_quyhoachcb(){
 	$donvi_id = JRequest::getVar('donvi_id');
 	$model = Core::model('Hoso/Quyhoachcanbo');
 	$rowQHCB= $model->ds_quyhoachcanbo($donvi_id);
	$str.='
<h3 class="header smaller lighter blue">
	Danh sách quy hoạch cán bộ<span data-original-title="Xóa" class="btn btn-mini btn-danger pull-right inline" id="btn_remove_quyhoachcanbo" style="margin-right: 5px;" data-placement="top" title="">
		<i class="icon-trash"></i> Xóa
	</span>
	<a data-original-title="Thêm mới" class="btn btn-mini btn-success pull-right inline" id="btn_add_quyhoachcanbo" style="margin-right: 5px;" data-toggle="modal" data-target=".modal">
		<i class="icon-plus"></i> Thêm mới
	</a>
</h3>
			
			<div class="dataTables_wrapper">
		<table class="table table-striped table-bordered table-hover dataTable" id="formQuyhoachcanbo" role="grid" aria-describedby="formNhucaudaotao_info">
			<thead>
				<tr role="row">
					<th style="vertical-align: middle;" class="center"></th>
					<th style="vertical-align: middle;" class="center">Họ và tên</th>
					<th style="vertical-align: middle;" class="center">Ngày sinh</th>
					<th style="vertical-align: middle;" class="center">Chức vụ hiện tại</th>
					<th style="vertical-align: middle;" class="center">Phòng công tác</th>
					<th style="vertical-align: middle;" class="center sort_pos_td">Chức vụ quy hoạch</th>
					<th style="vertical-align: middle;" class="center">Từ năm</th>
					<th style="vertical-align: middle;" class="center">Đến năm</th>
					<th style="vertical-align: middle;" class="center">Ngày đăng ký</th>
					<th style="vertical-align: middle;" class="center">Ghi chú</th>
					<th style="vertical-align: middle;" class="center"></th>
				</tr>
			</thead>
			<tbody id="tbody_canhannhucaudaotao">'; 	
 	for($i=0;$i<sizeof($rowQHCB);$i++){
 		if ($rowQHCB[$i]->status ==1) {$ngayxuly=date('d/m/Y', strtotime($rowQHCB[$i]->date_created));}
 					$str.='<tr style="color:'.$stylecolor.'" class="tr_nhucaudaotao" role="row">';
 						$str.='<td style="vertical-align: middle;"><input type="checkbox" class="ckb_qhcb" value="'.$rowQHCB[$i]->id_qhcb.'" style="opacity:1"></td>';
 						$str.='<td style="vertical-align: middle;">'.$rowQHCB[$i]->e_name.'</td>';
 						$str.='<td style="vertical-align: middle;">'.date('d/m/Y' ,strtotime($rowQHCB[$i]->birth_date)).'</td>';
 						$str.='<td style="vertical-align: middle;">'.$rowQHCB[$i]->position.'</td>';
 						$str.='<td style="vertical-align: middle;">'.$rowQHCB[$i]->phongcongtac.'</td>';		
 						$str.='<td style="vertical-align: middle;">'.$rowQHCB[$i]->positionQuyhoach.'</td>';		
 						$str.='<td style="vertical-align: middle;">'.$rowQHCB[$i]->start_year.'</td>';		
 						$str.='<td style="vertical-align: middle;">'.$rowQHCB[$i]->end_year.'</td>';		
 						$str.='<td style="vertical-align: middle;" class="center">'.date('d/m/Y' ,strtotime($rowQHCB[$i]->date_created)).'</td>';
 						$str.='<td style="vertical-align: middle;">'.$rowQHCB[$i]->ghichu.'</td>';
 						$str.='	<td style="vertical-align: middle;"><span class="btn btn-mini btn-info btn_edit_quyhoachcanbo" data-toggle="modal"  data-target=".modal" role="button" id_qhcb="'.$rowQHCB[$i]->id_qhcb.'" data-original-title="Điều chỉnh" title="Điều chỉnh">
 										<i class="icon-edit"></i>
 									</span>
 											</td>
 								</tr>';
 }
 $str.='</tbody>
		</table></div>
	';
	header('Content-type: application/json');
	echo json_encode($str);
	die;
 }
}
?>