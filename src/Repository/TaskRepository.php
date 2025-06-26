<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function findTasksByUserId(int $userId): array {
        return $this->createQueryBuilder('t')
            ->join('t.userProject', 'up')
            ->join('up.user', 'u')
            ->join('up.project', 'p')
            ->andWhere('u.id = :userId')
            ->setParameter('userId', $userId)
            ->select('t.title AS task', 'p.name AS project', 'up.rate AS rate')
            ->getQuery()
            ->getScalarResult();
    }
}
