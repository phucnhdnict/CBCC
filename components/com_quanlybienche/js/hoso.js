var clickDieuDong=0;
/*
 * jQuery Asynchronous Plugin 1.0 RC1
 *
 * Copyright (c) 2008 Vincent Robert (genezys.net)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 */
(function($){

// opts.delay : (default 10) delay between async call in ms
// opts.bulk : (default 500) delay during which the loop can continue synchronously without yielding the CPU
// opts.test : (default true) function to test in the while test part
// opts.loop : (default empty) function to call in the while loop part
// opts.end : (default empty) function to call at the end of the while loop
$.whileAsync = function(opts)
{
	var delay = Math.abs(opts.delay) || 10,
		bulk = isNaN(opts.bulk) ? 500 : Math.abs(opts.bulk),
		test = opts.test || function(){ return true; },
		loop = opts.loop || function(){},
		end  = opts.end  || function(){};
	
	(function(){

		var t = false, 
			begin = new Date();
			
		while( t = test() )
		{
			loop();
			if( bulk === 0 || (new Date() - begin) > bulk )
			{
				break;
			}
		}
		if( t ) 
		{
			setTimeout(arguments.callee, delay);
		}
		else
		{
			end();
		}
		
	})();
}

// opts.delay : (default 10) delay between async call in ms
// opts.bulk : (default 500) delay during which the loop can continue synchronously without yielding the CPU
// opts.loop : (default empty) function to call in the each loop part, signature: function(index, value) this = value
// opts.end : (default empty) function to call at the end of the each loop
$.eachAsync = function(array, opts)
{
	var i = 0, 
		l = array.length, 
		loop = opts.loop || function(){};
	
	$.whileAsync(
		$.extend(opts, {
			test: function(){ return i < l; },
			loop: function()
			{ 
				var val = array[i];
				return loop.call(val, i++, val);
			}
		})
	);
}

$.fn.eachAsync = function(opts)
{
	$.eachAsync(this, opts);
	return this;
}

})(jQuery);
var _ind=0;
(function( $ ) { 
 			//tinh nguyen quan
			$.widget( "ui.cadc_code", {
				_create: function() {
					var self = this,
						select = this.element.hide(),
						selected = select.children( ":selected" ),
						value = selected.val() ? selected.text() :"";
					var input = $( "<input style='width:130px;'>" )
						.insertAfter( select )					
						.val( value )
						.autocomplete({
							delay: 0,
							minLength: 0,
							source: function( request, response ) {
								var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
								response( select.children( "option" ).map(function() {
									var text = $( this ).text();
									if ( this.value && ( !request.term || matcher.test(text) ) )
										return {
											label: text.replace(
												new RegExp(
													"(?![^&;]+;)(?!<[^<>]*)(" +
													$.ui.autocomplete.escapeRegex(request.term) +
													")(?![^<>]*>)(?![^&;]+;)", "gi"
												), "<strong>$1</strong>" ),
											value: text,
											option: this
										};
								}) );
							},
							select: function( event, ui ) {
								
								ui.item.option.selected = true;
								self._trigger( "selected", event, {
									item: ui.item.option
								});
								//show_select(idcbx,idcbxAdd,idcbxRem,idsel);
								show_select("cadc_code","dist_placebirth","comm_placebirth","viewhuyen");
								//alert(ui.item.option.value);
							},
							change: function( event, ui ) {
								
								if ( !ui.item ) {
									var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
										valid = false;
									select.children( "option" ).each(function() {
										
										if ( this.value.match( matcher ) ) {
											this.selected = valid = true;
											return false;
										}
									});
									if ( !valid ) {
										// remove invalid value, as it didn't match anything
										$( this ).val( "" );
										select.val( "" );
										return false;
									}
								}
							}
						})					
						.addClass( "ui-widget ui-widget-content ui-corner-left margin-button" );
						
	
					input.data( "autocomplete" )._renderItem = function( ul, item ) {
						return $( "<li></li>" )
							.data( "item.autocomplete", item )
							.append( "<a>" + item.label + "</a>" )
							.appendTo( ul );
					};
	
					$( "<button>&nbsp;</button>" )
						.attr( "tabIndex", -1 )
						.attr( "title", "Hiển thị tất cả" )
						.insertAfter( input )
						.button({
							icons: {
								primary: "ui-icon-triangle-1-s"
							},
							text: false
						})
						.removeClass( "ui-corner-all" )
						.addClass( "ui-corner-right ui-button-icon" )
						.click(function() {
							
							// close if already visible
							/*if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
								input.autocomplete( "close" );
								return;
							}*/
	
							// pass empty string as value to search for, displaying all results
							input.autocomplete( "search", "" );
							input.focus();
							return false;
						});
				}
			
			});
		//huyen nguyen quan
		$.widget( "ui.dist_placebirth", {
			_create: function() {
				var self = this,
					select = this.element.hide(),
					selected = select.children( ":selected" ),
					value = selected.val() ? selected.text() :"";
				var input = $( "<input id='dist_placebirth_text' style='width:130px;'>" )
					.insertAfter( select )					
					.val( value )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: function( request, response ) {
							var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
							response( select.children( "option" ).map(function() {
								var text = $( this ).text();
								if ( this.value && ( !request.term || matcher.test(text) ) )
									return {
										label: text.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(request.term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>" ),
										value: text,
										option: this
									};
							}) );
						},
						select: function( event, ui ) {
							ui.item.option.selected = true;
							self._trigger( "selected", event, {
								item: ui.item.option
							});
							show_select("dist_placebirth","comm_placebirth","","viewxa");
						},
						change: function( event, ui ) {
							if ( !ui.item ) {
								var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
									valid = false;
								select.children( "option" ).each(function() {
									if ( this.value.match( matcher ) ) {
										this.selected = valid = true;
										return false;
									}
								});
								if ( !valid ) {
									// remove invalid value, as it didn't match anything
									$( this ).val( "" );
									select.val( "" );
									return false;
								}
							}
						}
					})					
					.addClass( "ui-widget ui-widget-content ui-corner-left margin-button" );
					

				input.data( "autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li></li>" )
						.data( "item.autocomplete", item )
						.append( "<a>" + item.label + "</a>" )
						.appendTo( ul );
				};

				$( "<button>&nbsp;</button>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Hiển thị tất cả" )
					.insertAfter( input )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "ui-corner-right ui-button-icon" )
					.click(function() {
						
						// close if already visible
						/*if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
							input.autocomplete( "close" );
							return;
						}*/

						// pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
						input.focus();
						return false;
					});
			}
		});
		//xa nguyen quan
		$.widget( "ui.comm_placebirth", {
			_create: function() {
				var self = this,
					select = this.element.hide(),
					selected = select.children( ":selected" ),
					value = selected.val() ? selected.text() :"";
				var input = $( "<input id='comm_placebirth_text' style='width:130px;'>" )
					.insertAfter( select )					
					.val( value )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: function( request, response ) {
							var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
							response( select.children( "option" ).map(function() {
								var text = $( this ).text();
								if ( this.value && ( !request.term || matcher.test(text) ) )
									return {
										label: text.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(request.term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>" ),
										value: text,
										option: this
									};
							}) );
						},
						select: function( event, ui ) {
							ui.item.option.selected = true;
							self._trigger( "selected", event, {
								item: ui.item.option
							});
						},
						change: function( event, ui ) {
							if ( !ui.item ) {
								var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
									valid = false;
								select.children( "option" ).each(function() {
									if ( this.value.match( matcher ) ) {
										this.selected = valid = true;
										return false;
									}
								});
								if ( !valid ) {
									// remove invalid value, as it didn't match anything
									$( this ).val( "" );
									select.val( "" );
									return false;
								}
							}
						}
					})					
					.addClass( "ui-widget ui-widget-content ui-corner-left margin-button" );
					

				input.data( "autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li></li>" )
						.data( "item.autocomplete", item )
						.append( "<a>" + item.label + "</a>" )
						.appendTo( ul );
				};

				$( "<button>&nbsp;</button>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Hiển thị tất cả" )
					.insertAfter( input )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "ui-corner-right ui-button-icon" )
					.click(function() {
						
						// close if already visible
						/*if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
							input.autocomplete( "close" );
							return;
						}*/

						// pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
						input.focus();
						return false;
					});
			}
		});
		//tinh ho khau thuong tru
		$.widget( "ui.city_peraddress", {
			_create: function() {
				var self = this,
					select = this.element.hide(),
					selected = select.children( ":selected" ),
					value = selected.val() ? selected.text() :"";
				var input = $( "<input style='width:130px;'>" )
					.insertAfter( select )					
					.val( value )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: function( request, response ) {
							var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
							response( select.children( "option" ).map(function() {
								var text = $( this ).text();
								if ( this.value && ( !request.term || matcher.test(text) ) )
									return {
										label: text.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(request.term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>" ),
										value: text,
										option: this
									};
							}) );
						},
						select: function( event, ui ) {
							
							ui.item.option.selected = true;
							self._trigger( "selected", event, {
								item: ui.item.option
							});
							show_select("city_peraddress","dist_peraddress","comm_peraddress","viewhuyen");
						},
						change: function( event, ui ) {
							
							if ( !ui.item ) {
								var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
									valid = false;
								select.children( "option" ).each(function() {
									
									if ( this.value.match( matcher ) ) {
										this.selected = valid = true;
										return false;
									}
								});
								if ( !valid ) {
									// remove invalid value, as it didn't match anything
									$( this ).val( "" );
									select.val( "" );
									return false;
								}
							}
						}
					})					
					.addClass( "ui-widget ui-widget-content ui-corner-left margin-button" );
					

				input.data( "autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li></li>" )
						.data( "item.autocomplete", item )
						.append( "<a>" + item.label + "</a>" )
						.appendTo( ul );
				};

				$( "<button>&nbsp;</button>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Hiển thị tất cả" )
					.insertAfter( input )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "ui-corner-right ui-button-icon" )
					.click(function() {
						
						// close if already visible
						/*if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
							input.autocomplete( "close" );
							return;
						}*/

						// pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
						input.focus();
						return false;
					});
			}
		
		});
		//huyen ho khau thuong tru
		$.widget( "ui.dist_peraddress", {
			_create: function() {
				var self = this,
					select = this.element.hide(),
					selected = select.children( ":selected" ),
					value = selected.val() ? selected.text() :"";
				var input = $( "<input id='dist_peraddress_text' style='width:130px'>" )
					.insertAfter( select )					
					.val( value )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: function( request, response ) {
							var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
							response( select.children( "option" ).map(function() {
								var text = $( this ).text();
								if ( this.value && ( !request.term || matcher.test(text) ) )
									return {
										label: text.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(request.term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>" ),
										value: text,
										option: this
									};
							}) );
						},
						select: function( event, ui ) {
							
							ui.item.option.selected = true;
							self._trigger( "selected", event, {
								item: ui.item.option
							});
							show_select("dist_peraddress","comm_peraddress","","viewxa");
						},
						change: function( event, ui ) {
							
							if ( !ui.item ) {
								var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
									valid = false;
								select.children( "option" ).each(function() {
									
									if ( this.value.match( matcher ) ) {
										this.selected = valid = true;
										return false;
									}
								});
								if ( !valid ) {
									// remove invalid value, as it didn't match anything
									$( this ).val( "" );
									select.val( "" );
									return false;
								}
							}
						}
					})					
					.addClass( "ui-widget ui-widget-content ui-corner-left margin-button" );
					

				input.data( "autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li></li>" )
						.data( "item.autocomplete", item )
						.append( "<a>" + item.label + "</a>" )
						.appendTo( ul );
				};

				$( "<button>&nbsp;</button>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Hiển thị tất cả" )
					.insertAfter( input )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "ui-corner-right ui-button-icon" )
					.click(function() {
						
						// close if already visible
						/*if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
							input.autocomplete( "close" );
							return;
						}*/

						// pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
						input.focus();
						return false;
					});
			}
		
		});
		//xa ho khau thuong tru
		$.widget( "ui.comm_peraddress", {
			_create: function() {
				var self = this,
					select = this.element.hide(),
					selected = select.children( ":selected" ),
					value = selected.val() ? selected.text() :"";
				var input = $( "<input id='comm_peraddress_text' style='width:130px'>" )
					.insertAfter( select )					
					.val( value )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: function( request, response ) {
							var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
							response( select.children( "option" ).map(function() {
								var text = $( this ).text();
								if ( this.value && ( !request.term || matcher.test(text) ) )
									return {
										label: text.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(request.term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>" ),
										value: text,
										option: this
									};
							}) );
						},
						select: function( event, ui ) {
							
							ui.item.option.selected = true;
							self._trigger( "selected", event, {
								item: ui.item.option
							});
						},
						change: function( event, ui ) {
							
							if ( !ui.item ) {
								var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
									valid = false;
								select.children( "option" ).each(function() {
									
									if ( this.value.match( matcher ) ) {
										this.selected = valid = true;
										return false;
									}
								});
								if ( !valid ) {
									// remove invalid value, as it didn't match anything
									$( this ).val( "" );
									select.val( "" );
									return false;
								}
							}
						}
					})					
					.addClass( "ui-widget ui-widget-content ui-corner-left margin-button" );
					

				input.data( "autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li></li>" )
						.data( "item.autocomplete", item )
						.append( "<a>" + item.label + "</a>" )
						.appendTo( ul );
				};

				$( "<button>&nbsp;</button>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Hiển thị tất cả" )
					.insertAfter( input )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "ui-corner-right ui-button-icon" )
					.click(function() {
						
						// close if already visible
						/*if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
							input.autocomplete( "close" );
							return;
						}*/

						// pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
						input.focus();
						return false;
					});
			}
		
		});
		//$.widget( "ui.comm_peraddress", {
		$.widget( "ui.combobox", {
			_create: function() {
				var self = this,
					select = this.element.hide(),
					selected = select.children( ":selected" ),
					value = selected.val() ? selected.text() :"";
				var input = $( "<input style='width:130px'>" )
					.insertAfter( select )					
					.val( value )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: function( request, response ) {
							var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
							response( select.children( "option" ).map(function() {
								var text = $( this ).text();
								if ( this.value && ( !request.term || matcher.test(text) ) )
									return {
										label: text.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(request.term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>" ),
										value: text,
										option: this
									};
							}) );
						},
						select: function( event, ui ) {
							
							ui.item.option.selected = true;
							self._trigger( "selected", event, {
								item: ui.item.option
							});
						},
						change: function( event, ui ) {
							
							if ( !ui.item ) {
								var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
									valid = false;
								select.children( "option" ).each(function() {
									
									if ( this.value.match( matcher ) ) {
										this.selected = valid = true;
										return false;
									}
								});
								if ( !valid ) {
									// remove invalid value, as it didn't match anything
									$( this ).val( "" );
									select.val( "" );
									return false;
								}
							}
						}
					})					
					.addClass( "ui-widget ui-widget-content ui-corner-left margin-button" );
					

				input.data( "autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li></li>" )
						.data( "item.autocomplete", item )
						.append( "<a>" + item.label + "</a>" )
						.appendTo( ul );
				};

				$( "<button>&nbsp;</button>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Hiển thị tất cả" )
					.insertAfter( input )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "ui-corner-right ui-button-icon" )
					.click(function() {
						
						// close if already visible
						/*if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
							input.autocomplete( "close" );
							return;
						}*/

						// pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
						input.focus();
						return false;
					});
			}
		
		});
		//xa ho khau thuong tru
		//$.widget( "ui.comm_peraddress", {
		$.widget( "ui.chuyennganh", {
			_create: function() {
				var self = this,
					select = this.element.hide(),
					selected = select.children( ":selected" ),
					value = selected.val() ? selected.text() :"";
				var input = $( "<input style='width:135px' name='LIM_NAME_DT[]' id='LIM_NAME_DT_"+_ind+"'>" )
					.insertAfter( select )					
					.val( value )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: function( request, response ) {
							var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
							response( select.children( "option" ).map(function() {
								var text = $( this ).text();
								if ( this.value && ( !request.term || matcher.test(text) ) )
									return {
										label: text.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(request.term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>" ),
										value: text,
										option: this
									};
							}) );
						},
						select: function( event, ui ) {
							
							ui.item.option.selected = true;
							self._trigger( "selected", event, {
								item: ui.item.option
							});
						},
						change: function( event, ui ) {
							
							if ( !ui.item ) {
								var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
									valid = false;
								select.children( "option" ).each(function() {
									
									if ( this.value.match( matcher ) ) {
										this.selected = valid = true;
										return false;
									}
								});
								if ( !valid ) {
									// remove invalid value, as it didn't match anything
									$( this ).val( "" );
									select.val( "" );
									return false;
								}
							}
						}
					})					
					.addClass( "ui-widget ui-widget-content ui-corner-left margin-button" );
					

				input.data( "autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li></li>" )
						.data( "item.autocomplete", item )
						.append( "<a>" + item.label + "</a>" )
						.appendTo( ul );
				};

				$( "<button>&nbsp;</button>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Hiển thị tất cả" )
					.insertAfter( input )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "ui-corner-right ui-button-icon" )
					.click(function() {
						
						// close if already visible
						/*if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
							input.autocomplete( "close" );
							return;
						}*/

						// pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
						input.focus();
						return false;
					});
			}
		
		});
	})( $ );
