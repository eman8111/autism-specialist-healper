<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class attached_reports extends Db
{
    public function __construct()
    {
        $this->table = 'attached_reports';
        $this->connect();
    }
}