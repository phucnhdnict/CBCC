<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
// specific controller?
$controller = JFactory::getApplication()->input->get('controller','nhucaudaotao');
// Require specific controller if requested
require_once (JPATH_COMPONENT.'/controllers/'.$controller.'.php');
require_once JPATH_COMPONENT.'/helpers/nhucaudaotao.php';
// Create the controller
$classname  = 'NhucaudaotaoController'.ucfirst($controller);

$controller = new $classname();
$controller->execute(JFactory::getApplication()->input->get('task'));

$controller->redirect();