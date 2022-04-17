<?php

use Project\Classes\Models\long_term;
use Project\Classes\Models\patient;
use Project\Classes\Models\short_term;
use Project\Classes\Models\specialist;
use Project\Classes\Models\strength_point;
use Project\Classes\Models\weknees_point;

require_once('include/header.php');


$patient_id = $request->get('patientid');
$specialist_id = $session->get('specialist_id');

$specialist = new specialist;
$specialist_result =  $specialist->selectId("*", $specialist_id);

$patient = new patient;
$patient_result = $patient->selectId("*", $patient_id);

$strength_point = new strength_point;
$select_strength_point = $strength_point->selectWhere("*", "patient_id = $patient_id");

$weknees_point = new weknees_point;
$select_weknees_point = $weknees_point->selectWhere("*", "patient_id = $patient_id");

$long_term = new long_term;
$select_long_term = $long_term->selectWhere("*", "patient_id = $patient_id");

$short_term = new short_term;
$select_short_term = $short_term->selectWhere("*", "patient_id = $patient_id");

if ($session->has('add_error')) {
    $error = $session->get('add_error');
}

require_once('include/navbar.php');
?>
<section class="main-banner text-white d-flex justify-content-center align-items-center text-center">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10 col-md-12">
                <h1>Individual plan</h1>
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
<div class="plan py-5 rounded">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="current-level shadow-sm rounded pb-5 pt-4 px-3">
                    <div class="row justify-content-between align-items-center head pb-3">
                        <div class="col-lg-6">
                            <h3>Current level</h3>
                        </div>
                    </div>
                    <div class="content bg-box mt-5 mx-lg-5 rounded shadow-sm">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="strength-tab" data-bs-toggle="tab"
                                    data-bs-target="#strength" type="button" role="tab" aria-controls="strength"
                                    aria-selected="true">Strength points</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="weakness-tab" data-bs-toggle="tab"
                                    data-bs-target="#weakness" type="button" role="tab" aria-controls="weakness"
                                    aria-selected="false">Weakness points</button>
                            </li>
                        </ul>
                        <div class="tab-content p-4 pt-0" id="myTabContent">
                            <!-- strength point -->
                            <div class="tab-pane fade show active" id="strength" role="tabpanel"
                                aria-labelledby="strength-tab">
                                <div class="row justify-content-end align-items-center mb-3">
                                    <div class="col-lg-6">
                                        <?php if ($session->has('add_error')) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= $session->get('add_error') ?>
                                        </div>
                                        <?php endif ?>
                                        <?php $session->remove('add_error') ?>
                                    </div>
                                    <div class="col-lg-2 col-md-4">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn secondary-btn float-end" data-bs-toggle="modal"
                                            data-bs-target="#add-strength-points">
                                            <i class="fas fa-plus"></i> Add new
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="add-strength-points" tabindex="-1"
                                            aria-labelledby="add-strength-pointsLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="add-strength-pointsLabel">
                                                            Add Strength Points</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="handle/plan/add-new.php" method="post">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <input type="hidden" name="patient_id"
                                                                    value="<?= $patient_id ?>">
                                                                <label class="form-label">Add Topic</label>
                                                                <textarea class="form-control" rows="3"
                                                                    name="topic"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="submit" name="add-strength-point"
                                                                class="btn secondary-btn" value="Save
                                                                        changes">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($select_strength_point) { ?>
                                <table class="table table-hover">
                                    <thead class="bg-white">
                                        <tr>
                                            <th>Topic</th>
                                            <th class="text-center">Edite</th>
                                            <th class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($select_strength_point as $key => $point) : ?>
                                        <tr>
                                            <td><?= $point['strength_point_description'] ?></td>
                                            <td class="text-center"><a href="" data-bs-toggle="modal"
                                                    data-bs-target="#Modal<?= $point['id'] ?>"><i
                                                        class="fas fa-edit light-green fa-lg"></i></a></td>

                                            <td class="text-center">
                                                <a
                                                    href="handle/plan/delete-topic.php?delete_topic_strength=<?= $point['id'] ?>&patient_id=<?= $patient_id ?>"><i
                                                        class="fas fa-trash-alt red fa-lg"></i></a>
                                            </td>

                                            <!-- Modal Edit-->
                                            <div class="modal fade" id="Modal<?= $point['id'] ?>" tabindex="-1"
                                                aria-labelledby="ModalLabel<?= $point['id'] ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ModalLabel<?= $point['id'] ?>">
                                                                Edit Topic
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="handle/plan/edit-topic.php" method="post">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="patient_id"
                                                                    value="<?= $patient_id ?>">
                                                                <input type="hidden" name="question_id"
                                                                    value="<?= $point['id'] ?>">
                                                                <textarea class="w-100 p-3" name="topic" cols="30"
                                                                    rows="10"><?= $point['strength_point_description'] ?></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" name="edit_topic_strength"
                                                                    class="btn secondary-btn" value="Save
                                                                            changes">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                                <?php } else { ?>
                                <p class="text-center">No data yet</p>
                                <?php } ?>
                            </div>
                            <!-- weknees point -->
                            <div class="tab-pane fade" id="weakness" role="tabpanel" aria-labelledby="weakness-tab">
                                <div class="row justify-content-end mb-3">
                                    <div class="col-lg-2 col-md-4">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn secondary-btn float-end" data-bs-toggle="modal"
                                            data-bs-target="#add-weakness-points">
                                            <i class="fas fa-plus"></i> Add new
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="add-weakness-points" tabindex="-1"
                                            aria-labelledby="add-weakness-pointsLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="add-weakness-pointsLabel">
                                                            Add Weakness Points</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="handle/plan/add-new.php" method="post">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <input type="hidden" name="patient_id"
                                                                    value="<?= $patient_id ?>">
                                                                <label class="form-label">Add Topic</label>
                                                                <textarea class="form-control" rows="3"
                                                                    name="topic"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="submit" name="add-weaknees-point"
                                                                class="btn secondary-btn" value="Save
                                                                        changes">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($select_weknees_point) { ?>
                                <table class="table table-hover">
                                    <thead class="bg-white">
                                        <tr>
                                            <th>Topic</th>
                                            <th class="text-center">Edite</th>
                                            <th class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($select_weknees_point as $weak => $point) : ?>
                                        <tr>
                                            <td><?= $point['weeknees_point_description'] ?></td>
                                            <td class="text-center"><a href="" data-bs-toggle="modal"
                                                    data-bs-target="#Modal<?= $point['id'] ?>"><i
                                                        class="fas fa-edit light-green fa-lg"></i></a></td>

                                            <td class="text-center">
                                                <a
                                                    href="handle/plan/delete-topic.php?delete_topic_weaknees=<?= $point['id'] ?>&patient_id=<?= $patient_id ?>"><i
                                                        class="fas fa-trash-alt red fa-lg"></i></a>
                                            </td>

                                            <!-- Modal Edit-->
                                            <div class="modal fade" id="Modal<?= $point['id'] ?>" tabindex="-1"
                                                aria-labelledby="ModalLabel<?= $point['id'] ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ModalLabel<?= $point['id'] ?>">
                                                                Edit Topic
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="handle/plan/edit-topic.php" method="post">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="patient_id"
                                                                    value="<?= $patient_id ?>">
                                                                <input type="hidden" name="question_id"
                                                                    value="<?= $point['id'] ?>">
                                                                <textarea class="w-100 p-3" name="topic" cols="30"
                                                                    rows="10"><?= $point['weeknees_point_description'] ?></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" name="edit_topic_weaknees"
                                                                    class="btn secondary-btn" value="Save
                                                                            changes">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                                <?php } else { ?>
                                <p class="text-center">No data yet</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 mt-5">
                <div class="objectives shadow-sm rounded py-5 px-3">
                    <div class="row justify-content-between align-items-center head pb-2">
                        <div class="col-lg-6">
                            <h3>Objectives</h3>
                        </div>
                    </div>
                    <div class="content bg-box mt-5 mx-lg-5 rounded shadow-sm">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="long-tab" data-bs-toggle="tab"
                                    data-bs-target="#long" type="button" role="tab" aria-controls="long"
                                    aria-selected="true">Long Term</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="short-tab" data-bs-toggle="tab" data-bs-target="#short"
                                    type="button" role="tab" aria-controls="short" aria-selected="false">Short
                                    Term</button>
                            </li>
                        </ul>
                        <div class="tab-content p-4 pt-0" id="myTabContent">
                            <!-- long_term -->
                            <div class="tab-pane fade show active" id="long" role="tabpanel" aria-labelledby="long-tab">
                                <div class="row justify-content-end mb-3">
                                    <div class="col-lg-2 col-md-4">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn secondary-btn float-end" data-bs-toggle="modal"
                                            data-bs-target="#add-long-term">
                                            <i class="fas fa-plus"></i> Add new
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="add-long-term" tabindex="-1"
                                            aria-labelledby="add-long-termLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="add-long-termLabel">
                                                            Add Logn Term</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="handle/plan/add-new.php" method="post">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <input type="hidden" name="patient_id"
                                                                    value="<?= $patient_id ?>">
                                                                <label class="form-label">Add Topic</label>
                                                                <textarea class="form-control" rows="3"
                                                                    name="topic"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="submit" name="add-long-term"
                                                                class="btn secondary-btn" value="Save
                                                                        changes">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($select_long_term) { ?>
                                <table class="table table-hover">
                                    <thead class="bg-white">
                                        <tr>
                                            <th>Topic</th>
                                            <th class="text-center">Edite</th>
                                            <th class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($select_long_term as $key => $term) : ?>
                                        <tr>
                                            <td><?= $term['long_term_discription'] ?></td>
                                            <td class="text-center"><a href="" data-bs-toggle="modal"
                                                    data-bs-target="#Modal<?= $term['id'] ?>"><i
                                                        class="fas fa-edit light-green fa-lg"></i></a></td>

                                            <td class="text-center">
                                                <a
                                                    href="handle/plan/delete-topic.php?delete_long_term=<?= $term['id'] ?>&patient_id=<?= $patient_id ?>"><i
                                                        class="fas fa-trash-alt red fa-lg"></i></a>
                                            </td>

                                            <!-- Modal Edit-->
                                            <div class="modal fade" id="Modal<?= $term['id'] ?>" tabindex="-1"
                                                aria-labelledby="ModalLabel<?= $term['id'] ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ModalLabel<?= $term['id'] ?>">
                                                                Edit Topic
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="handle/plan/edit-topic.php" method="post">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="patient_id"
                                                                    value="<?= $patient_id ?>">
                                                                <input type="hidden" name="question_id"
                                                                    value="<?= $term['id'] ?>">
                                                                <textarea class="w-100 p-3" name="topic" cols="30"
                                                                    rows="10"><?= $term['long_term_discription'] ?></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" name="edit_long_term"
                                                                    class="btn secondary-btn" value="Save
                                                                            changes">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                                <?php } else { ?>
                                <p class="text-center">No data yet</p>
                                <?php } ?>
                            </div>
                            <!-- short_term -->
                            <div class="tab-pane fade" id="short" role="tabpanel" aria-labelledby="short-tab">
                                <div class="row justify-content-end mb-3">
                                    <div class="col-lg-2">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn secondary-btn float-end" data-bs-toggle="modal"
                                            data-bs-target="#add-short-term">
                                            <i class="fas fa-plus"></i> Add new
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="add-short-term" tabindex="-1"
                                            aria-labelledby="add-short-termLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="add-short-termLabel">
                                                            Add short term </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="handle/plan/add-new.php" method="post">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <input type="hidden" name="patient_id"
                                                                    value="<?= $patient_id ?>">
                                                                <label class="form-label">Add Topic</label>
                                                                <textarea class="form-control" rows="3"
                                                                    name="topic"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="submit" name="add-short-term"
                                                                class="btn secondary-btn" value="Save
                                                                        changes">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($select_short_term) { ?>
                                <table class="table table-hover">
                                    <thead class="bg-white">
                                        <tr>
                                            <th>Topic</th>
                                            <th class="text-center">Edite</th>
                                            <th class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($select_short_term as $term) : ?>
                                        <tr>
                                            <td><?= $term['short_term_description'] ?></td>
                                            <td class="text-center"><a href="" data-bs-toggle="modal"
                                                    data-bs-target="#Modal<?= $term['id'] ?>"><i
                                                        class="fas fa-edit light-green fa-lg"></i></a></td>

                                            <td class="text-center">
                                                <a
                                                    href="handle/plan/delete-topic.php?delete_short_term=<?= $term['id'] ?>&patient_id=<?= $patient_id ?>"><i
                                                        class="fas fa-trash-alt red fa-lg"></i></a>
                                            </td>

                                            <!-- Modal Edit-->
                                            <div class="modal fade" id="Modal<?= $term['id'] ?>" tabindex="-1"
                                                aria-labelledby="ModalLabel<?= $term['id'] ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ModalLabel<?= $term['id'] ?>">
                                                                Edit Topic
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="handle/plan/edit-topic.php" method="post">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="patient_id"
                                                                    value="<?= $patient_id ?>">
                                                                <input type="hidden" name="question_id"
                                                                    value="<?= $term['id'] ?>">
                                                                <textarea class="w-100 p-3" name="topic" cols="30"
                                                                    rows="10"><?= $term['short_term_description'] ?></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" name="edit_short_term"
                                                                    class="btn secondary-btn" value="Save
                                                                            changes">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                                <?php } else { ?>
                                <p class="text-center">No data yet</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<?php
require_once('include/footer.php');
?>