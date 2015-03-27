'use strict';

/* Directives */
/*
flash('My message')
<ol id="flash-messages">
    <li class="success">My message</li>
    </ol>
flash([ 'Hi!', 'My message' ])
<ol id="flash-messages">
    <li class="success">Hi</li>
    <li class="success">My message</li>
</ol>
flash('error', 'Something went wrong…')
    <ol id="flash-messages">
        <li class="error">Something went wrong…</li>
    </ol>
flash([ 'Hi!', { level: 'warning', text: 'This is a warning!' } ])
    <ol id="flash-messages">
        <li class="success">Hi</li>
        <li class="warning">This is a warning!</li>
    </ol>
*/
angular.module('flash', [])
    .factory('flash', function($rootScope, $timeout) {
        var messages = [];

        var reset;
        var cleanup = function() {
            $timeout.cancel(reset);
            reset = $timeout(function() { messages = []; });
        };

        var emit = function() {
            $rootScope.$emit('flash:message', messages, cleanup);
        };

        $rootScope.$on('$routeChangeSuccess', emit);

        var asMessage = function(level, text) {
            if (!text) {
                text = level;
                level = 'success';
            }
            return { level: level, text: text };
        };

        var asArrayOfMessages = function(level, text) {
            if (level instanceof Array) return level.map(function(message) {
                return message.text ? message : asMessage(message);
            });
            return text ? [{ level: level, text: text }] : [asMessage(level)];
        };

        return function(level, text) {
            emit(messages = asArrayOfMessages(level, text));
        };
    })
    .directive('flashMessages', function() {
        var directive = { restrict: 'E', replace: true };
        directive.template =
            '<div class="alert alert-{{m.level}}" ng-repeat="m in messages" id="flash-messages">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '{{m.text}}'
            '</div>'
            ;
        directive.controller = function($scope, $rootScope) {
            $rootScope.$on('flash:message', function(_,messages, done) {
                $scope.messages = messages;
                done();
            });
        };

        return directive;
    });
app.directive( 'whenActive', function ( $location ) {
    return {
        scope: true,
        link: function ( scope, element, attrs ) {
            scope.$on( '$routeChangeSuccess', function () {
                if ('#'+$location.path() ==  element.attr( 'href' )) {
                    element.parent().addClass( 'active' );
                    //console.log('active');
                }
                else {
                    element.parent().removeClass( 'active' );
                }
            });
        }
    };
});
app.directive('whenScrolled', function() {
    return function(scope, elm, attr) {
        var raw = elm[0];

        elm.bind('scroll', function() {
            if (raw.scrollTop + raw.offsetHeight >= raw.scrollHeight) {
                scope.$apply(attr.whenScrolled);
            }
        });
    };
});
app.directive('jstree',['DataSourceTree', function(DataSourceTree) {
    return {
        //jstree must be an attribute on an HTML element
        restrict: 'A',
        //give every [jstree] its own scope
        scope: {
            //create a two-way binding between this scope and the attribute's value
            jstree: '='
        },
        //call this function to construct the element
        link: function(scope, element, attrs) {
            element.on('selected', function (evt, data) {
                console.log(data.info[0].id);
            });
            element.on('opened', function (evt, data) {
                console.log(data.id);
            });
            scope.$watch('jstree', function(newval, oldval) {
                if (newval !== oldval) {
                    element.ace_tree({
                        dataSource: new DataSourceTree({data:scope.jstree}) ,
                        multiSelect:false,
                        loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
                        'open-icon' : 'icon-minus',
                        'close-icon' : 'icon-plus',
                        'selectable' : true,
                        'selected-icon' : null,
                        'unselected-icon' : null
                    });
                }
            }, true);
/*
                $('#tree1').ace_tree({
                    dataSource: treeDataSource ,
                    multiSelect:true,
                    loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
                    'open-icon' : 'icon-minus',
                    'close-icon' : 'icon-plus',
                    'selectable' : true,
                    'selected-icon' : null,
                    'unselected-icon' : null
                });

                $('#tree2').ace_tree({
                    dataSource: treeDataSource2 ,
                    loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
                    'open-icon' : 'icon-folder-open',
                    'close-icon' : 'icon-folder-close',
                    'selectable' : false,
                    'selected-icon' : null,
                    'unselected-icon' : null
                });



                /**
                 $('#tree1').on('loaded', function (evt, data) {
		});

                 $('#tree1').on('opened', function (evt, data) {
		});

                 $('#tree1').on('closed', function (evt, data) {
		});

                 $('#tree1').on('selected', function (evt, data) {
		});
                 */

        }

    };
}]);

