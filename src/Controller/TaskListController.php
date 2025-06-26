<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TaskListController extends AbstractController {
    #[Route('/user/{id}/tasks', name: 'user_task_list')]
    public function index(int $id, TaskRepository $taskRepo, UserRepository $userRepo, Request $request): Response {
        $user = $userRepo->find($id);
        $tasks = $taskRepo->findTasksByUserId($id);

        if (!$user) {
            throw $this->createNotFoundException('Usuario no encontrado');
        }

        if ($request->isXmlHttpRequest()) {
            return $this->json([
                'user' => [
                    'id' => $user->getId(),
                    'name' => $user->getName()
                ],
                'tasks' => $tasks
            ]);
        }

        return $this->render('task_list/index.html.twig', [
            'users' => $userRepo->findAll(),
            'tasks' => $tasks,
            'user' => $user,
        ]);
    }
}
