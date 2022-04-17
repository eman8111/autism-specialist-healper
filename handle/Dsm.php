<?php

use Project\Classes\Models\dsm5_question;
use Project\Classes\Models\dsm_result;

require_once("../app.php");

$dsm5_questions = new dsm5_question;
$dsm_result_arr = new dsm_result;

if ($request->postHas('dsm5_question')) {
    $patient_id = $session->get('patient_id');
    foreach ($_POST as $key => $record) {
        if (strpos($key, 'question_') !== false) {
            $question_id = str_replace('question_', '', $key);
            $dsm_results = $dsm_result_arr->insert(("dsm_question_result , 	dsm_question_id , pateint_id"), ("'$record' , $question_id , $patient_id"));
        }
    }
    $request->redirect("diagnosis.php?patientid=$patient_id");
}