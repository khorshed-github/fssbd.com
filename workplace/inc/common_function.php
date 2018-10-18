<?php 
function get_table_data_all($table_name){
	global $db;
	$table_name = sanetize($table_name);
	$sql = mysqli_query($db, "SELECT * FROM `".$table_name."` ORDER BY `id` DESC");
	return $sql;
}
function get_table_data_specific($table_name, $field, $data){
	global $db;
	$table_name = sanetize($table_name);
	$field = sanetize($field);
	$data = sanetize($data);
	$sql = mysqli_query($db, "SELECT * FROM `".$table_name."` WHERE `".$field."` = '".$data."'");
	return $sql;
}
function get_table_data_specific_inv($table_name, $field, $data){
	global $db;
	$table_name = sanetize($table_name);
	$field = sanetize($field);
	$data = sanetize($data);
	$sql = mysqli_query($db, "SELECT * FROM `".$table_name."` WHERE `".$field."` = '".$data."' ORDER BY `id` DESC");
	return $sql;
}
function get_table_data_single_row($table_name, $field, $data, $return){
	global $db;
	$table_name = sanetize($table_name);
	$field = sanetize($field);
	$data = sanetize($data);
	$return = sanetize($return);
	$sql = mysqli_query($db, "SELECT * FROM `".$table_name."` WHERE `".$field."` = '".$data."'");
	$data = mysqli_fetch_assoc($sql);
	return $data[$return];
}
function insert_table_data($table_name, $fields, $datas){
	global $db;
	$table_name = sanetize($table_name);
	//$fields = sanetize($fields);
	//$datas = sanetize($datas);
	$fields = implode($fields, '`,`');
	$datas = implode($datas, "','");
	$sql  = "INSERT INTO `".$table_name."` (`".$fields."`)VALUES('".$datas."')";
	$query = mysqli_query($db, $sql);
	if($query == true){
		return true;
	}else{
		return false;
	}
}
function update_table_data($table_name, $fieldsAndDatas, $unique_id, $data){
	global $db;
	$fieldsAndDatas = implode($fields, ',');
	
	$sql = mysqli_query($db, "UPDATE `".$table_name."` SET ".$fieldsAndDatas." WHERE `".$unique_id."` = '".$data."' ");
	if($sql == true){
		return true;
	}else{
		return false;
	}
}
function get_searched_items_from_table($table_name, $field, $search_word){
	global $db;
	$table_name = sanetize($table_name);
	$field = sanetize($field);
	$search_word = sanetize($search_word);
	$sql = mysqli_query($db, "SELECT * FROM `".$table_name."` WHERE `".$field."` LIKE '%".$search_word."%' ");
	return $sql;
}
function dates(){
	$date  = gmdate('Y-m-d',time()+(6*60*60));
	return $date;
}

function times(){
	$time  = gmdate('h-i-s',time()+(6*60*60));
	return $time;
}
function sanetize($data){
	global $db;
	$return = mysqli_real_escape_string($db,htmlentities(htmlspecialchars($data)));
	return $return;
}

?>