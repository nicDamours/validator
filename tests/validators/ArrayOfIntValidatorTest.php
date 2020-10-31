<?php


namespace validators;

require_once __DIR__ . '/../../vendor/autoload.php';

use nicDamours\Validator\Validator;
use PHPUnit\Framework\TestCase;

class ArrayOfIntValidatorTest extends TestCase {
    private $errors;

    const ARRAY_OF_NUMERIC_VALUES = [1,2,3,4,5];

    const ARRAY_OF_POSITIVE_AND_NEGATIVE_VALUES = [-1, 2, -3, 4];

    const ARRAY_OF_POSITIVE_AND_NEGATIVE_VALUES_AS_STRING = ["-1", "2", "-3", "4"];

    const ARRAY_OF_NUMERIC_VALUE_AS_STRING = ["1", "2", "3", "4"];

    const ARRAY_OF_NUMERIC_VALUE_AS_STRING_AND_INTEGER = ["1", 2, "3", 4];

    const ARRAY_OF_ALPHA_NUMERIC_VALUES = [1, 2, "A", 4, "5"];

    const ARRAY_OF_ONLY_ALPHA_NUMERIC_VALUES = ["A", "B", "C"];

    const EMPTY_ARRAY = [];

    const NOT_AN_ARRAY = "somethingThatIsNotAnArray";

    const NOT_A_ARRAY_OF_INTEGER_ERROR_MESSAGE = "property test was invalid: not an array of integers";

    const PROPERTY_CANNOT_BE_NULL_ERROR_MESSAGE = "property test was not found but it is required";

    public function setUp(): void {
        $this->errors = [];
    }


    public function testItShouldReturnTrueWhenThePropertyIsAnArrayOfInt() {
        $this->assertTrue(Validator::make(['test' => self::ARRAY_OF_NUMERIC_VALUES])->arrayOfInt('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnFalseWhenThePropertyContainsAnAlphaNumericString() {
        $this->assertFalse(Validator::make(['test' => self::ARRAY_OF_ALPHA_NUMERIC_VALUES])->arrayOfInt('test')->validate($this->errors));
        $this->assertContains(self::NOT_A_ARRAY_OF_INTEGER_ERROR_MESSAGE, $this->errors['test']);
    }

    public function testItShouldReturnTrueWhenThePropertyAreIntegerButAsString() {
        $this->assertTrue(Validator::make(['test' => self::ARRAY_OF_NUMERIC_VALUE_AS_STRING])->arrayOfInt('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenThePropertyHasNegativeIntegerInTheArray() {
        $this->assertTrue(Validator::make(['test' => self::ARRAY_OF_POSITIVE_AND_NEGATIVE_VALUES])->arrayOfInt('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenThePropertyHasNegativeIntegerAsStringInTheArray() {
        $this->assertTrue(Validator::make(['test' => self::ARRAY_OF_POSITIVE_AND_NEGATIVE_VALUES_AS_STRING])->arrayOfInt('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenThePropertyIsNullAndCanBeNull() {
        $this->assertTrue(Validator::make(['otherTest' => self::ARRAY_OF_NUMERIC_VALUES])->arrayOfInt('test', true)->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnFalseWhenThePropertyIsNullAndCannotBeNull() {
        $this->assertFalse(Validator::make(['otherTest' => self::ARRAY_OF_NUMERIC_VALUES])->arrayOfInt('test', false)->validate($this->errors));
        $this->assertContains(self::PROPERTY_CANNOT_BE_NULL_ERROR_MESSAGE, $this->errors['test']);
    }

    public function testItShouldReturnTrueWhenThePropertyIsNumericCharacterOnlyInBothStringAndIntegerForm() {
        $this->assertTrue(Validator::make(['test' => self::ARRAY_OF_NUMERIC_VALUE_AS_STRING_AND_INTEGER])->arrayOfInt('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnFalseWhenThePropertyContainsAlphaNumericAndNumericValues() {
        $this->assertFalse(Validator::make(['test' => self::ARRAY_OF_ALPHA_NUMERIC_VALUES])->arrayOfInt('test')->validate($this->errors));
        $this->assertContains(self::NOT_A_ARRAY_OF_INTEGER_ERROR_MESSAGE, $this->errors['test']);
    }

    public function testItShouldReturnFalseWhenThePropertyContainsOnlyAlphaCharacter() {
        $this->assertFalse(Validator::make(['test' => self::ARRAY_OF_ONLY_ALPHA_NUMERIC_VALUES])->arrayOfInt('test')->validate($this->errors));
        $this->assertContains(self::NOT_A_ARRAY_OF_INTEGER_ERROR_MESSAGE, $this->errors['test']);
    }

    public function testItShouldReturnTrueWhenThePropertyIsAnEmptyArrayAndPropertyCanBeNull() {
        $this->assertTrue(Validator::make(['test' => self::EMPTY_ARRAY])->arrayOfInt('test', true)->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnFalseWhenThePropertyIsAbnEmptyArrayAndThePropertyCannotBeNull() {
        $this->assertFalse(Validator::make(['test' => self::EMPTY_ARRAY])->arrayOfInt('test', false)->validate($this->errors));
        $this->assertContains(self::PROPERTY_CANNOT_BE_NULL_ERROR_MESSAGE, $this->errors['test']);
    }

    public function testItShouldReturnFalseWhenThePropertyIsNotAnArray() {
        $this->assertFalse(Validator::make(['test' => self::NOT_AN_ARRAY])->arrayOfInt('test')->validate($this->errors));
        $this->assertContains(self::NOT_A_ARRAY_OF_INTEGER_ERROR_MESSAGE, $this->errors['test']);
    }


}
