<?php

/** @var \App\Models\Song[] $songs */
/** @var \Framework\Support\LinkGenerator $link */
?>
<section class="hero">
    <h1>Objavuj hudobnú knižnicu</h1>
    <p>Prehliadaj piesne, vytváraj zoznamy a zdieľaj noty s ostatnými hudobníkmi</p>
    <a class="btn btn-white" href="<?= $link->url('song.add') ?>">Pridať novú pieseň</a>
</section>

<section class="card filters" aria-label="Filtrovanie piesní">
    <strong>Filtrovanie</strong>
    <select aria-label="Tónina"><option>Tónina</option><option>C dur</option><option>G dur</option></select>
    <select aria-label="Typ / Žáner"><option>Typ / Žáner</option><option>Ľudová</option><option>Valčík</option><option>Polka</option></select>
    <input class="search" type="search" placeholder="Vyhľadaj pieseň, autora..." aria-label="Vyhľadávanie">
</section>

<?php if (count($songs) > 0) : ?>
    <section class="song-grid" aria-label="Zoznam piesní">
        <?php foreach ($songs as $song) : ?>
            <article class="card song-card">
                <div class="song-thumb">
                    <h2><a class="card-link" href="<?= $link->url('song.detail', ['id' => $song->getId()]) ?>"><?= e($song->getTitle()) ?></a></h2>
                    <p><?= e($song->getTonality()) ?> &bull; <?= e($song->getGenre()) ?></p>
                </div>
                <div class="song-body">
                    <p class="meta">Pridal: <?= e($song->getAuthor()) ?></p>
                    <div class="card-actions">
                        <a class="icon-btn" href="#" aria-label="Stiahnuť noty – <?= e($song->getTitle()) ?>">
                            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 4v11M7 11l5 5 5-5M5 20h14"/></svg>
                        </a>
                        <a class="btn btn-sm" href="<?= $link->url('song.edit', ['id' => $song->getId()]) ?>">Upraviť</a>
                        <form class="inline-form" method="post" action="<?= $link->url('song.delete') ?>">
                            <input type="hidden" name="id" value="<?= $song->getId() ?>">
                            <button class="btn btn-sm" type="submit">Zmazať</button>
                        </form>
                    </div>
                </div>
            </article>
        <?php endforeach ?>
    </section>
    <div class="more"><a class="btn" href="#">Načítaj ďalšie</a></div>
<?php else : ?>
    <p class="empty">V knižnici zatiaľ nie sú žiadne piesne.</p>
<?php endif ?>
