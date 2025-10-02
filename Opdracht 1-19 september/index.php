<?php
class House {
    // Properties (private)
    private int $floors;
    private int $rooms;
    private float $width;
    private float $height;
    private float $depth;

    // Constant price per m³
    private const PRICE_PER_M3 = 1500;

    // Constructor
    public function __construct(int $floors, int $rooms, float $width, float $height, float $depth) {
        $this->floors = $floors;
        $this->rooms = $rooms;
        $this->width = $width;
        $this->height = $height;
        $this->depth = $depth;
    }

    // Setters
    public function setFloors(int $floors): void { $this->floors = $floors; }
    public function setRooms(int $rooms): void { $this->rooms = $rooms; }
    public function setWidth(float $width): void { $this->width = $width; }
    public function setHeight(float $height): void { $this->height = $height; }
    public function setDepth(float $depth): void { $this->depth = $depth; }

    // Getters
    public function getFloors(): int { return $this->floors; }
    public function getRooms(): int { return $this->rooms; }
    public function getWidth(): float { return $this->width; }
    public function getHeight(): float { return $this->height; }
    public function getDepth(): float { return $this->depth; }

    // Calculate volume
    public function calculateVolume(): float {
        return $this->width * $this->height * $this->depth;
    }

    // Calculate price
    public function calculatePrice(): float {
        return $this->calculateVolume() * self::PRICE_PER_M3;
    }

    // Show details
    public function showDetails(): void {
        echo "🏠 House details:<br>";
        echo "Floors: " . $this->getFloors() . "<br>";
        echo "Rooms: " . $this->getRooms() . "<br>";
        echo "Width: " . $this->getWidth() . " m<br>";
        echo "Height: " . $this->getHeight() . " m<br>";
        echo "Depth: " . $this->getDepth() . " m<br>";
        echo "Volume: " . $this->calculateVolume() . " m³<br>";
        echo "Price: €" . number_format($this->calculatePrice(), 2, ',', '.') . "<br><br>";
    }
}

// Create 3 objects
$house1 = new House(2, 5, 8.0, 6.0, 10.0);
$house2 = new House(3, 8, 12.0, 8.0, 15.0);
$house3 = new House(1, 3, 6.0, 4.0, 9.0);

// Show details
$house1->showDetails();
$house2->showDetails();
$house3->showDetails();
?>