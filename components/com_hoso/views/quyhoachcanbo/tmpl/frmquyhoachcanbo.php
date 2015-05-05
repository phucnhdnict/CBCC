<?php 
defined( '_JEXEC' ) or die( 'Truy cập không hợp lệ' );
$model = Core::model('Hoso/Quyhoachcanbo');
$a = $this->datadb_quyhoachcanbo;
?>
<div class="modal-header">
	<button data-dismiss="modal" class="close" type="button">×</button>
	<h4 id="title_quatrinh" class="blue bigger"><?php if($data_nhucaudaotao[0]->id_ncdt>0) echo "Hiệu chỉnh"; else echo "Thêm mới"?> quy hoạch cán bộ</h4>
</div>
<div style="clear: both;"></div>
<form id="data_frmQuyhoachcanbo" name="data_frmQuyhoachcanbo" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
	<div style="float:left;width:400px;">
		<div class="control-group">
			<label class="control-label" for="emp_id">Họ và tên CBCC (<span style="color:red;">*</span>)</label>
			<div class="controls">
				<?php echo $model->getCanboById($this->donvi_id,$a[0]->emp_id);?>
			</div>
		</div>
	</div>
	<div style="float:left;width:400px;">
		<div class="control-group">
			<label class="control-label" for="pos_system_id">Chức vụ (<span style="color:red;">*</span>)</label>
			<div class="controls">
				<?php echo $model->getChucvuByDonvi($this->donvi_id,$a[0]->pos_system_id)?>
				<input type="hidden" id="position" name="position">
			</div>
		</div>
	</div>
	<div style="float:left;width:400px;">
		<div class="control-group">
			<label class="control-label" for="start_year">Từ năm (<span style="color:red;">*</span>)</label>
			<div class="controls">
				<input id="start_year" name="start_year" value="<?php if(isset($a[0]->start_year)) echo $a[0]->start_year?>">
			</div>
		</div>
	</div>
	<div style="float:left;width:400px;">
		<div class="control-group">
			<label class="control-label" for="end_year">Đến năm (<span style="color:red;">*</span>)</label>
			<div class="controls">
				<input id="end_year" name="end_year" class="greaterThan" value="<?php if(isset($a[0]->end_year)) echo $a[0]->end_year?>">
			</div>
		</div>
	</div>
	<div style="float:left;width:800px;">
		<div class="control-group">
			<label class="control-label" for="ghichu">Ghi chú</label>
			<div class="controls">
				<textarea rows="2" style="width:599px" id="ghichu" name="ghichu"><?php if(isset($a[0]->ghichu)) echo $a[0]->ghichu?> </textarea>
			</div>
		</div>
	</div>
	
	<div style="clear: both;"></div>
	<input type="hidden" id="date_created" name="date_created" value="<?php echo date('d/m/Y')?>" />
	<input type="hidden" id="id_qhcb" name="id_qhcb" value="<?php if(isset($a[0]->id_qhcb))  echo $a[0]->id_qhcb?>" />
	<div id="button_quatrinh" class="modal-footer">
		<button data-dismiss="modal" class="btn btn-small btn_remove_quatrinh">Hủy bỏ</button>
		<button class="btn btn-small btn-primary btn_save_canhanguinhucaudaotao" index="-1">Lưu</button>
	</div>				
</form>
<script type="text/javascript">
jQuery(document).ready(function($){
	$.validator.addMethod("greaterThan", function (value, element, param) {
		var $min = $(param);
		if (this.settings.onfocusout) {
			$min.off(".validate-greaterThan").on("blur.validate-greaterThan", function () {
				$(element).valid();
			});
		}
	return parseInt(value) > parseInt($min.val());
	});
	$('#data_frmQuyhoachcanbo').validate({
		ignore: ':hidden',
		rules: {
			'emp_id': {
				required: true,
			},
			'pos_system_id': {
				required: true,
			},
			'start_year': {
				required: true,
				number:true,
				min:0,
			},
			'end_year': {
				required: true,
				number:true,
				min:0,
				greaterThan: '#start_year'
			},
		},
		messages: {
			'emp_id': {
				required: "Bắt buộc nhập.",
			},
			'pos_system_id': {
				required: "Vui lòng chọn.",
			},
			'start_year': {
				required: "Bắt buộc nhập.",
				number:"Sai định dạng",
				min:"Sai định dạng",
			},
			'end_year': {
				required: "Bắt buộc nhập.",
				number:"Sai định dạng",
				min:"Sai định dạng",
				greaterThan:"Năm kết thúc phải hơn năm bắt đầu",
			},
		},
		submitHandler: function(){
			$.blockUI({ timeout:1000});
			$('#position').val($('#pos_system_id').find('option:selected').text());
			var data_frmQuyhoachcanbo = $('#data_frmQuyhoachcanbo').serialize();
			var url = '<?php echo JUri::base(true);?>/index.php?option=com_hoso&controller=quyhoachcanbo&task=saveQuyhoachcanbo';
			$.post(url, data_frmQuyhoachcanbo, function(data){
					$('.modal').modal('hide');
					if (data == true){
		                a();
		                loadNoticeBoardSuccess('Thông báo','Xử lý thành công!');
					}
					else loadNoticeBoardError('Thông báo','Có lỗi xảy ra, vui lòng liên hệ quản trị viên.');
			});
			
		},
	});
	$("#pos_system_id option").filter(function() {
	    return this.text == "<?php echo $a[0]->position ?>"; 
	}).attr('selected', true);
	$('body').delegate('#pos_system_id', 'change', function(){
		$('#position').val($('#pos_system_id').find('option:selected').text());
	});
	
});
</script>
