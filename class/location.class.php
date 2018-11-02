<?php
require_once 'database.class.php';

class location extends database{
	private $table = 'location';
	private static $TABLE = 'location';

	public static function calculate_row(){
		try{
			$sql = "SELECT count(id) AS count FROM ".self::$TABLE;
			$result = self::$PDO->query($sql);
			$count = $result->fetchObject();
			return $count->count;
		}
		catch(PDOException $e){
			echo 'Error: [location.class.php/function calculate_row]'.$e->getMessage().'<br>';
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
			self::record('read','View '.self::$TABLE.' Table');
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [location.class.php/function lists]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function search_list($sorting,$startIndex,$pageSize,$search_str){
		try{
			/*$where = self::check_permission_view(self::$TABLE);
			self::hack_pageSize($startIndex,$pageSize);
			$sorting = self::hack_sorting($sorting);*/

			$arr_table = array(
				'id'=>array('state'=>'self','field'=>'id'),
				'department'=>array('state'=>'foreign','table'=>'department','field'=>'name','source'=>'id_department'),
				'user'=>array('state'=>'foreign','table'=>'user','field'=>'name','source'=>'id_user'),
				'code'=>array('state'=>'self','field'=>'code'),
				'location'=>array('state'=>'self','field'=>'name'),
				'type'=>array('state'=>'self','field'=>'type'),
				'phone'=>array('state'=>'self','field'=>'phone'),
				'address'=>array('state'=>'self','field'=>'address'),
				'detail'=>array('state'=>'self','field'=>'detail')
			);
			
			self::record('read',"search locations's","SEARCH: $search_str");
			return self::search($sorting,$startIndex,$pageSize,$search_str,$arr_table,'location');
		}
		catch(PDOException $e){
			echo 'Error: [model.class.php/function lists]'.$e->getMessage().'<br>';
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
			echo 'Error: [location.class.php/function last_row_data]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function create($id_department,$id_user,$code,$name,$type,$phone,$address,$detail){
		try{
			if(!self::check_perm_manage(self::$TABLE)){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission To Create!!!');
				self::record('write','WARNING : Try write data to '.self::$TABLE.' but havent permission',"DATA : name = $name / detail = $detail");
				return json_encode($jTableResult);
			}
			$sql = "INSERT INTO ".self::$TABLE."(id_department,id_user,code,name,type,phone,address,detail) VALUES(:id_department,:id_user,:code,:name,:type,:phone,:address,:detail);";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id_department',$id_department,PDO::PARAM_STR);
			$stmt->bindParam(':id_user',$id_user,PDO::PARAM_STR);
			$stmt->bindParam(':code',$code,PDO::PARAM_STR);
			$stmt->bindParam(':name',$name,PDO::PARAM_STR);
			$stmt->bindParam(':type',$type,PDO::PARAM_STR);
			$stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
			$stmt->bindParam(':address',$address,PDO::PARAM_STR);
			$stmt->bindParam(':detail',$detail,PDO::PARAM_STR);
			$stmt->execute();

			$fp = fopen('a.txt', 'a+');
			fwrite($fp, "$id_user|$name|$detail"."\n");
			
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Record'] = self::last_row_data();
			self::record('write','Write data to '.self::$TABLE,"DATA : name = $name / detail = $detail");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [location.class.php/function create]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function update($id_department,$id_user,$code,$name,$type,$phone,$address,$detail,$id){
		try{
			if(!self::check_perm_manage(self::$TABLE)){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission To Edit!!!');
				self::record('write','WARNING : Try edit data in '.self::$TABLE.' but havent permission',"DATA : name = $name / detail = $detail / id = $id");
				return json_encode($jTableResult);
			}
			$sql = "UPDATE ".self::$TABLE." SET id_department = :id_department, id_user = :id_user, code = :code, name = :name, type = :type, phone = :phone, address = :address, detail = :detail WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id_department',$id_department,PDO::PARAM_STR);
			$stmt->bindParam(':id_user',$id_user,PDO::PARAM_STR);
			$stmt->bindParam(':code',$code,PDO::PARAM_STR);
			$stmt->bindParam(':name',$name,PDO::PARAM_STR);
			$stmt->bindParam(':type',$type,PDO::PARAM_STR);
			$stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
			$stmt->bindParam(':address',$address,PDO::PARAM_STR);
			$stmt->bindParam(':detail',$detail,PDO::PARAM_STR);
			$stmt->bindParam(':id',$id,PDO::PARAM_STR);
			$stmt->execute();
			
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','Edit data in '.self::$TABLE,"DATA : name = $name / detail = $detail / id = $id ");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [location.class.php/function update]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function delete($id){
		try{
			if(!self::check_perm_manage(self::$TABLE)){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission To delete!!!');
				self::record('write','WARNING : Try delete data in '.self::$TABLE.' but havent permission',"DATA : id = $id");
				return json_encode($jTableResult);
			}
			$sql = "DELETE FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			//$stmt = $db->pdo->prepare($sql);
			$stmt->bindParam(':id',$_POST['id'],PDO::PARAM_INT);
			$stmt->execute();

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','WARNING : Delete data in '.self::$TABLE.' but havent permission',"DATA : id = $id");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [location.class.php/function delete]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function json_list($id_department,$part){
		try{
			$where = self::return_user_range($part);
			$id_department = intval($id_department);
			if($id_department)
				$sql = "SELECT id AS Value,name AS DisplayText FROM ".self::$TABLE." WHERE id_department = $id_department AND {$where['location']}";
			else
				$sql = "SELECT id AS Value,name AS DisplayText FROM ".self::$TABLE;
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Options'] = $rows;
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [location.class.php/function json_list]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function get_location_info($id){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}
		catch(PDOException $e){
			echo 'Error: [location.class.php/function get_location_info]'.$e->getMessage().'<br>';
			die();
		}
	}
}

//$location = new location();

//var_dump($location->show_locations('id',0,5));


?>