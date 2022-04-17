<?php
require_once('include/header.php');

if ($session->has("which_user")) {

    switch ($session->get("which_user")) {
        case 'user':
            $request->redirect('user.php');
            break;
        case 'specialist':
            $request->redirect('specialist.php');
            break;
        case 'caregiver':
            $request->redirect('caregiver.php');
            break;
    }
}
?>
<!-- Banner and form First Section -->
<div class="banner">
    <div class="container">
        <div class="main-form">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-side pt-35 ps-60">
                        <div class="logo wow animated fadeIn" data-wow-delay="0.3s" data-wow-duration="0.8s">
                            <div class="row align-items-center">
                                <div class="col-md-2 col-3">
                                    <img src="<?= URL; ?>assets/images/autism.png" alt="" class="img-fluid">
                                </div>
                                <div class="col-md-6 col-6 p-0 text-white">
                                    <h1 class="mb-0 h3">Autism</h1>
                                    <p class="m-0 p-0 text-white">Specialist Helper</p>
                                </div>
                            </div>
                        </div>
                        <div class="title position-relative">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-12">
                                    <h1 class="text-white mt-80 mb-15 wow animated fadeInDown" data-wow-delay="0.3s"
                                        data-wow-duration="1s">
                                        Enhancing lives today and accelerating a spectrum of solutions
                                        for tomorrow</h1>
                                    <p class="text-white wow animated fadeInDown" data-wow-delay="0.3s"
                                        data-wow-duration="1.8s">
                                        We’re working to create a kinder, more inclusive world for people with
                                        autism, and we invite you to join us.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="scroll wow animated fadeIn d-lg-block d-none" data-wow-delay="0.3s"
                    data-wow-duration="2.4s">
                    <div class="mouse"></div>
                    <p>Scroll</p>
                </div>
                <div class="col-md-6">
                    <div class="right-side px-5 py-3 position-relative">
                        <ul id="myTab" class="nav nav-tabs wow animated fadeIn" data-wow-delay="0.3s"
                            data-wow-duration="0.8s" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="login-tab" data-bs-toggle="tab" type="button"
                                    data-bs-target="#login" role="tab" aria-controls="login"
                                    aria-selected="true">Login</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="register-tab" data-bs-toggle="tab" type="button"
                                    data-bs-target="#register" role="tab" aria-controls="register"
                                    aria-selected="false">Register</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="login" role="tabpanel"
                                aria-labelledby="login-tab">
                                <div class="row justify-content-center align-items-center">
                                    <div class="w-100">
                                        <?php
                                        if ($session->has('login_errors')) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php
                                                $errors[] = $session->get('login_errors');
                                                foreach ($errors as $error) : ?>
                                            <ul class="m-0">
                                                <li><i class="fas fa-circle me-2 fa-xs"></i><?= $error ?></li>
                                            </ul>
                                            <?php endforeach;
                                                $session->remove('login_errors');
                                                ?>
                                        </div>
                                        <?php endif ?>
                                        <?php if ($session->has('sucsses_reg')) : ?>
                                        <div class="alert alert-success" role="alert">
                                            <?= $session->get('sucsses_reg') ?>
                                        </div>
                                        <?php $session->remove('sucsses_reg');
                                        endif ?>
                                        <h3 class="my-4 fw-bold text-white wow animated fadeIn" data-wow-delay="0.3s"
                                            data-wow-duration="1s">Login to your Account</h3>
                                        <form method="POST" action="handle/login.php">
                                            <div class="form-floating mb-3 wow animated fadeInDown"
                                                data-wow-delay="0.3s" data-wow-duration="1.4s">
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Enter your Email" autocomplete="on" required>
                                                <label for="floatingInput">Enter your Email</label>
                                            </div>
                                            <div class="form-floating mb-3 wow animated fadeInDown"
                                                data-wow-delay="0.3s" data-wow-duration="1.8s">
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Enter your Password" autocomplete="on" required>
                                                <label for="">Enter your Password</label>
                                            </div>
                                            <div class="form-floating mb-3 wow animated fadeInDown"
                                                data-wow-delay="0.3s" data-wow-duration="2.2s">
                                                <select class="form-select bg-transparent" name="choose"
                                                    aria-label="Choose your account..." required>
                                                    <option selected>Open this select menu</option>
                                                    <option value="user">Guest</option>
                                                    <option value="specialist">Specialist</option>
                                                    <option value="caregiver">Caregiver</option>
                                                </select>
                                                <label for="">Choose your account...</label>
                                            </div>
                                            <button type="submit"
                                                class="btn main-btn w-100 mt-10 wow animated fadeInDown"
                                                data-wow-delay="0.3s" data-wow-duration="3s" name="login">LOGIN</button>
                                        </form>
                                        <!-- <div class="row mt-3 wow animated fadeInDown" data-wow-delay="0.3s"
                                            data-wow-duration="3.4s">
                                            <div class="col-md-4">
                                                <a href="forget-password.php" class="text-white">Forgot Password ?</a>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <?php if ($session->has('reg_errors')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php
                                        $errors[] = $session->get('reg_errors');
                                        foreach ($errors as $error) :
                                        ?>
                                    <ul class="m-0">
                                        <li><i class="fas fa-circle me-2 fa-xs"></i><?= $error ?></li>
                                    </ul>
                                    <?php endforeach;
                                        $session->remove('reg_errors');
                                        ?>
                                </div>
                                <?php endif ?>


                                <h3 class="my-4 fw-bold text-white">Create a new Account</h3>
                                <form method="POST" action="handle/reg.php">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 wow animated fadeInDown"
                                                data-wow-delay="0.3s" data-wow-duration="1.4s">
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter your Full Name" autocomplete="on">
                                                <label for="">Enter your Full Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 wow animated fadeInDown"
                                                data-wow-delay="0.3s" data-wow-duration="1.4s">
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="Enter your Email" autocomplete="on">
                                                <label for="">Enter your Email</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 wow animated fadeInDown"
                                                data-wow-delay="0.3s" data-wow-duration="1.8s">
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Enter your Password" autocomplete="on">
                                                <label for="">Enter your Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 wow animated fadeInDown"
                                                data-wow-delay="0.3s" data-wow-duration="1.8s">
                                                <input type="password" name="re-password" class="form-control"
                                                    placeholder="Re-enter your Password" autocomplete="on">
                                                <label for="">Re-enter your Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3 wow animated fadeInDown" data-wow-delay="0.3s"
                                        data-wow-duration="2.2s">
                                        <select class="form-select bg-transparent" name="choose" id="choose">
                                            <option selected>Open this select menu</option>
                                            <option value="user">Guest</option>
                                            <option value="specialist">Specialist</option>
                                            <option value="caregiver">Caregiver</option>
                                        </select>
                                        <label for="">Choose your account...</label>
                                    </div>
                                    <div id="serial" style="display: none;">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="sp_serial_no"
                                                placeholder="Enter your Specialist serial number">
                                            <label for="floatingInput">Enter Your Specialist Serial Number </label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="patient_id"
                                                placeholder="Enter Your patient ID">
                                            <label for="floatingInput">Enter Your patient ID </label>
                                        </div>
                                    </div>
                                    <input type="submit" name="reg" value="Register" id="register"
                                        class="btn main-btn w-100 mt-10 wow animated fadeInDown" data-wow-delay="0.3s"
                                        data-wow-duration="2.6s">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner and form First Section -->


<!-- how we can support -->

<section class="wwd position-relative">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="head">
                    <h2 class="position-relative blue-title">how we can support</h2>
                </div>
            </div>
        </div>
        <div class="row mt-lg-5 mt-3">
            <div class="col-lg-12">
                <div class="row justify-content-between">
                    <div class=" col-lg-5 col-md-12">
                        <div class="discription f-300">
                            <h5 class="red discription-head mb-4">IF You Need</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat alias aliquid
                                assumenda illo nam totam nobis necessitatibus tenetur. Laboriosam, harum!</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat alias aliquid
                                assumenda illo nam totam nobis necessitatibus tenetur. Laboriosam, harum! Lorem,
                                ipsum dolor sit amet consectetur adipisicing elit. Ex sapiente commodi maxime quidem
                                necessitatibus laudantium fugit cum doloribus sint officia enim aspernatur quibusdam
                                fuga, perferendis iusto, autem voluptates, in deleniti.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="discription-img position-relative">
                            <img src="<?= URL; ?>assets/images/user.jpg" class="img-fluid rounded" alt="">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mt-lg-5 mt-md-3">
                    <div class="col-lg-6 col-md-12 order-lg-0 order-1">
                        <div class="discription-img position-relative">
                            <img src="<?= URL; ?>assets/images/doctor.jpg" class="img-fluid rounded" alt="">
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 order-lg-1 order-0">
                        <div class="discription f-300">
                            <h5 class="red discription-head mb-4">IF You Need</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat alias aliquid
                                assumenda illo nam totam nobis necessitatibus tenetur. Laboriosam, harum!</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat alias aliquid
                                assumenda illo nam totam nobis necessitatibus tenetur.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam aperiam provident
                                cupiditate officiis, veritatis, laboriosam placeat iste quasi eveniet hic ipsam!
                                Soluta voluptatem odio blanditiis modi error magnam, nesciunt ullam!</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mt-lg-5 mt-md-3">
                    <div class="col-lg-5 col-md-12">
                        <div class="discription f-300">
                            <h5 class="red discription-head mb-4">IF You Need</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat alias aliquid
                                assumenda illo nam totam nobis necessitatibus tenetur. Laboriosam, harum!</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat alias aliquid
                                assumenda illo nam totam nobis necessitatibus tenetur.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque veniam eligendi, odit
                                eius fuga labore incidunt sapiente voluptas! Dolores commodi odit voluptas
                                recusandae, tenetur magnam officiis iure doloremque voluptatum ipsum sapiente cumque
                                soluta, et porro.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="discription-img position-relative">
                            <img src="<?= URL; ?>assets/images/caregiver.jpg" class="img-fluid rounded" alt="">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="shape d-lg-block d-md-none d-none">
        <span class="ss-one rellax position-absolute" data-rellax-speed="-2">
            <img src="<?= URL; ?>assets/images/ss-one.png" alt="shape">
        </span>
        <span class="ss-two rellax position-absolute" data-rellax-speed="-1">
            <img src="<?= URL; ?>assets/images/ss-two.png" alt="shape">
        </span>
        <span class="ss-three rellax position-absolute" data-rellax-speed="-2">
            <img src="<?= URL; ?>assets/images/ss-three.png" alt="shape">
        </span>
    </div>
</section>

<!-- how we can support -->

<!-- Contact Us -->

<section class="contact-us py-5 bg-blue">
    <div class="container">
        <div class="row">
            <div class="col-md-6 wow animated fadeIn" data-wow-delay="0.3s" data-wow-duration="0.8s">
                <h1 class="text-head-contact mb-10 text-white fw-bold">
                    Ask The Expert
                    <br>
                    Get in touch ...
                </h1>
                <p class="contact-info text-white">
                    A paragraph is a series of related sentences developing <br>a central idea, called the
                    topic.
                </p>
            </div>
            <div class="col-md-6 wow animated fadeIn" data-wow-delay="0.3s" data-wow-duration="0.8s">
                <form class="form">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" rows="5" placeholder="Message"></textarea>
                    </div>
                    <button type="button" class="secondary-btn float-end btn">Send</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Contact Us -->

<script>
var div_input = document.getElementById('serial');
var choose_select = document.getElementById('choose');

choose_select.addEventListener('change', function() {
    if (this.value == 'caregiver') {
        div_input.style.display = 'block'
    }
})
</script>

<?php require_once('include/footer.php'); ?>