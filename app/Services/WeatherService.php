<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    protected $url;
    protected $key;
    protected $timeout;
    protected $provider;

    public function __construct()
    {
        $this->url = config('weather.url');
        $this->key = config('weather.api_key');
        $this->timeout = config('weather.timeout', 5);
        $this->provider = config('weather.provider');
    }

    public function fetch(string $city = null): ?array
    {
        $city = $city ?: config('weather.default_city');

        // If provider is set to 'open-meteo' or no API key, use Open-Meteo
        if ($this->provider === 'open-meteo' || !$this->key) {
            return $this->fetchOpenMeteo();
        }

        try {
            $response = Http::timeout($this->timeout)
                ->get($this->url, [
                    'q' => $city,
                    'appid' => $this->key,
                    'units' => 'metric',
                ]);

            if ($response->successful()) {
                $data = $response->json();

                return [
                    'city' => $data['name'] ?? $city,
                    'temperature' => isset($data['main']['temp']) ? round($data['main']['temp']) : null,
                    'description' => $data['weather'][0]['description'] ?? null,
                    'humidity' => $data['main']['humidity'] ?? null,
                    'wind_speed' => $data['wind']['speed'] ?? null,
                    'raw' => $data,
                ];
            }

            Log::warning('Weather API responded with non-success', ['status' => $response->status(), 'body' => $response->body()]);
            return null;
        } catch (\Exception $e) {
            Log::error('Weather API request failed: ' . $e->getMessage());
            return null;
        }
    }

    protected function fetchOpenMeteo(): ?array
    {
        $lat = config('weather.latitude');
        $lon = config('weather.longitude');
        $params = config('weather.open_meteo_current_params', 'temperature_2m,relative_humidity_2m,wind_speed_10m');

        $url = 'https://api.open-meteo.com/v1/forecast';

        try {
            $response = Http::timeout($this->timeout)
                ->get($url, [
                    'latitude' => $lat,
                    'longitude' => $lon,
                    'current_weather' => true,
                    'hourly' => $params,
                ]);

            if ($response->successful()) {
                $data = $response->json();

                // Map data: Open-Meteo provides current_weather and hourly arrays
                $current = $data['current_weather'] ?? null;

                // Attempt to derive humidity from hourly if available (best-effort)
                $humidity = null;
                if (isset($data['hourly']) && isset($data['hourly']['relative_humidity_2m'])) {
                    $hourly = $data['hourly'];
                    // find the latest value
                    $vals = $hourly['relative_humidity_2m'];
                    $humidity = is_array($vals) ? end($vals) : $vals;
                }

                return [
                    'city' => config('weather.default_city', 'Arakan, North Cotabato'),
                    'temperature' => isset($current['temperature']) ? round($current['temperature']) : null,
                    'description' => isset($current['weathercode']) ? 'Weather code: ' . $current['weathercode'] : null,
                    'humidity' => $humidity,
                    'wind_speed' => $current['windspeed'] ?? null,
                    'raw' => $data,
                ];
            }

            Log::warning('Open-Meteo responded with non-success', ['status' => $response->status(), 'body' => $response->body()]);
            return null;
        } catch (\Exception $e) {
            Log::error('Open-Meteo request failed: ' . $e->getMessage());
            return null;
        }
    }
}
