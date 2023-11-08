<?php

namespace Shared;

class Item
{
    private string $name;
    private int $quantity;
    private int $totalValue;

    public function __construct(string $name, int $quantity, int $totalValue)
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->totalValue = $totalValue;
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

    public function getTotalValue(): int
    {
        return $this->totalValue;
    }

    public function setTotalValue(int $totalValue): Item
    {
        $this->totalValue = $totalValue;
        return $this;
    }
}
