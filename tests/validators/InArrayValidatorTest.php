<?php declare(strict_types=1);
namespace validators;


require_once __DIR__ . '/../../vendor/autoload.php';

use nicdamours\Validator\Validator;
use PHPUnit\Framework\TestCase;

class InArrayValidatorTest extends TestCase {

    private $validator;

    const PROPERTY_NOT_FOUND_DEFAULT_MESSAGE = 'property keyThatdoesNotExists was not found but it is required';

    const PROPERTY_NOT_FOUND_CUSTOM_MESSAGE_INPUT = '<property> was not found';

    const PROPERTY_NOT_FOUND_CUSTOM_MESSAGE_OUTPUT = 'test was not found';

    const PROPERTY_NOT_IN_ARRAY_DEFAULT_MESSAGE = 'property test was not in array (someThingToTest)';

    const IN_ARRAY_POSSIBILITIES = ['someThingToTest'];

    private $errors;

    public function setUp(): void {
        $this->validator = Validator::make([
            'test' => 'someThingToTest'
        ]);
        $this->errors = [];
    }

    public function testItShouldValidateAnItemThatIsInAFullArray() {
        $this->assertTrue($this->validator->inArray('test', self::IN_ARRAY_POSSIBILITIES)->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldNotValidateAnItemThatIsInAnEmptyArray() {
        $this->assertFalse($this->validator->inArray('test', [])->validate($this->errors));
        $this->assertContains('property test was invalid: not in array ()', $this->errors['test']);
    }

    public function testItShouldReturnTrueIfTheCaseCanBeNull() {
        $this->assertTrue($this->validator->inArray('keyThatdoesNotExists', self::IN_ARRAY_POSSIBILITIES)->validate($this->errors));
        $this->assertEmpty($this->errors);
    }

    public function testItShouldReturnFalseIfTheCaseCannotBeNull() {
        $this->assertFalse($this->validator->inArray('keyThatdoesNotExists', self::IN_ARRAY_POSSIBILITIES, false)->validate($this->errors));
        $this->assertContains(self::PROPERTY_NOT_FOUND_DEFAULT_MESSAGE, $this->errors['keyThatdoesNotExists']);
    }

    public function testItShouldReturnFalseIfTheTestCaseIsNotInTheArray() {
        $notInArrayMessage = 'property test was invalid: not in array (somethingElseToTest, anotherThingThatIsNotIt)';
        $this->assertFalse($this->validator->inArray('test', ['somethingElseToTest', 'anotherThingThatIsNotIt'], false)->validate($this->errors));
        $this->assertContains($notInArrayMessage, $this->errors['test']);
    }
}

?>
