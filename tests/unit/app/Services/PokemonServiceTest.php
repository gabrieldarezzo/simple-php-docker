<?php


namespace unit\app\Services;
use App\Services\PokemonService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use TestCase;

class PokemonServiceTest extends TestCase
{
    public function testGetRandomPokemonName()
    {
        $client  = new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(200, ['Content-Type' => 'application/json'], json_encode([
                    'name' => 'charmeleon',
                    'prites' => [
                        "front_default" => "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/5.png"
                    ]
                ]))
            ])),
        ]);
        $this->pokemonService = new PokemonService($client);
        $pokemonName = $this->pokemonService->getRandomPokemonName();
        $this->assertEquals('charmeleon', $pokemonName);
    }
}
