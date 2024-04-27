<?php

declare(strict_types=1);

namespace Simphle\Messaging\Email\Provider;

use Psr\Log\LoggerInterface;
use Simphle\Messaging\Email\EmailMessageInterface;
use Simphle\Messaging\Email\EmailMessageValidator;

readonly class DummyEmailProvider implements EmailProviderInterface
{
    use EmailMessageValidator;

    public function __construct(private LoggerInterface $logger)
    {
    }

    public function send(EmailMessageInterface $message, array $options = []): void
    {
        [$sender, $recipients, $subject, $html, $text] = $this->validate($message);
        $this->logger->info('[Dummy Email Provider] Sending email message', [
            'from' => $sender,
            'to' => $recipients,
            'subject' => $subject,
            'html' => $html,
            'text' => $text,
        ]);
    }
}
