<?php
require_once 'database.class.php';
require_once 'permission.class.php';
require_once 'user.class.php';

class fund extends database{
	private static $TABLE = 'fund';

	public static function lists($sorting,$startIndex,$pageSize){
		try{
			$where = self::check_permission_view(self::$TABLE);
			self::hack_pageSize($startIndex,$pageSize);
			// $sorting = self::hack_sorting($sorting);
			// $sql = "SELECT * FROM ".self::$TABLE." $where ORDER BY $sorting LIMIT $startIndex, $pageSize;";
			$sql = "SELECT * FROM ".self::$TABLE."  ORDER BY $sorting LIMIT $startIndex, $pageSize;";
			// dsh($sql);
			
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$count = count($rows);
			for($i=0;$i<$count;$i++){
				$rows[$i]['dollar'] = dsh_money($rows[$i]['dollar'],0,'$');
				$rows[$i]['dinar'] = dsh_money($rows[$i]['dinar']);
				$rows[$i]['box_dollar'] = dsh_money($rows[$i]['box_dollar'],0,'$');
				$rows[$i]['box_dinar'] = dsh_money($rows[$i]['box_dinar']);

			}

			$sql = "SELECT COUNT(*) AS count FROM ".self::$TABLE." ;";
			$result = self::$PDO->query($sql);
			$count = $result->fetch(PDO::FETCH_ASSOC);

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			// $jTableResult['TotalRecordCount'] = self::calculate_rows(self::$TABLE);
			$jTableResult['TotalRecordCount'] = $count['count'];
			$jTableResult['Records'] = $rows;
			self::record('read','View fund\'s');
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function lists]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function list_all($sorting,$startIndex,$pageSize){
		try{
			$where = self::check_permission_view('boss_reports');
			// dsh($where);
			self::hack_pageSize($startIndex,$pageSize);
			$sorting = self::hack_sorting($sorting);
			// $sql = "SELECT * FROM ".self::$TABLE." $where ORDER BY $sorting LIMIT $startIndex, $pageSize;";
			$sql = "SELECT * FROM ".self::$TABLE." $where ORDER BY $sorting LIMIT $startIndex, $pageSize;";
			
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$count = count($rows);
			for($i=0;$i<$count;$i++){
				$rows[$i]['dollar'] = dsh_money($rows[$i]['dollar'],0,'$');
				$rows[$i]['dinar'] = dsh_money($rows[$i]['dinar']);
				$rows[$i]['box_dollar'] = dsh_money($rows[$i]['box_dollar'],0,'$');
				$rows[$i]['box_dinar'] = dsh_money($rows[$i]['box_dinar']);

			}

			$sql = "SELECT COUNT(*) AS count FROM ".self::$TABLE." ;";
			$result = self::$PDO->query($sql);
			$count = $result->fetch(PDO::FETCH_ASSOC);


			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			// $jTableResult['TotalRecordCount'] = self::calculate_rows(self::$TABLE);
			$jTableResult['TotalRecordCount'] = $count['count'];
			$jTableResult['Records'] = $rows;
			self::record('read','View fund\'s');
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function lists]'.$e->getMessage().'<br>';
			die();
		}
	}


