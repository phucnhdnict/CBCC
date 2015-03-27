<?php
class NhucaudaotaoControllerThongkenhucaudaotao extends JControllerLegacy {
	function __construct() {
		parent::__construct ();
	}
	function display($cachable = false, $urlparams = false) {
		$document = JFactory::getDocument ();
		$viewName = JRequest::getVar ( 'view', 'thongkenhucaudaotao' );
		$viewLayout = JRequest::getVar ( 'layout', 'default' );
		$viewType = $document->getType ();
		$view = $this->getView ( $viewName, $viewType );
		$view->setLayout ( $viewLayout );
		$view->display ();
// 		parent::display();
	}
	
}
?>