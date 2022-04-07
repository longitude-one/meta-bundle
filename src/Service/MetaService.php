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

namespace LongitudeOne\MetaBundle\Service;

use LongitudeOne\MetaBundle\Exception\InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class MetaService implements MetaServiceInterface
{
    private array $defaults;
    private array $paths;
    private RequestStack $requestStack;

    public function __construct(
        array $defaults,
        array $paths,
        RequestStack $requestStack
    ) {
        $this->requestStack = $requestStack;
        $this->paths = $paths;
        $this->defaults = $defaults;
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

        throw new InvalidArgumentException(sprintf('"%s" is not a valid meta-tag. Did you mispell it ? Did you miss to declare it in your configuration files? By default, the configuration is in the /config/package/meta.yml file)', $metaTag));
    }

    /**
     * @return false|string
     */
    private function getMetaForCurrentPathInfo(string $meta)
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
