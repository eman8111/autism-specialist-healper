<?php require_once('include/header.php'); ?>
<?php require_once('include/navbar.php'); ?>
<section class="contact-us py-5 bg-blue" style="height: calc(100vh - 150px); ">
    <div calss="contact-us-container">
        <div class="container contact pt-40">
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
    </div>
</section>
<?php require_once('include/footer.php'); ?>