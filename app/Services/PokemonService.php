<?php

namespace App\Services;

use GuzzleHttp\Client;

class PokemonService
{

    const POKEMON_URL = 'https://pokeapi.co/api/v2/';
    /**
     * @var Client
     */
    private $client;


    /**
     * @var array
     */
    private $pokemon;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->pokemon = \stdClass::class;
        $this->client = new Client([
            'base_uri' => self::POKEMON_URL,
        ]);
    }


    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRandomPokemon(): array
    {
        $response = $this->client->request('GET', 'pokemon/' . $this->getRandomNumber());
        return json_decode($response->getBody()->getContents(), true);
    }


    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRandomPokemonName(): string
    {
        $pokemon = $this->getRandomPokemon();
        return $pokemon['name'];
    }


    /**
     * return number beteween generation choise.
     * @return int
     */
    private function getRandomNumber(): int
    {
        return rand(1,10);
    }


}
