<?php

declare(strict_types=1);

namespace Simphle\Tests;

use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use Simphle\Messaging\Email\EmailContact;
use Simphle\Messaging\Email\EmailMessage;
use Simphle\Messaging\Email\Exception\InvalidMessageException;
use Simphle\Messaging\Email\Provider\DummyEmailProvider;

/**
 * @psalm-suppress UnusedClass, PropertyNotSetInConstructor
 */
class SendMessageTest extends TestCase
{
    public function testSendMessage(): void
    {
        self::expectNotToPerformAssertions();
        $message = new EmailMessage();
        $message->setTextBody('Hello World');
        $message->setHTMLBody('<html lang="en"><body><p>Hello  World</p></body></html>');
        $message->setSubject('This is a test message');
        $message->setFrom(new EmailContact('you@example.com', 'Optional Sender Name'));
        $message->addTo(new EmailContact('someoneelse@somewhere.com', 'Optional Recipient Name'));

        $mailer = new DummyEmailProvider(new NullLogger());
        $mailer->send($message);
    }

    public function testErrorOnEmptyBody(): void
    {
        $message = new EmailMessage();
        $message->setSubject('This is a test message');
        $message->setFrom(new EmailContact('you@example.com', 'Optional Sender Name'));
        $message->addTo(new EmailContact('someoneelse@somewhere.com', 'Optional Recipient Name'));

        $mailer = new DummyEmailProvider(new NullLogger());
        $this->expectException(InvalidMessageException::class);
        $this->expectExceptionMessage('Message has no body');
        $mailer->send($message);
    }
}
