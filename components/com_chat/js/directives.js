/**
 * Created by huuthanh3108 on 11/2/13.
 */
'use strict';
app.directive( 'offcanvas', function ( $location ) {
    return {
        scope: true,
        link: function ( scope, element, attrs ) {
            element.click(function() {
                angular.element('.row-offcanvas').toggleClass('active');
            });
        }
    };
});
app.directive('backButton', function(){
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            //$("#ng-view").removeClass("slide-animation").addClass("slide-left-animate");
            element.bind('click', goBack);
            function goBack() {
                history.back();
                scope.$apply();
            }
        }
    }
});
app.directive( 'whenActive', function ( $location ) {
    return {
        scope: true,
        link: function ( scope, element, attrs ) {
            scope.$on( '$routeChangeSuccess', function () {
                if (angular.equals('#'+$location.path().substring(1),element.attr( 'href' ))) {
                    element.parent().addClass( 'active' );
                }
                else {
                    element.parent().removeClass( 'active' );
                }
            });
        }
    };
});
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
app.factory('flash', function($rootScope, $timeout) {
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
        var elemId = new Date().getTime();
        directive.template ='<div class="alert alert-{{m.level}} alert-dismissable" ng-repeat="m in messages" id="flash-messages-'+elemId+'">'
            +'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
            +'{{m.text}}'
            +'</div>';
        directive.controller = function($scope, $rootScope,$timeout) {
            $rootScope.$on('flash:message', function(_,messages, done) {
                $scope.messages = messages;
                /*
                var reset;
                reset = $timeout(function(){
                    $('#flash-messages-'+elemId).remove();
                    //console.log('sssss');
                    $timeout.cancel(reset);
                }, 30000);
                */
                done();
            });
        };

        return directive;
    });
app.directive('loading', function () {
    return {
        restrict: 'E',
        replace:true,
        template: '<div class="spinner"></div>',
        link: function (scope, element, attr) {
            scope.$watch('loading', function (val) {
                if (val)
                	jQuery(element).show();
                else
                	jQuery(element).hide();
            });
        }
    }
});
app.directive('accordion', function () {
    return {
        restrict: 'A',
        replace:true,        
        link: function (scope, element, attr) {
        	var el = jQuery(element[0]);
        	el.on('hide', function (e) {
        		jQuery(e.target).prev().children(0).addClass('collapsed');
        	});
        	el.on('hidden', function (e) {
        		jQuery(e.target).prev().children(0).addClass('collapsed');
        	});
        	el.on('show', function (e) {
        		jQuery(e.target).prev().children(0).removeClass('collapsed');
        	});
        	el.on('shown', function (e) {
        		jQuery(e.target).prev().children(0).removeClass('collapsed');
        	});
        }
    }
});
app.directive('focusMe', function($timeout) {
	  return {
	    scope: { trigger: '=focusMe' },
	    link: function(scope, element) {
	      scope.$watch('trigger', function(value) {
	        if(value === true) { 
	          //console.log('trigger',value);
	          //$timeout(function() {
	            element[0].focus();
	            scope.trigger = false;
	          //});
	        }
	      });
	    }
	  };
});
app.directive('avatar', ['UserService', function (UserService) {
  return {
    restrict: 'A',
    replace:true,
    require: 'ngModel',
    scope:{
    	ngModel:'='
    },
    link:function(scope, element, attrs) {
      function doBuildAvatar(username) {
    	var el = jQuery(element[0]);
    	var data = {avatar:'avatar1.png',name:'Hệ thống'};
      	if(!scope.ngModel[username] == true){      		
    		if(username=='system'){        		
        		el.attr('alt',data.name);
        		el.attr('src','images/avatars/'+data.avatar);
        		//scope.ngModel[username] = [];
        		scope.ngModel[username] = data;
        	}else{
        		UserService.get({"act":"info","username":username},function(data){        			
        			//scope.ngModel[username] = [];
        			scope.ngModel[username] = data;
        	  		el.attr('alt',data.name);
            		el.attr('src','images/avatars/'+data.avatar);
        		});     		
        	}
    		//ctrl.$setViewValue(userInfo);
    	}else{
    		data = scope.ngModel[username];
    		//console.log(data);
    		el.attr('alt',data.name);
    		el.attr('src','images/avatars/'+data.avatar);
    	}     	  
      }
     doBuildAvatar(attrs.avatar);      
    }
  };
}]);
app.directive('infiniteScroll',	['$rootScope','$window','$timeout',function($rootScope, $window, $timeout) {
	return {
		link : function(scope, elem, attrs) {
			var raw = elem[0];
			var checkWhenEnabled, handler, scrollDistance, scrollEnabled;
			$window = angular.element($window);
			scrollDistance = 0;
			if (attrs.infiniteScrollDistance != null) {
				scope.$watch(attrs.infiniteScrollDistance,function(value) {
					return scrollDistance = parseInt(value, 10);
				});
			}
			scrollEnabled = true;
			checkWhenEnabled = false;
			if (attrs.infiniteScrollDisabled != null) {
				scope.$watch(attrs.infiniteScrollDisabled,function(value) {
									scrollEnabled = !value;
									if (scrollEnabled && checkWhenEnabled) {
										checkWhenEnabled = false;
										return handler();
									}
								});
			}
			handler = function() {
				var elementBottom, remaining, shouldScroll, windowBottom;
				if (attrs.infiniteScrollWindow && attrs.infiniteScrollWindow == true) {
					windowBottom = $window.height()	+ $window.scrollTop();
					elementBottom = elem.offset().top + elem.height();
					remaining = elementBottom - windowBottom;
					shouldScroll = remaining <= $window.height() * scrollDistance;					
				}else{
					shouldScroll = raw.scrollTop + raw.offsetHeight >= raw.scrollHeight;
				}
				if (shouldScroll && scrollEnabled) {
					if ($rootScope.$$phase) {
						return scope.$eval(attrs.infiniteScroll);
					} else {
						return scope.$apply(attrs.infiniteScroll);
					}
				} else if (shouldScroll) {
					return checkWhenEnabled = true;
				}
			};
			if (attrs.infiniteScrollWindow && attrs.infiniteScrollWindow==true) {
				$window.on('scroll', handler);
				scope.$on('$destroy', function() {
					return $window.off('scroll', handler);
				});		
			}else{
				elem.on('scroll', handler);
				scope.$on('$destroy', function() {
					return elem.off('scroll', handler);
				});	
			}		
			return $timeout((function() {
						if (attrs.infiniteScrollImmediateCheck) {
							if (scope.$eval(attrs.infiniteScrollImmediateCheck)) {
								return handler();
							}
						} else {
							return handler();
						}
			}), 0);
			}
		};
	} ]);