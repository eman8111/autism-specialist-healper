<?php

namespace Project\Classes\Validation;

class Validator
{
    private $errors = [];
    public function validate(string $name, $value, array $rules)
    {
        foreach ($rules as $rule) {
            $obj = new $rule;
            // if ($rule == "required") {
            //     $obj = new Required;
            // } elseif ($rule == "numeric") {
            //     $obj = new Numeric;
            // } elseif ($rule == "str") {
            //     $obj = new Str;
            // } elseif ($rule == "email") {
            //     $obj = new Email;
            // }
            $error = $obj->check($name, $value);
            if ($error !== false) {
                $this->errors[]  = $error;
                break;
            }
        }
    }
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
        // if (empty($this->errors)) {
        //     return false;
        // } else {
        //     return true;
        // }
    }
}