<?php


namespace unit\app\Services;
use App\Dto\Pokemon;
use App\Services\PokemonClientService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use TestCase;

class PokemonClientServiceTest extends TestCase
{

    /**
     * @var PokemonClientService
     */
    private PokemonClientService $pokemonClientService;

    protected function setUp(): void
    {
        $client  = new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(200, ['Content-Type' => 'application/json'], json_encode([
                    'id' => 10,
                    'name' => 'caterpie',
                    'sprites' => [
                        "front_default" => "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/10.png"
                    ]
                ]))
            ])),
        ]);
        $this->pokemonClientService = new PokemonClientService($client);
    }

    public function testGetPokemonSuccefullShouldReturnInstanceOfPokemon()
    {
        $this->assertInstanceOf(Pokemon::class, $this->pokemonClientService->getRandomPokemon());
    }

    //    public function testGetPokemonErrorShouldThrowError(){}

}
