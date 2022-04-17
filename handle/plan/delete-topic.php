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

if ($request->getHas('delete_topic_strength') && $request->getHas('patient_id')) {
    $topic_id = $request->get('delete_topic_strength');
    $patient_id = $request->get('patient_id');
    $result = $strength_point->delete("id = $topic_id");
    $request->redirect("plan.php?patientid=$patient_id");
} elseif ($request->getHas('delete_topic_weaknees') && $request->getHas('patient_id')) {
    $topic_id = $request->get('delete_topic_weaknees');
    $patient_id = $request->get('patient_id');
    $result = $weknees_point->delete("id = $topic_id");
    $request->redirect("plan.php?patientid=$patient_id");
} elseif ($request->getHas('delete_long_term') && $request->getHas('patient_id')) {
    $topic_id = $request->get('delete_long_term');
    $patient_id = $request->get('patient_id');
    $result = $long_term->delete("id = $topic_id");
    $request->redirect("plan.php?patientid=$patient_id");
} elseif ($request->getHas('delete_short_term') && $request->getHas('patient_id')) {
    $topic_id = $request->get('delete_short_term');
    $patient_id = $request->get('patient_id');
    $result = $short_term->delete("id = $topic_id");
    $request->redirect("plan.php?patientid=$patient_id");
}