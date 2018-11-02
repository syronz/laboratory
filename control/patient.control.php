<?php
require_once '../class/patient.class.php';
if(!isset($_SESSION['user']))
		die();
	//file_put_contents('a.txt', print_r($_GET, true));
switch ($_GET['action']) {

	case 'list':
		echo patient::lists($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"]);
		break;
	case 'create':
		echo patient::create($_POST);
		break;
	case 'update':
		echo patient::update($_POST);
		break;
	case 'delete':
		echo patient::delete($_POST['id']);
		break;

	case 'search_list':
		echo patient::search_list($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"],$_GET['search_str']);
		break;

	case 'json_list':
		echo patient::json_list($_GET['part'],@$_GET['for_all']);
		break;

	case 'patientId':
		echo patient::patientId($_GET['data']);
		break;

	case 'patientName':
		echo patient::patientName($_GET['data']);
		break;

	 
	default:
		
		break;
}




?>