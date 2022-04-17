<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class autism_checker_question extends Db
{
    public function __construct()
    {
        $this->table = 'autism_checker_question';
        $this->connect();
    }
}