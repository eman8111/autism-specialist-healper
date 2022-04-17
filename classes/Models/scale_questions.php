<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class scale_questions extends Db
{
    public function __construct()
    {
        $this->table = 'scale_questions';
        $this->connect();
    }
}