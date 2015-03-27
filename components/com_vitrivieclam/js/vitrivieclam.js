var loadingAjax = function (value){
	jQuery("#"+value).html('<div style="background:#FFFFFF;border:1px solid #E9E9E9;padding:90px;font-size: 14px;position:fixed;top:300px;left:200px;width:60%;height:auto;z-index:1;border-radius:8px"><i class="icon-spinner icon-spin orange bigger-125"></i> Đang tải dữ liệu...</div>');
};
var loadNoticeBoardSuccess = function(title,text){
	jQuery.gritter.add({
		title: title,
		text: text,
		class_name: 'gritter-success gritter-center gritter-light'
	});
};
var loadNoticeBoardError = function(title,text){
	jQuery.gritter.add({
		title: title,
		text: text,
		class_name: 'gritter-error gritter-light'
	});
};