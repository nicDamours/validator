<?php


namespace validators;

use nicDamours\Validator\I18n;
use nicDamours\Validator\Validator;
use PHPUnit\Framework\TestCase;

class FloatValidatorTest extends TestCase {

    const FLOAT_WITH_2_DIGITS = 2.34;

    const FLOAT_WITH_MORE_THAN_TWO_DIGITS = 2.329083;

    const INTEGER = 2;

    const FLOAT_AS_STRING_WITH_TWO_DIGITS = '2.34';

    const FLOAT_WITH_MORE_THAN_TWO_DIGITS_AS_STRING = '2.1324098';

    const NEGATIVE_FLOAT_WITH_TWO_DIGITS = -2.34;

    const NEGATIVE_INTEGER = -1;

    const NEGATIVE_FLOAT_WITH_MORE_THAN_TWO_DIGITS = -2.129038;

    const NEGATIVE_FLOAT_AS_STRING = '-1.12';

    const NEGATIVE_FLOAT_WITH_MORE_THAN_TWO_DIGITS_AS_STRING = '-212.123098123';

    const NEGATIVE_INTEGER_AS_STRING = '-123';

    const INTEGER_AS_STRING = '2';

    const STRING_THAT_IS_NOT_A_FLOAT = 'test';

    const STRING_THAT_CONTAINS_FLOAT_BUT_NOT_ALL_OF_IT = 'test32.34';

    const NEITHER_A_FLOAT_NOT_A_STRING = [];

    const NULL = null;

    const NOT_A_FLOAT_ERROR_MESSAGE = "property test was invalid: not a float";

    const PROPERTY_CANNOT_BE_NULL_ERROR_MESSAGE = "property test was not found but it is required";

    /**
     * @var array
     */
    private $errors;

    protected function setUp(): void{
        $this->errors = [];
    }

    public function testItShouldReturnTrueWhenPassingAFloatWithDigitsAsAPrimitive() {
        $this->assertTrue(Validator::make(['test' => self::FLOAT_WITH_2_DIGITS])->float('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenPassingAFloatWithManyDigitsAsAPrimitive() {
        $this->assertTrue(Validator::make( ['test' => self::FLOAT_WITH_MORE_THAN_TWO_DIGITS])->float('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenPassingAnIntegerAsAPrimitive() {
        $this->assertTrue(Validator::make(['test' => self::INTEGER])->float('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenPassingAFloatWithTwoDigitAsAString() {
        $this->assertTrue(Validator::make(['test' => self::FLOAT_AS_STRING_WITH_TWO_DIGITS])->float('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenPassingAFloatWithMutlipleDigitsAsAString() {
        $this->assertTrue(Validator::make(['test' => self::FLOAT_WITH_MORE_THAN_TWO_DIGITS_AS_STRING])->float('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenPassingAnIntegerAsAString() {
        $this->assertTrue(Validator::make(['test' => self::INTEGER_AS_STRING])->float('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenPassingANegativeFloatAsPrimitive() {
        $this->assertTrue(Validator::make(['test' => self::NEGATIVE_FLOAT_WITH_TWO_DIGITS])->float('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenPassingNegativeFloatWithMoreThanTwoDigitsAsPrimitive() {
        $this->assertTrue(Validator::make(['test' => self::NEGATIVE_FLOAT_WITH_MORE_THAN_TWO_DIGITS])->float('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenPassingANegativeIntegerAsPrimitive() {
        $this->assertTrue(Validator::make(['test' => self::NEGATIVE_INTEGER])->float('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenPassingANegativeFloatAsString() {
        $this->assertTrue(Validator::make(['test' => self::NEGATIVE_FLOAT_AS_STRING])->float('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenPassingANegativeFloatWithMutlipleDigitsAsString() {
        $this->assertTrue(Validator::make(['test' => self::NEGATIVE_FLOAT_WITH_MORE_THAN_TWO_DIGITS_AS_STRING])->float('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnTrueWhenPassingANegativeIntegerAsString() {
        $this->assertTrue(Validator::make(['test' => self::NEGATIVE_INTEGER])->float('test')->validate($this->errors));
        $this->assertEmpty($this->errors);
    }


    public function testItShouldReturnFalseWhenPassingAPrimitiveThatIsNotAStringNorAFloatOrAnInteger() {
        $this->assertFalse(Validator::make(['test' => self::NEITHER_A_FLOAT_NOT_A_STRING])->float('test')->validate($this->errors));
        $this->assertContains(self::NOT_A_FLOAT_ERROR_MESSAGE, $this->errors['test']);
    }

    public function testItShouldReturnFalseWhenPassingAStringThatIsNotAFloatNorAnInteger() {
        $this->assertFalse(Validator::make(['test' => self::STRING_THAT_IS_NOT_A_FLOAT])->float('test')->validate($this->errors));
        $this->assertContains(self::NOT_A_FLOAT_ERROR_MESSAGE,$this->errors['test']);
    }

    public function testItShouldReturnFalseWhenPassingAStringThatContainsAFloatButNotAllOfIt() {
        $this->assertFalse(Validator::make(['test' => self::STRING_THAT_CONTAINS_FLOAT_BUT_NOT_ALL_OF_IT])->float('test')->validate($this->errors));
        $this->assertContains(self::NOT_A_FLOAT_ERROR_MESSAGE, $this->errors['test']);
    }

    public function testItShouldReturnFalseWhenTheValueIsRequiredButNotPresent() {
        $this->assertFalse(Validator::make(['autreTest' => self::FLOAT_WITH_2_DIGITS])->float('test', false)->validate($this->errors));
        $this->assertContains(self::PROPERTY_CANNOT_BE_NULL_ERROR_MESSAGE, $this->errors['test']);
    }


}
