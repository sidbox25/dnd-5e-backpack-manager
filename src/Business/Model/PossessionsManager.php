<?php

namespace src\Business\Model;

use Shared\Character;
use Shared\Item;

class PossessionsManager
{



    public function getData():array
    {

        $temp = new Character("Racknar",15);

        $temp->addContainer("backpack","backpack",45);

        $temp->getContainers()["backpack"]->addItem("rations",10,1);
        $temp->getContainers()["backpack"]->addItem("arrows",20,1);
        $temp->getContainers()["backpack"]->addItem("bolt",20,1);
        $temp->getContainers()["backpack"]->addItem("sword",1,15);

        $temp->addContainer("pouch","pouch",10);
        $temp->getContainers()["pouch"]->addItem("herbs",10,15);



        return [$temp];
    }
}
