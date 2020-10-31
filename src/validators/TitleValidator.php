<?php

namespace nicDamours\Validator\validators;


use nicDamours\Validator\Regex;

class TitleValidator extends ValidationQuery {

    protected function getValidationCallback(): callable {
        return function ($item) {
            return filter_var($item, FILTER_VALIDATE_REGEXP, array("options" =>
                array("regexp" => Regex::TITLE)));
        };
    }

    public function getErrorMessage(): string {
       return "notATitle";
    }
}
