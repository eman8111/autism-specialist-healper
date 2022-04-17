<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class caregiver extends Db
{
    public function __construct()
    {
        $this->table = 'caregiver';
        $this->connect();
    }
}