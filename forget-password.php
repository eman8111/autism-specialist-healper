<?php require_once('include/header.php'); ?>

<div class="forget-pass">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 wow animated fadeIn" data-wow-delay="3s" data-wow-duration="8s">
                <div class=" bg-img"></div>
            </div>
            <div class="col-md-6">
                <div class="form-forget">
                    <h1 class="wow animated fadeInDown" data-wow-delay="5s" data-wow-duration="8s">Forget <br> Your
                        Password
                        ?</h1>
                    <form action="">
                        <div class="form-floating mb-3 wow animated fadeInDown" data-wow-delay="7s"
                            data-wow-duration="8s">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <input type="submit" class="btn main-btn w-100 mt-10 wow animated fadeInDown"
                            data-wow-delay="0.3s" data-wow-duration="3s" name="forget" value="RESET PASSWORD">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?= URL; ?>assets/js/jquery.js"></script>
<script src="<?= URL; ?>assets/js/popper.min.js"></script>
<script src="<?= URL; ?>assets/js/bootstrap.min.js"></script>
<script src="<?= URL; ?>assets/js/all.min.js"></script>
<script src="<?= URL; ?>assets/js/rellax.min.js"></script>
</body>

</html>