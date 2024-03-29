<?php

namespace Shared;

class Character
{
    private string $name;
    private int $strength;
    /**
     * @var array<\Shared\Container>
     */
    private array $containers;
    private int $caringCapacity;

    public function __construct(string $name, int $strength, array $containers = [])
    {
        $this->name = $name;
        $this->strength = $strength;
        $this->containers = $containers;
    }

    public function save(){

    }


    public function toArray()
    {
        $containersArr = [];
        foreach ($this->containers as $name => $container){
            $containersArr[$name] = $container->toArray();
        }

        return ["name"=>$this->name, "strength"=>$this->strength,"containers"=>$containersArr];
    }



    /**
     * @param string $name
     * @param string $type
     * @param int $capacity
     * @param array $content
     *
     * @return int
     * @description 0 = container successfully added, 1 = container already exists
     */
    public function addContainer(string $name, string $type, int $capacity,array $content = []):int
    {
        if (!isset($this->containers[$name])) {
            $this->containers[$name] = new Container($name, $type, $capacity, $content);
            return 0;
        }
        return 1;
    }


    /**
     * @param string $name
     *
     * @return int
     * @description 0 = container successfully removed, 1 = container was not found
     */
    public function removeContainerByName(string $name):int
    {
        if (isset($this->$containers[$name])) {
            unset($this->$containers[$name]);
            return 0;
        }
        return 1;
    }

    /**
     * @return void
     */
    public function removeAllContainers():void
    {
        $this->containers = array();
    }



    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Character
    {
        $this->name = $name;
        return $this;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): Character
    {
        $this->strength = $strength;
        return $this;
    }

    /**
     * @return array<Container>
    */
    public function getContainers(): array
    {
        return $this->containers;
    }

    public function getContainer($name): Container
    {
        return $this->containers[$name];
    }

    public function setContainers(array $containers): Character
    {
        $this->containers = $containers;
        return $this;
    }

    public function getContainersFromArray(array $containers): Character
    {
        foreach ($containers as $container){
            $this->addContainer($container["name"], $container["type"],$container["capacity"]);
            $this->getContainer($container["name"])->getItemsFromArray($container["items"]);
        }

        return $this;
    }
}
