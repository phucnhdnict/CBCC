'use strict';

var app = angular.module('search',['ui.select2','ngResource','ngGrid'])
.config(['$httpProvider','$locationProvider', function($httpProvider,$locationProvider) {
$httpProvider.defaults.useXDomain = true;
delete $httpProvider.defaults.headers.common['X-Requested-With'];
$httpProvider.defaults.transformRequest = function (data) {
    var str = [];
    //str.push('apikey' + '=' + 'w7xtc2ywfb');
    for (var p in data) {
        data[p] !== undefined && str.push(encodeURIComponent(p) + '=' + encodeURIComponent(data[p]));
    }
    //console.log(str);
    return str.join('&');
};
$httpProvider.defaults.headers.put['Content-Type'] = $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
//$locationProvider.html5Mode(false);
// $locationProvider.html5Mode(true).hashPrefix('!');
}]);
app.run(['$location', '$window', function($location, $window) {
//	/$window.moment.lang('vi');
}]);

//var app = angular.module('search',['ui.select2','ui.bootstrap','ngResource','infinite-scroll']);

function QuickSearchCtrl($scope,$http){
	$scope.isSubmit = false;
	$scope.loading = false;
	$scope.doExport = function(act){
		if(act=='EXCEL'){
			jQuery('#frmQuickSearch').attr('action','index.php?option=com_searchhs&controller=searchhs&task=resultExcelQuick&format=raw');
			jQuery('#frmQuickSearch').attr('method','POST');
			jQuery('#frmQuickSearch').attr('target','excelQuick');
			document.frmQuickSearch.submit();
		}		
	};
	
	$scope.doQuickSearch = function(form){
		$scope.isSubmit = false;
		$scope.loading = true;
		$http.post('index.php?option=com_searchhs&task=doQuickSearch&format=raw',form).success(function(data, status){		
			$scope.myData = data;
			console.log($scope.myData);
			var columnDefs = [
			                  {field:"e_name",displayName:"Họ và tên",cellTemplate: '<div><a href="index.php?option=com_hoso&y={{row.getProperty(\'id\')}}">{{row.getProperty(col.field)}}</a></div>'},
			                  {field:"birth_date",displayName:"Ngày sinh",cellTemplate: '<div class="text-algin">{{row.getProperty(col.field)}}</div>'},
			                  {field:"sta_name",displayName:"Tên ngạch",cellTemplate: '<div>{{row.getProperty(col.field)}}</div>'},
			                  {field:"sl_code",displayName:"Bậc lương",cellTemplate: '<div>{{row.getProperty(col.field)}}</div>'},
			                  {field:"sca_code",displayName:"Trình độ",cellTemplate: '<div>{{row.getProperty(col.field)}}</div>'},
			                  {field:"it_code",displayName:"Tin học",cellTemplate: '<div>{{row.getProperty(col.field)}}</div>'},
			                  {field:"eng_code",displayName:"Tiếng anh",cellTemplate: '<div>{{row.getProperty(col.field)}}</div>'},
			                  {field:"pub_code",displayName:"QLNN",cellTemplate: '<div>{{row.getProperty(col.field)}}</div>'},
			                  {field:"pol_code",displayName:"Chính trị",cellTemplate: '<div>{{row.getProperty(col.field)}}</div>'},
			                  {field:"loaihinh_code",displayName:"Loại hình",cellTemplate: '<div>{{row.getProperty(col.field)}}</div>'},
			                  {field:"dangvien",displayName:"Đảng viên",cellTemplate: '<div>{{row.getProperty(col.field)}}</div>'},
			                  {field:"position",displayName:"Chức vụ",cellTemplate: '<div>{{row.getProperty(col.field)}}</div>'},
			                  {field:"dept_code",displayName:"Phòng",cellTemplate: '<div>{{row.getProperty(col.field)}}</div>'},
			                  {field:"inst_code",displayName:"Đơn vị",cellTemplate: '<div>{{row.getProperty(col.field)}}</div>'},
			                  ];
			//var str='Họ và tên,Ngày sinh,Tên ngạch,Bậc lương,Trình độ,Tin học,Tiếng anh,QLNN,Chính trị,Loại hình,Đảng viên,Chức vụ,Phòng,Đơn vị';
			//var arrVal='e_name,birth_date,sta_name,sl_code,sca_code,it_code,eng_code,pub_code,pol_code,loaihinh_code,dangvien,position,dept_code,inst_code';
//			angular.forEach(response.columns, function(v,i) {				
//				if(i == 0){
//					//console.log(i);
//					columnDefs.push({field:v.value,displayName:v.text,cellTemplate: '<div class="ngCellText"><a href="index.php?option=com_hoso&y={{row.getProperty(\'id\')}}">{{row.getProperty(col.field)}}</a></div>'});
//				}else{
//					columnDefs.push({field:v.value,displayName:v.text});	
//				}
//				           	
//            });			
		    $scope.myOptions = { data: 'myData',
		    		columnDefs: columnDefs,
		    		rowHeight: 60,
		    		showGroupPanel: true,
		    		jqueryUIDraggable: true		    		
		    };
		    $scope.isSubmit = true;
		    $scope.loading = false;
		});
		return false;
	};

};
function FullSearchCtrl($scope,$http,$filter,$q,DanhmucService,Units,UnitWorked,SearchService,Users,$timeout){
	/** condition
	 * 'EQ'=>'='
	 * 'GE'=>'>='
	 * 'GT'=>'>'
	 * 'LE'=>'<='
	 * 'LT'=>'<'
	 */
	$scope.loading = false;
    $scope.result1 = '';
    $scope.options1 = null;
    $scope.details1 = '';
	$scope.info={};
	
	$scope.info.birth_date_condition_start='GE';
	$scope.info.birth_date_condition_end='LE';
	$scope.info.id_card_condition_start='GE';
	$scope.info.id_card_condition_end='LE';
	$scope.info.age_condition1='GE';
	$scope.info.age_condition2='LE';
	
	$scope.info.cadc_code='';
	$scope.info.dist_placebirth = '';
	$scope.info.city_peraddress = '';
	$scope.info.dist_peraddress = '';
	$scope.info.comm_placebirth = '';
	$scope.info.comm_peraddress = '';
	$scope.donvi = {};
	$scope.congtac = {};
	//$scope.congtac.date_hdxettuyen_condition_start ='EQ';
	$scope.congtac.bienche={};
	$scope.congtac.bienche.loaihinh={};
	$scope.congtac.bienche.chinhthuc={};
	$scope.congtac.bienche.khongchinhthuc={};
	$scope.congtac.hdxettuyen = {};
	$scope.congtac.hdthituyen = {};	
	$scope.congtac.hdthituyen.tapsu = {};
	$scope.congtac.hdthituyen.chinhthuc = {};
	$scope.congtac.hdvuviec = {};
	$scope.congtac.hdvuviec.batdau = {};
	$scope.congtac.hdvuviec.ketthuc = {};
	$scope.congtac.hdtrongchitieu = {};
	$scope.congtac.hdngoaichitieu = {};
	$scope.congtac.quatrinh = {};
	$scope.config = {};
	$scope.config.columns = [3,4,67];
	//$scope.congtac.hdvuviec.vuviec = {};
	//$scope.company.loaihinhbienche = [];
	$scope.inited = false;
	$scope.select2Options = {
		    placeholder: "Search for a movie",
		    minimumInputLength: 1	
		};
	$scope.$watch('info.cadc_code',function(newValue, oldValue) {
		if ( newValue !== oldValue && !angular.equals($scope.info.cadc_code, '') ) {
			$scope.cboNguyenquanQuanhuyen = DanhmucService.query({"collect":"quanhuyen",'cadc_code':$scope.info.cadc_code});			
		}
	});
	$scope.$watch('info.dist_placebirth',function(newValue, oldValue) {
		if ( newValue !== oldValue && !angular.equals($scope.info.dist_placebirth, '') ) {			
			$scope.cboNguyenquanPhuongxa = DanhmucService.query({"collect":"phuongxa",'dc_cadc_code':$scope.info.cadc_code,'dc_code':$scope.info.dist_placebirth});
		}
	});
	$scope.$watch('info.city_peraddress',function(newValue, oldValue) {
		if ( newValue !== oldValue && !angular.equals($scope.info.city_peraddress, '') ) {
			$scope.cboHokhauQuanhuyen = DanhmucService.query({"collect":"quanhuyen",'cadc_code':$scope.info.city_peraddress});
		}
	});
	$scope.$watch('info.dist_peraddress',function(newValue, oldValue) {
		if ( newValue !== oldValue && !angular.equals($scope.info.dist_peraddress, '') ) {
			$scope.cboHokhauPhuongxa = DanhmucService.query({"collect":"phuongxa",'dc_cadc_code':$scope.info.city_peraddress,'dc_code':$scope.info.dist_peraddress});
		}
	});
	/*
	 * Begin Tab Don Vi
	 */
    $scope.$watch('chkLoaihinhBienche', function(newval, oldval) {
        if (newval !== oldval) {
        	$scope.donvi.LOAIHINHBIENCHE = [];
            angular.forEach($filter('filter')(newval, {checked:true}), function(v) {
            	$scope.donvi.LOAIHINHBIENCHE.push(v.id);
                //console.log(v.code);
            });
        }
    }, true);
   
//    $scope.$watch('chkLoaihinhDonvi', function(newval, oldval) {
//        if (newval !== oldval) {
//        	$scope.donvi.loaihinhdonvi = [];
//            angular.forEach($filter('filter')(newval, {checked:true}), function(v) {
//            	$scope.donvi.loaihinhdonvi.push(v.id);
//                //console.log(v.code);
//            });
//        }
//    }, true);
    
    $scope.$watch('chkLoaihinhDonvi1', function(newval, oldval) {
        if (newval !== oldval) {
        	$scope.donvi.INS_LOAIHINH = [];  
            angular.forEach($filter('filter')(newval, {checked:true}), function(v) {
            	$scope.donvi.INS_LOAIHINH.push(v.id);
            });
            angular.forEach($filter('filter')(newval, {checked:false}), function(v) {            	
             	angular.forEach($filter('filter')($scope.chkCapDonvi, {type:v.id}), function(cap,i) {             
             		cap.checked=false;             	
                });
            });            
        }
    }, true);
    $scope.$watch('chkCapDonvi', function(newval, oldval) {
        if (newval !== oldval) {
        	$scope.donvi.INS_CAP = [];    
            angular.forEach($filter('filter')(newval, {checked:true}), function(v) {
            	$scope.donvi.INS_CAP.push(v.id);
            });           
            angular.forEach($filter('filter')(newval, {checked:false}), function(v) {            	
             	angular.forEach($filter('filter')($scope.chkLoaihinhDonvi2, {type:v.id}), function(cap,i) {             
             		cap.checked=false;             	
                });
            });      
        }
    }, true);
    $scope.$watch('chkLoaihinhDonvi2', function(newval, oldval) {
        if (newval !== oldval) {
        	$scope.donvi.INS_LOAIHINH2 = [];
            angular.forEach($filter('filter')(newval, {checked:true}), function(v) {
            	$scope.donvi.INS_LOAIHINH2.push(v.id);
                //console.log(v.code);
            });
        }
    }, true);
    $scope.$watch('chkchkGoiluong', function(newval, oldval) {
        if (newval !== oldval) {
        	$scope.donvi.GOILUONG = [];
            angular.forEach($filter('filter')(newval, {checked:true}), function(v) {
            	$scope.donvi.GOILUONG.push(v.id);
                //console.log(v.code);
            });
        }
    }, true);
    $scope.$watch('chkLinhvucphong', function(newval, oldval) {
        if (newval !== oldval) {
        	$scope.donvi.INS_LV = [];
            angular.forEach($filter('filter')(newval, {checked:true}), function(v) {
            	$scope.donvi.INS_LV.push(v.id);
                //console.log(v.code);
            });
        }
    }, true);    
    /*
     * End Tab Don vi
     */
    /*
	 * Begin Tab Cong tac
	 */
    $scope.$watch('chkBienche', function(newval, oldval) {
        if (newval !== oldval) {
        	$scope.congtac.bienche_code = [];
        	$scope.showBiencheChinhthuc = false;
        	$scope.showBiencheChuaChinhthuc = false;
        	$scope.showHopdongThuhut = false;
            angular.forEach($filter('filter')(newval, {checked:true}), function(v) {
            	$scope.congtac.bienche_code.push(v.id);
                //console.log(v.code);
            	if(v.id == 1){
            		$scope.showBiencheChinhthuc = true;	
            	}else if(v.id == 2){
            		$scope.showBiencheChuaChinhthuc = true;
            	}else if(v.id == 3){
            		$scope.showHopdongThuhut = true;
            	}           	
            });
            angular.forEach($filter('filter')(newval, {checked:false}), function(v) {
                angular.forEach($scope.chkBiencheChinhthuc, function(cap) {               	
                	cap.checked = false;                              	
                });
                angular.forEach($scope.chkBiencheChuaChinhthuc, function(cap) {               	
                	cap.checked = false;                              	
                });
            });
        }
    }, true);
    $scope.$watch('chkBiencheChinhthuc', function(newval, oldval) {
        if (newval !== oldval) {
        	$scope.congtac.loaihinh_code = [];
        	$scope.showHinhthucTuyendung = false;        	
            angular.forEach($filter('filter')(newval, {checked:true}), function(v) {
            	$scope.congtac.loaihinh_code.push(v.id);
                //console.log(v.code);
            	if(v.id == 2 || v.id == 3){
            		$scope.showHinhthucTuyendung = true;	
            	}          	
            });
        }
    }, true);
    $scope.$watch('chkBiencheChuaChinhthuc', function(newval, oldval) {
        if (newval !== oldval) {
        	$scope.congtac.bienche.khongchinhthuc = [];
        	$scope.showHopdongVuviec = false;
        	$scope.showHopdongTrongchitieu = false;
        	$scope.showHopdongNgoaichitieu = false;
            angular.forEach($filter('filter')(newval, {checked:true}), function(v) {
            	$scope.congtac.bienche.khongchinhthuc.push(v.id);
                //console.log(v.code);
            	if(v.id == 11){
            		$scope.showHopdongVuviec = true;	
            	}else if(v.id == 12){
            		$scope.showHopdongTrongchitieu = true;
            	}
            	else if(v.id == 13){
            		$scope.showHopdongNgoaichitieu = true;
            	}
            });
        }
    }, true);    
    $scope.$watch('chkHinhthucTuyendung', function(newval, oldval) {
        if (newval !== oldval) {
        	$scope.congtac.recr_type = [];
        	$scope.showVitriTuyendung = false;
        	$scope.showThiTuyen = false;
        	$scope.congtac.hdxettuyen.vitrituyendung = '';
        	//console.log($scope.congtac.hdxettuyen.vitrituyendung);
            angular.forEach($filter('filter')(newval, {checked:true}), function(v) {
            	$scope.congtac.recr_type.push(v.id);
                //console.log(v.code);
            	if(v.id == '00'){
            		$scope.showVitriTuyendung = true;	
            	}else if(v.id=='01'){
            		$scope.showThiTuyen = true;
            	}          	
            });
        }
    }, true);
    $scope.$watch('chkTrangthaiHoso', function(newval, oldval) {
        if (newval !== oldval) {
        	$scope.congtac.status = [];  
            angular.forEach($filter('filter')(newval, {checked:true}), function(v) {
            	$scope.congtac.status.push(v.id);                	
            });
        }
    }, true);
    $scope.$watch('chkHinhThucDaoTao', function(newval, oldval) {
        if (newval !== oldval) {
        	$scope.daotao.htdaotao = [];  
            angular.forEach($filter('filter')(newval, {checked:true}), function(v) {
            	$scope.daotao.htdaotao.push(v.id);                	
            });
        }
    }, true);
    $scope.$watch('chkTotNghiepLoai', function(newval, oldval) {
        if (newval !== oldval) {
        	$scope.daotao.loaitotnghiep = [];  
            angular.forEach($filter('filter')(newval, {checked:true}), function(v) {
            	$scope.daotao.loaitotnghiep.push(v.id);                	
            });
        }
    }, true);
   
	var _initPage = function(successCallback){
		/*
		QuanhuyenService.get($scope.info.nguyenquan.tinhthanh,function success(data){
			$scope.nguyenquan_quanhuyen = data;
			$scope.hokhau_quanhuyen = data;
		});
		
		PhuongxaService.get($scope.info.nguyenquan.tinhthanh,$scope.info.nguyenquan.quanhuyen,function success(data){
			$scope.nguyenquan_phuongxa = data;
			$scope.hokhau_phuongxa = data;
		});
		*/
		/**
		 * Init Tab 1
		 */
		//$scope.cboDanToc = DanhmucService.query({"collect":"DANTOC"});
		//$scope.cboTongiao = DanhmucService.query({"collect":"tongiao"});		
		$scope.cboTinhthanh = $scope.cboNoicapCmnd = $scope.cboNguyenquanTinhthanh = $scope.cboHokhauTinhthanh = DanhmucService.query({"collect":"tinhthanh"});
		
		$scope.cboHonnhan = DanhmucService.query({"collect":"honnhan"});
		//$scope.cboDonvi = DanhmucService.query({"task":"donvi","limit":"ALL"});
		/**
		 * Init Tab 2
		 */
		
		$scope.chkLoaihinhBienche = DanhmucService.query({"collect":"loaihinhbienche"});

		$scope.chkLoaihinhDonvi1 = [{'id':1,'name':'Hành chính'},{'id':2,'name':'Sự nghiệp'}];
		
		$scope.chkLoaihinhDonvi2 = [{'type':3,'id':1,'name':'UBND Quận'},
		                            {'type':3,'id':2,'name':'UBND Huyện'},
		                            {'type':4,'id':3,'name':'UBND Phường'},
					                {'type':4,'id':4,'name':'UBND Xã'}];
		
		$scope.chkCapDonvi = [{'type':1,'id':1,'name':'Sở, Ban, Ngành'},
		                           {'type':1,'id':2,'name':'Chi cục'},
				                   {'type':1,'id':3,'name':'UBND cấp Huyện'},
				                   {'type':1,'id':4,'name':'UBND cấp Xã'},
				                   {'type':2,'id':5,'name':'Đơn vị đảm bảo kinh phí hoạt động'},
		                           {'type':2,'id':6,'name':'Đơn vị đảm bảo một phần kinh phí hoạt động'},
		                           {'type':2,'id':7,'name':'Đơn vị được giao toàn bộ kinh phí hoạt động'}];
		$scope.chkGoiluong = DanhmucService.query({"collect":"goiluong"});
		
		//$scope.chkGoichucvu = DanhmucService.query({"task":"goichucvu","limit":"ALL"});
		//$scope.childrenUrl="index.php?option=com_searchhs&conrtoller=searchhs&view=searchhs&format=raw&task=goichucvu";
		$scope.urlGoichucvu = "index.php?option=com_searchhs&conrtoller=searchhs&view=searchhs&format=raw&task=treegoichucvu";
		$scope.urlLinhvucTochuc = "index.php?option=com_searchhs&conrtoller=searchhs&view=searchhs&format=raw&task=treelinhvuctochuc";
		$scope.chkLinhvucphong = DanhmucService.query({"collect":"linhvucphong"});
		/**
		 *  Init Tab 3
		 */

		$scope.chkBienche = DanhmucService.query({"collect":"bienche"});
		$scope.chkBiencheChinhthuc = DanhmucService.query({"collect":"bienchechinhthuc"});
		$scope.showBiencheChinhthuc = false;
		$scope.chkBiencheChuaChinhthuc = DanhmucService.query({"collect":"bienchekhongchinhthuc"});
		$scope.showBiencheChuaChinhthuc = false;
		$scope.chkHinhthucTuyendung = DanhmucService.query({"collect":"hinhthuctuyendung"});
		$scope.showHinhthucTuyendung = false;		
		$scope.cboVitriTuyendung = DanhmucService.query({"collect":"vitrituyendung"});
		
		$scope.cboThoihanHdNganhan = [{'id':1,'name':'06 Tháng'},{'id':2,'name':'Một năm'},{'id':3,'name':'2 Năm'},{'id':4,'name':'3 Năm'},{'id':0,'name':'Không xác định'}];
		$scope.cboDoituongThuhut = DanhmucService.query({"collect":"doituongthuhut"});		
		$scope.chkTrangthaiHoso = DanhmucService.query({"collect":"trangthaihoso"});		
		$scope.cboChucvuHientai = DanhmucService.query({"collect":"chucvu"});
		$scope.cboDonviTungCongtac = DanhmucService.query({"collect":"donvitungcongtac"});	
		
		$scope.cboChucvuDaTungLam = DanhmucService.query({"collect":"CHUCVUTUNGCONGTAC"});
		/**
		 * Init tab 4
		 */
		$scope.cboMaNgach = DanhmucService.query({"collect":"MANGACH"});
		$scope.cboMaNgachTuongDuong = DanhmucService.query({"collect":"MANGACHTUONGDUONG"});		
		$scope.cboNhomNgach = DanhmucService.query({"collect":"NHOMNGACH"});
		
		$scope.cboTrinhdoChuyenmon = SearchService.query({"task":"TrinhdoChuyenmon","tosc_code":2,"limit":"ALL"});
		$scope.cboChucDanhKhoaHoc = SearchService.query({"task":"TrinhdoChuyenmon","tosc_code":11,"limit":"ALL"});
		$scope.cboLyLuanChinhTri = SearchService.query({"task":"TrinhdoChuyenmon","tosc_code":3,"limit":"ALL"});
		$scope.cboQuanLyHanhChinh = SearchService.query({"task":"TrinhdoChuyenmon","tosc_code":5,"limit":"ALL"});
		$scope.cboQuanLyKinhTe = SearchService.query({"task":"TrinhdoChuyenmon","tosc_code":8,"limit":"ALL"});
		$scope.cboTiengAnh = SearchService.query({"task":"TrinhdoChuyenmon","tosc_code":6,"limit":"ALL"});
		$scope.cboTinHoc = SearchService.query({"task":"TrinhdoChuyenmon","tosc_code":7,"limit":"ALL"});
		$scope.cboTiengDanToc = SearchService.query({"task":"TIENGDANTOC","limit":"ALL"});
		$scope.cboAnNinhQuocPhong = SearchService.query({"task":"TrinhdoChuyenmon","tosc_code":17,"limit":"ALL"});
		$scope.cboNgonNguKhac = SearchService.query({"task":"NgonNguKhac","limit":"ALL"});
		//$scope.cboTrinhDoNgonNguKhac = DanhmucService.query({"task":"TrinhdoChuyenmon","tosc_code":17,"limit":"ALL"});
		$scope.cboTruongDaoTao = SearchService.query({"task":"TruongDaoTao","limit":"ALL"});
		$scope.cboNganhDaoTao = SearchService.query({"task":"NganhDaoTao","limit":"ALL"});
		$scope.chkHinhThucDaoTao = SearchService.query({"task":"HinhThucDaoTao","limit":"ALL"});
		$scope.chkTotNghiepLoai = SearchService.query({"task":"TotNghiepLoai","limit":"ALL"});
		/**
		 * Init tab Khac
		 */
		//$scope.cboChucvuDoan =  DanhmucService.query({"collect":"ChucvuDoan"});
		//$scope.cboChucvuDang =  DanhmucService.query({"collect":"CHUCVUDANG"});
		//$scope.cboCapbacquandoi =  DanhmucService.query({"collect":"Capbacquandoi"});
		//$scope.cboChucvuquandoi =  DanhmucService.query({"collect":"Chucvuquandoi"});
		//$scope.cboDanhhieuphongtang =  DanhmucService.query({"collect":"Danhhieuphongtang"});
		//$scope.cboDoituongchinhsach =  DanhmucService.query({"collect":"Doituongchinhsach"});
		//$scope.cboSuckhoe =  DanhmucService.query({"collect":"Suckhoe"});
		//$scope.cboNhommau =  DanhmucService.query({"collect":"Nhommau"});
		//$scope.cboKhuyettat =  DanhmucService.query({"collect":"Khuyettat"});
		//$scope.cboNanglucsotruong =  DanhmucService.query({"collect":"Nanglucsotruong"});
		//$scope.cboThuongbinhloai =  DanhmucService.query({"collect":"Thuongbinhloai"});
		//$scope.cboKhenthuong =  DanhmucService.query({"collect":"Khenthuong"});
		//$scope.cboKyluat =  DanhmucService.query({"collect":"Kyluat"});
		//$scope.cboKhenthuong =  DanhmucService.query({"collect":"Khenthuong"});
		$scope.urlTreecol = "index.php?option=com_searchhs&conrtoller=searchhs&view=searchhs&format=raw&task=treecol";
		$scope.chkUsers =  SearchService.query({"task":"user"});
		$scope.dataQuerySearch =  SearchService.query({"task":"QuerySearch"});
/*

		DanhmucService.get('chucvu',function success(data){
			$scope.cboChucvuHientai1 = data;
			$scope.cboChucvuHientai2 = data;
			$scope.cboChucvuHientai3 = data;
			//console.log($scope.chkGoichucvu);
		});
		/*
		DanhmucService.get('donvitungcongtac',function success(data){
			$scope.cboDonviTungCongtac = data;			
		});	
		*/	
		/*
		$rows[] = array('type'=>1,'id'=>1,'name'=>'Sở, Ban, Ngành');
		$rows[] = array('type'=>1,'id'=>2,'name'=>'Chi cục');
		$rows[] = array('type'=>1,'id'=>3,'name'=>'UBND cấp Huyện');
		$rows[] = array('type'=>1,'id'=>4,'name'=>'UBND cấp Xã');
		$rows[] = array('type'=>2,'id'=>5,'name'=>'Đơn vị đảm bảo kinh phí hoạt động');
		$rows[] = array('type'=>2,'id'=>6,'name'=>'Đơn vị đảm bảo một phần kinh phí hoạt động');
		$rows[] = array('type'=>2,'id'=>7,'name'=>'Đơn vị được giao toàn bộ kinh phí hoạt động');
		*/
		successCallback();
		$scope.lockSearch = false;
		//$scope.congtac.quantrinh.donvi = undefined;
	};
	_initPage(function(){
		$scope.inited = true;
	});
	//$scope.reports = [];
	 $scope.mySelections = [];
	$scope.isSubmit = false;
	$scope.doSearch = function(){
		jQuery('#myTab3 a:last').tab('show');
		$scope.isSubmit = false;
		$scope.loading = true;
		if(angular.isUndefined($scope.config.columns)){			
			$scope.config.columns = [3,4,67];
		}
		var data = {};
		data.info = $scope.info;
		data.donvi = $scope.donvi;
		data.congtac = $scope.congtac;
		data.luong = $scope.luong;
		data.daotao = $scope.daotao;
		data.khac = $scope.khac;
		data.config = $scope.config;
		//$scope.aoColumns = [];
		var formData = angular.toJson(data);
		SearchService.search({"task":"dosearch"},{"formData":formData},function(response){			
			//$scope.reports = response.data;
			$scope.myData = response.data;			
			var columnDefs = [];
			angular.forEach(response.columns, function(v,i) {				
				if(i == 0){
					//console.log(i);
					columnDefs.push({field:v.value,displayName:v.text,cellTemplate: '<div class="ngCellText"><a href="index.php?option=com_hoso&y={{row.getProperty(\'id\')}}">{{row.getProperty(col.field)}}</a></div>'});
				}else{
					columnDefs.push({field:v.value,displayName:v.text});	
				}
				           	
            });			
		    $scope.myOptions = { data: 'myData',
		    		columnDefs: columnDefs,	
		    		showGroupPanel: true,
		    		jqueryUIDraggable: true		    		
		    };
		    $scope.isSubmit = true;
		    $scope.loading = false;
		});		
	};
	$scope.doExport = function(){
		
	};
	$scope.changeTab = function(){
		jQuery('#myTab3 a:last').tab('show');
	};	
	   // not mandatory, here as an example

    // not mandatory, here as an example
    //$scope.columnDefs = [{ "bSortable": false, "aTargets": [1] }];

    // not mandatory, you can use defaults in directive
//	$scope.aoColumns = [];
//	$scope.aoColumns.push({ "sTitle": "ID" });
//	$scope.aoColumns.push({ "sTitle": "Họ và tên" });  			

    
};
