<?php

namespace Lcobucci\Fixture\Persistence;

use Doctrine\Common\EventSubscriber;
use Doctrine\Fixture\Event\FixtureEvent;
use Doctrine\Fixture\Event\ImportFixtureEventListener;
use Doctrine\Fixture\Event\PurgeFixtureEventListener;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Entity Manager Event Subscriber.
 *
 * @author Luís Otávio Cobucci Oblonczyk
 */
class EntityManagerEventSubscriber implements
    EventSubscriber,
    ImportFixtureEventListener,
    PurgeFixtureEventListener
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * Constructor.
     *
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return array(
            ImportFixtureEventListener::IMPORT,
            PurgeFixtureEventListener::PURGE,
        );
    }

    /**
     * {@inheritdoc}
     */
    public function purge(FixtureEvent $event)
    {
        $fixture = $event->getFixture();

        if ( ! ($fixture instanceof EntityManagerFixture)) {
            return;
        }

        $fixture->setEntityManager($this->manager);
    }

    /**
     * {@inheritdoc}
     */
    public function import(FixtureEvent $event)
    {
        $fixture = $event->getFixture();

        if ( ! ($fixture instanceof EntityManagerFixture)) {
            return;
        }

        $fixture->setEntityManager($this->manager);
    }
}
