<?php

use Project\Classes\Models\specialist;

require_once('include/header.php');
require_once('include/navbar.php');

$specialist = new specialist;
$specialist_id = $session->get('specialist_id');
$select_specialist = $specialist->selectId("*", $specialist_id);

$patients_results = $patients->selectWhere("id ,name , age , caregiver_phone", "spcialist_id = $specialist_id");

$query = "SELECT schedule.id , schedule.schedule_date_time , patient.id AS p_id , patient.name FROM `schedule` join patient on schedule.patient_id = patient.id where schedule.specialist_id = $specialist_id";
$run_query =  $schedule->query($query);
$results_schedule = mysqli_fetch_all($run_query, MYSQLI_ASSOC);

?>

<section class="main-banner text-white d-flex justify-content-center align-items-center text-center">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10 col-md-12">
                <h1>Welcome Dr. <?= $select_specialist['name']; ?> </h1>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Reprehenderit
                    illum odit doloremque sed distinctio cum sapiente reiciendis modi, soluta minima numquam consectetur
                    iure enim hic..</p>
            </div>
        </div>
    </div>
</section>

<section class="sp-details pt-5 pb-5">
    <div class="container">
        <div class="sp-details-tabs">
            <ul class="nav nav-pills row justify-content-center mb-20" id="pills-tab" role="tablist">
                <li class="nav-item col-lg-4 col-md-8" role="presentation">
                    <div class="nav-link text-center py-4" id="pills-add-patient-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-add-patient" role="tab" aria-controls="pills-add-patient"
                        aria-selected="true">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                            style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g>
                                <g>
                                    <path class="st0"
                                        d="M367.6,256.9c-9.8-4.7-19.9-8.7-30.1-12.1C370.6,220,392,180.5,392,136C392,61,331,0,256,0S120,61,120,136c0,44.5,21.5,84.1,54.6,108.9c-30.4,10-58.9,25.6-83.8,46.1c-45.7,37.6-77.5,90.1-89.5,147.7c-3.8,18.1,0.7,36.6,12.4,50.9c11.6,14.2,28.7,22.4,47,22.4H307c11,0,20-9,20-20s-9-20-20-20H60.7c-8.5,0-13.7-4.8-16-7.6c-4-4.9-5.5-11.3-4.2-17.5c20.8-99.7,108.7-172.5,210.2-175c1.8,0.1,3.5,0.1,5.3,0.1c1.8,0,3.6,0,5.4-0.1c31.1,0.7,61,7.8,89,21.1c10,4.7,21.9,0.5,26.6-9.5C381.8,273.6,377.5,261.7,367.6,256.9z M260.9,231.9c-1.6,0-3.2,0-4.9,0c-1.6,0-3.2,0-4.8,0c-50.7-2.5-91.2-44.6-91.2-95.9c0-52.9,43.1-96,96-96s96,43.1,96,96C352,187.3,311.6,229.3,260.9,231.9z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path class="st0"
                                        d="M492,397h-55v-55c0-11-9-20-20-20s-20,9-20,20v55h-55c-11,0-20,9-20,20s9,20,20,20h55v55c0,11,9,20,20,20s20-9,20-20v-55h55c11,0,20-9,20-20S503,397,492,397z" />
                                </g>
                            </g>
                        </svg>
                        <h3 class="dark-title">Add patient</h3>
                        <P class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis ipsum
                            molestiae
                            quae ratione.</P>
                    </div>
                </li>
                <li class="nav-item col-lg-4 col-md-8" role="presentation">
                    <div class="nav-link text-center py-4" id="pills-list-of-patient-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-list-of-patient" role="tab" aria-controls="pills-list-of-patient"
                        aria-selected="false">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                            style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g>
                                <g>
                                    <path
                                        d="M448,0H64C28.715,0,0,28.715,0,64v384c0,35.285,28.715,64,64,64h384c35.285,0,64-28.715,64-64V64C512,28.715,483.285,0,448,0z M469.333,448c0,11.776-9.579,21.333-21.333,21.333H64c-11.755,0-21.333-9.557-21.333-21.333V64c0-11.755,9.579-21.333,21.333-21.333h384c11.755,0,21.333,9.579,21.333,21.333V448z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M147.627,119.893c-1.067-2.773-2.56-4.907-4.48-7.04c-1.067-0.853-2.133-1.707-3.2-2.56c-1.28-0.853-2.56-1.493-3.84-1.92c-1.28-0.64-2.56-1.067-3.84-1.28c-4.267-0.853-8.533-0.427-12.373,1.28c-2.56,1.067-4.907,2.56-7.04,4.48c-1.92,2.133-3.413,4.267-4.48,7.04c-1.067,2.56-1.707,5.333-1.707,8.107s0.64,5.547,1.707,8.107c1.067,2.773,2.56,4.907,4.48,7.04c4.053,3.84,9.6,6.187,15.147,6.187c1.28,0,2.773-0.213,4.267-0.427c1.28-0.213,2.56-0.64,3.84-1.28c1.28-0.427,2.56-1.067,3.84-1.92c1.067-0.853,2.133-1.707,3.2-2.56c3.84-4.053,6.187-9.6,6.187-15.147C149.333,125.227,148.693,122.453,147.627,119.893z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M384,106.667H213.333C201.557,106.667,192,116.224,192,128s9.557,21.333,21.333,21.333H384c11.776,0,21.333-9.557,21.333-21.333S395.776,106.667,384,106.667z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M148.907,251.733c-0.213-1.28-0.64-2.56-1.28-3.84c-0.427-1.28-1.067-2.56-1.92-3.84c-0.853-1.067-1.707-2.133-2.56-3.2c-2.133-1.92-4.48-3.413-7.04-4.48c-5.12-2.133-11.093-2.133-16.213,0c-2.56,1.067-4.907,2.56-7.04,4.48c-0.853,1.067-1.707,2.133-2.56,3.2c-0.853,1.28-1.493,2.56-1.92,3.84c-0.64,1.28-1.067,2.56-1.28,3.84c-0.213,1.493-0.427,2.987-0.427,4.267c0,5.547,2.347,11.093,6.187,15.147c4.053,3.84,9.6,6.187,15.147,6.187s11.093-2.347,15.147-6.187c3.84-4.053,6.187-9.6,6.187-15.147C149.333,254.72,149.12,253.227,148.907,251.733z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M384,234.667H213.333C201.557,234.667,192,244.224,192,256s9.557,21.333,21.333,21.333H384c11.776,0,21.333-9.557,21.333-21.333S395.776,234.667,384,234.667z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M147.627,375.893c-1.067-2.773-2.56-4.907-4.48-7.04c-5.973-5.781-15.36-7.68-23.253-4.48c-2.56,1.067-4.907,2.56-7.04,4.48c-1.92,2.133-3.413,4.48-4.48,7.04s-1.707,5.333-1.707,8.107c0,5.76,2.133,11.093,6.187,15.147c4.053,4.032,9.387,6.187,15.147,6.187s11.093-2.155,15.147-6.187c4.053-4.053,6.187-9.387,6.187-15.147C149.333,381.227,148.907,378.453,147.627,375.893z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M384,362.667H213.333C201.557,362.667,192,372.203,192,384c0,11.797,9.557,21.333,21.333,21.333H384c11.776,0,21.333-9.536,21.333-21.333C405.333,372.203,395.776,362.667,384,362.667z" />
                                </g>
                            </g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                        </svg>

                        <h3 class="dark-title">List of patients</h3>
                        <P class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis ipsum
                            molestiae
                            quae ratione.</P>
                        <!-- </div> -->
                    </div>
                </li>
                <li class="nav-item col-lg-4 col-md-8" role="presentation">
                    <div class="nav-link text-center py-4" id="pills-schedule-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-schedule" role="tab" aria-controls="pills-schedule"
                        aria-selected="false">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                            style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <path class="st0"
                                d="M456.8,32.1h-25.2V15c0-8.3-6.7-15-15-15s-15,6.7-15,15v17.1h-34.3V15c0-8.3-6.7-15-15-15s-15,6.7-15,15v17.1h-34.3V15c0-8.3-6.7-15-15-15s-15,6.7-15,15v17.1h-34.3V15c0-8.3-6.7-15-15-15s-15,6.7-15,15v17.1h-34.3V15c0-8.3-6.7-15-15-15s-15,6.7-15,15v17.1h-34.3V15c0-8.3-6.7-15-15-15s-15,6.7-15,15v17.1H55.2C24.7,32.1,0,56.9,0,87.3v369.5C0,487.3,24.7,512,55.2,512h345.4C462,512,512,462,512,400.6V87.3C512,56.9,487.3,32.1,456.8,32.1L456.8,32.1z M55.2,62.1h25.2v17.1c0,8.3,6.7,15,15,15s15-6.7,15-15V62.1h34.3v17.1c0,8.3,6.7,15,15,15s15-6.7,15-15V62.1h34.3v17.1c0,8.3,6.7,15,15,15s15-6.7,15-15V62.1h34.3v17.1c0,8.3,6.7,15,15,15s15-6.7,15-15V62.1h34.3v17.1c0,8.3,6.7,15,15,15s15-6.7,15-15V62.1h34.3v17.1c0,8.3,6.7,15,15,15s15-6.7,15-15V62.1h25.2c13.9,0,25.2,11.3,25.2,25.2v41.2H30V87.3C30,73.4,41.3,62.1,55.2,62.1L55.2,62.1z M400.6,482c-44.9,0-81.4-36.5-81.4-81.4s36.5-81.4,81.4-81.4c44.9,0,81.4,36.5,81.4,81.4C482,445.5,445.5,482,400.6,482L400.6,482z M400.6,289.2c-61.4,0-111.4,50-111.4,111.4c0,32.1,13.6,61.1,35.4,81.4H55.2C41.3,482,30,470.7,30,456.8V158.5h452v166.1C461.7,302.8,432.7,289.2,400.6,289.2z" />
                            <path class="st0"
                                d="M159.6,208.9c-3.9,0-7.8,1.6-10.6,4.4s-4.4,6.7-4.4,10.6c0,3.9,1.6,7.8,4.4,10.6c2.8,2.8,6.7,4.4,10.6,4.4s7.8-1.6,10.6-4.4c2.8-2.8,4.4-6.7,4.4-10.6c0-3.9-1.6-7.8-4.4-10.6S163.6,208.9,159.6,208.9z" />
                            <path class="st0"
                                d="M223.9,208.9c-3.9,0-7.8,1.6-10.6,4.4s-4.4,6.7-4.4,10.6c0,3.9,1.6,7.8,4.4,10.6s6.7,4.4,10.6,4.4c3.9,0,7.8-1.6,10.6-4.4s4.4-6.7,4.4-10.6c0-3.9-1.6-7.8-4.4-10.6S227.8,208.9,223.9,208.9z" />
                            <path class="st0"
                                d="M288.1,208.9c-4,0-7.8,1.6-10.6,4.4s-4.4,6.7-4.4,10.6c0,3.9,1.6,7.8,4.4,10.6s6.7,4.4,10.6,4.4c4,0,7.8-1.6,10.6-4.4s4.4-6.7,4.4-10.6c0-3.9-1.6-7.8-4.4-10.6S292.1,208.9,288.1,208.9z" />
                            <path class="st0"
                                d="M352.4,208.9c-4,0-7.8,1.6-10.6,4.4s-4.4,6.7-4.4,10.6c0,3.9,1.6,7.8,4.4,10.6c2.8,2.8,6.7,4.4,10.6,4.4s7.8-1.6,10.6-4.4s4.4-6.7,4.4-10.6c0-3.9-1.6-7.8-4.4-10.6S356.3,208.9,352.4,208.9z" />
                            <path class="st0"
                                d="M416.7,208.9c-4,0-7.8,1.6-10.6,4.4s-4.4,6.7-4.4,10.6c0,3.9,1.6,7.8,4.4,10.6c2.8,2.8,6.7,4.4,10.6,4.4s7.8-1.6,10.6-4.4s4.4-6.7,4.4-10.6c0-3.9-1.6-7.8-4.4-10.6S420.6,208.9,416.7,208.9z" />
                            <path class="st0"
                                d="M95.3,273.1c-3.9,0-7.8,1.6-10.6,4.4c-2.8,2.8-4.4,6.7-4.4,10.6c0,4,1.6,7.8,4.4,10.6c2.8,2.8,6.7,4.4,10.6,4.4s7.8-1.6,10.6-4.4s4.4-6.7,4.4-10.6c0-3.9-1.6-7.8-4.4-10.6C103.2,274.7,99.3,273.1,95.3,273.1z" />
                            <path class="st0"
                                d="M159.6,273.1c-3.9,0-7.8,1.6-10.6,4.4c-2.8,2.8-4.4,6.7-4.4,10.6c0,4,1.6,7.8,4.4,10.6c2.8,2.8,6.7,4.4,10.6,4.4s7.8-1.6,10.6-4.4c2.8-2.8,4.4-6.7,4.4-10.6s-1.6-7.8-4.4-10.6C167.4,274.7,163.6,273.1,159.6,273.1z" />
                            <path class="st0"
                                d="M223.9,273.1c-3.9,0-7.8,1.6-10.6,4.4c-2.8,2.8-4.4,6.7-4.4,10.6s1.6,7.8,4.4,10.6s6.7,4.4,10.6,4.4c3.9,0,7.8-1.6,10.6-4.4s4.4-6.7,4.4-10.6c0-3.9-1.6-7.8-4.4-10.6C231.7,274.7,227.8,273.1,223.9,273.1z" />
                            <path class="st0"
                                d="M288.1,273.1c-4,0-7.8,1.6-10.6,4.4c-2.8,2.8-4.4,6.7-4.4,10.6c0,4,1.6,7.8,4.4,10.6s6.6,4.4,10.6,4.4s7.8-1.6,10.6-4.4s4.4-6.7,4.4-10.6c0-3.9-1.6-7.8-4.4-10.6C295.9,274.7,292.1,273.1,288.1,273.1z" />
                            <path class="st0"
                                d="M95.3,337.4c-3.9,0-7.8,1.6-10.6,4.4s-4.4,6.7-4.4,10.6c0,4,1.6,7.8,4.4,10.6c2.8,2.8,6.7,4.4,10.6,4.4c3.9,0,7.8-1.6,10.6-4.4c2.8-2.8,4.4-6.7,4.4-10.6c0-3.9-1.6-7.8-4.4-10.6C103.2,339,99.3,337.4,95.3,337.4z" />
                            <path class="st0"
                                d="M159.6,337.4c-3.9,0-7.8,1.6-10.6,4.4s-4.4,6.7-4.4,10.6c0,4,1.6,7.8,4.4,10.6c2.8,2.8,6.7,4.4,10.6,4.4s7.8-1.6,10.6-4.4c2.8-2.8,4.4-6.7,4.4-10.6c0-3.9-1.6-7.8-4.4-10.6C167.4,339,163.6,337.4,159.6,337.4z" />
                            <path class="st0"
                                d="M223.9,337.4c-3.9,0-7.8,1.6-10.6,4.4s-4.4,6.7-4.4,10.6c0,4,1.6,7.8,4.4,10.6c2.8,2.8,6.7,4.4,10.6,4.4c3.9,0,7.8-1.6,10.6-4.4c2.8-2.8,4.4-6.7,4.4-10.6c0-3.9-1.6-7.8-4.4-10.6C231.7,339,227.8,337.4,223.9,337.4z" />
                            <path class="st0"
                                d="M95.3,401.7c-3.9,0-7.8,1.6-10.6,4.4c-2.8,2.8-4.4,6.7-4.4,10.6c0,3.9,1.6,7.8,4.4,10.6c2.8,2.8,6.7,4.4,10.6,4.4c3.9,0,7.8-1.6,10.6-4.4c2.8-2.8,4.4-6.7,4.4-10.6c0-3.9-1.6-7.8-4.4-10.6S99.3,401.7,95.3,401.7z" />
                            <path class="st0"
                                d="M159.6,401.7c-3.9,0-7.8,1.6-10.6,4.4c-2.8,2.8-4.4,6.7-4.4,10.6c0,3.9,1.6,7.8,4.4,10.6c2.8,2.8,6.7,4.4,10.6,4.4s7.8-1.6,10.6-4.4c2.8-2.8,4.4-6.7,4.4-10.6c0-3.9-1.6-7.8-4.4-10.6C167.4,403.3,163.6,401.7,159.6,401.7z" />
                            <path class="st0"
                                d="M223.9,401.7c-3.9,0-7.8,1.6-10.6,4.4s-4.4,6.7-4.4,10.6c0,3.9,1.6,7.8,4.4,10.6s6.7,4.4,10.6,4.4c3.9,0,7.8-1.6,10.6-4.4s4.4-6.7,4.4-10.6c0-3.9-1.6-7.8-4.4-10.6S227.8,401.7,223.9,401.7z" />
                            <path class="st0"
                                d="M432.7,385.6h-17.1v-17.1c0-8.3-6.7-15-15-15s-15,6.7-15,15v32.1c0,8.3,6.7,15,15,15h32.1c8.3,0,15-6.7,15-15C447.7,392.3,441,385.6,432.7,385.6z" />
                        </svg>

                        <h3 class="dark-title">Schedule</h3>
                        <P class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis ipsum
                            molestiae quae ratione.</P>
                    </div>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade bg-box p-lg-5 p-md-4 p-3 rounded" id="pills-add-patient" role="tabpanel"
                    aria-labelledby="pills-add-patient-tab">
                    <!-- Create patient Account-->
                    <div class="create-patient-account">
                        <div class="info">
                            <h2 class="text-blue">
                                Create Patient Account
                            </h2>
                            <div class="line bg-yellow"></div>
                            <form action="handle/patient.php" method="POST" enctype="multipart/form-data">
                                <div class="row mt-40">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label dark-text">
                                                Name <span class="red">*</span></label>
                                            <input type="text" name="patient_name" class="form-control bg-white"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label dark-text">Date of
                                                Birth <span class="red">*</span></label>
                                            <input type="date" name="patient_date" class="form-control bg-white"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Photo</label>
                                            <input class="form-control" type="file" name="patient_pic" value="null">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1"
                                                class="form-label dark-text d-block">Gender <span
                                                    class="red">*</span></label>
                                            <select name="patient_gender" class="form-select form-control bg-white"
                                                aria-label="Default select example" required>
                                                <option selected>Open this select menu</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1"
                                                class="form-label dark-text">Class</label>
                                            <input type="text" name="patient_class" class="form-control bg-white">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1"
                                                class="form-label dark-text">School</label>
                                            <input type="text" name="patient_school" class="form-control bg-white">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label dark-text"> Number
                                                of brothers </label>
                                            <input type="number" name="No_of_bro" class="form-control bg-white">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label dark-text"> Rank
                                                among brothers </label>
                                            <input type="number" name="arr_btw_bro" class="form-control bg-white">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label dark-text">Caregiver
                                                name
                                                <span class="red">*</span></label>
                                            <input type="text" name="caregiver_name" class="form-control bg-white"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1"
                                                class="form-label dark-text">Relationship
                                                with patient since <span class="red">*</span></label>
                                            <input type="number" name="caregiver_relationship"
                                                class="form-control bg-white">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label dark-text">Phone
                                                number
                                                <span class="red">*</span></label>
                                            <input type="number" id="telephone" name="caregiver_number"
                                                class="form-control bg-white">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="create_patient"
                                    class="secondary-btn float-end btn mt-25">Create</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                    <!-- type here your code -->
                </div>
                <div class="tab-pane fade bg-box p-lg-5 p-md-4 p-3 rounded" id="pills-list-of-patient" role="tabpanel"
                    aria-labelledby="pills-list-of-patient-tab">
                    <!-- List of patient-->
                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <div class="head text-blue">
                                <h2>List of Patient </h2>
                                <div class="line bg-yellow"></div>
                            </div>
                        </div>
                    </div>
                    <div class="list row mt-5">
                        <div class="col-md-12 table-responsive">
                            <table class="patient-list table tableData table-striped table-hover ">
                                <thead class="bg-white">
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Patient Age</th>
                                        <th>Caregiver phone</th>
                                        <th>Patient Info</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($patients_results as $patient) : ?>
                                    <tr>
                                        <td>
                                            <!-- <img src="assets/images/child.jpg" alt="patiant" width="40px" height="40px"
                                                class="rounded-circle me-1"> -->
                                            <a href="patient-profile.php?patientid=<?= $patient['id'] ?>" target="blank"
                                                class="dark-text">
                                                <?= $patient['name'] ?></a>
                                        </td>
                                        <td><?= $patient['age'] ?></td>
                                        <td><?= $patient['caregiver_phone'] ?></td>
                                        <td><a href="patient-profile.php?patientid=<?= $patient['id'] ?>"
                                                target="blank"><i class="fas fa-info-circle fa-lg dark-text"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show bg-box p-lg-5 p-md-4 p-3 rounded" id="pills-schedule" role="tabpanel"
                    aria-labelledby="pills-schedule-tab">
                    <!-- Schedule -->
                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <div class="head text-blue">
                                <h2>Schedule</h2>
                                <div class="line bg-yellow"></div>
                            </div>
                        </div>
                    </div>
                    <div class="list row mt-5">
                        <div class="col-md-12 table-responsive">
                            <table class="table tableData table-striped table-hover">
                                <thead class="bg-white">
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Session Date</th>
                                        <th>Session Time</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($results_schedule as $schedule) : ?>
                                    <tr>
                                        <td>
                                            <a href="patient-profile.php?patientid=<?= $schedule['p_id'] ?>"
                                                class="dark-text" target="blank">
                                                <?= $schedule['name'] ?>
                                            </a>
                                        </td>
                                        <td><?= date('d/m/Y', strtotime($schedule['schedule_date_time'])); ?></td>
                                        <td><?= date('h:i a', strtotime($schedule['schedule_date_time'])); ?></td>
                                        <td><a href="handle/schedule.php?schedule_id=<?= $schedule['id'] ?>"><i
                                                    class="far fa-trash-alt fa-lg red"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
var input = document.querySelector("#telephone");
window.intlTelInput(input, ({
    preferredCountries: ["eg"]
}));
</script>
<?php
require_once('include/footer.php');
?>