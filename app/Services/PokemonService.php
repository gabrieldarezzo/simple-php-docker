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
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    private function setUrl($url = ''): string
    {
        return self::POKEMON_URL . $url;
    }

    /**
     * return number beteween generation choise.
     * @return int
     */
    private function getRandomNumber(): int
    {
        return rand(1,10);
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRandomPokemon(): array
    {
        $response = $this->client->request('GET', $this->setUrl('pokemon/' . $this->getRandomNumber()));
        return json_decode($response->getBody()->getContents(), true);
    }


    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPokemonName(): string
    {
        return $this->pokemon['name'];
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPokemonPhoto(): string
    {
        return $this->pokemon['sprites']['front_default'];
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setPokemon($pokemon)
    {
        return $this->pokemon = $pokemon;
    }
}
