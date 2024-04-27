<?php

declare(strict_types=1);

namespace Simphle\Messaging\Email;

use Simphle\Messaging\Email\Exception\InvalidMessageException;

trait EmailMessageValidator
{
    protected function validate(EmailMessageInterface $message): array
    {
        $sender = $message->getFrom()
            ?? throw new InvalidMessageException('Message has no sender');

        $recipients = $message->getTo();
        if (empty($recipients)) {
            throw new InvalidMessageException('Message has no recipients');
        }

        $subject = $message->getSubject()
            ?? throw new InvalidMessageException('Message has no subject');

        $html = $message->getHTMLBody();
        $text = $message->getTextBody();
        /** @psalm-suppress RiskyTruthyFalsyComparison */
        if (empty($html) && empty($text)) {
            throw new InvalidMessageException('Message has no body');
        }
        return [$sender, $recipients, $subject, $html, $text];
    }
}
