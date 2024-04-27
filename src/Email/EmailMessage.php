<?php

declare(strict_types=1);

namespace Simphle\Messaging\Email;

class EmailMessage implements EmailMessageInterface
{
    private ?EmailContact $from = null;

    /**
     * @var EmailContact[]
     */
    private array $to = [];

    /**
     * @var EmailContact[]
     */
    private array $cc = [];

    /**
     * @var EmailContact[]
     */
    private array $bcc = [];

    private ?string $subject = null;

    private ?string $textBody = null;
    private ?string $htmlBody = null;

    private ?EmailContact $replyTo = null;

    /**
     * @var EmailAttachment[]
     */
    private array $attachments = [];

    public function setFrom(EmailContact $from): void
    {
        $this->from = $from;
    }

    public function getFrom(): ?EmailContact
    {
        return $this->from;
    }

    public function addTo(EmailContact $to): void
    {
        $this->to[] = $to;
    }

    /**
     * @return EmailContact[]
     */
    public function getTo(): array
    {
        return $this->to;
    }

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setTextBody(string $text): void
    {
        $this->textBody = $text;
    }

    public function getTextBody(): ?string
    {
        return $this->textBody;
    }

    public function setHTMLBody(string $html): void
    {
        $this->htmlBody = $html;
    }

    public function getHTMLBody(): ?string
    {
        return $this->htmlBody;
    }

    public function addCC(EmailContact $cc): void
    {
        $this->cc[] = $cc;
    }

    public function getCC(): array
    {
        return $this->cc;
    }

    public function addBCC(EmailContact $bcc): void
    {
        $this->bcc[] = $bcc;
    }

    public function getBCC(): array
    {
        return $this->bcc;
    }

    public function setReplyTo(EmailContact $email): void
    {
        $this->replyTo = $email;
    }

    public function getReplyTo(): ?EmailContact
    {
        return $this->replyTo;
    }

    public function addAttachment(EmailAttachment $attachment): void
    {
        $this->attachments[] = $attachment;
    }

    public function getAttachments(): array
    {
        return $this->attachments;
    }
}
