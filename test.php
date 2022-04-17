<?php

// $conn = mysqli_connect('localhost', 'root', '', 'autism_test');

// $query = 'select p.name,p.age
// from patient AS p , specialist AS s
// where s.id = 8 and p.spcialist_id = s.id';

// $run_query = mysqli_query($conn, $query);
// $result = mysqli_fetch_assoc($run_query);

// echo "<pre>";
// print_r($result);
// echo "</pre>";


// require_once('classes/Request.php');
// require_once('classes/Session.php');
// require_once('classes/Db.php');
// require_once('classes/Validation/ValudationRule.php');
// require_once('classes/Validation/Required.php');
// require_once('classes/Validation/Numeric.php');
// require_once('classes/Validation/Email.php');
// require_once('classes/Validation/Str.php');
// require_once('classes/Validation/Validator.php');
// require_once('classes/Users.php');
// require_once('classes/module/adir.php');
// $users = new Users;
// $result = $users->insert("name , email , password", "'Moamen Ali' , 'moamen@gmail.com' , '12345'");
// echo "<pre>";
// var_dump($result);
// echo "</pre>";

// $adir = new adir;
// $result = $adir->selectAll();

// echo "<pre>";
// print_r($result);
// echo "</pre>";

// $v = new Validator;
// $v->validate('age', 'aaaa', ['required', 'numeric']);
// echo "<pre>";
// print_r($v->getErrors());
// echo "</pre>";

// $lovaas = new lovaas_question;
// $result =  $lovaas->selectAll();
// echo "<pre>";
// print_r($result);
// echo "</pre>";

// $users = new status;
// $result = $users->delete('id = 8');

// echo "<pre>";
// var_dump($result);
// echo "</pre>";


// $session = new Session;

// $session->get($errors);

// $request = new Request;
// $result = $request->get("id");
// echo $result;

require_once('app.php');

use Project\Classes\Request;
use Project\Classes\Session;
use Project\Classes\calc_scale;
use Project\Classes\Models\adir;
use Project\Classes\Models\plan;
use Project\Classes\Models\to_do;
use Project\Classes\Models\Users;
use Project\Classes\Models\tables;
use Project\Classes\Models\patient;
use Project\Classes\Models\schedule;
use Project\Classes\Models\caregiver;
use Project\Classes\Models\long_term;
use Project\Classes\Models\specialist;
use Project\Classes\Models\notify_to_do;
use Project\Classes\Models\weknees_point;
use Project\Classes\Validation\Validator;
use Project\Classes\Models\lovaas_results;
use Project\Classes\Models\strength_point;
use Project\Classes\Models\lovaas_category;
use Project\Classes\Models\notify_schedule;
use Project\Classes\Models\lovaas_questions;

// $db = new adir;
// $result = $db->selectAll();
// echo "<pre>";
// print_r($result);
// echo "</pre>";


// $validation = new Validator;
// $validation->validate('name', 10, ['required', 'str']);
// echo "<pre>";
// print_r($validation->getErrors());
// echo "</pre>";


// echo "<pre>";
// print_r($_SESSION['errors']);
// echo "</pre>";


// $user = new Users;
// $run_query = $user->select("*", "email = '$email'");
// echo $run_query;
// $user_id[] = $session->get('user_id');
// echo "<pre>";
// print_r($user_id);
// echo "</pre>";

// echo $_SESSION['user_id'];
// $adir = new adir;
// $result = $adir->selectAll();
// echo "<pre>";
// print_r($result);
// echo "</pre>";

// $lovaas_question = new lovaas_questions;
// $result = $lovaas_question->selectAll();
// echo "<pre>";
// print_r($result);
// echo "</pre>";

// $lovaas_category = new lovaas_category;
// $lovaas_cats = $lovaas_category->selectAll();
// echo "<pre>";
// print_r($lovaas_cats);
// echo "</pre>";

// foreach ($lovaas_cats as $value) {
//     echo $value['id'] . "<br>";
//     echo $value['category'];
// }

// echo "<hr>";

// $lovaas_questions = new lovaas_questions;
// $lovaas_ques = $lovaas_questions->selectAll();
// echo "<pre>";
// print_r($lovaas_ques);
// echo "</pre>";




