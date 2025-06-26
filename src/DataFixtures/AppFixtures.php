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
        $user = new User();
        $user->setName('Daniel')
             ->setEmail('daniel@example.com');

        $project = new Project();
        $project->setName('Proyecto Alpha');

        $userProject = new UserProject();
        $userProject->setUser($user);
        $userProject->setProject($project);
        $userProject->setRate(120000);

        $task1 = new Task();
        $task1->setTitle('Diseñar interfaz')
              ->setUserProject($userProject);

        $task2 = new Task();
        $task2->setTitle('Implementar backend')
              ->setUserProject($userProject);

        $manager->persist($user);
        $manager->persist($project);
        $manager->persist($userProject);
        $manager->persist($task1);
        $manager->persist($task2);

        $manager->flush();
    }
}
