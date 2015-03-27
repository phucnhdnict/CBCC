'use strict';

/* Controllers */
var HomeCtrl = function($scope){

}
var CayTochucCtrl = function($scope,flash){
    flash('Lưu thành công!');
}
var TochucCtrl = function($scope,flash, Tochuc){
    $scope.maxSize = 5;
    $scope.currentPage = 1;
    $scope.limitPage = Core.limitPage;
    $scope.parents = [];
    $scope.doSearch = function() {
        $scope.pageChanged(1);
    };
    $scope.doReset = function() {
        $scope.filter_search = '';
        $scope.pageChanged(1);
    };
    $scope.$watch('currentPage', function(newPage){
        $scope.watchPage = newPage;
        //or any other code here
    });
    $scope.pageChanged = function(page) {
        console.log(page);
        var start = (page - 1)*$scope.limitPage;
        Tochuc.query({page:page,limit:$scope.limitPage,start:start,search:$scope.filter_search,parent_id:$scope.parent_id},function(response){
            $scope.items = response.data;
            if($scope.limitPage == 0){
                $scope.noOfPages = 0;
            }else{
                $scope.noOfPages =  Math.ceil(response.total / $scope.limitPage);
            }
        });
    };
    // tao trang
    $scope.filter_search = '';
    $scope.pageChanged($scope.currentPage);
}
var ThanhlapCtrl = function($scope,$log,$modal,$filter,TochucPagination,Tochuc,Captochuc,Loaihinh){
    $scope.tochuc = {};
    $scope.submitted = false;
    $scope.collectTochuc = [];
    $scope.tochuc.ngaythanhlap  = $filter('date')(new Date(),'dd/MM/yyyy');

    Tochuc.query({action:"getCollect"},function(response){
        $scope.collectTochuc = response.data;
    });
    Captochuc.query({action:"getCollect"},function(response){
        $scope.collectCaptochuc = response.data;
    });
    Loaihinh.query({action:"getCollect"},function(response){
        $scope.collectLoaihinh = response.data;
    });
    $scope.saveTochuc = function(){
        $scope.submitted == true;
       console.log($scope.tochuc.ngaythanhlap);
        if ($scope.thanhlap_form.$valid) {
            // Submit as normal
            Tochuc.create($scope.tochuc,function(response){
                console.log(response);
            });
        } else {
            $scope.thanhlap_form.submitted = true;
        }
    }
    $scope.openModalTochuc = function () {
        var modalInstance = $modal.open({
            templateUrl: Core.baseUrl + '/tpl/thanhlap/modal-tochuc.html',
            controller: ModalSelectTochucCtrl,
            resolve: {
                item: function () {
                    return {'code':$scope.tochuc.code_parent,'name':$scope.tochuc.coquanchuquan};
                }
            }
        });
        modalInstance.result.then(function (selectedItem) {
            //$scope.selected = selectedItem;
            $scope.tochuc.coquanchuquan = selectedItem.name;
            $scope.tochuc.code_parent = selectedItem.code;
            //$log.info('Modal dismissed at: ' +$scope.selected);
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };
}
var ModalSelectTochucCtrl = function ($scope,$log, $modalInstance,item,TochucPagination) {
    $scope.tochucPagination = new TochucPagination();
    $scope.selected = {
        item: item,
        search:''
    };
    $scope.doSearch = function () {
        $log.log($scope.selected.search);
        $scope.tochucPagination = new TochucPagination();
        $scope.tochucPagination.state = 0;
        $scope.tochucPagination.search =  $scope.selected.search
        $scope.tochucPagination.busy = false;
        $scope.tochucPagination.page = 1;
        $scope.tochucPagination.start = 0;
        $scope.tochucPagination.nextPage();
    };
    $scope.doReset = function(){
        $scope.selected.search = '';
        $scope.doSearch();
    }
    $scope.doOk = function () {
        $modalInstance.close($scope.selected.item);
    };
    $scope.doCancel = function () {
        $modalInstance.dismiss('cancel');
    };
};