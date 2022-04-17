<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class notic_questions extends Db
{
    public function __construct()
    {
        $this->table = 'notic_questions';
        $this->connect();
    }
}