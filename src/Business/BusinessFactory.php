<?php

namespace src\Business;

use src\Business\Model\PossessionsManager;

class BusinessFactory
{
    public function CreatePossessionsManager():PossessionsManager
    {
        return new PossessionsManager();
    }
}
