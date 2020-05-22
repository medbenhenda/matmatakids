<?php

namespace App\Controller;

use App\Entity\Don;
use App\Entity\Donor;
use App\Entity\Folder;
use App\Entity\Project;
use App\Entity\Sponsor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\DonRepository;
use App\Repository\ProjectRepository;
use App\Service\Helper;
use Doctrine\DBAL\DBALException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Gedmo\Loggable\Entity\LogEntry;

class AdminController extends AbstractController
{

    /**
     * @Route("/statsdash", name="statsdash", methods={"GET"}, options = { "expose" = true })
     * @param Request $request
     * @param DonRepository $donRepository
     * @param ProjectRepository $pRepository
     * @return Response
     * @throws DBALException
     */
    public function donStats(Request $request, DonRepository $donRepository, ProjectRepository $pRepository, Helper $helper): Response
    {
        $data = $donRepository->getDonsGroupedByMonth();
        $dataProjects = $pRepository->getDonsGroupedByProject();

        for ($i=0; $i< count($data['values']); $i++) {
            $data['background_color'][] = $helper->rand_color();
        }
        for ($i=0; $i< count($dataProjects['values']); $i++) {
            $dataProjects['background_color'][] = $helper->rand_color();
        }

        $result['month'] = $data;
        $result['project'] = $dataProjects;
        return new JsonResponse($result);
    }

    /**
     * @Route("/", name="admin")
     * @param DonRepository $donRepository
     * @param ProjectRepository $pRepository
     * @return Response
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Don::class);
        $repositoryDonor = $this->getDoctrine()->getRepository(Donor::class);
        $repositoryFolder = $this->getDoctrine()->getRepository(Folder::class);
        $repositorySponsors = $this->getDoctrine()->getRepository(Sponsor::class);
        $repositoryProjects = $this->getDoctrine()->getRepository(Project::class);
        $repositoryGedmo = $this->getDoctrine()->getRepository(LogEntry::class);
        $user = $this->getUser();
        return $this->render('admin/index.html.twig', [
            'count_dons' => count($repository->findAll()),
            'count_donors' => count($repositoryDonor->findAll()),
            'count_folders' => count($repositoryFolder->findAll()),
            'count_sponsors' => count($repositorySponsors->findAll()),
            'count_projects' => count($repositoryProjects->findAll()),
            'logs_user' => array_slice($repositoryGedmo->getLogEntries($user), 0, 10),
        ]);
    }
}
