<?php


namespace nicDamours\Validator\validators;
use nicDamours\Validator\Regex;

class IsoDateTimeValidator extends ValidationQuery {

    protected function getValidationCallback(): callable {
       return function ($item) {
           return filter_var($item, FILTER_VALIDATE_REGEXP, array("options" =>
               array("regexp" => Regex::ISO_DATE)));
       };
    }

    public function getErrorMessage(): string {
        return "invalidIsoDateTime";
    }
}
