<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherController extends Controller
{
    public function getWeather()
    {
        $apiKey = config('services.weather.key');

        $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q=Kuressaare&units=metric&appid={$apiKey}";

        $cacheKey = 'weather_data_kuressaare';

        if (Cache::has($cacheKey)) {
            $weatherData = Cache::get($cacheKey);
        } else {
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                $weatherData = $response->json();
                Cache::put($cacheKey, $weatherData, now()->addHour());
            } else {
                Log::error('Failed to fetch weather data from the API. Response: '.$response->body());
                $errorDetails = [
                    'message' => 'Failed to fetch weather data.',
                    'details' => $response->json() ?? 'No additional information available.',
                ];

                return view('error', compact('errorDetails'));
            }
        }

        return view('weather.weather', compact('weatherData'));
    }
}