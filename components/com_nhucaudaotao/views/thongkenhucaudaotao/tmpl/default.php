<?php
/**
 * Author: Phucnh
 * Date created: Jan 23, 2015
 * Company: DNICT
 */ 
$thongke = $this->thongke;
?>
<ul id="myTab" class="nav nav-tabs">
	<li class="active">	
		<a href="#tab_thongkenhucau" data-tab-url="/index.php?option=com_nhucaudaotao&controller=thongkenhucaudaotao&task=default&format=raw" data-toggle="tab" class="loaded">
            Thống kê nhu cầu đào tạo</a>
	</li>
</ul>
<div class="tab-content">
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
		   		<div id="caydonvi_moi" style="overflow:auto"> CÂY ĐƠN VỊ </div>
		    </div>
		   	<div class="span8">
		   		<h4 style="text-align:center;" class="blue header"><i class="icon-star blue"></i> Thống kê nhu cầu đào tạo</h4>
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
											Từ <input style="width:85px" name="tungay"  id="tungay" class="date"> 
											đến <input style="width:85px" name="denngay" value="<?php echo date("d/m/Y")?>" id="denngay" class="date">
										</h5>
									</div>
								</div>
							</div>
						</div>
					</div>
			   		<!-- <div class="span6 widget-container-span">
						<div class="widget-box transparent">
							<div class="widget-header">
								<h5 class="smaller">Mức độ thống kê</h5>
							</div>
							<div class="widget-body">
								<div class="widget-main padding-6">
									<div>
										<select style="width:250px;" size="5" name="exp_lev_congchuc">
								          	<option selected="" value="0">Chỉ báo cáo các đơn vị được chọn</option>
								          	<option value="1">Mở rộng xuống 1 cấp</option>
								          	<option value="2">Mở rộng xuống 2 cấp</option>
											<option value="3">Mở rộng xuống 3 cấp</option>
											<option value="10">Hiển thị báo cáo tất cả tổ chức</option>				          
							          </select>  
									</div>
								</div>
							</div>
						</div>
					</div>-->
		   		</div>
	   		</div>
  		</div>
	</div>
	<h5 class="row-fluid header smaller lighter blue">
      	<span>Hiển thị nội dung thống kê</span>
	</h5>
	<div id="ketquathongke" ></div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	$(document).ajaxStart(function() {
        $.blockUI();
    });

	$(document).ajaxStop(function() {
	    $.unblockUI();
	});
	var id;
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	today = dd+'/'+mm+'/'+yyyy;
	$('.date').datepicker({
		format: 'dd/mm/yyyy', 
        "autoclose": true
    });
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
		  "ajax" : {
		   "url" : "<?php echo JURI::base(true);?>/index.php",
		   "data" : function (n) {
		    return {
		     "option" : "com_nhucaudaotao",                            
		     "view" : "treeview",
		     "task" : "treethongkenhucau",
		     "format" : "raw",                            
		     "id" : n.attr ? n.attr("id").replace("node_","") : + root_id
		    };
		   }
		  }
		  },
		  "checkbox": {
              two_state: true,
              override_ui: false,
              real_checkboxes:false,
              real_checkboxes_names:function(n){
                  return ["id_donvithongkencdt[]", n.attr("id").replace("node_","")]
                  }
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
		 });
	$('#btn_exel_thongkencdt').on('click', function(){
		var checked_ids = [];
		$("#caydonvi_moi").jstree("get_checked",null,true).each(function () {
            checked_ids.push(this.id.replace("node_",""));
    	});
		if(checked_ids.length>0){
			var tungay = $('#tungay').val();
			var denngay = $('#denngay').val();
			url= '<?php echo JUri::base(true);?>/index.php?option=com_nhucaudaotao&view=thongkenhucaudaotao&format=xls&donvi_id='+checked_ids+'&tungay='+tungay+'&denngay='+denngay;
	  		document.location.assign(url);
		}else alert("Phải chọn đơn vị rồi mới hiển thị");
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
	$('#btn_hienthi_thongkencdt').on('click', function(){
		var checked_ids = []; 
		$("#caydonvi_moi").jstree("get_checked",null,true).each(function () {
            checked_ids.push(this.id.replace("node_",""));
    	});
    	if(checked_ids.length>0){
			hienthithead();
			var tungay = $('#tungay').val();
			var denngay = $('#denngay').val();
			var xhtml;
	        $.ajax({
				type: 'POST',
	  			url: '<?php echo JUri::base(true);?>/index.php?option=com_nhucaudaotao&view=thongkenhucaudaotao&format=raw&task=hienthithongke',
	  			data: { donvi_id : checked_ids, tungay : tungay, denngay : denngay},
	  			success:function(data){
	  	  			for(var i=0; i< data.length; i++){
	  	  	  			if(typeof data[i][0].tiensi !='undefined'){
	  						xhtml +='<tr>';
	  		  				xhtml +='<td class="center">'+(i+1)+'</td><td>'+data[i][0].donvi_name+'</td><td>'+data[i][0].tong+'</td><td>'+data[i][0].tiensi+'</td>';
	  		  				xhtml +='<td>'+data[i][0].thacsi+'</td><td>'+data[i][0].daihoc+'</td><td>'+data[i][0].caodang+'</td>';
	  		  				xhtml +='<td>'+data[i][0].trungcap+'</td><td>'+data[i][0].conlai+'</td><td>'+data[i][0].cunhan_ctri+'</td>';
	  		  				xhtml +='<td>'+data[i][0].caocap_ctri+'</td><td>'+data[i][0].trungcap_ctri+'</td><td>'+data[i][0].trendaihoc_tinhoc+'</td><td>'+data[i][0].tccd_tinhoc+'</td>';
	  		  				xhtml +='<td>'+data[i][0].coso_tinhoc+'</td><td>'+data[i][0].trendaihoc_tienganh+'</td><td>'+data[i][0].tccd_tienganh+'</td><td>'+data[i][0].coso_tienganh+'</td>';
	  		  				xhtml +='<td>'+data[i][0].trendaihoc_nnkhac+'</td><td>'+data[i][0].tccd_nnkhac+'</td><td>'+data[i][0].coso_nnkhac+'</td>';
	  		  				xhtml +='<td>'+data[i][0].qlnn_cvcc+'</td><td>'+data[i][0].qlnn_cvc+'</td><td>'+data[i][0].qlnn_cv+'</td>';
	  		  				xhtml +='<td>'+data[i][0].qphong_12+'</td><td>'+data[i][0].qphong_3+'</td><td>'+data[i][0].qphong_45+'</td><td>'+data[i][0].khac+'</td>';
	  		  				xhtml +='</tr>';
	  		  				$('#tbody_thongkencdt').append(xhtml);
	  		  				xhtml='';
	  	  				}
	  	  			}
	  				
	  			}
	        });
    	}else alert("Phải chọn đơn vị rồi mới hiển thị");
	});
	function hienthithead(){
		var str='';
		str +='<table class="table table-striped table-bordered dataTable tblThongkencdt" id="tblThongkencdt">';
		str +='<thead>';
		str +='<tr>';
		str +='<th rowspan="3">STT</th>';
		str +='<th rowspan="3" style="min-width:200px; text-align:center;">Tên đơn vị</th>';
		str +='<th rowspan="3">Tổng số</th>';
		str +='<th colspan="25" style="text-align:center; height: 21px">Nhu cầu đào tạo</th>';
		str +='</tr>';
		str +='<tr>';
		str +='<th colspan="6" style="text-align:center;">Chuyên môn</th>';
		str +='<th colspan="3" style="text-align:center;">Lý luận chính trị</th>';
		str +='<th colspan="3" style="text-align:center;">Tin học</th>';
		str +='<th colspan="3" style="text-align:center;">Anh văn</th>';
		str +='<th colspan="3" style="text-align:center;">Ngoại ngữ khác</th>';
		str +='<th colspan="3" style="text-align:center;">Quản lý nhà nước</th>';
		str +='<th colspan="3" style="text-align:center;">Quốc phòng - An ninh</th>';
		str +='<th rowspan="2" style="text-align:center;">Khác</th>';
		str +='</tr>';
		str +='<tr>';
		str +='<th>Tiến sĩ</th><th>Thạc sĩ</th><th>Đại học</th><th>Cao đẳng</th><th>Trung cấp</th><th>Còn lại</th><th>Cử nhân</th><th>Cao cấp</th>';
		str +='<th>Trung cấp</th><th>Cử nhân trở lên</th><th>TC, CĐ</th><th>Cơ sở</th><th>Cử nhân trở lên</th><th>TC, CĐ</th><th>Cơ sở</th><th>Cử nhân trở lên</th>';
		str +='<th>TC, CĐ</th><th>Cơ sở</th><th>CVCC</th><th>CVC</th><th>CV</th><th>Đối tượng 1,2</th><th>Đối tượng 3</th><th>Đối tượng 4,5</th></tr>';
		str +='<tr>';
		str +='	<th></th>';
		str +='<th style="text-align:center;">A</th>';
		str +='<th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th><th>20</th><th>21</th><th>22</th><th>23</th><th>24</th><th>25</th><th>26</th>';
		str +='</tr>';
		str +='</thead>';
		str +='<tbody id="tbody_thongkencdt">';
		str +='	</tbody>';
		str +='</table>';
		$('#ketquathongke').html(str);
	}
});
</script>