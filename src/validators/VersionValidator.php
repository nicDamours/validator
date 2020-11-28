<?php


namespace nicDamours\Validator\validators;

use nicDamours\Validator\Regex;

class VersionValidator extends ValidationQuery {

    protected function getValidationCallback(): callable {
        return function($item) {
            return $this->validateWithRegex($item, Regex::VERSION);
        };
    }

    public function getErrorMessage(): string {
        return "invalidVersionNumber";
    }
}
