<?php

namespace App\Action\User;

use App\Service\UserServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class EditActionFactory
{
    /**
     * @param ContainerInterface $container
     * @return EditAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $renderer = $container->get(TemplateRendererInterface::class);
        $router = $container->get(RouterInterface::class);
        $userService = $container->get(UserServiceInterface::class);

        return new EditAction($renderer, $router, $userService);
    }
}

