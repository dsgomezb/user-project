<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Task;
use App\Entity\User;
use App\Entity\UserProject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // --- Usuario 1: Daniel ---
        $user1 = new User();
        $user1->setName('Daniel')
              ->setEmail('daniel@example.com');

        $project1 = new Project();
        $project1->setName('Proyecto Alpha');

        $userProject1 = new UserProject();
        $userProject1->setUser($user1);
        $userProject1->setProject($project1);
        $userProject1->setRate(120000);

        $task1 = new Task();
        $task1->setTitle('Diseñar interfaz')
              ->setUserProject($userProject1);

        $task2 = new Task();
        $task2->setTitle('Implementar backend')
              ->setUserProject($userProject1);

        // --- Usuario 2: Laura ---
        $user2 = new User();
        $user2->setName('Laura')
              ->setEmail('laura@example.com');

        $project2 = new Project();
        $project2->setName('Proyecto Beta');

        $userProject2 = new UserProject();
        $userProject2->setUser($user2);
        $userProject2->setProject($project2);
        $userProject2->setRate(95000);

        $task3 = new Task();
        $task3->setTitle('Crear landing page')
              ->setUserProject($userProject2);

        $task4 = new Task();
        $task4->setTitle('Escribir documentación')
              ->setUserProject($userProject2);

        // --- Usuario 3: Miguel ---
        $user3 = new User();
        $user3->setName('Miguel')
              ->setEmail('miguel@example.com');

        $project3 = new Project();
        $project3->setName('Proyecto Gamma');

        $userProject3 = new UserProject();
        $userProject3->setUser($user3);
        $userProject3->setProject($project3);
        $userProject3->setRate(110000);

        $task5 = new Task();
        $task5->setTitle('Integrar API')
              ->setUserProject($userProject3);

        $task6 = new Task();
        $task6->setTitle('Test de carga')
              ->setUserProject($userProject3);

        // --- Usuario 4: Sofía ---
        $user4 = new User();
        $user4->setName('Sofía')
              ->setEmail('sofia@example.com');

        $project4 = new Project();
        $project4->setName('Proyecto Delta');

        $userProject4 = new UserProject();
        $userProject4->setUser($user4);
        $userProject4->setProject($project4);
        $userProject4->setRate(105000);

        $task7 = new Task();
        $task7->setTitle('Revisión de código')
              ->setUserProject($userProject4);

        $task8 = new Task();
        $task8->setTitle('Optimización de consultas')
              ->setUserProject($userProject4);

        foreach ([
            $user1, $project1, $userProject1, $task1, $task2,
            $user2, $project2, $userProject2, $task3, $task4,
            $user3, $project3, $userProject3, $task5, $task6,
            $user4, $project4, $userProject4, $task7, $task8
        ] as $entity) {
            $manager->persist($entity);
        }

        $manager->flush();
    }
}