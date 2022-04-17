<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class weknees_point extends Db
{
    public function __construct()
    {
        $this->table = 'weknees_point';
        $this->connect();
    }
}