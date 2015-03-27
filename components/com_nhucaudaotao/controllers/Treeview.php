<?php
class NhucaudaotaoControllerTreeview extends JControllerLegacy{

	public function treeunit(){
		if ( ! JRequest::getCmd( 'view' ) ) {
			JRequest::setVar('view', 'treeview' );
		}
		parent::display();
	}
}