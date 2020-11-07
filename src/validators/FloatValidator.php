<?php


namespace nicDamours\Validator\validators;


use nicDamours\Validator\I18n;
use nicDamours\Validator\Regex;

class FloatValidator extends ValidationQuery {

    protected function getValidationCallback(): callable {
        return function ($item) {
            $isFloat = is_float($item);
            $isInt =  is_int($item);
            $matchesString = (is_string($item) && $this->validateWithRegex($item, Regex::FLOAT));
            return $isFloat || $isInt || $matchesString;
        };
    }

    public function getErrorMessage(): string {
        return I18n::getMessage("notAFloat");
    }
}
