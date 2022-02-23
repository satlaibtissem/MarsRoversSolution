<?php

namespace Test\Model;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class CoordinateTest extends TestCase
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
     * @var Coordinate
     */
    private $coordinate;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        $this->x = 5;
        $this->y = 5;
        $this->coordinate = new Coordinate($this->x, $this->y);
    }

    /**
     * Test that getX function returns the right value of X
     */
    public function testThatGetXReturnsTheRightValue()
    {
        assertEquals($this->x, $this->coordinate->getX());
    }

    /**
     * Test that getY function returns the right value of Y
     */
    public function testThatGetYReturnsTheRightValue()
    {
        assertEquals($this->y, $this->coordinate->getY());
    }

    /**
     * Test that setX function changes the value of X
     */
    public function testThatSetXChangesTheValueOfX()
    {
        $this->coordinate->setX($this->x + 1);
        assertEquals($this->x + 1 , $this->coordinate->getX());
    }

    /**
     * Test that setY function changes the value of Y
     */
    public function testThatSetYChangesTheValueOfY()
    {
        $this->coordinate->setY($this->y + 1);
        assertEquals($this->Y + 1 , $this->coordinate->getY());
    }
}