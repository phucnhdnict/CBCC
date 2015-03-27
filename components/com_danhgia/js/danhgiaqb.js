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
			jQuery(this).addClass('error');
			str += 'Vui lòng cho điểm các tiêu chí chính tại mục ';
			str += jQuery(this).attr("belongto") + '<br/>';
		}else{
			jQuery(this).removeClass('error');
		}
	});
	if(str != ''){
		loadNoticeBoard('Thông báo lỗi',str);
		return false;
	}
};
var tinhdiemcongviec = function(row_index){
	var diemmaxcongviec = jQuery('#diemmax_congviec').val();
	var tongthoigian = jQuery('#template_thoigiandot').val();
	if(jQuery('.cbo-mdpt-congviec').eq(row_index).val() == ''){
		var heso_mdpt = 1;
	}else{
		var heso_mdpt = parseFloat(jQuery('.cbo-mdpt-congviec').eq(row_index).find('option:selected').data('heso'));
	}
	if(jQuery('.cbo-chatluong-congviec').eq(row_index).val() == ''){
		var tyle_chatluong = 0;
	}else{
		var tyle_chatluong = parseFloat(jQuery('.cbo-chatluong-congviec').eq(row_index).find('option:selected').data('tyle'));
	}
	if(jQuery('.cbo-tiendo-congviec').eq(row_index).val() == ''){
		var tyle_tiendo = 0;
	}else{
		var tyle_tiendo = parseFloat(jQuery('.cbo-tiendo-congviec').eq(row_index).find('option:selected').data('tyle'));
	}
	if(jQuery('.cbo-nhiemvuchinh').eq(row_index).val() == ''){
		var diemtrungbinh = 0;
	}else{
		var diemtrungbinh = parseInt(jQuery('.cbo-nhiemvuchinh').eq(row_index).find('option:selected').data('tytrong'))*parseFloat(diemmaxcongviec)/parseFloat(tongthoigian);
	}
	
	var diem =  (diemtrungbinh*heso_mdpt*(tyle_chatluong + tyle_tiendo + 100)/100);
	var str_diem_congviec = '<option value="' + diem.toFixed(1) + '">' + diem.toFixed(1) + '</option>';
	jQuery('.cbo-diem-congviec').eq(row_index).html(str_diem_congviec);
};
var tinhdiemnghiphep = function(){
	var diemmaxcongviec = jQuery('#diemmax_congviec').val();
	var tongthoigian = jQuery('#template_thoigiandot').val();
	if(jQuery('#nghiphep').val() == ''){
		var nghiphep = 0;
	}else{
		var nghiphep = jQuery('#nghiphep').val();
	}

	var diem_nghiphep = parseInt(nghiphep)*parseFloat(diemmaxcongviec)/parseFloat(tongthoigian);
	jQuery('#diem_nghiphep').val(diem_nghiphep.toFixed(1));
};
var tinhdiemhieuqua = function(){
	var diemcongviec = 0;
	var diem_max = jQuery('#diemmax_congviec').val();
	diemcongviec += parseFloat(jQuery('#diem_nghiphep').val());
	jQuery('.cbo-diem-congviec').each(function(){
		if(jQuery(this).val() != ''){
			diemcongviec += parseFloat(jQuery(this).val());
		}
	});
	if(diemcongviec > parseFloat(diem_max)){
		diemcongviec = parseFloat(diem_max);
	}
	jQuery("#diemA1").val(diemcongviec);
	tinhFloatBar();
	tinhTongdiem();
};
var tinhFloatBar = function(){
	var heso = jQuery('#heso_danhgia').val();
	if(jQuery('#template_type').val() == 'thammuu'){
		if(heso > 1){
			var diem_a1 = parseFloat(jQuery("#diemA1").val());
			var diemthuong_a1 = parseFloat(jQuery("select[name='diems[]']").eq(0).val());
			var diem_a2 = parseFloat(jQuery("select[name='diems[]']").eq(1).val());
			var diemthuong_a2 = parseFloat(jQuery("select[name='diems[]']").eq(2).val()) + parseFloat(jQuery("select[name='diems[]']").eq(3).val());
			var diem_a3 = 0;
			var diemthuong_a3 = 0;
			var diem_b = parseFloat(jQuery("select[name='diems[]']").eq(4).val());
			var diemthuong_b = parseFloat(jQuery("select[name='diems[]']").eq(5).val()) + parseFloat(jQuery("select[name='diems[]']").eq(6).val());
			var diem_c = parseFloat(jQuery("select[name='diems[]']").eq(7).val());
			var diemthuong_c = parseFloat(jQuery("select[name='diems[]']").eq(8).val()) + parseFloat(jQuery("select[name='diems[]']").eq(9).val()) + parseFloat(jQuery("select[name='diems[]']").eq(10).val()) + parseFloat(jQuery("select[name='diems[]']").eq(11).val());
		
			jQuery("#td_floatbar_muc_a1").html('<font style="color:red;">' + parseFloat(diem_a1.toFixed(1)) + '/40</font>');
			jQuery("#td_floatbar_muc_a1_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_a1.toFixed(1)) + '/10</font>');
			jQuery("#td_floatbar_muc_a2").html('<font style="color:red;">' + parseFloat(diem_a2.toFixed(1)) + '/16</font>');
			jQuery("#td_floatbar_muc_a2_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_a2.toFixed(1)) + '/4</font>');
			jQuery("#td_floatbar_muc_a3").html('<font style="color:red;">' + parseFloat(diem_a3.toFixed(1)) + '/0</font>');
			jQuery("#td_floatbar_muc_a3_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_a3.toFixed(1)) + '/0</font>');
			jQuery("#td_floatbar_muc_b").html('<font style="color:red;">' + parseFloat(diem_b.toFixed(1)) + '/8</font>');
			jQuery("#td_floatbar_muc_b_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_b.toFixed(1)) + '/2</font>');
			jQuery("#td_floatbar_muc_c").html('<font style="color:red;">' + parseFloat(diem_c.toFixed(1)) + '/18</font>');
			jQuery("#td_floatbar_muc_c_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_c.toFixed(1)) + '/2</font>');
			
			if(jQuery('#danhgia_type').val() == 'danhgiakhac'){
				jQuery('.diemthuong_hoanthanh').each(function(){
					jQuery(this).val(parseFloat(diemthuong_a1.toFixed(1)));
				});
			}
		}else{
			jQuery('#tr_hieuqua').hide();
			jQuery('#tr_thoigian').hide();
			jQuery('#tr_lanhdao').hide();
			var diem_b = parseFloat(jQuery("select[name='diems[]']").eq(0).val());
			var diem_c = parseFloat(jQuery("select[name='diems[]']").eq(1).val());
			
			jQuery("#td_floatbar_muc_b").html('<font style="color:red;">' + diem_b + '/8</font>');
			jQuery("#td_floatbar_muc_b_thuong").html('<font style="color:red;">0/0</font>');
			jQuery("#td_floatbar_muc_c").html('<font style="color:red;">' + diem_c + '/18</font>');
			jQuery("#td_floatbar_muc_c_thuong").html('<font style="color:red;">0/0</font>');
		}
	}else if(jQuery('#template_type').val() == 'phucvu'){
		if(heso > 1){
			var diem_a1 = parseFloat(jQuery("#diemA1").val());
			var diemthuong_a1 = parseFloat(jQuery("select[name='diems[]']").eq(0).val());
			var diem_a2 = parseFloat(jQuery("select[name='diems[]']").eq(1).val());
			var diemthuong_a2 = parseFloat(jQuery("select[name='diems[]']").eq(2).val()) + parseFloat(jQuery("select[name='diems[]']").eq(3).val());
			var diem_a3 = 0;
			var diemthuong_a3 = 0;
			var diem_b = parseFloat(jQuery("select[name='diems[]']").eq(4).val());
			var diemthuong_b = parseFloat(jQuery("select[name='diems[]']").eq(5).val()) + parseFloat(jQuery("select[name='diems[]']").eq(6).val());
			var diem_c = parseFloat(jQuery("select[name='diems[]']").eq(7).val());
			var diemthuong_c = parseFloat(jQuery("select[name='diems[]']").eq(8).val()) + parseFloat(jQuery("select[name='diems[]']").eq(9).val()) + parseFloat(jQuery("select[name='diems[]']").eq(10).val()) + parseFloat(jQuery("select[name='diems[]']").eq(11).val());
		
			jQuery("#td_floatbar_muc_a1").html('<font style="color:red;">' + parseFloat(diem_a1.toFixed(1)) + '/35</font>');
			jQuery("#td_floatbar_muc_a1_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_a1.toFixed(1)) + '/10</font>');
			jQuery("#td_floatbar_muc_a2").html('<font style="color:red;">' + parseFloat(diem_a2.toFixed(1)) + '/21</font>');
			jQuery("#td_floatbar_muc_a2_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_a2.toFixed(1)) + '/4</font>');
			jQuery("#td_floatbar_muc_a3").html('<font style="color:red;">' + parseFloat(diem_a3.toFixed(1)) + '/0</font>');
			jQuery("#td_floatbar_muc_a3_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_a3.toFixed(1)) + '/0</font>');
			jQuery("#td_floatbar_muc_b").html('<font style="color:red;">' + parseFloat(diem_b.toFixed(1)) + '/8</font>');
			jQuery("#td_floatbar_muc_b_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_b.toFixed(1)) + '/2</font>');
			jQuery("#td_floatbar_muc_c").html('<font style="color:red;">' + parseFloat(diem_c.toFixed(1)) + '/18</font>');
			jQuery("#td_floatbar_muc_c_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_c.toFixed(1)) + '/2</font>');
			
			if(jQuery('#danhgia_type').val() == 'danhgiakhac'){
				jQuery('.diemthuong_hoanthanh').each(function(){
					jQuery(this).val(parseFloat(diemthuong_a1.toFixed(1)));
				});
			}
		}else{
			jQuery('#tr_hieuqua').hide();
			jQuery('#tr_thoigian').hide();
			jQuery('#tr_lanhdao').hide();
			var diem_b = parseFloat(jQuery("select[name='diems[]']").eq(0).val());
			var diem_c = parseFloat(jQuery("select[name='diems[]']").eq(1).val());
			
			jQuery("#td_floatbar_muc_b").html('<font style="color:red;">' + diem_b + '/8</font>');
			jQuery("#td_floatbar_muc_b_thuong").html('<font style="color:red;">0/0</font>');
			jQuery("#td_floatbar_muc_c").html('<font style="color:red;">' + diem_c + '/18</font>');
			jQuery("#td_floatbar_muc_c_thuong").html('<font style="color:red;">0/0</font>');
		}
	}else if(jQuery('#template_type').val() == 'truongphong'){
		if(heso > 1){
			var diem_a1 = parseFloat(jQuery("#diemA1").val());
			var diemthuong_a1 = parseFloat(jQuery("select[name='diems[]']").eq(0).val());
			var diem_a2 = parseFloat(jQuery("select[name='diems[]']").eq(1).val());
			var diemthuong_a2 = parseFloat(jQuery("select[name='diems[]']").eq(2).val()) + parseFloat(jQuery("select[name='diems[]']").eq(3).val());
			var diem_a3 = parseFloat(jQuery("select[name='diems[]']").eq(4).val());
			var diemthuong_a3 = parseFloat(jQuery("select[name='diems[]']").eq(5).val()) + parseFloat(jQuery("select[name='diems[]']").eq(6).val());
			var diem_b = parseFloat(jQuery("select[name='diems[]']").eq(7).val());
			var diemthuong_b = parseFloat(jQuery("select[name='diems[]']").eq(8).val()) + parseFloat(jQuery("select[name='diems[]']").eq(9).val());
			var diem_c = parseFloat(jQuery("select[name='diems[]']").eq(10).val());
			var diemthuong_c = parseFloat(jQuery("select[name='diems[]']").eq(11).val()) + parseFloat(jQuery("select[name='diems[]']").eq(12).val()) + parseFloat(jQuery("select[name='diems[]']").eq(13).val()) + parseFloat(jQuery("select[name='diems[]']").eq(14).val());
			
			jQuery("#td_floatbar_muc_a1").html('<font style="color:red;">' + parseFloat(diem_a1.toFixed(1)) + '/35</font>');
			jQuery("#td_floatbar_muc_a1_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_a1.toFixed(1)) + '/10</font>');
			jQuery("#td_floatbar_muc_a2").html('<font style="color:red;">' + parseFloat(diem_a2.toFixed(1)) + '/11</font>');
			jQuery("#td_floatbar_muc_a2_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_a2.toFixed(1)) + '/2</font>');
			jQuery("#td_floatbar_muc_a3").html('<font style="color:red;">' + parseFloat(diem_a3.toFixed(1)) + '/10</font>');
			jQuery("#td_floatbar_muc_a3_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_a3.toFixed(1)) + '/2</font>');
			jQuery("#td_floatbar_muc_b").html('<font style="color:red;">' + parseFloat(diem_b.toFixed(1)) + '/8</font>');
			jQuery("#td_floatbar_muc_b_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_b.toFixed(1)) + '/2</font>');
			jQuery("#td_floatbar_muc_c").html('<font style="color:red;">' + parseFloat(diem_c.toFixed(1)) + '/18</font>');
			jQuery("#td_floatbar_muc_c_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_c.toFixed(1)) + '/2</font>');
			
			if(jQuery('#danhgia_type').val() == 'danhgiakhac'){
				jQuery('.diemthuong_hoanthanh').each(function(){
					jQuery(this).val(parseFloat(diemthuong_a1.toFixed(1)));
				});
			}
		}else{
			jQuery('#tr_hieuqua').hide();
			jQuery('#tr_thoigian').hide();
			var diem_a3 = parseFloat(jQuery("select[name='diems[]']").eq(0).val());
			var diem_b = parseFloat(jQuery("select[name='diems[]']").eq(1).val());
			var diem_c = parseFloat(jQuery("select[name='diems[]']").eq(2).val());

			jQuery("#td_floatbar_muc_a3").html('<font style="color:red;">' + diem_a3 + '/10</font>');
			jQuery("#td_floatbar_muc_a3_thuong").html('<font style="color:red;">0/0</font>');
			jQuery("#td_floatbar_muc_b").html('<font style="color:red;">' + diem_b + '/8</font>');
			jQuery("#td_floatbar_muc_b_thuong").html('<font style="color:red;">0/0</font>');
			jQuery("#td_floatbar_muc_c").html('<font style="color:red;">' + diem_c + '/18</font>');
			jQuery("#td_floatbar_muc_c_thuong").html('<font style="color:red;">0/0</font>');
		}
	}else if(jQuery('#template_type').val() == 'phogiamdoc'){
		if(heso > 1){
			var diem_a1 = parseFloat(jQuery("#diemA1").val());
			var diemthuong_a1 = parseFloat(jQuery("select[name='diems[]']").eq(0).val());
			var diem_a2 = parseFloat(jQuery("select[name='diems[]']").eq(1).val());
			var diemthuong_a2 = parseFloat(jQuery("select[name='diems[]']").eq(2).val()) + parseFloat(jQuery("select[name='diems[]']").eq(3).val());
			var diem_a3 = parseFloat(jQuery("select[name='diems[]']").eq(4).val());
			var diemthuong_a3 = parseFloat(jQuery("select[name='diems[]']").eq(5).val()) + parseFloat(jQuery("select[name='diems[]']").eq(6).val());
			var diem_b = parseFloat(jQuery("select[name='diems[]']").eq(7).val());
			var diemthuong_b = parseFloat(jQuery("select[name='diems[]']").eq(8).val()) + parseFloat(jQuery("select[name='diems[]']").eq(9).val());
			var diem_c = parseFloat(jQuery("select[name='diems[]']").eq(10).val());
			var diemthuong_c = parseFloat(jQuery("select[name='diems[]']").eq(11).val()) + parseFloat(jQuery("select[name='diems[]']").eq(12).val()) + parseFloat(jQuery("select[name='diems[]']").eq(13).val()) + parseFloat(jQuery("select[name='diems[]']").eq(14).val());
			
			jQuery("#td_floatbar_muc_a1").html('<font style="color:red;">' + parseFloat(diem_a1.toFixed(1)) + '/25</font>');
			jQuery("#td_floatbar_muc_a1_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_a1.toFixed(1)) + '/10</font>');
			jQuery("#td_floatbar_muc_a2").html('<font style="color:red;">' + parseFloat(diem_a2.toFixed(1)) + '/8</font>');
			jQuery("#td_floatbar_muc_a2_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_a2.toFixed(1)) + '/2</font>');
			jQuery("#td_floatbar_muc_a3").html('<font style="color:red;">' + parseFloat(diem_a3.toFixed(1)) + '/23</font>');
			jQuery("#td_floatbar_muc_a3_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_a3.toFixed(1)) + '/2</font>');
			jQuery("#td_floatbar_muc_b").html('<font style="color:red;">' + parseFloat(diem_b.toFixed(1)) + '/8</font>');
			jQuery("#td_floatbar_muc_b_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_b.toFixed(1)) + '/2</font>');
			jQuery("#td_floatbar_muc_c").html('<font style="color:red;">' + parseFloat(diem_c.toFixed(1)) + '/18</font>');
			jQuery("#td_floatbar_muc_c_thuong").html('<font style="color:red;">' + parseFloat(diemthuong_c.toFixed(1)) + '/2</font>');
			
			if(jQuery('#danhgia_type').val() == 'danhgiakhac'){
				jQuery('.diemthuong_hoanthanh').each(function(){
					jQuery(this).val(parseFloat(diemthuong_a1.toFixed(1)));
				});
			}
		}else{
			jQuery('#tr_hieuqua').hide();
			jQuery('#tr_thoigian').hide();
			var diem_a3 = parseFloat(jQuery("select[name='diems[]']").eq(0).val());
			var diem_b = parseFloat(jQuery("select[name='diems[]']").eq(1).val());
			var diem_c = parseFloat(jQuery("select[name='diems[]']").eq(2).val());

			jQuery("#td_floatbar_muc_a3").html('<font style="color:red;">' + diem_a3 + '/23</font>');
			jQuery("#td_floatbar_muc_a3_thuong").html('<font style="color:red;">0/0</font>');
			jQuery("#td_floatbar_muc_b").html('<font style="color:red;">' + diem_b + '/8</font>');
			jQuery("#td_floatbar_muc_b_thuong").html('<font style="color:red;">0/0</font>');
			jQuery("#td_floatbar_muc_c").html('<font style="color:red;">' + diem_c + '/18</font>');
			jQuery("#td_floatbar_muc_c_thuong").html('<font style="color:red;">0/0</font>');
		}
	}
};
var tinhTongdiem = function(){
	var tongdiem = 0;
	jQuery("input[name='diems[]']").each(function(){
		tongdiem += parseFloat(jQuery(this).val());
	});
	if(jQuery('#danhgia_type').val() == 'tudanhgia'){
		jQuery("select[name='diems[]']").each(function(){
			if(!jQuery(this).hasClass('select-dexuat')){
				tongdiem += parseFloat(jQuery(this).val());
			}
		});
		jQuery("#td_floatbar_tongdiem").html('<font style="color:red;font-size:15px;">' + tongdiem.toFixed(1) + ' / 82.0</font>');
	}else{
		jQuery("select[name='diems[]']").each(function(){
			tongdiem += parseFloat(jQuery(this).val());
		});
		var heso = jQuery('#heso_danhgia').val();
		if(heso > 1){
			jQuery("#td_floatbar_tongdiem").html('<font style="color:red;font-size:15px;">' + tongdiem.toFixed(1) + ' / 100</font>');
		}else{
			if(jQuery('#template_type').val() == 'thammuu' || jQuery('#template_type').val() == 'phucvu'){
				jQuery("#td_floatbar_tongdiem").html('<font style="color:red;font-size:15px;">' + tongdiem.toFixed(1) + ' / 26.0</font>');
			}else if(jQuery('#template_type').val() == 'truongphong'){
				jQuery("#td_floatbar_tongdiem").html('<font style="color:red;font-size:15px;">' + tongdiem.toFixed(1) + ' / 36.0</font>');
			}else if(jQuery('#template_type').val() == 'phogiamdoc'){
				jQuery("#td_floatbar_tongdiem").html('<font style="color:red;font-size:15px;">' + tongdiem.toFixed(1) + ' / 49.0</font>');
			}
		}
	}
};
jQuery(document).ready(function($){
	$('body').delegate('.select-dexuat', 'change', function(){
		showDexuat();
	});
	$('body').delegate('select[name="diems[]"]', 'change', function(){
		tinhFloatBar();
		tinhTongdiem();
	});
	$('body').delegate('#nghiphep', 'blur', function(){
		if(!$.isNumeric($(this).val())){
    		loadNoticeBoard('Thông báo lỗi','Dữ liệu nhập phải là số nguyên.');
       		$(this).val('0');
			return false;
    	}
    	if($(this).val() > 80){
    		loadNoticeBoard('Thông báo lỗi','Dữ liệu nhập không được quá 80 giờ (10 ngày).');
       		$(this).val('0');
			return false;
    	}
    	tinhdiemnghiphep();
    	tinhdiemhieuqua();
	});
	$('body').delegate('.cbo-mdpt-congviec', 'change', function(){
		var row_index = $('.cbo-mdpt-congviec').index($(this));
		tinhdiemcongviec(row_index);
		tinhdiemhieuqua();
	});
	$('body').delegate('.cbo-nhiemvuchinh', 'change', function(){
		var row_index = $('.cbo-nhiemvuchinh').index($(this));
		$('input[name="tencongviec[]"]').eq(row_index).val($(this).find('option:selected').text());
		$('b[name="b_tencongviec[]"]').eq(row_index).html($(this).find('option:selected').text());
		$(this).next().hide();
		$('.btn-edit-nhiemvuchinh').eq(row_index).show();
		$('b[name="b_daura[]"]').eq(row_index).html($(this).find('option:selected').data('daura').replace('||','<br/>'));
		tinhdiemcongviec(row_index);
		tinhdiemhieuqua();
	});
	$('body').delegate('.btn-edit-nhiemvuchinh', 'click', function(){
		var row_index = $('.btn-edit-nhiemvuchinh').index($(this));
		$('.cbo-nhiemvuchinh').eq(row_index).next().slideToggle('slow');
	});
	$('body').delegate('.cbo-chatluong-congviec', 'change', function(){
		var row_index = $('.cbo-chatluong-congviec').index($(this));
		tinhdiemcongviec(row_index);
		tinhdiemhieuqua();
	});
	$('body').delegate('.cbo-tiendo-congviec', 'change', function(){
		var row_index = $('.cbo-tiendo-congviec').index($(this));
		tinhdiemcongviec(row_index);
		tinhdiemhieuqua();
	});
    $('body').delegate('.btn_remove','click',function(event){
    	event.preventDefault();    
        if(confirm('Bạn có chắc chắn muốn xóa?')){
			var el = $(this);
			el.parentsUntil('tbody').remove();
	        tinhdiemhieuqua();
			return false;
        }else{
            return false;
        }
	});
	$('body').delegate('.btn_save_continue_khac',ace.click_event,function(){
		$.blockUI();
		if ($('#'+$('#template_type').val()+'Frm').valid() == false){
        	loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc.');
			$.unblockUI();
            return false;
        }
    	if(checkDexuat() == false){
			$.unblockUI();
    		return false;
    	}
    	tinhdiemhieuqua();
		var url = 'index.php?option=com_danhgia&controller='+$('#danhgia_type').val()+'&task=saveDanhgiaQB&id_dotdanhgia='+$('#id_dotdanhgia').val();
		$.post(url,$('#'+$('#template_type').val()+'Frm').serialize(),function(data){
			if(data == '0'){
				loadNoticeBoard('Thông báo','Xử lý không thành công.');
			}else{
				loadNoticeBoardSuccess('Thông báo','Xử lý thành công.');
			}
			$.unblockUI();
		});
		return false;
    });
	$('body').delegate('.btn_save_back_khac',ace.click_event,function(){
		$.blockUI();
		if ($('#'+$('#template_type').val()+'Frm').valid() == false){
        	loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc.');
			$.unblockUI();
            return false;
        }
    	if(checkDexuat() == false){
			$.unblockUI();
    		return false;
    	}
    	tinhdiemhieuqua();
		var url = 'index.php?option=com_danhgia&controller='+$('#danhgia_type').val()+'&task=saveDanhgiaQB&id_dotdanhgia='+$('#id_dotdanhgia').val();
		$.post(url,$('#'+$('#template_type').val()+'Frm').serialize(),function(data){
			if(data == '0'){
				loadNoticeBoard('Thông báo','Xử lý không thành công.');
			}else{
				loadNoticeBoardSuccess('Thông báo','Xử lý thành công.');
				displayDanhgias();
			}
			$.unblockUI();
		});
		return false;
    });
	$('body').delegate('.btn_save_finished_khac',ace.click_event,function(){
		$.blockUI();
		if ($('#'+$('#template_type').val()+'Frm').valid() == false){
        	loadNoticeBoard('Thông báo lỗi','Vui lòng nhập đầy đủ nội dung công việc.');
			$.unblockUI();
            return false;
        }
    	if(checkDiemchinh() == false){
			$.unblockUI();
    		return false;
    	}
    	if(checkDexuat() == false){
			$.unblockUI();
    		return false;
    	}
    	if($("#nhanxet").val() == ''){
			$("#nhanxet").addClass('error');
			loadNoticeBoard('Vui lòng nhập nội dung nhận xét chung trong tháng.');
            return false;
		}else{
			$("#nhanxet").removeClass('error');
		}
    	tinhdiemhieuqua();
		var url = 'index.php?option=com_danhgia&controller='+$('#danhgia_type').val()+'&task=saveDanhgiaQB&id_dotdanhgia='+$('#id_dotdanhgia').val()+'&typesave=finished';
		$.post(url,$('#'+$('#template_type').val()+'Frm').serialize(),function(data){					
			if(data == '0'){
				loadNoticeBoard('Thông báo','Xử lý không thành công.');
			}else{
				loadNoticeBoardSuccess('Thông báo','Xử lý thành công.');
				displayDanhgias();
			}
			$.unblockUI();
		});
		return false;
    });
});