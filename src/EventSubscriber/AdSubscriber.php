<?php

namespace App\EventSubscriber;

use App\Entity\Ad;
use App\Entity\GroupAd;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class AdSubscriber implements EventSubscriberInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            'easy_admin.pre_persist' => 'onPrePersist',
        ];
    }

    public function onPrePersist(GenericEvent $event)
    {
        $entity = $event->getSubject();

        if ($entity instanceof Ad) {
            // Create a new GroupAd and set its firstAdId
            $groupAd = new GroupAd();
            $groupAd->setFirstAdId($entity->getId());

            // Add the Ad to the GroupAd
            $groupAd->addAd($entity);

            // Persist both Ad and GroupAd
            $this->entityManager->persist($groupAd);
            $this->entityManager->flush();
        }
    }
}