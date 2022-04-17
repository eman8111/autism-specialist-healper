<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class dsm_result extends Db
{
    public function __construct()
    {
        $this->table = 'dsm_result';
        $this->connect();
    }
}