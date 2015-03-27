/**
 * @file: caydonvi.js
 * @author: npbnguyen@gmail.com
 * @date: 25-09-2014
 * @company : http://dnict.vn
 **/
var createTreeviewInMenuBar = function(text_menu){
	var str = '<li id="li_tree_parents" class="open active">';
		str+= '<a class="dropdown-toggle" href="#">';
		str+= '<i class="icon-sitemap"></i>';
		str+= '<span class="menu-text">'+text_menu+'</span>';
		str+= '<b class="arrow icon-angle-down"></b>';
		str+= '</a>';
		str+= '<ul class="submenu open">';
		str+= '<li id="li_tree_child" class="open active">';
		str+= '<div id="main-content-tree"></div>';
		str+= '</li>';
		str+= '</ul>';
		str+= '</li>';
	jQuery('ul.nav-list').prepend(str);
};