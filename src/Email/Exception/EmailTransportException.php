<?php

declare(strict_types=1);

namespace Simphle\Messaging\Email\Exception;

use RuntimeException;

class EmailTransportException extends RuntimeException
{
    protected $message = 'Unable to send email';
}
