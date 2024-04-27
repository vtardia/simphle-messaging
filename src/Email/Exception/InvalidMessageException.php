<?php

declare(strict_types=1);

namespace Simphle\Messaging\Email\Exception;

use InvalidArgumentException;

class InvalidMessageException extends InvalidArgumentException
{
    protected $message = 'Invalid or empty message body';
}
