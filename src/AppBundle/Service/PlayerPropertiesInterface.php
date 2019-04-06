<?php


namespace AppBundle\Service;


use AppBundle\Repository\PlayerProperties\WaterGlassesRepository;

interface PlayerPropertiesInterface
{

     public function LastWaterRecord($user, $userId);

     public function PlayerTeam($player);

}