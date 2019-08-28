<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Admins;
use AppBundle\Entity\Coaches;
use AppBundle\Entity\Players;
use AppBundle\Entity\Role;
use AppBundle\Entity\Users;
use AppBundle\Form\UsersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/signIn" ,name  = "signIn")
     *
     */
    public function signInView(Request $request, AuthenticationUtils $authUtils)
    {
        return $this->render('security/signIn.html.twig', array(

            'error' => $authUtils->getLastAuthenticationError(),
        ));
    }

    /**
     * @Route("/" , name = "signIn")
     *
     */
    public function login(AuthenticationUtils $authenticationUtils, AuthenticationUtils $authUtils): Response
    {

        if ($this->isGranted('ROLE_PLAYER')) {
            return $this->redirectToRoute('playerView');
        }elseif ($this->isGranted('ROLE_COACHE')){
            return $this->redirectToRoute('coacheViewAction');
        }
        elseif ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('adminHomeAction');
        }

        return $this->render('security/signIn.html.twig', array(

            'error' => $authUtils->getLastAuthenticationError(),
        ));
    }

//    /**
//     * @Route("/signIn" , name = "signIn_page", )
//     */
//    public function signInAction(Request $request)
//    {
//        $users = new Users();
//        //Name, fName
//        $form = $this->createForm(UsersType::class, $users);
//
//        $form = $form->handleRequest($request);
//        $token = $request->request->get("token");
//
//        if ($this->isCsrfTokenValid("csrf", $token)) {
//
//            $em = $this->getDoctrine()->getRepository(Users::class);
//            $userExist = $em->findBy(['email' => $users->getEmail()]);
//            if ($userExist == true) {
//                var_dump($userExist);
//                exit;
//
//            } else {
//                return $this->json(0);
//
//            }
//        } else {
//
//            var_dump();
//            exit;
//
//        }
//
//    }

    /**
     *
     * @Route("/signUp", name="signUp_page", methods={"GET"})
     */
    public function signUpView()
    {
        return $this->render('security/signUp.html.twig');
    }


    /**
     *
     * @Route("/signUp", name = "signUp_pageAction", methods={"POST"})
     */

    public function signUpAction(Request $request){
        $phone = $request->get("phone");

        $player = $this->getDoctrine()->getRepository(Players::class)->findBy(["phone" => $phone]);
        $coache = $this->getDoctrine()->getRepository(Admins::class)->findBy(["phone" => $phone]);
        $admin = $this->getDoctrine()->getRepository(Coaches::class)->findBy(["phone" => $phone]);

        $em = $this->getDoctrine()->getManager();

        $email = $this->getDoctrine()->getRepository(Players::class)->findBy(["email" => $request->get("email")]);

        if(count($email) > 0){
            return 3;
        }

        if(count($player) !=0 ){
            $user = $player[0]->getUserId();
            if ($user->getEmail() != null ){
                echo 4;
                exit;
            }
            $role = $this->getDoctrine()->getRepository(Role::class)->findBy(["id" => 2]);

            $options = [
                'cost' => 4,
            ];
            $pass = password_hash($request->get("pass"), PASSWORD_BCRYPT, $options);
            $user->setEmail($request->get("email"));
            $user->setPassword($pass);

            $user->setRoles($role);

            $em->persist($user);
            $em->flush();

            echo 1;
            exit;
        }elseif (count($coache) != 0){
            $user = $coache[0]->getUserId();
            if ($user->getEmail() != null ){
                echo 4;
                exit;
            }
            $role = $this->getDoctrine()->getRepository(Role::class)->findBy(["id" => 4]);

            $options = [
                'cost' => 4,
            ];
            $pass = password_hash($request->get("pass"), PASSWORD_BCRYPT, $options);
            $user->setEmail($request->get("email"));
            $user->setPassword($pass);

            $user->setRoles($role);

            $em->persist($user);
            $em->flush();

            echo 1;
            exit;
        }elseif (count($admin) != 0){
            $user = $admin[0]->getUserId();
            if ($user->getEmail() != null ){
                echo 4;
                exit;
            }
            $role = $this->getDoctrine()->getRepository(Role::class)->findBy(["id" => 3]);

            $options = [
                'cost' => 4,
            ];
            $pass = password_hash($request->get("pass"), PASSWORD_BCRYPT, $options);
            $user->setEmail($request->get("email"));
            $user->setPassword($pass);

            $user->setRoles($role);

            $em->persist($user);
            $em->flush();

            echo 1;
            exit;
        }else{
            echo 0;
            exit;
        }

    }

    /**
     * @Route("/logOut", name = "logOut" )
     */
    public function logOut(){

    }
    /**
     * Loads the user for the given username.
     *
     * This method must return null if the user is not found.
     *
     * @param string $username The username
     *
     * @return UserInterface|null
     */
    public function loadUserByUsername($username)
    {
        // TODO: Implement loadUserByUsername() method.
    }
}
