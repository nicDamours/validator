<?php


namespace nicDamours\Validator\validators;
use nicDamours\Validator\Regex;

class IsoDateTimeValidator extends ValidationQuery {

    protected function getValidationCallback(): callable {
       return function ($item) {
           return $this->validateWithRegex($item, Regex::ISO_DATE);
       };
    }

    public function getErrorMessage(): string {
        return "invalidIsoDateTime";
    }
}
