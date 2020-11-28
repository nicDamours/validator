<?php


namespace nicDamours\Validator\validators;
use nicDamours\Validator\Regex;

class DateTimeValidator extends ValidationQuery {

    protected function getValidationCallback(): callable {
        return function ($item) {
            return $this->validateWithRegex($item, Regex::DATE_TIME);
        };
    }

    public function getErrorMessage(): string {
        return "invalidDateTime";
    }
}
