<?php

namespace App\Controllers;

use App\Services\ForecastService;
use App\View;

class ForecastController
{
    private ForecastService $forecastService;

    private string $city;

    public function __construct(ForecastService $forecastService)
    {
        $this->forecastService = $forecastService;
    }

    public function show(): View
    {
        return new View ('forecast.twig', [
            'forecast' => $this->forecastService->execute()->getForecast(),
            'city' => $_SESSION['city']
        ]);
    }

    public function city(): void
    {
        $request = preg_replace("/[^A-Za-z0-9 ]/", '', $_REQUEST['city']);

        if ($_POST['city']) {
            $this->city = $request;
        } elseif ($_POST['city'] == '') {
            $this->city = 'Riga';
        }

        $_SESSION['city'] = $this->getCity();
        header('Location: /forecast');
    }

    public function getCity(): string
    {
        return $this->city;
    }
}