<?php


namespace nicDamours\Validator\validators;

use nicDamours\Validator\I18n;

class BooleanValidator extends ValidationQuery {

    protected function getValidationCallback(): callable {
        return function ($item) {
            if(is_int($item)) {
                return in_array($item, [0, 1]);
            }

            if(is_string($item)) {
                return in_array($item, ['true', 'false', 'TRUE', 'FALSE']);
            }

            return $item === true || $item === false;
        };
    }

    public function getErrorMessage(): string {
        return I18n::getMessage("notABoolean");
    }
}
