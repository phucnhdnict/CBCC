<?php
/**
 * Author: Phucnh
 * Date created: Apr 25, 2015
 * Company: DNICT
 * Dự thảo
 */
defined('_JEXEC') or die( 'Restricted access' );
class Thongke_Model_Duthao extends JModelLegacy{
	function __construct() {
		parent::__construct ();
		global $mainframe;
		$mainframe = JFactory::getApplication ();
	}
	public function xuatduthao($idHoso, $select, $join = null, $where = null){
		$db	=	JFactory::getDbo();
		$query = $db->getQuery(true);
		$query = "select $select
		from hosochinh_quatrinhhientai hs
		$join
		WHERE hs.hosochinh_id = $idHoso
		$where";
// 		echo $query;exit;
		$db->setQuery($query);
		return $db->loadObject();
	}
	public function duthao($idHoso, $type){
		if ($type =='nltx' || $type == 'nltth') 
			$data = $this->xuatduthao($idHoso, 
										"`hs`.`hosochinh_id` AS `hosochinh_id`,
										`hs`.`hoten` AS `hoten`,
										`hs`.`gioitinh` AS gioitinh,
										`hs`.`luong_tenngach` AS `luong_tenngach`,
										`hs`.`luong_mangach` AS `luong_mangach`,
										`hs`.`luong_bac` AS `luong_bac_cu`,
										`hs`.`luong_heso` AS `luong_heso_cu`,
										IF((`hs`.`luong_vuotkhung` = 0),'',`hs`.`luong_vuotkhung`)AS `luong_vuotkhung_cu`,
										`hs`.`luong_ngaybatdau` AS `thoidiemhuong`,
										`hs`.`luong_ngaynangluongtieptheo`AS `thoidiemnangluong`,
										IF((`hs`.`luong_bac` = `c`.`baccuoi`),`hs`.`luong_bac`,(`hs`.`luong_bac` + 1))AS `bac_moi`,
										format(IF((`hs`.`luong_bac` = `c`.`baccuoi`),`hs`.`luong_heso`,(`hs`.`luong_heso` +((`c`.`hesocuoi` - `c`.`hesodau`)/(`c`.`baccuoi` - `c`.`bacdau`)))),2)AS `heso_moi`,
										IF((`hs`.`luong_bac` = `c`.`baccuoi`),IF((`hs`.`luong_vuotkhung` > 0),(`hs`.`luong_vuotkhung` + 1),5),NULL)AS `vk_moi`,
										dvcq.name as donvichuquan,
										dv.ins_loaihinh, 
										dv.`name` as congtac_donvi, 
										hs.bienche_hinhthuc_id as bienche_hinhthuc_id", 
										"LEFT JOIN `cb_bac_heso` `b` ON `b`.`mangach` = `hs`.`luong_mangach`
										LEFT JOIN `cb_nhomngach` `c` ON `c`.`id` = `b`.`manhom`
										LEFT JOIN `whois_sal_mgr` `d` ON `d`.`id` = `hs`.`luong_hinhthuc_id`
										LEFT JOIN ins_dept dv ON dv.id = hs.congtac_donvi_id
										LEFT JOIN ins_dept dvcq ON dv.ins_created = dvcq.id", 
										"AND `hs`.`hoso_trangthai` = '00'
							 			 AND `d`.`is_nangluonglansau` = 1"
					);
		elseif ($type =='dd' || $type == 'bn' || $type == 'bnvnvc' || $type == 'cxnl')
			$data = $this->xuatduthao($idHoso, 
					"dvcq.name as donvichuquan, hsc.birth_place, hs.luong_bac, hs.luong_heso,
					 hs.luong_ngaybatdau, hs.chuyenmon_chuyennganh, hs.luong_tenngach, 
					hs.luong_mangach, hs.ngaysinh, hs.hoten, hs.gioitinh, hs.congtac_chucvu as congtac_chucvu, 
					dv.name as congtac_donvi, dv.ins_loaihinh", 
					"INNER JOIN hosochinh hsc on hsc.id = hs.hosochinh_id
					LEFT JOIN ins_dept dv on dv.id = hs.congtac_donvi_id 
					LEFT JOIN ins_dept dvcq ON dv.ins_created = dvcq.id", 
					null);
		return $data;
	}
}