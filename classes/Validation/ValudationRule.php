<?php

namespace Project\Classes\Validation;

interface ValidationRule
{
    public function check(string $name, $value);
}