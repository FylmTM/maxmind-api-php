<?php

namespace Maxmind\MinFraud\exceptions;

use Exception;

class MissingRequiredFieldException extends \Exception
{
    public function __construct($field, $code = 0, Exception $previous = null)
    {
        parent::__construct("Field '{$field}' are required", $code, $previous);
    }

} 