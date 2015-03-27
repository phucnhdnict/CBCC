var loadingAjax = function (value){
	jQuery("#"+value).html('<img src="/media/media/images/ajax_loading.gif" /> Đang tải dữ liệu...');
};
var loadNoticeBoard = function(title,text){
	jQuery.gritter.add({
		title: title,
		text: text,
		class_name: 'gritter-error gritter-center gritter-light'
	});
};
var loadNoticeBoardSuccess = function(title,text){
	jQuery.gritter.add({
		title: title,
		text: text,
		class_name: 'gritter-success gritter-center gritter-light'
	});
};
var setCookie = function (key, value) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
};
var getCookie = function (key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
};
var showFloatBar = function(template,type){
	jQuery('#settings-board').show();
	jQuery('#tr_tongthoigian').show();
	if(type == 'tudanhgia'){
		jQuery('#tr_luu_y').show();
	}else if(type == 'danhgiakhac'){
		jQuery('#tr_luu_y').hide();
	}
	if(template == 'thammuu'){
		jQuery('#span_maudanhgia').html('Tham mưu, tổng hợp');
	}else if(template == 'phucvu'){
		jQuery('#span_maudanhgia').html('Hỗ trợ, phục vụ');
		jQuery('#tr_tongthoigian').hide();
	}else if(template == 'truongphong'){
		jQuery('#span_maudanhgia').html('Trưởng phòng');
	}else if(template == 'phogiamdoc'){
		jQuery('#span_maudanhgia').html('Phó giám đốc');
		jQuery('#tr_tongthoigian').hide();
	}else if(template == 'giamdoc'){
		jQuery('#span_maudanhgia').html('Giám đốc');
	}else if(template == 'congchuc'){
		jQuery('#span_maudanhgia').html('Công chức phường xã');
	}else if(template == 'phochutich'){
		jQuery('#tr_tongthoigian').hide();
		jQuery('#span_maudanhgia').html('Phó chủ tịch phường xã');
	}else if(template == 'chutich'){
		jQuery('#span_maudanhgia').html('Chủ tịch phường xã');
	}
	var loaicongviec = jQuery('#ids_loaicongviec').val().split(',');
	jQuery('td[class*=floatbar_loaicongviec_]').hide();
	for(i = 0; i < loaicongviec.length; i++){
		jQuery('.floatbar_loaicongviec_'+loaicongviec[i]).show();
	}
}
var showGroupButton = function(type,loaidanhgia){
	if(type == 'danhgia'){
		jQuery('#td_group_button_back').hide();
		if(loaidanhgia != 'danhgiakhac'){
			jQuery('#td_group_button_dg').show();
			jQuery('#td_group_button_dg_khac').hide();
		}else{
			jQuery('#td_group_button_dg').hide();
			jQuery('#td_group_button_dg_khac').show();
		}
	}else if(type == 'xemlai'){
		jQuery('#td_group_button_back').show();
		jQuery('#td_group_button_dg').hide();
		jQuery('#td_group_button_dg_khac').hide();
	}
}