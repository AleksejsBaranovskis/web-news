<?php

namespace App\Models;

class Forecast
{
    private string $time;
    private string $temperature;
    private float $humidity;

    public function __construct(string $time, float $temperature, float $humidity)
    {
        $this->time = $time;
        $this->temperature = $temperature;
        $this->humidity = $humidity;
    }

    public function getHumidity(): float
    {
        return $this->humidity;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getTime(): string
    {
        return $this->time;
    }

}