<?php

namespace App\Services;

use App\Dto\Pokemon;
use GuzzleHttp\Client;

class PokemonClientService
{

    const POKEMON_URL = 'https://pokeapi.co/api/v2/';
    /**
     * @var Client
     */
    private Client $client;


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
     * return a random id of first generation.
     * @return int
     */
    private function getRandomIdFirstGeneration(): int
    {
        return rand(1, 151);
    }

    /**
     * @return Pokemon
     */
    public function getRandomPokemon(): Pokemon
    {
        return $this->getPokemon($this->getRandomIdFirstGeneration());
    }


    /**
     * @param int $id
     * @return Pokemon
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getPokemon(int $id): Pokemon
    {
        // Separar em outra classe
        $response = $this->client->request('GET', $this->setUrl('pokemon/' . $id), [
            'http_errors' => false
        ]);

        if($response->getStatusCode() === 404) {
            throw new \Exception('Pokemon not Found');
        }


        $pokemonArr = json_decode($response->getBody()->getContents(), true);


        return new Pokemon(
            $pokemonArr['id'],
            $pokemonArr['name'],
            $pokemonArr['sprites']['front_default'],
        );
    }
}
