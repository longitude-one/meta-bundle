<?php

namespace LongitudeOne\MetaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MetaBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
