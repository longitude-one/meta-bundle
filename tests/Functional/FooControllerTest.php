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

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;

class FooControllerTest extends WebTestCase
{
    private static ?KernelBrowser $client = null;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        static::$client = static::createClient();
    }

    public static function tearDownAfterClass(): void
    {
        static::$client = null;
        parent::tearDownAfterClass();
    }

    public function testBarAction(): void
    {
        static::$client->request('GET', '/json');

        static::assertTrue(static::$client->getResponse()->isSuccessful(), 'Response of Request /json is not successful. Functional tests are not well initialized.');
    }

    public function testCustomMeta(): void
    {
        static::$client->request('GET', '/meta');
        $response = static::$client->getResponse();
        static::assertTrue($response->isSuccessful(), 'Response of Request /meta is not successful. The LongitudeOneMetaBundle is failing.');
        static::assertStringContainsString('Description for /meta url', $response->getContent());
        static::assertStringContainsString('Image for /meta url', $response->getContent());
        static::assertStringContainsString('Title for /meta url', $response->getContent());

        static::assertStringNotContainsString('My default description', $response->getContent());
        static::assertStringNotContainsString('My default image', $response->getContent());
        static::assertStringNotContainsString('My default title', $response->getContent());
    }

    public function testDefaultMeta(): void
    {
        static::$client->request('GET', '/foo');
        $response = static::$client->getResponse();
        static::assertTrue($response->isSuccessful());

        static::assertStringContainsString('My default description', $response->getContent());
        static::assertStringContainsString('My default image', $response->getContent());
        static::assertStringContainsString('My default title', $response->getContent());
    }

    public function testMetaWithQuotes(): void
    {
        static::$client->request('GET', '/quote');
        $response = static::$client->getResponse();
        static::assertTrue($response->isSuccessful());

        static::assertStringContainsString('Description contains a &quot;quote&quot; for /quote url', $response->getContent(), 'LongitudeOneMetaBundle is no more quote-proof');
        static::assertStringContainsString('Image contains a &quot;quote&quot; for /quote url', $response->getContent(), 'LongitudeOneMetaBundle is no more quote-proof');
        static::assertStringContainsString('Title contains a &quot;quote&quot; for /quote url', $response->getContent(), 'LongitudeOneMetaBundle is no more quote-proof');
    }

    public function testMetaWithInvalidArgument(): void
    {
        static::$client->request('GET', '/invalid');
        $response = static::$client->getResponse();
        static::assertFalse($response->isSuccessful());
        static::assertSame(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
        static::assertStringContainsString('&quot;foo:bar&quot; is not a valid meta-tag.', $response->getContent());
    }
}
