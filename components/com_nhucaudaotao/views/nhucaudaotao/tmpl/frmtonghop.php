<?php 
defined( '_JEXEC' ) or die( 'Truy cập không hợp lệ' );
@$data_nhucaudaotao = $this->datadb_nhucaudaotao;
$model = Core::model('Daotao/Nhucaudaotao');
$iscn=(int)$model->getIscn($data_nhucaudaotao[0]->id_loaitrinhdo);
$donvi_id = $_GET['donvi_id'];
?>
<div class="modal-header">
	<button data-dismiss="modal" class="close" type="button">×</button>
	<h4 id="title_quatrinh" class="blue bigger"><?php if($data_nhucaudaotao[0]->id_ncdt>0) echo "Hiệu chỉnh"; else echo "Thêm mới"?> nhu cầu đào tạo</h4>
</div>
<div style="clear: both;"></div>
<form id="nhucaudaotaoFrmTonghop" name="nhucaudaotaoFrmTonghop" method="post" class="form-horizontal" enctype="multipart/form-data">
	<div style="float:left;width:400px;">
		<div class="control-group">
			<label class="control-label" for="empid">Họ và tên CBCC (<span style="color:red;">*</span>)</label>
			<div class="controls">
				<?php
					echo $model->getCanboById($donvi_id,$data_nhucaudaotao[0]->empid);
				?>
			</div>
		</div>
	</div>
	<div style="float:left;width:400px;">
		<div class="control-group">
			<label class="control-label" for="id_loaitrinhdo">Loại trình độ (<span style="color:red;">*</span>)</label>
			<div class="controls">
				<?php
					echo $model->getLoaitrinhdo($data_nhucaudaotao[0]->id_loaitrinhdo);
				?>
			</div>
		</div>
	</div>
	<div style="float:left;width:400px;" id="div_id_chuyennganh">
		<?php
		if(isset($data_nhucaudaotao[0]->id_loaitrinhdo)){ 
		if ($data_nhucaudaotao[0]->id_loaitrinhdo == -1) {?>
		<div class="control-group">
			<label class="control-label" for="id_chuyennganh">Chuyên ngành(<span style="color:red;">*</span>)</label>
			<div class="controls">
				<input id="id_chuyennganh" name="id_chuyennganh" value="-1" type="hidden">
				<input name="name_chuyennganhinput" id="name_chuyennganhinput" value="<?php echo $data_nhucaudaotao[0]->name_chuyennganh?>">
			</div>
		</div>
		<?php }
		elseif
		 ($iscn== 1){ ?>
		<div class="control-group">
			<label class="control-label" for="id_chuyennganh">Chuyên ngành(<span style="color:red;">*</span>)</label>
			<div class="controls">
				<?php 
					echo $model->getChuyennganhByLoaitrinhdo($data_nhucaudaotao[0]->id_loaitrinhdo,$data_nhucaudaotao[0]->id_chuyennganh);
				?>
			</div>
		</div>
		<?php }}?>
	</div>
	<div style="float:left;width:400px;" id="div_id_trinhdo">
		<?php
		if(isset($data_nhucaudaotao[0]->id_trinhdo)){
			if ($data_nhucaudaotao[0]->id_loaitrinhdo == -1) {?>
			<div class="control-group">
				<label class="control-label" for="id_trinhdo">Trình độ(<span style="color:red;">*</span>)</label>
				<div class="controls">
					<input id="id_trinhdo" name="id_trinhdo" value="-1" type="hidden">
					<input name="name_trinhdoinput" id="name_trinhdoinput" value="<?php echo $data_nhucaudaotao[0]->name_trinhdo?>">
				</div>
			</div>
			<?php }
			elseif($iscn==1){ ?>
			<div class="control-group">
				<label class="control-label" for="id_trinhdo">Trình độ(<span style="color:red;">*</span>)</label>
				<div class="controls">
					<?php 
						echo $model->getTrinhdoByChuyennganh($data_nhucaudaotao[0]->id_trinhdo,$data_nhucaudaotao[0]->id_chuyennganh);
					?>
				</div>
			</div>
			<?php }elseif($iscn==0){ ?>
			<div class="control-group">
				<label class="control-label" for="id_trinhdo">Trình độ(<span style="color:red;">*</span>)</label>
				<div class="controls">
					<?php 
						echo $model->getTrinhdoByLoaitrinhdo($data_nhucaudaotao[0]->id_trinhdo,$data_nhucaudaotao[0]->id_loaitrinhdo);
					?>
				</div>
			</div>
		<?php }}?>
	</div>
	<div style="float:left;width:400px;" id="div_id_trinhdo">
	</div>
	<div style="float:left;width:400px;">
		<div class="control-group">
			<label class="control-label" for="ngaydangky_nhucaudaotao">Ngày đăng ký</label>
			<div class="controls">
				<input type="text" class="required" readonly="readonly" id="ngaydangky_nhucaudaotao" name="ngaydangky_nhucaudaotao" value="<?php echo date('d/m/Y')?>" />
			</div>
		</div>
	</div>
	<div style="clear: both;"></div>
	<input type="hidden" id="name_loaitrinhdo" name="name_loaitrinhdo" value="<?php echo $data_nhucaudaotao[0]->name_loaitrinhdo;?>" />
	<input type="hidden" id="name_trinhdo" name="name_trinhdo" value="<?php echo $data_nhucaudaotao[0]->name_trinhdo;?>" />
	<input type="hidden" id="name_chuyennganh" name="name_chuyennganh" value="<?php echo $data_nhucaudaotao[0]->name_chuyennganh;?>" />
	<input type="hidden" id="id_ncdt" name="id_ncdt" value="<?php echo $data_nhucaudaotao[0]->id_ncdt;?>" />
	<div style="clear: both;"></div>
	<div id="button_quatrinh" class="modal-footer">
		<button data-dismiss="modal" class="btn btn-small btn_remove_quatrinh">Hủy bỏ</button>
		<button class="btn btn-small btn-primary btn_save_canhanguinhucaudaotao" index="-1">Lưu</button>
	</div>				
