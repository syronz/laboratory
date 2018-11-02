<?php
require_once '../class/department.class.php';
if(!isset($_SESSION['user']))
		die();

switch ($_GET['action']) {
	case 'list':
		echo department::lists($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"]);
		//echo department::lists('id DESC',0,10);
		break;
	case 'create':
		echo department::create($_POST['id_user'],$_POST['name'],$_POST['detail']);
		break;
	case 'update':
		echo department::update($_POST['id_user'],$_POST['name'],$_POST['detail'],$_POST['id']);
		break;
	case 'delete':
		echo department::delete($_POST['id']);
		break;
	case 'json_list':
		echo department::json_list($_GET['part'],@$_GET['for_all']);
		break;

	case 'search_list':
		echo department::search_list($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"],$_GET['search_str']);
		break;
	
	default:
		
		break;
}




?>