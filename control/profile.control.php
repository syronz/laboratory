<?php
require_once '../class/profile.class.php';
if(!isset($_SESSION['user']))
		die();
	//file_put_contents('a.txt', print_r($_GET, true));
switch ($_GET['action']) {

	case 'list':
		echo profile::lists($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"]);
		break;
	case 'create':
		echo profile::create($_POST);
		break;
	case 'update':
		echo profile::update($_POST);
		break;
	case 'delete':
		echo profile::delete($_POST['id']);
		break;

	case 'search_list':
		echo profile::search_list($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"],$_GET['search_str']);
		break;

	case 'json_list':
		echo profile::json_list($_GET['part'],@$_GET['for_all']);
		break;

	 
	default:
		
		break;
}




?>