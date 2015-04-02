<?php
class Daotao_Model_Nhucaudaotao extends JModelLegacy {
	function __construct() {
		parent::__construct ();
		global $mainframe;
		$mainframe = JFactory::getApplication ();
	}
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
	 * @return	string	
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
	/**
	 * Kiểm tra quá trình đào tạo đã tồn tại nhu cầu đang chọn chưa
	 * @param unknown $formData
	 * @return Ambigous <mixed, NULL>
	 */
	public function checkQuatrinhdaotao($formData){
		$empid= $formData['empid'];
		$id_loaitrinhdo = $formData['id_loaitrinhdo'];
		$id_chuyennganh = $formData['id_chuyennganh'];
		$id_trinhdo 	= $formData['id_trinhdo'];
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('count(id_dt)'))
		->from($db->quoteName('quatrinhdaotao','qt'));
		$query->where($db->quoteName('tosc_code_dt').'='.$db->quote($id_loaitrinhdo));
		if ((int)$id_chuyennganh>0) { $query->where($db->quoteName('lim_code_dt').'='.$db->quote($id_chuyennganh));}
		if ((int)$id_trinhdo>0) { $query->where($db->quoteName('sca_code_dt').'='.$db->quote($id_trinhdo));}
		$query->where('emp_id_dt = '.$db->quote($empid));
		$db->setQuery($query);
		return $db->loadResult();
	}
	/**
	 * Lưu nhu cầu đào tạo
	 * @param unknown $formData
	 * @return boolean
	 */
	public function saveNhucaudaotao($formData){
		$db = JFactory::getDbo();
		$check = $this->checkQuatrinhdaotao($formData);
		if ($check == 0) {
            $query = $db->getQuery(true);
            $fields = array(
                $db->quoteName('empid') . '=' . $db->quote($formData['empid']),
                $db->quoteName('id_loaitrinhdo') . '=' . $db->quote($formData['id_loaitrinhdo']),
                $db->quoteName('name_loaitrinhdo') . '=' . $db->quote($formData['name_loaitrinhdo']),
                $db->quoteName('id_chuyennganh') . '=' . $db->quote($formData['id_chuyennganh']),
                $db->quoteName('name_chuyennganh') . '=' . $db->quote($formData['name_chuyennganh']),
                $db->quoteName('id_trinhdo') . '=' . $db->quote($formData['id_trinhdo']),
                $db->quoteName('name_trinhdo') . '=' . $db->quote($formData['name_trinhdo']),
                $db->quoteName('trangthai') . '=' . $db->quote($formData['trangthai']),
                $db->quoteName('ngaydangky') . '= (SELECT STR_TO_DATE(' . $db->quote($formData['ngaydangky_nhucaudaotao']) . ',\'%d/%m/%Y\'))',
            );
            if (isset($formData['id_ncdt']) && $formData['id_ncdt'] > 0) {
                $conditions = array(
                    $db->quoteName('id_ncdt') . '=' . $db->quote($formData['id_ncdt'])
                );
                $query->update($db->quoteName('nhucaudaotao'))->set($fields)->where($conditions);
            } else {
                $query->insert($db->quoteName('nhucaudaotao'));
                $query->set($fields);
            }
            $db->setQuery($query);
            if (!$db->query()) {
                JError::raiseError(500, $db->getErrorMsg());
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
	/**
	 * cập nhật status nhu cầu
	 * @param unknown $id_ncdt
	 * @param unknown $id_nguoixuly
	 * @return boolean
	 */
	public function updatestatusNhucaudaotao($id_ncdt,$id_nguoixuly){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$fields = array(
				$db->quoteName('trangthai').'= 1',
				$db->quoteName('id_nguoixuly').'='.$db->quote($id_nguoixuly),
				$db->quoteName('ngayxuly').'='.$db->quote(date('Y-m-d'))
		);
		$conditions = array(
				$db->quoteName('id_ncdt').'='.$db->quote($id_ncdt),
			);
		$query->update($db->quoteName('nhucaudaotao'))->set($fields)->where($conditions);
		$db->setQuery($query);
		if (!$db->query()) {
			JError::raiseError(500, $db->getErrorMsg());
			return false;
		} else {
			return true;
		}
	}
	/**
	 * Xóa nhu cầu đào tạo
	 * @param unknown $arr
	 * @return boolean
	 */
	public function removeNhucaudaotao($arr){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$conditions = array(
				$db->quoteName('id_ncdt').' IN ('.$arr['arrNcdtDelete'].')'
		);
		$query->delete($db->quoteName('nhucaudaotao'));
		$query->where($conditions);
		$db->setQuery($query);
		if (!$db->query()) {
			JError::raiseError(500, $db->getErrorMsg());
			return false;
		} else {
			return true;
		}
	}
	/**
	 * Danh sách nhu cầu đào tạo của đơn vị
	 * @param unknown $inst_code
	 * @return Ambigous <mixed, NULL, multitype:unknown mixed >
	 */
	public function ds_nhucaudaotaotaidonvi($inst_code) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('a.e_name','nc.name_loaitrinhdo','nc.name_chuyennganh','nc.name_trinhdo','nc.ngaydangky','nc.trangthai','nc.ngayxuly','nc.id_ncdt'))
		->from($db->quoteName('nhucaudaotao','nc'))
		->join('inner', $db->quoteName('hosochinh', 'a') . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('nc.empid') . ')')
		->join('inner', $db->quoteName('hosochinh_quatrinhhientai', 'b') . ' ON (' . $db->quoteName('b.hosochinh_id') . ' = ' . $db->quoteName('a.id') . ') ');
		$query->where('( '.$db->quoteName('a.inst_code').'='.$db->quote($inst_code).' OR '.$db->quoteName('a.dept_code').'='.$db->quote($inst_code).')');
		$query->where('b.hoso_trangthai = "00" ');
		$donviloaitru = $this->getUnManageDonvi(JFactory::getUser()->id, 'com_nhucaudaotao', 'treeview' ,'treenhucautonghop');
		if($donviloaitru!='')
			$query->where('a.inst_code NOT IN ('.$donviloaitru.') and a.dept_code NOT IN ('.$donviloaitru.')');
		$query->order('trangthai ASC,ngaydangky ASC, id_loaitrinhdo DESC');
		$db->setQuery($query);
		return $db->loadObjectList();
		
	}
	/**
	 * Lấy hoso_id bằng user_id login
	 * @param unknown $josUser
	 * @return Ambigous <mixed, NULL>
	 */
	public function getEmpidByJos($josUser){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('hoso_id'))
		->from($db->quoteName('core_user_hoso','hs'))
		->join('inner', $db->quoteName('jos_users', 'a') . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('hs.user_id') . ')')
		->join('inner', $db->quoteName('hosochinh', 'b') . ' ON (' . $db->quoteName('b.id') . ' = ' . $db->quoteName('hs.hoso_id') . ')');
		$query->where($db->quoteName('a.id').'='.$db->quote($josUser));
// 		echo $query;exit;
		$db->setQuery($query);
		return $db->loadResult();
	}
	/**
	 * danh sách nhu cầu đào tạo của từng cá nhân
	 * @param string $empid
	 * @param string $id_ncdt
	 * @return Ambigous <mixed, NULL, multitype:unknown mixed >
	 */
	public function ds_nhucaudaotaocanhan($empid=null,$id_ncdt=null) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('id_ncdt','empid','id_loaitrinhdo','name_loaitrinhdo','id_trinhdo','name_trinhdo','id_chuyennganh','name_chuyennganh','ngaydangky','trangthai','ngayxuly'))
		  		->from($db->quoteName('nhucaudaotao','nc'));
		$query->where($db->quoteName('empid').'='.$db->quote($empid));
		if ((int)$id_ncdt>0) {
			$query->where($db->quoteName('id_ncdt').'='.$db->quote($id_ncdt));
		}
		$query->order('trangthai ASC,ngaydangky ASC, id_loaitrinhdo DESC');
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 * thông tin nhu cầu edit
	 * @param string $id_ncdt
	 * @return Ambigous <mixed, NULL, multitype:unknown mixed >
	 */
	public function infoNhucaudaotaoEdit($id_ncdt=null) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('id_ncdt','empid','id_loaitrinhdo','name_loaitrinhdo','id_trinhdo','name_trinhdo','id_chuyennganh','name_chuyennganh','ngaydangky','trangthai'))
		->from($db->quoteName('nhucaudaotao','nc'));
		if ((int)$id_ncdt>0) {
			$query->where($db->quoteName('id_ncdt').'='.$db->quote($id_ncdt));
		}
		$query->order('trangthai ASC,ngaydangky ASC, id_ncdt DESC 	');
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 * lấy combobox chuyên ngành bằng loại trình độ 
	 * @param string $id_loaitrinhdo
	 * @param string $select
	 * @return string
	 */
	public function getChuyennganhByLoaitrinhdo($id_loaitrinhdo=null,$select=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('b.code, b.name'))
		->from($db->quoteName('ls_code','b'))
		->join('INNER', $db->quoteName('type_sca_code', 'a') . ' ON (' . $db->quoteName('a.lim_code') . ' = ' . $db->quoteName('b.lim_code') . ')')
		->where('b.status=1');
		if ((int)$id_loaitrinhdo>0) { $query->where($db->quoteName('a.code').'='.$db->quote($id_loaitrinhdo));}
		$query->order('b.code DESC');
		$db->setQuery($query);
		$arrChuyennganh = $db->loadObjectList();
		$data=array();
		array_push($data, array('value' => "",'text' => "--Chọn chuyên ngành--"));
		for($i=0;$i<count($arrChuyennganh);$i++){
			array_push($data, array('value' => $arrChuyennganh[$i]->code,'text' => $arrChuyennganh[$i]->name));
		}
		$options = array(
				'id' => 'id_chuyennganh',
                                'list.attr' => array( 
                                    'class'=>'chosen',
				),
				'option.key'=>'value',
				'option.text'=>'text',
				'option.attr'=>'attr',
				'list.select'=>$select
		);
		return $result = JHtmlSelect::genericlist($data,'id_chuyennganh',$options);
	}
	/**
	 * Lấy combobox loại trình độ
	 * @param unknown $select
	 * @return string
	 */
	public function getLoaitrinhdo($select){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('code','name','iscn','lim_code'))
		->from($db->quoteName('type_sca_code'))
		->where('status=1 and is_nghiepvu=1 or code=2');
		if ((int)$id_loaitrinhdo>0) { $query->where($db->quoteName('code').'='.$db->quote($id_loaitrinhdo));}
		$query->order('name DESC');
		$db->setQuery($query);
		$arrChuyennganh = $db->loadObjectList();
		$data=array();
		array_push($data, array('value' => "",'text' => "--Chọn loại trình độ--"));
		for($i=0;$i<count($arrChuyennganh);$i++){
			array_push($data, array(
								'value' => $arrChuyennganh[$i]->code,
								'text' => $arrChuyennganh[$i]->name, 	
								'attr' => array( 
												'iscn' => $arrChuyennganh[$i]->iscn , 
												'lim_code' => $arrChuyennganh[$i]->lim_code
												)
									)
						);
		}
		array_push($data, array('value' => "-1",'text' => "Khác"));
		$options = array(
				'id' => 'id_loaitrinhdo',
                                'list.attr' => array( 
                                    'class'=>'chosen',
				),
				'option.key'=>'value',
				'option.text'=>'text',
				'option.attr'=>'attr',
				'list.select'=>$select
		);
		return $result = JHtmlSelect::genericlist($data,'id_loaitrinhdo',$options);
	}
	/**
	 * Lấy combobox trình độ by chuyên ngành
	 * @param unknown $select
	 * @param unknown $id_chuyennganh
	 */
	public function getTrinhdoByChuyennganh($select,$id_chuyennganh){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('ls_code','code','name'))
		->from($db->quoteName('cla_sca_code'));
		if ((int)$id_chuyennganh>0) { $query->where($db->quoteName('ls_code').'='.$db->quote($id_chuyennganh));}
		$query->order('name DESC');
		$db->setQuery($query);
		$arrChuyennganh = $db->loadObjectList();
		$data=array();
		array_push($data, array('value' => "",'text' => "--Chọn trình độ--"));
		for($i=0;$i<count($arrChuyennganh);$i++){
			array_push($data, array('value' => $arrChuyennganh[$i]->code,'text' => $arrChuyennganh[$i]->name));
		}
		$options = array(
				'id' => 'id_trinhdo',
                                'list.attr' => array( 
                                    'class'=>'chosen',
				),
				'option.key'=>'value',
				'option.text'=>'text',
				'option.attr'=>'attr',
				'list.select'=>$select
		);
		return $result = JHtmlSelect::genericlist($data,'id_trinhdo',$options);
	}
	/**
	 * combobox trình độ by loại trình độ
	 * @param unknown $select
	 * @param unknown $id_loaitrinhdo
	 * @return string
	 */
	public function getTrinhdoByLoaitrinhdo($select,$id_loaitrinhdo){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('code','tosc_code','name'))
		->from($db->quoteName('cla_sca_code'));
		if ((int)$id_loaitrinhdo>0) { $query->where($db->quoteName('tosc_code').'='.$db->quote($id_loaitrinhdo));}
		$query->order('name DESC');
		$db->setQuery($query);
		$arrChuyennganh = $db->loadObjectList();
		$data=array();
		array_push($data, array('value' => "",'text' => "--Chọn trình độ--"));
		for($i=0;$i<count($arrChuyennganh);$i++){
			array_push($data, array('value' => $arrChuyennganh[$i]->code,'text' => $arrChuyennganh[$i]->name));
		}
		$options = array(
				'id' => 'id_trinhdo',
                                'list.attr' => array( 
                                    'class'=>'chosen',
				),
				'option.key'=>'value',
				'option.text'=>'text',
				'option.attr'=>'attr',
				'list.select'=>$select
		);
		return $result = JHtmlSelect::genericlist($data,'id_trinhdo',$options);
	}
	/**
	 * kiểm tra loại trình độ có chuyên ngành hay không
	 * @param unknown $id_loaitrinhdo
	 * @return Ambigous <mixed, NULL>
	 */
	public function getIscn($id_loaitrinhdo){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('iscn'))
		->from($db->quoteName('type_sca_code'))
		->where('status=1')
		->where($db->quoteName('code').'='.$db->quote($id_loaitrinhdo))
		;
		$db->setQuery($query);
		return $db->loadResult();
	} 
	
	// P bo sung ngay 3/3/2015
	/**
	 * Lấy thông tin Cán bộ theo donvi_id, đưa vào <select>, tự động selected option ứng với $select
	 * @param int $inst_code donvi_id
	 * @param int $select id để selected
	 * @return string
	 */
	public function getCanboById($inst_code,$select=null){
		// lấy danh sách cán bộ tại đơn vị theo inst_code -> từ tree, select = option đã chọn
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('a.id, a.e_name'))
		->from($db->quoteName('hosochinh','a'))
		->join('inner', $db->quoteName('hosochinh_quatrinhhientai', 'b') . ' ON (' . $db->quoteName('b.hosochinh_id') . ' = ' . $db->quoteName('a.id') . ') ');
		$query->where('( '.$db->quoteName('a.inst_code').'='.$db->quote($inst_code).' OR '.$db->quoteName('a.dept_code').'='.$db->quote($inst_code).')');
		$query->where('b.hoso_trangthai = "00" ');
