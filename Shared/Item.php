<?php

namespace Shared;

class Item
{
    private string $name;
    private int $quantity;
    private int $singleValue;

    public function __construct(string $name, int $quantity, int $singleValue)
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->singleValue = $singleValue;
    }

    public function toArray()
    {

        return ["name"=>$this->name, "quantity"=>$this->quantity,"singleValue"=>$this->singleValue];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Item
    {
        $this->name = $name;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): Item
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getSingleValue(): int
    {
        return $this->singleValue;
    }

    public function setSingleValue(int $singleValue): Item
    {
        $this->singleValue = $singleValue;
        return $this;
    }

    public function getTotalValue(): int
    {
        return $this->singleValue * $this->quantity;
    }
}
