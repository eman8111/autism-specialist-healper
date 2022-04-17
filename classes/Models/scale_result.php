<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class scale_result extends Db
{
    public function __construct()
    {
        $this->table = 'scale_result
        ';
        $this->connect();
    }
}