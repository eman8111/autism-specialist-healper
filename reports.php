<?php

use Project\Classes\calc_scale;
use Project\Classes\Models\notic;
use Project\Classes\Models\tables;
use Project\Classes\Models\patient;
use Project\Classes\Models\dsm_result;
use Project\Classes\Models\adir_result;
use Project\Classes\Models\scale_result;
use Project\Classes\Models\dsm5_category;
use Project\Classes\Models\dsm5_question;

// dsm5
use Project\Classes\Models\lovaas_results;
use Project\Classes\Models\scale_category;
use Project\Classes\Models\lovaas_category;

// scale
use Project\Classes\Models\scale_questions;
use Project\Classes\Models\lovaas_questions;
use Project\Classes\Models\attahced_reports_result;
use Project\Classes\Models\evaluation_history_result;


require_once('include/header.php');


$patient_id = $request->get('patientid');
$patients = new patient;
$patient_result = $patients->selectId("*", "$patient_id");
$lovaas_category = new lovaas_category;
$lovaas_cats = $lovaas_category->selectAll();
$lovaas_questions = new lovaas_questions;
$lovaas_ques = $lovaas_questions->selectAll();
$lovaas_results = new lovaas_results;
$lovaas_results_arr = $lovaas_results->selectWhere("*", "patient_id = $patient_id");
// Dsm5
$dsm5_question = new dsm5_question;
$dsm_ques = $dsm5_question->selectAll();

$dsm5_category = new dsm5_category;
$dsm_cats = $dsm5_category->selectAll();

$dsm_results = new dsm_result;
$dsm_results_arr = $dsm_results->selectWhere("*", "pateint_id = $patient_id");

// scale 
$scale_questions = new scale_questions;
$scale_ques = $scale_questions->selectAll();

$scale_category = new scale_category;
$scale_cats = $scale_category->selectAll();

$scale_result = new scale_result;
$scale_result_arr = $scale_result->selectWhere("*", "patient_id = $patient_id");
$calc_scale = new calc_scale;

$tables_select = new tables;
$adir_result = new adir_result;
$adir_result_arr = $adir_result->selectWhere("*", "pateint_id = $patient_id");
$att_result = new attahced_reports_result;
$att_result_arr = $att_result->selectWhere("*", "patient_id = $patient_id");
$eva_result = new evaluation_history_result;
$eva_result_arr = $eva_result->selectWhere("*", "pateint_id = $patient_id");
$notic_result = new notic;
$notic_result_arr = $notic_result->selectWhere("*", "pateint_id = $patient_id");

$conn = mysqli_connect('localhost', 'root', '', 'autism');
require_once('include/navbar.php');
?>

<section class="main-banner text-white d-flex justify-content-center align-items-center text-center">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <h1>Reports</h1>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit
                    illum odit doloremque sed distinctio cum sapiente reiciendis modi, soluta minima numquam consectetur
                    iure enim hic..</p>
            </div>
        </div>
    </div>
</section>

<div class="toggle">
    <div class="main-box">
        <div id="patient-info" class="card bg-box" style="width: 18rem;">
            <img src="<?= URL ?>assets/images/uploads/patients/<?= $patient_result['photo'] ?>" class="img-card"
                alt="child">
            <div class="card-body">
                <a href="patient-profile.php?patientid=<?= $patient_result['id'] ?>" class="dark-text">
                    <h5 class="text-center"><?= $patient_result['name'] ?></h5>
                </a>
                <p class="card-text mb-0">Age : <?= $patient_result['age'] ?></p>
                <p class="card-text">Caregiver Name : <?= $patient_result['caregiver_name'] ?></p>
            </div>
        </div>
        <div id="toggle-info" class="button-show text-white p-2">
            <i class="fas fa-info-circle"></i>
            <span class="m-0">Patient info</span>
        </div>
    </div>
</div>

