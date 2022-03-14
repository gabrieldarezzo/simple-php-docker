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

    public function save()
    {
        try {
            return $this->pokemonService->getRandomPokemonName();
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }

    }
}
