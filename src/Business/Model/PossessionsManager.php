<?php

namespace src\Business\Model;

use Shared\Character;
use src\Persistence\Data;

class PossessionsManager
{


    const CHARACTER_NAME = "characterName";
    const BAG_NAME = "bagName";
    const ITEM_NAME = "itemName";

    /**
     * @var array<Character>
     */
    private array $data;

    public function __construct()
    {
        $this->data = $this->getRawData();
    }



    public function getData():array
    {
        $this->checkForButtonPress();

        return $this->data;
    }


    /**
     * @return array<String,Character>
     */
    private function getRawData(): array
    {
        $Racknar = new Character("Racknar",15);
        $campaign["Racknar"] = $Racknar;

        $Racknar->addContainer("backpack","backpack",45);

        $Racknar->getContainer("backpack")->addItem("rations",10,1);
        $Racknar->getContainer("backpack")->addItem("arrows",20,1);
        $Racknar->getContainer("backpack")->addItem("bolt",20,1);
        $Racknar->getContainer("backpack")->addItem("sword",1,15);

        $Racknar->addContainer("pouch","pouch",10);
        $Racknar->getContainer("pouch")->addItem("herbs",10,15);


        $mosis = new Character("mosis",15);
        $campaign["mosis"] = $mosis;
        $mosis->addContainer("backpack","backpack",45);

        $mosis->getContainer("backpack")->addItem("rations",10,1);
        $mosis->getContainer("backpack")->addItem("arrows",20,1);
        $mosis->getContainer("backpack")->addItem("bolt",20,1);
        $mosis->getContainer("backpack")->addItem("sword",1,15);

        $mosis->addContainer("pouch","pouch",10);
        $mosis->getContainers()["pouch"]->addItem("herbs",10,15);

        $campaignArr = [];
        foreach ($campaign as $name => $character){
            $campaignArr[$name] = $character->toArray();
        }

        $temp = json_encode($campaignArr,True);
        Data::saveCampaign($campaign);

        $otherCampaign = [];
        foreach (json_decode($temp,true) as $name => $character){
            $otherCampaign[$name] = new Character($character["name"],$character["strength"]);
            $otherCampaign[$name]->getContainersFromArray($character["containers"]);
        }
        return $campaign;
    }
    /**
     * @param array $path
     *
     * @return array
     */
    private function addItemQuantity(array $path)
    {
        $this->data[$path[self::CHARACTER_NAME]]
            ->getContainer($path[self::BAG_NAME])
            ->addAmountFromItem($path[self::ITEM_NAME],1);
    }

    private function removeItemQuantity(array $path)
    {
        $this->data[$path[self::CHARACTER_NAME]]
            ->getContainer($path[self::BAG_NAME])
            ->removeAmountFromItem($path[self::ITEM_NAME],1);
    }

    private function checkForButtonPress(){
        foreach (array_keys($_POST) as $post){
            $explodedPost = explode("-",$post);
            if ($explodedPost[0] == "btn"){

                $path =
                    [self::CHARACTER_NAME => $explodedPost[2],
                        self::BAG_NAME => $explodedPost[3],
                        self::ITEM_NAME => $explodedPost[4]];

                if ($explodedPost[1] == "add"){
                    $this->addItemQuantity($path);
                }
                if ($explodedPost[1] == "remove"){
                    $this->removeItemQuantity($path);
                }
            }
        }
    }
}
