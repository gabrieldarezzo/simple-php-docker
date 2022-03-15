<?php

namespace App\Http\Controllers;

use App\Services\PokemonService;

class PokemonController extends Controller
{
    /**
     * @var PokemonService
     */
    private $pokemonService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PokemonService $pokemonService)
    {
        $this->pokemonService = $pokemonService;
    }

    public function random()
    {
        try {
            $this->pokemonService->setPokemon($this->pokemonService->getRandomPokemon());
            return "<h3>{$this->pokemonService->getPokemonName()}</h3><hr/><img src='{$this->pokemonService->getPokemonPhoto()}'/>";
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }
}
