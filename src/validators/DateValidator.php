<?php


namespace nicDamours\Validator\validators;
use nicDamours\Validator\Regex;

class DateValidator extends ValidationQuery {

    protected function getValidationCallback(): callable {
        return function ($item) {
            return filter_var($item, FILTER_VALIDATE_REGEXP, array("options" =>
                array("regexp" => Regex::DATE)));
        };
    }

    public function getErrorMessage(): string {
        return "invalidDate";
    }
}
