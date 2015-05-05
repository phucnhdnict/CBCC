<?php
/**
 * Author: Phucnh
 * Date created: Apr 3, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
$controller = JFactory::getApplication()->input->get('controller','thongke');
require_once (JPATH_COMPONENT.'/controllers/'.$controller.'.php');
require_once JPATH_COMPONENT.'/helpers/thongke.php';
$classname  = 'ThongkeController'.ucfirst($controller);
$controller = new $classname();
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();