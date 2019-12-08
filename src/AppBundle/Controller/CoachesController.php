<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Coaches;
use AppBundle\Entity\PlayerProperties\Positions;
use AppBundle\Entity\Players;
use AppBundle\Entity\Schedule;
use AppBundle\Entity\Users;
use AppBundle\Entity\YouthTeams;
use AppBundle\Form\PlayersType;
use AppBundle\Form\ScheduleType;
use AppBundle\Form\UsersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class CoachesController extends Controller
{
    

    public function __construct()
    {


    }


    /**
     * @Route("/coache", name = "coacheViewAction" )
     */
    public function CoacheViewAction(){


        $coache = $this->getUser()->getCoaches();

        if($coache->getTeam() != null){
            $teamOfCoache = $coache->getTeam();
        }else    {
            $teamOfCoache = $coache->getYouthTeam();
        }

        $players = $teamOfCoache->getPlayers();

        return $this->render('coaches/index.html.twig', array(
            'playersCount' => count($players),
            'cups' => 0,
            'players' => $players,
            'name' => $this->getUser()->getName() ,
            'fName' => $this->getUser()->getFName(),
            'profile_img' => $this->getUser()->getCoaches()->getImage()));
    }


    /**
     * @Route("/coache/trainings", name = "trainingView")
     */
    public function TrainingView(Request $request)
    {
        $coache = $this->getUser()->getCoaches();

        if($coache->getTeam() != null){
            $teamOfCoache = $coache->getTeam();
        }else    {
            $teamOfCoache = $coache->getYouthTeam();
        }

        $players = $teamOfCoache->getPlayers();

        $team = $coache->getTeam();

        $user = new Users();
        $player = new Players();
        $form_user = $this->createForm(UsersType::class, $user);
        $form_player = $this->createForm(PlayersType::class, $player)->add('position');

        $form_player->handleRequest($request);
        $form_user->handleRequest($request);

        if($form_player->isSubmitted() && $form_user->isSubmitted()){
            $playerPhone = $player->getPhone();
            $validPhoneNum = $this->getDoctrine()->getRepository(Players::class)->findBy(array('phone' => $playerPhone));
            if (count($validPhoneNum) > 0){
                var_dump(1);
            }else {
                $positionId =   json_decode($request->request->get('position'));
                $position = $this->getDoctrine()->getRepository(Positions::class)->find((int)$positionId);
                $player->setPosition($position);
                $player->setTeam($coache->getTeam());

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $player->setUserId($user);
                $em->persist($player);
                $em->flush();
                echo 1;
                exit;
            }
        }



        $user = $this->getUser()->getCoaches();
        return $this->render('coaches/trainings/training.html.twig',array(
            'profile_img' => $user->getImage(),
            'players' => $players
        ));
    }


    /**
     * @Route("/coache/trainingCalendar", name = "trainingCalendarActionView")
     */
    public function TrainingCalendarViewAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $coach = $this->getUser()->getCoaches();

        $schedule = new Schedule();
        $form = $this->createForm(ScheduleType::class, $schedule);
        $form->handleRequest($request);

        $schedules  = [];
        $schedules2 = $this->getDoctrine()->getRepository(Schedule::class)->findBy(['coaches' => $coach->getId()]);

        $Current = strval(Date('d/m/Y'));
        $currentMonth = explode('/', $Current);

        for ( $i = 0; $i < count($schedules2); $i++ ){
            $dates = explode('/', strval($schedules2[$i]->getDate()));
            if ($currentMonth[1] == $dates[1]){
                array_push($schedules, $schedules2[$i]);
            }else{
                $em->remove($schedules2[$i]);
                $em->flush();
            }
        }


        if ($form->isSubmitted()) {
            $schedule->setCoaches($coach);
            $em = $this->getDoctrine()->getManager();
            $em->persist($schedule);
            $em->flush();
            exit;
        }

        return $this->render('coaches/trainings/trainingCalendar.html.twig',
            array("form" => $form->createView(),
            'profile_img' => $coach->getImage(),
            'schedules' => $schedules));
    }


    /**
     * @Route("/coache/settings", name = "coache_settings")
     *
     */
    public function SettingsView(\Symfony\Component\HttpFoundation\Request $request){
        $user = $this->getUser()->getCoaches();
        $coaches = new Coaches();
        $form = $this->createFormBuilder($coaches)
            ->add('image', FileType::class, array('data_class' => null, ))
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $coaches->getImage();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {

            }
            $em = $this->getDoctrine()->getManager();

            $user->setImage($fileName);
            $em->persist($user);
            $em->flush();

            // ... persist the $product variable or any other work
            return $this->render('coaches/settings/settings.html.twig',
                array("image" => $user->getImage(),'form' => $form->createView()));
        }

        return $this->render('coaches/settings/settings.html.twig',
            array('form' => $form->createView(), "image" => $this->getUser()->getCoaches()->getImage(), ));
    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }


    /**
     * @Route("/coache/player/{id}", name = "playerAction")
     *
     */
    public function PlayerAction($id, \Symfony\Component\HttpFoundation\Request $request)
    {
        $coache = $this->getUser()->getCoaches();
        $player = $this->getDoctrine()->getRepository(Players::class)->find($id);
        $playerStats = $player->getStats();
        $coacheYouthTeam = false;
        $playerYouthTeam = false;
        $players = new Players();

        $form = $this->createFormBuilder($players)->add('pace');

        if($player->getTeam() != null){
            $team = $player->getTeam();

        }else {
            $team = $player->getYouthTeams();
            $playerYouthTeam = true;
        }


        if($coache->getTeam() != null){
            $coacheTeam = $coache->getTeam();

        }else {
            $coacheTeam = $coache->getYouthTeams();
            $coacheYouthTeam = true;
        }

        if ($team->getId() != $coacheTeam->getId() || $coacheYouthTeam != $playerYouthTeam){
            return $this->redirectToRoute("trainingView");
        }

        return $this->render('coaches/playerStat.html.twig',
            array(
                'profile_img' => $coache->getImage(),
                'player' => $player,
                'playerStats' => $playerStats,
                'image' => $this->getUser()->getCoaches()->getImage(),


                )
        );

    }



    /**
     * @Route("/coache/playerStats/{id}", name = "playerStats")
     *
     */
    public function PlayerStats($id, \Symfony\Component\HttpFoundation\Request $request)
    {
        $player = $this->getDoctrine()->getRepository(Players::class)->find(intval($id));
        $player->setDribble(intval($request->get("dribble")));
        $player->setLongPass(intval($request->get("longPass")));
        $player->setWork(intval($request->get("workHard")));
        $player->setPass(intval($request->get("pass")));
        $player->setPerspective(intval($request->get("perspective")));
        $player->setRelax(intval($request->get("relax")));
        $player->setShot(intval($request->get("shot")));
        $player->setTacticks(intval($request->get("tacktick")));
        $player->setTechnique(intval($request->get("technique")));
        $player->setWillpower(intval($request->get("willPower")));
        $player->setStatusFromCoaches(intval($request->get("all")));
        $player->setPace(intval($request->get("pace")));
        $player->setHeight(intval($request->get("height")));
        $player->setWeight(intval($request->get("weight")));
        $player->setFat(intval($request->get("fat")));

        $em = $this->getDoctrine()->getManager();
        $em->persist($player);
        $em->flush();

       return 1;

    }




}
