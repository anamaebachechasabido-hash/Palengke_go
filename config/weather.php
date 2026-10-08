<?php

return [
    /* OpenWeatherMap by default. Configure via .env */
    'api_key' => env('WEATHER_API_KEY', null),
    'url' => env('WEATHER_API_URL', 'https://api.openweathermap.org/data/2.5/weather'),
    'provider' => env('WEATHER_PROVIDER', null),
    'default_city' => env('WEATHER_DEFAULT_CITY', 'Manila'),
    'timeout' => env('WEATHER_TIMEOUT', 5),
    'latitude' => env('WEATHER_LATITUDE', '7.19'),
    'longitude' => env('WEATHER_LONGITUDE', '125.46'),
    'open_meteo_current_params' => env('WEATHER_OPEN_METEO_PARAMS', 'temperature_2m,relative_humidity_2m,wind_speed_10m'),
];
