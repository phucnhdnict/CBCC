<?php
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.formvalidation');
JHTML::_('behavior.tooltip');

$model			=	Core::model('Kekhaitaisan/Kekhaitaisan');
$nguoikekhai	=	$this->nguoikekhai;
$hosochinh_id	=	$this->hosochinh_id;
$vochong		=	$this->vochong;
$concai			=	$this->concai;
// tài sản type: 1 nhà, 2 đất, 3 tài sản khác
if (isset($_REQUEST['dotkekhai']))
	$dotkekhai_id 	= $_REQUEST['dotkekhai'];
else
	$dotkekhai_id = $model->getLastDotkekhai($hosochinh_id);
$taisandb		=	$model->getTaisan($hosochinh_id,$dotkekhai_id);
$taisan			=	$this->taisan_kk;
$taisan_cb		=	$this->taisan_cb;
$capcongtrinh           =	$this->capcongtrinh;
$hokhau_city            =	$this->hokhau_city;
$loainha		=	$this->loainha;
$dotkekhai		=	$this->dotkekhai;
$tmp = array();
$tmp[]		= array('id'=>'','name'=>'-- Chọn đợt --');
$tmp 		= array_merge($tmp, $dotkekhai);
$dotkekhai =  JHTML::_('select.genericlist',$tmp,'dot_kekhai','class="inputbox width_taisan_id chosen" size="1"','id','name',$dotkekhai_id);
?>
<style type="text/css">
.width_max{width:692px;}
.width_taisan_id{width:220px;}
.width_loainha{width:220px;}
.chosen-container .chosen-drop {
    border-bottom: 1;
	z-index: 9999;
    border-top: 1px solid #aaa;
	top: auto;
	bottom: auto;
	overflow: hidden;
}
</style>
<form id="kekhaitaisanForm" name="kekhaitaisanForm" class="form-horizontal form-validate">
<fieldset>
<legend>Kê khai tài sản, thu nhập
	<span class="pull-right inline">
		<?php echo $dotkekhai;?>
		<button class="btn btn-small btn-primary" id="btn_luutieptuc_kekhaitaisan" style="margin-right: 5px;">
			<i class="icon-ok"></i> Lưu và tiếp tục
		</button>
		<span class="btn btn-small btn-danger" id="btn_quaylai_kekhaitaisan" style="margin-right: 5px;" data-placement="top" title="">
			<i class="icon-refresh"></i> Quay lại
		</span>
	</span>
</legend>
<div id="accordion2" class="accordion">
	<div class="accordion-group">
		<div class="accordion-heading">
			<a href="#collapseOne" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
				I. Thông tin chung
			</a>
		</div>
		<div class="accordion-body in collapse" id="collapseOne">
			<div class="accordion-inner" style="min-height: 200px; overflow-x: hidden;">
<!-- Người kê khai -->
				<div class="span8">
					<div class="control-group">
						<label>1. Người kê khai tài sản, thu nhập</label>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label class="control-label">Họ tên </label>
						<div class="controls">
							<input type="text" disabled="disabled" value="<?php echo $nguoikekhai[0]->hoten; ?>"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Chức vụ </label>
						<div class="controls">
							<input type="text" disabled="disabled" value="<?php echo $nguoikekhai[0]->congtac_chucvu; ?>"/>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label class="control-label">Năm sinh </label>
						<div class="controls">
							<input type="text" disabled="disabled" value="<?php echo date("Y", strtotime($nguoikekhai[0]->ngaysinh)) ; ?>"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Đơn vị công tác </label>
						<div class="controls">
							<input type="text"  disabled="disabled" value="<?php echo $nguoikekhai[0]->name; ?>"/>
						</div>
					</div>
				</div>
				<div class="span16">
					<div class="control-group">
						<label class="control-label">Hộ khẩu thường trú </label>
						<div class="controls">
							<div style="float: left;"><?php echo $model->getCboCityPer($nguoikekhai[0]->city_peraddress,1,'nguoikekhai_hokhau_city');?></div>
							<div style="float: left;"><?php echo $model->getCboDistPer($nguoikekhai[0]->city_peraddress,$nguoikekhai[0]->dist_peraddress,1,'nguoikekhai_hokhau_dist');?></div>
							<div style="float: left;"><?php echo $model->getCboCommPer($nguoikekhai[0]->dist_peraddress,$nguoikekhai[0]->comm_peraddress,1,'nguoikekhai_hokhau_comm');?></div>
						</div>
					</div>
				</div>
				<div class="span16">
					<div class="control-group">
						<label class="control-label">Chỗ ở hiện tại </label>
						<div class="controls">
							<input style="width:606px" type="text"  disabled="disabled" value="<?php echo $nguoikekhai[0]->per_residence; ?>"/>
						</div>
					</div>
				</div>
	<!-- end người kê khai -->
	<!-- Vợ chồng -->
				<div class="span8">
					<div class="control-group">
						<label>2. Vợ hoặc chồng của người kê khai tài sản, thu nhập</label>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label class="control-label" for="vochong_hoten">Họ tên </label>
						<div class="controls">
							<input type="text" id="vochong_hoten" name="vochong_hoten" value="<?php echo $vochong[0]->hoten; ?>" placeholder="Nhập họ tên" />
							<input type="hidden" id="vochong_id" name="vochong_id" value="<?php echo $vochong[0]->id?>"/>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label class="control-label">Năm sinh </label>
						<div class="controls">
							<input type="text" id="vochong_namsinh" name="vochong_namsinh" value="<?php echo $vochong[0]->namsinh ?>" placeholder="Nhập năm sinh" />
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label class="control-label">Quan hệ </label>
						<div class="controls">
							<?php echo $model->getCboRelation($vochong[0]->relative_code_id,'vochong_relative_code_id'); ?>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label class="control-label">Chức vụ </label>
						<div class="controls">
							<input type="text" id="vochong_chucvu" name="vochong_chucvu" value="<?php echo $vochong[0]->chucvu ?>" placeholder="Nhập chức vụ" />
						</div>
					</div>
				</div>
				<div class="span8">
					<div class="control-group">
						<label class="control-label">Đơn vị công tác </label>
						<div class="controls">
							<input type="text" id="vochong_coquan" style="width:606px" name="vochong_coquan" value="<?php echo $vochong[0]->coquan ?>" placeholder="Nhập đơn vị công tác" />
						</div>
					</div>
				</div>
				<div class="span10">
					<div class="control-group">
						<label class="control-label">Hộ khẩu thường trú </label>
						<div class="controls">
							<input type='hidden' name='vochong_id' id='vochong_id' value="<?php echo $vochong[0]->id?>"/>
							<div id="vochong_hokhaucity" style="float: left;"><?php echo $model->getCboCityPer($vochong[0]->hokhau_tinhthanh,0,'vochong_hokhau_city');?></div>
							<div id="vochong_hokhaudist" style="float: left;"><?php echo $model->getCboDistPer($vochong[0]->hokhau_tinhthanh,$vochong[0]->hokhau_quanhuyen,0,'vochong_hokhau_dist');?></div>
							<div id="vochong_hokhaucomm" style="float: left;"><?php echo $model->getCboCommPer($vochong[0]->hokhau_quanhuyen,$vochong[0]->hokhau_phuongxa,0,'vochong_hokhau_comm');?></div>
						</div>
					</div>
				</div>
				<div class="span8">
					<div class="control-group">
						<label class="control-label">Chỗ ở hiện tại </label>
						<div class="controls">
							<input type="text" id="vochong_choohientai" style="width:606px" name="vochong_choohientai" value="<?php echo $vochong[0]->choohientai; ?>" placeholder="Nhập chỗ ở hiện tại" />
						</div>
					</div>
				</div>
