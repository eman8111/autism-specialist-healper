<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class status extends Db
{
    public function __construct()
    {
        $this->table = 'status';
        $this->connect();
    }
}