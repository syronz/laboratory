<?php
require_once '../class/test.class.php';
if(!isset($_SESSION['user']))
		die();
	//file_put_contents('a.txt', print_r($_GET, true));
switch ($_GET['action']) {

	case 'list':
		echo test::lists($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"]);
		break;
	case 'create':
		echo test::create($_POST);
		break;
	case 'update':
		echo test::update($_POST);
		break;
	case 'delete':
		echo test::delete($_POST['id']);
		break;

	case 'search_list':
		echo test::search_list($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"],$_GET['search_str']);
		break;
		
	case 'json_list':
		echo test::json_list($_GET['part'],@$_GET['for_all']);
		break;

	case 'testListProfile':
		// echo 'worked';
		echo test::testListProfile($_GET['idProfile']);
		break;

	case 'examList':
		echo test::exam_list($_GET['idExam']);
		break;

	case 'insertResult':
		echo test::insertResult($_POST);
		break;

	case 'deleteResult':
		echo test::deleteResult($_POST);
		break;
	 
	default:
		
		break;
}




?>
