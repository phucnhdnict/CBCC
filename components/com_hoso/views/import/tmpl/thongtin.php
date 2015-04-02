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
<form id="frmHosoImport" method="post" class="form-horizontal">
	<h4 class="header lighter blue">Hồ sơ cán bộ: <?php echo $thongtinImportCanxem->hoten;?>
		<span class="pull-right inline">
		<button type="submit" class="btn btn-mini btn-success add-on"><i class="icon-save"></i> Lưu và quay lại</button>
		<span class="btn btn-mini btn_quaylai btn-warning add-on">
			<i class="icon-mail-reply"></i> Quay lại
		</span>
		<span class="btn btn-mini btn_huyimport btn-danger add-on">
			<i class="icon-trash"></i> Hủy hồ sơ
		</span>
		</span>
	</h4>
	<div role="tabpanel">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#thongtinchung" aria-controls="home" role="tab" data-toggle="tab" title="Thông tin chung">Thông tin chung</a></li>
		    <li role="presentation"><a href="#bienchehopdong" aria-controls="profile" role="tab" data-toggle="tab">Biên chế; Chức vụ; Ngạch, bậc</a></li>
		    <li role="presentation"><a href="#trinhdodaotao" aria-controls="messages" role="tab" data-toggle="tab">Trình độ, đào tạo</a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="thongtinchung" style="min-height: 1200px">
				<h3 class="header smaller lighter blue">Thông tin chung</h3>
				<div class="span8">
					<div class="control-group">
						<label for="hoten" class="control-label">Đơn vị công tác (<span style="color: red">*</span>)
						</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<?php echo $this->listDonviQuanly;?>
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="hoten" class="control-label">Họ tên (<span style="color: red">*</span>)
						</label>
						<div class="controls">
							<div class="row-fluid input-append">
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
							<div class="row-fluid input-append" id="div_birth_date">
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
							<div class="row-fluid input-append">
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
							<div class="row-fluid input-append">
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
							<div class="row-fluid input-append">
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
							<div class="row-fluid input-append">
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
							<div class="row-fluid input-append">
								<input type="text" value="<?php echo $thongtinImportCanxem->phone_work?>" name="phone_work" id="phone_work" class="input-medium">
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="mobile" class="control-label">Điện thoại di động</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" value="<?php echo $thongtinImportCanxem->mobile?>" name="mobile" id="mobile" class="input-medium">
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="maso_bhxh" class="control-label">Mã số BHXH</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" value="<?php echo $thongtinImportCanxem->maso_bhxh?>" id="maso_bhxh" name="maso_bhxh" class="input-medium">
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="maso_thue" class="control-label">Mã số thuế</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" value="<?php echo $thongtinImportCanxem->maso_thue?>" id="maso_thue" name="maso_thue" class="input-medium">
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="email" class="control-label">Email</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" value="<?php echo $thongtinImportCanxem->email;?>" name="email" id="email" class="input-medium">
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label for="yim" class="control-label">YIM</label>
						<div class="controls">
							<div class="row-fluid input-append">
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
							<div class="row-fluid input-append">
							<?php echo $model->getCbo('maried_code', 'id, name', 'status = 1', 'name asc', '--Chọn Tình trạng hôn nhân--', 'id', 'name', $thongtinImportCanxem->married_fk, 'married_fk', 'chosen');?>
							</div>
						</div>
					</div>
				</div>
				<div style="clear: both;"></div>
				<div class="span4">
					<div class="control-group">
						<label for="dangvien" class="control-label">Đảng viên (<span style="color: red">*</span>)</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<select name="is_dangvien" id="is_dangvien" class="required chosen">
									<option value="">--Chọn--</option>
									<option value="0" <?php if ($thongtinImportCanxem->party_j_date=='0000-00-00') echo 'selected'?>>Không</option>
									<option value="1" <?php if ($thongtinImportCanxem->party_j_date!='0000-00-00') echo 'selected'?>>Có</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div style="<?php if ($thongtinImportCanxem->party_j_date=='0000-00-00') echo 'display:none'?>" class="span4 dangvien">
					<div class="control-group">
						<label for="sothedangvien" class="control-label">Số thẻ đảng viên</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" value="<?php echo $thongtinImportCanxem->sothedangvien;?>" name="sothedangvien" id="sothedangvien" class="input-small">
							</div>
						</div>
					</div>
				</div>
				<div style="<?php if ($thongtinImportCanxem->party_j_date=='0000-00-00') echo 'display:none'?>" class=" span4 dangvien">
					<div class="control-group">
						<label for="party_j_date" class="control-label">Ngày kết nạp (<span style="color: red">*</span>)</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" value="<?php if ($thongtinImportCanxem->party_j_date!='0000-00-00') echo date('d/m/Y' ,strtotime($thongtinImportCanxem->party_j_date));?>" name="party_j_date" id="party_j_date" class="input-small date-picker required">
								<span class="add-on">
									<i class="icon-calendar"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div style="<?php if ($thongtinImportCanxem->party_j_date=='0000-00-00') echo 'display:none'?>" class="span4 dangvien">
					<div class="control-group">
						<label for="party_date" class="control-label">Ngày chính thức</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" value="<?php if ($thongtinImportCanxem->party_date!='0000-00-00') echo date('d/m/Y' ,strtotime($thongtinImportCanxem->party_date));?>" name="party_date" id="party_date" class="input-small date-picker">
								<span class="add-on">
									<i class="icon-calendar"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div style="<?php if ($thongtinImportCanxem->party_j_date=='0000-00-00') echo 'display:none'?>" class="dangvien span4">
					<div class="control-group">
						<label for="dang_chucvudang_id" class="control-label">Chức vụ Đảng</label>
						<div class="controls">
							<div class="row-fluid input-append">
							<?php 
								echo $model->getcbo('party_pos_code',
								'code, name','status=1',
								'name asc',
								'--Chọn Chức vụ Đảng--',
								'code', 'name', $thongtinImportCanxem->dang_chucvudang_id, 'dang_chucvudang_id', 'chosen');?>
							</div>
						</div>
					</div>
				</div>
				<div class="qtdangvien span4"  style="<?php if ($thongtinImportCanxem->dang_chucvudang_id==0) echo 'display:none';?> <?php if ($thongtinImportCanxem->party_j_date=='0000-00-00') echo 'display:none';?>">
					<div class="control-group valid">
						<label for="start_date_ctd" class="control-label">Ngày bắt đầu (<span style="color: red">*</span>)</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" value="" class="input-small date-picker <?php if (($thongtinImportCanxem->dang_chucvudang_id!=0)&&($thongtinImportCanxem->party_j_date!='0000-00-00')) echo 'required'?>" name="start_date_ctd" id="start_date_ctd">
								<span class="add-on">
									<i class="icon-calendar"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="qtdangvien span4" style="<?php if ($thongtinImportCanxem->dang_chucvudang_id==0) echo 'display:none';?> <?php if ($thongtinImportCanxem->party_j_date=='0000-00-00') echo 'display:none';?>">
					<div class="control-group valid">
						<label for="donvidang_ctd" class="control-label">Tổ chức Đảng (<span style="color: red">*</span>)</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" class="<?php if (($thongtinImportCanxem->dang_chucvudang_id!=0)&&($thongtinImportCanxem->party_j_date!='0000-00-00')) echo 'required'?>" value="<?php echo $thongtinImportCanxem->donvidang_ctd?>" name="donvidang_ctd" id="donvidang_ctd">
							</div>
						</div>
					</div>
				</div>
				<div class="span8">
					<div class="control-group">
						<label for="ghichu" class="control-label">Ghi chú</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<textarea style="height: 61px;" class="input-xxlarge" id="ghichu" name="ghichu"><?php echo $thongtinImportCanxem->ghichu;?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
	<!-- ---------------------  LOẠI HÌNH BIÊN CHẾ, HỢP ĐỒNG ------------------------------------ -->
			<div role="tabpanel" class="tab-pane" id="bienchehopdong" style="overflow: visible; min-height:1000px;">
			<?php $arrThongtinbienche = $model->listData('bc_hinhthuc',
		 				 array('id','name','loaihinh_id','is_thietlapthoihan','is_hinhthuctuyendung','text_ngaybatdau','text_ngayketthuc','text_soquyetdinh','text_coquanraquyetdinh','text_ngaybanhanh','valid_ngaybatdau','valid_ngayketthuc','valid_soquyetdinh','valid_coquanraquyetdinh','valid_ngaybanhanh'),
		 				array('id = '.$thongtinImportCanxem->bienche_hinhthuc_id,' status=1'), '');
					?>
				<h3 class="header smaller lighter blue">Loại biên chế, hợp đồng</h3>
				<div class="span5">
					<div class="control-group">
						<label class="control-label" for="bienche_hinhthuc_id">Loại hình biên chế, HĐ (<span style="color:red;">*</span>)</label>
							<div class="controls">
								<div class="row-fluid input-append" id="div_bienche_hinhthuc_id">
									<!-- combobox biên chế -->
							</div>
						</div>
					</div>
				</div>
				<div style="clear:both;"></div>
				<div id="div_bienche_hinhthuc_chitiet">
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="bienche_ngaybatdau"> Ngày bắt đầu <?php if($arrThongtinbienche[0]->valid_ngaybatdau=='required'){?>(<span style="color:red;">*</span>)<?php }?></label>
							<div class="controls">
								<div class="row-fluid input-append">
										<input type="text" id="bienche_ngaybatdau" name="bienche_ngaybatdau" autocomplete="off" value="<?php echo date('d/m/Y',strtotime($thongtinImportCanxem->bienche_ngaybatdau));?>" class="input-medium date-picker <?php echo $arrThongtinbienche[0]->valid_ngaybatdau?>">
										<span class="add-on"> <i class="icon-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="bienche_ngayketthuc">Ngày kết thúc <?php if($arrThongtinbienche[0]->valid_ngayketthuc=='required'){?>(<span style="color:red;">*</span>)<?php }?></label></label>
							<div class="controls">
								<div class="row-fluid input-append">
										<input type="text"  name="bienche_ngayketthuc" id="bienche_ngayketthuc" autocomplete="off" value="<?php if ($thongtinImportCanxem->bienche_ngayketthuc!='0000-00-00') echo date('d/m/Y',strtotime($thongtinImportCanxem->bienche_ngayketthuc));?>" class="input-medium date-picker <?php echo $arrThongtinbienche[0]->valid_ngayketthuc?>">
										<span class="add-on"> <i class="icon-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>
					
					<?php if($arrThongtinbienche[0]->is_hinhthuctuyendung == 1){?>
					<div class="span5">
						<div class="control-group">
							<label class="control-label" for="id_hinhthuctuyendung">Hình thức tuyển dụng (<span style="color:red;">*</span>)</label>
							<div class="controls">
								<div class="row-fluid input-append" id="div_id_hinhthuctuyendung">
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
								<div class="row-fluid input-append" id="div_id_thietlapthoihan" >
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
					<div style="clear:both;"></div>
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="bienche_coquanraquyetdinh">Cơ quan ra quyết định <?php if($arrThongtinbienche[0]->valid_coquanraquyetdinh=='required'){?>(<span style="color:red;">*</span>)<?php }?></label>
							<div class="controls">
								<div class="row-fluid input-append">
										<input type="text"  id="bienche_coquanraquyetdinh" name="bienche_coquanraquyetdinh" value="<?php echo $thongtinImportCanxem->bienche_coquanquyetdinh;?>" autocomplete="off" class="input-medium <?php echo $arrThongtinbienche[0]->valid_coquanraquyetdinh?>">
								</div>
							</div>
						</div>
					</div>
					
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="bienche_soquyetdinh">Số quyết định <?php if($arrThongtinbienche[0]->valid_soquyetdinh=='required'){?>(<span style="color:red;">*</span>)<?php }?></label>
							<div class="controls">
								<div class="row-fluid input-append">
										<input type="text" id="bienche_soquyetdinh" name="bienche_soquyetdinh" value="<?php echo $thongtinImportCanxem->bienche_soquyetdinh;?>" autocomplete="off" class="input-medium <?php echo $arrThongtinbienche[0]->valid_soquyetdinh?>">
								</div>
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="bienche_ngaybanhanh">Ngày ban hành <?php if($arrThongtinbienche[0]->valid_ngaybanhanh=='required'){?>(<span style="color:red;">*</span>)<?php }?></label>
							<div class="controls">
								<div class="row-fluid input-append">
										<input type="text" id="bienche_ngaybanhanh" name="bienche_ngaybanhanh" autocomplete="off" value="<?php if ($thongtinImportCanxem->bienche_ngaybanhanh!='0000-00-00') echo date('d/m/Y',strtotime($thongtinImportCanxem->bienche_ngaybanhanh));?>" class="input-medium date-picker <?php echo $arrThongtinbienche[0]->valid_ngaybanhanh;?>">
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
					<div class="span5 div_luong_hinhthuc_id">
						<div class="control-group">
							<label class="control-label" for="luong_hinhthuc_id">Hình thức hưởng lương/ ngạch (<span style="color:red;">*</span>)</label>
							<div class="controls">
								<div class="row-fluid input-append">
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
								<div class="row-fluid input-append">
									<input type="text" id="money_sal"  name="money_sal" value="<?php echo $thongtinImportCanxem->money_sal?>" autocomplete="off" class="input-medium required">
								</div>
							</div>
						</div>
						<?php }?>
					</div>
					
					
					<div class="span4 luong_ngaynangluong">
						<?php if($arrLuong[0]->is_nhapngaynangluong==1 && $arrLuong[0]->is_nangluonglansau==1){?>
						<div class="control-group">
							<label for="real_start_date_sal" class="control-label">Thời điểm nâng lương lần sau tính từ</label>
							<div class="controls">
								<div class="row-fluid input-append">
									<input type="text" class="input-medium date-picker" name="luong_ngaynangluonglansau" id="luong_ngaynangluonglansau" value="<?php echo $thongtinImportCanxem->luong_ngaynangluonglansau;?>">
									<span class="add-on">
										<i class="icon-calendar"></i>
									</span>
								</div>
							</div>
						</div>
						<?php }?>
					</div>
					<div style="clear: both;"></div>
					<div class="span5 luong_divngach">
						<div class="control-group">
							<label for="sta_code" class="control-label">Ngạch (<span style="color:red;">*</span>)</label>
							<div class="controls">
								<div class="row-fluid input-append">
									<?php echo $model->getCbo('cb_bac_heso a, cb_goiluong b, cb_goiluong_ngach c, ins_dept d',
										'a.mangach as mangach, a.name as name',
										' d.goiluong=b.id and b.id = c.id_goi and c.ngach=a.mangach and d.id='.$thongtinImportCanxem->congtac_donvi_id,
										'mangach asc',
										'--Chọn Ngạch--',
										'mangach', 'name', $thongtinImportCanxem->luong_mangach, 'luong_mangach', 'chosen required');?>
									<a data-toggle="modal" data-target=".modal" role="button" class="btn btn-mini btn-warning" id="btn-ngachkhac">
										<i class="icon-wrench"></i> Ngạch khác
									</a>
								</div>
							</div>
						</div>
					</div>
					<div style="clear: both;"></div>
					<?php  $arrBac= $model->listData('cb_nhomngach_heso',
		 				 array('idbac','heso','sta_code'),
		 				array('sta_code = "'.$thongtinImportCanxem->luong_mangach.'"', 'idbac= '.$thongtinImportCanxem->luong_bac), '');
					?>
					<div class="span5 luong_divbac">
						<div class="control-group">
							<label for="sl_code" class="control-label">Bậc (<span style="color:red;">*</span>)</label>
							<div class="controls">
								<div class="row-fluid">
									<div style="width:100px;float:left;">
									<?php echo $model->getCbo('cb_nhomngach_heso a, cb_bac_heso b',
										'a.idbac as idbac, a.heso as heso',
										' a.sta_code = b.mangach and b.mangach='.$thongtinImportCanxem->luong_mangach,
										'idbac asc',
										'--Bậc--',
										'idbac', 'idbac', "$thongtinImportCanxem->luong_bac", 'luong_bac', 'chosen required', array('heso'=>'heso'));?>
									</div>
									<div style="float:left;padding-left:10px;">
										H/số:&nbsp;<span class="heso"><?php echo $arrBac[0]->heso;?> </span>
									</div>
									<div style="float:left;padding-left:10px; <?php if($model->checkVK($thongtinImportCanxem->luong_mangach)!=$thongtinImportCanxem->luong_bac) echo "display:none";?>" class="vk">
										VK <input type="text" id="luong_vuotkhung" value="<?php echo $thongtinImportCanxem->luong_vuotkhung;?>" style="width:25px;" name="luong_vuotkhung">%
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="control-group">
							<label for="sal_step_date" id="dvngayhuong" class="control-label">Ngày hưởng lương,bậc (<span style="color:red;">*</span>)</label>
							<div class="controls">
								<div class="row-fluid input-append">
									<input type="text" class="input-small required date-picker" id="luong_ngaybatdau" name="luong_ngaybatdau" value="<?php if ($thongtinImportCanxem->luong_ngaybatdau!="0000-00-00") echo date('d/m/Y', strtotime($thongtinImportCanxem->luong_ngaybatdau));?>">
									<span class="add-on">
										<i class="icon-calendar"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div style="clear: both;"></div>
					<div class="span5 div_congtac_chucvu_id">
						<div class="control-group">
							<label for="congtac_chucvu_id" class="control-label">Chức vụ hiện tại (<span style="color:red;">*</span>)</label>
							<div class="controls">
								<div class="row-fluid input-append">
									<?php echo $model->getCboChucvu($thongtinImportCanxem->congtac_donvi_id, $thongtinImportCanxem->congtac_chucvu_id, $thongtinImportCanxem->congtac_chucvu);?>
								</div> 
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="control-group">
							<label id="lblPos" for="congtac_ngaybatdau" class="control-label"><?php if ($thongtinImportCanxem->congtac_chucvu_id==0||$thongtinImportCanxem->congtac_chucvu_id==''){?>Ngày bắt đầu vị trí tại Phòng <?php } else { ?> Ngày bắt đầu giữ chức vụ<?php }?>(<span style="color:red;">*</span>)</label>
							<div class="controls">
								<div class="row-fluid input-append">
									<input type="text" id="congtac_ngaybatdau" value="<?php if($thongtinImportCanxem->congtac_ngaybatdau!='0000-00-00') echo date('d/m/Y', strtotime($thongtinImportCanxem->congtac_ngaybatdau));?>" class="input-small date-picker" name="congtac_ngaybatdau">
									<span class="add-on">
										<i class="icon-calendar"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div style="clear: both;"></div>
					<div class="span4 div_ngaycongbo" style="<?php if ($thongtinImportCanxem->congtac_chucvu_id==0||$thongtinImportCanxem->congtac_chucvu_id=='') echo 'display:none;';?>">
						<div class="control-group">
							<label for="contac_chucvu_ngaycongbo" class="control-label">Ngày công bố chức vụ (<span style="color:red;">*</span>)</label>
							<div class="controls">
								<div class="row-fluid input-append">
									<input type="text" id="congtac_chucvu_ngaycongbo" value="<?php if($thongtinImportCanxem->congtac_chucvu_ngaycongbo!='0000-00-00') echo date('d/m/Y', strtotime($thongtinImportCanxem->congtac_chucvu_ngaycongbo));?>" class="input-small date-picker required" name="congtac_chucvu_ngaycongbo">
									<span class="add-on">
										<i class="icon-calendar"></i> 
									</span>
								</div>
							</div>
						</div>
					</div>
					<div style="clear: both;"></div>
					<div class="span5 div_congtac_phong_id">
						<div class="control-group">
							<label for="congtac_phong_id" class="control-label">Phòng công tác (<span style="color:red;">*</span>)</label>
							<div class="controls">
								<div class="row-fluid input-append">
									<?php echo $model->getCbo('ins_dept',
										'id, name',
										' type=0 and parent_id='.$thongtinImportCanxem->congtac_donvi_id,
										'id asc',
										'--Chọn Phòng công tác--',
										'id', 'name', $thongtinImportCanxem->congtac_phong_id, 'congtac_phong_id', 'chosen required');?>
									
								</div>
							</div>
						</div>
					</div>
					<div class="span4 div_whois_pos_mgr">
						<div class="control-group">
							<label for="cachthucbonhiem_id" class="control-label">Hình thức bổ nhiệm (<span style="color:red;">*</span>)</label>
							<div class="controls">
								<div class="row-fluid input-append">
									<?php
									if ($thongtinImportCanxem->congtac_chucvu_id==0||$thongtinImportCanxem->congtac_chucvu_id=='')
									 echo $model->getCbo('whois_pos_mgr',
										'id, name, type',
										' type=2',
										'name asc',
										'--Chọn Hình thức bổ nhiệm--',
										'id', 'name', $thongtinImportCanxem->whois_pos_mgr_id, 'whois_pos_mgr_id', 'chosen required');
									else 
										echo $model->getCbo('whois_pos_mgr',
										'id, name, type',
										' type=1',
										'name asc',
										'--Chọn Hình thức bổ nhiệm--',
										'id', 'name', $thongtinImportCanxem->whois_pos_mgr_id, 'whois_pos_mgr_id', 'chosen required');?>
								</div>
							</div>
						</div>
					</div>
					<div style="clear: both;"></div>
					<div class="span4 div_cachthuc_bonhiem" style="<?php if ($thongtinImportCanxem->congtac_chucvu_id==0||$thongtinImportCanxem->congtac_chucvu_id=='') echo 'display:none;';?>">
						<div class="control-group">
							<label for="cachthucbonhiem_id" class="control-label">Cách thức bổ nhiệm (<span style="color:red;">*</span>)</label>
							<div class="controls">
								<div class="row-fluid input-append">
									<?php echo $model->getCbo('ct_cachthucbonhiem',
										'id, name',
										' status=1',
										'name asc',
										'--Chọn Cách thức bổ nhiệm--',
										'id', 'name', $thongtinImportCanxem->cachthucbonhiem_id, 'cachthucbonhiem_id', 'chosen required');?>
								</div>
							</div>
						</div>
					</div>
			</div>
			
			<!-- ---------------------------------Trình độ, đào tạo---------------------------- -->
			<div role="tabpanel" class="tab-pane" id="trinhdodaotao" style="min-height:800px;">
				<h3 class="header smaller lighter blue">Trình độ chuyên môn</h3>
				<div class="span4">
					<div class="control-group">
						<label class="control-label" for="chuyenmon_trinhdo_code">Trình độ cao nhất (<span style="color:red;">*</span>)</label>
							<div class="controls">
								<div class="row-fluid input-append">
									<?php echo $model->getCbo('cla_sca_code',
										'id, name, tosc_code',
										' tosc_code=2',
										'id asc',
										'',
										'id', 'name', $thongtinImportCanxem->chuyenmon_trinhdo_code, 'chuyenmon_trinhdo_code', 'chosen required');?>
							</div>
						</div>
					</div>
				</div>
				<div class="span8 chuyenmon_div">
					<div class="control-group">
						<label class="control-label" for="chuyenmon_truong_id">Trường (<span style="color:red;">*</span>)</label>
						<div class="controls">
							<div class="row-fluid input-append">
							<?php echo $model->getCbo('place_training',
										'code, name',
										' status=1 and code>0',
										'name asc',
										'--Chọn Trường--',
										'code', 'name', $thongtinImportCanxem->chuyenmon_truong_id, 'chuyenmon_truong_id', 'chosen required');?>
							</div>
						</div>
					</div>
				</div>
				<div class="span8 chuyenmon_div">
					<div class="control-group">
						<label class="control-label" for="chuyenmon_chuyennganh_id">Chuyên ngành đào tạo (<span style="color:red;">*</span>)</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<?php echo $model->getCbo('ls_code',
										'code, name',
										' status=1',
										'name asc',
										'--Chọn Chuyên ngành đào tạo--',
										'code', 'name', $thongtinImportCanxem->chuyenmon_chuyennganh_id, 'chuyenmon_chuyennganh_id', 'chosen required');?>
							</div>
						</div>
					</div>
				</div>
				<div class="span4 chuyenmon_div">
					<div class="control-group">
						<label class="control-label" for="chuyenmon_namtotnghiep">Năm tốt nghiệp (<span style="color:red;">*</span>)</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input id="chuyenmon_namtotnghiep" class="input-small required" name="chuyenmon_namtotnghiep" type="text" value="<?php echo $thongtinImportCanxem->chuyenmon_namtotnghiep?>"/>
							</div>
						</div>
					</div>
				</div>
				<div class="span4 chuyenmon_div">
					<div class="control-group">
						<label class="control-label" for="chuyenmon_hinhthucdaotao_id">Hình thức đào tạo (<span style="color:red;">*</span>)</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<?php echo $model->getCbo('edu_form',
										'id, name, status, orders',
										' status=1',
										'orders asc',
										'--Chọn Hình thức đào tạo--',
										'id', 'name', $thongtinImportCanxem->chuyenmon_hinhthucdaotao_id, 'chuyenmon_hinhthucdaotao_id', 'chosen required');?>
							</div>
						</div>
					</div>
				</div>
				<div class="span4 chuyenmon_div">
					<div class="control-group">
						<label class="control-label" for="chuyenmon_loaitotnghiep_id">Tốt nghiệp loại</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<?php echo $model->getCbo('degree_code',
										'id, name, status, orders',
										' status=1',
										'orders asc',
										'--Chọn Loại tốt nghiệp--',
										'id', 'name', $thongtinImportCanxem->chuyenmon_loaitotnghiep_id, 'chuyenmon_loaitotnghiep_id', 'chosen');?>
							</div>
						</div>
					</div>
				</div>
				<div class="span4 chuyenmon_div">
					<div class="control-group">
						<label class="control-label" for="chuyenmon_nuocdaotao">Nước đào tạo (<span style="color:red;">*</span>)</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<?php echo $model->getCbo('country_code',
										'code, name',
										' 1=1',
										'name asc',
										'--Chọn Nước đào tạo--',
										'code', 'name', $thongtinImportCanxem->chuyenmon_nuocdaotao, 'chuyenmon_nuocdaotao', 'chosen required');?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="modal fade" id="div-modal" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="blue bigger">Chọn ngạch khác</h4>
				<hr/>
				 <?php echo $model->getCbo('cb_bac_heso',
										'mangach, name',
										' 1=1',
										'mangach asc',
										'--Chọn Ngạch--',
										'mangach', 'name', '', 'ngachkhac', 'chosen');?>
		</div>
	 	<div class="modal-footer">
		 	<button data-dismiss="modal" class="btn btn-small">Hủy bỏ</button>
			<button class="btn btn-small btn-primary btn_them_mangach" index="-1">Đồng ý</button>
	 	</div>
	</div>
