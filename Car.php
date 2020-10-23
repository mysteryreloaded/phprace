<?php

class Car
{
    public $straightSpeed;
    public $curveSpeed;
    public $position;
    
    public function __construct()
    {
        $this->straightSpeed = rand(4, 18);
        $this->curveSpeed = 22 - $this->straightSpeed;
        $this->position = 0;
    }
}
