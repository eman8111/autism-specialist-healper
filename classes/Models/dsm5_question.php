<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class dsm5_question extends Db
{
    public function __construct()
    {
        $this->table = 'dsm5_question';
        $this->connect();
    }
}