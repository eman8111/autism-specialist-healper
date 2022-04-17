<?php

use Project\Classes\Models\caregiver;
use Project\Classes\Models\notify_schedule;
use Project\Classes\Models\notify_to_do;
use Project\Classes\Models\patient;
use Project\Classes\Models\schedule;
use Project\Classes\Models\specialist;
use Project\Classes\Models\to_do;
use Project\Classes\Models\Users;

require_once('../app.php');

$specialist = new specialist;
$caregiver = new caregiver;
$users = new Users;
$patients = new patient;
$schedule = new schedule;
$notify_schedule = new notify_schedule;
$to_do = new to_do;
$notify_to_do = new notify_to_do;


if ($request->postHas('reg')) {
    $name = $request->post('name');
    $email = $request->post('email');
    $password = $request->post('password');
    $re_password = $request->post('re-password');
    $choose = $request->post('choose');
    $sp_serial_no  = $request->post('sp_serial_no');
    $patient_id  = $request->post('patient_id');

    if ($password != $re_password) {
        $session->set('reg_errors', 'The two passwords do not match');
        $request->redirect('index.php');
    } else {
        switch ($choose) {
            case 'specialist':
                $select_specialist = $specialist->select("email", "email = '$email'");
                $select_specialist_row = mysqli_fetch_assoc($select_specialist);
                if ($select_specialist_row['email'] === $email) {
                    $session->set('reg_errors', 'Email already exists');
                    $request->redirect('index.php');
                } else {
                    $serial_no = uniqid();
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $specialist->insert(("serial_no ,name , email , password"), (" '$serial_no ', '$name' , '$email' , '$password'"));
                    $session->set('sucsses_reg', 'You are now logged in');
                    $request->redirect('index.php');
                }
                break;
            case 'user':
                $select_user = $users->select("email", "email = '$email'");
                $select_user_row = mysqli_fetch_assoc($select_user);
                if ($select_user_row['email'] === $email) {
                    $session->set('reg_errors', 'Email already exists');
                    $request->redirect('index.php');
                } else {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $users->insert(("name , email , password"), ("'$name' , '$email' , '$password'"));
                    $session->set('sucsses_reg', 'You are now logged in');
                    $request->redirect('index.php');
                }
                break;
            case 'caregiver':
                //Caregiver
                $select_caregiver = $caregiver->select("email", "email = '$email'");
                $select_caregiver_row = mysqli_fetch_assoc($select_caregiver);
                //Specialist
                $select_specialist = $specialist->select("serial_no", "serial_no = '$sp_serial_no'");
                $select_specialist_row = mysqli_fetch_assoc($select_specialist);
                // patient
                $select_patient_row = $patients->selectId("*", $patient_id);
                if ($select_caregiver_row['email'] === $email) {
                    $session->set('reg_errors', 'Email already exists');
                    $request->redirect('index.php');
                } elseif ($select_specialist_row['serial_no'] != $sp_serial_no) {
                    $session->set('reg_errors', 'The Serial number is invalid');
                    $request->redirect('index.php');
                } elseif ($select_patient_row['id'] != $patient_id) {
                    $session->set('reg_errors', 'The id not found');
                    $request->redirect('index.php');
                } else {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $res = $caregiver->insert(("sp_serial_no , name , email , password"), ("'$sp_serial_no','$name' , '$email' , '$password'"));
                    $query = "SELECT * FROM `caregiver` WHERE sp_serial_no = '$sp_serial_no' AND name = '$name'  AND email = '$email' AND password = '$password'";
                    $run_query = $caregiver->query($query);
                    $caregiver_just_reg = mysqli_fetch_assoc($run_query);
                    $caregiver_just_reg_id = $caregiver_just_reg['id'];
                    // update_patient
                    $update_patient = $patients->update("caregiver_id = $caregiver_just_reg_id", "id = $patient_id");
                    // update schedule
                    $update_schedule = $schedule->update("caregiver_id = $caregiver_just_reg_id", "patient_id = $patient_id");
                    // update notify schedule
                    $update_notify_schedule = $notify_schedule->update("caregiver_id = $caregiver_just_reg_id", "patient_id = $patient_id");
                    // update to_do
                    $update_to_do = $to_do->update("caregiver_id = $caregiver_just_reg_id", "patient_id = $patient_id");
                    // update notify_to_do
                    $update_notify_to_do = $notify_to_do->update("caregiver_id = $caregiver_just_reg_id", "patient_id = $patient_id");
                    $session->set('sucsses_reg', 'You are now logged in');
                    var_dump($res);
                    $request->redirect('index.php');
                }
                break;
            default:
                $request->redirect('index.php');
                break;
        }
    }
} else {
    $request->redirect('index.php');
}