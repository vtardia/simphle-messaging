# Simphle Messaging

Simphle Messaging is a library to send email messages from PHP application.

## Install

```shell
composer require vtardia/simphle-messaging
```

## Usage

The simplest way to send an email message is:

```php
use Simphle\Messaging\Email\EmailMessage;
use Simphle\Messaging\Email\EmailContact;
use Simphle\Messaging\Email\Provider\PHPMailerEmailProvider;
use Simphle\Messaging\Email\SMTPOptions;
use Simphle\Messaging\Email\Exception\EmailTransportException;
use Simphle\Messaging\Email\Exception\InvalidMessageException;

try {
    // Compose a message
    $message = new EmailMessage();
    $message->setTextBody('Hello World');
    $message->setHTMLBody('<html><body><p>Hello  World</p></body></html>');
    $message->setSubject('This is a test message');
    $message->setFrom(new EmailContact('you@example.com', 'Optional Sender Name'));
    $message->addTo(new EmailContact('someoneelse@somewhere.com', 'Optional Recipient Name'));
    
    // Create a mailer using one of the available providers,
    // in this case SMTP with PHPMailer
    $mailer = new PHPMailerEmailProvider(
        new SMTPOptions(
            host: 'smtp.mailer.com',
            port: 25,
            username: 'you',
            password: 'YourPassword'
        ),
        /* optional PRS logger */
    );
    
    // Send the email
    $mailer->send($message /*, [some, options]*/);
} catch (InvalidMessageException $e) {
    // Do something...
} catch (EmailTransportException $e) {
    // Do something else...
}
```

Messages are sent using email providers, which are classes implementing an `EmailProviderInterface`. Simphle Message has a built-in dummy email provider and out-of-the-box providers for:

 - SMTP via PHPMailer
 - Postmark via their official client
 - SparkPost via their official client

Each provider library must be installed separately.

### Using factories and templates

If you want to send emails within a non-trivial web application, you may need to use templates to generate messages with custom content.

Simphle Message provides an `EmailMessageFactoryInterface` which you can implement using your favourite template library. Your code will look like:

```php
use Simphle\Messaging\Email\EmailTemplate;

$factory = new EmailMessageFactory(view: $yourView, logger: $yourLogger);
$message = $factory->build(
    new EmailTemplate('relative/path/to/template' /*, optional layout */),
    ['name' => 'John Smith', 'title' => 'Mr']
);
// Set from, to, subject, etc
```

The exact parameters for the template depend on which library you are using. With Twig, you need to configure the renderer with the base path so that you can specify the relative path of the template. You will not need a layout because you can reference it from the template. Other template engines may require a different configuration. 

### Adding attachments

```php
use Simphle\Messaging\Email\EmailAttachment;

$message->addAttachment(new EmailAttachment(
    path: 'relative/path/to/file.ext',
    name: 'filename.ext'
));
$mailer->send($message, ['baseDir' => $basePathForAttachments]);
```

### Inline images

To send inline images, you need reference the image using a content id within your email markup:

```html
<p><img src="cid:companyLogo" alt="Acme Ltd"></p>
```

And then add the file attachment as inline:

```php
use Simphle\Messaging\Email\EmailAttachment;

$message->addAttachment(new EmailAttachment(
    path: 'relative/path/to/logo.png',
    name: 'logo.png',
    contentId: 'companyLogo',
    inline: true
));
$mailer->send($message, ['baseDir' => $basePathForAttachments]);
```
