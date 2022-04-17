<?php

use Project\Classes\Models\specialist;

require_once("../app.php");

$specialist = new specialist;
$specialist_id = $session->get('specialist_id');

if ($request->postHas('edit_specialist')) {
    $specialist_name = $request->post('specialist_name');
    $specialist_email = $request->post('specialist_email');
    $specialist_gender = $request->post('specialist_gender');
    $specialist_number = $request->post('specialist_number');
    $specialist_pic = $request->files('specialist_pic');

    if ($specialist_pic['name'] != null) {
        $pic_name = $specialist_pic['name'];
        $pic_type = $specialist_pic['type'];
        $pic_tmp_name = $specialist_pic['tmp_name'];

        $select_specialist = $specialist->selectId("*", "$specialist_id");
        $specialist_img = $select_specialist['photo'];
        unlink(PATH . "assets/images/uploads/specialist/$specialist_img");
        // Uniq Name
        $random = uniqid();
        $extention = pathinfo($pic_name, PATHINFO_EXTENSION);
        $uniq_pic_name = "$random.$extention";
        move_uploaded_file($pic_tmp_name, PATH . "assets/images/uploads/specialist/$uniq_pic_name");
        // Insert in Database
        $query = "UPDATE specialist SET `name` = '$specialist_name' , gender = '$specialist_gender' , photo = '$uniq_pic_name' , email = '$specialist_email' , phone = $specialist_number WHERE specialist.id = $specialist_id";
        $res = $specialist->query($query);
        echo "img <br>";
    } else {
        // Insert in Database
        echo "done <br>";
        $query = "UPDATE specialist SET `name` = '$specialist_name' , gender = '$specialist_gender', email = '$specialist_email' , phone = '$specialist_number'  WHERE specialist.id = $specialist_id";
        $res = $specialist->query($query);
    }

    var_dump($res);
    $request->redirect('specialist-profile.php');
}