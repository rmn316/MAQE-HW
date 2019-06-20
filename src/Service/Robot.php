<?php

namespace App\Service;

use \InvalidArgumentException;

class Robot
{
    const NORTH = 0;
    const EAST = 90;
    const SOUTH = 180;
    const WEST = 270;

    /**
     * Direction array map as strings
     */
    const DIRECTION = [
        self::NORTH => 'North',
        self::EAST => 'East',
        self::SOUTH => 'South',
        self::WEST => 'West'
    ];

    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * @var string
     */
    private $direction;

    public function __construct()
    {
        $this->x = 0;
        $this->y = 0;
        $this->direction = static::NORTH;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return sprintf('X: %d Y: %d Direction: %s', $this->x, $this->y, static::DIRECTION[$this->direction]);
    }

    /**
     * @param $instructions
     * @throws InvalidArgumentException
     */
    public function execute($instructions)
    {
        for ($i = 0; $i<strlen($instructions); $i++) {
            switch ($instructions[$i]) {
                case 'L':
                    $this->turnLeft();
                    break;
                case 'R':
                    $this->turnRight();
                    break;
                case 'W':
                    // split on chars to get array of int (spaces to move).
                    $matches = preg_split('/[A-Z]/', substr($instructions, $i));
                    if ($matches) {
                        $this->walk((int)$matches[1]);
                        $i += strlen($matches[1]); // move the loop passed the walking instructions...
                    }
                    break;
                default:
                    throw new InvalidArgumentException('Unexpected instruction received');
            }
        }
    }

    /**
     * Turn the robot left by 90 degrees.
     */
    private function turnLeft()
    {
        if ($this->direction === 0) {
            $this->direction = 270;
        } else {
            $this->direction -= 90;
        }
    }

    /**
     * Turn the robot right by 90 degrees.
     */
    private function turnRight()
    {
        if ($this->direction === 270) {
            $this->direction = 0;
        } else {
            $this->direction += 90;
        }
    }

    /**
     * @param int $spaces
     */
    private function walk(int $spaces) : void
    {
        switch ($this->direction) {
            case static::NORTH :
                $this->y += $spaces;
                break;
            case static::EAST :
                $this->x += $spaces;
                break;
            case static::SOUTH :
                $this->y -= $spaces;
                break;
            case static::WEST :
                $this->x -= $spaces;
                break;
            default:
                throw new InvalidArgumentException('Unexpected argument for current direction');
        }
    }
}
