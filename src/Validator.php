<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 20/02/19
 * Time: 9:06 PM
 */
namespace nicdamours\Validator {

    class Validator {


        /**
         * @var object;
         */
        private $objectToValidate;

        /**
         * @var ValidationQuery[]
         */
        private $validationQueryArray;

        private function __construct($object) {
            $this->objectToValidate = $object;
            $this->validationQueryArray = [];
        }

        public function email(string $property, bool $canBeNull = true): Validator {
            array_push($this->validationQueryArray, new ValidationQuery($property, function ($item) {
                return filter_var($item, FILTER_VALIDATE_EMAIL);
            }, $canBeNull));
            return $this;
        }

        public function password(string $property, bool $canBeNull = true): Validator {
            array_push($this->validationQueryArray, new ValidationQuery($property, function ($item) {
                return filter_var($item, FILTER_VALIDATE_REGEXP, array("options" =>
                    array("regexp" => Regex::PASSWORD)));
            }, $canBeNull));
            return $this;
        }

        public function title(string $property, bool $canBeNull = true): Validator {
            array_push($this->validationQueryArray, new ValidationQuery($property, function ($item) {
                return filter_var($item, FILTER_VALIDATE_REGEXP, array("options" =>
                    array("regexp" => Regex::TITLE)));
            }, $canBeNull));
            return $this;
        }

        public function datetime(string $property, bool $canBeNull = true): Validator {
            array_push($this->validationQueryArray, new ValidationQuery($property, function ($item) {
                return filter_var($item, FILTER_VALIDATE_REGEXP, array("options" =>
                    array("regexp" => Regex::DATE_TIME)));
            }, $canBeNull));
            return $this;
        }

        public function date(string $property, bool $canBeNull = true): Validator {
            array_push($this->validationQueryArray, new ValidationQuery($property, function ($item) {
                return filter_var($item, FILTER_VALIDATE_REGEXP, array("options" =>
                    array("regexp" => Regex::DATE)));
            }, $canBeNull));
            return $this;
        }

        public function isoDatetime(string $property, bool $canBeNull = true): Validator {
            array_push($this->validationQueryArray, new ValidationQuery($property, function ($item) {
                return filter_var($item, FILTER_VALIDATE_REGEXP, array("options" =>
                    array("regexp" => Regex::ISO_DATE)));
            }, $canBeNull));
            return $this;
        }

        public function boolean(string $property, bool $canBeNull = true): Validator {
            array_push($this->validationQueryArray, new ValidationQuery($property, function ($item) {
                return $item || $item === "true";
            }, $canBeNull));
            return $this;
        }

        public function id(string $property, bool $canBeNull = true): Validator {
            array_push($this->validationQueryArray, new ValidationQuery($property, function ($item) {
                return filter_var($item, FILTER_VALIDATE_REGEXP, array("options" =>
                    array("regexp" => Regex::NUMERIC)));
            }, $canBeNull));
            return $this;
        }

        public function int(string $property, bool $canBeNull = true): Validator {
            array_push($this->validationQueryArray, new ValidationQuery($property, function ($item) {
                return filter_var($item, FILTER_VALIDATE_REGEXP, array("options" =>
                    array("regexp" => Regex::NUMERIC)));
            }, $canBeNull));
            return $this;
        }

        public function arrayOfInt(string $property, bool $canBeNull = true) : Validator {
            array_push($this->validationQueryArray, new ValidationQuery($property, function ($item) {
                return Helper::array_every(function ($subItem) {
                    return is_int($subItem);
                }, $item);
            }, $canBeNull));
            return $this;
        }

        public function arrayOfString(string $property, bool $canBeNull = true) : Validator {
            array_push($this->validationQueryArray, new ValidationQuery($property, function ($item) {
                return Helper::array_every(function ($subItem) {
                    return is_string($subItem);
                }, $item);
            }, $canBeNull));
            return $this;
        }

        public function path(string $property, bool $canBeNull = true): Validator {
            array_push($this->validationQueryArray, new ValidationQuery($property, function($item) {
                return filter_var($item, FILTER_VALIDATE_REGEXP, array("options" =>
                    array("regexp" => Regex::PATH)));
            }, $canBeNull));
            return $this;
        }

        public function version(string $property, bool $canBeNull = true): Validator {
            array_push($this->validationQueryArray, new ValidationQuery($property, function($item) {
                return filter_var($item, FILTER_VALIDATE_REGEXP, array("options" =>
                    array("regexp" => Regex::VERSION)));
            }, $canBeNull));
            return $this;
        }

        public function validate(): bool {
            // cannot directly use $this-> with the use keyword
            $objectToValidate = $this->objectToValidate;
            return Helper::array_every(function ($item) use ($objectToValidate) {
                /** @var ValidationQuery $item */
                return $item->isValid($objectToValidate);
            }, $this->validationQueryArray);
        }

        public static function make($object): Validator {
            return new Validator($object);
        }
    }
}
