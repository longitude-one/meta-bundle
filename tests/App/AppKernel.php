<?php

namespace LongitudeOne\MetaBundle\Tests\App;

use Exception;
use JetBrains\PhpStorm\Pure;
use LongitudeOne\MetaBundle\MetaBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    #[Pure]
    public function registerBundles(): iterable
    {
        return [
            new FrameworkBundle(),
            new MetaBundle(),
            new TwigBundle(),
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
    }
}
