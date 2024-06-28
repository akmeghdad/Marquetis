<?php

namespace App\Controller;

use App\Entity\Proprietaire;
use App\Entity\Vehicule;
use App\Form\VehiculeType;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

#[Route('/vehicule')]
class VehiculeController extends AbstractController
{
    #[Route('/', name: 'vehicule_index', methods: ['GET'])]
    public function index(Request $request, VehiculeRepository $vehiculeRepository, EntityManagerInterface $entityManager): Response
    {
        $sort = $request->query->get('sort', 'id');
        $direction = $request->query->get('direction', 'asc');
        $proprietaireId = $request->query->get('proprietaire');

        $criteria = [];
        if ($proprietaireId) {
            $criteria['proprietaire'] = $entityManager->getRepository(Proprietaire::class)->find($proprietaireId);
        }

        $vehicules = $vehiculeRepository->findBy($criteria, [$sort => $direction]);
        $proprietaires = $entityManager->getRepository(Proprietaire::class)->findAll();


        return $this->render('vehicule/index.html.twig', [
            'vehicules' => $vehicules,
            'sort' => $sort,
            'direction' => $direction,
            'proprietaires' => $proprietaires,
            'current_proprietaire' => $proprietaireId,
        ]);
    }

    #[Route('/new', name: 'vehicule_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vehicule);
            $entityManager->flush();

            return $this->redirectToRoute('vehicule_index');
        }

        return $this->render('vehicule/new.html.twig', [
            'vehicule' => $vehicule,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'vehicule_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vehicule $vehicule, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('vehicule_index');
        }

        return $this->render('vehicule/edit.html.twig', [
            'vehicule' => $vehicule,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'vehicule_delete', methods: ['POST'])]
    public function delete(Request $request, Vehicule $vehicule, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vehicule->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vehicule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vehicule_index');
    }

    #[Route('/stats', name: 'vehicule_stats', methods: ['GET'])]
    public function stats(EntityManagerInterface $entityManager, ChartBuilderInterface $chartBuilder): Response
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $proprietaires = $entityManager->getRepository(Proprietaire::class)->findAll();
        $stats = [];

        foreach ($proprietaires as $proprietaire) {
            $stats[] = [
                'nom' => $proprietaire->getNom() . ' ' . $proprietaire->getPrenom(),
                'count' => count($proprietaire->getVehicules())
            ];
        }

        $chart->setData($stats);

        return $this->render('vehicule/stats.html.twig', [
            'chart' => $chart,
        ]);
    }
}
