<?php

namespace Test\Model;

use PHPUnit\Framework\TestCase;

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
        $this->assertEquals($this->x, $this->coordinate->getX());
    }

    /**
     * Test that getY function returns the right value of Y
     */
    public function testThatGetYReturnsTheRightValue()
    {
        $this->assertEquals($this->y, $this->coordinate->getY());
    }

    /**
     * Test that setX function changes the value of X
     */
    public function testThatSetXChangesTheValueOfX()
    {
        $this->coordinate->setX($this->x + 1);
        $this->assertEquals($this->x + 1 , $this->coordinate->getX());
    }

    /**
     * Test that setY function changes the value of Y
     */
    public function testThatSetYChangesTheValueOfY()
    {
        $this->coordinate->setY($this->y + 1);
        $this->assertEquals($this->Y + 1 , $this->coordinate->getY());
    }
}