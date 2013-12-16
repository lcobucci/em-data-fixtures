<?php

namespace Lcobucci\Fixture\Persistence;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\EventSubscriber;
use Doctrine\Fixture\Event\FixtureEvent;
use Doctrine\Fixture\Event\ImportFixtureEventListener;
use Doctrine\Fixture\Event\PurgeFixtureEventListener;

/**
 * Object Manager Event Subscriber.
 *
 * @author Luís Otávio Cobucci Oblonczyk
 */
class ObjectManagerEventSubscriber implements
    EventSubscriber,
    ImportFixtureEventListener,
    PurgeFixtureEventListener
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * Constructor.
     *
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
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

        if ( ! ($fixture instanceof ObjectManagerFixture)) {
            return;
        }

        $fixture->setObjectManager($this->manager);
    }

    /**
     * {@inheritdoc}
     */
    public function import(FixtureEvent $event)
    {
        $fixture = $event->getFixture();

        if ( ! ($fixture instanceof ObjectManagerFixture)) {
            return;
        }

        $fixture->setObjectManager($this->manager);
    }
}
