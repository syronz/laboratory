<?php
require_once '../class/user_activity.class.php';
if(!isset($_SESSION['user']))
		die();

switch ($_GET['action']) {
	case 'list':
		echo user_activity::lists($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"]);
		break;

	case 'search_list':
		echo user_activity::search_list($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"],$_GET['search_str']);
		break;


	
	default:
		
		break;
}




?>