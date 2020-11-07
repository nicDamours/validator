<?php
namespace nicDamours\Validator;

use nicDamours\Validator\validators\ArrayOfIntValidator;
use nicDamours\Validator\validators\ArrayOfStringValidator;
use nicDamours\Validator\validators\BooleanValidator;
use nicDamours\Validator\validators\DateTimeValidator;
use nicDamours\Validator\validators\DateValidator;
use nicDamours\Validator\validators\EmailValidator;
use nicDamours\Validator\validators\FloatValidator;
use nicDamours\Validator\validators\HexColorValidator;
use nicDamours\Validator\validators\IdValidator;
use nicDamours\Validator\validators\InArrayValidator;
use nicDamours\Validator\validators\IntValidator;
use nicDamours\Validator\validators\IsoDateTimeValidator;
use nicDamours\Validator\validators\PasswordValidator;
use nicDamours\Validator\validators\PathValidator;
use nicDamours\Validator\validators\TitleValidator;
use nicDamours\Validator\validators\ValidationQuery;
use nicDamours\Validator\validators\VersionValidator;

/**
 * Class Validator
 * @package nicdamours\Validator
 *
 * Magic methods:
 * @method Validator email(string $property, $canBeNull = true) validate an email.
 * @method Validator password(string $property, $canBeNull = true) validate a password.
 * @method Validator title(string $property, $canBeNull = true) validate a title
 * @method Validator datetime(string $property, $canBeNull = true) validate a datetime (Y-m-d h:i:s)
 * @method Validator date(string $property, $canBeNull = true) validate a date (Y-m-d)
 * @method Validator isoDatetime(string $property, $canBeNull = true) validate a datetime under the format ISO-8601
 * @method Validator boolean(string $property, $canBeNull = true) validate a boolean
 * @method Validator id(string $property, $canBeNull = true) validate an id
 * @method Validator int(string $property, $canBeNull = true) validate an int
 * @method Validator arrayOfInt(string $property, $canBeNull = true) validate an array of integers
 * @method Validator arrayOfString(string $property, $canBeNull = true) validate an array of strings
 * @method Validator path(string $property, $canBeNull = true) validate a path ( path/to/some/thing )
 * @method Validator version(string $property, $canBeNull = true) validate a version number ( 1.1.1 )
 * @method Validator hexColor(string $property, $canBeNull = true) validate a hex color #FFFFFF or #FFF
 * @method Validator float(string $property, $canBeNull = true) validate a float, as string or primitive
 */
class Validator {

    const VALIDATION_OBJECT_MAPPING = [
        'email' => EmailValidator::class,
        'password' => PasswordValidator::class,
        'title' => TitleValidator::class,
        'datetime' => DateTimeValidator::class,
        'date' => DateValidator::class,
        'isoDatetime' => IsoDateTimeValidator::class,
        'boolean' => BooleanValidator::class,
        'id' => IdValidator::class,
        'int' => IntValidator::class,
        'arrayOfInt' => ArrayOfIntValidator::class,
        'arrayOfString' => ArrayOfStringValidator::class,
        'path' => PathValidator::class,
        'version' => VersionValidator::class,
        'hexColor' => HexColorValidator::class,
        'float' => FloatValidator::class
    ];

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

    public function __call($method, $args) {
        $validationObject = self::VALIDATION_OBJECT_MAPPING[$method];
        if(!$validationObject) {
            throw new \Exception("invalid validator: $method");
        }

        $validatorInstance = new $validationObject(...$args);
        array_push($this->validationQueryArray, $validatorInstance);
        return $this;
    }

    /**
     * Custom validation function that cannot be represent using an object.
     * @param string $property
     * @param array $possibilities
     * @param bool $canBeNull
     * @return $this
     */
    public function inArray(string $property, array $possibilities, bool $canBeNull = true) : Validator {
        array_push($this->validationQueryArray, new InArrayValidator($property, function($item, &$error) use ($possibilities, $property) {
            $valid = in_array($item, $possibilities);
            if(!$valid) {
               $error[] = I18n::getMessage("notInArray", ['values' => join(', ', $possibilities)]);
            }
            return $valid;
        }, $canBeNull));
        return $this;
    }

    public function validate(array &$validationErrors = []): bool {
        // cannot directly use $this-> with the use keyword
        $objectToValidate = $this->objectToValidate;
        return Helper::array_every(function ($item) use ($objectToValidate, &$validationErrors) {
            $currentError = [];
            /** @var ValidationQuery $item */
            $valid = $item->isValid($objectToValidate, $currentError);
            if(!$valid) {
                $validationErrors[$item->getValidationKey()] = $currentError;
            }
            return $valid;
        }, $this->validationQueryArray);
    }

    public static function make($object, $i18n = []): Validator {
        I18n::defineI18n($i18n);
        return new Validator($object);
    }
}

