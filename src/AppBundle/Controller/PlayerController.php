<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PlayerProperties\Positions;
use AppBundle\Entity\PlayerProperties\WaterGlasses;
use AppBundle\Entity\Players;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\PlayersInjured;
use AppBundle\Form\PlayersInjuredType;
use AppBundle\Repository\PlayerProperties\WaterGlassesRepository;
use AppBundle\Repository\PlayersInjuredRepository;
use AppBundle\Repository\PlayersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Service;

class PlayerController extends Controller
{
    private $playerPropService;
    private $waterGlassRepo;

    public function __construct(Service\PlayerProperties $playerProperties, WaterGlassesRepository $waterGlassesRepository)
    {
        $this->playerPropService = $playerProperties;
        $this->waterGlassRepo = $waterGlassesRepository;
    }

    /**
     * @Route("/player", name ="playerView")
     */
    public function IndexView(WaterGlassesRepository $waterGlasses)
    {
        $player =  $this->getUser()->getPlayer();

        $lastWaterRecord = $this->playerPropService->LastWaterRecord($this->getUser(), $this->getUser()->getId());
        $allWaterRecords = $waterGlasses->getWaterGlassesByUserASC( $this->getUser()->getId());
        $playerProp = $this->playerPropService->PlayerTeam($player);
        $playerNames = $this->playerName($player->getUserId()->getFName());
        return $this->render('player/index.html.twig', array('coachStatus' => $player->getStatusFromCoaches(),
            'playerFat' => $player->getFat(),
            'pace' => $player->getPace(),
            'teams' => $playerProp[1],
            'myTeam' => $playerProp[2],
            'waterGlasses' =>  $lastWaterRecord->getWaterGlasses(),
            'allWatersGlasese' => $allWaterRecords,
            'profile_img' => $player->getImage(),
            'playerName' => $playerNames,

        ));
    }

    /**
     * @Route("/player/removeWaterGlasses", name = "removeWaterGlassAction")
     */
    public function RemoveWaterGlassesAction()
    {
        $userId = $this->getUser()->getId();
        $water_glasses = $this->waterGlassRepo->getWaterGlassesByUserDESC($userId);
        if ($water_glasses[0]->getWaterGlasses() > 0){
            $water_glasses[0]->setWaterGlasses($water_glasses[0]->getWaterGlasses() - 1);
            $this->waterGlassRepo->save($water_glasses[0]);

        }
        return 'success';
    }

    /**
     * @Route("/player/addWaterGlasses", name = "addWaterGlassAction")
     */
    public function AddWaterGlassesAction()
    {
        $userId = $this->getUser()->getId();
        $water_glasses = $this->waterGlassRepo->getWaterGlassesByUserDESC($userId);
        if ($water_glasses[0]->getWaterGlasses() < 21) {
            $water_glasses[0]->setWaterGlasses($water_glasses[0]->getWaterGlasses() + 1);
            $this->waterGlassRepo->save($water_glasses[0]);
        }
        return 'success';
    }

    /**
     * @Route("/players/settings", name = "player_settings")
     *
     */
    public function SettingsView(\Symfony\Component\HttpFoundation\Request $request){
        $user = $this->getUser()->getPlayer();
        $players = new Players();
        $positions = $this->getDoctrine()->getRepository(Positions::class)->findAll();
        $form = $this->createFormBuilder($players)
            ->add('image', FileType::class, array('data_class' => null, ))
            ->add('height')
            ->add('weight')
            ->add('save', SubmitType::class, ['label' => 'Запаметяване '])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $players->getImage();
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

            return $this->render('player/settings/newSettingPage.html.twig',
                array("image" => $user->getImage(),
                    'form' => $form->createView(),
                    'player' => $user,
                    'playerName' => $user->getUserId()->getName(). ' '.$user->getUserId()->getFName()
                ));
        }

