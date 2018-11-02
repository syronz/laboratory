<?php
require_once 'database.class.php';
require_once 'permission.class.php';

class category extends database{
	private $table = 'category';
	private static $TABLE = 'category';

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
			$jTableResult['TotalRecordCount'] = self::calculate_rows(self::$TABLE);
			$jTableResult['Records'] = $rows;
			self::record('read','View category\'s');
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [category.class.php/function lists]'.$e->getMessage().'<br>';
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
			echo 'Error: [category.class.php/function last_row_data]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function create($name,$less,$detail){
		try{
			if(!self::check_perm_manage('category')){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission!!! to add category');
				self::record('write','WARNING : Try Add new category but havent permission',"DATA : $name, $less, $detail");
				return json_encode($jTableResult);
			}
			$sql = "INSERT INTO ".self::$TABLE."(name,less,detail) VALUES(:name,:less,:detail);";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':name',$name,PDO::PARAM_STR);
			$stmt->bindParam(':less',$less,PDO::PARAM_STR);
			$stmt->bindParam(':detail',$detail,PDO::PARAM_STR);
			$stmt->execute();

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Record'] = self::last_row_data();
			self::record('write','Add new category',"DATA : $name, $name, $less, $detail");
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [category.class.php/function create]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function update($name,$less,$detail,$id){
		try{
			$before = self::get_category_info($id);
			if(!self::check_perm_manage('category')){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission!!! to edit category');
				self::record('write','WARNING : Try to edit category info but havent permission',"DATA : $name, $less, $detail in ID = $id");
				return json_encode($jTableResult);
			}
			$sql = "UPDATE ".self::$TABLE." SET name = :name, less = :less, detail = :detail WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':name',$name,PDO::PARAM_STR);
			$stmt->bindParam(':less',$less,PDO::PARAM_STR);
			$stmt->bindParam(':detail',$detail,PDO::PARAM_STR);
			$stmt->bindParam(':id',$id,PDO::PARAM_STR);
			$stmt->execute();
			
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','Edit category info',"DATA : $name, $less, $detail in ID = $id / OLD DATA : ".$before['name'].', '.$before['less'].', '.$before['detail']);
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [category.class.php/function update]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function delete($id){
		try{
			$before = self::get_category_info($id);
			if(!self::check_perm_manage('category',@$pre)){
				$jTableResult['Result'] = "NO";
				$jTableResult['Message'] = dic_return('You Havent Permission!!! to delete category');
				self::record('write','WARNING : Try to delete category but havent permission',"DATA : ID = $id");
				return json_encode($jTableResult);
			}
			$sql = "DELETE FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();

			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			self::record('write','Delete a category',"DATA : ID = $id / OLD DATA : ".$before['name'].', '.$before['less'].', '.$before['detail']);
			return json_encode($jTableResult);
		}
		catch(PDOException $e){
			echo 'Error: [category.class.php/function delete]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function get_category_info($id){
		try{
			$sql = "SELECT * FROM ".self::$TABLE." WHERE id = :id";
			$stmt = self::$PDO->prepare($sql);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}
		catch(PDOException $e){
			echo 'Error: [category.class.php/function get_category_info]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function json_list($part){
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
			echo 'Error: [department.class.php/function json_list]'.$e->getMessage().'<br>';
			die();
		}
	}

	public static function search_list($sorting,$startIndex,$pageSize,$search_str){
		try{
			$arr_table = array(
				'id'=>array('state'=>'self','field'=>'id'),
				'category'=>array('state'=>'self','field'=>'name'),
				'less'=>array('state'=>'self','field'=>'less'),
				'detail'=>array('state'=>'self','field'=>'detail')
			);
			
			self::record('read',"search category's","SEARCH: $search_str");
			return self::search($sorting,$startIndex,$pageSize,$search_str,$arr_table,'category');
		}
		catch(exception $e){
			echo 'Error: [category.class.php/function search_list]'.$e->getMessage().'<br>';
			die();
		}
	}
}

?>