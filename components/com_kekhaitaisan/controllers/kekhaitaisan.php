<?php
class KekhaitaisanControllerKekhaitaisan extends JControllerLegacy
{

	function __construct()
    {
        parent::__construct();
        $this->registerTask('add','edit');         
	}
	
	function display() 
  {
//   	$model = $this->getModel();

 		$document   =& JFactory::getDocument();
        $viewName   =	JRequest::getVar( 'view', 'kekhaitaisan');
       
        JRequest::setVar('controller','kekhaitaisan');
        $viewLayout = JRequest::getVar( 'layout', 'default');
        $viewType   = $document->getType();    
        $view =& $this->getView( $viewName, $viewType);
        $view->setLayout($viewLayout);
     
        $view->display(); 
  } 
}
?>
