<?php

namespace App\Controller;

use App\Entity\CareTakerOrder;
use App\Entity\City;
use App\Entity\DrugOrder;
use App\Entity\Money;
use App\Entity\User;

use App\Form\CareTakerOrderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class RoutingController extends AbstractController
{
    /**
     * @Route("/routing", name="routing")
     */
    public function index()
    {
        return $this->render('routing/index.html.twig', [
            'controller_name' => 'RoutingController',
        ]);
    }

    /**
     * @Route("/privacyIn" , name="routing.privacyIn")
     *
     */
    public function privacyIn()
    {
        return $this->render('privacyPolicy.html.twig');
    }

    /**
     * @Route("/privacyOut" , name="routing.privacyOut")
     *
     */
    public function privacyOut()
    {
        return $this->render('privacyPolicyOut.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/useIn",name="routing.useIn")
     */
    public function useIn()
    {
        return $this->render('TermOfUseIn.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/useOut",name="routing.useOut")
     */
    public function useOut()
    {
        return $this->render('TermOfUseOut.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/homeIn",name="routing.homeIn")
     */
    public function homeIn()
    {
        return $this->render('home.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/services",name="routing.services")
     */
    public function services()
    {
        return $this->render('sevices.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/homeOut",name="routing.homeOut")
     */
    public function acceuil()
    {
        return $this->render('aboutUs.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/homeUsIn", name="routing.homeUsIn")
     */
    public function aboutUsIn()
    {
        return $this->render('aboutUsIn.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/lobby", name="routing.lobby")
     */
    public function lobby()
    {
        return $this->render('lobby.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/show", name="routing.show")
     */
    public function showClient()
    {
        return $this->render('profileShow.html.twig');
    }
//    /**
//     * @return \Symfony\Component\HttpFoundation\Response
//     * @Route("/change", name="routing.changePassword")
//     */
//    public function changePassword(){
//        return $this->render('changePassword.html.twig');
//    }
    /**
     * @param User|null $user1
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/delete", name="routing.delete")
     */
    public function removeMe(User $user1 = null)
    {
        $user = $this->getUser();
        if ($user != NULL) {
            $repository = $this->getDoctrine()->getRepository(User::class);
            $me = $repository->findOneBy(['email' => $user->getUsername()]);
            $manager = $this->getDoctrine()->getManager();
            $user->eraseCredentials();
            $manager->remove($me);
            $manager->flush();
            return $this->redirectToRoute('app_login');
        } else {
            return $this->redirectToRoute('app_logout');
        }

    }

    /**
     * @Route("/stockConsult",name="routing.stockConsult")
     */
    public function stockConsult(User $user1 = null): Response
    {
        $user = $this->getUser();
        if ($user != NULL) {
            $repository = $this->getDoctrine()->getRepository(User::class);
            $pharmacy = $repository->findOneBy(['email' => $user->getUsername()]);
            if ($pharmacy) {
                $manager = $this->getDoctrine()->getManager();
                $drugStock = $pharmacy->getdrugStock();
                $drugStockPharmacy = $drugStock->getDrugStockPharmacy();
                $drugs = $drugStockPharmacy->getDrug();
                if ($drugs) {
                    return $this->render('DrugInStock.html.twig', ['drugs' => $drugs]);
                }
                return $this->render('routing.homeIn');
            }
        }
    }

    /**
     * @Route("/consult/taker/{id}", name="histo.consult.taker")
     */
    public function histoCareTaker(User $user): Response
    {
        $user1= $this->getUser();
        if ($user1 != NULL) {

            $id=$user1->getId();
            $historiques = $this->getDoctrine()->getRepository(CareTakerOrder::class);
            $exist = $historiques->findBy(['client' => $id, 'deleted' => 0]);
            $today = date("Y-m-d");
            $lastweek = date("Y-m-d", strtotime('-7 day'));
            $lastmonth = date("Y-m-d", strtotime('-30 day'));
            $lastweeks = $historiques->findForWeek($id, $today, $lastweek);
            $lastmonths = $historiques->findForMonth($id, $lastweek, $lastmonth);
            $rest = $historiques->findTheRest($id, $lastmonth);
            if ($exist) {
                return $this->render('histoCareTaker.html.twig', [
                    'listes' => $exist,
                    'client' => $id,
                    'weeks' => $lastweeks,
                    'months' => $lastmonths,
                    'rests' => $rest
                ]);
            }
            return new Response
            (
                "<h1>This page is currently empty</h1>"
            );
        }
    }
        /**
     *@Route("/consult/order/{id}", name="histo.consult.drugorder")
     */
    public function histoDrugOrder($id) : Response
    {
        $historiques = $this->getDoctrine()->getRepository(DrugOrder::class);
        $exist = $historiques->findBy(['client' => $id, 'deleted' => 0]);
        $today = date("Y-m-d");
        $lastweek = date("Y-m-d",strtotime('-7 day'));
        $lastmonth= date("Y-m-d",strtotime('-30 day'));
        $lastweeks = $historiques->findForWeek($id, $today, $lastweek);
        $lastmonths = $historiques->findForMonth($id, $lastweek, $lastmonth);
        $rest = $historiques->findTheRest($id, $lastmonth);
        if($exist) {
            return $this->render('histoDrugOrderr.html.twig', [
                'listes' => $exist,
                'client' => $id,
                'weeks' => $lastweeks,
                'months' => $lastmonths,
                'rests' => $rest
            ]);
        }
        return new Response(
            "<h1>This page is currently empty</h1>"
        );
    }
    /**
     * @Route("/delete/histo/drug/{id}/{idd}",name="histoDrug.delete")
     */
    public function deleteHistoDrug ($id, $idd) : Response
    {
        $repository= $this->getDoctrine()->getRepository(DrugOrder::class);
        $exist = $repository->find($id);
        if($exist) {
            $manager=$this->getDoctrine()->getManager();
            $exist->setDeleted(1);
            $manager->persist($exist);
            $manager->flush();
            $this->addFlash('success', 'Ligne supprimé avec succes');
        } else {
            $this->addFlash('error', 'Id n\'existe pas');
        }
        return $this->redirectToRoute('histo.consult.drugorder', [ 'id' => $idd ]);
    }
    /**
     * @Route("/delete/histo/taker/{id}/{idd}",name="histoTaker.delete")
     */
    public function deleteHistoTaker($id, $idd): \Symfony\Component\HttpFoundation\Response
    {
        $repository = $this->getDoctrine()->getRepository(CareTakerOrder::class);
        $exist = $repository->find($id);
        if ($exist) {
            $manager = $this->getDoctrine()->getManager();
            $exist->setDeleted(1);
            $manager->persist($exist);
            $manager->flush();
            $this->addFlash('success', 'Ligne supprimé avec succes');
        } else {
            $this->addFlash('error', 'Id n\'existe pas');
        }
        return $this->redirectToRoute('histo.consult.taker', ['id' => $idd]);
    }

    /**
     * @Route("/affich/city/{place}", name="city.afficher")
     */
    public function affichCity($place) : Response
    {
        $repository = $this->getDoctrine()->getRepository(City::class);
        $cities = $repository->findAll();
        return $this->render('city.html.twig', [
            'cities' => $cities,
            'place' => $place
        ]);
    }
    /**
     * @Route("/pharmacy/list/{city}", name="pharmacy.list")
     */
    public function affichPharmacy($city) : Response
    {
        $repository = $this->getDoctrine()->getRepository(Person::class);
        if ($city == 'null'){
            $pharmacy = $repository->findBy(['role' => 'pharmacy']);
        } else {
            $pharmacy = $repository->findBy(['city' => $city, 'role' => 'pharmacy']);
        }
        return $this->render('first/pharmacyList.html.twig', [
            'pharmacy' => $pharmacy
        ]);
    }

    /**
     * @Route("/care/affich/{city}", name="caretaker.affich")
     */
    public function afficherCareTaker($city) : Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $caretaker = $repository->findBy(['city' => $city, 'role' => 'ROLE_CARETAKER']);
        if($caretaker){
            return $this->render('careTaker.html.twig', [
                'caretakers' => $caretaker
            ]);
        }
        $this->addFlash('error', 'careTakers in this city are nonexistent');
        return $this->render('careTaker.html.twig');
    }
    /**
     * @Route("/hire/care/{id}", name="caretaker.hire")
     */
    public function orderCareTaker(Request $request, EntityManagerInterface $manager, $id ) : Response
    {
         $userId = $this->getUser()->getId();
         $user = $this->getUser();
         $takerId = $id;
         $day=$request->query->get('day');
       //  $takerUser= $this->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
      //  $pharma= $repository->findOneBy(['id' => 1]);
        //$user =$repository->findOneBy(['id' => 2]);
        $takerUser=$repository->findOneBy(['id' => $id]);
        if(!$user || !$takerId){
            return new Response('<h1> There is no user or caretaker</h1>');
//                $this->render('hireTaker.html.twig');
        }else {
            $order = new CareTakerOrder();
            $form = $this->createForm(CareTakerOrderType::class, $order);
         //   $form->remove('pharmacy');
            $form->remove('approved');
            $form->remove('Pending');
            $form->remove('client');
            $form->remove('caretaker');
            $form->remove('deleted');
            $form->remove('day');
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
            //    $order->setPharmacy($pharma);
                $order->setApproved(0);
                $order->setCaretaker($takerUser);
                $order->setClient($user);
                $order->setPending(1);
                $order->setDeleted(0);
                $order->setDay(new \DateTime());
                $manager->persist($order);
                $manager->flush();
                return $this->redirectToRoute("caretaker.affich",['city' => $takerUser->getCity()]);
            }
            return $this->render('hireTaker.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    /**
     * @Route("/pending/taker/{id}", name="pending.taker")
     */
    public function affichPendingTaker($id) : Response
    {
        $repository = $this->getDoctrine()->getRepository(CareTakerOrder::class);
        $orders = $repository->findOrder($id);
       // dd($orders);
        return $this->render('pendingTaker.html.twig', [
            'orders' => $orders
        ]);
    }
    /**
     * @Route("/pending/order/{id}", name="pending.order")
     */
    public function affichPendingOrder($id) : Response
    {
        $repository = $this->getDoctrine()->getRepository(DrugOrder::class);
        $orders = $repository->findOrder($id);
        return $this->render('pendingOrder.html.twig', [
            'orders' => $orders
        ]);
    }
    /**
     * @Route("/consult/my/orders/{id}", name="consult.taker.orders")
     */
    public function affichMyOrders($id) : Response
    {
        $repository = $this->getDoctrine()->getRepository(CareTakerOrder::class);
        $orders = $repository->findBy(['caretaker' => $id, 'pending' => 1]);
        return $this->render('myTakerOrder.html.twig',[
            'orders' => $orders
        ]);
    }
    /**
     * @Route("/consult/approve/orders/{id}", name="approve.taker.orders")
     */
    public function approveTakerOrder($id, EntityManagerInterface $manager) : Response
    {
        $user =$this->getUser()->getId();
        $repository = $this->getDoctrine()->getRepository(CareTakerOrder::class);
        $repository1 = $this->getDoctrine()->getRepository(User::class);
        $repository2 = $this->getDoctrine()->getRepository(Money::class);
        $order = $repository->findOneBy(['id' => $id]);
        $client = $repository1->findOneBy(['id' => $order->getClient()]);
        $money = $repository2->findOneBy(['id' => 1]);
        $caretaker = $repository1->findOneBy(['id' => $order->getCaretaker()]);
        $order->setPending(0);
        $a =$client->getSolde()-$order->getPrice();
        $b=$money->getSolde()+ ($order->getPrice()*0.05);
        $c=$caretaker->getSolde()+ ($order->getPrice()*0.95);
        $client->setSolde($a );
        $money->setSolde($b);
        $caretaker->setSolde($c);
        $manager->persist($order);
        $manager->persist($client);
        $manager->persist($money);
        $manager->persist($caretaker);
        $manager->flush();
        $this->addFlash('success', 'Order approved with success');
        return $this->redirectToRoute('consult.taker.orders', ['id' => $user]);
    }
    /**
     * @Route("/consult/refuse/orders/{id}", name="refuse.taker.orders")
     */
    public function refuseTakerOrder($id, EntityManagerInterface $manager):Response
    {
        $user =$this->getUser()->getId();
        $repository = $this->getDoctrine()->getRepository(CareTakerOrder::class);
        $order = $repository->findOneBy(['id' => $id]);
        $order->setPending(0);
        $manager->persist($order);
        $manager->flush();
        $this->addFlash('error', 'Order Refused :( ');
        return $this->redirectToRoute('consult.taker.orders', ['id' => $user]);
    }
}