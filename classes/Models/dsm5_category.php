<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class dsm5_category extends Db
{
    public function __construct()
    {
        $this->table = 'dsm5_category';
        $this->connect();
    }
}