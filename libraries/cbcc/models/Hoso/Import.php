<?php
/**
 * Author: Phucnh
 * Date created: Mar 19, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class Hoso_Model_Import extends JModelLegacy {
	function __construct() {
		parent::__construct ();
		global $mainframe;
		$mainframe = JFactory::getApplication ();
	}
	/**
	 *	Lấy thông tin của 1 bảng
	 * @param unknown $table
	 * @param string $ar_field
	 * @param string $ar_where
	 * @param string $oder
	 * @return Ambigous <mixed, NULL, multitype:unknown Ambigous <unknown, mixed> >
	 */
	public function listData($table, $ar_field = '*', $ar_where = '', $oder =''){
		$db		=	JFactory::getDbo();
		if (is_array($ar_field)) {
			$field = implode (', ', $ar_field);
		}else {
			$field = '*';
		}
		if (is_array($ar_where)) {
			$where = ' WHERE '.implode (' and ', $ar_where);
		}else {
			$where = '';
		}
		$query	=	'SELECT '.$field.' FROM '.$table.' '.$where.' '. $oder;
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	//-------------- Các hàm thao tác cây đơn vị --------------------
	/**
	 * Lấy node gốc trên tree của acccount đang log
	 *
	 * @param   integer  $user->id  id account đăng nhập.
	 *
	 * @return  null|array  Trả về thông tin về node gốc.
	 *
	 */
	function getRootTree(){
		$user  = JFactory::getUser();
		$id_user = $user->id;
		$root = Core::getManageUnit($id_user);
		return $root;
	}
	/**
	 * Lấy thông tin đơn vị từ don_id truyền vào
	 *
	 * @param	int	$root_id	node root hiện hành theo account đang log
	 *
	 * @return	string	Trả về tên của node
	 */
	public function getInfoByDonvi_id($root_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('name'))
		->from($db->quoteName('ins_dept'));
		$query->where($db->quoteName('id').'='.$db->quote($root_id));
		$db->setQuery($query);
		return $db->loadResult();
	}
	
	//-----------
	/**
	 * Kiểm tra có phải ngày hay năm không
	 * @param string $data
	 * @return boolean
	 */
	function checkDateTime($data) {
		if ((date('Y-m-d', strtotime($data)) == $data)||(date('Y-n-j', strtotime($data)) == $data)||(date('Y-m-j', strtotime($data)) == $data)||(date('Y-n-d', strtotime($data)) == $data)) {
			return 0; //ngày tháng năm
		} elseif((date('Y', strtotime($data)) == $data)) {
			return 1; //năm
		}else return 3;
	}
	
