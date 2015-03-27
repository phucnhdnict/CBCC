/*
* AUSU jQuery-Ajax Auto Suggest
* http://www.oslund.ca/
*
* @version
* 1.0.1 (Jan 28 2011)
*
* @copyright
* Copyright (C) 2011 Isaac Oslund
* Dual licensed under the MIT and GPL licenses.
* http://www.opensource.org/licenses/mit-license.php
* http://www.opensource.org/licenses/gpl-license.php
*/

(function($){
    $.fn.autosugguest = function(config) {

        var defaults = {
            className: 'suggest',
	   methodType: 'POST',
            addParams: null,
               rtnIDs: false,
             dataFile: 'data.php',
             minChars:  4,
             fadeTime:  100
          };
    
        var config = $.extend(defaults, config);

        config.addParams = (config.addParams != '') ? '&' + config.addParams : '';
        
        $('<div class="ausu-suggestionsBox"><img src="/components/com_hoso/images/arrow.png" /><ul></ul></div>').appendTo('.' + config.className);
        $(".ausu-suggestionsBox > ul li").live('mouseover', function()
        {	
			var sel = $(this).parent().find("li[class='selected']").removeClass('selected');
			$(this).addClass('selected');
		});
		
		$("." + config.className + " > input").keyup(function(event)
        {
			//var width=$("." + config.className + " > input").css('width');
			var width=$(this).css('width');
	        width=width.substring(0,width.length-2);
	        width =parseInt(width)+25+'px';
	        jQuery(".ausu-suggestionsBox").css('width',width);
           var fieldParent = $(this).parents('div.' + config.className);

           if (event.which != 39 && event.which != 37 && event.which != 38 && event.which != 40 && event.which != 13 && event.which != 9 ) {
                
                fieldVal = fieldParent.find('input:eq(0)').val();
                suggest(fieldVal,this.id);
           } else {
             
             var fieldChild  = fieldParent.find('.ausu-suggestionsBox > ul');

             switch (event.which)
                {
                 case 40: { keyEvent(fieldChild,'next');break; }
                 case 38: { keyEvent(fieldChild,'prev');break; }
                 case 13:
                 {
                	 //fieldParent.children('input:eq(0)').val($("li[class='selected'] a").text());
                	 	fieldParent.children('input:eq(0)').val($("li[class='selected'] span").text());
                        if (config.rtnIDs==true) fieldParent.children('input:eq(1)').val($("li[class='selected']").attr("id"));
                        fieldParent.children('div.ausu-suggestionsBox').hide();
                        return false;
                        break;
                 }
                 case 9:
                 {
                        offFocus(this); $("li").removeClass("selected");
                        break;
                 }
             }
         }
        });

		$("." + config.className).bind("keypress", function(event) {
		  if (event.keyCode == 13) return false;
		});

        $("." + config.className + " > input").live("blur", function(){ offFocus(this); $("li").removeClass("selected"); });
    
        function suggest(dataInput, id)
        {
            if(dataInput.length < config.minChars) {
                    $('#'+id).parent('.' + config.className).children('div.ausu-suggestionsBox').fadeOut();
            } else {
            	$('#' + id + ":eq(0)").addClass('ausu-load');
                $.ajax({
                   type: config.methodType,
                    url: config.dataFile,
                   data: "data=" + dataInput + "&id=" + id + config.addParams,
                success: function(data){
                    if(data.length >0)
                    {
                        $('#'+id).parent('div.' + config.className).children('div.ausu-suggestionsBox').fadeIn();
                        $('#'+id).parent('div.' + config.className).find('.ausu-suggestionsBox > ul').html(data);
                        $('#'+ id + ":eq(0)").removeClass('ausu-load');
                    }
                    else
                    {
                        $('#' + id + ":eq(0)").removeClass('ausu-load');
                    }
                }
              });
            }
        }

		function keyEvent (fieldChild,action)
		{
			yx = 0;
			fieldChild.find("li").each(function(){
				if($(this).attr("class") == "selected")
                yx = 1;
            });
            
			if(yx == 1)
            {
				var sel = fieldChild.find("li[class='selected']");
				(action=='next') ? sel.next().addClass("selected") : sel.prev().addClass("selected");
				sel.removeClass("selected");
            }
            else
			{
				(action=='next') ? fieldChild.find("li:first").addClass("selected") : fieldChild.find("li:last").addClass("selected");
			}
        }

        function offFocus(fieldChild)
        {
            var fieldParent =  $(fieldChild).parents('div.' + config.className);
            fieldParent.children('div.ausu-suggestionsBox').delay(config.fadeTime).fadeOut();
        }

        $(".ausu-suggestionsBox > ul li").live("click", function()
        {
            var fieldParent = $(this).parents('div.' + config.className);
            fieldParent.children('input:eq(0)').val($(this).text());
            if (config.rtnIDs==true) fieldParent.children('input:eq(1)').val($(this).attr("id"));
            fieldParent.children('div.ausu-suggestionsBox').hide();
        });

    };
})(jQuery);