<?php

namespace App\Action\User;

use App\Exception\UserNotFoundException;
use App\Service\UserServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class DeleteAction
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
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
        $userData = $request->getParsedBody();
        $userId = $userData['id'];
        try {
            $user = $this->userService->findById($userId);
            $this->userService->delete($user);

        } catch (UserNotFoundException $e) {
            return new JsonResponse([
                'success' => false,
                'message' => 'User not found.',
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Failed to delete user.',
            ]);
        }

        return new JsonResponse(['success' => true]);
    }
}

