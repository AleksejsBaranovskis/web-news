<?php

namespace App\Repositories;

use App\Models\Forecast;
use App\Models\ForecastCollection;
use GuzzleHttp\Client;

class ForecastAPIRepository implements ForecastRepository
{
    public function getData(): ForecastCollection
    {
//        $client = new Client([
//            'base_uri' => $_ENV['FORECAST_API']
//        ]);
        $client = new Client();
        $response = $client->get('http://api.weatherapi.com/v1/forecast.json?key=7d7ce322474a478d8ed85730222107&q=Riga&days=1&aqi=no&alerts=no');

//        $response = $client->get('/v1/forecast.json', [
//            'query' => [
//                'key' => $_ENV['FORECAST_API_KEY'],
//                'q' => 'Riga',
//                'days' => 1,
//                'aqi' => 'no',
//                'alerts' => 'no'
//            ]
//        ]);

        $forecast = json_decode($response->getBody());
        $weatherForecast= [];
        foreach ($forecast->forecast->forecastday[0]->hour as $hourlyForecast) {
            $weatherForecast [] = new Forecast(
                $hourlyForecast->time,
                $hourlyForecast->temp_c,
                $hourlyForecast->humidity,
            );
        }
        return new ForecastCollection($weatherForecast);
    }
}