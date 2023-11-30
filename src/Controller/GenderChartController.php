<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class GenderChartController extends AbstractController
{
    #[Route('/stat', name: 'app_stat')]
    public function index(UserRepository $Repository): Response
    {
        $hommes = $Repository->findByGenre('Homme');
        $femmes = $Repository->findByGenre('Femme');

        $data = [
            'hommes' => count($hommes),
            'femmes' => count($femmes),
        ];

        // Initialize the GoogleCharts object
        //  $googleCharts = new GoogleCharts();

        // Create a new ColumnChart object
        $chart = $googleCharts->newColumnChart();

        // Add series to the chart
        $chart->addSeries('Hommes', $data['hommes']);
        $chart->addSeries('Femmes', $data['femmes']);

        // Set chart title and axis titles
        $chart->setTitle('Statistiques hommes/femmes');
        $chart->setYAxisTitle('Nombre');

        // Render the chart and return the response
        return $this->render('gender_chart/index.html.twig', [
            'chart' => $chart->render(),
        ]);
    }
}
