<?php

namespace App\Model;

class Plateau
{
    /**
     * @var Coordinate
     */
    private $lowerLeft;
    /**
     * @var Coordinate
     */
    private $upperRight;

    /**
     * @param Coordinate $upperRightCoordinate
     */
    public function __construct(Coordinate $lowerLeftCoordinate, Coordinate $upperRightCoordinate)
    {
        $this->lowerLeft = $lowerLeftCoordinate;
        $this->upperRight = $upperRightCoordinate;
    }

    /**
     * Get the lower left coordinate
     * @return Coordinate
     */
    public function getLowerLeftCoordinate(): Coordinate
    {
        return $this->lowerLeft;
    }

    /**
     * Get the upper right coordinate
     * @return Coordinate
     */
    public function getUpperRightCoordinate(): Coordinate
    {
        return $this->upperRight;
    }
}