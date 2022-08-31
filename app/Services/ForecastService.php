<?php

namespace App\Services;

use App\Models\ForecastCollection;
use App\Repositories\ForecastRepository;

class ForecastService
{
    private ForecastRepository $forecastRepository;

    public function __construct(ForecastRepository $forecastRepository)
    {
        $this->forecastRepository = $forecastRepository;
    }

    public function execute(string $city): ForecastCollection
    {
        return $this->forecastRepository->getData($city);
    }
}