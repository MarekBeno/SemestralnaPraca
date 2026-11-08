<?php

namespace App\Controllers;

use App\Models\Song;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Správa piesní (CRUD): zoznam, detail, pridanie, úprava a zmazanie.
 */
class SongController extends BaseController
{
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    /** Zoznam všetkých piesní (Read). */
    public function index(Request $request): Response
    {
        return $this->html(['songs' => Song::getAll(orderBy: '`id` desc')]);
    }

    /** Detail jednej piesne (Read). */
    public function detail(Request $request): Response
    {
        return $this->html(['song' => $this->getSongOr404((int)$request->value('id'))]);
    }

    /** Prázdny formulár na pridanie piesne (Create). */
    public function add(Request $request): Response
    {
        return $this->formView(new Song(), [], 'index');
    }

    /** Formulár na úpravu existujúcej piesne (Update). */
    public function edit(Request $request): Response
    {
        return $this->formView($this->getSongOr404((int)$request->value('id')), [], $this->getFrom($request));
    }

    /** Spracovanie formulára: uloží novú pieseň, alebo upraví existujúcu. */
    public function save(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        // id > 0 znamená úpravu existujúcej piesne, inak vytvárame novú
        $id = (int)$request->post('id');
        $song = $id > 0 ? $this->getSongOr404($id) : new Song();
        $song->setTitle(trim((string)$request->post('title')));
        $song->setTonality(trim((string)$request->post('tonality')));
        $song->setGenre(trim((string)$request->post('genre')));
        $song->setAuthor(trim((string)$request->post('author')));

        $errors = $this->validate($song);
        if (count($errors) > 0) {
            return $this->formView($song, $errors, $this->getFrom($request));
        }

        $song->save();
        // po úprave sa vrátime tam, odkiaľ používateľ prišiel (detail alebo zoznam)
        if ($id > 0 && $this->getFrom($request) === 'detail') {
            return $this->redirect($this->url('song.detail', ['id' => $song->getId()]));
        }
        return $this->redirect($this->url('song.index'));
    }

    /** Zmazanie piesne (Delete), povolené len metódou POST. */
    public function delete(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }
        $this->getSongOr404((int)$request->post('id'))->delete();
        return $this->redirect($this->url('song.index'));
    }

    /** Zobrazí formulár spolu so zoznamami tónin a žánrov pre výber. */
    private function formView(Song $song, array $errors, string $from): Response
    {
        return $this->html([
            'song' => $song,
            'errors' => $errors,
            'from' => $from,
            'tonalities' => Song::TONALITIES,
            'genres' => Song::GENRES,
        ], 'form');
    }

    /** Odkiaľ používateľ prišiel na formulár: 'detail' alebo 'index' (zoznam). */
    private function getFrom(Request $request): string
    {
        return $request->value('from') === 'detail' ? 'detail' : 'index';
    }

    private function getSongOr404(int $id): Song
    {
        $song = Song::getOne($id);
        if ($song === null) {
            throw new HttpException(404);
        }
        return $song;
    }

    private function validate(Song $song): array
    {
        $errors = [];
        if ($song->getTitle() === '') {
            $errors[] = 'Pole „Názov“ je povinné.';
        } elseif (mb_strlen($song->getTitle()) > 100) {
            $errors[] = 'Pole „Názov“ môže mať najviac 100 znakov.';
        }
        // tónina a žáner musia byť z povolených hodnôt (formulár ich ponúka vo výbere)
        if (!in_array($song->getTonality(), array_merge(...array_values(Song::TONALITIES)), true)) {
            $errors[] = 'Vyber tóninu zo zoznamu.';
        }
        if (!in_array($song->getGenre(), Song::GENRES, true)) {
            $errors[] = 'Vyber žáner zo zoznamu.';
        }
        if ($song->getAuthor() === '') {
            $errors[] = 'Pole „Pridal“ je povinné.';
        } elseif (mb_strlen($song->getAuthor()) > 100) {
            $errors[] = 'Pole „Pridal“ môže mať najviac 100 znakov.';
        }
        return $errors;
    }
}
