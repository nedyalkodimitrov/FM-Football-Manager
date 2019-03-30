<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Coaches;
use AppBundle\Entity\CoachesPositions;
use AppBundle\Entity\Division;
use AppBundle\Entity\PlayerProperties\Positions;
use AppBundle\Entity\Players;
use AppBundle\Entity\Users;
use AppBundle\Entity\YouthTeams;
use AppBundle\Form\CoachesType;
use AppBundle\Form\PlayersType;
use AppBundle\Form\UsersType;
use AppBundle\Repository\TeamsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{

    /**
     * @Route("/admin", name = "adminHomeAction" )
     */
    public function CoacheViewAction(Request $request){

        $admin = $this->getUser()->getAdmin();
        $team = $admin->getTeam();
        $division = $team->getDevision();
        $players = $team->getPlayers();
        $coaches = $team->getCoaches();
        $youthTeams = $team->getYouthTeams();



        $user = new Users();
        $coache = new Coaches();
        $player = new Players();
        $form_user = $this->createForm(UsersType::class, $user);
        $form_coaches = $this->createForm(CoachesType::class, $coache);
        $form_player = $this->createForm(PlayersType::class, $player);

        $form_player->handleRequest($request);
        $form_user->handleRequest($request);
        $form_coaches->handleRequest($request);

        if($form_player->isSubmitted() && $form_user->isSubmitted()) {
            $playerPhone = $player->getPhone();
            $validPhoneNum = $this->getDoctrine()->getRepository(Players::class)->findBy(array('phone' => $playerPhone));
            if (count($validPhoneNum) > 0) {
                var_dump(1);
            } else {
                $positionId = json_decode($request->request->get('position'));
                $position = $this->getDoctrine()->getRepository(Positions::class)->find((int)$positionId);
                $player->setPosition($position);
                $player->setTeam($admin->getTeam());

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $player->setUserId($user);
                $em->persist($player);
                $em->flush();
                return $this->redirectToRoute('adminHomeAction');
            }
        }


            if($coache->getPhone() != null && $user->getName() != null && $user->getFName() != null) {

                $coachePhone = $coache->getPhone();

                $playerValidPhoneNum = $this->getDoctrine()->getRepository(Players::class)->findBy(array('phone' => $coachePhone));
                $coacheValidPhoneNum = $this->getDoctrine()->getRepository(Coaches::class)->findBy(array('phone' => $coachePhone));

                if (count($playerValidPhoneNum) > 0 || count($coacheValidPhoneNum) > 0) {
                    var_dump(1);
                    exit;
                } else {

                    $positionId = json_decode($request->request->get('position'));
                    $position = $this->getDoctrine()->getRepository(CoachesPositions::class)->find((int)$positionId);

                    $coache->setTeamPosition($position);
                    $coache->setTeam($admin->getTeam());

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();

                    $coache->setUserId($user);
                    $em->persist($coache);
                    $em->flush();

                    var_dump("2");
                    exit;
                }

            }




        return $this->render('admin/home.html.twig', array('profile_img' => $admin->getTeam()->getImage(),
            'playersNum' => count($players),
            'division' => $division,
            'players' => $players,
            'coaches' =>$coaches,
            'team' =>''
        ));
    }

    /**
     * @Route("/admin/youthTeams", name= "youthTeams" )
     */
    public function Teams(Request $request){
        $user = $this->getUser()->getAdmin();
        $team = $user->getTeam();
        $youthTeams = $team->getYouthTeams();
        $country = $team->getCountry();
        $divisions = $country->getYouthDivisions();

        return $this->render('admin/teams.html.twig', array(
            'youthTeams' =>$youthTeams,
            'profile_img' => $this->getUser()->getAdmin()->getTeam()->getImage(),
            'divisions' => $divisions,

        ));

    }


    /**
     * @Route("/admin/createYouthTeam", name= "createYouthTeam" )
     */
    public function CreateYouthTeam(Request $request)
    {
        $user = $this->getUser()->getAdmin();
        $team = $user->getTeam();
        $country = $team->getCountry();

        $youthTeam = new YouthTeams();
        $youthTeam->setName($request->get('name'));
        $division = $this->getDoctrine()->getRepository(Division::class)->find($request->get('division'));
        $youthTeam->setDivision($division);
        if ($youthTeam->getName() != null && $youthTeam->getDivision() != null) {
            $youthTeam->setCountry($country);
            $youthTeam->setMotherTeam($team);
            $youthTeam->setPoints(0);
            $youthTeam->setPlayedGames(0);
            $youthTeam->setLostGames(0);
            $youthTeam->setGoalsInTheTeamDoor(0);
            $youthTeam->setDrawsGames(0);
            $youthTeam->setGoals(0);
            $youthTeam->setWins(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($youthTeam);
            $em->flush();

            return $this->redirectToRoute('youthTeams');

        }


    }
        /**
         * @Route("/admin/deleteYouthTeam/{id}", name= "deleteYouthTeam" )
         */
        public function DeleteYouthTeam($id, Request $request){

            $youthTeam = $this->getDoctrine()->getRepository(YouthTeams::class)->find(intval($id));
            $players = $this->getDoctrine()->getRepository(Players::class)->findBy(["youthTeams" =>intval($id)]);
            $coaches= $this->getDoctrine()->getRepository(Coaches::class)->findBy(["youthTeam" =>intval($id)]);
            $em = $this->getDoctrine()->getManager();
           foreach ($coaches as $coache){
               $em->remove($coache);
               $em->flush();
           }
            foreach ($players as $player){
               $em->remove($player);
               $em->flush();
           }


            $em->remove($youthTeam);
            $em->flush();

           return $this->redirectToRoute('youthTeams');




    }


    /**
     * @Route("/admin/youthTeam/{id}" , name = "youthTeam")
     */
    public function YouthTeam($id, Request $request){

        $admin = $this->getUser()->getAdmin();
        $youthTeam = $this->getDoctrine()->getRepository(YouthTeams::class)->find($id);
        if ($youthTeam->getMotherTeam()->getAdmin()[0]->getId() != $admin->getId()){
            return $this->redirectToRoute(adminHomeAction);
        }

        $players = $youthTeam->getPlayers();
        $coaches = $youthTeam->getCoaches();

        $user = new Users();
        $coache = new Coaches();
        $player = new Players();
        $form_user = $this->createForm(UsersType::class, $user);
        $form_player = $this->createForm(PlayersType::class, $player);
        $form_coaches = $this->createForm(CoachesType::class, $coache);

        $form_coaches->handleRequest($request);
        $form_player->handleRequest($request);
        $form_user->handleRequest($request);

        if($form_player->isSubmitted() && $form_user->isSubmitted()) {

            $playerPhone = $player->getPhone();
            $playerValidPhoneNum = $this->getDoctrine()->getRepository(Players::class)->findBy(array('phone' => $playerPhone));
            $coacheValidPhoneNum = $this->getDoctrine()->getRepository(Coaches::class)->findBy(array('phone' => $playerPhone));

            if (count($playerValidPhoneNum) > 0 || count($coacheValidPhoneNum) > 0) {
                var_dump(1);
            } else {

                $positionId = json_decode($request->request->get('position'));

                $position = $this->getDoctrine()->getRepository(Positions::class)->find((int)$positionId);

                $player->setPosition($position);
                $player->setYouthTeams($youthTeam);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();


                $player->setUserId($user);
                $em->persist($player);
                $em->flush();

                var_dump("2");
                exit;
            }

        }

        if($form_coaches->isSubmitted() && $form_user->isSubmitted()) {

            $coachePhone = $coache->getPhone();

            $playerValidPhoneNum = $this->getDoctrine()->getRepository(Players::class)->findBy(array('phone' => $coachePhone));
            $coacheValidPhoneNum = $this->getDoctrine()->getRepository(Coaches::class)->findBy(array('phone' => $coachePhone));

            if (count($playerValidPhoneNum) > 0 || count($coacheValidPhoneNum) > 0) {
                var_dump(1);
                exit;
            } else {

                $positionId = json_decode($request->request->get('position'));
                $position = $this->getDoctrine()->getRepository(CoachesPositions::class)->find((int)$positionId);

                $coache->setTeamPosition($position);
                $coache->setYouthTeam($youthTeam);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $coache->setUserId($user);
                $em->persist($coache);
                $em->flush();

                var_dump("2");
                exit;
            }

        }



        return $this->render('admin/youthTeam.html.twig', array('players' =>$players,
            'coaches' => $coaches,
            'teamId' => $id,
            'profile_img' =>  $this->getUser()->getAdmin()->getTeam()->getImage()));

    }

    /**
     * @Route("/admin/coaches/" , name = "coaches")
     */
    public function Coaches(Request $request)
    {
            $admin = $this->getUser()->getAdmin();
            $team = $admin->getTeam();
            $youthTeams = $team->getYouthTeams();

        return $this->render('admin/coaches.html.twig', array('team' =>$team,
            'youthTeams' => $youthTeams,
            'profile_img' => ''));

    }

    /**
     * @Route("/admin/coaches/{id}" , name = "coacheAction")
     */
    public function CoachesAction($id, Request $request)
    {   $admin = $this->getUser()->getAdmin();
        $coache = $this->getDoctrine()->getRepository(Coaches::class)->find($id);
        if ($coache->getTeam() != null){
            $team = $coache->getTeams();
        }else{
            $team = $coache->getYouthTeam()->getTeam();
        }

        if ($team->getAdmin()[0]->getId() != $admin->getId())
        {
            return $this->redirectToRoute(coaches);
        }

        return $this->render('admin/coacheAction.html.twig', array('coache' =>$coache,

            'profile_img' => ''));

    }



    /**
     * @Route("/admin/deletePlayer/{id}" , name = "deletePlayer")
     */
    public function DeletePlayer($id, Request $request)
    {    $players = $this->getDoctrine()->getRepository(Players::class)->find(intval($id));

        if($players->getTeam() != null){
            $team = $players->getTeam();
        }else{
            $team = $players->getYouthTeams()->getMotherTeam();
        }

        if ($team->getId() != $this->getUser()->getAdmin()->getTeam()->getId()){
            echo 0;
            exit;
        }

        $user = $players->getUserId();
        $em = $this->getDoctrine()->getManager();
        $em->remove($players);
        $em->remove($user);
        $em->flush();
        echo 1;
        exit;
    }
    /**
     * @Route("/admin/deleteCoache/{id}" , name = "deleteCoache")
     */
    public function DeleteCoache($id, Request $request)
    {
        $coache = $this->getDoctrine()->getRepository(Coaches::class)->find(intval($id));

        if($coache->getTeam() != null){
            $team = $coache->getTeam();
        }else{
            $team = $coache->getYouthTeam()->getMotherTeam();
        }

        if ($team->getId() != $this->getUser()->getAdmin()->getTeam()->getId()){
            echo 0;
            exit;
        }

        $user = $coache->getUserId();
        $em = $this->getDoctrine()->getManager();
        $em->remove($coache);
        $em->remove($user);
        $em->flush();
        echo 1;
        exit;

    }

}

