<?php
if (!$session->get('which_user')) {
    $request->redirect('index.php');
}

use Project\Classes\Models\caregiver;
use Project\Classes\Models\patient;
use Project\Classes\Models\schedule;
use Project\Classes\Models\notify_to_do;
use Project\Classes\Models\notify_schedule;
use Project\Classes\Models\specialist;
use Project\Classes\Models\Users;

$patients = new patient;
$schedule = new schedule;
$notify_to_do = new notify_to_do;
$notify_schedule = new notify_schedule;
$specialist = new specialist;
$caregiver = new caregiver;
$user = new Users;
?>

<?php if ($session->get('which_user') == 'specialist') { ?>
<?php
    $specialist_id = $session->get('specialist_id');
    $select_specialist = $specialist->selectId("*", "$specialist_id");
    $notif_schedule = $schedule->selectWhere("*", "specialist_id = $specialist_id");
    $date_time_arr = [];
    $today = date("d-m-Y");
    foreach ($notif_schedule as $key => $value) {
        $date_time_arr[] = [
            'patient_id' => $value['patient_id'],
            'schedule_date' => date('d-m-Y', strtotime($value['schedule_date_time'])),
            'schedule_time' => date('h:i a', strtotime($value['schedule_date_time'])),
        ];
    }

    $notify_schedule = [];
    foreach ($date_time_arr as $value) {
        if ($value['schedule_date'] == $today) {
            $notify_schedule[] = [
                'patient_id' => $value['patient_id'],
                'schedule_date' => $value['schedule_date'],
                'schedule_time' => $value['schedule_time']
            ];
        }
    }
    ?>
<nav class="navbar navbar-expand-lg bg-nav">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <a class="navbar-brand" href="specialist.php">
            <img src="<?= URL; ?>assets/images/autism.png" alt="logo" width="40">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="specialist.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="organizations.php">Orgnization</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="articales.php">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
        <!--== notification dropdown ==-->
        <div class="dropdown me-5 notification position-relative ">
            <a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-bell fa-lg"></i>
                <div class="number text-white">
                    <span><?= count($notify_schedule) ?></span>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="dropdownMenuLink">
                <?php if (!empty($notify_schedule)) { ?>
                <?php foreach ($notify_schedule as $notify) { ?>
                <?php $notify_patient_id = $notify['patient_id'];
                            $notify_patients = $patients->selectWhere("*", "id = $notify_patient_id"); ?>
                <?php foreach ($notify_patients as $patient) { ?>
                <li class="dropdown-item">
                    <div class="item py-2">
                        <span class="badge bg-light text-dark">Today session</span>
                        <p class="my-1">You have session with <strong><a
                                    href="<?= URL ?>patient-profile.php?patientid=<?= $patient['id'] ?>"
                                    class="dark-text"><?= $patient['name'] ?></a></strong>
                        </p>
                        <?php if ($notify['patient_id'] == $patient['id']) { ?>
                        <span
                            class="badge bg-light text-dark"><?= date('d/m/Y', strtotime($notify['schedule_date'])); ?></span>
                        <span
                            class="badge bg-light text-dark"><?= date('h:i a', strtotime($notify['schedule_time'])); ?></span>
                        <?php } ?>
                    </div>
                </li>
                <li>
                    <hr class="dropdown-divider m-0">
                </li>
                <?php } ?>
                <?php } ?>
                <?php } else { ?>
                <li class="dropdown-item p-5">No date Found !</li>
                <?php } ?>
            </ul>
        </div>
        <!-- ==notification dropdown== -->
        <!-- ==Profile dropdown== -->
        <div class="dropdown pe-2">
            <div class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <?php if ($select_specialist['photo'] != null) { ?>
                <img src="<?= URL; ?>assets/images/uploads/specialist/<?= $select_specialist['photo'] ?>" alt=""
                    width="40px" height="40px" class="rounded-circle">
                <?php } else { ?>
                <img src="<?= URL; ?>assets/images/user-male.jpg" alt="" width="40px" height="40px"
                    class="rounded-circle">
                <?php } ?>
            </div>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="specialist-profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="handle/logout.php">log out</a></li>
            </ul>
        </div>
        <!-- ==Profile dropdown== -->
    </div>
</nav>

<?php } elseif ($session->get('which_user') == 'caregiver') { ?>
<?php $caregiver_id = $session->get('caregiver_id');
    $select_caregiver = $caregiver->selectId("*", "$caregiver_id");
    $get_notify = $notify_to_do->selectWhere("*", "caregiver_id = $caregiver_id");
    $get_notify_schedule = $notify_schedule->selectWhere("*", "caregiver_id = $caregiver_id");

    $date_time_arr = [];
    $today = date("d-m-Y");
    foreach ($get_notify_schedule as $key => $value) {
        $date_time_arr[] = [
            'id' => $value['id'],
            'patient_id' => $value['patient_id'],
            'schedule_date' => date('d-m-Y', strtotime($value['schedule_date_time'])),
            'schedule_time' => date('h:i a', strtotime($value['schedule_date_time'])),
        ];
    }

    $notify_caregiver_today = [];
    foreach ($date_time_arr as $value) {
        if ($value['schedule_date'] == $today) {
            $notify_caregiver_today[] = [
                'id' => $value['id'],
                'patient_id' => $value['patient_id'],
                'schedule_date' => $value['schedule_date'],
                'schedule_time' => $value['schedule_time']
            ];
        }
    }
    ?>
<nav class="navbar navbar-expand-lg bg-nav">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <a class="navbar-brand" href="caregiver.php">
            <img src="<?= URL; ?>assets/images/autism.png" alt="logo" width="40">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="caregiver.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="organizations.php">Orgnization</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="articales.php">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>

        <!--== notification dropdown ==-->
        <div class="dropdown me-5 notification position-relative ">
            <a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-bell fa-lg"></i>
                <div class="number text-white">
                    <span><?= count($get_notify) + count($date_time_arr) + count($notify_caregiver_today) ?></span>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="dropdownMenuLink">
                <?php if (!(empty($get_notify)) || !empty($date_time_arr)) { ?>
                <?php foreach ($date_time_arr as $notify_schedule) : ?>
                <?php $patient_id = $notify_schedule['patient_id'];
                            $patient = $patients->selectId("name", "$patient_id") ?>
                <li class="dropdown-item">
                    <div class="item py-2">
                        <span class="badge bg-info dark-text">New session</span>
                        <p class="my-1">You have new session for <strong><?= $patient['name'] ?></strong>
                        </p>
                        <span
                            class="badge bg-light text-dark"><?= date('d/m/Y', strtotime($notify_schedule['schedule_date'])); ?></span>
                        <span
                            class="badge bg-light text-dark"><?= date('h:i a', strtotime($notify_schedule['schedule_time'])); ?></span>
                        <a href="handle/schedule.php?notify_id=<?= $notify_schedule['id'] ?>"
                            class="text-end d-block"><span class="badge bg-light light-green"><i
                                    class="fas fa-check-double me-2"></i>Mark as read
                            </span></a>
                    </div>
                </li>
                <li>
                    <hr class="dropdown-divider m-0">
                </li>
                <?php endforeach ?>
                <?php foreach ($get_notify as $notify) : ?>
                <?php $patient_id = $notify['patient_id'];
                            $patient = $patients->selectId("name", "$patient_id") ?>
                <li class="dropdown-item py-3">
                    <span class="badge bg-success">To DO</span>
                    <span
                        class="badge bg-light text-dark"><?= date('d/m/Y', strtotime($notify['created_at'])); ?></span>
                    <span class="badge bg-light text-dark"><?= $patient['name'] ?></span>
                    <p class="my-1">Your have new mission from your specialist </p>
                    <p class="my-1">Title : <strong><?= $notify['to_do_title'] ?></strong></p>
                    <a href="handle/add-to-do.php?notify_id=<?= $notify['id'] ?>" class="text-end d-block"><span
                            class="badge bg-light light-green"><i class="fas fa-check-double me-2"></i>Mark as read
                        </span></a>
                </li>
                <li>
                    <hr class="dropdown-divider m-0">
                </li>
                <?php endforeach ?>
                <?php foreach ($notify_caregiver_today as $today) : ?>
                <li class="dropdown-item py-3">
                    <span class="badge bg-warning  dark-text">Today</span>
                    <span class="badge bg-light text-dark"><?= $patient['name'] ?></span>
                    <p class="my-1">Your have mission Session today with your specialist </p>
                    <span class="badge bg-light text-dark"><?= $today['schedule_date'] ?></span>
                    <span class="badge bg-light text-dark"><?= $today['schedule_time'] ?></span>
                    <a href="handle/add-to-do.php?notify_id=<?= $today['id'] ?>" class="text-end d-block"><span
                            class="badge bg-light light-green"><i class="fas fa-check-double me-2"></i>Mark as read
                        </span></a>
                </li>
                <li>
                    <hr class="dropdown-divider m-0">
                </li>
                <?php endforeach ?>
                <?php } else { ?>
                <li class="dropdown-item p-5">No date Found !</li>
                <?php } ?>
            </ul>
        </div>
        <!-- ==notification dropdown== -->

        <div class="dropdown pe-2">
            <div class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <?php if ($select_caregiver['photo'] != null) { ?>
                <img src="<?= URL; ?>assets/images/uploads/caregiver/<?= $select_caregiver['photo'] ?>" alt=""
                    width="40px" height="40px" class="rounded-circle">
                <?php } else { ?>
                <img src="<?= URL; ?>assets/images/user-male.jpg" alt="" width="40px" height="40px"
                    class="rounded-circle">
                <?php } ?>
            </div>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="caregiver-profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="handle/logout.php">log out</a></li>
            </ul>
        </div>
    </div>
</nav>

<?php } elseif ($session->get('which_user') == 'user') { ?>
<?php $user_id = $session->get('user_id');
    $select_user = $user->selectId("*", "$user_id");
    ?>
<nav class="navbar navbar-expand-lg bg-nav">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <a class="navbar-brand" href="user.php">
            <img src="<?= URL; ?>assets/images/autism.png" alt="logo" width="40">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="user.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="organizations.php">Orgnization</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="articales.php">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>

        </div>
        <div class="dropdown pe-2">
            <div class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <?php if ($select_user['photo'] != null) { ?>
                <img src="<?= URL; ?>assets/images/uploads/users/<?= $select_user['photo'] ?>" alt="" width="40px"
                    height="40px" class="rounded-circle">
                <?php } else { ?>
                <img src="<?= URL; ?>assets/images/user-male.jpg" alt="" width="40px" height="40px"
                    class="rounded-circle">
                <?php } ?>
            </div>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="user-profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="handle/logout.php">log out</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php } ?>