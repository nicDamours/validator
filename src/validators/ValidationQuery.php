<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 20/02/19
 * Time: 9:08 PM
 */

namespace nicDamours\Validator\validators;

use nicDamours\Validator\exceptions\PropertyNotFoundException;
use nicDamours\Validator\I18n;
use nicDamours\Validator\Regex;

abstract class ValidationQuery {

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
    public function __construct(string $validationKey, $canBeNull = true) {
        $this->validationKey = $validationKey;
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
    protected abstract function getValidationCallback(): callable;

    /**
     * @return bool
     */
    public function isCanBeNull(): bool {
        return $this->canBeNull;
    }

    /**
     * @param bool $canBeNull
     */
    public function setCanBeNull(bool $canBeNull): void {
        $this->canBeNull = $canBeNull;
    }

    /**
     * @return string
     */
    public abstract function getErrorMessage(): string;

    public function isValid($object, &$error): bool {
        $valueFromObject = $this->getValueFromObject($object);
        if ($valueFromObject === null && $this->isCanBeNull()) {
            return true;
        } else if($valueFromObject === null && !$this->isCanBeNull()) {
            $error[] = I18n::getMessage('not_found', [
                'property' => $this->getValidationKey()
            ]);
            return false;
        }
        $validationErrors = [];
        try {
            $valid = $this->getValidationCallback()($valueFromObject, $validationErrors);
            if(!$valid) {
                $placeholderValues = [
                    'property' => $this->getValidationKey()
                ];

                if(sizeof($validationErrors) > 0) {
                    $placeholderValues['error_message'] = join(', ', $validationErrors);
                } else {
                    $placeholderValues['error_message'] = $this->getErrorMessage();
                }
                $error[] = I18n::getMessage('invalid', $placeholderValues);
            }
            return $valid;
        } catch(PropertyNotFoundException $exception) {
            $error[] = I18n::getMessage('not_found', [
                'property' => $this->getValidationKey()
            ]);
          return false;
        }
    }

    private function getValueFromObject($object) {
        if (is_object($object)) {
            return property_exists($object, $this->getValidationKey()) ? $object->{$this->getValidationKey()} : null;
        } else if (is_array($object)) {
            return isset($object[$this->getValidationKey()]) ? $object[$this->getValidationKey()] : null;
        }
        return null;
    }

    protected function validateWithRegex($value, string $regex) : bool {
        return filter_var($value, FILTER_VALIDATE_REGEXP, array("options" =>
            array("regexp" => $regex)));
    }
}
