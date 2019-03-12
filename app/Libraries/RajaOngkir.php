<?php

namespace App\Libraries;

use GuzzleHttp\Client;
use App\Libraries\JSON;

/**
 * Simple RajaOngkir API Client Library
 * Require Guzzle
 * Credits @Jokosudarsono
 */
class RajaOngkir
{
    /** HTTP Query Parameters */
    private static $query = [];

    /** HTTP POST Parameters */
    private static $params = [];

    /** HTTP Headers */
    public static $headers = [];

    /**
     * Request to RajaOngkir API
     *
     * @param string $method | HTTP Verb Method
     * @param string $endpoint | API Endpoint
     * @return Object
     */
    public static function request($method, $endpoint)
    {
        try {

            $client = new Client(['base_uri' => \Config::get('services.rajaongkir.domain')]);
            $result = $client->request($method, $endpoint,[
                'headers' => array_merge(['key' => \Config::get('services.rajaongkir.key')], self::$headers),
                'query' => self::$query,
                'form_params' => self::$params
            ]);

            $body = $result->getBody()->getContents();

        } catch (\GuzzleHttp\Exception\RequestException $e) {

            $body = $e->getResponse()->getBody(true);

        } catch (Exception $e) {
            $body = $e->getMessage();
        }

        return JSON::parse($body);
    }

    /**
     * GET Method
     *
     * @param string $endpoint | API Endpoint
     * @param array $query | HTTP Query Parameters
     * @return Object
     */
    public static function get($endpoint, $query = [])
    {
        self::$query = $query;
        return self::request('GET', $endpoint);
    }

    /**
     * POST Method
     *
     * @param string $endpoint | API Endpoint
     * @param array $params | HTTP POST Parameters
     * @param array $query | HTTP Query Parameters
     * @return Object
     */
    public static function post($endpoint, $params = [], $query = [])
    {
        self::$query = $query;
        self::$params = $params;
        return self::request('POST', $endpoint);
    }
}