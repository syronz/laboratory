<?php
require_once 'database.class.php';

class permission extends database{
	private $table = 'permission';
	private static $TABLE = 'permission';

	public static function calculate_row(){
		try{
			$sql = "SELECT count(id) AS count FROM ".self::$TABLE;
			$result = self::$PDO->query($sql);
			$count = $result->fetchObject();
			return $count->count;
		}
		catch(PDOException $e){
			echo 'Error: [permission.class.php/function calculate_row]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function lists($sorting,$startIndex,$pageSize){
		try{
			$where = self::check_permission_view(self::$TABLE);
			self::hack_pageSize($startIndex,$pageSize);
			$sorting = self::hack_sorting($sorting);
			$sql = "SELECT * FROM ".self::$TABLE." $where ORDER BY $sorting LIMIT $startIndex, $pageSize;";
			$fp = fopen('a.txt', 'a+');
			fwrite($fp, $sql."\n");
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
			echo 'Error: [permission.class.php/function lists]'.$e->getMessage().'<br>';
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
			echo 'Error: [permission.class.php/function last_row_data]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function create($id_user,$name,$detail,$user,$location,$department,$permission,$user_activity,$all_user_activity,$employee,$certificate,$salary,$job_title,$category,$name_list,$stuff,$model,$company,$gate,$buy_facture,$sell_facture,$stuff_transfer,$set_detail,$waiting_list,$installment_list,$less_in_store_list,$regular_order,$special_order,$object_order,$customer,$payment,$fund,$payout_category,$payout,$money_transfer,$reports,$boss_reports,$dollar_prices){
		try{
			if(!self::check_perm_manage('permission')){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission To Create!!!');
				self::record('write','WARNING : Try write data to '.self::$TABLE.' but havent permission',"DATA : name = $name / detail = $detail");
				return json_encode($jTableResult);
			}

			$sql = "INSERT INTO ".self::$TABLE."(id_user,name,detail, user,location,department,permission,user_activity,all_user_activity,employee,certificate,salary,job_title,category,name_list,stuff,model,company,gate,buy_facture,sell_facture,stuff_transfer,set_detail,waiting_list,installment_list,less_in_store_list,regular_order,special_order,object_order,customer,payment,fund,payout_category,payout,money_transfer,reports,boss_reports,date,dollar_prices) VALUES(:id_user,:name,:detail,:user,:location,:department,:permission,:user_activity,:all_user_activity,:employee,:certificate,:salary,:job_title,:category,:name_list,:stuff,:model,:company,:gate,:buy_facture,:sell_facture,:stuff_transfer,:set_detail,:waiting_list,:installment_list,:less_in_store_list,:regular_order,:special_order,:object_order,:customer,:payment,:fund,:payout_category,:payout,:money_transfer,:reports,:boss_reports,NOW(),:dollar_prices);";

  			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id_user',$id_user,PDO::PARAM_STR);
			$stmt->bindParam(':name',$name,PDO::PARAM_STR);
			$stmt->bindParam(':detail',$detail,PDO::PARAM_STR);
			$stmt->bindParam(':user',$user,PDO::PARAM_STR);
			$stmt->bindParam(':location',$location,PDO::PARAM_STR);
			$stmt->bindParam(':department',$department,PDO::PARAM_STR);
			$stmt->bindParam(':permission',$permission,PDO::PARAM_STR);
			$stmt->bindParam(':user_activity',$user_activity,PDO::PARAM_STR);
			$stmt->bindParam(':all_user_activity',$all_user_activity,PDO::PARAM_STR);
			$stmt->bindParam(':employee',$employee,PDO::PARAM_STR);
			$stmt->bindParam(':certificate',$certificate,PDO::PARAM_STR);
			$stmt->bindParam(':salary',$salary,PDO::PARAM_STR);
			$stmt->bindParam(':job_title',$job_title,PDO::PARAM_STR);
			$stmt->bindParam(':category',$category,PDO::PARAM_STR);
			$stmt->bindParam(':name_list',$name_list,PDO::PARAM_STR);
			$stmt->bindParam(':stuff',$stuff,PDO::PARAM_STR);
			$stmt->bindParam(':model',$model,PDO::PARAM_STR);
			$stmt->bindParam(':company',$company,PDO::PARAM_STR);
			$stmt->bindParam(':gate',$gate,PDO::PARAM_STR);
			$stmt->bindParam(':buy_facture',$buy_facture,PDO::PARAM_STR);
			$stmt->bindParam(':sell_facture',$sell_facture,PDO::PARAM_STR);
			$stmt->bindParam(':stuff_transfer',$stuff_transfer,PDO::PARAM_STR);
			$stmt->bindParam(':set_detail',$set_detail,PDO::PARAM_STR);
			$stmt->bindParam(':waiting_list',$waiting_list,PDO::PARAM_STR);
			$stmt->bindParam(':installment_list',$installment_list,PDO::PARAM_STR);
			$stmt->bindParam(':less_in_store_list',$less_in_store_list,PDO::PARAM_STR);
			$stmt->bindParam(':regular_order',$regular_order,PDO::PARAM_STR);
			$stmt->bindParam(':special_order',$special_order,PDO::PARAM_STR);
			$stmt->bindParam(':object_order',$object_order,PDO::PARAM_STR);
			$stmt->bindParam(':customer',$customer,PDO::PARAM_STR);
			$stmt->bindParam(':payment',$payment,PDO::PARAM_STR);
			$stmt->bindParam(':fund',$fund,PDO::PARAM_STR);
			$stmt->bindParam(':payout_category',$payout_category,PDO::PARAM_STR);
			$stmt->bindParam(':payout',$payout,PDO::PARAM_STR);
			$stmt->bindParam(':money_transfer',$money_transfer,PDO::PARAM_STR);
			$stmt->bindParam(':reports',$reports,PDO::PARAM_STR);
			$stmt->bindParam(':boss_reports',$boss_reports,PDO::PARAM_STR);
			$stmt->bindParam(':dollar_prices',$dollar_prices,PDO::PARAM_STR);
			$stmt->execute();

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Record'] = self::last_row_data();
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [permission.class.php/function create]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function update($id_user,$name,$detail,$id,$user,$location,$department,$permission,$user_activity,$all_user_activity,$employee,$certificate,$salary,$job_title,$category,$name_list,$stuff,$model,$company,$gate,$buy_facture,$sell_facture,$stuff_transfer,$set_detail,$waiting_list,$installment_list,$less_in_store_list,$regular_order,$special_order,$object_order,$customer,$payment,$fund,$payout_category,$payout,$money_transfer,$reports,$boss_reports,$dollar_prices){
		try{
			if(!self::check_perm_manage('permission')){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission To Edit!!!');
				self::record('write','WARNING : Try edit data in '.self::$TABLE.' but havent permission',"DATA : name = $name / detail = $detail / id = $id");
				return json_encode($jTableResult);
			}
			$sql = "UPDATE ".self::$TABLE." SET id_user = :id_user, name = :name, detail = :detail,  user = :user, location = :location, department = :department, permission = :permission, user_activity = :user_activity, all_user_activity = :all_user_activity, employee = :employee, certificate = :certificate, salary = :salary, job_title = :job_title, category = :category, name_list = :name_list, stuff = :stuff, model = :model, company = :company, gate = :gate, buy_facture = :buy_facture, sell_facture = :sell_facture, stuff_transfer = :stuff_transfer, set_detail = :set_detail, waiting_list = :waiting_list, installment_list = :installment_list, less_in_store_list = :less_in_store_list, regular_order = :regular_order, special_order = :special_order, object_order = :object_order, customer = :customer, payment = :payment, fund = :fund, payout_category = :payout_category, payout = :payout, money_transfer = :money_transfer, reports = :reports, boss_reports = :boss_reports, date = NOW(), dollar_prices = :dollar_prices WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id_user',$id_user,PDO::PARAM_STR);
			$stmt->bindParam(':name',$name,PDO::PARAM_STR);
			$stmt->bindParam(':detail',$detail,PDO::PARAM_STR);
			$stmt->bindParam(':id',$id,PDO::PARAM_STR);

			$stmt->bindParam(':user',$user,PDO::PARAM_STR);
			$stmt->bindParam(':location',$location,PDO::PARAM_STR);
			$stmt->bindParam(':department',$department,PDO::PARAM_STR);
			$stmt->bindParam(':permission',$permission,PDO::PARAM_STR);
			$stmt->bindParam(':user_activity',$user_activity,PDO::PARAM_STR);
			$stmt->bindParam(':all_user_activity',$all_user_activity,PDO::PARAM_STR);
			$stmt->bindParam(':employee',$employee,PDO::PARAM_STR);
			$stmt->bindParam(':certificate',$certificate,PDO::PARAM_STR);
			$stmt->bindParam(':salary',$salary,PDO::PARAM_STR);
			$stmt->bindParam(':job_title',$job_title,PDO::PARAM_STR);
			$stmt->bindParam(':category',$category,PDO::PARAM_STR);
			$stmt->bindParam(':name_list',$name_list,PDO::PARAM_STR);
			$stmt->bindParam(':stuff',$stuff,PDO::PARAM_STR);
			$stmt->bindParam(':model',$model,PDO::PARAM_STR);
			$stmt->bindParam(':company',$company,PDO::PARAM_STR);
			$stmt->bindParam(':gate',$gate,PDO::PARAM_STR);
			$stmt->bindParam(':buy_facture',$buy_facture,PDO::PARAM_STR);
			$stmt->bindParam(':sell_facture',$sell_facture,PDO::PARAM_STR);
			$stmt->bindParam(':stuff_transfer',$stuff_transfer,PDO::PARAM_STR);
			$stmt->bindParam(':set_detail',$set_detail,PDO::PARAM_STR);
			$stmt->bindParam(':waiting_list',$waiting_list,PDO::PARAM_STR);
			$stmt->bindParam(':installment_list',$installment_list,PDO::PARAM_STR);
			$stmt->bindParam(':less_in_store_list',$less_in_store_list,PDO::PARAM_STR);
			$stmt->bindParam(':regular_order',$regular_order,PDO::PARAM_STR);
			$stmt->bindParam(':special_order',$special_order,PDO::PARAM_STR);
			$stmt->bindParam(':object_order',$object_order,PDO::PARAM_STR);
			$stmt->bindParam(':customer',$customer,PDO::PARAM_STR);
			$stmt->bindParam(':payment',$payment,PDO::PARAM_STR);
			$stmt->bindParam(':fund',$fund,PDO::PARAM_STR);
			$stmt->bindParam(':payout_category',$payout_category,PDO::PARAM_STR);
			$stmt->bindParam(':payout',$payout,PDO::PARAM_STR);
			$stmt->bindParam(':money_transfer',$money_transfer,PDO::PARAM_STR);
			$stmt->bindParam(':reports',$reports,PDO::PARAM_STR);
			$stmt->bindParam(':boss_reports',$boss_reports,PDO::PARAM_STR);
			$stmt->bindParam(':dollar_prices',$dollar_prices,PDO::PARAM_STR);

			$stmt->execute();
			
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','Edit data in '.self::$TABLE,"DATA : name = $name / detail = $detail / id = $id ");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [permission.class.php/function update]'.$e->getMessage().'<br>';
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
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [permission.class.php/function delete]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function json_list(){
		try{
			$sql = "SELECT id AS Value,name AS DisplayText FROM ".self::$TABLE;
			$result = self::$PDO->query($sql);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Options'] = $rows;
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [permission.class.php/function json_list]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function return_one_permission($id){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}
		catch(PDOException $e){
			echo 'Error: [user.class.php/function delete]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function search_list($sorting,$startIndex,$pageSize,$search_str){
		try{
			$arr_table = array(
				'id'=>array('state'=>'self','field'=>'id'),
				'permission'=>array('state'=>'foreign','table'=>'user','field'=>'name','source'=>'id_user'),
				'permission'=>array('state'=>'self','field'=>'name'),
				'date'=>array('state'=>'self','field'=>'date'),
				'user'=>array('state'=>'self','field'=>'id_user'),
				'detail'=>array('state'=>'self','field'=>'detail')
			);
			
			self::record('read',"search permission's","SEARCH: $search_str");
			return self::search($sorting,$startIndex,$pageSize,$search_str,$arr_table,'permission');
		}
		catch(exception $e){
			echo 'Error: [permission.class.php/function search_list]'.$e->getMessage().'<br>';
			die();
		}
	}
}

//$permission = new permission();

//var_dump($permission->show_permissions('id',0,5));

//dsh(permission::update(1,'diako',@$n,'AA','AA','AA','AA','AA',null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null));
		

?>