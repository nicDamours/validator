<?php declare(strict_types=1);


use nicdamours\Validator\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTestInArrayTest extends TestCase {
    public function testItShouldValidateAnItemThatIsInAFullArray() {
        $validator = Validator::make([
            'test' => 'someThingToTest'
        ]);
        $this->assertTrue($validator->inArray('test', ['someThingToTest'])->validate());
    }

    public function testItShouldNotValidateAnItemThatIsInAnEmptyArray() {
        $validator = Validator::make([
            'test' => 'someThingToTest'
        ]);
        $this->assertFalse($validator->inArray('test', [])->validate());
    }

    public function testItShouldReturnTrueIfTheCaseCanBeNull() {
        $validator = Validator::make([
            'test' => 'someThingToTest'
        ]);
        $this->assertTrue($validator->inArray('keyThatdoesNotExists', ['someThingToTest'])->validate());
    }

    public function testItShouldReturnFalseIfTheCaseCannotBeNull() {
        $validator = Validator::make([
            'test' => 'someThingToTest'
        ]);
        $this->assertFalse($validator->inArray('keyThatdoesNotExists', ['someThingToTest'], false)->validate());
    }

    public function testItShouldReturnFasleIfTheTestCaseIsNotInTheArray() {
        $validator = Validator::make([
            'test' => 'someThingToTest'
        ]);
        $this->assertFalse($validator->inArray('test', ['somethingElseToTest', 'anotherThingThatIsNotIt'], false)->validate());
    }
}

?>
