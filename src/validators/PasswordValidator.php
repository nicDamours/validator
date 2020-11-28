<?php


namespace nicDamours\Validator\validators;
use nicDamours\Validator\Regex;

class PasswordValidator extends ValidationQuery {

    protected function getValidationCallback(): callable {
        return function ($item) {
            return $this->validateWithRegex($item, Regex::PASSWORD);
        };
    }

    public function getErrorMessage(): string {
       return "invalidPassword";
    }
}
