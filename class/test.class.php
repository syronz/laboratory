<?php
require_once 'database.class.php';

class test extends database{
	private $table = 'test';
	private static $TABLE = 'test';
	/*public function show_tests($sorting,$startIndex,$pageSize){
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
			echo 'Error: [test.class.php/function calculate_row]'.$e->getMessage().'<br>';
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
			echo 'Error: [test.class.php/function lists]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function testListProfile($idProfile){
		try{
			$sql = "SELECT id,name,price FROM ".self::$TABLE." WHERE id_profile = $idProfile;";
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			foreach ($rows as $key => &$value) {
				$value['price'] = dsh_money($value['price']);
			}

			// $jTableResult = array();
			// $jTableResult['Result'] = "OK";
			// $jTableResult['Message'] = "bye";
			// $jTableResult['TotalRecordCount'] = self::calculate_row();
			// $jTableResult['Records'] = $rows;
			// self::record('read','View '.self::$TABLE.' Table');
			return json_encode($rows);
		}
		catch(PDOException $e){
			echo 'Error: [test.class.php/function testListProfile]'.$e->getMessage().'<br>';
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
			echo 'Error: [test.class.php/function last_row_data]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function create($data){
		try{
			// if(!self::check_perm_manage(self::$TABLE)){
			// 	$jTableResult['Result'] = "NO";
			// 	$jTableResult['Message'] = dic_return('You Havent Permission To Create!!!');
			// 	self::record('write','WARNING : Try write data to testm but havent permission',"DATA : name = $name / detail = $detail");
			// 	return json_encode($jTableResult);
			// }
			$sql = "INSERT INTO ".self::$TABLE."(id_profile,name,type,result_type,price,detail,date,default_normal) VALUES(:id_profile,:name,:type,:result_type,:price,:detail,NOW(),:default_normal);";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id_profile',$data['id_profile'],PDO::PARAM_STR);
			$stmt->bindParam(':name',$data['name'],PDO::PARAM_STR);
			$stmt->bindParam(':type',$data['type'],PDO::PARAM_STR);
			$stmt->bindParam(':result_type',$data['result_type'],PDO::PARAM_STR);
			$stmt->bindParam(':price',$data['price'],PDO::PARAM_STR);
			$stmt->bindParam(':detail',$data['detail'],PDO::PARAM_STR);
			$stmt->bindParam(':default_normal',$data['default_normal'],PDO::PARAM_STR);
			$stmt->execute();

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Record'] = self::last_row_data();
			self::record('write','write data to testm',"DATA : name = name / detail = detail");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [test.class.php/function create]'.$e->getMessage().'<br>';
			die();
		}
	}

public static function insertResult($data){
		try{
			// if(!self::check_perm_manage(self::$TABLE)){
			// 	$jTableResult['Result'] = "NO";
			// 	$jTableResult['Message'] = dic_return('You Havent Permission To Edit!!!');
			// 	self::record('write','WARNING : Try edit data on testm but havent permission',"DATA : name = $name / detail = $detail / id = $id");
			// 	return json_encode($jTableResult);
			// }
			$sql = "UPDATE exam_tests SET result = :result, detail = :detail, checker = :checker WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':result',$data['result'],PDO::PARAM_STR);
			$stmt->bindParam(':detail',$data['detail'],PDO::PARAM_STR);
			$stmt->bindParam(':checker',$data['checker'],PDO::PARAM_STR);
			$stmt->bindParam(':id',$data['id'],PDO::PARAM_STR);
			$stmt->execute();
			
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','Edit data on testm',"DATA : name = name / detail = detail / id = id");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [test.class.php/function update]'.$e->getMessage().'<br>';
			die();
		}
	}


	public static function update($data){
		try{
			if(!self::check_perm_manage(self::$TABLE)){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission To Edit!!!');
				self::record('write','WARNING : Try edit data on testm but havent permission',"DATA : name = $name / detail = $detail / id = $id");
				return json_encode($jTableResult);
			}
			$sql = "UPDATE ".self::$TABLE." SET id_profile = :id_profile, name = :name,type = :type, result_type = :result_type, price = :price, detail = :detail, default_normal = :default_normal WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id_profile',$data['id_profile'],PDO::PARAM_STR);
			$stmt->bindParam(':name',$data['name'],PDO::PARAM_STR);
			$stmt->bindParam(':type',$data['type'],PDO::PARAM_STR);
			$stmt->bindParam(':result_type',$data['result_type'],PDO::PARAM_STR);
			$stmt->bindParam(':price',$data['price'],PDO::PARAM_STR);
			$stmt->bindParam(':detail',$data['detail'],PDO::PARAM_STR);
			$stmt->bindParam(':default_normal',$data['default_normal'],PDO::PARAM_STR);
			$stmt->bindParam(':id',$data['id'],PDO::PARAM_STR);
			$stmt->execute();
			
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','Edit data on testm',"DATA : name = name / detail = detail / id = id");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [test.class.php/function update]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function delete($id){
		try{
			if(!self::check_perm_manage(self::$TABLE)){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission To Edit!!!');
				self::record('write','WARNING : Try delete data in testm but havent permission',"DATA : id = $id");
				return json_encode($jTableResult);
			}
			$sql = "DELETE FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			//$stmt = $db->pdo->prepare($sql);
			$stmt->bindParam(':id',$_POST['id'],PDO::PARAM_INT);
			$stmt->execute();

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','WARNING : Delete data in testm',"DATA : id = $id");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [test.class.php/function delete]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function json_list($part,$for_all=null){
		try{
			$sql = "SELECT id AS Value,name AS DisplayText FROM ".self::$TABLE;
			// dsh($sql);
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Options'] = $rows;
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [test.class.php/function json_list]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function exam_list($idExam){
		try{
			$sql = "SELECT exam_tests.*,test.id_profile,test.default_normal AS normal FROM exam_tests INNER JOIN test ON exam_tests.id_test = test.id WHERE id_exam = $idExam ORDER BY exam_tests.id ASC";
			// $sql = "SELECT id FROM exam_tests WHERE id_exam = $idExam";
			// dsh($sql);
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			// $jTableResult = array();
			// $jTableResult['Result'] = "OK";
			// $jTableResult['Options'] = $rows;

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Message'] = "bye";
			// $jTableResult['TotalRecordCount'] = self::calculate_row();
			$jTableResult['Records'] = $rows;
			self::record('read','View '.self::$TABLE.' Table');
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [test.class.php/function exam_list]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function examListPrint($idExam){
		try{
			$sql = "SELECT exam_tests.*,test.id_profile,test.result_type,test.name AS test_name,profile.name AS profile_name,test.default_normal,test.price FROM exam_tests INNER JOIN test ON exam_tests.id_test = test.id INNER JOIN profile ON test.id_profile = profile.id WHERE id_exam = $idExam ORDER BY exam_tests.id ASC";
			// $sql = "SELECT id FROM exam_tests WHERE id_exam = $idExam";
			// dsh($sql);
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
			
			return $rows;
		}
		catch(PDOException $e){
			echo 'Error: [test.class.php/function examListPrint]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function select_list($part){
		try{
			$where = self::return_user_range($part);
			$sql = "SELECT id,name FROM ".self::$TABLE." WHERE {$where['test']} " ;
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
			return $rows;
		}
		catch(PDOException $e){
			echo 'Error: [test.class.php/function select_list]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function get_test_info($id){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}
		catch(PDOException $e){
			echo 'Error: [test.class.php/function get_test_info]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function search_list($sorting,$startIndex,$pageSize,$search_str){
		try{
			$arr_table = array(
				'id'=>array('state'=>'self','field'=>'id'),
				'id_profile'=>array('state'=>'foreign','table'=>'profile','field'=>'name','source'=>'id_profile'),
				'name'=>array('state'=>'self','field'=>'name'),
				'price'=>array('state'=>'self','field'=>'price'),
				'result_type'=>array('state'=>'self','field'=>'result_type'),
				'detail'=>array('state'=>'self','field'=>'detail')
			);
			
			self::record('read',"search test's","SEARCH: $search_str");
			return self::search($sorting,$startIndex,$pageSize,$search_str,$arr_table,'test');
		}
		catch(exception $e){
			echo 'Error: [test.class.php/function search_list]'.$e->getMessage().'<br>';
			die();
		}
	}
}

//$test = new test();


//echo test::json_list();
//var_dump($test->show_tests('id',0,5));
// $data = array('name'=>'test','type'=>'ok','detail'=>'good detail');
// dsh(test::create($data));
?>