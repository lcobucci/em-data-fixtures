<?php

namespace Lcobucci\Fixture\Persistence;

use Doctrine\Fixture\Fixture;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Contract for Entity Manager fixtures.
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
interface EntityManagerFixture extends Fixture
{
    /**
     * Defines the Entity Manager.
     *
     * @param EntityManagerInterface $manager
     */
    public function setEntityManager(EntityManagerInterface $manager);
}