// 	function getDonvi($donvi_id, $field){
// 		$db = JFactory::getDbo();
// 		$query = $db->getQuery(true);
// 		$query	->select(array($field))
// 		->from($db->quoteName('ins_dept','a'))
// 		->where($db->quote($field).' ='.$db->quote($donvi_id));
// 		$db->setQuery($query);
// 		return $db->loadResult();
// 	}
	/**
	 * Lấy thông tin các hồ sơ cán bộ theo đơn vị, phòng ban
	 * @param string $donvi_id
	 * @return Ambigous <mixed, NULL, multitype:unknown mixed >
	 */
	function danhsachImport($donvi_id=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('a.id',
								'a.hoten',
								'a.ngaysinh',
								'a.danhdaunamsinh',
								'a.gioitinh',
								'a.nat_code',
								'a.married_fk',
								'a.per_residence',
								'a.mobile',
								'a.phone_work',
								'a.email',
								'a.yim',
								'a.maso_bhxh',
								'a.maso_thue',
								'a.cadc_code',
								'a.dist_placebirth',
								'a.comm_placebirth',
								'a.bienche_hinhthuc_id',
								'a.bienche_ngaybatdau',
								'a.bienche_ngayketthuc',
								'a.bienche_hinhthuctuyendung_id',
								'a.bienche_thoihanbienchehopdong_id',
								'a.bienche_soquyetdinh',
								'a.bienche_coquanquyetdinh',
								'a.bienche_ngaybanhanh',
								'a.luong_hinhthuc_id',
								'a.luong_mangach',
								'a.luong_bac',
								'a.luong_vuotkhung',
								'a.luong_ngaybatdau',
								'a.luong_ngaynangluongtieptheo',
								'a.money_sal',
								'a.congtac_donvi_id',
								'a.congtac_phong_id',
								'a.congtac_ngaybatdau',
								'a.congtac_chucvu_id',
								'a.congtac_chucvu',
								'a.congtac_chucvu_ngaycongbo',
								'a.whois_pos_mgr_id',
								'a.cachthucbonhiem_id',
								'a.chuyenmon_trinhdo_code',
								'a.chuyenmon_truong_id',
								'a.chuyenmon_chuyennganh_id',
								'a.chuyenmon_namtotnghiep',
								'a.chuyenmon_hinhthucdaotao_id',
								'a.chuyenmon_nuocdaotao',
								'a.chuyenmon_loaitotnghiep_id',
								'a.party_j_date',
								'a.party_date',
								'a.sothedangvien',
								'a.dang_chucvudang_id',
								'a.start_date_ctd',
								'a.donvidang_ctd',
								'a.ghichu',
								'a.status',
								'a.date_import',
								'a.user_import',
								'b.name as tenphong',
								'c.name as tendonvi'
		))
		->from($db->quoteName('hosochinh_import','a'))
		->join('left', $db->quoteName('ins_dept', 'b') . ' ON (' . $db->quoteName('b.id') . ' = ' . $db->quoteName('a.congtac_phong_id').')')
		->join('left', $db->quoteName('ins_dept', 'c') . ' ON (' . $db->quoteName('c.id') . ' = ' . $db->quoteName('a.congtac_donvi_id').')')
		->where('a.congtac_donvi_id ='.$db->quote($donvi_id).' OR '.'a.congtac_phong_id ='.$db->quote($donvi_id));
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 * Lưu thông tin dữ liệu import của cbcc
	 * @param array $arr
	 * @return boolean
	 */
	function saveImport($arrData){
		$db = JFactory::getDbo();
		$array = array();
		if(count($arrData)!=0){
			for($i=3; $i<(count($arrData)+3);$i++){
				if($arrData[$i][0]!="" && $arrData[$i][1]!="" ){
					$query = $db->getQuery(true);
					
					if ($this->checkDateTime($arrData[$i][1]) == 1 && $arrData[$i][1]<3000) {
						// năm sinh, đánh dấu 1,chuyển thành ngày 1/1
						$danhdaunamsinh = 1;
						$namsinh = $arrData[$i][1].'-12-31'; 
					}
					elseif($this->checkDateTime($arrData[$i][1]) == 0) {
						// ngày sinh, đánh dấu không
							$danhdaunamsinh = 0;
							$namsinh = $arrData[$i][1];
					}
					
					if($danhdaunamsinh==1 || $danhdaunamsinh==0){
						$fields = array(
								$db->quoteName('hoten').'='.$db->quote($arrData[$i][0]),
								$db->quoteName('ngaysinh').'='.$db->quote($namsinh),
								$db->quoteName('danhdaunamsinh').'='.$db->quote($danhdaunamsinh), //1 nếu là năm
								$db->quoteName('gioitinh').'='.$db->quote($arrData[$i][2]),
								$db->quoteName('nat_code').'='.$db->quote($arrData[$i][3]),
								$db->quoteName('married_fk').'='.$db->quote($arrData[$i][4]),
								$db->quoteName('per_residence').'='.$db->quote($arrData[$i][5]),
								$db->quoteName('mobile').'='.$db->quote($arrData[$i][6]),
								$db->quoteName('phone_work').'='.$db->quote($arrData[$i][7]),
								$db->quoteName('email').'='.$db->quote($arrData[$i][8]),
								$db->quoteName('yim').'='.$db->quote($arrData[$i][9]),
								$db->quoteName('maso_bhxh').'='.$db->quote($arrData[$i][10]),
								$db->quoteName('maso_thue').'='.$db->quote($arrData[$i][11]),
								$db->quoteName('cadc_code').'='.$db->quote($arrData[$i][12]),
								$db->quoteName('dist_placebirth').'='.$db->quote($arrData[$i][13]),
								$db->quoteName('comm_placebirth').'='.$db->quote($arrData[$i][14]),
								$db->quoteName('bienche_hinhthuc_id').'='.$db->quote($arrData[$i][15]),
								$db->quoteName('bienche_ngaybatdau').'='.$db->quote($arrData[$i][16]),
								$db->quoteName('bienche_ngayketthuc').'='.$db->quote($arrData[$i][17]),
								$db->quoteName('bienche_hinhthuctuyendung_id').'='.$db->quote($arrData[$i][18]),
								$db->quoteName('bienche_thoihanbienchehopdong_id').'='.$db->quote($arrData[$i][19]),
								$db->quoteName('bienche_soquyetdinh').'='.$db->quote($arrData[$i][20]),
								$db->quoteName('bienche_coquanquyetdinh').'='.$db->quote($arrData[$i][21]),
								$db->quoteName('bienche_ngaybanhanh').'='.$db->quote($arrData[$i][22]),
								$db->quoteName('luong_hinhthuc_id').'='.$db->quote($arrData[$i][23]),
								$db->quoteName('luong_mangach').'='.$db->quote($arrData[$i][24]),
								$db->quoteName('luong_bac').'='.$db->quote($arrData[$i][25]),
								$db->quoteName('luong_vuotkhung').'='.$db->quote($arrData[$i][26]),
								$db->quoteName('luong_ngaybatdau').'='.$db->quote($arrData[$i][27]),
								$db->quoteName('luong_ngaynangluongtieptheo').'='.$db->quote($arrData[$i][28]),
								$db->quoteName('money_sal').'='.$db->quote($arrData[$i][29]),
								$db->quoteName('congtac_donvi_id').'='.$db->quote($arrData[$i][30]),
								$db->quoteName('congtac_phong_id').'='.$db->quote($arrData[$i][31]),
								$db->quoteName('congtac_ngaybatdau').'='.$db->quote($arrData[$i][32]),
								$db->quoteName('congtac_chucvu_id').'='.$db->quote($arrData[$i][33]),
								$db->quoteName('congtac_chucvu').'='.$db->quote($arrData[$i][34]),
								$db->quoteName('congtac_chucvu_ngaycongbo').'='.$db->quote($arrData[$i][35]),
								$db->quoteName('whois_pos_mgr_id').'='.$db->quote($arrData[$i][36]),
								$db->quoteName('cachthucbonhiem_id').'='.$db->quote($arrData[$i][37]),
								$db->quoteName('chuyenmon_trinhdo_code').'='.$db->quote($arrData[$i][38]),
								$db->quoteName('chuyenmon_truong_id').'='.$db->quote($arrData[$i][39]),
								$db->quoteName('chuyenmon_chuyennganh_id').'='.$db->quote($arrData[$i][40]),
								$db->quoteName('chuyenmon_namtotnghiep').'='.$db->quote($arrData[$i][41]),
								$db->quoteName('chuyenmon_hinhthucdaotao_id').'='.$db->quote($arrData[$i][42]),
								$db->quoteName('chuyenmon_nuocdaotao').'='.$db->quote($arrData[$i][43]),
								$db->quoteName('chuyenmon_loaitotnghiep_id').'='.$db->quote($arrData[$i][44]),
								$db->quoteName('party_j_date').'='.$db->quote($arrData[$i][45]),
								$db->quoteName('party_date').'='.$db->quote($arrData[$i][46]),
								$db->quoteName('sothedangvien').'='.$db->quote($arrData[$i][47]),
								$db->quoteName('dang_chucvudang_id').'='.$db->quote($arrData[$i][48]),
								$db->quoteName('start_date_ctd').'='.$db->quote($arrData[$i][49]),
								$db->quoteName('donvidang_ctd').'='.$db->quote($arrData[$i][50]),
								$db->quoteName('ghichu').'='.$db->quote($arrData[$i][51]),
								$db->quoteName('status').'='.$db->quote(0),
								$db->quoteName('date_import').'='.$db->quote(date('Y-m-d')),
								$db->quoteName('user_import').'='.$db->quote(JFactory::getUser()->id),
						);
						if ((isset($arrData[$i]['id'])) && ($arrData[$i]['id']>0)){
							$conditions = array(
									$db->quoteName('id').'='.$db->quote($arrData[$i]['id'])
							);
							$query->update($db->quoteName('hosochinh_import'))->set($fields)->where($conditions);
						}else{
							$query->insert($db->quoteName('hosochinh_import'));
							$query->set($fields);
						}
						$query.=';';
						$db->setQuery($query);
						$db->execute();
						$danhdaunamsinh=3;
					} else array_push($array, $arrData[$i][0]);
				}else array_push($array, $arrData[$i][0]);
			}
		}
		return $array;
	}
	/**
	 * 
	 * @param string $cs chuỗi ký tự tiếng việt
	 * @param string $tolower true: viết thường, fasle: giữ nguyên
	 * @return string|mixed
	 */
	function regexFileUpload($cs, $tolower = false)
	{
		/*Mảng chứa tất cả ký tự có dấu trong Tiếng Việt*/
		$marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
				"ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề",
				"ế","ệ","ể","ễ",
				"ì","í","ị","ỉ","ĩ",
				"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ",
				"ờ","ớ","ợ","ở","ỡ",
				"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
				"ỳ","ý","ỵ","ỷ","ỹ",
				"đ",
				"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă",
				"Ằ","Ắ","Ặ","Ẳ","Ẵ",
				"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
				"Ì","Í","Ị","Ỉ","Ĩ",
				"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
				"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
				"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
				"Đ"," ");
	
		/*Mảng chứa tất cả ký tự không dấu tương ứng với mảng $marTViet bên trên*/
		$marKoDau=array("a","a","a","a","a","a","a","a","a","a","a",
				"a","a","a","a","a","a",
				"e","e","e","e","e","e","e","e","e","e","e",
				"i","i","i","i","i",
				"o","o","o","o","o","o","o","o","o","o","o","o",
				"o","o","o","o","o",
				"u","u","u","u","u","u","u","u","u","u","u",
				"y","y","y","y","y",
				"d",
				"A","A","A","A","A","A","A","A","A","A","A","A",
				"A","A","A","A","A",
				"E","E","E","E","E","E","E","E","E","E","E",
				"I","I","I","I","I",
				"O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
				"U","U","U","U","U","U","U","U","U","U","U",
				"Y","Y","Y","Y","Y",
				"D","_");
		if ($tolower) {
			return strtolower(str_replace($marTViet,$marKoDau,$cs));
		}
		return str_replace($marTViet,$marKoDau,$cs);
	}
	/**
	 * Lấy thông tin import để cán bộ xem
	 * @param string $id_import
	 * @return Ambigous <mixed, NULL, multitype:unknown mixed >
	 */
	function getThongtinImport($id_import=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('a.id',
				'a.hoten',
				'a.ngaysinh',
				'a.danhdaunamsinh',
				'a.gioitinh',
				'a.nat_code',
				'a.married_fk',
				'a.per_residence',
				'a.mobile',
				'a.phone_work',
				'a.email',
				'a.yim',
				'a.maso_bhxh',
				'a.maso_thue',
				'a.cadc_code', // nguyên quán tỉnh thành
				'a.dist_placebirth',
				'a.comm_placebirth',
				'a.bienche_hinhthuc_id',
				'a.bienche_ngaybatdau',
				'a.bienche_ngayketthuc',
				'a.bienche_hinhthuctuyendung_id',
				'a.bienche_thoihanbienchehopdong_id',
				'a.bienche_soquyetdinh',
				'a.bienche_coquanquyetdinh',
				'a.bienche_ngaybanhanh',
				'a.luong_hinhthuc_id',
				'a.luong_mangach',
				'a.luong_bac',
				'a.luong_vuotkhung',
				'a.luong_ngaybatdau',
				'a.luong_ngaynangluongtieptheo',
				'a.money_sal',
				'a.congtac_donvi_id',
				'a.congtac_phong_id',
				'a.congtac_ngaybatdau',
				'a.congtac_chucvu_id',
				'a.congtac_chucvu',
				'a.congtac_chucvu_ngaycongbo',
				'a.whois_pos_mgr_id',
				'a.cachthucbonhiem_id',
				'a.chuyenmon_trinhdo_code',
				'a.chuyenmon_truong_id',
				'a.chuyenmon_chuyennganh_id',
				'a.chuyenmon_namtotnghiep',
				'a.chuyenmon_hinhthucdaotao_id',
				'a.chuyenmon_nuocdaotao',
				'a.chuyenmon_loaitotnghiep_id',
				'a.party_j_date',
				'a.party_date',
				'a.sothedangvien',
				'a.dang_chucvudang_id',
				'a.start_date_ctd',
				'a.donvidang_ctd',
				'a.ghichu',
				'a.status',
				'a.date_import',
				'a.user_import'
		))
		->from($db->quoteName('hosochinh_import','a'))
		->where('a.id ='.$db->quote($id_import));
		$db->setQuery($query);
		return $db->loadObject();
	}
	/**
	 * combobox cho hộ khẩu thường trú (thành phố)
	 * @param string $select
	 * @param string $id
	 * @return string
	 */
	public function getCboCityPer($select=null,$id=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('code','name'))
		->from($db->quoteName('city_code'))
		->where('status=1');
		$query->order('name asc');
		$db->setQuery($query);
		$tmp = $db->loadObjectList();
		$data=array();
		array_push($data, array('value','text' => '--Chọn tỉnh/thành--'));
		for($i=0;$i<count($tmp);$i++){
			array_push($data, array('value' => $tmp[$i]->code,'text' => $tmp[$i]->name));
		}
		$options = array(
				'id' => $id,
				'list.attr' => array( // additional HTML attributes for select field
						'class'=>'chosen',
						'z-index'=>'9999',
				),
				'option.key'=>'value',
				'option.text'=>'text',
				'option.attr'=>'attr',
				'list.select'=>$select
		);
		return $result = JHtmlSelect::genericlist($data,$id,$options);
	}
	/**
	 * combobox hộ khẩu thường trú (quận/huyện)
	 * @param string $city_code
	 * @param string $select là id được selected
	 * @param string $id là id/name
	 * @return string
	 */
	public function getCboDistPer($city_code=null,$select=null,$id=null){
		if(!isset($city_code)) $city_code=0;
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('a.code','a.name'))
		->from($db->quoteName('dist_code','a'))
		->where('a.status=1');
		if (isset($city_code)) $query->where('a.cadc_code ='.$city_code);
		$query->order('a.name asc');
		$db->setQuery($query);
		$tmp = $db->loadObjectList();
		$data=array();
		array_push($data, array('value','text' => '--Chọn quận/huyện--'));
		for($i=0;$i<count($tmp);$i++){
			array_push($data, array('value' => $tmp[$i]->code,'text' => $tmp[$i]->name));
		}
		$options = array(
				'id' => $id,
				'list.attr' => array(
						'class'=>'chosen',
						'z-index'=>'9999',
				),
				'option.key'=>'value',
				'option.text'=>'text',
				'option.attr'=>'attr',
				'list.select'=>$select
		);
		return $result = JHtmlSelect::genericlist($data,$id,$options);
	}
	/**
	 * ombobox hộ khẩu thường trú phường xã
	 * @param unknown $dist_code
	 * @param string $select là id được selected
	 * @param string $id là id/name
	 * @return string
	 */
	public function getCboCommPer($dist_code=null,$select=null,$id=null){
		if(!isset($dist_code)) $dist_code=0;
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('a.code','a.name'))
		->from($db->quoteName('comm_code','a'))
		->where('a.status=1');
		if(isset($dist_code)) $query->where('a.dc_code ='.$dist_code);
		$query->order('a.name asc');
		$db->setQuery($query);
		$tmp = $db->loadObjectList();
		$data=array();
		array_push($data, array('value','text' => '--Chọn phường/xã--'));
		for($i=0;$i<count($tmp);$i++){
			array_push($data, array('value' => $tmp[$i]->code,'text' => $tmp[$i]->name));
		}
		$options = array(
				'id' => $id,
				'list.attr' => array( 
						'class'=>'chosen',
						'z-index'=>'9999',
				),
				'option.key'=>'value',
				'option.text'=>'text',
				'option.attr'=>'attr',
				'list.select'=>$select
		);
		return $result = JHtmlSelect::genericlist($data,$id,$options);
	}
	/**
	 * combobox với một danh mục đơn giản
	 * @param string $select
	 * @param string $id
	 * @return string
	 */
	public function getCbo($table,$field,$where,$order,$text,$code,$name,$selected=null,$idname=null,$class=null,$attrArray=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array($field))
		->from($table)
		->where($where);
		$query->order($order);
		$db->setQuery($query);
		$tmp = $db->loadObjectList();
		$data=array();
		array_push($data, array('value','text' => $text));
		for($i=0;$i<count($tmp);$i++){
			$attr=array();
			if(isset($attrArray) && is_array($attrArray))
				foreach ($attrArray as $k=>$v){
					$attr+=array($k=>$tmp[$i]->$v);
				}
			if (!isset($attr) && !is_array($attr))
				array_push($data, array('value' => $tmp[$i]->$code,'text' => $tmp[$i]->$name));
			else {
				array_push($data, array('value' => $tmp[$i]->$code,'text' => $tmp[$i]->$name,'attr'=>$attr));
			}
		}
		$options = array(
				'id' => $idname,
				'list.attr' => array(
						'class'=>$class,
						'z-index'=>'9999',
				),
				'option.key'=>'value',
				'option.text'=>'text',
				'option.attr'=>'attr',
				'list.select'=>$selected
		);
		return $result = JHtmlSelect::genericlist($data,$idname,$options);
	}
}