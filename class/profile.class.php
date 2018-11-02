<?php
require_once 'database.class.php';

class profile extends database{
	private $table = 'profile';
	private static $TABLE = 'profile';
	/*public function show_profiles($sorting,$startIndex,$pageSize){
		try{
			$sql = "SELECT * FROM $this->table ORDER BY $sorting LIMIT $startIndex,$pageSize;";
			$result = $this->pdo->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$sql = "SELECT count(id) AS count FROM $this->table";
			$result = $this->pdo->query($sql);
			$count = $result->fetchObject();
			
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] = $count->count;
			$jTableResult['Records'] = $rows;
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: '.$e->getMessage().'<br>';
			die();
		}

	}*/

	public static function calculate_row(){
		try{
			$sql = "SELECT count(id) AS count FROM ".self::$TABLE;
			$result = self::$PDO->query($sql);
			$count = $result->fetchObject();
			return $count->count;
		}
		catch(PDOException $e){
			echo 'Error: [profile.class.php/function calculate_row]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function lists($sorting,$startIndex,$pageSize){
		try{
			//var_dump($where);
			self::hack_pageSize($startIndex,$pageSize);
			$sorting = self::hack_sorting($sorting);
			$sql = "SELECT * FROM ".self::$TABLE." ORDER BY $sorting LIMIT $startIndex, $pageSize;";
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Message'] = "bye";
			$jTableResult['TotalRecordCount'] = self::calculate_row();
			$jTableResult['Records'] = $rows;
			self::record('read','View '.self::$TABLE.' Table');
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [profile.class.php/function lists]'.$e->getMessage().'<br>';
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
			echo 'Error: [profile.class.php/function last_row_data]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function create($data){
		try{
			// if(!self::check_perm_manage(self::$TABLE)){
			// 	$jTableResult['Result'] = "NO";
			// 	$jTableResult['Message'] = dic_return('You Havent Permission To Create!!!');
			// 	self::record('write','WARNING : Try write data to profilem but havent permission',"DATA : name = $name / detail = $detail");
			// 	return json_encode($jTableResult);
			// }
			$sql = "INSERT INTO ".self::$TABLE."(type,name,detail,date) VALUES(:type,:name,:detail,NOW());";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':type',$data['type'],PDO::PARAM_STR);
			$stmt->bindParam(':name',$data['name'],PDO::PARAM_STR);
			$stmt->bindParam(':detail',$data['detail'],PDO::PARAM_STR);
			$stmt->execute();

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Record'] = self::last_row_data();
			self::record('write','write data to profilem',"DATA : name = name / detail = detail");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [profile.class.php/function create]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function update($data){
		try{
			// if(!self::check_perm_manage(self::$TABLE)){
			// 	$jTableResult['Result'] = "NO";
			// 	$jTableResult['Message'] = dic_return('You Havent Permission To Edit!!!');
			// 	self::record('write','WARNING : Try edit data on profilem but havent permission',"DATA : name = $name / detail = $detail / id = $id");
			// 	return json_encode($jTableResult);
			// }
			$sql = "UPDATE ".self::$TABLE." SET type = :type, name = :name, detail = :detail WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':type',$data['type'],PDO::PARAM_STR);
			$stmt->bindParam(':name',$data['name'],PDO::PARAM_STR);
			$stmt->bindParam(':detail',$data['detail'],PDO::PARAM_STR);
			$stmt->bindParam(':id',$data['id'],PDO::PARAM_STR);
			$stmt->execute();
			
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','Edit data on profilem',"DATA : name = name / detail = detail / id = id");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [profile.class.php/function update]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function delete($id){
		try{
			if(!self::check_perm_manage(self::$TABLE)){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission To Edit!!!');
				self::record('write','WARNING : Try delete data in profilem but havent permission',"DATA : id = $id");
				return json_encode($jTableResult);
			}
			$sql = "DELETE FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			//$stmt = $db->pdo->prepare($sql);
			$stmt->bindParam(':id',$_POST['id'],PDO::PARAM_INT);
			$stmt->execute();

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','WARNING : Delete data in profilem',"DATA : id = $id");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [profile.class.php/function delete]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function json_list($part,$for_all=null){
		try{
			$sql = "SELECT id AS Value,name AS DisplayText FROM ".self::$TABLE."  " ;
			// dsh($sql);
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Options'] = $rows;
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [profile.class.php/function json_list]'.$e->getMessage().'<br>';
			die();
		}
	}



	public static function select_list($part){
		try{
			$where = self::return_user_range($part);
			$sql = "SELECT id,name FROM ".self::$TABLE." WHERE {$where['profile']} " ;
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
			return $rows;
		}
		catch(PDOException $e){
			echo 'Error: [profile.class.php/function select_list]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function get_profile_info($id){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}
		catch(PDOException $e){
			echo 'Error: [profile.class.php/function get_profile_info]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function search_list($sorting,$startIndex,$pageSize,$search_str){
		try{
			$arr_table = array(
				'id'=>array('state'=>'self','field'=>'id'),
				'user'=>array('state'=>'foreign','table'=>'user','field'=>'name','source'=>'id_user'),
				'profile'=>array('state'=>'self','field'=>'name'),
				'detail'=>array('state'=>'self','field'=>'detail')
			);
			
			self::record('read',"search profile's","SEARCH: $search_str");
			return self::search($sorting,$startIndex,$pageSize,$search_str,$arr_table,'profile');
		}
		catch(exception $e){
			echo 'Error: [profile.class.php/function search_list]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function profile_as_options(){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." ORDER BY name ASC";
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$str = '';
			foreach ($rows as $key => $value) {
				$str .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
			}
			return $str;
		}
		catch(PDOException $e){
			echo 'Error: [profile.class.php/function profile_as_options]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function allTest(){
		try{
			$sql = "SELECT id,name FROM ".self::$TABLE." ORDER BY name ASC";
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			foreach ($rows as &$value) {
				$sql = "SELECT id,name,price FROM test WHERE id_profile = {$value['id']}";
				$result = self::$PDO->query($sql);
				$value['tests'] = $result->fetchAll(PDO::FETCH_ASSOC);
			}

			
			return $rows;
		}
		catch(PDOException $e){
			echo 'Error: [profile.class.php/function allTest]'.$e->getMessage().'<br>';
			die();
		}
	}


}

//$profile = new profile();
//echo profile::json_list();
//var_dump($profile->show_profiles('id',0,5));
// $data = array('name'=>'profile','type'=>'ok','detail'=>'good detail','id'=>'1');
// dsh(profile::update($data));
// dsh(profile::create($data));
?>