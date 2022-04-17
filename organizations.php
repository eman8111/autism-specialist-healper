<?php

require_once('include/header.php');
require_once('include/navbar.php');
?>
<section class="main-banner text-white d-flex justify-content-center align-items-center text-center">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <h1>Organizations</h1>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit
                    illum odit doloremque sed distinctio cum sapiente reiciendis modi, soluta minima numquam consectetur
                    iure enim hic..</p>
            </div>
        </div>
    </div>
</section>
<div class="orgs pt-3 pb-5 bg-box">
    <div class="container">
        <div id="orgs" class="row">
        </div>
    </div>
</div>

<script src="<?= URL; ?>assets/js/scripts/display_organizations.js"></script>
<?php


require_once('include/footer.php');
?>