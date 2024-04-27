<?php

/**
 * EmailTemplate is a generic container value object class.
 * Each concrete factory can interpret the values in a
 * different way depending on their business logic and
 * the template engine used.
 *
 * For example, Twig templates will always have a null layout
 * because the layout is defined within the template file.
 */

declare(strict_types=1);

namespace Simphle\Messaging\Email;

readonly class EmailTemplate
{
    /**
     * @param string $name Relative path of the template file (with or without extension)
     * @param ?string $layout Engine-dependant layout file name or path
     */
    public function __construct(
        public string $name,
        public ?string $layout = null
    ) {
    }
}
