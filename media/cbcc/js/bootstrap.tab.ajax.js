jQuery(document).ready(function($){
//enable all remote data tabs
	var _executeRemoteCall = function(url, customData, callbackFn, beforeCallbackFn, trigger, tabContainer) {	        
	        $.ajax({
	            url: url,
	            data: customData || [],
	  		  	beforeSend: function(data){				 
	  		  		if(typeof window[beforeCallbackFn] == 'function') {
	  		  			window[beforeCallbackFn].call(null, data, trigger, tabContainer, customData);
	  		        }	
				},
	            success: function(data) {	   
	                if (data) {	                	
	                    if(typeof window[callbackFn] == 'function') {
	                        window[callbackFn].call(null, data, trigger, tabContainer, customData);
	                    }
	                    if(!trigger.hasClass("loaded")) {
	                        trigger.addClass("loaded");
	                    }
	                    tabContainer.html(data);
	                }
	            },
	            fail: function(data) {
	     
	            }
	        });
	};
$('[data-toggle=tab]').each(function(k, tab) {
    var tabObj = $(tab),
        tabDiv,
        tabData,
        tabCallback,
        url,
        simulateDelay;

    // check if the tab has a data-url property
    if(tabObj.is('[data-tab-url]')) {
        tabObj.on("shown", function(e) {
            url = tabObj.attr('data-tab-url');
            tabDiv = $(tabObj.attr('href'));
            tabData = tabObj.attr('data-tab-json') || [];
            tabCallback = tabObj.attr('data-tab-callback') || null;
            tabBeforeCallback = tabObj.attr('data-tab-before-callback') || null;
            simulateDelay = tabObj.attr('data-tab-delay') || null;
        	//console.log(tabData);
            if(tabData.length > 0) {
                try
                {
                  tabData = $.parseJSON(tabData);
                } catch (exc) {
                    //console.log('Invalid json passed to data-tab-json');
                    //console.log(exc);
                }

            }
        
            if (!tabObj.hasClass("loaded") || tabObj.is('[data-tab-always-refresh]')) {
                       // delay the json call if it has been given a value
                if(simulateDelay) {
                    clearTimeout(window.timer);
                    window.timer=setTimeout(function(){
                    	_executeRemoteCall(url, tabData, tabCallback,tabBeforeCallback, tabObj, tabDiv);
                    }, simulateDelay);
                } else {
                	_executeRemoteCall(url, tabData, tabCallback,tabBeforeCallback, tabObj, tabDiv);
                }

            }

        });

    }
});
});