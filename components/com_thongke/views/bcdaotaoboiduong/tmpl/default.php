<?php
/**
 * Author: Phucnh
 * Date created: Apr 15, 2015
 * Company: DNICT
 */
?>
<div id="tab_thongkenhucau" class="tab-pane active">
	<div>
		<h5 class="header smaller lighter blue">
			<?php echo $this->root_info['root_name']?>
			<span class="pull-right inline">
				<a data-original-title="Thêm mới" class="btn btn-small btn-primary" id="btn_hienthi_thongkencdt" style="margin-right: 5px;" data-toggle="modal" data-target=".modal">
					<i class="icon-search"></i> Hiển thị
				</a>
				<span data-original-title="Xóa" class="btn btn-small btn-success" id="btn_exel_thongkencdt" style="margin-right: 5px;" data-placement="top" title="">
					<i class="icon-download"></i> Xuất excel
				</span>
	        </span>
		</h5>
	</div>
	<div class="row-fluid">
	   	<div class="span4">
	   		<div id="caydonvi_moi" style="overflow:auto; height: 200px;"> CÂY ĐƠN VỊ </div>
	    </div>
	   	<div class="span8">
	   		<h4 style="text-align:center;" class="blue header"><i class="icon-star blue"></i> Thống kê đào tạo bồi dưỡng cán bộ công chức</h4>
	   		<div class="row-fluid">
	   			<div class="span6 widget-container-span">
					<div class="widget-box transparent">
						<div class="widget-header">
							<h5 class="smaller">Thời gian</h5>
						</div>
						<div class="widget-body">
							<div class="widget-main padding-6">
								<div>
									<h5>
										Từ <input style="width:85px" name="tungay" value="<?php echo date("d/m/Y")?>" id="tungay" class="date mask"> 
										đến <input style="width:85px" name="denngay" value="<?php echo date("d/m/Y")?>" id="denngay" class="date mask">
									</h5>
								</div>
							</div>
						</div>
					</div>
				</div>
		   	</div>
	   	</div>
  	</div>
</div>
<h5 class="row-fluid header smaller lighter blue">
	<span>Hiển thị nội dung thống kê</span>
