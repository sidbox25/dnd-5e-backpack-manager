<?php

namespace src\Persistence;

use PDO;
use Shared\Character;
use src\Core\Connector;

class data
{

    private const TABLES = [ #todo doesnt work
        "Saves"=> "dnd5eItemManager.Saves",
        "Campaigns" => "dnd5eItemManager.Campaigns",
    ];

    /**
     * @var array<String,int>
     */
    public const CAMPAIGN = [
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

        $stm = $connection->prepare("INSERT INTO dnd5eItemManager.Saves (`CampaignsID`, `Json`) VALUES (:campaignId, :json);");
        $stm->bindValue("campaignId", Data::CAMPAIGN["epichtröm2"],PDO::PARAM_INT);
        $stm->bindValue("json", $JsonString);
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
        $stm = $connection->prepare("SELECT (campainId,Json) FROM dnd5eItemManager.Saves WHERE campainId = :campainId ");
        $stm->bindValue("campaignId", Data::CAMPAIGN[$Campaign]);
        $stm->execute();

        return $stm;
    }

    /**
     * @param String $CampaignID
     *
     * @return String
     */
    static function getLastDataPreProcessing(String $CampaignID): String|null
    {
        $connection = Connector::getConnection();
        $stm = $connection->prepare("SELECT (Json) FROM dnd5eItemManager.Saves
            WHERE CampaignsID = :campaignId ORDER BY save_date DESC LIMIT 1");
        $stm->bindValue("campaignId", $CampaignID);
        $stm->execute();
        if (!empty($stm->fetch())){
            $result = $stm->fetch()["Json"];
        } else {
            $result = null;
        }
        $test = !empty($stm->fetch()) ? 1 : null;#todo Why not work
        return $result;
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
        $stm = $connection->prepare("INSERT INTO dnd5eItemManager.Campaigns (`name`, `description`) VALUES (:name, :description); ");
        $stm->bindValue("Campaigns",Data::TABLES["Campaigns"]);
        $stm->bindValue("name", $campaignName);
        $stm->bindValue("description", $campaignDescription ? $campaignDescription==="": NULL);
        return $stm->execute();
    }

}
