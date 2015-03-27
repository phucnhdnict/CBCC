function remove(){
	if(confirm('Bạn có chắc chắn muốn xóa?')==true){
		
	}
}

function ExportExcelNL(){
	var iddv=jQuery("#iddv").val()
	var phong_id=jQuery("#phong_id").val()
	url="index.php?option=com_quanlybienche&task=exportExcel&format=raw&iddv="+iddv+"&phong_id="+phong_id 
	jQuery.post(url,function(data) {
		jQuery("#dsnangluongExcel").html(data)
	})				
		
}

