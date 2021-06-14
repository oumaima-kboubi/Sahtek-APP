<?php

namespace App\Controller;

use App\Entity\CareTakerOrder;
use App\Entity\DrugOrder;
use App\Entity\Money;
use App\Entity\Person;
use App\Entity\City;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatisticController extends AbstractController
{
    /**
     * @Route("/statistic/dash", name="statistic.dash")
     */
    public function dashboard(): Response
    {
        $repository = $this->getDoctrine()->getRepository(City::class);
        $repository1 = $this->getDoctrine()->getRepository(User::class);
        $repository2 = $this->getDoctrine()->getRepository(Money::class);
        $repository3 = $this->getDoctrine()->getRepository(DrugOrder::class);
        $repository4 = $this->getDoctrine()->getRepository(CareTakerOrder::class);

        $month_start = strtotime('first day of this month', time());
        $year_start = strtotime('first day of January', time());
        $d1=date('y/m/d', $month_start);
        $d2=date('y/m/d', $year_start);

        $monthlyEarnings = $repository3->monthlyEarning($d1);
        $yearlyEarnings =$repository3->yearlyEarning($d2);

        $userNumbers = $repository1->count(['role' => 'ROLE_CLIENT']);
        $pendingOrders =$repository3->count(['pending' => 1]) + $repository4->count(['pending' => 1]);
        $totalMoney= $repository2->returnMoney();
        $pharmacyNumbers= $repository1->count(['role' => 'ROLE_PHARMACY']);
        $careTakerNumbers= $repository1->count(['role' => 'ROLE_CARETAKER']);

        $yearly = $repository3->yearly($d2);

        $cityPercentage=$repository1->cityLight();
        $cityNumbers = count($cityPercentage);

        $numberFemale = $repository1->count(['gender' => 'F']);
        $numberMale = $repository1->count(['gender' => 'M']);
        $numbers = $userNumbers + $careTakerNumbers;

        return $this->render('statistic/main.html.twig', [
            'cityNumbers' => $cityNumbers,
            'monthlyEarnings' => $monthlyEarnings,
            'yearlyEarnings' => $yearlyEarnings,
            'userNumbers' => $userNumbers,
            'pendingOrders' => $pendingOrders,
            'totalMoney' => $totalMoney,
            'pharmacyNumbers' => $pharmacyNumbers,
            'careTakerNumbers' => $careTakerNumbers,
            'cityPercentage' => $cityPercentage,
            'numberFemale' => $numberFemale,
            'numberMale' => $numberMale,
            'numbers' => $numbers,
            'yearly' => $yearly
        ]);
    }

    /**
     * @Route("/statistic/chart", name="statistic.chart")
     */
    public function charts() : Response
    {
        $repository3 = $this->getDoctrine()->getRepository(DrugOrder::class);
        $repository1 = $this->getDoctrine()->getRepository(User::class);
        $month_start = strtotime('first day of this month', time());
        $year_start = strtotime('first day of January', time());
        $d1=date('y/m/d', $month_start);
        $d2=date('y/m/d', $year_start);
        $userNumbers = $repository1->count(['role' => 'ROLE_CLIENT']);
        $careTakerNumbers= $repository1->count(['role' => 'ROLE_CARETAKER']);
        $yearly = $repository3->yearly($d2);
        $numberFemale = $repository1->count(['gender' => 'F']);
        $numberMale = $repository1->count(['gender' => 'M']);
        $numbers = $userNumbers + $careTakerNumbers;
        return $this->render('statistic/chart.html.twig', [
            'yearly' => $yearly,
            'numberFemale' => $numberFemale,
            'numberMale' => $numberMale,
            'numbers' => $numbers
        ]);
    }
}
