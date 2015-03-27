//Mo cac the tuong ung tu cac component khac, goi cac function tai day
function openExtTab(id){
	countTab(id,"com_nangluongtx","getChuaNL","#lblCountTabNangluong",'');
//	checkOpenTab(id,'#isNangluongOpen','com_nangluongtx','display','#nangluong','');
	
	countTab(id,"com_nghihuu","getNghihuu","#lblCountTabNghihuu",'');
//	checkOpenTab(id,'#isNghihuuOpen','com_nghihuu','display','#nghihuu','');
	
	checkOpenTab(id,'#isDanhbaOpen','com_danhba','display','#danhba','');
	
	countTab(id,"com_danhba","display_num_dv","#lblCountTabDangvien",'');
//	checkOpenTab(id,'#isDangvienOpen','com_danhba','display_dv','#dsdangvien','');
	
	countTab(id,"com_danhba","numBonhiem","#lblCountTabNhacbonhiem",'');
//	checkOpenTab(id,'#isNhacbonhiemOpen','com_danhba','displayBonhiem','#nhacbonhiem','');
	
	countTab(id,"com_quanlybienche","count","#lblCountTabTuHopDong",'Tuhopdong');
//	checkOpenTab(id,'#isTuHopDongOpen','com_quanlybienche','display','#tuhopdong','Tuhopdong');
	
	countTab(id,"com_hosocanhan","countDexuat","#lblCountTabDexuat",'hosocanhan');
//	checkOpenTab(id,'#isDexuatOpen','com_hosocanhan','displayDexuatDV','#dexuat','hosocanhan');
}

//Kiem tra the da mo chua, neu da mo thi load lai danh sach

function checkOpenTab(id,isOpenDivId,com_name,task_name,listDivId,controller){	
	if(jQuery(isOpenDivId).val()==1){
		//window[functionName](id);		
		listTab(id,isOpenDivId,com_name,task_name,listDivId,controller);
	}
}

function listTab(id,isOpenDivId,com_name,task_name,listDivId,controller){
	jQuery(isOpenDivId).val("1");
	var phong_id=jQuery("#phong_id").val();
	var iddv;
	if(id !='' && id>0 && id !="undefined"){
		iddv=id;
	}else{
		iddv=jQuery("#iddv").val();
	}		
	url="index.php?option="+com_name+"&task="+task_name+"&controller="+controller+"&format=raw&iddv="+iddv+"&phong_id="+phong_id
	jQuery(listDivId).html("Đang tải dữ liệu...")
	jQuery.post(url,function(data) {
		jQuery(listDivId).html(data);
	});
}

function countTab(id,com_name,task_name,lblCount,controller){
	var url="index.php?option="+com_name+"&task="+task_name+"&controller="+controller+"&format=raw&iddv="+id;
	jQuery.post(url,function(data) {
		jQuery(lblCount).html(data);
	});
}


