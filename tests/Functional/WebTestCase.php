<?php

/**
 * Meta Bundle
 *
 * PHP 7.4|8
 * Symfony 5.4 | 6
 *
 * Copyright LongitudeOne - Alexandre Tranchant
 *
 * Copyright 2021 - 2022
 */

namespace LongitudeOne\MetaBundle\Tests\Functional;

use LongitudeOne\MetaBundle\Tests\App\AppKernel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as SymfonyWebTestCase;

abstract class WebTestCase extends SymfonyWebTestCase
{
    protected static function getKernelClass(): string
    {
        return AppKernel::class;
    }
}
