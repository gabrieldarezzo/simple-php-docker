<?php


namespace unit\app\Dto;
use App\Dto\Pokemon;
use TestCase;
use unit\dummy\Base64;

class PokemonTest extends TestCase
{

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->base64 = new Base64();
    }

    public function testGetPhotoBase64ShouldReturnDataImage()
    {
        $pokemon = new Pokemon(
            10,
            'caterpie',
            'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/10.png'
        );

        $pokemonPhotoBase64 = $pokemon->getPhotoBase64();
        $this->assertStringContainsString('data:image/;base64', $pokemonPhotoBase64);
        $this->assertEquals($this->base64->getBase64(), $pokemonPhotoBase64);
    }
}
