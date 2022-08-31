<?php

namespace App\Repositories;

use App\Models\Forecast;
use App\Models\ForecastCollection;
use GuzzleHttp\Client;

class ForecastAPIRepository implements ForecastRepository
{
    public function getData(string $city): ForecastCollection
    {
        $client = new Client([
            'base_uri' => $_ENV['FORECAST_API']
        ]);

        $response = $client->get('/v1/forecast.json', [
            'query' => [
                'key' => $_ENV['FORECAST_API_KEY'],
                'q' => $city,
                'days' => 1,
                'aqi' => 'no',
                'alerts' => 'no'
            ]
        ]);

        $forecast = json_decode($response->getBody());
        $weatherForecast = [];
        foreach ($forecast->forecast->forecastday[0]->hour as $hourlyForecast) {
            $weatherForecast [] = new Forecast(
                $hourlyForecast->time,
                $hourlyForecast->temp_c,
                $hourlyForecast->humidity,
                $hourlyForecast->wind_kph,
                $hourlyForecast->cloud,
                $hourlyForecast->condition->icon
            );
        }
        return new ForecastCollection($weatherForecast);
    }
}