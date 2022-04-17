<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class adir_result extends Db
{
    public function __construct()
    {
        $this->table = 'adir_result';
        $this->connect();
    }
}