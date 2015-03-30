<div class="span4">
	<div class="control-group">
		<label class="control-label" for="bienche_ngaybatdau">'+data[0].text_ngaybatdau;
		if (data[0].valid_ngaybatdau=='required') (<span style="color:red;">*</span>) </label>
		<div class="controls">
			<div class="row-fluid">
					<input id="bienche_ngaybatdau" name="bienche_ngaybatdau" autocomplete="off" class="input-medium date-picker '+data[0].valid_ngaybatdau+'">
					<span class="add-on"> <i class="icon-calendar"></i></span>
			</div>
		</div>
	</div>
</div>
if (data[0].is_hinhthuctuyendung==1){
	<div class="span4">
		<div class="control-group">
			<label class="control-label" for="id_hinhthuctuyendung">Hình thức tuyển dụng (<span style="color:red;">*</span>)</label>
			<div class="controls">
			<div class="row-fluid" id="div_id_hinhthuctuyendung" style="width:70%">'
				</div>
			</div>
		</div>
	</div>
			url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=getHinhthuctuyendung',
}
if (data[0].is_thietlapthoihan==1){
	<div class="span4">
		<div class="control-group">
			<label class="control-label" for="id_thietlapthoihan">Thiết lập thời hạn (<span style="color:red;">*</span>)</label>
			<div class="controls">
			<div class="row-fluid" id="div_id_thietlapthoihan" style="width:70%">'
				</div>
			</div>
		</div>
	</div>
			url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=getThietlapthoihan',
}

<div class="span4">
	<div class="control-group">
		<label class="control-label" for="bienche_ngayketthuc">'+data[0].text_ngayketthuc+'</label>
		<div class="controls">
			<div class="row-fluid">
					<input name="bienche_ngayketthuc" id="bienche_ngayketthuc" autocomplete="off" class="input-medium date-picker '+data[0].valid_ngayketthuc+'">
					<span class="add-on"> <i class="icon-calendar"></i></span>
			</div>
		</div>
	</div>
</div>

<div class="span4">
	<div class="control-group">
		<label class="control-label" for="bienche_coquanraquyetdinh
">'+data[0].text_coquanraquyetdinh;
if (data[0].valid_coquanraquyetdinh=='required')  (<span style="color:red;">*</span>)
</label>
		<div class="controls">
			<div class="row-fluid">
					<input id="bienche_coquanraquyetdinh" name="bienche_coquanraquyetdinh
" autocomplete="off" class="input-medium '+data[0].valid_coquanraquyetdinh+'">
			</div>
		</div>
	</div>
</div>

<div class="span4">
	<div class="control-group">
		<label class="control-label" for="bienche_soquyetdinh
">'+data[0].text_soquyetdinh;
if (data[0].valid_soquyetdinh=='required')  (<span style="color:red;">*</span>)
</label>
		<div class="controls">
			<div class="row-fluid">
					<input id="bienche_soquyetdinh" name="bienche_soquyetdinh
" autocomplete="off" class="input-medium '+data[0].valid_soquyetdinh+'">
			</div>
		</div>
	</div>
</div>
<div class="span4">
	<div class="control-group">
		<label class="control-label" for="bienche_ngaybanhanh
">'+data[0].text_ngaybanhanh;
if (data[0].valid_ngaybanhanh=='required')  (<span style="color:red;">*</span>)
</label>
		<div class="controls">
			<div class="row-fluid">
					<input id="bienche_ngaybanhanh" name="bienche_ngaybanhanh
" autocomplete="off" class="input-medium date-picker '+data[0].valid_ngaybanhanh+'">
					<span class="add-on"> <i class="icon-calendar"></i></span>
			</div>
		</div>
	</div>
</div>