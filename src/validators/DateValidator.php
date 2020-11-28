<?php


namespace nicDamours\Validator\validators;
use nicDamours\Validator\Regex;

class DateValidator extends ValidationQuery {

    protected function getValidationCallback(): callable {
        return function ($item) {
            return $this->validateWithRegex($item, Regex::DATE);
        };
    }

    public function getErrorMessage(): string {
        return "invalidDate";
    }
}
