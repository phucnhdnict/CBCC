'use strict';

/* Directives */
app.directive('loading', function () {
    return {
        restrict: 'E',
        replace:true,
        template: '<i class="icon-spinner icon-spin orange bigger-300"></i>',
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
app.directive('whenScrolled', function() {
    return function(scope, elm, attr) {
        var raw = elm[0];        
        elm.on('scroll', function() {
            if (raw.scrollTop + raw.offsetHeight >= raw.scrollHeight) {
                scope.$apply(attr.whenScrolled);
            }
        });
    };
});
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

app.directive('ngAutocomplete', function($parse) {
  return {
    scope: {
      details: '=',
      ngAutocomplete: '=',
      options: '='
    },

    link: function(scope, element, attrs, model) {

      // options for autocomplete
      var opts

      // convert options provided to opts
      var initOpts = function() {
        opts = {}
        if (scope.options) {
          if (scope.options.types) {
            opts.types = []
            opts.types.push(scope.options.types)
          }
          if (scope.options.bounds) {
            opts.bounds = scope.options.bounds
          }
          if (scope.options.country) {
            opts.componentRestrictions = {
              country: scope.options.country
            }
          }
        }
      }
      initOpts()

      // create new autocomplete
      // reinitializes on every change of the options provided
      var newAutocomplete = function() {
        scope.gPlace = new google.maps.places.Autocomplete(element[0], opts);
        google.maps.event.addListener(scope.gPlace, 'place_changed', function() {
          scope.$apply(function() {
// if (scope.details) {
              scope.details = scope.gPlace.getPlace();
// }
            scope.ngAutocomplete = element.val();
          });
        })
      }
      newAutocomplete()

      //watch options provided to directive
      scope.watchOptions = function () {
        return scope.options
      };
      scope.$watch(scope.watchOptions, function () {
        initOpts()
        newAutocomplete()
        element[0].value = '';
        scope.ngAutocomplete = element.val();
      }, true);
    }
  };
});
app.directive('jstree', function($timeout,$compile) {
	  return {
		  	restrict: 'E',
		    require: '^ngModel',
		   // replace: true, 
		    scope: {
		        ngModel: '=',
		        childrenUrl: '=',
		        twoState:'='
		    },
		    link: function(scope, elem, attrs, ctrl) {	    
		        var initJsTree = function () {
		        	var el = elem[0];
		        	//console.log((scope.twoState)?true:false);
		            var option = {			    		
				    		 "checkbox" : {				    		     
				    		      "two_state":(!angular.isUndefined(scope.twoState) || scope.twoState == true)?true:false
				    		  },
				       		"types" : {
		            			"valid_children" : [ "root" ],
		            			"types" : {
		            				"file" : {
		            					"icon" : { 
		            						"image" : "/media/cbcc/js/jstree/file.png" 
		            					}            					
		            				},
		            				"folder" : {
		            					"icon" : { 
		            						"image" : "/media/cbcc/js/jstree/folder.png" 
		            					}            					
		            				},
		            				"default" : {
		            					"valid_children" : [ "default" ]
		            				}
		            			}
		            		},
			                 "plugins": ["themes", "json_data", "ui","checkbox","types"]
			    	};
			    	if(!angular.isUndefined(scope.childrenUrl)){
			    		option.json_data = {
							"ajax" : {
								// the URL to fetch the data
								"url" : scope.childrenUrl,	
								"data" : function(n) {
									// the result is fed to the AJAX request `data`
									// option
									return {
										"id" : n.attr ? n.attr("id").replace("node_", "") : 0
									};
								}
							}
						};
			    	}
			        // Initialize the plugin late so that the injected DOM does
					// not disrupt the template compiler
			        //$timeout(function () {
			          jQuery(el).jstree(option).on('change_state.jstree', function (e, d) {
			        	  	var checked_ids = [];
			        	    var tagName = d.args[0].tagName;
			        	    var refreshing = d.inst.data.core.refreshing;
			        	    if ((tagName == "A" || tagName == "INS") &&
			        	      (refreshing != true && refreshing != "undefined")) {
			        	    //if a checkbox or it's text was clicked, 
			        	    //and this is not due to a refresh or initial load, run this code . . .
			        	    	
			        	    	jQuery(el).jstree("get_checked",null,true).each(function () {
			        	    		 checked_ids.push(this.id.replace("node_",""));
					        	 });
			        	    	// console.log(checked_ids);
			        	    	 e.preventDefault();
			        	    	   scope.$apply(function() {			        	            
			        	    		   ctrl.$setViewValue(checked_ids);			        	            
			        	             });
			        	    }
//			        	    $(elm[0]).jstree("get_checked",null,true).each(function () {
//		                        checked_ids.push(this.id.replace("node_",""));
//			        	    });
			          });
			          // Set initial value - I'm not sure about this but it
						// seems to need to be there
//			          elm.val(ctrl.$viewValue);
//			          // important!
//			          ctrl.$render();
			        //});		           
		          };
		         // scope.$watch(getOptions, initJsTree, true);		
		          initJsTree();
		    }
	  };
});
app.directive('numberInput', function() {
	  return {
	    require: 'ngModel',
	    //scope: true,
	    link: function(scope, elm, attrs, ctrl) {

	        var minValue = attrs.min || 0,
	            maxValue = attrs.max || Infinity;

	        elm.wrap('<div class="number-input-wrap"></div>').parent().append('<div class="number-input-controls"><a href="#" class="btn btn-xs btn-pluimen">+</a><a href="#" class="btn btn-xs btn-pluimen">-</a></div>');
	        elm.parent().find('a').bind('click',function(e){

	        	 var currValue = parseInt(ctrl.$modelValue),  newValue = currValue;

	            if(this.text=='+' && currValue<maxValue) {
	                newValue = currValue+1;    
	            } else if (this.text=='-' && currValue>minValue) {
	                newValue = currValue-1;    
	            }
	            ctrl.$setViewValue(newValue);
                ctrl.$render();
	           // scope.$eval(attrs.ngModel + "=" + newValue);
	            e.preventDefault();
	            scope.$apply();
	        });
	    }
	  };
});
app.directive('inputMaskDate', function($timeout) {
	return {
		require : "ngModel",
		link : function(scope, elem, attr, ctrl) {
			var el = jQuery(elem[0]);	          		
			el.mask("99/99/9999");
		  	el.on('keyup', function() {
				scope.$apply(function() {
					ctrl.$setViewValue(el.val());
				});
			});
		}
	};

});
app.directive('myTable', function($timeout,$compile) {
    return {
    	restrict: 'A',    	
    	link : function(scope, element, attrs) {    		
            // apply DataTable options, use defaults if none specified by user
            var options = {};
            if (attrs.myTable.length > 0) {
                options = scope.$eval(attrs.myTable);
            } else {
                options = {
                    "bStateSave": true,
                    "iCookieDuration": 2419200, /* 1 month */
                    "bJQueryUI": true,
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bInfo": false,
                    "bDestroy": true
                };
            }

            // Tell the dataTables plugin what columns to use
            // We can either derive them from the dom, or use setup from the controller           
            var explicitColumns = [];
            element.find('th').each(function(index, el) {
                explicitColumns.push($(el).text());
            });
            if (explicitColumns.length > 0) {
                options["aoColumns"] = explicitColumns;
            } else if (attrs.aoColumns) {            	
                options["aoColumns"] = scope.$eval(attrs.aoColumns);               
            }

            // aoColumnDefs is dataTables way of providing fine control over column config
            if (attrs.aoColumnDefs) {
                options["aoColumnDefs"] = scope.$eval(attrs.aoColumnDefs);
            }
            
            if (attrs.fnRowCallback) {
                options["fnRowCallback"] = scope.$eval(attrs.fnRowCallback);
            }

            // apply the plugin
            var dataTable = element.dataTable(options);
            // watch for any changes to our data, rebuild the DataTable
            scope.$watch(attrs.aaData, function(value) {
            	//console.log(attrs.aaData);          
                var val = value || null;
                if (val) {
                	
                	$timeout(function(){                		
                		dataTable.fnClearTable();
                        dataTable.fnAddData(scope.$eval(attrs.aaData));	
                	});
                	
//                	dataTable.fnClearTable();
//                    dataTable.fnAddData(scope.$eval(attrs.aaData));
//                	$compile(element)(scope);
                }
            },true);
        }
    }; 
});