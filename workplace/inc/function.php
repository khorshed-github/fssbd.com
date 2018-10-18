<?php
	function checknumber($data){
		if(strlen(strval($data)) > 11){
			return false;
		}else if(strlen(strval($data)) < 11){
			return false;
		}else if(strlen(strval($data)) == 11){
			if(substr(strval($data), 0, 3) == '018'){
				return true;
			}else if(substr(strval($data), 0, 3) == '017'){
				return true;
			}else if(substr(strval($data), 0, 3) == '011'){
				return false;
			}else if(substr(strval($data), 0, 3) == '016'){
				return true;
			}else if(substr(strval($data), 0, 3) == '015'){
				return true;
			}else if(substr(strval($data), 0, 3) == '019'){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function sendsms($number, $message){
		/*
		 * Created by PhpStorm.
		 * User: ahsuoy
		 * Date: 4/20/2017
		 * Time: 4:40 PM
		 */
		
		// base64 encoded authorization key (username:password)
		$authKey = base64_encode("Self-Employment:Mymessage.56");
		
		// request url
		$url = "http://107.20.199.106/restapi/sms/1/text/single";
		
		// post data
		$data = [
			"from" => 'Mobisheba',
			"to"   => ["88".$number],
			"text" => $message,
		];
		
		//print_r($data);
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_POST, 1);
		
		// header data
		$headers = [];
		$headers[] = "Content-Type: application/json";
		$headers[] = "Accept: application/json";
		$headers[] = "Authorization: Basic " . $authKey;
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		
		curl_close ($ch);
		
		// convert the response into php array from json
		$result = json_decode($result, true);
		
	   //print_r($result);
	   
		 $status = $result['messages']['0']['status']['groupId'];
	
	
	}
	function loggedin(){
		if(isset($_SESSION['flc_logged'])){
			return true;
		}else{
			return false;
		}
	}
	function create_tasks_status($uid){
		global $db;
		$task = 1;
		$step = 0;
		$cont = 0;
		$date  = gmdate('Y-m-d',time()+(6*60*60));
		$sql = mysqli_query($db, "SELECT * FROM `dailytask` WHERE `uid` = '$uid' AND `date` = '$date'");
		
		if($sql->num_rows == 0){
			while($cont == 0){
				if($task > 10){
					$cont = 1;
				}else{
					$sql = mysqli_query($db, "INSERT INTO `dailytask` 
					(`uid`,`task`,`status`,`date`)
					VALUES 
					('$uid','$task','0','".dates()."')
					");
					/*$cont2 = 0;
					$step = 1;
					while($cont2 == 0){
						if($step == 11){
							$cont2 = 1;
						}else{
							$sql = mysqli_query($db, "INSERT INTO `steps` (`uid`,`taskid`,`step`,`date`)
							VALUES 
							('$uid','$task','$step','".dates()."')");
							if($sql == false){
							    
							}
							$step++;
							
						}
					}*/
					$task++;
					
				}
			}
			
		}
	}
	function create_jobs_status(){
		global $db;
		$task = 1;
		$step = 0;
		$cont = 0;
		$date  = gmdate('Y-m-d',time()+(6*60*60));
		$sql = mysqli_query($db, "SELECT * FROM `jobs2` WHERE `date` = '$date'");
		
		if($sql->num_rows == 0){
			while($cont == 0){
				if($task > 10){
					$cont = 1;
				}else{
					
					$cont2 = 0;
					$step = 1;
					while($cont2 == 0){
						if($step > 10){
							$cont2 = 1;
						}else{
							$sql = mysqli_query($db, "INSERT INTO `jobs2` 
							(`taskid`,`step`,`status`,`date`)
							VALUES 
							('$task','$step','0','".dates()."')
							");
							$step++;
						}
					}
					$task++;
					
				}
			}
			
		}
	}
	function get_task_id($uid){
		global $db;
		$date = dates();
		$sql = mysqli_query($db, "SELECT * FROM `dailytask` WHERE `uid` = '$uid' AND `date` = '$date' AND `status` = '0' LIMIT 1");
		$data = mysqli_fetch_assoc($sql);
		return $data['id'];
	}
	function get_step_id($uid,$task_number){
		global $db;
		
		$date = dates();
		
			$sql = mysqli_query($db, "SELECT * FROM `steps` WHERE `uid` = '$uid' AND `taskid` = '$task_number' AND `date` = '$date' AND `status` = '0' LIMIT 1");
			$data = mysqli_fetch_assoc($sql);
			return $data['id'];
		
	}
	function get_earning_rate($uid){
		global $db;
		$points = get_table_data_single_row('flc_users','id',$uid,'points');
		$sql = get_table_data_all('direct_income');
		foreach($sql as $data){
			if($points >= $data['min'] && $points <= $data['max']){
				$price = $data['price'];
			}
		}
		return $price;
	}
	function accounts_update($id, $amount, $details, $old_bal, $new_bal,$type){
		global $db;
		$date = date('Y-m-d', time());
		$time = date('H-i-s', time());
		if($type == 'dr'){
			$sql = mysqli_query($db, "INSERT INTO `accounts` 
		(`uid`,`details`,`dr_amount`,`cr_amount`,`old_bal`,`new_bal`,`status`,`date`,`time`)
		VALUES
		('$id','$details','$amount','0.00','$old_bal','$new_bal','0','".dates()."','".times()."')
		");
		}else if($type == 'cr'){
			$sql = mysqli_query($db, "INSERT INTO `accounts` 
		(`uid`,`details`,`dr_amount`,`cr_amount`,`old_bal`,`new_bal`,`status`,`date`,`time`)
		VALUES
		('$id','$details','0.00','$amount','$old_bal','$new_bal','0','".dates()."','".times()."')
		");
		}
	}
	function send_uppler_level_commission($uid, $amount,$type){
		global $db;
		if($type == 'work'){
			$levels = get_uppler_levels($uid, get_table_data_all('work_referral')->num_rows);
		}else if($type == 'join'){
			$levels = get_uppler_levels($uid, get_table_data_all('joining_referal')->num_rows);
		}else if($type == 'purchase'){
			$levels = get_uppler_levels($uid, get_table_data_all('purchase_level')->num_rows);
		}
		foreach($levels as $key => $upids){
			$level = $key + 1;
			if($upids !== 0){
				$percent = get_table_data_single_row('work_referral','level',$level,'percent');
				$comm = ($amount / 100) * $percent;
				$old_balance = get_table_data_single_row('flc_users','id',$upids,'p_balance');
				$new_balance = $old_balance + $comm;
				$update = mysqli_query($db, "UPDATE `flc_users` SET `p_balance` = '$new_balance' WHERE `id` = '$upids'");
				accounts_update($upids,$comm,'work referral income from level '.$level.' User '.get_table_data_single_row('flc_users','id',$uid,'username').' On Primary Balance',$old_balance,$new_balance,'cr');
				$type = $level + 1;
				if($type > 7){
					income_entry($upids,$uid,$comm,7,$type);
				}else{
					income_entry($upids,$uid,$comm,$type,$type);
				}
			}
		}
	}
	function get_uppler_levels($uid, $level){
		global $db;
		$cont = 0;
		$count = 0;
		$array = array();
		$ref = $uid;
		while($cont == 0){
			if($count == $level){
				$cont = 1;
			}else{
				$refid = get_table_data_single_row('flc_users','id',$ref,'ref');
				if(!empty($refid)){
					$array[] = $refid;
				}else{
					$array[] = 0;
				}
				$ref = $refid;
				$count++;
			}
		}
		return $array;
	}
	function income_entry($uid,$sid,$amount,$type,$extra_level){
		global $db;
		
		$sql = mysqli_query($db, "INSERT INTO `incomes`
			(`uid`,`sid`,`amount`,`type`,`date`,`time`,`status`,`extra_level`)
			VALUES
			('$uid','$sid','$amount','$type','".dates()."','".times()."','0',$extra_level)
		");
		$find = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '$type' AND `date` = '".dates()."' LIMIT 1");
		if($find->num_rows == 0){
		    $sql = mysqli_query($db, "INSERT INTO `income`
			(`uid`,`sid`,`amount`,`type`,`date`,`time`,`status`,`extra_level`)
			VALUES
			('$uid','$sid','$amount','$type','".dates()."','".times()."','0',$extra_level)
		");
		}else{
		    $data = mysqli_fetch_assoc($find);
		    $id = $data['id'];
		    $old_amount = $data['amount'];
		    $new_amount = $old_amount + $amount;
		    $update = mysqli_query($db, "UPDATE `income` SET `amount` = '$new_amount' WHERE `id` = '$id'");
		}
		/*if($type !== '3'){
		$tds_percent = get_table_data_single_row('getamounts','name','tds_amount','amount');
		$tds_amount = ($amount / 100) * $tds_percent;
		$old_balance = get_table_data_single_row('userlg','id',$uid,'mbalance');
		$new_balance = $old_balance - $tds_amount;
		$sql2 = mysqli_query($db, "UPDATE `userlg` SET `mbalance` = '$new_balance' WHERE `id` = '$uid'");
		accounts_update($uid, $tds_amount, 'TDS Deducted','cut','bonus','0');
		$old_tds_amount = get_table_data_single_row('tds_earnings','id','1','amount');
		$new_tds_amount = $old_tds_amount + $tds_amount;
		$update_tds = mysqli_query($db, "UPDATE `tds_earnings` SET `amount` = '$new_tds_amount' WHERE `id` = '1'");
		
		}*/
	}
	function get_designation($uid){
		if(get_table_data_single_row('flc_users','id',$uid,'type') == '0'){
			echo 'General Employee';
		}else if(get_table_data_single_row('flc_users','id',$uid,'type') == '1'){
			echo 'Besic Employee';
		}else if(get_table_data_single_row('flc_users','id',$uid,'type') == '2'){
			echo 'Advanced Employee';
		}else if(get_table_data_single_row('flc_users','id',$uid,'type') == '3'){
			echo 'Premium Employee';
		}else if(get_table_data_single_row('flc_users','id',$uid,'type') == '4'){
			echo 'Ambassadors';
		}else if(get_table_data_single_row('flc_users','id',$uid,'type') == '5'){
			echo 'Brand Ambassadors';
		}
	}
	function get_add_code(){
		global $db;
		$sql = mysqli_query($db, "SELECT * FROM `adds` ORDER BY RAND() LIMIT 1");
		$data = mysqli_fetch_assoc($sql);
		return $data['id'];
	}
	function get_lever_members($level,$uid){
		global $db;
		$level_1 = array();
		$sql = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `ref` = '$uid'");
		//$sql = get_table_data_specific('flc_users','ref',$uid); 
		foreach($sql as $id){
			$level_1[] = $id['id'];
		}
		$level_2 = array();
		foreach($level_1 as $id1){
			$sql2 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `ref` = '$id1'");
			//$sql2 = get_table_data_specific('flc_users','ref',$id1);
			foreach($sql2 as $ids2){
				$level_2[] = $ids2['id'];
			}
		}
		$level_3 = array();
		foreach($level_2 as $id2){
			$sql3 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `ref` = '$id2'");
			//$sql3 = get_table_data_specific('flc_users','ref',$id2);
			foreach($sql3 as $ids3){
				$level_3[] = $ids3['id'];
			}
		}
		$level_4 = array();
		foreach($level_3 as $id3){
			$sql4 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `ref` = '$id3'");
			//$sql4 = get_table_data_specific('flc_users','ref',$id3);
			foreach($sql4 as $ids4){
				$level_4[] = $ids4['id'];
			}
		}
		$level_5 = array();
		foreach($level_4 as $id4){
			$sql5 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `ref` = '$id4'");
			//$sql5 = get_table_data_specific('flc_users','ref',$id4);
			foreach($sql5 as $ids5){
				$level_5[] = $ids5['id'];
			}
		}
		$level_6 = array();
		foreach($level_5 as $id5){
			$sql6 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `ref` = '$id5'");
			//$sql6 = get_table_data_specific('flc_users','ref',$id5);
			foreach($sql6 as $ids6){
				$level_6[] = $ids6['id'];
			}
		}
		
		$array[] = $level_1; 
		$array[] = $level_2; 
		$array[] = $level_3; 
		$array[] = $level_4; 
		$array[] = $level_5; 
		$array[] = $level_6; 
		return $array[$level];
	}
	
	function get_lever_members_act($level,$uid){
		global $db;
		$level_1 = array();
		$sql = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '1' AND `ref` = '$uid'");
		//$sql = get_table_data_specific('flc_users','ref',$uid); 
		foreach($sql as $id){
			$level_1[] = $id['id'];
		}
		$level_2 = array();
		foreach($level_1 as $id1){
			$sql2 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '1' AND `ref` = '$id1'");
			//$sql2 = get_table_data_specific('flc_users','ref',$id1);
			foreach($sql2 as $ids2){
				$level_2[] = $ids2['id'];
			}
		}
		$level_3 = array();
		foreach($level_2 as $id2){
			$sql3 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '1' AND `ref` = '$id2'");
			//$sql3 = get_table_data_specific('flc_users','ref',$id2);
			foreach($sql3 as $ids3){
				$level_3[] = $ids3['id'];
			}
		}
		$level_4 = array();
		foreach($level_3 as $id3){
			$sql4 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '1' AND `ref` = '$id3'");
			//$sql4 = get_table_data_specific('flc_users','ref',$id3);
			foreach($sql4 as $ids4){
				$level_4[] = $ids4['id'];
			}
		}
		$level_5 = array();
		foreach($level_4 as $id4){
			$sql5 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '1' AND `ref` = '$id4'");
			//$sql5 = get_table_data_specific('flc_users','ref',$id4);
			foreach($sql5 as $ids5){
				$level_5[] = $ids5['id'];
			}
		}
		$level_6 = array();
		foreach($level_5 as $id5){
			$sql6 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '1' AND `ref` = '$id5'");
			//$sql6 = get_table_data_specific('flc_users','ref',$id5);
			foreach($sql6 as $ids6){
				$level_6[] = $ids6['id'];
			}
		}
		
		$level_7 = array();
		foreach($level_6 as $id6){
			$sql7 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '1' AND `ref` = '$id6'");
			//$sql6 = get_table_data_specific('flc_users','ref',$id5);
			foreach($sql7 as $ids7){
				$level_7[] = $ids7['id'];
			}
		}
		
		$level_8 = array();
		foreach($level_7 as $id7){
			$sql8 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '1' AND `ref` = '$id7'");
			//$sql6 = get_table_data_specific('flc_users','ref',$id5);
			foreach($sql8 as $ids8){
				$level_8[] = $ids8['id'];
			}
		}
			$level_9 = array();
		foreach($level_8 as $id8){
			$sql9 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '1' AND `ref` = '$id8'");
			//$sql6 = get_table_data_specific('flc_users','ref',$id5);
			foreach($sql9 as $ids9){
				$level_9[] = $ids9['id'];
			}
		}
		$level_10 = array();
		foreach($level_9 as $id9){
			$sql10 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '1' AND `ref` = '$id9'");
			//$sql6 = get_table_data_specific('flc_users','ref',$id5);
			foreach($sql10 as $ids10){
				$level_10[] = $ids10['id'];
			}
		}
		
	
		
		$array[] = $level_1; 
		$array[] = $level_2; 
		$array[] = $level_3; 
		$array[] = $level_4; 
		$array[] = $level_5; 
		$array[] = $level_6;  
		$array[] = $level_7;  
		$array[] = $level_8;  
		$array[] = $level_9;  
		$array[] = $level_10; 
		return $array[$level];
	}
	
	function get_lever_members_inact($level,$uid){
		global $db;
		$level_1 = array();
		$sql = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '0' AND `ref` = '$uid'");
		//$sql = get_table_data_specific('flc_users','ref',$uid); 
		foreach($sql as $id){
			$level_1[] = $id['id'];
		}
		$level_2 = array();
		foreach($level_1 as $id1){
			$sql2 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '0' AND `ref` = '$id1'");
			//$sql2 = get_table_data_specific('flc_users','ref',$id1);
			foreach($sql2 as $ids2){
				$level_2[] = $ids2['id'];
			}
		}
		$level_3 = array();
		foreach($level_2 as $id2){
			$sql3 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '0' AND `ref` = '$id2'");
			//$sql3 = get_table_data_specific('flc_users','ref',$id2);
			foreach($sql3 as $ids3){
				$level_3[] = $ids3['id'];
			}
		}
		$level_4 = array();
		foreach($level_3 as $id3){
			$sql4 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '0' AND `ref` = '$id3'");
			//$sql4 = get_table_data_specific('flc_users','ref',$id3);
			foreach($sql4 as $ids4){
				$level_4[] = $ids4['id'];
			}
		}
		$level_5 = array();
		foreach($level_4 as $id4){
			$sql5 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '0' AND `ref` = '$id4'");
			//$sql5 = get_table_data_specific('flc_users','ref',$id4);
			foreach($sql5 as $ids5){
				$level_5[] = $ids5['id'];
			}
		}
		$level_6 = array();
		foreach($level_5 as $id5){
			$sql6 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `status` = '0' AND `ref` = '$id5'");
			//$sql6 = get_table_data_specific('flc_users','ref',$id5);
			foreach($sql6 as $ids6){
				$level_6[] = $ids6['id'];
			}
		}
		
		$array[] = $level_1; 
		$array[] = $level_2; 
		$array[] = $level_3; 
		$array[] = $level_4; 
		$array[] = $level_5; 
		$array[] = $level_6; 
		return $array[$level];
	}
	function get_affiliates($uid){
		global $db;
		$ids = get_table_data_specific('flc_users','ref',$uid);
		$array = array();
		foreach($ids as $id){
			$array[] = $id['id'];
		}
		return $array;
	}
	function get_income($type){
		global $uid;
		global $db;
		if($type  == 'today'){
			$sql = mysqli_query($db, "SELECT `amount` FROM `income` WHERE `uid` = '$uid' AND  `date` = '".dates()."'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['amount'] * 1);
			}
			return $total;
		}else if($type == 'week'){
			$back_span = time() - (60*60*24*7);
			$back_date = date('Y-m-d',$back_span);
			$curr_date = date('Y-m-d',time());
			$sql = mysqli_query($db, "SELECT `amount` FROM `income` WHERE `uid` = '$uid' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['amount'] * 1);
			}
			return $total;
		}else if($type == 'last_week'){
			$back_span = time() - (60*60*24*14);
			$back_span2 = time() - (60*60*24*7);
			$back_date = date('Y-m-d',$back_span);
			$curr_date = date('Y-m-d',$back_span2);
			$sql = mysqli_query($db, "SELECT `amount` FROM `income` WHERE `uid` = '$uid' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['amount'] * 1);
			}
			return $total;
		}else if($type == 'month'){
			$back_span = time() - (60*60*24*30);
			$back_date = date('Y-m-d',$back_span);
			$curr_date = date('Y-m-d',time());
			$sql = mysqli_query($db, "SELECT `amount` FROM `income` WHERE `uid` = '$uid' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['amount'] * 1);
			}
			return $total;
		}else if($type == 'last_month'){
			$back_span = time() - (60*60*24*60);
			$back_span2 = time() - (60*60*24*30);
			$back_date = date('Y-m-d',$back_span);
			$curr_date = date('Y-m-d',$back_span2);
			$sql = mysqli_query($db, "SELECT `amount` FROM `income` WHERE `uid` = '$uid' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['amount'] * 1);
			}
			return $total;
		}else if($type == 'all'){
			$sql = mysqli_query($db, "SELECT `amount` FROM `income` WHERE `uid` = '$uid'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['amount'] * 1);
			}
			return $total;
		}
	}
	function get_withdraw($type){
		global $uid;
		global $db;
		if($type  == 'today'){
			$sql = mysqli_query($db, "SELECT `amount` FROM `withdraw` WHERE `status` = '1' AND `uid` = '$uid' AND  `date` = '".dates()."'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['amount'] * 1);
			}
			return $total;
		}else if($type == 'week'){
			$back_span = time() - (60*60*24*7);
			$back_date = date('Y-m-d',$back_span);
			$curr_date = date('Y-m-d',time());
			$sql = mysqli_query($db, "SELECT `amount` FROM `withdraw` WHERE `status` = '1' AND  `uid` = '$uid' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['amount'] * 1);
			}
			return $total;
		}else if($type == 'last_week'){
			$back_span = time() - (60*60*24*14);
			$back_span2 = time() - (60*60*24*7);
			$back_date = date('Y-m-d',$back_span);
			$curr_date = date('Y-m-d',$back_span2);
			$sql = mysqli_query($db, "SELECT `amount` FROM `withdraw` WHERE `status` = '1' AND  `uid` = '$uid' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['amount'] * 1);
			}
			return $total;
		}else if($type == 'month'){
			$back_span = time() - (60*60*24*30);
			$back_date = date('Y-m-d',$back_span);
			$curr_date = date('Y-m-d',time());
			$sql = mysqli_query($db, "SELECT `amount` FROM `withdraw` WHERE `status` = '1' AND  `uid` = '$uid' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['amount'] * 1);
			}
			return $total;
		}else if($type == 'last_month'){
			$back_span = time() - (60*60*24*60);
			$back_span2 = time() - (60*60*24*30);
			$back_date = date('Y-m-d',$back_span);
			$curr_date = date('Y-m-d',$back_span2);
			$sql = mysqli_query($db, "SELECT `amount` FROM `withdraw` WHERE `status` = '1' AND  `uid` = '$uid' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['amount'] * 1);
			}
			return $total;
		}else if($type == 'all'){
			$sql = mysqli_query($db, "SELECT `amount` FROM `withdraw` WHERE `status` = '1' AND  `uid` = '$uid'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['amount'] * 1);
			}
			return $total;
		}
	}
	function get_income_report($way, $type){
		global $uid;
		global $db;
		if($way == 'direct'){
			if($type  == 'today'){
				$sql = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '1' AND  `date` = '".dates()."'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				return $total;
			}else if($type == 'week'){
				$back_span = time() - (60*60*24*7);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',time());
				$sql = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '1' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				return $total;
			}else if($type == 'last_week'){
				$back_span = time() - (60*60*24*14);
				$back_span2 = time() - (60*60*24*7);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',$back_span2);
				$sql = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '1' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				return $total;
			}else if($type == 'month'){
				$back_span = time() - (60*60*24*30);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',time());
				$sql = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '1' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				return $total;
			}else if($type == 'last_month'){
				$back_span = time() - (60*60*24*60);
				$back_span2 = time() - (60*60*24*30);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',$back_span2);
				$sql = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '1' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				return $total;
			}else if($type == 'all'){
				$sql = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '1'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				return $total;
			}
		}else if($way == 'work_referal'){
			if($type  == 'today'){
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '2' AND  `date` = '".dates()."'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '3' AND  `date` = '".dates()."'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '4' AND  `date` = '".dates()."'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '5' AND  `date` = '".dates()."'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '6' AND  `date` = '".dates()."'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '7' AND  `date` = '".dates()."'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}else if($type == 'week'){
				$back_span = time() - (60*60*24*7);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',time());
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '2' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '3' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '4' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '5' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '6' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '7' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}else if($type == 'last_week'){
				$back_span = time() - (60*60*24*14);
				$back_span2 = time() - (60*60*24*7);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',$back_span2);
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '2' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '3' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '4' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '5' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '6' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '7' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}else if($type == 'month'){
				$back_span = time() - (60*60*24*30);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',time());
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '2' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '3' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '4' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '5' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '6' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '7' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}else if($type == 'last_month'){
				$back_span = time() - (60*60*24*60);
				$back_span2 = time() - (60*60*24*30);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',$back_span2);
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '2' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '3' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '4' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '5' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '6' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '7' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}else if($type == 'all'){
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '2'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '3'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '4'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '5'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '6'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '7'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}
		}else if($way == 'purchase'){
			if($type  == 'today'){
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '14' AND  `date` = '".dates()."'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '15' AND  `date` = '".dates()."'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '16' AND  `date` = '".dates()."'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '17' AND  `date` = '".dates()."'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '18' AND  `date` = '".dates()."'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '19' AND  `date` = '".dates()."'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}else if($type == 'week'){
				$back_span = time() - (60*60*24*7);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',time());
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '14' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '15' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '16' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '17' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '18' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '19' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}else if($type == 'last_week'){
				$back_span = time() - (60*60*24*14);
				$back_span2 = time() - (60*60*24*7);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',$back_span2);
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '14' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '15' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '16' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '17' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '18' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '19' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}else if($type == 'month'){
				$back_span = time() - (60*60*24*30);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',time());
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '14' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '15' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '16' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '17' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '18' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '19' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}else if($type == 'last_month'){
				$back_span = time() - (60*60*24*60);
				$back_span2 = time() - (60*60*24*30);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',$back_span2);
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '14' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '15' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '16' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '17' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '18' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '19' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}else if($type == 'all'){
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '14'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '15'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '16'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '17'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '18'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '19'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}
		}else if($way == 'delivery'){
			if($type  == 'today'){
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '20' AND  `date` = '".dates()."'");
			
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
			
				return $total;
			}else if($type == 'week'){
				$back_span = time() - (60*60*24*7);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',time());
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '20' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
			
				return $total;
			}else if($type == 'last_week'){
				$back_span = time() - (60*60*24*14);
				$back_span2 = time() - (60*60*24*7);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',$back_span2);
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '20' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
			
				return $total;
			}else if($type == 'month'){
				$back_span = time() - (60*60*24*30);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',time());
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '20' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
			
				return $total;
			}else if($type == 'last_month'){
				$back_span = time() - (60*60*24*60);
				$back_span2 = time() - (60*60*24*30);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',$back_span2);
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '20' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				return $total;
			}else if($type == 'all'){
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '20'");
					$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
			
				return $total;
			}
		}else if($way == 'joining_referal'){
			if($type  == 'today'){
				$sql =  mysqli_query($db,  "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '8' AND  `date` = '".dates()."'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '9' AND  `date` = '".dates()."'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '10' AND  `date` = '".dates()."'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '11' AND  `date` = '".dates()."'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '12' AND  `date` = '".dates()."'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '13' AND  `date` = '".dates()."'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}else if($type == 'week'){
				$back_span = time() - (60*60*24*7);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',time());
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '8' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '9' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '10' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '11' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '12' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '13' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}else if($type == 'last_week'){
				$back_span = time() - (60*60*24*14);
				$back_span2 = time() - (60*60*24*7);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',$back_span2);
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '8' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '9' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '10' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '11' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '12' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '13' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}else if($type == 'month'){
				$back_span = time() - (60*60*24*30);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',time());
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '8' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '9' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '10' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '11' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '12' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '13' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}else if($type == 'last_month'){
				$back_span = time() - (60*60*24*60);
				$back_span2 = time() - (60*60*24*30);
				$back_date = date('Y-m-d',$back_span);
				$curr_date = date('Y-m-d',$back_span2);
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '8' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '9' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '10' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '11' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '12' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '13' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}else if($type == 'all'){
				$sql =  mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '8'");
				$sql2 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '9'");
				$sql3 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '10'");
				$sql4 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '11'");
				$sql5 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '12'");
				$sql6 = mysqli_query($db, "SELECT * FROM `income` WHERE `uid` = '$uid' AND `type` = '13'");
				$total = 0;
				foreach($sql as $data){
					$total = $total  + ($data['amount'] * 1);
				}
				foreach($sql2 as $data2){
					$total = $total  + ($data2['amount'] * 1);
				}
				foreach($sql3 as $data3){
					$total = $total  + ($data3['amount'] * 1);
				}
				foreach($sql4 as $data4){
					$total = $total  + ($data4['amount'] * 1);
				}
				foreach($sql5 as $data5){
					$total = $total  + ($data5['amount'] * 1);
				}
				foreach($sql6 as $data6){
					$total = $total  + ($data6['amount'] * 1);
				}
				return $total;
			}
		}
		
	}
	function levels($uid){
		global $db;
		$level_1 = array();
		$sql = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `ref` = '$uid'");
		//$sql = get_table_data_specific('flc_users','ref',$uid); 
		foreach($sql as $id){
			$level_1[] = $id['id'];
		}
		$level_2 = array();
		foreach($level_1 as $id1){
			$sql2 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `ref` = '$id1'");
			//$sql2 = get_table_data_specific('flc_users','ref',$id1);
			foreach($sql2 as $ids2){
				$level_2[] = $ids2['id'];
			}
		}
		$level_3 = array();
		foreach($level_2 as $id2){
			$sql3 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `ref` = '$id2'");
			//$sql3 = get_table_data_specific('flc_users','ref',$id2);
			foreach($sql3 as $ids3){
				$level_3[] = $ids3['id'];
			}
		}
		$level_4 = array();
		foreach($level_3 as $id3){
			$sql4 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `ref` = '$id3'");
			//$sql4 = get_table_data_specific('flc_users','ref',$id3);
			foreach($sql4 as $ids4){
				$level_4[] = $ids4['id'];
			}
		}
		$level_5 = array();
		foreach($level_4 as $id4){
			$sql6 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `ref` = '$id4'");
			//$sql5 = get_table_data_specific('flc_users','ref',$id4);
			foreach($sql5 as $ids5){
				$level_5[] = $ids5['id'];
			}
		}
		$level_6 = array();
		foreach($level_5 as $id5){
			$sql6 = mysqli_query($db, "SELECT `id` FROM `flc_users` WHERE `ref` = '$id5'");
			//$sql6 = get_table_data_specific('flc_users','ref',$id5);
			foreach($sql6 as $ids6){
				$level_6[] = $ids6['id'];
			}
		}
		$array = array();
		$total = count($level_1) + count($level_2) + count($level_3) + count($level_4) +  count($level_5) + count($level_6);
		return $total;
	}
	function update_usertype(){
		global $db;
		$users = get_table_data_specific('flc_users','status','1');
		foreach($users as $ids){
			$level_1 = get_lever_members('1',$ids);
			$level_2 = get_lever_members('2',$ids);
			$total = levels($ids);
			$number = get_table_data_single_row('flc_users','id',$ids,'number');
			if
			(
			$level_1 >= get_table_data_single_row('designation_bonus','id','2','level_1') &&
			$level_2 >= get_table_data_single_row('designation_bonus','id','2','level_2') &&
			$total >= get_table_data_single_row('designation_bonus','id','2','upto_6') &&
			get_table_data_single_row('flc_users','id',$ids,'type') == '0'
			)
			{
				$bonus = get_table_data_single_row('designation_bonus','id','2','bonus');
				$old_balance = get_table_data_single_row('flc_users','id',$ids,'balance');
				$new_balance = $old_balance + $bonus;
				$sql = mysqli_query($db,"UPDATE `flc_users` SET `balance` = '$new_balance',`type` = '1' WHERE `id` = '$ids'" );
				accounts_update($ids, $bonus, 'Designation upgrade bonus added on balance', $old_balance, $new_balance,'cr');
				income_entry($ids,$ids,$bonus,'21');
				sendsms($number,'Congratulations, your account designation has been upgraded and got commission'.$bonus);
			
			}else if
			(
			$level_1 >= get_table_data_single_row('designation_bonus','id','3','level_1') &&
			$level_2 >= get_table_data_single_row('designation_bonus','id','3','level_2') &&
			$total >= get_table_data_single_row('designation_bonus','id','3','upto_6') &&
			get_table_data_single_row('flc_users','id',$ids,'type') == '1'
			)
			{
				$bonus = get_table_data_single_row('designation_bonus','id','3','bonus');
				$old_balance = get_table_data_single_row('flc_users','id',$ids,'balance');
				$new_balance = $old_balance + $bonus;
				$sql = mysqli_query($db,"UPDATE `flc_users` SET `balance` = '$new_balance',`type` = '2' WHERE `id` = '$ids'" );
				accounts_update($ids, $bonus, 'Designation upgrade bonus added on balance', $old_balance, $new_balance,'cr');
				income_entry($ids,$ids,$bonus,'21');
			    sendsms($number,'Congratulations, your account designation has been upgraded and got commission'.$bonus);
			}else if
			(
			$level_1 >= get_table_data_single_row('designation_bonus','id','4','level_1') &&
			$level_2 >= get_table_data_single_row('designation_bonus','id','4','level_2') &&
			$total >= get_table_data_single_row('designation_bonus','id','4','upto_6')&&
			get_table_data_single_row('flc_users','id',$ids,'type') == '2'
			
			)
			{
				$bonus = get_table_data_single_row('designation_bonus','id','4','bonus');
				$old_balance = get_table_data_single_row('flc_users','id',$ids,'balance');
				$new_balance = $old_balance + $bonus;
				$sql = mysqli_query($db,"UPDATE `flc_users` SET `balance` = '$new_balance',`type` = '3' WHERE `id` = '$ids'" );
				accounts_update($ids, $bonus, 'Designation upgrade bonus added on balance', $old_balance, $new_balance,'cr');
				income_entry($ids,$ids,$bonus,'21');
			    sendsms($number,'Congratulations, your account designation has been upgraded and got commission'.$bonus);
			}else if
			(
			$level_1 >= get_table_data_single_row('designation_bonus','id','5','level_1') &&
			$level_2 >= get_table_data_single_row('designation_bonus','id','5','level_2') &&
			$total >= get_table_data_single_row('designation_bonus','id','5','upto_6')&&
			get_table_data_single_row('flc_users','id',$ids,'type') == '3'
			
			)
			{
				$bonus = get_table_data_single_row('designation_bonus','id','5','bonus');
				$old_balance = get_table_data_single_row('flc_users','id',$ids,'balance');
				$new_balance = $old_balance + $bonus;
				$sql = mysqli_query($db,"UPDATE `flc_users` SET `balance` = '$new_balance',`type` = '4' WHERE `id` = '$ids'" );
				accounts_update($ids, $bonus, 'Designation upgrade bonus added on balance', $old_balance, $new_balance,'cr');
				income_entry($ids,$ids,$bonus,'21');
			    sendsms($number,'Congratulations, your account designation has been upgraded and got commission'.$bonus);
			}else if
			(
			$level_1 >= get_table_data_single_row('designation_bonus','id','6','level_1') &&
			$level_2 >= get_table_data_single_row('designation_bonus','id','6','level_2') &&
			$total >= get_table_data_single_row('designation_bonus','id','6','upto_6')&&
			get_table_data_single_row('flc_users','id',$ids,'type') == '4'
			
			)
			{
				$bonus = get_table_data_single_row('designation_bonus','id','6','bonus');
				$old_balance = get_table_data_single_row('flc_users','id',$ids,'balance');
				$new_balance = $old_balance + $bonus;
				$sql = mysqli_query($db,"UPDATE `flc_users` SET `balance` = '$new_balance',`type` = '5' WHERE `id` = '$ids'" );
				accounts_update($ids, $bonus, 'Designation upgrade bonus added on balance', $old_balance, $new_balance,'cr');
				income_entry($ids,$ids,$bonus,'21');
				sendsms($number,'Congratulations, your account designation has been upgraded and got commission'.$bonus);
			}
		}
	}
	function decode($data){
	    $return = base64_decode($data);
	    return 'ok';
	}
	function total_income($uid){
	    global $db;
		$sql = mysqli_query($db,"SELECT `amount` FROM `income` WHERE `uid` = '$uid'");
	    
	   // $sql = get_table_data_specific('incomes','uid',$uid);
	    $total = 0;
	    foreach($sql as $data){
	        $total = $total + ($data['amount'] * 1);
	    }
	    return $total;
	}
	function sendmail($to,$subject,$message){
	
    $headers = 'From: support@self-employments.com' . "\r\n" .
        'Reply-To: no-reply@self-employments.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        mail(trim($to), $subject, $message, $headers);
	}
	function get_page_content($page){
		global $db;
		$text = get_table_data_specific('middletexts','id',$page);
		$text = mysqli_fetch_assoc($text);
		return $text;
	}
	function get_texts($task, $step){
		global $db;
		if($step == 1){
			$sql = mysqli_query($db, "SELECT * FROM `middletexts` WHERE `id` BETWEEN '1' AND '10'");
			return $sql;
		}else if($step = 2){
			$sql = mysqli_query($db, "SELECT * FROM `middletexts` WHERE `id` BETWEEN '11' AND '20'");
			return $sql;
		}else if($step = 3){
			$sql = mysqli_query($db, "SELECT * FROM `middletexts` WHERE `id` BETWEEN '21' AND '30'");
			return $sql;
		}else if($step = 4){
			$sql = mysqli_query($db, "SELECT * FROM `middletexts` WHERE `id` BETWEEN '31' AND '40'");
			return $sql;
		}else if($step = 5){
			$sql = mysqli_query($db, "SELECT * FROM `middletexts` WHERE `id` BETWEEN '41' AND '50'");
			return $sql;
		}else if($step = 6){
			$sql = mysqli_query($db, "SELECT * FROM `middletexts` WHERE `id` BETWEEN '51' AND '60'");
			return $sql;
		}else if($step = 7){
			$sql = mysqli_query($db, "SELECT * FROM `middletexts` WHERE `id` BETWEEN '61' AND '70'");
			return $sql;
		}else if($step = 8){
			$sql = mysqli_query($db, "SELECT * FROM `middletexts` WHERE `id` BETWEEN '71' AND '80'");
			return $sql;
		}else if($step = 9){
			$sql = mysqli_query($db, "SELECT * FROM `middletexts` WHERE `id` BETWEEN '81' AND '90'");
			return $sql;
		}else if($step = 10){
			$sql = mysqli_query($db, "SELECT * FROM `middletexts` WHERE `id` BETWEEN '91' AND '100'");
			return $sql;
		}
	}
	function get_pfund_report($time){
		global $uid;
		global $db;
		if($time == 'today'){
			$sql = mysqli_query($db, "SELECT `provident` FROM `withdraw` WHERE `uid` = '$uid'  AND  `date` = '".dates()."'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['provident'] * 1);
			}
			return $total;
		}else if($time == 'this_week'){
			$back_span = time() - (60*60*24*7);
			$back_date = date('Y-m-d',$back_span);
			$curr_date = date('Y-m-d',time());
			$sql = mysqli_query($db, "SELECT `provident` FROM `withdraw` WHERE `uid` = '$uid'  AND  `date` BETWEEN '$back_date' AND '$curr_date'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['provident'] * 1);
			}
			return $total;
		}else if($time == 'last_week'){
			$back_span = time() - (60*60*24*14);
			$back_span2 = time() - (60*60*24*7);
			$back_date = date('Y-m-d',$back_span);
			$curr_date = date('Y-m-d',$back_span2);
			$sql = mysqli_query($db, "SELECT `provident` FROM `withdraw` WHERE `uid` = '$uid'  AND  `date` BETWEEN '$back_date' AND '$curr_date'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['provident'] * 1);
			}
			return $total;
		}else if($time == 'this_month'){
			$back_span = time() - (60*60*24*30);
			$back_date = date('Y-m-d',$back_span);
			$curr_date = date('Y-m-d',time());
			$sql = mysqli_query($db, "SELECT `provident` FROM `withdraw` WHERE `uid` = '$uid' AND  `date` BETWEEN '$back_date' AND '$curr_date'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['provident'] * 1);
			}
			return $total;
		}else if($time == 'last_month'){
			$back_span = time() - (60*60*24*60);
			$back_span2 = time() - (60*60*24*30);
			$back_date = date('Y-m-d',$back_span);
			$curr_date = date('Y-m-d',$back_span2);
			$sql = mysqli_query($db, "SELECT `provident` FROM `withdraw` WHERE `uid` = '$uid'  AND  `date` BETWEEN '$back_date' AND '$curr_date'");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['provident'] * 1);
			}
			return $total;
		}else if($time == 'all'){
			
			$sql = mysqli_query($db, "SELECT `provident` FROM `withdraw` WHERE `uid` = '$uid' ");
			$total = 0;
			foreach($sql as $data){
				$total = $total  + ($data['provident'] * 1);
			}
			return $total;
		}
	}
	function get_domain($step){
	    if($step == '1'){
	        $url = get_table_data_single_row('dynamics','content','domain_one','value');
	        return $url;
	    }else if($step == '2'){
	        $url = get_table_data_single_row('dynamics','content','domain_two','value');
	        return $url;
	    }else if($step == '3'){
	        $url = get_table_data_single_row('dynamics','content','domain_three','value');
	        return $url;
	    }else if($step == '4'){
	        $url = get_table_data_single_row('dynamics','content','domain_four','value');
	        return $url;
	    }else if($step == '5'){
	        $url = get_table_data_single_row('dynamics','content','domain_five','value');
	        return $url;
	    }else if($step == '6'){
	        $url = get_table_data_single_row('dynamics','content','domain_six','value');
	        return $url;
	    }else if($step == '7'){
	        $url = get_table_data_single_row('dynamics','content','domain_seven','value');
	        return $url;
	    }else if($step == '8'){
	        $url = get_table_data_single_row('dynamics','content','domain_eight','value');
	        return $url;
	    }else if($step == '9'){
	        $url = get_table_data_single_row('dynamics','content','domain_nine','value');
	        return $url;
	    }else if($step == '10'){
	        $url = get_table_data_single_row('dynamics','content','domain_ten','value');
	        return $url;
	    }
	}
	function get_product_price($uid){
		global $db;
		$sql = mysqli_query($db, "SELECT * FROM `i_purchase` WHERE `uid` = '$uid' AND `status` = '1'");
		$count = $sql->num_rows;
		$query = mysqli_query($db, "SELECT * FROM `dynamic_price`");
		foreach($query as $data){
			if($count >= $data['min'] && $count <= $data['max']){
				$amount = $data['rate'];
			}
		}
		return $amount;
	}
	function get_earning_description($type){
		if($type == '1'){
			$description = 'Own Work Income';
			return $description;
		}else if($type == '2'){
			$description = 'Work Referal From Level 2';
			return $description;
		}else if($type == '3'){
			$description = 'Work Referal From Level 3';
			return $description;
		}else if($type == '4'){
			$description = 'Work Referal From Level 4';
			return $description;
		}else if($type == '5'){
			$description = 'Work Referal From Level 5';
			return $description;
		}else if($type == '6'){
			$description = 'Work Referal From Level 6';
			return $description;
		}else if($type == '7'){
			$description = 'Direct Referal Commission';
			return $description;
		}else if($type == '8'){
			$description = 'Joining Referal From Level 1';
			return $description;
		}else if($type == '9'){
			$description = 'Joining Referal From Level 2';
			return $description;
		}else if($type == '10'){
			$description = 'Joining Referal From Level 3';
			return $description;
		}else if($type == '11'){
			$description = 'Joining Referal From Level 4';
			return $description;
		}else if($type == '12'){
			$description = 'Joining Referal From Level 5';
			return $description;
		}else if($type == '13'){
			$description = 'Joining Referal From Level 6';
			return $description;
		}else if($type == '14'){
			$description = 'Product Purchase referal from Level 1';
			return $description;
		}else if($type == '15'){
			$description = 'Product Purchase referal from Level 2';
			return $description;
		}else if($type == '16'){
			$description = 'Product Purchase referal from Level 3';
			return $description;
		}else if($type == '17'){
			$description = 'Product Purchase referal from Level 4';
			return $description;
		}else if($type == '18'){
			$description = 'Product Purchase referal from Level 5';
			return $description;
		}else if($type == '19'){
			$description = 'Product Purchase referal from Level 6';
			return $description;
		}else if($type == '20'){
			$description = 'Delivery point commission';
			return $description;
		}else if($type == '21'){
			$description = 'Designation Upgrade Bonus';
			return $description;
		}
	}
	function get_ten_data_ref($table_name){
		global $db;
		global $uid;
		$sql = mysqli_query($db, "SELECT * FROM `".$table_name."` WHERE `ref` = '$uid' ORDER BY `id` DESC LIMIT 10");
		return $sql;
	}
	function paginationed_ref($coun,$table_name){
		global $db;
		global $uid;
        $count = sanetize($coun);
		$counts = $count.'0';
		
		$sql = mysqli_query($db, "SELECT * FROM `".$table_name."` WHERE `ref` = '$uid'   ORDER BY `id` DESC LIMIT $counts, 10");
		return $sql;
	}
	function pagination_list_ref($table_name){
		global $db;
		global $uid;
		$sql = mysqli_query($db, "SELECT `id` FROM `".$table_name."` WHERE `ref` = '$uid'   ORDER BY `id` DESC  LIMIT 300");
		$num_rows = mysqli_num_rows($sql);
		
		if($num_rows > 10){
			$rowscount = ($num_rows / 10);
			$count_total = ceil($rowscount);
			return $count_total;
		}else{
			return 1;
		}
	}
	function get_ten_data($table_name){
		global $db;
		global $uid;
		$sql = mysqli_query($db, "SELECT * FROM `".$table_name."` WHERE `uid` = '$uid' ORDER BY `id` DESC LIMIT 10");
		return $sql;
	}
	function paginationed($coun,$table_name){
		global $db;
		global $uid;
        $count = sanetize($coun);
		$counts = $count.'0';
		
		$sql = mysqli_query($db, "SELECT * FROM `".$table_name."` WHERE `uid` = '$uid' ORDER BY `id` DESC LIMIT $counts, 10");
		return $sql;
	}
	function pagination_list($table_name){
		global $db;
		global $uid;
		$sql = mysqli_query($db, "SELECT `id` FROM `".$table_name."` WHERE `uid` = '$uid' ORDER BY `id` DESC LIMIT 300");
		$num_rows = mysqli_num_rows($sql);
		
		if($num_rows > 10){
			$rowscount = ($num_rows / 10);
			$count_total = ceil($rowscount);
			return $count_total;
		}else{
			return 1;
		}
	}
	function get_ten_data_dp($table_name){
		global $db;
		global $uid;
		$sql = mysqli_query($db, "SELECT * FROM `".$table_name."` WHERE `dp` = '$uid' ORDER BY `id` DESC LIMIT 10");
		return $sql;
	}
	function paginationed_dp($coun,$table_name){
		global $db;
		global $uid;
        $count = sanetize($coun);
		$counts = $count.'0';
		
		$sql = mysqli_query($db, "SELECT * FROM `".$table_name."` WHERE `dp` = '$uid' ORDER BY `id` DESC LIMIT $counts, 10");
		return $sql;
	}
	function pagination_list_dp($table_name){
		global $db;
		global $uid;
		$sql = mysqli_query($db, "SELECT `id` FROM `".$table_name."` WHERE `dp` = '$uid' ORDER BY `id` DESC  LIMIT 300");
		$num_rows = mysqli_num_rows($sql);
		
		if($num_rows > 10){
			$rowscount = ($num_rows / 10);
			$count_total = ceil($rowscount);
			return $count_total;
		}else{
			return 1;
		}
	}
	function get_stepID($date, $step){
		global $db;
		$sql = mysqli_query($db, "SELECT `id` FROM `jobs2` WHERE `date` = '$date' AND `step` = '$step'");
		$data = mysqli_fetch_assoc($sql);
		return $data['id'];
	}
	function get_page_adds($stepID, $page){
		global $db;
		$page = $page - 1;
		$count = $page.'0';
		$sql = mysqli_query($db, "SELECT * FROM `jobs` WHERE `jobid` = '$stepID' LIMIT $count, 10");
		
		$sl = 1;
		$array = array();
		foreach($sql as $jobs){
			$array[$sl] = $jobs;
			$sl++;
		}
		return $array;
	}
	function check_profile_complition(){
		if(get_table_data_single_row('flc_users','id',$_SESSION['flc_logged'],'varify') == '1'){
			return true;
		}else{
			return false;
		}
	}
	function get_downline($uid){
		set_time_limit(20);
		$array = array();
		$array[] = $uid;
		$ids_array = array();
		$cont = 0;
		$turn_off = 0;
		while($cont == 0){
			$temp = array();
			foreach($array as $ids){
				$sql = get_table_data_specific('flc_users','ref',$ids);
				if($sql->num_rows !== 0){
					foreach($sql as $id_founds){
						$temp[] = $id_founds['id'];
						$ids_array[] = $id_founds['id'];
					}
				}
			}
			$cont = 1;
		}
		return count($temp);
	}
	function get_total_step_worked($uid){
	    global $db;
	    $sql = mysqli_query($db, "SELECT `id` FROM `incomes` WHERE `type` = '1' AND `uid` = '$uid' AND `date` = '".dates()."' LIMIT 100");
	    $num_rows = $sql->num_rows;
	    return $num_rows;
	}
	function elegable_step($uid){
	    global $db;
	    $total_task_done = get_table_data_single_row('flc_users','id',$uid,'points');
	    $sql = get_table_data_all('direct_income');
	    $found = 0;
	    foreach($sql as $data){
	        if($total_task_done > $data['min'] && $total_task_done < $data['max']){
	            $found = 1;
	            $id = $data['id'];
	        }
	    }
	    return get_table_data_single_row('direct_income','id',$id,'step');
	}
	function profile_fully_complete($uid){
	    $sql = mysqli_query($db, "SELECT * FROM `flc_users` WHERE `id` = '$uid' LIMIT 1");
	    $data = mysqli_fetch_assoc($sql);
	    if($data['device'] !== null &&
	        $data['dob'] !== null &&
	        $data['gender'] !== null &&
	        $data['occ'] !== null &&
	        $data['edu'] !== null &&
	        $data['address'] !== null &&
	        $data['nid_front'] !== null &&
	        $data['nid_back'] !== null &&
	        $data['blood'] !== null){
	       return true;
	   }else{
	       return false;
	   }
	}
	function get_steps_allowed($uid){
	    $steps_done = get_table_data_single_row('flc_users','id',$uid,'points');
	    $query = get_table_data_all('direct_income');
	    $found = 0;
	    if($steps_done < 1 || $steps_done == ''){
	        $steps_done = 1;
	    }
	    foreach($query as $data){
	        if($steps_done >= $data['min']  && $steps_done <= $data['max']){
	            $found = 1;
	            $step = $data['step'];
	        }
	    }
	    return $step;
	}
?>



