<?php


namespace validators;


use nicDamours\Validator\Validator;
use PHPUnit\Framework\TestCase;

class ArrayOfStringValidatorTest extends TestCase {

    private $errors;

    const ARRAY_OF_STRING_VALUES = ["1","2","3","4","5"];

    const ARRAY_OF_STRING_AND_INTEGERS_VALUES = ["1", 2, "3", 4];

    const EMPTY_ARRAY = [];

    const NOT_AN_ARRAY = "somethingThatIsNotAnArray";

    const NOT_A_ARRAY_OF_STRING_ERROR_MESSAGE = "property test was invalid: not an array of strings";

    const PROPERTY_CANNOT_BE_NULL_ERROR_MESSAGE = "property test was not found but it is required";

    protected function setUp(): void{
        $this->errors = [];
    }

    public function testItShouldReturnTrueWhenThePropertyIsAnArrayOfString() {
        $this->assertTrue(Validator::make(['test' => self::ARRAY_OF_STRING_VALUES])->arrayOfString('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnFalseWhenThePropertyIsNotAnArrayOfString() {
        $this->assertFalse(Validator::make(['test' => self::ARRAY_OF_STRING_AND_INTEGERS_VALUES])->arrayOfString('test')->validate($this->errors));
        $this->assertContains(self::NOT_A_ARRAY_OF_STRING_ERROR_MESSAGE, $this->errors['test']);
    }

    public function testItShouldReturnTrueWhenThePropertyIsNullAndCanBeNull() {
        $this->assertTrue(Validator::make(['someOtherTest' => []])->arrayOfString('test', true)->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnFalseWhenThePropertyIsNullAndCannotBeNull() {
        $this->assertFalse(Validator::make(['someOtherTest' => []])->arrayOfString('test', false)->validate($this->errors));
        $this->assertContains(self::PROPERTY_CANNOT_BE_NULL_ERROR_MESSAGE, $this->errors['test']);
    }

    public function testItShouldReturnTrueWhenThePropertyIsAnEmptyArrayAndCanBeNull() {
        $this->assertTrue(Validator::make(['test' => self::EMPTY_ARRAY])->arrayOfString('test', true)->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnFalseWhenThePropertyIsAnEmptyArrayAndCannotBeNull() {
        $this->assertFalse(Validator::make(['test' => self::EMPTY_ARRAY])->arrayOfString('test', false)->validate($this->errors));
        $this->assertContains(self::PROPERTY_CANNOT_BE_NULL_ERROR_MESSAGE, $this->errors['test']);
    }

    public function testItShouldReturnFalseWhenThePropertyIsNotAnArray() {
        $this->assertFalse(Validator::make(['test' => self::NOT_AN_ARRAY])->arrayOfString('test')->validate($this->errors));
        $this->assertContains(self::NOT_A_ARRAY_OF_STRING_ERROR_MESSAGE, $this->errors['test']);
    }
}
