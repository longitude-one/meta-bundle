<?php

namespace LongitudeOne\MetaBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;

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
        static::$client->request('GET', '/');

        $this->assertTrue(static::$client->getResponse()->isSuccessful(), 'Response of Request / is not successful. Functional tests failed and will fail.');
    }

    public function testMetaAction(): void
    {
        static::$client->request('GET', '/meta');

        $this->assertTrue(static::$client->getResponse()->isSuccessful(), 'Response of Request /meta is not successful. The MetaBundle is failing.');
    }
}
