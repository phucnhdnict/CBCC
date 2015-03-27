<?php
/**
 * Author: Phucnh
 * Date created: Mar 19, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
require 'libraries\phpexcel\Classes\PHPExcel.php';
require_once 'libraries\phpexcel\Classes\PHPExcel\IOFactory.php';
class HososViewImport extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		  	case 'uploadcbcc':
		  		$this->uploadcbcc();
		  		break;
	  		case 'danhsachImport':
	  			$this->danhsachImport();
	  			break;
	  		case 'thongtinImport':
	  			$this->thongtinImport();
	  			$this->setLayout('thongtin');
	  			break;
  			case "changeCadc":
  				$this->changeCadc();
  				break;
  			case "changeDist":
  				$this->changeDist();
  				break;
  			case "getBiencheHinhthuc":
  				$this->getBiencheHinhthuc();
  				break;
  			case "getInfor_BiencheHinhthuc":
  				$this->getInfor_BiencheHinhthuc();
  				break;
  			case "getTreeImport":
  				$this->getTreeImport();
  				break;
  			case "getHinhthuctuyendung":
  				$this->getHinhthuctuyendung();
  				break;
  			case "getThietlapthoihan":
  				$this->getThietlapthoihan();
  				break;
	  	}
	  	parent::display($tpl);
	 }
	 function getTreeImport(){
		$model = Core::model('Hoso/Import');
		$id = JRequest::getInt('id');
		$id = ((int)$id==0)?Core::getManageUnit(JFactory::getUser()->id):$id;
		$items = $model->treeImport($id);
		header("HTTP/1.0 200 OK");
		header('Content-type: application/json; charset=utf-8');
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		echo $items;
		exit;
	 }
	 function uploadcbcc(){
	 	$arr = array();
	 	$model = Core::model('Hoso/Import');
	 	$user_import = jFactory::getUser()->id;
	 	$md5 = md5(rand(0,999));
	 	$hash = substr($md5, 15, 5);
		$filename	= 	$hash.date('mdY').'_'.($model->regexFileUpload($_FILES['file']['name'], true));
	 	move_uploaded_file($_FILES['file']['tmp_name'], $filename); // tải file lên server
	 	$objPHPExcel = PHPExcel_IOFactory::load ($filename);
	 	$objPHPExcel->setActiveSheetIndex(0); // lấy sheet đầu tiên
	//  	$objPHPExcel->setActiveSheetIndexByName('DSCBCC'); // lấy sheet với tên DSCBCC
	 	$highestColumn = $objPHPExcel->getActiveSheet()->getHighestColumn(); // số cột lớn nhất
	 	$highestColumnIndex = PHPExcel_Cell::columnIndexFromString ( $highestColumn ); // số cột lớn nhất 
	 	$highestRow = $objPHPExcel->getActiveSheet()->getHighestRow(); // số hàng lớn nhất
		
	 	for($row = 3; $row <= $highestRow ; ++ $row) {
	 		for($col = 0; $col < $highestColumnIndex; ++ $col) {
	 			$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow ( $col, $row );
	 			$val = $cell->getValue ();
	 			if ($row === 1)
	 				echo $val;
	 			else{
	 				$arr[$row][$col]= $val;
			 		}
	 		}
	 	}
	 	// lưu dữ liệu vào db
	 	$arrKq = $model->saveImport($arr);
	 	if (count($arrKq)>0) {
	 		echo 	'<br/>
	 				<span style="color:blue">Import thành công.</span>
	 				<br/>
	 				<span style="color:red">Vui lòng bổ sung các hồ sơ có thông tin sai lệch:
	 				<br/>';
	 		foreach ($arrKq as $val)
	 			echo '- '.$val.'<br/>';
	 		echo '</span>'; 
	 	}
	 	else echo "<br/><span style='color:blue'>Import thành công, các hồ sơ đã được lưu</span>";
	 	unlink($filename); // xóa file khỏi hệ thống
	 	exit;
 	}
 	/**
 	 * trả về json chứa thông tin các hồ sơ chờ import theo đơn vị
 	 */
 	function danhsachImport(){
 		$donvi_id = JRequest::getVar('donvi_id');
 		$model = Core::model('Hoso/Import');
 		$danhsach = $model->danhsachImport($donvi_id);
 		Core::printJson($danhsach);
 		exit;
 	}
 	/**
 	 * Lấy thông tin hồ sơ import đang được chọn để hiển thị
 	 */
 	function thongtinImport(){
 		$model	=	Core::model('Hoso/Import');
 		$id_import = JRequest::getVar('id_import');
 		$thongtinImportCanxem	=	$model->getThongtinImport($id_import);
 		$this->assignRef('thongtinImportCanxem', $thongtinImportCanxem);
 	}
 	/**
 	 * Hiển thị combobox chọn quận huyện
 	 */
 	public function changeCadc(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	(JRequest::get('cadc_code'));
 		$cadc_code = $post['cadc_code'];
 		$dist 	=	$model->getCboDistPer($cadc_code, null, 'dist_placebirth');
 		echo $dist;
 		exit;
 	}
 	/**
 	 * Hiển thị combobox chọn phường xã
 	 */
 	public function changeDist(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	(JRequest::get('dist_placebirth'));
 		$dist_placebirth = $post['dist_placebirth'];
 		$comm 	=	$model->getCboCommPer($dist_placebirth, null , 'comm_placebirth');
 		echo $comm;
 		exit;
 	}
 	/**
 	 * Hiển thị combobox chọn hình thức biên chế
 	 */
 	public function getBiencheHinhthuc(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	(JRequest::get('donvi_id'));
 		$donvi_id = $post['donvi_id'];
 		$selected = $post['selected'];
 		$biencheHinhthuc 	=	$model->getCbo('bc_hinhthuc a, bc_goibienche_hinhthuc b,ins_dept c ', 'a.id, a.name', 'a.id=b.hinhthuc_id
 and c.goibienche=b.goibienche_id and a.status=1 and c.id='.$donvi_id , 'name asc', '--Chọn Loại hình biên chế--', 'id', 'name', $selected, 'bienche_hinhthuc_id', 'chosen required');
 		echo $biencheHinhthuc;
 		exit;
 	}
 	/**
 	 * Hiển thị combobox chọn hình thức biên chế
 	 */
 	public function getInfor_BiencheHinhthuc(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	(JRequest::get('bienche_hinhthuc_id'));
 		$bienche_hinhthuc_id	=	$post['bienche_hinhthuc_id'];
 		$thongtinBienche = $model->listData('bc_hinhthuc',
 				 array('id','name','loaihinh_id','is_thietlapthoihan','is_hinhthuctuyendung','text_ngaybatdau','text_ngayketthuc','text_soquyetdinh','text_coquanraquyetdinh','text_ngaybanhanh','valid_ngaybatdau','valid_ngayketthuc','valid_soquyetdinh','valid_coquanraquyetdinh','valid_ngaybanhanh'),
 				array('id = '.$bienche_hinhthuc_id,' status=1'), '');
 		Core::PrintJson($thongtinBienche);
 		exit;
 	}
 	/**
 	 * Hiển thị combobox chọn hình thức biên chế
 	 */
 	public function getHinhthuctuyendung(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	JRequest::get('bienche_hinhthuc_id');
 		$bienche_hinhthuc_id	=	$post['bienche_hinhthuc_id'];
 		$hinhthuctuyendung_selected	=	$post['selected'];
 		echo $model->getcbo('bc_hinhthuctuyendung a, bc_hinhthuc_hinhthuctuyendung b, bc_hinhthuc c',
									'a.code, a.name',' a.id= b.hinhthuctuyendung_id and b.hinhthuc_id=c.id and a.`status`=1 and c.id='.$bienche_hinhthuc_id,
									'a.name asc',
									'--Chọn Hình thức tuyển dụng--',
									'code', 'name', $hinhthuctuyendung_selected, 'id_hinhthuctuyendung', 'chosen required');
 		exit;
 	}
 	/**
 	 * Hiển thị combobox chọn thiết lập thời hạn
 	 */
 	public function getThietlapthoihan(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	JRequest::get('bienche_hinhthuc_id');
 		$bienche_hinhthuc_id	=	$post['bienche_hinhthuc_id'];
 		$thietlapthoihan_selected	=	$post['selected'];
 		echo $model->getcbo('bc_hinhthuc a, bc_hinhthuc_thoihan b, bc_thoihanbienchehopdong c',
									'c.id as id, c.name as name, c.month as month',' a.id=b.hinhthuc_id and c.id=b.thoihan_id and c.`status`=1 and a.id='.$bienche_hinhthuc_id,
									'id asc',
									'--Chọn Thời hạn--',
									'id', 'name', $thietlapthoihan_selected, 'id_thietlapthoihan', 'chosen required', 'month', 'month');
 		exit;
 	}
 	
 	
//  	clone v2
//  	function uploadcbcc(){
//  		$arr = array();
//  		$model = Core::model('Hoso/Import');
//  		$user_import = jFactory::getUser()->id;
//  		$md5 = md5(rand(0,999));
//  		$hash = substr($md5, 15, 5);
//  		$filename	= 	$hash.date('mdY').'_'.($model->regexFileUpload($_FILES['file']['name'], true));
//  		move_uploaded_file($_FILES['file']['tmp_name'], 'phucnh/' .  $filename); // tải file lên server
//  		$objPHPExcel = PHPExcel_IOFactory::load ('phucnh/' .$filename);
//  		$objPHPExcel->setActiveSheetIndex(0); // lấy sheet đầu tiên
//  		//  	$objPHPExcel->setActiveSheetIndexByName('DSCBCC'); // lấy sheet với tên DSCBCC
 	
//  		$title =  $objPHPExcel->getActiveSheet()->getTitle(); // tiêu đề sheet
//  		$highestColumn = $objPHPExcel->getActiveSheet()->getHighestColumn(); // số cột lớn nhất
//  		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString ( $highestColumn ); // số cột lớn nhất
//  		$highestRow = $objPHPExcel->getActiveSheet()->getHighestRow(); // số hàng lớn nhất
 	
//  		echo '<div class="dataTables_wrapper">
//  			<table id="tbl" class="table table-striped table-bordered dataTable">
// 	 			<thead>
//  					<tr>
// 	 					<th>Họ và tên</th><th>Ngày sinh
// 						(yyyy-mm-dd hoặc yyyy)</th><th>Giới tính</th><th>ID Dân tộc</th><th>ID Tình trạng hôn nhân</th><th>Địa chỉ</th><th>Di động</th><th>ĐT cơ quan</th><th>Email</th><th>YIM</th><th>Mã số BHXH</th><th>Mã số thuế</th><th>ID tỉnh (thành)</th><th>ID quận (huyện)</th><th>ID phường (xã)</th><th>ID Loại hình biên chế</th><th>Ngày bắt đầu
// 						(yyyy-mm-dd)</th><th>Ngày kết thúc
// 						(yyyy-mm-dd)</th><th>ID Hình thức tuyển dụng
// 						(nếu loại hình là Biên chế hành chính)</th><th>ID Thời hạn hợp đồng
// 						(nếu loại hình là Hợp đồng trong chỉ tiêu)</th><th>Số quyết định</th><th>Cơ quan ra quyết định</th><th>Ngày ban hành
// 						(yyyy-mm-dd)</th><th>ID Hình thức hưởng ngạch</th><th>Mã ngạch</th><th>Bậc</th><th>Vượt khung (%)</th><th>Ngày hưởng lương
// 						(yyyy-mm-dd)</th><th>Thời điểm nâng lương lần sau tính từ
// 						(yyyy-mm-dd)</th><th>Số tiền được hưởng</th><th>ID đơn vị</th><th>ID phòng</th><th>Ngày bắt đầu
// 						(yyyy-mm-dd) </th><th>ID Chức vụ</th><th>Tên chức vụ</th><th>Ngày công bố chức vụ
// 						(yyyy-mm-dd)</th><th>ID Hình thức phân công/ bổ nhiệm</th><th>ID Cách thức bổ nhiệm</th><th>ID Trình độ đào tạo</th><th>ID trường</th><th>ID chuyên ngành</th><th>Năm tốt nghiệp</th><th>ID Hình thức đào tạo</th><th>ID Nước đào tạo</th><th>ID Loại tốt nghiệp</th><th>Ngày kết nạp
// 						(yyyy-mm-dd)</th><th>Ngày chính thức (yyyy-mm-dd)</th><th>Số thẻ đảng</th><th>ID Chức vụ Đảng</th><th>Ngày bắt đầu chức vụ Đảng</th><th>Tên tổ chức Đảng đang sinh hoạt</th><th>Ghi chú</th>
//  					</tr>
//  				</thead><tbody>
//  			';
 	
//  		for($row = 3; $row <= $highestRow ; ++ $row) {
//  			echo '<tr>';
//  			for($col = 0; $col < $highestColumnIndex; ++ $col) {
//  				$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow ( $col, $row );
//  				$val = $cell->getValue ();
 	
//  				if ($row === 1)
//  					echo '<td>'. $val . '</td>';
//  				else{
//  					$arr[$row][$col]= $val;
//  					echo '<td>'. $val . '</td>';
//  				}
//  			}
//  			echo '</tr>';
//  		}
//  		echo '</tbody></table></div>';
//  		// lưu dữ liệu vào bảng
//  		$arrKq = $model->saveImport($arr);
//  		if (count($arrKq)>0) {
//  			echo "Import thành công.<br/>Vui lòng bổ sung các hồ sơ có thông tin sai lệch:<br/>";
//  			foreach ($arrKq as $val)
//  				echo '- '.$val.'<br/>';
//  		}
//  		else echo "Import thành công";
//  		unlink('phucnh/' .$filename); // xóa file khỏi hệ thống
//  		exit;
//  	}
 	
 	
//  	clone v1
//  	function uploadcbcc(){
//  		$model = Core::model('Hoso/Import');
//  		$user_import = jFactory::getUser()->id;
//  		$md5 = md5(rand(0,999));
//  		$hash = substr($md5, 15, 5);
//  		$filename	= 	$hash.date('mdY').'_'.($model->regexFileUpload($_FILES['file']['name'], true));
//  		move_uploaded_file($_FILES['file']['tmp_name'], 'phucnh/' .  $filename); // tải file lên server
//  		echo $filename;
//  		$objPHPExcel = PHPExcel_IOFactory::load ('phucnh/' .$filename);
//  		$objPHPExcel->setActiveSheetIndex(0); // lấy sheet đầu tiên
//  		//  	$objPHPExcel->setActiveSheetIndexByName('DSCBCC'); // lấy sheet với tên DSCBCC
 	
//  		$title =  $objPHPExcel->getActiveSheet()->getTitle(); // tiêu đề sheet
//  		$highestColumn = $objPHPExcel->getActiveSheet()->getHighestColumn(); // số cột lớn nhất
//  		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString ( $highestColumn ); // số cột lớn nhất
//  		$highestRow = $objPHPExcel->getActiveSheet()->getHighestRow(); // số hàng lớn nhất
 	
//  		echo 'Sheet '.$title.' có '.$highestColumnIndex. ' trường và '.($highestRow-2).' hàng dữ liệu! <br/><br/><br/>';
//  		echo '<div class="dataTables_wrapper">
//  			<table id="tbl" class="table table-striped table-bordered dataTable">
// 	 			<thead>
//  					<tr>
// 	 					<th>Họ và tên</th><th>Ngày sinh
// 						(yyyy-mm-dd hoặc yyyy)</th><th>Giới tính</th><th>ID Dân tộc</th><th>ID Tình trạng hôn nhân</th><th>Địa chỉ</th><th>Di động</th><th>ĐT cơ quan</th><th>Email</th><th>YIM</th><th>Mã số BHXH</th><th>Mã số thuế</th><th>ID tỉnh (thành)</th><th>ID quận (huyện)</th><th>ID phường (xã)</th><th>ID Loại hình biên chế</th><th>Ngày bắt đầu
// 						(yyyy-mm-dd)</th><th>Ngày kết thúc
// 						(yyyy-mm-dd)</th><th>ID Hình thức tuyển dụng
// 						(nếu loại hình là Biên chế hành chính)</th><th>ID Thời hạn hợp đồng
// 						(nếu loại hình là Hợp đồng trong chỉ tiêu)</th><th>Số quyết định</th><th>Cơ quan ra quyết định</th><th>Ngày ban hành
// 						(yyyy-mm-dd)</th><th>ID Hình thức hưởng ngạch</th><th>Mã ngạch</th><th>Bậc</th><th>Vượt khung (%)</th><th>Ngày hưởng lương
// 						(yyyy-mm-dd)</th><th>Thời điểm nâng lương lần sau tính từ
// 						(yyyy-mm-dd)</th><th>Số tiền được hưởng</th><th>ID đơn vị</th><th>ID phòng</th><th>Ngày bắt đầu
// 						(yyyy-mm-dd) </th><th>ID Chức vụ</th><th>Tên chức vụ</th><th>Ngày công bố chức vụ
// 						(yyyy-mm-dd)</th><th>ID Hình thức phân công/ bổ nhiệm</th><th>ID Cách thức bổ nhiệm</th><th>ID Trình độ đào tạo</th><th>ID trường</th><th>ID chuyên ngành</th><th>Năm tốt nghiệp</th><th>ID Hình thức đào tạo</th><th>ID Nước đào tạo</th><th>ID Loại tốt nghiệp</th><th>Ngày kết nạp
// 						(yyyy-mm-dd)</th><th>Ngày chính thức (yyyy-mm-dd)</th><th>Số thẻ đảng</th><th>ID Chức vụ Đảng</th><th>Ngày bắt đầu chức vụ Đảng</th><th>Tên tổ chức Đảng đang sinh hoạt</th><th>Ghi chú</th>
//  					</tr>
//  				</thead><tbody>
//  			';
//  		for($row = 3; $row <= $highestRow ; ++ $row) {
//  			echo '<tr>';
//  			for($col = 0; $col < $highestColumnIndex; ++ $col) {
//  				$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow ( $col, $row );
//  				$val = $cell->getValue ();
//  				if ($row === 1)
//  					echo '<td>' . $val . '</td>';
//  				else
//  					echo '<td>' . $val . '</td>';
//  			}
//  			echo '</tr>';
//  		}
//  		echo '</tbody></table></div>';
//  		unlink($filename); // xóa file khỏi hệ thống
//  		exit;
//  	}
}
?>