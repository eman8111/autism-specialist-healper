<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class long_term extends Db
{
    public function __construct()
    {
        $this->table = 'long_term';
        $this->connect();
    }
}