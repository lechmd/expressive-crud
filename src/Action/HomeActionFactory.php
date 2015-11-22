<?php

namespace App\Action;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomeActionFactory
{
    /**
     * @param ContainerInterface $container
     * @return HomeAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $renderer = $container->get(TemplateRendererInterface::class);

        return new HomeAction($renderer);
    }
}

