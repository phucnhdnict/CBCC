<?php 
defined( '_JEXEC' ) or die( 'Truy cập không hợp lệ' );
$model = Core::model('Hoso/Quyhoachcanbo');
?>
<style>
#main-content-tree{
 height: 280px;
 overflow: auto;
}
</style>
<div id="tabQuyhoachcanbo" class="tab-pane active">
</div>
<div class="modal fade" id="div-modal" style="width:900px;margin-left:-430px" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
		<div id="div_popup_quyhoachcanbo">
			
		</div>
 	</div>
  </div>
</div>
<script>
var id;
var type;
var a = function(){
	jQuery.blockUI();	
	jQuery.ajax({
		url: '<?php echo JURI::base(true);?>/index.php?option=com_hoso&controller=quyhoachcanbo&format=raw&task=ds_quyhoachcb&donvi_id='+id,
		type: "GET",
		cache: true,
		success: function(html) {
			jQuery('#tabQuyhoachcanbo').html(html);
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
									"mColumns": [ 0,1,2,3,4,5,6 ],
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
									"targets": [1,2,3,4,5,6,7,8,9],
									"orderable": true
								},
								{
									"targets": [0],
									"orderable": false
								},
							],
			});
			jQuery.unblockUI();
		}
	  });
};
jQuery(document).ready(function($){
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
				var url = '<?php echo JUri::base(true);?>/index.php?option=com_hoso&view=quyhoachcanbo&format=raw&task=deleteQuyhoachcanbo&arrQhcbDelete='+arrQhcbDelete;
				$.post(url,  function(data){
				});
				$.unblockUI();
				a();
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
