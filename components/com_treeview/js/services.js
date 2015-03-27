'use strict';

/* Services */
app.factory('Caydonvi',function($resource) {
    var resource = $resource(Core.rootUrl+'/api/tochuc/caydonvi.php/:id',{id: '@id'}, {
        'query':  {method:'GET'},
        'get':    {method:'GET'},
        'create':   {method:'POST'},
        'update': {method:'PUT'},
        'delete': {method:'DELETE'}
    });
    return resource;
});
app.factory('Tochuc',function($resource) {
    var resource = $resource(Core.rootUrl+'/api/tochuc/tochuc.php/:id',{id: '@id'}, {
        'query':  {method:'GET'},
        'get':    {method:'GET'},
        'create':   {method:'POST'},
        'update': {method:'PUT'},
        'delete': {method:'DELETE'}
    });
    return resource;
});
app.factory('Captochuc',function($resource) {
    var resource = $resource(Core.rootUrl+'/api/tochuc/captochuc.php/:id',{id: '@id'}, {
        'query':  {method:'GET'},
        'get':    {method:'GET'},
        'create':   {method:'POST'},
        'update': {method:'PUT'},
        'delete': {method:'DELETE'}
    });
    return resource;
});
app.factory('Loaihinh',function($resource) {
    var resource = $resource(Core.rootUrl+'/api/tochuc/loaihinh.php/:id',{id: '@id'}, {
        'query':  {method:'GET'},
        'get':    {method:'GET'},
        'create':   {method:'POST'},
        'update': {method:'PUT'},
        'delete': {method:'DELETE'}
    });
    return resource;
});

app.factory('TochucLinhvuc',function($resource) {
    var resource = $resource(Core.rootUrl+'/api/tochuc/linhvuc.php/:id',{id: '@id'}, {
        'query':  {method:'GET'},
        'get':    {method:'GET'},
        'create':   {method:'POST'},
        'update': {method:'PUT'},
        'delete': {method:'DELETE'}
    });
    return resource;
});
app.factory('TochucPagination', function($http) {
    var TochucPagination = function() {
        this.items = [];
        this.busy = false;
        this.after = '';
        this.page = 1;
        this.state = 0;
        this.search = undefined;
        this.start = 0;
    };
    TochucPagination.prototype.nextPage = function() {
        if (this.busy) return;
        this.busy = true;
        var url = Core.rootUrl+'/api/tochuc/tochuc.php?start=' + this.start + '&limit=40&state='+this.state +'&search='+this.search;
        $http.get(url).success(function(response) {
            var items = response.data;
            for (var i = 0; i < items.length; i++) {
                this.items.push(items[i]);
            }
            if(items.length > 0 ){
                this.page  = this.page + 1;
                this.start = (this.start + 40)
            }
            //console.log(data);
            //this.after = "t3_" + this.items[this.items.length - 1].id;
            this.busy = false;
        }.bind(this));
    };
    return TochucPagination;
});
app.factory('Trees',['Tochuc',function(Tochuc) {
    Tochuc.query().then(function(response){
        var buildTree =  function (data) {
            var source = [];
            var items = [];
            // build hierarchical source.
            for (var i = 0; i < data.length; i++) {
                var item = data[i];
                var label = item["name"];
                var parents = item["parents"];
                var id = item["id"];
                if (items[parents]) {
                    var item = { parents: parents, label: label };
                    if (!items[parents].children) {
                        items[parents].children = [];
                    }
                    items[parents].children[items[parents].children.length] = item;
                    items[id] = item;
                }
                else {
                    items[id] = { parents: parents, label: label };
                    source[0] = items[id];
                }
            }
            return source;
        }
      return buildTree(response);
    });
}]);
app.factory('Gioitinh',function($resource,$q,$http) {
    var resourceGioitinh = $resource(Core.rootUrl+'/api/gioitinh.php/:id',{}, {
        'query':  {method:'GET'},
        'get':    {method:'GET'},
        'save':   {method:'POST'},
        'update': {method:'PUT'},
        'delete': {method:'DELETE'}
    });
    return {
        pagination:function(page,limit,search){
            var deferred = $q.defer();
            //console.log(page);
            var start = (page - 1)*limit;
            resourceGioitinh.query({start:start,limit:limit,search:search},function(data){
                deferred.resolve(data);
            });
            return deferred.promise;
        },
        query:function(params){
            var deferred = $q.defer();
            //console.log(page);
            var start = (page - 1)*limit;
            resourceGioitinh.query(params,function(data){
                deferred.resolve(data);
            });
            return deferred.promise;
        },
        get:function(id){
            var deferred = $q.defer();
            resourceGioitinh.get({id:id},function(data){
                deferred.resolve(data);
            });
            return deferred.promise;
        },
        save:function(formData){
            var deferred = $q.defer();
            resourceGioitinh.save({},formData,function(data){
                deferred.resolve(data);
            });
            return deferred.promise;
        },
        update:function(id,formData){
            var deferred = $q.defer();
            resourceGioitinh.update({id:id},formData,function(data){
                deferred.resolve(data);
            });
            return deferred.promise;
        },
        changeStatus:function(id,status){
            var deferred = $q.defer();
            resourceGioitinh.update({id:id},{action:"changeStatus",status:status},function(data){
                deferred.resolve(data);
            });
            return deferred.promise;
        },
        delete:function(id,formData){
            var deferred = $q.defer();
            resourceGioitinh.delete({id:id},function(data){
                deferred.resolve(data);
            });
            return deferred.promise;
        }
    }
});
app.factory('DataSourceTree',function() {
    /*
    var tree_data;
    Tochuc.query({action:"fueluxtree"}).then(function(data){
        tree_data = data;
    });
    */
var DataSourceTree = function(options) {
    this._data 	= options.data;
    this._delay = options.delay;
}

DataSourceTree.prototype.data = function(options, callback) {
    var self = this;
    var $data = null;
    if(!("name" in options) && !("type" in options)){
        $data = this._data;//the root tree
        //console.log($data);
        callback({ data: $data });
        return;
    }
    else if("type" in options && options.type == "folder") {
        if("additionalParameters" in options && "children" in options.additionalParameters){
            $data = options.additionalParameters.children;
            console.log($data);
        }
        else{
           $data = {};//no data
        }
    }

    if($data != null){
        callback({ data: $data });
    }


    //we have used static data here
    //but you can retrieve your data dynamically from a server using ajax call
    //checkout examples/treeview.html and examples/treeview.js for more info
};
    //return new DataSourceTree({data: tree_data});
    return DataSourceTree;
});