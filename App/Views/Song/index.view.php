<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var array $songs */
?>
<section class="hero">
    <h1>Objavuj hudobnú knižnicu</h1>
    <p>Prehliadaj piesne, vytváraj zoznamy a zdieľaj noty s ostatnými hudobníkmi</p>
    <a class="btn btn-white" href="#">Pridať novú pieseň</a>
</section>

<section class="card filters" aria-label="Filtrovanie piesní">
    <strong>Filtrovanie</strong>
    <select aria-label="Tónina"><option>Tónina</option><option>C dur</option><option>G dur</option></select>
    <select aria-label="Typ / Žáner"><option>Typ / Žáner</option><option>Ľudová</option><option>Valčík</option><option>Polka</option></select>
    <input class="search" type="search" placeholder="Vyhľadaj pieseň, autora..." aria-label="Vyhľadávanie">
</section>

<section class="song-grid" aria-label="Zoznam piesní">
    <?php foreach ($songs as $song) { ?>
        <article class="card song-card">
            <div class="song-thumb">
                <h2><a class="card-link" href="<?= $link->url('song.detail', ['id' => $song['id']]) ?>"><?= e($song['title']) ?></a></h2>
                <p><?= e($song['key']) ?> &bull; <?= e($song['genre']) ?></p>
            </div>
            <div class="song-body">
                <p class="meta">Pridal: <?= e($song['author']) ?></p>
                <a class="icon-btn" href="#" aria-label="Stiahnuť noty – <?= e($song['title']) ?>">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 4v11M7 11l5 5 5-5M5 20h14"/></svg>
                </a>
            </div>
        </article>
    <?php } ?>
</section>
<div class="more"><a class="btn" href="#">Načítaj ďalšie</a></div>
