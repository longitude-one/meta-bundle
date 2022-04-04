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

namespace LongitudeOne\MetaBundle\Tests\App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FooController extends AbstractController
{
    public function barAction(): JsonResponse
    {
        return new JsonResponse(['foo' => 'bar']);
    }

    public function metaAction(): Response
    {
        return $this->render('meta.html.twig');
    }
}
