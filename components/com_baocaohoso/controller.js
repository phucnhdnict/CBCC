function display(divContent,isOpenId,controller,task){
	if(checkOpenTab(isOpenId) == false ) { //Bo cai true di sau khi lam xong  || checkOpenTab(isOpenId) == true
//		console.log (checkOpenTab(isOpenId));
//		loading();
		
		var url="index.php?option=com_baocaohoso&controller="+controller+"&task=display&format=raw"
	    jQuery.post(url,function(data){
	    	 jQuery(divContent).html(data)
//	    	 jQuery.unblockUI();
//	    	 ({
//	             onUnblock: function() { alert ('Goi ham UnblockUI trong controller.js 1'); }
//	         });
	    })  				
	}
}

function submit(divContent,isOpenId,controller,task,frmName){
	loading()
	var url="index.php?option=com_baocaohoso&controller="+controller+"&task="+task+"&format=raw"
    jQuery.post(url,jQuery(frmName).serialize(),function(data){
    	 jQuery(divContent).html(data)
//    	 jQuery.unblockUI();
//    	 ({
//             onUnblock: function() { console.log ('Goi ham UnblockUI trong controller.js 2'); }
//         });
    })  				
}