<?php
require_once '../class/user.class.php';
if(!isset($_SESSION['user']))
		die();
// echo user::update('ako',1,1,1,22,'a','a',null,null,'2013-11-06',2);
switch (@$_GET['action']) {
	case 'list':
		echo user::lists($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"]);
		break;
	case 'create':
		echo user::create($_POST['name'],$_POST['id_permission'],$_POST['id_department'],$_POST['id_location'],$_POST['id_employee'],$_POST['username'],$_POST['password'],$_POST['limited'],$_POST['image_url']);
		break;
	case 'update':
		echo user::update(@$_POST['name'],@$_POST['id_permission'],@$_POST['id_department'],@$_POST['id_location'],@$_POST['id_employee'],@$_POST['username'],@$_POST['password'],@$_POST['limited'],@$_POST['image_url'],@$_POST['register_date'],@$_POST['id']);
		break;
	case 'delete':
		echo user::delete($_POST['id']);
		break;
	case 'json_list':
		echo user::json_list(@$_GET['part'],@$_GET['id_location']);
		break;

	case 'search_list':
		echo user::search_list($_GET["jtSorting"],$_GET["jtStartIndex"],$_GET["jtPageSize"],$_GET['search_str']);
		break;

	case 'change_pass':
		echo user::change_pass(@$_POST["current_pass"],@$_POST["new_pass"],@$_POST["new_pass_confirm"]);
		break;

	case 'test_pass':
		echo user::test_pass(@$_POST["new_pass"]);
		break;
	
	default:
		
		break;
}




?>