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
        self::expectExceptionMessage('Invalid type for path "meta.paths./mon_url.bad_tag_content". Expected "scalar", but got "array".');

        $this->processFile('config-non-valid.yaml');
    }

    public function testEmptyConfiguration(): void
    {
        $metaArray = $this->process('');
        self::assertSame($metaArray, [
            'defaults' => [],
            'paths' => [],
        ]);
    }

    public function testValidConfiguration(): void
    {
        $metaArray = $this->processFile('config-valid.yaml');
        self::assertSame($metaArray, [
            'defaults' => [
                'description' => 'My default description',
                'image' => 'My default image',
                'title' => 'My default title',
            ],
            'paths' => [
                '/meta' => [
                    'description' => 'Description for /meta url',
                    'image' => 'Image for /meta url',
                    'title' => 'Title for /meta url',
                ],
                '/' => [
                    'description' => 'Description for / url',
                    'image' => '',
                    'title' => 'Title for / url',
                ],
            ],
        ]);
    }

    public function testValidSmall(): void
    {
        $metaArray = $this->processFile('config-valid-small.yaml');
        self::assertSame($metaArray, [
            'defaults' => [
                'description' => 'My default description',
                'image' => 'My default image',
                'title' => 'My default title',
            ],
            'paths' => [],
        ]);
    }

    private function processFile(string $filename): array
    {
        return $this->process(file_get_contents(__DIR__.'/../config-samples/'.$filename));
    }

    private function process(string $content): array
    {
        $config = Yaml::parse($content);

        $configs = [$config];

        $processor = new Processor();
        $metaConfiguration = new Configuration();
        $result = $processor->processConfiguration(
            $metaConfiguration,
            $configs
        );

        return $result;
    }
}
