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

    /**
     * @var PokemonService
     */
    private PokemonService $pokemonService;

    protected function setUp(): void
    {
        $client  = new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(200, ['Content-Type' => 'application/json'], json_encode([
                    'name' => 'charmeleon',
                    'sprites' => [
                        "front_default" => "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/5.png"
                    ]
                ]))
            ])),
        ]);
        $this->pokemonService = new PokemonService($client);
    }

    public function testGetPokemonName()
    {
        $this->pokemonService->setPokemon($this->pokemonService->getRandomPokemon());
        $pokemonName = $this->pokemonService->getPokemonName();
        $this->assertEquals('charmeleon', $pokemonName);
    }

    public function testGetPokemonPhoto()
    {
        $this->pokemonService->setPokemon($this->pokemonService->getRandomPokemon());
        $pokemonPhoto = $this->pokemonService->getPokemonPhoto();
        $this->assertEquals('https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/5.png', $pokemonPhoto);
    }
}
