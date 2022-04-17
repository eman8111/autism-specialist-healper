<?php

namespace Project\Classes\Models;

use Project\Classes\Db;

class tables extends Db
{
    // public $tables;
    public function __construct()
    {
        $this->table = "";
        $this->connect();
    }
}