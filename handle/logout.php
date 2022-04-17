<?php

require_once('../app.php');

$session->destroy();
$request->redirect('index.php');