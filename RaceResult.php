<?php

class RaceResult
{
    /**
     * @var array of StepResult
     */
    private $roundResults = [];

    public function getRoundResults(): array
    {
        return $this->roundResults;
    }

    public function setRoundResults($result)
    {
        array_push($this->roundResults, $result);
    }
}
