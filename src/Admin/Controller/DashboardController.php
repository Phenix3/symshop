<?php


namespace App\Admin\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

/**
 * Class DashboardController
 * @package App\Admin\Controller
 */
class DashboardController extends BaseController
{
    /**
     * @Route("", name="dashboard_index")
     * @return Response
     */
    public function index(ChartBuilderInterface $chartBuilder)
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgba(0, 0, 0, 0.2)',
                    'data' => [0, 10, 5, 2, 20, 12, 45],
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'yAxes' => [
                    ['tricks' => ['min' => 0, 'max' => 100]],
                ],
            ],
        ]);

        return $this->render('admin/dashboard/index.html.twig', ['chart' => $chart]);
    }
}