	public static function location_report($sorting,$startIndex,$pageSize,$date,$id_location = null){
		try{
			$where = self::check_permission_view('boss_reports');
			// dsh($where);
			self::hack_pageSize($startIndex,$pageSize);
			$sorting = self::hack_sorting($sorting);
			if(!isset($id_location))
				$id_location = $_SESSION['user']['id_location'];
			// $sql = "SELECT * FROM ".self::$TABLE." $where ORDER BY $sorting LIMIT $startIndex, $pageSize;";
			$sql = "SELECT * FROM ".self::$TABLE." WHERE date LIKE '$date%' AND id_location = '$id_location' ORDER BY id_user,$sorting LIMIT $startIndex, $pageSize;";
			
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$count = count($rows);
			for($i=0;$i<$count;$i++){
				$rows[$i]['dollar'] = dsh_money($rows[$i]['dollar'],0,'$');
				$rows[$i]['dinar'] = dsh_money($rows[$i]['dinar']);
				$rows[$i]['box_dollar'] = dsh_money($rows[$i]['box_dollar'],0,'$');
				$rows[$i]['box_dinar'] = dsh_money($rows[$i]['box_dinar']);

			}

			$sql = "SELECT COUNT(*) AS count FROM ".self::$TABLE." WHERE date LIKE '$date%' AND id_location = '$id_location';";
			$result = self::$PDO->query($sql);
			$count = $result->fetch(PDO::FETCH_ASSOC);


			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			// $jTableResult['TotalRecordCount'] = self::calculate_rows(self::$TABLE);
			$jTableResult['TotalRecordCount'] = $count['count'];
			$jTableResult['Records'] = $rows;
			self::record('read','View fund\'s');
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function location_report]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function user_fund_report($sorting,$startIndex,$pageSize,$date,$id_location = null){
		try{
			$where = self::check_permission_view('boss_reports');
			// dsh($where);
			self::hack_pageSize($startIndex,$pageSize);
			$sorting = self::hack_sorting($sorting);
			if(!isset($id_location))
				$id_location = $_SESSION['user']['id_location'];
			$id_user = $_SESSION['user']['id'];
			// $sql = "SELECT * FROM ".self::$TABLE." $where ORDER BY $sorting LIMIT $startIndex, $pageSize;";
			$sql = "SELECT * FROM ".self::$TABLE." WHERE date LIKE '$date%' AND id_location = '$id_location' AND id_user = '$id_user' ORDER BY id_user,$sorting LIMIT $startIndex, $pageSize;";
			
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$count = count($rows);
			for($i=0;$i<$count;$i++){
				$rows[$i]['dollar'] = dsh_money($rows[$i]['dollar'],0,'$');
				$rows[$i]['dinar'] = dsh_money($rows[$i]['dinar']);
				$rows[$i]['box_dollar'] = dsh_money($rows[$i]['box_dollar'],0,'$');
				$rows[$i]['box_dinar'] = dsh_money($rows[$i]['box_dinar']);

			}

			$sql = "SELECT COUNT(*) AS count FROM ".self::$TABLE." WHERE date LIKE '$date%' AND id_location = '$id_location';";
			$result = self::$PDO->query($sql);
			$count = $result->fetch(PDO::FETCH_ASSOC);


			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			// $jTableResult['TotalRecordCount'] = self::calculate_rows(self::$TABLE);
			$jTableResult['TotalRecordCount'] = $count['count'];
			$jTableResult['Records'] = $rows;
			self::record('read','View fund\'s');
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function user_fund_report]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function location_report_pp($date,$id_location = null){
		try{
			if(!isset($id_location))
				$id_location = $_SESSION['user']['id_location'];
			// $sql = "SELECT * FROM ".self::$TABLE." $where ORDER BY $sorting LIMIT $startIndex, $pageSize;";
			$sql = "SELECT SUM(dollar) AS sum_dollar, SUM(dinar) AS sum_dinar FROM payment WHERE date LIKE '$date%' AND id_location = '$id_location';";
			$result = self::$PDO->query($sql);
			$rows = $result->fetch(PDO::FETCH_ASSOC);

			$arr_result = array();
			$arr_result['payment_dollar'] = $rows['sum_dollar'];
			$arr_result['payment_dinar'] = $rows['sum_dinar'];

			$sql = "SELECT SUM(dollar) AS sum_dollar, SUM(dinar) AS sum_dinar FROM payout WHERE date LIKE '$date%' AND id_location = '$id_location';";
			$result = self::$PDO->query($sql);
			$rows = $result->fetch(PDO::FETCH_ASSOC);

			$arr_result['payout_dollar'] = $rows['sum_dollar'];
			$arr_result['payout_dinar'] = $rows['sum_dinar'];

			$sql = "SELECT type,SUM(dollar) AS sum_dollar, SUM(dinar) AS sum_dinar FROM fund WHERE date LIKE '$date%' AND id_location = '$id_location' GROUP BY type;";
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$rows2 = array();
			foreach ($rows as $key => $value) {
				$rows2[$value['type']] = $value;
			}

			$arr_result['all'] = $rows2;

			return $arr_result;
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function location_report_pp]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function user_report_pp($date,$id_user = null){
		try{
			if(!isset($id_user))
				$id_user = $_SESSION['user']['id'];
			// $sql = "SELECT * FROM ".self::$TABLE." $where ORDER BY $sorting LIMIT $startIndex, $pageSize;";
			$sql = "SELECT SUM(dollar) AS sum_dollar, SUM(dinar) AS sum_dinar FROM payment WHERE date LIKE '$date%' AND id_user = '$id_user';";
			$result = self::$PDO->query($sql);
			$rows = $result->fetch(PDO::FETCH_ASSOC);

			$arr_result = array();
			$arr_result['payment_dollar'] = $rows['sum_dollar'];
			$arr_result['payment_dinar'] = $rows['sum_dinar'];

			$sql = "SELECT SUM(dollar) AS sum_dollar, SUM(dinar) AS sum_dinar FROM payout WHERE date LIKE '$date%' AND id_user = '$id_user';";
			$result = self::$PDO->query($sql);
			$rows = $result->fetch(PDO::FETCH_ASSOC);

			$arr_result['payout_dollar'] = $rows['sum_dollar'];
			$arr_result['payout_dinar'] = $rows['sum_dinar'];

			$sql = "SELECT type,SUM(dollar) AS sum_dollar, SUM(dinar) AS sum_dinar FROM fund WHERE date LIKE '$date%' AND id_user = '$id_user' GROUP BY type;";
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$rows2 = array();
			foreach ($rows as $key => $value) {
				$rows2[$value['type']] = $value;
			}

			$arr_result['all'] = $rows2;

			return $arr_result;
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function user_report_pp]'.$e->getMessage().'<br>';
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
			echo 'Error: [fund.class.php/function last_row_data]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function pre_fund($id_user = null){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." ORDER BY id DESC LIMIT 1;";
			$stmt = self::$PDO->query($sql);
			$row = $stmt->fetchObject();
			return $row;
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function pre_fund]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function find_fund_by_id_payment($id_payment){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id_payment = $id_payment;";
			$stmt = self::$PDO->query($sql);
			$row = $stmt->fetchObject();
			return $row;
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function find_fund_by_id_payment]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function find_fund_by_id_payout($id_payout){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id_payout = $id_payout;";
			$stmt = self::$PDO->query($sql);
			$row = $stmt->fetchObject();
			return $row;
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function find_fund_by_id_payout]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function create($data){
		try{
			// $perm['id_location'] = $_SESSION['user']['id_location'];

			if(!self::check_perm_manage('fund',$_SESSION['user'])){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission!!! to add fund');
				self::record('write','WARNING : Try Add new fund but havent permission',"DATA : {$data['dollar']}");
				return json_encode($jTableResult);
			}

			if(($data['dollar'] * $data['dinar']) < 0)
				$data['type'] = 'exchange';

			$data['dollar'] = 0;
			

			$pre = self::pre_fund();
			$box_dollar = @$pre->box_dollar + $data['dollar'];
			$box_dinar = @$pre->box_dinar + $data['dinar'];
			

			$sql = "INSERT INTO ".self::$TABLE."(id_user,date,dollar,dinar,box_dollar,box_dinar,type,detail,id_exam) VALUES(:id_user,NOW(),:dollar,:dinar,:box_dollar,:box_dinar,:type,:detail,:id_exam);";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id_user',$id_user,PDO::PARAM_STR);
			$stmt->bindParam(':dollar',$data['dollar'],PDO::PARAM_STR);
			$stmt->bindParam(':dinar',$data['dinar'],PDO::PARAM_STR);
			$stmt->bindParam(':box_dollar',$box_dollar,PDO::PARAM_STR);
			$stmt->bindParam(':box_dinar',$box_dinar,PDO::PARAM_STR);
			$stmt->bindParam(':type',$data['type'],PDO::PARAM_STR);
			//$stmt->bindParam(':date_last_changed','NOW()''],PDO::PARAM_STR);
			$stmt->bindParam(':detail',$data['detail'],PDO::PARAM_STR);
			$stmt->bindParam(':id_exam',$data['id_exam'],PDO::PARAM_STR);
			$stmt->execute();



			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Record'] = self::last_row_data();
			self::record('write','Add new fund',"DATA : {$data['dollar']} , {$data['dinar']}");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			dsh($e);
			echo 'Error: [fund.class.php/function create]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function update_box($id_user,$id,$offset_dollar,$offset_dinar){
		try{
			$sql = "UPDATE ".self::$TABLE." SET box_dollar = box_dollar + (:offset_dollar), box_dinar = box_dinar + (:offset_dinar) WHERE id >= :id AND id_user = :id_user";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':offset_dollar',$offset_dollar,PDO::PARAM_STR);
			$stmt->bindParam(':offset_dinar',$offset_dinar,PDO::PARAM_STR);
			$stmt->bindParam(':id_user',$id_user,PDO::PARAM_STR);
			$stmt->bindParam(':id',$id,PDO::PARAM_STR);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function update_box]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function update($data){
		try{
			// file_put_contents('a.txt', print_r($data,true));
			$dollar = $data['dollar'];
			$dinar = $data['dinar'];
			$detail = $data['detail'];
			$id = $data['id'];

			$before = self::get_fund_info($id);
			if(!self::check_perm_manage('fund',$_SESSION['user']) || $before['type'] == 'payment' || $before['type'] == 'payout' ){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission!!! to edit this fund');
				self::record('write','WARNING : Try to edit fund info but havent permission',"DATA :  in ID = $id");
				return json_encode($jTableResult);
			}
			$sql = "UPDATE ".self::$TABLE." SET dollar = :dollar, dinar = :dinar, detail = :detail WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':dollar',$dollar,PDO::PARAM_STR);
			$stmt->bindParam(':dinar',$dinar,PDO::PARAM_STR);
			$stmt->bindParam(':detail',$detail,PDO::PARAM_STR);
			$stmt->bindParam(':id',$id,PDO::PARAM_STR);
			$stmt->execute();

			$offset_dollar = $dollar - $before['dollar'];
			$offset_dinar = $dinar - $before['dinar'];
			self::update_box($before['id_user'],$id,$offset_dollar,$offset_dinar);
			
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','Edit fund info',"DATA : $dollar, $dinar, $detail,$id in ID = $id / OLD DATA : ".@$before['id_model'].', '.@$before['name']);
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function update]'.$e->getMessage().'<br>';
			die();
		}
	}

		public static function update2($data){
		try{
			// file_put_contents('a.txt', print_r($data,true));
			// dsh($data);
			$dollar = $data['dollar'];
			$dinar = $data['dinar'];
			$detail = $data['detail'];
			$id = $data['id'];

			$before = self::get_fund_info($id);
			// if(!self::check_perm_manage('fund',$_SESSION['user']) || $before['type'] == 'payment' || $before['type'] == 'payout' ){
			// 	$jTableResult['Result'] = "NO";
			// 	$jTableResult['Message'] = dic_return('You Havent Permission!!! to edit this fund');
			// 	self::record('write','WARNING : Try to edit fund info but havent permission',"DATA :  in ID = $id");
			// 	return json_encode($jTableResult);
			// }
			$sql = "UPDATE ".self::$TABLE." SET dollar = :dollar, dinar = :dinar, detail = :detail WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':dollar',$dollar,PDO::PARAM_STR);
			$stmt->bindParam(':dinar',$dinar,PDO::PARAM_STR);
			$stmt->bindParam(':detail',$detail,PDO::PARAM_STR);
			$stmt->bindParam(':id',$id,PDO::PARAM_STR);
			$stmt->execute();

			$offset_dollar = $dollar - $before['dollar'];
			$offset_dinar = $dinar - $before['dinar'];
			self::update_box($before['id_user'],$id,$offset_dollar,$offset_dinar);
			
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','Edit fund info',"DATA : $dollar, $dinar, $detail,$id in ID = $id / OLD DATA : ".@$before['id_model'].', '.@$before['name']);
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function update2]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function delete($id,$high_permition = null){
		try{
			$before = self::get_fund_info($id);

			if(setting::NOT_DELETED_DATA_FUND){
				return null;
			}

			if(!self::check_perm_manage('fund',$before)){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission!!! to delete fund');
				self::record('write','WARNING : Try to delete fund but havent permission',"DATA : ID = $id");
				return json_encode($jTableResult);
			}

			if($before['type'] == 'transfer from' && !$high_permition){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Are Reciever! Just sender can delete');
				self::record('write','WARNING : reciever to try a fund',"DATA : ID = $id");
				return json_encode($jTableResult);
			}

			if($before['type'] == 'transfer to'){
				self::delete($id+1,true);
			}

			$sql = "DELETE FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();

			// $offset_dollar = 0 - $before['dollar'];
			// $offset_dinar = 0 - $before['dinar'];
			// self::update_box($before['id_user'],$id,$offset_dollar,$offset_dinar);
			$sql = "UPDATE fund SET box_dinar = box_dinar - {$before['dinar']} WHERE id > $id";
			self::$PDO->query($sql);

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','Delete a fund',"DATA : ID = $id / OLD DATA : ".$before['dollar'].', '.$before['dinar']);
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function delete]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function get_fund_info($id){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function get_fund_info]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function last_position($id_user){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id_user = :id_user ORDER BY id DESC LIMIT 1";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id_user',$id_user,PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			// $row['box_dollar'] = dsh_money($row['box_dollar'],0,'$');
			// $row['box_dinar'] = dsh_money($row['box_dinar'],0,'IQD');

			return json_encode($row);
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function get_fund_info]'.$e->getMessage().'<br>';
			die();
		}
	}


	public static function money_transfer($data){
		try{
			// dsh($data);
			
			// $sql = "SELECT * FROM fund WHERE id = '{$data['trans_id']}'";
			// $stmt = self::$PDO->query($sql);
			// $row = $stmt->fetchObject();

//dsh($row);
			
			if(!isset($data['user_select']))
				return dic_return('Select User At First!');

			$data_last_position = self::last_position($_SESSION['user']['id']);
			$arr_last_postion = json_decode($data_last_position);
			// dsh($arr_last_postion);
// var_dump($data['dollar_destination'] > $arr_last_postion->box_dollar);
			if($data['dollar_destination'] > $arr_last_postion->box_dollar || $data['dinar_destination'] > $arr_last_postion->box_dinar)
				return dic_return('Not Enough In Box');


			$user_target_info = user::get_user_info($data['user_select']);
// dsh($user_target_info);

			$data_sender = array(
				'dollar' => 0 - $data['dollar_destination'],
				'dinar' => 0 - $data['dinar_destination'],
				'type' => 'transfer to',
				'detail' => "give to {$user_target_info['name']} , {$data['detail_destination']}",
				'id_user' => $_SESSION['user']['id'],
				'transfer_ok' => $data['user_select'],
				'id_payout' => $_SESSION['user']['id_location'],
				'id_payment' => $user_target_info['id_location']);
			fund::create($data_sender);	

			$data_reciever = array(
				'dollar' => $data['dollar_destination'],
				'dinar' => $data['dinar_destination'],
				'type' => 'transfer from',
				'detail' => "get from {$_SESSION['user']['name']} , {$data['detail_destination']}",
				'id_user' => $data['user_select'],
				'id_department' => $user_target_info['id_department'],
				'id_location' => $user_target_info['id_location'],
				'transfer_ok' => $_SESSION['user']['id'],
				'id_payout' => $_SESSION['user']['id_location'],
				'id_payment' => $user_target_info['id_location']);
			fund::create($data_reciever);	

				

			return dic_return('Transfer Successful');

			
			/*@$data['trans_id'];
			@$data['department_list'];
			@$data['location_list'];
			@$data['qty_destination'];
			@$data['state_destination'];
			@$data['rack_destination'];*/
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function money_transfer]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function idFund(){
		try{
			$sql = "SELECT id FROM ".self::$TABLE." ORDER BY id DESC LIMIT 1";
			$stmt = self::$PDO->query($sql);
			$row = $stmt->fetchObject();
			if($row)
				return $row->id;
			return 0;
		}
		catch(PDOException $e){
			echo 'Error: [Fund.class.php/function idFund]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function search_list($sorting,$startIndex,$pageSize,$search_str){
		try{
			$arr_table = array(
				'id'=>array('state'=>'self','field'=>'id'),
				// 'user'=>array('state'=>'foreign','table'=>'user','field'=>'name','source'=>'id_user'),
				// 'model'=>array('state'=>'foreign','table'=>'model','field'=>'name','source'=>'id_model'),
				// 'product'=>array('state'=>'foreign','table'=>'name_list','field'=>'name','source'=>'id_name_list'),
				// 'code'=>array('state'=>'foreign','table'=>'code','field'=>'code','source'=>'id_code'),
				// 'color'=>array('state'=>'foreign','table'=>'color','field'=>'color','source'=>'id_code'),
				// 'department'=>array('state'=>'foreign','table'=>'department','field'=>'name','source'=>'id_department'),
				// 'location'=>array('state'=>'foreign','table'=>'location','field'=>'name','source'=>'id_location'),
				// 'invoice'=>array('state'=>'foreign','table'=>'buy_facture','field'=>'invoice','source'=>'id_buy_facture'),
				//'sell_invoice'=>array('state'=>'foreign','table'=>'sell_facture','field'=>'invoice','source'=>'id_sell_facture'),
				'date'=>array('state'=>'self','field'=>'date'),
				'dollar'=>array('state'=>'self','field'=>'dollar'),
				'dinar'=>array('state'=>'self','field'=>'dinar'),
				'box_dollar'=>array('state'=>'self','field'=>'box_dollar'),
				'box_dinar'=>array('state'=>'self','field'=>'box_dinar'),
				'type'=>array('state'=>'self','field'=>'type'),
				'detail'=>array('state'=>'self','field'=>'detail')

				// 'id_category'=>array('state'=>'foreign','table'=>'category','field'=>'name','source'=>'id_category'),
				// 'category'=>array('state'=>'self','field'=>'id_category'),

			);
			
			// $other_table = "fund.*,model.id_company,model.id_category FROM fund LEFT JOIN model ON fund.id_model = model.id";

			self::record('read',"search fund's","SEARCH: $search_str");
			return self::search($sorting,$startIndex,$pageSize,$search_str,$arr_table,'fund');
		}
		catch(exception $e){
			echo 'Error: [fund.class.php/function search_list]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function financeDaily($date){
		try{
      /* dsh($date); */
			$where = self::check_permission_view(self::$TABLE);
      $sql = "SELECT e.id, e.id_patient, p.name, e.date_recieved, e.total_price, e.discount
        FROM laboratory.exam e
        inner join patient p on p.id = e.id_patient
        where date_recieved like '$date%'";

			
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);


			$count = count($rows);
      $balance = 0;
      $tDiscount = 0;
      $tCost = 0;

			for($i=0;$i<$count;$i++){
        $balance += $rows[$i]['total_price'] - $rows[$i]['discount'];
        $tDiscount += $rows[$i]['discount'];
        $tCost += $rows[$i]['total_price'];
        $rows[$i]['balance'] = dsh_money($balance);
        $rows[$i]['total_price'] = dsh_money($rows[$i]['total_price']);
        $rows[$i]['discount'] = dsh_money($rows[$i]['discount']);
			}

      $rows[$i]['name'] = 'Total';
      $rows[$i]['total_price'] = dsh_money($tCost);
      $rows[$i]['discount'] = dsh_money($tDiscount);
      $rows[$i]['balance'] = dsh_money($balance);


			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] = $count;
			$jTableResult['Records'] = $rows;
			self::record('read','View daily finance\'s');
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function lists]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function financeMonthly(){
		try{
      /* dsh($date); */
			$where = self::check_permission_view(self::$TABLE);
      $sql = "SELECT substr(date_recieved,1,7) as month, sum(e.total_price) as cost, sum(e.discount) as discount
        FROM laboratory.exam e
        group by substr(date_recieved,1,7)";
			
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);


			$count = count($rows);
      $balance = 0;
      $tDiscount = 0;
      $tCost = 0;

			for($i=0;$i<$count;$i++){
        $balance += $rows[$i]['cost'] - $rows[$i]['discount'];
        $tDiscount += $rows[$i]['discount'];
        $tCost += $rows[$i]['cost'];
        $rows[$i]['balance'] = dsh_money($balance);
        $rows[$i]['cost'] = dsh_money($rows[$i]['cost']);
        $rows[$i]['discount'] = dsh_money($rows[$i]['discount']);
			}

      $rows[$i]['month'] = 'Total';
      $rows[$i]['cost'] = dsh_money($tCost);
      $rows[$i]['discount'] = dsh_money($tDiscount);
      $rows[$i]['balance'] = dsh_money($balance);


			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] = $count;
			$jTableResult['Records'] = $rows;
			self::record('read','View daily finance\'s');
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [fund.class.php/function lists]'.$e->getMessage().'<br>';
			die();
		}
	}

}

// $data = array(
//     'dollar' => 500,
//     'dinar' => null,
//     'detail' => null,
// 	'id' => '41');
// // dsh(fund::update($data));
// fund::create($data);
// dsh(fund::pre_fund(1));

// dsh(fund::check_perm_manage2('fund',$_SESSION['user']));
// dsh(fund::location_report_pp('2014-04-14'));


?>
