<?php

declare(strict_types=1);

namespace Bone\DeepLinks;

use Barnacle\Container;
use Bone\Contracts\Container\ContainerInterface;
use Bone\Contracts\Container\RegistrationInterface;
use Bone\DeepLinks\Controller\DeepLinksController;
use Bone\Router\Router;
use Bone\Router\RouterConfigInterface;

class DeepLinksPackage implements RegistrationInterface, RouterConfigInterface
{
    const DEFAULTS = [
        'iOS' => [
            'applinks' => [
                'details' => [
                    [
                        'appID' => '',
                        'paths' => ['*']
                    ]
                ]
            ]
        ],
        'Android' => [
            [
                'relation' => ['delegate_permission/webhandle/https/boneframework.docker'],
                'target' => [
                    'application' => [
                        'name' => 'Bone Native',
                        'package_name' => 'com.boneframework.bonenative',
                        'app_signing' => [
                            'hash_instructions' => 'sha256'
                        ]
                    ]
                ]
            ]
        ],
    ];

    public function addToContainer(ContainerInterface $c): void
    {
        $config = $c->has('bone-native') ? $c->get('bone-native')['deep-links'] ?? self::DEFAULTS : self::DEFAULTS;

        if ($config['iOS']['applinks']['details'][0]['appID'] === '') {
            $config['iOS']['applinks']['details'][0]['appID'] = getenv('IOS_APP_ID') ?? '';
        }

        $c[DeepLinksController::class] = $c->factory(function () use ($config) {
            return new DeepLinksController($config);
        });
    }

    public function addRoutes(Container $c, Router $router)
    {
       $router->get('/.well-known/apple-app-site-association', [DeepLinksController::class, 'iOS']);
       $router->get('/.well-known/assetlinks.json', [DeepLinksController::class, 'iOS']);
    }
}
