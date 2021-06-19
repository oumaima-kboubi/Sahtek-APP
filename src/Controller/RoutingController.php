<?php

namespace App\Controller;

use App\Entity\Belong;
use App\Entity\CareTakerOrder;
use App\Entity\Category;
use App\Entity\City;
use App\Entity\Drug;
use App\Entity\DrugOrder;
use App\Entity\Entreprise;
use App\Entity\Money;
use App\Entity\User;

use App\Form\BelongType;
use App\Form\CareTakerOrderType;
use App\Form\DrugOrderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
     * @Route("/about",name="routing.about")
     */
    public function about()
    {
        return $this->render('aboutUs.html.twig');
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
        $user1 = $this->getUser();
        if ($user1 != NULL) {

            $id = $user1->getId();
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
     * @Route("/consult/order/{id}", name="histo.consult.drugorder")
     */
    public function histoDrugOrder($id): Response
    {
        $historiques = $this->getDoctrine()->getRepository(DrugOrder::class);
        $exist = $historiques->findBy(['client' => $id, 'deleted' => 0]);
        $today = date("Y-m-d");
        $lastweek = date("Y-m-d", strtotime('-7 day'));
        $lastmonth = date("Y-m-d", strtotime('-30 day'));
        $lastweeks = $historiques->findForWeek($id, $today, $lastweek);
        $lastmonths = $historiques->findForMonth($id, $lastweek, $lastmonth);
        $rest = $historiques->findTheRest($id, $lastmonth);
        if ($exist) {
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
    public function deleteHistoDrug($id, $idd): Response
    {
        $repository = $this->getDoctrine()->getRepository(DrugOrder::class);
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
        return $this->redirectToRoute('histo.consult.drugorder', ['id' => $idd]);
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
    public function affichCity($place): Response
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
    public function affichPharmacy($city): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        if ($city == 'null') {
            $pharmacy = $repository->findBy(['role' => 'ROLE_PHARMACY']);

        } else {
            $pharmacy = $repository->findBy(['city' => $city, 'role' => 'ROLE_PHARMACY']);

        }
//        if ($pharmacy == []){
//            return $this->render('pharmacieslist.html.twig', [
//                'pharmacy' => '<h1>Sorry! There is no pharmacies in this region!</h1>'
//            ]);
//        }
        return $this->render('pharmacieslist.html.twig', [
            'pharmacy' => $pharmacy
        ]);
    }


    /**
     * @Route("/care/affich/{city}", name="caretaker.affich")
     */
    public function afficherCareTaker($city): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $caretaker = $repository->findBy(['city' => $city, 'role' => 'ROLE_CARETAKER']);
//        if ($caretaker) {
            return $this->render('careTaker.html.twig', [
                'caretakers' => $caretaker
            ]);
//        }
//        $this->addFlash('error', 'careTakers in this city are nonexistent');
//        return $this->render('careTaker.html.twig');
    }

    /**
     * @Route("/hire/care/{id}", name="caretaker.hire")
     */
    public function orderCareTaker(Request $request, EntityManagerInterface $manager, $id): Response
    {
        $userId = $this->getUser()->getId();
        $user = $this->getUser();
        $takerId = $id;
        $day = $request->query->get('day');
        //  $takerUser= $this->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
        //  $pharma= $repository->findOneBy(['id' => 1]);
        //$user =$repository->findOneBy(['id' => 2]);
        $takerUser = $repository->findOneBy(['id' => $id]);
        if (!$user || !$takerId) {
            return new Response('<h1> There is no user or caretaker</h1>');
//                $this->render('hireTaker.html.twig');
        } else {
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
            if ($form->isSubmitted() && $form->isValid()) {
                //    $order->setPharmacy($pharma);
                $order->setApproved(0);
                $order->setCaretaker($takerUser);
                $order->setClient($user);
                $order->setPending(1);
                $order->setDeleted(0);
                $order->setDay(new \DateTime());
                $manager->persist($order);
                $manager->flush();
                return $this->redirectToRoute("caretaker.affich", ['city' => $takerUser->getCity()]);
            }
            return $this->render('hireTaker.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    /**
     * @Route("/pending/taker/{id}", name="pending.taker")
     */
    public function affichPendingTaker($id): Response
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
    public function affichPendingOrder($id): Response
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
    public function affichMyOrders($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(CareTakerOrder::class);
        $orders = $repository->findBy(['caretaker' => $id, 'pending' => 1]);
        return $this->render('myTakerOrder.html.twig', [
            'orders' => $orders
        ]);
    }

    /**
     * @Route("/consult/approve/orders/{id}", name="approve.taker.orders")
     */
    public function approveTakerOrder($id, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser()->getId();
        $repository = $this->getDoctrine()->getRepository(CareTakerOrder::class);
        $repository1 = $this->getDoctrine()->getRepository(User::class);
        $repository2 = $this->getDoctrine()->getRepository(Money::class);
        $order = $repository->findOneBy(['id' => $id]);
        $client = $repository1->findOneBy(['id' => $order->getClient()]);
        $money = $repository2->findOneBy(['id' => 1]);
        $caretaker = $repository1->findOneBy(['id' => $order->getCaretaker()]);
        $order->setPending(0);
        $a = $client->getSolde() - $order->getPrice();
        $b = $money->getSolde() + ($order->getPrice() * 0.05);
        $c = $caretaker->getSolde() + ($order->getPrice() * 0.95);
        $client->setSolde($a);
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
    public function refuseTakerOrder($id, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser()->getId();
        $repository = $this->getDoctrine()->getRepository(CareTakerOrder::class);
        $order = $repository->findOneBy(['id' => $id]);
        $order->setPending(0);
        $manager->persist($order);
        $manager->flush();
        $this->addFlash('error', 'Order Refused :( ');
        return $this->redirectToRoute('consult.taker.orders', ['id' => $user]);
    }


    /**
     * @Route("/category/list/{place}", name="category.list")
     */
//    category/list/drug.affich
    public function affichCategory($place): Response
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);

        $categories = $repository->findAll();
        return $this->render('drug.html.twig', [
            'categories' => $categories,
            'place' => $place
        ]);
    }

    /**
     * @Route("/drugAffiche/{category}", name="drug.affich")
     */
    public function afficherDrugs($category): Response
    {
        $repository = $this->getDoctrine()->getRepository(Drug::class);
        $drugs = $repository->findBy(['type' => $category]);
      //  if ($drugs) {
            return $this->render('druglist.html.twig', [
                'drugs' => $drugs
            ]);
     //   }
     //   $this->addFlash('error', 'drugs in this city are nonexistent');
      //  return $this->render('druglist.html.twig');
    }
    /**
     * @Route("/entreprise/list/{place}", name="entreprise.list")
     */
//    category/list/drug.affich
    public function affichEntreprise($place): Response
    {
        $repository = $this->getDoctrine()->getRepository(Entreprise::class);

        $entreprises = $repository->findAll();
        return $this->render('entreprise.html.twig', [
            'entreprises' => $entreprises,
            'place' => $place
        ]);
    }

    /**
     * @Route("/entrepriseAffiche/{entreprise}", name="entreprise.affich")
     */
    public function afficherEntreprise($entreprise): Response
    {
        $repository = $this->getDoctrine()->getRepository(Drug::class);
        $drugs = $repository->findBy(['entreprise' => $entreprise]);
        if ($drugs) {
            return $this->render('druglist.html.twig', [
                'drugs' => $drugs
            ]);
        }
        $this->addFlash('error', 'drugs in this city are nonexistent');
        return $this->render('druglist.html.twig');
    }

    /**
     * @Route("/drugOrder/{id}", name="drug.order")
     */
    public function orderDrug(Request $request, EntityManagerInterface $manager, $id): Response
    {
        $userId = $this->getUser()->getId();
        $user = $this->getUser();
        $takerId = $id;
        $day = $request->query->get('day');
        //  $takerUser= $this->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
        //  $pharma= $repository->findOneBy(['id' => 1]);
        //$user =$repository->findOneBy(['id' => 2]);
        $takerUser = $repository->findOneBy(['id' => $id]);
        if (!$user || !$takerId) {
            return new Response('<h1> There is no user or caretaker</h1>');
//                $this->render('hireTaker.html.twig');
        } else {
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
            if ($form->isSubmitted() && $form->isValid()) {
                //    $order->setPharmacy($pharma);
                $order->setApproved(0);
                $order->setCaretaker($takerUser);
                $order->setClient($user);
                $order->setPending(1);
                $order->setDeleted(0);
                $order->setDay(new \DateTime());
                $manager->persist($order);
                $manager->flush();
                return $this->redirectToRoute("caretaker.affich", ['city' => $takerUser->getCity()]);
            }
            return $this->render('hireTaker.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    /**
     * @Route("/drug/list/{id}", name="drug.list")
     */
    public function affichDrug($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Belong::class);
        $drugs = $repository->findThe($id);
        return $this->render('drugListt.html.twig', [
            'drugs' => $drugs,
            'idd' => $id
        ]);
    }

    /**
     * @Route("/order/drug/{id}/{idd}", name="drug.order.client")
     */
    public function orderDrugs(Request $request, EntityManagerInterface $manager, $id, $idd): Response
    {
        $idUser = $this->getUser()->getId();
        // $takerId = $request->query->get('taker');
        $repository = $this->getDoctrine()->getRepository(User::class);
        $repository1 = $this->getDoctrine()->getRepository(Drug::class);
        $pharma = $repository->findOneBy(['id' => $idd]);
        $user = $repository->findOneBy(['id' => $idUser]);
        $drug = $repository1->findOneBy(['id' => $id]);
        if (!$user || !$drug) {
            return new Response("<h1> Problem :( </h1>");
        } else {
            $order = new DrugOrder();
            $form = $this->createForm(DrugOrderType::class, $order);
            $form->remove('pharmacy');
            $form->remove('Approved');
            $form->remove('pending');
            $form->remove('client');
            $form->remove('Drug');
            $form->remove('featured_image');
            $form->remove('deleted');
            $form->remove('price');
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $order->setPharmacy($pharma);
                $order->setApproved(0);
                $order->setDrug($drug);
                $order->setClient($user);
                $order->setPending(1);
                $order->setDeleted(0);
                $order->setPrice($drug->getPrice());
//                if($form['featured_image'] != null ) {
//                    $image = $form['featured_image']->getData();
//                    if($image) {
//                        $imagePath = md5(uniqid()) . $image->getClientOriginalName();
//                        $destination = __DIR__ . '/../../public/assets/uploads';
//                        try {
//                            $image->move($destination, $imagePath);
//                            $user->setFeaturedImage('assets/uploads/' . $imagePath);
//                        } catch (FileException $fe) {
//                            echo $fe;
//                        }
//                    }
//                }
                $order->setFeaturedImage($user->getFeaturedImage());
                $manager->persist($order);
                $manager->flush();
                return $this->redirectToRoute("drug.list", ['id' => $idd]);
            }
            return $this->render('orderDrug.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }


    /**
     * @Route("/pharmacy/add/list/{id}", name="drug.list.add")
     */
    public function addDrugToList(Request $request, EntityManagerInterface $manager, $id): Response
    {
        $idUser = $this->getUser()->getId();
        $repository1 = $this->getDoctrine()->getRepository(User::class);
        $repository2 = $this->getDoctrine()->getRepository(Drug::class);
        $repository = $this->getDoctrine()->getRepository(Belong::class);
        $pharma = $repository1->findOneBy(['id' => $idUser]);
        $drug = $repository2->findOneBy(['id' => $id]);
        $exist = $repository->findOneBy(['drug' => $id, 'pharmacy' => $idUser]);
        if (!$pharma || !$drug) {
            return new Response("<h1> Problem :( </h1>");
        } else {
            $order = new Belong();
            $form = $this->createForm(BelongType::class, $order);
            $form->remove('Pharmacy');
            $form->remove('Promotion');
            $form->remove('finalPrice');
            $form->remove('InitialPrice');
            $form->remove('pourcentage');
            $form->remove('drug');
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $order->setPharmacy($pharma);
                $order->setPourcentage(0);
                $order->setInitialPrice($drug->getPrice());
                $order->setFinalPrice(0);
                $order->setPromotion(0);
                $order->setDrug($drug);
                if ($exist) {
                    $i = $order->getQuantity() + $exist->getQuantity();
                    $exist->setQuantity($i);
                    $manager->persist($exist);
                    $manager->flush();
                    return $this->redirectToRoute("category.list", ['place' => 'drug.affich']);
                }
                $manager->persist($order);
                $manager->flush();
                return $this->redirectToRoute("category.list", ['place' => 'drug.affich']);
            }
            return $this->render('addDrugToList.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    /**
     * @Route("/consult/my/drugs/{id}", name="consult.drugs.orders")
     */
    public function affichMyDrugs($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(DrugOrder::class);
        $orders = $repository->findBy(['pharmacy' => $id, 'pending' => 1]);
        return $this->render('MyDrugOrder.html.twig', [
            'orders' => $orders
        ]);
    }

    /**  * @Route("/consult/refuse/drugs/{id}", name="refuse.drugs.orders") */
    public function refuseDrugsOrder($id, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser()->getId();
        $repository = $this->getDoctrine()->getRepository(DrugOrder::class);
        $order = $repository->findOneBy(['id' => $id]);
        $order->setPending(0);
        $order->setApproved(0);
        $manager->persist($order);
        $manager->flush();
        $this->addFlash('error', 'Order Refused :( ');
        return $this->redirectToRoute('consult.drugs.orders', ['id' => $user]);
    }

    /**  * @Route("/consult/approve/drugs/{id}", name="approve.drugs.orders") */
    public function approveDrugsOrder($id, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser()->getId();
        $repository = $this->getDoctrine()->getRepository(DrugOrder::class);
        $repository1 = $this->getDoctrine()->getRepository(User::class);
        $repository2 = $this->getDoctrine()->getRepository(Money::class);


        $order = $repository->findOneBy(['id' => $id]);
        $client = $repository1->findOneBy(['id' => $order->getClient()->getId()]);
        $money = $repository2->findOneBy(['id' => 1]);
        $pharmacy = $repository1->findOneBy(['id' => $order->getPharmacy()->getId()]);
        $order->setPending(0);
        $order->setApproved(true);


        $a = $client->getSolde() - $order->getPrice();
        $b = $money->getSolde() + ($order->getPrice() * 0.05);
        $c = $pharmacy->getSolde() + ($order->getPrice() * 0.95);


        $client->setSolde($a);
        $money->setSolde($b);
        $pharmacy->setSolde($c);


        $manager->persist($order);
        $manager->persist($client);
        $manager->persist($money);
        $manager->persist($pharmacy);
        $manager->flush();
        $this->addFlash('success', 'Order approved with success');
        return $this->redirectToRoute('consult.drugs.orders', ['id' => $user]);
    }

    /**
     * @Route("/statistic/map/dash/{id}", name="statistic.map.dash")
     */
    public function mapIt($id) : Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $pharmacy = $repository->findOneBy(['id' => $id]);
        return $this->render('map.html.twig', [
            'pharmacy' => $pharmacy
        ]);
    }

    /**
     * @Route("/statistic/user/dash/{id}", name="statistic.user.dash")
     */
    public function index1($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(DrugOrder::class);
        $repository1 = $this->getDoctrine()->getRepository(User::class);
        $totalOrders = $repository->count(['client' => $id]);
        $solde = $repository1->findOneBy(['id' => $id]);
        $approvedOrders = $repository->count(['client' => $id, 'pending' => 0, 'Approved' => 1]);
        $refusedOrders = $repository->count(['client' => $id, 'pending' => 0, 'Approved' => 0]);
        $pendingOrders = $repository->count(['client' => $id, 'pending' => 1]);
        return $this->render('index1.html.twig', [
            'totalOrders' => $totalOrders,
            'solde' => $solde,
            'approvedOrders' => $approvedOrders,
            'refusedOrders' => $refusedOrders,
            'pendingOrders' => $pendingOrders
        ]);
    }

    /**
     * @Route("/statistic/pharmacy/dash/{id}", name="statistic.pharmacy.dash")
     */
    public function index2($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Belong::class);
        $repository1 = $this->getDoctrine()->getRepository(DrugOrder::class);
        $repository2 = $this->getDoctrine()->getRepository(User::class);
        $pharmacy = $repository2->findOneBy(['id' => $id]);
        $clientNumbers = $repository1->clientNumber($id);
        $totalMoney = $repository2->findOneBy(['id' => $id]);
        $totalOrders = $repository1->count(['pharmacy' => $pharmacy]);
        $numberDrugs= $repository->count(['pharmacy' => $pharmacy]);
        $cityCalcul = $repository1->cityCalcul($id);
        $pendingOrders = $repository1->findBy(['pharmacy' => $pharmacy, 'pending' => 1]);
        $refusedOrder=$repository1->count(['pharmacy' => $pharmacy, 'pending' => 0, 'Approved' => 0]);;
        $acceptOrder=$repository1->count(['pharmacy' => $pharmacy, 'pending' => 0, 'Approved' => 1]);;
        $numberPend =$repository1->count(['pharmacy' => $pharmacy, 'pending' => 1]);
        $findMoney = $repository1->findBy(['pharmacy' => $pharmacy, 'Approved' => 1]);
        return $this->render('index2.html.twig', [
            'totalMoney' => $totalMoney,
            'totalOrders' => $totalOrders,
            'numberDrugs' => $numberDrugs,
            'clientNumber' => $clientNumbers[0][1],
            'pendingOrders' => $pendingOrders,
            'cityCalcul' => $cityCalcul,
            'refuseOrder' => $refusedOrder,
            'acceptOrder' => $acceptOrder,
            'numberPend' => $numberPend,
            'findMoney' => $findMoney
        ]);
    }

}
