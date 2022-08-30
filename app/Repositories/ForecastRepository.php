<?php

namespace App\Repositories;

use App\Models\ForecastCollection;

interface ForecastRepository
{
    public function getData(): ForecastCollection;
}