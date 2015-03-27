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
</h4>
     <div role="tabpanel">
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#thongtinchung" aria-controls="home" role="tab" data-toggle="tab" title="Thông tin chung">Thông tin chung</a></li>
		    <li role="presentation"><a href="#bienchehopdong" aria-controls="profile" role="tab" data-toggle="tab">Biên chế/ hợp đồng</a></li>
		    <li role="presentation"><a href="#luong" aria-controls="messages" role="tab" data-toggle="tab">Lương</a></li>
		    <li role="presentation"><a href="#congtac" aria-controls="settings" role="tab" data-toggle="tab">Công tác</a></li>
			<li role="presentation"><a href="#trinhdochuyenmon" aria-controls="settings" role="tab" data-toggle="tab">Trình độ chuyên môn</a></li>
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
	
	<div role="tabpanel" class="tab-pane" id="bienchehopdong" style="overflow: visible; min-height:500px;">
		<h3 class="header smaller lighter blue">Loại biên chế, hợp đồng</h3>
		<div class="span4">
			<div class="control-group">
				<label class="control-label" for="bienche_hinhthuc_id">Loại hình biên chế, HĐ (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div class="row-fluid" id="div_bienche_hinhthuc_id" style="width:70%">
							<?php // combobox biên chế?>
					</div>
				</div>
			</div>
		</div>
		<div id="div_bienche_hinhthuc_chitiet">
			
		</div>
	</div>
	<div role="tabpanel" class="tab-pane" id="luong" style="overflow: visible; min-height: 500px">
		<h3 class="header smaller lighter blue">Lương</h3>
		<div class="span4">
				<div class="control-group">
					<label class="control-label" for="bienche_hinhthuc_id">Lương (<span style="color:red;">*</span>)</label>
						<div class="controls">
							<div class="row-fluid" id="div_bienche_hinhthuc_id" style="width:70%">
								<select class="chosen" placeholder="a">
									<option value="" disabled selected>Select your option</option>
								    <option value="hurr">Durr</option>
								</select>
						</div>
					</div>
				</div>
			</div>
		
	</div>
	<div role="tabpanel" class="tab-pane" id="congtac">
	</div>
	<div role="tabpanel" class="tab-pane" id="trinhdochuyenmon">
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
				$('.chosen').chosen();$('.chosen-container').css('width', '100%');
			}
    });
	$('body').delegate('#bienche_hinhthuc_id', 'change', function(){
		var bienche_hinhthuc_id = $(this).val();
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
									$('.chosen').chosen();$('.chosen-container').css('width', '100%');
								}
					    });
					}
					if (data[0].is_thietlapthoihan==1){
						xhtml+='<div class="span4">';
						xhtml+='	<div class="control-group">';
						xhtml+='		<label class="control-label" for="id_thietlapthoihan">Thiết lập thời hạn (<span style="color:red;">*</span>)</label>';
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
									$('.chosen').chosen();$('.chosen-container').css('width', '100%');
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
					$('.date-picker').datepicker({format: 'dd/mm/yyyy', 'autoclose':true});
// 					$('.chosen').chosen();$('.chosen-container').css('width', '100%');
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
	$('body').delegate('.btn_quaylai', 'click', function(){
		$('#danhsachimport').css("display","");
		$('#divimport').css("display","");
		$('#div_xemchitiet').html("");
	});
	$('.date-picker').datepicker({format: 'dd/mm/yyyy'}).on('changeDate', function(e){$(this).datepicker('hide');});
	
	$('.chosen').chosen();  
	
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
			
			"bienche_hinhthuc_id": { required : 'Nhập <b>Loại hình biên chế, HĐ</b> trong thẻ "Biên chế/ hợp đồng"' },
			"bienche_ngaybatdau": { required : 'Nhập <b>Ngày bắt đầu</b> trong thẻ "Biên chế/ hợp đồng"' },
			"bienche_ngayketthuc": { validNgayBCHD : 'Nhập <b>Ngày kết thúc</b> phải lớn hơn Ngày bắt đầu trong thẻ "Biên chế/ hợp đồng"' },
			"bienche_coquanraquyetdinh": { required : 'Nhập <b>Cơ quan quyết định</b> trong thẻ "Biên chế/ hợp đồng"' },
			"bienche_soquyetdinh": { required : 'Nhập <b>Số quyết định</b> trong thẻ "Biên chế/ hợp đồng"' },
			"bienche_ngaybanhanh": { required : 'Nhập <b>Ngày ban hành</b> trong thẻ "Biên chế/ hợp đồng"' },
			"id_hinhthuctuyendung": { required : 'Nhập <b>Hình thức tuyển dụng</b> trong thẻ "Biên chế/ hợp đồng"' },
			"id_thietlapthoihan": { required : 'Nhập <b>Thời hạn</b> trong thẻ "Biên chế/ hợp đồng"' },
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