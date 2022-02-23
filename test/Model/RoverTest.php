<?php

namespace App\Model;

class Rover
{
    /**
     * @var Coordinate
     */
    private $coordinate;
    /**
     * @var Direction
     */
    private $direction;

    /**
     * @param Coordinate $coordinate
     * @param Direction $direction
     */
    public function __construct(Coordinate $coordinate, Direction $direction)
    {
        $this->coordinate = $coordinate;
        $this->direction = $direction;
    }

    /**
     * Get coordinate
     * @return Coordinate
     */
    public function getCoordinate(): Coordinate
    {
        return $this->coordinate;
    }

    /**
     * Get direction
     * @return Direction
     */
    public function getDirection(): Direction
    {
        return $this->direction;
    }

    /**
     * Set direction
     * @param Direction $direction
     */
    public function setDirection(Direction $direction)
    {
        $this->direction = $direction;
    }

    /**
     * Set coordinate
     * @param Coordinate $coordinate
     */
    public function setCoordinate(Coordinate $coordinate)
    {
        $this->coordinate = $coordinate;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->coordinate->getX() . ' ' .
            $this->coordinate->getY() . ' ' .
            $this->direction->getOrientation();
    }
}