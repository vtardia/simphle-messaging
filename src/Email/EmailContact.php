<?php

declare(strict_types=1);

namespace Simphle\Messaging\Email;

use InvalidArgumentException;
use JsonSerializable;

readonly class EmailContact implements JsonSerializable
{
    public function __construct(
        public string $address,
        public ?string $name = null
    ) {
        if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("'$address' is not a valid email address");
        }
    }

    public static function fromArray(array $data): EmailContact
    {
        if (!isset($data['address'])) {
            throw new InvalidArgumentException('No email address provided');
        }
        return new self($data['address'], $data['name'] ?? null);
    }

    public function __toString(): string
    {
        if (isset($this->name)) {
            return "$this->name <$this->address>";
        }
        return $this->address;
    }

    public function jsonSerialize(): array
    {
        $data = [
            'address' => $this->address
        ];
        if (!is_null($this->name)) {
            $data['name'] = $this->name;
        }
        return $data;
    }
}
