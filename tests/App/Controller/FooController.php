<?php

namespace LongitudeOne\MetaBundle\Tests\App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class FooController
{
    public function barAction(): JsonResponse
    {
        return new JsonResponse(['foo' => 'bar']);
    }
}