// $select_cat_id = $lovaas_category->selectId("*", 1);
// echo $select_cat_id['id'];
// echo "<br>";
// $select_que_id = $lovaas_questions->selectId("*", 1);
// echo $select_que_id['lovaas_category_id'];;
// echo "<pre>";
// print_r($results);
// echo "</pre>";


// $users = new Users;
// $selectUsers = $users->select("email", "email = 'admin@gmail.com'");
// $selectUserResult = mysqli_fetch_assoc($selectUsers);
// var_dump($selectUserResult);

// echo $selectUserResult['email'];


// print_r($_SESSION);
// $specialist = new specialist;
// $specialist_id = $session->get('specialist_id');
// $selectSpecialist = $specialist->selectId("*", $specialist_id);

// $patiants = new patient;
// $patiantsResults = $patiants->selectWhere("name , age , caregiver_phone", "spcialist_id = $specialist_id");

// print_r($patiantsResults);

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

// $specialist = new specialist;
// $specialist_id = $session->get('specialist_id');
// $select_specialist = $specialist->selectId("*", $specialist_id);

// $patiants = new patient;
// $patiants_results = $patiants->selectWhere("*", "spcialist_id = $specialist_id");

// $full_result = [];

// $tablesSelect = new tables;
// $results =  $tablesSelect->selectAs("schedule.*, patient.name", "schedule left JOIN patient on schedule.patient_id = patient.id",  "schedule.specialist_id = 11");
// $full_result[] = $results;

// $schedule = new schedule;
// $schedule_results = $schedule->selectWhere("schedule.*, patient.name ", "specialist_id = $specialist_id");
// $full_result[] = $schedule_results;

// SELECT schedule.*, patient.name from schedule left JOIN patient on schedule.patient_id = patient.id WHERE schedule.specialist_id = 11

// echo "<pre>";
// print_r($results);
// echo "</pre>";

// foreach ($results as $key => $result) {
//     if ($result['P.id'] === 101) {
//         foreach ($schedule_results as $schedule_result) {
//             array_push($result, array($key => $schedule_result));
//         }
//     }
// }
// echo "<pre>";
// print_r($results);
// echo "</pre>";

// echo "<hr>";

// $patient_id = $request->get('patientid');

// $plan = new plan;
// $select_plan = $plan->select("id", "pateint_id  = $patient_id");
// $show_paln_id = mysqli_fetch_assoc($select_plan);
// $plan_id = $show_paln_id['id'];

// $strength_point = new strength_point;
// $select_strength_point = $strength_point->selectWhere("*", "plan_id = $plan_id");
// echo "<pre>";
// print_r($select_strength_point);
// echo "</pre>";
// $weknees_point = new weknees_point;
// $select_weknees_point = $weknees_point->selectWhere("*", "plan_id = $plan_id");
// echo "<pre>";
// print_r($select_weknees_point);
// echo "</pre>";


// $specialist = new specialist;
// $select_specialist = $specialist->select("*", "serial_no = '60'");
// $select_specialist_row = mysqli_fetch_assoc($select_specialist);

// echo "<pre>";
// print_r($select_specialist_row);
// echo "</pre>";


// $patients = new patient;
// $select_patient =  $caregiver->select("*", "sp_serial_no = '$sp_serial_no' AND name = '$name' AND email = '$email' AND password = '$password'");
// $select_patient_row = mysqli_fetch_assoc($select_patient);
// echo "<pre>";
// print_r($select_patient_row);
// echo "</pre>";


// echo $select_patient_row['name'];


// $lovaas_results = new lovaas_results;
// $lovaas_results_arr = $lovaas_results->selectWhere("*", "patient_id = 104");
// echo "<pre>";
// print_r($lovaas_results_arr);
// echo "</pre>";

// $tables_select = new tables;
// $query = "SELECT lovaas_questions.lovass_questions , lovaas_results.lovaas_question_result FROM lovaas_questions , lovaas_results WHERE lovaas_results.patient_id = 101 AND lovaas_questions.lovaas_category_id = 1";
// $lovaas_results =  $tables_select->query($query);
// $lovaas_results_report = mysqli_fetch_all($lovaas_results, MYSQLI_ASSOC);
// echo "<pre>";
// print_r($lovaas_results_report);
// echo "</pre>";


