!function( $ ) {
$.extend( $.fn.dataTable.defaults, {
	"language": {
        "url": "/media/cbcc/js/dataTables.vietnam.txt"
    },
   //"deferRender":true,
    "pageLength": 20,
    "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "Tất cả"]],
	"paginate": true,
	"processing": true,
	"dom": "<'dataTables_wrapper'<'row-fluid'<'span3'f><'span3'<'pull-right'rT>><'span6'p>t<'row-fluid'<'span2'l><'span4'i><'span6'p>>>"	
} );
}( window.jQuery );