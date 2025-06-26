<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskListController extends AbstractController
{
    #[Route('/user/{id}/tasks', name: 'user_task_list')]
    public function index(int $id, TaskRepository $taskRepository, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);
        $tasks = $taskRepository->findTasksByUserId($id);

        return $this->render('task_list/index.html.twig', [
            'tasks' => $tasks,
            'user' => $user,
        ]);
    }
}
