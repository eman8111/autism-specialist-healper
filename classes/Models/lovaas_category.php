<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class lovaas_category extends Db
{
    public function __construct()
    {
        $this->table = 'lovaas_category';
        $this->connect();
    }
}