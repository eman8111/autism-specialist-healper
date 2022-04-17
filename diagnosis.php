<?php

use Project\Classes\Models\lovaas_category;
use Project\Classes\Models\lovaas_questions;
use Project\Classes\Models\specialist;
// dsm5
use Project\Classes\Models\dsm5_question;
use Project\Classes\Models\dsm5_category;
use Project\Classes\Models\patient;
// scale
use Project\Classes\Models\scale_questions;
use Project\Classes\Models\scale_category;

require_once('include/header.php');
// specialist
$specialist_id = $session->get('specialist_id');
$specialist = new specialist;
$select_specialist = $specialist->selectId("*", $specialist_id);

$patient_id = $request->get('patientid');
$session->set('patient_id', $patient_id);
$patient = new patient;
$select_patient = $patient->selectId("*", "$patient_id");

// Lovaas
$lovaas_category = new lovaas_category;
$lovaas_cats = $lovaas_category->selectAll();
$lovaas_questions = new lovaas_questions;
$lovaas_ques = $lovaas_questions->selectAll();

// Dsm5
$dsm5_question = new dsm5_question;
$dsm_ques = $dsm5_question->selectAll();
$dsm5_category = new dsm5_category;
$dsm_cats = $dsm5_category->selectAll();

// Scale
$scale_questions = new scale_questions;
$scale_ques = $scale_questions->selectAll();
$scale_category = new scale_category;
$scale_cats = $scale_category->selectAll();

$conn = mysqli_connect("localhost", "root", "", "autism");
include('response.php');

require_once('include/navbar.php');
?>
<section class="main-banner text-white d-flex justify-content-center align-items-center text-center">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <h1>Welcome <?= $select_specialist['name'] ?> </h1>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit
                    illum odit doloremque sed distinctio cum sapiente reiciendis modi, soluta minima numquam consectetur
                    iure enim hic.</p>
                <?php if (!empty($_SESSION['display_error'])) {
                    echo $_SESSION['display_error'];
                    $_SESSION['display_error'] = null;
                } ?>
            </div>
        </div>
    </div>
</section>
<!-- select patient -->
<div class="toggle">
    <div class="main-box">
        <div id="patient-info" class="card bg-box" style="width: 18rem;">
            <img src="<?= URL ?>assets/images/uploads/patients/<?= $select_patient['photo'] ?>" class="img-card"
                alt="child">
            <div class="card-body">
                <a href="patient-profile.php?patientid=<?= $select_patient['id'] ?>" class="dark-text">
                    <h5 class="text-center"><?= $select_patient['name'] ?></h5>
                </a>
                <p class="card-text mb-0">Age : <?= $select_patient['age'] ?></p>
                <p class="card-text">Caregiver Name : <?= $select_patient['caregiver_name'] ?></p>
            </div>
        </div>
        <div id="toggle-info" class="button-show text-white p-2">
            <i class="fas fa-info-circle"></i>
            <span class="m-0">Patient info</span>
        </div>
    </div>
</div>
<!-- select patient -->

