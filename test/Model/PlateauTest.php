<?php
declare(strict_types=1);

namespace Test\Model;

use App\Model\Coordinate;
use App\Model\Plateau;
use PHPUnit\Framework\TestCase;
use Test\Traits\ModelMokeryTrait;

class PlateauTest extends TestCase
{
    use ModelMokeryTrait;

    /**
     * @var Coordinate
     */
    private $lowerLeftCoordinate;
    /**
     * @var Coordinate
     */
    private $upperRightCoordinate;
    /**
     * @var Plateau
     */
    private $plateau;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        $this->lowerLeftCoordinate = $this->getCoordinateMock(0, 0);
        $this->upperRightCoordinate = $this->getCoordinateMock(5, 5);
        $this->plateau = new Plateau($this->lowerLeftCoordinate, $this->upperRightCoordinate);
    }

    /**
     * Test that getLowerLeftCoordinate function returns the right value
     */
    public function testThatGetLowerLeftCoordinateReturnsTheRightValue()
    {
        $this->assertEquals($this->lowerLeftCoordinate, $this->plateau->getLowerLeftCoordinate());
    }

    /**
     * Test that getUpperRightCoordinate function returns the right value
     */
    public function testThatGetUpperRightCoordinateReturnsTheRightValue()
    {
        $this->assertEquals($this->upperRightCoordinate, $this->plateau->getUpperRightCoordinate());
    }
}