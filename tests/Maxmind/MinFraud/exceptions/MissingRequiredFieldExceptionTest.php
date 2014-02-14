<?php

namespace tests\Maxmind\MinFraud\exceptions;

use Maxmind\MinFraud\exceptions\MissingRequiredFieldException;

class MissingRequiredFieldExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testMessageAreCorrect()
    {
        $exception = new MissingRequiredFieldException('missingField');
        $this->assertEquals("Field 'missingField' are required", $exception->getMessage());
    }
}
 