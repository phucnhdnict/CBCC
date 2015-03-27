var showbienche = function(hinhthuctuyendung_id,ngaybatdau,thoihanbienchehopdong_id,ngayketthuc,soquyetdinh,coquanquyetdinh,ngaybanhanh){
	if(hinhthuctuyendung_id == null){
		hinhthuctuyendung_id = '';
	}
	if(ngaybatdau == null){
		ngaybatdau = '';
	}
	if(thoihanbienchehopdong_id == null){
		thoihanbienchehopdong_id = '';
	}
	if(ngayketthuc == null){
		ngayketthuc = '';
	}
	if(soquyetdinh == null){
		soquyetdinh = '';
	}
	if(coquanquyetdinh == null){
		coquanquyetdinh = '';
	}
	if(ngaybanhanh == null){
		ngaybanhanh = '';
	}
	var bc_hinhthuc_id = jQuery('#bc_hinhthuc_id').val();
	jQuery('#bc_ngaybatdau').removeClass('required dateVN validNgayBCHD').closest('.control-group').removeClass('error');
	jQuery('#bc_ngayketthuc').removeClass('required dateVN validNgayBCHD').closest('.control-group').removeClass('error');
	jQuery('#bc_soquyetdinh').removeClass('required dateVN validNgayBCHD').closest('.control-group').removeClass('error');
	jQuery('#bc_coquanquyetdinh').removeClass('required dateVN validNgayBCHD').closest('.control-group').removeClass('error');
	jQuery('#bc_ngaybanhanh').removeClass('required dateVN validNgayBCHD').closest('.control-group').removeClass('error');
	if(bc_hinhthuc_id == null || bc_hinhthuc_id == ''){
		jQuery('.div_ngaybatdau').hide();
		jQuery('.div_thoihan').hide();
		jQuery('.div_hinhthuctuyendung').hide();
		jQuery('.div_ngayketthuc').hide();
		jQuery('.div_soqd').hide();
		jQuery('.div_coquanqd').hide();
		jQuery('.div_ngaybanhanh').hide();
	}else{
		jQuery.ajax({
			type: "POST",
			url: "index.php?option=com_hoso&view=congtac&task=getHinhthucInfo&format=raw",
			data: {bc_hinhthuc_id:bc_hinhthuc_id},
			success:function(data){
				if(data != undefined && data.is_hinhthuctuyendung != null && data.is_hinhthuctuyendung != '' ){
					jQuery.ajax({
						type: "POST",
						url: "index.php?option=com_hoso&view=congtac&task=getHinhthucTuyendung&format=raw",
						data: {bc_hinhthuc_id:bc_hinhthuc_id},
						success:function(data_hinhthuctuyendung){
							var xhtml = '<option value=""></option>';
							if(data_hinhthuctuyendung !== undefined && data_hinhthuctuyendung.length > 0 ){
								jQuery.each(data_hinhthuctuyendung, function(i,v){
									xhtml += '<option value="' + v.id + '">' + v.name + '</option>';
								});
								jQuery('#bc_hinhthuctuyendung_id').html(xhtml);
								jQuery('#bc_hinhthuctuyendung_id').val(hinhthuctuyendung_id);
								jQuery('#bc_hinhthuctuyendung_id').addClass('required');
								jQuery('.div_hinhthuctuyendung').show();
							}else{
								jQuery('#bc_hinhthuctuyendung_id').html(xhtml);
								jQuery('#bc_hinhthuctuyendung_id').removeClass('required');
								jQuery('.div_hinhthuctuyendung').hide();
							}
						}
					});
				}else{
					jQuery('#bc_hinhthuctuyendung_id').val('');
					jQuery('#bc_hinhthuctuyendung_id').removeClass('required');
					jQuery('.div_hinhthuctuyendung').hide();
				}
				if(data != undefined && data.text_ngaybatdau != null && data.text_ngaybatdau != '' ){
					if(data.valid_ngaybatdau == 'required'){
						jQuery('#lbl_ngaybatdau').html(data.text_ngaybatdau + ' (<span style="color:red;">*</span>)');
					}else{
						jQuery('#lbl_ngaybatdau').html(data.text_ngaybatdau);
					}
					jQuery('#bc_ngaybatdau').val(ngaybatdau);
					jQuery('.div_ngaybatdau').show();
					jQuery('#bc_ngaybatdau').addClass(data.valid_ngaybatdau);
				}else{
					jQuery('#bc_ngaybatdau').val('');
					jQuery('.div_ngaybatdau').hide();
				}
				if(data != undefined && data.is_thietlapthoihan != null && data.is_thietlapthoihan != '' ){
					jQuery.ajax({
						type: "POST",
						url: "index.php?option=com_hoso&view=congtac&task=getThoihan&format=raw",
						data: {bc_hinhthuc_id:bc_hinhthuc_id},
						success:function(data){
							var xhtml = '<option value="" month="0"></option>';
							if(data !== undefined && data.length > 0 ){
								jQuery.each(data,function(i,v){
									xhtml += '<option value="' + v.id + '" month="' + v.month + '">' + v.name + '</option>';
								});
								jQuery('#bc_thoihanbienchehopdong_id').html(xhtml);
								jQuery('#bc_thoihanbienchehopdong_id').val(thoihanbienchehopdong_id);
								jQuery('#bc_thoihanbienchehopdong_id').addClass('required');
								jQuery('.div_thoihan').show();
								jQuery('#bc_ngayketthuc').attr('readonly','readonly');
								jQuery('#bc_thoihanbienchehopdong_id').on('change',function(){
									var month = jQuery(this).find('option:selected').attr('month');
									if(month < 0){
										jQuery('#bc_ngayketthuc').removeAttr('readonly');
										jQuery('#bc_ngayketthuc').val('');
									}else{
										if(jQuery('#bc_ngaybatdau').val() != ''){
											var arrBegin = jQuery('#bc_ngaybatdau').val().split("/");
											if(arrBegin.length == 3){
												total_month = (parseInt(arrBegin[1]) + parseInt(month));
												if(parseInt(total_month%12) == 0){
													monthEnd = '01';
												}else if(parseInt(total_month%12) < 10){
													monthEnd = '0' + total_month%12;
												}else{
													monthEnd = total_month%12
												}
												yearEnd = parseInt(total_month/12) + parseInt(arrBegin[2]);
												dateEnd = arrBegin[0] + '/' + monthEnd + '/' + yearEnd;
												jQuery('#bc_ngayketthuc').val(dateEnd);
											}
										}
										jQuery('#bc_ngayketthuc').attr('readonly','readonly');
									}
								});
							}else{
								jQuery('#bc_thoihanbienchehopdong_id').html(xhtml);
								jQuery('#bc_thoihanbienchehopdong_id').removeClass('required');
								jQuery('.div_thoihan').hide();
								jQuery('#bc_ngayketthuc').removeAttr('readonly');
							}
						}
					});
				}else{
					jQuery('#bc_thoihanbienchehopdong_id').removeClass('required');
					jQuery('.div_thoihan').hide();
					jQuery('#bc_thoihanbienchehopdong_id').val('');
				}
				if(data != undefined && data.text_ngayketthuc != null && data.text_ngayketthuc != '' ){
					if(data.valid_ngayketthuc == 'required'){
						jQuery('#lbl_ngayketthuc').html(data.text_ngayketthuc + ' (<span style="color:red;">*</span>)');
					}else{
						jQuery('#lbl_ngayketthuc').html(data.text_ngayketthuc);
					}
					jQuery('#bc_ngayketthuc').val(ngayketthuc);
					jQuery('.div_ngayketthuc').show();
					jQuery('#bc_ngayketthuc').addClass(data.valid_ngayketthuc);
				}else{
					jQuery('.div_ngayketthuc').hide();
					jQuery('#bc_ngayketthuc').val('');
				}
				if(data != undefined && data.text_soquyetdinh != null && data.text_soquyetdinh != '' ){
					if(data.valid_soquyetdinh == 'required'){
						jQuery('#lbl_soqd').html(data.text_soquyetdinh + ' (<span style="color:red;">*</span>)');
					}else{
						jQuery('#lbl_soqd').html(data.text_soquyetdinh);
					}
					jQuery('#bc_soquyetdinh').addClass(data.valid_soquyetdinh);
					jQuery('#bc_soquyetdinh').val(soquyetdinh);
					jQuery('.div_soqd').show();
				}else{
					jQuery('#bc_soquyetdinh').val('');
					jQuery('.div_soqd').hide();
				}
				if(data != undefined && data.text_coquanraquyetdinh != null && data.text_coquanraquyetdinh != '' ){
					if(data.valid_coquanraquyetdinh == 'required'){
						jQuery('#lbl_coquanqd').html(data.text_coquanraquyetdinh + ' (<span style="color:red;">*</span>)');
					}else{
						jQuery('#lbl_coquanqd').html(data.text_coquanraquyetdinh);
					}
					jQuery('#bc_coquanquyetdinh').addClass(data.valid_coquanraquyetdinh);
					jQuery('#bc_coquanquyetdinh').val(coquanquyetdinh);
					jQuery('.div_coquanqd').show();
				}else{
					jQuery('#bc_coquanquyetdinh').val('');
					jQuery('.div_coquanqd').hide();
				}
				if(data != undefined && data.text_ngaybanhanh != null && data.text_ngaybanhanh != '' ){
					if(data.valid_ngaybanhanh == 'required'){
						jQuery('#lbl_ngaybanhanh').html(data.text_ngaybanhanh + ' (<span style="color:red;">*</span>)');
					}else{
						jQuery('#lbl_ngaybanhanh').html(data.text_ngaybanhanh);
					}
					jQuery('#bc_ngaybanhanh').addClass(data.valid_ngaybanhanh);
					jQuery('#bc_ngaybanhanh').val(ngaybanhanh);
					jQuery('.div_ngaybanhanh').show();
				}else{
					jQuery('#bc_ngaybanhanh').val('');
					jQuery('.div_ngaybanhanh').hide();
				}
			}
		});
	}
};
var clickDoituong = function(row_index){
	if(jQuery('input[name="check_doituong[]"]').eq(row_index).is(':checked')){
		if(jQuery('input[name="doituong_id[]"]').eq(row_index).val() == '1'){
			jQuery('.td_doituong').eq(row_index).find('.span3').show();
		}else{
			if(jQuery('.td_doituong').eq(row_index).find('.span6').length > 0){
				jQuery('.td_doituong').eq(row_index).find('.span6').show();
				jQuery('.cbxLoaiDT').eq(row_index).change();
			}else{
				jQuery('.td_doituong').eq(row_index).find('.span3').show();
			}
		}
		jQuery('input[name="doituong_selected[]"]').eq(row_index).val('1');
	}else{
		if(jQuery('input[name="doituong_id[]"]').eq(row_index).val() == '1'){
			jQuery('.td_doituong').eq(row_index).find('.span3').hide();
		}else{
			if(jQuery('.td_doituong').eq(row_index).find('.span6').length > 0){
				jQuery('.cbxLoaiDT').eq(row_index).val('');
				jQuery('.cbxLoaiDT').eq(row_index).change();
				jQuery('.td_doituong').eq(row_index).find('.span6').hide();
			}else{
				jQuery('.td_doituong').eq(row_index).find('.span3').hide();
			}
		}
		jQuery('input[name="doituong_selected[]"]').eq(row_index).val('0');
	}
};
var showQuanDoi = function(){
	var val=jQuery("#quandoi").val();
	if(val==1){
		jQuery(".quandoi1").show();
		jQuery(".quandoi2").show();
	}else{
		jQuery(".quandoi1").hide();
		jQuery(".quandoi2").hide();
	}
};
var ktraVK = function(){
	var mangach = jQuery('#sta_code_sal').val();
	var bac = jQuery('#sl_code_sal').val();
	if(mangach != ''){
		jQuery.ajax({
			type: "POST",
			url: "index.php?option=com_hoso&view=congtac&task=ktraVK&format=raw",
			data: {mangach:mangach, bac:bac},
			success:function(data){
				if(data == '1'){
					jQuery('.vk').show();
					jQuery('#ext_coef_per_sal').addClass('required').attr('title','Nhập phần trăm vượt khung');
				}else{
					jQuery('.vk').hide();
					jQuery('#ext_coef_per_sal').removeClass('required').removeAttr('title');
					jQuery('#ext_coef_per_sal').val('');
				}
			}
		});
	}
};
jQuery(document).ready(function($){
	/********************** Quá trình Biên chế, hợp đồng ************************/
	$('body').delegate('.btn_detail_bienche', 'click', function(){
		var row_index = $('.btn_detail_bienche').index($(this));
		$('.tr_child_bienchehopdong').eq(row_index).slideToggle('slow');
	});
	$('body').delegate('#btn_add_bchd', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình biên chế hợp đồng');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_bchd">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=congtac&format=raw&task=add_bchd&idHoso='+$('#idHoso').val()+'&id_donvi='+$('#id_donvi').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_bchd', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình biên chế hợp đồng');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_bchd ">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=congtac&format=raw&task=edit_bchd&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val()+'&id_donvi='+$('#id_donvi').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('#btn-hinhthucbckhac', 'click', function(){
		$('#bc_hinhthuc_id_khac').slideToggle('slow');
	});
	$('body').delegate('#bc_hinhthuc_id_khac', 'change', function(){
		if($('#bc_hinhthuc_id').find('option[value="'+$(this).find("option:selected").val()+'"]').length < 1){
			$(this).find("option:selected").clone().appendTo('#bc_hinhthuc_id');
		}
		$('#bc_hinhthuc_id').val($(this).val());
		$('#bc_hinhthuc_id').change();
		$(this).slideToggle('slow');
	});
	$('body').delegate('.btn_save_bchd', 'click', function(){
		$.blockUI();
		if($('#BiencheFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			if($('#arrGoibienche').length > 0){
				var arrGoibienche = $('#arrGoibienche').val().split(',');
			}else{
				var arrGoibienche = '';
			}
			if($('#ngaybatdau_bchd').length > 0){
				if($('#ngaybatdau_bchd').val() != null && $('#ngaybatdau_bchd').val() != ''){
					var bc_ngaybatdau_bchd = $('#ngaybatdau_bchd').val();
				}else{
					var bc_ngaybatdau_bchd = $('#bc_ngaybatdau').val();
				}
			}else{
				var bc_ngaybatdau_bchd = $('#bc_ngaybatdau').val();
			}
			
			if(Date.parseExact($('#bc_ngaybatdau').val(),'dd/mm/yyyy').compareTo(Date.parseExact(bc_ngaybatdau_bchd,'dd/mm/yyyy')) == 1 && $.inArray($('#bc_hinhthuc_id').val(),arrGoibienche) == -1){
				loadNoticeBoardError('Thông báo', 'Quá trình biên chế mới nhất phải phù hợp với các hình thức biên chế cho phép của đơn vị');
				$.unblockUI();
				return false;
			}else{
				var url = 'index.php?option=com_hoso&controller=hoso&task=saveBienche';
				$.post(url, $('#BiencheFrm').serialize(), function(data){
					if(data == '1'){
						loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
						if(Date.parseExact($('#bc_ngaybatdau').val(),'dd/mm/yyyy').compareTo(Date.parseExact(bc_ngaybatdau_bchd,'dd/mm/yyyy')) == 1){
							var idHoso = jQuery('#idHoso').val();
							$.ajax({
								type: 'POST',
								url: 'index.php?option=com_hoso&view=thongtinchung&format=raw&task=getInfoBienche',
								data: { idHoso : idHoso },
								success:function(data){
									renewElement($('#lbl_loaihinh_bchd'),data.lbl_loaihinh_bchd);
									renewElement($('#lbl_ngaybatdau_bchd'),data.lbl_ngaybatdau_bchd);
									$('label[for="lbl_ngaybatdau_bchd"]').html(data.text_ngaybatdau);
									renewElement($('#lbl_hinhthuctuyendung_bchd'),data.lbl_hinhthuctuyendung_bchd);
									renewElement($('#lbl_thoihan_bchd'),data.lbl_thoihan_bchd);
									renewElement($('#lbl_ngayketthuc_bchd'),data.lbl_ngayketthuc_bchd);
									$('label[for="lbl_ngayketthuc_bchd"]').html(data.text_ngayketthuc);
									renewElement($('#lbl_soquyetdinh_bchd'),data.lbl_soquyetdinh_bchd);
									$('label[for="lbl_soquyetdinh_bchd"]').html(data.text_soquyetdinh);
									renewElement($('#lbl_coquanquyetdinh_bchd'),data.lbl_coquanquyetdinh_bchd);
									$('label[for="lbl_coquanquyetdinh_bchd"]').html(data.text_coquanraquyetdinh);
								}
							});
						}
						$('#modalQuatrinh').modal('hide');
						$('#noidung_quatrinh').html('');
						$('#div-quatrinhbienchehopdong').load('index.php?option=com_hoso&view=congtac&format=raw&task=quatrinhbienchehopdong&idHoso='+$('#idHoso').val()+'&id_donvi='+$('#id_donvi').val(),function(){
							$.unblockUI();
						});
					}else{
						loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
						$.unblockUI();
					}
				});
			}
		}
	});
	
	/********************** Quá trình công tác ************************/
	$('body').delegate('.btn_detail_congtac', 'click', function(){
		var row_index = $('.btn_detail_congtac').index($(this));
		$('.tr_child_congtac').eq(row_index).slideToggle('slow');
	});
	$('body').delegate('#btn_add_congtac', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình công tác');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_congtac">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=congtac&format=raw&task=add_congtac&idHoso='+$('#idHoso').val()+'&ngaybatdau='+$('#newest_ngaybatdau').val()+'&donvi='+$('#newest_donvi').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_congtac', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình công tác');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_congtac ">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=congtac&format=raw&task=edit_congtac&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val()+'&ngaybatdau='+$('#newest_ngaybatdau').val()+'&donvi='+$('#newest_donvi').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_congtac', 'click', function(){
		$.blockUI();
		if($('#CongtacFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveCongtac';
			$.post(url, $('#CongtacFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhcongtac').load('index.php?option=com_hoso&view=congtac&format=raw&task=quatrinhcongtac&idHoso='+$('#idHoso').val()+'&id_donvi='+$('#id_donvi').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});
	
	/********************** Quá trình công tác nước ngoài ************************/
	$('body').delegate('.btn_detail_congtacnn', 'click', function(){
		var row_index = $('.btn_detail_congtacnn').index($(this));
		$('.tr_child_congtacnn').eq(row_index).slideToggle('slow');
	});
	$('body').delegate('#btn_add_congtacnn', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình công tác nước ngoài');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_congtacnn">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=congtac&format=raw&task=add_congtacnn&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_congtacnn', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình công tác nước ngoài');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_congtacnn ">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=congtac&format=raw&task=edit_congtacnn&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_congtacnn', 'click', function(){
		$.blockUI();
		if($('#CongtacNNFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveCongtacNN';
			$.post(url, $('#CongtacNNFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhcongtacnn').load('index.php?option=com_hoso&view=congtac&format=raw&task=quatrinhcongtacnn&idHoso='+$('#idHoso').val()+'&id_donvi='+$('#id_donvi').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});
	
	/********************** Quá trình kiêm nhiệm, biệt phái ************************/
	$('body').delegate('.btn_detail_knbp', 'click', function(){
		var row_index = $('.btn_detail_knbp').index($(this));
		$('.tr_child_knbp').eq(row_index).slideToggle('slow');
	});
	$('body').delegate('#btn_add_knbp', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình kiêm nhiệm biệt phái');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_knbp">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=congtac&format=raw&task=add_knbp&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_knbp', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình kiêm nhiệm biệt phái');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_knbp ">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=congtac&format=raw&task=edit_knbp&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_knbp', 'click', function(){
		$.blockUI();
		if($('#KiemnhiemFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveKiemnhiem';
			$.post(url, $('#KiemnhiemFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhkiemnhiembietphai').load('index.php?option=com_hoso&view=congtac&format=raw&task=quatrinhkiemnhiembietphai&idHoso='+$('#idHoso').val()+'&id_donvi='+$('#id_donvi').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});
	$('body').delegate('#type_knbp', 'change', function(){
		if($('#type_knbp').val() != ''){
			$('.div_knbp').show();
			if($('#type_knbp').val() == '2'){
				$('.div_knbp_chucvu').hide();
				$('#pos_sys_knbp').val('');
				$('#pos_name_knbp').val('');
			}
		}else{
			$('.div_knbp').hide();
		}
	});
	
	/********************** Quá trình Lương mới ************************/
	$('body').delegate('#btn_add_luongmoi', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình lương mới');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_luongmoi">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=luong&format=raw&task=add_luongmoi&idHoso='+$('#idHoso').val()+'&id_donvi='+$('#id_donvi').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_luongmoi', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình lương mới');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_luongmoi">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=luong&format=raw&task=edit_luongmoi&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val()+'&id_donvi='+$('#id_donvi').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_luongmoi', 'click', function(){
		$.blockUI();
		if($('#LuongmoiFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveLuongmoi';
			$.post(url, $('#LuongmoiFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					var idHoso = jQuery('#idHoso').val();
					$.ajax({
						type: 'POST',
						url: 'index.php?option=com_hoso&view=thongtinchung&format=raw&task=getInfoLuong',
						data: { idHoso : idHoso },
						success:function(data){
							renewElement($('#lbl_mangach_luongmoi'),data.lbl_mangach_luongmoi);
							renewElement($('#lbl_tenngach_luongmoi'),data.lbl_tenngach_luongmoi);
							renewElement($('#lbl_ngayhuong_luongmoi'),data.lbl_ngayhuong_luongmoi);
							renewElement($('#lbl_bac_luongmoi'),data.lbl_bac_luongmoi);
							renewElement($('#lbl_ngayhuongtieptheo_luongmoi'),data.lbl_ngayhuongtieptheo_luongmoi);
							renewElement($('#lbl_heso_luongmoi'),data.lbl_heso_luongmoi);
							renewElement($('#lbl_vuotkhung_luongmoi'),data.lbl_vuotkhung_luongmoi);
						}
					});
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhluongmoi').load('index.php?option=com_hoso&view=luong&format=raw&task=quatrinhluongmoi&idHoso='+$('#idHoso').val()+'&id_donvi='+$('#id_donvi').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});
	$('body').delegate('#whois_sal_fk', 'change', function(){
		var sotien = $(this).find('option:selected').data('sotien');
		var nangluong = $(this).find('option:selected').data('nangluong');
		var ngaynangluong = $(this).find('option:selected').data('ngaynangluong');
		var phantramsotien = $(this).find('option:selected').data('phantramsotien');
		$('#is_nangluong').val(nangluong);
		$('#percent').val(phantramsotien);
		$('.dvnongach').show();
		if(sotien == '1'){
			$('.luong_sotien').show();
			$('#sta_code_sal').val('');
			$('#sta_name_sal').val('');
			$('#sl_code_sal').val('');
			$('#coef_sal').val('');
			$('#ext_coef_per_sal').val('');
			$('.dvnongach').hide();
			$('#sta_code_sal').change();
		}else{
			$('.luong_sotien').hide();
			$('#money_sal_show').val('');
			$('#money_sal').val('');
		}
		if(ngaynangluong == '1'){
			$('.luong_ngaynangluong').show();
		}else{
			$('.luong_ngaynangluong').hide();
			$('#real_start_date_sal').val('');
		}
	});
	$('body').delegate('#sta_code_sal', 'change', function(){
		var mangach = $(this).val();
		var str_bac = '<option value="" coef_sal=""></option>';
		if(mangach == ''){
			$('#sl_code_sal').html(str_bac);
		}else{
			$.ajax({
				type: "POST",
				url: "index.php?option=com_hoso&view=congtac&task=getBac&format=raw",
				data: {mangach:mangach},
				success:function(data){
					if(data !== undefined && data.length > 0 ){
						$.each(data,function(i,v){
							str_bac += '<option value="' + v.idbac + '" heso="' + v.heso + '">' + v.idbac + '</option>';
						});
					}
					$('#sl_code_sal').html(str_bac);
				}
			});
		}
		$('#sta_name_sal').val($(this).find('option:selected').text());
		$('#hs').html('0');
		$('#coef_sal').val('');
		$('.vk').hide();
		$('#ext_coef_per_sal').val('');
		ktraVK();
	});
	$('body').delegate('#sl_code_sal', 'change', function(){
		$('#hs').html($(this).find('option:selected').attr('heso'));
		$('#coef_sal').val($(this).find('option:selected').attr('heso'));
		ktraVK();
	});
	$('body').delegate('#btn-hinhthucluongkhac', 'click', function(){
		$('#whois_sal_fk_khac').slideToggle('slow');
	});
	$('body').delegate('#whois_sal_fk_khac', 'change', function(){
		if($('#whois_sal_fk').find('option[value="'+$(this).find("option:selected").val()+'"]').length < 1){
			$(this).find("option:selected").clone().appendTo('#whois_sal_fk');
		}
		$('#whois_sal_fk').val($(this).val());
		$('#whois_sal_fk').change();
		$(this).slideToggle('slow');
	});
	$('body').delegate('#btn-ngachkhac', 'click', function(){
		$('#sta_code_sal_khac').next().slideToggle('slow');
	});
	$('body').delegate('#sta_code_sal_khac', 'change', function(){
		if($('#sta_code_sal').find('option[value="'+$(this).find("option:selected").val()+'"]').length < 1){
			$(this).find("option:selected").clone().appendTo('#sta_code_sal');
		}
		$('#sta_code_sal').val($(this).val());
		$('#sta_code_sal').change();
		$(this).next().slideToggle('slow');
	});

	/********************** Quá trình Lương cũ ************************/
	$('body').delegate('#btn_add_luongcu', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình lương cũ');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_luongcu">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=luong&format=raw&task=add_luongcu&idHoso='+$('#idHoso').val()+'&id_donvi='+$('#id_donvi').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_luongcu', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình lương cũ');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_luongcu">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=luong&format=raw&task=edit_luongcu&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val()+'&id_donvi='+$('#id_donvi').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_luongcu', 'click', function(){
		$.blockUI();
		if($('#LuongcuFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveLuongcu';
			$.post(url, $('#LuongcuFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhluongcu').load('index.php?option=com_hoso&view=luong&format=raw&task=quatrinhluongcu&idHoso='+$('#idHoso').val()+'&id_donvi='+$('#id_donvi').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});
	$('body').delegate('#whois_sal_fk_old', 'change', function(){
		var whois_sal = $(this).val();
		var sotien = $(this).find('option:selected').data('sotien');
		var nangluong = $(this).find('option:selected').data('nangluong');
		var ngaynangluong = $(this).find('option:selected').data('ngaynangluong');
		var phantramsotien = $(this).find('option:selected').data('phantramsotien');
		$('.dvnongach').show();
		$('#is_nangluong').val(nangluong);
		if(sotien == '1'){
			$('.dvtien').show();
			$('.dvnongach').hide();
			$('#sta_code_sal_old').val('');
			$('#sta_name_sal_old').val('');
			$('#sl_code_sal_old').val('');
			$('#coef_sal_old').val('');
			$('#ext_coef_per_sal_old').val('');
		}else{
			$('.dvtien').hide();
			$('#money_sal_old_show').val('');
			$('#money_sal_old').val('');
		}
		if(ngaynangluong == '1'){
			$('.dvthoigian').show();
			$("#real_start_date_sal_old").addClass("dateVN").attr('title','Nhập đúng định dạng thời điểm nâng lương lần sau');
		}else{
			$('.dvthoigian').hide();
			$('#real_start_date_sal_old').val('');
			$("#real_start_date_sal_old").removeClass("dateVN").removeAttr('title');
		}
	});

	/********************** Quá trình Phụ cấp thâm niên nghề ************************/
	$('body').delegate('#btn_add_phucap_thamnien', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình phụ cấp thâm niên nghề');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_phucap_thamnien">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=luong&format=raw&task=add_phucap_thamnien&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_phucap_thamnien', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình phụ cấp thâm niên nghề');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_phucap_thamnien">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=luong&format=raw&task=edit_phucap_thamnien&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_phucap_thamnien', 'click', function(){
		$.blockUI();
		if($('#PhucapThamnienFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=savePhucapThamnien';
			$.post(url, $('#PhucapThamnienFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhphucapthamnien').load('index.php?option=com_hoso&view=luong&format=raw&task=quatrinhphucap_thamnien&idHoso='+$('#idHoso').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});

	/********************** Quá trình đào tạo chuyên môn ************************/
	$('body').delegate('.btn_detail_chuyenmon', 'click', function(){
		var row_index = $('.btn_detail_chuyenmon').index($(this));
		$('.tr_child_chuyenmon').eq(row_index).slideToggle('slow');
	});
	$('body').delegate('#btn_add_chuyenmon', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình đào tạo chuyên môn');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_chuyenmon">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=daotao&format=raw&task=add_chuyenmon&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_chuyenmon', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình đào tạo chuyên môn');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_chuyenmon">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=daotao&format=raw&task=edit_chuyenmon&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_chuyenmon', 'click', function(){
		$.blockUI();
		if($('#ChuyenmonFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveChuyenmon';
			$.post(url, $('#ChuyenmonFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					var idHoso = jQuery('#idHoso').val();
					$.ajax({
						type: 'POST',
						url: 'index.php?option=com_hoso&view=thongtinchung&format=raw&task=getInfoDaotao',
						data: { idHoso : idHoso },
						success:function(data){
							renewElement($('#lbl_trinhdochuyenmon'),data.lbl_trinhdochuyenmon);
							renewElement($('#lbl_chuyennganhdaotao'),data.lbl_chuyennganhdaotao);
							renewElement($('#lbl_trinhdotinhoc'),data.lbl_trinhdotinhoc);
							renewElement($('#lbl_chucdanhkhoahoc'),data.lbl_chucdanhkhoahoc);
							renewElement($('#lbl_lyluanchinhtri'),data.lbl_lyluanchinhtri);
							renewElement($('#lbl_quanlyhanhchinh'),data.lbl_quanlyhanhchinh);
							renewElement($('#lbl_quanlykinhte'),data.lbl_quanlykinhte);
							renewElement($('#lbl_tienganh'),data.lbl_tienganh);
							renewElement($('#lbl_anninhquocphong'),data.lbl_anninhquocphong);
						}
					});
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhdaotaochuyenmon').load('index.php?option=com_hoso&view=daotao&format=raw&task=quatrinhdaotaochuyenmon&idHoso='+$('#idHoso').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});

	/********************** Quá trình bồi dưỡng nghiệp vụ ************************/
	$('body').delegate('.btn_detail_nghiepvu', 'click', function(){
		var row_index = $('.btn_detail_nghiepvu').index($(this));
		$('.tr_child_nghiepvu').eq(row_index).slideToggle('slow');
	});
	$('body').delegate('#btn_add_nghiepvu', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình bồi dưỡng nghiệp vụ');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_nghiepvu">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=daotao&format=raw&task=add_nghiepvu&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_nghiepvu', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình bồi dưỡng nghiệp vụ');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_nghiepvu">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=daotao&format=raw&task=edit_nghiepvu&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_nghiepvu', 'click', function(){
		$.blockUI();
		if($('#NghiepvuFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveNghiepvu';
			$.post(url, $('#NghiepvuFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					var idHoso = jQuery('#idHoso').val();
					$.ajax({
						type: 'POST',
						url: 'index.php?option=com_hoso&view=thongtinchung&format=raw&task=getInfoDaotao',
						data: { idHoso : idHoso },
						success:function(data){
							renewElement($('#lbl_trinhdochuyenmon'),data.lbl_trinhdochuyenmon);
							renewElement($('#lbl_chuyennganhdaotao'),data.lbl_chuyennganhdaotao);
							renewElement($('#lbl_trinhdotinhoc'),data.lbl_trinhdotinhoc);
							renewElement($('#lbl_chucdanhkhoahoc'),data.lbl_chucdanhkhoahoc);
							renewElement($('#lbl_lyluanchinhtri'),data.lbl_lyluanchinhtri);
							renewElement($('#lbl_quanlyhanhchinh'),data.lbl_quanlyhanhchinh);
							renewElement($('#lbl_quanlykinhte'),data.lbl_quanlykinhte);
							renewElement($('#lbl_tienganh'),data.lbl_tienganh);
							renewElement($('#lbl_anninhquocphong'),data.lbl_anninhquocphong);
						}
					});
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhboiduongnghiepvu').load('index.php?option=com_hoso&view=daotao&format=raw&task=quatrinhboiduongnghiepvu&idHoso='+$('#idHoso').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});
	$('body').delegate('#tosc_code_dt_nghiepvu', 'change', function(){
		var loaitrinhdo = $(this).val();
		var is_chuyennganh = $(this).find('option:selected').data('iscn');
		if(is_chuyennganh != '1'){
			$.ajax({
				type: "POST",
				url: "index.php?option=com_hoso&view=daotao&format=raw&task=getTrinhdoByLoaitrinhdo",
				data: {loaitrinhdo:loaitrinhdo},
				success:function(data){
					var str = '<option value="" data-istext="0"></option>';
					if(data !== undefined && data.length > 0 && data !== null ){
						$.each(data,function(i,v){
							str+= '<option value="' + v.code + '" data-istext="' + v.istext +'">' + v.name + '</option>';
						});
					}
					$('#sca_code_dt_nghiepvu').html(str);
					$('#sca_code_dt_nghiepvu').change();
				}
			});
			$('.div_CNDTNV').hide();
			$('#lim_name_dt_nghiepvu').val('');
			$('#lim_code_dt_nghiepvu').val('');
			$('#lim_code_dt_nghiepvu').removeClass('required');
		}else{
			$('.div_CNDTNV').show();
			$('#lim_code_dt_nghiepvu').addClass('required');
			$("#sca_code_dt_nghiepvu").html('<option value="" data-istext="0"></option>');
		}
	});
	$('body').delegate('#lim_code_dt_nghiepvu', 'change', function(){
		var ngoaingu = $(this).val();
		$.ajax({
			type: "POST",
			url: "index.php?option=com_hoso&view=daotao&format=raw",
			data: { ngoaingu : ngoaingu, task : 'getOptTrinhdoNV' },
			success:function(data){
				var str = '<option value="" data-istext=""></option>';
				if(data !== undefined || data.length > 0){
					$.each(data,function(i,v){
						str+= '<option value="'+v.code+'" data-istext="'+v.istext+'">'+v.name+'</option>';
					});
				}
				$("#sca_code_dt_nghiepvu").html(str);
			}
		});
	});

	/********************** Quá trình bồi dưỡng ngắn hạn ************************/
	$('body').delegate('#btn_add_nganhan', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình bồi dưỡng ngắn hạn');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_nganhan">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=daotao&format=raw&task=add_nganhan&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_nganhan', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình bồi dưỡng ngắn hạn');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_nganhan">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=daotao&format=raw&task=edit_nganhan&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_nganhan', 'click', function(){
		$.blockUI();
		if($('#NganhanFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveNganhan';
			$.post(url, $('#NganhanFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhboiduongnganhan').load('index.php?option=com_hoso&view=daotao&format=raw&task=quatrinhboiduongnganhan&idHoso='+$('#idHoso').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});

	/********************** Quá trình đào tạo phổ thông ************************/
	$('body').delegate('#btn_add_phothong', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình đào tạo phổ thông');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_phothong">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=daotao&format=raw&task=add_phothong&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_phothong', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình đào tạo phổ thông');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_phothong">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=daotao&format=raw&task=edit_phothong&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_phothong', 'click', function(){
		$.blockUI();
		if($('#PhothongFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=savePhothong';
			$.post(url, $('#PhothongFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhdaotaophothong').load('index.php?option=com_hoso&view=daotao&format=raw&task=quatrinhdaotaophothong&idHoso='+$('#idHoso').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});

	/********************** Quá trình khen thưởng ************************/
	$('body').delegate('#btn_add_khenthuong', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình khen thưởng');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_khenthuong">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=khenthuongkyluat&format=raw&task=add_khenthuong&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_khenthuong', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình khen thưởng');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_khenthuong">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=khenthuongkyluat&format=raw&task=edit_khenthuong&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_khenthuong', 'click', function(){
		$.blockUI();
		if($('#KhenthuongFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveKhenthuong';
			$.post(url, $('#KhenthuongFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhkhenthuong').load('index.php?option=com_hoso&view=khenthuongkyluat&format=raw&task=quatrinhkhenthuong&idHoso='+$('#idHoso').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});
	$('body').delegate('#rew_code', 'change', function(){
		$('#description_kt').val($(this).find('option:selected').text());
	});

	/********************** Quá trình kỷ luật ************************/
	$('body').delegate('#btn_add_kyluat', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình kỷ luật');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_kyluat">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=khenthuongkyluat&format=raw&task=add_kyluat&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_kyluat', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình kỷ luật');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_kyluat">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=khenthuongkyluat&format=raw&task=edit_kyluat&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_kyluat', 'click', function(){
		$.blockUI();
		if($('#KyluatFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveKyluat';
			$.post(url, $('#KyluatFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhkyluat').load('index.php?option=com_hoso&view=khenthuongkyluat&format=raw&task=quatrinhkyluat&idHoso='+$('#idHoso').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});
	$('body').delegate('#rafc_code', 'change', function(){
		$('#description_kl').val($(this).find('option:selected').text());
		var url = 'index.php?option=com_hoso&view=khenthuongkyluat&format=raw&task=getSothangNangluong';
		$.get(url, { id_hinhthuc_kyluat : $(this).val(), idHoso : $('#emp_id_kl').val()}, function(data){
			if(data == '-1'){
				$('.div_kyluat_sothang').hide();
				$('#months_kl').val('');
			}else{
				$('.div_kyluat_sothang').show();
				$('#months_kl').val(parseInt(data));
			}
		});
	});

	/********************** Quá trình bình bầu danh hiệu ************************/
	$('body').delegate('#btn_add_binhbau', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình bình bầu danh hiệu');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_binhbau">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=khenthuongkyluat&format=raw&task=add_binhbau&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_binhbau', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình bình bầu danh hiệu');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_binhbau">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=khenthuongkyluat&format=raw&task=edit_binhbau&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_binhbau', 'click', function(){
		$.blockUI();
		if($('#BinhbauFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveBinhbau';
			$.post(url, $('#BinhbauFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhbinhbau').load('index.php?option=com_hoso&view=khenthuongkyluat&format=raw&task=quatrinhbinhbau&idHoso='+$('#idHoso').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});
	$('body').delegate('#quality_fk', 'change', function(){
		var quality_fk = $(this).val();
		$.ajax({
			type: 'POST',
			url: 'index.php?option=com_hoso&view=khenthuongkyluat&format=raw',
			data: { quality_fk : quality_fk,task:'getKetquaBinhbau' },
			success:function(data){
				var str = '<option value=""></option>';
				if(data !== undefined && data.length > 0 && data !== null ){
					$.each(data, function(i,v){
						str+= '<option value="' + v.id + '">' + v.name + '</option>';
					});
				}
				$('#level_fk').html(str);
			}
		});
	});

	/********************** Quá trình bảo hiểm xã hội ************************/
	$('body').delegate('#btn_add_bhxh', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình bảo hiểm xã hội');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_bhxh">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=baohiem&format=raw&task=add_bhxh&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_bhxh', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình bảo hiểm xã hội');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_bhxh">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=baohiem&format=raw&task=edit_bhxh&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_bhxh', 'click', function(){
		$.blockUI();
		if($('#BaohiemxahoiFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveBaohiemxahoi';
			$.post(url, $('#BaohiemxahoiFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-baohiemxahoi').load('index.php?option=com_hoso&view=baohiem&format=raw&task=quatrinhbaohiemxahoi&idHoso='+$('#idHoso').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});

	/********************** Quá trình quan hệ gia đình (bản thân) ************************/
	$('body').delegate('#btn_add_banthan', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quan hệ gia đình');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_banthan">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=nhanthan&format=raw&task=add_banthan&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_banthan', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quan hệ gia đình');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_banthan">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=nhanthan&format=raw&task=edit_banthan&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_banthan', 'click', function(){
		$.blockUI();
		if($('#BanthanFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveBanthan';
			$.post(url, $('#BanthanFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quanhebanthan').load('index.php?option=com_hoso&view=nhanthan&format=raw&task=banthan&idHoso='+$('#idHoso').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});

	/********************** Quá trình quan hệ gia đình (thân tộc) ************************/
	$('body').delegate('#btn_add_thantoc', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quan hệ gia đình');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_thantoc">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=nhanthan&format=raw&task=add_thantoc&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_thantoc', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quan hệ gia đình');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_thantoc">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=nhanthan&format=raw&task=edit_thantoc&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_thantoc', 'click', function(){
		$.blockUI();
		if($('#ThantocFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveThantoc';
			$.post(url, $('#ThantocFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quanhethantoc').load('index.php?option=com_hoso&view=nhanthan&format=raw&task=thantoc&idHoso='+$('#idHoso').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});

	/********************** Quá trình quan hệ gia đình (vợ chồng) ************************/
	$('body').delegate('#btn_add_vochong', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quan hệ gia đình');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_vochong">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=nhanthan&format=raw&task=add_vochong&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_vochong', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quan hệ gia đình');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_vochong">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=nhanthan&format=raw&task=edit_vochong&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_vochong', 'click', function(){
		$.blockUI();
		if($('#VochongFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveVochong';
			$.post(url, $('#VochongFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quanhevochong').load('index.php?option=com_hoso&view=nhanthan&format=raw&task=vochong&idHoso='+$('#idHoso').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});

	/********************** Quá trình công tác Đảng ************************/
	$('body').delegate('#btn_add_ctd', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình công tác Đảng');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_ctd">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=congtac&format=raw&task=add_ctd&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_ctd', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình công tác Đảng');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_ctd">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=congtac&format=raw&task=edit_ctd&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_ctd', 'click', function(){
		$.blockUI();
		if($('#CongtacDangFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveCongtacDang';
			$.post(url, $('#CongtacDangFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhdang').load('index.php?option=com_hoso&view=congtac&format=raw&task=quatrinhdang&idHoso='+$('#idHoso').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});

	/********************** Quá trình công tác Đoàn ************************/
	$('body').delegate('#btn_add_ctdoan', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình công tác Đoàn');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_ctdoan">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=congtac&format=raw&task=add_ctdoan&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_ctdoan', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình công tác Đoàn');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_ctdoan">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=congtac&format=raw&task=edit_ctdoan&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_ctdoan', 'click', function(){
		$.blockUI();
		if($('#CongtacDoanFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveCongtacDoan';
			$.post(url, $('#CongtacDoanFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhdoan').load('index.php?option=com_hoso&view=congtac&format=raw&task=quatrinhdoan&idHoso='+$('#idHoso').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});

	/********************** Quá trình tham gia đoàn thể khác ************************/
	$('body').delegate('#btn_add_doanthekhac', 'click', function(){
		$.blockUI();
		$('#title_quatrinh').html('Thêm mới quá trình tham gia đoàn thể khác');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_doanthekhac">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=congtac&format=raw&task=add_doanthekhac&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_doanthekhac', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#title_quatrinh').html('Điều chỉnh quá trình tham gia đoàn thể khác');
		$('#button_quatrinh').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_doanthekhac">Lưu</button>');
		$('#noidung_quatrinh').load('index.php?option=com_hoso&view=congtac&format=raw&task=edit_doanthekhac&id_quatrinh='+id_quatrinh+'&idHoso='+$('#idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_save_doanthekhac', 'click', function(){
		$.blockUI();
		if($('#DoanthekhacFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_hoso&controller=hoso&task=saveDoanthekhac';
			$.post(url, $('#DoanthekhacFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modalQuatrinh').modal('hide');
					$('#noidung_quatrinh').html('');
					$('#div-quatrinhdoanthekhac').load('index.php?option=com_hoso&view=congtac&format=raw&task=qtdoanthekhac&idHoso='+$('#idHoso').val());
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				}
				$.unblockUI();
			});
		}
	});
});