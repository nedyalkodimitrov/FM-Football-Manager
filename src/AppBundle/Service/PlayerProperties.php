<?php

namespace AppBundle\Service;


use AppBundle\Entity\PlayerProperties\WaterGlasses;
use AppBundle\Entity\Teams;
use AppBundle\Entity\YouthTeams;
use AppBundle\Repository\PlayerProperties\WaterGlassesRepository;
use AppBundle\Repository\TeamsRepository;
use AppBundle\Repository\YouthTeamsRepository;


class PlayerProperties implements PlayerPropertiesInterface
{

    private $waterGlassesRepo;
    private $teamRepo;
    private $youthTeam;
    public function __construct(WaterGlassesRepository $waterGlassesRepository, TeamsRepository $teamsRepository, YouthTeamsRepository $youthTeams)
    {
        $this->waterGlassesRepo = $waterGlassesRepository;
        $this->teamRepo = $teamsRepository;
        $this->youthTeam = $youthTeams;

    }

    public function LastWaterRecord($user, $userId){

        $currentDate = Date('Y-m-d');
        $today = date('Y-m-d', strtotime($currentDate));

        $water_glasses = $this->waterGlassesRepo->getWaterGlassesByUserDESC($userId);

        if ($water_glasses == null) {
            $waterTime = 0;
        }else {
            $waterTime = strtotime($water_glasses[0]->getDate());
        }

        $waterDay = date('Y-m-d',$waterTime);
        if ($water_glasses == null || $waterDay < $today ){
            $this->waterGlassesRepo->setWaterGlass($user, $currentDate);
        }

        return  $this->waterGlassesRepo->getLastWaterGlass($userId);

    }


    //Get the team of the player
    public function PlayerTeam($player){

        if($player->getTeam() != null){
            $playerTeam = $player->getTeam();
            $devision = $playerTeam->getDevision();
            $teams = $this->teamRepo->getTeamByDivisionDesc($devision->getId());

        }else {
            $playerTeam = $player->getYouthTeams();
            $devision = $playerTeam->getDivision();
            $teams = $this->youthTeam->getYouthTeamByDivisionDesc($devision->getId());
        }
        $arr = [$devision, $teams, $playerTeam];
        return $arr;
    }
}


