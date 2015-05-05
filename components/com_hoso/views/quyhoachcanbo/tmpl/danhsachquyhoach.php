<?php 
defined( '_JEXEC' ) or die( 'Truy cập không hợp lệ' );
$model = Core::model('Hoso/Quyhoachcanbo');
?>
<style>
#main-content-tree{
 height: 280px;
 overflow: auto;
}
table.dataTable thead .sorting, 
table.dataTable thead .sorting_asc, 
table.dataTable thead .sorting_desc {
    background : none;
}
</style>
<div id="tabQuyhoachcanbo">
</div>
<div class="modal fade" id="div-modal" style="width:900px; margin-left:-430px" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
		<div id="div_popup_quyhoachcanbo">
		</div>
 	</div>
  </div>
</div>
<div id="xemchitiet"></div>
<script>
var id;
var type;
var a = function(){
	jQuery.blockUI();	
	jQuery.ajax({
		url: '<?php echo JURI::base(true);?>/index.php?option=com_hoso&view=quyhoachcanbo&format=raw&task=ds_quyhoachcb&donvi_id='+id,
		type: "GET",
		cache: true,
		success: function(data) {
			// P them + update 050515
				var xhtml='<h3 class="header smaller lighter blue">';
					xhtml+='Danh sách quy hoạch cán bộ<span data-original-title="Xóa" class="btn btn-mini btn-danger pull-right inline" id="btn_remove_quyhoachcanbo" style="margin-right: 5px;" data-placement="top" title="">';
					xhtml+='<i class="icon-trash"></i> Xóa';
					xhtml+='</span>';
					xhtml+='<a data-original-title="Thêm mới" class="btn btn-mini btn-success pull-right inline" id="btn_add_quyhoachcanbo" style="margin-right: 5px;" data-toggle="modal" data-target=".modal">';
					xhtml+='<i class="icon-plus"></i> Thêm mới';
					xhtml+='</a>';
					xhtml+='</h3>';
					xhtml+='<div class="dataTables_wrapper">';
					xhtml+='<table class="table table-striped table-bordered table-hover dataTable" id="formQuyhoachcanbo" role="grid" aria-describedby="formNhucaudaotao_info">';
					xhtml+='<thead>';
					xhtml+='<tr role="row">';
					xhtml+='<th style="vertical-align: middle;" class="center"></th>';
					xhtml+='<th style="vertical-align: middle;width:100%" class="center">Họ và tên</th>';
					xhtml+='<th style="vertical-align: middle;" class="center">Ngày sinh</th>';
					xhtml+='<th style="vertical-align: middle;" class="center">Chức vụ hiện tại</th>';
					xhtml+='<th style="vertical-align: middle;" class="center">Phòng công tác</th>';
					xhtml+='<th style="vertical-align: middle;" class="center">Chức vụ quy hoạch</th>';
					xhtml+='<th style="vertical-align: middle;" class="center">Từ năm<input style="width:30px" class="dp" id="min_date"></th>';
					xhtml+='<th style="vertical-align: middle;" class="center">Đến năm<input style="width:30px" class="dp" id="max_date"></th>';
					xhtml+='<th style="vertical-align: middle;" class="center">Ngày đăng ký</th>';
					xhtml+='<th style="vertical-align: middle;" class="center">Ghi chú</th>';
					xhtml+='<th style="vertical-align: middle;" class="center"></th>';
					xhtml+='</tr>';
					xhtml+='</thead>';
					xhtml+='<tbody id="tbody_canhannhucaudaotao">';
					for(i=0; i< data.length; i++){
						if (data[i].phongcongtac==null)
							var phong=""; 
						else phong = data[i].phongcongtac;
	 					xhtml+='<tr>';
	 						xhtml+='<td style="vertical-align: middle;"><input type="checkbox" class="ckb_qhcb" value="'+data[i].id_qhcb+'" style="opacity:1"></td>';
	 						xhtml+='<td style="vertical-align: middle;"><a class="btn_view_hoso" idHoso="'+data[i].emp_id+'" style="cursor:pointer;">'+data[i].e_name+'</a></td>';
	 						xhtml+='<td style="vertical-align: middle;">'+jQuery.date(data[i].birth_date)+'</td>';
	 						xhtml+='<td style="vertical-align: middle;">'+data[i].position+'</td>';
	 						xhtml+='<td style="vertical-align: middle;">'+phong+'</td>';		
	 						xhtml+='<td style="vertical-align: middle;">'+data[i].positionQuyhoach+'</td>';		
	 						xhtml+='<td style="vertical-align: middle;">'+data[i].start_year+'</td>';		
	 						xhtml+='<td style="vertical-align: middle;">'+data[i].end_year+'</td>';		
	 						xhtml+='<td style="vertical-align: middle;" class="center">'+jQuery.date(data[i].date_created)+'</td>';
	 						xhtml+='<td style="vertical-align: middle;">'+data[i].ghichu+'</td>';
	 						xhtml+='<td style="vertical-align: middle;"><span class="btn btn-mini btn-info btn_edit_quyhoachcanbo" data-toggle="modal"  data-target=".modal" role="button" id_qhcb="'+data[i].id_qhcb+'" data-original-title="Điều chỉnh" title="Điều chỉnh">';
	 						xhtml+='<i class="icon-edit"></i>';
 							xhtml+='</span>';
							xhtml+='</td>';
							xhtml+='</tr>';
					}
					 xhtml+='</tbody></table></div>';
			jQuery('#tabQuyhoachcanbo').html(xhtml);
			var table = jQuery('#formQuyhoachcanbo').DataTable({
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
									"mColumns": [1,2,3,4,5,6,7,8],
									"sFileName": "Quyhoachcanbo.xls",
									"oSelectorOpts": { filter: 'applied'},
								},
								{ 	"sExtends":"print",
									"bShowAll": false
								},
									
							]
				},
				"bSort": true,
				"columnDefs": [
								{
									"targets": [1,2,3,4,5],
									"orderable": true
								},
								{
									"targets": [0,6,7,8,9],
									"orderable": false
								},
							],
			});
			jQuery('.dp').datepicker({
				format:'yyyy',
			    viewMode: "years", 
			    minViewMode: "years"
				}).on('changeDate', function (ev) {
				    jQuery(this).datepicker('hide');
				});
			jQuery('body').delegate('#min_date', 'change', function(){table.draw();});
	    	jQuery('body').delegate('#max_date', 'change', function(){table.draw();});
	    	jQuery('#min_date, #max_date').keyup( function() {
	    	        table.draw();
	    	    });
    	    // end
			jQuery.unblockUI();
		}
	  });
};
jQuery(document).ready(function($){
	//P thêm 050515
	$('body').delegate('.btn_view_hoso', 'click', function(){
		idhoso = $(this).attr('idhoso');
		$.blockUI();
		$.ajax({
			type: 'GET',
			url: '<?php echo JURI::base(true);?>/index.php?option=com_hoso&view=hoso&format=raw&task=hoso_detail',
			data: {idHoso : idhoso},
			success: function(data){
				$('#tabQuyhoachcanbo').hide();
				$('#xemchitiet').html(data);
				$.unblockUI();
			}
		});
	});
	$('body').delegate('#btn_back_detail', 'click', function(){
		$('#tabQuyhoachcanbo').show();
		$('#xemchitiet').html('');
	});
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
	$.fn.dataTableExt.afnFiltering.push(
			function( oSettings, aData, iDataIndex ) {
				var min_date = $('#min_date').val();
				var max_date = $('#max_date').val();
				var iStartDateCol = 6;
				var iEndDateCol = 7;
				var dbstart =aData[iStartDateCol]; // data start
				var dbend =aData[iEndDateCol]; // data end
				if ( min_date === "" && max_date === "" )
				{
				return true;
				}
				else if ((min_date <= dbstart && min_date<=dbend) && max_date === "") // min_date
				{
				return true;
				}
				else if ((min_date >= dbstart && min_date<=dbend) && max_date === "") // min_date
				{
				return true;
				}
				else if ((max_date >= dbend && max_date>=dbstart) && min_date === "") //max_date
				{
				return true;
				}
				else if ( min_date != "" && max_date != "" && min_date <= max_date && min_date<=dbend && max_date>=dbstart)
				{
				return true;
				}
			return false;
			}
			);
	// end
	createTreeviewInMenuBar('Cây đơn vị');
	$('body').delegate('#btn_add_quyhoachcanbo', 'click', function(){
		if(type == "file" || type == "folder" || type==undefined) 
			$('#div_popup_quyhoachcanbo').load('<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=quyhoachcanbo&format=raw&task=addQuyhoachcanbo&donvi_id='+id,function(){});
		else {alert('Vui lòng chọn đơn vị'); return false;}
	});
	$('body').delegate('.btn_edit_quyhoachcanbo', 'click', function(){ 
		var id_qhcb = $(this).attr('id_qhcb');
		$('#div_popup_quyhoachcanbo').load('<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=quyhoachcanbo&format=raw&task=editQuyhoachcanbo&id_qhcb='+id_qhcb+'&donvi_id='+id,function(){
		});
	});
	
	$('body').delegate('#btn_remove_quyhoachcanbo', 'click', function(){
		var arrQhcbDelete = [];
		$(".ckb_qhcb:checked").each(function() {
			arrQhcbDelete.push($(this).val());
		});
		if (arrQhcbDelete.length>0){
			if(confirm('BẠN CÓ CHẮC CHẮN XÓA?')){
				$.blockUI();
				var url = '<?php echo JUri::base(true);?>/index.php?option=com_hoso&controller=quyhoachcanbo&task=deleteQuyhoachcanbo&arrQhcbDelete='+arrQhcbDelete;
				$.post(url,  function(data){
					if(data == true){
						$.unblockUI();
						a();
						loadNoticeBoardSuccess('Thông báo','Xóa dữ liệu thành công!');
					}
					else{
						loadNoticeBoardError('Thông báo','Có lỗi xảy ra, vui lòng liên hệ quản trị viên.');
					}
				});
			}
		}
		else alert("Vui lòng chọn quá trình cần xóa!!");
	});
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
		     "controller" : "treeview",
		     "view" : "treeview",
		     "task" : "treequyhoach",
		     "format" : "raw",                            
		     "id" : n.attr ? n.attr("id").replace("node_","") : + root_id
		    };
		   }
		  }
		  },
		  "checkbox":{
		   "two_state": true,
// 		    real_checkboxes: true,
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
			if(type == "file" || type == "folder" || type==undefined)
				a();				
			else{
				data.inst.toggle_node(data.rslt.obj);
			}
		 });
});
</script>
