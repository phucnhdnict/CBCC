var util = {
	change_alias: function(alias){
	    var str = alias;
	    str= str.toLowerCase(); 
	    str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
	    str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
	    str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
	    str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ  |ợ|ở|ỡ/g,"o"); 
	    str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
	    str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
	    str= str.replace(/đ/g,"d"); 
	    str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|-/g,"_");
	    /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */
	    str= str.replace(/_+_/g,"_");
	    //thay thế 2- thành 1-
	    str= str.replace(/^\_+|\_+$/g,""); 
	    //cắt bỏ ký tự - ở đầu và cuối chuỗi 
	    return str;
	},
	fileExport:function(str){
		str = str.replace(/(\d)/g,"");
		return this.change_alias(str); 		
	}

};
//console.log(util.fileExport('Sở Thông Tin Và Truyền Thông ( 20 )'));