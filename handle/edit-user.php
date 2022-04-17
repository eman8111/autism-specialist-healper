<?php

use Project\Classes\Models\Users;

require_once("../app.php");

$user = new Users;
$user_id = $session->get('user_id');

if ($request->postHas('edit_user')) {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
    $user_name = $request->post('user_name');
    $user_email = $request->post('user_email');
    $user_gender = $request->post('user_gender');
    $user_pic = $request->files('user_pic');

    if ($user_pic['name'] != null) {
        $pic_name = $user_pic['name'];
        $pic_type = $user_pic['type'];
        $pic_tmp_name = $user_pic['tmp_name'];
        // Uniq Name
        $random = uniqid();
        $extention = pathinfo($pic_name, PATHINFO_EXTENSION);
        $uniq_pic_name = "$random.$extention";
        move_uploaded_file($pic_tmp_name, PATH . "assets/images/uploads/users/$uniq_pic_name");
        // Insert in Database
        $query = "UPDATE users SET `name` = '$user_name' , gender = '$user_gender' , photo = '$uniq_pic_name' , email = '$user_email'  WHERE users.id = $user_id";
        $res = $user->query($query);
        echo "img <br>";
    } else {
        // Insert in Database
        echo "done <br>";
        $query = "UPDATE users SET `name` = '$user_name' , gender = '$user_gender', email = '$user_email'  WHERE users.id = $user_id";
        $res = $user->query($query);
    }

    var_dump($res);
    $request->redirect('user-profile.php');
}