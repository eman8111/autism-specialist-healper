<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class Users extends Db
{
    public function __construct()
    {
        $this->table = 'users';
        $this->connect();
    }
}