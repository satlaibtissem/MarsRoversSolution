<?php

namespace App\Model;

use App\Data\DirectionTypes;
use ReflectionClass;

class Direction
{
    /**
     * @var string
     */
    private $orientation;

    /**
     * @param string $orientation
     */
    public function __construct(string $orientation)
    {
        $orientation = trim($orientation);
        $this->validateOrientation($orientation);
        $this->orientation = $orientation;
           
    }

    /**
     * Get Orientation
     * @return string
     */
    public function getOrientation(): string
    {
        return $this->orientation;
    }

    /** Check if it's a valid orientation
     * @param string $orientation
     * @throws Exception
     */
    private function validateOrientation(string $orientation)
    {
        $supportedDirections = (new ReflectionClass(DirectionTypes::class))->getConstants();
        if (!in_array(
            $orientation,
            $supportedDirections,
            true)
        )
            throw new \Exception('Invalid Orientation: ' . $orientation);
    }
}