// $lovaas_results = new lovaas_results;
// $lovaas_results_arr = $lovaas_results->selectWhere("*", "patient_id = 101");

// echo "<pre>";
// print_r($lovaas_results_arr);
// echo "</pre>";

// if (!empty($lovaas_results_arr)) {
//     echo 'not empty';
// } else {
//     echo 'empty';
// }

// Another way to debug/test is to view all cookies
// echo "<pre>";
// print_r($_COOKIE);
// echo "</pre>";



// $now = new DateTime();
// $now_date = $now->format("Y-m-d");

// $schedule = new schedule;
// $query = "SELECT * FROM `schedule` WHERE schedule_date >= '$now_date' AND patient_id = 105 LIMIT 1";
// $run_query = $schedule->query($query);
// $next_schedule = mysqli_fetch_assoc($run_query);


// if ($next_schedule !== null) {
//     echo "<pre>";
//     print_r($next_schedule);
//     echo "</pre>";
// } else {
//     echo "no";
// }

// $schedule = new schedule;
// $query = "SELECT schedule.id , schedule.schedule_time , schedule.schedule_date , patient.id AS p_id , patient.name FROM `schedule` join patient on schedule.patient_id = patient.id where schedule.specialist_id = 11";
// $run_query =  $schedule->query($query);
// $res = mysqli_fetch_all($run_query, MYSQLI_ASSOC);

// echo "<pre>";
// print_r($res);
// echo "</pre>";

// foreach ($res as $value) {
//     echo $value['3'];
//     echo "<br>";
//     echo $value['4'];
// }
// $schedule = new schedule;
// $today = date("Y-m-d");

// $notif_schedule = $schedule->selectWhere("*", "schedule_date = '$today'");

// foreach ($notif_schedule as $notif) {
//     $patient_id = $notif['patient_id'];
//     $notif_patients = $patients->selectWhere("*", "id = $patient_id");
//     foreach ($notif_patients as $patient) {
//         if ($notif['patient_id'] == $patient['id']) {
//             echo $notif['schedule_time'];
//             echo "<br>";
//         }
//         echo $patient['name'];
//         echo "<br>";
//     }
// }

// echo "<pre>";
// print_r($notif_schedule);
// echo "</pre>";
// echo count($notif_schedule);


// $patients = new patient;
// $to_do = new to_do;

// $res = $to_do->selectAll();

// unset($_SESSION['to_do']);

// if ($session->has('to_do')) {
//     $to_do_arr = $session->get('to_do');
//     foreach ($to_do_arr as $value) {
//         echo $value['title'] . "<br>";
//     }
//     echo count($to_do_arr);
// } else {
//     echo "no";
// }


// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

// unset($_SESSION['to_do']);
// $schedule = new schedule;
// $query = "SELECT schedule.id , schedule.schedule_date_time , patient.id AS p_id , patient.name FROM `schedule` join patient on schedule.patient_id = patient.id where schedule.specialist_id = 11";
// $run_query =  $schedule->query($query);
// $results_schedule = mysqli_fetch_all($run_query, MYSQLI_ASSOC);

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

// $schedule = new schedule;
// $specialist_id = $session->get('specialist_id');
// $notif_schedule = $schedule->selectWhere("*", "specialist_id = $specialist_id");
// $date_time_arr = [];
// $today = date("d-m-Y");
// foreach ($notif_schedule as $key => $value) {
//     $date_time_arr[] = [
//         'patient_id' => $value['patient_id'],
//         'schedule_date' => date('d-m-Y', strtotime($value['schedule_date_time'])),
//         'schedule_time' => date('h:i a', strtotime($value['schedule_date_time'])),
//     ];
// }

// $today_arr = [];
// foreach ($date_time_arr as $value) {
//     if ($value['schedule_date'] == $today) {
//         $today_arr[] = [
//             'patient_id' => $value['patient_id'],
//             'schedule_date' => $value['schedule_date'],
//             'schedule_time' => $value['schedule_time']
//         ];
//     }
// }

// echo "<pre>";
// print_r($today_arr);
// echo "</pre>";
// $notify_to_do = new notify_to_do;
// $patient = new patient;
// $caregiver_id = $session->get('caregiver_id');
// $get_notify = $notify_to_do->selectWhere("*", "caregiver_id = $caregiver_id");

