<?php

namespace App\Models;

class Forecast
{
    private string $time;
    private string $temperature;
    private float $humidity;
    private float $wind;
    private int $cloud;
    private string $icon;

    public function __construct(string $time, float $temperature, float $humidity, float $wind, int $cloud, string $icon)
    {
        $this->time = $time;
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->wind = $wind;
        $this->cloud = $cloud;
        $this->icon = $icon;
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

    public function getCloud(): int
    {
        return $this->cloud;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function getWind(): float
    {
        return $this->wind;
    }

    public function isCurrentHour(): bool
    {
        return date('d H', strtotime($this->getTime())) === date('d H');
    }
}