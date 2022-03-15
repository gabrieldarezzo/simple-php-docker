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
    public function getRandomPokemonName(): string
    {
        $pokemon = $this->getRandomPokemon();
        return $pokemon['name'];
    }
}
