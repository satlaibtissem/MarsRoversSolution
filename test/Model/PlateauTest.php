<?php
declare(strict_types=1);

namespace Test\Model;

use App\Model\Coordinate;
use App\Model\Plateau;
use PHPUnit\Framework\TestCase;


class PlateauTest extends TestCase
{

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
        $this->lowerLeftCoordinate = $this->getCoordinateMock();
        $this->upperRightCoordinate = $this->getCoordinateMock();
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

    /**
     * Mock Coordinate object
     * @return Coordinate
     */
    private function getCoordinateMock(): Coordinate
    {
        $coordinate = \Mockery::mock(Coordinate::class);
        return $coordinate;
    }
}