<?php

/**
 * Meta Bundle
 *
 * PHP 8 | Symfony 5.4 | 6
 *
 * Copyright LongitudeOne - Alexandre Tranchant
 *
 * Copyright 2021 - 2022
 */

namespace LongitudeOne\MetaBundle\Twig;

use JetBrains\PhpStorm\Pure;
use LongitudeOne\MetaBundle\Service\MetaService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MetaExtension extends AbstractExtension
{
    public function __construct(
        private MetaService $service
    ) {
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('meta_description', [$this, 'getDescription']),
            new TwigFunction('meta_image', [$this, 'getImage']),
            new TwigFunction('meta_title', [$this, 'getTitle']),
        ];
    }

    #[Pure]
    public function getDescription(): string
    {
        return $this->service->getMetaContent('description');
    }

    #[Pure]
    public function getImage(): string
    {
        return $this->service->getMetaContent('image');
    }

    #[Pure]
    public function getTitle(): string
    {
        return $this->service->getMetaContent('title');
    }
}
