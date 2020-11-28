<?php


namespace nicDamours\Validator\validators;

use nicDamours\Validator\Regex;

class PathValidator extends ValidationQuery {

    protected function getValidationCallback(): callable {
        return function($item) {
            return $this->validateWithRegex($item, Regex::PATH);
        };
    }

    public function getErrorMessage(): string {
        return "invalidPath";
    }
}
