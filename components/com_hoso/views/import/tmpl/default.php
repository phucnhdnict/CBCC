<?php
/**
 * Author: Phucnh
 * Date created: Mar 19, 2015
 * Company: DNICT
 */ 
defined( '_JEXEC' ) or die( 'Truy cập không hợp lệ' );
?>
<style>
#main-content-tree{
 height: 280px;
 overflow: auto;
}
</style>
<div>
	<h4 class="header lighter blue">
		Import thông tin CBCCVC
	</h4>
</div>
<div id="divimport">
	<div>
		Chọn tệp tin để upload: 
		<input type="file" id="fileupload" name="fileupload"/>
	</div>
	<div>
		<a data-original-title="Import" class="btn btn-small btn-primary" id="btn_import_fileupload" style="margin-right: 5px;">
			<i class="icon-upload"></i> Import
		</a>
	</div>
	<div id="ketqua">
</div>
</div>
<div id="danhsachimport">
</div>
<!-- Modal -->
<div id="div_xemchitiet"></div>
<script type="text/javascript">
var refresh = function() {
	jQuery.blockUI();
	jQuery.ajax({
	  	url: '<?php echo JURI::base(true);?>/index.php?option=com_hoso&controller=import&format=raw&task=danhsachImport',
	    type: "GET",
	    data: {donvi_id: id},
	    cache: true,
	    success: function(data) {
	    	xhtml = '<div class="dataTables_wrapper">';
	    	xhtml +='<table id="tbl" class="table table-striped table-bordered dataTable">';
	    	xhtml +='<thead>';
	    	xhtml +='<tr>';
	    	xhtml +='<th>Họ và tên</th>';
	    	xhtml +='<th>Ngày/Năm sinh</th>';
	    	xhtml +='<th>Giới tính</th>';
//		    	xhtml +='<th>ID Dân tộc</th>';
//		    	xhtml +='<th>ID Tình trạng hôn nhân</th>';
			xhtml +='<th>Địa chỉ</th>';
			xhtml +='<th>Di động</th>';
			xhtml +='<th>ĐT cơ quan</th>';
			xhtml +='<th>Email</th>';
			xhtml +='<th>YIM</th>';
// 			xhtml +='<th>Mã số BHXH</th>';
// 			xhtml +='<th>Mã số thuế</th>';
// 			xhtml +='<th>ID tỉnh (thành)</th>';
// 			xhtml +='<th>ID quận (huyện)</th>';
// 			xhtml +='<th>ID phường (xã)</th>';
// 			xhtml +='<th>ID Loại hình biên chế</th>';
// 			xhtml +='<th>Ngày bắt đầu</th>';
//		    	xhtml +='<th>Ngày kết thúc</th>';
//				xhtml +='<th>ID Hình thức tuyển dụng(nếu loại hình là Biên chế hành chính)</th>';
//				xhtml +='<th>ID Thời hạn hợp đồng(nếu loại hình là Hợp đồng trong chỉ tiêu)</th>';
//				xhtml +='<th>Số quyết định</th>';
//				xhtml +='<th>Cơ quan ra quyết định</th>';
//				xhtml +='<th>Ngày ban hành</th>';
//				xhtml +='<th>ID Hình thức hưởng ngạch</th>';
//				xhtml +='<th>Mã ngạch</th>';
//				xhtml +='<th>Bậc</th>';
//				xhtml +='<th>Vượt khung (%)</th>';
//				xhtml +='<th>Ngày hưởng lương</th>';
//				xhtml +='<th>Thời điểm nâng lương lần sau tính từ</th>';
//				xhtml +='<th>Số tiền được hưởng</th>';
			xhtml +='<th>Đơn vị</th>';
			xhtml +='<th>Phòng</th>';
//				xhtml +='<th>Ngày bắt đầu</th>';
//				xhtml +='<th>ID Chức vụ</th>';
			xhtml +='<th>Tên chức vụ</th>';
			xhtml +='<th>Ngày công bố chức vụ</th>';
//				xhtml +='<th>ID Hình thức phân công/ bổ nhiệm</th>';
//				xhtml +='<th>ID Cách thức bổ nhiệm</th>';
//				xhtml +='<th>ID Trình độ đào tạo</th>';
//				xhtml +='<th>ID trường</th>';
//				xhtml +='<th>ID chuyên ngành</th>';
//				xhtml +='<th>Năm tốt nghiệp</th>';
//				xhtml +='<th>ID Hình thức đào tạo</th>';
//				xhtml +='<th>ID Nước đào tạo</th>';
//				xhtml +='<th>ID Loại tốt nghiệp</th>';
//				xhtml +='<th>Ngày kết nạp</th>';
//				xhtml +='<th>Ngày chính thức</th>';
//				xhtml +='<th>Số thẻ đảng</th>';
//				xhtml +='<th>ID Chức vụ Đảng</th>';
//				xhtml +='<th>Ngày bắt đầu chức vụ Đảng</th>';
//				xhtml +='<th>Tên tổ chức Đảng đang sinh hoạt</th>';
			xhtml +='<th>Ghi chú</th>';
			xhtml +='<th>Thao tác</th>';
			xhtml +='</tr>';
			xhtml +='</thead><tbody>';
	    	for(i=0; i<data.length; i++){
	    		xhtml +='<tr>';
	    		xhtml +='<td>'+data[i].hoten+'</td>';
	    		xhtml +='<td>'+jQuery.date(data[i].ngaysinh)+'</td>';
	    		if (data[i].gioitinh =='Nam')
	    		xhtml +='<td>Nam</td>';
	    		else
	    			xhtml +='<td>Nữ</td>'; 
//		    		xhtml +='<td>'+data[i].nat_code+'</td>';
//		    		xhtml +='<td>'+data[i].married_fk+'</td>';
	    		xhtml +='<td>'+data[i].per_residence+'</td>';
	    		xhtml +='<td>'+data[i].mobile+'</td>';
	    		xhtml +='<td>'+data[i].phone_work+'</td>';
	    		xhtml +='<td>'+data[i].email+'</td>';
	    		xhtml +='<td>'+data[i].yim+'</td>';
//		    		xhtml +='<td>'+data[i].maso_bhxh+'</td>';
//		    		xhtml +='<td>'+data[i].maso_thue+'</td>';
//		    		xhtml +='<td>'+data[i].cadc_code+'</td>';
//		    		xhtml +='<td>'+data[i].dist_placebirth+'</td>';
//		    		xhtml +='<td>'+data[i].comm_placebirth+'</td>';
//		    		xhtml +='<td>'+data[i].bienche_hinhthuc_id+'</td>';
//		    		if (data[i].bienche_ngaybatdau!='0000-00-00')
//		    		xhtml +='<td>'+$.date(data[i].bienche_ngaybatdau)+'</td>';else xhtml +='<td></td>';
//		    		if (data[i].bienche_ngayketthuc!='0000-00-00')
//		    		xhtml +='<td>'+$.date(data[i].bienche_ngayketthuc)+'</td>';else xhtml +='<td></td>';
//		    		xhtml +='<td>'+data[i].bienche_hinhthuctuyendung_id+'</td>';
//		    		xhtml +='<td>'+data[i].bienche_thoihanbienchehopdong_id+'</td>';
//		    		xhtml +='<td>'+data[i].bienche_soquyetdinh+'</td>';
//		    		xhtml +='<td>'+data[i].bienche_coquanquyetdinh+'</td>';
//		    		if (data[i].bienche_ngaybanhanh!='0000-00-00')
//		    		xhtml +='<td>'+$.date(data[i].bienche_ngaybanhanh)+'</td>';else xhtml +='<td></td>';
//		    		xhtml +='<td>'+data[i].luong_hinhthuc_id+'</td>';
//		    		xhtml +='<td>'+data[i].luong_mangach+'</td>';
//		    		xhtml +='<td>'+data[i].luong_bac+'</td>';
//		    		xhtml +='<td>'+data[i].luong_vuotkhung+'</td>';
//		    		xhtml +='<td>'+data[i].luong_ngaybatdau+'</td>';
//		    		if (data[i].luong_ngaynangluongtieptheo!='0000-00-00')
//		    		xhtml +='<td>'+$.date(data[i].luong_ngaynangluongtieptheo)+'</td>';else xhtml +='<td></td>';
//		    		xhtml +='<td>'+data[i].money_sal+'</td>';
	    		xhtml +='<td>'+data[i].tendonvi+'</td>';
	    		xhtml +='<td>'+data[i].tenphong+'</td>';
//		    		if (data[i].congtac_ngaybatdau!='0000-00-00')
//		    		xhtml +='<td>'+$.date(data[i].congtac_ngaybatdau)+'</td>';else xhtml +='<td></td>';
//		    		xhtml +='<td>'+data[i].congtac_chucvu_id+'</td>';
	    		xhtml +='<td>'+data[i].congtac_chucvu+'</td>';
	    		if (data[i].congtac_chucvu_ngaycongbo!='0000-00-00')
	    		xhtml +='<td>'+jQuery.date(data[i].congtac_chucvu_ngaycongbo)+'</td>';else xhtml +='<td></td>';
//		    		xhtml +='<td>'+data[i].whois_pos_mgr_id+'</td>';
//		    		xhtml +='<td>'+data[i].cachthucbonhiem_id+'</td>';
//		    		xhtml +='<td>'+data[i].chuyenmon_trinhdo_code+'</td>';
//		    		xhtml +='<td>'+data[i].chuyenmon_truong_id+'</td>';
//		    		xhtml +='<td>'+data[i].chuyenmon_chuyennganh_id+'</td>';
//		    		xhtml +='<td>'+data[i].chuyenmon_namtotnghiep+'</td>';
//		    		xhtml +='<td>'+data[i].chuyenmon_hinhthucdaotao_id+'</td>';
//		    		xhtml +='<td>'+data[i].chuyenmon_nuocdaotao+'</td>';
//		    		xhtml +='<td>'+data[i].chuyenmon_loaitotnghiep_id+'</td>';
//		    		if (data[i].party_j_date!='0000-00-00')
//		    		xhtml +='<td>'+$.date(data[i].party_j_date)+'</td>';else xhtml +='<td></td>';
//		    		if (data[i].party_date!='0000-00-00')
//		    		xhtml +='<td>'+$.date(data[i].party_date)+'</td>';else xhtml +='<td></td>';
//		    		xhtml +='<td>'+data[i].sothedangvien+'</td>';
//		    		xhtml +='<td>'+data[i].dang_chucvudang_id+'</td>';
//		    		if (data[i].start_date_ctd!='0000-00-00')
//		    		xhtml +='<td>'+$.date(data[i].start_date_ctd)+'</td>';else xhtml +='<td></td>';
//		    		xhtml +='<td>'+data[i].donvidang_ctd+'</td>';
	    		xhtml +='<td>'+data[i].ghichu+'</td>';
	    		xhtml +='<td><span class="btn btn-mini btn-info btn_xemchitiet" data-toggle="modal"  data-target=".modal" style="cursor: pointer;" id_import="'+data[i].id+'" ><i class="icon-save"></i></span></td>';
	    		xhtml +='</tr>';
	    	}
	    	xhtml+='</tbody></table></div>';
	    	jQuery('#danhsachimport').html(xhtml);
	    	jQuery.unblockUI();
	    	var table = jQuery('#tbl').DataTable({
	   			"lengthMenu": [[10, 20, 50, 100,-1], [10, 20, 50, 100, "Tất cả"]],
	   			"oLanguage": {
	               "sUrl": "/media/cbcc/js/dataTables.vietnam.txt"
				},
	           	"sDom": "<'dataTables_wrapper'<'clear'><'row-fluid'<'span3'f><'span3'<'pull-right'T>><'span6'p>t<'row-fluid'<'span2'l><'span4'i><'span6'p>>>",
	    		"oTableTools": {
	   			"sSwfPath": "/media/cbcc/js/dataTables-1.10.0/swf/copy_csv_xls_pdf.swf",		
	   			"aButtons": [
	   							{
	   								"sExtends": "xls",
	   								"sButtonText": "Excel",
	   								"mColumns": [ 0,1,2,3,4,5,6 ],
	   								"sFileName": "danhsachimport.xls",
		   							"oSelectorOpts": { filter: 'applied'},
	   							},
	   							{ 	"sExtends":"print",
	   								"bShowAll": false
	   							},
	   						]
	    		},
	    		"bSort": false,
	   		});
	    }
	  });
};
jQuery(document).ready(function($){
	createTreeviewInMenuBar('Cây đơn vị');
	$("#main-content-tree").jstree({
		   "plugins" : ["themes","json_data","types","ui","cookies"],
		   "json_data" : {
		  "data" : [{ "attr" : { "id" : "<?php echo $this->root_info['root_id'];?>"},
		     "state" : "closed",
		     "data" : {
		       "title" : "<?php echo $this->root_info['root_name'];?>",
		       "attr" : { "href" : "#" }
		      }
		  }],
		  "ajax" : {
		   "url" : "<?php echo JURI::base(true);?>/index.php",
		   "data" : function (n) {
		    return {
		     "option" : "com_hoso",                            
		     "controller" : "import",
		     "view" : "treeview",
		     "task" : "treeImportHoso",
		     "format" : "raw",                            
		     "id" : n.attr ? n.attr("id").replace("node_","") : + root_id
		    };
		   }
		  }
		  },
		  "checkbox":{
		   "two_state": true,
//		    real_checkboxes: true,
		   "override_ui": false
		  },
		  "types" : {
		   "valid_children" : [ "root" ],
		   "types" : {
		    "file" : {
		     "icon" : { 
		      "image" : "<?php echo JUri::root(true);?>/media/cbcc/js/jstree/file.png" 
		     }                 
		    },
		    "folder" : {
		     "icon" : { 
		      "image" : "<?php echo JUri::root(true);?>/media/cbcc/js/jstree/folder.png" 
		     }
		    },
		    "default" : {
		     "valid_children" : [ "default" ]
		    }
		   }
		  }  
		 }).bind("select_node.jstree", function (e, data) {
			id = data.rslt.obj.attr("id").replace("node_","");
			type = data.rslt.obj.attr('rel');
			type = data.rslt.obj.attr('rel');
			if(type == "file" || type == "folder")
				refresh();				
			else{
				data.inst.toggle_node(data.rslt.obj);
			}
		 });
	$('#btn_import_fileupload').on('click',function(){
		var filefullname = $('#fileupload').val();
		var file_data = $('#fileupload').prop('files')[0];  
		var form_data = new FormData();                  
	    form_data.append('file', file_data);
		if (filefullname=="") 
			{alert('Vui lòng chọn tệp tin');}
		else{
			if ((isExcel(filefullname)) && ((filefullname.split(".").length - 1)==1)){
				$.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=uploadcbcc',
		  			data: form_data,
		  			dataType: 'text', 
	                cache: false,
	                contentType: false,
	                processData: false,
		  			success:function(data){
			  			$('#ketqua').html(data);
			  			refresh();
		  			}
		        });
			}
			else alert('Tập tin không hợp lệ!\n Các loại tập tin được hỗ trợ: xls, xlsx, csv.\n Vui lòng chọn lại file!!!');
		}
	});

	function getExtension(filename) {
	    var parts = filename.split('.');
	    return parts[parts.length - 1];
	}

	function isExcel(filename) {
	    var ext = getExtension(filename);
	    switch (ext.toLowerCase()) {
	    case 'xls':
	    case 'xlsx':
	    case 'csv':
	        return true;
	    }
	    return false;
	}
	$.date = function(dateObject) {
	    var d = new Date(dateObject);
	    var day = d.getDate();
	    var month = d.getMonth() + 1;
	    var year = d.getFullYear();
	    if (day < 10) {
	        day = "0" + day;
	    }
	    if (month < 10) {
	        month = "0" + month;
	    }
	    var date = day + "/" + month + "/" + year;

	    return date;
	};
	
	$('body').delegate('.btn_xemchitiet', 'click', function(){
		var id_import = $(this).attr('id_import');
		$.blockUI();
		$('#div_xemchitiet').load('<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=thongtinImport&id_import='+id_import,function(){
			$('#danhsachimport').css("display","none");
			$('#divimport').css("display","none");
			$.unblockUI();
		});
	});
	$('body').delegate('#cadc_code', 'change', function(){
		var cadc_code = $(this).val(); 
		$.ajax({
			type: 'POST',
			url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=changeCadc',
			data: { cadc_code : cadc_code},
			success:function(data){
				$('#div_dist_placebirth').html(data);
				$('#div_comm_placebirth').html('<select id="comm_placebirth" class="chosen" name="comm_placebirth"><option value="">--Chọn phường/xã--</option></select>');
				$('.chosen').chosen();
			}
		});
	});
	
	$('body').delegate('#dist_placebirth', 'change', function(){
		var dist_placebirth = $(this).val(); 
		$.ajax({
			type: 'POST',
  			url: '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=import&format=raw&task=changeDist',
  			data: {dist_placebirth:dist_placebirth},
  			success:function(data){
	  			$('#div_comm_placebirth').html(data);
	  			$('.chosen').chosen();
  			}
        });
	});
	$('.date-picker').datepicker({format: 'dd/mm/yyyy', "autoclose":true});
	$('.datepicker').css('zIndex', 999999);
});
</script>