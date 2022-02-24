<?php
declare(strict_types=1);

use App\Model\Coordinate;
use App\Model\Direction;
use App\Model\Plateau;
use App\Model\Rover;
use App\Service\ServiceInterface;
use DI\ContainerBuilder;

require_once __DIR__ . '/vendor/autoload.php';

if (STDIN) {
    $containerBuilder = new ContainerBuilder();
    $containerBuilder->useAutowiring(true);
    $containerBuilder->addDefinitions(__DIR__.'/config.php');
    $container = $containerBuilder->build();

    $plateauInputLine = fgets(STDIN);
    $plateauBorders = explode(' ', $plateauInputLine);
    validateCoordinate($plateauBorders);
    $plateau = new Plateau(
        new Coordinate(0, 0),
        new Coordinate((int)$plateauBorders[0], (int)$plateauBorders[1])
    );
    $roverSquad = [];
    $commandInput = 0;
    $service = $container->make(ServiceInterface::class, ['plateau' => $plateau]);
    while (($input = fgets(STDIN)) !== false) {
        if ($commandInput === 0) {
            $inputLine = explode(' ', $input);
            validateCoordinate($inputLine);
            $rover = new Rover(
                new Coordinate((int)$inputLine[0], (int)$inputLine[1]),
                new Direction($inputLine[2])
            );
            $roverSquad[] = $rover;
            $commandInput++;
        } elseif ($commandInput == 1) {
            $commands = str_split(trim($input));
            $rover = $roverSquad[count($roverSquad) - 1];
            $service->consume($rover, $commands);
            $roverSquad[count($roverSquad) - 1] = $rover;
            $commandInput = 0;
        }
    }
    foreach ($roverSquad as $key => $rover) {
        $output = $rover->toString();
        if ($key !== count($roverSquad) - 1)
            $output .= "\xA";
        echo  $output;
    }
}

function validateCoordinate(array $coordinate)
{
    if (count($coordinate) >= 2)
    {
        $x = filter_var($coordinate[0], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        $y = filter_var($coordinate[1], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (isset($x) && isset($y)) return; 
    }
    echo 'Invalid coordinate';
    exit;
}