<?php


namespace nicDamours\Validator\validators;
use nicDamours\Validator\Regex;

class IdValidator extends ValidationQuery {
    protected function getValidationCallback(): callable {
       return function ($item) {
           return $this->validateWithRegex($item, Regex::NUMERIC);
       };
    }

    public function getErrorMessage(): string {
        return "notANumber";
    }
}
