<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PasswordFormType;
use App\Form\RegistrationFormType;
use App\Form\UserType;
use App\Security\CustomAuthAuthenticator;
use App\Security\EmailVerifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Message;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class EditProfileController extends AbstractController
{
    private $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/edit", name="app_edit")
     */
    public function editProfile(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, CustomAuthAuthenticator $authenticator): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($form['featured_image'] != null ) {
                $image = $form['featured_image']->getData();
                if($image) {
                    $imagePath = md5(uniqid()) . $image->getClientOriginalName();
                    $destination = __DIR__ . '/../../public/assets/uploads';
                    try {
                        $image->move($destination, $imagePath);
                        $user->setFeaturedImage('assets/uploads/' . $imagePath);
                    } catch (FileException $fe) {
                        echo $fe;
                    }
                }
            }
            // encode the plain password
//            if($user->getRole()=="ROLE_CLIENT" ){
//
//                $user->setRoles(["ROLE_CLIENT"]);
//            }
//            elseif($user->getRole()=="ROLE_PHARMACY" ){
//
//                $user->setRoles(["ROLE_PHARMACY"]);
//            }
//            elseif($user->getRole()=="ROLE_CARETAKER"){
//
//                $user->setRoles(["ROLE_CARETAKER"]);
//            }
//            $user->setPassword(
//                $passwordEncoder->encodePassword(
//                    $user,
//                    $form->get('plainPassword')->getData()
//                )
//            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
//            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
//                (new TemplatedEmail())
//                    ->from(new Address('sahtekapp.noreply@gmail.com', 'SahtekAPP Mail Bot'))
//                    ->to($user->getEmail())
//                    ->subject('Please Confirm your Email')
//                    ->htmlTemplate('registration/confirmation_email.html.twig')
//            );
//            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('editPersonal.html.twig', [
            'form' => $form->createView(),
        ]);
    }
  /**
     * @Route("/change", name="changePassword")
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, CustomAuthAuthenticator $authenticator): Response
    {
        $user = $this->getUser();
        $passwordold = $user->getPassword();
        $form = $this->createForm(PasswordFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

//            if($form['featured_image'] != null ) {
//                $image = $form['featured_image']->getData();
//                if($image) {
//                    $imagePath = md5(uniqid()) . $image->getClientOriginalName();
//                    $destination = __DIR__ . '/../../public/assets/uploads';
//                    try {
//                        $image->move($destination, $imagePath);
//                        $user->setFeaturedImage('assets/uploads/' . $imagePath);
//                    } catch (FileException $fe) {
//                        echo $fe;
//                    }
//                }
//            }
            // encode the plain password
//            if($user->getRole()=="ROLE_CLIENT" ){
//
//                $user->setRoles(["ROLE_CLIENT"]);
//            }
//            elseif($user->getRole()=="ROLE_PHARMACY" ){
//
//                $user->setRoles(["ROLE_PHARMACY"]);
//            }
//            elseif($user->getRole()=="ROLE_CARETAKER"){
//
//                $user->setRoles(["ROLE_CARETAKER"]);
//            }
//            $user->setPassword(
//                $passwordEncoder->encodePassword(
//                    $user,
//                    $form->get('plainPassword')->getData()
//                )
//            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
//            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
//                (new TemplatedEmail())
//                    ->from(new Address('sahtekapp.noreply@gmail.com', 'SahtekAPP Mail Bot'))
//                    ->to($user->getEmail())
//                    ->subject('Please Confirm your Email')
//                    ->htmlTemplate('registration/confirmation_email.html.twig')
//            );
//            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('editPersonal.html.twig', [
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/verify/email", name="app_verify_email")
//     */
//    public function verifyUserEmail(Request $request): Response
//    {
//        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
//
//        // validate email confirmation link, sets User::isVerified=true and persists
//        try {
//            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
//        } catch (VerifyEmailExceptionInterface $exception) {
//            $this->addFlash('verify_email_error', $exception->getReason());
//
//            return $this->redirectToRoute('app_register');
//        }
//
//        // @TODO Change the redirect on success and handle or remove the flash message in your templates
//        $this->addFlash('success', 'Your email address has been verified.');
//
//        return $this->redirectToRoute('app_register');
//    }



}
