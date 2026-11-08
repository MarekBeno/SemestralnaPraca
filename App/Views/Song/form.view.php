<?php

/** @var \App\Models\Song $song */
/** @var string[] $errors */
/** @var array<string, string[]> $tonalities */
/** @var string[] $genres */
/** @var string $from */
/** @var \Framework\Support\LinkGenerator $link */
?>
<section class="card panel form-panel" aria-label="Formulár piesne">
    <h1><?= $song->getId() ? 'Úprava piesne' : 'Nová pieseň' ?></h1>

    <?php if (count($errors) > 0) : ?>
        <div class="alert" role="alert">
            <?php foreach ($errors as $error) : ?>
                <div><?= e($error) ?></div>
            <?php endforeach ?>
        </div>
    <?php endif ?>

    <form method="post" action="<?= $link->url('song.save') ?>">
        <input type="hidden" name="id" value="<?= $song->getId() ?>">
        <input type="hidden" name="from" value="<?= e($from) ?>">
        <div class="field">
            <label for="title">Názov</label>
            <input id="title" name="title" type="text" maxlength="100" required value="<?= e($song->getTitle()) ?>">
        </div>
        <div class="field">
            <label for="tonality">Tónina</label>
            <select id="tonality" name="tonality" required>
                <option value="" disabled <?= $song->getTonality() ? '' : 'selected' ?>>Vyber tóninu</option>
                <?php foreach ($tonalities as $group => $items) : ?>
                    <optgroup label="<?= e($group) ?>">
                        <?php foreach ($items as $item) : ?>
                            <option value="<?= e($item) ?>" <?= $song->getTonality() === $item ? 'selected' : '' ?>><?= e($item) ?></option>
                        <?php endforeach ?>
                    </optgroup>
                <?php endforeach ?>
            </select>
        </div>
        <div class="field">
            <label for="genre">Typ / Žáner</label>
            <select id="genre" name="genre" required>
                <option value="" disabled <?= $song->getGenre() ? '' : 'selected' ?>>Vyber žáner</option>
                <?php foreach ($genres as $genre) : ?>
                    <option value="<?= e($genre) ?>" <?= $song->getGenre() === $genre ? 'selected' : '' ?>><?= e($genre) ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="field">
            <label for="author">Pridal</label>
            <input id="author" name="author" type="text" maxlength="100" required value="<?= e($song->getAuthor()) ?>">
        </div>
        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Uložiť</button>
            <a class="btn" href="<?= $from === 'detail' && $song->getId() ? $link->url('song.detail', ['id' => $song->getId()]) : $link->url('song.index') ?>">Späť</a>
        </div>
    </form>
</section>
