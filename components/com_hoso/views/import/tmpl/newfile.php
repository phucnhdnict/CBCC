<div id="tabbienche" class="tab-pane active">
		<div style="clear:both"></div>
		<h3 class="header smaller lighter blue">Loại biên chế, hợp đồng</h3>
		<div class="span8">
			<div class="control-group valid">
				<label for="bc_hinhthuc_id" class="control-label">Loại hình biên chế, HĐ (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<div class="row-fluid">
						<select name="bc_hinhthuc_id" id="bc_hinhthuc_id" aria-required="true" aria-invalid="false">
							<option data-loaihinh_id="" value=""></option>
							<option data-loaihinh_id="1" value="4">Hợp đồng 68 CP</option><option data-loaihinh_id="1" value="2">Biên chế hành chính</option><option data-loaihinh_id="2" value="11">Hợp đồng vụ việc</option><option data-loaihinh_id="2" value="12">Hợp đồng trong chỉ tiêu</option><option data-loaihinh_id="2" value="13">Đơn vị tự hợp đồng</option><option data-loaihinh_id="3" value="15">Hợp đồng Thu hút, Đề án nhân lực cao</option>						</select>
						<input type="hidden" value="2" name="bienche_code" id="bienche_code">
					</div>
				</div>
			</div>
		</div>
		<div class="span8 div_hinhthuctuyendung" style="display: none;">
			<div class="control-group">
				<label for="bc_hinhthuctuyendung_id" class="control-label" id="lbl_hinhthuctuyendung">Hình thức tuyển dụng (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<div class="row-fluid">
						<select name="bc_hinhthuctuyendung_id" id="bc_hinhthuctuyendung_id" class=""><option value=""></option></select>
					</div>
				</div>
			</div>
		</div>
		<div class="span8 div_ngaybatdau" style="display: block;">
			<div class="control-group">
				<label for="bc_ngaybatdau" class="control-label" id="lbl_ngaybatdau">Ngày bắt đầu (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<div class="row-fluid input-append">
						<input type="text" data-date-format="dd/mm/yyyy" value="" class="input-small date-picker input-mask-date required" name="bc_ngaybatdau" id="bc_ngaybatdau">
						<span class="add-on">
							<i class="icon-calendar"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="span8 div_thoihan" style="display: block;">
			<div class="control-group">
				<label for="bc_thoihanbienchehopdong_id" class="control-label">Thời hạn (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<div class="row-fluid">
						<select name="bc_thoihanbienchehopdong_id" id="bc_thoihanbienchehopdong_id" class="required"><option month="0" value=""></option><option month="12" value="8">1 năm</option><option month="36" value="4">3 năm</option><option month="3" value="7">3 tháng</option><option month="6" value="1">6 tháng</option><option month="-1" value="5">Không xác định</option></select>
					</div>
				</div>
			</div>
		</div>
		<div class="span8 div_ngayketthuc" style="display: block;">
			<div class="control-group">
				<label for="bc_ngayketthuc" class="control-label" id="lbl_ngayketthuc">Ngày kết thúc</label>
				<div class="controls">
					<div class="row-fluid input-append">
						<input type="text" value="" data-date-format="dd/mm/yyyy" class="input-small date-picker input-mask-date validNgayBCHD" name="bc_ngayketthuc" id="bc_ngayketthuc" readonly="readonly">
						<span class="add-on">
							<i class="icon-calendar"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="span8 div_soqd" style="display: block;">
			<div class="control-group">
				<label for="bc_soquyetdinh" class="control-label" id="lbl_soqd">Số quyết định</label>
				<div class="controls">
					<div class="row-fluid">
						<input type="text" value="" class="input-small" name="bc_soquyetdinh" id="bc_soquyetdinh">
					</div>
				</div>
			</div>
		</div>
		<div class="span8 div_coquanqd" style="display: block;">
			<div class="control-group">
				<label for="bc_coquanquyetdinh" class="control-label" id="lbl_coquanqd">Cơ quan ra quyết định</label>
				<div class="controls">
					<div class="row-fluid">
						<input type="text" value="" class="input-xlarge" name="bc_coquanquyetdinh" id="bc_coquanquyetdinh">
					</div>
				</div>
			</div>
		</div>
		<div class="span8 div_ngaybanhanh" style="display: block;">
			<div class="control-group">
				<label for="bc_ngaybanhanh" class="control-label" id="lbl_ngaybanhanh">Ngày ban hành</label>
				<div class="controls">
					<div class="row-fluid input-append">
						<input type="text" data-date-format="dd/mm/yyyy" value="" class="input-small date-picker input-mask-date" name="bc_ngaybanhanh" id="bc_ngaybanhanh">
						<span class="add-on">
							<i class="icon-calendar"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div style="clear: both;"></div>
		<h3 class="header smaller lighter blue">Đối tượng đặc thù</h3>
		<table class="table table-striped table-bordered table-hover">
				<tbody><tr>
			<td style="vertical-align: middle;">
				<input type="checkbox" value="" name="check_doituong[]">
				<span class="lbl"> Đề án 922 bậc Đại học (47,32)</span>
				<input type="hidden" value="0" name="doituong_selected[]">
				<input type="hidden" value="1" name="doituong_id[]">
			</td>
			<td class="td_doituong" style="vertical-align: middle;">
				<input type="hidden" value="1" class="cbxLoaiDT" name="loaidoituong_id[]">
				<div style="clear: both;"></div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="soqd_cudihoc[]" class="control-label">
							Số QĐ cử đi học						</label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="" class="input-small" name="soqd_cudihoc[]">
							</div>
						</div>
					</div>
				</div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="ngay_cudihoc[]" class="control-label">
							Ngày QĐ cử đi học						</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" data-date-format="dd/mm/yyyy" value="" class="input-small date-picker input-mask-date" name="ngay_cudihoc[]">
								<span class="add-on">
									<i class="icon-calendar"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div style="clear: both;"></div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="soqd_botri[]" class="control-label">
							Số QĐ bố trí (<span style="color:red;">*</span>)						</label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="" class="input-small" name="soqd_botri[]">
							</div>
						</div>
					</div>
				</div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="ngay_botri[]" class="control-label">
							Ngày QĐ bố trí (<span style="color:red;">*</span>)						</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" data-date-format="dd/mm/yyyy" value="" class="input-small date-picker input-mask-date" name="ngay_botri[]">
								<span class="add-on">
									<i class="icon-calendar"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
				<tr>
			<td style="vertical-align: middle;">
				<input type="checkbox" value="" name="check_doituong[]">
				<span class="lbl"> Đề án 922 bậc sau Đại học (393,56)</span>
				<input type="hidden" value="0" name="doituong_selected[]">
				<input type="hidden" value="1" name="doituong_id[]">
			</td>
			<td class="td_doituong" style="vertical-align: middle;">
				<input type="hidden" value="2" class="cbxLoaiDT" name="loaidoituong_id[]">
				<div style="clear: both;"></div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="soqd_cudihoc[]" class="control-label">
							Số QĐ cử đi học						</label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="" class="input-small" name="soqd_cudihoc[]">
							</div>
						</div>
					</div>
				</div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="ngay_cudihoc[]" class="control-label">
							Ngày QĐ cử đi học						</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" data-date-format="dd/mm/yyyy" value="" class="input-small date-picker input-mask-date" name="ngay_cudihoc[]">
								<span class="add-on">
									<i class="icon-calendar"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div style="clear: both;"></div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="soqd_botri[]" class="control-label">
							Số QĐ bố trí (<span style="color:red;">*</span>)						</label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="" class="input-small" name="soqd_botri[]">
							</div>
						</div>
					</div>
				</div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="ngay_botri[]" class="control-label">
							Ngày QĐ bố trí (<span style="color:red;">*</span>)						</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" data-date-format="dd/mm/yyyy" value="" class="input-small date-picker input-mask-date" name="ngay_botri[]">
								<span class="add-on">
									<i class="icon-calendar"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
				<tr>
			<td style="vertical-align: middle;">
				<input type="checkbox" value="" name="check_doituong[]">
				<span class="lbl"> Thu hút</span>
				<input type="hidden" value="0" name="doituong_selected[]">
				<input type="hidden" value="2" name="doituong_id[]">
			</td>
			<td class="td_doituong" style="vertical-align: middle;">
						<div style="display:none;" class="span6">
					<div class="control-group">
						<label for="loaidoituong_id[]" class="control-label">Loại đối tượng (<span style="color: red">*</span>)</label>
						<div class="controls">
							<div class="row-fluid">
								<select class="cbxLoaiDT" name="loaidoituong_id[]">
									<option data-valid_soqd_botri="" data-valid_ngay_botri="" data-valid_soqd_cudihoc="" data-valid_ngay_cudihoc="" data-text_soqd_botri="" data-text_ngay_botri="" data-text_soqd_cudihoc="" data-text_ngay_cudihoc="" value="">
									</option>
																	<option data-valid_soqd_botri="required" data-valid_ngay_botri="required" data-valid_soqd_cudihoc="" data-valid_ngay_cudihoc="" data-text_soqd_botri="Số QĐ bố trí" data-text_ngay_botri="Ngày QĐ bố trí" data-text_soqd_cudihoc="" data-text_ngay_cudihoc="" value="3">
										Đúng đối tượng									</option>
																	<option data-valid_soqd_botri="required" data-valid_ngay_botri="required" data-valid_soqd_cudihoc="" data-valid_ngay_cudihoc="" data-text_soqd_botri="Số QĐ bố trí" data-text_ngay_botri="Ngày QĐ bố trí" data-text_soqd_cudihoc="" data-text_ngay_cudihoc="" value="4">
										Vận dụng									</option>
																	<option data-valid_soqd_botri="required" data-valid_ngay_botri="required" data-valid_soqd_cudihoc="" data-valid_ngay_cudihoc="" data-text_soqd_botri="Số QĐ bố trí" data-text_ngay_botri="Ngày QĐ bố trí" data-text_soqd_cudihoc="" data-text_ngay_cudihoc="" value="5">
										Ngành giáo dục									</option>
																</select>
							</div>
						</div>
					</div>
				</div>
				<div style="clear: both;"></div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="soqd_cudihoc[]" class="control-label"></label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="" class="input-small" name="soqd_cudihoc[]">
							</div>
						</div>
					</div>
				</div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="ngay_cudihoc[]" class="control-label"></label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" data-date-format="dd/mm/yyyy" value="" class="input-small date-picker input-mask-date" name="ngay_cudihoc[]">
								<span class="add-on">
									<i class="icon-calendar"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div style="clear: both;"></div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="soqd_botri[]" class="control-label"></label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="" class="input-small" name="soqd_botri[]">
							</div>
						</div>
					</div>
				</div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="ngay_botri[]" class="control-label"></label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" data-date-format="dd/mm/yyyy" value="" class="input-small date-picker input-mask-date" name="ngay_botri[]">
								<span class="add-on">
									<i class="icon-calendar"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
					</td>
		</tr>
				<tr>
			<td style="vertical-align: middle;">
				<input type="checkbox" value="" name="check_doituong[]">
				<span class="lbl"> HĐLĐ tại cơ quan hành chính có ý kiến Chủ tịch UBND</span>
				<input type="hidden" value="0" name="doituong_selected[]">
				<input type="hidden" value="4" name="doituong_id[]">
			</td>
			<td class="td_doituong" style="vertical-align: middle;">
						<input type="hidden" value="7" class="cbxLoaiDT" name="loaidoituong_id[]">
				<div style="clear: both;"></div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="soqd_cudihoc[]" class="control-label">
													</label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="" class="input-small" name="soqd_cudihoc[]">
							</div>
						</div>
					</div>
				</div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="ngay_cudihoc[]" class="control-label">
													</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" data-date-format="dd/mm/yyyy" value="" class="input-small date-picker input-mask-date" name="ngay_cudihoc[]">
								<span class="add-on">
									<i class="icon-calendar"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div style="clear: both;"></div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="soqd_botri[]" class="control-label">
							Số CV/QĐ đồng ý bố trí (<span style="color:red;">*</span>)						</label>
						<div class="controls">
							<div class="row-fluid">
								<input type="text" value="" class="input-small" name="soqd_botri[]">
							</div>
						</div>
					</div>
				</div>
				<div style="display:none;" class="span3">
					<div class="control-group">
						<label for="ngay_botri[]" class="control-label">
							Ngày CV/QĐ đồng ý bố trí (<span style="color:red;">*</span>)						</label>
						<div class="controls">
							<div class="row-fluid input-append">
								<input type="text" data-date-format="dd/mm/yyyy" value="" class="input-small date-picker input-mask-date" name="ngay_botri[]">
								<span class="add-on">
									<i class="icon-calendar"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
					</td>
		</tr>
				</tbody></table>
		<div style="clear: both;"></div>
		<h3 class="header smaller lighter blue">Ngạch, bậc, chức vụ</h3>
		<table>
		<tbody><tr>
			<td style="width:50%;">
			<div class="span4">
				<div class="control-group">
					<label for="whois_sal" class="control-label">Hình thức hưởng lương/ngạch (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div class="row-fluid">
							<select name="whois_sal" id="whois_sal">
								<option data-phantramsotien="0" data-ngaynangluong="0" data-nangluong="0" data-sotien="0" value=""></option>
							<option data-phantramsotien="100" data-ngaynangluong="0" data-nangluong="1" data-sotien="0" value="1">Nâng lương thường xuyên</option><option data-phantramsotien="100" data-ngaynangluong="0" data-nangluong="1" data-sotien="0" value="2">Nâng lương trước thời hạn</option><option data-phantramsotien="100" data-ngaynangluong="1" data-nangluong="1" data-sotien="0" value="5">Chuyển ngạch/ Bổ nhiệm vào ngạch</option><option data-phantramsotien="100" data-ngaynangluong="0" data-nangluong="1" data-sotien="0" value="6">Chuyển xếp theo bảng lương mới</option><option data-phantramsotien="100" data-ngaynangluong="0" data-nangluong="1" data-sotien="0" value="8">Hưởng lương HĐ 100%</option><option data-phantramsotien="85" data-ngaynangluong="0" data-nangluong="0" data-sotien="0" value="9">Hưởng lương HĐ 85%</option><option data-phantramsotien="100" data-ngaynangluong="0" data-nangluong="0" data-sotien="1" value="10">Lương thỏa thuận bằng tiền</option><option data-phantramsotien="100" data-ngaynangluong="1" data-nangluong="1" data-sotien="0" value="17">Hạ bậc lương</option><option data-phantramsotien="100" data-ngaynangluong="0" data-nangluong="0" data-sotien="0" value="18">Hưởng lương HĐ 100%, đóng bảo hiểm 85%</option>							</select>
							<input type="hidden" value="" name="is_nangluong" id="is_nangluong">
							<input type="hidden" value="" name="percent" id="percent">
						</div>
					</div>
				</div>
			</div>
			</td>
			<td style="width:50%;vertical-align:top;">
			<div style="display: none;" class="span4 luong_sotien">
				<div class="control-group">
					<label for="money_sal" class="control-label">Số tiền được hưởng</label>
					<div class="controls">
						<div class="row-fluid">
							<input type="text" id="money_sal_show" value="" name="money_sal_show" style="text-align:right;" class="input-medium">
							<input type="hidden" id="money_sal" value="" name="money_sal">
						</div>
					</div>
				</div>
			</div>
			<div style="display: none;" class="span4 luong_ngaynangluong">
				<div class="control-group">
					<label for="real_start_date_sal" class="control-label">Thời điểm nâng lương lần sau tính từ</label>
					<div class="controls">
						<div class="row-fluid input-append">
							<input type="text" data-date-format="dd/mm/yyyy" class="input-small date-picker input-mask-date" name="real_start_date_sal" id="real_start_date_sal" value="">
							<span class="add-on">
								<i class="icon-calendar"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<div class="span8 dvnongach">
				<div class="control-group">
					<label for="sta_code" class="control-label">Ngạch (<span style="color:red;">*</span>)</label>
					<div class="controls">
						<div class="row-fluid input-append">
							<select name="sta_code" id="sta_code">
								<option value=""></option>
							<option value="01010">Lái xe cơ quan</option><option value="01002">Chuyên viên Chính</option><option value="04024">Thanh tra viên chính</option><option value="06030">Kế toán viên chính</option><option value="06031">Kế toán viên</option><option value="04025">Thanh tra viên</option><option value="01011">Nhân viên bảo vệ</option><option value="01009">Nhân viên phục vụ</option><option value="01003">Chuyên viên</option><option value="01a003">Chuyên viên (Cao đẳng)</option><option value="01004">Cán sự</option><option value="01001">Chuyên viên cao cấp</option>							</select>
							<a data-toggle="modal" href="#modal-form" role="button" class="btn btn-small btn-warning add-on" id="btn-ngachkhac">
								<i class="icon-wrench"></i> Ngạch khác
							</a>
						</div>
						<input type="hidden" value="" name="sta_name" id="sta_name">
					</div>
				</div>
			</div>
			</td>
		</tr>
		<tr>
			<td style="width:50%;">
			<div class="span4 dvnongach">
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
			</td>
			<td style="width:50%;">
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
			</td>
		</tr>
		<tr>
			<td style="width:50%;">
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
										Chánh văn phòng									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="5" value="11028">
										Chánh thanh tra									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="5" value="11028">
										Trưởng phòng									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="5" value="11028">
										Quyền trưởng phòng									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="6" value="11032">
										Phó Chánh thanh tra									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="6" value="11032">
										Phó Trưởng phòng phụ trách phòng									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="6" value="11032">
										Phó Trưởng phòng									</option>
																	<option data-pos_thoihanbonhiem="60" data-pos_td="6" value="11032">
										Phó Chánh văn phòng									</option>
															</select>
						</div>
					</div>
				</div>
			</div>
			</td>
			<td style="width:50%;">
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
			</td>
		</tr>
		<tr>
			<td style="width:50%;">
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
			</td>
			<td style="width:50%;">
			</td>
		</tr>
		<tr>
			<td style="width:50%;">
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
			</td>
			<td style="width:50%;">
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
	<option value="12">Cách chức</option>
	<option value="13">Từ chức</option>
</select>
						</div>
					</div>
				</div>
			</div>
			</td>
		</tr>
		<tr>
			<td style="width:50%;">
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
			</td>
			<td style="width:50%;">
			</td>
		</tr>
		</tbody></table>
		<div style="clear:both;"></div>
		<h3 class="header smaller lighter blue">Kiêm nhiệm, biệt phái</h3>
		<div class="span4">
			<div class="control-group">
				<label for="type_knbp" class="control-label">Kiêm nhiệm, biệt phái</label>
				<div class="controls">
					<div class="row-fluid">
						<select name="type_knbp" id="type_knbp">
							<option value=""></option>
							<option value="1">Kiêm nhiệm</option>
							<option value="2">Biệt phái</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="span4 div_knbp" style="display: none;">
			<div class="control-group">
				<label for="inst_code_knbp" class="control-label">Đơn vị (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<div class="row-fluid">
						<select data-placeholder="Chọn đơn vị..." class="chzn-select" name="inst_code_knbp" id="inst_code_knbp" style="display: none;">
	<option value=""></option>
	<option value="150944">UBND quận Hải Châu</option>
	<option value="150009">Trung tâm Văn hóa thể thao quận Hải Châu</option>
	<option value="150014">Đội Kiểm tra quy tắc Đô thị quận Hải Châu</option>
	<option value="150015">Hội chữ thập đỏ quận Hải Châu</option>
	<option value="150018">Văn phòng Đăng ký quyền sử dụng đất Hải Châu</option>
	<option value="151333">Trường THCS Kim Đồng</option>
	<option value="151334">Trường THCS Lê Hồng Phong</option>
	<option value="151335">Trường THCS Lê Thánh Tôn</option>
	<option value="151336">Trường THCS Lý Thường Kiệt</option>
	<option value="151340">Trường THCS Sào Nam</option>
	<option value="151357">Trường THCS Nguyễn Huệ</option>
	<option value="151358">Trường THCS Tây Sơn</option>
	<option value="151359">Trường THCS Trần Hưng Đạo</option>
	<option value="151343">Trường THCS Trưng Vương</option>
	<option value="152827">Trường MN Anh Đào</option>
	<option value="152828">Trường MN 20-10</option>
	<option value="152829">Trường MN 19-5</option>
	<option value="152830">Trường MN Bảo Ngọc</option>
	<option value="152831">Trường MN Bình Minh</option>
	<option value="152832">Trường MN Ánh Hồng</option>
	<option value="152833">Trường MN Cẩm Vân</option>
	<option value="152834">Trường MN Dạ Lan Hương</option>
	<option value="152835">Trường MN Hoa Ban</option>
	<option value="152836">Trường MN Hoa Phương Đỏ</option>
	<option value="152837">Trường MN Hoàng Lan</option>
	<option value="152838">Trường MN Măng Non</option>
	<option value="152839">Trường MN Ngọc Lan</option>
	<option value="152840">Trường MN Tiên Sa</option>
	<option value="152841">Trường MN Trúc Đào</option>
	<option value="152842">Trường MN Tuổi Thơ</option>
	<option value="151361">Trường Tiểu học Lê Quý Đôn</option>
	<option value="151362">Trường Tiểu học Lý Công Uẩn</option>
	<option value="151363">Trường Tiểu học Nguyễn Du</option>
	<option value="151364">Trường Tiểu học Núi Thành</option>
	<option value="151365">Trường Tiểu học Ông Ích Khiêm</option>
	<option value="151347">Trường Tiểu học Bán công năng khiếu</option>
	<option value="151348">Trường Tiểu học Hùng Vương</option>
	<option value="151349">Trường Tiểu học Lê Đình Chinh</option>
	<option value="151344">Trường Tiểu học Bạch Đằng</option>
	<option value="151346">Trường Tiểu học Hoàng Văn Thụ</option>
	<option value="151367">Trường Tiểu học Phan Thanh</option>
	<option value="151368">Trường Tiểu học Phù Đổng</option>
	<option value="151369">Trường Tiểu học Tây Hồ</option>
	<option value="151370">Trường Tiểu học Thế giới Trẻ em</option>
	<option value="151371">Trường Tiểu học Trần Thị Lý</option>
	<option value="151372">Trường Tiểu học Trần Văn Ơn</option>
	<option value="151373">Trường Tiểu học Võ Thị Sáu</option>
	<option value="153060">Trường Tiểu học Phan Đăng Lưu</option>
	<option value="153269">Trường Tiểu học Lê Lai</option>
	<option value="150885">Ban Quản lý xây dựng cơ bản quận Hải Châu</option>
	<option value="151250">Hội Người mù quận Hải Châu</option>
	<option value="151251">Ban Quản lý chợ Nguyễn Tri Phương</option>
	<option value="151252">Ban Quản lý chợ mới Hòa Thuận</option>
	<option value="150945">UBND quận Thanh Khê</option>
	<option value="150030">Đội kiểm tra quy tắc đô thị quận Thanh Khê</option>
	<option value="150031">Hội chữ thập đỏ quận Thanh Khê</option>
	<option value="151291">Hội người mù quận Thanh Khê</option>
	<option value="151292">Văn phòng Đăng ký quyền sử dụng đất quận Thanh Khê</option>
	<option value="151293">Trung tâm Văn hoá - Thể thao quận Thanh Khê</option>
	<option value="151459">Trường THCS Chu Văn An</option>
	<option value="151467">Trường THCS Nguyễn Trãi</option>
	<option value="151462">Trường THCS Huỳnh Thúc Kháng</option>
	<option value="151463">Trường THCS Lê Thị Hồng Gấm</option>
	<option value="151464">Trường THCS Nguyễn Đình Chiểu</option>
	<option value="151465">Trường THCS Nguyễn Duy Hiệu</option>
	<option value="151466">Trường THCS Nguyễn Thị Minh Khai</option>
	<option value="151461">Trường THCS Hoàng Diệu</option>
	<option value="151468">Trường THCS Phan Đình Phùng</option>
	<option value="151460">Trường THCS Đỗ Đăng Tuyển</option>
	<option value="151517">Trường Mầm non Cẩm Nhung</option>
	<option value="151518">Trường Mầm non Cẩm Tú</option>
	<option value="151519">Trường Mầm non Hải Đường</option>
	<option value="151520">Trường Mầm non Hoàng Mai</option>
	<option value="151521">Trường Mầm non Hồng Đào</option>
	<option value="151522">Trường Mầm non Mẫu Đơn</option>
	<option value="151523">Trường Mầm non tư thục A2</option>
	<option value="151524">Trường Mầm non tư thục An Hòa</option>
	<option value="151525">Trường Mầm non tư thục Ánh Sáng</option>
	<option value="151526">Trường Mầm non tư thục Bảo Lộc</option>
	<option value="151527">Trường Mầm non tư thục Đức Minh</option>
	<option value="151528">Trường Mầm non tư thục Hạnh Nhân</option>
	<option value="151529">Trường Mầm non tư thục Hiền Lương</option>
	<option value="151530">Trường Mầm non tư thục Hoa Phượng</option>
	<option value="151531">Trường Mầm non tư thục Hồng Chuyên</option>
	<option value="151532">Trường Mầm non tư thục Hồng Nhung</option>
	<option value="151533">Trường Mầm non tư thục Khai Trí</option>
	<option value="151534">Trường Mầm non tư thục Mai Anh</option>
	<option value="151535">Trường Mầm non tư thục Minh Châu</option>
	<option value="151536">Trường Mầm non tư thục Minh Trí</option>
	<option value="151537">Trường Mầm non tư thục Mỹ Nhi</option>
	<option value="151538">Trường Mầm non tư thục Ngân Hà</option>
	<option value="151539">Trường Mầm non tư thục Phượng Hồng</option>
	<option value="151540">Trường Mầm non tư thục Phương Lan</option>
	<option value="151541">Trường Mầm non tư thục Thanh Tâm</option>
	<option value="151542">Trường Mầm non tư thục Xuân Mai</option>
	<option value="151543">Trường Mầm non Phong Lan</option>
	<option value="151544">Trường Mầm non Thủy Tiên</option>
	<option value="151545">Trường Mầm non Tuổi Hoa</option>
	<option value="151546">Trường Mầm non Tường Vi</option>
	<option value="151476">Trường Tiểu học Hoa Lư</option>
	<option value="151477">Trường Tiểu học Huỳnh Ngọc Huệ</option>
	<option value="151479">Trường Tiểu học Lê Quang Sung</option>
	<option value="151470">Trường Tiểu học Điện Biên Phủ</option>
	<option value="151471">Trường Tiểu học Đinh Bộ Lĩnh</option>
	<option value="151472">Trường Tiểu học Đoàn Thị Điểm</option>
	<option value="151473">Trường Tiểu học Dũng sỹ Thanh Khê</option>
	<option value="151480">Trường Tiểu học Lê Văn Tám</option>
	<option value="151483">Trường Tiểu học Nguyễn Trung Trực</option>
	<option value="151469">Trường Tiểu học Bế Văn Đàn</option>
	<option value="151484">Trường Tiểu học Trần Cao Vân</option>
	<option value="151474">Trường Tiểu học Hà Huy Tập</option>
	<option value="151482">Trường Tiểu học Nguyễn Bỉnh Khiêm</option>
	<option value="151475">Trường Tiểu học Hàm Nghi</option>
	<option value="151481">Trường Tiểu học Nguyễn Bá Ngọc</option>
	<option value="151707">Ban Quản lý chợ Phú Lộc</option>
	<option value="151708">Nhà Thi đấu quận Thanh Khê</option>
	<option value="152658">Trung tâm Dân số - KHHGĐ quận Thanh Khê</option>
	<option value="150946">UBND quận Sơn Trà</option>
	<option value="151253">Hội người mù quận Sơn Trà</option>
	<option value="151256">Đội Kiểm tra quy tắc Đô thị quận Sơn Trà</option>
	<option value="151254">Trung tâm Văn hóa - Thể thao quận Sơn Trà</option>
	<option value="152819">Trường MN Bạch Yến</option>
	<option value="152820">Trường MN Họa My</option>
	<option value="152821">Trường MN Hoàng Anh</option>
	<option value="152822">Trường MN Hoàng Cúc</option>
	<option value="152823">Trường MN Hoàng Yến</option>
	<option value="152824">Trường MN Rạng Đông</option>
	<option value="152825">Trường MN Sơn Ca</option>
	<option value="152826">Trường MN Vành Khuyên</option>
	<option value="151493">Trường tiểu học Tô Vĩnh Diện</option>
	<option value="151494">Trường tiểu học Tiểu La</option>
	<option value="151495">Trường tiểu học Ngô Gia Tự</option>
	<option value="151497">Trường tiểu học Nguyễn Văn Thoại</option>
	<option value="151454">Trường Tiểu học Quang Trung</option>
	<option value="151457">Trường Tiểu học Trần Quốc Toản</option>
	<option value="151445">Trường Tiểu học Chi Lăng</option>
	<option value="151446">Trường Tiểu học Đinh Tiên Hoàng</option>
	<option value="151447">Trường Tiểu học Hai Bà Trưng</option>
	<option value="151450">Trường Tiểu học Ngô Mây</option>
	<option value="151496">Trường tiểu học Lương Thế Vinh</option>
	<option value="151452">Trường Tiểu học Nguyễn Thái Học</option>
	<option value="151451">Trường Tiểu học Nguyễn Phan Vinh</option>
	<option value="151453">Trường Tiểu học Nguyễn Tri Phương</option>
	<option value="151441">Trường THCS Nguyễn Chí Thanh</option>
	<option value="151442">Trường THCS Nguyễn Văn Cừ</option>
	<option value="151443">Trường THCS Phạm Ngọc Thạch</option>
	<option value="151444">Trường THCS Phan Bội Châu</option>
	<option value="151439">Trường THCS Lê Độ</option>
	<option value="151440">Trường THCS Lý Tự Trọng</option>
	<option value="151438">Trường THCS Cao Thắng</option>
	<option value="151255">Ban Quản lý công trình xây dựng cơ bản quận Sơn Trà</option>
	<option value="151257">Ban Quản lý chợ quận Sơn Trà</option>
	<option value="151258">Hội Chữ thập đỏ quận Sơn Trà</option>
	<option value="151290">Văn phòng đăng ký quyền sử dụng đất quận Sơn Trà</option>
	<option value="152657">Trung tâm Dân số - KHHGĐ quận Sơn Trà</option>
	<option value="153938">Đài Truyền thanh quận Sơn Trà</option>
	<option value="150947">UBND quận Ngũ Hành Sơn</option>
	<option value="150068">Đội kiểm tra quy tắc đô thị quận Ngũ Hành Sơn</option>
	<option value="150069">Hội chữ thập đỏ quận Ngũ Hành Sơn</option>
	<option value="150071">Ban Quản lý khu danh thắng Ngũ Hành Sơn</option>
	<option value="150075">Văn phòng Đăng ký quyền sử dụng đất quận Ngũ Hành Sơn</option>
	<option value="151424">Ban Quản lý chợ quận Ngũ Hành Sơn</option>
	<option value="152394">Trường mầm non Ngọc lan</option>
	<option value="152424">Trường mầm non Hoàng Anh</option>
	<option value="152432">Trường mầm non Bạch Dương</option>
	<option value="152433">Trường mầm non Vàng Anh</option>
	<option value="151434">Trường Tiểu học Phạm Hồng Thái</option>
	<option value="151435">Trường Tiểu học Tô Hiến Thành</option>
	<option value="151432">Trường Tiểu học Mai Đăng Chơn</option>
	<option value="151429">Trường Tiểu học Lê Bá Trinh</option>
	<option value="151430">Trường Tiểu học Lê Lai</option>
	<option value="151431">Trường Tiểu học Lê Văn Hiển</option>
	<option value="151433">Trường Tiểu học Nguyễn Duy Trinh</option>
	<option value="151436">Trường Tiểu học Trần Quang Diệu</option>
	<option value="151427">Trường THCS Lê Lợi</option>
	<option value="151428">Trường THCS Nguyễn Bỉnh Khiêm</option>
	<option value="151426">Trường THCS Huỳnh Bá Chánh</option>
	<option value="152388">Trường THCS Trần Đại Nghĩa</option>
	<option value="151288">Hội người mù quận Ngũ Hành Sơn</option>
	<option value="151289">Trung tâm Văn hóa - Thể thao quận Ngũ Hành Sơn</option>
	<option value="151423">Ban Quản lý công trình xây dựng cơ bản quận Ngũ Hành Sơn</option>
	<option value="152656">Trung tâm Dân số - KHHGĐ quận Ngũ Hành Sơn</option>
	<option value="153904">Ban Quản lý Làng đá mỹ nghệ Non Nước</option>
	<option value="153936">Đài Truyền thanh quận Ngũ Hành Sơn</option>
	<option value="150948">UBND quận Liên Chiểu</option>
	<option value="151282">Trung tâm Đào tạo nghề quận Liên Chiểu</option>
	<option value="151281">Hội Chữ thập đỏ quận Liên Chiểu</option>
	<option value="151280">Hội Người mù quận Liên Chiểu</option>
	<option value="152576">Trường MN Tuổi Ngọc</option>
	<option value="152577">Trường MN Tuổi Thơ</option>
	<option value="152578">Trường MN 1-6</option>
	<option value="152579">Trường MN Hoạ Mi</option>
	<option value="152580">Trường MN Măng Non</option>
	<option value="152581">Trường MN Hướng Dương</option>
	<option value="151419">Trường Tiểu học Trần Bình Trọng</option>
	<option value="151410">Trường Tiểu học Âu Cơ</option>
	<option value="151411">Trường Tiểu học Bùi Thị Xuân</option>
	<option value="151415">Trường Tiểu học Ngô Sĩ Liên</option>
	<option value="151414">Trường Tiểu học Hồng Quang</option>
	<option value="151418">Trường Tiểu học Phan Phu Tiên</option>
	<option value="151417">Trường Tiểu học Nguyễn Văn Trỗi</option>
	<option value="151413">Trường Tiểu học Hải Vân</option>
	<option value="151416">Trường Tiểu học Nguyễn Đức Cảnh</option>
	<option value="151412">Trường Tiểu học Duy Tân</option>
	<option value="151421">Trường Tiểu học Trưng Nữ Vương</option>
	<option value="151420">Trường Tiểu học Triệu Thị Trinh</option>
	<option value="151405">Trường THCS Lương Thế Vinh</option>
	<option value="151406">Trường THCS Ngô Thì Nhậm</option>
	<option value="151407">Trường THCS Nguyễn Bỉnh Khiêm</option>
	<option value="151408">Trường THCS Nguyễn Thái Bình</option>
	<option value="151409">Trường THCS Đàm Quang Trung</option>
	<option value="151404">Trường THCS Lê Anh Xuân</option>
	<option value="151284">Văn phòng Đăng ký quyền sử dụng đất quận Liên Chiểu</option>
	<option value="151285">Ban Quản lý các chợ</option>
	<option value="151286">Trung tâm Văn hóa - Thể thao quận Liên Chiểu</option>
	<option value="152654">Trung tâm Dân số - KHHGĐ quận Liên Chiểu</option>
	<option value="153937">Đài Truyền thanh quận Liên Chiểu</option>
	<option value="150949">UBND huyện Hoàng Sa</option>
	<option value="150950">UBND huyện Hòa Vang</option>
	<option value="151272">Hội Chữ Thập đỏ huyện Hòa Vang</option>
	<option value="151273">Hội người mù huyện Hòa Vang</option>
	<option value="151274">Đội Kiểm tra quy tắc đô thị huyện Hòa Vang</option>
	<option value="151275">Trung tâm Văn hoá - Thông tin huyện Hòa Vang</option>
	<option value="151276">Văn phòng đăng ký quyền sử dụng đất huyện Hòa Vang</option>
	<option value="152434">Trường MN Hòa Châu</option>
	<option value="152435">Trường MN Hoa Mai</option>
	<option value="152436">Trường MN số 1 Hòa Tiến</option>
	<option value="152437">Trường MN ....</option>
	<option value="152438">Trường MN Hòa Phước</option>
	<option value="152439">Trường MN Hòa Phong</option>
	<option value="152440">Trường MN Hòa Nhơn</option>
	<option value="152441">Trường MN Hòa Phú</option>
	<option value="152442">Trường MN Hòa Khương</option>
	<option value="152443">Trường MN Hòa Ninh</option>
	<option value="152444">Trường MN Hòa Sơn</option>
	<option value="152445">Trường MN Hòa Liên</option>
	<option value="152446">Trường MN số 2 Hòa Liên</option>
	<option value="152447">Trường MN Hòa Bắc</option>
	<option value="153873">Trường MNCL Hòa Tiến 2</option>
	<option value="151400">Trường Tiểu học Hòa Sơn 1</option>
	<option value="151401">Trường Tiểu học Hòa Sơn 2</option>
	<option value="151402">Trường Tiểu học Hòa Tiến 1</option>
	<option value="151403">Trường Tiểu học Hòa Tiến 2</option>
	<option value="151386">Trường Tiểu học Hòa Bắc</option>
	<option value="151387">Trường Tiểu học Hòa Châu 1</option>
	<option value="151388">Trường Tiểu học Hòa Châu 2</option>
	<option value="151389">Trường Tiểu học Hòa Khương</option>
	<option value="151390">Trường Tiểu học Hòa Khương 2</option>
	<option value="151391">Trường Tiểu học Hòa Liên</option>
	<option value="151392">Trường Tiểu học Hòa Liên 2</option>
	<option value="151396">Trường Tiểu học Lâm Quang Thự</option>
	<option value="151397">Trường Tiểu học Hòa Phú</option>
	<option value="151398">Trường Tiểu học Hòa Phước</option>
	<option value="151399">Trường Tiểu học Hòa Phước 2</option>
	<option value="151393">Trường Tiểu học Hòa Nhơn 1</option>
	<option value="151394">Trường Tiểu học Hòa Nhơn 2</option>
	<option value="151395">Trường Tiểu học Hòa Ninh</option>
	<option value="153939">Trường Tiểu học An Phước</option>
	<option value="151374">Trường THCS Đỗ Thúc Tịnh</option>
	<option value="151375">Trường THCS Nguyễn Bá Phát</option>
	<option value="151376">Trường THCS Nguyễn Hồng Ánh</option>
	<option value="151377">Trường THCS Nguyễn Phú Hường</option>
	<option value="151378">Trường THCS Nguyễn Tri Phương</option>
	<option value="151379">Trường THCS Nguyễn Văn Linh</option>
	<option value="151380">Trường THCS Nguyễn Viết Xuân</option>
	<option value="151381">Trường THCS Ông Ích Đường</option>
	<option value="151383">Trường THCS Trần Quang Khải</option>
	<option value="151384">Trường THCS Trần Quốc Tuấn</option>
	<option value="152340">Trường THCS Phạm Văn Đồng</option>
	<option value="152341">Trường THCS....</option>
	<option value="151668">Ban Quản lý dự án đầu tư xây dựng huyện Hòa Vang</option>
	<option value="152511">Đài Truyền thanh - Phát lại truyền hình huyện Hòa Vang</option>
	<option value="152512">Trung tâm Dân số - KHHGĐ huyện Hòa Vang</option>
	<option value="150951">UBND quận Cẩm Lệ</option>
	<option value="151355">Trường Tiểu học Trần Văn Dư</option>
	<option value="150886">Ban quản lý chợ quận Cẩm Lệ</option>
	<option value="150906">Trung tâm Văn hoá - Thể thao quận Cẩm Lệ</option>
	<option value="150907">Hội Chữ thập đỏ quận Cẩm Lệ</option>
	<option value="150908">Hội người mù quận Cẩm Lệ</option>
	<option value="150909">Đội Kiểm tra Quy tắc đô thị quận Cẩm Lệ</option>
	<option value="150910">Văn phòng Đăng ký quyền sử dụng đất quận Cẩm Lệ&nbsp;</option>
	<option value="151222">Ban Quản lý dự án đầu tư xây dựng cơ bản quận Cẩm Lệ</option>
	<option value="151296">Trường THCS Nguyễn Công Trứ</option>
	<option value="151297">Trường THCS Nguyễn Thiện Thuật</option>
	<option value="151298">Trường THCS Nguyễn Văn Linh</option>
	<option value="151299">Trường THCS Trần Quý Cáp</option>
	<option value="151300">Trường THCS Nguyễn Thị Định</option>
	<option value="151301">Trường THCS Đặng Thai Mai</option>
	<option value="151354">Trường Tiểu học Ông Ích Đường</option>
	<option value="151302">Trường Tiểu học Diên Hồng</option>
	<option value="151303">Trường Tiểu học Hoàng Dư Khương</option>
	<option value="151304">Trường Tiểu học Ngô Quyền</option>
	<option value="151305">Trường Tiểu học Nguyễn Như Hạnh</option>
	<option value="151307">Trường Tiểu học Thái Thị Bôi</option>
	<option value="151308">Trường Tiểu học Trần Đại Nghĩa</option>
	<option value="151309">Trường Tiểu học Trần Nhân Tông</option>
	<option value="153230">Trường Tiểu học Trần Văn Dư</option>
	<option value="151356">Trường Mầm non Trí Nhân</option>
	<option value="151311">Trường Mầm non Bình Minh</option>
	<option value="151328">Trường Mầm non Hoa Ngọc Lan</option>
	<option value="151329">Trường Mầm non Hướng Dương</option>
	<option value="151330">Trường Mầm non Hương Sen</option>
	<option value="151331">Trường Mầm non Sao Mai</option>
	<option value="153341">Trường Mầm non Tư thục</option>
	<option value="152655">Trung tâm Dân số - KHHGĐ quận Cẩm Lệ</option>
	<option value="153848">Đài Truyền thanh quận Cẩm Lệ</option>
	<option value="150131">Liên hiệp các Hội Văn học - Nghệ thuật</option>
	<option value="150132">Hội Chữ thập đỏ</option>
	<option value="150133">Hội người mù</option>
	<option value="150134">Hội Nhà báo</option>
	<option value="150135">Liên Hiệp các Hội Khoa học và Kỹ thuật</option>
	<option value="150136">Hội Đông y</option>
	<option value="150137">Hội Nạn nhân chất độc Da cam</option>
	<option value="150166">Liên minh Hợp tác xã</option>
	<option value="150287">Liên Hiệp các Tổ chức hữu nghị</option>
	<option value="151944">Hội Bảo trợ phụ nữ và trẻ em nghèo bất hạnh</option>
	<option value="150942">Sở Tài chính</option>
	<option value="150141">Chi cục Quản lý Tài sản-Doanh nghiệp</option>
	<option value="150144">Công ty quản lý Hội chợ triển lãm và các chợ Đà Nẵng</option>
	<option value="150145">Trung tâm Xúc tiến thương mại Đà Nẵng</option>
	<option value="150301">Trung tâm Khuyến công và tư vấn Phát triển Công nghiệp Đà Nẵng</option>
	<option value="150299">Sở Công thương</option>
	<option value="150147">Chi cục Quản lý thị trường</option>
	<option value="151780">Chi cục Quản lý thị trường</option>
	<option value="150151">Ban Quản lý Dự án đầu tư xây dựng công trình giao thông công chính</option>
	<option value="150152">Ban Quản lý Dự án giao thông nông thôn</option>
	<option value="150155">Thanh tra Sở Giao thông vận tải</option>
	<option value="150156">Trung tâm đăng kiểm xe cơ giới</option>
	<option value="150847">Trường Trung cấp nghề giao thông công chính</option>
	<option value="151226">Trung tâm sát hạch lái xe</option>
	<option value="150848">Ban Quản lý Dự án hạ tầng giao thông đô thị</option>
	<option value="150849">Công ty Quản lý cầu đường&nbsp;</option>
	<option value="151145">Ban Quản lý dự án Cầu Rồng</option>
	<option value="150943">Sở Giao thông vận tải</option>
	<option value="154399">Công đoàn</option>
	<option value="154396">Công đoàn</option>
	<option value="150933">Sở Xây dựng</option>
	<option value="150159">Ban Quản lý các Dự án phát triển đô thị Đà Nẵng</option>
	<option value="150160">Ban Quản lý Dự án xây dựng</option>
	<option value="150161">Ban Quản lý dự án Xây dựng số 3 </option>
	<option value="150162">Ban Quản lý các Dự án tái định cư</option>
	<option value="150164">Viện Quy hoạch xây dựng Đà Nẵng</option>
	<option value="150165">Trung tâm Kiểm định chất lượng xây dựng</option>
	<option value="150766">Công ty Cây xanh Đà Nẵng</option>
	<option value="150767">Công ty Công viên Cây xanh Đà Nẵng</option>
	<option value="150768">Công ty Quản lý vận hành Điện chiếu sáng công cộng</option>
	<option value="150769">Công ty Quản lý nhà Đà Nẵng&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</option>
	<option value="151801">Công ty Quản lý nhà chung cư Đà Nẵng</option>
	<option value="151847">Trung tâm Tư vấn kỹ thuật xây dựng</option>
	<option value="150931">Sở Khoa học và Công nghệ</option>
	<option value="150637">Trung tâm Ứng dụng tiến bộ khoa học và công nghệ</option>
	<option value="150170">Trung tâm Thông tin Khoa học và Công nghệ</option>
	<option value="150688">Trung tâm Công nghệ sinh học</option>
	<option value="150862">Trung tâm Tiết kiệm năng lượng và Tư vấn chuyển giao công nghệ Đà Nẵng</option>
	<option value="150169">Chi cục Tiêu chuẩn Đo lường chất lượng</option>
	<option value="150960">Trung tâm Kỹ thuật Tiêu chuẩn Đo lường Chất lượng</option>
	<option value="150172">Thanh tra thành phố</option>
	<option value="150939">Sở Tư pháp</option>
	<option value="150174">Phòng Công chứng số 2</option>
	<option value="150176">Phòng Công chứng số 1</option>
	<option value="150177">Trung tâm Dịch vụ bán đấu giá tài sản</option>
	<option value="150178">Trung tâm Trợ giúp pháp lý nhà nước&nbsp;</option>
	<option value="150179">Phòng Công chứng số 3</option>
	<option value="150935">Sở Tài nguyên và Môi trường</option>
	<option value="150743">Chi cục Bảo vệ Môi trường</option>
	<option value="154074">Trường THPT Cẩm Lệ</option>
	<option value="150181">Trung tâm Phát triển quỹ đất</option>
	<option value="150182">Trung tâm Đào tạo và Bồi dưỡng cán bộ tài nguyên và môi trường</option>
	<option value="150185">Trung tâm đào tạo cán bộ quản lý tổng hợp vùng bờ tại TP ĐN</option>
	<option value="150186">Trung tâm Kỹ thuật môi trường</option>
	<option value="150187">Văn phòng Đăng ký đất đai</option>
	<option value="150745">Công ty Thoát nước và Xử lý nước thải</option>
	<option value="150184">Trung tâm Đo đạc và Bản đồ thành phố ĐN</option>
	<option value="150213">Sở Văn hóa, Thể thao và Du lịch</option>
	<option value="150202">Trung tâm Quản lý Quảng cáo</option>
	<option value="150203">Trung tâm Phát hành phim và Chiếu bóng</option>
	<option value="150204">Nhà hát Trưng Vương ĐN</option>
	<option value="150205">Thư viện Khoa học - Tổng hợp</option>
	<option value="150206">Trung tâm Văn hoá thành phố Đà Nẵng</option>
	<option value="150207">Bảo tàng Đà Nẵng</option>
	<option value="150208">Trường Trung học Văn hoá Nghệ thuật</option>
	<option value="150209">Nhà hát tuồng Nguyễn Hiễn Dĩnh</option>
	<option value="150293">Tạp chí du lịch</option>
	<option value="150294">Trung tâm Xúc tiến du lịch</option>
	<option value="150800">Nhà Biểu diễn đa năng</option>
	<option value="150801">Bảo tàng Điêu khắc Chăm</option>
	<option value="150802">Trung tâm Thể dục - Thể thao thành phố ĐN</option>
	<option value="150803">Trung tâm Huấn luyện và Đào tạo vận động viên</option>
	<option value="150804">Trung tâm Thể thao người lớn tuổi</option>
	<option value="150806">Ban Quản lý bán đảo Sơn Trà và các bãi biển du lịch Đà Nẵng&nbsp;</option>
	<option value="151350">Cung thể thao Tiên Sơn</option>
	<option value="151351">Trung tâm Quản lý Di sản văn hóa</option>
	<option value="151352">Trung tâm Tổ chức Sự kiện và Lễ hội</option>
	<option value="151667">Đội Trật tự Du lịch</option>
	<option value="150941">Sở Lao động - Thương binh và Xã hội</option>
	<option value="150227">Chi cục Phòng chống tệ nạn xã hội</option>
	<option value="150219">Trung tâm Giáo dục dạy nghề 05-06</option>
	<option value="150221">Ban Nghĩa trang</option>
	<option value="150222">Trung tâm Bảo trợ xã hội</option>
	<option value="150223">Trung tâm Phụng dưỡng người có công cách mạng</option>
	<option value="150224">Trung tâm điều dưỡng người tâm thần</option>
	<option value="150225">Trung tâm Dịch vụ việc làm</option>
	<option value="150702">Trung tâm Dạy nghề Liên Chiểu</option>
	<option value="150703">Trung tâm Nuôi dạy trẻ em khó khăn</option>
	<option value="150704">Trung tâm Cung cấp dịch vụ công tác xã hội</option>
	<option value="150705">Trường PTTH Hermann Gmeiner</option>
	<option value="150706">Trung tâm Dạy nghề Hoà Vang</option>
	<option value="151224">Quỹ Bảo trợ trẻ em</option>
	<option value="150930">Sở Y tế</option>
	<option value="150242">Bệnh viện Da liễu</option>
	<option value="150243">Bệnh viện mắt</option>
	<option value="150244">Bệnh viện Y học cổ truyền</option>
	<option value="150269">Bệnh viện Tâm thần</option>
	<option value="150271">Bệnh viện Đà Nẵng</option>
	<option value="150272">Bệnh viện Phục hồi chức năng</option>
	<option value="151270">Bệnh viện Lao và bệnh phổi</option>
	<option value="152373">Bệnh viện Phụ Sản Nhi</option>
	<option value="150240">Trung tâm Truyền thông Giáo dục sức khoẻ</option>
	<option value="150241">Trung tâm Cấp cứu </option>
	<option value="150262">Trung tâm Y tế dự phòng</option>
	<option value="150263">Trung tâm đào tạo cán bộ y tế</option>
	<option value="150264">Trung tâm Kiểm nghiệm dược phẩm, mỹ phẩm thành phố</option>
	<option value="150265">Trung tâm phòng chống lao</option>
	<option value="150266">Trung tâm Răng - Hàm - Mặt</option>
	<option value="150268">Trung tâm pháp y</option>
	<option value="150274">Trạm Bảo vệ sức khỏe cán bộ</option>
	<option value="150275">Trung tâm kiểm dịch Y tế Quốc tế</option>
	<option value="150778">Trung tâm Chăm sóc sức khoẻ sinh sản</option>
	<option value="150779">Trung tâm cấp cứu</option>
	<option value="150780">Trung tâm Phòng, chống HIV/AIDS</option>
	<option value="150781">Trung tâm Giám định Y khoa</option>
	<option value="150782">Trung tâm dịch vụ chăm sóc người lớn tuổi ĐN</option>
	<option value="150865">Trung tâm Giám định pháp y tâm thần</option>
	<option value="153881">Trung tâm TV&amp;DV dân số, gia đình và trẻ em</option>
	<option value="150245">Trung tâm Y tế huyện Hòa Vang</option>
	<option value="150257">Trung tâm Y tế quận Hải Châu</option>
	<option value="150258">Trung tâm Y tế quận Thanh Khê</option>
	<option value="150259">Trung tâm Y tế quận Sơn Trà</option>
	<option value="150260">Trung tâm Y tế quận Liên Chiểu</option>
	<option value="150261">Trung tâm Y tế quận Ngũ Hành Sơn</option>
	<option value="150864">Trung tâm Y tế quận Cẩm Lệ</option>
	<option value="151945">Thu hút về Sở Y tế chưa rõ</option>
	<option value="150788">Chi cục An toàn vệ sinh thực phẩm</option>
	<option value="150789">Chi cục Dân số - Kế hoạch hóa gia đình</option>
	<option value="150790">TT DSKHHGD quận Hải Châu</option>
	<option value="150791">TT DSKHHGD quận Thanh Khê</option>
	<option value="150792">TT DSKHHGD quận Liên Chiểu</option>
	<option value="150793">TT DSKHHGD quận Sơn Trà</option>
	<option value="150794">TT DSKHHGD quận NHS</option>
	<option value="150795">TT DSKHHGD quận Cẩm Lệ</option>
	<option value="150796">TT DSKHHGD huyện Hòa vang</option>
	<option value="150797">TT Tư vấn, Dịch vụ DS KHHGĐ</option>
	<option value="150928">Sở Nội vụ</option>
	<option value="150638">Ban Thi đua - Khen thưởng</option>
	<option value="150286">Ban Tôn giáo</option>
	<option value="150934">Văn phòng UBND thành phố</option>
	<option value="150282">Trung tâm Lưu trữ</option>
	<option value="150283">Ban Giải tỏa đền bù các dự án đầu tư và Xây dựng số 1</option>
	<option value="150284">Ban Giải tỏa đền bù các dự án đầu tư và Xây dựng số 2</option>
	<option value="150285">Trung tâm giao dịch bất động sản thành phố</option>
	<option value="150828">Trung tâm Công báo</option>
	<option value="150829">Nhà khách Văn phòng UBND thành phố</option>
	<option value="150860">Ban Quản lý các dự án cơ sở hạ tầng ưu tiên</option>
	<option value="150859">Ban Quản lý các dự án Nam Lào thành phố Đà Nẵng&nbsp;</option>
	<option value="150861">Ban Giải tỏa đền bù các dự án đầu tư và Xây dựng số 3</option>
	<option value="151669">Trung tâm Tin học - Công báo</option>
	<option value="150936">Sở Kế hoạch và Đầu tư</option>
	<option value="150876">Trung tâm Hỗ trợ doanh nghiệp</option>
	<option value="150937">Sở Ngoại vụ</option>
	<option value="150304">Trung tâm Phục vụ Đối ngoại</option>
	<option value="150712">Văn phòng đại diện thành phố tại Tokyo Nhật Bản</option>
	<option value="150713">Trung tâm Đào tạo tiếng Anh Việt Nam Ấn Độ</option>
	<option value="150938">BQL các Khu công nghiệp và Chế xuất</option>
	<option value="150665">&nbsp;Ban Quản lý dự án đầu tư xây dựng khu công nghệ cao</option>
	<option value="150312">Công ty Phát triển và KT hạ tầng KCN Đà Nẵng</option>
	<option value="150313">Trung tâm giới thiệu việc làm Khu công nghiệp</option>
	<option value="150929">Sở Giáo dục và Đào tạo</option>
	<option value="150391">Trường Phổ thông chuyên biệt Nguyễn Đình Chiểu</option>
	<option value="150393">THCS Lê Lợi</option>
	<option value="150394">THCS Hoà Khánh</option>
	<option value="150395">THCS Hoà Minh</option>
	<option value="150396">THCS Nguyễn Thái Bình</option>
	<option value="150397">THCS Lê Thánh Tôn</option>
	<option value="150398">THCS Hoà Hải</option>
	<option value="150399">THCS Hoà Quí</option>
	<option value="150400">THCS Hoà Phước</option>
	<option value="150401">THCS Hoà Tiến</option>
	<option value="150402">THCS Hoà Phát</option>
	<option value="150403">THCS Hoà Xuân</option>
	<option value="150404">THCS Hoà Khương</option>
	<option value="150405">THCS Hoà Châu</option>
	<option value="150406">THCS Hoà Liên</option>
	<option value="150407">THCS Hoà Thọ</option>
	<option value="150408">THCS Hoà Nhơn</option>
	<option value="150409">THCS Hoà Ninh</option>
	<option value="150410">THCS Hoà Bắc</option>
	<option value="150411">THCS Hoà Phú</option>
	<option value="150412">THCS Lê Anh Xuân</option>
	<option value="150413">THCS Trần Hưng Đạo</option>
	<option value="150414">THCS Nguyễn Chí Thanh</option>
	<option value="150415">THCS Kim Đồng</option>
	<option value="150416">THCS Nguyễn Huệ</option>
	<option value="150417">THCS Lý Thường Kiệt</option>
	<option value="150418">THCS Lê Hồng Phong</option>
	<option value="150419">THCS Tây Sơn</option>
	<option value="150420">THCS Trưng Vương</option>
	<option value="150421">THCS Trần Quí Cáp</option>
	<option value="150422">THCS Nguyễn Khuyến</option>
	<option value="150423">THCS Sào Nam</option>
	<option value="150424">THCS Trần Quốc Tuấn</option>
	<option value="150425">THCS Nguyễn Đình Chiểu</option>
	<option value="150426">THCS Hoàng Diệu</option>
	<option value="150427">THCS Lê Thị Hồng Gấm</option>
	<option value="150428">THCS Nguyễn Thị Minh Khai</option>
	<option value="150429">THCS Nguyễn Trãi</option>
	<option value="150430">THCS Chu Văn An</option>
	<option value="150431">THCS Nguyễn Duy Hiệu</option>
	<option value="150432">THCS Huỳnh Thúc Kháng</option>
	<option value="150433">THCS Phan Đình Phùng</option>
	<option value="150434">THCS Phan Bội Châu</option>
	<option value="150435">THCS Nguyễn Văn Cừ</option>
	<option value="150436">THCS Lê Độ</option>
	<option value="150437">THCS Cao Thắng</option>
	<option value="150438">THCS Lý Tự Trọng</option>
	<option value="150439">THCS Phạm Ngọc Thạch</option>
	<option value="150441">Trường THPT Phan Châu Trinh</option>
	<option value="150442">Trường THPT Trần Phú</option>
	<option value="150443">Trường THPT Thái Phiên</option>
	<option value="150444">Trường THPT Hoàng Hoa Thám</option>
	<option value="150445">Trường THPT chuyên Lê Quý Đôn</option>
	<option value="150446">Trường THPT Hòa Vang</option>
	<option value="150447">Trường THPT Nguyễn Trãi</option>
	<option value="150448">Trường THPT Ông ích Khiêm</option>
	<option value="150449">Trường THPT Ngũ Hành Sơn</option>
	<option value="150450">Trường THPT Ngô Quyền</option>
	<option value="150451">Trường THPT Nguyễn Hiền</option>
	<option value="150452">Trường THPT Phan Thành Tài</option>
	<option value="150868">Trường THPT Phạm Phú Thứ</option>
	<option value="150869">Trường THPT Tôn Thất Tùng</option>
	<option value="150870">Trường THPT Nguyễn Thượng Hiền</option>
	<option value="150871">Trường THPT Thanh Khê</option>
	<option value="150455">Trung tâm GDTX,KTTH-HN&amp;DN Ngũ Hành Sơn</option>
	<option value="150456">Trung tâm Giáo dục thường xuyên Liên Chiểu</option>
	<option value="150458">Trung tâm GDTX,KTTH-HN&amp;DN Hải Châu</option>
	<option value="150459">Trung tâm GDTX thành phố Đà Nẵng</option>
	<option value="150460">Trung tâm GDTX,KTTH-HN&amp;DN Hoà Vang</option>
	<option value="150461">Trung tâm GDTX,KTTH-HN&amp;DN Thanh Khê</option>
	<option value="150874">Trung tâm GDTX, KTTH-HN&amp;DN Sơn Trà</option>
	<option value="150875">Trung tâm GDTX,KTTH-HN&amp;DN Cẩm Lệ</option>
	<option value="151353">Trường THCS Nguyễn Khuyến</option>
	<option value="150872">Trường Chuyên biệt Tương Lai</option>
	<option value="150940">Sở Nông nghiệp và Phát triển nông thôn</option>
	<option value="150724">Chi cục Thú y</option>
	<option value="150726">Chi cục Trồng trọt và Bảo vệ thực vật</option>
	<option value="150727">Chi cục Thủy lợi và phòng chống lụt bão</option>
	<option value="150729">Chi cục Phát triển nông thôn và Quản lý chất lượng nông, lâm, thủy sản</option>
	<option value="151008">Chi cục Thủy sản</option>
	<option value="150728">Chi cục Kiểm lâm</option>
	<option value="151206">Hạt Kiểm lâm Hòa Vang</option>
	<option value="151207">Hạt Kiểm lâm quận Liên Chiểu</option>
	<option value="151208">Hạt Kiểm lâm liên quận Sơn Trà- Ngũ Hành Sơn</option>
	<option value="151209">Đội Kiểm lâm cơ động và phòng cháy, chữa cháy rừng</option>
	<option value="151210">Ban Quản lý khu Bảo tồn thiên nhiên Bà Nà- Núi Chúa</option>
	<option value="150730">Ban Quản lý Âu thuyền và&nbsp;Cảng cá Thọ Quang Đà Nẵng</option>
	<option value="151192">Đội Bảo vệ và Phòng cháy chữa cháy</option>
	<option value="151193">Đội thu phí</option>
	<option value="151194">Đội điều độ tàu thuyền, xe</option>
	<option value="151195">Đội Vệ sinh môi trường</option>
	<option value="150731">Trung tâm Khuyến Ngư Nông Lâm</option>
	<option value="150732">Ban Quản lý Rừng đặc dụng Bà Nà - Núi Chúa</option>
	<option value="151183">Trạm Quản lý bảo vệ rừng Sông Bắc</option>
	<option value="151184">Trạm Quản lý bảo vệ rừng Cà Nhông</option>
	<option value="151185">Trạm phát triển giống lâm nghiệp Hoà Liên</option>
	<option value="151182">Trạm Quản lý bảo vệ rừng Sông Nam</option>
	<option value="151186">Đội Lâm sinh</option>
	<option selected="selected" value="150932">Sở Thông tin và Truyền thông</option>
	<option value="150754">Trung tâm Công nghệ thông tin và truyền thông Đà Nẵng</option>
	<option value="150755">Trung tâm Phát triển hạ tầng công nghệ thông tin Đà Nẵng</option>
	<option value="150756">Ban Quản lý Dự án đầu tư xây dựng khu CNTT tập trung</option>
	<option value="150757">Tạp chí Điện tử thông tin và truyền thông&nbsp;</option>
	<option value="151266">Trung tâm Thông tin dịch vụ công Đà Nẵng</option>
	<option value="150972">Sở Công nghiệp</option>
	<option value="150973">Sở Thương mại</option>
	<option value="150974">Ban Tổ chức chính quyền</option>
	<option value="150985">Ủy ban dân số Kế hoạch hóa gia đình</option>
	<option value="151510">Trung tâm nghiên cứu ứng dụng và phát triển công nghệ;</option>
	<option value="151511">Trung tâm Đào tạo</option>
	<option value="151512">Trung tâm Dịch vụ tổng hợp</option>
	<option value="151513">Trung tâm Ươm tạo Doanh nghiệp công nghệ cao</option>
	<option value="151514">Công ty trách nhiệm hữu hạn một thành viên Phát triển Khu công nghệ cao Đà Nẵng</option>
	<option value="151516">Ban quản lý Đầu tư và Xây dựng khu Công nghệ Cao</option>
	<option value="151318">Ban Quản lý Khu công nghệ cao</option>
	<option value="150317">Văn phòng Đoàn ĐBQH và HĐND thành phố</option>
	<option value="151548">Thường trực HĐND, Trưởng/Phó Ban và chuyên trách ĐBQH</option>
	<option value="151765">Văn phòng Ban chỉ đạo phòng chống tham nhũng</option>
	<option value="150228">Đài Phát thanh - Truyền hình</option>
	<option value="153963">Trung tâm Quảng cáo và Dịch vụ Phát thanh - Truyền hình</option>
	<option value="153964">Trung tâm Truyền hình Cáp Đà Nẵng</option>
	<option value="150964">Viện Nghiên cứu phát triển kinh tế - xã hội</option>
	<option value="150965">Trường Cao đẳng Nghề</option>
	<option value="150966">Trung tâm Phát triển nguồn nhân lực chất lượng cao</option>
	<option value="150967">Quỹ Đầu tư phát triển Đà Nẵng</option>
	<option value="151710">Trung tâm Xúc tiến Đầu tư</option>
	<option value="151554">Thành Đoàn Đà Nẵng</option>
	<option value="151564">Nhà Văn hóa thiếu nhi Đà Nẵng</option>
	<option value="151565">Hội Phụ nữ thành phố</option>
	<option value="150988">Văn phòng Thành ủy</option>
	<option value="150977">Đảng ủy Dân chính Đảng</option>
	<option value="150989">Ban Tổ chức thành ủy</option>
	<option value="150990">Ban Dân vận thành ủy</option>
	<option value="150991">Ban Tuyên giáo thành ủy</option>
	<option value="150992">Ủy ban kiểm tra thành ủy</option>
	<option value="151897">Báo Đà Nẵng</option>
	<option value="151898">Trường Chính trị thành phố</option>
	<option value="150978">Cơ quan Trung ương tại thành phố</option>
	<option value="150979">Cục thuế Đà Nẵng</option>
	<option value="150986">Tổng Công ty Lâm nghiệp Việt Nam tại Đà Nẵng</option>
	<option value="150993">Công an thành phố</option>
	<option value="150994">Bộ Chỉ huy Quân sự thành phố</option>
	<option value="150995">Tòa án nhân dân thành phố</option>
	<option value="150996">Viện Kiểm sát nhân dân thành phố</option>
	<option value="150997">Cục Hải quan thành phố</option>
	<option value="150998">Cục Thống kê thành phố</option>
	<option value="150999">Cục Thuế thành phố</option>
	<option value="151000">Kho bạc Nhà nước</option>
	<option value="151001">Công ty TNHH Một thành viên Điện lực Đà Nẵng</option>
	<option value="151002">Bưu điện thành phố Đà Nẵng</option>
	<option value="151003">Ngân hàng Nhà nước - Chi nhánh Đà Nẵng</option>
	<option value="151004">Bảo hiểm xã hội thành phố</option>
	<option value="151005">Kiểm toán nhà nước khu vực III</option>
	<option value="151006">Tòa án Phúc thẩm thành phố Đà Nẵng</option>
	<option value="151007">Viện Kiểm sát Phúc thẩm tại Đà Nẵng</option>
	<option value="151899">Cơ quan Trung ương</option>
	<option value="151900">Khối Doanh nghiệp nhà nước</option>
	<option value="151901">Khối Doanh nghiệp tư nhân</option>
	<option value="153989">Trung tâm Dân số - KHHGĐ quận Hải Châu</option>
	<option value="153990">Hội Tù yêu nước</option>
	<option value="153991">Hội Chữ thập đỏ</option>
	<option value="153995">Liên hiệp các tổ chức hữu nghị</option>
	<option value="154009">Trường MN 29-3</option>
	<option value="154016">Trung tâm Điều hành Đèn tín hiệu giao thông và VTCC</option>
	<option value="154034">Đài Phát thanh</option>
	<option value="154035">Ban Quản lý dự án đầu tư xây dựng</option>
	<option value="154049">Chi cục Biển và Hải đảo</option>
	<option value="154069">Hạt Kiểm lâm rừng đặc dụng Bà Nà- Núi Chúa</option>
	<option value="154103">Bệnh viện Ung thư</option>
	<option value="154075">Ban Quản lý rừng đặc dụng Bà Nà - Núi Chúa</option>
	<option value="154163">Trung tâm Phòng tránh và Giảm nhẹ thiên tai </option>
	<option value="154167">UBND phường Phước Ninh</option>
	<option value="154168">UBND xã Hòa Tiến</option>
	<option value="154170">UBND phường Hòa Cường Bắc</option>
	<option value="154171">UBND phường Hòa Cường Nam</option>
	<option value="154172">UBND phường Hòa Thụân Đông</option>
	<option value="154173">UBND phường Hòa Thuận Tây</option>
	<option value="154174">UBND phường Bình Thuận</option>
	<option value="154175">UBND phường Bình Hiên</option>
	<option value="154176">UBND phường Nam Dương</option>
	<option value="154177">UBND phường Hải Châu 1</option>
	<option value="154178">UBND phường Hải Châu 2</option>
	<option value="154179">UBND phường Thạch Thang</option>
	<option value="154180">UBND phường Thanh Bình</option>
	<option value="154181">UBND phường Thuận Phước</option>
	<option value="154182">UBND phường An Hải Đông</option>
	<option value="154183">UBND phường An Hải Bắc</option>
	<option value="154184">UBND phường An Hải Tây</option>
	<option value="154185">UBND phường Phước Mỹ</option>
	<option value="154186">UBND phường Mân Thái</option>
	<option value="154187">UBND phường Nại Hiên Đông</option>
	<option value="154188">UBND phường Thọ Quang</option>
	<option value="154189">UBND phường Mỹ An</option>
	<option value="154190">UBND phường Hòa Hải</option>
	<option value="154191">UBND phường Khuê Mỹ</option>
	<option value="154192">UBND phường Hòa Quý</option>
	<option value="154193">UBND phường An Khê</option>
	<option value="154194">UBND phường Hòa Khê</option>
	<option value="154195">UBND phường Thanh Khê Đông</option>
	<option value="154196">UBND phường Thanh Khê Tây</option>
	<option value="154197">UBND phường Xuân Hà</option>
	<option value="154198">UBND phường Tam Thuận</option>
	<option value="154199">UBND phường Chính Gián</option>
	<option value="154200">UBND phường Thạc Gián</option>
	<option value="154201">UBND phường Tân Chính</option>
	<option value="154202">UBND phường Vĩnh Trung</option>
	<option value="154203">UBND phường Hòa Minh</option>
	<option value="154204">UBND phường Hòa Khánh Nam</option>
	<option value="154205">UBND phường Hòa Khánh Bắc</option>
	<option value="154206">UBND phường Hòa Hiệp Nam</option>
	<option value="154207">UBND phường Hòa Hiệp Bắc</option>
	<option value="154208">UBND phường Hòa An</option>
	<option value="154209">UBND phường Hòa Phát</option>
	<option value="154210">UBND phường Hòa Thọ Đông</option>
	<option value="154211">UBND phường Hòa Thọ Tây</option>
	<option value="154212">UBND phường Hòa Xuân</option>
	<option value="154213">UBND phường Khuê Trung</option>
	<option value="154214">UBND xã Hòa Châu</option>
	<option value="154215">UBND xã Hòa Phước</option>
	<option value="154216">UBND xã Hòa Phong</option>
	<option value="154217">UBND xã Hòa Phú</option>
	<option value="154218">UBND xã Hòa Nhơn</option>
	<option value="154219">UBND xã Hòa Khương</option>
	<option value="154220">UBND xã Hòa Bắc</option>
	<option value="154221">UBND xã Hòa Ninh</option>
	<option value="154222">UBND xã Hòa Sơn</option>
	<option value="154223">UBND xã Hòa Liên</option>
	<option value="154242">Trung tâm Phòng tránh và giảm nhẹ thiên tai</option>
	<option value="154274">Trung tâm Lưu trữ</option>
	<option value="154279">Ban Quản lý các dự án cơ sở hạ tầng ưu tiên</option>
	<option value="154286">Ban Quản lý Dự án Xây dựng số 2</option>
	<option value="154299">Trung tâm Dịch vụ Dân số - KHHGĐ</option>
	<option value="154306">Ban Giải phóng mặt bằng các dự án đầu tư xây dựng</option>
	<option value="154332">Dự án</option>
	<option value="154339">Bảo tàng Mỹ thuật Đà Nẵng</option>
	<option value="154343">Trường MN Sơn Ca</option>
	<option value="154349">Trường THCS Nguyễn Lương Bằng</option>
	<option value="154359">Trường Mầm non Hoàng Lan</option>
	<option value="154360">Trường Mầm non Sen Hồng</option>
	<option value="154368">Trung tâm WTO</option>
	<option value="154400">Công đoàn</option>
	<option value="154374">Trung tâm Vi mạch</option>
	<option value="154395">Công đoàn</option>
	<option value="154397">Công đoàn - Dự án</option>
	<option value="154398">Công đoàn</option>
	<option value="154402">Hội Cựu thanh niên xung phong</option>
	<option value="154403">Hội Liên hiệp thanh niên</option>
	<option value="154411">Câu lạc bộ Cán bộ trẻ</option>
	<option value="154409">Câu lạc bộ Thái Phiên</option>
	<option value="154410">Hội Sinh viên</option>
	<option value="154412">Hội Luật gia</option>
	<option value="154413">Hội Công chứng</option>
	<option value="154415">Hiệp hội Doanh nghiệp nhỏ và vừa</option>
	<option value="154416">Hiệp hội Doanh nghiệp phần mềm</option>
	<option value="154417">Hội Doanh nhân cựu chiến binh</option>
	<option value="154418">Hiệp hội Nữ doanh nhân</option>
	<option value="154419">Hội Doanh nhân trẻ </option>
	<option value="154420">Hiệp hội Gỗ và Lâm nghiệp</option>
	<option value="154421">Hiệp hội Bất động sản</option>
	<option value="154422">Hiệp hội Các nhà đầu tư</option>
	<option value="154424">Câu lạc bộ Doanh nghiệp có vốn đầu tư nước ngoài</option>
	<option value="154427">Hội Thương gia</option>
	<option value="154428">Hội Cán bộ hưu trí ngành công nghiệp</option>
	<option value="154429">Hội Bảo vệ quyền lợi người tiêu dùng</option>
	<option value="154430">Hội Cơ khí</option>
	<option value="154431">Hội Khoa học Kỹ thuật Đúc - Luyện kim</option>
	<option value="154432">Hội Làm vườn</option>
	<option value="154433">Hội Nghề cá</option>
	<option value="154434">Hiệp hội Vận tải ô tô</option>
	<option value="154435">Hiệp hội Taxi </option>
	<option value="154436">Hiệp hội Đào tạo lái xe ô tô, mô tô</option>
	<option value="154437">Hội Những người yêu thích ô tô</option>
	<option value="154438">Hội Kiến trúc sư</option>
	<option value="154439">Hội Khoa học Kỹ thuật Cầu Đường</option>
	<option value="154440">Hội Quy hoạch phát triển đô thị</option>
	<option value="154441">Hội Xây dựng</option>
	<option value="154442">Hội Bảo vệ thiên nhiên và môi trường </option>
	<option value="154443">Hội Tin học</option>
	<option value="154444">Hội Từ thiện và Bảo vệ quyền trẻ em</option>
	<option value="154445">Hội Nhân ái</option>
	<option value="154446">Hội Người khuyết tật</option>
	<option value="154447">Hội Bảo trợ người khuyết tật và trẻ mồ côi</option>
	<option value="154448">Ban Đại diện Hội Người cao tuổi</option>
	<option value="154449">Trung tâm Y tế từ thiện Phan Châu Toàn</option>
	<option value="154450">Trung tâm Nghệ thuật tình thương</option>
	<option value="154451">Hội Chiến sĩ bảo vệ Thành cổ Quảng Trị 81 ngày đêm năm 1972 tại Đà Nẵng</option>
	<option value="154452">Hội Âm nhạc</option>
	<option value="154453">Hội Mỹ thuật</option>
	<option value="154454">Hội Nghệ sĩ sân khấu</option>
	<option value="154455">Hội Điện ảnh</option>
	<option value="154456">Hội Văn nghệ dân gian</option>
	<option value="154457">Hội Nhiếp ảnh nghệ thuật</option>
	<option value="154458">Hội Nhà văn</option>
	<option value="154459">Hội Nghệ sĩ múa</option>
	<option value="154460">Hiệp hội Thể thao dưới nước</option>
	<option value="154461">Hội Cổ động viên bóng đá SHB Đà Nẵng</option>
	<option value="154462">Hội VOVINAM Việt Võ Đạo</option>
	<option value="154463">Hội Nghệ thuật hoa viên</option>
	<option value="154464">Hội Sinh vật cảnh</option>
	<option value="154465">Liên đoàn Quần vợt</option>
	<option value="154466">Liên đoàn Cầu lông</option>
	<option value="154467">Liên đoàn Bóng bàn</option>
	<option value="154468">Liên đoàn Võ thuật cổ truyền</option>
	<option value="154469">Câu lạc bộ Tóc sông Hàn</option>
	<option value="154470">Hội Tem</option>
	<option value="154471">Hội Khoa học Lịch sử</option>
	<option value="154472">Hiệp hội Du lịch</option>
	<option value="154473">Hiệp hội Quảng cáo</option>
	<option value="154474">Liên đoàn Cờ</option>
	<option value="154475">Câu lạc bộ Mô tô thể thao</option>
	<option value="154476">Hội Yoga</option>
	<option value="154477">Hội Golf</option>
	<option value="154478">Hội Karate-do</option>
	<option value="154479">Hội Khoa học Kỹ thuật Nhiệt</option>
	<option value="154480">Hội Khoa học Kinh tế</option>
	<option value="154481">Hội Tự động hóa</option>
	<option value="154482">Hội Hóa học</option>
	<option value="154483">Hội Nữ trí thức</option>
	<option value="154484">Hội Khuyến học</option>
	<option value="154485">Hội Cựu sinh viên Xây dựng - Bách khoa Đà Nẵng</option>
	<option value="154486">Hội Cựu giáo chức</option>
	<option value="154487">Hội Khoa học Tâm lý - Giáo dục</option>
	<option value="154488">Hội Ngôn ngữ học</option>
	<option value="154489">Hội Kế hoạch hóa gia đình</option>
	<option value="154490">Hội Tai - Mũi - Họng</option>
	<option value="154491">Hội Y học</option>
	<option value="154492">Hội Điều dưỡng</option>
	<option value="154493">Hội Dược liệu</option>
	<option value="154494">Hội Dược học</option>
	<option value="154495">Hội Chẩn đoán hình ảnh và Y học hạt nhân</option>
	<option value="154496">Hội Thiết bị y tế</option>
	<option value="154497">Hội Khoa học Tiêu hóa</option>
	<option value="154498">Hội Châm cứu</option>
	<option value="154499">Hội Phục hồi chức năng</option>
	<option value="154500">Hội Ngoại khoa</option>
	<option value="154501">Hội Thầy thuốc trẻ</option>
	<option value="154502">Hội Nữ hộ sinh</option>
	<option value="154503">Hội Hữu nghị Việt - Mỹ</option>
	<option value="154504">Hội Hữu nghị Việt - Lào</option>
	<option value="154505">Hội Hữu nghị Việt - Pháp</option>
	<option value="154506">Hội Hữu nghị Việt - Trung</option>
	<option value="154507">Hội Hữu nghị Việt - Nga</option>
	<option value="154508">Hội Hữu nghị Việt - Đức</option>
	<option value="154509">Ủy ban Hòa bình</option>
	<option value="154510">Hội Liên lạc với người Việt Nam ở nước ngoài</option>
	<option value="154511">Hội Hữu nghị Việt Nam - Thái Lan</option>
	<option value="154512">Hội Hữu nghị Việt - Nhật</option>
	<option value="154513">Câu lạc bộ Tiếng Pháp</option>
	<option value="154514">Hội Hữu nghị Việt Nam - Hàn Quốc</option>
	<option value="154515">Hội Hữu nghị Việt Nam - Ấn Độ</option>
	<option value="154516">Hội Ung thư</option>
	<option value="154527">test to chuc</option>
	<option value="154529">Trung tâm Công nghệ thông tin Tài nguyên và Môi trường Đà Nẵng</option>
	<option value="154536">Test đánh giá phường</option>
	<option value="154537">Test đánh giá sở</option>
	<option value="0">Chưa xác định</option>
</select><div class="chosen-container chosen-container-single" style="width: 220px;" title="" id="inst_code_knbp_chosen"><a tabindex="-1" class="chosen-single"><span>Sở Thông tin và Truyền thông</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
					</div>
				</div>
			</div>
		</div>
		<div class="span4 div_knbp div_knbp_chucvu" style="display: none;">
			<div class="control-group">
				<label for="pos_sys_knbp" class="control-label">Chức vụ (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<div class="row-fluid">
						<input type="hidden" value="" name="pos_name_knbp" id="pos_name_knbp">
						<select name="pos_sys_knbp" id="pos_sys_knbp">
							<option value=""></option>
															<option value="11020">Giám đốc</option>
															<option value="11024">Phó giám đốc</option>
															<option value="151291">Phụ trách Kế toán</option>
															<option value="151291">Kế toán trưởng</option>
															<option value="11028">Chánh văn phòng</option>
															<option value="11028">Chánh thanh tra</option>
															<option value="11028">Trưởng phòng</option>
															<option value="11028">Quyền trưởng phòng</option>
															<option value="11032">Phó Chánh thanh tra</option>
															<option value="11032">Phó Trưởng phòng phụ trách phòng</option>
															<option value="11032">Phó Trưởng phòng</option>
															<option value="11032">Phó Chánh văn phòng</option>
													</select>
					</div>
				</div>
			</div>
		</div>
		<div class="span4 div_knbp" style="display: none;">
			<div class="control-group">
				<label for="start_date_knbp" class="control-label">Ngày bắt đầu (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<div class="row-fluid input-append">
						<input type="text" data-date-format="dd/mm/yyyy" value="" class="input-small date-picker input-mask-date" name="start_date_knbp" id="start_date_knbp">
						<span class="add-on">
							<i class="icon-calendar"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>