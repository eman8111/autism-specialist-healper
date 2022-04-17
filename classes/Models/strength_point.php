<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class strength_point extends Db
{
    public function __construct()
    {
        $this->table = 'strength_point';
        $this->connect();
    }
}