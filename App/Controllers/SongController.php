<?php

namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Stránky s piesňami: knižnica piesní (index) a detail piesne (detail).
 */
class SongController extends BaseController
{
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    public function index(Request $request): Response
    {
        $songs = [
            ['id' => 1, 'title' => 'Kopala studienku', 'key' => 'G dur', 'genre' => 'Ľudová', 'author' => 'Marek Beňo'],
            ['id' => 2, 'title' => 'Viedenský valčík', 'key' => 'C dur', 'genre' => 'Valčík', 'author' => 'Eva Kováčová'],
            ['id' => 3, 'title' => 'Polka z Detvy', 'key' => 'B dur', 'genre' => 'Polka', 'author' => 'Ján Novák'],
        ];
        return $this->html(compact('songs'));
    }

    public function detail(Request $request): Response
    {
        return $this->html();
    }
}