<!-- end vợ chồng -->
<!-- 3. Con chưa thành niên (con đẻ, con nuôi theo quy định của pháp luật) -->
				<div class="span8">
					<div class="control-group">
						<label style="float:left">3. Con chưa thành niên (con đẻ, con nuôi theo quy định của pháp luật)</label>
						<span class="btn btn-success btn-small" style="float:right" id="insert_concai_new">+</span>
						<input type="hidden" id="concai_sum" value="<?php echo count($concai)?>">
					</div>
				</div>
<!-- 	for lấy ra dsách con -->
				<div id="div_concai">
				<?php
				$j='a';
					for ($i = 0; $i < count($concai); $i++) {
				?>
				<div class="div_concai_new">
						<div class="span8">
							<div class="control-group">
								<label><?php echo $j;?>. Con thứ <?php echo ($i+1);?> <?php if($i!=0){?><span class="btn btn-danger btn-xoa-concai icon-trash bigger-200 btn-small" style="float:right"></span><?php }?></label>
								<input type="hidden" id="concai_old_id<?php echo $i;?>" name="concai_old_id<?php echo $i;?>" value="<?php echo $concai[$i]->id?>"/>
							</div>
						</div>
						<div class="span4">
							<div class="control-group">
								<label class="control-label" for="concai_old_hoten<?php echo $i;?>">Họ tên </label>
								<div class="controls">
									<input type="text" id="concai_old_hoten<?php echo $i;?>" name="concai_old_hoten<?php echo $i;?>" value="<?php echo $concai[$i]->hoten; ?>" placeholder="Nhập tên" />
								</div>
							</div>
						</div>
						<div class="span4">
							<div class="control-group">
								<label class="control-label" for="concai_old_namsinh<?php echo $i;?>">Năm sinh </label>
								<div class="controls">
									<input type="text" id="concai_old_namsinh<?php echo $i;?>" name="concai_old_namsinh<?php echo $i;?>" value="<?php echo $concai[$i]->namsinh; ?>" placeholder="Nhập năm sinh" />
								</div>
							</div>
						</div>
						<div class="span10">
							<div class="control-group">
								<label class="control-label">Hộ khẩu thường trú </label>
								<div class="controls">
									<input type='hidden' name='concai_id<?php echo $i?>' id='concai_id<?php echo $i?>' value="<?php echo $concai[$i]->id?>"/>
									<div style="position:relative">
										<div id="concai_old_hokhaucity<?php echo $i?>" style="float: left;"><?php echo $model->getCboCityPer($concai[$i]->hokhau_tinhthanh,0,'concai_old_hokhau_city'.$i);?></div>
										<div id="concai_old_hokhaudist<?php echo $i?>" style="float: left;"><?php echo $model->getCboDistPer($concai[$i]->hokhau_tinhthanh,$concai[$i]->hokhau_quanhuyen,0,'concai_old_hokhau_dist'.$i);?></div>
										<div id="concai_old_hokhaucomm<?php echo $i?>" style="float: left;"><?php echo $model->getCboCommPer($concai[$i]->hokhau_quanhuyen,$concai[$i]->hokhau_phuongxa,0,'concai_old_hokhau_comm'.$i);?></div>
									</div>
								</div>
							</div>
						</div>
						<div class="span8">
							<div class="control-group">
								<label class="control-label" for="concai_old_choohientai<?php echo $i;?>">Chỗ ở hiện tại </label>
								<div class="controls">
									<input style="width:606px" type="text" id="concai_old_choohientai<?php echo $i;?>" name="concai_old_choohientai<?php echo $i;?>" value="<?php echo $concai[$i]->choohientai; ?>" placeholder="Nhập chỗ ở hiện tại" />
								</div>
							</div>
						</div>
						<div class="span8">
							<div class="control-group">
								<hr>
							</div>
						</div>
					</div>
				<?php $j++;}?>
		<!-- 	end for			 -->
		<!-- end con chưa thành niên -->
						</div>
				</div>
		</div>
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a href="#collapseTwo" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
				II. Thông tin mô tả về tài sản
			</a>
		</div>
		<div class="accordion-body in collapse" id="collapseTwo">
			<div class="accordion-inner">
	<!-- tài sản -->
		<?php
			for ($i = 0; $i < count($taisan); $i++) {

				$data = $taisan[$i];
				$j = $i + 1;
		?>
			<h6><?php echo $j.'. '.$taisan[$i]['tenloaitaisan'];?></h6>
		<?php
				// dựa vào type để phân loại nhà, đất.....
				switch ($data['type']) {
					case 1:  // Nhà ở, công trình xây dựng khác
					$k = 0;
					foreach ($taisan_cb[$data['id']] as $key=>$value) {
						$k += 1;
		?>
			<div class="widget-box">
				<div class="widget-header">
					<h6><?php echo $j.'.'.$k.' '.$value; ?></h6>
					<span class="widget-toolbar">
						<a href="#" data-action="collapse">
							<i class="icon-chevron-down"></i>
						</a>
					</span>
				</div>
				<div class="widget-body">
					<span class="btn btn-success btn-small pull-right" title="Thêm mới" id_taisan="<?php echo $key ?>" id="insert_nha_congtrinh_<?php echo $k;?>">+</span>
					</br>
					<div class="widget-main" id="nha_congtrinh_<?php echo $k;?>"> 
						<?php $tmp_nha=0;
						for($tsn=0; $tsn<count($taisandb);$tsn++) {
							if($taisandb[$tsn]->taisan_id == $key){
								$tmp_nha +=1;
							?>
						<div class="nhaocongtrinh">
							<div class="row-fluid">
								<span title="Xóa" class="btn btn-danger btn-xoa-nha_congtrinh icon-trash bigger-200 btn-small pull-right" ></span>
								<div class="control-group">
									<label class="control-label" for="nha_ten<?php echo $i;?>"><?php if($key==10) echo "Tên nhà"; elseif($key==11) echo "Tên công trình"?> (<span style="color:red;">*</span>)</label>
									<div class="controls">
										<input type="text" id="nha_ten<?php echo $i;?>" name="nha_ten[]" class="width_max required" value="<?php echo $taisandb[$tsn]->value; ?>" placeholder="Nhập tên" />
										<input type="hidden" value="<?php echo $key ?>" name="nha_taisan_id[]"/>
									</div>
								</div>
							</div>
							<div class="row-fluid">
							<div class="span5">
								<div class="control-group">
									<label class="control-label" >Loại <?php if($key==10) echo "nhà"; elseif($key==11) echo "công trình"?></label>
									<div class="controls">
								<?php
									$assigned = array();
									if($key==10)	$assigned[]		= array('id'=>'','name'=>'-- Chọn loại nhà --');
									if($key==11)	$assigned[]		= array('id'=>'','name'=>'-- Chọn loại công trình --');
									$assigned 		= array_merge($assigned, $loainha);
									echo JHTML::_('select.genericlist',$assigned,'nha_loainha_id[]','class="inputbox width_taisan_id chosen" size="1"','id','name',$taisandb[$tsn]->loainha_id);
								?>
									</div>
								</div>
							</div>
							<div class="span5">
								<div class="control-group">
									<label class="control-label">Cấp công trình</label>
									<div class="controls">
									<?php
										$assigned = array();
										$assigned[]		= array('id'=>'','name'=>'-- Chọn cấp công trình --');
										$assigned 		= array_merge($assigned, $capcongtrinh);
										echo JHTML::_('select.genericlist',$assigned,'nha_capcongtrinh_id[]','class="inputbox width_taisan_id chosen" size="1"','id','name',$taisandb[$tsn]->capcongtrinh_id);
									?>
									</div>
								</div>
							</div>
							</div>
							<div class="row-fluid">
							<div class="span5">
								<div class="control-group" for="nha_dientich<?php echo $i;?>">
									<label class="control-label">Diện tích xây dựng</label>
									<div class="controls">
										<input type="text" id="nha_dientich<?php echo $i;?>" class="" name="nha_dientich[]" value="<?php echo $taisandb[$tsn]->dientich; ?>" placeholder="Nhập diện tích" />
									</div>
								</div>
							</div>
							<div class="span5">
								<div class="control-group">
									<label class="control-label" for="nha_giatri<?php echo $i;?>">Giá trị</label>
									<div class="controls">
										<input type="text" id="nha_giatri" name="nha_giatri[]" class="money" style="text-align:right" value="<?php echo $taisandb[$tsn]->trigia; ?>" placeholder="Nhập giá trị" />
									</div>
								</div>
							</div>
							</div>
							<div class="row-fluid">
								<div class="control-group">
									<label class="control-label" for="nha_gcn<?php echo $i;?>">GCN quyền sở hữu</label>
									<div class="controls">
										<input type="text" id="nha_gcn" name="nha_gcn[]" class="width_max" value="<?php echo $taisandb[$tsn]->giaychungnhan; ?>" placeholder="Nhập giấy chứng nhận quyền sở hữu" />
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="control-group">
									<label class="control-label">Thông tin khác (Nếu có)</label>
									<div class="controls">
										<input type="text" id="nha_thongtinkhac" name="nha_thongtinkhac[]" class="width_max" value="<?php echo $taisandb[$tsn]->thongtinkhac; ?>" placeholder="Nhập thông tin khác" />
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="control-group">
									<hr>
								</div>
							</div>
						</div>
			<?php }} 
					if ($tmp_nha<1) {?>
					<div class="nhaocongtrinh">
							<div class="row-fluid">
								<span title="Xóa" class="btn btn-danger btn-xoa-nha_congtrinh icon-trash bigger-200 btn-small pull-right" ></span>
								<div class="control-group">
									<label class="control-label" for="nha_ten<?php echo $i;?>"><?php if($key==10) echo "Tên nhà"; elseif($key==11) echo "Tên công trình"?> (<span style="color:red;">*</span>)</label>
									<div class="controls">
										<input type="text" id="nha_ten<?php echo $i;?>" name="nha_ten[]" class="width_max required" value="<?php echo $taisandb[$tsn]->value; ?>" placeholder="Nhập tên" />
										<input type="hidden" value="<?php echo $key ?>" name="nha_taisan_id[]"/>
									</div>
								</div>
							</div>
							<div class="row-fluid">
							<div class="span5">
								<div class="control-group">
									<label class="control-label" >Loại <?php if($key==10) echo "nhà"; elseif($key==11) echo "công trình"?></label>
									<div class="controls">
								<?php
									$assigned = array();
									if($key==10)	$assigned[]		= array('id'=>'','name'=>'-- Chọn loại nhà --');
									if($key==11)	$assigned[]		= array('id'=>'','name'=>'-- Chọn loại công trình --');
									$assigned 		= array_merge($assigned, $loainha);
									echo JHTML::_('select.genericlist',$assigned,'nha_loainha_id[]','class="inputbox width_taisan_id chosen" size="1"','id','name',$taisandb[$tsn]->loainha_id);
								?>
									</div>
								</div>
							</div>
							<div class="span5">
								<div class="control-group">
									<label class="control-label">Cấp công trình</label>
									<div class="controls">
									<?php
										$assigned = array();
										$assigned[]		= array('id'=>'','name'=>'-- Chọn cấp công trình --');
										$assigned 		= array_merge($assigned, $capcongtrinh);
										echo JHTML::_('select.genericlist',$assigned,'nha_capcongtrinh_id[]','class="inputbox width_taisan_id chosen" size="1"','id','name',$taisandb[$tsn]->capcongtrinh_id);
									?>
									</div>
								</div>
							</div>
							</div>
							<div class="row-fluid">
							<div class="span5">
								<div class="control-group">
									<label class="control-label">Diện tích xây dựng</label>
									<div class="controls">
										<input type="text" class="" name="nha_dientich[]" value="<?php echo $taisandb[$tsn]->dientich; ?>" placeholder="Nhập diện tích" />
									</div>
								</div>
							</div>
							<div class="span5">
								<div class="control-group">
									<label class="control-label" >Giá trị</label>
									<div class="controls">
										<input type="text"  name="nha_giatri[]" class="money" style="text-align:right" value="<?php echo $taisandb[$tsn]->trigia; ?>" placeholder="Nhập giá trị" />
									</div>
								</div>
							</div>
							</div>
							<div class="row-fluid">
								<div class="control-group">
									<label class="control-label" >GCN quyền sở hữu</label>
									<div class="controls">
										<input type="text"  name="nha_gcn[]" class="width_max" value="<?php echo $taisandb[$tsn]->giaychungnhan; ?>" placeholder="Nhập giấy chứng nhận quyền sở hữu" />
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="control-group">
									<label class="control-label">Thông tin khác (Nếu có)</label>
									<div class="controls">
										<input type="text" name="nha_thongtinkhac[]" class="width_max" value="<?php echo $taisandb[$tsn]->thongtinkhac; ?>" placeholder="Nhập thông tin khác" />
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="control-group">
									<hr>
								</div>
							</div>
						</div>
					<?php }?>
					</div>
				</div>
			</div>
		<?php }	?>
		<?php
					break;
					case 2: // Quyền sử dụng đất
					$k = 0;
					foreach ($taisan_cb[$data['id']] as $key=>$value) {
						$k += 1;
		?>
			<div class="widget-box "> <!-- collapsed nếu cần đóng-->
				<div class="widget-header">
					<h6><?php echo $j.'.'.$k.' '.$value; ?></h6>
					<span class="widget-toolbar">
						<a href="#" data-action="collapse">
							<i class="icon-chevron-down"></i>
						</a>
					</span>
				</div>
				<div class="widget-body" >
					<span class="btn btn-success btn-small pull-right" title="Thêm mới" id_taisan="<?php echo $key ?>" id="insert_quyensudungdat_<?php echo $k;?>">+</span>
					<br/>
					<div class="widget-body-inner" style="display: block;"	>
						<div  class="widget-main" id="quyensudungdat_<?php echo $k;?>"> <br/>
						<?php
							$tmp_dat = 0;
							for($ts=0; $ts<count($taisandb);$ts++) {
							if($taisandb[$ts]->taisan_id == $key){
								$tmp_dat +=1;
						?>
							<div class="quyensudungdat" >
								<div class="row-fluid">
									<span title="Xóa" class="btn btn-danger btn-xoa-quyensudungdat icon-trash bigger-200 btn-small pull-right" ></span>
									<div class="control-group">
										<label class="control-label">Tên mảnh đất (<span style="color:red;">*</span>)</label>
										<div class="controls">
											<input type="text" id="dat_ten" name="dat_ten[]" class="width_max" value="<?php echo $taisandb[$ts]->value;?>" placeholder="Nhập tên" />
											<input type="hidden" value="<?php echo $key ?>" name="dat_taisan_id[]"/>
										</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="control-group">
										<label class="control-label">Địa chỉ</label>
										<div class="controls">
											<input type="text" id="dat_diachi" name="dat_diachi[]" class="width_max" value="<?php echo $taisandb[$ts]->diachi; ?>" placeholder="Nhập địa chỉ" />
										</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span5">
										<div class="control-group">
											<label class="control-label">Diện tích xây dựng</label>
											<div class="controls">
												<input type="text" id="dat_dientich" name="dat_dientich[]" value="<?php echo $taisandb[$ts]->dientich; ?>" placeholder="Nhập diện tích" />
											</div>
										</div>
									</div>
									<div class="span5">
										<div class="control-group">
											<label class="control-label">Giá trị</label>
											<div class="controls">
												<input type="text" id="dat_giatri" name="dat_giatri[]" value="<?php echo $taisandb[$ts]->trigia; ?>" placeholder="Nhập giá trị" />
											</div>
										</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="control-group">
										<label class="control-label">GCN quyền sở hữu</label>
										<div class="controls">
											<input type="text" id="dat_gcn" name="dat_gcn[]" class="width_max" value="<?php echo $taisandb[$ts]->giaychungnhan; ?>" placeholder="Nhập giấy chứng nhận quyền sở hữu" />
										</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="control-group">
										<label class="control-label">Thông tin khác (Nếu có)</label>
										<div class="controls">
											<input type="text" id="dat_thongtinkhac" name="dat_thongtinkhac[]" class="width_max" value="<?php echo $taisandb[$ts]->thongtinkhac; ?>" placeholder="Nhập thông tin khác" />
										</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="control-group">
										<hr>
									</div>
								</div>
							</div>
						<?php }}
						if($tmp_dat<1){?>
							<div class="quyensudungdat" >
								<div class="row-fluid">
									<span title="Xóa" class="btn btn-danger btn-xoa-quyensudungdat icon-trash bigger-200 btn-small pull-right" ></span>
									<div class="control-group">
										<label class="control-label" for="dat_tennull">Tên mảnh đất (<span style="color:red;">*</span>)</label>
										<div class="controls">
											<input type="text" id="dat_tennull" name="dat_ten[]" class="width_max required" placeholder="Nhập tên" />
											<input type="hidden" value="<?php echo $key ?>" name="dat_taisan_id[]"/>
										</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="control-group">
										<label class="control-label">Địa chỉ</label>
										<div class="controls">
											<input type="text" id="dat_diachi" name="dat_diachi[]" class="width_max" placeholder="Nhập địa chỉ" />
										</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span5">
										<div class="control-group">
											<label class="control-label">Diện tích xây dựng</label>
											<div class="controls">
												<input type="text" id="dat_dientich" name="dat_dientich[]" placeholder="Nhập diện tích" />
											</div>
										</div>
									</div>
									<div class="span5">
										<div class="control-group">
											<label class="control-label">Giá trị</label>
											<div class="controls">
												<input type="text" id="dat_giatri" name="dat_giatri[]"  placeholder="Nhập giá trị" />
											</div>
										</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="control-group">
										<label class="control-label">GCN quyền sở hữu</label>
										<div class="controls">
											<input type="text" id="dat_gcn" name="dat_gcn[]" class="width_max" placeholder="Nhập giấy chứng nhận quyền sở hữu" />
										</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="control-group">
										<label class="control-label">Thông tin khác (Nếu có)</label>
										<div class="controls">
											<input type="text" id="dat_thongtinkhac" name="dat_thongtinkhac[]" class="width_max" placeholder="Nhập thông tin khác" />
										</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="control-group">
										<hr>
									</div>
								</div>
							</div>
						<?php }?>
						</div>
					</div>
				</div>
			</div>
		<?php }	?>
		<?php

			break;
			case 0:
				if (count($taisan_cb[$data['id']]) > 0) { //tài sản có combobox chọn loại tài sản.
// 					echo $data['id'];echo $data['type'];
					?>
					<span class="pull-right inline">
						<span class="btn btn-success btn-small" id_taisan="<?php echo $data['id'] ?>" id="insert_phancap_<?php echo $data['id'];?>">+</span>
					</span>
					<div class="widget-main" id="id_phancap<?php echo $data['id']?>">
						<?php
						for($ts3=0; $ts3<count($taisandb);$ts3++) {
							if($model->checkTaisanParent($taisandb[$ts3]->taisan_id,$data['id'])){
						?>
							<div class="phancap" >
									<div class="row-fluid">
										<div class="control-group">
											<label class="control-label">Loại tài sản</label>
											<div class="controls">
												<?php
													$assigned = array();
													// $assigned[]		= array('id'=>'','name'=>'-- Chọn loại tài sản --');
													$assigned 		= $assigned + $taisan_cb[$data['id']];
													echo JHTML::_('select.genericlist',$assigned,'tsk_taisan_id['.$data['id'].'][]','style="width: 667px" class="inputbox chosen" size="1"','id','name',$taisandb[$ts3]->taisan_id);
												?>
												<span class="btn btn-danger btn-xoa-phancap icon-trash bigger-200 btn-small" ></span>
											</div>
										</div>
									</div>
									<div class="row-fluid">
										<div class="span4">
											<div class="control-group">
												<label  class="control-label" for="tskts3_value<?php echo  $ts3;?>">Tên tài sản (<span style="color:red;">*</span>)</label>
												<div class="controls">
													<textarea rows="1" class="required" id="tskts3_value<?php echo  $ts3;?>" name="tsk_value[<?php echo $data['id']?>][]" placeholder="Nhập tên tài sản" style="width: 200px;"><?php echo $taisandb[$ts3]->value;?></textarea>
												</div>
											</div>
										</div>
										<div class="span4">
											<div class="control-group">
												<label  class="control-label" for="tskts3_giatri<?php echo  $ts3;?>">Giá trị </label>
												<div class="controls">
													<textarea rows="1" class="money" style="text-align:right" id="tskts3_giatri<?php echo  $ts3;?>" name="tsk_giatri[<?php echo $data['id']?>][]" placeholder="Nhập giá trị tài sản" style="width: 300px;"><?php if(isset($taisandb[$ts3]->trigia)) echo $taisandb[$ts3]->trigia;?></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="row-fluid">
										<div class="control-group">
											<hr>
										</div>
									</div>
								</div>
						<?php }}	?>
					</div>
				<?php
				}else { // các tài sản không có combobox
					for($ts4=0; $ts4<count($taisandb);$ts4++) {
						if($taisandb[$ts4]->taisan_id == $data['id']){ $check=true;
							?>
								<div class="row-fluid">
									<div class="span4">
										<div class="control-group">
											<label class="control-label" for="tsk_value4<?php echo $ts4?>"><span id="lbl_value<?php echo $ts4?>">Tên tài sản</span></label>
											<div class="controls">
												<textarea rows="1" id="tsk_value4<?php echo $ts4?>" name="tsk_value[<?php echo $data['id']?>][]" placeholder="Nhập tên tài sản" style="width: 200px;"><?php echo $taisandb[$ts4]->value;?></textarea>
												<input type="hidden" value="<?php echo $data['id'] ?>" name="tsk_taisan_id[<?php echo $data['id']?>][]">
											</div>
										</div>
									</div>
									<div class="span4">
										<div class="control-group">
											<label class="control-label" for="trigia4<?php echo $ts4?>"><span id="lbl_trigia<?php echo $ts4?>">Giá trị</span></label>
											<div class="controls">
												<textarea class="money" style="text-align:right" id="trigia4<?php echo $ts4?>" rows="1" name="tsk_giatri[<?php echo $data['id']?>][]" placeholder="Nhập giá trị tài sản" style="width: 400px;"><?php if(isset($taisandb[$ts4]->trigia)) echo $taisandb[$ts4]->trigia;?></textarea>
											</div>
										</div>
									</div>
								</div>
								<script>
								jQuery(document).ready(function($){
									$('#tsk_value4<?php echo $ts4?>').on('change',function(){
										if ($('#tsk_value4<?php echo $ts4?>').val()!='') {
											$('#lbl_trigia<?php echo $ts4?>').html('Giá trị (<span style="color:red;">*</span>)');
											$('#trigia4<?php echo $ts4?>').addClass('required');
										}
										else {
											$('#lbl_trigia<?php echo $ts4?>').html('Giá trị');
											$('#trigia4<?php echo $ts4?>').removeClass('required');
											// $('#trigia4<?php echo $ts4?>').val('');
											// var no_dist_peraddress = $('option:selected', this).parent().attr('id');
											$('#tsk_value4<?php echo $ts4?>').parentsUntil("div", ".control-group").removeClass('error');
										}
									});
									$('#trigia4<?php echo $ts4?>').on('change',function(){
										if ($('#trigia4<?php echo $ts4?>').val()!='' || $('#trigia4<?php echo $ts4?>').val()!=0) {
											$('#lbl_value<?php echo $ts4?>').html('Tên tài sản (<span style="color:red;">*</span>)');
											$('#tsk_value4<?php echo $ts4?>').addClass('required');
										}
										else {
											$('#lbl_value<?php echo $ts4?>').html('Tên tài sản');
											$('#tsk_value4<?php echo $ts4?>').removeClass('required');
											// $('#tsk_value4<?php echo $ts4?>').val('');
										}
									});
									if ($('#tsk_value4<?php echo $ts4?>').val()!='') $('#lbl_trigia<?php echo $ts4?>').html('Giá trị (<span style="color:red;">*</span>)');
									else $('#lbl_trigia<?php echo $ts4?>').html('Giá trị');
									
								});
								</script>									
							<?php
						}
					}
					if($check==false){?>
						<div class="row-fluid">
							<div class="span4">
								<div class="control-group">
									<label class="control-label" id="lbl_valueelse<?php echo $data['id']?>" for="tsk_valueelse<?php echo $data['id']?>">Tên tài sản </label>
									<div class="controls">
										<textarea rows="1" id="tsk_valueelse<?php echo $data['id']?>" name="tsk_value[<?php echo $data['id']?>][]" placeholder="Nhập tên tài sản" style="width: 200px;"></textarea>
									<input type="hidden" value="<?php echo $data['id'] ?>" name="tsk_taisan_id[<?php echo $data['id']?>][]">
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label" for="trigiaelse<?php echo $data['id']?>"><span id="lbl_trigiaelse<?php echo $data['id']?>">Giá trị</span></label>
									<div class="controls">
										<textarea class="money" style="text-align:right" rows="1" id="trigiaelse<?php echo $data['id']?>" name="tsk_giatri[<?php echo $data['id']?>][]" placeholder="Nhập giá trị tài sản" style="width: 400px;"></textarea>
									</div>
								</div>
							</div>
						</div>
						<script>
						jQuery(document).ready(function($){
							$('#tsk_valueelse<?php echo $data['id']?>').on('change',function(){
								if ($('#tsk_valueelse<?php echo $data['id']?>').val() != ''){
									$('#lbl_trigiaelse<?php echo $data['id']?>').html('Giá trị (<span style="color:red;">*</span>)');
									$('#trigiaelse<?php echo $data['id']?>').addClass('required');
								}
								else {
									$('#lbl_trigiaelse<?php echo $data['id']?>').html('Giá trị');
									$('#trigiaelse<?php echo $data['id']?>').removeClass('required');
									$('#tsk_valueelse<?php echo $data['id']?>').parentsUntil("div", ".control-group").removeClass('error');
								}
							});
							$('#trigiaelse<?php echo $data['id']?>').on('change',function(){
								if ($('#trigiaelse<?php echo $data['id']?>').val() != ''){
									$('#lbl_valueelse<?php echo $data['id']?>').html('Tên tài sản (<span style="color:red;">*</span>)');
									$('#tsk_valueelse<?php echo $data['id']?>').addClass('required');
								}
								else {
									$('#lbl_valueelse<?php echo $data['id']?>').html('Tên tài sản');
									$('#tsk_valueelse<?php echo $data['id']?>').removeClass('required');
								}
							});
						});
						</script>	
					<?php
					}
				}
				break;
			}
		?>
		<?php }?>
