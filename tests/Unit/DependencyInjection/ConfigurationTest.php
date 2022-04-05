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

namespace LongitudeOne\MetaBundle\Tests\Unit\DependencyInjection;

use LongitudeOne\MetaBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Yaml\Yaml;

class ConfigurationTest extends TestCase
{
    public function testNonValidConfiguration(): void
    {
        self::expectException(InvalidConfigurationException::class);
        self::expectExceptionMessage('Unrecognized options "descriptions, images, titles" under "meta.defaults". Did you mean "description", "image", "title"?');

        $this->process('config-non-valid.yaml');
    }

    public function testValidConfiguration(): void
    {
        $this->process('config-valid.yaml');
        self::assertTrue(true); // No exceptions have been thrown
    }

    public function testValidSmall(): void
    {
        $this->process('config-valid-small.yaml');
        self::assertTrue(true); // No exceptions have been thrown
    }

    private function process(string $filename): void
    {
        $config = Yaml::parse(file_get_contents(__DIR__.'/../config-samples/'.$filename));

        $configs = [$config];

        $processor = new Processor();
        $metaConfiguration = new Configuration();
        $processor->processConfiguration(
            $metaConfiguration,
            $configs
        );
    }
}
