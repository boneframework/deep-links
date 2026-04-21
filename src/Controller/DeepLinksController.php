<?php

declare(strict_types=1);

namespace Bone\DeepLinks\Controller;

use Bone\Http\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DeepLinksController
{
    public function  __construct(
        private readonly array $settings,
    ) {}

    public function iOS(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse($this->settings['iOS']);
    }

    public function android(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse($this->settings['iOS']);
    }
}