<!-- Tài sản -->
			</div>
		</div>
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a href="#collapseThree" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
				III. Giải trình về sự biến động của tài sản
			</a>
		</div>

		<div class="accordion-body collapse" id="collapseThree">
			<div class="accordion-inner">
				Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
			</div>
		</div>
	</div>
</fieldset>
</div>
<input type="hidden" id="hosochinh_id" name="hosochinh_id" value="<?php echo $nguoikekhai[0]->hosochinh_id; ?>" />
<input type="hidden" name="task" id="task" value="" />
<input type="hidden" name="option" value="com_kekhaitaisan" />
<input type="hidden" name="controller" value="khekhaitaisan" />
</form>
<script type="text/javascript">
Joomla.submitbutton = function(task){
	if (task == 'cancel' || document.formvalidator.isValid(document.id('kekhaitaisanForm')))
	{
		Joomla.submitform(task, document.getElementById('kekhaitaisanForm'));
	}
};
var nha_congtrinh = function(nhacongtrinh,id_taisan,loainhann){
	var loainha = <?php echo json_encode($loainha);?>;

    var cb_loainha = '<select id="nha_loainha_id'+id_taisan+'" name="nha_loainha_id[]" class="width_taisan_id chosen required">';
    jQuery.each(loainha,function(i,val){
   	 cb_loainha += '<option value="' + val.id + '">' + val.name + '</option>';
    });
    cb_loainha += '</select>';

    var capcongtrinh = <?php echo json_encode($capcongtrinh);?>;
    var cb_capcongtrinh = '<select id="nha_capcongtrinh_id'+id_taisan+'" name="nha_capcongtrinh_id[]" class="width_taisan_id chosen required">';
    jQuery.each(capcongtrinh,function(i,val){
//         console.log (val.id+'=>'+val.name);
    	cb_capcongtrinh += '<option value="' + val.id + '">' + val.name + '</option>';
    });
    cb_capcongtrinh += '</select>';
	var str = '<div class="nhaocongtrinh"><div class="row-fluid"><span class="btn btn-danger btn-xoa-nha_congtrinh icon-trash bigger-200 btn-small pull-right" ></span>';
	str += '<div class="control-group">';
	str += '<label class="control-label" for="nha_ten'+id_taisan+'">'+nhacongtrinh+'(<span style="color:red;">*</span>)</label>';
	str += '<div class="controls">';
	str += '<input type="text" id="nha_ten'+id_taisan+'" name="nha_ten[]" class="width_max required" value="" placeholder="Nhập tên" />';
	str += '<input type="hidden" value="'+id_taisan+'" name="nha_taisan_id[]"/>';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="row-fluid">';
	str += '<div class="span5">';
	str += '<div class="control-group">';
	str += '<label class="control-label" for="nha_loainha_id'+id_taisan+'">'+loainhann+'</label>';
	str += '<div class="controls">'+cb_loainha;
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="span5">';
	str += '<div class="control-group">';
	str += '<label class="control-label" for="name_capcongtrinh_id'+id_taisan+'">Cấp công trình</label>';
	str += '<div class="controls">'+cb_capcongtrinh;
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="row-fluid">';
	str += '<div class="span5">';
	str += '<div class="control-group">';
	str += '<label class="control-label" for="nha_dientich'+id_taisan+'">Diện tích xây dựng</label>';
	str += '<div class="controls">';
	str += '<input type="text" id="nha_dientich'+id_taisan+'" name="nha_dientich[]" class="" value="" placeholder="Nhập diện tích" />';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="span5">';
	str += '<div class="control-group">';
	str += '<label class="control-label" for="nha_giatri'+id_taisan+'">Giá trị</label>';
	str += '<div class="controls">';
	str += '<input type="text" id="nha_giatri'+id_taisan+'" class="money" style="text-align:right" name="nha_giatri[]" value="" placeholder="Nhập giá trị" />';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="row-fluid">';
	str += '<div class="control-group">';
	str += '<label class="control-label" for="nha_gcn'+id_taisan+'">GCN quyền sở hữu</label>';
	str += '<div class="controls">';
	str += '<input type="text" id="nha_gcn'+id_taisan+'" name="nha_gcn[]" class="width_max" value="" placeholder="Nhập giấy chứng nhận quyền sở hữu" />';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="row-fluid">';
	str += '<div class="control-group">';
	str += '<label class="control-label">Thông tin khác (Nếu có)</label>';
	str += '<div class="controls">';
	str += '<input type="text" id="nha_thongtinkhac" name="nha_thongtinkhac[]" class="width_max" value="" placeholder="Nhập thông tin khác" />';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="row-fluid">';
	str += '<div class="control-group">';
	str += '<hr>';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	return str;
};
var quyensudungdat = function(nhacongtrinh, id_taisan){
	var str = '<div class="quyensudungdat"><div class="row-fluid"><span class="btn btn-danger btn-xoa-quyensudungdat icon-trash bigger-200 btn-small pull-right" ></span>';
	str += '<div class="control-group">';
	str += '<label class="control-label" for="dat_ten'+id_taisan+'">'+nhacongtrinh+' (<span style="color:red;">*</span>)</label>';
	str += '<div class="controls">';
	str += '<input type="text" id="dat_ten'+id_taisan+'" name="dat_ten[]" class="width_max required" value="" placeholder="Nhập tên" />';
	str += '<input type="hidden" value="'+id_taisan+'" name="dat_taisan_id[]"/>';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="row-fluid">';
	str += '<div class="control-group">';
	str += '<label class="control-label" for="dat_diachi_'+id_taisan+'">Địa chỉ</label>';
	str += '<div class="controls">';
	str += '<input type="text" id="dat_diachi'+id_taisan+'" name="dat_diachi[]" class="width_max" value="" placeholder="Nhập địa chỉ" />';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="row-fluid">';
	str += '<div class="span5">';
	str += '<div class="control-group">';
	str += '<label class="control-label" for="dat_dientich_'+id_taisan+'">Diện tích xây dựng</label>';
	str += '<div class="controls">';
	str += '<input type="text" id="dat_dientich'+id_taisan+'" class="" name="dat_dientich[]" value="" placeholder="Nhập diện tích" />';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="span5">';
	str += '<div class="control-group">';
	str += '<label class="control-label" for="dat_giatri_'+id_taisan+'">Giá trị</label>';
	str += '<div class="controls">';
	str += '<input type="text" id="dat_giatri'+id_taisan+'" class="money" style="text-align:right" name="dat_giatri[]" value="" placeholder="Nhập giá trị" />';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="row-fluid">';
	str += '<div class="control-group">';
	str += '<label class="control-label" for="dat_gcn'+id_taisan+'">GCN quyền sở hữu</label>';
	str += '<div class="controls">';
	str += '<input type="text" id="dat_gcn'+id_taisan+'" name="dat_gcn[]" class="width_max" value="" placeholder="Nhập giấy chứng nhận quyền sở hữu" />';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="row-fluid">';
	str += '<div class="control-group">';
	str += '<label class="control-label">Thông tin khác (Nếu có)</label>';
	str += '<div class="controls">';
	str += '<input type="text" id="dat_thongtinkhac" name="dat_thongtinkhac[]" class="width_max" value="" placeholder="Nhập thông tin khác" />';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="row-fluid">';
	str += '<div class="control-group">';
	str += '<hr>';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	return str;
};
var concai = function(concai_thutu,stt){
	var hokhau_city = <?php echo json_encode($hokhau_city);?>;
	var cb_hokhau_city = '<select id="concai_new_hokhau_city'+stt+'" name="concai_new_hokhau_city'+stt+'" class="chosen">';
	jQuery.each(hokhau_city,function(i,val){
	//     console.log (val.code+'=>'+val.name);
		cb_hokhau_city += '<option value="' + val.code + '">' + val.name + '</option>';
	});
	cb_hokhau_city += '</select>';

	var str = '<div class="div_concai_new">';
	str += '<div class="span8">';
	str += '<div class="control-group">';
	str += '<label>'+concai_thutu+'';
	str += '<span class="btn btn-danger btn-xoa-concai icon-trash bigger-200 btn-small" style="float:right"></span></label>';
	str += '</div>';
	str += '</div>';
	str += '<div class="span4">';
	str += '<div class="control-group">';
	str += '<label class="control-label" for="concai_new_hoten'+stt+'">Họ tên (<span style="color:red;">*</span>)</label>';
	str += '<div class="controls">';
	str += '<input type="text" id="concai_new_hoten'+stt+'" class="required" name="concai_new_hoten'+stt+'"  placeholder="Nhập tên" />';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="span4">';
	str += '<div class="control-group">';
	str += '<label class="control-label" for="concai_new_namsinh'+stt+'">Năm sinh (<span style="color:red;">*</span>)</label>';
	str += '<div class="controls">';
	str += '<input type="text" id="concai_new_namsinh'+stt+'" class="required" name="concai_new_namsinh'+stt+'" placeholder="Nhập năm sinh" />';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="span10">';
	str += '<div class="control-group">';
	str += '<label class="control-label">Hộ khẩu thường trú</label>';
	str += '<div class="controls">';
	str += '<div id="concai_new_hokhaucity'+stt+'" style="float: left;">'+cb_hokhau_city+'</div>';
	str += '<div id="concai_new_hokhaudist'+stt+'" style="float: left;"><select class="chosen" name="concai_new_hokhau_dist'+stt+'"><option value="0">--Chọn quận/huyện--</option></select></div>';
	str += '<div id="concai_new_hokhaucomm'+stt+'" style="float: left;"><select class="chosen" name="concai_new_hokhau_comm'+stt+'"><option value="0">--Chọn phường/xã--</option></select></div>';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="span4">';
	str += '<div class="control-group">';
	str += '<label class="control-label" for="concai_new_choohientai'+stt+'">Chỗ ở hiện nay (<span style="color:red;">*</span>)</label>';
	str += '<div class="controls">';
	str += '<input type="text" id="concai_new_choohientai'+stt+'" class="required" name="concai_new_choohientai'+stt+'" placeholder="Nhập chỗ ở hiện nay" />';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	str += '<div class="span8">';
	str += '<div class="control-group">';
	str += '<hr>';
	str += '</div>';
	str += '</div>';
	str += '</div>';
	return str;
};
jQuery(document).ready(function($){
// Insert nhà ở, công trình xây dựng
	$("#insert_nha_congtrinh_1").click(function () {
		$('#nha_congtrinh_1').append(nha_congtrinh('Tên nhà', $(this).attr('id_taisan'),'Loại nhà'));
		money();
		chosen();
	});
	$("#insert_nha_congtrinh_2").click(function () {
		//nha_congtrinh();
		$('#nha_congtrinh_2').append(nha_congtrinh('Tên công trình', $(this).attr('id_taisan'),'Loại công trình'));
		money();
		chosen();
	});
// 	Insert nhà ở, công trình xây dựng
	$("#insert_quyensudungdat_1").click(function () {
		$('#quyensudungdat_1').append(quyensudungdat('Tên mảnh đất', $(this).attr('id_taisan')));
		money();
	});
	$("#insert_quyensudungdat_2").click(function () {
		$('#quyensudungdat_2').append(quyensudungdat('Tên mảnh đất', $(this).attr('id_taisan')));
		money();
	});
// 	Insert con cái
	var a = 97;
	var charArray = {};
	// khai báo mảng key=>value (1=>a...24=>z)
	for (var i = 0; i<26; i++)
	    charArray[i+1] = String.fromCharCode(a + i);
	$("#insert_concai_new").click(function () {
		var concai_sum_new = (parseInt($('#concai_sum').val()))+1;
		$('#div_concai').append(concai(charArray[concai_sum_new]+'. Con thứ '+concai_sum_new,concai_sum_new));
		$('#concai_sum').val(concai_sum_new);
		chosen();
	});
	$("body").delegate(".btn-xoa-nha_congtrinh", "click", function(event){
       	event.preventDefault();
           if(confirm('Bạn có chắc chắn muốn xóa?')){
   			//var el = $(this);
   			$(this).parentsUntil("span", ".nhaocongtrinh").remove();
   			//console.log($(this).parentsUntil("div").html());
   			//el.parentsUntil('div.row1').remove();
   			return false;
           }else{
               return false;
           }
   	});
	$("body").delegate(".btn-xoa-quyensudungdat", "click", function(event){
       	event.preventDefault();
           if(confirm('Bạn có chắc chắn muốn xóa?')){
   			//var el = $(this);
   			$(this).parentsUntil("span", ".quyensudungdat").remove();
   			//console.log($(this).parentsUntil("div").html());
   			//el.parentsUntil('div.row1').remove();
   			return false;
           }else{
               return false;
           }
   	});
   	// xóa con cái
	$("body").delegate(".btn-xoa-concai", "click", function(event){
       	event.preventDefault();
           if(confirm('Bạn có chắc chắn muốn xóa?')){
   			$(this).parentsUntil("span", ".div_concai_new").remove();
   			return false;
           }else{
               return false;
           }
   	});
// end nhà ở, công trình xây dựng
// Insert phân cấp tài sản
	var pc4 = 0;
	var pc5 = 0;
    $("#insert_phancap_4").click(function () {
    	var data_taisan = <?php echo json_encode($taisan_cb[4]);?>;
		pc4+=1;
        var cb_taisan = '<select name="tsk_taisan_id[4][]" id="tsk4_taisan_id'+pc4+'" class="chosen" style="width: 667px;">';
        jQuery.each(data_taisan,function(i,val){
       	 cb_taisan += '<option value="' + i + '">' + val + '</option>';
        });
        cb_taisan += '</select>';
		var str ='<div class="phancap" >';
		str +='<div class="row-fluid">';
		str +='<div class="control-group">';
		str +='<label class="control-label">Loại tài sản (<span style="color:red;">*</span>)</label>';
		str +='<div class="controls">';
		str +=cb_taisan+' <span class="btn btn-danger btn-xoa-phancap icon-trash bigger-200 btn-small" ></span>';
		str +='</div>';
		str +='</div>';
		str +='</div>';
		str +='	<div class="row-fluid">';
		str +='<div class="span4">';
		str +='<div class="control-group">';
		str +='<label class="control-label" for="tsk4_value'+pc4+'">Tên tài sản (<span style="color:red;">*</span>)</label>';
		str +='<div class="controls">';
		str +='<textarea rows="1" class="required" id="tsk4_value'+pc4+'" name="tsk_value[4][]" placeholder="Nhập tên tài sản" style="width: 200px;"></textarea>';
		str +='</div>';
		str +='</div>';
		str +='</div>';
		str +='<div class="span4">';
		str +='<div class="control-group">';
		str +='<label  class="control-label" for="tsk4_giatri'+pc4+'">Giá trị</label>';
		str +='<div class="controls">';
		str +='<textarea rows="1" class="money" style="text-align:right" id="tsk4_giatri'+pc4+'" name="tsk_giatri[4][]" placeholder="Nhập giá trị tài sản" style="width: 300px;"></textarea>';
		str +='</div>';
		str +='</div>';
		str +='</div>';
		str +='</div>';
		str +='<div class="row-fluid">';
		str +='<div class="control-group">';
		str +='<hr>';
		str +='</div>';
		str +='</div>';
		str +='</div>';
		$('#id_phancap4').append(str);
		money(); chosen();
    });
    $("#insert_phancap_5").click(function () {
    	var data_taisan = <?php echo json_encode($taisan_cb[5]);?>;
		pc5+=1;
        var cb_taisan = '<select id="tsk5_taisan_id'+pc5+'" name="tsk_taisan_id[5][]" class="chosen" style="width: 667px;">';
        jQuery.each(data_taisan,function(i,val){
       	 cb_taisan += '<option value="' + i + '">' + val + '</option>';
        });
        cb_taisan += '</select>';
   		var str ='<div class="phancap" >';
		str +='<div class="row-fluid">';
		str +='<div class="control-group">';
		str +='<label class="control-label">Loại tài sản (<span style="color:red;">*</span>)</label>';
		str +='<div class="controls">';
		str +=cb_taisan+' <span class="btn btn-danger btn-xoa-phancap icon-trash bigger-200 btn-small" ></span>';
		str +='</div>';
		str +='</div>';
		str +='</div>';
		str +='	<div class="row-fluid">';
		str +='<div class="span4">';
		str +='<div class="control-group">';
		str +='<label  class="control-label" for="tsk4_value'+pc5+'">Tên tài sản (<span style="color:red;">*</span>)</label>';
		str +='<div class="controls">';
		str +='<textarea rows="1" class="required" id="tsk4_value'+pc5+'" name="tsk_value[5][]" placeholder="Nhập tên tài sản" style="width: 200px;"></textarea>';
		str +='</div>';
		str +='</div>';
		str +='</div>';
		str +='<div class="span4">';
		str +='<div class="control-group">';
		str +='<label  class="control-label" for="tsk4_giatri'+pc5+'">Giá trị1111</label>';
		str +='<div class="controls">';
		str +='<textarea rows="1" class="money" style="text-align:right" id="tsk4_giatri'+pc5+'" name="tsk_giatri[5][]" placeholder="Nhập giá trị tài sản" style="width: 300px;"></textarea>';
		str +='</div>';
		str +='</div>';
		str +='</div>';
		str +='</div>';
		str +='<div class="row-fluid">';
		str +='<div class="control-group">';
		str +='<hr>';
		str +='</div>';
		str +='</div>';
		str +='</div>';
      	$('#id_phancap5').append(str);
		money(); chosen();
    });

   	$("body").delegate(".btn-xoa-phancap", "click", function(event){
       	event.preventDefault();
           if(confirm('Bạn có chắc chắn muốn xóa?')){
   			//var el = $(this);
   			$(this).parentsUntil("span", ".phancap").remove();
   			//console.log($(this).parentsUntil("div").html());
   			//el.parentsUntil('div.row1').remove();
   			return false;
           }else{
               return false;
           }
   	});
// end phân cấp tài sản

// Lưu tiếp tục
   	$("#kekhaitaisanForm").validate({
   		ignore: ':hidden',
   	    rules: {
   	    	nha_dientich: {
   	            required: true,
   	        }
   	    },
      	 submitHandler: function(){
 			var formData = $('#kekhaitaisanForm').serialize();
//    		var taisanForm = $('#taisanForm').serialize();
			var dotkekhai_id = $('#dot_kekhai').val();
			var hosochinh_id = $('#hosochinh_id').val();
			if(dotkekhai_id!="")
			{
				$.blockUI({timeout:1000});
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: '<?php echo JUri::base(true);?>/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=luutieptuc',
					data: { formData : formData, hosochinh_id : hosochinh_id,  dotkekhai_id:dotkekhai_id},
					success:function(data){
		// 				window.location.replace('< ?php echo JUri::base(true);?>/index.php?option=com_kekhaitaisan&controller=kekhaitaisan&task=add');
					}
				});
			}else alert('Bạn phải chọn đợt!!');
 		},
   	});

   	$("#btn_quaylai_kekhaitaisan").click(function () {
   		$.blockUI({timeout:1000});
		window.location.replace('<?php echo JUri::base(true);?>/index.php?option=com_kekhaitaisan&controller=kekhaitaisan&task=add');
   	});

   	$('#vochong_hokhau_city').on('change',function(){
		var city_peraddress = $('option:selected', this).val();
		$.ajax({
			type: 'POST',
			url: '<?php echo JUri::base(true);?>/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=getdist',
			data: { city_peraddress : city_peraddress, quanhe : 'vochong'},
			success:function(data){
				$('#vochong_hokhaudist').html(data);
				$('#vochong_hokhaucomm').html('<select class="chosen"><option>--Chọn phường/xã--</option></select>');
				chosen();
			}
		});
   	});
   	$('body').delegate('#vochong_hokhau_dist','change',function(){
		var dist_peraddress = $('option:selected', this).val();
		$.ajax({
			type: 'POST',
			url: '<?php echo JUri::base(true);?>/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=getcomm',
			data: { dist_peraddress : dist_peraddress, quanhe : 'vochong'},
			success:function(data){
				$('#vochong_hokhaucomm').html(data);
				chosen();
			}
		});
   	});

   	$('body').delegate('select[name^="concai_new_hokhau_city"]','change',function(){
		var city_peraddress = $('option:selected', this).val();
		var no_city_peraddress = $('option:selected', this).parent().attr('id');
		var div_id = no_city_peraddress.replace('concai_new_hokhau_city','');
		$.ajax({
			type: 'POST',
			url: '<?php echo JUri::base(true);?>/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=getdist',
			data: { city_peraddress : city_peraddress, div_id:div_id, quanhe:"concai_new"},
			success:function(data){
				$('#concai_new_hokhaudist'+div_id).html(data);
				$('#concai_new_hokhaucomm'+div_id).html('<select class="chosen"><option>--Chọn phường/xã--</option></select>');
				chosen();
			}
		});
   	});
   	$('body').delegate('select[name^="concai_new_hokhau_dist"]','change',function(){
		var dist_peraddress = $('option:selected', this).val();
		var no_dist_peraddress = $('option:selected', this).parent().attr('id');
		var div_id = no_dist_peraddress.replace('concai_new_hokhau_dist','');
     	$.ajax({
			type: 'POST',
			url: '<?php echo JUri::base(true);?>/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=getcomm',
			data: { dist_peraddress : dist_peraddress, div_id:div_id, quanhe:"concai_new"},
			success:function(data){
				$('#concai_new_hokhaucomm'+div_id).html(data);
				chosen();
			}
		});
 	});
   	$('body').delegate('select[name^="concai_old_hokhau_city"]','change',function(){
		var city_peraddress = $('option:selected', this).val();
		var no_city_peraddress = $('option:selected', this).parent().attr('id');
		var div_id = no_city_peraddress.replace('concai_old_hokhau_city','');
		$.ajax({
			type: 'POST',
			url: '<?php echo JUri::base(true);?>/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=getdist',
			data: { city_peraddress : city_peraddress, div_id:div_id, quanhe:"concai_old"},
			success:function(data){
				$('#concai_old_hokhaudist'+div_id).html(data);
				$('#concai_old_hokhaucomm'+div_id).html('<select class="chosen"><option>--Chọn phường/xã--</option></select>');
				chosen();
			}
		});
   	});
   	$('body').delegate('select[name^="concai_old_hokhau_dist"]','change',function(){
		var dist_peraddress = $('option:selected', this).val();
		var no_dist_peraddress = $('option:selected', this).parent().attr('id');
		var div_id = no_dist_peraddress.replace('concai_old_hokhau_dist','');
     	$.ajax({
			type: 'POST',
			url: '<?php echo JUri::base(true);?>/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=getcomm',
			data: { dist_peraddress : dist_peraddress, div_id:div_id, quanhe:"concai_old"},
			success:function(data){
				$('#concai_old_hokhaucomm'+div_id).html(data);
				chosen();
			}
		});
 	});
 	$('#dot_kekhai').on('change', function(){
 		window.location.replace('<?php echo JUri::base(true);?>/index.php?option=com_kekhaitaisan&controller=kekhaitaisan&task=add&dotkekhai='+$(this).val());
 	 	});
 	if($('#dot_kekhai').val()==0) $('.accordion-group').hide(); else $('.accordion-group').show();
 	chosen();
	money();
 	function chosen(){
   		$(".chosen").chosen({
   	   		search_contains: true,
   	   		no_results_text: "Không tìm thấy "
 		});
 	}
	function money(){
		$(".money").maskMoney({ precision: 0,  thousands:'.'});
	};
});
</script>