<?php


namespace unit\app\Services;
use App\Services\PokemonService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use TestCase;
use unit\dummy\Base64;

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
                        "front_default" => "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/10.png"
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
        $this->assertEquals('https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/10.png', $pokemonPhoto);
    }


    public function testGetPokemonPhotoBase64()
    {
        $this->pokemonService->setPokemon($this->pokemonService->getRandomPokemon());
        $pokemonPhotoBase64 = $this->pokemonService->getPokemonPhotoBase64();
        $this->assertStringContainsString('data:image/;base64', $pokemonPhotoBase64);
        $base64 = new Base64();
        $this->assertEquals($base64->base64, $pokemonPhotoBase64);
    }


//    public function testGetPokemonPhotoBase64ShouldThrowError(){}
}
