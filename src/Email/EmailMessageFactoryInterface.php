<?php

declare(strict_types=1);

namespace Simphle\Messaging\Email;

use Simphle\Messaging\MessageFactoryInterface;

interface EmailMessageFactoryInterface extends MessageFactoryInterface
{
    public function build(EmailTemplate $template, array $vars): EmailMessageInterface;
}
