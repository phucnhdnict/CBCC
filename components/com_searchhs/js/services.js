'use strict';

/* Services */
app.factory('Units', function($http) {
    var Units = function() {
        this.items = [];
        this.busy = false;
        this.after = '';
        this.page = 1;
        this.state = 0;
        this.search = undefined;
        //this.start = 0;
        this.limit = 10;
    };
    Units.prototype.nextPage = function() {
        if (this.busy) return;
        this.busy = true;
        //server="index.php?option=com_searchhs&conrtoller=searchhs&view=searchhs&format=raw";
        var url = 'index.php?option=com_searchhs&conrtoller=searchhs&view=searchhs&format=raw&task=donvi&page=' + this.page + '&limit='+this.limit+'&search='+this.search;
        $http.get(url).success(function(response) {
            var items = response;
            for (var i = 0; i < items.length; i++) {
                this.items.push(items[i]);
            }
            if(items.length > 0 ){
                this.page  = this.page + 1;
                //this.start = (this.start +  this.limit);
            }
            //console.log(data);
            //this.after = "t3_" + this.items[this.items.length - 1].id;
            this.busy = false;
        }.bind(this));
    };
    return Units;
});
app.factory('UnitWorked', function($http) {
    var Units = function() {
        this.items = [];
        this.busy = false;
        this.after = '';
        this.page = 1;
        this.state = 0;
        this.search = undefined;
        //this.start = 0;
        this.limit = 10;
    };
    Units.prototype.nextPage = function() {
        if (this.busy) return;
        this.busy = true;
        //server="index.php?option=com_searchhs&conrtoller=searchhs&view=searchhs&format=raw";
        var url = 'index.php?option=com_searchhs&conrtoller=searchhs&view=searchhs&format=raw&task=donvitungcongtac&page=' + this.page + '&limit='+this.limit+'&search='+this.search;
        $http.get(url).success(function(response) {
            var items = response;
            for (var i = 0; i < items.length; i++) {
                this.items.push(items[i]);
            }
            if(items.length > 0 ){
                this.page  = this.page + 1;
                //this.start = (this.start +  this.limit);
            }
            //console.log(data);
            //this.after = "t3_" + this.items[this.items.length - 1].id;
            this.busy = false;
        }.bind(this));
    };
    return Units;
});
app.factory('Users', function($http) {
    var Users = function() {
        this.items = [];
        this.busy = false;
        this.after = '';
        this.page = 1;
        this.state = 0;
        this.search = undefined;
        //this.start = 0;
        this.limit = 10;
    };
    Users.prototype.nextPage = function() {
        if (this.busy) return;
        this.busy = true;
        //server="index.php?option=com_searchhs&conrtoller=searchhs&view=searchhs&format=raw";
        var url = 'index.php?option=com_searchhs&conrtoller=searchhs&view=searchhs&format=raw&task=user&page=' + this.page + '&limit='+this.limit;
        $http.get(url).success(function(response) {
            var items = response;
            for (var i = 0; i < items.length; i++) {
                this.items.push(items[i]);
            }
            if(items.length > 0 ){
                this.page  = this.page + 1;
                //this.start = (this.start +  this.limit);
            }
            //console.log(data);
            //this.after = "t3_" + this.items[this.items.length - 1].id;
            this.busy = false;
        }.bind(this));
    };
    return Users;
});
app.factory('DanhmucService',function($resource) {
	var url = "api.php?task=collect";
    return $resource(url,{}, {
        'query':  {method:'GET',isArray:true}
    });
});
app.factory('SearchService',function($resource) {
	var url = "index.php?option=com_searchhs&conrtoller=searchhs&view=searchhs&format=raw";
    return $resource(url,{}, {
        'query':  {method:'GET',isArray:true},        
        'search':  {method:'POST',isArray:false}
    });
});