// 		$donviloaitru = Core::getUnManageDonvi(JFactory::getUser()->id);
		$donviloaitru = $this->getUnManageDonvi(JFactory::getUser()->id, 'com_nhucaudaotao', 'treeview','treenhucautonghop');
		if($donviloaitru!='')
		$query->where('a.inst_code NOT IN ('.$donviloaitru.') and a.dept_code NOT IN ('.$donviloaitru.')');
		$db->setQuery($query);
		$arrCanbo = $db->loadObjectList();
		$data=array();
		array_push($data, array('value' => "",'text' => "--Chọn CBCC--"));
		for($i=0;$i<sizeof($arrCanbo);$i++){
			array_push($data, array('value' => $arrCanbo[$i]->id,'text' => $arrCanbo[$i]->e_name));
		}
		$options = array(
				'id' => 'empid',
                                'list.attr' => array( 
                                    'class'=>'chosen required',
				),
				'option.key'=>'value',
				'option.text'=>'text',
				'option.attr'=>'attr',
				'list.select'=>$select
		);
		return $result = JHtmlSelect::genericlist($data,'empid',$options);
	}
	//
	public static function getUnManageDonvi($id_user,$component = null,$controller=null,$task=null,$location='site'){
		if ($id_user == null) {
			return null;
		}
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('DISTINCT uad.param_donvi')
		->from(' core_user_action_loaitrudonvi AS uad  ')
		->join('INNER', 'core_action AS b ON uad.action_id = b.id')
		->where(" uad.user_id = ".$db->quote($id_user))
		;
		if ($component != null) {
			$query->where('b.component = '.$db->q($component));
		}
		if ($controller != null) {
			$query->where('b.controllers = '.$db->q($controller));
		}
		if ($task != null) {
			$query->where('b.tasks = '.$db->q($task));
		}
		if ($location != null) {
			$query->where('b.location = '.$db->q($location));
		}
		$db->setQuery( $query);
		return $db->loadResult();
	}
	//
}