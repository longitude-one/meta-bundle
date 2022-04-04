<?php

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
