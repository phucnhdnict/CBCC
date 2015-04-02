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
  			case "getHinhthuctuyendung":
  				$this->getHinhthuctuyendung();
  				break;
  			case "getThietlapthoihan":
  				$this->getThietlapthoihan();
  				break;
  			case "checkVK":
  				$this->checkVK();
  				break;
  			case "getBac":
  				$this->getBac();
  				break;
  			case "getHinhthuchuongngach":
  				$this->getHinhthuchuongngach();
  				break;
  			case "getNgach":
  				$this->getNgach();
  				break;
  			case "getChucvu":
  				$this->getChucvu();
  				break;
  			case "getPhongcongtac":
  				$this->getPhongcongtac();
  				break;
	  	}
	  	parent::display($tpl);
	 }
 	/**
 	 * trả về json chứa thông tin các hồ sơ chờ import theo đơn vị
 	 */
 	function danhsachImport(){
 		$donvi_id = JRequest::getVar('donvi_id');
 		$model = Core::model('Hoso/Import');
 		$danhsach = $model->danhsachImport($donvi_id);
 		Core::printJson($danhsach);
 		die;
 	}
 	/**
 	 * Lấy thông tin hồ sơ import đang được chọn để hiển thị
 	 */
 	function thongtinImport(){
 		$model	=	Core::model('Hoso/Import');
 		$id_import = JRequest::getVar('id_import');
 		$thongtinImportCanxem	=	$model->getThongtinImport($id_import);
 		$this->assignRef('thongtinImportCanxem', $thongtinImportCanxem);
 		$model_hoso = Core::model('Hoso/Hoso');
 		$listDonviQuanly = $model_hoso->getDonviQuanlyOfUser('hoso_add');
 		
 		$data=array();
 		array_push($data, array('value','text' => '--Chọn Đơn vị công tác--'));
 		for($i=0;$i<count($listDonviQuanly);$i++){
 			array_push($data, array('value' => $listDonviQuanly[$i]['id'],'text' => $listDonviQuanly[$i]['name']));
 		}
 		$options = array(
 				'id' => 'congtac_donvi_id',
 				'list.attr' => array( // additional HTML attributes for select field
 						'class'=>'chosen',
 						'z-index'=>'9999',
 				),
 				'option.key'=>'value',
 				'option.text'=>'text',
 				'option.attr'=>'attr',
 				'list.select'=>$thongtinImportCanxem->congtac_donvi_id
 		);
 		$result = JHtmlSelect::genericlist($data,'congtac_donvi_id',$options);
 		$this->assignRef('listDonviQuanly', $result);
 	}
 	/**
 	 * Hiển thị combobox chọn quận huyện
 	 */
 	public function changeCadc(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	(JRequest::get('cadc_code'));
 		$cadc_code = $post['cadc_code'];
 		$dist 	=	$model->getCboDistPer($cadc_code, null, 'dist_placebirth');
 		Core::PrintJson($dist);
 		die;
 	}
 	/**
 	 * Hiển thị combobox chọn phường xã
 	 */
 	public function changeDist(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	(JRequest::get('dist_placebirth'));
 		$dist_placebirth = $post['dist_placebirth'];
 		$comm 	=	$model->getCboCommPer($dist_placebirth, null , 'comm_placebirth');
 		Core::PrintJson($comm);
 		die;
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
												 				and c.goibienche=b.goibienche_id and a.status=1 and c.id='.$donvi_id  
												 				,'name asc', '--Chọn Loại hình biên chế--', 'id', 'name'
												 				, $selected, 'bienche_hinhthuc_id', 'chosen required');
 		Core::PrintJson($biencheHinhthuc);
 		die;
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
 		die;
 	}
 	/**
 	 * Hiển thị combobox chọn hình thức biên chế
 	 */
 	public function getHinhthuctuyendung(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	JRequest::get('bienche_hinhthuc_id');
 		$bienche_hinhthuc_id	=	$post['bienche_hinhthuc_id'];
 		$hinhthuctuyendung_selected	=	$post['selected'];
 		Core::PrintJson($model->getcbo('bc_hinhthuctuyendung a, bc_hinhthuc_hinhthuctuyendung b, bc_hinhthuc c',
									'a.id, a.name',' a.id= b.hinhthuctuyendung_id and b.hinhthuc_id=c.id and a.`status`=1 and c.id='.$bienche_hinhthuc_id,
									'a.name asc',
									'--Chọn Hình thức tuyển dụng--',
									'id', 'name', $hinhthuctuyendung_selected, 'bienche_hinhthuctuyendung_id', 'chosen required'));
 		die;
 	}
 	/**
 	 * Hiển thị combobox chọn thiết lập thời hạn
 	 */
 	public function getThietlapthoihan(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	JRequest::get('bienche_hinhthuc_id');
 		$bienche_hinhthuc_id	=	$post['bienche_hinhthuc_id'];
 		$thietlapthoihan_selected	=	$post['selected'];
 		Core::PrintJson($model->getcbo('bc_hinhthuc a, bc_hinhthuc_thoihan b, bc_thoihanbienchehopdong c',
									'c.id as id, c.name as name, c.month as month',' a.id=b.hinhthuc_id and c.id=b.thoihan_id and c.`status`=1 and a.id='.$bienche_hinhthuc_id,
									'id asc',
									'--Chọn Thời hạn--',
									'id', 'name', $thietlapthoihan_selected, 'bienche_thoihanbienchehopdong_id', 'chosen required', array('month'=>'month')));
 		die;
 	}
 	/**
 	 * Hiển thị combobox chọn thiết lập thời hạn
 	 */
 	public function checkVK(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	JRequest::get('luong_heso');
 		$luong_idbac	=	$post['luong_idbac'];
 		$luong_mangach	=	$post['luong_mangach'];
 		$vk = $model->checkVK($luong_mangach);
 		if ($luong_idbac == $vk) return Core::PrintJson(true);
 		else return Core::PrintJson(false);
 		die;
 	}
 	/**
 	 * Hiển thị combobox chọn Bậc
 	 */
 	public function getBac(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	JRequest::get('luong_mangach');
 		$luong_mangach	=	$post['luong_mangach'];
 		Core::PrintJson($model->getCbo('cb_nhomngach_heso a, cb_bac_heso b',
 				'a.idbac as idbac, a.heso as heso',
 				' a.sta_code = b.mangach and b.mangach="'.$luong_mangach.'"',
 				'idbac asc',
 				'--Bậc--', 'idbac', 'idbac', '', 'luong_bac', 'chosen required', array('heso'=>'heso')));
 		die;
 	}
 	/**
 	 * Hiển thị combobox chọn getHinhthuchuongngach
 	 */
 	public function getHinhthuchuongngach(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	JRequest::get('donvi_id');
 		$congtac_donvi_id	=	$post['donvi_id'];
 		Core::PrintJson($model->getCbo('whois_sal_mgr a, cb_goihinhthuchuongluong b, cb_goihinhthuchuongluong_hinhthucnangluong c, ins_dept d',
									'a.id as id, a.name as name, a.is_nangluonglansau as is_nangluonglansau, a.is_nhaptien as is_nhaptien, a.phantramsotienhuong as phantramsotienhuong, a.is_nhapngaynangluong as is_nhapngaynangluong',
									' d.goihinhthuchuongluong= b.id and b.id=c.goihinhthuchuongluong_id and a.id=c.whois_sal_mgr_id
									and a.`status`=1 and d.id='.$congtac_donvi_id,
									'id asc',
									'--Chọn Hình thức hưởng lương/ngạch--',
									'id', 'name', '', 'luong_hinhthuc_id', 'chosen required', array('phantramsotienhuong'=>'phantramsotienhuong','is_nangluonglansau'=>'is_nangluonglansau','is_nhaptien'=>'is_nhaptien','is_nhapngaynangluong'=>'is_nhapngaynangluong')));
 		die;
 	}
 	/**
 	 * Hiển thị combobox chọn getNgach
 	 */
 	public function getNgach(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	JRequest::get('donvi_id');
 		$congtac_donvi_id	=	$post['donvi_id'];
 		Core::PrintJson($model->getCbo('cb_bac_heso a, cb_goiluong b, cb_goiluong_ngach c, ins_dept d',
										'a.mangach as mangach, a.name as name',
										' d.goiluong=b.id and b.id = c.id_goi and c.ngach=a.mangach and d.id='.$congtac_donvi_id,
										'mangach asc',
										'--Chọn Ngạch--',
										'mangach', 'name', '', 'luong_mangach', 'chosen required'));
 		die;
 	}
 	/**
 	 * Hiển thị combobox chọn getChucvu
 	 */
 	public function getChucvu(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	JRequest::get('donvi_id');
 		$congtac_donvi_id	=	$post['donvi_id'];
 		Core::PrintJson($model->getCboChucvu($congtac_donvi_id));
 		die;
 	}
 	/**
 	 * Hiển thị combobox chọn getPhongcongtac
 	 */
 	public function getPhongcongtac(){
 		$model	=	Core::model('Hoso/Import');
 		$post 	=	JRequest::get('donvi_id');
 		$congtac_donvi_id	=	$post['donvi_id'];
 		Core::PrintJson($model->getCbo('ins_dept',
										'id, name',
										' type=0 and parent_id='.$congtac_donvi_id,
										'id asc',
										'--Chọn Phòng công tác--',
										'id', 'name', '', 'congtac_phong_id', 'chosen required'));
 		die;
 	}
}
?>