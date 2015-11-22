<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomeAction
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * @param TemplateRendererInterface $renderer
     */
    public function __construct(TemplateRendererInterface $renderer = null)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param null|callable $next
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $viewData = [];
        $viewData['title'] = 'Home';
        return new HtmlResponse($this->renderer->render('app::home', $viewData));
    }
}