// // echo "<pre>";
// // print_r($get_notify);
// // echo "</pre>";

// foreach ($get_notify as $patient) {
//     $patient_id =  $patient['patient_id'] . "<br>";
//     $patient_select = $patient->selectWhere("*", "id = $patient_id");
// }
// echo "<pre>";
// print_r($patient_select);
// echo "</pre>";

// $notify_schedule = new notify_schedule;
// $get_notify_schedule = $notify_schedule->selectWhere("*", "caregiver_id = 9");

// $date_time_arr = [];
// $today = date("d-m-Y");
// foreach ($get_notify_schedule as $key => $value) {
//     $date_time_arr[] = [
//         'patient_id' => $value['patient_id'],
//         'schedule_date' => date('d-m-Y', strtotime($value['schedule_date_time'])),
//         'schedule_time' => date('h:i a', strtotime($value['schedule_date_time'])),
//     ];
// }

// $notify_caregiver = [];
// foreach ($date_time_arr as $value) {
//     if ($value['schedule_date'] == $today) {
//         $notify_caregiver[] = [
//             'patient_id' => $value['patient_id'],
//             'schedule_date' => $value['schedule_date'],
//             'schedule_time' => $value['schedule_time']
//         ];
//     }
// }



// $now = new DateTime();
// $now_date = $now->format('Y-m-d H:i:s T');

// print_r($now);
// echo $now_date;
// $patients = new patient;
// $patient_result =  $patients->selectId("*", 142);
// $caregiver_id = $patient_result['caregiver_id'];

// if ($caregiver_id != null) {
//     echo $caregiver_id;
//     // $session->set("caregiver_id", $caregiver_id);
// } else {
//     echo "not found";
// }

