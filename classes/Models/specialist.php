<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class specialist extends Db
{
    public function __construct()
    {
        $this->table = 'specialist';
        $this->connect();
    }
}