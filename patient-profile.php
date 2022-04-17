<?php

use Project\Classes\calc_scale;
use Project\Classes\Models\to_do;
use Project\Classes\Models\lovaas_results;

require_once('include/header.php');
require_once('include/navbar.php');

$patient_id = $request->get('patientid');
$session->set("patient_id", $patient_id);

$patient_result =  $patients->selectId("*", $patient_id);
$caregiver_id = $patient_result['caregiver_id'];

if (empty($patient_result)) {
    $request->redirect("specialist.php");
}

if ($caregiver_id != null) {
    $session->set("caregiver_id", $caregiver_id);
} else {
    $session->set("caregiver_id", "");
}

$now = new DateTime();
$now_date = $now->format("Y-m-d H:i:s");

$query = "SELECT * FROM `schedule` WHERE schedule_date_time >= '$now_date' AND patient_id = $patient_id GROUP BY schedule_date_time LIMIT 1";
$run_query = $schedule->query($query);
$next_schedule = mysqli_fetch_assoc($run_query);

$to_do = new to_do;
$to_do_list = $to_do->selectWhere("*", "patient_id = $patient_id");

$lovaas_result = new lovaas_results;
$calc_scale = new calc_scale;
?>

<?php if (!empty($patient_result)) { ?>
<div class="patient-profile">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-4">
                <div class="bg-box p-4 rounded shadow-sm patient-data">
                    <div class="row justify-content-center personal-img">
                        <div class="col-lg-12 text-center">
                            <?php if (!empty($patient_result['photo'] == null)) { ?>
                            <?php if ($patient_result['gender'] == "male") { ?>
                            <img src="<?= URL; ?>assets/images/user-male.jpg" alt="" class="rounded img-fluid mb-2">
                            <?php } else { ?>
                            <img src="<?= URL; ?>assets/images/user-female.jpg" alt="" class="rounded img-fluid mb-2">
                            <?php } ?>
                            <?php } else { ?>
                            <div class="col-8 col-lg-9 m-auto">
                                <img src="<?= URL; ?>assets/images/uploads/patients/<?= $patient_result['photo'] ?>"
                                    alt="" class="rounded img-fluid mb-2">
                            </div>
                            <?php } ?>
                            <h4><?= $patient_result['name'] ?> </h4>
                            <span class="d-inline-block text-center mb-3">ID : <?= $patient_result['id'] ?></span>
                            <div class="d-inline-block btn-copy ms-2" data-clipboard-text="<?= $patient_result['id'] ?>"
                                style="cursor: pointer;">
                                <span><i class="fas fa-copy"></i></span>
                            </div>
                            <br>
                            <a href="edit-patient-profile.php?patientid=<?= $patient_id ?>" class="light-green">
                                <div class="icon d-inline-block">
                                    <i class="far fa-edit"></i>
                                </div>
                            </a>
                            <a href="handle/patient.php?patient_id=<?= $patient_id ?>" class="red">
                                <div class="icon d-inline-block">
                                    <i class="far fa-trash-alt"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row justify-content-center action-btn">
                        <div class="col-xl-5 col-lg-12 col-md-5 mt-3">
                            <a href="diagnosis.php?patientid=<?= $patient_result['id'] ?>"
                                class="btn secondary-btn w-100">Diagnosis</a>
                        </div>
                        <div class="col-xl-5 col-lg-12 col-md-5 mt-3">
                            <a href="plan.php?patientid=<?= $patient_result['id'] ?>" class="btn secondary-btn w-100"
                                style="background-color: #ff5a4c;color: #fff;">Plan</a>
                        </div>
                        <div class="col-xl-5 col-lg-12 col-md-5 mt-3">
                            <a href="reports.php?patientid=<?= $patient_result['id'] ?>" class="btn secondary-btn w-100"
                                style="background-color: #00628B;color: #fff;">Reports</a>
                        </div>
                        <div class="col-xl-5 col-lg-12 col-md-5 mt-3">
                            <a href="#add-to-do" class="btn secondary-btn w-100"
                                style="background-color: #368BA9;color: #fff;" data-bs-toggle="modal">Add to do</a>
                        </div>
                        <!-- Add to do Modal -->
                        <div class="modal fade" id="add-to-do" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add To Do</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="handle/add-to-do.php" method="post">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <input type="text" name="title" id="title" class="form-control"
                                                    placeholder="Title">
                                            </div>
                                            <div class="mb-3">
                                                <textarea class="form-control" id="description" name="description"
                                                    placeholder="leave a Description" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="add-to-do" class="btn secondary-btn">Save
                                                changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Add to do Modal -->
                    </div>
                    <div class="row justify-content-center next-session mt-4">
                        <div class="col-lg-10 col-md-10 bg-white p-3 shadow-sm rounded">
                            <h5>Next Session</h5>
                            <hr>
                            <?php if ($next_schedule !== null) { ?>
                            <ul class="ps-0 mt-3">
                                <li>
                                    <i class="far fa-calendar-alt yellow me-1"></i>
                                    <span>Date :
                                        <?= date('d/m/Y', strtotime($next_schedule['schedule_date_time']));  ?></span>
                                </li>
                                <li class="mt-2">
                                    <i class="far fa-clock yellow me-1"></i>
                                    <span>Time :
                                        <?= date('h:i a', strtotime($next_schedule['schedule_date_time'])); ?></span>
                                </li>
                            </ul>
                            <?php } else { ?>
                            <p class="text-center my-2">No date yet</p>
                            <?php } ?>
                            <button type="button" class="btn secondary-btn float-end" data-bs-toggle="modal"
                                data-bs-target="#add-new-session">
                                <i class="fas fa-plus"></i> Add New
                            </button>
                            <!-- Add new Schedule Modal -->
                            <div class="modal fade" id="add-new-session" tabindex="-1" aria-labelledby="add-new"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="add-new">Add new Schedule</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="handle/schedule.php" method="post">
                                            <div class="modal-body">
                                                <div class="row align-items-end ">
                                                    <div class="col-lg-10">
                                                        <div id="duplicater" class="row align-items-end my-3">
                                                            <div class="col-lg-12">
                                                                <div class="input">
                                                                    <label class="form-label dark-text f-800">Date &
                                                                        time</label>
                                                                    <input type="datetime-local" id="datetime"
                                                                        name="datetime_0" class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 my-3">
                                                        <button type="button" class="secondary-btn btn text-white py-0"
                                                            onclick="duplicate()">
                                                            <i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="add-schedule" class="btn secondary-btn">Save
                                                    changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-box rounded mt-4 p-4">
                    <h3>Case Overview</h3>
                    <?php
                        $scale_array = $session->get('scale_array');
                        $RB = $scale_array[0];
                        $SI = $scale_array[1];
                        $SC = $scale_array[2];
                        $ER = $scale_array[3];
                        $CS = $scale_array[4];
                        $MS = $scale_array[5];
                        $array = [$RB, $SI, $SC, $ER, $CS, $MS];
                        $final_degree =  $calc_scale->calc_all($RB, $SI, $SC, $ER, $CS, $MS);
                        ?>
                    <canvas class="mb-4" id="myChart" width="400" height="400"></canvas>
                    <strong>Autism coefficient :</strong>
                    <div class="progress shadow">
                        <div class="progress-bar" role="progressbar" style="width: <?= $final_degree ?>%;"
                            aria-valuenow="<?= $final_degree ?>" aria-valuemin="0" aria-valuemax="100">
                            <?= $final_degree ?>%</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 pt-lg-0 pt-4">
                <div class="bg-box rounded shadow-sm data-info">
                    <div class="head">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-xl-4 col-lg-10 col-8">
                                <div class="icon">
                                    <i class="fas fa-user fa-lg"></i>
                                </div>
                                <h4 class="d-inline-block mb-0"> Personal info </h4>
                            </div>
                        </div>
                    </div>
                    <div class="info">
                        <!-- <div class="row mb-3">
                            <div class="col-lg-4 col-md-4">
                                <h5 class="f-400">Patient name</h5>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <h5> <?= $patient_result['name'] ?></h5>
                            </div>
                        </div> -->
                        <div class="row mb-3">
                            <div class="col-lg-4 col-md-4">
                                <h5 class="f-400">Date of birth</h5>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <h5><?= $patient_result['date_of_birth'] ?> </h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4 col-md-4">
                                <h5 class="f-400">Age</h5>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <h5> <?= $patient_result['age'] ?> years old</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4 col-md-4">
                                <h5 class="f-400">Gender</h5>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <h5><?= $patient_result['gender'] ?></h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4 col-md-4">
                                <h5 class="f-400">Rank among brothers</h5>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <h5><?= $patient_result['arr_btw_bro'] ?></h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4 col-md-4">
                                <h5 class="f-400">Number of brothers</h5>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <h5><?= $patient_result['No_of_bro'] ?></h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4 col-md-4">
                                <h5 class="f-400">Class</h5>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <h5><?= $patient_result['class'] ?></h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4 col-md-4">
                                <h5 class="f-400">School</h5>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <h5><?= $patient_result['school'] ?> </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-box rounded shadow-sm data-info mt-4">
                    <div class="head">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-xl-4 col-lg-10 col-8">
                                <div class="icon">
                                    <i class="fas fa-user fa-lg"></i>
                                </div>
                                <h4 class="d-inline-block mb-0"> caregiver info </h4>
                            </div>
                        </div>
                    </div>
                    <div class="info">
                        <div class="row mb-3">
                            <div class="col-lg-4 col-md-4">
                                <h5 class="f-400">Caregiver name</h5>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <h5> <?= $patient_result['caregiver_name'] ?> </h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4 col-md-4">
                                <h5 class="f-400">Relationship with patient since</h5>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <h5> <?= $patient_result['caregiver_relationship'] ?> </h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4 col-md-4">
                                <h5 class="f-400">Phone number</h5>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <h5><?= $patient_result['caregiver_phone'] ?> </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-box rounded shadow-sm data-info mt-4">
                    <div class="head">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-xl-4 col-lg-10 col-8">
                                <div class="icon">
                                    <i class="far fa-list-alt fa-lg"></i>
                                </div>
                                <h4 class="d-inline-block mb-0"> TO DO </h4>
                            </div>
                        </div>
                    </div>
                    <div class="info table-responsive" style="max-height: 400px; overflow: auto;">
                        <?php if (!empty($to_do_list)) { ?>
                        <table class="table table-responsive-sm table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Finished</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($to_do_list as $to_do) : ?>
                                <tr>
                                    <td data-bs-toggle="modal" data-bs-target="#Modal_<?= $to_do['id'] ?>"
                                        style="cursor: pointer;"><?= $to_do['title'] ?></td>
                                    <?php if ($to_do['done'] == 'done') { ?>
                                    <td><span class="badge bg-success">Finished</span></td>
                                    <?php } else { ?>
                                    <td><span class="badge bg-danger">not finished</span></td>
                                    <?php } ?>
                                    <td data-bs-toggle="modal" data-bs-target="#Modal_edit_<?= $to_do['id'] ?>"
                                        style="cursor: pointer;"><i class="far fa-edit light-green fa-lg"></i></td>
                                    <td><a
                                            href="handle/add-to-do.php?to_do_id=<?= $to_do['id'] ?>&to_do_title=<?= $to_do['title'] ?>&to_do_details=<?= $to_do['to_do_details'] ?>"><i
                                                class="far fa-trash-alt red fa-lg"></i></a></td>
                                </tr>
                                <!-- Modal for To do -->
                                <div class="modal fade" id="Modal_<?= $to_do['id'] ?>" tabindex="-1"
                                    aria-labelledby="Modal_<?= $to_do['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="Modal_<?= $to_do['id'] ?>">
                                                    <?= $to_do['title'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?= $to_do['to_do_details'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal for Edit -->
                                <div class="modal fade" id="Modal_edit_<?= $to_do['id'] ?>" tabindex="-1"
                                    aria-labelledby="Modal_<?= $to_do['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="Modal_<?= $to_do['id'] ?>">
                                                    Edit This mission</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="handle/add-to-do.php" method="POST">
                                                <div class="modal-body">
                                                    <input type="hidden" name="to_do_id" value="<?= $to_do['id'] ?>">
                                                    <div class="mb-3">
                                                        <input type="text" name="title" class="form-control"
                                                            placeholder="Enter a Title" value="<?= $to_do['title'] ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <textarea name="desc" class="form-control" rows="3"
                                                            placeholder="Leave a Description"
                                                            class="py-1"><?= $to_do['to_do_details'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="edit_to_do"
                                                        class="btn secondary-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            </tbody>
                        </table>
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
<div class="not_found vh-100 d-flex justify-content-center align-items-center text-center">
    <div class="content">
        <h4>OOPS! PAGE NOT FOUND</h4>
        <h1>404</h1>
        <p>we are sorry , But the page you requested was not found</p>
    </div>
</div>
<?php } ?>


<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['RB', 'SI', 'SC', 'ER', 'CS', 'MS'],
        datasets: [{
            label: 'SCALE',
            data: [<?= $RB ?>, <?= $SI ?>, <?= $SC ?>, <?= $ER ?>, <?= $CS ?>, <?= $MS ?>],
            backgroundColor: [
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            hoverOffset: 4
        }]
    },
});
</script>

<script>
var i = 0;
var original = document.getElementById('duplicater');
var date = document.getElementById('datetime');


function duplicate() {
    var clone = original.cloneNode(true);
    clone.id = "duplicater" + ++i;
    console.log(i);
    original.parentNode.appendChild(clone);
    // i += 1;
    date.setAttribute('name', 'datetime_' + i);

}
</script>

<?php
require_once('include/footer.php');
?>