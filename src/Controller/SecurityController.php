<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\InscriptionType;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends AbstractController
{
  /**
  * @Route("/inscription", name="security_inscription")
  */
  public function inscription(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){
    $user = new User();
    $form = $this->createForm(InscriptionType::class, $user);

    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
      $hash = $encoder->encodePassword($user, $user->getPassword());
      $user->setPassword($hash);

      $manager->persist($user);
      $manager->flush();

      return $this->redirectToRoute('security_login');
    }

    return $this->render('security/inscription.html.twig', [
      'formInscription' => $form->createView(),
    ]);
  }

    /**
    * @Route("/connexion", name="security_login")
    */
    public function login(){
      return $this->render('security/login.html.twig');
    }

    /**
    * @Route("/deconnexion", name="security_logout")
    */
    public function logout(){}

    /**
    * @Route("/userList", name="list_users")
    */
    public function userList(UserRepository $repo){
      $users = $repo->findAllOrderByUserName();

      return $this->render('security/userList.html.twig', [
        'users' => $users,
      ]);
    }

    /**
    * @Route("/profile", name="profile")
    */
    public function profil(){
      $user = $this->getUser();

      return $this->render('security/profile.html.twig', [
        'user' => $user,
      ]);
    }
}
