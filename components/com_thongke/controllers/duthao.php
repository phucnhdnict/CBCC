<?php
/**
 * Author: Phucnh
 * Date created: Apr 25, 2015
 * Company: DNICT
 * Dự thảo
 */
class ThongkeControllerDuthao extends JControllerLegacy {
	function __construct() {
		parent::__construct ();
	}
	function display($cachable = false, $urlparams = false) {
		$document   =& JFactory::getDocument();
		$viewName   =	JRequest::getVar( 'view', 'duthao');
		 
		JRequest::setVar('controller','duthao');
		$viewLayout = JRequest::getVar( 'layout', 'default');
		$viewType   = $document->getType();
		$view =& $this->getView( $viewName, $viewType);
		$view->setLayout($viewLayout);
		 
		$view->display();
	}
}
?>