<?php

declare(strict_types=1);

namespace Simphle\Messaging\Email;

use Simphle\Messaging\MessageInterface;

interface EmailMessageInterface extends MessageInterface
{
    public function setFrom(EmailContact $from): void;
    public function getFrom(): ?EmailContact;

    public function addTo(EmailContact $to): void;

    /**
     * @return EmailContact[]
     */
    public function getTo(): array;

    public function setSubject(string $subject): void;
    public function getSubject(): ?string;

    public function setTextBody(string $text): void;
    public function getTextBody(): ?string;

    public function setHTMLBody(string $html): void;
    public function getHTMLBody(): ?string;

    public function addCC(EmailContact $cc): void;

    /**
     * @return EmailContact[]
     */
    public function getCC(): array;

    public function addBCC(EmailContact $bcc): void;
    /**
     * @return EmailContact[]
     */
    public function getBCC(): array;

    public function setReplyTo(EmailContact $email): void;

    public function getReplyTo(): ?EmailContact;

    public function addAttachment(EmailAttachment $attachment): void;

    /**
     * @return EmailAttachment[]
     */
    public function getAttachments(): array;
}
