<?php
namespace App\Service;

use Symfony\Component\Security\Core\Security;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManager;
use App\Entity;

Class SponsorAffectation {

    /**
    * @Var EntityManager
    */
    protected $em;

    /**
    * @Var Security
    */
    protected $security;

    /**
    */
    public function __construct(EntityManager $em, Security $security) {
        $this->em = $em;
        $this->security = $security;
    }

    /**
     *  @return []
     */
    public function getAffectedCases():Array
    {

    }

    /**
    * Affect a case to a sponsor
    * @param Entity\Folder $case the case tha will be affected to sponsor
    * @param Entity\Sponsor $sponsor the sponsor affected to case
    * @return void
    */
    public function affect(Entity\Folder $case, Entity\Sponsor $sponsor) {

    }

    /* disable/enable case*/
    public function manageCase(Entity\Folder $case, $action)  {

    }

    public function disableAffectation() {

    }

    /**
    * Change the affectation of a case.
    * the new sponsor will be affcted to the case and a version of the case will be created to maintain the versionning
    * @param Entity\Folder $case the case tha will be affected to sponsor
    * @param Entity\Sponsor $sponsor the new sponsor affected to case
    * @return void
    */
    public function changeAffectation(Entity\Folder $case, Entity\Sponsor $sponsor) {

    }
}
