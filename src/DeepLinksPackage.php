<?php

declare(strict_types=1);

namespace Bone\DeepLinks;

use Barnacle\Container;
use Bone\Contracts\Container\ContainerInterface;
use Bone\Contracts\Container\RegistrationInterface;
use Bone\Router\Router;
use Bone\Router\RouterConfigInterface;

class DeepLinksPackage implements RegistrationInterface, RouterConfigInterface
{
    public function addToContainer(ContainerInterface $c): void
    {

    }

    public function addRoutes(Container $c, Router $router)
    {
       $router->get('/.well-known', function () {return 'HELLO';} );
    }
}
