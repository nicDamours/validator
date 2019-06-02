<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 20/02/19
 * Time: 9:08 PM
 */

namespace nDamours\Validator {
    class ValidationQuery {

        /**
         * @var string;
         */
        private $validationKey;

        /**
         * @var callable
         */
        private $validationCallback;

        /**
         * @var bool
         */
        private $canBeNull;

        /**
         * ValidationQuery constructor.
         * @param string $validationKey
         * @param callable $validationCallback
         * @param bool $canBeNull
         */
        public function __construct(string $validationKey, callable $validationCallback, $canBeNull = true) {
            $this->validationKey = $validationKey;
            $this->validationCallback = $validationCallback;
            $this->canBeNull = $canBeNull;
        }

        /**
         * @return string
         */
        public function getValidationKey(): string {
            return $this->validationKey;
        }

        /**
         * @param string $validationKey
         */
        public function setValidationKey(string $validationKey): void {
            $this->validationKey = $validationKey;
        }

        /**
         * @return callable
         */
        public function getValidationCallback(): callable {
            return $this->validationCallback;
        }

        /**
         * @param callable $validationCallback
         */
        public function setValidationCallback(callable $validationCallback): void {
            $this->validationCallback = $validationCallback;
        }

        public function isValid($object): bool {
            $valueFromObject = $this->getValueFromObject($object);
            if ($valueFromObject == null && $this->canBeNull) {
                return true;
            }
            return $this->getValidationCallback()($valueFromObject);
        }

        private function getValueFromObject($object) {
            if (is_object($object)) {
                return property_exists($object, $this->getValidationKey()) ? $object->{$this->getValidationKey()} : null;
            } else if (is_array($object)) {
                return isset($object[$this->getValidationKey()]) ? $object[$this->getValidationKey()] : null;
            }
            return null;
        }
    }
}