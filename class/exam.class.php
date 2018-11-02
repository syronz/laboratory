<?php
require_once 'database.class.php';
require_once 'fund.class.php';
require_once 'patient.class.php';

class exam extends database{
	private $table = 'exam';
	private static $TABLE = 'exam';
	/*public function show_exams($sorting,$startIndex,$pageSize){
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
			echo 'Error: [exam.class.php/function calculate_row]'.$e->getMessage().'<br>';
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
			echo 'Error: [exam.class.php/function lists]'.$e->getMessage().'<br>';
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
			echo 'Error: [exam.class.php/function last_row_data]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function idExam(){
		try{
			$sql = "SELECT id FROM ".self::$TABLE." ORDER BY id DESC LIMIT 1";
			$stmt = self::$PDO->query($sql);
			$row = $stmt->fetchObject();
			if($row)
				return $row->id;
			return 0;
		}
		catch(PDOException $e){
			echo 'Error: [exam.class.php/function last_row_data]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function create($data){
		try{
			// if(!self::check_perm_manage(self::$TABLE)){
			// 	$jTableResult['Result'] = "NO";
			// 	$jTableResult['Message'] = dic_return('You Havent Permission To Create!!!');
			// 	self::record('write','WARNING : Try write data to examm but havent permission',"DATA : name = $name / detail = $detail");
			// 	return json_encode($jTableResult);
			// }

			// if(!$data['patientName'] && !$data['patientId'])
			// 	return 'No Patient';

			// dsh($data['tests']);
			$idExam = self::idExam() + 1;
			// dsh($idExam);

			$fundPayment = $data['totalPrice'] - $data['discount'];
			$data_fund = array('dollar'=> '','dinar' => $fundPayment,'detail' => "discount : {$data['discount']}", 'type'=>'payin', 'id_exam'=>$idExam);
			fund::create($data_fund);

			$idFund = fund::idFund();

			if($data['patientName']){
				$dataPatient = array('dob'=>$data['dob'],'name'=>$data['patientName'],'gender'=>$data['gender'],'detail'=>@$data['detail']);
				patient::create($dataPatient);
				$idPatient = patient::idPatient();
				$age = patient::getAge($idPatient);
			}
			else{
				$idPatient = $data['patientId'];
				$age = patient::getAge($idPatient);
			}

			$state = 'progress';

			$sql = "INSERT INTO ".self::$TABLE."(id,id_patient,date_recieved,age,doctor,state,detail,total_price,discount,id_fund) VALUES(:id,:id_patient,NOW(),:age,:doctor,:state,:detail,:total_price,:discount,:id_fund);";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id',$idExam,PDO::PARAM_STR);
			$stmt->bindParam(':id_patient',$idPatient,PDO::PARAM_STR);
			$stmt->bindParam(':age',$age,PDO::PARAM_STR);
			$stmt->bindParam(':doctor',$data['doctorName'],PDO::PARAM_STR);
			$stmt->bindParam(':state',$state,PDO::PARAM_STR);
			$stmt->bindParam(':detail',$data['examDetail'],PDO::PARAM_STR);
			$stmt->bindParam(':total_price',$data['totalPrice'],PDO::PARAM_STR);
			$stmt->bindParam(':discount',$data['discount'],PDO::PARAM_STR);
			$stmt->bindParam(':id_fund',$idFund,PDO::PARAM_STR);
			$stmt->execute();


			foreach ($data['tests'] as $key => $value) {
				if($value['check']){
					$sql = "INSERT INTO exam_tests(id_exam,id_test,detail) VALUES(:id_exam,:id_test,:detail)";
					$stmt = self::$PDO->prepare($sql);
					$stmt->bindParam(':id_exam',$idExam,PDO::PARAM_STR);
					$stmt->bindParam(':id_test',$value['id'],PDO::PARAM_STR);
					$stmt->bindParam(':detail',$value['detail'],PDO::PARAM_STR);
					$stmt->execute();
				}
			}
			
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','write data to examm',"DATA : name = name / detail = detail");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			dsh($e);
			echo 'Error: [exam.class.php/function create]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function update($data){
		try{
			// if(!self::check_perm_manage(self::$TABLE)){
			// 	$jTableResult['Result'] = "NO";
			// 	$jTableResult['Message'] = dic_return('You Havent Permission To Edit!!!');
			// 	self::record('write','WARNING : Try edit data on examm but havent permission',"DATA : name = $name / detail = $detail / id = $id");
			// 	return json_encode($jTableResult);
			// }
			$sql = "UPDATE ".self::$TABLE." SET detail = :detail WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':detail',$data['detail'],PDO::PARAM_STR);
			$stmt->bindParam(':id',$data['id'],PDO::PARAM_STR);
			$stmt->execute();
			
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','Edit data on examm',"DATA : name = name / detail = detail / id = id");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [exam.class.php/function update]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function delete($id){
		try{
			if(!self::check_perm_manage(self::$TABLE)){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission To Edit!!!');
				self::record('write','WARNING : Try delete data in examm but havent permission',"DATA : id = $id");
				return json_encode($jTableResult);
			}
			$sql = "DELETE FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			//$stmt = $db->pdo->prepare($sql);
			$stmt->bindParam(':id',$_POST['id'],PDO::PARAM_INT);
			$stmt->execute();

			$sql = "DELETE FROM exam_tests WHERE id_exam = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();

			$sql = "SELECT * FROM fund WHERE id_exam = '$id'";
			$stmt = self::$PDO->query($sql);
			$row = $stmt->fetchObject();

			fund::delete($row->id,true);

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','WARNING : Delete data in examm',"DATA : id = $id");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [exam.class.php/function delete]'.$e->getMessage().'<br>';
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
			echo 'Error: [exam.class.php/function json_list]'.$e->getMessage().'<br>';
			die();
		}
	}



	public static function select_list($part){
		try{
			$where = self::return_user_range($part);
			$sql = "SELECT id,name FROM ".self::$TABLE." WHERE {$where['exam']} " ;
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
			return $rows;
		}
		catch(PDOException $e){
			echo 'Error: [exam.class.php/function select_list]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function get_exam_info($id){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}
		catch(PDOException $e){
			echo 'Error: [exam.class.php/function get_exam_info]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function search_list($sorting,$startIndex,$pageSize,$search_str){
		try{
			$arr_table = array(
				'id'=>array('state'=>'self','field'=>'id'),
				'total_price'=>array('state'=>'self','field'=>'total_price'),
				'patient'=>array('state'=>'foreign','table'=>'patient','field'=>'name','source'=>'id_patient'),
				// 'exam'=>array('state'=>'self','field'=>'id'),
				'date_recieved'=>array('state'=>'self','field'=>'date_recieved'),
				'detail'=>array('state'=>'self','field'=>'detail')
			);
			
			self::record('read',"search exam's","SEARCH: $search_str");
			return self::search($sorting,$startIndex,$pageSize,$search_str,$arr_table,'exam');
		}
		catch(exception $e){
			echo 'Error: [exam.class.php/function search_list]'.$e->getMessage().'<br>';
			die();
		}
	}


}

//$exam = new exam();
//echo exam::json_list();
//var_dump($exam->show_exams('id',0,5));
// $data = array('name'=>'exam','type'=>'ok','detail'=>'good detail','id'=>'1');
// dsh(exam::update($data));
// dsh(exam::create($data));
?>
