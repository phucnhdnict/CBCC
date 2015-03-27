var nl2br = function (str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
};
var showDexuat = function(){
	jQuery(".select-dexuat").each(function(i){
		if(jQuery(this).val()!= '0'){
			jQuery(".tr-dexuat"+i).show();
		}else{
			jQuery(".tr-dexuat"+i).hide();
			jQuery("textarea[name='dexuat[" + i + "]']").val('');
		}
	});
};
var checkDexuat = function(){
	var str = '';
	jQuery(".select-dexuat").each(function(i){
		if(jQuery(this).val() != 0 && jQuery("textarea[name='dexuat[" + i + "]']").val() == ""){
			jQuery("textarea[name='dexuat[" + i + "]']").addClass('error');
			str += 'Vui lòng nhập chứng minh đề xuất tại mục ';
			str += jQuery("textarea[name='dexuat[" + i + "]']").attr("belongto") + '<br/>';
		}else{
			jQuery("textarea[name='dexuat[" + i + "]']").removeClass('error');
		}
	});
	if(str != ''){
		loadNoticeBoard('Thông báo lỗi',str);
		return false;
	}
};
var checkDiemchinh = function(){
	var str = '';
	jQuery(".select-diemchinh").each(function(){
		if(jQuery(this).val() == 0){
			jQuery(this).attr("style","font-size:15px;border-color:red;border-style:solid;");
			str += 'Vui lòng cho điểm các tiêu chí chính tại mục ';
			str += jQuery(this).attr("belongto") + '<br/>';
		}else{
			jQuery(this).removeAttr("style");
		}
	});
	if(str != ''){
		loadNoticeBoard('Thông báo lỗi',str);
		return false;
	}
};
var check_diemthuong = function(){
	var flag = true;
	jQuery("select[name='diemthuong_hoanthanh[]']").each(function(){
		if(jQuery(this).val() == '' || jQuery(this).val() == null){
			jQuery(this).attr("style","width:60px;font-size:15px;border-color:red;border-style:solid;");
			flag = flag && false;
		}else{
			jQuery(this).attr("style","width:60px;");
		}
	});
	return flag;
};
var diemthuong_hoanthanh = function(){
	var diemthuonghoanthanh = 0;
	var diemmax = parseFloat(jQuery('input[name="float_diemcong[]"]').val());
	jQuery("select[name='diemthuong_hoanthanh[]']").each(function(){
		var value = jQuery(this).val();
		if (value.length > 0) {
			diemthuonghoanthanh += parseFloat(value);
		}
	});
	var tongdiemthuong = 0;
	if(jQuery(".select-dexuat").eq(0).val() == ''){
		diemthuong = 0;
	}else{
		diemthuong = parseFloat(jQuery(".select-dexuat").eq(0).val());
	}
	
	if(jQuery(".select-dexuat").eq(1).val() == ''){
		diemtru = 0;
	}else{
		diemtru = parseFloat(jQuery(".select-dexuat").eq(1).val());
	}
	
	tongdiemthuong = diemthuonghoanthanh + diemthuong + diemtru;
	if(tongdiemthuong > diemmax){
		diemthuonghoanthanh = diemmax - (diemthuong + diemtru);
	}
	jQuery("#diemthuong_congviechoanthanh").val(diemthuonghoanthanh);
	tinhFloatBar();
	tinhTongdiem();
};
var check_thoigian = function(){
	if(jQuery("#thaydoithoigian").is(":checked")){
		if(jQuery("#thoigian").val() == "" || jQuery("textarea[name='noidungthoigian']").val() == ""){
			return false;
		}
	}else{
		return true;
	}
};
var check_ngoaigio = function(){
	var ngay_thuchien = jQuery("input[name='ngay_thuchien[]']");
	var gio_thuchien = jQuery("input[name='gio_thuchien[]']");
	var ngay_ngoaigio = jQuery("input[name='ngay_ngoaigio[]']");
	var gio_ngoaigio = jQuery("input[name='gio_ngoaigio[]']");
	ngay_ngoaigio.each(function(i){
		var tonggio = ngay_thuchien.eq(i).val() * 8 + gio_thuchien.eq(i).val()*1;
		var tonggio_ngoaigio = ngay_ngoaigio.eq(i).val() * 8 + gio_ngoaigio.eq(i).val()*1;
		if(tonggio_ngoaigio > tonggio){
			loadNoticeBoard('Thông báo lỗi','Thời gian làm ngoài giờ phải nhỏ hơn thời gian thực hiện. Đề nghị điều chỉnh!');
			jQuery(this).val('');
			return false;
		}
	});
};
var check_ngoaigiokhac = function(){
	var ngaykhac = jQuery("input[name='ngaykhac[]']");
	var giokhac = jQuery("input[name='giokhac[]']");
	var ngaykhac_ngoaigio = jQuery("input[name='ngaykhac_ngoaigio[]']");
	var giokhac_ngoaigio = jQuery("input[name='giokhac_ngoaigio[]']");
	ngaykhac_ngoaigio.each(function(i){
		var tonggiokhac = ngaykhac.eq(i).val() * 8 + giokhac.eq(i).val()*1;
		var tonggiokhac_ngoaigio = ngaykhac_ngoaigio.eq(i).val() * 8 + giokhac_ngoaigio.eq(i).val()*1;
		if(tonggiokhac_ngoaigio > tonggiokhac){
			loadNoticeBoard('Thông báo lỗi','Thời gian làm ngoài giờ phải nhỏ hơn thời gian thực hiện. Đề nghị điều chỉnh!');
			jQuery(this).val('');
			return false;
		}
	});
};
var check_saipham = function(){
	var flag = true;
	jQuery("select[name='solansaipham[]']").each(function(i){
		if(jQuery(this).val() != '0' && jQuery("select.diemtru").eq(i).val() == '0'){
			flag = flag && false;
		}
	});
	return flag;
};
var tinhphantramthoigian = function(){
	var tongthoigian = 0;
	var diemphantramthoigian = 0;
	jQuery("input[name='ngay_thuchien[]']").each(function(i){
		tongthoigian += jQuery(this).val() * 8;
	});
	jQuery("input[name='gio_thuchien[]']").each(function(i){
		tongthoigian += jQuery(this).val()*1;
	});
	jQuery("input[name='ngaykhac[]']").each(function(i){
		tongthoigian += jQuery(this).val() * 8;
	});
	jQuery("input[name='giokhac[]']").each(function(i){
		tongthoigian += jQuery(this).val()*1;
	});
	var phantramthoigian = parseFloat(tongthoigian*100/jQuery('#thoigiandot').val());
	diemphantramthoigian = parseFloat(phantramthoigian*jQuery('#label-diemphantramthoigian').data('diem_max')/100);
	if(phantramthoigian >= 100){
		diemphantramthoigian = parseFloat(jQuery('#label-diemphantramthoigian').data('diem_max'));
	}
	jQuery("#label-phantramthoigian").text(phantramthoigian.toFixed(2));
	jQuery("#label-diemphantramthoigian").text(diemphantramthoigian.toFixed(1));
	jQuery("#diemthaydoi").val(diemphantramthoigian.toFixed(1));
	showVuotthoigian();
	tinhFloatBar();
	tinhTongdiem();
};
var thaydoidiem = function(){
	var diemthaydoi = parseFloat(jQuery("#thoigian").val()*jQuery('input[name="float_diemchinh[]"]').eq(1).val()/100);
	if(jQuery("#thoigian").val() >= 100){
		jQuery("#diemthaydoi").val(jQuery('input[name="float_diemchinh[]"]').eq(1).val());
	}else{
		jQuery("#diemthaydoi").val(diemthaydoi.toFixed(1));
	}
	showVuotthoigian();
	tinhFloatBar();
	tinhTongdiem();
};
var showthoigian = function(){
	if(!jQuery("#thaydoithoigian").is(":checked")){
		jQuery("#thoigian").val(jQuery('#phantramthoigian').val());
		tinhphantramthoigian();
		jQuery(".showtg").hide();
	}else{
		jQuery("#thoigian").val(jQuery('#phantramthoigian').val());
		thaydoidiem();
		jQuery(".showtg").show();
	}
};
var showVuotthoigian = function(){
	if(!jQuery("#thaydoithoigian").is(":checked")){
		if(parseFloat(jQuery("#label-phantramthoigian").text()) >= 110){
			jQuery("#td_vuotthoigian").html('<strong class="">'+jQuery('#diem_vuotthoigian').data('diem_max')+'</strong>');
			jQuery("#diem_vuotthoigian").val(jQuery('#diem_vuotthoigian').data('diem_max'));
		}else{
			jQuery("#td_vuotthoigian").html('<strong class="">0.0</strong>');
			jQuery("#diem_vuotthoigian").val('0');
		}
	}else{
		if(parseFloat(jQuery("#thoigian").val()) >= 110){
			jQuery("#td_vuotthoigian").html('<strong class="">'+jQuery('#diem_vuotthoigian').data('diem_max')+'</strong>');
			jQuery("#diem_vuotthoigian").val(jQuery('#diem_vuotthoigian').data('diem_max'));
		}else{
			jQuery("#td_vuotthoigian").html('<strong class="">0.0</strong>');
			jQuery("#diem_vuotthoigian").val('0');
		}
	}
};
var showTongthoigian = function(){
	var tongthoigian = 0;
	jQuery("input[name='ngay_thuchien[]']").each(function(i){
		tongthoigian += jQuery(this).val() * 8;
	});
	jQuery("input[name='gio_thuchien[]']").each(function(i){
		tongthoigian += jQuery(this).val()*1;
	});
	jQuery("input[name='ngaykhac[]']").each(function(i){
		tongthoigian += jQuery(this).val() * 8;
	});
	jQuery("input[name='giokhac[]']").each(function(i){
		tongthoigian += jQuery(this).val()*1;
	});
	
	jQuery("#label-tongngay").text(parseInt(tongthoigian/8));
	jQuery("#label-tonggio").text(parseInt(tongthoigian%8));
	var songaythuchien = parseFloat(tongthoigian/8);
	jQuery("#td_floatbar_thoigian").html(songaythuchien.toFixed(2) + ' ngày / ' + (jQuery('#thoigiandot').val()/8).toFixed(2) + ' ngày.');

	var tongthoigian_ngoaigio = 0;
	jQuery("input[name='ngay_ngoaigio[]']").each(function(i){
		tongthoigian_ngoaigio += jQuery(this).val() * 8;
	});
	jQuery("input[name='gio_ngoaigio[]']").each(function(i){
		tongthoigian_ngoaigio += jQuery(this).val()*1;
	});
	jQuery("input[name='ngaykhac_ngoaigio[]']").each(function(i){
		tongthoigian_ngoaigio += jQuery(this).val() * 8;
	});
	jQuery("input[name='giokhac_ngoaigio[]']").each(function(i){
		tongthoigian_ngoaigio += jQuery(this).val()*1;
	});
	jQuery("#label-ngayngoaigio").text(parseInt(tongthoigian_ngoaigio/8));
	jQuery("#label-giongoaigio").text(parseInt(tongthoigian_ngoaigio%8));

	tongthoigian_quydinh = tongthoigian - tongthoigian_ngoaigio;
	jQuery("#label-ngayquydinh").text(parseInt(tongthoigian_quydinh/8));
	jQuery("#label-gioquydinh").text(parseInt(tongthoigian_quydinh%8));

	if(tongthoigian_quydinh > jQuery('#thoigiandot').val()){
		jQuery("#div-thoigianquydinh").html('Thời gian sử dụng để làm việc trong giờ hành chính lớn hơn số ngày làm việc theo quy định trong tháng (' + (jQuery('#thoigiandot').val()/8).toFixed(2) + ' ngày). Đề nghị điều chỉnh!');
	}else{
		jQuery("#div-thoigianquydinh").html('');
	}
};
var tinhdiemhieuqua = function(){
	var heso_chung = jQuery('#heso_chung').val();
	var heso_chatluong_chung = jQuery('#heso_chatluong_chung').val();
	var heso_hieuqua_chung = jQuery('#heso_hieuqua_chung').val();
	//tinh diem cong viec da hoan thanh
	if((jQuery('#template_type').val() == 'thammuu' || jQuery('#template_type').val() == 'truongphong') && jQuery('#danhgia_type').val() == 'tudanhgia'){
		var diem_chatluongcongviec = 0;
		var diem_hieuquacongviec = 0;
		var chatluongcongviec = jQuery("input[name='chatluongcongviec[]']");
		var hieuquacongviec = jQuery("input[name='hieuquacongviec[]']");
		if(chatluongcongviec.length > 0){
			chatluongcongviec.each(function(i){
				if(chatluongcongviec.eq(i).val() != ''){
					diem_chatluongcongviec += parseFloat(chatluongcongviec.eq(i).val());
				}
				if(hieuquacongviec.eq(i).val() != ''){
					diem_hieuquacongviec += parseFloat(hieuquacongviec.eq(i).val());
				}
			});
			if(diem_chatluongcongviec/chatluongcongviec.length > heso_chung){
				phantramchatluong = heso_chung;
			}else{
				phantramchatluong = diem_chatluongcongviec/chatluongcongviec.length;
			}
			if(diem_hieuquacongviec/chatluongcongviec.length > heso_chung){
				phantramhieuqua = heso_chung;
			}else{
				phantramhieuqua = diem_hieuquacongviec/chatluongcongviec.length;
			}
			diemhoanthanh = phantramchatluong*heso_chatluong_chung + phantramhieuqua*heso_hieuqua_chung;
		}else{
			diemhoanthanh = 0;
		}
		//Tinh diem cong viec chua hoan thanh
		var tongchuahoanthanh = 0;
		var heso_lydochuahoanthanh = jQuery("select[name='id_lydo_congviec_fail[]']");
		var tiendo_fail = jQuery("input[name='tiendo_fail[]']");
		if(tiendo_fail.length > 0){
			heso_lydochuahoanthanh.each(function(i){
				tongchuahoanthanh += heso_lydochuahoanthanh.eq(i).find("option:selected").data("heso") * (100 - parseFloat(tiendo_fail.eq(i).val()));
			});
			if(tongchuahoanthanh > 0){
				phantramchuahoanthanh = tongchuahoanthanh/(chatluongcongviec.length + tiendo_fail.length);
				jQuery('input[name="xeploai_min[]"]').each(function(){
					var row_index = jQuery('input[name="xeploai_min[]"]').index(jQuery(this));
					if(phantramchuahoanthanh == 100){
						diemchuahoanthanh = 7;
					}else if(jQuery('input[name="xeploai_min[]"]').eq(row_index).val() <= phantramchuahoanthanh && phantramchuahoanthanh < jQuery('input[name="xeploai_max[]"]').eq(row_index).val()){
						diemchuahoanthanh = parseFloat(jQuery('input[name="xeploai_diemtru[]"]').eq(row_index).val());
						return;
					}
				});
			}else{
				diemchuahoanthanh = 0;
			}
		}else{
			diemchuahoanthanh = 0;
		}
	}else{
		var chatluongcongviec = 0;
		var hieuquacongviec = 0;
		var heso_mucdophuctap = jQuery("input[name='id_mucdophuctap_xeploai[]']");
		var heso_chatluong = jQuery("select[name='id_chatluong_xeploai[]']");
		var heso_tiendo = jQuery("select[name='id_tiendo_xeploai[]']");
		if(heso_mucdophuctap.length > 0 ){
			heso_mucdophuctap.each(function(i){
				if(heso_mucdophuctap.eq(i).attr("heso") != '' && heso_chatluong.eq(i).find("option:selected").attr("heso") != ''){
					chatluongcongviec += heso_mucdophuctap.eq(i).attr("heso") * heso_chatluong.eq(i).find("option:selected").attr("heso");
				}
				if(heso_mucdophuctap.eq(i).attr("heso") != '' && heso_tiendo.eq(i).find("option:selected").attr("heso") != ''){
					hieuquacongviec += heso_mucdophuctap.eq(i).attr("heso") * heso_tiendo.eq(i).find("option:selected").attr("heso");
				}
			});
			if(chatluongcongviec/heso_mucdophuctap.length > heso_chung){
				phantramchatluong = heso_chung;
			}else{
				phantramchatluong = chatluongcongviec/heso_mucdophuctap.length;
			}
			if(hieuquacongviec/heso_mucdophuctap.length > heso_chung){
				phantramhieuqua = heso_chung;
			}else{
				phantramhieuqua = hieuquacongviec/heso_mucdophuctap.length;
			}
			diemhoanthanh = phantramchatluong*heso_chatluong_chung + phantramhieuqua*heso_hieuqua_chung;
		}else{
			diemhoanthanh = 0;
		}
		//Tinh diem cong viec chua hoan thanh
		var tongchuahoanthanh = 0;
		var heso_lydochuahoanthanh = jQuery("select[name='id_lydo_congviec_fail[]']");
		var tiendo_fail = jQuery("input[name='tiendo_fail[]']");
		if(tiendo_fail.length > 0){
			heso_lydochuahoanthanh.each(function(i){
				tongchuahoanthanh += heso_lydochuahoanthanh.eq(i).find("option:selected").data("heso") * (100 - parseFloat(tiendo_fail.eq(i).val()));
			});
			if(tongchuahoanthanh > 0){
				phantramchuahoanthanh = tongchuahoanthanh/(heso_mucdophuctap.length + tiendo_fail.length);
				jQuery('input[name="xeploai_min[]"]').each(function(){
					var row_index = jQuery('input[name="xeploai_min[]"]').index(jQuery(this));
					if(phantramchuahoanthanh == 100){
						diemchuahoanthanh = 7;
					}else if(jQuery('input[name="xeploai_min[]"]').eq(row_index).val() <= phantramchuahoanthanh && phantramchuahoanthanh < jQuery('input[name="xeploai_max[]"]').eq(row_index).val()){
						diemchuahoanthanh = parseFloat(jQuery('input[name="xeploai_diemtru[]"]').eq(row_index).val());
						return;
					}
				});
//				console.log(diemchuahoanthanh);
			}else{
				diemchuahoanthanh = 0;
			}
		}else{
			diemchuahoanthanh = 0;
		}
	}
// 	console.log(diemhoanthanh);
	
	jQuery("#diemhoanthanh").val(diemhoanthanh.toFixed(1));
	jQuery("#diemchuahoanthanh").val(-diemchuahoanthanh);
	tinhFloatBar();
	tinhTongdiem();
};
var tinhFloatBar = function(){
	var heso = jQuery('#heso_danhgia').val();
	var loaicongviec = jQuery('#ids_loaicongviec').val().split(',');
	var j = 0;
	for(i = 0; i < loaicongviec.length; i++){
		if(loaicongviec[i] == 1){
			var diemchinh = parseFloat(jQuery("#diemhoanthanh").val()) + parseFloat(jQuery("#diemchuahoanthanh").val());
			if(jQuery('#danhgia_type').val() == 'tudanhgia'){
				var diemthuong = parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
			}else{
				var diemthuong = parseFloat(jQuery("#diemthuong_congviechoanthanh").val()) + parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
			}
			var diemtru = parseFloat(jQuery("select[name='diems[]']").eq(j).val());
			j++;
			if(jQuery('#template_type').val() == 'congchuc'){
				diemtru+= parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
				diemtru+= parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
				diemtru+= parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
			}
			jQuery("#td_floatbar_muc_a1").html('<font style="color:red;">' + parseFloat(diemchinh.toFixed(1)) + '/'+jQuery('input[name="float_diemchinh[]"]').eq(i).val()+'</font>');
			jQuery("#td_floatbar_muc_a1_thuong").html('<font style="color:red;">' + parseFloat(diemthuong.toFixed(1)) + '/'+jQuery('input[name="float_diemcong[]"]').eq(i).val()+'</font>');
			jQuery("#td_floatbar_muc_a1_tru").html('<font style="color:red;">' + parseFloat(-diemtru.toFixed(1)) + '/'+parseFloat(-jQuery('input[name="float_diemtru[]"]').eq(i).val())+'</font>');
		}else if(loaicongviec[i] == 3){
			if(jQuery('#template_type').val() == 'thammuu' || jQuery('#template_type').val() == 'truongphong' || jQuery('#template_type').val() == 'congchuc'){
				var diemchinh = parseFloat(jQuery("#diemthaydoi").val());
				if(jQuery('#template_type').val() == 'congchuc'){
					if(jQuery('#id_dotdanhgia').val() < 61){
						var diemthuong = parseFloat(jQuery("select[name='diems[]']").eq(j).val());
						j++;
					}else{
						var diemthuong = parseFloat(jQuery("select[name='diems[]']").eq(j).val());
						j++;
						diemthuong += parseFloat(jQuery("select[name='diems[]']").eq(j).val());
						j++;
					}
				}else{
					var diemthuong = parseFloat(jQuery("select[name='diems[]']").eq(j).val()) + parseFloat(jQuery("#diem_vuotthoigian").val());
					j++;
				}
			}else{
				var diemchinh = parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
				var diemthuong = parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
				diemthuong += parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
			}
			jQuery("#td_floatbar_muc_a2").html('<font style="color:red;">' + parseFloat(diemchinh.toFixed(1)) + '/'+jQuery('input[name="float_diemchinh[]"]').eq(i).val()+'</font>');
			jQuery("#td_floatbar_muc_a2_thuong").html('<font style="color:red;">' + parseFloat(diemthuong.toFixed(1)) + '/'+jQuery('input[name="float_diemcong[]"]').eq(i).val()+'</font>');
		}else if(loaicongviec[i] == 7){
			var diemchinh = parseFloat(jQuery("select[name='diems[]']").eq(j).val());
			j++;
			if(heso > 1){
				var diemthuong = parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
				diemthuong += parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
			}
			jQuery("#td_floatbar_muc_a3").html('<font style="color:red;">' + parseFloat(diemchinh.toFixed(1)) + '/'+jQuery('input[name="float_diemchinh[]"]').eq(i).val()+'</font>');
			if(heso > 1){
				jQuery("#td_floatbar_muc_a3_thuong").html('<font style="color:red;">' + parseFloat(diemthuong.toFixed(1)) + '/'+jQuery('input[name="float_diemcong[]"]').eq(i).val()+'</font>');
			}else{
				jQuery("#td_floatbar_muc_a3_thuong").html('<font style="color:red;">0/0</font>');
			}
		}else if(loaicongviec[i] == 4){
			var diemchinh = parseFloat(jQuery("select[name='diems[]']").eq(j).val());
			j++;
			if(heso > 1){
				var diemthuong = parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
				diemthuong += parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
			}
			jQuery("#td_floatbar_muc_b").html('<font style="color:red;">' + parseFloat(diemchinh.toFixed(1)) + '/'+jQuery('input[name="float_diemchinh[]"]').eq(i).val()+'</font>');
			if(heso > 1){
				jQuery("#td_floatbar_muc_b_thuong").html('<font style="color:red;">' + parseFloat(diemthuong.toFixed(1)) + '/'+jQuery('input[name="float_diemcong[]"]').eq(i).val()+'</font>');
			}else{
				jQuery("#td_floatbar_muc_b_thuong").html('<font style="color:red;">0/0</font>');
			}
		}else if(loaicongviec[i] == 5){
			var diemchinh = parseFloat(jQuery("select[name='diems[]']").eq(j).val());
			j++;
			if(heso > 1){
				var diemthuong = parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
				diemthuong += parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
				diemthuong += parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
				diemthuong += parseFloat(jQuery("select[name='diems[]']").eq(j).val());
				j++;
			}
			jQuery("#td_floatbar_muc_c").html('<font style="color:red;">' + parseFloat(diemchinh.toFixed(1)) + '/'+jQuery('input[name="float_diemchinh[]"]').eq(i).val()+'</font>');
			if(heso > 1){
				jQuery("#td_floatbar_muc_c_thuong").html('<font style="color:red;">' + parseFloat(diemthuong.toFixed(1)) + '/'+jQuery('input[name="float_diemcong[]"]').eq(i).val()+'</font>');
			}else{
				jQuery("#td_floatbar_muc_c_thuong").html('<font style="color:red;">0/0</font>');
			}
		}
	}
};
var tinhTongdiem = function(){
	var tongdiem = 0;
	jQuery("input[name='diems[]']").each(function(){
		tongdiem += parseFloat(jQuery(this).val());
	});
	var tongdiemchinh = 0;
	var tongdiemcong = 0;
	jQuery('input[name="float_diemchinh[]"]').each(function(i,v){
		tongdiemchinh += parseFloat(jQuery(this).val());
		tongdiemcong += parseFloat(jQuery('input[name="float_diemcong[]"]').eq(i).val());
	});
	if(jQuery('#danhgia_type').val() == 'tudanhgia'){
		jQuery("select[name='diems[]']").each(function(){
			if(!jQuery(this).hasClass('select-dexuat')){
				tongdiem += parseFloat(jQuery(this).val());
			}
		});
		if(jQuery("#diem_vuotthoigian").val() != undefined){
			tongdiem -= parseFloat(jQuery("#diem_vuotthoigian").val());
		}
		jQuery("#td_floatbar_tongdiem").html('<font style="color:red;font-size:15px;">' + tongdiem.toFixed(1) + ' / ' + tongdiemchinh + '</font>');
	}else{
		jQuery("select[name='diems[]']").each(function(){
			tongdiem += parseFloat(jQuery(this).val());
		});
		var heso = jQuery('#heso_danhgia').val();
		if(heso > 1){
			jQuery("#td_floatbar_tongdiem").html('<font style="color:red;font-size:15px;">' + tongdiem.toFixed(1) + ' / ' + parseFloat(tongdiemchinh+tongdiemcong) + '</font>');
		}else{
			jQuery("#td_floatbar_tongdiem").html('<font style="color:red;font-size:15px;">' + tongdiem.toFixed(1) + ' / ' + tongdiemchinh + '</font>');
		}
	}
};
var checkCongViec_HoanThanh = function(){
	var elTencongviec = jQuery("input[name='tencongviec[]']");
	var elMota = jQuery("textarea[name='mota[]']");
	var elLoaicongviec = jQuery("select[name='is_nhomcongviec[]']");
	var elMucdothamgia = jQuery("select[name='id_mucdothamgia[]']");
	var elCongviecxeploai = jQuery(".cbo-xeploai-congviec");
	var elChatluong = jQuery("select[name='id_chatluong_xeploai[]']");
	var elTiendo = jQuery("select[name='id_tiendo_xeploai[]']");
	
	if(jQuery('#template_type').val() == 'congchuc'){
		var elDieukienlamviec = jQuery(".cbo-dieukienlamviec");
	}
	if(jQuery('#template_type').val() == 'thammuu' || jQuery('#template_type').val() == 'truongphong' || jQuery('#template_type').val() == 'congchuc'){
		var elNgay_thuchien = jQuery("input[name='ngay_thuchien[]']");
		var elGio_thuchien = jQuery("input[name='gio_thuchien[]']");
	}
	
	var lengthEl = elTencongviec.length;
	var flag = true;
	for(var i=0;i<lengthEl;i++){
		flag = flag && ((elTencongviec.eq(i).val()=='')?false:true);
		flag = flag && ((elMota.eq(i).val()=='')?false:true);
		flag = flag && ((elLoaicongviec.eq(i).val()=='')?false:true);
		flag = flag && ((elMucdothamgia.eq(i).val()=='')?false:true);
		flag = flag && ((elCongviecxeploai.eq(i).val()=='')?false:true);
		flag = flag && ((elChatluong.eq(i).val()=='')?false:true);
		flag = flag && ((elTiendo.eq(i).val()=='')?false:true);

		if(jQuery('#template_type').val() == 'congchuc'){
			flag = flag && ((elDieukienlamviec.eq(i).val()=='')?false:true);
		}
		if(jQuery('#template_type').val() == 'thammuu' || jQuery('#template_type').val() == 'truongphong' || jQuery('#template_type').val() == 'congchuc'){
			flag = flag && (((elNgay_thuchien.eq(i).val()*8 + elGio_thuchien.eq(i).val()*1) == 0)?false:true);
		}
		
		if(elTencongviec.eq(i).val() == ''){
			elTencongviec.eq(i).addClass('error');
		}
		if(elMota.eq(i).val() == ''){
			elMota.eq(i).addClass('error');
		}
		if(elLoaicongviec.eq(i).val() == ''){
			elLoaicongviec.eq(i).addClass('error');
		}
		if(elMucdothamgia.eq(i).val() == ''){
			elMucdothamgia.eq(i).addClass('error');
		}
		if(elCongviecxeploai.eq(i).val() == ''){
			elCongviecxeploai.eq(i).addClass('error');
		}
		if(elChatluong.eq(i).val() == ''){
			elChatluong.eq(i).addClass('error');
		}
		if(elTiendo.eq(i).val() == ''){
			elTiendo.eq(i).addClass('error');
		}
		
		if(jQuery('#template_type').val() == 'congchuc'){
			if(elDieukienlamviec.eq(i).val() == ''){
				elDieukienlamviec.eq(i).addClass('error');
			}
		}
		if(jQuery('#template_type').val() == 'thammuu' || jQuery('#template_type').val() == 'truongphong' || jQuery('#template_type').val() == 'congchuc'){
			if((elNgay_thuchien.eq(i).val()*8 + elGio_thuchien.eq(i).val()*1) == 0){
				elNgay_thuchien.eq(i).addClass('error');
				elGio_thuchien.eq(i).addClass('error');
			}else{
				if(elNgay_thuchien.eq(i).val() == ''){
					elNgay_thuchien.eq(i).addClass('error');
				}
				if(elGio_thuchien.eq(i).val() == ''){
					elGio_thuchien.eq(i).addClass('error');
				}
			}
		}
    }
    return flag;
};
var checkCongViec_ChuaHoanThanh = function(){
	var elTencongviec_fail = jQuery("textarea[name='tencongviec_fail[]']");
	var elLoainhiemvu_fail = jQuery("select[name='loainhiemvu_fail[]']");
	var elLydo_fail = jQuery("select[name='id_lydo_congviec_fail[]']");
	var elTiendo_fail = jQuery("input[name='tiendo_fail[]']");
	var lengthEl = elTencongviec_fail.length;
	var flag = true;
	for(var i=0;i<lengthEl;i++){
		flag = flag && ((elTencongviec_fail.eq(i).val()=='')?false:true);
		flag = flag && ((elLoainhiemvu_fail.eq(i).val()=='')?false:true);
		flag = flag && ((elLydo_fail.eq(i).val()=='')?false:true);
		flag = flag && ((elTiendo_fail.eq(i).val()=='')?false:true);
		if(elTencongviec_fail.eq(i).val() == ''){
			elTencongviec_fail.eq(i).addClass('error');
		}
		if(elLoainhiemvu_fail.eq(i).val() == ''){
			elLoainhiemvu_fail.eq(i).addClass('error');
		}
		if(elLydo_fail.eq(i).val() == ''){
			elLydo_fail.eq(i).addClass('error');
		}
		if(elTiendo_fail.eq(i).val() == ''){
			elTiendo_fail.eq(i).addClass('error');
		}
    }
    return flag;
};
jQuery(document).ready(function($){
	$('body').delegate('#thoigian', 'keyup', function(){
		thaydoidiem();
	});
	$('body').delegate('#thaydoithoigian', 'click', function(){
		showthoigian();
	});
	$('body').delegate('.select-dexuat', 'change', function(){
		if(jQuery('#danhgia_type').val() == 'danhgiakhac'){
			diemthuong_hoanthanh();
		}
		showDexuat();
	});
	$('body').delegate('select[name="diems[]"]', 'change', function(){
		tinhFloatBar();
		tinhTongdiem();
	});
	$('body').delegate("select[name='diemthuong_hoanthanh[]']","change",function(){
		diemthuong_hoanthanh();
	});
	$('body').delegate('.cbo-solansaipham', 'change', function(event){
		var row_index = $('.cbo-solansaipham').index($(this));
		var solansaipham = $('.cbo-solansaipham').eq(row_index).val();
		var diem_max = parseFloat($(this).attr('diem_max'))/5;
		var html = "<option value='0'>-Điểm-</option>";
		if(solansaipham != '0'){
			var min = 0.5 * parseInt(solansaipham);
			var max = diem_max * parseInt(solansaipham);
			for(var j = max; j >= min; j-= 0.5){
				html += "<option value=" + -j + ">" + j + "</option>";
			}
		}
		$('select.diemtru').eq(row_index).html(html);
		showDexuat();
		tinhdiemhieuqua();
	});
	$('body').delegate('select.diemtru', 'change', function(){
		var tongdiemtru = 0;
		var diemtru = parseFloat($('input[name="float_diemtru[]"]').eq(0).val());
		$("select.diemtru").each(function(){
			tongdiemtru += parseFloat(-$(this).val());
		});
		if(tongdiemtru > diemtru){
			$(this).val('0');
			showDexuat();
			tinhFloatBar();
			tinhTongdiem();
			loadNoticeBoard('Thông báo lỗi','Tổng số điểm trừ không được vượt quá ' + diemtru  +'. Đề nghị điều chỉnh!');
            return false;
		}
		tinhFloatBar();
		tinhTongdiem();
	});
	$("body").delegate(".kieungay","keyup",function(){
		val=$.trim($(this).val());
    	if(!isFinite(val)){
    		loadNoticeBoard('Thông báo lỗi','Dữ liệu nhập phải là số nguyên.');
       		$(this).val('');
    	}
    	temp = val.split(',','2');
    	temp1 = val.split('.','2');
    	if(temp.length > 1 || temp1.length > 1){
    		loadNoticeBoard('Thông báo lỗi','Dữ liệu nhập phải là số nguyên.');
       		$(this).val('');
    	}
    	if(jQuery('#template_type').val() == 'thammuu' || jQuery('#template_type').val() == 'truongphong' || jQuery('#template_type').val() == 'congchuc'){
	    	check_ngoaigio();
			check_ngoaigiokhac();
			showTongthoigian();
			tinhphantramthoigian();
    	}
	});
	$("body").delegate(".kieugio","keyup",function(){
		val=$.trim($(this).val());
    	if(!isFinite(val)){
    		loadNoticeBoard('Dữ liệu nhập phải là số và dùng dấu "chấm" để phân biệt thập phân.');
       		$(this).val('');
    	}
    	if(val >= 8){
    		loadNoticeBoard('Dữ liệu nhập không được quá 8.');
       		$(this).val('');
    	}
    	temp=val.split(',','2');
    	if(temp.length>1){
    		loadNoticeBoard('Dữ liệu nhập phải là số và dùng dấu "chấm" để phân biệt thập phân.');
       		$(this).val('');
    	}
    	if(jQuery('#template_type').val() == 'thammuu' || jQuery('#template_type').val() == 'truongphong' || jQuery('#template_type').val() == 'congchuc'){
	    	check_ngoaigio();
			check_ngoaigiokhac();
			showTongthoigian();
			tinhphantramthoigian();
    	}
	});
    $('body').delegate('.kieuso','keyup',function(){
		val=$.trim($(this).val());
    	if(!isFinite(val)){
    		loadNoticeBoard('Thông báo lỗi','Dữ liệu nhập phải là số và dùng dấu "chấm" để phân biệt thập phân.');
       		$(this).val('');
    	}
    	temp = val.split(',','2');
    	if(temp.length > 1){
    		loadNoticeBoard('Thông báo lỗi','Dữ liệu nhập phải là số và dùng dấu "chấm" để phân biệt thập phân.');
       		$(this).val('');
    	}
	});
	$('body').delegate('#btn_add_fail','click',function(){
    	if (checkCongViec_ChuaHoanThanh() == false){
    		loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc chưa hoàn thành.');
            return false;
        }
        var str = '<tr>';
	        str+= '<td width="80%" style="vertical-align:top;">';
	    	str+= '<textarea name="tencongviec_fail[]" class="noidung" style="width:97%;"></textarea>';
	    	str+= '</td>';
	    	str+= '<td class="center" style="vertical-align:middle;">';
	    	str+= '<select name="loainhiemvu_fail[]">';
	    	str+= '<option value=""></option>';
	    	str+= '<option value="chuyenmon">Chuyên môn thường xuyên</option>';
	    	str+= '<option value="dotxuat">Đột xuất, bổ sung</option>';
	    	str+= '</select>';
	    	str+= '</td>';
	    	str+= '<td class="center" style="vertical-align:middle;">';
	    	str+= str_select_lydo_fail;
	    	str+= '</td>';
	    	str+= '<td class="center" style="vertical-align:middle;">';
	    	str+= '<input type="text" style="text-align:right;" class="input-mini" name="tiendo_fail[]" value=""/>';
	    	str+= '</td>';
	    	str+= '<td class="center" style="vertical-align:middle;">';
	    	str+= '<a href="#" class="btn_remove" style="width:20px;">';
	    	str+= '<span class="btn btn-mini btn-danger"><i class="icon-trash"></i></span>';
	    	str+= '</a>';
	    	str+= '</td>';
	    	str+= '</tr>';
	    $('#tbl_fail tbody').append(str);
		$("textarea").autosize();
	    return false;
    });
    $('body').delegate('.btn_remove','click',function(event){
    	event.preventDefault();    
        if(confirm('Bạn có chắc chắn muốn xóa?')){
			var el = $(this);
			el.parentsUntil('tbody').remove();
			if($('#danhgia_type').val() == 'danhgiakhac'){
				diemthuong_hoanthanh();
				if($('#template_type').val() == 'thammuu' || $('#template_type').val() == 'truongphong' || jQuery('#template_type').val() == 'congchuc'){
					showTongthoigian();
					tinhphantramthoigian();
				}
			}
	        tinhdiemhieuqua();
			return false;
        }else{
            return false;
        }
	});
    $('body').delegate("select[name='id_lydo_congviec_fail[]']","change",function(){
		tinhdiemhieuqua();
    });
    $('body').delegate(".cbo-chatluong-congviec,.cbo-tiendo-congviec","change",function(){
    	if(jQuery('#danhgia_type').val() == 'tudanhgia'){
    		tinhdiemhieuqua();
    	}else{
    		var el = $(this);
    		var row_index = 0;
    		row_index = $('.'+$(this).attr('class')).index(el);
        	getDiemThuong(row_index);
    	}
    });
    $('body').delegate(".cbo-mucdothamgia,.cbo-xeploai-congviec","change", function(event){
    	var el = $(this);
		var row_index = 0;
		row_index = $('.'+$(this).attr('class')).index(el);
    	getDiemThuong(row_index);
    });
    var getDiemThuong = function(index){
        var chatluong = $(".cbo-chatluong-congviec").eq(index).val();
        var mucdothamgia = $(".cbo-mucdothamgia").eq(index).val();
        var congviecxeploai = $(".cbo-xeploai-congviec").eq(index).val();
        var tiendo = $(".cbo-tiendo-congviec").eq(index).val();
        if($('#template_type').val() != 'congchuc'){
	        $.ajax({
	        	type: "POST",
	        	url: "index.php?option=com_danhgia&controller=danhgiakhac&task=getdiemthuong&format=raw",
	        	data: { tiendo: tiendo, chatluong: chatluong, congviecxeploai: congviecxeploai, mucdothamgia: mucdothamgia },
	        	success:function(data){
	            		if(data.diemthuong !== undefined && data.diemthuong.length > 0 ){
	                    	var xhtml = '<select name="diemthuong_hoanthanh[]" style="width:60px;">';
	                		xhtml +='<option value=""></option>';
							xhtml +='<option value="0">Không xác nhận thưởng</option>';
	                		$.each(data.diemthuong,function(i,v){
	                			xhtml +='<option value="'+v+'">'+v+'</option>';
	                    	});
	                		xhtml +='</select>';        	
	                    	$('.cbo-congviec-diemthuong').eq(index).html(xhtml);
	                	}else{
	                    	var xhtml = '<input type="hidden" value="0" name="diemthuong_hoanthanh[]" />';
	                    	$('.cbo-congviec-diemthuong').eq(index).html(xhtml);
	                	}
	                	$('input[name="id_mucdophuctap_xeploai[]"]').eq(index).attr('heso',data.heso);
	                	$('input[name="id_mucdophuctap_xeploai[]"]').eq(index).val(data.id_mucdophuctap_xeploai);
						diemthuong_hoanthanh();
						tinhdiemhieuqua();
				}
	        });
        }else{
        	var dieukienlamviec = $(".cbo-dieukienlamviec").eq(index).val();
        	$.ajax({
            	type: "POST",
            	url: "index.php?option=com_danhgia&controller=danhgiakhac&task=getdiemthuong_ccpx&format=raw",
            	data: { tiendo: tiendo, chatluong: chatluong, congviecxeploai: congviecxeploai, dieukienlamviec: dieukienlamviec, mucdothamgia: mucdothamgia },
            	success:function(data){
                		if(data.diemthuong !== undefined && data.diemthuong.length > 0 ){
                        	var xhtml = '<select name="diemthuong_hoanthanh[]" style="width:60px;">';
                    		xhtml +='<option value=""></option>';
    						xhtml +='<option value="0">Không xác nhận thưởng</option>';
                    		$.each(data.diemthuong,function(i,v){
                    			xhtml +='<option value="'+v+'">'+v+'</option>';
                        	});
                    		xhtml +='</select>';        	
                        	$('.cbo-congviec-diemthuong').eq(index).html(xhtml);
                    	}else{
                        	var xhtml = '<input type="hidden" value="0" name="diemthuong_hoanthanh[]" />';
                        	$('.cbo-congviec-diemthuong').eq(index).html(xhtml);
                    	}
                    	$('input[name="id_mucdophuctap_xeploai[]"]').eq(index).attr('heso',data.heso);
                    	$('input[name="id_mucdophuctap_xeploai[]"]').eq(index).val(data.id_mucdophuctap_xeploai);
    					diemthuong_hoanthanh();
    					tinhdiemhieuqua();
    			}
            });
        }
    };
    $('body').delegate('input[name="tiendo_fail[]"]','keyup',function(){
    	val=$.trim($(this).val());
    	if(!isFinite(val)){
    		loadNoticeBoard('Thông báo lỗi','Dữ liệu nhập phải là số và dùng dấu "chấm" để phân biệt thập phân.');
       		$(this).val('');
    	}
    	temp = val.split(',','2');
    	if(temp.length > 1){
    		loadNoticeBoard('Thông báo lỗi','Dữ liệu nhập phải là số và dùng dấu "chấm" để phân biệt thập phân.');
       		$(this).val('');
    	}
    	if($(this).val() >= 100){
			loadNoticeBoard('Thông báo lỗi','Vui lòng nhập số nhỏ hơn 100.');
			$(this).val('');
			$(this).focus();
		}
		tinhdiemhieuqua();
	});
    /* ******************************* Lưu kết quả tự đánh giá ******************************* */
    $('body').delegate('.btn_save_continue', ace.click_event, function(){
    	if($('#danhgia_type').val() == 'tudanhgia'){
    		if($('#template_type').val() == 'thammuu' || $('#template_type').val() == 'truongphong'){
		    	if(checkCongViec_ChuaHoanThanh() == false){
		    		loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc.');
		    		return false;
		    	}
		    	if(check_thoigian() == false){
		    		loadNoticeBoard('Thông báo lỗi','Vui lòng nhập thời gian và lý do thay đổi mức sử dụng thời gian.');
		    		return false;
		        }
		        if(jQuery("#div-thoigianquydinh").html() != ''){
		        	loadNoticeBoard('Thông báo lỗi','Thời gian sử dụng để làm việc trong giờ hành chính lớn hơn số ngày làm việc theo quy định trong tháng. Đề nghị điều chỉnh!');
		            return false;
		        }
		    	if(checkDexuat() == false){
		    		return false;
		    	}
    		}else{
    			if (checkCongViec_HoanThanh() == false){
    				loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc.');
    	            return false;
    	        }
    			if(checkCongViec_ChuaHoanThanh() == false){
    				loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc.');
    	    		return false;
    	    	}
    	    	if(checkDexuat() == false){
    	    		return false;
    	    	}
    	    	if($('#template_type').val() == 'congchuc'){
	    	    	if(check_saipham() == false){
	    	    		loadNoticeBoard('Thông báo lỗi','Bạn chưa cho điểm phần điểm trừ. Vui lòng kiểm tra lại!');
	    	    		return false;
	    	    	}
    	    	}
    		}
    	}else{
    		
    	}
    	tinhdiemhieuqua();
		blockMyUI('Đang lưu dữ liệu...');
		var url = 'index.php?option=com_danhgia&controller=tudanhgia&task=save_tong&id_dotdanhgia='+$('#id_dotdanhgia').val();
		$.post(url,$('#tudanhgiaForm-'+$('#template_type').val()).serialize(),function(data){
			$.unblockUI();
		});
		return false;
    });
    $('body').delegate('.btn_save_back', ace.click_event, function(){
    	if($('#danhgia_type').val() == 'tudanhgia'){
    		if($('#template_type').val() == 'thammuu' || $('#template_type').val() == 'truongphong'){
		    	if(checkCongViec_ChuaHoanThanh() == false){
		    		loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc.');
		    		return false;
		    	}
		    	if(check_thoigian() == false){
		    		loadNoticeBoard('Thông báo lỗi','Vui lòng nhập thời gian và lý do thay đổi mức sử dụng thời gian.');
		    		return false;
		        }
		        if(jQuery("#div-thoigianquydinh").html() != ''){
		        	loadNoticeBoard('Thông báo lỗi','Thời gian sử dụng để làm việc trong giờ hành chính lớn hơn số ngày làm việc theo quy định trong tháng. Đề nghị điều chỉnh!');
		            return false;
		        }
		        if(checkDexuat() == false){
		    		return false;
		    	}
    		}else{
    			if (checkCongViec_HoanThanh() == false){
    				loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc.');
    	            return false;
    	        }
    			if(checkCongViec_ChuaHoanThanh() == false){
    				loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc.');
    	    		return false;
    	    	}
    	    	if(checkDexuat() == false){
    	    		return false;
    	    	}
    	    	if($('#template_type').val() == 'congchuc'){
	    	    	if(check_saipham() == false){
	    	    		loadNoticeBoard('Thông báo lỗi','Bạn chưa cho điểm phần điểm trừ. Vui lòng kiểm tra lại!');
	    	    		return false;
	    	    	}
    	    	}
    		}
    	}else{
    		
    	}
    	tinhdiemhieuqua();
		blockMyUI('Đang lưu dữ liệu...');
		var url = 'index.php?option=com_danhgia&controller=tudanhgia&task=save_tong_back&id_dotdanhgia='+$('#id_dotdanhgia').val();		
		$.post(url,$('#tudanhgiaForm-'+$('#template_type').val()).serialize(),function(data){					
			displayDanhgias();
			$.unblockUI();
		});
		return false;
    });
    $('body').delegate('.btn_save_finished', ace.click_event, function(){
    	if($('#danhgia_type').val() == 'tudanhgia'){
    		if($('#template_type').val() == 'thammuu' || $('#template_type').val() == 'truongphong'){
		    	if(checkCongViec_ChuaHoanThanh() == false){
		    		loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc.');
		    		return false;
		    	}
		    	if(check_thoigian() == false){
		    		loadNoticeBoard('Thông báo lỗi','Vui lòng nhập thời gian và lý do thay đổi mức sử dụng thời gian.');
		    		return false;
		        }
		        if(jQuery("#div-thoigianquydinh").html() != ''){
		        	loadNoticeBoard('Thông báo lỗi','Thời gian sử dụng để làm việc trong giờ hành chính lớn hơn số ngày làm việc theo quy định trong tháng. Đề nghị điều chỉnh!');
		    		return false;
		        }
		    	if(checkDiemchinh() == false){
		    		return false;
		    	}
		        if(checkDexuat() == false){
		    		return false;
		    	}
    		}else{
    			if (checkCongViec_HoanThanh() == false){
    				loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc.');
    	            return false;
    	        }
    			if(checkCongViec_ChuaHoanThanh() == false){
    				loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc.');
    	    		return false;
    	    	}
    	    	if(checkDiemchinh() == false){
    	    		return false;
    	    	}
    	    	if(checkDexuat() == false){
    	    		return false;
    	    	}
    	    	if($('#template_type').val() == 'congchuc'){
	    	    	if(check_saipham() == false){
	    	    		loadNoticeBoard('Thông báo lỗi','Bạn chưa cho điểm phần điểm trừ. Vui lòng kiểm tra lại!');
	    	    		return false;
	    	    	}
    	    	}
    		}
    	}else{
    		
    	}
    	tinhdiemhieuqua();
		blockMyUI('Đang lưu dữ liệu...');
		var url = 'index.php?option=com_danhgia&controller=tudanhgia&task=save_finished&id_dotdanhgia='+$('#id_dotdanhgia').val();
		$.post(url,$('#tudanhgiaForm-'+$('#template_type').val()).serialize(),function(data){					
			displayDanhgias();
			$.unblockUI();
		});
		return false;
		
	});
    /* ******************************* Lưu kết quả đánh giá chéo ******************************* */
    $('body').delegate('.btn_save_continue_khac', ace.click_event, function(){
    	if(check_thoigian() == false){
    		loadNoticeBoard('Thông báo lỗi','Vui lòng nhập thời gian và lý do thay đổi mức sử dụng thời gian.');
    		return false;
        }
		if(check_diemthuong() == false){
			loadNoticeBoard('Phải xác nhận và điều chỉnh điểm thưởng đối với các công việc có điểm thưởng ở phần A1.1.');
    		return false;
        }
    	if(checkCongViec_HoanThanh() == false || checkCongViec_ChuaHoanThanh() == false){
    		loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc.');
    		return false;
    	}
    	if($('#template_type').val() == 'thammuu' || $('#template_type').val() == 'truongphong'){
	    	if(jQuery("#div-thoigianquydinh").html() != ''){
	    		loadNoticeBoard('Thông báo lỗi','Thời gian sử dụng để làm việc trong giờ hành chính lớn hơn số ngày làm việc theo quy định trong tháng. Đề nghị điều chỉnh!');
	            return false;
	        }
    	}
    	if(checkDexuat() == false){
    		return false;
    	}
    	tinhdiemhieuqua();
		blockMyUI('Đang lưu dữ liệu...');
		var url = 'index.php?option=com_danhgia&controller=danhgiakhac&task=save_tong&id_dotdanhgia='+$('#id_dotdanhgia').val();
		$.post(url,$('#danhgiakhacForm-'+$('#template_type').val()).serialize(),function(data){
			$.unblockUI();
		});
		return false;
    });
    $('body').delegate('.btn_save_back_khac', ace.click_event, function(){
    	if(check_thoigian() == false){
    		loadNoticeBoard('Thông báo lỗi','Vui lòng nhập thời gian và lý do thay đổi mức sử dụng thời gian.');
    		return false;
        }
		if(check_diemthuong() == false){
			loadNoticeBoard('Phải xác nhận và điều chỉnh điểm thưởng đối với các công việc có điểm thưởng ở phần A1.1.');
    		return false;
        }
    	if(checkCongViec_HoanThanh() == false || checkCongViec_ChuaHoanThanh() == false){
    		loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc.');
    		return false;
    	}
    	if($('#template_type').val() == 'thammuu' || $('#template_type').val() == 'truongphong'){
	    	if(jQuery("#div-thoigianquydinh").html() != ''){
	    		loadNoticeBoard('Thông báo lỗi','Thời gian sử dụng để làm việc trong giờ hành chính lớn hơn số ngày làm việc theo quy định trong tháng. Đề nghị điều chỉnh!');
	            return false;
	        }
    	}
    	if(checkDexuat() == false){
    		return false;
    	}
    	tinhdiemhieuqua();
		blockMyUI('Đang lưu dữ liệu...');
		var url = 'index.php?option=com_danhgia&controller=danhgiakhac&task=save_tong_back&id_dotdanhgia='+$('#id_dotdanhgia').val();
		$.post(url,$('#danhgiakhacForm-'+$('#template_type').val()).serialize(),function(data){					
			displayDanhgias();
			$.unblockUI();
		});
		return false;
    });
    $('body').delegate('.btn_save_finished_khac', ace.click_event, function(){
    	if(check_thoigian() == false){
    		loadNoticeBoard('Thông báo lỗi','Vui lòng nhập thời gian và lý do thay đổi mức sử dụng thời gian.');
    		return false;
        }
		if(check_diemthuong() == false){
			loadNoticeBoard('Phải xác nhận và điều chỉnh điểm thưởng đối với các công việc có điểm thưởng ở phần A1.1.');
    		return false;
        }
    	if(checkCongViec_HoanThanh() == false || checkCongViec_ChuaHoanThanh() == false){
    		loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc.');
    		return false;
    	}
    	if($('#template_type').val() == 'thammuu' || $('#template_type').val() == 'truongphong'){
        	if(jQuery("#div-thoigianquydinh").html() != ''){
        		loadNoticeBoard('Thông báo lỗi','Thời gian sử dụng để làm việc trong giờ hành chính lớn hơn số ngày làm việc theo quy định trong tháng. Đề nghị điều chỉnh!');
                return false;
            }
    	}
    	if(checkDiemchinh() == false){
    		return false;
    	}
    	if(checkDexuat() == false){
    		return false;
    	}
		if(jQuery("#nhanxet").val() == ''){
			jQuery("#nhanxet").attr("style","font-size:15px;border-color:red;border-style:solid;");
			loadNoticeBoard('Vui lòng nhập nội dung nhận xét chung trong tháng.');
            return false;
		}else{
			jQuery("#nhanxet").attr("style","font-size: 15px;");
		}
    	tinhdiemhieuqua();
		blockMyUI('Đang lưu dữ liệu...');
		var url = 'index.php?option=com_danhgia&controller=danhgiakhac&task=save_finished&id_dotdanhgia='+$('#id_dotdanhgia').val();
		$.post(url,$('#danhgiakhacForm-'+$('#template_type').val()).serialize(),function(data){					
			displayDanhgias();
			$.unblockUI();
		});
		return false;
    });
});