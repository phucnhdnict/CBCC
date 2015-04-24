<?php
defined('_JEXEC') or die( 'Restricted access' );
class Thongke_Model_Bcdaotaoboiduong extends JModelLegacy{
	function __construct() {
		parent::__construct ();
		global $mainframe;
		$mainframe = JFactory::getApplication ();
	}
	function hienthiBaocao($donvi_id, $target, $condition,$tungay, $denngay){
		if($target==1){
				if ($condition == 1) {$chucvu='11012,11016';}
				elseif ($condition == 2) {$chucvu='11020,11024';}
				elseif ($condition == 3) {$chucvu='11111,11114';}
				elseif ($condition == 4) {$chucvu='11028,11032,11120,11117';}
				$json = $this->countBaocao($donvi_id,null ,$tungay,$denngay,  "INNER JOIN quatrinhcongtac ct ON hv.hocvien_id = ct.emp_id_ct AND ct.pos_sys_fk IN($chucvu) AND lh.ngaybatdau >= ct.start_date_ct AND (lh.ngaybatdau <= ct.end_date_ct OR ct.end_date_ct IS NULL)");
		}elseif ($target==2){
				if ($condition==1) $con_luong='01001';
				elseif ($condition==2) $con_luong='01002';
				elseif ($condition==3) $con_luong='01003';
				elseif ($condition==4) $con_luong='01004';
				$json = $this->countBaocao($donvi_id,null ,$tungay,$denngay,  "INNER JOIN quatrinhluong sal ON hv.hocvien_id = sal.emp_id_sal  AND sal.sta_code_sal = $con_luong AND lh.ngaybatdau >= sal.start_date_sal AND (lh.ngaybatdau <= sal.end_date_sal OR sal.end_date_sal IS NULL)");
		}elseif ($target ==4){
				if ($condition==1) $con_daibieu=' and b.elec_prov = 1';
				elseif($condition==2) $con_daibieu='and b.elec_dist = 1';
				elseif($condition==3) $con_daibieu='and b.elec_comm = 1';
				$json = $this->countBaocao($donvi_id, $con_daibieu, $tungay, $denngay);
		}elseif($target==5 || $target==6){
				if ($condition==1) $con_px='canbopx';
				elseif($condition==2) $con_px='congchucpx';
				elseif($condition==3) $con_px='kctpx';
				$json = $this->countBaocao($donvi_id, null,$tungay,$denngay,"INNER JOIN quatrinhcongtac ct ON hv.hocvien_id = ct.emp_id_ct AND lh.ngaybatdau >= ct.start_date_ct AND (lh.ngaybatdau <= ct.end_date_ct OR ct.end_date_ct IS NULL) AND ct.pos_sys_fk IN(select relation_id from config_bc where report_group_code like '$con_px')");
	}elseif($target==0)
				$json = $this->countBaocao($donvi_id,'',$tungay,$denngay);
		return $json;									
	}
	/**
	 * Tính báo cáo đào tạo bồi dưỡng cán bộ, công chức
	 * @param int $donvi_id
	 * @param string $where
	 * @param string $tungay
	 * @param string $denngay
	 * @param string $join
	 * @return Ambigous <mixed, NULL>
	 */
	function countBaocao($donvi_id, $where=null, $tungay=null, $denngay=null, $join=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query="SELECT
		 count(IF(b.sex = 'Nu', 1, NULL)) nu,
		 count(IF(b.nat_code != 11, 1, NULL)) thieuso,
		 count(b.id) tongso,
		 -- lý luận chính trị
		 count(IF(ctri.step = 3, 1, NULL))caocap_ctri,
		 count(IF(ctri.step = 4, 1, NULL))trungcap_ctri,
		 count(IF(ctri.step = 5, 1, NULL))socap_ctri,
		 count(IF(ctri.step < 3, 1, NULL))cunhan_ctri,
		 -- count(IF(ctri.step = 5 OR ctri.step = 2 OR ctri.step = 3 OR ctri.step = 4 OR ctri.step = 1 OR ctri.step = 0, 1, NULL ))tong_ctri,
		 -- quản lý nhà nước
		 count(IF(qlnn.step = 0, 1, NULL))qlnn_cvcc,
		 count(IF(qlnn.step = 1, 1, NULL))qlnn_cvc,
		 count(IF(qlnn.step = 2, 1, NULL))qlnn_cv,
		 count(IF(qlnn.step = NULL, 1, NULL))qlnn_cansu,
		 -- Chuyên môn
		 count(IF(td.step = 1, 1, NULL))cm_tiensi,
		 count(IF(td.step = 2, 1, NULL))cm_thacsi,
		 count(IF(td.step = 3, 1, NULL))cm_daihoc,
		 count(IF(td.step = 4, 1, NULL))cm_caodang,
		 count(IF(td.step = 5, 1, NULL))cm_trungcap,
		 count(IF(td.step >= 6, 1, NULL))cm_socap,
		 -- tin học
		 -- count(IF(tinhoc.step <= 2, 1, NULL))trendaihoc_tinhoc,
		 -- count(IF(tinhoc.step = 3 OR tinhoc.step = 4, 1,NULL))tccd_tinhoc,
		 -- count(IF(tinhoc.step > 4, 1, NULL))coso_tinhoc,
		 count(IF(tinhoc.step >= 0, 1, NULL))tong_tinhoc,
		 -- tiếng anh
		 -- count(IF(tienganh.step < 3, 1, NULL))trendaihoc_tienganh,
		 -- count(IF(tienganh.step = 3 OR tienganh.step = 4,1, NULL))tccd_tienganh,
		 -- count(IF(tienganh.step = 5, 1, NULL))coso_tienganh,
		 -- count(IF(tienganh.step >= 0, 1, NULL))tong_tienganh,
		 -- count(IF(nnkhac.step < 3, 1, NULL))trendaihoc_nnkhac,
		 -- count(IF(nnkhac.step = 3 OR nnkhac.step = 4, 1, NULL ) )tccd_nnkhac,
		 -- count(IF(nnkhac.step = 5, 1, NULL))coso_nnkhac,
		 -- count(IF(nnkhac.step >= 0, 1, NULL))tong_nnkhac,
		 count(IF(ngoaingu.step >= 0, 1, NULL))tong_ngoaingu,
		 -- quốc phòng an ninh
		--  count(IF(qphong.step = 1 OR qphong.step = 2,1,NULL))qphong_12,
		 -- count(IF(qphong.step = 3, 1, NULL))qphong_3,
		 -- count(IF(qphong.step = 4 OR qphong.step = 5,1,NULL))qphong_45,
		 count(IF(qphong.step > 0, 1, NULL))qphong_tong,
		 -- bồi dưỡng 
		 count(IF(boiduong.step = 1, 1, NULL))quanly,
		 count(IF(boiduong.step = 2, 1, NULL))chuyenmon,
		 count(IF(boiduong.step = 3, 1, NULL))tiengdantoc,
		 count(IF(boiduong.step = 4, 1, NULL))khac 
		FROM
		 daotao_lophoc lh
		INNER JOIN daotao_lophoc_hocvien hv ON lh.id = hv.lophoc_id
		INNER JOIN hosochinh b ON hv.hocvien_id = b.id
		INNER JOIN hosochinh_quatrinhhientai c ON hv.hocvien_id = c.hosochinh_id
		$join
		INNER JOIN ins_dept dv ON hv.donvi_id = dv.id
		AND dv.lft BETWEEN
		(SELECT lft FROM ins_dept WHERE id = $donvi_id)
		AND (SELECT rgt FROM ins_dept WHERE id = $donvi_id)
		LEFT JOIN cla_sca_code tinhoc ON lh.loaitrinhdo_id = tinhoc.tosc_code
		AND tinhoc.tosc_code = 7
		AND lh.trinhdo_id = tinhoc.`code`
		LEFT JOIN cla_sca_code ctri ON lh.loaitrinhdo_id = ctri.tosc_code
		AND ctri.tosc_code = 3
		AND lh.trinhdo_id = ctri.`code`
		LEFT JOIN cla_sca_code boiduong ON lh.loaitrinhdo_id = boiduong.tosc_code
		AND boiduong.tosc_code = 18
		AND lh.trinhdo_id = boiduong.`code`
		LEFT JOIN cla_sca_code td ON lh.loaitrinhdo_id = td.tosc_code
		AND td.tosc_code = 2
		AND lh.trinhdo_id = td.`code`
		-- LEFT JOIN cla_sca_code nnkhac ON lh.trinhdo_id = nnkhac.`code`
		-- AND lh.loaitrinhdo_id = nnkhac.tosc_code
		-- AND nnkhac.ls_code != 340646
		-- AND nnkhac.tosc_code = 6
		LEFT JOIN cla_sca_code qphong ON lh.loaitrinhdo_id = qphong.tosc_code
		AND qphong.tosc_code = 17
		AND lh.trinhdo_id = qphong.`code`
		LEFT JOIN cla_sca_code qlnn ON lh.loaitrinhdo_id = qlnn.tosc_code
		AND qlnn.tosc_code = 5
		AND lh.trinhdo_id = qlnn.`code`
		-- LEFT JOIN cla_sca_code tienganh ON lh.loaitrinhdo_id = tienganh.tosc_code
		-- AND tienganh.ls_code = 340646
		-- AND tienganh.tosc_code = 6
		-- AND lh.trinhdo_id = tienganh.`code`
		LEFT JOIN cla_sca_code ngoaingu ON lh.loaitrinhdo_id = ngoaingu.tosc_code
		AND ngoaingu.tosc_code = 6
		AND lh.trinhdo_id = ngoaingu.`code`
  		WHERE lh.status = 3
		AND lh.ngaybatdau >= STR_TO_DATE('$tungay', '%d/%m/%Y')
		AND lh.ngayketthuc <= STR_TO_DATE('$denngay', '%d/%m/%Y')";
		if($where!="" || $where!=null) $query .= $where;
// 		$donviloaitru = Core::getUnManageDonvi(JFactory::getUser()->id, 'com_thongke', 'treeview' ,'treebcdaotaoboiduong');
		$donviloaitru = $this->getUnManageDonvi(JFactory::getUser()->id, 'com_thongke', 'treeview' ,'treebcdaotaoboiduong');
		if($donviloaitru!='')
			$query.=' and (dv.id NOT IN ('.$donviloaitru.') AND c.congtac_phong_id NOT IN ('.$donviloaitru.'))';
// 		echo $query;exit;
		$db->setQuery($query);
		return $db->loadObject();
	}
	/**
	 * Hàm lấy thông tin bảng, dựa theo các field, table, table join, where và order
	 * @param array $field
	 * @param string $table
	 * @param array $arrJoin
	 * @param array $where
	 * @param string $order
	 * @return Ambigous <mixed, NULL, multitype:unknown mixed >
	 */
	function getThongtin($field, $table, $arrJoin=null, $where=null, $order=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($field)
		->from($table);
		if (count($arrJoin)>0)
			foreach ($arrJoin as $key=>$val){
				$query->join($key, $val);
			}
		for($i=0;$i<count($where);$i++)
			if ($where[$i]!='')
				$query->where($where);
		if($order!=null) $query->order($order);
		$db->setQuery($query);
		return $db->loadObjectList();
	}
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
}