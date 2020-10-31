<?php


namespace nicDamours\Validator\validators;
use nicDamours\Validator\Regex;

class IdValidator extends ValidationQuery {
    protected function getValidationCallback(): callable {
       return function ($item) {
           return filter_var($item, FILTER_VALIDATE_REGEXP, array("options" =>
               array("regexp" => Regex::NUMERIC)));
       };
    }

    public function getErrorMessage(): string {
        return "notANumber";
    }
}
