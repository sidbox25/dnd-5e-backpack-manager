<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

use \src\Communication\Controller\InventoryController;

include_once __DIR__ . "/../autoload.php";
require_once __DIR__ . '/../vendor/autoload.php';





$jsonComparatorController = new InventoryController();
$jsonComparatorController->showAction();
