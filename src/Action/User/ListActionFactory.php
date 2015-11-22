<?php

namespace App\Action\User;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use App\Service\UserServiceInterface;
use App\Action\UserListAction;

class ListActionFactory
{
    /**
     * @param ContainerInterface $container
     * @return ListAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $renderer = $container->get(TemplateRendererInterface::class);
        $userService = $container->get(UserServiceInterface::class);

        return new ListAction($renderer, $userService);
    }
}

