<?php declare(strict_types=1);

require_once __DIR__ . '/../src/I18n.php';

use nicdamours\Validator\I18n;
use PHPUnit\Framework\TestCase;

class i18nTest extends TestCase {

    const TEST_SUBJECT_1_VALUE = 'another validator!';
    const TEST_SUBJECT_1_KEY = 'another_validator';

    const TEST_SUBJECT_2_VALUE = 'validator 1';
    const TEST_SUBJECT_2_KEY = 'testSubject';

    const ONE_TEST_SUBJECT_MESSAGE = '<' . self::TEST_SUBJECT_2_KEY . '>' . ' something else';
    const ONE_TEST_SUBJECT_MESSAGE_KEY = 'oneTestSubjectMessage';
    const ONE_TEST_SUBJECT_MESSAGE_OUTPUT = self::TEST_SUBJECT_2_VALUE . ' something else';

    const ONE_TEST_SUBJECT_TWICE_MESSAGE = '<' . self::TEST_SUBJECT_2_KEY . '>' . ' something else ' . '<' . self::TEST_SUBJECT_2_KEY . '>';
    const ONE_TEST_SUBJECT_TWICE_MESSAGE_KEY = 'oneTestSubjectTwiceMessage';
    const ONE_TEST_SUBJECT_TWICE_MESSAGE_OUTPUT = self::TEST_SUBJECT_2_VALUE . ' something else ' . self::TEST_SUBJECT_2_VALUE;

    const NO_TEST_SUBJECT_MESSAGE = 'no subject at all';
    const NO_TEST_SUBJECT_MESSAGE_KEY = 'noTestSubjectMessage';

    const TWO_TEST_SUBJECT_MESSAGE = '<' . self::TEST_SUBJECT_2_KEY . '>' . ' mutliple test subject ' . '<' . self::TEST_SUBJECT_1_KEY . '>';
    const TWO_TEST_SUBJECT_MESSAGE_KEY = 'twoTestSubjectMessage';
    const TWO_TEST_SUBJECT_MESSAGE_OUTPUT = self::TEST_SUBJECT_2_VALUE . ' mutliple test subject ' . self::TEST_SUBJECT_1_VALUE;

    const TWO_TEST_SUBJECT_TWICE_MESSAGE = '<' . self::TEST_SUBJECT_2_KEY . '>' . ' mutliple ' . '<' . self::TEST_SUBJECT_2_KEY . '>' . ' test ' . '<' . self::TEST_SUBJECT_1_KEY . '>' . ' subject ' . '<' . self::TEST_SUBJECT_1_KEY . '>';
    const TWO_TEST_SUBJECT_TWICE_MESSAGE_KEY = 'twoTestSubjectTwiceMessage';
    const TWO_TEST_SUBJECT_TWICE_MESSAGE_OUTPUT = self::TEST_SUBJECT_2_VALUE . ' mutliple ' . self::TEST_SUBJECT_2_VALUE . ' test ' . self::TEST_SUBJECT_1_VALUE . ' subject ' . self::TEST_SUBJECT_1_VALUE;

    const TEST_MESSAGES = [
        self::ONE_TEST_SUBJECT_MESSAGE_KEY => self::ONE_TEST_SUBJECT_MESSAGE,
        self::ONE_TEST_SUBJECT_TWICE_MESSAGE_KEY => self::ONE_TEST_SUBJECT_TWICE_MESSAGE,
        self::NO_TEST_SUBJECT_MESSAGE_KEY => self::NO_TEST_SUBJECT_MESSAGE,
        self::TWO_TEST_SUBJECT_MESSAGE_KEY => self::TWO_TEST_SUBJECT_MESSAGE,
        self::TWO_TEST_SUBJECT_TWICE_MESSAGE_KEY => self::TWO_TEST_SUBJECT_TWICE_MESSAGE
    ];

    public function setUp(): void {
        I18n::defineI18n(self::TEST_MESSAGES);
    }

    public function testWhenPassingMessageWithOneSubjectItShouldReturnTheFormattedMessage() {
        $this->assertEquals(self::ONE_TEST_SUBJECT_MESSAGE_OUTPUT, I18n::getMessage(self::ONE_TEST_SUBJECT_MESSAGE_KEY, [
            self::TEST_SUBJECT_2_KEY => self::TEST_SUBJECT_2_VALUE
        ]));
    }

    public function testWhenPassingMessageWithOneSubjectTwiceItShouldReturnTheFormattedMessage() {
        $this->assertEquals(self::ONE_TEST_SUBJECT_TWICE_MESSAGE_OUTPUT, I18n::getMessage(self::ONE_TEST_SUBJECT_TWICE_MESSAGE_KEY, [
            self::TEST_SUBJECT_2_KEY => self::TEST_SUBJECT_2_VALUE
        ]));
    }

    public function testWhenPassingMessageWithNoSubjectItShouldReturnTheSameMessage() {
        $this->assertEquals(self::NO_TEST_SUBJECT_MESSAGE, I18n::getMessage(self::NO_TEST_SUBJECT_MESSAGE_KEY));
    }

    public function testWhenPassingMessageWithTwoSubjectItShouldReturnTheFormattedMessage() {
        $this->assertEquals(self::TWO_TEST_SUBJECT_MESSAGE_OUTPUT, I18n::getMessage(self::TWO_TEST_SUBJECT_MESSAGE_KEY, [
            self::TEST_SUBJECT_1_KEY => self::TEST_SUBJECT_1_VALUE,
            self::TEST_SUBJECT_2_KEY => self::TEST_SUBJECT_2_VALUE
        ]));
    }

    public function testWhenPassingMessageWithTwoSubjectTwiceItShouldReturnTheFormattedMessage() {
        $this->assertEquals(self::TWO_TEST_SUBJECT_TWICE_MESSAGE_OUTPUT, I18n::getMessage(self::TWO_TEST_SUBJECT_TWICE_MESSAGE_KEY, [
            self::TEST_SUBJECT_1_KEY => self::TEST_SUBJECT_1_VALUE,
            self::TEST_SUBJECT_2_KEY => self::TEST_SUBJECT_2_VALUE
        ]));
    }
}

