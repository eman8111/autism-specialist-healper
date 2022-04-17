<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class dsm5 extends Db
{
    public function __construct()
    {
        $this->table = 'dsm5';
        $this->connect();
    }
}