function calc_cat($num, $cat)
{

    $RB[] = [
        'array_1' => ['range' => range(0, 3), 'norm' => 4, 'mini' => 2],
        'array_2' => ['range' => range(4, 6), 'norm' => 5, 'mini' => 3],
        'array_3' => ['range' => range(7, 9), 'norm' => 6, 'mini' => 9],
        'array_4' => ['range' => range(10, 13), 'norm' => 7, 'mini' => 16],
        'array_5' => ['range' => range(14, 16), 'norm' => 8, 'mini' => 25],
        'array_6' => ['range' => range(17, 19), 'norm' => 9, 'mini' => 37],
        'array_7' => ['range' => range(20, 22), 'norm' => 10, 'mini' => 50],
        'array_8' => ['range' => range(23, 26), 'norm' => 11, 'mini' => 63],
        'array_9' => ['range' => range(27, 29), 'norm' => 12, 'mini' => 75],
        'array_10' => ['range' => range(30, 32), 'norm' => 13, 'mini' => 84],
        'array_11' => ['range' => range(33, 36), 'norm' => 14, 'mini' => 91],
        'array_12' => ['range' => range(37, 39), 'norm' => 15, 'mini' => 95]
    ];

    $SI[] = [
        'array_1' => ['range' => range(0, 0), 'norm' => 3, 'mini' => 1],
        'array_2' => ['range' => range(1, 4), 'norm' => 4, 'mini' => 2],
        'array_3' => ['range' => range(5, 8), 'norm' => 5, 'mini' => 3],
        'array_4' => ['range' => range(9, 12), 'norm' => 6, 'mini' => 9],
        'array_5' => ['range' => range(13, 15), 'norm' => 7, 'mini' => 16],
        'array_6' => ['range' => range(16, 19), 'norm' => 8, 'mini' => 25],
        'array_7' => ['range' => range(20, 23), 'norm' => 9, 'mini' => 37],
        'array_8' => ['range' => range(24, 27), 'norm' => 10, 'mini' => 50],
        'array_9' => ['range' => range(28, 30), 'norm' => 11, 'mini' => 63],
        'array_10' => ['range' => range(31, 34), 'norm' => 12, 'mini' => 75],
        'array_11' => ['range' => range(35, 38), 'norm' => 13, 'mini' => 84],
        'array_12' => ['range' => range(39, 342), 'norm' => 14, 'mini' => 91]
    ];

    $SC[] = [
        'array_1' => ['range' => range(0, 1), 'norm' => 2, 'mini' => "<1"],
        'array_2' => ['range' => range(2, 4), 'norm' => 3, 'mini' => 1],
        'array_3' => ['range' => range(5, 8), 'norm' => 4, 'mini' => 2],
        'array_4' => ['range' => range(9, 11), 'norm' => 5, 'mini' => 3],
        'array_5' => ['range' => range(12, 13), 'norm' => 6, 'mini' => 9],
        'array_6' => ['range' => range(14, 16), 'norm' => 7, 'mini' => 16],
        'array_7' => ['range' => range(17, 18), 'norm' => 8, 'mini' => 25],
        'array_8' => ['range' => range(19, 21), 'norm' => 9, 'mini' => 37],
        'array_9' => ['range' => range(22, 23), 'norm' => 10, 'mini' => 50],
        'array_10' => ['range' => range(24, 25), 'norm' => 11, 'mini' => 63],
        'array_11' => ['range' => range(26, 27), 'norm' => 12, 'mini' => 75],
    ];

    $ER[] = [
        'array_1' => ['range' => range(0, 1), 'norm' => 3, 'mini' => 1],
        'array_2' => ['range' => range(2, 4), 'norm' => 4, 'mini' => 2],
        'array_3' => ['range' => range(5, 6), 'norm' => 5, 'mini' => 3],
        'array_4' => ['range' => range(7, 8), 'norm' => 6, 'mini' => 9],
        'array_5' => ['range' => range(9, 10), 'norm' => 7, 'mini' => 16],
        'array_6' => ['range' => range(11, 12), 'norm' => 8, 'mini' => 25],
        'array_7' => ['range' => range(13, 14), 'norm' => 9, 'mini' => 37],
        'array_8' => ['range' => range(15, 16), 'norm' => 10, 'mini' => 50],
        'array_9' => ['range' => range(17, 18), 'norm' => 11, 'mini' => 63],
        'array_10' => ['range' => range(19, 20), 'norm' => 12, 'mini' => 75],
        'array_11' => ['range' => range(21, 22), 'norm' => 13, 'mini' => 84],
        'array_12' => ['range' => range(23, 24), 'norm' => 14, 'mini' => 91],
    ];

    $CS[] = [
        'array_1' => ['range' => range(0, 0), 'norm' => 5, 'mini' => 3],
        'array_2' => ['range' => range(1, 1), 'norm' => 6, 'mini' => 9],
        'array_3' => ['range' => range(2, 3), 'norm' => 7, 'mini' => 16],
        'array_4' => ['range' => range(4, 6), 'norm' => 8, 'mini' => 25],
        'array_5' => ['range' => range(7, 8), 'norm' => 9, 'mini' => 37],
        'array_6' => ['range' => range(9, 10), 'norm' => 10, 'mini' => 50],
        'array_7' => ['range' => range(11, 13), 'norm' => 11, 'mini' => 63],
        'array_8' => ['range' => range(14, 15), 'norm' => 12, 'mini' => 75],
        'array_9' => ['range' => range(16, 17), 'norm' => 13, 'mini' => 84],
        'array_10' => ['range' => range(18, 19), 'norm' => 14, 'mini' => 91],
        'array_11' => ['range' => range(20, 21), 'norm' => 15, 'mini' => 95],
    ];

    $MS[] = [
        'array_1' => ['range' => range(0, 0), 'norm' => 5, 'mini' => 3],
        'array_2' => ['range' => range(1, 2), 'norm' => 6, 'mini' => 9],
        'array_3' => ['range' => range(3, 4), 'norm' => 7, 'mini' => 16],
        'array_4' => ['range' => range(5, 5), 'norm' => 8, 'mini' => 25],
        'array_5' => ['range' => range(6, 7), 'norm' => 9, 'mini' => 37],
        'array_6' => ['range' => range(8, 9), 'norm' => 10, 'mini' => 50],
        'array_7' => ['range' => range(10, 11), 'norm' => 11, 'mini' => 63],
        'array_8' => ['range' => range(12, 13), 'norm' => 12, 'mini' => 75],
        'array_9' => ['range' => range(14, 15), 'norm' => 13, 'mini' => 84],
        'array_10' => ['range' => range(16, 16), 'norm' => 14, 'mini' => 91],
        'array_11' => ['range' => range(17, 18), 'norm' => 15, 'mini' => 95],
        'array_12' => ['range' => range(19, 20), 'norm' => 16, 'mini' => 98],
        'array_13' => ['range' => range(21, 21), 'norm' => 17, 'mini' => 99],
    ];

    switch ($cat) {
        case 'RB':
            $cat = $RB;
            break;
        case 'SI':
            $cat = $SI;
            break;
        case 'SC':
            $cat = $SC;
            break;
        case 'ER':
            $cat = $ER;
            break;
        case 'CS':
            $cat = $CS;
            break;
        case 'MS':
            $cat = $MS;
            break;
        default:
            return false;
            break;
    }

    foreach ($cat as $value) {
        foreach ($value as $one_value) {
            if (in_array($num, $one_value['range'])) {
                $norm =  $one_value['norm'];
                $mini =  $one_value['mini'];
                return $norm;
            }
        }
    }
}