        return $this->render('player/settings/newSettingPage.html.twig',
            array('form' => $form->createView(),
                "image" => $this->getUser()->getPlayer()->getImage(),
                'profile_img' =>$this->getUser()->getPlayer()->getImage(),
                'player' => $user,
                'playerName' => $user->getUserId()->getName(). ' '.$user->getUserId()->getFName()
                ));
    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    /**
     * @Route("/player/training", name="playerTraining")
     */
    public function TrainingView(\Symfony\Component\HttpFoundation\Request $request, PlayersInjuredRepository $playersInjuredRepo, PlayersRepository $playersRepository)
    {
        $Current = Date('N');
        $DaysToSunday = 7 - $Current;
        $DaysFromMonday = $Current - 1;
        $Monday = Date('d-m-Y', StrToTime("- {$DaysFromMonday} Days"));
        $Sunday = Date('d-m-Y', StrToTime("+ {$DaysToSunday} Days"));

        $player = $this->getUser()->getPlayer();
        $status = new PlayersInjured();
        $form = $this->createForm(PlayersInjuredType::class, $status);
        $form->handleRequest($request);
        $statuses = $this->getDoctrine()->getRepository(PlayersInjured::class)
            ->findBy(['users' =>$player->getId()], ['id' => 'DESC']);

        if ($form->isSubmitted()) {
            $querySuccseesd = $this->setPlayerInjured($player, $statuses, $status, $playersInjuredRepo);;
           return new Response($querySuccseesd);
        }

        $team = $playersRepository->getPlayerTeam($player);
        $coaches = $team->getCoaches();
        $param = $this->getSchedule($coaches);
        $bigCoache = $param[1];
        $schedule = $param[0];

        return $this->render('player/training.html.twig' , array('schedule' => $schedule,
            'monday' => strval($Monday),
            'sunday' => strval($Sunday),
            'profile_img' => $player->getImage(),
            'coaches' => $coaches,
            'bigCoache' =>$bigCoache,
            'status' => $statuses,
            'playerName' => $player->getUserId()->getFName(),
        ));
    }

    /**
     * @Route("/player/deleteStat/{id}", name="playerStatDeleting")
     */
    public function StatRemove($id, \Symfony\Component\HttpFoundation\Request $request)
    {
        $player= $this->getUser()->getPlayer()->getId();
        $stat = $this->getDoctrine()->getRepository(PlayersInjured::class)->find($id);
        if ($stat->getUsers()->getId() != $player)
            return $this->redirectToRoute(playerTraining);

        $em = $this->getDoctrine()->getManager();
        $em->remove($stat);
        $em->flush();
        return 1;
    }



    private function setPlayerInjured($player, $statuses, $status, PlayersInjuredRepository $playersInjuredRepo){
        $checker1 = true;
        $checker2 = true;

        foreach ($statuses as $stat){
            if ($stat->getStartTreatment() >= $status->getStartTreatment()&& $status->getStartTreatment() <= $stat->getEndTreatment()){
                $checker1 = false;
            }
            if ($stat->getEndTreatment() >= $status->getEndTreatment()&& $status->getEndTreatment() <= $stat->getEndTreatment()){
                $checker2 = false;
            }
        }
        if ($checker1 == true && $checker2 == true) {
            $status->setUsers($player);
            $playersInjuredRepo->save($status);
            return 1;
        }else{
            return 2;
        }


    }


    private function getSchedule($coaches){
        $schedule = [];
        foreach ($coaches as $coache){
            if($coache->getTeamPosition()->getId() == 1){
                $bigCoache = $coache;
                $schedule = $bigCoache->getSchedule();
            }else{
                $bigCoache = null;
            }
        }
        $param =[$schedule, $bigCoache,];
        return $param;
    }


    private function playerName($name){
        $time = date('h');

        if ($time >7 && $time < 11){
            return "Добро утро, господин ".$name;
        }else if($time >= 11 && $time< 17){
            return "Добър ден, господин ".$name;
        }

        return "Добър вечер, господин ".$name;
    }

}
