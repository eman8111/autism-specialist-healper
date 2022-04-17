<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class attahced_reports_result extends Db
{
    public function __construct()
    {
        $this->table = 'attahced_reports_result';
        $this->connect();
    }
}