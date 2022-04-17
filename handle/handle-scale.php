<?php

use Project\Classes\Models\scale_questions;
use Project\Classes\Models\scale_result;

require_once("../app.php");

$scale_question = new scale_questions;
$scale_question_arr = $scale_question->selectAll();

$scale_result_arr = new scale_result;

if ($request->postHas('scale_question')) {

    $patient_id = $session->get('patient_id');

    foreach ($_POST as $key => $record) {
        if (strpos($key, 'question_') !== false) {
            $question_id = str_replace('question_', '', $key);
            $record = (int)$record;
            $scale_result = $scale_result_arr->insert(("scale_question_result , scale_question_id , patient_id"), (" $record , $question_id , $patient_id"));
            var_dump($scale_result);
        }
    }
    $request->redirect("diagnosis.php?patientid=$patient_id");
}