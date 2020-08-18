<?php
ini_set('session.gc_maxlifetime', 46000);
session_set_cookie_params(46000);
@session_start();
error_reporting(E_ALL);
date_default_timezone_set("Asia/Baghdad");
require_once 'dictionary.ku.class.php';
require_once 'setting.class.php';
require_once 'user_activity.class.php';
require_once 'search.class.php';

function dsh($v){
	echo '<pre style="color:red">';
	ob_start();
	var_dump($v);
	$result = ob_get_clean();
	$result = str_replace(">\n", '>', $result);
	echo $result;
	echo '</pre>';
}

function dsh_money($money,$decimal_check = 2,$symbol = null){
	$negative = false;
	if($money < 0){
		$negative = true;
		$money = abs($money);
	}
	if($money == 0)
		return '0';
	$decimal = $money - intval($money);
	$arr = array();
	if($money !== 0)
		while($money){
			$part = strval($money % 1000);
			$len = strlen($part);
			if($len == 1)
				$part = '00'.$part;
			else if($len == 2)
				$part = '0'.$part;
			$money =intval($money/1000);
			array_push($arr, $part);
		}
	else
		$arr = array(0);
	$arr = array_reverse($arr);
	
	$str = implode(',', $arr);
	if(strlen($str)>1){
		if($str[0]=='0')
			$str = substr($str, 1);
		if($str[0]=='0')
			$str = substr($str, 1);
	}
	
	if($decimal_check)
		if(round($decimal,$decimal_check))
			$str .= substr(strval(round($decimal,2)),1);
	if($symbol)
		$str .= ' '.$symbol;

	if($negative)
		$str = '-'.$str;
	return $str;
}

function dsh_convert_number($string) {
    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');

    $num = range(0, 9);
    $string = str_replace($persian, $num, $string);
    return str_replace($arabic, $num, $string);
}


class database{
	public $pdo;
	public static $PDO;
	function __construct(){
		try {
	    $this->pdo = new PDO('mysql:host=127.0.0.1;dbname=laboratory', 'diako', setting::MYSQL_PASSWORD);
	    //$this->pdo = new PDO('mysql:host=127.0.0.1;dbname=laboratory', 'travis');

	    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $this->pdo->query('SET NAMES utf8');

	    /*static mode*/
	    self::$PDO = $this->pdo;
		} 
		catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}

/* deleted
	public function return_company_list(){
		try{
			$sql = 'SELECT id,name FROM company;';
			$result = $this->pdo->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
			$rows2 = array();
			foreach ($rows as $key => $value) {
				$rows2[$value['id']]=$value['name'];
			}
			return json_encode($rows2);
		}
		catch(PDOException $e){
			echo 'Error: '.$e->getMessage().'<br>';
			die();
		}	
	}

	public function return_category_list(){
		$sql = 'SELECT id,name FROM category;';
		$result = $this->pdo->query($sql);
		$rows = $result->fetchAll(PDO::FETCH_ASSOC);
		$rows2 = array();
		foreach ($rows as $key => $value) {
			$rows2[$value['id']]=$value['name'];
		}
		return json_encode($rows2);
	}
*/
	public static function hack_pageSize($startIndex,$pageSize){
		$startIndex = intval($startIndex);
		$pageSize = intval($pageSize);
		if(!$pageSize)
			die('Hack Detection!');/* use admin log for security issue !!! database*/
	}

	public static function hack_sorting($sorting){
		$sorting = str_replace("'", "", $sorting);
		$sorting = str_replace('"', '"', $sorting);
		return $sorting;
	}

	private static function check_column_exist($column,$table){
		try{
			$sql = "SHOW COLUMNS FROM `$table` LIKE '$column'";
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
			if($rows)
				return true;
			return NULL;
		}
		catch(PDOException $e){
			return null;
		}
		
	}

