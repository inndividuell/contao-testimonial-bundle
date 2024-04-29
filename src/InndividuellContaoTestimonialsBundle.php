<?php

declare(strict_types=1);

/*
 * This file is part of [package name].
 *
 * (c) John Doe
 *
 * @license LGPL-3.0-or-later
 */
namespace Inndividuell\ContaoTestimonialsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class InndividuellContaoTestimonialsBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
