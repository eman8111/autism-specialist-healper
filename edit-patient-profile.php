<?php

use Project\Classes\Models\patient;

require_once('include/header.php');
require_once('include/navbar.php');

$patient_id = $request->get('patientid');

$patient = new patient;
$select_patient = $patient->selectId("*", "$patient_id");
?>

<div class="edit-patient pt-120 pb-80">
    <div class="container">
        <h2 class="text-center mb-1">Edit Patient </h2>
        <div class="line bg-yellow m-auto mb-5"></div>
        <div class="row justify-content-center">
            <form action="handle/patient.php" method="POST" enctype="multipart/form-data">
                <?php if (!empty($select_patient['photo'] == null)) { ?>
                <?php if ($select_patient['gender'] == "male") { ?>
                <div class="col-lg-2 m-auto">
                    <img src="<?= URL; ?>assets/images/user-male.jpg" alt="" class="rounded img-fluid mb-2"
                        id="imgshow">
                </div>
                <div class="col-4 m-auto">
                    <div class="mb-3">
                        <input type="file" class="form-control" name="patient_pic" id="imgload">
                    </div>
                </div>
                <?php } else { ?>
                <div class="col-lg-2 m-auto">
                    <img src="<?= URL; ?>assets/images/user-female.jpg" alt="" class="rounded img-fluid mb-2"
                        id="imgshow">
                </div>
                <div class="col-4 m-auto">
                    <div class="mb-3">
                        <input type="file" class="form-control" name="patient_pic" id="imgload">
                    </div>
                </div>
                <?php } ?>
                <?php } else { ?>
                <div class="col-4 col-lg-2 m-auto">
                    <img src="<?= URL; ?>assets/images/uploads/patients/<?= $select_patient['photo'] ?>" alt=""
                        class="rounded img-fluid mb-2" id="imgshow">
                </div>
                <div class="col-4 m-auto">
                    <div class="mb-3">
                        <input type="file" class="form-control" name="patient_pic" id="imgload">
                    </div>
                </div>
                <?php } ?>
                <div class="w-100"></div>
                <div class="row justify-content-center mt-40">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label dark-text">
                                Name</label>
                            <input type="text" name="patient_name" class="form-control bg-white"
                                value="<?= $select_patient['name'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label dark-text">Date of
                                Birth </label>
                            <input type="date" name="patient_date" class="form-control bg-white"
                                value="<?= $select_patient['date_of_birth'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label dark-text d-block">Gender </label>
                            <select name="patient_gender" class="form-select form-control bg-white"
                                aria-label="Default select example">
                                <?php if ($select_patient['gender'] == 'male') { ?>
                                <option value="male" selected>Male</option>
                                <?php } else { ?>
                                <option value="male">Male</option>
                                <?php } ?>
                                <?php if ($select_patient['gender'] == 'female') { ?>
                                <option value="female" selected>female</option>
                                <?php } else { ?>
                                <option value="female">female</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label dark-text">Class</label>
                            <input type="text" name="patient_class" class="form-control bg-white"
                                value="<?= $select_patient['class'] ?>">
                        </div>
                    </div>

                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label dark-text">School</label>
                            <input type="text" name="patient_school" class="form-control bg-white"
                                value="<?= $select_patient['school'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label dark-text"> Number
                                of brothers </label>
                            <input type="number" name="No_of_bro" class="form-control bg-white"
                                value="<?= $select_patient['No_of_bro'] ?>">
                        </div>
                    </div>

                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label dark-text"> Rank
                                among brothers </label>
                            <input type="number" name="arr_btw_bro" class="form-control bg-white"
                                value="<?= $select_patient['arr_btw_bro'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label dark-text">Caregiver
                                name</label>
                            <input type="text" name="caregiver_name" class="form-control bg-white"
                                value="<?= $select_patient['caregiver_name'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label dark-text">Relationship
                                with patient since </label>
                            <input type="number" name="caregiver_relationship" class="form-control bg-white"
                                value="<?= $select_patient['caregiver_relationship'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label dark-text">Phone
                                number</label>
                            <input type="number" name="caregiver_number" class="form-control bg-white"
                                value="<?= $select_patient['caregiver_phone'] ?>">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="patient_id" value="<?= $patient_id ?>">
                <div class="col-md-10">
                    <button type="submit" name="edit_patient" class="secondary-btn float-end btn mt-25">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once('include/footer.php');
?>