<?php if (!empty($lovaas_results_arr) or !empty($adir_result_arr) or !empty($notic_result_arr) or !empty($att_result_arr) or !empty($eva_result_arr)) { ?>
<div class="list-arr reports py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
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
                </div>
            </div>
            <div class="col-lg-9">
                <div class="tab-content" id="nav-tabContent">
                    <!-- Notices -->
                    <div class="tab-pane fade show active bg-box rounded p-lg-5 p-2 mt-lg-0 mt-4" id="list-notice"
                        role="tabpanel" aria-labelledby="list-notice-list">
                        <div class="tab-pane fade show active bg-box" id="list-notice" role="tabpanel"
                            aria-labelledby="list-notice-list">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-notice-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-notice" type="button" role="tab"
                                        aria-controls="pills-notice" aria-selected="true">Notice</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-adir-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-adir" type="button" role="tab" aria-controls="pills-adir"
                                        aria-selected="false">ADIR</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <!-- Notice -->
                                <div class="tab-pane fade show active" id="pills-notice" role="tabpanel"
                                    aria-labelledby="pills-notice-tab">
                                    <?php if (!empty($notic_result_arr)) { ?>
                                    <div class="row">
                                        <div class="col-md-12 mt-3 rounded">
                                            <button type="button" class="secondary-btn float-end btn"
                                                onclick='PrintElem("Notice-print")'>Print and generate PDF</button>
                                        </div>
                                    </div>
                                    <div class="report px-lg-5 px-3 py-4 mt-3" id="Notice-print">
                                        <div class="row justify-content-between align-items-center head">
                                            <div class="col-md-8">
                                                <div class="row align-items-center">
                                                    <div class="col-md-2 col-3">
                                                        <img src="<?= URL; ?>assets/images/autism.png" alt=""
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="col-md-6 col-6 p-0 text-white">
                                                        <h1 class="mb-0 h3 dark-text">Autism</h1>
                                                        <p class="m-0 p-0 dark-text">Specialist Helper</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row mb-4">
                                                    <div class="col-md-12">
                                                        <h5>Patient</h5>
                                                        <div class="d-flex flex-wrap">
                                                            <p class="mx-2 mb-1">Name : <strong>
                                                                    <?= $patient_result['name'] ?> </strong>
                                                            </p>
                                                            <p class="mx-2 mb-1">Age : <strong>
                                                                    <?= $patient_result['age'] ?> </strong>
                                                            </p>
                                                            <p class="mx-2 mb-1">Gender : <strong>
                                                                    <?= $patient_result['gender'] ?>
                                                                </strong> </p>
                                                            <p class="mx-2 mb-1">Number of brothers : <strong>
                                                                    <?= $patient_result['No_of_bro'] ?>
                                                                </strong> </p>
                                                            <p class="mx-2 mb-1">Rank among brothers : <strong>
                                                                    <?= $patient_result['arr_btw_bro'] ?>
                                                                </strong> </p>
                                                            <p class="mx-2 mb-1">Class : <strong>
                                                                    <?= $patient_result['class'] ?>
                                                                </strong> </p>
                                                            <p class="mx-2 mb-1">School : <strong>
                                                                    <?= $patient_result['school'] ?>
                                                                </strong> </p>
                                                        </div>
                                                        <h5 class="mt-2">Caregiver</h5>
                                                        <div class="d-flex flex-wrap ">
                                                            <p class="mx-2">Name : <strong>
                                                                    <?= $patient_result['caregiver_name'] ?>
                                                                </strong> </p>
                                                            <p class="mx-2">Relationship with patient since : <strong>
                                                                    <?= $patient_result['caregiver_relationship'] ?>
                                                                </strong> </p>
                                                            <p class="mx-2">Phone number : <strong>
                                                                    <?= $patient_result['caregiver_phone'] ?>
                                                                </strong> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="dark-text">
                                                    Here are the answers you provided:
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="bg-box py-3 my-3">
                                            <?php
                                                    $not_query = 'SELECT notic_questions.notic_question_category FROM `notic_questions` 
                                                             GROUP BY notic_question_category';
                                                    $not_result = $conn->query($not_query);
                                                    if ($not_result->num_rows > 0) {
                                                        while ($not_row = $not_result->fetch_assoc()) {
                                                    ?>
                                            <div class="container-fluid">
                                                <div class="row justify-content-between align-items-center bg-box cat">
                                                    <div class="col-lg-10">
                                                        <h5><?php echo $not_row['notic_question_category']; ?></h5>
                                                    </div>
                                                </div>
                                                <div class="pt-3">
                                                    <ul>
                                                        <?php
                                                                        $not_sql = 'SELECT notic.*, patient.name,notic_questions.notice_questions
                                                                FROM `notic` 
                                                                LEFT JOIN patient ON notic.pateint_id = patient.id
                                                                LEFT JOIN notic_questions ON notic.notic_q_id = notic_questions.id
                                                                WHERE notic.notic_category = "' . $not_row['notic_question_category'] . '" AND notic.pateint_id = "' . $_GET['patientid'] . '"';
                                                                        $not_q = $conn->query($not_sql);
                                                                        if ($not_q->num_rows > 0) {
                                                                            while ($not_q_row = $not_q->fetch_assoc()) {
                                                                                echo '<li class="report_prgraph_content">' . $not_q_row['notice_questions'] . '</li>';
                                                                            }
                                                                        } else {
                                                                            echo '<br>';
                                                                        }
                                                                        ?>
                                                    </ul>
                                                </div>

                                            </div>
                                            <?php }
                                                    } ?>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-md-12">
                                                <p> For your reference, based on conventional autism screening AQ-10
                                                    technique, autistic traits have been identified
                                                    in the respondent given the provided information. The AQ-10 score
                                                    for the respondent is 7. This result is not
                                                    obtained from our AI.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="body_not_select text-center" style="background-color: #FDFDFD;">
                                        <div class="row justify-content-center pb-5">
                                            <div class="col-lg-6">
                                                <div class="not-found">
                                                    <img src="<?= URL ?>assets/images/not_data.jpg" alt=""
                                                        class="img-fluid">
                                                    <h3>No data found!</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>

                                <!-- ADIR -->
                                <div class="tab-pane fade show " id="pills-adir" role="tabpanel"
                                    aria-labelledby="pills-adir-tab">
                                    <?php if (!empty($adir_result_arr)) { ?>
                                    <div class="row">
                                        <div class="col-md-12 mt-3 rounded">
                                            <button type="button" class="secondary-btn float-end btn"
                                                onclick='PrintElem("adir-print")'>Print and generate PDF</button>
                                        </div>
                                    </div>
                                    <div class="report px-lg-5 px-3 py-4 mt-3" id="adir-print">
                                        <div class="row justify-content-between align-items-center head">
                                            <div class="col-md-8">
                                                <div class="row align-items-center">
                                                    <div class="col-md-2 col-3">
                                                        <img src="<?= URL; ?>assets/images/autism.png" alt=""
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="col-md-6 col-6 p-0 text-white">
                                                        <h1 class="mb-0 h3 dark-text">Autism</h1>
                                                        <p class="m-0 p-0 dark-text">Specialist Helper</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row mb-4">
                                                    <div class="col-md-12">
                                                        <h5>Patient</h5>
                                                        <div class="d-flex flex-wrap">
                                                            <p class="mx-2 mb-1">Name : <strong>
                                                                    <?= $patient_result['name'] ?> </strong>
                                                            </p>
                                                            <p class="mx-2 mb-1">Age : <strong>
                                                                    <?= $patient_result['age'] ?> </strong>
                                                            </p>
                                                            <p class="mx-2 mb-1">Gender : <strong>
                                                                    <?= $patient_result['gender'] ?>
                                                                </strong> </p>
                                                            <p class="mx-2 mb-1">Number of brothers : <strong>
                                                                    <?= $patient_result['No_of_bro'] ?>
                                                                </strong> </p>
                                                            <p class="mx-2 mb-1">Rank among brothers : <strong>
                                                                    <?= $patient_result['arr_btw_bro'] ?>
                                                                </strong> </p>
                                                            <p class="mx-2 mb-1">Class : <strong>
                                                                    <?= $patient_result['class'] ?>
                                                                </strong> </p>
                                                            <p class="mx-2 mb-1">School : <strong>
                                                                    <?= $patient_result['school'] ?>
                                                                </strong> </p>
                                                        </div>
                                                        <h5 class="mt-2">Caregiver</h5>
                                                        <div class="d-flex flex-wrap ">
                                                            <p class="mx-2">Name : <strong>
                                                                    <?= $patient_result['caregiver_name'] ?>
                                                                </strong> </p>
                                                            <p class="mx-2">Relationship with patient since : <strong>
                                                                    <?= $patient_result['caregiver_relationship'] ?>
                                                                </strong> </p>
                                                            <p class="mx-2">Phone number : <strong>
                                                                    <?= $patient_result['caregiver_phone'] ?>
                                                                </strong> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="dark-text">
                                                    here are the answer of provide:
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="report-table table-responsive mt-2">
                                            <table class="table table-hover table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Questions</th>
                                                        <th>Result</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                            $adir_query = 'SELECT adir.adir_questions,adir_result.*, patient.name FROM `adir_result` LEFT JOIN adir on adir_result.adir_id = adir.id 
                                                            LEFT JOIN patient on adir_result.pateint_id = patient.id WHERE  adir_result.pateint_id = "' . $_GET['patientid'] . '"';
                                                            $adir_result = $conn->query($adir_query);
                                                            if ($adir_result->num_rows > 0) {
                                                                while ($adir_row = $adir_result->fetch_assoc()) {
                                                            ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $adir_row['adir_questions']; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                            if ($adir_row['result'] === '1') {
                                                                                echo "Yes";
                                                                            } else {
                                                                                echo "No";
                                                                            }
                                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php }
                                                            }  ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-md-12">
                                                <p> Lorem ipsum dolor sit amet consecteturLorem ipsum dolor sit amet
                                                    consectetur adipisicing elit. Voluptate
                                                    adipisicing dolor sit amet consecteturLorem ipsum dolor sit amet
                                                    consectetur adipisicing elit. Voluptate
                                                    adipis elit. VoluptateLorem ipsum dolor sit amet consectetur
                                                    adipisicing
                                                    elit. Voluptate
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="body_not_select text-center" style="background-color: #FDFDFD;">
                                        <div class="row justify-content-center pb-5">
                                            <div class="col-lg-6">
                                                <div class="not-found">
                                                    <img src="<?= URL ?>assets/images/not_data.jpg" alt=""
                                                        class="img-fluid">
                                                    <h3>No data found!</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Attached Report   -->
                    <div class="tab-pane fade bg-box rounded p-lg-5 p-2 mt-lg-0 mt-4" id="list-attched-report"
                        role="tabpanel" aria-labelledby="list-attched-report-list">
                        <?php if (!empty($att_result_arr)) { ?>
                        <div class="row">
                            <div class="col-md-12 mt-3 rounded">
                                <button type="button" class="secondary-btn float-end btn"
                                    onclick='PrintElem("att-print")'>Print and generate PDF</button>
                            </div>
                        </div>
                        <div class="report px-lg-5 px-3 py-4 mt-3" id="att-print">
                            <div class="row justify-content-between align-items-center head">
                                <div class="col-md-8">
                                    <div class="row align-items-center">
                                        <div class="col-md-2 col-3">
                                            <img src="<?= URL; ?>assets/images/autism.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-md-6 col-6 p-0 text-white">
                                            <h1 class="mb-0 h3 dark-text">Autism</h1>
                                            <p class="m-0 p-0 dark-text">Specialist Helper</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5>Patient</h5>
                                            <div class="d-flex flex-wrap">
                                                <p class="mx-2 mb-1">Name : <strong> <?= $patient_result['name'] ?>
                                                    </strong>
                                                </p>
                                                <p class="mx-2 mb-1">Age : <strong> <?= $patient_result['age'] ?>
                                                    </strong>
                                                </p>
                                                <p class="mx-2 mb-1">Gender : <strong> <?= $patient_result['gender'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">Number of brothers : <strong>
                                                        <?= $patient_result['No_of_bro'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">Rank among brothers : <strong>
                                                        <?= $patient_result['arr_btw_bro'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">Class : <strong> <?= $patient_result['class'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">School : <strong> <?= $patient_result['school'] ?>
                                                    </strong> </p>
                                            </div>
                                            <h5 class="mt-2">Caregiver</h5>
                                            <div class="d-flex flex-wrap ">
                                                <p class="mx-2">Name : <strong> <?= $patient_result['caregiver_name'] ?>
                                                    </strong> </p>
                                                <p class="mx-2">Relationship with patient since : <strong>
                                                        <?= $patient_result['caregiver_relationship'] ?>
                                                    </strong> </p>
                                                <p class="mx-2">Phone number : <strong>
                                                        <?= $patient_result['caregiver_phone'] ?>
                                                    </strong> </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="dark-text">
                                        here are the answer of provide:
                                    </h6>
                                </div>
                            </div>
                            <div class="report-table table-responsive mt-2">
                                <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Questions</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                $att_query = 'SELECT attached_reports.details,attahced_reports_result.*,patient.name FROM attahced_reports_result LEFT JOIN attached_reports on attahced_reports_result.attached_id= attached_reports.id LEFT JOIN patient on attahced_reports_result.patient_id = patient.id WHERE attahced_reports_result.patient_id = "' . $_GET['patientid'] . '"';
                                                $att_result = $conn->query($att_query);
                                                if ($att_result->num_rows > 0) {
                                                    $attcount = 0;
                                                    while ($att_row = $att_result->fetch_assoc()) {
                                                ?>
                                        <tr>

                                            <td type="button" data-toggle="modal" data-target="#exampleModal"
                                                data-whatever="<?php echo $att_row['attached_url']; ?>">
                                                <?php echo $att_row['details']; ?> </td>
                                            <td>
                                                <?php
                                                                if ($att_row['result'] === '1') {
                                                                    echo "Yes";
                                                                } else {
                                                                    echo "No";
                                                                }
                                                                ?>
                                            </td>
                                        </tr>
                                        <?php $attcount++;
                                                    }
                                                } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-12">
                                    <p> Lorem ipsum dolor sit amet consecteturLorem ipsum dolor sit amet
                                        consectetur adipisicing elit. Voluptate
                                        adipisicing dolor sit amet consecteturLorem ipsum dolor sit amet
                                        consectetur adipisicing elit. Voluptate
                                        adipis elit. VoluptateLorem ipsum dolor sit amet consectetur adipisicing
                                        elit. Voluptate
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="body_not_select text-center" style="background-color: #FDFDFD;">
                            <div class="row justify-content-center pb-5">
                                <div class="col-lg-6">
                                    <div class="not-found">
                                        <img src="<?= URL ?>assets/images/not_data.jpg" alt="" class="img-fluid">
                                        <h3>No data found!</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <!-- Evaluation History -->
                    <div class="tab-pane fade bg-box rounded p-lg-5 p-2 mt-lg-0 mt-4" id="list-evaluation-history"
                        role="tabpanel" aria-labelledby="list-evaluation-history-list">
                        <?php if (!empty($eva_result_arr)) { ?>
                        <div class="row">
                            <div class="col-md-12 mt-3 rounded">
                                <button type="button" class="secondary-btn float-end btn"
                                    onclick='PrintElem("eva-print")'>Print and generate PDF</button>
                            </div>
                        </div>
                        <div class="report px-lg-5 px-3 py-4 mt-3" id="eva-print">
                            <div class="row justify-content-between align-items-center head">
                                <div class="col-md-8">
                                    <div class="row align-items-center">
                                        <div class="col-md-2 col-3">
                                            <img src="<?= URL; ?>assets/images/autism.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-md-6 col-6 p-0 text-white">
                                            <h1 class="mb-0 h3 dark-text">Autism</h1>
                                            <p class="m-0 p-0 dark-text">Specialist Helper</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5>Patient</h5>
                                            <div class="d-flex flex-wrap">
                                                <p class="mx-2 mb-1">Name : <strong> <?= $patient_result['name'] ?>
                                                    </strong>
                                                </p>
                                                <p class="mx-2 mb-1">Age : <strong> <?= $patient_result['age'] ?>
                                                    </strong>
                                                </p>
                                                <p class="mx-2 mb-1">Gender : <strong> <?= $patient_result['gender'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">Number of brothers : <strong>
                                                        <?= $patient_result['No_of_bro'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">Rank among brothers : <strong>
                                                        <?= $patient_result['arr_btw_bro'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">Class : <strong> <?= $patient_result['class'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">School : <strong> <?= $patient_result['school'] ?>
                                                    </strong> </p>
                                            </div>
                                            <h5 class="mt-2">Caregiver</h5>
                                            <div class="d-flex flex-wrap ">
                                                <p class="mx-2">Name : <strong> <?= $patient_result['caregiver_name'] ?>
                                                    </strong> </p>
                                                <p class="mx-2">Relationship with patient since : <strong>
                                                        <?= $patient_result['caregiver_relationship'] ?>
                                                    </strong> </p>
                                                <p class="mx-2">Phone number : <strong>
                                                        <?= $patient_result['caregiver_phone'] ?>
                                                    </strong> </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="dark-text">
                                        here are the answer of provide:
                                    </h6>
                                </div>
                            </div>
                            <div class="report-table table-responsive mt-2">
                                <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Questions</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                $evquery = 'SELECT evaluation_history.evaluation_questions,evaluation_history_result.*,patient.name FROM `evaluation_history_result` LEFT JOIN evaluation_history ON evaluation_history_result.evaluation_id = evaluation_history.id LEFT JOIN patient ON evaluation_history_result.pateint_id = patient.id WHERE evaluation_history_result.pateint_id  = "' . $_GET['patientid'] . '"';
                                                $eva_result = $conn->query($evquery);
                                                if ($eva_result->num_rows > 0) {
                                                    while ($e_row = $eva_result->fetch_assoc()) {
                                                ?>
                                        <tr>
                                            <td> <?php echo $e_row['evaluation_questions']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                                if ($e_row['result'] === '1') {
                                                                    echo "Yes";
                                                                } else {
                                                                    echo "No";
                                                                }
                                                                ?>
                                            </td>
                                        </tr>
                                        <?php }
                                                } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-12">
                                    <p> Lorem ipsum dolor sit amet consecteturLorem ipsum dolor sit amet
                                        consectetur adipisicing elit. Voluptate
                                        adipisicing dolor sit amet consecteturLorem ipsum dolor sit amet
                                        consectetur adipisicing elit. Voluptate
                                        adipis elit. VoluptateLorem ipsum dolor sit amet consectetur adipisicing
                                        elit. Voluptate
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="body_not_select text-center" style="background-color: #FDFDFD;">
                            <div class="row justify-content-center pb-5">
                                <div class="col-lg-6">
                                    <div class="not-found">
                                        <img src="<?= URL ?>assets/images/not_data.jpg" alt="" class="img-fluid">
                                        <h3>No data found!</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <!-- DSM 5 -->
                    <div class="tab-pane fade bg-box rounded p-lg-5 p-2 mt-lg-0 mt-4" id="list-dsm" role="tabpanel"
                        aria-labelledby="list-dsm-list">
                        <div class="row">
                            <div class="col-md-12 mt-3 rounded">
                                <button type="button" class="secondary-btn float-end btn"
                                    onclick='PrintElem("dsm-print")'>Print and generate PDF</button>
                            </div>
                        </div>
                        <div class="report px-lg-5 px-3 py-4 mt-3" id="dsm-print">
                            <div class="row justify-content-between align-items-center head">
                                <div class="col-md-8">
                                    <div class="row align-items-center">
                                        <div class="col-md-2 col-3">
                                            <img src="<?= URL; ?>assets/images/autism.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-md-6 col-6 p-0 text-white">
                                            <h1 class="mb-0 h3 dark-text">Autism</h1>
                                            <p class="m-0 p-0 dark-text">Specialist Helper</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5>Patient</h5>
                                            <div class="d-flex flex-wrap">
                                                <p class="mx-2 mb-1">Name : <strong> <?= $patient_result['name'] ?>
                                                    </strong>
                                                </p>
                                                <p class="mx-2 mb-1">Age : <strong> <?= $patient_result['age'] ?>
                                                    </strong>
                                                </p>
                                                <p class="mx-2 mb-1">Gender : <strong> <?= $patient_result['gender'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">Number of brothers : <strong>
                                                        <?= $patient_result['No_of_bro'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">Rank among brothers : <strong>
                                                        <?= $patient_result['arr_btw_bro'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">Class : <strong> <?= $patient_result['class'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">School : <strong> <?= $patient_result['school'] ?>
                                                    </strong> </p>
                                            </div>
                                            <h5 class="mt-2">Caregiver</h5>
                                            <div class="d-flex flex-wrap ">
                                                <p class="mx-2">Name : <strong> <?= $patient_result['caregiver_name'] ?>
                                                    </strong> </p>
                                                <p class="mx-2">Relationship with patient since : <strong>
                                                        <?= $patient_result['caregiver_relationship'] ?>
                                                    </strong> </p>
                                                <p class="mx-2">Phone number : <strong>
                                                        <?= $patient_result['caregiver_phone'] ?>
                                                    </strong> </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="dark-text">
                                        Here are the answers you provided:
                                    </h6>
                                </div>
                            </div>
                            <?php foreach ($dsm_cats as $dsm_cat) : ?>

                            <div class="bg-box py-3 my-3">
                                <div class="container-fluid">
                                    <div class="row justify-content-between align-items-center bg-box cat">
                                        <div class="col-lg-10">
                                            <h5><?= $dsm_cat['dsm_category'] ?></h5>
                                        </div>
                                        <?php
                                                $dsm_result = new dsm_result;
                                                $dsm_category_id = $dsm_cat['id'];
                                                $dsm_calc = "SELECT dsm_question_result , dsm_question_id FROM dsm_result JOIN dsm5_category JOIN dsm5_question ON 
                                                    dsm5_category.id = dsm5_question.dsm5_category_id AND dsm5_question.id = dsm_result.dsm_question_id WHERE dsm_question_result='yes' AND dsm5_category.id = $dsm_category_id AND pateint_id = $patient_id";
                                                $get_result = $dsm_result->query($dsm_calc);
                                                $dsm_calc_results_report = mysqli_fetch_all($get_result, MYSQLI_ASSOC);
                                                ?>
                                        <div class="col-lg-2">
                                            <strong class="red">Degree : <?= count($dsm_calc_results_report) ?></strong>
                                            <?php $array[] = [count($dsm_calc_results_report)] ?>
                                        </div>
                                    </div>
                                    <table class="table table-hover table-striped table-bordered mt-4">
                                        <thead>
                                            <tr>
                                                <th>Questions</th>
                                                <th>Result</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                    $dsm_category_id = $dsm_cat['id'];
                                                    $query = "SELECT dsm5_question.dsm5_questions , dsm_result.dsm_question_result FROM patient JOIN dsm_result JOIN dsm5_question JOIN dsm5_category  ON
                                                    patient.id=dsm_result.pateint_id AND dsm5_question.id = dsm_result.dsm_question_id AND dsm5_category.id = dsm5_question.dsm5_category_id WHERE dsm5_category.id= $dsm_category_id AND patient.id= $patient_id";
                                                    $dsm_result =  $tables_select->query($query);
                                                    $dsm_results_report = mysqli_fetch_all($dsm_result, MYSQLI_ASSOC);
                                                    ?>
                                            <?php if ($dsm_results_report) { ?>
                                            <?php foreach ($dsm_results_report as $result) : ?>
                                            <tr>
                                                <td><?= $result['dsm5_questions'] ?></td>
                                                <td><?= $result['dsm_question_result'] ?></td>
                                            </tr>
                                            <?php endforeach ?>
                                            <?php } else { ?>
                                            <td colspan="2" class="text-center">No data yet</td>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php endforeach ?>
                            <div class="row pt-3">
                                <div class="col-md-12">
                                    <?php
                                        $dsm_result = new dsm_result;
                                        $dsm_category_id = $dsm_cat['id'];
                                        $dsm_calc = "SELECT dsm_question_result , dsm_question_id FROM dsm_result JOIN dsm5_category JOIN dsm5_question ON 
                                    dsm5_category.id = dsm5_question.dsm5_category_id AND dsm5_question.id = dsm_result.dsm_question_id WHERE dsm_question_result='yes' AND pateint_id = $patient_id";
                                        $get_result = $dsm_result->query($dsm_calc);
                                        $dsm_calc_results_reports = mysqli_fetch_all($get_result, MYSQLI_ASSOC);
                                        ?>
                                    <?php if (count($dsm_calc_results_reports) < 4) { ?>
                                    <p>
                                    <h6>your child degree is</h6>
                                    <h6><?= count($dsm_calc_results_reports) ?></h6>
                                    so it seems that he have a low level of support
                                    </p>
                                    <?php } elseif ((count($dsm_calc_results_reports) < 8)) { ?>
                                    your child degree is
                                    <?= count($dsm_calc_results_reports) ?>
                                    so it seems that he have a medium level of support
                                    <?php } elseif ((count($dsm_calc_results_reports) < 14)) { ?>
                                    your child degree is
                                    <?= count($dsm_calc_results_reports) ?>
                                    so it seems that he have a High level of support
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Scale -->
                    <div class="tab-pane fade bg-box rounded p-lg-5 p-2 mt-lg-0 mt-4" id="list-scale" role="tabpanel"
                        aria-labelledby="list-scale-list">
                        <div class="row">
                            <div class="col-md-12 mt-3 rounded">
                                <button type="button" class="secondary-btn float-end btn"
                                    onclick='PrintElem("scale-print")'>Print and generate PDF</button>
                            </div>
                        </div>
                        <div class="report px-lg-5 px-3 py-4 mt-3" id="scale-print">
                            <div class="row justify-content-between align-items-center head">
                                <div class="col-md-8">
                                    <div class="row align-items-center">
                                        <div class="col-md-2 col-3">
                                            <img src="<?= URL; ?>assets/images/autism.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-md-6 col-6 p-0 text-white">
                                            <h1 class="mb-0 h3 dark-text">Autism</h1>
                                            <p class="m-0 p-0 dark-text">Specialist Helper</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5>Patient</h5>
                                            <div class="d-flex flex-wrap">
                                                <p class="mx-2 mb-1">Name : <strong> <?= $patient_result['name'] ?>
                                                    </strong>
                                                </p>
                                                <p class="mx-2 mb-1">Age : <strong> <?= $patient_result['age'] ?>
                                                    </strong>
                                                </p>
                                                <p class="mx-2 mb-1">Gender : <strong> <?= $patient_result['gender'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">Number of brothers : <strong>
                                                        <?= $patient_result['No_of_bro'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">Rank among brothers : <strong>
                                                        <?= $patient_result['arr_btw_bro'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">Class : <strong> <?= $patient_result['class'] ?>
                                                    </strong> </p>
                                                <p class="mx-2 mb-1">School : <strong> <?= $patient_result['school'] ?>
                                                    </strong> </p>
                                            </div>
                                            <h5 class="mt-2">Caregiver</h5>
                                            <div class="d-flex flex-wrap ">
                                                <p class="mx-2">Name : <strong> <?= $patient_result['caregiver_name'] ?>
                                                    </strong> </p>
                                                <p class="mx-2">Relationship with patient since : <strong>
                                                        <?= $patient_result['caregiver_relationship'] ?>
                                                    </strong> </p>
                                                <p class="mx-2">Phone number : <strong>
                                                        <?= $patient_result['caregiver_phone'] ?>
                                                    </strong> </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="dark-text">
                                        Here are the answers you provided:
                                    </h6>
                                </div>
                            </div>
                            <?php foreach ($scale_cats as $scale_cat) : ?>
                            <div class="bg-box py-3 my-3">
                                <div class="container-fluid">
                                    <div class="row justify-content-between align-items-center bg-box cat">
                                        <div class="col-lg-10">
                                            <h5><?= $scale_cat['scale_category'] ?></h5>
                                        </div>
                                        <?php
                                                $scale_result = new scale_result;
                                                $scale_category_id = $scale_cat['id'];
                                                $scale_calc = "SELECT SUM(scale_question_result) FROM scale_result JOIN scale_category JOIN scale_questions ON 
                                                    scale_category.id = scale_questions.scale_category_id AND scale_questions.id = scale_result.scale_question_id WHERE scale_category.id = $scale_category_id AND patient_id= $patient_id";
                                                $get_result2 = $scale_result->query($scale_calc);
                                                $scale_calc_results_report = mysqli_fetch_assoc($get_result2);
                                                ?>
                                        <div class="col-lg-2">
                                            <strong class="red">Degree :
                                                <?= $scale_calc_results_report['SUM(scale_question_result)'] ?></strong>
                                        </div>
                                    </div>
                                    <table class="table table-hover table-striped table-bordered mt-4">
                                        <thead>
                                            <tr>
                                                <th>Questions</th>
                                                <th>Result</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                    $scale_category_id = $scale_cat['id'];
                                                    $query = "SELECT scale_questions.scale_question , scale_result.scale_question_result FROM patient JOIN scale_result JOIN scale_questions JOIN scale_category  ON
                                            patient.id=scale_result.patient_id AND scale_questions.id = scale_result.scale_question_id AND scale_category.id = scale_questions.scale_category_id WHERE scale_category.id= $scale_category_id AND patient.id= $patient_id";
                                                    $scale_result =  $tables_select->query($query);
                                                    $scale_results_report = mysqli_fetch_all($scale_result, MYSQLI_ASSOC);
                                                    ?>
                                            <?php if ($scale_results_report) { ?>
                                            <?php foreach ($scale_results_report as $result) : ?>
                                            <tr>
                                                <td><?= $result['scale_question'] ?></td>
                                                <td><?= $result['scale_question_result'] ?></td>
                                            </tr>
                                            <?php endforeach ?>
                                            <?php } else { ?>
                                            <td colspan="2" class="text-center">No data yet</td>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php
                                    $cat_result[] = $scale_calc_results_report['SUM(scale_question_result)']; ?>
                            <?php endforeach ?>
                            <div class="row pt-3">
                                <div class="col-md-12">
                                    <p>
                                        <?php
                                            $RB = $calc_scale->calc_cat($cat_result[0], 'RB');
                                            $SI = $calc_scale->calc_cat($cat_result[1], 'SI');
                                            $SC = $calc_scale->calc_cat($cat_result[2], 'SC');
                                            $ER = $calc_scale->calc_cat($cat_result[3], 'ER');
                                            $CS = $calc_scale->calc_cat($cat_result[4], 'CS');
                                            $MS = $calc_scale->calc_cat($cat_result[5], 'MS');
                                            $array = [$RB, $SI, $SC, $ER, $CS, $MS];
                                            $session->set('scale_array', $array);
                                            $final_degree =  $calc_scale->calc_all($RB, $SI, $SC, $ER, $CS, $MS);
                                            if ($final_degree <= 54) {
                                                echo " <strong> Autism coefficient : <span class='red'> $final_degree<span> </strong> 
                                                <br> This child didn't have any sign of autism according to G.A.R.S3 scoring rate";
                                            } elseif ($final_degree >= 55  and $final_degree <= 70) {
                                                echo "<strong> Autism coefficient : <span class='red'> $final_degree<span> </strong> 
                                                <br> This child have sign of autism according to G.A.R.S3 scoring rate and need a low level of support";
                                            } elseif ($final_degree >= 77 and $final_degree <= 100) {
                                                echo "<strong> Autism coefficient : <span class='red'> $final_degree<span></strong> 
                                                <br> This child have sign of autism according to G.A.R.S3 scoring rate and need a high level of support";
                                            } elseif ($final_degree > 101) {
                                                echo " <strong> Autism coefficient : <span class='red'> $final_degree<span> </strong> 
                                                <br>This child have sign of autism according to G.A.R.S3 scoring rate and need a very high level of support";
                                            }
                                            ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Lovass-->
                    <div class="tab-pane fade bg-box rounded p-lg-5 p-2 mt-lg-0 mt-4" id="list-lovaas" role="tabpanel"
                        aria-labelledby="list-lovaas-list">
                        <?php if (!empty($lovaas_results_arr)) { ?>
                        <div class="row">
                            <div class="col-md-12 mt-3 rounded">
                                <button type="button" class="secondary-btn float-end btn"
                                    onclick='PrintElem("lovaas-print")'>Print and generate PDF</button>
                            </div>
                        </div>
                        <div class="report px-lg-5 px-3 py-4 mt-3" id="lovaas-print">
                            <div class="row justify-content-between align-items-center head">
                                <div class="col-md-8">
                                    <div class="row align-items-center">
                                        <div class="col-md-2 col-3">
                                            <img src="<?= URL; ?>assets/images/autism.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-md-6 col-6 p-0 text-white">
                                            <h1 class="mb-0 h3 dark-text">Autism</h1>
                                            <p class="m-0 p-0 dark-text">Specialist Helper</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5>Patient</h5>
                                    <div class="d-flex flex-wrap">
                                        <p class="mx-2 mb-1">Name : <strong> <?= $patient_result['name'] ?> </strong>
                                        </p>
                                        <p class="mx-2 mb-1">Age : <strong> <?= $patient_result['age'] ?> </strong>
                                        </p>
                                        <p class="mx-2 mb-1">Gender : <strong> <?= $patient_result['gender'] ?>
                                            </strong> </p>
                                        <p class="mx-2 mb-1">Number of brothers : <strong>
                                                <?= $patient_result['No_of_bro'] ?>
                                            </strong> </p>
                                        <p class="mx-2 mb-1">Rank among brothers : <strong>
                                                <?= $patient_result['arr_btw_bro'] ?>
                                            </strong> </p>
                                        <p class="mx-2 mb-1">Class : <strong> <?= $patient_result['class'] ?>
                                            </strong> </p>
                                        <p class="mx-2 mb-1">School : <strong> <?= $patient_result['school'] ?>
                                            </strong> </p>
                                    </div>
                                    <h5 class="mt-2">Caregiver</h5>
                                    <div class="d-flex flex-wrap ">
                                        <p class="mx-2">Name : <strong> <?= $patient_result['caregiver_name'] ?>
                                            </strong> </p>
                                        <p class="mx-2">Relationship with patient since : <strong>
                                                <?= $patient_result['caregiver_relationship'] ?>
                                            </strong> </p>
                                        <p class="mx-2">Phone number : <strong>
                                                <?= $patient_result['caregiver_phone'] ?>
                                            </strong> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="dark-text">
                                        Here are the answers you provided:
                                    </h6>
                                </div>
                            </div>
                            <?php foreach ($lovaas_cats as $lovaas_cat) : ?>
                            <div class="bg-box py-3 my-3">
                                <div class="container-fluid">
                                    <div class="row justify-content-between align-items-center bg-box cat">
                                        <div class="col-lg-10">
                                            <h5><?= $lovaas_cat['category'] ?></h5>
                                        </div>
                                    </div>
                                    <table class="table table-hover table-striped table-bordered my-4">
                                        <thead>
                                            <tr>
                                                <th>Questions</th>
                                                <th>Result</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                        $lovaas_category_id = $lovaas_cat['id'];
                                                        $query = "SELECT lovaas_questions.lovass_questions , lovaas_results.lovaas_question_result FROM patient JOIN lovaas_results JOIN lovaas_questions JOIN lovaas_category  ON
                                                patient.id=lovaas_results.patient_id AND lovaas_questions.id = lovaas_results.lovaas_question_id AND lovaas_category.id = lovaas_questions.lovaas_category_id WHERE lovaas_category.id= $lovaas_category_id AND patient.id= $patient_id";
                                                        $lovaas_results =  $tables_select->query($query);
                                                        $lovaas_results_report = mysqli_fetch_all($lovaas_results, MYSQLI_ASSOC);
                                                        ?>
                                            <?php if ($lovaas_results_report) { ?>
                                            <?php foreach ($lovaas_results_report as $result) : ?>
                                            <tr>
                                                <td><?= $result['lovass_questions'] ?></td>
                                                <td><?= $result['lovaas_question_result'] ?></td>
                                            </tr>
                                            <?php endforeach ?>
                                            <?php } else { ?>
                                            <td colspan="2" class="text-center">No data yet</td>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php endforeach ?>
                            <!-- <div class="row pt-3">
                                <div class="col-md-12">
                                    <p> For your reference, based on conventional autism screening AQ-10
                                        technique, autistic traits have been identified
                                        in the respondent given the provided information. The AQ-10 score
                                        for the respondent is 7. This result is not
                                        obtained from our AI.
                                    </p>
                                </div>
                            </div> -->
                        </div>
                        <?php } else { ?>
                        <div class="body_not_select text-center" style="background-color: #FDFDFD;">
                            <div class="row justify-content-center pb-5">
                                <div class="col-lg-6">
                                    <div class="not-found">
                                        <img src="<?= URL ?>assets/images/not_data.jpg" alt="" class="img-fluid">
                                        <h3>No data found!</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else { ?>
<div class="body_not_select text-center" style="background-color: #FDFDFD;">
    <div class="row justify-content-center pb-5">
        <div class="col-lg-6">
            <div class="not-found">
                <img src="<?= URL ?>assets/images/not_data.jpg" alt="" class="img-fluid">
                <h3>No data found!</h3>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="width: 85%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="hidden" style="max-width: 98%;" id="recipient-name" />
                        <embed id="element-embed" style="width:100%; height:100%">
                        <?php
                        echo $test = '<script> document.getElementById("recipient-name").value; </script>';
                        ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
$('#exampleModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var recipient = button.data('whatever')
    var modal = $(this)
    modal.find('.modal-title').text('View Report')
    modal.find('.modal-body input').val(recipient)

    var element = document.getElementById('element-embed');
    var src = document.getElementById('recipient-name"');
    changeSrcEmbed(element, recipient);

    function changeSrcEmbed(element, src) {
        var id = element.id;
        element.src = src;
        var embedOld = document.getElementById(id);
        var parent = embedOld.parentElement;
        var newElement = element;
        document.getElementById(id).remove();
        parent.append(newElement);
    }
})
</script>

<script type="text/javascript">
function PrintElem(elem) {
    var newstr = document.all.item(elem).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = newstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
}
</script>

<script>
$(document).ready(function() {
    var doc = new jsPDF();
    $('#cmd').click(function() {
        doc.fromHTML($('#testprint').html(), 15, 15, {
            'width': 170,
        }, function() {
            doc.save('sample-file.pdf')
        });
    });
});
</script>
<?php require_once('include/footer.php'); ?>