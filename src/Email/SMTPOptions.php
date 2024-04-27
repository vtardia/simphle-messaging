<?php

declare(strict_types=1);

namespace Simphle\Messaging\Email;

final readonly class SMTPOptions
{
    public function __construct(
        public string $host,
        public int $port,
        public string $username,
        public string $password
    ) {
    }
}
