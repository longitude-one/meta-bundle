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

namespace LongitudeOne\MetaBundle\Tests\Unit\Controller;

use LongitudeOne\MetaBundle\Tests\App\Controller\FooController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class FooControllerTest extends TestCase
{
    private ?FooController $controller = null;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new FooController();
    }

    protected function tearDown(): void
    {
        $this->controller = null;
        parent::tearDown();
    }

    public function testBarAction(): void
    {
        $this->assertInstanceOf(JsonResponse::class, $this->controller->barAction());
    }

    public function testMetaAction(): void
    {
        $this->assertInstanceOf(JsonResponse::class, $this->controller->barAction());
    }
}
