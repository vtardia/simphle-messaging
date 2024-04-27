<?php

declare(strict_types=1);

namespace Simphle\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Simphle\Messaging\Email\EmailContact;

/**
 * @psalm-suppress UnusedClass, PropertyNotSetInConstructor
 */
class EmailContactTest extends TestCase
{
    public function testEmailContact(): void
    {
        $fox = new EmailContact('f.mulder@fbi.gov', 'Fox Mulder');
        $this->assertEquals('Fox Mulder <f.mulder@fbi.gov>', (string)$fox);
        $this->assertEquals('{"address":"f.mulder@fbi.gov","name":"Fox Mulder"}', json_encode($fox));

        $joe = new EmailContact('joe@example.com');
        $this->assertEquals('joe@example.com', (string)$joe);
        $this->assertEquals('{"address":"joe@example.com"}', json_encode($joe));

        $dana = EmailContact::fromArray(['address' => 'd.scully@example.com', 'name' => 'Dana Scully']);
        $this->assertEquals('d.scully@example.com', $dana->address);
        $this->assertEquals('Dana Scully', $dana->name);
    }

    public function testInvalidEmail(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("'joe' is not a valid email address");
        new EmailContact('joe');
    }

    public function testInvalidEmailFromArray(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('No email address provided');
        EmailContact::fromArray(['name' => 'Dana Scully']);
    }
}
