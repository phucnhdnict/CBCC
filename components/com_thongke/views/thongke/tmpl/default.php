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
table.dataTable thead .sorting, 
table.dataTable thead .sorting_asc, 
table.dataTable thead .sorting_desc {
    background : none;
}
</style>
<div>
	<h4 class="header lighter blue">
		Danh sách công chức <i class="icon-double-angle-right"></i><small><span id="tendonvi"></span></small>
	</h4>
</div>
<div id="tab_danhsach" role="tabpanel">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
        	<li class="active"> 
            	<a data-toggle="tab" href="#congchuc_tapsu_bonhiemngach">
              Công chức Tập sự được bổ nhiệm ngạch <span id="sl_cctsbnn"></span></a>
        	</li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane active" id="congchuc_tapsu_bonhiemngach">
				<div id="cctsbnn"> </div>
			</div>
		</div>
</div>
<div id="div_xemchitiet"></div>
<script type="text/javascript">
var donvi_id;
var type;
var date = function(dateObject) {
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
var refresh = function(){
	jQuery.blockUI();
	jQuery.ajax({
		type: 'POST',
		url: '<?php echo JUri::base(true)?>/index.php?option=com_thongke&view=thongke&format=raw&task=dsach_cctsbnn',
		data:{donvi_id: donvi_id},
		success: function(data){
			var xhtml='<div class="dataTables_wrapper">';
				xhtml+='<table role="grid" id="tbl_cctsbnn" class="table table-striped table-bordered table-hover dataTable">';
				xhtml+='<thead><tr>';
				xhtml+='<th style="vertical-align: middle;" class="center">Họ tên</th>';
				xhtml+='<th style="vertical-align: middle;" class="center">Ngày sinh</th>';
				xhtml+='<th style="vertical-align: middle;" class="center">Chức vụ</th>';
				xhtml+='<th style="vertical-align: middle;" class="center">Phòng</th>';
				xhtml+='<th style="vertical-align: middle;" class="center">Ngày tập sự</th>';
				xhtml+='<th style="vertical-align: middle;" class="center">Ngày bổ nhiệm vào ngạch</th>';
				xhtml+='<th style="vertical-align: middle;" class="center">Ngạch</th>';
				xhtml+='<th style="vertical-align: middle;" class="center">Bậc</th>';
				xhtml+='<th style="vertical-align: middle;" class="center">Hệ số</th>';
				xhtml+='</tr></thead><tbody>';
			for(i=0; i<data.length; i++){
				xhtml+='<tr>';
				xhtml+='<td><a style="cursor:pointer" idhoso="'+data[i].id+'" class="btn_edit_hoso">'+data[i].e_name+'</a></td>';
				xhtml+='<td>'+date(data[i].ngaysinh)+'</td>';
				xhtml+='<td>'+data[i].congtac_chucvu+'</td>';
				xhtml+='<td>'+data[i].congtac_phong+'</td><td>'+date(data[i].ngaytapsu)+'</td>';
				xhtml+='<td>'+date(data[i].ngaybonhiemngach)+'</td>';
				xhtml+='<td>'+data[i].luong_tenngach+'</td><td>'+data[i].luong_bac+'</td>';
				xhtml+='<td>'+data[i].luong_heso+'</td></tr>';
			}
			xhtml+='</tbody></table></div>';
			jQuery('#congchuc_tapsu_bonhiemngach').html(xhtml);
			jQuery('#sl_cctsbnn').html(' ('+data.length+')');
			var table = jQuery('#tbl_cctsbnn').DataTable({
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
									"mColumns": [ 0,1,2,3,4,5,6,7,8 ],
									"sFileName": "Congchuctapsubonhiemngach.xls",
									"oSelectorOpts": { filter: 'applied'},
								},
								{ 	"sExtends":"print",
									"bShowAll": false
								},
									
							]
			},
			"bSort": true,
		   	"columnDefs": [{
		   			"targets": [1,2,3,4,5,6,7,8],
		   			"orderable": true
					},
					{
						"targets": [0],
						"orderable": false
				}],
			"order": [[ 4, "asc" ]],
			 "stateSave": true,
			});
			jQuery.unblockUI();
		}
	});
}
jQuery(document).ready(function($){
	createTreeviewInMenuBar('Cây đơn vị');
	$('body').delegate('.btn_edit_hoso', 'click', function(){
		idhoso = $(this).attr('idhoso');
		$.blockUI();
		$.ajax({
			type: 'GET',
			url: '<?php echo JURI::base(true);?>/index.php?option=com_hoso&view=hoso&format=raw&task=hoso_detail',
			data: {idHoso : idhoso},
			success: function(data){
				$('#tab_danhsach').hide();
				$('#div_xemchitiet').html(data);
				$.unblockUI();
			}
		});
	});
	$('body').delegate('#btn_back_detail', 'click', function(){
		$('#div_xemchitiet').html('');
		$('#tab_danhsach').show();
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
		     "option" : "com_thongke",                            
		     "view" : "treeview",
		     "task" : "treeThongke",
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
			donvi_id = data.rslt.obj.attr("id").replace("node_","");
			type = data.rslt.obj.attr('rel');
			if(type == "file" || type == "folder" || type== undefined){
				$('#tendonvi').html($('.jstree-clicked').text());
				refresh();
			}else{
				data.inst.toggle_node(data.rslt.obj);
			}
		 });	
});

</script>