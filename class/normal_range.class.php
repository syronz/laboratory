<?php
require_once 'database.class.php';

class normal_range extends database{
	private $table = 'normal_range';
	private static $TABLE = 'normal_range';
	/*public function show_normal_ranges($sorting,$startIndex,$pageSize){
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
			echo 'Error: [normal_range.class.php/function calculate_row]'.$e->getMessage().'<br>';
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
			echo 'Error: [normal_range.class.php/function lists]'.$e->getMessage().'<br>';
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
			echo 'Error: [normal_range.class.php/function last_row_data]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function checkConflict($idTest,$min,$max,$gender,$id = null){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id_test='$idTest';";
			$stmt = self::$PDO->query($sql);
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// var_dump($idTest,$min,$max,$gender);
			// dsh($row);
			if($max < $min)
				return false;

			foreach ($row as $key => $value) {
				if($id == $value['id'])
					continue;
				if(($min <= $value['max_age'] && $max >= $value['max_age']) || ($max >= $value['min_age'] && $min <= $value['min_age']) || ($max <= $value['max_age'] && $min >= $value['min_age'])){
					if($gender == 'both' || $gender == $value['gender'] || $value['gender'] == 'both')
						return true;
				}
			}
			return false;
		}
		catch(PDOException $e){
			echo 'Error: [normal_range.class.php/function last_row_data]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function returnNormal($idTest,$age,$gender){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id_test='$idTest';";
			$stmt = self::$PDO->query($sql);
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// var_dump($idTest,$min,$max,$gender);
			// dsh($row);

			foreach ($row as $key => $value) {
				if($age <= $value['max_age'] && $age >= $value['min_age']){
					if($gender == 'both' || $gender == $value['gender'] || $value['gender'] == 'both')
						return $value;
				}
			}
			return false;
		}
		catch(PDOException $e){
			echo 'Error: [normal_range.class.php/function last_row_data]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function create($data){
		try{
			file_put_contents('a.txt', print_r($data,true));
			// if(!self::check_perm_manage(self::$TABLE)){
			// 	$jTableResult['Result'] = "NO";
			// 	$jTableResult['Message'] = dic_return('You Havent Permission To Create!!!');
			// 	self::record('write','WARNING : Try write data to normal_rangem but havent permission',"DATA : name = $name / detail = $detail");
			// 	return json_encode($jTableResult);
			// }

			if(self::checkConflict($data['id_test'],$data['min_age'],$data['max_age'],$data['gender'])){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('Conflict data');
				return json_encode($jTableResult);
			}


			$sql = "INSERT INTO ".self::$TABLE."(id_test,min_age,max_age,gender,in_print,detail,date,min,max) VALUES(:id_test,:min_age,:max_age,:gender,:in_print,:detail,NOW(),:min,:max);";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id_test',$data['id_test'],PDO::PARAM_STR);
			$stmt->bindParam(':min_age',$data['min_age'],PDO::PARAM_STR);
			$stmt->bindParam(':max_age',$data['max_age'],PDO::PARAM_STR);
			$stmt->bindParam(':gender',$data['gender'],PDO::PARAM_STR);
			$stmt->bindParam(':in_print',$data['in_print'],PDO::PARAM_STR);
			$stmt->bindParam(':detail',$data['detail'],PDO::PARAM_STR);
			$stmt->bindParam(':min',$data['min'],PDO::PARAM_STR);
			$stmt->bindParam(':max',$data['max'],PDO::PARAM_STR);
			$stmt->execute();

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Record'] = self::last_row_data();
			self::record('write','write data to normal_rangem',"DATA : name = name / detail = detail");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [normal_range.class.php/function create]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function update($data){
		try{

			$normalRangeInfo = self::get_normal_range_info($data['id']);
			if(self::checkConflict($normalRangeInfo['id_test'],$data['min_age'],$data['max_age'],$data['gender'],$data['id'])){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('Conflict data');
				return json_encode($jTableResult);
			}

			if(@$data['id_test'])
				$sql = "UPDATE ".self::$TABLE." SET id_test = :id_test, min_age = :min_age,max_age = :max_age, gender = :gender, in_print = :in_print, detail = :detail, min = :min, max = :max WHERE id = :id";
			else
				$sql = "UPDATE ".self::$TABLE." SET min_age = :min_age,max_age = :max_age, gender = :gender, in_print = :in_print, detail = :detail, min = :min, max = :max WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			if(@$data['id_test'])
				$stmt->bindParam(':id_test',$data['id_test'],PDO::PARAM_STR);
			$stmt->bindParam(':min_age',$data['min_age'],PDO::PARAM_STR);
			$stmt->bindParam(':max_age',$data['max_age'],PDO::PARAM_STR);
			$stmt->bindParam(':gender',$data['gender'],PDO::PARAM_STR);
			$stmt->bindParam(':in_print',$data['in_print'],PDO::PARAM_STR);
			$stmt->bindParam(':detail',$data['detail'],PDO::PARAM_STR);
			$stmt->bindParam(':min',$data['min'],PDO::PARAM_STR);
			$stmt->bindParam(':max',$data['max'],PDO::PARAM_STR);
			$stmt->bindParam(':id',$data['id'],PDO::PARAM_STR);
			$stmt->execute();
			
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','Edit data on normal_rangem',"DATA : name = name / detail = detail / id = id");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [normal_range.class.php/function update]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function delete($id){
		try{
			if(!self::check_perm_manage(self::$TABLE)){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission To Edit!!!');
				self::record('write','WARNING : Try delete data in normal_rangem but havent permission',"DATA : id = $id");
				return json_encode($jTableResult);
			}
			$sql = "DELETE FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			//$stmt = $db->pdo->prepare($sql);
			$stmt->bindParam(':id',$_POST['id'],PDO::PARAM_INT);
			$stmt->execute();

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','WARNING : Delete data in normal_rangem',"DATA : id = $id");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [normal_range.class.php/function delete]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function json_list($part,$for_all=null){
		try{
			if($for_all == 'all')
				return '{"Result":"OK","Options":[{"Value":"-1","DisplayText":""}]}';
			$where = self::return_user_range($part);
			$sql = "SELECT id AS Value,name AS DisplayText FROM ".self::$TABLE." WHERE {$where['normal_range']} " ;
			// dsh($sql);
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Options'] = $rows;
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [normal_range.class.php/function json_list]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function select_list($part){
		try{
			$where = self::return_user_range($part);
			$sql = "SELECT id,name FROM ".self::$TABLE." WHERE {$where['normal_range']} " ;
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
			return $rows;
		}
		catch(PDOException $e){
			echo 'Error: [normal_range.class.php/function select_list]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function get_normal_range_info($id){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}
		catch(PDOException $e){
			echo 'Error: [normal_range.class.php/function get_normal_range_info]'.$e->getMessage().'<br>';
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
			
			self::record('read',"search normal_range's","SEARCH: $search_str");
			return self::search($sorting,$startIndex,$pageSize,$search_str,$arr_table,'normal_range');
		}
		catch(exception $e){
			echo 'Error: [normal_range.class.php/function search_list]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function detail_lists($id_test){
		try{
			//$where = self::check_permission_view(self::$TABLE);
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id_test = $id_test";
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$count = count($rows);
			/*for($i=0;$i<$count;$i++){
				$rows[$i]['total_pack'] = $rows[$i]['unit_pack'] * $rows[$i]['qty'];
				$rows[$i]['total_kg'] = $rows[$i]['unit_kg'] * $rows[$i]['qty'];
				$rows[$i]['total_m3'] = $rows[$i]['unit_m3'] * $rows[$i]['qty'];
				$rows[$i]['total_price'] = $rows[$i]['price'] * $rows[$i]['qty'];

				$rows[$i]['row']++; 

				if($rows[$i]['id_stuff']){
					$stuff_info = self::stuff_info($rows[$i]['id_stuff']);
					$rows[$i]['id_category'] = $stuff_info['model']->id_category;
					$rows[$i]['id_test'] = $stuff_info['stuff']->id_test;
				}
				
			}*/

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Records'] = $rows;
			self::record('read','View models_stuff Detail');
			return json_encode($jTableResult);
		}
		catch(PDOException $e){

			echo 'Error: [buy_facture.class.php/function lists]'.$e->getMessage().'<br>';
			die();
		}
	}
}

//$normal_range = new normal_range();


//echo normal_range::json_list();
//var_dump($normal_range->show_normal_ranges('id',0,5));
// $data = array('id_test'=>'1','min_age'=>'15','max_age'=>'30','gender'=>'man','detail'=>'good detail');
// dsh(normal_range::create($data));

// dsh(normal_range::checkConflict(9,36,45,'both'));
 //dsh(normal_range::returnNormal(22,5,'female'));
?>
