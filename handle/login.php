<?php

use Project\Classes\Models\caregiver;
use Project\Classes\Models\specialist;
use Project\Classes\Models\Users;

require_once('../app.php');

$user = new Users;
$specialist = new specialist;
$caregiver = new caregiver;

if ($request->postHas('login')) {
    $email = $request->post('email');
    $password = $request->post('password');
    $choose = $request->post('choose');

    switch ($choose) {
        case 'user':
            $run_query = $user->select("*", "email = '$email' ");
            if (mysqli_num_rows($run_query) > 0) {
                $userDetails = mysqli_fetch_assoc($run_query);
                $isCorrect = password_verify($password, $userDetails['password']);
                if ($isCorrect) {
                    $session->set('user_id', $userDetails['id']);
                    $session->set('which_user', $choose);
                    setcookie("email", "$email");
                    $request->redirect('user.php');
                } else {
                    $session->set('login_errors', 'Password is not correct');
                    $request->redirect('index.php');
                }
            } else {
                $session->set('login_errors', 'Email is not correct');
                $request->redirect('index.php');
            }
            break;
        case 'specialist':
            $run_query = $specialist->select("*", "email = '$email'");
            if (mysqli_num_rows($run_query) > 0) {
                $specialistDetails = mysqli_fetch_assoc($run_query);
                $isCorrect = password_verify($password, $specialistDetails['password']);
                if ($isCorrect) {
                    $session->set('specialist_id', $specialistDetails['id']);
                    $session->set('which_user', $choose);
                    $request->redirect('specialist.php');
                } else {
                    $session->set('login_errors', 'Password is not correct');
                    $request->redirect('index.php');
                }
            } else {
                $session->set('login_errors', 'Email is not correct');
                $request->redirect('index.php');
            }
            break;
        case 'caregiver':
            $run_query = $caregiver->select("*", "email = '$email'");
            if (mysqli_num_rows($run_query) > 0) {
                $caregiverDetails = mysqli_fetch_assoc($run_query);
                $isCorrect = password_verify($password, $caregiverDetails['password']);
                if ($isCorrect) {
                    $session->set('caregiver_id', $caregiverDetails['id']);
                    $session->set('which_user', $choose);
                    $request->redirect('caregiver.php');
                } else {
                    $session->set('login_errors', 'Password is not correct');
                    $request->redirect('index.php');
                }
            } else {
                $session->set('login_errors', 'Email is not correct');
                $request->redirect('index.php');
            }
            break;

        default:
            $request->redirect('index.php');
            break;
    }
} else {
    $request->redirect('index.php');
}