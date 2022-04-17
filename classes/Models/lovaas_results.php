<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class lovaas_results extends Db
{
    public function __construct()
    {
        $this->table = 'lovaas_results';
        $this->connect();
    }
}