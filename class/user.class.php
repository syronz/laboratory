<?php
require_once 'database.class.php';
require_once 'permission.class.php';

class user extends database{
	private $table = 'user';
	private static $TABLE = 'user';

	public static function calculate_row(){
		try{
			$sql = "SELECT count(id) AS count FROM ".self::$TABLE;
			$result = self::$PDO->query($sql);
			$count = $result->fetchObject();
			return $count->count;
		}
		catch(PDOException $e){
			echo 'Error: [user.class.php/function calculate_row]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function lists($sorting,$startIndex,$pageSize){
		try{
			$where = self::check_permission_view(self::$TABLE);
			self::hack_pageSize($startIndex,$pageSize);
			$sorting = self::hack_sorting($sorting);
			$sql = "SELECT * FROM ".self::$TABLE." $where ORDER BY $sorting LIMIT $startIndex, $pageSize;";
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] = self::calculate_row();
			$jTableResult['Records'] = $rows;
			self::record('read','View User\'s');
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [user.class.php/function lists]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function last_row_data(){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id=LAST_INSERT_ID();";
			$stmt = self::$PDO->query($sql);
			$row = $stmt->fetchObject();
			return $row;
		}
		catch(PDOException $e){
			echo 'Error: [user.class.php/function last_row_data]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function create($name,$id_permission,$phone,$username,$password){
		try{
			// if(!self::check_perm_manage('user',$data)){
			// 	$jTableResult['Result'] = "NO";
			// 	$jTableResult['Message'] = dic_return('You Havent Permission!!! to add user in this department or location');
			// 	self::record('write','WARNING : Try create data in user but havent permission',"DATA : $name, $id_permission, $id_department, $id_location, $phone, $username, $limited, $image_url");
			// 	return json_encode($jTableResult);
			// }
			$sql = "INSERT INTO ".self::$TABLE."(name,id_permission,phone,username,password,register_date) VALUES(:name,:id_permission,:phone,:username,:password,NOW());";
			$password = md5("Ha783~qL&b3WM#shK+$password");
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':name',$name,PDO::PARAM_STR);
			$stmt->bindParam(':id_permission',$id_permission,PDO::PARAM_STR);
			$stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
			$stmt->bindParam(':username',$username,PDO::PARAM_STR);
			$stmt->bindParam(':password',$password,PDO::PARAM_STR);

			$stmt->execute();
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Record'] = self::last_row_data();
			self::record('write','create new user',"DATA : $name, $id_permission,  $phone, $username");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [user.class.php/function create]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function update($name,$id_permission,$id_department,$id_location,$id_employee,$username,$password,$limited,$image_url,$register_date,$id){
		try{
			// file_put_contents('a.txt', )
			$data['id_department'] = $id_department;
			$data['id_location'] = $id_location;
			$before = self::get_user_info($id);
			$pre['id_department'] = $before['id_department'];
			$pre['id_location'] = $before['id_location'];
			if(!self::check_perm_manage('user',$pre) || !self::check_perm_manage('user',$data)){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission!!! to edit user in this department or location');
				self::record('write','WARNING : Try to edit user info but havent permission',"DATA : $name, $id_permission, $id_department, $id_location, $id_employee, $username, $limited, $image_url in ID = $id");
				return json_encode($jTableResult);
			}
			$sql = "UPDATE ".self::$TABLE." SET name = :name, id_permission = :id_permission, id_department = :id_department, id_location = :id_location, id_employee = :id_employee, username = :username, password = :password, limited = :limited, image_url = :image_url, register_date = :register_date WHERE id = :id";
			if(strlen($password)!=32)
				$password = md5("Ha783~qL&b3WM#shK+$password");
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':name',$name,PDO::PARAM_STR);
			$stmt->bindParam(':id_permission',$id_permission,PDO::PARAM_STR);
			$stmt->bindParam(':id_department',$id_department,PDO::PARAM_STR);
			$stmt->bindParam(':id_location',$id_location,PDO::PARAM_STR);
			$stmt->bindParam(':id_employee',$id_employee,PDO::PARAM_STR);
			$stmt->bindParam(':username',$username,PDO::PARAM_STR);
			$stmt->bindParam(':password',$password,PDO::PARAM_STR);
			$stmt->bindParam(':limited',$limited,PDO::PARAM_STR);
			$stmt->bindParam(':image_url',$image_url,PDO::PARAM_STR);
			$stmt->bindParam(':register_date',$register_date,PDO::PARAM_STR);
			$stmt->bindParam(':id',$id,PDO::PARAM_STR);
			$stmt->execute();
			
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','Edit user info',"DATA : $name, $id_permission, $id_department, $id_location, $id_employee, $username, $limited, $image_url in ID = $id / OLD DATA : ".$before['name'].', '.$before['id_permission'].', '.$before['id_department'].', '.$before['id_location'].', '.$before['id_employee'].', '.$before['username'].', '.$before['limited'].', '.$before['image_url']);
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [user.class.php/function update]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function delete($id){
		try{
			$before = self::get_user_info($id);
			$pre['id_department'] = $before['id_department'];
			$pre['id_location'] = $before['id_location'];
			if(!self::check_perm_manage('user',$pre)){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission!!! to delete user in this department or location');
				self::record('write','WARNING : Try to delete user info but havent permission',"DATA : ID = $id");
				return json_encode($jTableResult);
			}
			if($_SESSION['user']['id'] == $id){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You can\'t delete yourselfe!!!');
				return json_encode($jTableResult);
			}
			$sql = "DELETE FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			//$stmt = $db->pdo->prepare($sql);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','Delete a user',"DATA : ID = $id");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [user.class.php/function delete2]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function login($username,$password){
		try{
			
			$sql = "SELECT * FROM ".self::$TABLE." WHERE username = :username AND password = :password";
			// dsh($sql);
			$password = md5("Ha783~qL&b3WM#shK+$password");
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':username',$username,PDO::PARAM_STR);
			$stmt->bindParam(':password',$password,PDO::PARAM_STR);
			$stmt->execute();
			$row['user'] = $stmt->fetch(PDO::FETCH_ASSOC);

			// $row['permission'] = permission::return_one_permission($row['user']['id_permission']);
			//if($row->id_permission)
			self::record('write','login to system',"DATA : username = $username ");
			return $row;

		}
		catch(PDOException $e){
			echo 'Error: [user.class.php/function login]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function change_pass($current_pass,$new_pass,$new_pass_confirm){
		try{
			if(strpos($_SERVER['HTTP_USER_AGENT'],'Linux') === false || strpos($_SERVER['HTTP_USER_AGENT'],'Chrome') === false)
				if(strpos($_SERVER['HTTP_USER_AGENT'],'Mozilla/5.0 (iPad; CPU OS 7_1 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) CriOS/26.0.1410.50 Mobile/11D167 Safari/8536.25') === false)
					return null;
			if(!$current_pass)
				return dic_return('<span style="color:red;">Wrong Password!</span>');
			$sql = "SELECT * FROM ".self::$TABLE." WHERE username = :username AND password = :password";
			// dsh($current_pass);
			$current_pass = md5("Ha783~qL&b3WM#shK+$current_pass");
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':username',$_SESSION['user']['username'],PDO::PARAM_STR);
			$stmt->bindParam(':password',$current_pass,PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if($row){
				if(strlen($new_pass) < 6)
					return dic_return('<span style="color:red;">Minimum Character Is 6</span>');
				if($new_pass == $new_pass_confirm){
					$new_pass = md5("Ha783~qL&b3WM#shK+$new_pass");
					$sql = "UPDATE user SET password = :new_pass WHERE id = :id";
					$stmt = self::$PDO->prepare($sql);

					$stmt->bindParam(':new_pass',$new_pass,PDO::PARAM_STR);
					$stmt->bindParam(':id',$row['id'],PDO::PARAM_STR);
					$stmt->execute();
					return dic_return('<span style="color:green;">Password Changed Successfully</span>');
				}
				else dic_return('<span style="color:red;">New Password Not Match!</span>');
			}
			else
				return dic_return('<span style="color:red;">Wrong Password!</span>');
			// dsh($row);
			
			//if($row->id_permission)
			self::record('write','change_pass to system',"DATA : username =  ");
			return false;

		}
		catch(PDOException $e){
			echo 'Error: [user.class.php/function login]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function get_user_info($id){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}
		catch(PDOException $e){
			echo 'Error: [user.class.php/function get_user_info]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function json_list($part,$id_location = null){
		try{
			//$where = self::return_user_range($part);
			//$sql = "SELECT id AS Value,name AS DisplayText FROM ".self::$TABLE." WHERE {$where['department']} " ;
			$sql = "SELECT id AS Value,name AS DisplayText FROM ".self::$TABLE;
			if($id_location)
				$sql = "SELECT id AS Value,name AS DisplayText FROM ".self::$TABLE." WHERE id_location = $id_location";
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Options'] = $rows;
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [user.class.php/function json_list]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function search_list($sorting,$startIndex,$pageSize,$search_str){
		try{
			$arr_table = array(
				'id'=>array('state'=>'self','field'=>'id'),
				'permission'=>array('state'=>'foreign','table'=>'permission','field'=>'name','source'=>'id_permission'),
				'department'=>array('state'=>'foreign','table'=>'department','field'=>'name','source'=>'id_department'),
				'location'=>array('state'=>'foreign','table'=>'location','field'=>'name','source'=>'id_location'),
				//'employee'=>array('state'=>'foreign','table'=>'employee','field'=>'name','source'=>'id_employee'),

				'user'=>array('state'=>'self','field'=>'name'),
				'username'=>array('state'=>'self','field'=>'username'),
				'date'=>array('state'=>'self','field'=>'register_date')
			);
			
			self::record('read',"search user's","SEARCH: $search_str");
			return self::search($sorting,$startIndex,$pageSize,$search_str,$arr_table,'user');
		}
		catch(exception $e){
			echo 'Error: [user.class.php/function search_list]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function test_pass($password){
	    if ( strlen( $password ) == 0 )
	    {
	        return 1;
	    }

	    $strength = 0;

	    /*** get the length of the password ***/
	    $length = strlen($password);

	    /*** check if password is not all lower case ***/
	    if(strtolower($password) != $password)
	    {
	        $strength += 1;
	    }
	    
	    /*** check if password is not all upper case ***/
	    if(strtoupper($password) == $password)
	    {
	        $strength += 1;
	    }

	    /*** check string length is 8 -15 chars ***/
	    if($length >= 8 && $length <= 15)
	    {
	        $strength += 1;
	    }

	    /*** check if lenth is 16 - 35 chars ***/
	    if($length >= 16 && $length <=35)
	    {
	        $strength += 2;
	    }

	    /*** check if length greater than 35 chars ***/
	    if($length > 35)
	    {
	        $strength += 3;
	    }
	    
	    /*** get the numbers in the password ***/
	    preg_match_all('/[0-9]/', $password, $numbers);
	    $strength += count($numbers[0]);

	    /*** check for special chars ***/
	    preg_match_all("/[|!@#$%&*\/=?,;.:\-_+~^\\\]/", $password, $specialchars);
	    $strength += sizeof($specialchars[0]);

	    /*** get the number of unique chars ***/
	    $chars = str_split($password);
	    $num_unique_chars = sizeof( array_unique($chars) );
	    $strength += $num_unique_chars * 2;

	    /*** strength is a number 1-10; ***/
	    $strength = $strength > 99 ? 99 : $strength;
	    $strength = floor($strength / 10 + 1);

	    return $strength;
	}
}

//$user = new user();

//var_dump($user->show_locations('id',0,5));
//dsh(user::login(syronz,88888888));
// dsh(user::update('ako',1,1,1,22,'a','a',null,null,'2013-11-06',2));

// dsh(user::create("cash",1,"00",'cash','99+36'));

?>
