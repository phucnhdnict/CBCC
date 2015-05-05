<?php
defined('_JEXEC') or die( 'Restricted access' );
class Thongke_Model_Thongke extends JModelLegacy{
	function __construct() {
		parent::__construct ();
		global $mainframe;
		$mainframe = JFactory::getApplication ();
	}
// 	select
// 	-- tin học
// 	count(if(tinhoc.step<=2,1,NULL)) trendaihoc_tinhoc,
// 	count(if(tinhoc.step=3 or tinhoc.step=4,1,NULL)) tccd_tinhoc,
// 	count(if(tinhoc.step>4 ,1,NULL)) coso_tinhoc,
// 	count(if(tinhoc.step>=0,1,NULL)) TONG_TINHOC,
// 	-- lý luận chính trị
// 	count(if(ctri.step<3,1,NULL)) cunhan_ctri,
// 	count(if(ctri.step=3,1,NULL)) caocap_ctri,
// 	count(if(ctri.step>=4,1,NULL)) trungcap_ctri,
// 	count(if(ctri.step=5 or ctri.step=2 or ctri.step=3 or ctri.step=4 or ctri.step=1 or ctri.step=0 ,1,NULL)) tong_ctri					,
// 	count(if(b.nat_code=11,1,NULL)) thieuso,
// 	count(if(b.sex = 'Nu',1,NULL)) nu
// 	from daotao_lophoc_hocvien hv
	
// 	left join daotao_lophoc lh on hv.lophoc_id = lh.id
// 	-- 					left JOIN daotao_lophoc_donvi dv on dv.lophoc_id = lh.id
// 	left join cla_sca_code tinhoc on lh.loaitrinhdo_id=tinhoc.tosc_code and tinhoc.tosc_code=7  and lh.trinhdo_id =tinhoc.`code`
// 	left join cla_sca_code ctri on lh.loaitrinhdo_id=ctri.tosc_code and ctri.tosc_code=3 and lh.trinhdo_id =ctri.`code`
// 	left join hosochinh b on hv.hocvien_id=b.id
// 	left join hosochinh_quatrinhhientai c on b.id = c.hosochinh_id and c.hoso_trangthai = "00"
// 			right JOIN (
// 					-- tính tổng các node con thành phần
// 					SELECT distinct(node.id) FROM ins_dept AS node, ins_dept AS parent
// 					WHERE node.lft BETWEEN parent.lft AND parent.rgt AND  parent.id = 150746 and
// 					if (parent.id=node.parent_id, node.id = 150746, parent.id = 150746)
// 		) AS dvbc ON (b.inst_code = dvbc.id or b.dept_code = dvbc.id)
// 		where lh.`status` > 0  and b.elec_prov=1
	function exportWord_2c($hosochinh_id){
		$data['canhan'] = $this->getCanhan($hosochinh_id);
		$data['qtdtao'] = $this->getThongtin(array('qtdtao.place_dt', 'qtdtao.lim_name_dt', 'qtdtao.start_date_dt', 'qtdtao.end_date_dt', 'edu.name as hinhthuc', 'loaitd.name as loaitrinhdo','trinhdo.name as trinhdo'), 'quatrinhdaotao qtdtao', array('left'=>'edu_form edu ON edu.id=qtdtao.formality_dt', 'inner'=>'type_sca_code loaitd ON loaitd.code = qtdtao.tosc_code_dt', 'left  '=>'cla_sca_code trinhdo ON trinhdo.code = qtdtao.sca_code_dt and trinhdo.tosc_code=qtdtao.tosc_code_dt'), ' qtdtao.emp_id_dt = '.$hosochinh_id, 'qtdtao.end_date_dt asc');
		$data['3quatrinhcongtac'] = $this->get3Quatrinhcongtac($hosochinh_id);
		$data['qtluong'] = $this->getThongtin(array('start_date_sal', 'sta_code_sal','end_date_sal', 'sl_code_sal', 'coef_sal', 'sta_name_sal'), 'quatrinhluong', null , array('emp_id_sal='.$hosochinh_id), 'start_date_sal asc');
		return $data;
	}
	/**
	 * get thông tin các hồ
	 * @param unknown $hosochinh_id
	 */
	function get3Quatrinhcongtac($hosochinh_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query = "select pos_name_ct as chucdanh ,dept_name as donvicongtac ,start_date_ct as ngaybatdau, end_date_ct as ngayketthuc, 'qtct' 
		from quatrinhcongtac where emp_id_ct=$hosochinh_id
				union
				select ppc.name as chucdanh, dvd.name as donvicongtac ,ctd.start_date_ctd, ctd.end_date_ctd, 'qtd' from quatrinhcongtacdang ctd
				join party_pos_code as ppc on ppc.code = ctd.party_pos_code
				join ctd_donvidang as dvd on dvd.id = ctd.donvidang_id
				where emp_id_ctd=$hosochinh_id
				union
				select nn.noidung_ctnn, coun.name as donvicongtac, nn.start_date_ctnn, nn.end_date_ctnn, 'qtnn' from quatrinhcongtacnuocngoai nn
				join country_code coun on coun.`code`= nn.quocgia_ctnn
				where emp_id_ctnn= $hosochinh_id order by ngaybatdau asc, ngayketthuc asc";
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	function getCanhan($hoso_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query = 'select hsc.e_name, sex.name as sex, hsc.birth_date, hsc.is_only_year, hsc.birth_place, hsc.e_code, 
					-- quê/nguyên quán
					hsc.cadc_code as macity, qq_city.`name` as qq_tt, qq_dist.`name` as qq_qh, qq_comm.`name` as qq_px, nguyenquan_khac, 
					nat.name as dantoc, rel.name as tongiao, 
					-- hộ khẩu thường trú
					hktt_city.`name` as tt_tt, hktt_dist.name as tt_qh, hktt_comm.`name` as tt_px,
					-- chỗ ở hiện nay
					hsc.per_residence as per_residence,
					-- nghề nghiệp khi được tuyển dụng, ngày tuyển dunjgm cơ quan tuyển dụng
					hsc.work_expe , hsht.congtac_ngayvaocoquanhiennay, hsht.congtac_donvi,
					-- bậc, hệ số, ngày hưởng, phụ cấp, phụ cấp khác
					hsht.luong_bac, hsht.luong_ngaybatdau, hsht.congtac_chucvu, hsht.luong_mangach, hsht.luong_tenngach, hsht.luong_heso,
					hsc.party_date, hsc.party_j_date, hsc.cyu_date, hsc.mil_date, hsc.exp_mil_date,
					hsc.hea_wei , hsc.hea_hig, hea.name as hea_fk, blood.name as blood_type,
				hsht.khenthuong_hinhthuc, hsht.khenthuong_ngayquyetdinh, hsht.kyluat_hinhthuc, hsht.kyluat_ngayquyetdinh,
				hsc.id_card,hsc.id_card_date, hsc.maso_bhxh, rank.name as quanham,
				-- danh hiệu phong tặng
				awa.name as ac_name, abi.name as ability_name, inv.name as inv_fk, ousc.name as ousc_code,
				-- trình độ chuyên môn
				tdllct.name as tdllct_name,tdcm.name as tdcm_name,tdqlnn.name as tdqlnn_name,tdnn.name as tdnn_name,tdth.name as tdth_name,
				hsht.luong_phucap_chucvu
					from hosochinh hsc
				join hosochinh_quatrinhhientai as hsht on hsc.id = hsht.hosochinh_id
				inner join city_code 	qq_city 		on qq_city.code = hsc.cadc_code
				left join cla_sca_code 	tdcm 		on tdcm.code = hsht.chuyenmon_trinhdo_code and tdcm.tosc_code = 2
				left join cla_sca_code 	tdllct 		on tdllct.code = hsht.nghiepvu_lyluanchinhtri_code and tdllct.tosc_code = 3
				left join cla_sca_code 	tdqlnn 		on tdqlnn.code = hsht.nghiepvu_quanlynhanuoc_code and tdqlnn.tosc_code = 5
				left join cla_sca_code 	tdnn 		on tdnn.code = hsht.nghiepvu_ngoaingu_anh_code and tdnn.tosc_code = 6
				left join cla_sca_code 	tdth 		on tdth.code = hsht.nghiepvu_tinhoc_code and tdth.tosc_code = 7
				left join dist_code 	qq_dist 	on qq_dist.code = hsc.dist_placebirth
				left join comm_code 	qq_comm 	on qq_comm.code = hsc.comm_placebirth
				left join city_code 	hktt_city 	on hktt_city.code = hsc.city_peraddress
				left join dist_code 	hktt_dist	on hktt_dist.code = hsc.dist_peraddress
				left join comm_code 	hktt_comm 	on hktt_comm.code = hsc.comm_peraddress
				left join nat_code 		nat 		on nat.id = hsc.nat_code
				left join sex_code 		sex 		on sex.id = hsc.sex
				left join rel_code 		rel 		on rel.id = hsc.nat_code
				left join hea_code 		hea 		on hea.id = hsc.hea_fk
				left join blood_code 	blood		on blood.id = hsc.blood_type
				left join rank_code		rank		on rank.id = hsc.rank_pos_fk
				left join awa_code 		awa			on awa.id = hsc.ac_code 
				left join ability_code 	abi			on abi.id = hsc.ability
				left join inv_code 		inv			on inv.id = hsc.inv_fk
				left join ous_code 		ousc		on ousc.id = hsc.ousc_code
				where hsc.id='.$hoso_id;
		$db->setQuery($query);
		return $db->loadObject();
	}
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
		if($order!=null)$query->order($order);
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	
	public function getCCtsbnn($donvi_id, $tapsu_id, $bienche_id){
	$str_bienche_id = implode(',', $bienche_id);
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query= 'select distinct(hsc.id), hsc.e_name,
			qtbienche_first.ngaybatdau as ngaytapsu,
			qtbienche_second.ngaybatdau ngaybonhiemngach, 
			qthientai.ngaysinh, qthientai.danhdaunamsinh, 
			qthientai.luong_tenngach, qthientai.luong_bac, qthientai.luong_heso, 
			qthientai.congtac_chucvu, qthientai.congtac_phong_id, ins.name congtac_phong   
			from hosochinh hsc
			join bc_quatrinhbienche qtbienche_first on qtbienche_first.emp_id_bc = hsc.id
			join bc_quatrinhbienche qtbienche_second on qtbienche_second.emp_id_bc = hsc.id
			join hosochinh_quatrinhhientai  qthientai on qthientai.hosochinh_id= hsc.id 
			left join ins_dept ins on qthientai.congtac_phong_id = ins.id
			where
			(hsc.dept_code ='.$donvi_id.' or hsc.inst_code ='.$donvi_id.')
					AND qtbienche_second.ngaybatdau >= qtbienche_first.ngaybatdau
				AND qtbienche_first.hinhthuc_id='.$tapsu_id.'
						and qtbienche_second.hinhthuc_id in ('.$str_bienche_id.')
						and qtbienche_second.id = ( 
								-- lấy ra id của hình thức ngay sau hình thức tập sự
					select id from bc_quatrinhbienche c
					where c.emp_id_bc= hsc.id
					AND c.ngaybatdau>= qtbienche_first.ngaybatdau
					order by (c.hinhthuc_id='.$tapsu_id.') desc ,c.ngaybatdau asc
					limit 1,1
					)';
		$db->setQuery($query);
			return $db->loadObjectList();
	}
}