	public static function check_permission_view($part){
		//if($_SESSION['permission'][$part] > );
		$range = strtoupper(@$_SESSION['permission'][$part][0]);


		switch ($range) {
			case 'A':
				$where = 'WHERE 1';
				break;
			case 'D':
				if(self::check_column_exist('id_department',$part))
					$where = 'WHERE  id_department = '.$_SESSION['user']['id_department'];
				else
					$where = 'WHERE 0';
				break;
			case 'L':
				if(self::check_column_exist('id_location',$part))
					$where = 'WHERE id_location = '.$_SESSION['user']['id_location'];
				else
					$where = 'WHERE 0';
				break;
			case 'U':
				if(self::check_column_exist('id_user',$part))
					$where = 'WHERE id_user = '.$_SESSION['user']['id_user'];
				else
					$where = 'WHERE 0';
				break;
			default:
				$where = 'WHERE 0';
				break;
		}

		return $where;
	}

	public static function return_user_range($part){
		$range = strtoupper(@$_SESSION['permission'][$part][0]);

		switch ($range) {
			case 'A':
				$rows['department'] = ' 1 ';
				$rows['location'] = ' 1 ';
				$rows['user'] = ' 1 ';
				break;

			case 'D':
				$rows['department'] = ' id = \''.$_SESSION['user']['id_department'].'\'';
				$rows['location'] = ' 1 ';
				$rows['user'] = ' 1 ';
				break;

			case 'L':
				$rows['department'] = ' id = \''.$_SESSION['user']['id_department'].'\'';
				$rows['location'] = ' id = \''.$_SESSION['user']['id_location'].'\'';
				$rows['user'] = ' 1 ';
				break;

			case 'U':
				$rows['department'] = ' id = \''.$_SESSION['user']['id_department'].'\'';
				$rows['location'] = ' id = \''.$_SESSION['user']['id_location'].'\'';
				$rows['user'] = ' id = \''.$_SESSION['user']['id_user'].'\'';
				break;
			
			default:
				$where = ' 1 ';
				break;
		}
		if(isset($rows))
			return $rows;
		return null;
	}

	public static function check_perm_manage($part,$data=null){
		return true;
		$range = strtoupper($_SESSION['permission'][$part][1]);
		switch ($range) {
			case 'A':
				return true;
				break;
			case 'D':
				if($_SESSION['user']['id_department'] == $data['id_department'])
					return true;
				else
					return false;
				break;
			case 'L':
				if($_SESSION['user']['id_location'] == $data['id_location'])
					return true;
				else
					return false;
				break;
			case 'U':
				if($_SESSION['user']['id_user'] == $data['id_user'])
					return true;
				else
					return false;
				break;
			
			default:
				return false;
				break;
		}
	}

	public static function record($type,$action,$detail=null){
		switch ($type) {
			case 'read':
				if(setting::USER_ACTIVITY_READ)
					user_activity::record_activity($_SERVER['REMOTE_ADDR'],$_SESSION['user']['id'],$action,$detail);
				break;
			case 'write':
				if(setting::USER_ACTIVITY_WRITE)
					user_activity::record_activity(@$_SERVER['REMOTE_ADDR'],@$_SESSION['user']['id'],@$action,@$detail);
				break;
			
			default:
				user_activity::record_activity($_SERVER['REMOTE_ADDR'],$_SESSION['user']['id'],$action,$detail.$type);
				break;
		}
	}

	public static function search($sorting,$startIndex,$pageSize,$search_str,$arr_table,$table,$other_table = null){
		try{
			return search::make_search_list($sorting,$startIndex,$pageSize,$search_str,$arr_table,$table,$other_table);
		}
		catch(exception $e){
			echo 'Error: [database.class.php/function search]'.$e->getMessage().'<br>';
			die();
		}
	}

//for jtable
	public static function calculate_rows($table){
		try{
			$sql = "SELECT count(id) AS count FROM $table";
			$result = self::$PDO->query($sql);
			$count = $result->fetchObject();
			return $count->count;
		}
		catch(PDOException $e){
			echo 'Error: [database.class.php/function calculate_row]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function last_id_data($table){
		try{
			$sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
			$stmt = self::$PDO->query($sql);
			$row = $stmt->fetchObject();
			return $row;
		}
		catch(PDOException $e){
			echo 'Error: [database.class.php/function last_id_data]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function go_to_login(){
		// header('location:'.SETTING::APP_URL.'/login.php');
		echo '<script>window.location.hash = "system>logout"</script>';
	}

}

$db = new database();
//dsh(database::last_id_data('stuff'));
//$db->return_company_list();
//echo $db->return_company_list();
// database::check_perm_manage('diako',225);
?>
