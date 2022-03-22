<?php

namespace App\Http\Controllers;

use App\Jobs\ExampleJob;
use App\Services\PokemonService;

class PokemonController extends Controller
{
    /**
     * @var PokemonService
     */
    private PokemonService $pokemonService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PokemonService $pokemonService)
    {
        $this->pokemonService = $pokemonService;
    }


    public function call()
    {
        $this->dispatch(new ExampleJob);
    }

    public function pdf()
    {
        return $this->pokemonService->generatePdfFromPokemon();
    }
}
