<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class notic extends Db
{
    public function __construct()
    {
        $this->table = 'notic';
        $this->connect();
    }
}