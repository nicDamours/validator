<?php


namespace validators;


use nicDamours\Validator\Validator;
use PHPUnit\Framework\TestCase;

class BooleanValidatorTest extends TestCase {

    private $errors;

    const BOOLEAN_FALSE = false;

    CONST BOOLEAN_TRUE = true;

    const BOOLEAN_FALSE_AS_STRING = 'false';

    const BOOLEAN_TRUE_AS_STRING = 'true';

    const BOOLEAN_TRUE_AS_NUMERIC = 1;

    const BOOLEAN_FALSE_AS_NUMERIC = 0;

    const UPPERCASE_BOOLEAN_TRUE_AS_STRING = 'TRUE';

    const UPPERCASE_BOOLEAN_FALSE_AS_STRING = 'FALSE';

    const NOT_A_BOOLEAN = [8232];

    const NOT_A_BOOLEAN_AS_NUMERIC = 2;

    const NOT_A_BOOLEAN_AS_STRING = 'somethingElse';

    const NOT_A_BOOLEAN_ERROR_MESSAGE = 'property test was invalid: not a boolean';

    const PROPERTY_CANNOT_BE_NULL_ERROR_MESSAGE = "property test was not found but it is required";

    protected function setUp(): void{
        $this->errors = [];
    }

    public function testItShouldReturnTrueWhenThePropertyIsOfTypeBooleanAndTrue() {
        $this->assertTrue(Validator::make(['test' => self::BOOLEAN_TRUE])->boolean('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenThePropertyIsOfTypeBooleanAndFalse() {
        $this->assertTrue(Validator::make(['test' => self::BOOLEAN_TRUE])->boolean('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenThePropertyIsOfTypeStringAndTrue() {
        $this->assertTrue(Validator::make(['test' => self::BOOLEAN_TRUE_AS_STRING])->boolean('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenThePropertyIsOfTypeStringAndFalse() {
        $this->assertTrue(Validator::make(['test' => self::BOOLEAN_FALSE_AS_STRING])->boolean('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenThePropertyIsOfTypeNumericAndTrue() {
        $this->assertTrue(Validator::make(['test' => self::BOOLEAN_TRUE_AS_NUMERIC])->boolean('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenThePropertyIsOfTypeNumericAndFalse() {
        $this->assertTrue(Validator::make(['test' => self::BOOLEAN_FALSE_AS_NUMERIC])->boolean('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenThePropertyIsOfTypeStringAndUppercaseTrue() {
        $this->assertTrue(Validator::make(['test' => self::UPPERCASE_BOOLEAN_TRUE_AS_STRING])->boolean('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenThePropertyIsOfTypeStringAndUppercaseFalse() {
        $this->assertTrue(Validator::make(['test' => self::UPPERCASE_BOOLEAN_FALSE_AS_STRING])->boolean('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnFalseWhenThePropertyIsNotABoolean() {
        $this->assertFalse(Validator::make(['test' => self::NOT_A_BOOLEAN])->boolean('test')->validate($this->errors));
        $this->assertContains(self::NOT_A_BOOLEAN_ERROR_MESSAGE, $this->errors['test']);
    }

    public function testItShouldReturnFalseWhenThePropertyIsOfTypeStringAndNotABoolean() {
        $this->assertFalse(Validator::make(['test' => self::NOT_A_BOOLEAN_AS_STRING])->boolean('test')->validate($this->errors));
        $this->assertContains(self::NOT_A_BOOLEAN_ERROR_MESSAGE, $this->errors['test']);
    }

    public function testItShouldReturnFalseWhenThePropertyIsOfTypeNumericAndNotABoolean() {
        $this->assertFalse(Validator::make(['test' => self::NOT_A_BOOLEAN_AS_NUMERIC])->boolean('test')->validate($this->errors));
        $this->assertContains(self::NOT_A_BOOLEAN_ERROR_MESSAGE, $this->errors['test']);
    }

    public function testItShouldReturnTrueWhenThePropertyIsNotPresentAndCanBeNull() {
        $this->assertTrue(Validator::make(['SomeOtherTest' => self::BOOLEAN_FALSE])->boolean('test', true)->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnFalseWhenThePropertyIsNotPresentAndCannotBeNull() {
        $this->assertFalse(Validator::make(['SomeOtherTest' => self::BOOLEAN_FALSE])->boolean('test', false)->validate($this->errors));
        $this->assertContains(self::PROPERTY_CANNOT_BE_NULL_ERROR_MESSAGE, $this->errors['test']);
    }
}
