<?php
require_once('include/header.php');
require_once('include/navbar.php');

use Project\Classes\Models\specialist;

$specialist = new specialist;
$specialist_id = $session->get('specialist_id');
$select_specialist = $specialist->selectId("*", "$specialist_id");
?>

<div class="user-profile">
    <div class="container pt-120 pb-50">
        <div class="bg-box border rounded p-5">
            <div class="row">
                <h2 class="text-center mb-1">Public profile</h2>
                <p class="text-center">Add information about yourself </p>
                <div class="line bg-yellow m-auto mb-4"></div>
                <div class="row justify-content-center">
                    <form action="handle/edit-specialist.php" method="POST" enctype="multipart/form-data">
                        <?php if (!empty($select_specialist['photo'] == null)) { ?>
                        <?php if ($select_specialist['gender'] == "female") { ?>
                        <div class="col-lg-4 text-center m-auto">
                            <img src="<?= URL; ?>assets/images/user-female.jpg" alt=""
                                class="rounded shadow img-fluid mb-3" id="imgshow">
                        </div>
                        <div class="col-8 m-auto">
                            <div class="mb-3">
                                <input type="file" class="form-control" name="specialist_pic" id="imgload">
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="col-lg-4 text-center m-auto">
                            <img src="<?= URL; ?>assets/images/user-male.jpg" alt=""
                                class="rounded shadow img-fluid mb-3" id="imgshow">
                        </div>
                        <div class="col-8 m-auto">
                            <div class="mb-3">
                                <input type="file" class="form-control" name="specialist_pic" id="imgload">
                            </div>
                        </div>
                        <?php } ?>
                        <?php } else { ?>
                        <div class="col-4 text-center col-lg-4 m-auto">
                            <img src="<?= URL; ?>assets/images/uploads/specialist/<?= $select_specialist['photo'] ?>"
                                alt="" class="rounded shadow-sm img-fluid mb-3" id="imgshow">
                        </div>
                        <div class="col-8 m-auto">
                            <div class="mb-3">
                                <input type="file" class="form-control" name="specialist_pic" id="imgload">
                            </div>
                        </div>
                        <?php } ?>
                        <div class="w-100"></div>
                        <div class="row justify-content-center mt-40">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label dark-text">
                                        Serial Number</label>
                                    <input id="copy" class="form-control position-relative" type="text"
                                        value="<?= $select_specialist['serial_no'] ?>"
                                        aria-label="Disabled input example" disabled>
                                    <div class="btn-copy" data-clipboard-text="<?= $select_specialist['serial_no'] ?>">
                                        <span><i class="fas fa-copy fa-lg"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label dark-text">
                                        Name</label>
                                    <input type="text" name="specialist_name" class="form-control bg-white"
                                        value="<?= $select_specialist['name'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label dark-text">
                                        Email</label>
                                    <input type="text" name="specialist_email" class="form-control bg-white"
                                        value="<?= $select_specialist['email'] ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label dark-text d-block">Gender
                                    </label>
                                    <select name="specialist_gender" class="form-select form-control bg-white"
                                        aria-label="Default select example">
                                        <?php if ($select_specialist['gender'] == null) { ?>
                                        <option selected>Open this select menu</option>
                                        <?php } ?>
                                        <?php if ($select_specialist['gender'] == 'male') { ?>
                                        <option value="male" selected>Male</option>
                                        <?php } else { ?>
                                        <option value="male">Male</option>
                                        <?php } ?>
                                        <?php if ($select_specialist['gender'] == 'female') { ?>
                                        <option value="female" selected>female</option>
                                        <?php } else { ?>
                                        <option value="female">female</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label dark-text">Phone
                                        number</label>
                                    <input type="number" name="specialist_number" class="form-control bg-white"
                                        id="telephone" value="<?= $select_specialist['phone'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <button type="submit" name="edit_specialist" class="secondary-btn float-end btn mt-25">Save
                                Changes</button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('include/footer.php'); ?>