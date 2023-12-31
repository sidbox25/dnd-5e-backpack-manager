<?php

namespace src\Persistence;

use Shared\Character;
use src\Core\Connector;

class data
{

    private const TABLES = [
        "Saves"=> "dnd5eItemManager.Saves",
        "Campaigns" => "dnd5eItemManager.Campaigns",
    ];

    /**
     * @var array<String,int>
     */
    private const CAMPAIGN = [
        "epichtröm2"=>1
    ];#todo is there a better way?


    /**
     * @param array<String,Character> $campaign
     *
     * @return bool
     */
    static function saveCampaign(array $campaign):bool
    {
        $JsonString = json_encode($campaign);

        $connection = Connector::getConnection();

        $stm = $connection->prepare("INSERT INTO :save (`CampaignsID`, `Json`)VALUES (:campaignId, :json);");
        $stm->bindValue("saves",Data::TABLES["Saves"]);
        $stm->bindValue("json", $JsonString);
        $stm->bindValue("campaignId", Data::CAMPAIGN["epichtröm2"]);
        return $stm->execute();
    }

    /**
     * @param String $Campaign
     *
     * @return false|\PDOStatement
     */
    static function getAllDataPreProcessing(String $Campaign): false|\PDOStatement
    {
        $connection = Connector::getConnection();
        $stm = $connection->prepare("SELECT (campainId,Json) FROM :saves WHERE campainId = :campainId ");
        $stm->bindValue("saves",Data::TABLES["Saves"]);
        $stm->bindValue("campaignId", Data::CAMPAIGN[$Campaign]);
        $stm->execute();

        return $stm;
    }

    /**
     * @param String $Campaign
     *
     * @return false|\PDOStatement
     */
    static function getLastDataPreProcessing(String $Campaign): false|\PDOStatement
    {
        $connection = Connector::getConnection();
        $stm = $connection->prepare("SELECT (campainId,Json) FROM :saves WHERE campainId = :campainId");#todo only get the last valid campain
        $stm->bindValue("saves",Data::TABLES["Saves"]);
        $stm->bindValue("campaignId", Data::CAMPAIGN[$Campaign]);
        $stm->execute();

        return $stm;
    }

    /**
     * @param String $Campaign
     *
     * @return void
     */
    static function getData(String $Campaign)
    {
        $rawData = Data::getAllDataPreProcessing($Campaign)->fetch();

        return json_decode($rawData['Json'],true);
    }

    static function createCampaign(String $campaignName, String $campaignDescription)
    {
        $connection = Connector::getConnection();
        $stm = $connection->prepare("INSERT INTO :Campaigns (`name`, `description`) VALUES (:name, :description); ");
        $stm->bindValue("Campaigns",Data::TABLES["Campaigns"]);
        $stm->bindValue("name", $campaignName);
        $stm->bindValue("description", $campaignDescription ? $campaignDescription==="": NULL);
        return $stm->execute();
    }

}
