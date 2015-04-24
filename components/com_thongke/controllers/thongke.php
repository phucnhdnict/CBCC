<?php
/**
 * Author: Phucnh
 * Date created: Apr 3, 2015
 * Company: DNICT
 * Công chức tập tự bổ nhiệm ngạch
 */
class ThongkeControllerThongke extends JControllerLegacy {
	function __construct() {
		parent::__construct ();
	}
	function display($cachable = false, $urlparams = false) {
// 		$document   =& JFactory::getDocument();
// 		$viewName   =	JRequest::getVar( 'view', 'dtbdcbcc');
		 
// 		JRequest::setVar('controller','dtbdcbcc');
// 		$viewLayout = JRequest::getVar( 'layout', 'default');
// 		$viewType   = $document->getType();
// 		$view =& $this->getView( $viewName, $viewType);
// 		$view->setLayout($viewLayout);
		 
// 		$view->display();
		parent::display();
	}
}
?>