
function viewToChuc(){
	var val = jQuery("#TYPE").val();
	
	//chon cap la to chuc
	if(val == 1){
		jQuery('#libc').show();
		jQuery('.tochuc').show();
		jQuery('.vochua').show();
		jQuery('.phong').hide();
		jQuery('#lirep').show();
		
		jQuery("#GOILUONG").addClass("required");
		jQuery("#CAPTOCHUC").addClass("required");
		jQuery("#INS_LOAIHINH").addClass("required");
		jQuery("#LOAIHINHBIENCHE").addClass("required");

	}else{
		//chon cap la vo chua
		if(val == 2){
			jQuery('.vochua').hide();
			jQuery('.phong').hide();
			jQuery('#libc').hide();
			jQuery('#lirep').hide();
		}else{//cap la phong
			jQuery('.vochua').show();
			jQuery('.phong').show();
			jQuery('#libc').show();
			jQuery('#lirep').show();
		}
		jQuery('.tochuc').hide();
		jQuery("#GOILUONG").removeClass("required");
		jQuery("#CAPTOCHUC").removeClass("required");
		jQuery("#INS_LOAIHINH").removeClass("required");
		jQuery("#LOAIHINHBIENCHE").removeClass("required");
//		$("#libc").hide();
	}
}
//hien thi thong tin chi tiet cua don vi

