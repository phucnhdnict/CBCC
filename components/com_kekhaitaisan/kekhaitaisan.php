<?php
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
// Require the base controller

require_once (JPATH_COMPONENT.'/helpers/kekhaitaisan.php');
// require_once( JPATH_LIBRARIES.'/cbcc/Core.php' );
$controller = JRequest::getWord('controller');
$view = JRequest::getWord('view');
if ($controller == '' && $view !='') {
	$controller = $view;
}
if ($controller != '' && $view =='') {
	$view = $controller;
}
JRequest::setVar('controller',$controller);
$path = JPATH_COMPONENT.'/controllers/'.$controller.'.php';
if (file_exists($path)) {
	require_once $path;
} else {
	$controller = '';
}
// Create the controller
JRequest::setVar('view',$view);
$classname    = 'KekhaitaisanController'.ucfirst($controller);
$controller   = new $classname();

// Perform the Request task
$controller->execute( JRequest::getCmd( 'task' ) );

// Redirect if set by the controller
$controller->redirect();
