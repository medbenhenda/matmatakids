<?php

namespace App\EventListener;

use App\Entity\Don;
use App\Entity\Donor;
use App\Entity\Folder;
use App\Repository\DonorRepository;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Security;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManager;

class NewActivitySubscriber implements EventSubscriber
{
    /**
     * @Var EntityManager
     */
    protected $em;

    /**
     * @Var Security
     */
    protected $security;

    /**
     * @var DonorRepository
     */
    protected $donorRepository;

    public function __construct(EntityManager $em, Security $security, DonorRepository $donorRepository)
    {
        $this->em = $em;
        $this->security = $security;
        $this->donorRepository = $donorRepository;
    }
    // this method can only return the event names; you cannot define a
    // custom method name to execute when each event triggers
    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            Events::postRemove,
            Events::postUpdate,
        ];
    }

    // callback methods must be called exactly like the events they listen to;
    // they receive an argument of type LifecycleEventArgs, which gives you access
    // to both the entity object of the event and the entity manager itself
    public function postPersist(LifecycleEventArgs $args)
    {
        $this->setOwner('persist', $args);
        $this->checkAdhesion($args);
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        $this->setOwner('remove', $args);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->setOwner('update', $args);
        $this->checkAdhesion($args);
    }

    private function setOwner(string $action, LifecycleEventArgs $args)
    {
        if ($action == 'persist' && property_exists($args->getObject(), 'createdBy')) {
            $entity = $args->getObject();
            $user = $this->security->getUser();
            $entity->setCreatedBy($user);
            $this->em->persist($entity);
            $this->em->flush();
        }
        if ($action == 'persist' && property_exists($args->getObject(), 'transactionDate')) {
            $entity = $args->getObject();
            if (!$entity->getTransactionDate()) {
                $entity->setTransactionDate(new \DateTime('now'));
                $this->em->persist($entity);
                $this->em->flush();
            }
        }
    }

    /**
     * @param LifecycleEventArgs $args
     * @throws \Doctrine\ORM\ORMException
     */
    private function checkAdhesion(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Don) {

            /** @var Don $don */
            $don = $args->getObject();
            /** @var Donor $donor */
            $donor = $don->getDonor();
            $sumAmount = $this->donorRepository->findSumAmountOfDonor($donor);

            if ($sumAmount['total_sum'] >= 30) {
                $donor = $don->getDonor();
                $donor->setIsAdherent(true);
                $donor->setValidityAdhesion(date('Y'));
                $this->em->persist($donor);
                $this->em->flush();
            }
        }
    }
}
