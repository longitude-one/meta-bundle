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

namespace LongitudeOne\MetaBundle\DependencyInjection\Loader\Configurator;

use LongitudeOne\MetaBundle\Service\MetaService;
use LongitudeOne\MetaBundle\Twig\MetaExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\param;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('longitude-one.meta.service', MetaService::class)
        ->args([
            param('meta.defaults'),
            param('meta.paths'),
            service('request_stack'),
        ])
        ->set('longitude-one.meta.twig-extension', MetaExtension::class)
        ->args([service('longitude-one.meta.service')])
        ->tag('twig.extension')
    ;
};
