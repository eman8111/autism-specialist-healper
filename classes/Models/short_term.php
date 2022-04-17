<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class short_term extends Db
{
    public function __construct()
    {
        $this->table = 'short_term';
        $this->connect();
    }
}