<?php


namespace nicDamours\Validator\validators;
use nicDamours\Validator\Regex;

class EmailValidator extends ValidationQuery {
    protected function getValidationCallback(): callable {
        return function ($item) {
            return filter_var($item, FILTER_VALIDATE_EMAIL) !== FALSE;
        };
    }

    public function getErrorMessage(): string {
        return "isNotAnEmail";
    }
}
