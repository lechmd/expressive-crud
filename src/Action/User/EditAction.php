<?php

namespace App\Action\User;

use App\Exception\UserNotFoundException;
use App\Form\UserForm;
use App\Service\UserServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class EditAction
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var UserServiceInterface
     */
    private $userService;

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
        $viewData = [];
        $viewData['title'] = 'Edit user';
        try {
            $form = new UserForm();
            if ($request->getMethod() === 'POST') {
                $formData = $request->getParsedBody();
                $userId = $formData['id'];
                $user = $this->userService->findById($userId);
                $form->bind($user);
                $form->setData($formData);
                if (!$form->isValid()) {
                    $viewData['userForm'] = $form;

                    return new HtmlResponse($this->renderer->render('app::user-edit', $viewData));
                }
                $this->userService->save($user);

                return new RedirectResponse($this->router->generateUri('user-list'));
            }

            $userId = $request->getAttribute('id');
            $user = $this->userService->findById($userId);

            $form->setAttribute('action', '/user-edit');
            $form->setData($user->toArray());
            $viewData['userForm'] = $form;

        } catch (UserNotFoundException $e) {
            return $next($request, $response->withStatus(404), 'User not found');
        } catch (\Exception $e) {
            return $next($request, $response->withStatus(500), 'Unknown error');
        }

        return new HtmlResponse($this->renderer->render('app::user-edit', $viewData));
    }
}

