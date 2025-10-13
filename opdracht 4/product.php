<?php

abstract class Product {
    protected string $naam;
    protected float $inkoopprijs;
    protected float $btw;
    protected string $omschrijving;

    public function __construct(string $naam, float $inkoopprijs, float $btw, string $omschrijving) {
        $this->naam = $naam;
        $this->inkoopprijs = $inkoopprijs;
        $this->btw = $btw;
        $this->omschrijving = $omschrijving;
    }

    public function getNaam(): string {
        return $this->naam;
    }

    public function getVerkoopPrijs(): float {
        $winst = $this->inkoopprijs * 0.30;
        return $this->inkoopprijs + $winst + ($this->inkoopprijs * $this->btw);
    }

    abstract public function getProductInfo(): string;
}
