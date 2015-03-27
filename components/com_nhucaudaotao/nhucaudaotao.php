<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
// specific controller?
$controller = JFactory::getApplication()->input->get('controller','Nhucaudaotao');
// Require specific controller if requested
require_once (JPATH_COMPONENT.'/controllers/'.ucfirst($controller).'.php');
require_once JPATH_COMPONENT.'/helpers/Nhucaudaotao.php';
// Create the controller
$classname  = 'NhucaudaotaoController'.ucfirst($controller);

$controller = new $classname();
$controller->execute(JFactory::getApplication()->input->get('task'));

$controller->redirect();