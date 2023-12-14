<?php

use Doctrine\ORM\EntityManagerInterface;

class CoreService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}