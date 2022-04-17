<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class notify_to_do extends Db
{
    public function __construct()
    {
        $this->table = 'notify_to_do';
        $this->connect();
    }
}