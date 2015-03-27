
function openEmp(pagcurrent,limit,is18tuoi){	
	var url_='', hoten = '', namhuong = 0, thanghuong = 0, namsinh = 0, nhom = '', phuong = 0;
	var name=jQuery("#txtSearch").val();
	jQuery("#cbxLimit").val(limit);
	jQuery("#pagcurrent").val(pagcurrent);
	hoten = jQuery("#hoten").val();
	namhuong = jQuery("#namhuongsearch").val();
	thanghuong = jQuery("#thanghuongsearch").val();
	namsinh = jQuery("#namsinh").val();
	nhom = jQuery("#nhomsearch").val();
	phuong = jQuery("#phuong").val();
	var cbxLimit = jQuery("#cbxLimit").val();
	var start = (pagcurrent)*limit;
	params='';
	//hoten='Nguyễn Thị Nuôi';
	if(hoten!=null&&hoten!=""){
		params+='hoten=' + hoten+'&';
	}
	if(namhuong!='0'){
		params+='namhuong=' + namhuong + '&';
	}
	if(thanghuong!='0'){
		params+='thanghuong=' + thanghuong + '&';
	}
	if(namsinh!=null&&namsinh!=""){
		params+='namsinh=' + namsinh + '&';
	}
	if(phuong!='0'){
		params+='phuong=' + phuong + '&';
	}
	if(nhom!="0"){
		params+='nhom=' + nhom + '&';
	}
	params+='limit=' + limit;
	params+='&start=' + start;	
	var len;
//	alert('hoten=' + hoten + '&namhuong=' + namhuong + '&thanghuong=' + thanghuong + '&namsinh=' + namsinh + '&nhom=' + nhom + '&phuong=' + phuong);return;
	if(is18tuoi == 'yes'){
		var myUrl="index.php?option=com_hoso&controller=tren18tuoi&task=getHoSo&format=raw";
	}else{
		var myUrl="index.php?option=com_hoso&controller=nhom&task=getHoSo&format=raw";
	}	
//	alert('start ' + start + 'count ' +limit);
	jQuery.ajax({
		url: myUrl,
		type: 'POST',
		cache: false,		
		data:params,
		//data:'hoten=' + hoten + '&namhuong=' + namhuong + '&thanghuong=' + thanghuong + '&namsinh=' 
			//+ namsinh + '&nhom=' + nhom + '&phuong=' + phuong +'&limit=' + limit + '&start=' + start,
		success: function(string){			
			//jQuery("#hoten").val(string);
			var getData;
			try{
				getData = jQuery.parseJSON(string);
			}catch(e){
				getData = '';
			} 
			len = getData.length;
			jQuery("#bdhoso").html('');
			jQuery("#dvpage").html('');
			if(len){
				for(rowindex=0;rowindex<len;rowindex++){
					var nsnam = '',nsnu = '',thangtruylinh = '',tientruylinh = '',thangchamlinh = '', tienchamlinh = '';
					stt = start+rowindex+1;
					if(getData[rowindex].sothangtruylinh){
						thangtruylinh = getData[rowindex].sothangtruylinh;
					}
					if(getData[rowindex].sotientruylinh){
						tientruylinh = getData[rowindex].sotientruylinh;
					}
					if(getData[rowindex].sothangchamlinh){
						thangchamlinh = getData[rowindex].sothangchamlinh;
					}
					if(getData[rowindex].sotienchamlinh){
						tienchamlinh = getData[rowindex].sotienchamlinh;
					}
					str="<tr class='row"+(rowindex%2)+"'>"+
							"<td align='center'>"+(stt)+"</td>"+
							"<td><input id='cb"+rowindex+"' type='checkbox'  name='cid[]' value='"+getData[rowindex].id+"'></td>"+
							"<td>"+getData[rowindex].hoten+"</td>"+
							"<td align='center'>" + getData[rowindex].nam + "</td>"+
							"<td>" + getData[rowindex].nu + "</td>"+
							"<td>"+getData[rowindex].todp+"</td>"+
							"<td>"+getData[rowindex].soqd+"</td>"+
							"<td>"+getData[rowindex].nhom+"</td>"+
							"<td align='right'>"+getData[rowindex].sotientrocap+"</td>"+
							"<td align='center'>"+getData[rowindex].name+"</td>"+
							"<td align='center'>"+thangtruylinh+"</td>"+
							"<td align='center'>"+tientruylinh+"</td>"+
							"<td align='center'>"+thangchamlinh+"</td>"+
							"<td align='center'>"+tienchamlinh+"</td>"+
						"</tr>";
					jQuery("#bdhoso").append(str);
					
				}//end for rowindex
				if(is18tuoi == 'yes'){
					myUrl = "index.php?option=com_hoso&controller=tren18tuoi&task=getCountHoSo&format=raw";
				}else{
					myUrl = "index.php?option=com_hoso&controller=nhom&task=getCountHoSo&format=raw";
				}
				jQuery.ajax({
					url: myUrl,
					type: 'POST',
					cache: false,
					data:'hoten=' + hoten + '&namhuong=' + namhuong + '&thanghuong=' + thanghuong + '&namsinh=' 
						+ namsinh + '&nhom=' + nhom + '&phuong=' + phuong +'&limit=' + limit + '&pagcurrent=' + pagcurrent,
					success: function(data){
//					alert(data);
						var pagcurr = jQuery("#pagcurrent").val();
						var numberpag = parseInt(data/cbxLimit);
						var mod = data%cbxLimit;
						if(mod>0){
							numberpag+=1;
						}
						if(numberpag>0){
							var fist,last,end;
							fist=parseInt(pagcurr)-5;
							if(fist<1) fist=1;
							//hien thi 10 trang
							last=fist+9;
							if(last>(numberpag-1)) last=numberpag;
							//neu trang hien tai la trang dau tien 
							if(pagcurr==0){
								jQuery("#dvpage").append("<span style='padding:4px 10px;margin:2px;background: #fff;color:red;border: solid 1px #eee'>Đầu tiên</span>");
								jQuery("#dvpage").append("<span style='padding:4px 10px;margin:2px;background: #fff;color:red;border: solid 1px #eee'>Trước</span>");
							}else{
								jQuery("#dvpage").append("<a onclick='openEmp(0,"+cbxLimit+")' href='#'>Đầu tiên</a>");
								jQuery("#dvpage").append("<a onclick='prevnextpage(\"prev\")' href='#'>Trước</a>");
							}
							
							for(page=fist;page<=last;page++){
								if(pagcurr==(page-1)){
									jQuery("#dvpage").append("<span style='padding:4px 10px;margin:2px;background: #fff;color:red;border: solid 1px #eee'>"+page+"</span>");
								}else{
									jQuery("#dvpage").append("<a href='#' onclick='openEmp("+(page-1)+","+cbxLimit+")'>"+page+"</a>");
								}
							}
							//neu trang hien tai la trang cuoi cung
							if(pagcurr==numberpag-1){
								jQuery("#dvpage").append("<span style='padding:4px 10px;margin:2px;background: #fff;color:red;border: solid 1px #eee'>Sau</span>");
								jQuery("#dvpage").append("<span style='padding:4px 10px;margin:2px;background: #fff;color:red;border: solid 1px #eee'>Cuối cùng</span>");
							}else{
								jQuery("#dvpage").append("<a onclick='prevnextpage(\"next\")' href='#'>Sau</a>");
								jQuery("#dvpage").append("<a onclick='openEmp("+(numberpag-1)+","+cbxLimit+")' href='#'>Cuối cùng</a>");
							}
							
							if(parseInt(len)<limit){
								 end=parseInt(len);
							}else{
								end=parseInt(limit);
							}
							jQuery("#dvpage").append("<div style='padding:10px;font-weight:bold'>Hiển thị "+(start+1)+" đến "+(parseInt(start)+end)+" của "+parseInt(data)+" nhân viên</div>");
						}
					}
				});//end post*/
			}//	if(len)
		},
		error: function (){
			alert('Có lỗi xảy ra');
		}
	});
}

