function removeTuHopDong(){
	var iddv=jQuery("#iddv").val();
	var valEmp=jQuery('input[name="chkEmp[]"]').fieldValue(true);
	if(valEmp!=""){
		if(confirm('Bạn có chắc chắn muốn xóa?')==true){
			jQuery("#dstuhopdong").html("Đang xóa hồ sơ...");
			jQuery.post("index.php?option=com_hoso&controller=hoso&task=delEmp&format=raw",
			{'emp_id[]':valEmp,iddv:iddv},function(string){
			searchEmp();
		});
		}else{
			jQuery('input[name="chkEmp[]"]').attr("checked","");
		}
		displayTuHopdong();
	}
} 
function ExportExcelNL(){
	var iddv=jQuery("#iddv").val();
	var phong_id=jQuery("#phong_id").val();
	url="index.php?option=com_quanlybienche&task=exportExcel&format=raw&iddv="+iddv+"&phong_id="+phong_id;
	jQuery.post(url,function(data) {
		jQuery("#dsnangluongExcel").html(data);
	});
}
function displayTuHopdong(id){
	var phong_id=jQuery("#phong_id").val();
	var iddv;
	if(id !='' && id>0 && id !="undefined"){
		iddv=id;
	}else{
		iddv=jQuery("#iddv").val();
	}		
	url="index.php?option=com_quanlybienche&controller=Tuhopdong&format=raw&iddv="+iddv+"&phong_id="+phong_id;
	jQuery.post(url,function(data) {
		jQuery("#dstuhopdong").html(data);
	});
}