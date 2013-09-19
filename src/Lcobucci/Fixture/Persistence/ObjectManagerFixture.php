<?php

namespace Lcobucci\Fixture\Persistence;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Fixture\Fixture;

/**
 * Contract for Object Manager fixtures.
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
interface ObjectManagerFixture extends Fixture
{
    /**
     * Defines the Object Manager.
     *
     * @param ObjectManager $manager
     */
    function setObjectManager(ObjectManager $manager);
}
