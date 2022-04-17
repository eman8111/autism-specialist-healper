<?php

$conn = mysqli_connect('localhost', 'root', '', 'autism');

if (isset($_POST['Insert_Adir']) && !empty($_POST['Insert_Adir'])) {
	$adir_size = e($_POST['adir_size']);
	$patient_id = e($_POST['patient_id']);

	if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `adir_result` WHERE pateint_id = '" . $patient_id . "' ")) > 0) {
		$_SESSION['display_error'] = "This Patient already exist";
	} else {
		// $comment=e($_POST['comment']);
		for ($i = 0; $i <= $adir_size; $i++) {

			if (isset($_POST['result' . $i]) && $_POST['result' . $i] != null && $_POST['result' . $i] === '1') {
				$result = 1;
			} else {
				$result = 0;
			}
			$Query = "INSERT INTO `adir_result` (`adir_id`, `result`, `pateint_id`) VALUES ('" . e($_POST['adir_id' . $i]) . "', '" . $result . "', '" . $patient_id . "')";  //comment
			$insert = mysqli_query($conn, $Query);
		}
		if (isset($insert) && $insert) {
			// echo 'Instered Sucessfully';
		} else {
			// echo 'Error While Inserting ADIR';
		}
	}
}






if (isset($_POST['Insert_Evaluation']) && !empty($_POST['Insert_Evaluation'])) {
	$evaluation_size = e($_POST['evaluation_size']);
	// $comment=e($_POST['comment']);
	$patient_id = e($_POST['patient_id']);

	if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `evaluation_history_result` WHERE pateint_id = '" . $patient_id . "' ")) > 0) {
		$_SESSION['display_error'] = "This Patient already exist";
	} else {

		for ($i = 0; $i <= $evaluation_size; $i++) {
			if (isset($_POST['result' . $i]) && $_POST['result' . $i] != null) {
				$Query = "INSERT INTO `evaluation_history_result` (`evaluation_id`, `result`, `pateint_id`) VALUES ('" . e($_POST['evaluation_id' . $i]) . "', '" . e($_POST['result' . $i]) . "', '" . $patient_id . "')"; //comment
				$insert = mysqli_query($conn, $Query);
			}
		}
		if (isset($insert) && $insert) {
			// echo 'Instered Sucessfully';
		} else {
			// echo 'Error While Inserting ADIR';
		}
	}
}







if (isset($_POST['Insert_notic']) && !empty($_POST['Insert_notic'])) {
	// $comment = e($_POST['comment']);
	$patient_id = e($_POST['patient_id']);

	if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `notic` WHERE pateint_id = '" . $patient_id . "' ")) > 0) {
		$_SESSION['display_error'] = "This Patient already exist";
	} else {

		for ($m = 0; $m < sizeof($_POST['notic_q_id']); $m++) {
			if (isset($_POST['result'][$m]) && $_POST['result'][$m] != null) {

				$Query = "INSERT INTO `notic` (`notic_q_id`, `notic_category`, `result`, `pateint_id`) 
					VALUES ('" . $_POST['notic_q_id'][$m] . "','" . $_POST['notic_category'][$m] . "', '" . $_POST['result'][$m] . "', '" . $patient_id . "')"; //comment
				$insert = mysqli_query($conn, $Query);
			}
		}
		if (isset($insert) && $insert) {
			// echo 'Instered Sucessfully';
		} else {
			// echo 'Error While Inserting ADIR';
		}
	}
}


if (isset($_POST['Insert_report']) && !empty($_POST['Insert_report'])) {
	// $comment = e($_POST['comment']);
	$patient_id = e($_POST['patient_id']);
	if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `attahced_reports_result` WHERE patient_id  = '" . $patient_id . "' ")) > 0) {
		$_SESSION['display_error'] = "This Patient already exist";
	} else {

		for ($m = 0; $m < sizeof($_POST['attached_id']); $m++) {
			$target_path = "attached/";
			$target_path = $target_path . basename($_FILES["uploadfile"]["name"][$m]);
			if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"][$m], $target_path)) {
				if (isset($_POST['result'][$m]) && $_POST['result'][$m] != null) {
					$result = 1;
				} else {
					$result = 0;
				}
				$Query = "INSERT INTO `attahced_reports_result` (`attached_id`, `result`, `attached_url`, `patient_id`)
 					VALUES ('" . $_POST['attached_id'][$m] . "','" . $result . "','" . $target_path . "', '" . $patient_id . "')"; //comment
				$insert = mysqli_query($conn, $Query);
			}
			$target_path = "";
		}



		if (isset($insert) && $insert) {
			// echo 'Instered Sucessfully';
		} else {
			// echo 'Error While Inserting ADIR';
		}
	}
}

function e($val)
{
	global $conn;
	return htmlspecialchars(mysqli_real_escape_string($conn, trim($val)));
}