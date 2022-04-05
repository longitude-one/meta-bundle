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

use LongitudeOne\MetaBundle\Service\MetaService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MetaExtension extends AbstractExtension
{
    public function __construct(
        private MetaService $service
    ) {
    }

    /**
     * @return TwigFilter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('meta', [$this, 'getCustomMeta']),
        ];
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('meta_description', [$this, 'getDescription']),
            new TwigFunction('meta_title', [$this, 'getTitle']),
            new TwigFunction('meta', [$this, 'getCustomMeta']),
        ];
    }

    public function getCustomMeta($meta): string
    {
        return $this->service->getMetaContent($meta);
    }

    public function getDescription(): string
    {
        return $this->service->getMetaContent('description');
    }

    public function getTitle(): string
    {
        return $this->service->getMetaContent('title');
    }
}
