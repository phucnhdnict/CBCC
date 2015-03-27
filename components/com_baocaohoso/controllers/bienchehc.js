bienchehc={
	option:'com_baocaohoso',
	controller:'bienchehc'
}


bienchehc.getListDv = function getListDv(divContent,frmName){
	
	var task = arguments.callee.toString()
	task = task.substr('function '.length)
	task = task.substr(0, task .indexOf('('))
	
	url = "index.php?&task="+task
	loading()
	
	//alert($(frmName).serialize());
	
	jQuery.post(url,jQuery(frmName).serialize(),function(data){
		jQuery(divContent).html(data)
		jQuery.unblockUI()
	})
}

