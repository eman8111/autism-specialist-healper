<?php

use Project\Classes\Models\schedule;
use Project\Classes\Models\notify_schedule;

require_once('../app.php');
$schedule = new schedule;
$notify_schedule = new notify_schedule;

$patient_id = $session->get('patient_id');
$specialist_id = $session->get('specialist_id');
$caregiver_id = $session->get('caregiver_id');

if ($request->postHas('add-schedule')) {

    foreach ($_POST as $key => $record) {
        if (strpos($key, 'datetime_') !== false) {
            $date_no = str_replace('datetime_', '', $key);
            echo $record . "<br>";
            if ($caregiver_id != null) {
                $schedule->insert("schedule_date_time , specialist_id, caregiver_id , patient_id", "'$record'  , $specialist_id , $caregiver_id , $patient_id");
                $notify_schedule->insert("schedule_date_time , specialist_id, caregiver_id , patient_id", "'$record'  , $specialist_id , $caregiver_id , $patient_id");
            } else {
                $schedule->insert("schedule_date_time , specialist_id , patient_id", "'$record'  , $specialist_id  , $patient_id");
                $notify_schedule->insert("schedule_date_time , specialist_id , patient_id", "'$record'  , $specialist_id  , $patient_id");
            }
            $request->redirect("patient-profile.php?patientid=$patient_id");
        }
    }
} elseif ($request->getHas('schedule_id')) {
    $schedule_id = $request->get('schedule_id');
    $schedule->delete("id = $schedule_id ");
    $request->redirect("specialist.php");
} elseif ($request->getHas('notify_id')) {
    $schedule_id = $request->get('notify_id');
    $notify_schedule->delete("id = $schedule_id");
    $request->redirect("caregiver.php");
} else {
    $request->redirect("patient-profile.php?patientid=$patient_id");
}