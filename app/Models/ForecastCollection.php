<?php

namespace App\Models;

class ForecastCollection
{
    private array $forecast;

    public function __construct(array $forecast)
    {
        foreach ($forecast as $forecastData) {
            $this->addForecastData($forecastData);
        }
        $this->forecast = $forecast;
    }

    public function addForecastData(Forecast $forecast): void
    {
        $this->forecast[] = $forecast;
    }

    public function getForecast(): array
    {
        return $this->forecast;
    }
}