var showDanhsachLophocSapmo = function(){
	jQuery.ajax({
		type: 'POST',
		url: 'index.php?option=com_daotao&view=lophoc&format=raw&task=listSapmo',
		data: {},
		success: function(data){
			if(data != ''){
				var str = '';
				jQuery.each(data,function(i,val){
					str+= '<tr>';
					str+= '<td class="center" style="vertical-align:middle;">';
					str+= '<input type="checkbox" name="id_lh_sapmo[]" value="' + val.id + '"><span class="lbl"></span>';
					str+= '</td>';
					str+= '<td class="center" style="vertical-align:middle;">' + val.ngaybatdau + '</td>';
					str+= '<td class="center" style="vertical-align:middle;">' + val.ngayketthuc + '</td>';
					str+= '<td class="center" style="vertical-align:middle;">' + val.code + '</td>';
					str+= '<td class="center" style="vertical-align:middle;">' + val.name + '</td>';
					str+= '<td class="center" style="vertical-align:middle;">' + val.thongtinlophoc + '</td>';
					str+= '<td class="center" style="vertical-align:middle;">' + val.noidaotao + '</td>';
					str+= '<td class="center" style="vertical-align:middle;text-align:right">';
					str+= '<div class="btn-group">';
					// Nếu là người khởi tạo hoặc được phân quyền thì mới dc edit
					if(val.hieuchinh == '1'){
						str+= '<span class="btn btn-mini btn-primary btn_edit_lophoc_sapmo" id_quatrinh="' + val.id + '" data-rel="tooltip" title="Điều chỉnh">';
						str+= '<i class="icon-edit"></i>';
						str+= '</span>';
					}
					
//					str+= '<span><a href="#myModalUser" class="btn btn-mini btn-warning btn_register_lophoc" id_quatrinh="' + val.id + '" data-rel="tooltip" title="Đăng ký">';
					str+= '<a href="#myModalUser" role="button" class="btn btn-mini btn-success btn-chonnguoi" lophoc_id ="'+val.id+'" data-toggle="modal" data-rel="tooltip" data-placement="top" title="Đăng ký">';
					str+= '<i class="icon-pencil"></i>';
					str+= '</a>';
					str+= '<span class="btn btn-mini btn-info btn_detail_lophocsapmo" lophoc_idsm="' + val.id + '" data-rel="tooltip" title="Chi tiết">';
					str+= '<i class="icon-zoom-in"></i>';
					str+= '</span>';
					str+= '</div>';
					str+= '</td>';
					str+= '</tr>';
				});
				jQuery('#tbody_ds_sapmo').html(str);
				jQuery('[data-rel=tooltip]').tooltip();
			}
		}
	});
};
var checkDonvi = function(){
	var slect_donvi = jQuery('.cboDonvi');
	var input_socb = jQuery('input[name="donvi[donvi_id][]"]');
	var total_array = slect_donvi.length;
	var flag = true;
	for(i = 0; i < total_array; i++){
		flag = flag && ((slect_donvi.val() == '')?false:true);
		flag = flag && ((input_socb.val() == '')?false:true);
	}
	return flag;
};