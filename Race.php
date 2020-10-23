<?php
include 'Car.php';
include 'RaceResult.php';
include 'RoundResult.php';

class Race
{
    public $track;
    public $isFinished;
    public $car;
    public $raceResult;
     
    function __construct() 
    {
        for ($i = 0; $i < 2000; $i = $i + 40) {
            if (rand(0, 1) == 1) {
                for ($j = $i; $j < $i + 40; $j++) {
                    $this->track[$j] = "straight";
                }
            } else {
                for ($j = $i; $j < $i + 40; $j++) {
                    $this->track[$j] = "curve";
                }
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $this->car[$i] = new Car();
        }

        $this->isFinished = false;
        $this->raceResult = new RaceResult();
    }

    public function race(): RaceResult
    {
        while(!$this->isFinished) {
            $this->round();
        }

        return $this->raceResult;
    }

    public function round()
    {
        $carsPosition = [];
        foreach ($this->car as $index => $car) {
            switch ($this->track[$car->position + 1]) {
                case 'straight':
                    $roundDestination = $car->position + $car->straightSpeed;
                    if ($roundDestination > 1000) {
                        $roundDestination = 1000;
                    }
                    if ($this->track[$roundDestination] == "straight") {
                        $car->position = $roundDestination;
                        array_push($carsPosition, $roundDestination);
                    } else {
                        for ($i = $roundDestination; $i > $car->position; $i--) {
                            if($this->track[$i] == 'straight') {
                                $car->position = $i;
                                array_push($carsPosition, $i);
                            }
                        }
                    }
                    break;
                
                case 'curve':
                    $roundDestination = $car->position + $car->curveSpeed;
                    if ($roundDestination > 1000) {
                        $roundDestination = 1000;
                    }
                    if ($this->track[$roundDestination] == "curve") {
                        $car->position =$roundDestination;
                        array_push($carsPosition,$roundDestination);
                    } else {
                        for ($i = $roundDestination; $i > $car->position; $i--) {
                            if($this->track[$i] == 'curve') {
                                $car->position = $i;
                                array_push($carsPosition, $i);
                            }
                        }
                    }
                    break;
            }
            if ($car->position == 1000) {
                $this->isFinished = true;
            }
        }

        $roundResult = new RoundResult(count($this->raceResult->getRoundResults()), $carsPosition);
        $this->raceResult->setRoundResults($roundResult);
    }
}

// Only run this when executed on the commandline
if (php_sapi_name() == 'cli') {
    $obj = new Race();
    $obj->race();
    print_r($obj->raceResult);
}
