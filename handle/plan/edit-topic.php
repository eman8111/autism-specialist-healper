<?php

use Project\Classes\Models\long_term;
use Project\Classes\Models\short_term;
use Project\Classes\Models\weknees_point;
use Project\Classes\Models\strength_point;

require_once("../../app.php");

$strength_point = new strength_point;
$weknees_point = new weknees_point;
$long_term = new long_term;
$short_term = new short_term;

if ($request->post('edit_topic_strength')) {
    $question_id = $request->post('question_id');
    $patient_id = $request->post('patient_id');
    $topic  = $request->post('topic');
    $results =  $strength_point->update("strength_point_description = '$topic'", "id = $question_id");
    $request->redirect("plan.php?patientid=$patient_id");
} elseif ($request->post('edit_topic_weaknees')) {
    $question_id = $request->post('question_id');
    $patient_id = $request->post('patient_id');
    $topic  = $request->post('topic');
    $results =  $weknees_point->update("weeknees_point_description = '$topic'", "id = $question_id");
    $request->redirect("plan.php?patientid=$patient_id");
} elseif ($request->post('edit_long_term')) {
    $question_id = $request->post('question_id');
    $patient_id = $request->post('patient_id');
    $topic  = $request->post('topic');
    $results =  $long_term->update("long_term_discription = '$topic'", "id = $question_id");
    $request->redirect("plan.php?patientid=$patient_id");
} elseif ($request->post('edit_short_term')) {
    $question_id = $request->post('question_id');
    $patient_id = $request->post('patient_id');
    $topic  = $request->post('topic');
    $results =  $short_term->update("short_term_description = '$topic'", "id = $question_id");
    $request->redirect("plan.php?patientid=$patient_id");
}