function prevnextpage(action){
	var pagg;
	if(action=='prev'){
		pagg=parseInt(jQuery("#pagcurrent").val())-1;
	}else{
		pagg=parseInt(jQuery("#pagcurrent").val())+1;
	}
	openEmp(pagg,jQuery("#cbxLimit").val());
	
}
function searchEmp(){
	var iddv=jQuery("#iddv").val();
	var dept_code=jQuery("#phong_id").val();
	var status=jQuery("#status").val();
	openId(iddv,dept_code,status,0,parseInt(jQuery("#cbxLimit").val()));	
}

function chkAllEmp(){
	var chk=jQuery("#chkAll").attr('checked');
	jQuery('.chkEmp').attr('checked',chk);
}
function callback() {
	jQuery("#searchResults > tr").hover(function() {
		jQuery(this).find("td").toggleClass("background");
	});
}
function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}
function isDouble(value)
{
    var loi = true;
    var i;
    if(value.length==0){
    	return loi;
    }
    for (i = 0; i < value.length; i++)
    {
        var char_sdt = value.charAt(i); 
       
        if (!isNaN(char_sdt))
        {
        }
        else if ((char_sdt == '.') || (char_sdt == ','))
        {
        }
        else
        {
            loi = false;
            break;
        }
    }
    return loi;
}
function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
		if (i==2) {this[i] = 29}
   } 
   return this
}
function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++){   
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}
function testDateVN( dtStr ){
	var dtCh= "/";
	var minYear = 1900;
	var maxYear = (new Date).getFullYear();
	if(dtStr=='' || dtStr=='__/__/____') return true;
	if(dtStr!=''&& dtStr.indexOf(dtCh)>0 && dtStr.indexOf(dtCh,dtStr.indexOf(dtCh)+1)>0
			&& dtStr.indexOf(dtCh,dtStr.indexOf(dtCh)+1) < (dtStr.length - 2)
			){
		//return true;
		var daysInMonth = DaysArray(12);
		var pos1=dtStr.indexOf(dtCh);
		var pos2=dtStr.indexOf(dtCh,pos1+1);
		var strDay=dtStr.substring(0,pos1);
		var strMonth=dtStr.substring(pos1+1,pos2);
		var strYear=dtStr.substring(pos2+1);
		strYr=strYear;
		if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1);
		if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1);
		for (var i = 1; i <= 3; i++) {
			if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1);
		}
		month=parseInt(strMonth);
		day=parseInt(strDay);
		year=parseInt(strYr);
		
		if (pos1==-1 || pos2==-1){		
			return false;
			
		}
		if (strMonth.length<1 || month<1 || month>12){
			return false;
		}
		if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
			return false;
		}
		if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
			return false;
		}
		
		if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
			return false;
		}	
		return true;
	}else{
		return false;
	}
	
}