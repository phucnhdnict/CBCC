<?php
class HososControllerImport extends JControllerLegacy {
	function __construct() {
		parent::__construct ();
	}
	function display($cachable = false, $urlparams = false) {
		$task = JRequest::getVar('task');
		switch($task){
			case 'uploadcbcc':
				$this->uploadcbcc();
				break;
		}
		parent::display();
	}
	
	function uploadcbcc(){
		$model = Core::model('Hoso/Import');
		$arrKq	=	$model->uploadcbcc();
		if (count($arrKq)>0) {
			echo 	'<br/>
	 				<span style="color:blue">Import thành công.</span>
	 				<br/>
	 				<span style="color:red">Vui lòng bổ sung các hồ sơ có thông tin sai lệch:
	 				<br/>';
			foreach ($arrKq as $val)
				echo '- '.$val.'<br/>';
			echo '</span>';
		}
		else echo "<br/><span style='color:blue'>Import thành công, các hồ sơ đã được lưu</span>";
		
	}
}
?>