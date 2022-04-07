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

namespace LongitudeOne\MetaBundle\Tests\App;

use Exception;
use LongitudeOne\MetaBundle\LongitudeOneMetaBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    public function registerBundles(): iterable
    {
        return [
            new FrameworkBundle(),
            new TwigBundle(),
            new LongitudeOneMetaBundle(),
        ];
    }

    /**
     * @throws Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__.'/config/config.yaml');
        $loader->load(__DIR__.'/config/services.yaml');
        $loader->load(__DIR__.'/config/twig.yaml');
        $loader->load(__DIR__.'/config/meta.yaml');
    }
}
