<?php

namespace App\Action\User;

use App\Service\UserServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class ListAction
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @param TemplateRendererInterface $renderer
     * @param UserServiceInterface $userService
     */
    public function __construct(
        TemplateRendererInterface $renderer,
        UserServiceInterface $userService
    ) {
        $this->renderer = $renderer;
        $this->userService = $userService;
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
        $viewData = [
            'title' => 'Users list',
        ];
        try {
            $viewData['usersList'] = $this->userService->findAllForView();
        } catch (\Exception $e) {
            return $next($request, $response->withStatus(500), 'Couldn\'t fetch users list.');
        }

        return new HtmlResponse($this->renderer->render('app::user-list', $viewData));
    }
}

