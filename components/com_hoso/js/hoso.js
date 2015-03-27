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
var blockMyUI = function(message){
	jQuery.blockUI({ 
		css: { 
		border: 'none',
		padding: '15px', 
		backgroundColor: '#000', 
		'-webkit-border-radius': '10px', 
		'-moz-border-radius': '10px',
		opacity: .5,
		color: '#fff' 
		},
		message: '<h1><i class="icon-spinner icon-spin orange bigger-125"></i>' + message + '</h1>'
	});
};
var renewElement = function(element,value){
	element.html(value);
	if(value != '' && value != null){
		element.closest('.span5').show();
	}else{
		element.closest('.span5').hide();
	}
};
var change_alias = function(alias){
    var str = alias;
    str= str.toLowerCase(); 
    str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
    str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
    str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
    str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
    str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
    str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
    str= str.replace(/đ/g,"d");
    str= str.replace(/0|1|2|3|4|5|6|7|8|9/g,"");
    str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\-|\:|\;|\'|\s|\"|\&|\#|\[|\]|~|$|_/g,"");
    /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */
    str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1-
    str= str.replace(/^\-+|\-+$/g,"");
    //cắt bỏ ký tự - ở đầu và cuối chuỗi
    return str;
}
var setCookie = function (key, value) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
};
var getCookie = function (key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
};
var compareDate = function(dateStart, dateEnd){
	/*
	 * dateStart < dateEnd => -1
	 * dateStart = dateEnd =>  0
	 * dateStart > dateEnd =>  1
	 */
	if(dateStart != '' && dateEnd != ''){
		var arrDateStart = dateStart.split('/',3);
		var arrDateEnd = dateEnd.split('/',3);
		var numberStart = parseInt(arrDateStart[2]+arrDateStart[1]+arrDateStart[0]);
		var numberEnd = parseInt(arrDateEnd[2]+arrDateEnd[1]+arrDateEnd[0]);
		if(numberStart < numberEnd){
			return -1;
		}else if(numberStart == numberEnd){
			return 0;
		}else{
			return 1;
		}
	}else{
		return -1;
	}
};
var getCbxNguyenquan = function(elSelect,elChange,task,elEnd){
	var valSelect = jQuery('#'+elSelect).val();
	jQuery.ajax({
		type: "POST",
		url: "index.php?option=com_hoso&view=thongtinchung&format=raw",
		data: { task : task, valSelect : valSelect },
		success:function(data){
			var str = '<option value=""></option>';
			if( data !== undefined && data.length > 0 ){
				jQuery.each(data,function(i,val){
					str+= '<option value="' + val.code + '">' + val.name + '</option>';
				});
			}
			jQuery('#'+elChange).html(str);
			jQuery('#'+elChange).trigger('chosen:updated');
			if(elEnd != null){
				jQuery('#'+elEnd).html('<option value=""></option>');
				jQuery('#'+elEnd).trigger('chosen:updated');
			}
		}
	});
};
var fxDynamicSelect = function(el_select,el_hidden,widselect){
	widselect = (widselect == '')?'220px':widselect;
	jQuery(el_select).chosen({ width: widselect,search_contains: true }).on('change', function(){
		var textSelect = jQuery(this).find("option:selected").text();
		var row_index = jQuery(el_select).index(jQuery(this));
		jQuery(el_hidden).eq(row_index).val(textSelect);
	}).on('chosen:no_results',function(){
		var row_index = jQuery(el_select).index(jQuery(this));
		var searchText = jQuery(el_select).eq(row_index).next().find('input');
		var inputText = searchText.val();
		if(jQuery(el_select).eq(row_index).children('option[value=""]').length > 0){
			jQuery(el_select).eq(row_index).children('option[value=""]').text(inputText);
		}else{
			jQuery(el_select).eq(row_index).append('<option value="">'+inputText+'</option>');
		}
		jQuery(el_hidden).eq(row_index).val(inputText);
		jQuery(el_select).eq(row_index).val('');
		jQuery(el_select).eq(row_index).trigger('chosen:updated');
		searchText.val(inputText);
	});
};