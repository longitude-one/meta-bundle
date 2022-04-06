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

namespace LongitudeOne\MetaBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class MetaService implements MetaServiceInterface
{
    public function __construct(
        private array $defaults,
        private array $paths,
        private RequestStack $requestStack
    ) {
    }

    public function getMetaContent(string $metaTag): string
    {
        $customContent = $this->getMetaForCurrentPathInfo($metaTag);

        if (false !== $customContent) {
            return $customContent;
        }

        if (key_exists($metaTag, $this->defaults)) {
            return $this->defaults[$metaTag];
        }

        return ''; // TODO throw exception
    }

    private function getMetaForCurrentPathInfo(string $meta): false|string
    {
        $request = $this->requestStack->getCurrentRequest();

        if (!$request instanceof Request) {
            return false;
        }

        $pathInfo = $request->getPathInfo();
        if (key_exists($pathInfo, $this->paths)) {
            if (key_exists($meta, $this->paths[$pathInfo])) {
                if (!empty($this->paths[$pathInfo][$meta])) {
                    return $this->paths[$pathInfo][$meta];
                }
            }
        }

        return false;
    }
}
