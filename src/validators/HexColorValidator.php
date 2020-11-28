<?php


namespace nicDamours\Validator\validators;
use nicDamours\Validator\Regex;

class HexColorValidator extends ValidationQuery {

    protected function getValidationCallback(): callable {
        return function($item) {
            return $this->validateWithRegex($item, Regex::HEX_COLOR);
        };
    }

    public function getErrorMessage(): string {
        return "invalidHexColor";
    }
}
