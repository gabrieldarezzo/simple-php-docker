<?php

namespace App\Http\Controllers;

use App\Jobs\ExampleJob;
use App\Services\PokemonService;
use Illuminate\Support\Facades\App;
use Svg\Tag\Image;

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


        //$path = url('10.jpg');
        $path = url('https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/10.png');

//        $filePath = 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/10.png';
//        $image = imagecreatefrompng($filePath);
//        $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
//        imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
//        imagealphablending($bg, TRUE);
//        imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
//        imagedestroy($image);
//        $quality = 50; // 0 = low / smaller file, 100 = better / bigger file
//        imagejpeg($bg, $filePath . ".jpg", $quality); // :VISH
//        imagedestroy($bg);





        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $html = view('pokemon-template', [
            'name' => 'caterpie' . rand(1, 10),
            'img_url' => $base64
        ]);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html)->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
