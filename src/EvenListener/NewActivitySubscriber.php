<?php
namespace App\EventListener;

use App\Entity\Folder;
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

   public function __construct(EntityManager $em, Security $security)
   {
     $this->em = $em;
     $this->security = $security;
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
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        $this->setOwner('remove', $args);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->setOwner('update', $args);
    }

    private function setOwner(string $action, LifecycleEventArgs $args)
    {
      if ($action != 'remove') {
        $entity = $args->getObject();
        $user = $this->security->getUser();
        $entity->setCreatedBy($user);
        $this->em->persist($entity);
        $this->em->flush();
      }
    }
}
