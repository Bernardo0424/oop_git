<?php
require_once 'Product.php';

class Game extends Product {
    private string $genre;
    private string $minHardware;

    public function __construct(string $naam, float $inkoopprijs, float $btw, string $omschrijving, string $genre, string $minHardware) {
        parent::__construct($naam, $inkoopprijs, $btw, $omschrijving);
        $this->genre = $genre;
        $this->minHardware = $minHardware;
    }

    public function getProductInfo(): string {
        return "Genre: {$this->genre}, Min. hardware: {$this->minHardware}";
    }
}