<div class="list-arr diagnosis py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item head disabled bg-nav" aria-disabled="true">Diagnosis Process</a>
                    <a class="list-group-item list-group-item-action active" id="list-notice-list" data-bs-toggle="list"
                        href="#list-notice" role="tab" aria-controls="notice">Notice</a>
                    <a class="list-group-item list-group-item-action" id="list-attched-report-list"
                        data-bs-toggle="list" href="#list-attched-report" role="tab"
                        aria-controls="attched-report">Attched Reports</a>
                    <a class="list-group-item list-group-item-action" id="list-evaluation-history-list"
                        data-bs-toggle="list" href="#list-evaluation-history" role="tab"
                        aria-controls="evaluation-history">Evaluation History</a>
                    <a class="list-group-item list-group-item-action" id="list-dsm-list" data-bs-toggle="list"
                        href="#list-dsm" role="tab" aria-controls="dsm">DSM 5</a>
                    <a class="list-group-item list-group-item-action" id="list-scale-list" data-bs-toggle="list"
                        href="#list-scale" role="tab" aria-controls="scale">Scale</a>
                    <a class="list-group-item list-group-item-action" id="list-scale-lovaas" data-bs-toggle="list"
                        href="#list-lovaas" role="tab" aria-controls="lovaas">Lovaas</a>
                    <a class="list-group-item list-group-item-action" id="list-scale-schedule" data-bs-toggle="list"
                        href="#list-schedule" role="tab" aria-controls="schedule">Schedule</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content bg-box pb-2 mt-lg-0 mt-5" id="nav-tabContent">
                    <!-- Notice -->
                    <div class="tab-pane fade show active bg-box" id="list-notice" role="tabpanel"
                        aria-labelledby="list-notice-list">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-notice-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-notice" type="button" role="tab" aria-controls="pills-notice"
                                    aria-selected="true">Notice</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-adir-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-adir" type="button" role="tab" aria-controls="pills-adir"
                                    aria-selected="false">ADIR</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <!-- Notices -->
                            <div class="tab-pane fade show active p-lg-5 p-2" id="pills-notice" role="tabpanel"
                                aria-labelledby="pills-notice-tab">
                                <div class="accordion" id="accordionExample">
                                    <form method="POST" id="form">
                                        <?php
                                        $sql2 = 'SELECT notic_questions.notic_question_category FROM `notic_questions` 
                                                GROUP BY notic_question_category';
                                        $result2 = $conn->query($sql2);
                                        if ($result2->num_rows > 0) {
                                            $count = 0;
                                            $i = 0;
                                            while ($row2 = $result2->fetch_assoc()) {
                                        ?>
                                        <div class="accordion-item">
                                            <div class="d-flex accordion-button collapsed" data-bs-toggle="collapse"
                                                data-bs-target="#collapse<?= $i ?>" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <div class="col-lg">
                                                    <h6 class="m-0">
                                                        <?php echo $row2['notic_question_category'];
                                                                ?>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div id="collapse<?= $i ?>" class="accordion-collapse collapse"
                                                aria-labelledby="heading<?= $i ?>" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="container p-0 overflow-hidden">
                                                        <div class="row bg-white rounded p-4">
                                                            <?php
                                                                    $sql3 = 'SELECT * FROM `notic_questions` WHERE notic_question_category="' . $row2['notic_question_category'] . '" ';
                                                                    $result3 = $conn->query($sql3);

                                                                    if ($result3->num_rows > 0) {
                                                                        while ($row3 = $result3->fetch_assoc()) {
                                                                    ?>
                                                            <div class="form-check">
                                                                <?php
                                                                                echo "<input class='form-check-input' name='result[" . $count . "]' value='1' type='checkbox'/>";
                                                                                echo "<input type='hidden' name='patient_id' value='" . $_GET['patientid'] . "' >";
                                                                                ?>
                                                                <label class="form-check-label">
                                                                    <?php echo $row3['notice_questions'];
                                                                                    echo '<input type="hidden" name="notic_q_id[]" value="' . $row3['id'] . '" >';
                                                                                    echo '<input type="hidden" name="notic_category[]" value="' . $row3['notic_question_category'] . '">';
                                                                                    ?>
                                                                </label>
                                                            </div>
                                                            <?php
                                                                            $count++;
                                                                        }
                                                                    } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                        <input type="submit" class="secondary-btn float-end btn mt-4" value="Done"
                                            name="Insert_notic" />
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>

                            <!-- ADIR -->
                            <div class="tab-pane fade show p-lg-5 p-2" id="pills-adir" role="tabpanel"
                                aria-labelledby="pills-adir-tab">
                                <div class="m-hight pe-4">
                                    <form method="POST">
                                        <?php
                                        $sql1 = 'SELECT * FROM `adir`';
                                        $result = $conn->query($sql1);
                                        if ($result->num_rows > 0) {
                                            $x = 0;
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <div class="row bg-white rounded p-4 mb-4">
                                            <div class="col-md-10">

                                                <?php
                                                        echo $row['adir_questions'];
                                                        echo '<input type="hidden" name="adir_id' . $x . '" value="' . $row['id'] . '">';

                                                        ?>
                                            </div>
                                            <div class="col-md-2 ">
                                                <div class="form-check">

                                                    <input class="form-check-input" type="radio" value="1"
                                                        name="result<?php echo $x ?>">
                                                    <label class="form-check-label">Yes</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="0"
                                                        name="result<?php echo $x ?>">
                                                    <label class="form-check-label">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                echo "<input type='hidden' name='adir_size' value='" . $x . "' >";
                                                echo "<input type='hidden' name='patient_id' value='" . $_GET['patientid'] . "' >";
                                                $x++;
                                            }
                                        } ?>
                                </div>
                                <span id="availability" class="float-start btn mt-4"> </span>
                                <input type="submit" class="secondary-btn float-end btn mt-4" value="Done"
                                    name="Insert_Adir" />
                                <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Attached Report -->
                    <div class="tab-pane fade bg-box rounded p-5" id="list-attched-report" role="tabpanel"
                        aria-labelledby="list-attched-report-list">
                        <div class="m-hight pe-4">
                            <form method="POST" enctype="multipart/form-data">
                                <?php
                                $sql5 = 'SELECT * FROM `attached_reports`';
                                $result5 = $conn->query($sql5);
                                $att_count = 0;
                                if ($result5->num_rows > 0) {
                                    while ($row5 = $result5->fetch_assoc()) {
                                ?>
                                <div class="row justify-content-between align-items-center bg-white rounded p-4 mb-4">
                                    <div class="col-md-10">
                                        <div class="mb-3">
                                            <label for="formFileMultiple" class="form-label">
                                                <?php
                                                        echo $row5['details'];
                                                        echo '<input type="hidden" name="attached_id[]" value="' . $row5['id'] . '" ';
                                                        ?></label>
                                            <!-- <input class="form-control" type="file" name="file[]"> -->
                                            <input type="File" class="form-control" name="uploadfile[]" /> <br>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                            <?php
                                                    echo "<input class='form-check-input' name='result[" . $att_count . "]' value='1' type='checkbox'/>";
                                                    ?>

                                        </div>
                                    </div>
                                </div>
                                <?php $att_count++;
                                    }
                                } ?>
                        </div>
                        <?php echo "<input type='hidden' name='patient_id' value='" . $_GET['patientid'] . "' >"; ?>
                        <input type="submit" class="secondary-btn float-end btn mt-4" value="Done"
                            name="Insert_report" />
                        <div class="clearfix"></div>
                        </form>
                    </div>

                    <!-- Evaluation History -->
                    <div class="tab-pane fade bg-box p-5" id="list-evaluation-history" role="tabpanel"
                        aria-labelledby="list-evaluation-history-list">
                        <div class="m-hight pe-4">
                            <form method="POST">
                                <?php
                                $sql4 = 'SELECT * FROM `evaluation_history`';
                                $result4 = $conn->query($sql4);
                                if ($result4->num_rows > 0) {
                                    $l = 0;
                                    while ($row4 = $result4->fetch_assoc()) {

                                ?>
                                <div class="row bg-white rounded p-4 mb-4">
                                    <div class="col-md-10">
                                        <?php
                                                echo $row4['evaluation_questions'];
                                                echo '<input type="hidden" name="evaluation_id' . $l . '" value="' . $row4['id'] . '">';
                                                ?>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="1"
                                                name="result<?php echo $l ?>">
                                            <label class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="0"
                                                name="result<?php echo $l ?>">
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                        echo "<input type='hidden' name='evaluation_size' value='" . $l . "' >";
                                        $l++;
                                    }
                                } ?>
                        </div>
                        <?php echo "<input type='hidden' name='patient_id' value='" . $_GET['patientid'] . "' >"; ?>
                        <input type="submit" class="secondary-btn float-end btn mt-4" value="Done"
                            name="Insert_Evaluation" />
                        <div class="clearfix"></div>
                        </form>
                    </div>


                    <!-- DSM 5 -->
                    <div class="tab-pane fade bg-box p-5" id="list-dsm" role="tabpanel" aria-labelledby="list-dsm-list">
                        <div class="accordion" id="accordionExample">
                            <form action="handle/Dsm.php" method="post">
                                <?php foreach ($dsm_cats as $dsm_cat) : ?>
                                <div class="accordion-item">
                                    <div class="d-flex accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapse<?= $dsm_cat['id'] ?>" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <div class="col-lg">
                                            <h6 class="m-0"><?= $dsm_cat['dsm_category'] ?></h6>
                                        </div>
                                    </div>
                                    <div id="collapse<?= $dsm_cat['id'] ?>" class="accordion-collapse collapse"
                                        aria-labelledby="heading<?= $dsm_cat['id'] ?>"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <?php $dsm_ques =  $dsm5_question->selectWhere("*", "dsm5_category_id =" . $dsm_cat['id']); ?>
                                            <?php foreach ($dsm_ques as $dsm_que) : ?>
                                            <div class="row bg-white rounded p-4 border-bottom">
                                                <div class="col-md-10">
                                                    <?= $dsm_que['dsm5_questions'] ?>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="question_<?= $dsm_que['id'] ?>" value="yes">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="question_<?= $dsm_que['id'] ?>" value="no">
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach ?>

                                        </div>
                                    </div>
                                </div>
                                <?php endforeach ?>
                                <button name="dsm5_question" type="submit"
                                    class="secondary-btn float-end btn mt-4">Done</button>
                            </form>
                        </div>
                    </div>
                    <!-- Scale -->
                    <div class="tab-pane fade bg-box p-5" id="list-scale" role="tabpanel"
                        aria-labelledby="list-scale-list">
                        <div class="accordion" id="accordionExample">
                            <form action="handle/handle-scale.php" method="post">
                                <?php foreach ($scale_cats as $scale_cat) : ?>
                                <div class="accordion-item">
                                    <div class="d-flex accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapse<?= $scale_cat['id'] ?>" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <div class="col-lg">
                                            <h6 class="m-0"><?= $scale_cat['scale_category'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapse<?= $scale_cat['id'] ?>" class="accordion-collapse collapse"
                                    aria-labelledby="heading<?= $scale_cat['id'] ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php $scale_ques =  $scale_questions->selectWhere("*", "scale_category_id=" . $scale_cat['id']); ?>
                                        <?php foreach ($scale_ques as $scale_que) : ?>
                                        <div class="bg-white rounded border-bottom p-4">
                                            <h6><?= $scale_que['scale_question'] ?></h6>
                                            <div class="row justify-content-center align-items-center text-center p-3">
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline ">
                                                        <input class="form-check-input" type="radio"
                                                            name="question_<?= $scale_que['id'] ?>" value="0">
                                                        <label class="form-check-label"
                                                            for="flexRadioDefault1">0</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline ">
                                                        <input class="form-check-input" type="radio"
                                                            name="question_<?= $scale_que['id'] ?>" value="1">
                                                        <label class="form-check-label" for="inlineCheckbox1">1</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline ">
                                                        <input class="form-check-input" type="radio"
                                                            name="question_<?= $scale_que['id'] ?>" value="2">
                                                        <label class="form-check-label" for="inlineCheckbox1">2</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-inline ">
                                                        <input class="form-check-input" type="radio"
                                                            name="question_<?= $scale_que['id'] ?>" value="3">
                                                        <label class="form-check-label" for="inlineCheckbox1">3</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                <?php endforeach ?>
                        </div>
                        <button name="scale_question" type="submit"
                            class="secondary-btn float-end btn mt-4">Done</button>
                    </div>

                    <!--Lovass-->
                    <div class="tab-pane fade bg-box p-lg-5 p-1" id="list-lovaas" role="tabpanel"
                        aria-labelledby="list-lovaas-list">
                        <div class="accordion" id="accordionExample">
                            <form action="handle/lovaas.php" method="post">
                                <?php foreach ($lovaas_cats as $lovass_cat) : ?>
                                <div class="accordion-item">
                                    <div class="d-flex accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapse<?= $lovass_cat['id'] ?>" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <div class="col-lg">
                                            <h6 class="m-0"><?= $lovass_cat['category'] ?></h6>
                                        </div>
                                    </div>
                                    <div id="collapse<?= $lovass_cat['id'] ?>" class="accordion-collapse collapse"
                                        aria-labelledby="heading<?= $lovass_cat['id'] ?>"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <?php $lovaas_questions_results =  $lovaas_questions->selectWhere("id , lovass_questions", "lovaas_category_id =" . $lovass_cat['id']); ?>
                                            <?php foreach ($lovaas_questions_results as $key => $lovaas_result) : ?>
                                            <div class="row bg-white rounded p-4 border-bottom">
                                                <div class="row">
                                                    <?= $lovaas_result['lovass_questions'] ?>
                                                </div>
                                                <div
                                                    class="row justify-content-around  align-items-center text-center p-3">
                                                    <div class="col-2 col-lg-2 form-check text-md-start">
                                                        <input class="form-check-input" type="radio"
                                                            name="radio_<?= $lovaas_result['id'] ?>" value="good">
                                                        <label class="form-check-label">
                                                            good
                                                        </label>
                                                    </div>
                                                    <div class="col-2 col-lg-2 form-check ">
                                                        <input class="form-check-input" type="radio"
                                                            name="radio_<?= $lovaas_result['id'] ?>" value="medium">
                                                        <label class="form-check-label">
                                                            medium
                                                        </label>
                                                    </div>
                                                    <div class="col-2 col-lg-2 form-check ">
                                                        <input class="form-check-input" type="radio"
                                                            name="radio_<?= $lovaas_result['id'] ?>" value="weak">
                                                        <label class="form-check-label">
                                                            weak
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach ?>
                                <button type="submit" name="lovaas_questions"
                                    class="secondary-btn btn float-end mt-4">Done</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                    <!-- Schedule -->
                    <div class="tab-pane fade bg-box" id="list-schedule" role="tabpanel"
                        aria-labelledby="list-schedule-list">
                        <div class="diagnosis-schedule p-5">
                            <h2 class="text-blue"> Add New Schedule</h2>
                            <div class="line bg-yellow"></div>
                            <form action="handle/schedule.php">
                                <div class="row align-items-end pt-4">
                                    <div class="col-lg-11">
                                        <div id="duplicater" class="row pt-3">
                                            <div class="col-lg-12">
                                                <div class="input">
                                                    <label class="form-label dark-text f-800">Date &
                                                        time</label>
                                                    <input type="datetime-local" id="datetime" name="datetime_0"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="secondary-btn btn text-white py-0"
                                            onclick="duplicate()">
                                            <i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <button type="submit" name="add-schedule"
                                    class="secondary-btn btn float-end mt-4">Done</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
// when page is ready
$(document).ready(function() {
    // on form submit
    $("#form").on('submit', function() {
        // to each unchecked checkbox
        $(this + 'input[type=checkbox]:not(:checked)').each(function() {
            // set value 0 and check it
            $(this).attr('checked', true).val(0);
        });
    })
})

var i = 0;
var original = document.getElementById('duplicater');

function duplicate() {
    var clone = original.cloneNode(true);
    console.log(clone);
    clone.id = "duplicater" + ++i;
    original.parentNode.appendChild(clone);
}
</script>
<?php require_once('include/footer.php'); ?>