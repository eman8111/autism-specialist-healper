<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class lovaas_questions extends Db
{
    public function __construct()
    {
        $this->table = 'lovaas_questions';
        $this->connect();
    }
}