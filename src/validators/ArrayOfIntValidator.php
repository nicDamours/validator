<?php


namespace nicDamours\Validator\validators;


use nicDamours\Validator\Helper;
use nicDamours\Validator\I18n;
use nicDamours\Validator\Regex;

class ArrayOfIntValidator extends ValidationQuery {

    protected function getValidationCallback(): callable {
       return function ($item, &$errors) {
           if(!is_array($item)) {
               $errors[] = I18n::getMessage('notAnArrayOfInteger');
               return false;
           }

           if($this->isCanBeNull() && sizeof($item) === 0) {
               $errors[] = I18n::getMessage('not_found');
               return false;
           }

           return Helper::array_every(function ($subItem) {
               return is_int($subItem) ?: $this->validateWithRegex($subItem, Regex::NUMERIC);
           }, $item);
       };
    }

    public function getErrorMessage(): string {
        return I18n::getMessage("notAnArrayOfInteger");
    }
}
