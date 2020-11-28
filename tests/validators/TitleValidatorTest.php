<?php

namespace validators;

require_once __DIR__ . '/../../vendor/autoload.php';

use nicDamours\Validator\Validator;
use PHPUnit\Framework\TestCase;

class TitleValidatorTest extends TestCase {
    const TITLE_WITH_ALPHA_NUMERIC_CHARACTERS = "test1234%";
}