</form>
<script type="text/javascript">
jQuery(document).ready(function($){
	var id = <?php echo $_GET['donvi_id']?>;
	$('#nhucaudaotaoFrmTonghop').validate({
		ignore: ':hidden',
		rules: {
			'empid': {
				required: true,
			},
			'id_loaitrinhdo': {
				required: true,
			},
			'id_chuyennganh': {
				required: true,
			},
			'id_trinhdo': {
				required: true,
			},
			'name_chuyennganh': {
				required: true,
			},
			'name_trinhdo': {
				required: true,
			},
			'name_chuyennganhinput': {
				required: true,
			},
			'name_trinhdoinput': {
				required: true,
			}
		},
		messages: {
			'empid': {
				required: "Bắt buộc nhập.",
			},
			'id_loaitrinhdo': {
				required: "Bắt buộc nhập.",
			},
			'id_chuyennganh': {
				required: "Vui lòng chọn.",
			},
			'id_trinhdo': {
				required: "Bắt buộc nhập.",
			},
			'name_chuyennganh': {
				required: "Bắt buộc nhập.",
			},
			'name_trinhdo': {
				required: "Bắt buộc nhập.",
			},
			'name_chuyennganhinput': {
				required: "Bắt buộc nhập.",
			},
			'name_trinhdoinput': {
				required: "Bắt buộc nhập.",
			},
		},
		submitHandler: function(){
			$.blockUI({ timeout:1000});
			var data_nhucaudaotaoFrm = $('#nhucaudaotaoFrmTonghop').serialize();
			var url = '<?php echo JUri::base(true);?>/index.php?option=com_nhucaudaotao&controller=nhucaudaotao&format=raw&task=saveCanhanguinhucaudaotao';
			$.post(url, data_nhucaudaotaoFrm, function(data){
					if (data==1) {
						$('.modal').modal('hide');
		                $.unblockUI;
		                refreshData();
					}
					else {alert('CBCC đã được đào tạo trình độ này. Vui lòng chọn trình độ khác.');}
			});
			
		},
	});
	
	$.date = function(dateObject) {
	    var d = new Date(dateObject);
	    var day = d.getDate();
	    var month = d.getMonth() + 1;
	    var year = d.getFullYear();
	    if (day < 10) {
	        day = "0" + day;
	    }
	    if (month < 10) {
	        month = "0" + month;
	    }
	    var date = day + "/" + month + "/" + year;

	    return date;
	};
});
</script>