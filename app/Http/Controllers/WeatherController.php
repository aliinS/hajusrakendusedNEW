<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function getWeather()
    {
        // Replace 'YOUR_API_KEY' with your OpenWeather API key
        $apiKey = env('WEATHER_API_KEY');
        
        // Create a new Guzzle client instance
        $client = new Client();

        // API endpoint URL with your desired location and units (e.g., London, Metric units)
        $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q=Kuressaare&units=metric&appid={$apiKey}";

        try {
            // Make a GET request to the OpenWeather API
            $response = $client->get($apiUrl);

            // Get the response body as an array
            $data = json_decode($response->getBody(), true);

            // Handle the retrieved weather data as needed (pass it to a view)
            return view('weather', ['weatherData' => $data]);
        } catch (\Exception $e) {
            // Handle any errors that occur during the API request
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }
}