function openEmp(id,dept_code,status,pagcurrent,limit,tree,userId){
	var url_='';
	var name=jQuery("#txtSearch").val();
	jQuery("#cbxLimit").val(limit);
	jQuery("#pagcurrent").val(pagcurrent);
	var cbxLimit=jQuery("#cbxLimit").val();
	var start=(pagcurrent)*limit;
	var filter=jQuery("#colorder").val();
	//alert('filter '+filter);
	var order='';//jQuery("#"+filter).attr('title');
	if(filter=='' || filter==0 || filter===null){
		filter='chucvu';
	}else{
		order=jQuery("#"+filter).attr('title');
	}
	if(order!=''){
		if(order=='asc'){
			jQuery("#"+filter).attr('title','desc');
		}else{
			jQuery("#"+filter).attr('title','asc');
		}
	}else{
		order='desc';
	}
	var len;
	loading("loading");
	jQuery("#empList").show();
	jQuery("#detailEmp").hide();
	$("#dvdieudong").hide();
	$("#bdthuyenchuyen").html('');
	jQuery("#iddv").val(id);
	jQuery("#phong_id").val(dept_code);
	jQuery("#status").val(status);
	jQuery('#mixed span').css("background-color","white");

	if(dept_code>0){
		jQuery('#mixed span#sp'+dept_code).css("background-color","#FFFAB0");
	}else if(dept_code==-1){
		jQuery('#mixed span#sp0').css("background-color","#FFFAB0");
	}else{
		jQuery('#mixed span#sp'+id).css("background-color","#FFFAB0");
	}
	jQuery("#dvbtn1").show();
	
	jQuery("#task").val('getEmpByInstCode');
	var myUrl="index.php?option=com_hoso&controller=hoso&task=getEmpByInstCode&format=raw";
//	alert("iddv=" + id +"&dept_code=" + dept_code +"&status=" + status +"&start=" + 
//			start + "&count=" +cbxLimit+"&name="+name+"&filter="+filter+"&order="+order);
	if(id){
		$.ajax({
			url: myUrl,
			type: 'POST',
			cache: false,
			//data:"iddv=" + id +"&dept_code=" + dept_code +"&status=" + status,
			data:"iddv=" + id +"&dept_code=" + dept_code +"&status=" + status +"&start=" + 
			start + "&count=" +cbxLimit+"&name="+name+"&filter="+filter+"&order="+order,
			success: function(string){
				//alert(string);//return false;
				var getData,disuser;
				
				try{
					getData = $.parseJSON(string);
				}catch(e){
					// We report an error, and show the erronous JSON string (we replace all " by ', to prevent another error)
					getData=$.parseJSON( '{"code":"error","content":"' + e.replace(/"/g, "'") + '"}' ); 
				} 
				len=getData.length;
				jQuery("#bdhoso").html('');
				jQuery("#dvpage").html('');
				if(len){
					for(rowindex=0;rowindex<len;rowindex++){
						stt=start+rowindex+1;
						disuser=(getData[rowindex].id==userId)?"disabled='disabled'":"class='chkEmp'";
						str="<tr class='row"+(rowindex%2)+"'>"+
								"<td><input type='checkbox' "+disuser+"  name='chkEmp[]' value='"+getData[rowindex].id+"'></td>"+
								"<td align='center'>"+(stt)+"</td>"+
								"<td><a onclick='viewDetailEmp("+getData[rowindex].id+")' href='#'>"+getData[rowindex].e_name+"</a></td>"+
								"<td align='center'>"+getData[rowindex].ngaysinh+"</td>"+
								"<td>"+getData[rowindex].sta_name+"</td>"+
								"<td align='center'>"+getData[rowindex].sl_code+"</td>"+
								"<td align='center'>"+getData[rowindex].vk+"</td>"+
								"<td align='center'>"+getData[rowindex].trinhdo+"</td>"+
								"<td align='center'>"+getData[rowindex].tinhoc+"</td>"+
								"<td align='center'>"+getData[rowindex].tienganh+"</td>"+
								"<td align='center'>"+getData[rowindex].qlnn+"</td>"+
								"<td align='center'>"+getData[rowindex].chinhtri+"</td>"+
								"<td align='center'>"+getData[rowindex].qpan+"</td>"+
								"<td>"+getData[rowindex].position+"</td>"+
								"<td>"+getData[rowindex].tenphong+"</td>"+
								"<td>"+getData[rowindex].loaihinh+" "+getData[rowindex].loaihinh2+"</td>"+
								"<td align='center'>"+getData[rowindex].dangvien+"</td>"+
								"<td>"+getData[rowindex].dtthuhut+" "+ getData[rowindex].dt47+" "+getData[rowindex].dt393+"</td>"+
								"<td>"+getData[rowindex].ghichu+"</td>"+
							"</tr>";
						jQuery("#bdhoso").append(str);
						
					}
					jQuery.post(myUrl,{iddv:id,dept_code:dept_code,status:status,count:0,end:0,pagination:1,name:name},function(data){
						var pagcurr=jQuery("#pagcurrent").val();
						var numberpag=parseInt(data/cbxLimit);
						var mod=data%cbxLimit;
						if(mod>0){
							numberpag+=1;
						}
						if(numberpag>0){
							var fist,last,end;
							fist=parseInt(pagcurr)-5;
							if(fist<1) fist=1;
							//hien thi 10 trang
							last=fist+9;
							if(last>(numberpag-1)) last=numberpag;
							//neu trang hien tai la trang dau tien 
							if(pagcurr==0){
								jQuery("#dvpage").append("<span style='padding:4px 10px;margin:2px;background: #fff;color:red;border: solid 1px #eee'>Đầu tiên</span>");
								jQuery("#dvpage").append("<span style='padding:4px 10px;margin:2px;background: #fff;color:red;border: solid 1px #eee'>Trước</span>");
							}else{
								jQuery("#dvpage").append("<a onclick='openId("+id+","+dept_code+",\""+status+"\",0,"+cbxLimit+",\"not\")' href='#'>Đầu tiên</a>");
								jQuery("#dvpage").append("<a onclick='prevnextpage(\"prev\")' href='#'>Trước</a>");
							}
							
							for(page=fist;page<=last;page++){
								if(pagcurr==(page-1)){
									jQuery("#dvpage").append("<span style='padding:4px 10px;margin:2px;background: #fff;color:red;border: solid 1px #eee'>"+page+"</span>");
								}else{
									jQuery("#dvpage").append("<a href='#' onclick='openId("+id+","+dept_code+",\""+status+"\","+(page-1)+","+cbxLimit+",\"not\")'>"+page+"</a>");
								}
							}
							//neu trang hien tai la trang cuoi cung
							if(pagcurr==numberpag-1){
								jQuery("#dvpage").append("<span style='padding:4px 10px;margin:2px;background: #fff;color:red;border: solid 1px #eee'>Sau</span>");
								jQuery("#dvpage").append("<span style='padding:4px 10px;margin:2px;background: #fff;color:red;border: solid 1px #eee'>Cuối cùng</span>");
							}else{
								jQuery("#dvpage").append("<a onclick='prevnextpage(\"next\")' href='#'>Sau</a>");
								jQuery("#dvpage").append("<a onclick='openId("+id+","+dept_code+",\""+status+"\","+(numberpag-1)+","+cbxLimit+",\"not\")' href='#'>Cuối cùng</a>");
							}
							
							if(parseInt(len)<limit){
								 end=parseInt(len);
							}
							else{
								end=parseInt(limit);
							}
							jQuery("#dvpage").append("<div style='padding:10px;font-weight:bold'>Hiển thị "+(start+1)+" đến "+(parseInt(start)+end)+" của "+parseInt(data)+" nhân viên</div>");
							
						}
					});//end post
				}
				jQuery("#loading").hide();
				
				var url2="index.php?option=com_hoso&controller=hoso&task=getThongKeDonVi&format=raw";
				//khong phai click vao so trang hoac next, prev... thi load so luong
				if(tree!='not'){
					
					jQuery("#dvsoluong").html('');
					if(!name){
						$.post(url2,{iddv:id,status:status,dept_code:dept_code},function(data){
							//alert(data);return false;
							var getData=$.parseJSON(data);
							
							if(getData.length>0){
								if(getData[0].tong>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Tổng số: "+getData[0].tong+"</div>");
								}
								if(getData[0].baucu>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Bầu cử: "+getData[0].baucu+"</div>");
								}
								if(getData[0].CC_CVCC>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>CVCC & TĐ: "+getData[0].CC_CVCC+"</div>");
								}
								if(getData[0].CC_CVC>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>CVC & TĐ: "+getData[0].CC_CVC+"</div>");
								}
								if(getData[0].CC_CV>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>CV & TĐ: "+getData[0].CC_CV+"</div>");
								}
								if(getData[0].CC_CS>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>CS & TĐ: "+getData[0].CC_CS+"</div>");
								}
								if(getData[0].CC_CL>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Còn lại: "+getData[0].CC_CL+"</div>");
								}
								if(getData[0].CM_TS>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Tiến sĩ: "+getData[0].CM_TS+"</div>");
								}
								if(getData[0].CM_TsS>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Thạc sĩ: "+getData[0].CM_TsS+"</div>");
								}
								if(getData[0].CM_DaiHoc>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Đại học: "+getData[0].CM_DaiHoc+"</div>");
								}
								if(getData[0].CM_CaoDang>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Cao Đẳng: "+getData[0].CM_CaoDang+"</div>");
								}
								if(getData[0].CM_TrungCap>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Trung Cấp: "+getData[0].CM_TrungCap+"</div>");
								}
								if(getData[0].CM_ConLai>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Còn lại: "+getData[0].CM_ConLai+"</div>");
								}
								if(getData[0].CT_CC>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Cao cấp (C/Trị): "+getData[0].CT_CC+"</div>");
								}
								if(getData[0].CT_TC>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Trung cấp (C/Trị): "+getData[0].CT_TC+"</div>");
								}
								if(getData[0].TH_CN>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Cử nhân (T/Học): "+getData[0].TH_CN+"</div>");
								}
								if(getData[0].TH_CS>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Cơ sở (T/Học): "+getData[0].TH_CS+"</div>");
								}
								if(getData[0].AV_CN>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Cử nhân (A/Văn): "+getData[0].AV_CN+"</div>");
								}
								if(getData[0].AV_CS>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Cơ sở (A/Văn): "+getData[0].AV_CS+"</div>");
								}
								if(getData[0].NN_CN>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Cử nhân (NN Khác): "+getData[0].NN_CN+"</div>");
								}
								if(getData[0].NN_CS>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Cơ sở (NN Khác): "+getData[0].NN_CS+"</div>");
								}
								if(getData[0].TD_D30>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Dưới 30 tuổi: "+getData[0].TD_D30+"</div>");
								}
								if(getData[0].TD_30_50>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Từ 30-50 tuổi: "+getData[0].TD_30_50+"</div>");
								}
								if(getData[0].TD_T50_60>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Từ 50-60 tuổi: "+getData[0].TD_T50_60+"</div>");
								}
								if(getData[0].TD_54_59>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Nữ 54, nam 59 tuổi: "+getData[0].TD_54_59+"</div>");
								}
								if(getData[0].DANG_VIEN>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Đảng viên: "+getData[0].DANG_VIEN+"</div>");
								}
								if(getData[0].NU>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>Nữ: "+getData[0].NU+"</div>");
								}
								if(getData[0].DAN_TOC>0){
									jQuery("#dvsoluong").append("<div style='float:left' class='soluong'>D/tộc thiểu số: "+getData[0].DAN_TOC+"</div>");
								}
							}
						});
					}	
					url_="index.php?option=com_hoso&controller=hoso&task=checkRoleAddDel&format=raw";
					$.post(url_,{iddv:id},function(data){
						var getData=$.parseJSON(data);
						if(getData.length>0){
							if(getData[0].add>0){
								$("#btnAdd").show();
							}else{
								$("#btnAdd").hide();
							}
							if(getData[0].del>0){
								$("#btnDel").show();
							}else{
								$("#btnDel").hide();
							}
							if(getData[0].mov>0){
								$("#btnMov").show();
							}else{
								$("#btnMov").hide();
							}
							if(getData[0].auth>0){
								$("#btnAuth").show();
							}else{
								$("#btnAuth").hide();
							}
							if(getData[0].cancel>0){
								$("#btnCancel").show();
							}else{
								$("#btnCancel").hide();
							}
						}
					});
					jQuery("#txtSearch").val('');
				}
				
			},
			error: function (){
				alert('Có lỗi xảy ra');
			}
			
		});
		//get count dieu dong
		getCountMoves();
		//list danh sach ho so cho dieu dong
		listDieuDongScript();
	}else
		jQuery("#loading").hide();
}
//get count dieu dong
function getCountMoves(){
	
	var url_="index.php?option=com_hoso&controller=chuyenhs&task=getCountMoves&format=raw";
	$.post(url_,function(count){
		$("#lblCoutMove").html(count);
	});
}
function prevnextpage(action){
	var iddv=jQuery("#iddv").val();
	var dept_code=jQuery("#phong_id").val();
	var status=jQuery("#status").val();
	var pagg;
	if(action=='prev'){
		pagg=parseInt(jQuery("#pagcurrent").val())-1;
	}else{
		pagg=parseInt(jQuery("#pagcurrent").val())+1;
	}
	openId(iddv,dept_code,status,pagg,jQuery("#cbxLimit").val(),'not');
	
}
function searchEmp(){
	var iddv=jQuery("#iddv").val();
	var dept_code=jQuery("#phong_id").val();
	var status=jQuery("#status").val();
	openId(iddv,dept_code,status,0,parseInt(jQuery("#cbxLimit").val()));	
}
function AddNew(){
	var iddv=jQuery("#iddv").val();
	jQuery("#empList").hide();
	jQuery("#detailEmp").show();
	if(iddv>0){
		var myUrl="index.php?option=com_hoso&controller=hoso&task=viewdetail&format=raw";
		jQuery.post(myUrl,{empId:0,id:iddv,layout:'quickDetail',opt:'viewemp'},function(data){
			jQuery("#detailEmp").html(data);
		});
	}else{
		alert("Vui lòng chọn 1 đơn vị trước khi thêm mới 1 nhân viên");
		return false;
	}
}
function chkAllEmp(){
	var chk=jQuery("#chkAll").attr('checked');
	jQuery('.chkEmp').attr('checked',chk);
}
function callback() {
	jQuery("#searchResults > tr").hover(function() {
		jQuery(this).find("td").toggleClass("background");
	});
}
function delEmp(){
	var iddv=jQuery("#iddv").val();
	var valEmp=jQuery('input[name="chkEmp[]"]').fieldValue(true);
	if(valEmp!=""){
		if(confirm('Bạn có chắc chắn muốn xóa?')==true){
			loading("loading");
			jQuery.post("index.php?option=com_hoso&controller=hoso&task=delEmp&format=raw",
					//{'emp_id[]':valEmp,iddv:iddv,dept_code:dept_code,status:status},function(string) {
					{'emp_id[]':valEmp,iddv:iddv},function(string) {
						searchEmp();
			});
		}else{
			jQuery('input[name="chkEmp[]"]').attr("checked","");
		}
		jQuery("#loading").html('');
	}
}
function checkDoiTuong(){
	//check trinh do thu hut
	if(jQuery("#dt_thuhut").is(":checked") && jQuery("#dt_47").attr("checked")==false && jQuery("#dt_393").attr("checked")==false){
		jQuery("#thuhut_trinhdo").attr("checked",true);
		jQuery("#dv_thuhut_trinhdo").show();
	}else{
		jQuery("#thuhut_trinhdo").attr("checked",false);
		jQuery("#dv_thuhut_trinhdo").hide();
	}
	
	//check trinh do 47
	if(jQuery("#dt_47").is(":checked") && jQuery("#dt_thuhut").attr("checked")==false && jQuery("#dt_393").attr("checked")==false){
		jQuery("#47_trinhdo").attr("checked",true);
		jQuery("#dv_47_trinhdo").show();
	}else{
		jQuery("#47_trinhdo").attr("checked",false);
		jQuery("#dv_47_trinhdo").hide();
	}
	//check trinh do 393
	if(jQuery("#dt_393").is(":checked") && jQuery("#dt_thuhut").attr("checked")==false && jQuery("#dt_47").attr("checked")==false){
		jQuery("#393_trinhdo").attr("checked",true);
		jQuery("#393_trinhdo1").val(1);
		jQuery("#dv_393_trinhdo").show();
	}else{
		jQuery("#393_trinhdo").attr("checked",false);
		jQuery("#dv_393_trinhdo").hide();
	}
	
	if((jQuery("#dt_47").is(":checked") && jQuery("#dt_393").is(":checked") && jQuery("#dt_thuhut").attr("checked")==false) || 
		(jQuery("#dt_thuhut").is(":checked") && jQuery("#dt_393").is(":checked") && jQuery("#dt_47").attr("checked")==false)){
		jQuery("#393_trinhdo").attr("checked",true).attr("disabled",true);
		jQuery("#393_trinhdo1").val(1);
		jQuery("#dv_393_trinhdo").show();
	}
}
function show_select(idcbx,idcbxAdd,idcbxRem,idsel) {
	var id=jQuery('#'+idcbx).val();
	var task='viewselect';
	var url="index.php?option=com_hoso&controller=hoso&format=raw";
	jQuery("#"+idcbxAdd+"_text").val('');
	if(idcbxRem!=""){
		jQuery("#"+idcbxRem+"_text").val('');
	}
	jQuery.post(url,{task:task,id:id,select:idsel},function(data){
		//alert(data);
		var obj=$.parseJSON(data);
		var len=obj.length;
		if(idcbxRem!='') jQuery("#"+idcbxRem+" option").remove();
		jQuery("#"+idcbxAdd+" option").remove();
		if(len>0){
			jQuery("#"+idcbxAdd).append("<option value=''></option>");
			for(i=0;i<len;i++){
				jQuery("#"+idcbxAdd).append("<option value='"+obj[i].value+"'>"+obj[i].text+"</option>");
			}
		}
	});
};
function goEmpList(){
	/*if(validator!=undefined){
		validator.resetForm();
	}*/
	var iddv=jQuery("#iddv").val();
	var dept_code=jQuery("#phong_id").val();
	var status=jQuery("#status").val();
	$("#empList").show();
	$("#detailEmp").hide();
	$("#dvdieudong").hide();
	$("#bdthuyenchuyen").html('');
	openId(iddv,dept_code,status,parseInt(jQuery("#pagcurrent").val()),parseInt(jQuery("#cbxLimit").val()),'not');
}
function dieuDong(){
	var iddv=jQuery("#iddv").val();
	$("#donvi_move").val(iddv);
	var valEmp=jQuery('input[name="chkEmp[]"]').fieldValue(true);
	if(valEmp==""){
		alert('Chọn hồ sơ cần điều động!');
		return;
	}else{
		var strid=jQuery("input[name='chkEmp[]']").fieldValue(true);
		jQuery("#empList").hide();
		jQuery("#dvdieudong").show();
		viewDieuDong(strid);
	}		
}
//liet ke danh sach ho so cho dieu dong theo tung don vi hoac tung phong
function listDieuDongScript(){
	//alert('d');return;
	var url='index.php?option=com_hoso&controller=chuyenhs&format=raw&task=getJsonDieuDong';
	$.post(url,function (data){
		//alert(data);
		var getData,error=0,len=0,str='';
		try{
			getData=$.parseJSON(data);
		}catch(e){
			error=1;
		}
		if(error==0){
			$("#bdwaitdieudong").html('');
			len=getData.length;
			for(i=0;i<len;i++){
				str='<tr>';
				str+='<td><input type="checkbox" value="'+getData[i].empid+'" name="empdd[]"/></td>';
				str+='<td>'+(i+1)+'</td>';
				str+='<td><a href="#" onclick="viewDetail('+getData[i].empid+')">'+getData[i].name+'</a></td>';
				str+='<td>'+getData[i].inst_name_old+'</td>';
				str+='<td>'+getData[i].inst_name_new+'</td>';
				str+='<td><input class="off ui-widget ui-widget-content ui-corner-all" size="8" type="text" '+
					'name="ngaychuyen[]" value="'+getData[i].ngaychuyen+'" id="ngaychuyen_init'+i+'"/></td>';
				str+='<td><input class="off ui-widget ui-widget-content ui-corner-all" size="10" type="text"'+ 
					'name="soqd[]" value="'+getData[i].soqd+'" id="soqd_init'+i+'"/></td>';
				str+='<td><input class="off ui-widget ui-widget-content ui-corner-all" size="8" type="text" '+
					'name="ngayqd[]" value="'+getData[i].ngayqd+'" id="ngayqd_init'+i+'"/></td>';
				str+='</tr>';
				$("#bdwaitdieudong").append(str);
				$("#ngaychuyen_init"+i).mask('99/99/9999');
				$("#ngayqd_init"+i).mask('99/99/9999');
			}
		}
	});
	url='index.php?option=com_hoso&controller=chuyenhs&task=getJsonHisMove&format=raw';
	$.post(url,function(data2){
		//alert(data2);//return;
		var getData2,error2=0,len2=0,str2='';
		if(data2!=null){
			try{
				getData2=$.parseJSON(data2);
			}catch(e){
				error2=1;
			}
		}else{
			error2=1;
		}
		if(error2==0){
			$('#bdhisdieudong').html('');
			len2=getData2.length;
			for(j=0;j<len2;j++){
				str2='<tr>';
				str2+='<td>'+getData2[j].name+'</td>';
				str2+='<td>'+getData2[j].inst_name+'</td>';
				str2+='<td>'+getData2[j].dept_name+'</td>';
				str2+='<td>'+getData2[j].position+'</td>';
				str2+='<td>'+getData2[j].inst_name_to+'</td>';
				str2+='<td>'+getData2[j].tungay+'</td>';
				str2+='<td>'+getData2[j].inst_name_cur+'</td>';
				str2+='<td>'+getData2[j].dept_name_cur+'</td>';
				str2+='<td>'+getData2[j].position_cur+'</td></tr>';
				$('#bdhisdieudong').append(str2);
			}
		}
	});
}
function viewDetail(empId){
	var myUrl="index.php?option=com_hoso&y="+empId;
	window.open(myUrl);

}
function viewDieuDong(strid){
	var myUrl="index.php?option=com_hoso&controller=chuyenhs&format=raw&task=getEmpDieuDong";
	$.ajax({
		url: myUrl,
		type: 'POST',
		cache: false,
		data:"strid=" + strid,
		success: function(string){
			//alert(string);return false;
			var getData,iserror=0,rowindex;
			
			try{
				getData = $.parseJSON(string);
			}catch(e){
				iserror=1; 
			} 
			if(iserror==0){
				len=getData.length;
				jQuery("#bdthuyenchuyen").html('');
				if(len){
					for(rowindex=0;rowindex<len;rowindex++){
						stt=rowindex+1;
						str="<tr>"+
								"<td><input type='hidden' name='idchuyen[]' value='"+getData[rowindex].id+"'>"+(stt)+
								"<input style='display:none' type='checkbox' name='id_chuyen[]' value='"+getData[rowindex].id+"' checked='checked'></td>"+
								"<td><a onclick='viewDetail("+getData[rowindex].id+")' href='#'>"+getData[rowindex].e_name+"</a></td>"+
								"<td>"+getData[rowindex].ngaysinh+"</td>"+
								"<td>"+getData[rowindex].sta_name+"</td>"+
								"<td>"+getData[rowindex].sl_code+"</td>"+
								"<td>"+getData[rowindex].trinhdo+"</td>"+
								"<td>"+getData[rowindex].tinhoc+"</td>"+
								"<td>"+getData[rowindex].tienganh+"</td>"+
								"<td>"+getData[rowindex].qlnn+"</td>"+
								"<td>"+getData[rowindex].chinhtri+"</td>"+
								"<td>"+getData[rowindex].qpan+"</td>"+
								"<td>"+getData[rowindex].position+"</td>"+
								"<td>"+getData[rowindex].tenphong+"</td>"+
								"<td>"+getData[rowindex].loaihinh+" "+getData[rowindex].loaihinh2+"</td>"+
								"<td>"+getData[rowindex].dangvien+"</td>"+
//								"<td>"+getData[rowindex].dtthuhut+" "+ getData[rowindex].dt47+" "+getData[rowindex].dt393+"</td>"+
//								"<td>"+getData[rowindex].ghichu+"</td>"+
								"<td width='170px'>"+
									'<div class="ausu-suggest" style="float:left;width:130px">'+
										'<input class="ui-corner-all required" alt="'+rowindex+'" style="width:90px;" type="text" id="donvi_'+rowindex+'" value="" name="donvi[]" autocomplete="off">'+
										'<input type="hidden" id="donviid_'+rowindex+'" value="" name="donviid[]">'+
										'<a style="margin:0 0 0 2px;" class="buttonacc" href="#" onclick="viewDonVi('+rowindex+');" rel="facebox">'+
											'<img style="padding:5px 0 0 5px;" src="/components/com_hoso/images/icon-20-tree.png" alt="" />'+
										'</a>'+
									'</div>'+
									
								"</td>"+
								"<td><input type='text' style='width:55px' class='ui-corner-all' name='ngaychuyen[]' id='ngaychuyen_"+rowindex+"'></td>"+
								"<td><input type='text' style='width:55px' class='ui-corner-all' name='soqd[]' id='soqd_"+rowindex+"'></td>"+
								"<td><input type='text' style='width:55px' class='ui-corner-all' name='ngayqd[]' id='ngayqd_"+rowindex+"'></td>"+
							"</tr>";
						jQuery("#bdthuyenchuyen").append(str);
						jQuery("#ngaychuyen_"+rowindex).mask("99/99/9999");
						jQuery("#ngayqd_"+rowindex).mask("99/99/9999");
					}
					$.fn.autosugguest({  
				           className: 'ausu-suggest',
				          methodType: 'POST',
				            minChars: 2,
				              rtnIDs: true,
				            dataFile: 'index.php?option=com_hoso&controller=chuyenhs&task=getValueAuto&format=raw'
				    });
				}
			}
		},
		error: function (){
			alert('Có lỗi xảy ra');
		}
		
	});
}
function viewDonVi(index){
	var url="index.php?option=com_hoso&controller=hoso&task=viewFace&format=raw&layout=facedonvi";
	$("#_index").val(index);
	$.facebox({
		closeImage:'<?php echo JURI::base(true) ; ?>/components/com_hoso/css/facebox/loading.gif'
		},function() {
		$("#_indexx").val(index); 
		$.post(url, function(data) { 
				$.facebox(data); 
		});
	});
}
function setWaitMoves(){
	
	var container = $('div.container');
	// validate the form when it is submitted
	validator = $("#frmDieuDong").validate({
   		 rules : {
			'donvi[]':{required: true},
    	    'ngaychuyen[]': { required: true,dateVN:true }
    	  },
    	  messages: {
    		  'ngaychuyen[]': {
	  				required: 'Yêu cầu nhập ngày bắt đầu chuyển!',
	  				dateVN: 'Nhập ngày bắt đầu chuyển sai định dạng (dd/mm/yyy)!'
	  			},
	  			'donvi[]':{
	  				required:'Yêu cầu nhập đơn vị chuyển đến!'
	  			}
	  		},  	
		errorContainer: container,
		errorLabelContainer: $("ol", container),
		wrapper: 'li',
		meta: "validate"
	});
	var ret=jQuery("#frmDieuDong").valid();
	if(ret){
		if(confirm("Bạn có chắc chắn muốn chuyển những hồ sơ này?")){
			var myUrl="index.php?option=com_hoso&controller=chuyenhs&format=raw&task=setWaitMoves";
			$.ajax({
				url: myUrl,
				type: 'POST',
				cache: false,
				data:jQuery("#frmDieuDong").serialize(),
				success: function(string){
					//alert(string);//return;
					jQuery("#messSucc").fadeIn("fast");
                	jQuery("#messSucc").html(string).fadeOut(10000);
					var strid=jQuery("input[name='id_chuyen[]']").fieldValue(true);
					viewDieuDong(strid);
				},
				error: function (){
					alert('Có lỗi xảy ra');
				}
				
			});
		}
	}
}
function thuyenChuyen(){
	var container = $('div.container');
	// validate the form when it is submitted
	validator = $("#frmDieuDong").validate({
   		 rules : {
			'donvi[]':{required: true},
    	    'ngaychuyen[]': { required: true,dateVN:true }
    	  },
    	  messages: {
    		  'ngaychuyen[]': {
	  				required: 'Yêu cầu nhập ngày bắt đầu chuyển!',
	  				dateVN: 'Nhập ngày bắt đầu chuyển sai định dạng (dd/mm/yyy)!'
	  			},
	  			'donvi[]':{
	  				required:'Yêu cầu nhập đơn vị chuyển đến!'
	  			}
	  		},  	
		errorContainer: container,
		errorLabelContainer: $("ol", container),
		wrapper: 'li',
		meta: "validate"
	});
	var ret=jQuery("#frmDieuDong").valid();
	if(ret){
		if(confirm("Bạn có chắc chắn muốn chuyển những hồ sơ này?")){
			var myUrl="index.php?option=com_chuyenhs&controller=chuyenhs&format=raw&task=setEmpThuyenChuyen";
			$.ajax({
				url: myUrl,
				type: 'POST',
				cache: false,
				data:jQuery("#frmDieuDong").serialize(),
				success: function(string){
					jQuery("#messSucc").fadeIn("fast");
                	jQuery("#messSucc").html(string).fadeOut(10000);
					var strid=jQuery("input[name='id_chuyen[]']").fieldValue(true);
					viewDieuDong(strid);
				},
				error: function (){
					alert('Có lỗi xảy ra');
				}
				
			});
		}
	}
}
//liet ke danh sach ho so cho dieu dong
function listDieuDong(){
	var iddv=$("#iddv").val();
	var phong_id=$("#phong_id").val();
	if(clickDieuDong==0){
		jQuery.post("index.php?option=com_hoso&controller=chuyenhs&task=loadDieuDong&format=raw",
				{iddv:iddv,phong_id:phong_id },function(data) {
					//alert(data);
					jQuery("#dieudong").html(data);
		});
	}
	clickDieuDong++;
}
//huy danh sach cho dieu dong
function cancelMoves(){
	var iddv=$("#iddv").val();
	var phong=$("#phong_id").val();
	var empdd=$('input[name=empdd[]]').fieldValue(true);
	if(empdd!=''){
		if(confirm('Bạn có chắc chắn muốn hủy điều động các hồ sơ đã chọn?')){
			var url='index.php?option=com_hoso&controller=chuyenhs&format=raw&task=cancelMoves';
			$.post(url,{empdd:empdd},function(data){
				getCountMoves();
				//listDieuDongScript(iddv,phong);
			});
		}else{
			$('input[name=empdd[]]').attr('checked',false);
		}
	}
}
//xac thuc dieu dong
function authMoves(){
	var iddv=$("#iddv").val();
	var phong=$("#phong_id").val();
	var url='index.php?option=com_hoso&controller=chuyenhs&format=raw&task=authMoves';
	var empdd=$('input[name=empdd[]]').fieldValue(true);
	if(empdd!=''){
		if(confirm('Bạn có chắc chắn muốn xác nhận điều động các hồ sơ đã chọn?')){
			$.ajax({
				url: url,
    			type: 'POST',
    			cache: false,
    			data: jQuery("#frmMoves").serialize(),
    			success: function(string){
				//alert(string);
					getCountMoves();
					listDieuDongScript(iddv,phong);
				},
    			error: function (){
    				jQuery("#mess").html("Lỗi cập nhật!");
    			}	
			});
		}else{
			$('input[name=empdd[]]').attr('checked');
		}
	}
}