app.directive( 'treeDonvi',['Tochuc', function (Tochuc) {
   return{
       restrict: 'E',
      // replace: true,
      // template: '<div id="tree-tochuc-donvi" class="tree"></div>',
       link:function(scope, element, attrs) {
        //console.log(DataSourceTree);
           element.jstree({
                // List of active plugins
                "plugins" : [
                    "themes","json_data","ui","crrm","types"
                ],
                "types" : {
                    // I set both options to -2, as I do not need depth and children count checking
                    // Those two checks may slow jstree a lot, so use only when needed
                    "max_depth" : -2,
                    "max_children" : -2,
                    // I want only `drive` nodes to be root nodes
                    // This will prevent moving or creating any other type as a root node
                    "valid_children" : [ "root" ],
                    "types" : {
                        // The default type
                        "default" : {
                            // I want this type to have no children (so only leaf nodes)
                            // In my case - those are files
                            "valid_children" : "none",
                            // If we specify an icon for the default type it WILL OVERRIDE the theme icons
                            "icon" : {
                                "image" : Core.rootUrl + "/media/cbcc/js/jquery/jstree/themes/file.png"
                            }
                        },
                        // The `folder` type
                        "folder" : {
                            // can have files and other folders inside of it, but NOT `drive` nodes
                            "valid_children" : [ "default", "folder" ],
                            "icon" : {
                                "image" : Core.rootUrl + "/media/cbcc/js/jquery/jstree/themes/folder.png"
                            }
                        },
                        // The `drive` nodes
                        "root" : {
                            // can have files and folders inside, but NOT other `drive` nodes
                            "valid_children" : [ "default", "folder" ],
                            "icon" : {
                                "image" : Core.rootUrl + "/media/cbcc/js/jquery/jstree/themes/root.png"
                            }
                        }
                    }
                },
                // I usually configure the plugin that handles the data first
                // This example uses JSON as it is most common
                "json_data" : {
                    // This tree is ajax enabled - as this is most common, and maybe a bit more complex
                    // All the options are almost the same as jQuery's AJAX (read the docs)
                    "ajax" : {
                        // the URL to fetch the data
                        "url" : "api/tochuc.php",
                        // the `data` function is executed in the instance's scope
                        // the parameter is the node being loaded
                        // (may be -1, 0, or undefined when loading the root nodes)
                        "data" : function (n) {
                            // the result is fed to the AJAX request `data` option
                            return {
                                "action" : "treeview",
                                "operation" : "get_children",
                                "id" : n.attr ? n.attr("id").replace("node_","") : 0
                            };
                        }
                    }
                }
            }).bind("select_node.jstree", function (event, data) {
                   // `data.rslt.obj` is the jquery extended node that was clicked
                   //alert(data.rslt.obj.attr("id").replace("node_",""));
                   scope.edit(data.rslt.obj.attr("id").replace("node_",""));
            }).delegate("a", "click", function (event, data) {
                   event.preventDefault();
            });

       }
   }
}]);
app.directive('btnBack',['$window', function ($window) {
    return {
        restrict: 'E',
        template: '<button class="btn"><i class="icon-cancel"></i>Thoát</button>',
        link: function(scope, element, attrs) {
            $(element[0]).on('click', function() {
                $window.history.back();
                scope.$apply();
            });
            /*
            $(element[1]).on('click', function() {
                $window.history.forward();
                scope.$apply();
            });
            */
        }
    };
}]);
app.directive('uiDatepicker', function($filter) {
    return {
        restrict: 'A',
        require : 'ngModel',
        link : function (scope, element, attrs, ngModelCtrl) {
            element.datepicker({format:'dd/mm/yyyy'})
                .on('changeDate', function(ev){
                    //$filter('date')(new Date($scope.tochuc.ngaythanhlap),'dd/MM/yyyy');
                    ngModelCtrl.$setViewValue($filter('date')(new Date(ev.date),'dd/MM/yyyy'));
                    ngModelCtrl.$setValidity('date', true);
                    //var newDate = new Date(ev.date)
                    scope.$apply();
                    //console.log(ev.date);
                })
                .on('blur',function(){
                    scope.$apply(function () {
                        if(angular.isDate(ngModelCtrl.$viewValue)){
                            ngModelCtrl.$setViewValue($filter('date')(new Date(ngModelCtrl.$viewValue),'dd/MM/yyyy'));
                            ngModelCtrl.$setValidity('date', true);
                            //console.log(ngModelCtrl.$viewValue);
                        }else{
                            //console.log(checkValidDate(ngModelCtrl.$viewValue));
                            //ngModelCtrl.$setViewValue(ngModelCtrl.$viewValue);
                            ngModelCtrl.$setValidity('date', checkValidDate(ngModelCtrl.$viewValue));
                            //console.log(ngModelCtrl.$viewValue);
                        }

                    });
                });

            var checkValidDate = function (strDate)
            {
                var regex = /^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((1[6-9]|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((1[6-9]|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((1[6-9]|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/;
                if(!(regex.test(strDate)))
                {
                    return false;
                }
                return true;
            }
        }
    }
});

app.directive('ensureUnique', ['$http', function($http) {
    return {
        restrict: 'A',
        require: '^ngModel',
        link: function(scope, element, attrs, ctrl) {
            element.on('blur', function (evt) {
                scope.$apply(function () {
                    //console.log(scope.$parent.$eval(attrs.ngModel));
                    $http({
                        method: 'POST',
                        url: Core.rootUrl + '/api/check/unique.php',
                        data: {'table':attrs.dbTableUnique,'column':attrs.dbColumnUnique,'value':attrs.ensureUnique}
                    }).success(function(data, status, headers, cfg) {
                            ctrl.$setValidity('unique', data.isUnique);
                        }).error(function(data, status, headers, cfg) {
                            ctrl.$setValidity('unique', false);
                    });
                });
            });
            /*
            scope.$watch(attrs.ngModel, function( newValue, oldValue ) {
                // Ignore initial setup.
                if ( newValue !== oldValue ) {
                    //console.log(scope.$parent.$eval(attrs.ngModel));
                    $http({
                        method: 'POST',
                        url: Core.rootUrl + '/api/check/unique.php/' + attrs.ensureUnique,
                        data: {'value': scope.$parent.$eval(attrs.ngModel)}
                    }).success(function(data, status, headers, cfg) {
                            c.$setValidity('unique', data.isUnique);
                        }).error(function(data, status, headers, cfg) {
                            c.$setValidity('unique', false);
                    });
                }
            });
            */
        }
    }
}]);
app.directive('ngFocus', [function() {
    var FOCUS_CLASS = "ng-focused";
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function(scope, element, attrs, ctrl) {
            ctrl.$focused = false;
            element.bind('focus', function(evt) {
                element.addClass(FOCUS_CLASS);
                scope.$apply(function() {ctrl.$focused = true;});
            }).bind('blur', function(evt) {
                    element.removeClass(FOCUS_CLASS);
                    scope.$apply(function() {ctrl.$focused = false;});
                });
        }
    }
}]);