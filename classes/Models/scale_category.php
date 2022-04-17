<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class scale_category extends Db
{
    public function __construct()
    {
        $this->table = 'scale_category';
        $this->connect();
    }
}