function viewDonVi(id){
	jQuery('#mixed span').css("background-color","transparent");
	jQuery('#mixed span#sp'+id).css("background-color","#FFFAB0");
	jQuery("#iddv").val(id);
	
	var myUrl = "index.php?option=com_tochuc&controller=tochuc&task=viewDetailDonVi&format=raw&iddv=" + id;
	
	jQuery.ajax({
		url: myUrl,
		type: 'POST',
		cache: false,
		beforeSend:function(){
	     	jQuery.blockUI({ message: '<h1 style="text-align:center;width:100%"><img  src="/components/com_tochuc/css/loading.gif" /> <br/>Đang tải dữ liệu...</h1>' });
	    },
	    data:"iddv = " + id,
		success: function(html){
//	    	alert(html);//return false;
	    	jQuery("#dvview").show();
	    	jQuery("#dvaction").hide();
	    	jQuery('#tabttchung').html(html);
	    	
	    	myUrl = "index.php?option=com_tochuc&controller=tochuc&task=checkRoleAddDel&format=raw";
			jQuery.post(myUrl,{iddv:id},function(data){
				var getData=$.parseJSON(data);
				if(getData.length>0){
					if(getData[0].add>0){
						$("#btnAdd").show();
					}else{
						$("#btnAdd").hide();
					}
					if(getData[0].upd>0){
						$("#btnUpd").show();
					}else{
						$("#btnUpd").hide();
					}
				}
			});
			jQuery.unblockUI();
		},
		error: function (){
			jQuery.unblockUI();
			alert('Có lỗi xảy ra');
		}
		
	});
}
function AddNew(){
	jQuery("#dvview").hide();
	jQuery("#dvaction").show();
	var iddv = jQuery('#iddv').val();
	var myUrl = "index.php?option=com_tochuc&controller=tochuc&task=viewadd&format=raw&iddv=" + iddv;
	jQuery.ajax({
		url: myUrl,
		type: 'POST',
		cache: false,
		beforeSend:function(){
	     	jQuery.blockUI({ message: '<h1 style="text-align:center;width:100%"><img  src="/components/com_tochuc/css/loading.gif" /> <br/>Đang tải dữ liệu...</h1>' });
	    },
	    data:"iddv = " + iddv,
		success: function(html){
	    	jQuery('#dvaction').html(html);
	    	jQuery.unblockUI();
	    },
		error: function (){
			jQuery("#mess").html("Lỗi!");
			jQuery.unblockUI();
		}
	});
}
//insert to chuc
function save(task){
	var container = $('div.container');
	//alert(jQuery("#frmHoso").serialize());return false;
	// validate the form when it is submitted
	var validator = $("#frmAdd").validate({  	
		errorContainer: container,
		errorLabelContainer: $("ol", container),
		wrapper: 'li',
		meta: "validate"
	});
	var url="index.php?option=com_tochuc&controller=tochuc&task=tochuc_SaveNew&format=raw";
	var ret=jQuery("#frmAdd").valid();
	$("#act").val(task);
	if(ret==false){
    	return false;
	}else{
		$.ajax({
			url: url,
			type: 'POST',
			cache: false,
			beforeSend:function(){
		     	jQuery.blockUI({ message: '<h1 style="text-align:center;width:100%"><img  src="/components/com_tochuc/css/loading.gif" /> <br/>Đang tải dữ liệu...</h1>' });
		    },
			data: jQuery("#frmAdd").serialize(),
			success: function(string){
//				alert(string);return false;
				goInsList();
				jQuery.unblockUI();
			},
			error: function (){
				jQuery("#mess").html("Lỗi cập nhật!");
				jQuery.unblockUI();
			}
		});
	}
}
//update to chuc
function viewUpdate(iddv){
	if(iddv == 0){
		iddv = $("#iddv").val();
	}
	if(iddv>0){
		jQuery("#dvview").hide();
		jQuery("#dvaction").show();
		var myUrl = "index.php?option=com_tochuc&controller=tochuc&task=viewupd&format=raw&iddv=" + iddv;
		jQuery.ajax({
			url: myUrl,
			type: 'POST',
			cache: false,
			beforeSend:function(){
		     	jQuery.blockUI({ message: '<h1 style="text-align:center;width:100%"><img  src="/components/com_tochuc/css/loading.gif" /> <br/>Đang tải dữ liệu...</h1>' });
		    },
		    data:"iddv = " + iddv,
			success: function(html){
		    	jQuery('#dvaction').html(html);
		    	jQuery.unblockUI();
		    },
			error: function (){
				jQuery("#mess").html("Lỗi!");
				jQuery.unblockUI();
			}
		});
	}else{
		alert("Chọn 1 đơn vị để chỉnh sửa!");
		return false;
	}
}
function changeCbx(){
	jQuery("#INS_LOAIHINH").change(function(){
		var val=$(this).val();
		changeINS_LH(val);
	});
	jQuery('#INS_CAP').change(function(){
		var val=$(this).val();
		changeISN_CAP(val);
	});
	jQuery("#LOAIHINHBIENCHE").change(function(){
		val=$(this).val();
		changeLHBC(val);
	});
}
//fun khi change cbx ins loai hinh
function changeINS_LH(val){
	$("#INS_CAP option").remove();
	if(val==1){
		$("#INS_CAP").append("<option value=''></option>");
		$("#INS_CAP").append("<option value='1'>Sở, Ban, Ngành</option>");
		$("#INS_CAP").append("<option value='2'>Chi cục</option>");
		$("#INS_CAP").append("<option value='3'>UBND cấp Huyện</option>");
		$("#INS_CAP").append("<option value='4'>UBND cấp Xã</option>");
	}else if(val==2){
		$("#INS_CAP").append("<option value=''></option>");
		$("#INS_CAP").append("<option value='5'>Đơn vị đảm bảo kinh phí hoạt động</option>");
		$("#INS_CAP").append("<option value='6'>Đơn vị đảm bảo một phần kinh phí hoạt động</option>");
		$("#INS_CAP").append("<option value='7'>Đơn vị được giao toàn bộ kinh phí hoạt động</option>");
	}
}
//fun khi change cbx ins cap
function changeISN_CAP(val){
	$("#INS_LOAIHINH2 option").remove();
	//ubnd cấp huyện
	if(val==3){
		$(".loaihinh2").show();
		$("#INS_LOAIHINH2").append("<option value=''></option>");
		$("#INS_LOAIHINH2").append("<option value='1'>UBND quận</option>");
		$("#INS_LOAIHINH2").append("<option value='2'>UBND huyện</option>");
	}else if(val==4){//cấp xã
		$(".loaihinh2").show();
		$("#INS_LOAIHINH2").append("<option value=''></option>");
		$("#INS_LOAIHINH2").append("<option value='3'>UBND xã</option>");
		$("#INS_LOAIHINH2").append("<option value='4'>UBND phường</option>");
	}else{
		$("#INS_LOAIHINH2").val('');
		$(".loaihinh2").hide();
	}
}
//fun khi change cbx loai hinh bien che
function changeLHBC(val){
	var url="index.php?option=com_tochuc&controller=tochuc&task=getgiaobc&format=raw";
	var val,iserror=0,getData='',len;
	$.post(url,{id:val},function(data){
		try{
			getData= $.parseJSON(data);
		}catch(e){
			iserror=1;
		}
		if(iserror==0){
			len=getData.length;
			$("#GIAO_BC option").remove();
			$("#GIAO_BC").append("<option value=''></option>");
			for(i=0;i<len;i++){
				$("#GIAO_BC").append("<option value='"+getData[i].id+"'>"+getData[i].name+"</option>");
			}
		}
	});
}
//hien thị form treeview
function viewFace(layout){
	var url="index.php?option=com_tochuc&controller=tochuc&task=viewFace&format=raw";
	$.facebox({
		closeImage:'<?php echo JURI::base(true) ; ?>/components/com_tochuc/css/facebox/loading.gif'
		},function() {
		$.post(url,{layout:layout}, function(data) { 
				$.facebox(data); 
		});
	});
}
function backTC(){
	alert(jQuery("#id").val());
	location.href='index.php?option=com_tochuc';
}
function update(task){
	var container = $('div.container');
	//alert(jQuery("#frmHoso").serialize());return false;
	// validate the form when it is submitted
	var validator = $("#frmCapNhat").validate({  	
		errorContainer: container,
		errorLabelContainer: $("ol", container),
		wrapper: 'li',
		meta: "validate"
	});
	var url="index.php?option=com_tochuc&controller=tochuc&task=tochuc_SaveNew&format=raw";
	var ret=jQuery("#frmCapNhat").valid();
	$("#act").val(task);
	if(ret==false){
    	return false;
	}else{
		$.ajax({
			url: url,
			type: 'POST',
			cache: false,
			beforeSend:function(){
		     	jQuery.blockUI({ message: '<h1 style="text-align:center;width:100%"><img  src="/components/com_tochuc/css/loading.gif" /> <br/>Đang tải dữ liệu...</h1>' });
		    },
			data: jQuery("#frmCapNhat").serialize(),
			success: function(string){
//				alert(string);return false;
				goInsList();
				jQuery.unblockUI();
			},
			error: function (){
				jQuery("#mess").html("Lỗi cập nhật!");
				jQuery.unblockUI();
			}
		});
	}
}
function goInsList(){
	var id = jQuery('#iddv').val();
	viewDonVi(id);
}

function delTC(){
	var iddv = jQuery('#iddv').val();
	if(iddv<0){
		alert("Vui lòng chọn 1 đơn vị để xóa!");
		return false;
	}else{
		if(confirm('Bạn có chắc chắn muốn xóa?')){
			jQuery('#task').val('delToChuc');
			jQuery('#frmMain').submit();
		}
	}
}