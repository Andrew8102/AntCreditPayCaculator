<?php
    $edu = $_GET['edu'];
    $shouru = $_GET['shouru'];
    $huoshifei = $_GET['huoshifei'];
    $huankuan = $_GET['huankuan'];

	$pressure = $_GET['pressure'];
	$usefirst = $_GET['usefirst'];
	$credit = $_GET['credit'];
	$postpone = $_GET['postpone'];
	$hascard = $_GET['hascard'];
	$sex = $_GET['sex'];
	$saving = $_GET['saving'];

	function huabei($huankuan,$shouru){
		$weight_huabei = (1-$huankuan/$shouru-0.375)*0.5;
		return $weight_huabei;
	}
	function pressure($select){
		$weight_pressure = -0.02*$select;
		return $weight_pressure;
	}

	function payment($select){
		$weight_payment = -0.02 * $select;
		return $weight_payment;
	}
	function badkid($select){
		switch($select){
			case 0:
				$weight_badkid = 0;
				break;
			case 1:
				$weight_badkid = -0.08;
				break;
			case 2:
				$weight_badkid = -0.11;
				break;
			case 3: 
				$weight_badkid = -0.14;
				break;
		}
		return $weight_badkid;
	}
	function credit($select){
		$weight_credit = 0.04 * $select;
		return $weight_credit;
	}
	function sex($select){
		$weight_sex = 0.05 * $select;
		return $weight_sex;
	}
	function saving($saving,$shouru,$huankuan){
		$saving_rate = $saving/($shouru-$huankuan);
		if ($saving_rate<=0.4){
			$weight_saving = 0;
		}elseif ($saving_rate <= 0.7){
			$weight_saving = -0.05;
		}else {
			$weight_saving = -0.1;
		}
		return $weight_saving;
	} 
	$weight = huabei($huankuan,$shouru) + pressure($pressure) + payment($usefirst) + badkid($postpone) + credit($credit)+sex($sex)+ saving($saving,$shouru,$huankuan);
	$edu_recommend = $shouru * (0.5+$weight);
	$array_edu = ["edu_recommend"=>$edu_recommend];
	echo json_encode($array_edu);
?>