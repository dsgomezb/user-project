<?php

namespace App\Controller\Api;

use App\Repository\UserRepository;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users', name: 'api_user_')]
class UserTaskController extends AbstractController
{
    #[Route('/{id}/tasks', name: 'tasks', methods: ['GET'])]
    public function tasks(int $id, UserRepository $userRepo, TaskRepository $taskRepo): JsonResponse
    {
        $user = $userRepo->find($id);

        if (!$user) {
            return $this->json([
                'error' => 'Usuario no encontrado'
            ], 404);
        }

        $tasks = [];

        foreach ($user->getUserProjects() as $userProject) {
            foreach ($userProject->getTasks() as $task) {
                $tasks[] = [
                    'task' => $task->getTitle(),
                    'project' => $userProject->getProject()?->getName(),
                    'rate' => $userProject->getRate(),
                ];
            }
        }

        return $this->json([
            'user' => [
                'id' => $user->getId(),
                'name' => $user->getName()
            ],
            'tasks' => $tasks
        ]);
    }
}