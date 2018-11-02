<?php
require_once '../class/fund.class.php';
if(!isset($_SESSION['user']))
		die();
	//file_put_contents('a.txt', print_r($_GET, true));
switch ($_GET['action']) {

	case 'list':
		echo fund::lists($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"]);
		break;
	case 'create':
		echo fund::create($_POST);
		break;
	case 'update':
		echo fund::update($_POST);
		break;
	case 'delete':
		echo fund::delete($_POST['id']);
		break;

	case 'money_transfer':
		echo fund::money_transfer($_POST);
		break;

	case 'last_position':
		echo fund::last_position(@$_GET["id_user"]);
		break;

	case 'search_list':
		echo fund::search_list($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"],$_GET['search_str']);
		break;

	case 'list_all':
		echo fund::list_all($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"]);
		break;

	case 'location_report':
		echo fund::location_report($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"],$_GET["date"]);
		break;

	case 'user_fund_report':
		echo fund::user_fund_report($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"],$_GET["date"]);
		break;
	 
	default:
		
		break;
}




?>