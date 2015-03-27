<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class KekhaitaisanViewKekhaitaisan extends JViewLegacy
{
	function display($tpl = null)
	{
		$task = JFactory::getApplication()->input->get('task');
		$task = ($task == null)?'default':strtoupper($task);
		switch($task){
			case "GETTAISAN":				
				$this->getListDv();
				break;
			case "LUUTIEPTUC":
				$this->luuTieptuc(); // lưu kkts_kekhai
				$this->xoaTaisan();	// xóa tài sản trước khi lưu
				$this->luuNhanthan(); // lưu hoso_nhanthan
				$this->luuTaisan(); // lưu tài sản khác + đất + nhà
				break;
			case "GETDIST":
				$this->getDist();
				break;
			case "GETCOMM":
				$this->getComm();
				break;
		}		
	}
	/**
	 * Lấy thông tin tài sản
	 */
	public function getTaisan(){
		$model		=	Core::model('Kekhaitaisan/Kekhaitaisan');
    	$data		=	$model->listTaisan(array('id', 'tenloaitaisan', 'type'), array('status = 1', 'parent_id = 0'));
		header('Content-type: application/json');
		echo json_encode($data);
		die;
	}
	/**
	 * Lưu thông tin kê khai , kiểm tra kê khai cũ hay mới để update/ insert
	 */
	public function luuTieptuc(){
		$model		=	Core::model('Kekhaitaisan/Kekhaitaisan');
		$hoso_id	=	$_POST['hosochinh_id'];
		$dotkekhai_id	=	$_POST['dotkekhai_id'];
		$model->saveKekhai($hoso_id, $dotkekhai_id);
		$kekhai_id = $model->getKekhaiid($hoso_id, $dotkekhai_id);
		$this->kekhai_id = $kekhai_id;
	}
	/**
	 * Xóa tài sản
	 */
	public function xoaTaisan(){
		$model		=	Core::model('Kekhaitaisan/Kekhaitaisan');
		$kekhai_id 	= 	$this->kekhai_id;
		$model->deleteNhaDat($kekhai_id);
	}
	/**
	 * Lưu thông tin tài sản
	 */
	public function luuTaisan(){
		$kekhai_id 	= 	$this->kekhai_id;
		$arrr		=	array();
		$arrNhaKey	=	array();
		$arrNhaVal	=	array();
		$arrNhaend	=	array();
		$arrDatKey	=	array();
		$arrDatVal	=	array();
		$arrDatend	=	array();
		$arrTskKey	=	array();
		$arrTskVal	=	array();
		$arrTskend	=	array();
		$model		=	Core::model('Kekhaitaisan/Kekhaitaisan');
		$hoso_id	=	$_POST['hosochinh_id'];
		parse_str($_POST['formData'], $arrr); // chuyển string $_POST ra thành mảng
		//----------------------------Lưu thông tin nhà ---------------------
		foreach($arrr as $key=>$val ){
			if ($this->startsWith($key, 'nha')){ 
				array_push($arrNhaVal, $val);
				array_push($arrNhaKey, $key);
			}
		}
		foreach ($arrNhaKey as $key=>$val)
			for ($i=0; $i<count($arrNhaVal[$key]);$i++)
				 $arrNhaend[$val][$i] = $arrNhaVal[$key][$i];
		for ($i=0; $i<count($arrNhaend['nha_ten']);$i++)
			if($arrNhaend['nha_ten'][$i]!="")
				$model->saveNhaDat($kekhai_id, $arrNhaend['nha_ten'][$i],$arrNhaend['nha_taisan_id'][$i],$arrNhaend['nha_loainha_id'][$i]
						,$arrNhaend['nha_capcongtrinh_id'][$i],$arrNhaend['nha_dientich'][$i]
						,$arrNhaend['nha_giatri'][$i],$arrNhaend['nha_gcn'][$i],$arrNhaend['nha_thongtinkhac'][$i],1);
		//--------------------------- Lưu thông tin đất ---------------------
		foreach($arrr as $key=>$val ){
			if ($this->startsWith($key, 'dat')){
				array_push($arrDatVal, $val);
				array_push($arrDatKey, $key);
			}
		}
		foreach ($arrDatKey as $key=>$val)
			for ($i=0; $i<count($arrDatVal[$key]);$i++)
				$arrDatend[$val][$i] = $arrDatVal[$key][$i];
		for ($i=0; $i<count($arrDatend['dat_ten']);$i++)
			if($arrDatend['dat_ten'][$i]!="") 
				$model->saveNhaDat($kekhai_id, $arrDatend['dat_ten'][$i],$arrDatend['dat_taisan_id'][$i],$arrDatend['dat_loaidat_id'][$i]
				,$arrDatend['dat_capcongtrinh_id'][$i],$arrDatend['dat_dientich'][$i]
				,$arrDatend['dat_giatri'][$i],$arrDatend['dat_gcn'][$i],$arrDatend['dat_thongtinkhac'][$i],2,$arrDatend['dat_diachi'][$i]);
		//----------------------- Lưu thông tin tài sản khác ----------------
		foreach($arrr as $key=>$val ){
			if ($this->startsWith($key, 'tsk')){
				array_push($arrTskVal, $val);
				array_push($arrTskKey, $key);
			}
		}
                var_dump($arrTskVal);
		for ($i=3; $i<=9; $i++)
		{
			for($j=0; $j<count($arrTskVal[0][$i]);$j++){
                                if($arrTskVal[0][$i][$j]!="")
					$model->saveNhaDat($kekhai_id, $arrTskVal[0][$i][$j], $arrTskVal[1][$i][$j], 0, 0, "", $arrTskVal[2][$i][$j],"","",0,"");
                                                        // kekhai_id,   value,                   taisan_id                        giatri
			}
		}
		exit;
	}
	/**
	 * Lưu thông tin nhân thân
	 */
	public function luuNhanthan(){
		$model			=	Core::model('Kekhaitaisan/Kekhaitaisan');
		$formData 		= 	JRequest::get('formData');
		$asArr	 		= 	explode( '&', urldecode($_POST["formData"]) );
		$arrVochong 		= 	array();
		$arrConcaiNew 		= 	array();
		$arrConcaiOld		= 	array();
		$arrOld			=	array();
		$arrNew			=	array();
		$arrVochongDataInput	=	array();
		// ------------------------- Save exist child ---------------
		foreach($asArr as $val ){
			if ($this->startsWith($val, 'concai_old')) array_push($arrConcaiOld, $val);
		}
		if(count($arrConcaiOld)!=0){
			foreach($arrConcaiOld as $val ){
			  $tmp = explode( '=', $val );
			  $arrConOldLuu[ $tmp[0] ] = $tmp[1];
			}
			foreach($arrConOldLuu as $key=>$val ){
				if ($this->startsWith($key, 'concai_old_hoten')) $oldRep = str_replace('concai_old_hoten', '', $key);
				array_push($arrOld, $oldRep);
			}
			$arrOldLast = array_unique($arrOld);
			$arrOldDataInput=array();
			$id_concanxoa .="0";
			foreach($arrOldLast as $val){
				$id_concanxoa.=$arrConOldLuu['concai_old_id'.$val].', ';
				array_push($arrOldDataInput,array ('id'=>$arrConOldLuu['concai_old_id'.$val],'hoten'=>$arrConOldLuu['concai_old_hoten'.$val],'namsinh'=>$arrConOldLuu['concai_old_namsinh'.$val]
						,'hokhau_tinhthanh'=>$arrConOldLuu['concai_old_hokhau_city'.$val],'hokhau_quanhuyen'=>$arrConOldLuu['concai_old_hokhau_dist'.$val]
						,'hokhau_phuongxa'=>$arrConOldLuu['concai_old_hokhau_comm'.$val],'choohientai'=>$arrConOldLuu['concai_old_choohientai'.$val]));
			}
			$id_concanxoa .="0";
			$model->saveNhanthan($formData['hosochinh_id'], 8 , $arrOldDataInput); // hosochinh_id, relative_code_id, array
			$model->deleteNhanthan($formData['hosochinh_id'],$id_concanxoa, '8, 19');
		}
		//-------------------------- Save new child input -----------------
		foreach($asArr as $val ){
			if ($this->startsWith($val, 'concai_new')) array_push($arrConcaiNew, $val);
		}
		if(count($arrConcaiNew)!=0){
			foreach($arrConcaiNew as $val ){
				$tmp = explode( '=', $val );
				$arrConNewLuu[ $tmp[0] ] = $tmp[1];
			}
			foreach($arrConNewLuu as $key=>$val ){
				if ($this->startsWith($key, 'concai_new_hoten')) $newRep = str_replace('concai_new_hoten', '', $key);
				array_push($arrNew, $newRep);
			}
			$arrNewLast = array_unique($arrNew);
			$arrNewDataInput=array();
			foreach($arrNewLast as $val){
				array_push($arrNewDataInput,array ('id'=>$arrConNewLuu['concai_new_id'.$val],'hoten'=>$arrConNewLuu['concai_new_hoten'.$val],'namsinh'=>$arrConNewLuu['concai_new_namsinh'.$val]
				,'hokhau_tinhthanh'=>$arrConNewLuu['concai_new_hokhau_city'.$val],'hokhau_quanhuyen'=>$arrConNewLuu['concai_new_hokhau_dist'.$val]
				,'hokhau_phuongxa'=>$arrConNewLuu['concai_new_hokhau_comm'.$val],'choohientai'=>$arrConNewLuu['concai_new_choohientai'.$val]));
			}
			$model->saveNhanthan($formData['hosochinh_id'],8 , $arrNewDataInput);
		}
		//-------------------------- Save vc -------------------------
		foreach($asArr as $val ){
			if ($this->startsWith($val, 'vochong')) array_push($arrVochong, $val);
		}
		if(count($arrVochong)!=0){
			foreach($arrVochong as $val ){
				$tmp = explode( '=', $val );
				$arrVochongLuu[ $tmp[0] ] = $tmp[1];
			}
			array_push($arrVochongDataInput,array ('id'=>$arrVochongLuu['vochong_id'],'coquan'=>$arrVochongLuu['vochong_coquan'],'chucvu'=>$arrVochongLuu['vochong_chucvu']
			,'relative_code_id'=>$arrVochongLuu['vochong_relative_code_id'],'hoten'=>$arrVochongLuu['vochong_hoten'],'namsinh'=>$arrVochongLuu['vochong_namsinh']
			,'hokhau_tinhthanh'=>$arrVochongLuu['vochong_hokhau_city'],'hokhau_quanhuyen'=>$arrVochongLuu['vochong_hokhau_dist']
			,'hokhau_phuongxa'=>$arrVochongLuu['vochong_hokhau_comm'],'choohientai'=>$arrVochongLuu['vochong_choohientai']));
			$model->saveNhanthan($formData['hosochinh_id'], $arrVochongLuu['vochong_relative_code_id'] , $arrVochongDataInput);
		}
		//------------------------------------------------------------------------
	}
	/**
	 * Hiển thị combobox chọn quận huyện
	 */
	public function getDist(){
		$model	=	Core::model('Kekhaitaisan/Kekhaitaisan');
		$post 	=	JRequest::get('city_peraddress');
		$quanhe	=	$post['quanhe'];
		$dist 	=	$model->getCboDistPer($post['city_peraddress'], null, 0, $quanhe.'_hokhau_dist'.$post['div_id']);
		echo $dist;
		exit;
	}
	/**
	 * Hiển thị combobox chọn phường xã
	 */
	public function getComm(){
		$model	=	Core::model('Kekhaitaisan/Kekhaitaisan');
		$post 	=	JRequest::get('dist_peraddress');
		$quanhe	=	$post['quanhe'];
		$dist 	=	$model->getCboCommPer($post['dist_peraddress'], null, 0, $quanhe.'_hokhau_comm'.$post['div_id']);
		echo $dist;
		exit;
	}
	function startsWith($haystack, $needle) {
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}
	function endsWith($haystack, $needle) {
		return $needle === "" || strpos($haystack, $needle, strlen($haystack) - strlen($needle)) !== FALSE;
	}
}