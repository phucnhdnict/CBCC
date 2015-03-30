<?php 
/**
 * Author: Phucnh
 * Date created: Mar 19, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
$model	=	Core::model('Hoso/Import');
$thongtinImportCanxem = $this->thongtinImportCanxem;
?>
<form id="frmHosoImport" method="post">
<h4 class="header lighter blue">Hồ sơ cán bộ: <?php echo $thongtinImportCanxem->hoten;?>
<span class="pull-right inline">
	<button type="submit" class="btn btn-mini btn-success"><i class="icon-save"></i> Lưu và quay lại</button>
	<span class="btn btn-mini btn_quaylai btn-warning">
		<i class="icon-mail-reply"></i> Quay lại
	</span>
	<span class="btn btn-mini btn_huyimport btn-danger">
		<i class="icon-trash"></i> Hủy hồ sơ
	</span>
</span>
<script>
jQuery('body').delegate('.btn_quaylai', 'click', function(){
	jQuery.blockUI();
	window.location.replace('/index.php?option=com_hoso&controller=import&task=importhoso');
//		$('#danhsachimport').css("display","");
//		$('#divimport').css("display","");
//		$('#div_xemchitiet').html("");
});
</script>
</h4>
     <div role="tabpanel">
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#thongtinchung" aria-controls="home" role="tab" data-toggle="tab" title="Thông tin chung">Thông tin chung</a></li>
		    <li role="presentation"><a href="#bienchehopdong" aria-controls="profile" role="tab" data-toggle="tab">Biên chế; Chức vụ; Ngạch, bậc</a></li>
		    <li role="presentation"><a href="#trinhdodaotao" aria-controls="messages" role="tab" data-toggle="tab">Trình độ, đào tạo</a></li>
		    <li role="presentation"><a href="#thongtindangvien" aria-controls="settings" role="tab" data-toggle="tab">Thông tin Đảng viên</a></li>
		  </ul>
		  <!-- Tab panes -->
		  <div class="tab-content">
		  	<div role="tabpanel" class="tab-pane active" id="thongtinchung">
				<h3 class="header smaller lighter blue">Thông tin chung</h3>
				<div class="span4">
					<div class="control-group">
						<label for="hoten" class="control-label">Họ tên (<span style="color: red">*</span>)
						</label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="<?php echo $thongtinImportCanxem->hoten;?>" id="hoten" name="hoten" class="input-medium required">
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="birth_date" class="control-label">Ngày sinh (<span style="color: red">*</span>)
						</label>
						<div class="controls">
							<input type="checkbox" <?php if ($thongtinImportCanxem->danhdaunamsinh == 1) echo 'checked="checked"';?>" name="danhdaunamsinh" id="danhdaunamsinh"> 
							<span class="lbl"> Chỉ nhập năm sinh</span>
							<div class="row-fluid" id="div_birth_date">
								<?php if ($thongtinImportCanxem->danhdaunamsinh == 0){?>
									<input type="text" id="birth_date" name="birth_date" value="<?php echo date('d/m/Y', strtotime($thongtinImportCanxem->ngaysinh));?>" autocomplete="off" class="input-medium date-picker required"> 
									<span class="add-on"> <i class="icon-calendar"></i></span>
								<?php } else {?>
								<input type="text" class="input-medium required"  id="birth_date" value="<?php echo date('Y', strtotime($thongtinImportCanxem->ngaysinh));?>" autocomplete="off" name="birth_date">
								<?php }?>
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="gioitinh" class="control-label">Giới tính (<span style="color: red">*</span>)
						</label>
						<div class="controls">
							<div class="row-fluid">
								<?php echo $model->getCbo('sex_code', 'id, name', 'status = 1', 'name asc', '--Chọn Giới tính--', 'id', 'name', $thongtinImportCanxem->gioitinh, 'gioitinh', 'chosen');?>
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="nat_code" class="control-label">Dân tộc (<span
							style="color: red">*</span>)
						</label>
						<div class="controls">
							<div class="row-fluid">
								<?php echo $model->getCbo('nat_code', 'id, name', 'status = 1', 'name asc', '--Chọn Dân tộc--', 'id', 'name', $thongtinImportCanxem->nat_code, 'nat_code', 'chosen');?>
							</div>
						</div>
					</div>
				</div>
				<div class="span8">
					<div class="control-group valid">
						<label for="per_residence" class="control-label">Địa chỉ thường trú (<span style="color: red">*</span>)
						</label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="<?php echo $thongtinImportCanxem->per_residence?>" name="per_residence" id="per_residence" class="input-xxlarge required">
							</div>
						</div>
					</div>
				</div>
				<div class="span8">
					<div class="control-group">
						<label for="div_comm_placebirth" class="control-label">Nguyên quán (<span style="color: red">*</span>)
						</label>
						<div class="controls">
							<div class="row-fluid">
								<div id="div_cadc_code" style="float:left; width:30%"><?php echo $model->getCboCityPer($thongtinImportCanxem->cadc_code,'cadc_code');?></div>
								<div id="div_dist_placebirth" style="float:left; width:30%"><?php echo $model->getCboDistPer($thongtinImportCanxem->cadc_code,$thongtinImportCanxem->dist_placebirth,'dist_placebirth');?></div>
								<div id="div_comm_placebirth" style="float:left; width:30%"><?php echo $model->getCboCommPer($thongtinImportCanxem->dist_placebirth,$thongtinImportCanxem->comm_placebirth,'comm_placebirth');?></div>
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="phone_work" class="control-label">Điện thoại cơ quan</label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="<?php echo $thongtinImportCanxem->phone_work?>" name="phone_work" id="phone_work" class="input-medium">
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="mobile" class="control-label">Điện thoại di động</label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="<?php echo $thongtinImportCanxem->mobile?>" name="mobile" id="mobile" class="input-medium">
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="maso_bhxh" class="control-label">Mã số BHXH</label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="<?php echo $thongtinImportCanxem->maso_bhxh?>" id="maso_bhxh" name="maso_bhxh" class="input-medium">
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="maso_thue" class="control-label">Mã số thuế</label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="<?php echo $thongtinImportCanxem->maso_thue?>" id="maso_thue" name="maso_thue" class="input-medium">
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="email" class="control-label">Email</label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="<?php echo $thongtinImportCanxem->email;?>" name="email" id="email" class="input-medium">
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="yim" class="control-label">YIM</label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="<?php echo $thongtinImportCanxem->yim;?>" name="yim" id="yim" class="input-medium">
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group valid">
						<label for="married_fk" class="control-label">Tình trạng hôn nhân (<span style="color: red">*</span>)
						</label>
						<div class="controls">
							<div class="row-fluid">
							<?php echo $model->getCbo('maried_code', 'id, name', 'status = 1', 'name asc', '--Chọn Tình trạng hôn nhân--', 'id', 'name', $thongtinImportCanxem->married_fk, 'married_fk', 'chosen');?>
							</div>
						</div>
					</div>
				</div>
				<div class="span8">
					<div class="control-group">
						<label for="ghichu" class="control-label">Ghi chú</label>
						<div class="controls">
							<div class="row-fluid">
								<textarea style="height: 61px;" class="input-xxlarge" id="ghichu" name="ghichu"><?php echo $thongtinImportCanxem->ghichu;?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
	
	<!-- ---------------------  LOẠI HÌNH BIÊN CHẾ, HỢP ĐỒNG ------------------------------------ -->
	<?php $arrThongtinbienche = $model->listData('bc_hinhthuc',
 				 array('id','name','loaihinh_id','is_thietlapthoihan','is_hinhthuctuyendung','text_ngaybatdau','text_ngayketthuc','text_soquyetdinh','text_coquanraquyetdinh','text_ngaybanhanh','valid_ngaybatdau','valid_ngayketthuc','valid_soquyetdinh','valid_coquanraquyetdinh','valid_ngaybanhanh'),
 				array('id = '.$thongtinImportCanxem->bienche_hinhthuc_id,' status=1'), '');
			?>
	<div role="tabpanel" class="tab-pane" id="bienchehopdong" style="overflow: visible; min-height:1000px;">
		<h3 class="header smaller lighter blue">Loại biên chế, hợp đồng</h3>
		<div class="span4">
			<div class="control-group">
				<label class="control-label" for="bienche_hinhthuc_id">Loại hình biên chế, HĐ (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div class="row-fluid" id="div_bienche_hinhthuc_id" style="width:70%">
							<!-- combobox biên chế -->
					</div>
				</div>
			</div>
		</div>
		<div id="div_bienche_hinhthuc_chitiet">
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="bienche_ngaybatdau"> Ngày bắt đầu <?php if($arrThongtinbienche[0]->valid_ngaybatdau=='required'){?>(<span style="color:red;">*</span>)<?php }?></label>
					<div class="controls">
						<div class="row-fluid">
								<input id="bienche_ngaybatdau" name="bienche_ngaybatdau" autocomplete="off" value="<?php echo date('d/m/Y',strtotime($thongtinImportCanxem->bienche_ngaybatdau));?>" class="input-medium date-picker <?php echo $arrThongtinbienche[0]->valid_ngaybatdau?>">
								<span class="add-on"> <i class="icon-calendar"></i></span>
						</div>
					</div>
				</div>
			</div>
			<?php if($arrThongtinbienche[0]->is_hinhthuctuyendung == 1){?>
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="id_hinhthuctuyendung">Hình thức tuyển dụng (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div class="row-fluid" id="div_id_hinhthuctuyendung" style="width:70%">
						<?php 
							echo $model->getcbo('bc_hinhthuctuyendung a, bc_hinhthuc_hinhthuctuyendung b, bc_hinhthuc c',
								'a.id, a.name',' a.id= b.hinhthuctuyendung_id and b.hinhthuc_id=c.id and a.`status`=1 and c.id='.$thongtinImportCanxem->bienche_hinhthuc_id,
								'a.name asc',
								'--Chọn Hình thức tuyển dụng--',
								'id', 'name', $thongtinImportCanxem->bienche_hinhthuctuyendung_id, 'bienche_hinhthuctuyendung_id', 'chosen required');?>
						</div>
					</div>
				</div>
			</div>
			<?php }
			if ($arrThongtinbienche[0]->is_thietlapthoihan==1){?>
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="id_thietlapthoihan">Thời hạn (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div class="row-fluid" id="div_id_thietlapthoihan" style="width:70%">
						<?php 
							echo $model->getcbo('bc_hinhthuc a, bc_hinhthuc_thoihan b, bc_thoihanbienchehopdong c',
								'c.id as id, c.name as name, c.month as month',' a.id=b.hinhthuc_id and c.id=b.thoihan_id and c.`status`=1 and a.id='.$thongtinImportCanxem->bienche_hinhthuc_id,
								'id asc',
								'--Chọn Thời hạn--',
								'id', 'name', $thongtinImportCanxem->bienche_thoihanbienchehopdong_id, 'bienche_thoihanbienchehopdong_id', 'chosen required', array('month'=>'month'));
								?>
						</div>
					</div>
				</div>
			</div>
			<?php }?>
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="bienche_ngayketthuc">Ngày kết thúc <?php if($arrThongtinbienche[0]->valid_ngayketthuc=='required'){?>(<span style="color:red;">*</span>)<?php }?></label></label>
					<div class="controls">
						<div class="row-fluid">
								<input name="bienche_ngayketthuc" id="bienche_ngayketthuc" autocomplete="off" value="<?php if ($thongtinImportCanxem->bienche_ngayketthuc!='0000-00-00') echo date('d/m/Y',strtotime($thongtinImportCanxem->bienche_ngayketthuc));?>" class="input-medium date-picker <?php echo $arrThongtinbienche[0]->valid_ngayketthuc?>">
								<span class="add-on"> <i class="icon-calendar"></i></span>
						</div>
					</div>
				</div>
			</div>
			
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="bienche_coquanraquyetdinh">Cơ quan ra quyết định <?php if($arrThongtinbienche[0]->valid_coquanraquyetdinh=='required'){?>(<span style="color:red;">*</span>)<?php }?></label>
					<div class="controls">
						<div class="row-fluid">
								<input id="bienche_coquanraquyetdinh" name="bienche_coquanraquyetdinh" value="<?php echo $thongtinImportCanxem->bienche_coquanquyetdinh;?>" autocomplete="off" class="input-medium <?php echo $arrThongtinbienche[0]->valid_coquanraquyetdinh?>">
						</div>
					</div>
				</div>
			</div>
			
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="bienche_soquyetdinh">Số quyết định <?php if($arrThongtinbienche[0]->valid_soquyetdinh=='required'){?>(<span style="color:red;">*</span>)<?php }?></label>
					<div class="controls">
						<div class="row-fluid">
								<input id="bienche_soquyetdinh" name="bienche_soquyetdinh" value="<?php echo $thongtinImportCanxem->bienche_soquyetdinh;?>" autocomplete="off" class="input-medium <?php echo $arrThongtinbienche[0]->valid_soquyetdinh?>">
						</div>
					</div>
				</div>
			</div>
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="bienche_ngaybanhanh">Ngày ban hành <?php if($arrThongtinbienche[0]->valid_ngaybanhanh=='required'){?>(<span style="color:red;">*</span>)<?php }?></label>
					<div class="controls">
						<div class="row-fluid">
								<input id="bienche_ngaybanhanh" name="bienche_ngaybanhanh" autocomplete="off" value="<?php if ($thongtinImportCanxem->bienche_ngaybanhanh!='0000-00-00') echo date('d/m/Y',strtotime($thongtinImportCanxem->bienche_ngaybanhanh));?>" class="input-medium date-picker <?php echo $arrThongtinbienche[0]->valid_ngaybanhanh;?>">
								<span class="add-on"> <i class="icon-calendar"></i></span>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	<!-- -------------------------- Lương + ngạch  -->
		<div style="clear: both;"></div>
			<?php $arrLuong = $model->listData('whois_sal_mgr',
 				 array('id','name','is_nangluonglansau','is_nhaptien','phantramsotienhuong','is_nhapngaynangluong'),
 				array('id = '.$thongtinImportCanxem->luong_hinhthuc_id,' status=1'), '');
			?>
			<h3 class="header smaller lighter blue">Lương, ngạch, bậc</h3>
			<div class="span8">
				<div class="control-group">
					<label class="control-label" for="luong_hinhthuc_id">Hình thức hưởng lương/ ngạch (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div class="row-fluid" style="width:50%">
								<?php echo $model->getCbo('whois_sal_mgr a, cb_goihinhthuchuongluong b, cb_goihinhthuchuongluong_hinhthucnangluong c, ins_dept d',
								'a.id as id, a.name as name, a.is_nangluonglansau as is_nangluonglansau, a.is_nhaptien as is_nhaptien, a.phantramsotienhuong as phantramsotienhuong, a.is_nhapngaynangluong as is_nhapngaynangluong',
								' d.goihinhthuchuongluong= b.id and b.id=c.goihinhthuchuongluong_id and a.id=c.whois_sal_mgr_id
								and a.`status`=1 and d.id='.$thongtinImportCanxem->congtac_donvi_id,
								'id asc',
								'--Chọn Hình thức hưởng lương/ngạch--',
								'id', 'name', $thongtinImportCanxem->luong_hinhthuc_id, 'luong_hinhthuc_id', 'chosen required', array('phantramsotienhuong'=>'phantramsotienhuong','is_nangluonglansau'=>'is_nangluonglansau','is_nhaptien'=>'is_nhaptien','is_nhapngaynangluong'=>'is_nhapngaynangluong'));?>
						</div>
					</div>
				</div>
			</div>
			
			<div class="span4 luong_sotien">
				<?php if($arrLuong[0]->is_nhaptien==1){?>
				<div class="control-group">
					<label for="money_sal" class="control-label">Số tiền được hưởng</label>
					<div class="controls">
						<div class="row-fluid">
							<input id="money_sal"  name="money_sal" value="<?php echo $thongtinImportCanxem->money_sal?>" autocomplete="off" class="input-medium required">
						</div>
					</div>
				</div>
				<?php }?>
			</div>
			
			
			<div class="span4 luong_ngaynangluong">
				<?php if($arrLuong[0]->is_nhapngaynangluong==1 && $arrLuong[0]->is-nangluonglansau==1){?>
				<div class="control-group">
					<label for="real_start_date_sal" class="control-label">Thời điểm nâng lương lần sau tính từ</label>
					<div class="controls">
						<div class="row-fluid">
							<input class="input-medium date-picker" name="luong_ngaynangluonglansau" id="luong_ngaynangluonglansau" value="<?php echo $thongtinImportCanxem->luong_ngaynangluonglansau;?>">
							<span class="add-on">
								<i class="icon-calendar"></i>
							</span>
						</div>
					</div>
				</div>
				<?php }?>
			</div>
			
			<div class="span4 luong_ngach">
				<div class="control-group">
					<label for="sta_code" class="control-label">Ngạch (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div class="row-fluid input-append">
							<?php echo $model->getCbo('cb_bac_heso a, cb_goiluong b, cb_goiluong_ngach c, ins_dept d',
								'a.id as id, a.name as name',
								' d.goiluong=b.id and b.id = c.id_goi and c.ngach=a.mangach and d.id='.$thongtinImportCanxem->congtac_donvi_id,
								'id asc',
								'--Chọn Ngạch--',
								'id', 'name', $thongtinImportCanxem->luong_mangach, 'luong_mangach', 'chosen required');?>
							<a data-toggle="modal" href="#modal-form" role="button" class="btn btn-small btn-warning add-on" id="btn-ngachkhac">
								<i class="icon-wrench"></i> Ngạch khác
							</a>
						</div>
						<input type="hidden" value="" name="sta_name" id="sta_name">
					</div>
				</div>
			</div>
			<div class="span4 luong_bac">
				<div class="control-group">
					<label for="sl_code" class="control-label">Bậc (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div class="row-fluid">
							<select style="float:left;" class="input-mini" name="sl_code" id="sl_code">
								<option value=""></option>
							</select>
							<div style="float:left;padding-top:5px;padding-left:10px;">
								H/số:&nbsp;
							</div>
							<div id="hs" style="float:left;padding:5px 5px 0 0;"></div>
							<input type="hidden" value="" id="coef_code" name="coef_code">
							<div style="float:left;padding-top:2px;display:none;" class="vk">
								VK <input type="text" id="ext_coef_per" value="" style="width:25px;" name="ext_coef_per">%
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="div_dvngayhuong" class="span4">
				<div class="control-group">
					<label for="sal_step_date" id="dvngayhuong" class="control-label">Ngày hưởng lương,bậc (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div class="row-fluid input-append">
							<input type="text" data-date-format="dd/mm/yyyy" class="input-small date-picker input-mask-date" id="sal_step_date" name="sal_step_date">
							<span class="add-on">
								<i class="icon-calendar"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="span4">
				<div class="control-group">
					<label for="pos_sys_fk" class="control-label">Chức vụ hiện tại (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div class="row-fluid">
							<input type="hidden" value="" id="position" name="position">
							<input type="hidden" value="99" id="pos_td" name="pos_td">
							<input type="hidden" value="0" id="pos_thoihanbonhiem" name="pos_thoihanbonhiem">
							<select name="pos_sys_fk" id="pos_sys_fk">
								<option data-pos_thoihanbonhiem="0" data-pos_td="99" value="">Không chức vụ</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="3" value="11020">
										Giám đốc									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="4" value="11024">
										Phó giám đốc									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="24" value="151291">
										Phụ trách Kế toán									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="24" value="151291">
										Kế toán trưởng									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="5" value="11028">
										Chánh thanh tra									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="5" value="11028">
										Trưởng phòng									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="5" value="11028">
										Quyền trưởng phòng									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="5" value="11028">
										Chánh văn phòng									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="6" value="11032">
										Phó Trưởng phòng phụ trách phòng									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="6" value="11032">
										Phó Trưởng phòng									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="6" value="11032">
										Phó Chánh văn phòng									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="6" value="11032">
										Phó Chánh thanh tra									</option>
															</select>
						</div>
					</div>
				</div>
			</div>
			<div class="span4">
				<div class="control-group">
					<label id="divPos" for="rpos_date" class="control-label">Ngày bắt đầu vị trí tại Phòng (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div class="row-fluid input-append">
							<input type="text" data-date-format="dd/mm/yyyy" id="rpos_date" value="" class="input-small date-picker input-mask-date" name="rpos_date">
							<span class="add-on">
								<i class="icon-calendar"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div id="div_ngaycongbo" style="display:none;" class="span4">
				<div class="control-group">
					<label for="rpos_date_congbo" class="control-label">Ngày công bố chức vụ (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div class="row-fluid input-append">
							<input type="text" data-date-format="dd/mm/yyyy" id="rpos_date_congbo" value="" class="input-small date-picker input-mask-date" name="rpos_date_congbo">
							<span class="add-on">
								<i class="icon-calendar"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="span4">
				<div class="control-group">
					<label id="dvphong" for="dept_code" class="control-label">Phòng công tác (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div class="row-fluid">
							<input type="hidden" value="" name="dept_name" id="dept_name">
							<select name="dept_code" id="dept_code">
	<option selected="selected" value=""></option>
	<option value="150747">Thanh tra</option>
	<option value="150748">Văn phòng</option>
	<option value="150749">Phòng Kế hoạch và Đầu tư</option>
	<option value="150750">Phòng Bưu chính - Viễn thông</option>
	<option value="150751">Phòng Công nghệ thông tin</option>
	<option value="150752">Phòng Báo chí - Xuất bản</option>
	<option value="151064">Ban lãnh đạo</option>
	<option value="151872">Thu hút, Đề án chưa phân công</option>
</select>
						</div>
					</div>
				</div>
			</div>
			<div class="span4">
				<div class="control-group">
					<label for="whois_pos_mgr_id" class="control-label">Hình thức phân công (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div id="div_bonhiem_dieudong" class="row-fluid">
							<select name="whois_pos_mgr_id" id="whois_pos_mgr_id">
	<option selected="selected" value=""></option>
	<option value="4">Miễn nhiệm</option>
	<option value="5">Điều động theo nhiệm vụ</option>
	<option value="6">Chuyển đổi vị trí NĐ158</option>
	<option value="10">Phân công lần đầu</option>
</select>
						</div>
					</div>
				</div>
			</div>
			<div style="display:none;" id="div_cachthuc_bonhiem" class="span4">
				<div class="control-group">
					<label for="cachthucbonhiem_id" class="control-label">Cách thức bổ nhiệm (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div class="row-fluid">
							<select name="cachthucbonhiem_id" id="cachthucbonhiem_id">
	<option selected="selected" value=""></option>
	<option value="1">Bổ nhiệm truyền thống</option>
	<option value="2">Thi tuyển chức danh lãnh đạo</option>
</select>
						</div>
					</div>
				</div>
			</div>
	</div>
	<div role="tabpanel" class="tab-pane" id="trinhdodaotao">
	</div>
	<div role="tabpanel" class="tab-pane" id="thongtindangvien">
	</div>
</div>
</div>
</form>
<script type="text/javascript">
jQuery(document).ready(function($){
	$.ajax({
		type: 'POST',
			url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=getBiencheHinhthuc',
			data: {donvi_id : id, selected:<?php echo $thongtinImportCanxem->bienche_hinhthuc_id;?>},
			success:function(data){
				$('#div_bienche_hinhthuc_id').html(data);
				cs();
			}
    });
	$('body').delegate('#luong_hinhthuc_id', 'change', function(){
		var luong_is_nhapngaynangluong	=	$('option:selected', this).attr('is_nhapngaynangluong');
		var luong_is_nhaptien = $('option:selected', this).attr('is_nhaptien');
		var luong_is_nangluonglansau = $('option:selected', this).attr('is_nangluonglansau');
		if (luong_is_nhapngaynangluong==1 && luong_is_nangluonglansau==1){
			xhtml='<div class="control-group">';
			xhtml+='	<label for="real_start_date_sal" class="control-label">Thời điểm nâng lương lần sau tính từ</label>';
			xhtml+='	<div class="controls">';
			xhtml+='		<div class="row-fluid">';
			xhtml+='			<input class="input-medium date-picker" name="luong_ngaynangluonglansau" id="luong_ngaynangluonglansau" value="">';
			xhtml+='			<span class="add-on">';
			xhtml+='				<i class="icon-calendar"></i>';
			xhtml+='			</span>';
			xhtml+='		</div>';
			xhtml+='	</div>';
			xhtml+='</div>';
			$('.luong_ngaynangluong').html(xhtml);
			dp();
		}else $('.luong_ngaynangluong').html('');
		if (luong_is_nhaptien==1){
			xhtml='<div class="control-group">';
			xhtml+='	<label for="money_sal" class="control-label">Số tiền được hưởng</label>';
			xhtml+='	<div class="controls">';
			xhtml+='		<div class="row-fluid">';
			xhtml+='			<input id="money_sal" name="money_sal" value="" autocomplete="off" class="input-medium required">';
			xhtml+='		</div>';
			xhtml+='	</div>';
			xhtml+='</div>';
			$('.luong_sotien').html(xhtml);
			$('.luong_ngach').html('');
			$('.luong_bac').html('');
		}else {
			$('.luong_sotien').html('');
		} 
	});
	
	$('body').delegate('#bienche_hinhthuc_id', 'change', function(){
		var bienche_hinhthuc_id = $('option:selected', this).val();
		if (bienche_hinhthuc_id==null || bienche_hinhthuc_id=="" || bienche_hinhthuc_id==0)
			$('#div_bienche_hinhthuc_chitiet').html('');
		else
		$.ajax({
			type: 'POST',
				url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=getInfor_BiencheHinhthuc',
				data: {bienche_hinhthuc_id : bienche_hinhthuc_id},
				success:function(data){
					xhtml='<div class="span4">';
					xhtml+='	<div class="control-group">';
					xhtml+='		<label class="control-label" for="bienche_ngaybatdau';
					xhtml+='">'+data[0].text_ngaybatdau;
					if (data[0].valid_ngaybatdau=='required')
						xhtml+=' (<span style="color:red;">*</span>)';
					xhtml+='</label>';
					xhtml+='		<div class="controls">';
					xhtml+='			<div class="row-fluid">';
					xhtml+='					<input id="bienche_ngaybatdau" name="bienche_ngaybatdau';
					xhtml+='" autocomplete="off" class="input-medium date-picker '+data[0].valid_ngaybatdau+'">';
					xhtml+='					<span class="add-on"> <i class="icon-calendar"></i></span>';
					xhtml+='			</div>';
					xhtml+='		</div>';
					xhtml+='	</div>';
					xhtml+='</div>';
					if (data[0].is_hinhthuctuyendung==1){
						xhtml+='<div class="span4">';
						xhtml+='	<div class="control-group">';
						xhtml+='		<label class="control-label" for="id_hinhthuctuyendung">Hình thức tuyển dụng (<span style="color:red;">*</span>)</label>';
						xhtml+='		<div class="controls">';
						xhtml+='		<div class="row-fluid" id="div_id_hinhthuctuyendung" style="width:70%">'
						xhtml+='			</div>';
						xhtml+='		</div>';
						xhtml+='	</div>';
						xhtml+='</div>';
						$.ajax({
							type: 'POST',
								url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=getHinhthuctuyendung',
								data: {bienche_hinhthuc_id : bienche_hinhthuc_id, selected:<?php echo $thongtinImportCanxem->bienche_hinhthuc_id;?>},
								success:function(data){
									$('#div_id_hinhthuctuyendung').html(data);
									cs();
								}
					    });
					}
					if (data[0].is_thietlapthoihan==1){
						xhtml+='<div class="span4">';
						xhtml+='	<div class="control-group">';
						xhtml+='		<label class="control-label" for="id_thietlapthoihan">Thời hạn (<span style="color:red;">*</span>)</label>';
						xhtml+='		<div class="controls">';
						xhtml+='		<div class="row-fluid" id="div_id_thietlapthoihan" style="width:70%">'
						xhtml+='			</div>';
						xhtml+='		</div>';
						xhtml+='	</div>';
						xhtml+='</div>';
						$.ajax({
							type: 'POST',
								url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=getThietlapthoihan',
								data: {bienche_hinhthuc_id : bienche_hinhthuc_id, selected:<?php echo $thongtinImportCanxem->bienche_hinhthuc_id;?>},
								success:function(data){
									$('#div_id_thietlapthoihan').html(data);
									cs();
								}
					    });
					}

					xhtml+='<div class="span4">';
					xhtml+='	<div class="control-group">';
					xhtml+='		<label class="control-label" for="bienche_ngayketthuc">'+data[0].text_ngayketthuc+'</label>';
					xhtml+='		<div class="controls">';
					xhtml+='			<div class="row-fluid">';
					xhtml+='					<input name="bienche_ngayketthuc" id="bienche_ngayketthuc" autocomplete="off" class="input-medium date-picker '+data[0].valid_ngayketthuc+'">';
					xhtml+='					<span class="add-on"> <i class="icon-calendar"></i></span>';
					xhtml+='			</div>';
					xhtml+='		</div>';
					xhtml+='	</div>';
					xhtml+='</div>';
					
					xhtml+='<div class="span4">';
					xhtml+='	<div class="control-group">';
					xhtml+='		<label class="control-label" for="bienche_coquanraquyetdinh';
					xhtml+='">'+data[0].text_coquanraquyetdinh;
					if (data[0].valid_coquanraquyetdinh=='required') xhtml+=' (<span style="color:red;">*</span>)';
					xhtml+='</label>';
					xhtml+='		<div class="controls">';
					xhtml+='			<div class="row-fluid">';
					xhtml+='					<input id="bienche_coquanraquyetdinh" name="bienche_coquanraquyetdinh';
					xhtml+='" autocomplete="off" class="input-medium '+data[0].valid_coquanraquyetdinh+'">';
					xhtml+='			</div>';
					xhtml+='		</div>';
					xhtml+='	</div>';
					xhtml+='</div>';
					
					xhtml+='<div class="span4">';
					xhtml+='	<div class="control-group">';
					xhtml+='		<label class="control-label" for="bienche_soquyetdinh';
					xhtml+='">'+data[0].text_soquyetdinh;
					if (data[0].valid_soquyetdinh=='required') xhtml+=' (<span style="color:red;">*</span>)';
					xhtml+='</label>';
					xhtml+='		<div class="controls">';
					xhtml+='			<div class="row-fluid">';
					xhtml+='					<input id="bienche_soquyetdinh" name="bienche_soquyetdinh';
					xhtml+='" autocomplete="off" class="input-medium '+data[0].valid_soquyetdinh+'">';
					xhtml+='			</div>';
					xhtml+='		</div>';
					xhtml+='	</div>';
					xhtml+='</div>';
					xhtml+='<div class="span4">';
					xhtml+='	<div class="control-group">';
					xhtml+='		<label class="control-label" for="bienche_ngaybanhanh';
					xhtml+='">'+data[0].text_ngaybanhanh;
					if (data[0].valid_ngaybanhanh=='required') xhtml+=' (<span style="color:red;">*</span>)';
					xhtml+='</label>';
					xhtml+='		<div class="controls">';
					xhtml+='			<div class="row-fluid">';
					xhtml+='					<input id="bienche_ngaybanhanh" name="bienche_ngaybanhanh';
					xhtml+='" autocomplete="off" class="input-medium date-picker '+data[0].valid_ngaybanhanh+'">';
					xhtml+='					<span class="add-on"> <i class="icon-calendar"></i></span>';
					xhtml+='			</div>';
					xhtml+='		</div>';
					xhtml+='	</div>';
					xhtml+='</div>';
					$('#div_bienche_hinhthuc_chitiet').html(xhtml);
					dp();
				}
	    });
	});
	$('#danhdaunamsinh').on('click', function(){
		if ($(this).attr('checked')){
			$('#div_birth_date').html('<input type="text" class="input-medium required"  id="birth_date" autocomplete="off" name="birth_date">');
		}else{
			$('#div_birth_date').html('<input type="text" id="birth_date" name="birth_date" autocomplete="off" class="input-medium date-picker required"><span class="add-on"> <i class="icon-calendar"></i></span>');
		}
		});
	dp();
	cs();
	
	$.validator.addMethod("validNgayBCHD", function(value, element) {
		var tungay = $('#bienche_ngaybatdau');
		var denngay = $('#bienche_ngayketthuc');
		if(tungay.val() != '' && denngay.val() != ''){
		if(compareDate(tungay.val(),denngay.val()) == -1){
		tungay.addClass('valid').removeClass('error');
		denngay.addClass('valid').removeClass('error');
		return true;
		}else{
		tungay.addClass('error').removeClass('valid');
		denngay.addClass('error').removeClass('valid');
		return false;
		}
		}else{
		tungay.addClass('valid').removeClass('error');
		denngay.addClass('valid').removeClass('error');
		return true;
		}
	});
	$('#frmHosoImport').validate({
		ignore: '',
		errorPlacement : function(error, element) {},
		rules:{
			"hoten": { required : true },
			"gioitinh": { required : true },
			"nat_code": { required : true },
			"birth_date": { required : true },
			"per_residence": { required : true },
			"comm_placebirth": { required : true },
			"married_fk": { required : true },

			"bienche_hinhthuc_id": { required : true },
			"id_hinhthuctuyendung": { required : true },
			"id_thietlapthoihan": { required : true },
		},
		messages:{
			"hoten": { required : 'Nhập <b>Họ tên</b> trong thẻ "Thông tin chung"' },
			"gioitinh": { required : 'Nhập <b>Giới tính</b> trong thẻ "Thông tin chung"' },
			"nat_code": { required : 'Nhập <b>Dân tộc</b> trong thẻ "Thông tin chung"' },
			"birth_date": { required : 'Nhập <b>Ngày sinh</b> trong thẻ "Thông tin chung"' },
			"per_residence": { required : 'Nhập <b>Địa chỉ</b> trong thẻ "Thông tin chung"' },
			"comm_placebirth": { required : 'Nhập <b>Nguyên quán</b> trong thẻ "Thông tin chung"' },
			"married_fk": { required : 'Nhập <b>Tình trạng hôn nhân</b> trong thẻ "Thông tin chung"' },
			
			"bienche_hinhthuc_id": { required : 'Nhập <b>Loại hình biên chế, HĐ</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"bienche_ngaybatdau": { required : 'Nhập <b>Ngày bắt đầu</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"bienche_ngayketthuc": { validNgayBCHD : 'Nhập <b>Ngày kết thúc</b> phải lớn hơn Ngày bắt đầu trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"bienche_coquanraquyetdinh": { required : 'Nhập <b>Cơ quan quyết định</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"bienche_soquyetdinh": { required : 'Nhập <b>Số quyết định</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"bienche_ngaybanhanh": { required : 'Nhập <b>Ngày ban hành</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"bienche_hinhthuctuyendung_id": { required : 'Nhập <b>Hình thức tuyển dụng</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"bienche_thoihanbienchehopdong_id": { required : 'Nhập <b>Thời hạn</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			
			"luong_hinhthuc_id": { required : 'Nhập <b>Hình thức hưởng lương/ ngạch</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
		},
		invalidHandler: function(form, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				var message = errors == 1 ? 'Kiểm tra lỗi sau:<br/>' : 'Phát hiện ' + errors + ' lỗi sau:<br/>';
				var errors = "";
				if (validator.errorList.length > 0) {
					for (x=0;x<validator.errorList.length;x++) {
						errors += "<br/>\u25CF " + validator.errorList[x].message;
					}
				}
				loadNoticeBoardError('Thông báo',message + errors);
			}
			validator.focusInvalid();
		},
		submitHandler: function(){
			var frmHosoImport=$('#frmHosoImport').serialize();
			$.ajax({
				type: 'POST',
	  			url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=luuImport',
	  			data: {frmHosoImport : frmHosoImport},
	  			success:function(data){
	  				$('.modal').modal('hide');
	  			}
	        });
		}
	});
});
</script>