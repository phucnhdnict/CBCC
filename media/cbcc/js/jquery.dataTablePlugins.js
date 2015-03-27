(function($) {
	$.fn.dataTableExt.oApi.fnProcessingIndicator = function ( oSettings, onoff )
	{
	    if( typeof(onoff) == 'undefined' )
	    {
	        onoff=true;
	    }
	    this.oApi._fnProcessingDisplay( oSettings, onoff );
	};
	$.extend( true, $.fn.DataTable.TableTools.classes, {
		"container": "btn-group",
		"buttons": {
			"normal": "btn btn-small btn-success",
			"disabled": "btn disabled"
		},
		"collection": {
			"container": "DTTT_dropdown dropdown-menu",
			"buttons": {
				"normal": "",
				"disabled": "disabled"
			}
		}
	} );

	// Have the collection use a bootstrap compatible dropdown
	$.extend( true, $.fn.DataTable.TableTools.DEFAULTS.oTags, {
		"collection": {
			"container": "ul",
			"button": "li",
			"liner": "a"
		}
	} );
})(jQuery);