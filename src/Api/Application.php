<?php

namespace RrEarring\BaiduMap\Api;

use RrEarring\BaiduMap\Kernel\Contracts\ServiceContainer;

/**
 * Class Application
 * @package RrEarring\BaiduMap\Api
 *
 * @property ReverseGeocoding\Client $reverse_geocoding
 * @property Geocoding\Client $geocoding
 * @property Place\Client $place
 * @property IpLocation\Client $ip_location
 * @property Geoconv\Client $geoconv
 * @property RouteMatrix\Client $route_matrix
 * @property DirectionLite\Client $direction_lite
 * @property Direction\Client $direction
 * @property LogisticsDirection\Client $logistics_direction
 * @property Timezone\Client $timezone
 * @property Parking\Client $parking
 * @property Rectify\Client $rectify
 * @property TrackMatch\Client $track_match
 * @property ApiTrackanalysis\Client $api_trackanalysis
 * @property Traffic\Client $traffic
 * @property Weather\Client $weather
 * @property WeatherAbroad\Client $weather_abroad
 * @property ApiRegionSearch\Client $api_region_search
 */
class Application extends ServiceContainer
{
    protected $providers = [
        ReverseGeocoding\ServiceProvider::class,
        Geocoding\ServiceProvider::class,
        Place\ServiceProvider::class,
        IpLocation\ServiceProvider::class,
        Geoconv\ServiceProvider::class,
        RouteMatrix\ServiceProvider::class,
        DirectionLite\ServiceProvider::class,
        Direction\ServiceProvider::class,
        LogisticsDirection\ServiceProvider::class,
        Timezone\ServiceProvider::class,
        Parking\ServiceProvider::class,
        Rectify\ServiceProvider::class,
        TrackMatch\ServiceProvider::class,
        ApiTrackanalysis\ServiceProvider::class,
        Traffic\ServiceProvider::class,
        Weather\ServiceProvider::class,
        WeatherAbroad\ServiceProvider::class,
        ApiRegionSearch\ServiceProvider::class,
    ];
}