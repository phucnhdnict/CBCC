<?php
defined('_JEXEC') or die('Restricted access');
class KekhaitaisanViewKekhaitaisan extends JViewLegacy{
    function display($tpl = null) {
    	$document = JFactory::getDocument();
        $task = JRequest::getVar('task');
        switch ($task){
        	case 'add':
        		$this->_getEdit();
        		$this->setLayout('add');
        		break;
        }
        parent::display($tpl);
    }
    public function _getEdit(){
    	$document = JFactory::getDocument();
    	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/chosen.jquery.min.js');
    	$document->addScript('/components/com_kekhaitaisan/js/jquery.maskMoney.min.js');
    	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
    	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.validate.default.js');
    	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.blockUI.js');
    	$taisan_cb		=	array();
    	$taisan_kk		=	array();
    	$model			=	Core::model('Kekhaitaisan/Kekhaitaisan');
    	$taisan			=	$model->listTaisan(array('id', 'tenloaitaisan', 'type', 'parent_id'), array('status = 1'));
    	$capcongtrinh           =	$model->listData('kkts_capcongtrinh', array('id', 'name'), array('status = 1') , $oder ='order by orders');
    	$hokhau_city            =	$model->listData('city_code', array('code', 'name','code'), array('status = 1') , $oder ='order by name');
    	$loainha		=	$model->listData('kkts_loainha', array('id', 'name'), array('status = 1') , $oder ='order by orders');
    	$nguoikekhai            =	$model->getInfoNguoikekhai($model->getHosoidByJos(JFactory::getUser()->id));
    	$dotkekhai		=	$model->listData('kkts_dotkekhai',array('id', 'name'), array('status = 1'));
    	$hosochinh_id           =	$nguoikekhai[0]->hosochinh_id;
        $vochong		=	$model->getNhanthan($hosochinh_id,'3,12,4'); //3: vợ, 12: vợ kế, 4: chồng
        $concai			=	$model->getNhanthan($hosochinh_id,'8,19'); //8: con, 19: con nuôi
    	
    	for ($i = 0; $i < count($taisan); $i++) {
    		if ((int)$taisan[$i]['parent_id'] != 0) {
    			$taisan_cb[(int)$taisan[$i]['parent_id']][$taisan[$i]['id']] = $taisan[$i]['tenloaitaisan'];
    		}else {
    			$taisan_kk[] = $taisan[$i];
    		}
    	}
        $this->assignRef('hosochinh_id', $hosochinh_id);
        $this->assignRef('vochong', $vochong);
        $this->assignRef('concai', $concai);
        $this->assignRef('dotkekhai', $dotkekhai);
        $this->assignRef('nguoikekhai', $nguoikekhai);
        $this->assignRef('loainha', $loainha);
        $this->assignRef('hokhau_city', $hokhau_city);
        $this->assignRef('capcongtrinh', $capcongtrinh);
    	$this->assignRef('taisan_kk', $taisan_kk);
    	$this->assignRef('taisan_cb', $taisan_cb);
    }
}