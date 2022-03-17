<?php

namespace App\Http\Controllers;

use App\Jobs\ExampleJob;
use App\Services\PokemonService;
use Illuminate\Support\Facades\App;

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

    public function random()
    {
        try {
            $this->pokemonService->setPokemon($this->pokemonService->getRandomPokemon());
            return "<h3>{$this->pokemonService->getPokemonName()}</h3><hr/><img src='{$this->pokemonService->getPokemonPhoto()}'/>";
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }


    public function call()
    {
        $this->dispatch(new ExampleJob);
    }

    public function pdf()
    {
        $this->pokemonService->setPokemon($this->pokemonService->getRandomPokemon());

        $html = view('pokemon-template', [
            'name' => ucfirst($this->pokemonService->getPokemonName()),
            'img_url' => $this->pokemonService->getPokemonPhotoBase64(),
            'uuid' => uniqid()
        ]);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html)->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
