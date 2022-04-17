<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class evaluation_history extends Db
{
    public function __construct()
    {
        $this->table = 'evaluation_history';
        $this->connect();
    }
}