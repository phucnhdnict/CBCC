'use strict';
app.factory('UserService',function($resource) {
	var url = "api.php?task=user";
    return $resource(url,{}, {
        'query':  {method:'GET',isArray:true},
        'get':  {method:'GET'}
    });
});
app.factory('UserPaging', function($http) {
    var UserPaging = function() {
        this.items = [];
        this.busy = false;      
        this.page = 1;       
        this.search = undefined;     
        this.limit = 20;
    };
    UserPaging.prototype.nextPage = function() {
        if (this.busy) return;
        this.busy = true;
        var url = "api.php?task=user&act=ALL&page=" + this.page + "&limit="+this.limit+"&search="+this.search;
        $http.get(url).success(function(response) {
            var items = response;
            for (var i = 0; i < items.length; i++) {
                this.items.push(items[i]);
            }
            if(items.length > 0 ){
                this.page  = this.page + 1;               
            }
            this.busy = false;
        }.bind(this));
    };
    return UserPaging;
});