<?php

declare(strict_types=1);

namespace Simphle\Messaging\Email\Provider;

use Simphle\Messaging\Email\EmailMessageInterface;

interface EmailProviderInterface
{
    public function send(EmailMessageInterface $message, array $options = []): void;
}
