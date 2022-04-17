<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class to_do extends Db
{
    public function __construct()
    {
        $this->table = 'to_do';
        $this->connect();
    }
}