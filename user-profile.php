<?php

use Project\Classes\Models\autism_checker;
use Project\Classes\Models\autism_checker_question;
use Project\Classes\Models\autism_checker_results;
use Project\Classes\Models\Users;

require_once('include/header.php');
require_once('include/navbar.php');
$user = new Users;
$user_case = new autism_checker;
$autism_checker_result = new autism_checker_results;
$autism_checker_quetions = new autism_checker_question;
$select_case = $user_case->selectWhere("*", "user_id = $user_id");
$user_id = $session->get('user_id');
$select_user = $user->selectId("*", "$user_id");
?>

<div class="user-profile">
    <div class="container pt-120 pb-50">
        <div class="bg-box border rounded p-5">
            <div class="row">
                <div class="col-lg-3">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-profile-list"
                            data-bs-toggle="list" href="#list-profile" role="tab"
                            aria-controls="list-profile">Profile</a>
                        <a class="list-group-item list-group-item-action" id="list-results-list" data-bs-toggle="list"
                            href="#list-results" role="tab" aria-controls="list-results">Results</a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content" id="nav-tabContent" style="border: 1px solid #000;padding: 25px;">
                        <div class="tab-pane fade show active" id="list-profile" role="tabpanel"
                            aria-labelledby="list-home-list">
                            <h2 class="text-center mb-1">Public profile</h2>
                            <p class="text-center">Add information about yourself </p>
                            <div class="line bg-yellow m-auto mb-4"></div>
                            <div class="row justify-content-center">
                                <form action="handle/edit-user.php" method="POST" enctype="multipart/form-data">
                                    <?php if (!empty($select_user['photo'] == null)) { ?>
                                    <?php if ($select_user['gender'] == "female") { ?>
                                    <div class="col-lg-4 text-center m-auto">
                                        <img src="<?= URL; ?>assets/images/user-female.jpg" alt=""
                                            class="rounded shadow img-fluid mb-2" id="imgshow">
                                    </div>
                                    <div class="col-8 m-auto">
                                        <div class="mb-3">
                                            <input type="file" class="form-control" name="user_pic" id="imgload">
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="col-lg-4 text-center m-auto">
                                        <img src="<?= URL; ?>assets/images/user-male.jpg" alt=""
                                            class="rounded shadow img-fluid mb-2" id="imgshow">
                                    </div>
                                    <div class="col-8 m-auto">
                                        <div class="mb-3">
                                            <input type="file" class="form-control" name="user_pic" id="imgload">
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php } else { ?>
                                    <div class="col-4 text-center col-lg-4 m-auto">
                                        <img src="<?= URL; ?>assets/images/uploads/users/<?= $select_user['photo'] ?>"
                                            alt="" class="rounded shadow-sm img-fluid mb-2" id="imgshow">
                                    </div>
                                    <div class="col-8 m-auto">
                                        <div class="mb-3">
                                            <input type="file" class="form-control" name="user_pic" id="imgload">
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="w-100"></div>
                                    <div class="row justify-content-center mt-40">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label dark-text">
                                                    Name</label>
                                                <input type="text" name="user_name" class="form-control bg-white"
                                                    value="<?= $select_user['name'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label dark-text">
                                                    Email</label>
                                                <input type="text" name="user_email" class="form-control bg-white"
                                                    value="<?= $select_user['email'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1"
                                                    class="form-label dark-text d-block">Gender </label>
                                                <select name="user_gender" class="form-select form-control bg-white"
                                                    aria-label="Default select example">
                                                    <?php if ($select_user['gender'] == null) { ?>
                                                    <option selected>Open this select menu</option>
                                                    <?php } ?>
                                                    <?php if ($select_user['gender'] == 'male') { ?>
                                                    <option value="male" selected>Male</option>
                                                    <?php } else { ?>
                                                    <option value="male">Male</option>
                                                    <?php } ?>
                                                    <?php if ($select_user['gender'] == 'female') { ?>
                                                    <option value="female" selected>female</option>
                                                    <?php } else { ?>
                                                    <option value="female">female</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <button type="submit" name="edit_user"
                                            class="secondary-btn float-end btn mt-25">Save
                                            Changes</button>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-results" role="tabpanel"
                            aria-labelledby="list-specialist-list">
                            <h2 class="text-center mb-1">Results</h2>
                            <div class="line bg-yellow m-auto mb-4"></div>
                            <table>

                            </table>
                            <div class="row justify-content-center rounded">
                                <?php foreach ($select_case as $case) : ?>
                                <div class="col-lg-6 text-center my-4">
                                    <div class="bg-white rounded shadow-sm p-4" data-bs-toggle="modal"
                                        data-bs-target="#modal_<?= $case['id'] ?>" style="cursor: pointer;">
                                        <h3 class="mb-1"><?= $case['case_name'] ?></h3>
                                        <span
                                            style="opacity:0.5;"><?= date('d/m/Y', strtotime($case['created_at'])); ?></span>
                                        <span
                                            style="opacity:0.5;"><?= date('h:i a', strtotime($case['created_at'])); ?></span>

                                    </div>
                                    <!-- Modal Report -->
                                    <div class="modal fade" id="modal_<?= $case['id'] ?>" tabindex="-1"
                                        aria-labelledby="modal_<?= $case['id'] ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal_<?= $case['id'] ?>">Report
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 mt-3 rounded">
                                                            <button type="button" class="secondary-btn float-end btn"
                                                                onclick='PrintElem("case-report")'>Print and Generate
                                                                PDF</button>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        $case_id = $case['id'];
                                                        $query = "SELECT autism_checker_results.* , autism_checker_question.checker_qustions FROM `autism_checker_results` JOIN autism_checker_question ON autism_checker_question.id = autism_checker_results.checker_question_id WHERE autism_checker_results.case_id = $case_id";
                                                        $run_query = $autism_checker_result->query($query);
                                                        $select_report = mysqli_fetch_all($run_query, MYSQLI_ASSOC);
                                                        ?>
                                                    <div class="report px-lg-5 px-3 py-4 mt-3 shadow" id="case-report">
                                                        <div
                                                            class="row justify-content-between align-items-center head">
                                                            <div class="col-md-4">
                                                                <div class="row align-items-center">
                                                                    <div class="col-md-3 col-3">
                                                                        <img src="<?= URL; ?>assets/images/autism.png"
                                                                            alt="" class="img-fluid">
                                                                    </div>
                                                                    <div class="col-md-4 col-6 p-0 text-white">
                                                                        <h1 class="mb-0 h3 dark-text">Autism</h1>
                                                                        <p class="m-0 p-0 dark-text">Specialist Helper
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <div class="d-flex flex-wrap">
                                                                    <p class="mx-2 mb-1">Name : <strong>
                                                                            <?= $case['case_name'] ?> </strong>
                                                                    </p>
                                                                    <p class="mx-2 mb-1">Age : <strong>
                                                                            <?= $case['age'] ?> </strong>
                                                                    </p>
                                                                    <p class="mx-2 mb-1">Gender : <strong>
                                                                            <?= $case['gender'] ?>
                                                                        </strong> </p>
                                                                    <p class="mx-2 mb-1">Today’s Date : <strong>
                                                                            <?= date("d-m-Y", strtotime($case['created_at'])) ?>
                                                                        </strong> </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h6 class="dark-text text-start">
                                                                    Here are the answers you provided:
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        <div class="bg-box py-3 my-3 shadow-sm">
                                                            <div class="container-fluid">
                                                                <table
                                                                    class="table table-hover table-striped table-bordered my-4">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Questions</th>
                                                                            <th>Result</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php foreach ($select_report as $report) : ?>
                                                                        <tr>
                                                                            <td class="text-start">
                                                                                <?= $report['checker_qustions'] ?></td>
                                                                            <td><?= $report['checker_question_result'] ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php endforeach ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="row pt-3 text-start">
                                                            <div class=" col-md-12">
                                                                <p>
                                                                    <?php $case_id = $case['id'];
                                                                        $result = $autism_checker_result->selectWhere("*", "case_id = $case_id AND checker_question_result = 'yes'"); ?>
                                                                    <?php if (0 <= count($result) and count($result) <= 2) {
                                                                            echo "<h5> Your risk score : <strong class='red'>" . count($result)  . "</strong> </h5>";
                                                                            echo "Score indicates week risk. You don't need to take your child to a health care";
                                                                        } elseif (3 <= count($result) and count($result) <= 7) {
                                                                            echo "<h5> Your risk score : <strong class='red'>" . count($result)  . "</strong> </h5>";
                                                                            echo "Score indicates medium risk. You should to take your child to a health care provider to administer the Follow Up Interview which is designed to go with the 20 questions.";
                                                                        } elseif (8 <= count($result) and count($result) <= 20) {
                                                                            echo "<h5> Your risk score : <strong class='red'>" . count($result)  . "</strong> </h5>";
                                                                            echo "Score indicates high risk. You should bring your child to a health care provider
                                                                            and early intervention provider for full assessment.";
                                                                        } ?>
                                                                </p>
                                                                <p>The M-CHAT-R is a screening tool, and because no
                                                                    screening tool is perfect, research recommends that
                                                                    the original 20 questions include a Follow-Up
                                                                    Interview. This interview will improve the
                                                                    specificity of the screen, and also provides an
                                                                    opportunity for you to discuss the parent or
                                                                    caregiver's specific concerns. Administering the
                                                                    M-CHAT-R Follow-Up Interview may also reduce
                                                                    unnecessary referrals<br>Thank you for your time
                                                                    with this patient and his/her
                                                                    family</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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