<?php

namespace App\Models;

use Framework\Core\Model;

/**
 * Model piesne. Zodpovedá tabuľke `songs` (názov sa odvodí z názvu triedy).
 */
class Song extends Model
{
    /** Povolené tóniny pre výber vo formulári (po skupinách dur a mol). */
    public const TONALITIES = [
        'Dur' => ['C dur', 'Cis dur', 'Des dur', 'D dur', 'Es dur', 'E dur', 'F dur', 'Fis dur',
            'Ges dur', 'G dur', 'As dur', 'A dur', 'B dur', 'H dur'],
        'Mol' => ['c mol', 'cis mol', 'd mol', 'dis mol', 'es mol', 'e mol', 'f mol', 'fis mol',
            'g mol', 'gis mol', 'as mol', 'a mol', 'b mol', 'h mol'],
    ];

    /** Povolené žánre pre výber vo formulári. */
    public const GENRES = ['Ľudová', 'Valčík', 'Polka', 'Čardáš', 'Marš', 'Tango', 'Pop', 'Rock',
        'Jazz', 'Klasika', 'Hymna', 'Folk', 'Iné'];

    protected ?int $id = null;
    protected ?string $title = null;
    protected ?string $tonality = null;
    protected ?string $genre = null;
    protected ?string $author = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTonality(): ?string
    {
        return $this->tonality;
    }

    public function setTonality(string $tonality): void
    {
        $this->tonality = $tonality;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }
}
