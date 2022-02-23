<?php

namespace App\Model;

class Coordinate
{
    /**
     * @var int
     */
    private $x;
    /**
     * @var int
     */
    private $y;

    /**
     * Set the coordinate X, Y attributes
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Get X attribute
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * Get Y attribute
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * Set X attribute
     * @param int $x
     */
    public function setX(int $x)
    {
        $this->x = $x;
    }

    /**
     * Set Y attribute
     * @param int $y
     */
    public function setY(int $y)
    {
        $this->y = $y;
    }
}