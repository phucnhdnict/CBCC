<?php 
defined( '_JEXEC' ) or die( 'Truy cập không hợp lệ' );
$model = Core::model('Daotao/Nhucaudaotao');
?>
<div id="tabNhucaudaotao" class="tab-pane active">
</div>
<div class="modal fade" id="div-modal" style="width:900px;margin-left:-430px" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
        <div id="div_edit_tonghopthemmoi">
        </div>
    </div>
  </div>
</div>
<style>
#main-content-tree{
 height: 280px;
 overflow: auto;
}
</style>
<script>
var id;
var refreshData = function (){
	jQuery.blockUI();
	jQuery.ajax({
	  	url: '<?php echo JURI::base(true);?>/index.php?option=com_nhucaudaotao&controller=nhucaudaotao&format=raw&task=ds_nhucaudaotaotaidonvi&donvi_id='+id,
	    type: "GET",
	    cache: true,
	    success: function(data) {
		    xhtml = '';
		    xhtml+='<h3 class="header smaller lighter blue">';
			xhtml+='Danh sách đăng ký nhu cầu đào tạo';
			xhtml+='<span data-original-title="Xóa" class="btn btn-mini btn-danger pull-right inline" id="btn_remove_nhucaudaotao" style="margin-right: 5px;" data-placement="top" title="">';
			xhtml+='<i class="icon-trash"></i> Xóa';
			xhtml+='</span>';
			xhtml+='<a data-original-title="Thêm mới" class="btn btn-mini btn-success pull-right inline" id="btn_add_nhucaudaotao" style="margin-right: 5px;" data-toggle="modal" data-target=".modal">';
			xhtml+='<i class="icon-plus"></i> Thêm mới';
			xhtml+='</a>';
			xhtml+='</h3>';
			xhtml+= '<div class="dataTables_wrapper">';
		    xhtml+= '<table class="table table-striped table-bordered table-hover dataTable" id="formNhucaudaotao" role="grid" aria-describedby="formNhucaudaotao_info">';
		    xhtml+= '<thead>';
		    xhtml+= '<tr role="row">';
		    xhtml+= '<th style="vertical-align: middle;" class="center"></th>';
		    xhtml+= '<th style="vertical-align: middle;" class="center">Họ và tên</th>';
		    xhtml+= '<th style="vertical-align: middle;" class="center">Loại trình độ</th>';
		    xhtml+= '<th style="vertical-align: middle;" class="center">Chuyên ngành</th>';
		    xhtml+= '<th style="vertical-align: middle;" class="center">Trình độ</th>';
		    xhtml+= '<th style="vertical-align: middle; width:100px" class="center">Ngày đăng ký<br/><input class="datepicker" style="width:70px" id="min_date"><input style="width:70px"class="datepicker" id="max_date"></th>';
		    xhtml+= '<th style="vertical-align: middle;" class="center">Trạng thái</th>';
		    xhtml+= '<th style="vertical-align: middle;" class="center">Ngày xử lý</th>';
		    xhtml+= '</tr>';
		    xhtml+= '</thead>';
		    xhtml+= '<tbody id="tbody_canhannhucaudaotao">';
		    for(i=0;i<data.length;i++){
		    	var ngayxuly ='';
		 		if (data[i].trangthai ==1) { if(data[i].ngayxuly!="") ngayxuly = jQuery.date(data[i].ngayxuly);}
		 					xhtml +='<tr class="tr_nhucaudaotao" role="row">';
		 						xhtml+='<td style="vertical-align: middle;" class="center">';
                                                                    if (data[i].trangthai ==0) {
                                                                            xhtml+='<input type="checkbox" class="ckb_ncdt" style="opacity:99;position:relative;" value="'+data[i].id_ncdt+'">';
                                                                    } 
                                                                    xhtml+='</td>';
		 						xhtml +='<td style="vertical-align: middle;">'+data[i].e_name+'</td>';
		 						xhtml +='<td style="vertical-align: middle;">'+data[i].name_loaitrinhdo+'</td>';
		 						xhtml +='<td style="vertical-align: middle;">'+data[i].name_chuyennganh+'</td>';
		 						xhtml +='<td style="vertical-align: middle;">'+data[i].name_trinhdo+'</td>';		
		 						xhtml +='<td style="vertical-align: middle;" class="center">'+jQuery.date(data[i].ngaydangky)+'</td>';
		 						xhtml +='<td style="vertical-align: middle;">';
								if (data[i].trangthai ==0) {
		 								xhtml +='<span class="btn btn-mini lbl-info btn_xacnhan_nhucaudaotao" style="cursor: pointer;" id_ncdt="'+data[i].id_ncdt+'" ><i class="icon-save"></i> Xác nhận đã đào tạo</span>';
		 								xhtml +='<span class="btn btn-mini btn-info btn_hieuchinh_nhucaudaotao" data-toggle="modal"  data-target=".modal" role="button" id_ncdt="'+data[i].id_ncdt+'" data-original-title="Điều chỉnh" title="Điều chỉnh"><i class="icon-edit"> Điều chỉnh</i></span>';
		 								} else {
		 								xhtml +='<span class="label label-success"><i class="icon-ok"></i> Đã được đào tạo</span>';
		 								}
		 					xhtml +='</td>';
		 					xhtml +='<td style="vertical-align: middle;" class="center">'+ngayxuly+'</td>';
		 					xhtml +='</tr>';
			}
		    xhtml+= '</tbody></table></div>';
		    jQuery('#tabNhucaudaotao').html(xhtml);
	    	var table = jQuery('#formNhucaudaotao').DataTable({
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
	   								"sFileName": "Nhucaudaotao.xls",
		   							"oSelectorOpts": { filter: 'applied'},
	   							},
	   							{ 	"sExtends":"print",
	   								"bShowAll": false
	   							},
	   								
	   						]
	    		},
	    		"bSort": true,
	           	"columnDefs": [{
			   			"targets": [1,2,3,4,6,7],
			   			"orderable": true
	   				},
	   				{
		   				"targets": [0,5],
		   				"orderable": false
	   			}],
	    		"order": [[ 6, "asc" ]]
	   		});
	    	jQuery('.datepicker').datepicker( {format: 'dd/mm/yyyy'});
	    	jQuery('body').delegate('#min_date', 'change', function(){table.draw();});
	    	jQuery('body').delegate('#max_date', 'change', function(){table.draw();});
	    	jQuery('#min_date, #max_date').keyup( function() {
	    	        table.draw();
	    	    });
	    	jQuery.unblockUI();
	    }
	  });
};
jQuery(document).ready(function($){
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
			var iStartDateCol = 5;
			var iEndDateCol = 5;
			min_date=min_date.substring(6,10) + min_date.substring(3,5)+ min_date.substring(0,2);
			max_date=max_date.substring(6,10) + max_date.substring(3,5)+ max_date.substring(0,2);
			var datofini=aData[iStartDateCol].substring(6,10) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(0,2);
			var datoffin=aData[iEndDateCol].substring(6,10) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(0,2);
			if ( min_date === "" && max_date === "" )
			{
			return true;
			}
			else if ( min_date <= datofini && max_date === "")
			{
			return true;
			}
			else if ( max_date >= datoffin && min_date === "")
			{
			return true;
			}
			else if (min_date <= datofini && max_date >= datoffin)
			{
			return true;
			}
			return false;
			}
			);
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
		     "option" : "com_nhucaudaotao",                            
		     "view" : "treeview",
		     "task" : "treenhucautonghop",
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
			if(type == "file" || type == "folder")
				refreshData();				
			else{
				data.inst.toggle_node(data.rslt.obj);
			}
		 });
	 
	$('body').delegate('.btn_xacnhan_nhucaudaotao', 'click', function(){
		var id_ncdt = $(this).attr('id_ncdt');
		bootbox.dialog({
			message: "Bạn có chắc chắn xác nhận?",
			title: "Cảnh báo",
			buttons: {
			success: {
			label: "Hủy",
			className: "btn-danger",
			callback: function() {
			}
			},
			main: {
			label: "Đồng ý",
			className: "btn-primary",
			callback: function() {
				var url = '<?php echo JUri::base(true);?>/index.php?option=com_nhucaudaotao&view=nhucaudaotao&format=raw&task=updatestatusNhucaudaotao&id_ncdt='+id_ncdt;
				$.post(url, function(data){
					refreshData();
		            return false;
				});
			}
			}
			}
			}); 
		
	});
	// P bo sung 3/3/2015
	$('body').delegate('#btn_add_nhucaudaotao', 'click', function(){ 
		$('#div_edit_tonghopthemmoi').load('<?php echo JUri::base(true);?>/index.php?option=com_nhucaudaotao&view=nhucaudaotao&format=raw&task=tonghopthemmoi&donvi_id='+id,function(){
		});
	});
        
        $('body').delegate('.btn_hieuchinh_nhucaudaotao', 'click', function(){ 
		var id_ncdt = $(this).attr('id_ncdt');
		$('#div_edit_tonghopthemmoi').load('<?php echo JUri::base(true);?>/index.php?option=com_nhucaudaotao&view=nhucaudaotao&format=raw&task=tonghophieuchinh&id_ncdt='+id_ncdt+'&donvi_id='+id,function(){
		});
	});
        
	$('body').delegate('#id_loaitrinhdo', 'change', function(){
		$('#name_loaitrinhdo').val($('#id_loaitrinhdo').find('option:selected').text());
		$('#name_chuyennganh').val("");
		$('#name_trinhdo').val("");
		var iscn = $('option:selected', this).attr('iscn');
		var id_loaitrinhdo = $(this).val(); //code
		var loaitrinhdo_lim_code = $('option:selected', this).attr('lim_code');
		if (id_loaitrinhdo>0){
			if (iscn==1) {
				$('#div_id_trinhdo').hide();
				$.ajax({
		    		type: "POST",
		    		url : '<?php echo JUri::base(true);?>/index.php?option=com_nhucaudaotao&controller=nhucaudaotao&format=raw&task=getChuyennganhByLoaitrinhdo&loaitrinhdo_lim_code='+loaitrinhdo_lim_code,
		    		success:function(data){
		        			$('#div_id_chuyennganh').html('<div class="control-group"><label class="control-label" for="id_chuyennganh">Chuyên ngành đào tạo (<span style="color:red">*</span>)</label><div class="controls" >'+data+'</div></div>');
		        			$('#div_id_chuyennganh').show();
		        			$('#name_chuyennganh').val($('#id_chuyennganh').find('option:selected').text());
		    			}
		    	});
			}
			else{
				$('#div_id_chuyennganh').hide();
				$.ajax({
		    		type: "POST",
		    		url : '<?php echo JUri::base(true);?>/index.php?option=com_nhucaudaotao&controller=nhucaudaotao&format=raw&task=getTrinhdoByLoaitrinhdo&loaitrinhdo_lim_code='+id_loaitrinhdo,
		    		success:function(data){
		        			$('#div_id_trinhdo').html('<div class="control-group"><label class="control-label" for="id_trinhdo">Trình độ (<span style="color:red;">*</span>)</label><div class="controls">'+data+'</div></div>');
		        			$('#div_id_trinhdo').show();
		    			}
		    	});
			}	
		}else {
			$('#div_id_trinhdo').show();
			$('#div_id_trinhdo').html('<div class="control-group"><label class="control-label" for="id_trinhdo">Trình độ (<span style="color:red;">*</span>)</label><div class="controls"><input id="id_trinhdo" name="id_trinhdo" value="-1" type="hidden"><input type="text" name="name_trinhdoinput" id="name_trinhdoinput"></div></div>');
			$('#div_id_chuyennganh').show();
			$('#div_id_chuyennganh').html('<div class="control-group"><label class="control-label" for="id_chuyennganh">Chuyên ngành đào tạo (<span style="color:red">*</span>)</label><div class="controls" ><input id="id_chuyennganh" name="id_chuyennganh" value="-1" type="hidden"><input type="text" name="name_chuyennganhinput" id="name_chuyennganhinput"></div></div>');
		}
	});
	$('body').delegate('#id_chuyennganh', 'change', function(){
		var chuyennganh_lim_code = $(this).val();
		if (chuyennganh_lim_code>0){
			$.ajax({
	    		type: "POST",
	    		url : '<?php echo JUri::base(true);?>/index.php?option=com_nhucaudaotao&controller=nhucaudaotao&format=raw&task=getTrinhdoByChuyennganh&chuyennganh_lim_code='+chuyennganh_lim_code,
	    		success:function(data){
	        			$('#div_id_trinhdo').html('<div class="control-group"><label class="control-label" for="id_trinhdo">Trình độ (<span style="color:red;">*</span>)</label><div class="controls">'+data+'</div></div>');
	        			$('#div_id_trinhdo').show();
	        			$('#name_chuyennganh').val($('#id_chuyennganh').find('option:selected').text());
	    			}
	    	});
		}
		else $('#div_id_trinhdo').hide();
	});
	$('body').delegate('#id_trinhdo', 'change', function(){
		$('#name_trinhdo').val($('#id_trinhdo').find('option:selected').text());
	});
	$('body').delegate('#name_trinhdoinput', 'change', function(){
		$('#name_trinhdo').val($('#name_trinhdoinput').val());
	});
	$('body').delegate('#name_chuyennganhinput', 'change', function(){
		$('#name_chuyennganh').val($('#name_chuyennganhinput').val());
	});
        $('body').delegate('#btn_remove_nhucaudaotao', 'click', function(){
		var arrNcdtDelete = [];
		$(".ckb_ncdt:checked").each(function() {
			arrNcdtDelete.push($(this).val());
		});
		if (arrNcdtDelete.length>0){
			if(confirm('BẠN CÓ CHẮC CHẮN XÓA?')){
				$(".ckb_ncdt:checked").each(function() {
					$(this).closest('tr').remove();
					});
				var url = '<?php echo JUri::base(true);?>/index.php?option=com_nhucaudaotao&view=nhucaudaotao&format=raw&task=deleteNhucaudaotao&arrNcdtDelete='+arrNcdtDelete;
				$.post(url,  function(data){
				});
				refreshData();
			}
		}
		else alert("Vui lòng chọn quá trình cần xóa!!");
	});
});
</script>