</h5>
<div id="thongke_ketqua" style="min-height:300px;"></div>
<script type="text/javascript">
var text = function(txt, data){
	var dt= txt+'<td style="text-align:center;">'+data.cunhan_ctri+'</td><td style="text-align:center;">'+data.caocap_ctri+'</td><td style="text-align:center;">'+data.trungcap_ctri+'</td><td style="text-align:center;">'+data.socap_ctri+'</td><td style="text-align:center;">'+data.qlnn_cvcc+'</td>';
	dt +='<td style="text-align:center;">'+data.qlnn_cvc+'</td><td style="text-align:center;">'+data.qlnn_cv+'</td><td style="text-align:center;">'+data.qlnn_cansu+'</td><td style="text-align:center;">'+data.cm_tiensi+'</td><td style="text-align:center;">'+data.cm_thacsi+'</td>';
	dt +='<td style="text-align:center;">'+data.cm_daihoc+'</td><td style="text-align:center;">'+data.cm_caodang+'</td><td style="text-align:center;">'+data.cm_trungcap+'</td><td style="text-align:center;">'+data.cm_socap+'</td>';
	dt +='<td style="text-align:center;">'+data.chuyenmon+'</td><td style="text-align:center;">'+data.quanly+'</td><td style="text-align:center;">'+data.tiengdantoc+'</td><td style="text-align:center;">'+data.khac+'</td>';
	dt +='<td style="text-align:center;">'+data.qphong_tong+'</td>';
	dt +='<td style="text-align:center;">'+data.tong_ngoaingu+'</td><td style="text-align:center;">'+data.tong_tinhoc+'</td><td style="text-align:center;">'+data.tongso+'</td><td style="text-align:center;">'+data.thieuso+'</td>';
	dt +='<td style="text-align:center;">'+data.nu+'</td>';
	return dt;
}
jQuery(document).ready(function($){
	$(document).ajaxStart(function() {
        $.blockUI();
    });

	$(document).ajaxStop(function() {
	    $.unblockUI();
	});
	var id;
	$('.date').datepicker({
		format: 'dd/mm/yyyy', 
        "autoclose": true
    });
    $('.mask').mask('39/19/2999');
	$("#caydonvi_moi").jstree({
		   		"plugins" : ["themes","json_data","checkbox","types","ui","cookies"],
		   		"json_data" : {
		  		"data" : [{ "attr" : { "id" : "<?php echo $this->root_info['root_id'];?>"},
		     	"state" : "closed",
		     	"data" : {
		       	"title" : "<?php echo $this->root_info['root_name'];?>",
		       	"attr" : { "href" : "#" }
		      }
		  }],
		  "ui": {
	            "select_limit": 3,
	        },
		  "ajax" : {
		   "url" : "<?php echo JURI::base(true);?>/index.php",
		   "data" : function (n) {
		    return {
		     "option" : "com_thongke",                            
		     "view" : "treeview",
		     "task" : "treeDaotaoboiduong",
		     "format" : "raw",                            
		     "id" : n.attr ? n.attr("id").replace("node_","") : + root_id
		    };
		   }
		  }
		  },
		  "checkbox": {
              two_state: true,
              override_ui: false,
              real_checkboxes:true,
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
		    	"check_node" : function (node) {
		        	$('#caydonvi_moi').jstree('uncheck_all');
		            return true;
		          },
		          "uncheck_node" : function (node) {
		            return true;
		          }
		    }
		   }
		  }  
		 }).bind("select_node.jstree", function (e, data) {
				id = data.rslt.obj.attr("id").replace("node_","");
				type = data.rslt.obj.attr('rel');
				if(type == "file" || type == "folder" || type == undefined)
					return 0;
				else{
					data.inst.toggle_node(data.rslt.obj)	;
				}
			 });
	$('#tungay').on('change', function(){
		var a_arr 		= ($("#denngay").val()).split('/');
        var b_arr 		= ($(this).val()).split('/');
        var start 	= a_arr[2]+a_arr[1]+a_arr[0];
	     var end	= b_arr[2]+b_arr[1]+b_arr[0];
	     var tmp = start - end;
	     if(($("#denngay").val()!="")  && $(this).val()!=""){
		     if (tmp>=0) {}
		     else {alert('Thời gian không hợp lệ'); $(this).val("");}
	     } 
	});
	$('#denngay').on('change', function(){
		var a_arr 		= ($("#tungay").val()).split('/');
        var b_arr 		= ($(this).val()).split('/');
        var start 	= a_arr[2]+a_arr[1]+a_arr[0];
	     var end	= b_arr[2]+b_arr[1]+b_arr[0];
	     var tmp = start - end;
	     if(($("#tungay").val()!="")  && $(this).val()!=""){
		     if (tmp<=0) {}
		     else {alert('Thời gian không hợp lệ'); $(this).val("");}
	     }  
	});
	$('#sidebar').addClass('menu-min');
	$('#module-left').hide();
	$('#btn_hienthi_thongkencdt').on('click', function(){
		var donvi_id_checked;
		$("#caydonvi_moi").jstree("get_checked",null,true).each(function () {
			donvi_id_checked= this.id.replace("node_","");
    	});
    	if(donvi_id_checked>0){
			var tungay = $('#tungay').val();
			var denngay = $('#denngay').val();
			if (tungay!=null || tungay!="" || denngay!=null || denngay!=""){
				var str='';
				str +='<table class="table table-striped table-bordered dataTable tblDaotaoboiduong" id="tblDaotaoboiduong">';
				str +='<thead>';
				str +='<tr>';
				str +='<th rowspan="3">TT</th>';
				str +='<th style="min-width:200px; text-align:center;" rowspan="3" colspan="2">Đối tượng</th>';
				str +='</tr>';
				str +='<tr>';
				str +='<th style="text-align:center;" colspan="4">Lý luận chính trị</th>'; 
				str +='<th style="text-align:center;" colspan="4">Quản lý nhà nước</th>'; 
				str +='<th style="text-align:center;" colspan="6">Chuyên môn</th>';
				str +='<th style="text-align:center;" colspan="4">Bồi dưỡng ngắn hạn</th>'; 
				str +='<th style="text-align:center;" rowspan="2">QP-AN</th>';
				str +='<th style="text-align:center;" rowspan="2">Ngoại ngữ</th>';
				str +='<th style="text-align:center;" rowspan="2">Tin học</th>';
				str +='<th style="text-align:center;" rowspan="2">Tổng số</th>';
				str +='<th style="text-align:center;" colspan="2">Trong đó	</th>';
				str +='</tr>';
				str +='<tr>';
				str +='<th>Cử nhân</th><th>Cao cấp</th><th>Trung cấp</th><th>Sơ cấp</th>';
				str +='<th>CV cao cấp</th><th>CV chính</th><th>Chuyên viên</th><th>Cán sự</tH>';
				str +='<th>Tiến sĩ</th><th>Thạc sĩ</th><th>Đại học</th><th>Cao đẳng</th><th>Trung cấp</th><th>Sơ cấp</th>'; 
				str +='<th>Kiến thức, kỹ năng chuyên ngành</th><th>Kỹ năng lãnh đạo, quản lý</th>';
				str +='<th>Tiếng dân tộc</th><th>Khác</th>';
				str +='<th>Người dân tộc thiểu số</th><th>Nữ</th>';
				str +='</tr>';
				str +='</thead>';
				str +='<tbody>';
				str +='<tr id="dt1a"></tr>';
				str +='<tr id="dt1b"></tr>';
				str +='<tr id="dt1c"></tr>';
				str +='<tr id="dt1d"></tr>';
				str +='<tr id="dt2a"></tr>';
				str +='<tr id="dt2b"></tr>';
				str +='<tr id="dt2c"></tr>';
				str +='<tr id="dt2d"></tr>';
				str +='<tr id="dt2e"><td style="text-align:left;">Công chức tập sự</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td></tr>';
				str +='<tr id="dt3">';
				str +='<td  style="vertical-align:middle" >3</td><td colspan="2"  style="vertical-align:left">Công chức trong nguồn quy hoạch</td>';
				str +='<td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td><td style="text-align:center;">-</td>';
				str +='</tr>';
				str +='<tr id="dt4a"></tr>';
				str +='<tr id="dt4b"></tr>';
				str +='<tr id="dt4c"></tr>';
				str +='<tr id="dt5a"></tr>';
				str +='<tr id="dt5b"></tr>';
				str +='<tr id="dt6"></tr>';
				str +='<tr id="dtall"></tr>';
				str +='</tbody>';
				str +='</table>';
				$('#thongke_ketqua').html(str);
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay:tungay, denngay:denngay, target:1 ,condition:1},
		  			success:function(data){
		  				dt = text('<td rowspan="4"  style="vertical-align:middle">1</td><td rowspan="4" width="20%"  style="vertical-align:middle">Cán bộ, công chức lãnh đạo quản lý</td><td style="text-align:left;">Cấp tỉnh, thành phố</td>',data);
		  				$('#dt1a').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay:tungay, denngay:denngay, target:1 ,condition:2},
		  			success:function(data){
		  				dt = text('<td style="text-align:left;">Cấp sở & tương đương</td>',data);
		  				$('#dt1b').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay:tungay, denngay:denngay, target:1 ,condition:3},
		  			success:function(data){
		  				dt = text('<td style="text-align:left;">Cấp huyện và tương đương</td>',data);
		  				$('#dt1c').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay:tungay, denngay:denngay, target:1 ,condition:4},
		  			success:function(data){
		  				dt = text('<td style="text-align:left;">Cấp phòng và tương đương</td>',data);
		  				$('#dt1d').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay:tungay, denngay:denngay, target:2 ,condition:1},
		  			success:function(data){
		  				dt = text('<td rowspan="5" style="vertical-align:middle">2</td><td rowspan="5" width="20%"  style="vertical-align:middle">Các ngạch công chức</td><td style="text-align:left;">Chuyên viên cao cấp</td>',data);
		  				$('#dt2a').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay:tungay, denngay:denngay, target:2 ,condition:2},
		  			success:function(data){
		  				dt= text('<td style="text-align:left;">Chuyên viên chính</td>',data);
		  				$('#dt2b').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay:tungay, denngay:denngay, target:2 ,condition:3},
		  			success:function(data){
		  				dt= text('<td style="text-align:left;">Chuyên viên</td>',data);
		  				$('#dt2c').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay:tungay, denngay:denngay, target:2 ,condition:4},
		  			success:function(data){
		  				dt= text('<td style="text-align:left;">Cán sự</td>',data);
		  				$('#dt2d').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay:tungay, denngay:denngay, target:4 ,condition:1},
		  			success:function(data){
		  				dt= text('<td rowspan="3"  style="vertical-align:middle">4</td><td rowspan="3" width="20%"  style="vertical-align:middle">Đại biểu HĐND</td><td style="text-align:left;">Cấp thành phố</td>',data);
		  				$('#dt4a').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay:tungay, denngay:denngay, target:4 ,condition:2},
		  			success:function(data){
		  				dt= text('<td style="text-align:left;">Cấp quận, huyện</td>',data);
		  				$('#dt4b').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay:tungay, denngay:denngay, target:4 ,condition:3},
		  			success:function(data){
		  				dt= text('<td style="text-align:left;">Cấp xã</td>',data);
		  				$('#dt4c').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay:tungay, denngay:denngay, target:5 ,condition:1},
		  			success:function(data){
		  				dt= text('<td rowspan="2"  style="vertical-align:middle">5</td><td rowspan="2" width="20%"  style="vertical-align:middle">CBCC cấp xã</td><td style="text-align:left;">Cán bộ chuyên trách</td>',data);
		  				$('#dt5a').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay:tungay, denngay:denngay, target:5 ,condition:2},
		  			success:function(data){
		  				dt= text('<td style="text-align:left;">Công chức cấp xã</td>',data);
		  				$('#dt5b').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay:tungay, denngay:denngay, target:6 ,condition:3},
		  			success:function(data){
		  				dt= text('<td  style="vertical-align:middle">6</td><td colspan="2"  style="vertical-align:left">Những người hoạt động không chuyên trách</td>',data);
		  				$('#dt6').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay:tungay, denngay:denngay,target:0 },
		  			success:function(data){
		  				dt = text('<td  style="vertical-align:middle"></td><td colspan="2"  style="vertical-align:middle"><b>Cộng</b></td>', data);
		  				$('#dtall').html(dt);
		  			}
		        });
			}else { alert("Vui lòng chọn ngày tháng!");}
    	}else alert("Vui lòng chọn đơn vị!");
	});
	$('#btn_exel_thongkencdt').on('click', function(){
		var checked_ids = [];
		$("#caydonvi_moi").jstree("get_checked",null,true).each(function () {
            checked_ids.push(this.id.replace("node_",""));
    	});
		if(checked_ids.length>0){
			var tungay = $('#tungay').val();
			var denngay = $('#denngay').val();
			url= '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaoboiduong&format=xls&donvi_id='+checked_ids+'&tungay='+tungay+'&denngay='+denngay;
	  		document.location.assign(url);
		}else alert("Vui lòng chọn đơn vị");
	});
});
</script>