</div>
<script type="text/javascript">
var donvi_id = <?php echo $thongtinImportCanxem->congtac_donvi_id;?>; 
jQuery(document).ready(function($){
	dp();
	cs();
	$('body').delegate('.btn_quaylai', 'click', function(){
		$.blockUI();
		window.location.replace('/index.php?option=com_hoso&controller=import&task=importhoso');
	});
	// TAB THÔNG TIN CHUNG
	$('body').delegate('#congtac_donvi_id', 'change', function(){
		donvi_id = $('option:selected', this).val();
		if (donvi_id!=0 || donvi_id!="" || donvi_id!= undefined){
			$.ajax({
				type: 'POST',
					url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=getBiencheHinhthuc',
					data: {donvi_id : donvi_id},
					success:function(data){
						$('#div_bienche_hinhthuc_id').html(data);
						cs();
					}
		    });
			$.ajax({
				type: 'POST',
					url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=getHinhthuchuongngach',
					data: {donvi_id : donvi_id},
					success:function(data){
						xhtml='<div class="control-group">';
						xhtml+='	<label class="control-label" for="luong_hinhthuc_id">Hình thức hưởng lương/ ngạch (<span style="color:red;">*</span>)</label>';
						xhtml+='	<div class="controls">';
						xhtml+='		<div class="row-fluid input-append">';
						xhtml+= 			data;						
						xhtml+='		</div>';
						xhtml+='	</div>';
						xhtml+='</div>';
						$('.div_luong_hinhthuc_id').html(xhtml);
						$('#div_bienche_hinhthuc_chitiet').html('');
						cs();
					}
		    });
			$.ajax({
				type: 'POST',
					url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=getNgach',
					data: {donvi_id : donvi_id},
					success:function(data){
						xhtml='<div class="control-group">';
						xhtml+='	<label for="sta_code" class="control-label">Ngạch (<span style="color:red;">*</span>)</label>';
						xhtml+='	<div class="controls">';
						xhtml+='		<div class="row-fluid input-append">';
						xhtml+=data;
						xhtml+='			<a data-toggle="modal" data-target=".modal" role="button" class="btn btn-mini btn-warning" id="btn-ngachkhac">';
						xhtml+='				<i class="icon-wrench"></i> Ngạch khác';
						xhtml+='			</a>';
						xhtml+='		</div>';
						xhtml+='	</div>';
						xhtml+='</div>';
						$('.luong_divngach').html(xhtml);
						$('#luong_bac').val('').trigger('chosen:updated');
						$('.heso').html('');
						$('#luong_vuotkhung').val('0').trigger('chosen:updated');
						$('.vk').css('display','none');
						cs();
					}
		    });
			$.ajax({
				type: 'POST',
					url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=getChucvu',
					data: {donvi_id : donvi_id},
					success:function(data){
						xhtml='<div class="control-group">';
						xhtml+='	<label for="congtac_chucvu_id" class="control-label">Chức vụ hiện tại (<span style="color:red;">*</span>)</label>';
						xhtml+='	<div class="controls">';
						xhtml+='		<div class="row-fluid input-append">';
						xhtml+=	data;
						xhtml+='		</div>'; 
						xhtml+='	</div>';
						xhtml+='</div>';
						$('.div_congtac_chucvu_id').html(xhtml);
						$('#congtac_chucvu_id').val('').trigger('chosen:updated');
						cs();
					}
		    });
			$.ajax({
				type: 'POST',
					url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=getPhongcongtac',
					data: {donvi_id : donvi_id},
					success:function(data){
						xhtml='<div class="control-group">';
		 				xhtml+='	<label for="congtac_phong_id" class="control-label">Phòng công tác (<span style="color:red;">*</span>)</label>';
	 					xhtml+='	<div class="controls">';
 						xhtml+='		<div class="row-fluid input-append">';
						xhtml+=data;
						xhtml+='		</div>';
						xhtml+='	</div>';
		 				xhtml+='</div>';
						$('.div_congtac_phong_id').html(xhtml);
						$('#congtac_phong_id').val('').trigger('chosen:updated');
						$('.div_cachthuc_bonhiem').css('display','none');
						$('#cachthucbonhiem_id').val('').trigger('chosen:updated');
						$('#cachthucbonhiem_id').addClass('valid').removeClass('required');
						cs();
					}
		    });
		}
	});
	$('#danhdaunamsinh').on('click', function(){
		if ($(this).attr('checked')){
			$('#div_birth_date').html('<input type="text" class="input-medium required"  id="birth_date" autocomplete="off" name="birth_date">');
		}else{
			$('#div_birth_date').html('<input type="text" id="birth_date" name="birth_date" autocomplete="off" class="input-medium date-picker required"><span class="add-on"> <i class="icon-calendar"></i></span>');
		}
	});
	$('body').delegate('#is_dangvien', 'change', function(){
		var is_dangvien = $('option:selected', this).val();
		if (is_dangvien==="" || is_dangvien==0 || is_dangvien===undefined){
			$('.dangvien').css('display','none');
			$('#party_j_date').addClass('valid').removeClass('required').val('');
			$('#sothedangvien').val('');
			$('#party_date').val('');
			$('#dang_chucvudang_id').val('').trigger('chosen:updated');
			$('.qtdangvien').css('display','none');
			$('#donvidang_ctd').addClass('valid').removeClass('required').val('');
			$('#start_date_ctd').addClass('valid').removeClass('required').val('');
			
		}
		else{
			$('.dangvien').css('display','');
			$('#party_j_date').addClass('required').removeClass('valid').val('');
		}
	});
	$('body').delegate('#dang_chucvudang_id', 'change', function(){
		var dang_chucvudang_id = $('option:selected', this).val();
		if (dang_chucvudang_id==="" || dang_chucvudang_id===0 || dang_chucvudang_id===undefined){
			$('.qtdangvien').css('display','none');
			$('#donvidang_ctd').addClass('valid').removeClass('required').val('');
			$('#start_date_ctd').addClass('valid').removeClass('required').val('');
		}
		else{
			$('.qtdangvien').css('display','');
			$('#donvidang_ctd').addClass('required').removeClass('valid');
			$('#start_date_ctd').addClass('required').removeClass('valid');
		}
	});
	$('body').delegate('#cadc_code', 'change', function(){
		var cadc_code = $(this).val();
		if (cadc_code==0 || cadc_code =="" || cadc_code==null || cadc_code==undefined){
		}
		else{
			$.ajax({
				type: 'POST',
				url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=changeCadc',
				data: { cadc_code : cadc_code},
				success:function(data){
					$('#div_dist_placebirth').html(data);
					$('#div_comm_placebirth').html('<select id="comm_placebirth" class="chosen" name="comm_placebirth"><option value="">--Chọn phường/xã--</option></select>');
					cs();
				}
			});
		}
	});
	$('body').delegate('#dist_placebirth', 'change', function(){
		var dist_placebirth = $(this).val(); 
		$.ajax({
			type: 'POST',
  			url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=changeDist',
  			data: {dist_placebirth:dist_placebirth},
  			success:function(data){
	  			$('#div_comm_placebirth').html(data);
	  			cs();
  			}
        });
	});
	
	// TAB BIÊN CHẾ, LƯƠNG, NGẠCH, BẬC
	$.ajax({
		type: 'POST',
			url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=getBiencheHinhthuc',
			data: {donvi_id : donvi_id, selected:<?php echo $thongtinImportCanxem->bienche_hinhthuc_id;?>},
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
			xhtml+='	<label for="real_start_date_sal" class="control-label">Thời điểm nâng lương lần sau tính từ (<span style="color:red;">*</span>)</label>';
			xhtml+='	<div class="controls">';
			xhtml+='		<div class="row-fluid input-append">';
			xhtml+='			<input type="text"  class="input-medium date-picker required" name="luong_ngaynangluonglansau" id="luong_ngaynangluonglansau" value="">';
			xhtml+='			<span class="add-on">';
			xhtml+='				<i class="icon-calendar"></i>';
			xhtml+='			</span>';
			xhtml+='		</div>';
			xhtml+='	</div>';
			xhtml+='</div>';
			$('.luong_ngaynangluong').html(xhtml);
			dp();
		}else {
			$('.luong_ngaynangluong').html('');
			$('#luong_ngaynangluonglansau').addClass('valid').removeClass('required');
		};
		
		if (luong_is_nhaptien==1){
			xhtml='<div class="control-group">';
			xhtml+='	<label for="money_sal" class="control-label">Số tiền được hưởng (<span style="color:red;">*</span>)</label>';
			xhtml+='	<div class="controls">';
			xhtml+='		<div class="row-fluid input-append">';
			xhtml+='			<input type="text" id="money_sal" name="money_sal" value="" autocomplete="off" class="input-medium required">';
			xhtml+='		</div>';
			xhtml+='	</div>';
			xhtml+='</div>';
			// ẩn div Ngạch, Bậc, hệ số, vk -/- hiện nhập số tiền
			$('.luong_sotien').html(xhtml);
			$('.luong_sotien').css('display','');
			
			$('.luong_divngach').css('display','none');
			$('#luong_mangach').val('').trigger('chosen:updated');
			$('#luong_mangach').addClass('valid').removeClass('required');
			
			$('.luong_divbac').css('display','none');
			$('#luong_bac').val('').trigger('chosen:updated');
			$('#luong_bac').addClass('valid').removeClass('required');
			$('.heso').css('display','none');
			
			$('.vk').css('display','none');
			$('.vk').val('0').trigger('chosen:updated');
			$('#luong_vuotkhung').val('');
		}else {
			// ẩn nhập số tiền -/- hiện div Ngạch, Bậc, hệ số, vk
			$('.luong_sotien').css('display','none');
			$('#money_sal').addClass('valid').removeClass('required');

			$('.luong_divngach').css('display','');
			$('#luong_mangach').addClass('required').removeClass('valid');

			$('.luong_divbac').css('display','');
			$('#luong_bac').addClass('required').removeClass('valid');
// 			$('.vk').css('display','none');
		} 
	});
	$('body').delegate('#luong_mangach', 'change', function(){
		var luong_mangach = $('option:selected', this).val();
		if (luong_mangach=== undefined || luong_mangach===0 || luong_mangach==='')
			console.log(luong_mangach);
		else{
			$.ajax({
				type:'POST',
				url: '<?php echo JUri::base(true)?>/index.php?option=com_hoso&view=import&format=raw&task=getBac',
				data: {luong_mangach:luong_mangach},
				success: function(data){
					xhtml='<div class="control-group">';
					xhtml+='	<label for="sl_code" class="control-label">Bậc (<span style="color:red;">*</span>)</label>';
					xhtml+='	<div class="controls">';
					xhtml+='		<div class="row-fluid">';
					xhtml+='			<div style="width:100px;float:left;">';
					xhtml+=					data;
					xhtml+='			</div>';
					xhtml+='			<div style="float:left;padding-left:10px;">';
					xhtml+='				H/số:&nbsp;<span class="heso"></span>';
					xhtml+='			</div>';
					xhtml+='			<div style="float:left;padding-left:10px;display:none" class="vk">';
					xhtml+='				VK <input type="text" id="luong_vuotkhung" value="" style="width:25px;" name="luong_vuotkhung">%';
					xhtml+='			</div>';
					xhtml+='		</div>';
					xhtml+='	</div>';
					xhtml+='</div>';
					$('.luong_divbac').html(xhtml);
					cs();
				}
			});	
		}
	});
	$('body').delegate('#congtac_chucvu_id', 'change', function(){
		var congtac_chucvu_id = $('option:selected', this).val();
		if(congtac_chucvu_id==0 || congtac_chucvu_id== undefined || congtac_chucvu_id=='')
			{
				$('.div_ngaycongbo').css('display','none');
				$('#congtac_chucvu_ngaycongbo').addClass('valid').removeClass('required');
				$('#lblPos').html('Ngày bắt đầu vị trí tại Phòng (<span style="color:red;">*</span>)');
				$('#congtac_chucvu_ngaycongbo').val('');
				a='<div class="control-group">';
				a+='	<label for="cachthucbonhiem_id" class="control-label">Hình thức bổ nhiệm (<span style="color:red;">*</span>)</label>';
				a+='	<div class="controls">';
				a+='		<div class="row-fluid input-append">';
				a+= <?php echo json_encode($model->getCbo('whois_pos_mgr',
						'id, name, type',
						' type=2',
						'name asc',
						'--Chọn Hình thức bổ nhiệm--',
						'id', 'name', '', 'whois_pos_mgr_id', 'chosen required'))?>;
				a+='		</div>';
				a+='	</div>';
				a+='</div>';
				$('.div_whois_pos_mgr').html(a);
				$('#whois_pos_mgr_id').val('').trigger('chosen:updated');
				$('.div_cachthuc_bonhiem').css('display','none');
				$('#cachthucbonhiem_id').val('').trigger('chosen:updated');
				$('#cachthucbonhiem_id').addClass('valid').removeClass('required');
				cs();
			}
		else {
				$('.div_ngaycongbo').css('display','');
				$('#congtac_chucvu_ngaycongbo').addClass('required').removeClass('valid');
				$('#lblPos').html('Ngày bắt đầu giữ chức vụ (<span style="color:red;">*</span>)');
				$('#whois_pos_mgr_id').val('').trigger('chosen:updated');
				$('.div_cachthuc_bonhiem').css('display','');
				$('#cachthucbonhiem_id').addClass('required').removeClass('valid');
				a='<div class="control-group">';
				a+='	<label for="cachthucbonhiem_id" class="control-label">Hình thức bổ nhiệm (<span style="color:red;">*</span>)</label>';
				a+='	<div class="controls">';
				a+='		<div class="row-fluid input-append">';
				a+= <?php echo json_encode($model->getCbo('whois_pos_mgr',
						'id, name, type',
						' type=1',
						'name asc',
						'--Chọn Hình thức bổ nhiệm--',
						'id', 'name', '', 'whois_pos_mgr_id', 'chosen required'))?>;
				a+='		</div>';
				a+='	</div>';
				a+='</div>';
				$('.div_whois_pos_mgr').html(a);
				cs();
			}
	});
	$('body').delegate('#luong_bac', 'change', function(){
		var luong_heso = $('option:selected', this).attr('heso');
		var luong_idbac = $('option:selected', this).val();
		var luong_mangach  = $('option:selected', '#luong_mangach').val();
		$('.heso').html(luong_heso);
		$.ajax({
			type: 'POST',
			url: '<?php echo JUri::base(true)?>/index.php?option=com_hoso&view=import&format=raw&task=checkVK',
			data: {luong_idbac, luong_mangach},
			success:function(data){
				if(data==true)
					$('.vk').css('display','');
				else
					{
						$('.vk').css('display','none');
						$('#luong_vuotkhung').val('');
					}
			}
		});
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
					xhtml+='			<div class="row-fluid input-append">';
					xhtml+='					<input type="text" id="bienche_ngaybatdau" name="bienche_ngaybatdau';
					xhtml+='" autocomplete="off" class="input-medium date-picker '+data[0].valid_ngaybatdau+'">';
					xhtml+='					<span class="add-on"> <i class="icon-calendar"></i></span>';
					xhtml+='			</div>';
					xhtml+='		</div>';
					xhtml+='	</div>';
					xhtml+='</div>';
					xhtml+='<div class="span4">';
					xhtml+='	<div class="control-group">';
					xhtml+='		<label class="control-label" for="bienche_ngayketthuc">'+data[0].text_ngayketthuc+'</label>';
					xhtml+='		<div class="controls">';
					xhtml+='			<div class="row-fluid input-append">';
					xhtml+='					<input type="text" name="bienche_ngayketthuc" id="bienche_ngayketthuc" autocomplete="off" class="input-medium date-picker '+data[0].valid_ngayketthuc+'">';
					xhtml+='					<span class="add-on"> <i class="icon-calendar"></i></span>';
					xhtml+='			</div>';
					xhtml+='		</div>';
					xhtml+='	</div>';
					xhtml+='</div>';
					
					if (data[0].is_hinhthuctuyendung==1){
						xhtml+='<div class="span5">';
						xhtml+='	<div class="control-group">';
						xhtml+='		<label class="control-label" for="id_hinhthuctuyendung">Hình thức tuyển dụng (<span style="color:red;">*</span>)</label>';
						xhtml+='		<div class="controls">';
						xhtml+='		<div class="row-fluid input-append" id="div_id_hinhthuctuyendung" >'
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
						xhtml+='		<div class="row-fluid input-append" id="div_id_thietlapthoihan">'
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

					xhtml+='<div style="clear:both;"></div><div class="span4">';
					xhtml+='	<div class="control-group">';
					xhtml+='		<label class="control-label" for="bienche_coquanraquyetdinh';
					xhtml+='">'+data[0].text_coquanraquyetdinh;
					if (data[0].valid_coquanraquyetdinh=='required') xhtml+=' (<span style="color:red;">*</span>)';
					xhtml+='</label>';
					xhtml+='		<div class="controls">';
					xhtml+='			<div class="row-fluid input-append">';
					xhtml+='					<input type="text" id="bienche_coquanraquyetdinh" name="bienche_coquanraquyetdinh';
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
					xhtml+='			<div class="row-fluid input-append">';
					xhtml+='					<input type="text" id="bienche_soquyetdinh" name="bienche_soquyetdinh';
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
					xhtml+='			<div class="row-fluid input-append">';
					xhtml+='					<input type="text" id="bienche_ngaybanhanh" name="bienche_ngaybanhanh';
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
	$('body').delegate('.btn_them_mangach', 'click', function(){
		ngachkhac_value = $('option:selected', '#ngachkhac').val();
		ngachkhac_text = $('option:selected', '#ngachkhac').text();
		if (ngachkhac_value=="" || ngachkhac_value== null || ngachkhac_value==0 || ngachkhac_value== undefined){
			$('#div-modal').modal('hide');
		}
		else{
			$('#luong_mangach').append(
					$('<option></option>')
						.val(ngachkhac_value)
						.attr('selected', 'selected')
						.html(ngachkhac_text)
			).trigger('chosen:updated');
			$('option:selected', '#ngachkhac').attr('disabled','disabled');
			$('#ngachkhac').val('').trigger('chosen:updated');
			$('#div-modal').modal('hide');
		}
	});
	// Tab Trình độ đào tạo
	$('#chuyenmon_trinhdo_code').prepend($('<option></option>')
	        .val('0')
	        .html('Chưa đào tạo')).trigger('liszt:updated');
	$('#chuyenmon_trinhdo_code').prepend($('<option></option>')
	        .val('')
	        .html('--Chọn Trình độ--')).trigger('liszt:updated');
	$('#chuyenmon_trinhdo_code').trigger("chosen:updated");
	$('body').delegate('#chuyenmon_trinhdo_code', 'change', function(){
		var chuyenmon_trinhdo_code = $('option:selected', this).val();
		if (chuyenmon_trinhdo_code == "" ||  chuyenmon_trinhdo_code == undefined){
			$('.chuyenmon_div').css('display','none');
			$('#chuyenmon_nuocdaotao').val('').trigger('chosen:updated');
			$('#chuyenmon_loaitotnghiep_id').val('').trigger('chosen:updated');
			$('#chuyenmon_hinhthucdaotao_id').val('').trigger('chosen:updated');
			$('#chuyenmon_namtotnghiep').val('');
			$('#chuyenmon_chuyennganh_id').val('').trigger('chosen:updated');
			$('#chuyenmon_truong_id').val('').trigger('chosen:updated');
			
			$('#chuyenmon_nuocdaotao').addClass('valid').removeClass('required');
			$('#chuyenmon_hinhthucdaotao_id').addClass('valid').removeClass('required');
			$('#chuyenmon_namtotnghiep').addClass('valid').removeClass('required');
			$('#chuyenmon_chuyennganh_id').addClass('valid').removeClass('required');
			$('#chuyenmon_truong_id').addClass('valid').removeClass('required');
		}
		else if(chuyenmon_trinhdo_code==0){
			$('.chuyenmon_div').css('display','none');
			$('#chuyenmon_nuocdaotao').val('').trigger('chosen:updated');
			$('#chuyenmon_loaitotnghiep_id').val('').trigger('chosen:updated');
			$('#chuyenmon_hinhthucdaotao_id').val('').trigger('chosen:updated');
			$('#chuyenmon_namtotnghiep').val('');
			$('#chuyenmon_chuyennganh_id').val('').trigger('chosen:updated');
			$('#chuyenmon_truong_id').val('').trigger('chosen:updated');
			
			$('#chuyenmon_nuocdaotao').addClass('valid').removeClass('required');
			$('#chuyenmon_hinhthucdaotao_id').addClass('valid').removeClass('required');
			$('#chuyenmon_namtotnghiep').addClass('valid').removeClass('required');
			$('#chuyenmon_chuyennganh_id').addClass('valid').removeClass('required');
			$('#chuyenmon_truong_id').addClass('valid').removeClass('required');
		}
		else{
			$('.chuyenmon_div').css('display','');
			$('#chuyenmon_nuocdaotao').addClass('required').removeClass('valid');
			$('#chuyenmon_hinhthucdaotao_id').addClass('required').removeClass('valid');
			$('#chuyenmon_namtotnghiep').addClass('required').removeClass('valid');
			$('#chuyenmon_chuyennganh_id').addClass('required').removeClass('valid');
			$('#chuyenmon_truong_id').addClass('required').removeClass('valid');
		}
	});
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
			"cadc_code": { required : true },
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
			"cadc_code": { required : 'Nhập <b>Nguyên quán</b> trong thẻ "Thông tin chung"' },
			"married_fk": { required : 'Nhập <b>Tình trạng hôn nhân</b> trong thẻ "Thông tin chung"' },
			"is_dangvien": { required : 'Nhập <b>Đảng viên</b> trong thẻ "Thông tin chung"' },
			"party_j_date": { required : 'Nhập <b>Ngày kết nạp Đảng</b> trong thẻ "Thông tin chung"' },
			"start_date_ctd": { required : 'Nhập <b>Ngày bắt đầu chức vụ Đảng</b> trong thẻ "Thông tin chung"' },
			"donvidang_ctd": { required : 'Nhập <b>Tổ chức Đảng</b> trong thẻ "Thông tin chung"' },
			
			"bienche_hinhthuc_id": { required : 'Nhập <b>Loại hình biên chế, HĐ</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"bienche_ngaybatdau": { required : 'Nhập <b>Ngày bắt đầu</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"bienche_ngayketthuc": { validNgayBCHD : 'Nhập <b>Ngày kết thúc</b> phải lớn hơn Ngày bắt đầu trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"bienche_coquanraquyetdinh": { required : 'Nhập <b>Cơ quan quyết định</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"bienche_soquyetdinh": { required : 'Nhập <b>Số quyết định</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"bienche_ngaybanhanh": { required : 'Nhập <b>Ngày ban hành</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"bienche_hinhthuctuyendung_id": { required : 'Nhập <b>Hình thức tuyển dụng</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"bienche_thoihanbienchehopdong_id": { required : 'Nhập <b>Thời hạn</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			
			"luong_hinhthuc_id": { required : 'Nhập <b>Hình thức hưởng lương/ ngạch</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"money_sal": { required : 'Nhập <b>Số tiền được hưởng</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"luong_mangach": { required : 'Nhập <b>Ngạch</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"luong_bac": { required : 'Nhập <b>Bậc</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"luong_ngaybatdau": { required : 'Nhập <b>Ngày hưởng lương, bậc</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"luong_ngaynangluonglansau": { required : 'Nhập <b>Ngày nâng lương lần sau</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			
			"congtac_chucvu_id": { required : 'Nhập <b>Chức vụ</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"congtac_chucvu_ngaycongbo": { required : 'Nhập <b>Ngày công bố chức vụ</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"cachthucbonhiem_id": { required : 'Nhập <b>Cách thức bổ nhiệm</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"congtac_phong_id": { required : 'Nhập <b>Phòng </b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"whois_pos_mgr_id": { required : 'Nhập <b>Hình thức bổ nhiệm</b> trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			
			"chuyenmon_trinhdo_code": { required : 'Nhập <b>Trình độ cao nhất</b> trong thẻ "Trình độ, đào tạo"' },
			"chuyenmon_chuyennganh_id": { required : 'Nhập <b>Chuyên ngành</b> trong thẻ "Trình độ, đào tạo"' },
			"chuyenmon_hinhthucdaotao_id": { required : 'Nhập <b>Hình thức đào tạo</b> trong thẻ "Trình độ, đào tạo"' },
			"chuyenmon_namtotnghiep": { required : 'Nhập <b>Năm tốt nghiệp</b> trong thẻ "Trình độ, đào tạo"' },
			"chuyenmon_nuocdaotao": { required : 'Nhập <b>Nước đào tạo</b> trong thẻ "Trình độ, đào tạo"' },
			"chuyenmon_truong_id": { required : 'Nhập <b>Trường</b> trong thẻ "Trình độ, đào tạo"' },
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