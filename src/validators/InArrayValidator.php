<?php


namespace nicDamours\Validator\validators;

class InArrayValidator extends ValidationQuery {

    /** @var callable */
    private $validationCallback;

    /**
     * InArrayValidator constructor.
     * @param string $property
     * @param callable $callback
     * @param bool $canBeNull
     */
    public function __construct(string $property, callable $callback, bool $canBeNull) {
        parent::__construct($property, $canBeNull);
        $this->validationCallback = $callback;
    }

    protected function getValidationCallback(): callable {
       return $this->validationCallback;
    }

    public function getErrorMessage(): string {
        return "";
    }
}
