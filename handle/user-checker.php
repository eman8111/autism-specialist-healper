<?php

use Project\Classes\Models\autism_checker;
use Project\Classes\Models\autism_checker_results;

require_once('../app.php');
$user_id = $session->get('user_id');
$autism_checker = new autism_checker;
$autism_checker_results = new autism_checker_results;

if ($request->postHas('user-checker')) {
    $name = $request->post('name');
    $age = $request->post('age');
    $choose = $request->post('choose');
    $now = date("Y-m-d H:i:a.u");
    $autism_checker->insert(("case_name , age , gender , user_id"), (" '$name' , $age , '$choose' , $user_id "));
    $query = "SELECT * FROM `autism_checker` WHERE case_name = '$name' AND age = $age AND gender = '$choose' AND user_id = $user_id GROUP BY created_at DESC LIMIT 1";
    $run_query = $autism_checker->query($query);
    $select_case = mysqli_fetch_assoc($run_query);
    $case_id = $select_case['id'];

    echo "<pre>";
    print_r($select_case);
    echo "</pre>";

    foreach ($_POST as $key => $record) {
        if (strpos($key, 'question_') !== false) {
            $question_id = str_replace('question_', '', $key);
            $autism_checker_results->insert(("checker_question_result , checker_question_id ,case_id"), ("'$record' , $question_id , $case_id"));
        }
    }

    $request->redirect('user.php');
}