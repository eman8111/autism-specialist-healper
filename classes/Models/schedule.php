<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class schedule extends Db
{
    public function __construct()
    {
        $this->table = 'schedule';
        $this->connect();
    }
}