<?php

namespace src\Communication\Controller;

use Shared\Container;
use Shared\Item;
use src\Business\BusinessFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class InventoryController
{

    /**
     * @return void
     * @throws \Swaggest\JsonDiff\Exception
     */
    public function showAction()
    {
        $businessFactory = new BusinessFactory();
        $PossessionsManager = $businessFactory->CreatePossessionsManager();


        echo $this->getView(
            __DIR__ . "/../../Presentation/",
            "views/json.comparator.main.layout.twig",
            [
                'characters' => $PossessionsManager->getData(),
            ]
        );
    }

    /**
     * @param string $path
     * @param string $twigFileName
     * @param array $filling
     *
     * @return string
     */
    private function getView(string $path, string $twigFileName, array $filling): string
    {
        $loader = new FilesystemLoader($path);

        return (new Environment($loader))->render($twigFileName, $filling);
    }
}
