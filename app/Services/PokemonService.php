<?php

namespace App\Services;

use App\Dto\Pokemon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\PDF;
use Illuminate\View\View;

class PokemonService
{
    /**
     * @var PokemonClientService
     */
    private PokemonClientService $client;


    /**
     * @param PokemonClientService $client
     */
    public function __construct(PokemonClientService $client)
    {
        $this->client = $client;
    }

    /**
     * @return PDF
     */
    public function getPdfWrapper(): Pdf
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('a4', 'landscape');
        return $pdf;
    }

    /**
     * @param Pokemon $pokemon
     * @return View|\Laravel\Lumen\Application
     */
    public function generateHtml(Pokemon $pokemon): View
    {
        return view('pokemon-template', [
            'name' => $pokemon->name,
            'img_url' => $pokemon->getPhotoBase64(),
            'uuid' => $pokemon->getUnique()
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function generatePdfFromPokemon(): Response
    {
        $pokemon = $this->client->getRandomPokemon();
        $html = $this->generateHtml($pokemon);
        $pdf = $this->getPdfWrapper();
        $pdf->loadHTML($html);
        return $pdf->stream();
    }

}
