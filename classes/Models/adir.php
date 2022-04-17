<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class adir extends Db
{
    public function __construct()
    {
        $this->table = 'adir';
        $this->connect();
    }
}