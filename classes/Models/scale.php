<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class scale extends Db
{
    public function __construct()
    {
        $this->table = 'scale';
        $this->connect();
    }
}