<?php

declare(strict_types=1);

namespace Simphle\Messaging\Email;

use InvalidArgumentException;
use JsonSerializable;

readonly class EmailAttachment implements JsonSerializable
{
    public string $name;

    public string $contentId;

    public function __construct(
        public string $path,
        ?string $name = null,
        ?string $contentId = null,
        public bool $inline = false
    ) {
        $this->name = $name ?? basename($this->path);
        $this->contentId = $contentId ?? $this->name;
    }

    public static function fromArray(array $data): EmailAttachment
    {
        if (!isset($data['path'])) {
            throw new InvalidArgumentException('Path is required');
        }
        return new self(
            path: $data['path'],
            name: $data['name'] ?? null,
            contentId: $data['contentId'] ?? null,
            inline: $data['inline'] ?? false
        );
    }

    public function jsonSerialize(): array
    {
        $data = [
            'path' => $this->path,
            'name' => $this->name,
            'contentId' => $this->contentId,
        ];
        if ($this->inline) {
            $data['inline'] = $this->inline;
        }
        return $data;
    }
}
