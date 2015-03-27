<?php
/**
 * Author: Phucnh
 * Date created: Jan 20, 2015
 * Company: DNICT
 */

class Daotao_Model_Thongkenhucaudaotao extends JModelLegacy {
	function __construct() {
		parent::__construct ();
		global $mainframe;
		$mainframe = JFactory::getApplication ();
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
	
	/**
	 * Hiển thị thống kê, chạy vòng lặp để lấy từng thông tin thống kê nhu cầu đào tạo của đơn vị
	 * 
	 * @param unknown $data
	 * @param string $tungay
	 * @param string $denngay
	 * @return Ambigous <mixed, NULL, multitype:unknown mixed >
	 */
	public function hienthithongke($data,$tungay=null,$denngay=null){
		$ketqua = array();
	 		for ($i=0;$i<count($data['donvi_id']);$i++)
	 		{ 
				$kq=$this->getThongke($data['donvi_id'][$i],$tungay,$denngay);
				array_push($ketqua,$kq);
	 		}
	 	return $ketqua;
	}
	/**
	 * Lấy thông tin thống kê của một đơn vị theo kiểu object
	 * @param string $donvi_id mã đơn vị
	 * @param string $tungay
	 * @param string $denngay
	 * @return Ambigous <mixed, NULL, multitype:unknown mixed >
	 */
	function getThongke($donvi_id, $tungay=null, $denngay=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query = '  select "'.$this->getInfoByDonvi_id($donvi_id).'" as donvi_name,
					-- chuyên môn
					count(if(td.step=1,1,NULL)) tiensi,
					count(if(td.step=2,1,NULL)) thacsi,
					count(if(td.step=3,1,NULL)) daihoc,
					count(if(td.step=4,1,NULL)) caodang,
					count(if(td.step=5,1,NULL)) trungcap,
					count(if(td.step>=6,1,NULL)) conlai,
					-- lý luận chính trị
					--count(if(ctri.step=0,1,NULL)) tiensi_ctri,
					--count(if(ctri.step=1,1,NULL)) thacsi_ctri,
					--count(if(ctri.step=2,1,NULL)) daihoc_ctri,
					count(if(ctri.step<3,1,NULL)) cunhan_ctri,
					count(if(ctri.step=3,1,NULL)) caocap_ctri,
					count(if(ctri.step>=4,1,NULL)) trungcap_ctri,
					--count(if(ctri.step=5,1,NULL)) socap_ctri,
					count(if(ctri.step=5 or ctri.step=2 or ctri.step=3 or ctri.step=4 or ctri.step=1 or ctri.step=0 ,1,NULL)) tong_ctri,
					-- tin học
					count(if(tinhoc.step<=2,1,NULL)) trendaihoc_tinhoc,
					count(if(tinhoc.step=3 or tinhoc.step=4,1,NULL)) tccd_tinhoc,
					count(if(tinhoc.step>4 ,1,NULL)) coso_tinhoc,
					count(if(tinhoc.step>=0,1,NULL)) tong_tinhoc,
					-- tiếng anh
					count(if(tienganh.step<3,1,NULL)) trendaihoc_tienganh,
					count(if(tienganh.step=3 or tienganh.step=4,1,NULL)) tccd_tienganh,
					count(if(tienganh.step=5,1,NULL)) coso_tienganh,
					count(if(tienganh.step>=0,1,NULL)) tong_tienganh,
					-- Ngoại ngữ khác
					count(if(nnkhac.step<3,1,NULL)) trendaihoc_nnkhac,
					count(if(nnkhac.step=3 or nnkhac.step=4,1,NULL)) tccd_nnkhac,
					count(if(nnkhac.step=5,1,NULL)) coso_nnkhac,
					count(if(nnkhac.step>=0,1,NULL)) tong_nnkhac,
					-- quản lý nhà nước
					count(if(qlnn.step=0,1,NULL)) qlnn_cvcc,
					count(if(qlnn.step=1,1,NULL)) qlnn_cvc,
					count(if(qlnn.step=2,1,NULL)) qlnn_cv,
					count(if(nc.id_loaitrinhdo=-1,1,NULL)) khac,
					-- quốc phòng an ninh
					count(if(qphong.step=1 or qphong.step=2,1,NULL)) qphong_12,
					count(if(qphong.step=3,1,NULL)) qphong_3,
					count(if(qphong.step=4 or qphong.step=5,1,NULL)) qphong_45,
					-- tổng
					count(nc.id_loaitrinhdo) tong
					from nhucaudaotao nc
					left join cla_sca_code td on nc.id_loaitrinhdo = td.tosc_code and td.tosc_code=2 and nc.id_trinhdo=td.`code`
					left join cla_sca_code ctri on nc.id_loaitrinhdo=ctri.tosc_code and ctri.tosc_code=3 and nc.id_trinhdo =ctri.`code`
					left join cla_sca_code qphong on nc.id_loaitrinhdo=qphong.tosc_code and qphong.tosc_code=17 and nc.id_trinhdo =qphong.`code` 
					left join cla_sca_code tinhoc on nc.id_loaitrinhdo=tinhoc.tosc_code and tinhoc.tosc_code=7  and nc.id_trinhdo =tinhoc.`code`
					left join cla_sca_code qlnn on nc.id_loaitrinhdo=qlnn.tosc_code and qlnn.tosc_code=5 and nc.id_trinhdo=qlnn.`code` 
					left join cla_sca_code tienganh on nc.id_loaitrinhdo=tienganh.tosc_code and tienganh.ls_code=340646 and tienganh.tosc_code=6 and nc.id_trinhdo=tienganh.`code`
					left join cla_sca_code nnkhac on nc.id_trinhdo=nnkhac.`code` and nc.id_loaitrinhdo= nnkhac.tosc_code and nc.name_trinhdo=nnkhac.`name` and nnkhac.ls_code!=340646 and nnkhac.tosc_code=6
					left join hosochinh b on nc.empid=b.id 
					left join hosochinh_quatrinhhientai c on b.id = c.hosochinh_id and c.hoso_trangthai = "00"
					right JOIN (
					-- tính tổng các node con thành phần
					  SELECT node.id FROM ins_dept AS node, ins_dept AS parent
					  WHERE node.lft BETWEEN parent.lft AND parent.rgt AND parent.id = '.$donvi_id.'
					  ) AS dvbc ON b.inst_code = dvbc.id
					where nc.trangthai = 0 ';
		if($tungay!="" || $tungay != null) $query .='and nc.ngaydangky >=  STR_TO_DATE("'.$tungay.'","%d/%m/%Y")';
		if($denngay!="" || $denngay != null) $query .='and nc.ngaydangky <= STR_TO_DATE("'.$denngay.'","%d/%m/%Y")';
		if($donvi_id!="") $db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 * Lấy thông tin thống kê của một đơn vị, trả về array để xuất excel
	 * @param string $donvi_id mã đơn vị
	 * @param string $tungay 
	 * @param string $denngay
	 * @return Ambigous <mixed, NULL, multitype:unknown mixed >
	 */
	function excelThongkencdt($donvi_id=null, $tungay=null, $denngay=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query = '  select "'.$this->getInfoByDonvi_id($donvi_id).'" as donvi_name,
					-- tổng
					count(nc.id_loaitrinhdo) tong, 
				    -- chuyên môn
					count(if(td.step=1,1,NULL)) tiensi, 
					count(if(td.step=2,1,NULL)) thacsi, 
					count(if(td.step=3,1,NULL)) daihoc, 
					count(if(td.step=4,1,NULL)) caodang,
					count(if(td.step=5,1,NULL)) trungcap,
					count(if(td.step>=6,1,NULL)) conlai,
					-- lý luận chính trị
					count(if(ctri.step<3,1,NULL)) cunhan_ctri, 
					count(if(ctri.step=3,1,NULL)) caocap_ctri, 
					count(if(ctri.step>=4,1,NULL)) trungcap_ctri,
					-- tin học
					count(if(tinhoc.step<=2,1,NULL)) trendaihoc_tinhoc, 
					count(if(tinhoc.step=3 or tinhoc.step=4,1,NULL)) tccd_tinhoc, 
					count(if(tinhoc.step>4 ,1,NULL)) coso_tinhoc,
					-- tiếng anh
					count(if(tienganh.step<3,1,NULL)) trendaihoc_tienganh, 
					count(if(tienganh.step=3 or tienganh.step=4,1,NULL)) tccd_tienganh, 
					count(if(tienganh.step=5,1,NULL)) coso_tienganh, 
					-- Ngoại ngữ khác
					count(if(nnkhac.step<3,1,NULL)) trendaihoc_nnkhac, 
					count(if(nnkhac.step=3 or nnkhac.step=4,1,NULL)) tccd_nnkhac,
					count(if(nnkhac.step=5,1,NULL)) coso_nnkhac, 
					-- quản lý nhà nước
					count(if(qlnn.step=0,1,NULL)) qlnn_cvcc, 
					count(if(qlnn.step=1,1,NULL)) qlnn_cvc,
					count(if(qlnn.step=2,1,NULL)) qlnn_cv,
					-- quốc phòng an ninh
					count(if(qphong.step=1 or qphong.step=2,1,NULL)) qphong_12,
					count(if(qphong.step=3,1,NULL)) qphong_3, 
					count(if(qphong.step=4 or qphong.step=5,1,NULL)) qphong_45, 
					count(if(nc.id_loaitrinhdo=-1,1,NULL)) khac
				
					from nhucaudaotao nc
					left join cla_sca_code td on nc.id_loaitrinhdo = td.tosc_code and td.tosc_code=2 and nc.id_trinhdo=td.`code`
					left join cla_sca_code ctri on nc.id_loaitrinhdo=ctri.tosc_code and ctri.tosc_code=3 and nc.id_trinhdo =ctri.`code`
					left join cla_sca_code qphong on nc.id_loaitrinhdo=qphong.tosc_code and qphong.tosc_code=17 and nc.id_trinhdo =qphong.`code`
					left join cla_sca_code tinhoc on nc.id_loaitrinhdo=tinhoc.tosc_code and tinhoc.tosc_code=7  and nc.id_trinhdo =tinhoc.`code`
					left join cla_sca_code qlnn on nc.id_loaitrinhdo=qlnn.tosc_code and qlnn.tosc_code=5 and nc.id_trinhdo=qlnn.`code`
					left join cla_sca_code tienganh on nc.id_loaitrinhdo=tienganh.tosc_code and tienganh.ls_code=340646 and tienganh.tosc_code=6 and nc.id_trinhdo=tienganh.`code`
					left join cla_sca_code nnkhac on nc.id_trinhdo=nnkhac.`code` and nc.id_loaitrinhdo= nnkhac.tosc_code and nc.name_trinhdo=nnkhac.`name` and nnkhac.ls_code!=340646 and nnkhac.tosc_code=6
					left join hosochinh b on nc.empid=b.id 
					left join hosochinh_quatrinhhientai c on b.id = c.hosochinh_id and c.hoso_trangthai = "00"
					right JOIN (
					-- tính tổng các node con thành phần
					  SELECT node.id FROM ins_dept AS node, ins_dept AS parent
					  WHERE node.lft BETWEEN parent.lft AND parent.rgt AND parent.id = '.$donvi_id.'
					  ) AS dvbc ON b.inst_code = dvbc.id
					where nc.trangthai = 0 ';
		if($tungay!="" || $tungay != null) $query .='and nc.ngaydangky >=  STR_TO_DATE("'.$tungay.'","%d/%m/%Y")';
		if($denngay!="" || $denngay != null) $query .='and nc.ngaydangky <= STR_TO_DATE("'.$denngay.'","%d/%m/%Y")';
		$db->setQuery($query);
		return $db->loadRowList();
	}
}