<?php

namespace App\Controllers;

use App\Services\ForecastService;
use App\View;

class ForecastController
{
    private ForecastService $forecastService;

    public function __construct(ForecastService $forecastService)
    {
        $this->forecastService = $forecastService;
    }

    public function show(): View
    {
        return new View ('forecast.twig', ['forecast' => $this->forecastService->execute()->getForecast()]);
    }
}