<?php

use Project\Classes\Models\lovaas_questions;
use Project\Classes\Models\lovaas_results;

require_once("../app.php");

$lovaas_questions = new lovaas_questions;
$lovaas_questions_arr = $lovaas_questions->selectAll();

$lovaas_results_arr = new lovaas_results;

if ($request->postHas('lovaas_questions')) {

    $patient_id = $session->get('patient_id');

    foreach ($_POST as $key => $record) {
        if (strpos($key, 'radio_') !== false) {
            $question_id = str_replace('radio_', '', $key);
            $lovaas_results = $lovaas_results_arr->insert(("lovaas_question_result , lovaas_question_id , patient_id "), ("'$record' , $question_id , $patient_id"));
<<<<<<< HEAD
            echo "$question_id - $record <br>";
        }
    }
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    // $request->redirect("diagnosis.php?patientid=$patient_id");
=======
        }
    }
    $request->redirect("diagnosis.php?patientid=$patient_id");
}


if ($request->postHas('add_comment')) {
    echo "add_comment";
>>>>>>> cc1bfaa74fe0f70ef60f422a267213c951a16272
}