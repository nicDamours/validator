<?php

namespace nicDamours\Validator\validators;


use nicDamours\Validator\Regex;

class TitleValidator extends ValidationQuery {

    protected function getValidationCallback(): callable {
        return function ($item) {
            return $this->validateWithRegex($item, Regex::TITLE);
        };
    }

    public function getErrorMessage(): string {
       return "notATitle";
    }
}
