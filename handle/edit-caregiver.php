<?php

use Project\Classes\Models\caregiver;

require_once("../app.php");

$caregiver = new caregiver;
$caregiver_id = $session->get('caregiver_id');

if ($request->postHas('edit_caregiver')) {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
    $caregiver_name = $request->post('caregiver_name');
    $caregiver_email = $request->post('caregiver_email');
    $caregiver_gender = $request->post('caregiver_gender');
    $caregiver_number = $request->post('caregiver_number');
    $caregiver_pic = $request->files('caregiver_pic');

    if ($caregiver_pic['name'] != null) {
        $pic_name = $caregiver_pic['name'];
        $pic_type = $caregiver_pic['type'];
        $pic_tmp_name = $caregiver_pic['tmp_name'];

        $select_caregiver = $caregiver->selectId("*", "$caregiver_id");
        $caregiver_img = $select_caregiver['photo'];
        unlink(PATH . "assets/images/uploads/caregiver/$caregiver_img");
        // Uniq Name
        $random = uniqid();
        $extention = pathinfo($pic_name, PATHINFO_EXTENSION);
        $uniq_pic_name = "$random.$extention";
        move_uploaded_file($pic_tmp_name, PATH . "assets/images/uploads/caregiver/$uniq_pic_name");
        // Insert in Database
        $query = "UPDATE caregiver SET `name` = '$caregiver_name' , gender = '$caregiver_gender' , photo = '$uniq_pic_name' , email = '$caregiver_email' , phone = $caregiver_number WHERE caregiver.id = $caregiver_id";
        $res = $caregiver->query($query);
        echo "img <br>";
    } else {
        // Insert in Database
        echo "done <br>";
        $query = "UPDATE caregiver SET `name` = '$caregiver_name' , gender = '$caregiver_gender', email = '$caregiver_email' , phone = '$caregiver_number'  WHERE caregiver.id = $caregiver_id";
        $res = $caregiver->query($query);
    }

    var_dump($res);
    $request->redirect('caregiver-profile.php');
}