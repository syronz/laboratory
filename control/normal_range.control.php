<?php
require_once '../class/normal_range.class.php';
if(!isset($_SESSION['user']))
		die();
	//file_put_contents('a.txt', print_r($_GET, true));
switch ($_GET['action']) {

	case 'list':
		echo normal_range::lists($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"]);
		break;
	case 'create':
		echo normal_range::create($_POST);
		break;
	case 'update':
		echo normal_range::update($_POST);
		break;
	case 'delete':
		echo normal_range::delete($_POST['id']);
		break;

	case 'search_list':
		echo normal_range::search_list($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"],$_GET['search_str']);
		break;

	case 'detail_list':
		echo normal_range::detail_lists($_GET["id_test"]);
		break;
	case 'create_detail':
		$_POST['id_test'] = $_GET['id_test'];
		echo normal_range::create($_POST);
		break;
	 
	default:
		
		break;
}




?>