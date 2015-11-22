<?php

namespace App\Action\User;

use App\Form\UserForm;
use App\Model\User;
use App\Service\UserServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class AddAction
{
    /**
     * @var TemplateRendererInterface
     */
    protected $renderer;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var UserServiceInterface
     */
    protected $userService;

    /**
     * @param TemplateRendererInterface $renderer
     * @param RouterInterface $router
     * @param UserServiceInterface $userService
     */
    public function __construct(
        TemplateRendererInterface $renderer,
        RouterInterface $router,
        UserServiceInterface $userService
    ) {
        $this->renderer = $renderer;
        $this->router = $router;
        $this->userService = $userService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ) {
        $viewData = [
            'title' => 'Add user',
        ];
        try {
            $form = new UserForm();
            if ($request->getMethod() === 'POST') {
                $form->setData($request->getParsedBody());
                if (!$form->isValid()) {
                    $form->setAttribute('action', '/user-add');
                    $form->get('submit')->setAttribute('value', 'Create');
                    $viewData['userForm'] = $form;

                    return new HtmlResponse($this->renderer->render('app::user-edit', $viewData));
                }
                $userData = $form->getData();
                $user = new User($userData['username'], $userData['email']);
                $this->userService->save($user);

                return new RedirectResponse($this->router->generateUri('user-list'));
            }

            $form->setAttribute('action', '/user-add');
            $viewData['userForm'] = $form;

        } catch (\Exception $e) {
            return $next($request, $response->withStatus(500), 'Unknown error');
        }

        return new HtmlResponse($this->renderer->render('app::user-edit', $viewData));
    }
}

