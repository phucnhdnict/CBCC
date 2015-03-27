function checkOpenTab(id){
	if(jQuery(id).val() == 1){
		return true
	}else{
		jQuery(id).val(1)
		return false
	}
}