function calc_all($RB, $SI, $SC, $ER, $CS, $MS)
{
    $autism_degree = array_merge([43, 44], [46, 47], [49, 50], [52, 53], [55, 56], [58, 59], range(61, 63), [65, 66], [68, 69], [71, 72], [74, 75], [77, 78], [80, 81], [83, 84], [86, 87], [89, 90], [92, 93, 94], [96, 97], [99, 100], [102, 103], [105, 106], [108, 109], [111, 112], [114, 115], [117, 118], range(120, 122),  [124, 125], [127, 128], [130, 131], [133, 134], [136, 137], [139, 140]);
    $result = range(21, 87);
    $norm = [$RB, $SI, $SC, $ER, $CS, $MS];
    $norm_sum = array_sum($norm);
    foreach ($result as $key => $value) {
        if ($value == $norm_sum) {
            return $autism_degree[$key];
        }
    }
}
$autism_degree = array_merge([43, 44], [46, 47], [49, 50], [52, 53], [55, 56], [58, 59], range(61, 63), [65, 66], [68, 69], [71, 72], [74, 75], [77, 78], [80, 81], [83, 84], [86, 87], [89, 90], [92, 93, 94], [96, 97], [99, 100], [102, 103], [105, 106], [108, 109], [111, 112], [114, 115], [117, 118], range(120, 122),  [124, 125], [127, 128], [130, 131], [133, 134], [136, 137], [139, 140]);
// echo "<pre>";
// print_r($autism_degree);
// echo "</pre>";
$RB = calc_cat(10, 'RB');
$SI = calc_cat(5, 'SI');
$SC = calc_cat(8, 'SC');
$ER = calc_cat(2, 'ER');
$CS = calc_cat(7, 'CS');
$MS = calc_cat(6, 'MS');

echo calc_all($RB, $SI, $SC, $ER, $CS, $MS);


// $calc_scale = new calc_scale;
// $res = $calc_scale->calc_cat(10, "RB");
// echo $res;


echo "<pre>";
print_r($_SESSION);
echo "</pre>";

// echo "<pre>";
// print_r($result);
// echo "</pre>";


// $cat = range(0, 6);
// $num = 9;
// if (in_array($num, $cat)) {
//     echo "done";
// } else {
//     echo "no";
// }
// $array = range(0, 39);
// $chunk = array_chunk($array, 3);
// echo "<pre>";
// print_r($chunk);
// echo "</pre>";

// $RB[] = [
//     'array_1' => ['range' => range(0, 3), 'result' => 4],
//     'array_2' => [range(4, 6), 5],
//     'array_3' => [range(7, 9), 6],
//     'array_4' => [range(10, 13), 7],
//     'array_5' => [range(14, 16), 8],
//     'array_6' => [range(17, 19), 9],
//     'array_7' => [range(20, 22), 10],
//     'array_8' => [range(23, 26), 11],
//     'array_9' => [range(27, 29), 12],
//     'array_10' => [range(30, 32), 13],
//     'array_11' => [range(33, 36), 14],
//     'array_12' => [range(37, 39), 15],
// ];

// echo "<pre>";
// print_r($RB);
// echo "</pre>";

// foreach ($RB as $key => $value) {
//     foreach ($value as $one_value) {
//         if (in_array($num, $one_value[0])) {
//             echo $one_value[1];
//         }
//     }
// }