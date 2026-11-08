<?php

/** @var \App\Models\Song $song */
/** @var \Framework\Support\LinkGenerator $link */
?>
<div class="page-title">
 <h1><?= e($song->getTitle()) ?></h1>
 <span class="chip">Verejná</span>
 <div class="actions">
  <a class="btn" href="<?= $link->url('song.edit', ['id' => $song->getId(), 'from' => 'detail']) ?>">Upraviť pieseň</a>
  <form class="inline-form" method="post" action="<?= $link->url('song.delete') ?>">
    <input type="hidden" name="id" value="<?= $song->getId() ?>">
    <button class="btn" type="submit">Zmazať pieseň</button>
   </form>
 </div>
</div>

<div class="detail-grid">
 <section class="card panel" aria-label="Noty">
  <div class="notes-preview"><div><strong>Náhľad nôt</strong><p>obrázok</p></div></div>
  <div class="pager">
   <a class="btn btn-sm" href="#">Predchádzajúca</a>
   <span>Strana 1 z 3</span>
   <a class="btn btn-sm" href="#">Ďalšia</a>
  </div>
 </section>

 <aside class="card panel" aria-label="Informácie o piesni">
  <h2>Informácie</h2>
  <dl class="info">
   <dt>Pridal</dt><dd><?= e($song->getAuthor()) ?></dd>
   <dt>Tónina</dt><dd><?= e($song->getTonality()) ?></dd>
   <dt>Typ / Žáner</dt><dd><?= e($song->getGenre()) ?></dd>
   
  </dl>
  <div class="info-actions">
   <a class="btn btn-primary btn-block" href="#">Stiahnuť noty</a>
   <select aria-label="Vybrať zoznam"><option>Vybrať zoznam</option><option>Svadba 2026</option></select>
   <button class="btn btn-block" type="button">Pridať do zoznamu</button>
  </div>
 </aside>
</div>

<section class="card panel" aria-label="Komentáre">
 <h2>Komentáre (3)</h2>
 <div class="comment-form">
  <input type="text" placeholder="Napíš komentár..." aria-label="Nový komentár">
  <button class="btn btn-primary" type="button">Odoslať</button>
 </div>
 <ul class="comments">
  <li class="comment"><span class="avatar">JN</span><div><strong>Ján Novák</strong><p>Výborné, čitateľné noty.</p></div></li>
  <li class="comment"><span class="avatar">EK</span><div><strong>Eva Kováčová</strong><p>Hrali sme to na svadbe, funguje to skvele.</p></div></li>
  <li class="comment"><span class="avatar">MB</span><div><strong>Marek Beňo</strong><p>Pridal som aj verziu v tónine G dur.</p></div><button class="btn btn-sm" type="button">Zmazať</button></li>
 </ul>
</section>
 
