<?php
/**
 * Author: Phucnh
 * Date created: Apr 15, 2015
 * Company: DNICT
 * TỔNG HỢP KẾT QUẢ ĐÀO TẠO BỒI DƯỠNG CÁN BỘ, CÔNG CHỨC
 */
class ThongkeControllerBcdaotaoboiduong extends JControllerLegacy {
	function __construct() {
		parent::__construct ();
	}
	function display($cachable = false, $urlparams = false) {
		$document   =& JFactory::getDocument();
		$viewName   =	JRequest::getVar( 'view', 'bcdaotaoboiduong');
		 
		JRequest::setVar('controller','bcdaotaoboiduong');
		$viewLayout = JRequest::getVar( 'layout', 'default');
		$viewType   = $document->getType();
		$view =& $this->getView( $viewName, $viewType);
		$view->setLayout($viewLayout);
		$view->display();
	}
}
?>