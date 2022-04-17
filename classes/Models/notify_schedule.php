<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class notify_schedule extends Db
{
    public function __construct()
    {
        $this->table = 'notify_schedule';
        $this->connect();
    }
}