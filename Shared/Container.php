<?php

namespace Shared;

class Container
{
    private string $type;
    private int $capacity;
    /**
     * @var array<\Shared\Item>
     */
    private array $items;
    private string $name;

    /**
     * @param string $type
     * @param int $capacity
     * @param array $items
     */
    public function __construct(string $name, string $type, int $capacity,array $items = [])
    {
        $this->type = $type;
        $this->capacity = $capacity;
        $this->items = $items;
        $this->name = $name;
    }


    public function save(){

    }


    /**
     * @param string $name
     * @param int $quantity
     * @param int $value
     *
     * @return int
     * @description 0 = item successfully added, 1 = item already exists
     */
    public function addItem(string $name, int $quantity, int $value):int
    {
        if (!isset($this->items[$name])) {
            $this->items[$name] = new Item($name, $quantity, $value);
            return 0;
        }
        return 1;
    }

    /**
     * @param string $name
     *
     * @return int
     * @description 0 = item successfully removed, 1 = item was not found
     */
    public function removeItemByName(string $name):int
    {
        if (isset($this->items[$name])) {
            unset($this->items[$name]);
            return 0;
        }
        return 1;
    }

    public function removeAmountFromItem(string $name, int $amount):int
    {
        if (isset($this->items[$name])) {
            if ($this->items[$name]->getQuantity() <=1)
            {
                $this->removeItemByName($name);
                return 0;
            }
            $this->items[$name]->setQuantity($this->items[$name]->getQuantity()-1);
            return 0;
        }
        return 1;
    }

    public function addAmountFromItem(string $name, int $amount):int
    {
        if (isset($this->items[$name])) {
            $this->items[$name]->setQuantity($this->items[$name]->getQuantity()+1);
            return 0;
        }
        return 1;
    }

    /**
     * @return void
     */
    public function removeAllItems():void
    {
        $this->items = array();
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): Container
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array<Item>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getItem($name): Item
    {
        return $this->items[$name];
    }
    public function setItems(array $items): Container
    {
        $this->items = $items;
        return $this;
    }
    public function getType(): string
    {
        return $this->type;
    }
    public function setType(string $type): Container
    {
        $this->type = $type;
        return $this;
    }
    public function getCapacity(): int
    {
        return $this->capacity;
    }
    public function setCapacity(int $capacity): Container
    {
        $this->capacity = $capacity;
        return $this;
    }
}
