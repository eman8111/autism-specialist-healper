<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class patient extends Db
{
    public function __construct()
    {
        $this->table = 'patient';
        $this->connect();
    }
}