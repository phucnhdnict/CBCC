jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "date-vn-pre": function ( date ) {
        date = date.replace(" ", "");
        var vn_date, year;
         
        if (date == '') {
            return 0;
        }
 
        if (date.indexOf('.') > 0) {
            /*date a, format dd.mn.(yyyy) ; (year is optional)*/
            vn_date = date.split('.');
        } else {
            /*date a, format dd/mn/(yyyy) ; (year is optional)*/
            vn_date = date.split('/');
        }
 
        /*year (optional)*/
        if (vn_date[2]) {
            year = vn_date[2];
        } else {
            year = 0;
        }
 
        /*month*/
        var month = vn_date[1];
        if(vn_date[1]){
	        if (month.length == 1) {
	            month = 0+month;
	        }
        }else{
        	month = 0;
        }
 
        /*day*/
        var day = vn_date[0];
        if(vn_date[0]){
        	if (day.length == 1) {
                day = 0+day;
            }
        }else{
        	day = 0;
        }
 
        return (year + month + day) * 1;
    },
 
    "date-vn-asc": function ( a, b ) {
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    },
 
    "date-vn-desc": function ( a, b ) {
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    }
} );