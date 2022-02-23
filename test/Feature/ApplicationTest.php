<?php

namespace App\Invoker;

use Exception;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    /**
     * Test that application output is correct
     */
    public function testThatApplicationOutputIsCorrect()
    {
        $output = shell_exec('php index.php < stdin_pass.txt');
        $this->assertSame("1 3 N\n5 1 E", $output);  
    }

    /**
     * Test that application output error message if coordinate aren't valid
     */
    public function testThatApplicationOutputErrorMessageIfCoordinateAreNotValid()
    {
        $output = shell_exec('php index.php < stdin_fail.txt');
        $this->assertSame('Invalid coordinate', $output);  
    }
}