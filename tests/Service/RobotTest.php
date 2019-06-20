<?php

namespace App\Tests\Service;

use App\Service\Robot;
use PHPUnit\Framework\TestCase;

class RobotTest extends TestCase
{
    /**
     * @param string $instruction
     * @param array $expectation
     * @dataProvider executeProvider
     */
    public function testExecute(string $instruction, array $expectation)
    {
        $obj = new Robot();

        $this->assertSame($obj->__toString(), sprintf("X: %d Y: %d Direction: %s", 0, 0, 'North'));
        $obj->execute($instruction);

        $this->assertSame($obj->__toString(), sprintf("X: %d Y: %d Direction: %s", ...$expectation));
    }

    /**
     * @return array
     */
    public function executeProvider() : array
    {
        return [
            ['RW15', [15, 0, Robot::DIRECTION[Robot::EAST]]],
            ['RW15RW1', [15, -1, Robot::DIRECTION[Robot::SOUTH]]],
//            ['W5RW5RW2RW1R', [4, 3, Robot::DIRECTION[Robot::NORTH]]],
//            ['RRW11RLLW19RRW12LW1', [7, -12, Robot::DIRECTION[Robot::SOUTH]]],
//            ['LLW100W50RW200W10', [-210, -150, Robot::DIRECTION[Robot::WEST]]],
//            ['LLLLLW99RRRRRW88LLLRL', [-99, 88, Robot::DIRECTION[Robot::EAST]]],
//            ['W55555RW555555W444444W1', [1000000, 55555, Robot::DIRECTION[Robot::EAST]]],
        ];
    }

}