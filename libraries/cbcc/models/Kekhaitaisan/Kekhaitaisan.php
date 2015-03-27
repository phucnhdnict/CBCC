<?php
defined('_JEXEC') or die( 'Restricted access' );
class Kekhaitaisan_Model_Kekhaitaisan extends JModelLegacy{
	/* listTaisan -> Input:
		$ar_field = array('id','name'..)
		$ar_where = array('id = 1', 'name = name'...) 
		return arr('key'=>'value')
	*/
	/**
	 * 
	 * @param string $ar_field
	 * @param string $ar_where
	 * @return Ambigous <mixed, NULL, multitype:unknown Ambigous <unknown, mixed> >
	 */
	public function listTaisan($ar_field = '*', $ar_where = ''){
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
		$query	=	'SELECT '.$field.' FROM kkts_taisan '.$where.' order by orders';
		$db->setQuery($query);
		return $db->loadAssocList();
	}
	/**
	 * 
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
		return $db->loadAssocList();
	}
	/**
	 * Lấy hoso_id bằng id đăng nhập
	 * @param int $josUser
	 * @return array
	 */
	public function getHosoidByJos($josUser){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('hoso_id'))
		->from($db->quoteName('core_user_hoso','hs'))
		->join('inner', $db->quoteName('jos_users', 'a') . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('hs.user_id') . ')')
		->join('inner', $db->quoteName('hosochinh', 'b') . ' ON (' . $db->quoteName('b.id') . ' = ' . $db->quoteName('hs.hoso_id') . ')');
		$query->where($db->quoteName('a.id').'='.$db->quote($josUser));
		$db->setQuery($query);
		return $db->loadResult();
	}
	/**
	 * Lấy thông tin người kê khai tài sản từ bảng hosochinh_quatrinhhientai
	 * @param int $hoso_id
	 * @return array
	 */
	public function getInfoNguoikekhai($hoso_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('a.hoten','a.hosochinh_id','a.ngaysinh','a.congtac_chucvu','a.congtac_donvi_id','b.name'
								,'c.per_residence','c.city_peraddress','c.dist_peraddress','c.comm_peraddress'))
		->from($db->quoteName('hosochinh_quatrinhhientai','a'))
		->join('inner',$db->quoteName('ins_dept','b') . 'ON ('. $db->quoteName('a.congtac_donvi_id').' = '.$db->quoteName('b.id').')')
		->join('inner',$db->quoteName('hosochinh','c') . 'ON ('. $db->quoteName('a.hosochinh_id').' = '.$db->quoteName('c.id').')')
		->where($db->quoteName('hosochinh_id').'='.$db->quote($hoso_id));
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 * Lấy thông tin thân nhân của người kê khai tài sản
	 * @param string $hoso_id
	 * @param string $relative_code_id
	 * @return array
	 */
	public function getNhanthan($hoso_id=null, $relative_code_id=null){
		$db	=	JFactory::getDbo();
		$query	=	$db->getQuery(true);
		$query->select(array('id','hoso_id','relative_code_id','hoten', 'namsinh', 'chucvu', 'coquan', 'hokhau_tinhthanh', 'hokhau_quanhuyen','hokhau_phuongxa', 'choohientai', 'ghichu'  ))
                        ->from($db->quoteName('hoso_nhanthan'));
		if(isset($relative_code_id)) $query->where(' hoso_id='.$hoso_id.' and relative_code_id IN('.$relative_code_id.')');
		$query->order('namsinh asc');
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 * Cập nhật thông tin nhân thân, insert + update
	 * @param unknown $hoso_id
	 * @param unknown $relative_code_id
	 * @param array $arrData
	 */
	public function saveNhanthan($hosochinh_id=null,$relative_code_id=null, $arrData=null){
		$db = JFactory::getDbo();
		if(count($arrData)!=0){
			for($i=0; $i<count($arrData);$i++){
				if(urldecode($arrData[$i]['hoten'])!=""){
					$query = $db->getQuery(true);
					$fields = array(
							$db->quoteName('relative_code_id').'='.$db->quote($relative_code_id),
							$db->quoteName('hoso_id').'='.$db->quote($hosochinh_id),
							$db->quoteName('hoten').'='.$db->quote(urldecode($arrData[$i]['hoten'])),
							$db->quoteName('namsinh').'='.$db->quote($arrData[$i]['namsinh']),
							$db->quoteName('chucvu').'='.$db->quote(urldecode($arrData[$i]['chucvu'])),
							$db->quoteName('coquan').'='.$db->quote(urldecode($arrData[$i]['coquan'])),
							$db->quoteName('hokhau_tinhthanh').'='.$db->quote($arrData[$i]['hokhau_tinhthanh']),
							$db->quoteName('hokhau_quanhuyen').'='.$db->quote($arrData[$i]['hokhau_quanhuyen']),
							$db->quoteName('hokhau_phuongxa').'='.$db->quote($arrData[$i]['hokhau_phuongxa']),
							$db->quoteName('choohientai').'='.$db->quote(urldecode($arrData[$i]['choohientai']))
					);
					if ((isset($arrData[$i]['id'])) && ($arrData[$i]['id']>0)){
						$conditions = array(
								$db->quoteName('id').'='.$db->quote($arrData[$i]['id'])
						);
						$query->update($db->quoteName('hoso_nhanthan'))->set($fields)->where($conditions);
					}else{
						$query->insert($db->quoteName('hoso_nhanthan'));
						$query->set($fields);
					}
					$query.=';';
					$db->setQuery($query);
					$db->execute();					
				}
			}
		}
	}
	/**
	 * Lưu thông tin tài sản nhà
	 * @param unknown $hoso_id
	 * @param array $taisannha
	 * @return boolean
	 */
	public function saveNhaDat($kekhai_id, $ten, $taisan_id, $loainha_id , $capcongtrinh_id, $dientich, $giatri, $gcn, $thongtinkhac, $type, $diachi=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$fields = array(
				$db->quoteName('kekhai_id').'       ='.$db->quote($kekhai_id),
				$db->quoteName('value').'           ='.$db->quote($ten),
				$db->quoteName('taisan_id').'       ='.$db->quote($taisan_id),
				$db->quoteName('loainha_id').'      ='.$db->quote($loainha_id),
				$db->quoteName('capcongtrinh_id').' ='.$db->quote($capcongtrinh_id),
				$db->quoteName('dientich').'        ='.$db->quote($dientich),
				$db->quoteName('trigia').'          ='.str_replace(".", "", $db->quote($giatri)),
				$db->quoteName('giaychungnhan').'   ='.$db->quote($gcn),
				$db->quoteName('thongtinkhac').'    ='.$db->quote($thongtinkhac),
				$db->quoteName('type').'            ='.$db->quote($type),
				$db->quoteName('diachi').'          ='.$db->quote($diachi)
		);
		$query->insert($db->quoteName('kkts_kekhai_chitiet'));
		$query->set($fields);
		$db->setQuery($query);
		return $db->execute();
	}
	/**
	 * Xóa thông tin nhà + đất + tài sản khác trước khi insert
	 * @param unknown $kekhai_id
	 * @return mixed
	 */
	public function deleteNhaDat($kekhai_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$conditions = array(
				$db->quoteName('kekhai_id').' = '.$kekhai_id,
		);
		$query->delete($db->quoteName('kkts_kekhai_chitiet'));
		$query->where($conditions);
		$db->setQuery($query);
		return $db->execute();
	}
	/**
	 * Lấy Kekhai_id
	 * @param unknown $hoso_id
	 * @param unknown $dotkekhai_id
	 * @return Ambigous <mixed, NULL>
	 */
	public function getKekhaiid($hoso_id,$dotkekhai_id){
		$db = JFactory::getDbo();
		$query	=	$db->getQuery(true);
		$query->select(array('id'))->from($db->quoteName('kkts_kekhai'));
		$query->where(' user_id='.$hoso_id.' and dotkekhai_id ='.$dotkekhai_id);
		$db->setQuery($query);
		$db->execute();
		return $db->loadResult();
	}
	/**
	 * Lưu / cập nhật bảng kê khai kkts_kekhai theo đợt...
	 * @param unknown $hoso_id
	 * @param unknown $dotkekhai_id
	 */
	public function saveKekhai($hoso_id,$dotkekhai_id){
// 		$year = date("Y"); // đổi nếu config đợt để chọn
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$fields = array(
				$db->quoteName('user_id').'='.$db->quote($hoso_id),
				$db->quoteName('ngaykekhai').'='.$db->quote(date("Y-m-d")),
				$db->quoteName('dotkekhai_id').'='.$db->quote($dotkekhai_id),
		);
		$conditions = array(
				$db->quoteName('user_id').'='.$hoso_id,
				$db->quoteName('dotkekhai_id').'='.$dotkekhai_id,
		);
		if($this->checkKekhai($hoso_id,$dotkekhai_id)==true){
			// update
			$query->update($db->quoteName('kkts_kekhai'))->set($fields)->where($conditions);
		}else {
			//insert
			$query->insert($db->quoteName('kkts_kekhai'));
			$query->set($fields);
		}
		$db->setQuery($query);
		$db->execute();
// 		if (!$db->query()) {
// 			JError::raiseError(500, $db->getErrorMsg());
// 			return false;
// 		} else {
// 			return true;
// 		}
	}
	/**
	 * Lấy thông tin tài sản đất cũ...
	 * @param unknown $hoso_id
	 * @param unknown $dotkekhai_id
	 * @return Ambigous <mixed, NULL, multitype:unknown mixed >
	 */
	public function getTaisan($hoso_id, $dotkekhai_id){
		$db	=	JFactory::getDbo();
		$query	=	$db->getQuery(true);
		$query->select(array('kk.id as kekhaiid', 'kk.ngaykekhai', 'ct.id as chitiet_id', 'ct.taisan_id as taisan_id', 'ct.value as value','ct.trigia as trigia','ct.type as type','ct.dientich', 'ct.giaychungnhan', 'ct.diachi','ct.thongtinkhac', 'ct.loainha_id','ct.capcongtrinh_id'))
		->from ($db->quoteName('kkts_kekhai_chitiet','ct'))
		->join('left',$db->quoteName('kkts_kekhai','kk') . 'ON ('. $db->quoteName('kk.id').' = '.$db->quoteName('ct.kekhai_id').')');
		$query->where($db->quoteName('kk.user_id').'='.$db->quote($hoso_id));
		$query->where($db->quoteName('kk.dotkekhai_id').' = '.$db->quote($dotkekhai_id));
// 		$query->where($db->quoteName('ct.type').' = '.$db->quote($type));
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 * Lấy đợt kê khai mới nhất của người đang login (hoso_id)
	 * @param unknown $hoso_id
	 * @return unknown
	 */
	public function getLastDotkekhai($hoso_id=null){
		$db = JFactory::getDbo();
		$query	=	$db->getQuery(true);
		$query->select('b.id')
		->from($db->quoteName('kkts_dotkekhai','b'));
		if($hoso_id!="")
			$query->join('inner',$db->quoteName('kkts_kekhai','kk') . 'ON ('. $db->quoteName('b.id').' = '.$db->quoteName('kk.dotkekhai_id').')')
				->where($db->quoteName('kk.user_id'). '=' . $db->quote($hoso_id));
		$query->order('b.orders DESC');
		$db->setQuery($query);
		$db->execute();
		return $db->loadResult();
	}
	/**
	 * kiểm tra $1 có phải là con của $2 không
	 * @param int @con
	 * @param int @cha
	 * @return boolean
	 */
	public function checkTaisanParent($con, $cha){
		$db	=	JFactory::getDbo();
		$query	=	$db->getQuery(true);
		$query->select(array('id'))->from($db->quoteName('kkts_taisan'));
		$query->where($db->quoteName('id').'='.$db->quote($con));
		$query->where(' parent_id='.$db->quote($cha));
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 * Kiểm tra thông tin kê khai mới hay đã tồn tại, true nếu đã tồn tại
	 * @param unknown $emp_id
	 * @return boolean
	 */
	public function checkKekhai($hoso_id,$dotkekhai_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select(array('user_id, id, dotkekhai_id, ngaykekhai'))->from($db->quoteName('kkts_kekhai'));
		$query->where(' user_id='.$hoso_id.' and dotkekhai_id ='.$dotkekhai_id);
		$db->setQuery($query);
		$row = $db->loadObjectList();
		if (count($row)>0) 
			return true; 
		else 
			return false;
	}
	/**
	 * Xóa thông tin nhân thân
	 * @param unknown $hosochinh
	 * @param unknown $id_nhanthan
	 * @return boolean
	 */
	public function deleteNhanthan($hosochinh,$id_nhanthan,$quanhe){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$conditions = array(
				$db->quoteName('hoso_id').' = '.$hosochinh,
				$db->quoteName('id').' NOT IN ('.$id_nhanthan.')',
				$db->quoteName('relative_code_id').' IN ('.$quanhe.')',
		);
		$query->delete($db->quoteName('hoso_nhanthan'));
		$query->where($conditions);
		$db->setQuery($query);
		$db->execute();
		if (!$db->query()) {
			JError::raiseError(500, $db->getErrorMsg());
			return false;
		} else {
			return true;
		}
	}
	/**
	 * combobox cho hộ khẩu thường trú (thành phố)
	 * @param string $select
	 * @return string
	 */
	public function getCboCityPer($select=null,$disabled=null,$id=null){
		if($disabled ==1) $diss= 'disabled';
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
						$diss=>$diss,
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
	 * @param string $select
	 * @return string
	 */
	public function getCboDistPer($city_code=null,$select=null,$disabled=null,$id=null){
		if($disabled ==1) $diss= 'disabled';
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
				'list.attr' => array( // additional HTML attributes for select field
						'class'=>'chosen',
						$diss=>$diss,
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
	 * @param string $select
	 * @return string
	 */
	public function getCboCommPer($dist_code=null,$select=null,$disabled=null,$id=null){
		if($disabled ==1) $diss= 'disabled';
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
				'list.attr' => array( // additional HTML attributes for select field
						'class'=>'chosen',
						$diss=>$diss,
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
	 * combobox quan hệ nhân thân vợ/chồng/ vợ kế
	 * @param string $select
	 * @param string $id
	 * @return string
	 */
	public function getCboRelation($select=null,$id=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('a.id','a.name'))
		->from($db->quoteName('relative_code','a'))
		->where('a.status=1 and id IN (3,12,4)');
		$query->order('a.name asc');
		$db->setQuery($query);
		$tmp = $db->loadObjectList();
		$data=array();
		array_push($data, array('value','text' => '--Chọn quan hệ--'));
		for($i=0;$i<count($tmp);$i++){
			array_push($data, array('value' => $tmp[$i]->id,'text' => $tmp[$i]->name));
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
}